### Server Requirements
- **PHP >= 8.1**
- **MYSQL >= 8.0**
- **Sqlite 3**
- **NGINX**

### Project Setup
- **Create new database in MYSQL: CREATE DATABASE coding_challenge;**
- **composer install / composer update**
- **composer dump-autoload**
- **php artisan migrate**
- **php artisan key:generate**
- **Rename .env.example to .env And fill DB ENV variables**
- **Move 'products.csv' file to storage/app/products.csv
- **php artisan serve**

### Commands
-- Import From Mock File Commands
- **php artisan import:products**
- 
-- Import From Mock API Commands
- **php artisan import:products-api**

#### Laravel Excel Package
- **https://github.com/SpartnerNL/Laravel-Excel**


### PHPUnit Testing Via Sqlite Memory
- **php artisan migrate --database=sqlite**
- **php artisan test --coverage --stop-on-failure**

### To Do List
- **To Add Seeders And Factories**
- **Use ProductVariations, ProductsVariationOptions Morph Relations**
- **Apply more code improvements**
