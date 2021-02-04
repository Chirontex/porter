<?php
/**
 * Porter
 */
spl_autoload_register(function($classname) {

    if (strpos($classname, 'Infernusophiuchus\\Porter') !== false) {

        $path = __DIR__.'/Porter/';

        $file = explode('\\', $classname);

        if (count($file) > 3) $path .= $file[count($file) - 2].'/';

        $file = $file[count($file) - 1].'.php';

        if (file_exists($path.$file)) require_once $path.$file;

    }

});
