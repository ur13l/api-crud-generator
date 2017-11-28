<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Krlove\CodeGenerator\Model\ClassModel;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
use Ur13l\ApiCrudGenerator\Exceptions\GeneratorException;
use Krlove\CodeGenerator\Model\UseClassModel;
use Krlove\CodeGenerator\Model\NamespaceModel;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\ArgumentModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\ClassNameModel;


/**
 * Class CreateResourceProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class CreateResourceProcessor implements ProcessorInterface
{
    /**
     * Implemented method from ProcessorInterface
     *
     * @param ClassModel $class
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(ClassModel $class, Model $model, Config $config){
        $class->setName(new ClassNameModel($model->getShortName() . "Resource", "Resource"));
        $class->setNamespace(new NamespaceModel($config->get('resources_namespace')));
        $class->addUses(new UseClassModel("Illuminate\Http\Resources\Json\Resource"));
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
        $class->addMethod($toArrayMethod);
        return $class;
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 10;
    }
}
