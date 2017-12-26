#!/bin/bash
# Ajout du cron pour vérification des services toutes les 5 minutes
# v1.0
# L. RIOU
echo "0,5,10,15,20,25,30,35,40,45,50,55 * * * * /share/scripts/check_services.sh" >> /var/spool/cron/crontabs/root
