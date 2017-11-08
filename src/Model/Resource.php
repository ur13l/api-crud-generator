<?php

namespace Ur13l\ApiCrudGenerator\Model;

use Krlove\CodeGenerator\Model\ClassModel;
use Krlove\CodeGenerator\Model\NamespaceModel;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\UseClassModel;

/**
 * Class Resource
 * @package Ur13l\ApiCrudGenerator\Model
 */
class Resource extends ClassModel {

    public function init($model, $config) {
        $this->setNamespace(new NamespaceModel($config->get('resources_namespace')));
        $this->addUses(new UseClassModel("Illuminate\Http\Resources\Json\Resource"));
        $toArrayMethod = new MethodModel("toArray");
        $toArrayMethod->addArgument(new ArgumentModel('request'));
        $toArrayMethod->setDocBlock(new DocBlockModel(
            'Transform the resource into an array.', 
            '@param \Illuminate\Http\Request $request', 
            '@return array'));

        $text = "";
        foreach($model->getAttributes() as $attribute) {
            if(!empty($text)) {
                $text .= ', 
                ';
            }
            $text .= sprintf('\'%s\' => $this->%s', $attribute, $attribute);
        }
        $toArrayMethod->setBody("return [
            $text
        ];");
        $this->addMethod($toArrayMethod);
        return $this;
    }
}