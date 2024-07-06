<?php

//use app\controllers\UserController;

use app\controllers\PatiantController;
use app\controllers\SpecialtieController;


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/DB/MysqliDb.php';
require_once __DIR__ . '/app/controllers/PatiantController.php';
require_once __DIR__ . '/app/controllers/SpecialtieController.php';


$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$request = $_SERVER['REQUEST_URI'];
 
define('BASE_PATH', '/');

$Patiantcontroller = new PatiantController($db);
$SpecialtieContrller = new SpecialtieController($db);

 switch ($request) {
    case BASE_PATH:
        $Patiantcontroller->index();
        $SpecialtieContrller->index();
        break;
    case BASE_PATH . 'add/patiant':
        $Patiantcontroller->addPatiant();
        break;
    case BASE_PATH . 'add/specialtie':
        $SpecialtieContrller->addSpecialtie();
        break;
    case BASE_PATH . 'show/patiant':
        $Patiantcontroller->showPatiant();
        break;
    case BASE_PATH . 'show/specialtie':
        $SpecialtieContrller->showSpecialtie();
        break;
    case BASE_PATH . 'delete/patiant?id=' . $_GET['id']:
        $Patiantcontroller->deletePatiant($_GET['id']);
        break;
    case BASE_PATH . 'delete/specialtie?id=' . $_GET['id']:
        $SpecialtieContrller->deleteSpeialtie($_GET['id']);
        break;
    case BASE_PATH . 'update/patiant?id=' . $_GET['id']:
        $Patiantcontroller->updatePatiant($_GET['id']);
        break;
    case BASE_PATH . 'update/specialtie?id=' . $_GET['id']:
        $SpecialtieContrller->updateSpeialtie($_GET['id']);
        break;
    case BASE_PATH . 'search/patiant':
        $Patiantcontroller->searchPatiant($_POST['search_term']);
        break;
    case BASE_PATH . 'search/specialtie':
        $SpecialtieContrller->searchSpecialtie($_POST['search_term']);
        break;
    default:
    // var_dump($request);
        break;
} 
