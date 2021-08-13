#!/usr/bin/env python2

import socket
import sys

if __name__ == "__main__":
	import argparse
	parser = argparse.ArgumentParser(description="Malware Python script")
	parser.add_argument("host", help="Hostname or IP Address of SSH Server to bruteforce")
	parser.add_argument("-a", "--arg", help="Argument")

	args = parser.parse_args()
	host_ip = args.host
	arg = args.arg

	try:
		s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		print("Socket successfully created")
	except socket.error as err:
		print("socket creation failed with error %s" %(err))

	port = 2222

	print('Connecting...');
	s.connect((host_ip, port))
	d = s.recv(1024);
	print(d.decode());

	print('Sending data...');
	data = arg;
	s.send(data.encode());
	d = s.recv(1024);
	print(d.decode());
