<?php

namespace MVC;

class View
{
    private static $instance = null;
    private mixed $viewPath;

    public function __construct($viewPath = 'frontend')
    {
        $this->viewPath = $viewPath;
    }

    public static function getInstance($viewPath = 'frontend')
    {
        if (self::$instance === null) {
            self::$instance = new self($viewPath);
        }
        return self::$instance;
    }

    public static function render($view, $data = [], $receive = false)
    {
        // ob_start(); and ob_get_clean(); are used to buffer the output of the view file
        // return content of the view file
        //echo self::getInstance()->viewPath;
        $viewPath = self::getInstance()->viewPath;
        $viewFile = VIEWS . $view;
        try {

            //app/viewPath
            //app/frontend/index.php
            $viewFile = VIEWS . $view;
            if (file_exists($viewFile)) {
                extract($data);
                if ($receive) {
                    ob_start();
                    include_once $viewFile;
                    return ob_get_clean();
                }
                include_once $viewFile;
            } else {
                throw new \Exception("View file not found: {$viewFile}");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
