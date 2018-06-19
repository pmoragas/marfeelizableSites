## Laravel project for the PHP test
1. PHP 7.1.3 
2. PHPUNIT 7.0
3. LARAVEL 5.6
*see composer.json

## Deployment
1. clone repository
2. composer update
3. create mysql DB for project (per ex. marfeelizablesites) -> can use other appearing in config/database.php
4. create .env / copy from .env.example -> with your mysql DB credentials
5. php artisan key:generate
6. php artisan migrate:fresh

if migration fails -> composer dump-autoload -o
