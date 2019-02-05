#!/usr/bin/python
from Crypto.Cipher import AES
from Crypto.PublicKey import RSA
from Crypto import Random
from socket import *
import threading
import sys


class Client:
	
	#password  = "chocolateisgreat"
	#create socket
	s = socket(AF_INET,SOCK_STREAM)

	def __init__(self):

		#connect to server
		address = ("127.0.0.1",1041)
		self.s.connect(address)
		
		#receive public key
		pubkey = self.s.recv(1000)

		#create RSA object with pubkey
		pubkeyObj = RSA.importKey(pubkey)
	
		#create AES key
		AES_key = AES.new("chocolateisgreat",AES.MODE_CFB,"chocolateisgreat")

		#encrypt AES key with public RSA
		encrypted_AES = pubkeyObj.encrypt("chocolateisgreat",AES_key)[0]
		self.s.send(encrypted_AES)
		
		
		def sendMessage():
			while True:
				data1 = raw_input("")
				data1 = AES_key.encrypt(data1)
				self.s.send(data1)
				print

	
		aThread = threading.Thread(target = sendMessage)
		aThread.start()

		while True:
			data2 = self.s.recv(2000)
			data2 = AES_key.decrypt(data2)
			if not data2:
				break
			print(data2)
			print



Client()
