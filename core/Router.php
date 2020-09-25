<?php
namespace HotelFactory\core;


class Router {

    private $params = [];
    private $routes;
    private $routeCalled;
    private $baseRouteCalled;
    private $routeCalledHasRole = false;

    public function __construct()
    {
        $this->getRoutes();
        $this->manageUrl();
    }

    public function getRoutes()
    {
        $this->routes = yaml_parse_file("routes.yml");
        //include('routes.php');
        $uriParams = explode('?', $_SERVER['REQUEST_URI'], 2);
        $this->routeCalled = $uriParams[0];
        $uriParams[0] = preg_replace('#/+#','/',$uriParams[0]);
        $this->baseRouteCalled = "/".explode("/", $uriParams[0])[1];
        
        
        //$this->routes = getRoutes();
        if(isset($uriParams[1]))
            $this->params = $this->getParams($uriParams[1]);
        return;
    }

    public function manageUrl()
    {
        $accesCheck = false;
        $routeAccess = false;
        $baseRouteAccess = false;
        foreach($this->routes as $key => $route)
        {
            //users/1
            // correspond à /users/(?P<id>\d+)
            if($this->baseRouteCalled == $this->routeCalled){
                $accesCheck = $this->getRouteAccess($key, $route, $this->baseRouteCalled, $accesCheck);
            }else{
                $routeAccess = $this->getRouteAccess($key, $route, $this->routeCalled, $routeAccess);
                $baseRouteAccess = $this->getRouteAccess($key, $route, $this->baseRouteCalled, $baseRouteAccess);
                $accesCheck = (!$baseRouteAccess && $routeAccess && $this->routeCalledHasRole) || $baseRouteAccess;
            }

            if($accesCheck){
                if (preg_match("#$key$#i", $this->routeCalled, $params)) {
                    Request::processPathParams($params);
                    $this->processRoute($route);
                    return;
                }
            }
        }
        header('Location: '.Helper::getUrl("Errors","quatreCentQuatre"));
        die("L'url n'existe pas : Erreur 404");

    }

    public function processRoute(array $routeConfig): void
    {
        // $routeConfig = [
        // 'controller'=> "User",
        //'action'=> "get"
        // ]
        $c =  'HotelFactory\controllers\\'.ucfirst($routeConfig["controller"]."Controller");
        $a =  $routeConfig["action"]."Action";

        try {
            $controller = new $c();
        } catch( \Throwable $t) {

            die("Le fichier controller n'existe pas. Fichier: ".$c);
        }

        // if(class_exists($c))

        if (method_exists($controller, $a)) {
            //$c->$a()
            $this->loadAutoWiringClass($c, $controller, $a);

        } else {

            die("L'action' n'existe pas");
        }
    }


    private function getParams($params) {
        $explodedParams = explode('&', $params, 2);
        $result = [];
        foreach($explodedParams as $param) {
            $data = explode("=", $param);
            if(isset($data[1]))
                $result[$data[0]] =  $data[1];
        }

        return $result;
    }

    private function loadAutoWiringClass(string $controllername, Controller $controller, string $action): void
    {
        $reflection = new \ReflectionMethod($controller, $action);
        //getAction(Request $request, UserManager $userManager, PostManager $postManager)
        $params = $reflection->getParameters();

        $paramsToLaunch = [];
        for( $i = 0; $i <count($params); $i++)
        {
            $param =  $params[$i]->getType()->getName();
            // $i = 0
            // $param = App\Core\Request

            if(class_exists($param))
            {
                $paramToLaunch = new $param;
                $paramsToLaunch[] = $paramToLaunch;
            }
            elseif($param == 'int' || $param == 'string')
            {
                $paramsToLaunch[] = 0;
            }

        }
        MiddleWareManager::launch('onController');
        $reflection->invokeArgs(new $controllername, $paramsToLaunch);

    }

    private function getRouteAccess($url, $routeTocheck, $route, $returnValue){

        if(preg_match("#$url$#i", $route, $params)){
            if(isset($routeTocheck["role"])){
                foreach(explode(";", $routeTocheck["role"]) as $role){
                    if($this->routeCalled == $route)$this->routeCalledHasRole = true;
                    if(isset($_SESSION["role"]) && $role == $_SESSION["role"])return true;
                }
            }else{
                return true;
            }
        }
        return $returnValue;
    }
}