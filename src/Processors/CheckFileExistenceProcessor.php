<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
use Ur13l\ApiCrudGenerator\Exceptions\GeneratorException;
use Krlove\CodeGenerator\Model\UseClassModel;


/**
 * Class CheckFileExistenceProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class CheckFileExistenceProcessor implements ProcessorInterface
{
    /**
     * Implemented method from ProcessorInterface
     *
     * @param Controller $controller
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(Controller $controller, Model $model, Config $config){
        $filename =  $model->getShortName() . "Controller";
        $exists = file_exists(app_path($config->get('output_path') . $filename . ".php"));
        if ($exists !== FALSE ){ 
            throw new GeneratorException(sprintf('Controller %s already exists', $filename));
        }
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 10;
    }
}
