#!/usr/bin/python3
from Crypto.Cipher import AES
from Crypto.PublicKey import RSA
from Crypto import Random
from socket import * 
import threading

class Server:

	#create socket	
	s = socket(AF_INET,SOCK_STREAM)
	def __init__(self):
		
		connections = []  #keep track of connections
		address = ("127.0.0.1",1041)
		self.s.bind(address) #assign server this address
		self.s.listen(2)	#set max num of connections to 2
		conn,addr = self.s.accept() 
		#print(conn,addr)

		key = RSA.generate(1024,Random.new().read) #generate RSA key
		public_key = key.publickey().exportKey('PEM') #generate public key
		
		private_key = key.exportKey('PEM') #generate the private key & its object
		privObj = RSA.importKey(private_key)

		conn.send(public_key) # send public key 
	
		encrypted_AES =  conn.recv(1000) #receive encryped AES key

		decrypted_AES = privObj.decrypt(encrypted_AES) #generate AES object key
		cipher = AES.new(decrypted_AES,AES.MODE_CFB,decrypted_AES)
	
		def sendMessage():
			while True:
				data1 = raw_input("")
				data1 = cipher.encrypt(data1)
				conn.send(data1)
				print
		
		
		
		bThread = threading.Thread(target = sendMessage)
		bThread.start()
			
		while True:
			data2 = conn.recv(2000)
			data2 = cipher.decrypt(data2)
			if not data2:
				break
			print(str(data2))
			print

Server()
