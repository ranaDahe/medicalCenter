<?php
namespace app\controllers;

require __DIR__.'/../models/TreatmentModel.php';
use app\models\TreatmentModel;


class TreatmentController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new TreatmentModel($db);
    }
   

    public function index() {
        $users = $this->model->getTreatments();
        
     
    }

    public function addTreatment() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $idappoint = $_POST['idappoint'];
            $symptoms = $_POST['symptoms'];
            $medicines = $_POST['medicines'];
            $odders = $_POST['orders'];
            $data = [
               ' idappoint' => $idappoint,
                'symptoms' => $symptoms,
                'medicines' => $medicines,
                'orders' => $orders


            ];
            header('Content-Type: application/json');

            $jsonData = json_encode($data);

             echo $jsonData;

            if ($this->model->addTreatment($data)) {
                header('Content-Type: application/json');
                
                return json_encode($data);
              
            } else {
                $m = ['msg'=> 'failed to add'];
                echo $m;
            }
    }
}

   

   
    public function updateTreatment($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $symptoms = $_POST['symptoms'];
            $medicines = $_POST['medicines'];
            $odders = $_POST['orders'];
            $data = [
                'symptoms' => $symptoms,
                'medicines' => $medicines,
                'orders' => $orders

            ];
            $jsonData = json_encode($data);

echo $jsonData;

            if ($this->model->updateTreatment($id, $data)) {
                echo "Treatment updated successfully!";
                $jsonData = json_encode($data);

echo $jsonData;
               
            } else {
                echo "Failed to update Treatment.";
            }
        } else {
            $user = $this->model->getTreatmentById($id);
           
        }
    } 

    
}
