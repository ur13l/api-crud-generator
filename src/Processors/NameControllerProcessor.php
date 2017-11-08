<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
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
     * @param ClassModel $class
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(ClassModel $class, Model $model, Config $config){
        $class->setName(new ClassNameModel($model->getShortName() . "Controller", "Controller"));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 9;
    }
}