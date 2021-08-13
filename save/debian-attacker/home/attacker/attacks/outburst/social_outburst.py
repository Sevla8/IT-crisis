#!/usr/bin/env python2

import socket
import sys
import requests
from bs4 import BeautifulSoup

if __name__ == "__main__":
	import argparse
	parser = argparse.ArgumentParser(description="Malware Python script")
	parser.add_argument("host", help="Hostname or IP Address of SSH Server to bruteforce")

	args = parser.parse_args()
	host_ip = args.host

	url = 'http://' + host_ip + '/index.php'
	html = requests.get(url).text
	if len(html) == 892:
		exit()

	try:
		s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		print("Socket successfully created")
	except socket.error as err:
		print("socket creation failed with error %s" %(err))

	port = 22222

	print('Connecting...');
	s.connect((host_ip, port))
	d = s.recv(1024);
	print(d.decode());

	print('Sending data...');
	data = "web";
	s.send(data.encode());
	d = s.recv(1024);
	print(d.decode());
