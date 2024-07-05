<?php

//use app\controllers\UserController;

use app\controllers\AdminController;
use app\controllers\PatiantController;
use app\controllers\SpecialtieController;
use app\controllers\ReviewController;
use app\controllers\AppointController;


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/DB/MysqliDb.php';
spl_autoload_register(function ($class) {
    require ('' . $class . '.php');

});
// require_once __DIR__ . '/app/controllers/PatiantController.php';
// require_once __DIR__ . '/app/controllers/SpecialtieController.php';
// require_once __DIR__ . '/app/controllers/AdminController.php';
// require_once __DIR__ . '/app/controllers/ReviewController.php';
// require_once __DIR__ . '/app/controllers/AppointController.php';




$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$request = $_SERVER['REQUEST_URI'];
var_dump($request);

define('BASE_PATH', '/');

$Patiantcontroller = new PatiantController($db);
$SpecialtieContrller = new SpecialtieController($db);
$admincontroller = new AdminController($db);
$reviewcontroller = new ReviewController($db);
$appointcontroller = new AppointController($db);

switch ($request) {
    case BASE_PATH . 'login':
        $admincontroller->login();
        break;
    case BASE_PATH . 'addreview':
        $reviewcontroller->addreview();
        break;
    case BASE_PATH . 'averagerate?id=' . $_GET['id']:
        $reviewcontroller->averagerate($_GET['id']);
        break;
    case BASE_PATH . 'showdoctorappoint?id=' . $_GET['id']:
        $appointcontroller->showdoctorappoint($_GET['id']);
        break;
    case BASE_PATH . 'showpatiantappoint?id=' . $_GET['id']:
        $appointcontroller->showpatiantappoint($_GET['id']);
        break;
    case BASE_PATH . 'deleteappoint?id=' . $_GET['id']:
        $appointcontroller->deleteappoint($_GET['id']);
        break;
    case BASE_PATH . 'addtreatment' . $_GET['id']:

    
    



}

