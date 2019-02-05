/*This is my implementation of a mouse driver in kernel space, assuming the keyboard is connected to a usb port. 
 * Chelsea Messan
 */

#include <linux/kernel.h>
#include <linux/interrupt.h>
#include <linux/module.h>
#include <linux/proc_fs.h>
#include <linux/keyboard.h>
#include <asm/uaccess.h>
#include <asm/io.h>
#include <linux/input.h>


#define PROC_FILE_NAME "kbm"  //name of my module
 

#define UP_ARROW    108   //keysym 0xff52
#define LEFT_ARROW  105   //keysym 0xff51
#define RIGHT_ARROW 106   //keysym 0xff53
#define DOWN_ARROW  103   //keysym 0xff54
#define SPACE_BAR   57    //keysym 0x20


int key = 0;
int pos =11; 
size_t tcount = 0;
struct input_dev *cat;
struct notifier_block nb;




int kb_notifier_fn(struct notifier_block *nb, unsigned long action, void* data){
    struct keyboard_notifier_param *kp = (struct keyboard_notifier_param*)data;
    
    //printk("action = %lu Key:  %d  Lights:  %d  Shiftmap:  %x Down:  %d \n", action,  kp->value, kp->ledstate, kp->shift, kp->down);

    key = kp->value; 
    
    switch(key)
    {
        case UP_ARROW:
            input_report_rel(cat, REL_Y, pos);
        break; 
        
        case LEFT_ARROW:
                        input_report_rel(cat, REL_X, -pos);
                break;

        case RIGHT_ARROW:
                        input_report_rel(cat, REL_X, pos);
                break;

        case DOWN_ARROW:
                        input_report_rel(cat, REL_Y, -pos);
                break;

        case SPACE_BAR :
                  //      input_report_rel(cat, BTN_LEFT, pos);
            if(kp->down == 0)
            {
                input_report_rel(cat, BTN_LEFT, pos);
            }
            else
            {
                printk("not released yet");


            }
                break;
        
        default: return 0; 
    } 
    input_sync(cat);     
    return 0;
}

static int init (void) {
    cat = input_allocate_device();

    cat->name = "cat";
    set_bit(EV_REL, cat->evbit);
    set_bit(REL_X, cat->relbit);
    set_bit(REL_Y, cat->relbit);

    set_bit(EV_KEY, cat->evbit);
    set_bit(BTN_LEFT, cat->keybit);
    input_register_device(cat);

    nb.notifier_call = kb_notifier_fn;
    register_keyboard_notifier(&nb);

    return 0;
}

static void cleanup(void) {
    input_unregister_device(cat);
    unregister_keyboard_notifier(&nb);
}

MODULE_LICENSE("GPL"); 
module_init(init);
module_exit(cleanup);