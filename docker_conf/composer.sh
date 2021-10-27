#!/bin/sh
#EXPECTED_SIGNATURE=$(php -r "echo trim(file_get_contents('https://composer.github.io/installer.sig'));")
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")
php composer-setup.php  --quiet
#RESULT=$?
rm composer-setup.php
exit 0

#if [ "$EXPECTED_SIGNATURE" = "$ACTUAL_SIGNATURE" ]
#then
    
#else
#    >&2 echo 'ERROR: Invalid installer signature'
#    rm composer-setup.php
#    exit 1
#fi
