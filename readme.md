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

## VIF(Very Important Files)
- app/Site.php -> Site model
- app/Http/Controllers/SitesController.php -> Controller where POST Site is
- app/Includes/MarfeelOperations.php -> Business Operations Class
- app/Includes/WebCrawler.php -> Web Crawler Class
- database/migrations/2018_06_15_085533_create_sites_table.php -> creates table 'sites'
- routes/web.php -> routes the json to the API at http://localhost/marfeelizableSites/public/sites (all routes but POST are closed)
- tests/Unit/MarfeelOperationsTest.php -> tests MarfeelOperations
- tests/Unit/SitesControllerTest.php -> tests SitesController
- tests/Unit/WebCrawlerTest.php -> tests WebCrawler
- .env -> has all DB persistence related data :: at gitignore, must be remade with .env.example

