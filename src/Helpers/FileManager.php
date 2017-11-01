<?php

namespace Ur13l\ApiCrudGenerator\Helpers;

/**
 * Class FileManager
 * @package Ur13l\ApiCrudGenerator\Helpers
 */
class FileManager {

    /**
     * We will find the models here
     *
     * @var string
     */
    protected $modelPath;

    /**
     * Constructor for the FileManager
     *
     * @param Config $config
     */
    public function __construct($config) {
        $this->modelPath = $config->get('model_path');
    }

    /**
     * Get the files containing Model classes.
     *
     * @return array
     */
    public function getFiles() {
        $list = [];
        if ($handle = opendir($this->modelPath)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && !is_dir($this->modelPath.$entry)) {
                        $list[] = $entry;
                    }
                }
                closedir($handle);
            }
        return $list;
    }
}