<?php

namespace Ur13l\ApiCrudGenerator\Model;

class Model {

    protected $parentClassName;

    protected $className;

    protected $attributes;


    public function setParentClassName($parentClassName) {
        $this->parentClassName = $parentClassName;
    }
    
    public function setClassName($className) {
        $this->className = $className;
    }

    public function setAttributes($attributes) {
        $this->attributes = $attributes;
    }

    public function getParentClassName() {
        return $this->parentClassName;
    }

    public function getClassNAme() {
        return $this->className;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function getShortName() {
        $pieces = explode('\\', $this->getClassName());
        return end($pieces);
    }

    public function printAttributes() {
        $string = "[";
        foreach($this->attributes as $key => $attr) {
            $string .= $attr . ($key != (count($this->attributes) - 1) ? "," : "");
        }
        $string .= "]";
        return $string;
    }
}