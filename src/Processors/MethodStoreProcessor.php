<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Interface ProcessorInterface
 * @package Krlove\EloquentModelGenerator\Processor
 */
class MethodStoreProcessor implements ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(Controller $controller, Model $model, Config $config){
        $storeMethod = new MethodModel($config->get('store'));
        $storeMethod->addArgument(new ArgumentModel('request', 'Request'));
        $storeMethod->setDocBlock(new DocBlockModel('Método para la creación de una instancia de ' . $model->getShortName() , 
            'params: ' . $model->printAttributes(), '@param Request $request', '@return Response'));
        $storeMethod->setBody('//Agregar reglas de validación.
        $rules = [];

        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error500($errors);
        }
        $data = '. $model->getShortName() . '::create($request->all());
        return $this->success($data);');
        $controller->addMethod($storeMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 7;
    }
}