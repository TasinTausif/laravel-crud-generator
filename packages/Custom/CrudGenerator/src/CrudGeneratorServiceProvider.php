<?php

namespace Custom\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use Custom\CrudGenerator\Commands\MakeCrudCommand;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCrudCommand::class,
            ]);
        }
    }
}
