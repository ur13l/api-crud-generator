<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;

/**
 * Interface ProcessorInterface
 * @package Ur13l\ApiCrudGenerator\Processors
 */
interface ProcessorInterface
{
    /**
     * Method to implement in the Processor classes, it handles the execution of a specific process
     * during the Controller generation.
     *
     * @param Controller $controller
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(Controller $controller, Model $model, Config $config);
    
    
    /**
     * @return int
     */
    public function getPriority();
}