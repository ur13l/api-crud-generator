<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
/**
 * Interface ProcessorInterface
 * @package Krlove\EloquentModelGenerator\Processor
 */
interface ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(Controller $controller, Model $model, Config $config);
    
    
    /**
     * @return int
     */
    public function getPriority();
}