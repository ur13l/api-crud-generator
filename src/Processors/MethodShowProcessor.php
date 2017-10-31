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
class MethodShowProcessor implements ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(Controller $controller, Model $model, Config $config){
        $showMethod = new MethodModel($config->get('show'));
        $showMethod->addArgument(new ArgumentModel('id'));
        $showMethod->setDocBlock(new DocBlockModel('Método para mostrar una instancia de ' . $model->getShortName() , 
            'params: $id', '@param Integer $id', '@return Response'));
        $showMethod->setBody('$data = '. $model->getShortName() . '::find($id);
        if(!$data) {
            return $this->error404("Objeto no encontrado");
        }
        return $this->success($data);');
        $controller->addMethod($showMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 7;
    }
}