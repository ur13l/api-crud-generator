<?php

namespace Ur13l\ApiCrudGenerator\Helpers;

use Ur13l\ApiCrudGenerator\Model\Model;

class ModelManager {
    
    protected $namespace;

    public function __construct($config) {
        $this->namespace = $config->get('model_namespace');
    }

    public function retrieveModel($entry) {
        $class = $this->namespace. '\\' . $this->trimPHP($entry);
        $model = new $class();
        $parentClass = get_parent_class($model);
        $m = null;
        if(in_array($parentClass, $this->getCommonModelClasses())){
            $m = new Model();
            $m->setParentClassName($parentClass);
            $m->setClassName(get_class($model));
        }
        return $m;
    }

    public function trimPHP($filename) {
        return str_replace('.php', '', $filename);
    }


    public function getCommonModelClasses() {
        return [
            'Illuminate\Foundation\Auth\User',
            'Illuminate\Database\Eloquent\Model'
        ];
    }
}