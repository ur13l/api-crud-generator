<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\ClassNameModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Interface ProcessorInterface
 * @package Krlove\EloquentModelGenerator\Processor
 */
class NameControllerProcessor implements ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(Controller $controller, Model $model, Config $config){
        $pieces = explode('\\', $model->getClassName());
        $shortClassName = end($pieces);
        $controller->setName(new ClassNameModel($shortClassName . "Controller", "Controller"));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 10;
    }
}