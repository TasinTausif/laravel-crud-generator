# Laravel CRUD Generator Package Challenge

This project contains a custom Laravel package for generating CRUD operations.

## Completed Tasks

- [x] Create a Laravel package structure in `packages/Custom/CrudGenerator`.
- [x] Implement `MakeCrudCommand` class.
- [x] Generate Model, Controller, Request, Migration, and Views.
- [x] Append routes to `routes/web.php`.
- [x] Integrate package into the main application.
- [x] Provide clean, MVC pattern code.

## How to Use

1. Run the command:
   ```bash
   php artisan make:crud {ModelName}
   ```
   Example:
   ```bash
   php artisan make:crud Post
   ```

2. Visit `/{model-name-kebab-case}` (e.g., `/posts`) in your browser to test the CRUD.

## Package Location

The package source code is located at `packages/Custom/CrudGenerator`.

## Notes for Reviewer

- The package is developed inside `packages/Custom/CrudGenerator` for ease of testing within this application. It can be extracted to a standalone repository.
- A basic layout file is automatically generated at `resources/views/layouts/app.blade.php` if missing, ensuring that the generated views render correctly out of the box.
- The project `composer.json` has been updated to include the local repository path and require the package.
