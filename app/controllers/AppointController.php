<?php
namespace app\controllers;

require __DIR__ . '/../models/AppointModel.php';

use app\models\AppointModel;
require __DIR__.'/../controllers/TreatmentController.php';
require __DIR__.'/../controllers/PatiantController.php';
use app\controllers\TreatmentController;
use app\controllers\PatiantController;
class AppointController{
    private $model;
    private $patiantmodel;


    public function __construct($db)
    {

        $this->model = new AppointModel($db);
        $this->treatmentcontroller = new TreatmentController($db);
        $this->patiantcontroller = new PatiantController($db);


       
    }
    public function addappoint($data){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $patiantid = $_POST["patiant-id"];
            $doctorid = $_POST["doctor-id"];
            $date = $_POST["date"];
            $time = $_POST["time"];
            $data = [
                "patiant-id" => $patiantid,
                "doctor-id" => $doctorid,
                'date' => $date,
                'time' => $time,
            ];
$exist=$this->patiantcontroller->patiantIsExist($data);
            if($exist==false){
                addPatiant();
            }
            if($this->model->appointisempty($date, $time, $doctorid)){
            if ($this->model->addappoint($data)) {
                header("content-type: application/json");
                $a = ['message' => 'add appoint done'];
                echo json_encode($a);
            } else {
                header("content-type: application/json");
                $a = ['message' => 'add appoint failed'];
                echo json_encode($a);
            }
        }}

    }
    public function showdoctorappoint($id){
        $appoints = $this->model->showdoctorappoint($id);
        header("content-type: application/json");
        echo json_encode($appoints);


    }
    public function showpatiantappoint($id){
        $appoints = $this->model->showpatiantappoint($id);
        header("content-type: application/json");
        echo json_encode($appoints);
    }
   
    public function deleteappoint($id){
        if ($this->model->deleteappoint($id)) {
            header("content-type: application/json");
            $a = ['message' => 'delete appoint done'];
            echo json_encode($a);
           
        } else {
            header("content-type: application/json");
            $a = ['message' => 'delete appoint failed'];
            echo json_encode($a);
        }
    }
    
    public function editstatus($id){
        $this->model->editstatus($id);
        $this->treatmentcontroller->addTreatment();


    }}



?>