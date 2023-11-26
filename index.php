<?php 

require_once 'models/Router.php';

require_once 'controllers/home/HomePageController.php';
require_once 'controllers/letter/LetterPageController.php';
require_once 'controllers/gift/GiftPageController.php';

require_once 'controllers/login/LoginApiController.php';

require_once 'controllers/admin/CategoryController.php';
require_once 'controllers/admin/CommentController.php';
require_once 'controllers/admin/GiftController.php';
require_once 'controllers/admin/ElfController.php';
require_once 'controllers/admin/VisitorController.php';
require_once 'controllers/admin/CommandController.php';

require_once 'models/Database.php';

define("BASE_URL", '');
define("ADMIN_URL", '/admin');
define("API_URL", '/api');

session_set_cookie_params([
    'httponly' => true
]);
session_start();

if (!isset($_COOKIE['gifts'])) {
    setcookie('gifts', '{}');
}

$router = new Router();

$router->addRoute('GET',BASE_URL.'/', 'HomePageController', 'index');
$router->addRoute('POST',BASE_URL.'/', 'HomePageController', 'index');

$router->addRoute('GET',BASE_URL.'/letter', 'LetterPageController', 'index');
$router->addRoute('POST',BASE_URL.'/letter', 'LetterPageController', 'index');

$router->addRoute('GET',BASE_URL.'/gift', 'GiftPageController', 'index');
$router->addRoute('POST',BASE_URL.'/gift', 'GiftpageController', 'index');

$router->addRoute('POST',BASE_URL.API_URL.'/login', 'LoginApiController', 'login');
$router->addRoute('POST',BASE_URL.API_URL.'/logout', 'LoginApiController', 'logout');

$router->addRoute('GET',BASE_URL.ADMIN_URL.'/category', 'CategoryController', 'index');
$router->addRoute('POST',BASE_URL.ADMIN_URL.'/category', 'CategoryController', 'index');

$router->addRoute('GET',BASE_URL.ADMIN_URL.'/comment', 'CommentController', 'index');
$router->addRoute('POST',BASE_URL.ADMIN_URL.'/comment', 'CommentController', 'index');

$router->addRoute('GET',BASE_URL.ADMIN_URL.'/gift', 'GiftController', 'index');
$router->addRoute('POST',BASE_URL.ADMIN_URL.'/gift', 'GiftController', 'index');

$router->addRoute('GET',BASE_URL.ADMIN_URL.'/elf', 'ElfController', 'index');
$router->addRoute('POST',BASE_URL.ADMIN_URL.'/elf', 'ElfController', 'index');

$router->addRoute('GET',BASE_URL.ADMIN_URL.'/visitor', 'VisitorController', 'index');
$router->addRoute('POST',BASE_URL.ADMIN_URL.'/visitor', 'VisitorController', 'index');

$router->addRoute('GET',BASE_URL.ADMIN_URL.'/command', 'CommandController', 'index');
$router->addRoute('POST',BASE_URL.ADMIN_URL.'/command', 'CommandController', 'index');

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('?', $_SERVER['REQUEST_URI'])[0];
error_log('=====================================================================> '.$_SERVER['REQUEST_URI']);
$handler = $router->gethandler($method, $uri);

if ($handler == null ) { 

    header ('HTTP/1.1 404 not found');
    exit();
}

$controller = new $handler['controller']();
$action = $handler['action'];
$controller->$action();
