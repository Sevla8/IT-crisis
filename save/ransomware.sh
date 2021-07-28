#Power off
VBoxManage controlvm "debian-file" poweroff

#Encrypt
VBoxManage encryptmedium "debian-file-disk1.vdi" --newpassword "-" --cipher "AES-XTS128-PLAIN64" --newpasswordid "id"

#Decrypt
VBoxManage encryptmedium "debian-file-disk1.vdi" --oldpassword "-"
