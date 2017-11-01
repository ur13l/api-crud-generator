<?php

namespace Ur13l\ApiCrudGenerator;

use Ur13l\ApiCrudGenerator\ControllerBuilder;
use Ur13l\ApiCrudGenerator\Helpers\FileManager;
use Ur13l\ApiCrudGenerator\Helpers\ModelManager;
use Ur13l\ApiCrudGenerator\Model\Model;

/**
 * Class ControllerGenerator
 * @package Ur13l\ApiCrudGenerator
 */
class ControllerGenerator {

    /**
     * Builder
     *
     * @var ControllerBuilder
     */
    protected $builder;

    /**
     * ControllerGenerator Constructor
     *
     * @param ControllerBuilder $builder
     */
    public function __construct(ControllerBuilder $builder) {
        $this->builder = $builder;
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
                $controller = $this->builder->createController($model, $config);
                $content = $controller->render();
                $outputPath = $this->resolveOutputPath($config, $model);
                print($outputPath);
                file_put_contents($outputPath, $content);
            }
        }
    }

    /**
     * @param Config $config
     * @return string
     * @throws GeneratorException
     */
    protected function resolveOutputPath(Config $config, Model $model)
    {
        $path = $config->get('output_path');
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
        $pieces = explode('\\', $model->getClassName());
        $shortClassName = end($pieces);
        return $path . '/' . $shortClassName . 'Controller.php';
    }

}