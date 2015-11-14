<?php

use Framework\Controller\Router;

class Framework {

    const CONTROLLER_PATH = "\\Application\\Mvc\\Controller\\";
    const DS = DIRECTORY_SEPARATOR;

    static protected $instance;
    static protected $utilities;

    public function __construct() {
        throw new \Exception("Framework � uma classe est�tica. N�o pode ser instanciada");
    }

    static public function autoload()
    {
        $app_path_in_pieces = explode("\\", rtrim(CONTROLLER_PATH, "\\"));
        $classes_prefixo = array
        (
            'Controller' => '.controller.php',
            'Model' => '.model.php',
            'Helper' => '.class.php'
        );

        spl_autoload_register(
            function($classname) use ($app_path_in_pieces, $classes_prefixo)
            {
                if (strpos($classname, $app_path_in_pieces[0]) !== 0)
                    return;

                $keys = explode("\\", $classname);
                $path = __DIR__.DS."..".DS."..".DS."..".DS.str_replace('\\', DS, strtolower($classname)) . $classes_prefixo[$keys[2]];

                if (file_exists($path))
                    require $path;
            }
        );
    }

    static public function utilities()
    {
        if (is_null(self::$utilities))
        {
            self::$utilities = new Utilities();
        }
        return self::$utilities;
    }

    public function __callStatic($method, $param)
    {
        switch($method)
        {
            case 'getController':
            case 'getModule':
            case 'getAction':
            case 'getUrlParameters':
                $router_class_exist = file_exists("router/router.php");
                if ($router_class_exist)
                    return Router::$$method(...$params);
                break;
        }
    }
}