<?php

namespace Ur13l\ApiCrudGenerator\Model;

use Krlove\CodeGenerator\Model\ClassModel;

/**
 * Class Controller
 * @package Ur13l\ApiCrudGenerator\Model
 */
class Controller extends ClassModel {

    public function __construct(){
        $this->addUses(new UseClassModel("Illuminate\Http\Request"));
        $this->addUses(new UseClassModel("Auth"));
        $this->addUses(new UseClassModel("Validator"));
        
    }
}