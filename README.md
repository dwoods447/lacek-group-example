

## About Lacek Group Example

This application is a short ecommerce demo that features a shopping cart and allows user to add products and checkout 

## Setup
- Install composer `composer install`
- Generate .env file `cp .env.example .env`
- Generate application key `./vendor/bin/sail php artisan key:generate`
- Start Laravel Sail `./vendor/bin/sail up --build`
- Change `DB_HOST  in .env from 127.0.0.1 to mysql`
- Migrate database tables `./vendor/bin/sail php artisan migrate`
- Seed the database `./vendor/bin/sail php artisan db:seed`
- Be sure to enter mailtrap credentials into the .env or email delivery may not work
- Install NPM and Run the development server ` ./vendor/bin/sail npm install && npm run dev`
- Visit: `http:localhost`

