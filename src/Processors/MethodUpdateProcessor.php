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
class MethodUpdateProcessor implements ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(Controller $controller, Model $model, Config $config){
        $updateMethod = new MethodModel($config->get('update'));
        $updateMethod->addArgument(new ArgumentModel('request', 'Request'));
        $updateMethod->setDocBlock(new DocBlockModel('Método para la actualización de una instancia de ' . $model->getShortName() , 
            'params: ' . $model->printAttributes(), '@param Request $request', '@return Response'));
        $updateMethod->setBody('
        $data = ' . $model->getShortName() . '::find($request->id);
        if(!$data) {
            return $this->error404("Objeto no encontrado");
        }
        $data->update($request->all());
        return $this->success($data);');
        $controller->addMethod($updateMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 7;
    }
}