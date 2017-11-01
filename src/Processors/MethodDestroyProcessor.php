<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Class MethodDestroyProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class MethodDestroyProcessor implements ProcessorInterface
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
        $destroyMethod = new MethodModel($config->get('destroy'));
        $destroyMethod->addArgument(new ArgumentModel('id'));
        $destroyMethod->setDocBlock(new DocBlockModel('Método para eliminar una instancia de ' . $model->getShortName() , 
           '@param Integer $id', '@return Response'));
        $destroyMethod->setBody('$data = '. $model->getShortName() . '::find($id);
        if(!$data) {
            return $this->error404("Objeto no encontrado");
        }
        $data->destroy();
        return $this->success($data);');
        $controller->addMethod($destroyMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 4;
    }
}