<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
use Krlove\CodeGenerator\Model\UseClassModel;


/**
 * Interface ProcessorInterface
 * @package Krlove\EloquentModelGenerator\Processor
 */
class AddUsesProcessor implements ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(Controller $controller, Model $model, Config $config){
        $controller->addUses(new UseClassModel("Illuminate\Http\Request"));
        $controller->addUses(new UseClassModel("Auth"));
        $controller->addUses(new UseClassModel("Validator"));
        $controller->addUses(new UseClassModel($model->getClassName()));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 8;
    }
}