# Common Project Commands

Run these commands from the Laravel project root (`laravel-deneme/`), where `artisan` and `composer.json` are located.

## Start the app

```powershell
php artisan serve
```

Open the local URL printed by Artisan, usually `http://127.0.0.1:8000`.

## Routes and views

```powershell
php artisan route:list
php artisan route:list --path=post
php artisan view:clear
php artisan view:cache
```

## Database

The app is configured to use the local MySQL database `laraveldenemedb`.

```powershell
php artisan db:show --database=mysql
php artisan migrate:status
php artisan migrate
php artisan db:seed --class=PostSeeder
php artisan db:seed --class=DemoUserSeeder
```

`php artisan db:seed` runs the default seeder, which also creates the sample user. The `PostSeeder` can be run again safely to refresh the sample posts.

In local development, the demo accounts use the shared password from `DEMO_SHARED_PASSWORD` when `DEMO_AUTH_ENABLED=true`. These settings are only for a local demo; do not enable them outside `APP_ENV=local`.

> **Destructive:** `php artisan migrate:fresh` drops every table in the configured database and recreates them. Use it only with a disposable development database when you are sure its data can be deleted.

## Create Laravel files

```powershell
php artisan make:controller ExampleController
php artisan make:model Example -m
php artisan make:seeder ExampleSeeder
```

## Frontend assets

```powershell
npm run dev
npm run build
```

`npm run dev` starts Vite in development mode. `npm run build` creates production assets.

## Tests

```powershell
php artisan test
```
