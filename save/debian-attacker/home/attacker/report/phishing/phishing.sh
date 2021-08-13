#!/usr/bin/env bash

cd /home/attacker/report/phishing/

echo "Nombre de visitites : $(cat /home/attacker/tmp/counter.txt)"
echo "Nombre de logins : $(wc -l < /home/attacker/tmp/phishing.txt)"
