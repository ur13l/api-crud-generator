<?php
namespace Ur13l\ApiCrudGenerator\Providers;
use Illuminate\Support\ServiceProvider;
use Ur13l\ApiCrudGenerator\Commands\GenerateCrud;

class ApiCrudGeneratorProvider extends ServiceProvider
{
   
    public function up() {
    }
    public function register() {
        $this->commands([
            GenerateCrud::class,
        ]);
    }
}