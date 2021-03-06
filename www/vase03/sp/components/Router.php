<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
			
            return trim($_SERVER['REQUEST_URI'], '/~');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        $parsedURL = parse_url($uri);

        $uri = $parsedURL['path'];
		

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
			

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/',  $internalRoute);

                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
				
				
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
				
				
                $controllerObject = new $controllerName;
                //$result = $controllerObject->$actionName();
                if (!method_exists($controllerObject, $actionName)) {
                    echo "Page doesn't exist";
                    //var_dump($controllerName);
                    //var_dump($actionName);
                    break;
                } else {
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                    if ($result != null) {
                        break;
                    }
                } 
            }
        }
    }
}
