# Website-Seblak

buka folder seblakwebistefinal di dua terminal

terminal pertama:
npm install
npm run dev

terminal kedua:
PHP artisan migrate:refresh

PHP artisan db:seed --class=AdminSeeder

PHP artisan db:seed --class=ToppingCategorySeeder

PHP artisan db:seed --class=ToppingSeeder

rm public/storage

PHP artisan cache:clear

PHP artisan view:clear

PHP artisan route:clear

PHP artisan config:clear

PHP artisan storage:link

PHP artisan serve
