#!/usr/bin/env bash

cd /home/attacker/report/dos/

ip=$(cat /home/attacker/gwIP.txt)
file='index.php'
log='dos.log'
time='dos.time'
dat='dos.dat'
x=0
threshold=1

while true; do
	RT=$(curl -s -w %{time_total}\\n -o /dev/null $ip)
	echo $(date) : $RT >> $log
	echo $(date '+%s') $RT >> $dat
	if (( $(echo "$RT > $threshold" | bc -l) )); then
		x=$((x+1))
		echo $x > $time
	fi
	sleep 5
done
