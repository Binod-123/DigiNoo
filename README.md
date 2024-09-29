This project is a Laravel 10 application designed for managing transactions with a focus on calculating balances and generating reports. The API supports token-based authentication using Laravel Sanctum.

Features
Database migration for transactions.
Seeder to populate the database.
Token generation for API access.
Various API endpoints for transaction management.
Requirements
PHP >= 8.1
Composer >= 2.0
Laravel 10.x
MySQL (or compatible database)

Run php api_token.php to generate token and save it in .env file.

Clone the repository:git clone https://github.com/Binod-123/DigiNoo.git

Install dependencies: composer install

Run Migrations:php artisan migrate

Run Seeders:php artisan db:seed --class=TransactionSeeder

Laravel API function for calculate user closing balance (transaction after balance): curl -H "Authorization: Bearer bb063d3d14167aad66aa1f432792c59c" \ http://127.0.0.1:8000/api/user/1194398/balances  
in Response data in json format that of 

1) Daily closing balance of 90 days
2) 90 days average balance
3) First 30 days and last days average closing balance (0-30 days and 60-90 days )

Another  Url For 1) Calculate last 30 days income except 18020004 this category id
2) Calculate debit transaction count in 30 days.
3) Sum of debit trans amount done on Friday/Saturday/Sunday
4) Sum of income with transaction amount &amp;gt; 15

curl -H "Authorization: Bearer bb063d3d14167aad66aa1f432792c59c" \ http://127.0.0.1:8000/api/user/1194398/calculatetransactions   in Response data in json format 



