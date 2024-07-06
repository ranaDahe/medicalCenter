<?php
namespace app\controllers;

require __DIR__.'/../models/DoctorModel.php';
use app\models\DoctorModel;


class DoctorController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new DoctorModel($db);
    }
   

    public function index() {
        $doctors = $this->model->getDoctors();
      
    }

    public function addDoctor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $id_specialization = $_POST['id_specialization'];
           // $name = filter_var($name, FILTER_SANITIZE_STRING);
           // $phone = filter_var($phone, FILTER_SANITIZE_STRING);
    // $iidSpecialization =filter_var($idSpecialization ,FILTER_SANITIZE_STRING);
            
             $data = [
                'name'=>$name,
                'phone'=>$phone,
                'id_specialization'=>$id_specialization
            ]; 
            header('Content-Type: application/json');

            $jsonData = json_encode($data);

             echo $jsonData;


            if ($this->model->addDoctor($data)) {
                echo $jsonData;
                $m= [ 'msg' =>'add done.'];
                echo json_encode($m);
            } else {
                $m = [ 'msg' =>'Failed to add doctor.'];
                echo json_encode($m);
            }
        }
    }
           
    public function showDoctors() {
       $doctors = $this->model->getDoctors();
       header('Content-Type: application/json');

       $jsonData = json_encode($doctors);
       echo $jsonData;

   }

    public function deleteDoctor($id) {
        if ($this->model->deleteDoctor($id)) {
            header('Content-Type: application/json');
            $m= [ 'msg' =>'delete done.'];
            echo json_encode($m);
        } else {
            $m = [ 'msg' =>'Failed to delete doctor.'];
            echo json_encode($m);
    }
    }
    public function updateDoctor($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $id_specialization = $_POST['id_specialization'];
    
             $data = [
                'name'=>$name,
                'phone'=>$phone,
                'id_specialization'=>$id_specialization
            ]; 
        

            if ($this->model->updateDoctor($id, $data)) {
                header('Content-Type: application/json');
                $response = [
                    'success' => true,
                    'message' => '  updated successfully'
                ];
                
                echo json_encode($response);
              
            } else {
                $response = [
                    'success' => false,
                    'message' => '  update failed '
                ];
                echo json_encode($responce);
            }
        } 
    }
 
     public function searchDoctors( $keyword) {
        $keyword = $_GET['keyword'];

       $result =$this->model->searchDoctors($keyword);
       var_dump($result);
    //    if ($result <> null ){
    //     header('Content-Type: application/json');

    //     $response = [
    //         'success' => true,
    //         'name' => $result
    //     ];
       
    //    return json_encode($responce);
    // }else{
    //      return ['msg'=> 'not match'];

    // }         

    }
    }


