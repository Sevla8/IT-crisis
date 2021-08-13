#!/usr/bin/env bash

if [[ $# -lt 1 ]]; then
	echo "Usage: $0 <target ip>"
	exit
fi

cd /home/attacker/attacks/outburst/
targetIP=$1

./send_post.sh $targetIP "Gilbert"	"motdepasse" "Vous ne respectez pas ni l'environnement, ni vos employés @frenchleather"
./send_post.sh $targetIP "Charles" 	"motdepasse" "Appel au boycott contre @frenchleather !!!"
./send_post.sh $targetIP "Damien" 	"motdepasse" "Vous devriez avoir honte \@frenchleather..."
./send_post.sh $targetIP "Laurent" 	"motdepasse" "Je sais voler"
./send_post.sh $targetIP "Louis" 	"motdepasse" "Vous nous avez tous contaminé !!"
./send_post.sh $targetIP "Lucie" 	"motdepasse" "On vous fera parler @frenchleather ! Il est temps de sortir de votre silence !!"
./send_post.sh $targetIP "Marie" 	"motdepasse" "Vive @frenchleather !"
./send_post.sh $targetIP "Laura" 	"motdepasse" "Je vous hais"
./send_post.sh $targetIP "Martine" 	"motdepasse" "Vous utilisez des produits toxiques, il est temps de vous expliquer !"
./send_post.sh $targetIP "Gérard" 	"motdepasse" "Vous nous devez des explications @frenchleather !!!"
./send_post.sh $targetIP "Albert" 	"motdepasse" "On aura votre peau @frenchleather ! ;)"
./send_post.sh $targetIP "Simon" 	"motdepasse" "Vous appartenez au passé"
./send_post.sh $targetIP "Isabelle" "motdepasse" "J'ai été licensié abusivement par @frenchleather !"
./send_post.sh $targetIP "Paul" 	"motdepasse" "Vous devriez avoir honte de comment vous traitez vos employés !"
./send_post.sh $targetIP "Luc" 		"motdepasse" "Assassins !!!"
./send_post.sh $targetIP "Martin" 	"motdepasse" "Après mes 10 ans au sein de @frenchleather, on me diagnostique un cancert des poumons. Merci @frenchleather."
./send_post.sh $targetIP "Daniel" 	"motdepasse" "Boycottons tous \@frenchleather !"
