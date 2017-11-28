<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
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
     * @param ClassName $class
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(ClassModel $class, Model $model, Config $config){
        $class->addUses(new UseClassModel("Illuminate\Http\Request"));
        $class->addUses(new UseClassModel("Auth"));
        $class->addUses(new UseClassModel("Validator"));
        $class->addUses(new UseClassModel($model->getClassName()));
        $class->addUses(new UseClassModel($config->get('resources_namespace') . "\\" . $model->getShortName() . "Resource"));
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 7;
    }
}