<?php
use app\controllers\DoctorController;
use app\controllers\TreatmentController;


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/lib/DB/MysqliDb.php';
require_once __DIR__ . '/app/controllers/DoctorController.php';
require_once __DIR__ . '/app/controllers/TreatmentController.php';


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


$controller = new DoctorController($db);
$controllert= new TreatmentController($db);


switch ($request) {
    case BASE_PATH:
        $controller->index();
        break;
    case BASE_PATH .'add' : 
        $controller->addDoctor();
        break;
    case BASE_PATH . 'show':
        $controller->showDoctors();
        break;
    case BASE_PATH . 'delete?id=' . $_GET['id']:
                    
         $controller->deleteDoctor($_GET['id']);
        break;
    case BASE_PATH . 'update?id=' . $_GET['id']:
        $controller->updateDoctor($_GET['id']);
         break; 
     case BASE_PATH . 'edit?id=' . $_GET['id']:
                        
        $controller->editDoctor($_GET['id']);
        break; 
    case BASE_PATH . 'searchdoctor':
         $controller->searchDoctors($_GET['keyword']);
         break;
         case BASE_PATH .'addtreatment' : 
            $controllert->addTreatment();
         break;         
    }


?>