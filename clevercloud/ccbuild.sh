#!/bin/bash -e

php ../bin/console cache:clear --env=prod
php ../bin/console assetic:dump --env=prod
php ../bin/console doctrine:schema:update --force