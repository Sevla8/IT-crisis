#!/usr/bin/env bash

cd /home/attacker/report/defacing/

ip=$(cat /home/attacker/gwIP.txt)
file='index.php'
log='defaced.log'
time='defaced.time'
x=0

while true; do
	wget http://$ip/$file
	if grep -q "HACKED" "$file"; then
		echo $(date) : 1 >> $log
		x=$((x+1))
		echo $x > $time
	else
		echo $(date) : 0 >> $log
	fi
	rm $file
	sleep 60
done
