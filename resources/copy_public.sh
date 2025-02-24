#!/bin/bash
#This script is intended for my own internal use while developing this project. It is provided for example purposes for developers forking this project. Do not use this script without modifying it, as the locations, and permissions it uses are specific to the setup I use for developing this project. This script is not for copying files to a public webserver. It is for copying files to a testing folder on a localhost server.
source=$(cd ../ && cd ./www/public && echo $PWD)
#echo $source
sudo chown -R user1:user1 "/var/www/html"
rm -r /var/www/html/*
cp -R "${source}/." "/var/www/html"