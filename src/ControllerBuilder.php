<?php

namespace Ur13l\ApiCrudGenerator;
use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Processors\ProcessorInterface;


class ControllerBuilder {

    protected $model;
    protected $processors;

    public function __construct($processors) {
        $this->processors = $processors;
    }

    public function createController($model, $config) {
        $this->model = $model;

        $controller = new Controller();

        $this->prepareProcessors();
        foreach ($this->processors as $processor) {
            $processor->process($controller, $model, $config);
        }
        

        return $controller;

    }


    /**
     * Sort processors by priority
     */
    protected function prepareProcessors()
    {
        usort($this->processors, function (ProcessorInterface $one, ProcessorInterface $two) {
            if ($one->getPriority() == $two->getPriority()) {
                return 0;
            }
            return $one->getPriority() < $two->getPriority() ? 1 : -1;
        });
    }
    
}