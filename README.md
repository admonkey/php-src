This is a custom build of php 5.5.9 to patch a PDO ODBC bug to prove [this answer](http://stackoverflow.com/a/38327719/4233593).

Ubuntu 14.04 Installation
=========================

most of these commands will require sudo

get dependencies

    apt-get install make autoconf apache2-dev libfcgi-dev libfcgi0ldbl libjpeg62-dbg libmcrypt-dev libssl-dev libbz2-dev libjpeg-dev \
        libfreetype6-dev libpng12-dev libxpm-dev libxml2-dev libpcre3-dev libbz2-dev libcurl4-openssl-dev \
        libjpeg-dev libpng12-dev libxpm-dev libfreetype6-dev libmysqlclient-dev libt1-dev libgd2-xpm-dev \
        libgmp-dev libsasl2-dev libmhash-dev unixodbc-dev freetds-dev libpspell-dev libsnmp-dev libtidy-dev \
        libxslt1-dev libmcrypt-dev libdb5.3-dev -y

must use old version of bison <= 2.7

    wget http://launchpadlibrarian.net/140087283/libbison-dev_2.7.1.dfsg-1_amd64.deb
    wget http://launchpadlibrarian.net/140087282/bison_2.7.1.dfsg-1_amd64.deb
    dpkg -i libbison-dev_2.7.1.dfsg-1_amd64.deb
    dpkg -i bison_2.7.1.dfsg-1_amd64.deb
    apt-mark hold libbison-dev
    apt-mark hold bison

compile and install

    ./buildconf --force

    ./configure --with-apxs2=/usr/bin/apxs2 --with-pdo-odbc=unixODBC,/usr/

    make

    make test

    make install

load apache

    cp php.ini-development /usr/local/php/php.ini

    nano /etc/apache2/apache2.conf

add these lines to the `apache2.conf`

    # pre-process php files
    AddType application/x-httpd-php .php
    PHPIniDir /usr/local/php


The PHP Interpreter
===================

This is the github mirror of the official PHP repository located at
http://git.php.net.

[![Build Status](https://secure.travis-ci.org/php/php-src.png?branch=master)](http://travis-ci.org/php/php-src)

Pull Requests
=============
PHP accepts pull requests via github. Discussions are done on github, but
depending on the topic can also be relayed to the official PHP developer
mailinglist internals@lists.php.net.

New features require an RFC and must be accepted by the developers.
See https://wiki.php.net/rfc and https://wiki.php.net/rfc/voting for more
information on the process.

Bug fixes **do not** require an RFC, but require a bugtracker ticket. Always
open a ticket at https://bugs.php.net and reference the bug id using #NNNNNN.

    Fix #55371: get_magic_quotes_gpc() throws deprecation warning

    After removing magic quotes, the get_magic_quotes_gpc function caused
    a deprecate warning. get_magic_quotes_gpc can be used to detected
    the magic_quotes behavior and therefore should not raise a warning at any
    time. The patch removes this warning

We do not merge pull requests directly on github. All PRs will be
pulled and pushed through http://git.php.net.


Guidelines for contributors
===========================
- [CODING_STANDARDS](/CODING_STANDARDS)
- [README.GIT-RULES](/README.GIT-RULES)
- [README.MAILINGLIST_RULES](/README.MAILINGLIST_RULES)
- [README.RELEASE_PROCESS](/README.RELEASE_PROCESS)

