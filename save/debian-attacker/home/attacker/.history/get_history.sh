#!/usr/bin/env bash

awk -F \\n '{ if ($0 ~ /^#[0-9]+/) {printf "%5d  %s ", ++i, strftime("%d/%m/%y %T", substr($1,2)); getline; print $0 }}' ~/.bash_history >> history.txt
