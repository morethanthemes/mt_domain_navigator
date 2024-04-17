#!/bin/bash
mkdir -p demo/web/modules/custom/mt_domain_navigator
shopt -s extglob
ln -sf /var/www/html/!(demo) /var/www/html/demo/web/modules/custom/mt_domain_navigator
#ln -sfn /var/www/html/!(demo)/* /var/www/html/demo/web/modules/custom/mt_domain_navigator
#ln -sfn /var/www/html/* /var/www/html/demo/web/modules/custom/mt_domain_navigator


