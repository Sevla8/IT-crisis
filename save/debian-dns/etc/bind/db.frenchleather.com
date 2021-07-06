$TTL	604800
$ORIGIN frenchleather.com.
@	IN	SOA	debian-dns.frenchleather.com. admin.frenchleather.com. (
			     13		; Serial
			 604800		; Refresh
			  86400		; Retry
			2419200		; Expire
			 604800 )	; Negative Cache TTL
;
@	IN	NS	debian-dns
	IN	MX	10	debian-mail
debian-admin	IN	A	192.168.1.50	
debian-dns	IN	A	192.168.2.51
debian-file	IN	A	192.168.2.52
debian-mail	IN	A	192.168.2.50
debian-web	IN	A	192.168.4.50
www	IN	CNAME	debian-web
mail	IN	CNAME	debian-mail

