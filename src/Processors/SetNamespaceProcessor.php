<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
use Krlove\CodeGenerator\Model\NamespaceModel;


/**
 * Class SetNamespaceProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class SetNamespaceProcessor implements ProcessorInterface
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
        $class->setNamespace(new NamespaceModel($config->get('namespace')));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 8;
    }
}