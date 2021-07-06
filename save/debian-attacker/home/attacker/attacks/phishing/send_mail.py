#!/usr/bin/env python2

import telnetlib
import time

if __name__ == "__main__":
    import argparse
    parser = argparse.ArgumentParser(description="Phishing Python script")
    parser.add_argument("host", help="Hostname or IP Address of target")
    parser.add_argument("-s", "--src", help="Email sender")
    parser.add_argument("-d", "--dst", help="Email destination")
    parser.add_argument("-m", "--message", help="Email message")

    args = parser.parse_args()
    host = args.host
    src = args.src
    dst = args.dst
    message = open(args.message).read()

    data = "FROM: " + src + "\nTO: " + dst + "\n" + message + "\r\n\r\n.\r\n"
    
    # print(host)
    # print(src)
    # print(dst)
    # print(data)

    tn = telnetlib.Telnet(host, 25)
    time.sleep(5)
    print(tn.read_very_eager())
    tn.write("EHLO frenchleather.com\n")
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
