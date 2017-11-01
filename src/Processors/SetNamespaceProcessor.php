<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
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
     * @param Controller $controller
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(Controller $controller, Model $model, Config $config){
        $controller->setNamespace(new NamespaceModel($config->get('namespace')));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 8;
    }
}