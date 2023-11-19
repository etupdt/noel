<?php 

require_once 'models/Router.php';

require_once 'controllers/HomeController.php';
require_once 'controllers/admin/CategoryController.php';

require_once 'models/Database.php';

define("BASE_URL", '');
define("ADMIN_URL", '/admin');
define("API_URL", '/api');

$router = new Router();

$router->addRoute('GET',BASE_URL.'/', 'HomeController', 'index');

$router->addRoute('GET',BASE_URL.ADMIN_URL.'/category', 'CategoryController', 'index');
$router->addRoute('POST',BASE_URL.ADMIN_URL.'/category', 'CategoryController', 'index');

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('?', $_SERVER['REQUEST_URI'])[0];

$handler = $router->gethandler($method, $uri);

if ($handler == null ) { 

    header ('HTTP/1.1 404 not found');
    exit();
}

$controller = new $handler['controller']();
$action = $handler['action'];
$controller->$action();
