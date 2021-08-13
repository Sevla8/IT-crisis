#!/usr/bin/env python2

import telnetlib
import time

def main(host, src, dst, subject, message):
	data = "FROM: " + src + "\nTO: " + dst + "\nSUBJECT: " + subject + "\n\n" + message + "\r\n.\r\n"

	tn = telnetlib.Telnet(host, 25)
	time.sleep(5)
	print(tn.read_very_eager())
	tn.write("EHLO frenchleather.fr\n")
	time.sleep(5)
	print(tn.read_very_eager())
	tn.write("MAIL FROM: " + src + "\n")
	time.sleep(5)
	print(tn.read_very_eager())
	tn.write("RCPT TO: " + dst + "\n")
	time.sleep(5)
	print(tn.read_very_eager())
	tn.write("DATA\n")
	time.sleep(5)
	print(tn.read_very_eager())
	tn.write(data)
	time.sleep(5)
	print(tn.read_very_eager())
	tn.write("QUIT\n")


if __name__ == "__main__":
	import argparse
	parser = argparse.ArgumentParser(description="Spamming Python script")
	parser.add_argument("host", help="Hostname or IP Address of target")
	parser.add_argument("-f", "--From", help="Email sender")
	parser.add_argument("-t", "--To", help="Email destination")
	parser.add_argument("-s", "--Subject", help="Email subject")
	parser.add_argument("-m", "--Message", help="Email message")

	args = parser.parse_args()
	host = args.host
	src = args.From
	dst = args.To
	subject = args.Subject
	message = args.Message

	main(host, src, dst, subject, message)
