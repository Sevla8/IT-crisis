#!/usr/bin/env python2

import send_mail
from threading import Thread

def send(host, f, t, s, m):
	send_mail.main(host, f, t, s, m)

if __name__ == "__main__":
	import argparse
	parser = argparse.ArgumentParser(description="Email outburst Python script")
	parser.add_argument("host", help="Hostname or IP Address of target")

	args = parser.parse_args()
	host = args.host

	Thread(target=send, args=(host, 'contact@anonymous.com', 'contact@frenchleather.fr', 'Honte a vous', 'Nous allons vous detruire. Vous etes morts.')).start()
	Thread(target=send, args=(host, 'contact@employeedefender.com', 'contact@frenchleather.fr', 'Demande de rdv', 'Bonjour, nous souhaiterions un rdv pour regler un litige avec notre client : M.Martin. Merci.')).start()
	Thread(target=send, args=(host, 'contact@gouvernment.fr', 'contact@frenchleather.fr', 'Assignation', 'Bonjour, vous etes pries de vous presenter la semaine prochaine a la mairie pour vous expliquer sur l\'utilisation de produits toxiques. Merci.')).start()
	Thread(target=send, args=(host, 'contact@anonymous.com', 'contact@frenchleather.fr', 'Vous etes morts', 'Il est temps de payer.')).start()
	Thread(target=send, args=(host, 'contact@employeedefender.com', 'contact@frenchleather.fr', 'Demande de rdv', 'Bonjour, nous souhaiterions un rdv pour regler un litige avec notre client : D.Daniel. Merci.')).start()
	Thread(target=send, args=(host, 'contact@bfmtv.fr', 'contact@frenchleather.fr', 'Demande d\'interview', 'Bonjour, Nous souhaiterions organiser une interview afin que vous puissiez vous expliquer. Merci de nous indiquer vos disponibilites.')).start()
	Thread(target=send, args=(host, 'contact@employeedefender.com', 'contact@frenchleather.fr', 'Demande de rdv', 'Bonjour, nous souhaiterions un rdv pour regler un litige avec notre client : R.Robert. Merci.')).start()
	Thread(target=send, args=(host, 'contact@anonymous.com', 'contact@frenchleather.fr', 'Faites vos prieres', 'Comment osez vous. Vous allez payer.')).start()
