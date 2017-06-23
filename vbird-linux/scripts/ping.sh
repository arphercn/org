#!/bin/bash
# ping 整个网域的主机 
for siteip in $(seq 1 254)
do
  site="192.168.0.${siteip}"
  ping -c1 -W1 ${site} &> /dev/null
  
  if [ "$?" == "0" ]; then
    echo "$site is UP"
  else
    echo "$site is DOWN"
  fi
done
