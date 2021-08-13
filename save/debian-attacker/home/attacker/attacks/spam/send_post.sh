#!/usr/bin/env bash

if [[ $# -lt 4 ]]; then
	echo "Usage: $0 <target ip> <user> <password> <post>"
	exit
fi

URL="http://$1"
TARGET="$URL/control.php"
user=$2
password=$3
message=$4

result=$(curl --location --request POST $TARGET \
--header 'Cookie: PHPSESSID=dnbsv2ol6um1huo11a1v46n9u6' \
--form "username=$user" \
--form "password=$password" \
--form "confirm_password=$password" \
--form 'register=Submit')

result=$(curl --location --request POST $TARGET \
--header 'Cookie: PHPSESSID=dnbsv2ol6um1huo11a1v46n9u6' \
--form "username=$user" \
--form "password=$password" \
--form 'login=Login')

result=$(curl --location --request POST $TARGET \
--header 'Cookie: PHPSESSID=dnbsv2ol6um1huo11a1v46n9u6' \
--form "text-post=$message" \
--form 'post=Post')
