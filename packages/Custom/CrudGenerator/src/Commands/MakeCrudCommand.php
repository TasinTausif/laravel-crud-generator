<?php

namespace Custom\CrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrudCommand extends Command
{
    protected $signature = 'make:crud {name : The name of the CRUD (e.g. Post)}';

    protected $description = 'Generate a complete CRUD operation';

    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Start generating CRUD for {$name}...");

        $this->createModel($name);
        $this->createController($name);
        $this->createRequest($name);
        $this->createMigration($name);
        $this->createViews($name);
        $this->appendRoutes($name);
        $this->createLayout();

        $this->info("CRUD for {$name} generated successfully!");
    }

    protected function createLayout()
    {
        $layoutPath = resource_path('views/layouts');
        if (! File::exists($layoutPath)) {
            File::makeDirectory($layoutPath, 0755, true);
        }

        if (! File::exists($layoutPath.'/app.blade.php')) {
            $content = "
            <!DOCTYPE html>\n
            <html>\n
            <head>\n
                <title>App</title>\n
                <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\">\n
            </head>\n
            <body>\n
                <div class='container mt-4'>\n
                    @if(session('success'))\n
                        <div class=\"alert alert-success\">{{ session('success') }}</div>\n
                    @endif\n
                    @yield('content')\n
                </div>\n
            </body>\n
            </html>";

            File::put($layoutPath.'/app.blade.php', $content);
            $this->info("Layout generated: {$layoutPath}/app.blade.php");
        }
    }

    protected function createModel($name)
    {
        $modelName = Str::studly($name);
        $content = "
        <?php\n\n
        namespace App\Models;\n\n
        use Illuminate\Database\Eloquent\Factories\HasFactory;\n
        use Illuminate\Database\Eloquent\Model;\n\n
        class {$modelName} extends Model\n
        {\n    
            use HasFactory;\n\n    
            protected \$fillable = ['title', 'description']; // Example fields\n
        }\n";

        $path = app_path("Models/{$modelName}.php");

        if (! File::exists(app_path('Models'))) {
            File::makeDirectory(app_path('Models'), 0755, true);
        }

        File::put($path, $content);
        $this->info("Model generated: {$path}");
    }

    protected function createController($name)
    {
        $modelName = Str::studly($name);
        $controllerName = "{$modelName}Controller";

        // Basic Controller Template
        $content = "
        <?php\n\n
        namespace App\Http\Controllers;\n\n
        use App\Models\\{$modelName};\n
        use Illuminate\Http\Request;\n
        use App\Http\Requests\\{$modelName}Request;\n\n
        class {$controllerName} extends Controller\n
        {\n
            public function index()\n
            {\n
                \$items = {$modelName}::all();\n
                return view('{$name}.index', compact('items'));\n
            }\n\n
            public function create()\n
            {\n
                return view('{$name}.create');\n
            }\n\n
            public function store({$modelName}Request \$request)\n
            {\n
                {$modelName}::create(\$request->validated());\n
                return redirect()->route('{$name}.index');\n
            }\n\n
            public function show({$modelName} \$item)\n
            {\n
                return view('{$name}.show', compact('item'));\n
            }\n\n
            public function edit({$modelName} \$item)\n
            {\n
                return view('{$name}.edit', compact('item'));\n
            }\n\n
            public function update({$modelName}Request \$request, {$modelName} \$item)\n
            {\n
                \$item->update(\$request->validated());\n
                return redirect()->route('{$name}.index');\n
            }\n\n
            public function destroy({$modelName} \$item)\n
            {\n
                \$item->delete();\n
                return redirect()->route('{$name}.index');\n
            }\n
        }\n
        ";

        $path = app_path("Http/Controllers/{$controllerName}.php");
        File::put($path, $content);
        $this->info("Controller generated: {$path}");
    }

    protected function createRequest($name)
    {
        $modelName = Str::studly($name);
        $requestName = "{$modelName}Request";
        $content = "
        <?php\n\n
        namespace App\Http\Requests;\n\n
        use Illuminate\Foundation\Http\FormRequest;\n\n
        class {$requestName} extends FormRequest\n
        {\n
            public function authorize()\n
            {\n
                return true;\n
            }\n\n
            public function rules()\n
            {\n
                return [\n
                    'title' => 'required|string|max:255',\n
                    'description' => 'nullable|string',\n
                ];\n
            }\n
        }\n
        ";

        $path = app_path("Http/Requests/{$requestName}.php");

        if (! File::exists(app_path('Http/Requests'))) {
            File::makeDirectory(app_path('Http/Requests'), 0755, true);
        }

        File::put($path, $content);
        $this->info("Request generated: {$path}");
    }

    protected function createMigration($name)
    {
        $tableName = Str::plural(Str::snake($name));
        $className = 'Create'.Str::studly($tableName).'Table';
        $timestamp = date('Y_m_d_His');
        $fileName = "{$timestamp}_create_{$tableName}_table.php";

        $content = "
        <?php\n\n
        use Illuminate\Database\Migrations\Migration;\n
        use Illuminate\Database\Schema\Blueprint;\n
        use Illuminate\Support\Facades\Schema;\n\n
        return new class extends Migration\n
        {\n
            public function up()\n
            {\n
                Schema::create('{$tableName}', function (Blueprint \$table) {\n
                    \$table->id();\n
                    \$table->string('title');\n
                    \$table->text('description')->nullable();\n
                    \$table->timestamps();\n
                });\n
            }\n\n
            public function down()\n
            {\n
                Schema::dropIfExists('{$tableName}');\n
            }\n
        };\n
        ";

        $path = database_path("migrations/{$fileName}");
        File::put($path, $content);
        $this->info("Migration generated: {$path}");

        // Optional: Run migration immediately if desired, but requirements usually just say generate
        // Artisan::call('migrate');
    }

    protected function createViews($name)
    {
        $name = Str::kebab($name); // folder name
        $viewPath = resource_path("views/{$name}");

        if (! File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
        }

        // Index View
        $indexContent = "
        @extends('layouts.app')\n\n
        @section('content')\n
            <h1>List</h1>\n
            <a href=\"{{ route('{$name}.create') }}\">Create New</a>\n
            <ul>\n
                @foreach(\$items as \$item)\n
                    <li>{{ \$item->title }} \n
                        <a href=\"{{ route('{$name}.edit', \$item->id) }}\">Edit</a>\n
                        <form action=\"{{ route('{$name}.destroy', \$item->id) }}\" method=\"POST\" style=\"display:inline;\">\n
                            @csrf @method('DELETE')\n
                            <button type=\"submit\">Delete</button>\n
                        </form>\n
                    </li>\n
                @endforeach\n
            </ul>\n
        @endsection\n
        ";
        File::put("{$viewPath}/index.blade.php", $indexContent);

        // Create View
        $createContent = "
        @extends('layouts.app')\n\n
        @section('content')\n
            <h1>Create</h1>\n
            <form action=\"{{ route('{$name}.store') }}\" method=\"POST\">\n
                @csrf\n
                <label>Title:</label>\n
                <input type=\"text\" name=\"title\" required>\n
                <label>Description:</label>\n
                <textarea name=\"description\"></textarea>\n
                <button type=\"submit\">Save</button>\n
            </form>\n
        @endsection\n
        ";
        File::put("{$viewPath}/create.blade.php", $createContent);

        // Edit View
        $editContent = "
        @extends('layouts.app')\n\n
        @section('content')\n
            <h1>Edit</h1>\n
            <form action=\"{{ route('{$name}.update', \$item->id) }}\" method=\"POST\">\n
                @csrf @method('PUT')\n
                <label>Title:</label>\n
                <input type=\"text\" name=\"title\" value=\"{{ \$item->title }}\" required>\n
                <label>Description:</label>\n
                <textarea name=\"description\">{{ \$item->description }}</textarea>\n
                <button type=\"submit\">Update</button>\n
            </form>\n
        @endsection\n
        ";
        File::put("{$viewPath}/edit.blade.php", $editContent);

        // Show View
        $showContent = "
        @extends('layouts.app')\n\n
        @section('content')\n
            <h1>Show</h1>\n
            <label>Title:</label>\n
            <p>{{ \$item->title }}</p>\n
            <label>Description:</label>\n
            <p>{{ \$item->description }}</p>\n
            <a href=\"{{ route('{$name}.index') }}\">Back</a>\n
        @endsection\n
        ";
        File::put("{$viewPath}/show.blade.php", $showContent);

        $this->info("Views generated in: {$viewPath}");
    }

    protected function appendRoutes($name)
    {
        $modelName = Str::studly($name);
        $controllerName = "{$modelName}Controller";
        $routeName = Str::kebab($name); // e.g., posts

        $routeContent = "
        \n\n
        // CRUD Route for {$modelName}\n
        use App\Http\Controllers\\{$controllerName};\n
        Route::resource('{$routeName}', {$controllerName}::class);\n
        ";

        File::append(base_path('routes/web.php'), $routeContent);
        $this->info('Routes appended to web.php');
    }
}
