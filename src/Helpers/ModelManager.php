<?php

namespace Ur13l\ApiCrudGenerator\Helpers;

use Ur13l\ApiCrudGenerator\Model\Model;

/**
 * Class ModelManager
 * @package Ur13l\ApiCrudGenerator\Helpers
 */
class ModelManager {
    
    /**
     * Namespace for the models
     *
     * @var String
     */
    protected $namespace;

    /**
     * Constructor for ModelManager
     *
     * @param Config $config
     */
    public function __construct($config) {
        $this->namespace = $config->get('model_namespace');
    }

    /**
     * Get the model instance from a filename
     *
     * @param String $entry
     * @return Ur13l\ApiCrudGenerator\Model\Model
     */
    public function retrieveModel($entry) {
        $class = $this->namespace. '\\' . $this->trimPHP($entry);
        $model = new $class();
        $parentClass = get_parent_class($model);
        $attributes = $model->getFillable();
        $m = null;
        if(in_array($parentClass, $this->getCommonModelClasses())){
            $m = new Model();
            $m->setParentClassName($parentClass);
            $m->setClassName(get_class($model));
            $m->setAttributes($model->getFillable());
        }
        return $m;
    }

    /**
     * Simple method to remove the .php extension
     *
     * @param string $filename
     * @return string
     */
    public function trimPHP($filename) {
        return str_replace('.php', '', $filename);
    }


    /**
     * Returns the common model classes in Laravel 5.5
     *
     * @return array
     */
    public function getCommonModelClasses() {
        return [
            'Illuminate\Foundation\Auth\User',
            'Illuminate\Database\Eloquent\Model',
            'Jenssegers\Mongodb\Eloquent\Model'
        ];
    }
}