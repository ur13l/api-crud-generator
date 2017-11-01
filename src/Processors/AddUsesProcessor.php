<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
use Krlove\CodeGenerator\Model\UseClassModel;


/**
 * Class AddUsesProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class AddUsesProcessor implements ProcessorInterface
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
        $controller->addUses(new UseClassModel("Illuminate\Http\Request"));
        $controller->addUses(new UseClassModel("Auth"));
        $controller->addUses(new UseClassModel("Validator"));
        $controller->addUses(new UseClassModel($model->getClassName()));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 7;
    }
}