<?php

namespace Ur13l\ApiCrudGenerator\Helpers;


class FileManager {

    protected $modelPath;

    public function __construct($config) {
        $this->modelPath = $config->get('model_path');
    }

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