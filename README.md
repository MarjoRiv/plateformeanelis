# Plateforme Anelis

Quick links : 
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Run Application](#run-application)

# Prerequisites

In order to install the plateform, you need:
- [PHP with APCU extension](#configure-php)
- [Git](#configure-git-project)
- Mysql server
- Apache server (or just symfony built in server)
- [Composer](#install-composer)

Once all prerequisites installed and configured, you can go to [Installation](#installation)

## Software Recommendation

Download and Install Git Bash (git) : https://gitforwindows.org/  
Download and Install PhpStorm (editor) : https://www.jetbrains.com/phpstorm/  
Download and Install Xampp (php/mysql/apache) : https://www.apachefriends.org/fr/index.html  

## Configure Git project

Generate and add an ssh key to your gitlab account : https://gitlab.com/help/ssh/README#generating-a-new-ssh-key-pair  
Clone project inside server project folder ("C:\xampp\htdocs" for xampp) with command `git clone git@gitlab.com:anelis/plateformeanelis.git`

## Configure PHP

Add php path into system variable "Path" ("C:\xampp\php" for xampp)

Download APCU extension: https://pecl.php.net/package/APCu  
-> put "php_apcu.dll" inside php ext file ("C:\xampp\php\ext" for xampp)  
-> add following lines inside php ini file ("C:\xampp\php\php.ini" for xampp) 
```
[apcu]
extension=php_apcu.dll
apc.enabled=1
apc.shm_size=32M
apc.ttl=7200
apc.enable_cli=1
apc.serializer=php
```

## Install composer

Install composer on windows or add composer into project folder: https://getcomposer.org/download/  
-> if installed on directory, run `php composer.phar command`, if installed on windows run `composer command`. I will use the windows command for the readme

# Installation

## Configure environment variables

### Local development

The project uses Dotenv component in order to simplify environment variables for development.  
You just need to copy .env.dist to .env and set all variables.

### Server installation

In server installation, you should configure environment variable directly on web server.  
For apache, add the following configuration inside httpd conf ("C:\xampp\apache\conf\httpd.conf" for xampp)
```
<VirtualHost *:80>
    SetEnv MYSQL_ADDON_HOST "127.0.0.1"
    SetEnv MYSQL_ADDON_PORT "3306"
    SetEnv MYSQL_ADDON_DB "plateformeanelis"
    SetEnv MYSQL_ADDON_USER "root"
    SetEnv MYSQL_ADDON_PASSWORD ""
    SetEnv PAYPAL_USERNAME ""
    SetEnv PAYPAL_PASSWORD ""
    SetEnv PAYPAL_SIGNATURE ""
</VirtualHost>
```
For every console command, you will need to export variables using: 
```bash
export MYSQL_ADDON_HOST=127.0.0.1
export MYSQL_ADDON_PORT=3306
export MYSQL_ADDON_DB=plateformeanelis
export MYSQL_ADDON_USER=root
export MYSQL_ADDON_PASSWORD=
export PAYPAL_USERNAME=
export PAYPAL_PASSWORD=
export PAYPAL_SIGNATURE=
```

## Install Symfony (need to be inside project folder: C:\xampp\htdocs\plateformeanelis)

:warning: The following commands should be executed inside project folder ("C:\xampp\htdocs\plateformeanelis" for xampp)

Run `composer install` in order to get vendors (dependencies) and generate parameters.yml

Create database with `php bin/console doctrine:database:create`  
Create tables with `php bin/console doctrine:migrations:migrate`  
Create user with `php bin/console fos:user:create testuser test@example.com p@ssword`  
Set user admin `php bin/console fos:user:promote testuser ROLE_SUPER_ADMIN`  

# Run application

Start Web Server and Mysql  
Go to http://localhost/plateformeanelis/web/app_dev.php