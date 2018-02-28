<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Class MethodUpdateProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class MethodUpdateProcessor implements ProcessorInterface
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
        $updateMethod = new MethodModel($config->get('update'));
        $updateMethod->addArgument(new ArgumentModel('request', 'Request'));
        $updateMethod->setDocBlock(new DocBlockModel(sprintf('%s: Update',  $model->getShortName()),
            sprintf('Método para la actualización de una instancia de %s', $model->getShortName()) , 
            sprintf('params: %s ', $model->printAttributes()), 
            '@param Request $request', 
            '@return Response'));
        $updateMethod->setBody('
        $data = ' . $model->getShortName() . '::find($request->id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        $data->update($request->all());
        return new '. $model->getShortName() .'Resource($data);');
        $class->addMethod($updateMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 5;
    }
}