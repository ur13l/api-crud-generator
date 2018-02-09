<?php
namespace Ur13l\ApiCrudGenerator\Commands;

use Illuminate\Config\Repository as AppConfig;
use Illuminate\Console\Command;
use Ur13l\ApiCrudGenerator\ControllerGenerator;
use Ur13l\ApiCrudGenerator\Config;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class GenerateCrud
 * @package Ur13l\ApiCrudGenerator\Commands
 */
class GenerateCrud extends Command {

    /**
     * Command call.
     *
     * @var string
     */
    protected $name = 'crud:generate';

    /**
     * Variable storing app info.
     *
     * @var AppConfig
     */
    protected $appConfig;

    /**
     * Controller Generator
     *
     * @var ControllerGenerator
     */
    protected $generator;

    /**
     * Constructor method
     *
     * @param ControllerGenerator $generator
     * @param AppConfig $appConfig
     */
    public function __construct (ControllerGenerator $generator, AppConfig $appConfig) {
        parent::__construct();

        $this->generator = $generator;
        $this->appConfig = $appConfig;
    }


    /**
     * @return Config
     */
    protected function createConfig()
    {
        $config = [];
        foreach ($this->getArguments() as $argument) {
            $config[$argument[0]] = $this->argument($argument[0]);
        }
        foreach ($this->getOptions() as $option) {
            $value = $this->option($option[0]);
            if ($option[2] == InputOption::VALUE_NONE && $value === false) {
                $value = null;
            }
            $config[$option[0]] = $value;
        }
        return new Config($config, $this->appConfig->get('api_crud_generator.defaults'));
    }

  
    /**
     * Fires the execution
     *
     * @return void
     */
    public function handle() {

        $this->fire();
    }

    /**
     * Creates a config and a controller class responsible for generate the controllers.
     *
     * @return void
     */
    public function fire() {
        $config = $this->createConfig();
        $controller = $this->generator->generateControllers($this->getArguments(), $config);
        $controller = $this->generator->generateResources($this->getArguments(), $config);
    }


    /**
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model-name', InputArgument::OPTIONAL, 'Model class name'],
        ];
    }
}