#!/usr/bin/env bash

. /vagrant/vagrant/common/provision.before.sh

###############################################################################
# GENERAL
###############################################################################

# php 7
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php7.0 php7.0-fpm php7.0-cli php7.0-opcache php7.0-common php7.0-phpdbg php7.0-dev
sudo apt-get install -y php7.0-mcrypt php7.0-mbstring
sudo apt-get install -y php7.0-mysql php7.0-pdo
sudo apt-get install -y php7.0-dom php7.0-xml php7.0-json
sudo apt-get install -y php7.0-zip php7.0-curl php7.0-gd php7.0-imap
sudo apt-get install -y php-mongodb
sudo apt-get install -y php7.0-bcmath
# php7.0-bz2
# php7.0-calendar
# php7.0-cgi
# php7.0-cli
# php7.0-ctype
# php7.0-dba
# php7.0-enchant
# php7.0-exif
# php7.0-fileinfo
# php7.0-fpm
# php7.0-ftp
# php7.0-gettext
# php7.0-gmp
# php7.0-iconv
# php7.0-interbase
# php7.0-intl
# php7.0-ldap
# php7.0-mcrypt
# php7.0-mysql
# php7.0-mysqli
# php7.0-mysqlnd
# php7.0-odbc
# php7.0-pdo-dblib
# php7.0-pdo-firebird
# php7.0-pdo-mysql
# php7.0-pdo-odbc
# php7.0-pdo-pgsql
# php7.0-pdo-sqlite
# php7.0-pgsql
# php7.0-phar
# php7.0-posix
# php7.0-pspell
# php7.0-readline
# php7.0-recode
# php7.0-shmop
# php7.0-simplexml
# php7.0-snmp
# php7.0-soap
# php7.0-sockets
# php7.0-sqlite3
# php7.0-sybase
# php7.0-sysvmsg
# php7.0-sysvsem
# php7.0-sysvshm
# php7.0-tidy
# php7.0-tokenizer
# php7.0-wddx
# php7.0-xmlreader
# php7.0-xmlrpc
# php7.0-xmlwriter
# php7.0-xsl

# nginx
sudo cp /vagrant/vagrant/ubuntu-16.04/nginx.conf /etc/nginx/sites-available/default

###############################################################################
# LARAVEL
###############################################################################

# one
# cd /vagrant/ed/laravel/examples/one \
#     && composer install \
#     && php artisan cache:clear \
#     && php artisan config:cache \
#     && php artisan migrate \
# # chmod 777 -R /vagrant/ed/laravel/examples/one/storage/
# # chmod 777 -R /vagrant/ed/laravel/examples/one/bootstrap/cache/
# mysql -uroot -e 'create database homestead'
# mysql -uroot -e "CREATE USER 'homestead'@'localhost' IDENTIFIED BY 'secret'"
# mysql -uroot -e "GRANT ALL PRIVILEGES ON homestead.* TO 'homestead'@'localhost' WITH GRANT OPTION;"
# mysql -uhomestead -psecret -Dhomestead
# cd /vagrant/ed/laravel/examples/one && php artisan migrate

###############################################################################
# Phalcon
###############################################################################

# phalcon
sudo curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | sudo bash
sudo apt-get install php7.0-phalcon
# phalcon dev-tools
cd /vagrant/ed/phalcon/examples/one && composer install
sudo ln -s /vagrant/ed/phalcon/examples/one/vendor/bin/phalcon.php /usr/bin/phalcon
sudo chmod ugo+x /usr/bin/phalcon



. /vagrant/vagrant/common/provision.after.sh
