#!/bin/bash

mv /tmp/phpmyadmin /var/www/html
rm -rf /tmp/*
#---  STARTING SERVEURS  ---#
service mysql start
service nginx start
service php7.3-fpm start
#--------------------------#

#--- CONFIG MYSQL (BDD) ---#
#           USER           #
mysql -u root -e "CREATE DATABASE IF NOT EXISTS ppe2;"
mysql -u root -e "CREATE USER '$USER'@'localhost' identified by '$PASSWORD';" 
mysql -u root -e "GRANT ALL PRIVILEGES ON ppe2.* TO '$USER'@'localhost';" 
mysql -u root -e "FLUSH PRIVILEGES;"
mysql -u root ppe2 < /var/www/html/ppe2.sql
#---					---#
#--------------------------#

nginx -g "daemon off;"

#    SLEEP BLOUCLE INFI    #
while [ true ]
do
    true = true
done
#--------------------------#