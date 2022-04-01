<?php

use Router\Router;

//Le namespace du Router

require '../vendor/autoload.php';//Pour beneficier des namespaces directement à partir de l'autoloader

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR); //definir le repertoire view
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR); //definir le repertoire des scripts
const DB_NAME = 'e_commerce';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PWD = '';

$router = new Router($_GET['url']); //creation d'une nouvelle instance de Router

//Les routes
$router->get('/', 'Controller\ArticleController@index');
$router->get('/login', 'Controller\ArticleController@login');
$router->get('/signup', 'Controller\ArticleController@signup');
$router->get('/products-insert', 'Controller\ArticleController@ProductsInsert');
$router->get('/products/:id', 'Controller\ArticleController@products');
$router->get('/posts/:id', 'Controller\ArticleController@users');
$router->get('/your-products/:id', 'Controller\User\ProductContoller@findUserProduct');
$router->post('/product-delete/:id', 'Controller\User\ProductContoller@destroy');
$router->get('/product-edit/:id', 'Controller\User\ProductContoller@edit');
$router->post('/product-edit/:id', 'Controller\User\ProductContoller@update');
$router->get('/add-products', 'Controller\User\ProductContoller@addProducts');
$router->post('/create-products', 'Controller\User\ProductContoller@createProducts');

try {

    $router->run(); // execution de la function run qui renvoie les vues

}catch(\Exceptions\NotFound $e){
    echo $e->error404();
}
