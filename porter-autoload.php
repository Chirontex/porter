<?php
/**
 * Porter
 */
spl_autoload_register(function($classname) {

    if (strpos($classname, 'Infernusophiuchus\\Porter') !== false) {

        $path = __DIR__.'/src/';

        $file = explode('\\', $classname);

        if (count($file) > 3) {

            switch ($file[count($file) - 2]) {

                case 'Exceptions':
                    $path .= 'exceptions/';
                    break;

                case 'Handlers':
                    $path .= 'handlers/';
                    break;

            }

        }

        $file = $file[count($file) - 1].'.php';

        if (file_exists($path.$file)) require_once $path.$file;

    }

});
