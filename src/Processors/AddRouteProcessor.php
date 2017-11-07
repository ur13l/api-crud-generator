<?php

namespace Ur13l\ApiCrudGenerator\Processors;

use Ur13l\ApiCrudGenerator\Model\Controller;
use Ur13l\ApiCrudGenerator\Model\Model;
use Ur13l\ApiCrudGenerator\Config;
use Krlove\CodeGenerator\Model\UseClassModel;


/**
 * Class AddRouteProcessor
 * @package Ur13l\ApiCrudGenerator\Processors
 */
class AddRouteProcessor implements ProcessorInterface
{
    
    /**
     * Implemented method from ProcessorInterface
     *
     * @param Controller $controller
     * @param Model $model
     * @param Config $config
     * @return void
     */
    public function process(Controller $controller, Model $model, Config $config){
        $content = file_get_contents($config->get('routes_path'));
        $route = sprintf("\nRoute::group(['prefix' => '%s'], function() {
            Route::post('store', '%s@store');
            Route::put('update', '%s@update');
            Route::delete('destroy/{id}', '%s@destroy');
            Route::get('/', '%s@index');
            Route::get('/{id}', '%s@show');
        });", 
        strtolower($model->getShortName()), $model->getShortName() . 'Controller');
        $pos = strpos ( $content , $route);
        if ($pos === FALSE ){ 
            file_put_contents($config->get('routes_path'), $route, FILE_APPEND);
        }
    }
    /**
     * @return int
     */
    public function getPriority(){
        return 1;
    }
}