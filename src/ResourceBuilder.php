<?php

namespace Ur13l\ApiCrudGenerator;
use Ur13l\ApiCrudGenerator\Model\Resource;
use Ur13l\ApiCrudGenerator\Processors\ProcessorInterface;

/**
 * Class ResourceBuilder
 */
class ResourceBuilder {

    protected $model;
    protected $processors;
    
    /**
     * Controller method for ControllerBuilder
     *
     * @param array $processors
     */
    public function __construct($processors) {
        $this->processors = $processors;
    }

    /**
     * Create the controller from a model instance
     *
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function createResource($model, $config) {
        $this->model = $model;
        $resource = new Resource();
        $this->prepareProcessors();
        foreach ($this->processors as $processor) {
            $processor->process($resource, $model, $config);
        }

        return $resource;
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