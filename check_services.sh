#!/bin/bash
# Check for those services if OK or KO
# v1.0
# L. RIOU
services="minidlna apache2 samba mysql nmbd smbd"
rm -f status.log
for serv in $services
do
   service $serv status >> status.log
done
