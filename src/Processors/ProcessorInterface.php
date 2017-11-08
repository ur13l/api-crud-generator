<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
use Krlove\CodeGenerator\Model\ClassModel;

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
     * @param ClassModel $class
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(ClassModel $class, Model $model, Config $config);
    
    
    /**
     * @return int
     */
    public function getPriority();
}