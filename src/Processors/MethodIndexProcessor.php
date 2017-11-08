<?php

namespace Ur13l\ApiCrudGenerator\Processors;


use Krlove\CodeGenerator\Model\ClassModel;
use Ur13l\ApiCrudGenerator\Model\Model;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Ur13l\ApiCrudGenerator\Config;


/**
 * Class MethodIndexProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class MethodIndexProcessor implements ProcessorInterface
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
        $indexMethod = new MethodModel($config->get('index'));
        $indexMethod->addArgument(new ArgumentModel('request', 'Request'));
        $indexMethod->setDocBlock(new DocBlockModel(sprintf('%s: Index', $model->getShortName()),
            sprintf('Método para mostrar una lista de %s', $model->getShortName()), 
           'params: [page]',
           '@param Request $request', '@return Response'));
        $indexMethod->setBody('$data = '. $model->getShortName() . '::paginate(10);
        return '.$model->getShortName() .'Resource::collection($data);');
        $class->addMethod($indexMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 3;
    }
}