<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\ClassNameModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Class NameControllerProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class NameControllerProcessor implements ProcessorInterface
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
        $controller->setName(new ClassNameModel($model->getShortName() . "Controller", "Controller"));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 9;
    }
}