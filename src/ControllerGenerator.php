<?php

namespace Ur13l\ApiCrudGenerator;

use Ur13l\ApiCrudGenerator\ControllerBuilder;
use Ur13l\ApiCrudGenerator\Helpers\FileManager;
use Ur13l\ApiCrudGenerator\Helpers\ModelManager;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Model\Resource;

/**
 * Class ControllerGenerator
 * @package Ur13l\ApiCrudGenerator
 */
class ControllerGenerator {

    /**
     * Controller Builder
     *
     * @var ControllerBuilder
     */
    protected $controllerBuilder;


    /**
     * Resource Builder 
     * 
     * @var ResourceBuilder
     */
    protected $resourceBuilder;



    /**
     * ControllerGenerator Constructor
     *
     * @param ControllerBuilder $builder
     */
    public function __construct(ControllerBuilder $controllerBuilder, ResourceBuilder $resourceBuilder) {
        $this->resourceBuilder = $resourceBuilder;
        $this->controllerBuilder = $controllerBuilder;
    }


    public function generateResources($args, $config) {
        $fileManager = new FileManager($config);
        $files = $fileManager->getFiles();
        $modelManager = new ModelManager($config);
        foreach($files as $file) {
            $model = $modelManager->retrieveModel($file);
            if (isset($model)) {
                $resource = $this->resourceBuilder->createResource($model, $config);
                $content1 = $resource->render();
                $outputPath1 = $this->resolvePath($config, 'resources_path', $model) . 'Resource.php';
                file_put_contents($outputPath1, $content1);
            }
        }
    }

    /**
     * Iterates over the Model files and creates the controller.
     *
     * @param $args
     * @param Config $config
     * @return void
     */
    public function generateControllers($args, $config) {
        $fileManager = new FileManager($config);
        $files = $fileManager->getFiles();
        $modelManager = new ModelManager($config);
        foreach($files as $file) {
            $model = $modelManager->retrieveModel($file);
            if (isset($model)) {
                $controller = $this->controllerBuilder->createController($model, $config);
                $content = $controller->render();
                $outputPath = $this->resolvePath($config, 'output_path', $model)  . 'Controller.php';
                file_put_contents($outputPath, $content);
            }
        }
    }

    /**
     * @param Config $config
     * @return string
     * @throws GeneratorException
     */
    protected function resolvePath(Config $config, $path, Model $model)
    {
        $path = $config->get($path);
        if ($path === null || stripos($path, '/') !== 0) {
            $path = app_path($path);
        }
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                throw new GeneratorException(sprintf('Could not create directory %s', $path));
            }
        }
        if (!is_writeable($path)) {
            throw new GeneratorException(sprintf('%s is not writeable', $path));
        }
        return $path . '/' . $model->getShortName();
    }

}