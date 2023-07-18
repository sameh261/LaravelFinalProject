please ensure you have installed all the necessary dependencies and have followed the instructions below.


Run the migrations by running php artisan migrate.

Seed the database with the necessary data by running the following commands in order:

php artisan db:seed --class=RolesTableSeeder
php artisan db:seed --class=CategoriesTableSeeder
php artisan db:seed --class=ProductsTableSeeder.

Start the Vue project first by running npm run dev to ensure the application can be accessed at http://localhost:5173/.

Then start the Laravel project by running npm run dev and php artisan serve.

Important Note
The Facebook login feature only works when accessed via localhost:8000 and not 127.0.0.1.
