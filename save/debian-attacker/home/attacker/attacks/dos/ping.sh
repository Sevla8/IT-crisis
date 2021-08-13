#!/usr/bin/env bash

if [[ $# -lt 1 ]]; then
	echo "Usage: $0 <target ip>"
	exit
fi

host=$1

ping $host -s 65507
