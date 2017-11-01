<?php

namespace Ur13l\ApiCrudGenerator\Model;

/**
 * Class Model
 * @package Ur13l\ApiCrudGenerator\Model
 */
class Model {

    /**
     * Name of the parent class
     *
     * @var string
     */
    protected $parentClassName;

    /**
     * Name of the current class
     *
     * @var string
     */
    protected $className;

    /**
     * List of attributes in the model
     *
     * @var array
     */
    protected $attributes;


    /**
     * @param String $parentClassName
     * @return void
     */
    public function setParentClassName($parentClassName) {
        $this->parentClassName = $parentClassName;
    }
    
    /**
     * @param String $className
     * @return void
     */
    public function setClassName($className) {
        $this->className = $className;
    }

    /**
     * @param array $attributes
     * @return void
     */
    public function setAttributes($attributes) {
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getParentClassName() {
        return $this->parentClassName;
    }

    /**
     * @return string
     */
    public function getClassName() {
        return $this->className;
    }

    /**
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * Returns the short name of a class without the package name.
     * @return string
     */
    public function getShortName() {
        $pieces = explode('\\', $this->getClassName());
        return end($pieces);
    }

    /**
     * List the attributes from the model in a readable format.
     *
     * @return array
     */
    public function printAttributes() {
        $string = "[";
        foreach($this->attributes as $key => $attr) {
            $string .= $attr . ($key != (count($this->attributes) - 1) ? "," : "");
        }
        $string .= "]";
        return $string;
    }
}