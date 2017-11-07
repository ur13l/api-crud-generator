<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
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
     * @param Controller $controller
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(Controller $controller, Model $model, Config $config){
        $indexMethod = new MethodModel($config->get('index'));
        $indexMethod->addArgument(new ArgumentModel('request', 'Request'));
        $indexMethod->setDocBlock(new DocBlockModel(
            sprintf('%s: Index. \nMétodo para mostrar una lista de %s', $model->getShortName(), $model->getShortName()), 
           'params: [page]',
            sprintf('route: /api/%s/', strtolower($model->getShortName())),
           'method: GET',
           '@param Request $request', '@return Response'));
        $indexMethod->setBody('$data = '. $model->getShortName() . '::paginate(10);
        return $this->success($data);');
        $controller->addMethod($indexMethod);
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 3;
    }
}