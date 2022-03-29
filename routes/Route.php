<?php

namespace Router;

class Route
{

    public $path;
    public $action ;
    public $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        //conversion de l'url avec des expressions regulieres

        $path = preg_replace('#:([\w]+)#', '[^/]+', $this->path);
        $pathToMatch = "#$path$#";

        if (preg_match($pathToMatch, $url, $matches)){
            $this->matches = $matches;
            var_dump($this->matches);

            return true;
        }
        else{
            return false;
        }
    }

    public function execute(string $url){
        //recupere l'action le sépare en controller et methode
        $params = explode('@', $this->action);
        $urlParser = explode('/', $url);
        $controller = new $params[0]();
        $method = $params[1];
//
//        var_dump($urlParser[1]);
        return isset($urlParser[1]) ? $controller->$method($urlParser[1]) : $controller->$method();
    }
}