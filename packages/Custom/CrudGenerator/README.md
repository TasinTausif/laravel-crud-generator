# CRUD Generator Package

This package generates a complete CRUD operation for Laravel applications.

## Features

- Generates Controller, Model, Request, Migration, and Views.
- Appends routes to `routes/web.php`.
- Creates a basic layout if not present.
- Supports Laravel 8+ and PHP 7.4+.

## Installation

1. Add the package to your `composer.json` repositories:

   ```json
   "repositories": [
       {
           "type": "path",
           "url": "packages/Custom/CrudGenerator"
       }
   ]
   ```

2. Require the package:

   ```bash
   composer require custom/crud-generator
   ```

## Usage

Run the following command to generate a CRUD for a model (e.g., Post):

```bash
php artisan make:crud Post
```

This will create:
- `app/Models/Post.php`
- `app/Http/Controllers/PostController.php`
- `app/Http/Requests/PostRequest.php`
- `database/migrations/xxxx_xx_xx_xxxxxx_create_posts_table.php`
- `resources/views/posts/index.blade.php`, `create.blade.php`, `edit.blade.php`, `show.blade.php`
- Appends resource route to `routes/web.php`

## Notes

- The package assumes a standard Laravel directory structure.
- Views use a basic Bootstrap layout created at `resources/views/layouts/app.blade.php` if it doesn't exist.
