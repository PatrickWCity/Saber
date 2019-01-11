web: vendor/bin/heroku-php-apache2 public/
release: php artisan migrate:fresh --seed && chmod -R 777 storage && php artisan passport:keys