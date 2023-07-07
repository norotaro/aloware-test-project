# Installation

Install backend dependencies with `composer` and frontend dependencies with `npm`.

```
composer install
npm install
```

Create the `.env` (can be copied from the `.env.example` file) file and then run the migrations and seeders.

```
php artisan migrate --seed
```

# Running

Run the backend with `artisan` and the frontend with `npm`, both instances must be running at the same time.

```
php artisan serve
npm run dev
```

Then open the url shown by `php artisan serve`, http://127.0.0.1:8000 by default.