<?php
namespace Ur13l\ApiCrudGenerator\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Ur13l\ApiCrudGenerator\Commands\GenerateCrud;
use Ur13l\ApiCrudGenerator\Processors\NameControllerProcessor;
use Ur13l\ApiCrudGenerator\Processors\AddUsesProcessor;
use Ur13l\ApiCrudGenerator\Processors\SetNamespaceProcessor;
use Ur13l\ApiCrudGenerator\Processors\MethodStoreProcessor;
use Ur13l\ApiCrudGenerator\Processors\MethodUpdateProcessor;
use Ur13l\ApiCrudGenerator\Processors\MethodShowProcessor;
use Ur13l\ApiCrudGenerator\Processors\MethodIndexProcessor;
use Ur13l\ApiCrudGenerator\Processors\MethodDestroyProcessor;
use Ur13l\ApiCrudGenerator\Processors\AddRouteProcessor;
use Ur13l\ApiCrudGenerator\Processors\CheckFileExistenceProcessor;
use Ur13l\ApiCrudGenerator\Processors\CreateResourceProcessor;
use Ur13l\ApiCrudGenerator\ControllerBuilder;
use Ur13l\ApiCrudGenerator\ResourceBuilder;

/**
 * Class ApiCrudGeneratorProvider
 * @package Ur13l\ApiCrudGenerator\Providers
 */
class ApiCrudGeneratorProvider extends ServiceProvider
{
    /**
     * Processor tag.
     */
    const PROCESSOR_TAG = 'api_crud_generator.processor';
    const RES_PROCESSOR_TAG = 'api_crud_generator.processor.resources';


    /**
     * Register Method
     *
     * @return void
     */
    public function register() {
        $this->commands([
            GenerateCrud::class,
        ]);

        $this->app->tag([
            CheckFileExistenceProcessor::class,
            NameControllerProcessor::class,
            AddUsesProcessor::class,
            SetNamespaceProcessor::class,
            MethodStoreProcessor::class,
            MethodUpdateProcessor::class,
            MethodShowProcessor::class,
            MethodIndexProcessor::class,
            MethodDestroyProcessor::class,
            AddRouteProcessor::class
        ], self::PROCESSOR_TAG);
        
        $this->app->tag([
            CreateResourceProcessor::class
        ], self::RES_PROCESSOR_TAG);
        

        $this->app->bind(ControllerBuilder::class, function (Application $app) {
            return new ControllerBuilder($app->tagged(self::PROCESSOR_TAG));
        });
        $this->app->bind(ResourceBuilder::class, function (Application $app) {
            return new ResourceBuilder($app->tagged(self::RES_PROCESSOR_TAG));
        });
    }
}