<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Class MethodShowProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class MethodShowProcessor implements ProcessorInterface
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
        $showMethod = new MethodModel($config->get('show'));
        $showMethod->addArgument(new ArgumentModel('id'));
        $showMethod->setDocBlock(new DocBlockModel(sprintf('%s: Show',$model->getShortName()),
            sprintf('Método para mostrar una instancia de %s', $model->getShortName()), 
            'params: id',
            '@param Integer $id', 
            '@return Response'));
        $showMethod->setBody('$data = '. $model->getShortName() . '::find($id);
        if(!$data) {
            return $this->error("Objeto no encontrado");
        }
        return new '. $model->getShortName() .'Resource($data);');
        $class->addMethod($showMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 2;
    }
}