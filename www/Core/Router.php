<?php
namespace HotelFactory\core;

class Router {

    private $uri;
    private $routes;
    const PATH = "cache/routes.cache.php";


    public function __construct(){

        if(file_exists(self::PATH)){
            $this->routes = include self::PATH;
        }else{

            $listOfRoutes=yaml_parse_file("routes.yml");
        //générer fichier php transformant le fichier yaml en fichier php sous forme de tableau
       
        $data = var_export($listOfRoutes, true); //retranscrit le contenu d'une variable en php brut
       
        file_put_contents(self::PATH, "<?php \n return ".$data. ";");
        $this->routes = $listOfRoutes;
        
        }

        if($_SERVER["REQUEST_URI"] == "/"){
            $this->uri = "/";
        }else{
        $this->uri = rtrim($_SERVER["REQUEST_URI"], "/");}
        
    }

    public function match(){

        foreach (array_keys($this->routes) as $route){
            if($this->uri == $route){
                return $this->routes[$route];
            }
        }
        die("pas de routes trouvées");
    
    }

    public function exec(array $paramsRoute){
        
        if (!empty($paramsRoute)) {
            $c =  $paramsRoute["controller"]."Controller";
            $a =  $paramsRoute["action"]."Action";
        
            $pathController = "Controllers/".$c.".class.php";
        
            if (file_exists($pathController)) {
                include $pathController;
                //Vérifier que la class existe et si ce n'est pas le cas faites un die("La class controller n'existe pas")
        
                if (class_exists($c)) {
                    $controller = new $c();
                    
                    //Vérifier que la méthode existeet si ce n'est pas le cas faites un die("L'action' n'existe pas")
                    if (method_exists($controller, $a)) {
                        
                        //EXEMPLE :
                        //$controller est une instance de la class UserController
                        //$a = userAction est une méthode de la class UserController
        
                        $controller->$a();
                    } else {
                        throw new \Exception("L'action' n'existe pas");
                    }
                } else {
                    throw new \Exception("La class controller n'existe pas");
                }
            } else {
                throw new \Exception("Le fichier controller n'existe pas");
            }
        } else {
            throw new \Exception("L'url n'existe pas : Erreur 404");
        }

    }

}