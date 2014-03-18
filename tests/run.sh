#!/usr/bin/env bash

pathToIniFile="/etc/php5/apache2/php.ini"
pathToTestDir="/home/selvinortiz/prj/loathing/tests"
pathToPhpUnit="/home/selvinortiz/www/selv.dev/selv/craft/app/vendor/phpunit/phpunit/phpunit.php"
pathToBootstrap="/home/selvinortiz/www/selv.dev/selv/craft/app/tests/bootstrap.php"
pathToConfigFile="/home/selvinortiz/www/selv.dev/selv/craft/app/tests/phpunit.xml"

php -c $pathToIniFile $pathToPhpUnit --bootstrap $pathToBootstrap --configuration $pathToConfigFile $pathToTestDir
