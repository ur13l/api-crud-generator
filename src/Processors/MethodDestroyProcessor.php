<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
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
     * @param ClassModel $class
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(ClassModel $class, Model $model, Config $config){
        $destroyMethod = new MethodModel($config->get('destroy'));
        $destroyMethod->addArgument(new ArgumentModel('id'));
        $destroyMethod->setDocBlock(new DocBlockModel(sprintf('%s: Destroy',$model->getShortName()),
            sprintf('Método para eliminar una instancia de %s', $model->getShortName()) , 
            'params id',
            '@param Integer $id',
            '@return Response'));
        $destroyMethod->setBody('$data = '. $model->getShortName() . '::find($id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        $data->delete();
        return new '. $model->getShortName() .'Resource($data);');
        $class->addMethod($destroyMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 4;
    }
}