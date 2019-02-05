<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cavill & Messan Co. </title>
    <link rel="shortcut icon" href="fav_icon.png">
    <link rel="stylesheet" href="public_html/styles/normalize.css">
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Open+Sans');

   body{
    width:100%;
    background-color:white;
     background-image: url("main_background.jpg");
    background-size:cover;
    background-repeat:no-repeat;
    background-position: -3 , 0;
   }

   body h1{
       color:rgb(6, 51, 43);
       width:85%;
       margin: 0 auto;
       text-align:center;
       margin-top:2em;
       font-family: 'Open Sans', sans-serif;
       font-weight:bold;
       font-size:3em;
       background: rgba(255, 255, 255, 0.6);

   }

   body h2{
    color:rgb(6, 51, 43);
       width:50%;
       margin: 0 auto;
       text-align:center;
       margin-top:2em;
       font-family: 'Open Sans', sans-serif;
       font-weight:bold;
       font-size:2.5em;
       background: rgba(255, 255, 255, 0.6);
   }

   #register{
    background: rgba(255, 255, 255, 0.6);
    width:55%;
    margin: 0 auto;
    margin-top: 1em;
   }
   
   #register form{
    width: 60%;
    margin: 0 auto;
    font-family: 'Open Sans', sans-serif;
    font-weight:bold;
    color:rgb(6, 51, 43);
    padding-top:1em;
    padding-bottom:1em;
   }


   #regiter form input{
       margin-left:1em;
       padding-bottom:0.7em;
   }

   #get_info{
    background: rgba(255, 255, 255, 0.6);
    width:55%;
    margin: 0 auto;
    margin-top: 1em;
   }

   #get_info form{
    width: 80%;
    margin: 0 auto;
    font-family: 'Open Sans', sans-serif;
    font-weight:bold;
    color:rgb(6, 51, 43);
    padding-top:1em;em;
    margin-bottom:0.5em;
   }

   #osubmit{
       width:20%;
       margin-left: 40%;
       font-family: 'Open Sans', sans-serif;
       font-weight:bold;
       color:rgb(6, 51, 43);
   }
   
   #sb{
       font-family: 'Open Sans', sans-serif;
       font-weight:bold;
       color:rgb(6, 51, 43);
       
   }
   
   #view_all{
       
       font-family: 'Open Sans', sans-serif;
       font-weight:bold;
       color:rgb(6, 51, 43);
   }
    </style>
    
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "id3907483_mandc";
    $password = "noChair6^";
    $dbname = "id3907483_solmaris";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    //$sql = "SELECT LAST_NAME, FIRST_NAME, STATE FROM OWNER";
    //$result = $conn->query($sql);
    
    //if ($result->num_rows > 0) {
        // output data of each row
       // while($row = $result->fetch_assoc()) {
            //echo "Last Name: " . $row["LAST_NAME"]. " First name: " . $row["FIRST_NAME"]. "   State: " . $row["STATE"]. "<br>";        }
    //} else {
    //    echo "0 results";
    //}
    //$conn->close();
?> 
<h1>Welcome to Cavill & Messan Condo Management</h1>

<h2>Register My Condo</h2>

<div id="register">
<form method="post" action="solmaris.php">
    
  <?php $CONDO_ID = $LOCATION_NUM = $UNIT_NUM = $SQR_FT = $BDRMS = $BATHS = $CONDO_FEE = $OWNER_NUM = ""?>

  Condo ID Number: <input type="number" name="CONDO_ID">
  <br><br>

  Assigned Location Number: <input type="number" name="LOCATION_NUM" >
  <br><br>

  Unit Number: <input type="text" name="UNIT_NUM">
  <br><br>

  Size (in squarefeet): <input type="number" name="SQR_FT">
  <br><br>

  Number of Bedrooms: <input type="number" name="BDRMS">
  <br><br>

  Number of Bathrooms: <input type="number" name="BATHS">
  <br><br>

  Monthly Condo Fee Ammount: <input type="number" name="CONDO_FEE">
  <br><br>

  Owner ID Number: <input type="text" name="OWNER_NUM">
  <br><br>

  <input type="submit" name="SUBMIT1" id="sb">
  <br><br>

  <?php 
  
  if(isset($_POST["SUBMIT1"])){

    $CONDO_ID = $_POST['CONDO_ID'];
    $LOCATION_NUM = $_POST['LOCATION_NUM'];
    $UNIT_NUM = $_POST['UNIT_NUM'];
    $SQR_FT = $_POST['SQR_FT'];
    $BDRMS = $_POST['BDRMS'];
    $BATHS = $_POST['BATHS'];
    $CONDO_FEE = $_POST['CONDO_FEE'];
    $OWNER_NUM = $_POST['OWNER_NUM'];

      
  }
  $sql = "INSERT INTO CONDO_UNIT (CONDO_ID, LOCATION_NUM, UNIT_NUM, SQR_FT, BDRMS, BATHS, CONDO_FEE, OWNER_NUM) VALUES ($CONDO_ID, $LOCATION_NUM, '$UNIT_NUM', $SQR_FT, $BDRMS, $BATHS, $CONDO_FEE, '$OWNER_NUM')";

  //echo $sql;

  $success = mysqli_query($conn, $sql );

  if($success){

    echo "Condo successfuly registered";
    
  }
    // else{
    // echo mysqli_error($conn);}

?>

</form>
</div>

<h2>Get My Condo's Info</h2>
<div id="get_info">

<form id="form" method="post" action="solmaris.php">
    
  <?php $OWNER_NUM = ""?>

  Enter Owner ID Number: <input type="text" name="OWNER_NUM">
  <br><br>

  <input id="osubmit" type="submit" name="SUBMIT2">
  <br><br>

  <?php 
  if(isset($_POST["SUBMIT2"])){
      $OWNER_NUM = $_POST["OWNER_NUM"];
  

     $sql = "SELECT * FROM CONDO_UNIT WHERE OWNER_NUM = '$OWNER_NUM'";

     $success = mysqli_query($conn, $sql );
  
     if ($success->num_rows > 0) 
     {
         //output data of each row
         while($row = $success->fetch_assoc()) {
             echo "Condo ID: " . $row["CONDO_ID"]. " Location Number: " . $row["LOCATION_NUM"]. "   Unit Number: " . $row["UNIT_NUM"]. " Size: " .$row["SQR_FT"]. "ft            Bedrooms: " .$row["BDRMS"]. " Bathrooms: " .$row["BATHS"]. " Monthly fee:" .$row["CONDO_FEE"].   "<br><br>" ;   

            } 
     }

     else {
        echo "No condos associated with this owner number. ";
    }
    
  }

?> 
<center><a id="view_all" href="https://candmcondo.000webhostapp.com/list.php">View All Condos</a>
<br><br>
</form>


</div>




</body>
</html>