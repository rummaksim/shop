<?php


class Router
{
    private $routes;

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Возвращает строку запроса
     * @return string
     */
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run(){
        //Получение строки запроса
        $uri=$this->getURI();
        //Проверка наличия запроса в routes.php
        foreach ($this->routes as $uriPattern=>$path){
            //сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)){
                $internalRoute = preg_replace("~$uriPattern~", $path,  $uri);
                //определяем какой controller и action обрабатывают запрос
                $segments = explode('/', $internalRoute);
                //получаем имя контроллера-обработчика
                $controllerName = array_shift($segments);
                //получаем имя нужного action
                $actionName = array_shift($segments);
                //получаем дополнительные параметры запроса
                $parameters = $segments;
                //подключаем нужный файл класса-контроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                // Создаем экземпляр контроллера и вызываем нужный action
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null)
                    break;
            }
        }
    }
}

