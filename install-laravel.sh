composer create-project laravel/laravel example
cd example
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
