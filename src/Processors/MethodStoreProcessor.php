<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Class MethodStoreProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class MethodStoreProcessor implements ProcessorInterface
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
        $storeMethod = new MethodModel($config->get('store'));
        $storeMethod->addArgument(new ArgumentModel('request', 'Request'));
        $storeMethod->setDocBlock(new DocBlockModel(sprintf('%s: Store', $model->getShortName()) ,
            sprintf('Método para la creación de una instancia de %s', $model->getShortName()) , 
            sprintf('params: %s ', $model->printAttributes()), 
            '@param Request $request', 
            '@return Response'));
        $storeMethod->setBody('//Agregar reglas de validación.
        $rules = [];

        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }
        $data = '. $model->getShortName() . '::create($request->all());
        return new '. $model->getShortName() .'Resource($data);');
        $class->addMethod($storeMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 6;
    }
}