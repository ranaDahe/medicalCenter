<?php
namespace app\controllers;

 require __DIR__.'/../models/SpecialtieModel.php';
 require_once __DIR__.'/../controllers/ValidationController.php';

 use app\models\SpecialtieModel;
 use app\controllers\ValidationController;

 class SpecialtieController{

    private $specialtieModel;
    protected $validator;


    public function __construct($db)
    {
        $this->specialtieModel = new SpecialtieModel($db);
        $this->validator= new ValidationController();
    }
    private function jsonResponse($data){
        
        header("content-type: application/json");
        echo json_encode($data);
        exit;
    }
    public function index() {
        $specialties = $this->specialtieModel->getSpecialties();
        $this->jsonResponse($specialties);
    }
    /////////////////////////////////////////////////////////
    public function addSpecialtie() {

            $json_data = file_get_contents('php://input');

            $data = json_decode($json_data,true);
            
            //$nameIsValid=$this->validator->nameIsValid($data);

            if(!$this->specialtieIsExist($data)){
                //if(is_null($nameIsValid)){
                    if ($this->specialtieModel->addSpecialtie($data)) {

                        echo json_encode(['msg' => 'adding specialtie Successfully!']);
                    }else {
                        echo json_encode(['msg' => "Failed to add specialtie."]);
                    }
/*                 }else{
                    echo $nameIsValid;
                } */
 
             }else{
                echo json_encode(['msg' => "this specialty is exist."]);            
            }  


    }

    //////////////////////////////////////////////////////////////////

    public function specialtieIsExist($data){
        $isExist=true;
        $name=$data['name'];
        $specialtie=$this->specialtieModel->searchSpecialties($name);
        if(count($specialtie)==0){
            $isExist=false;
        }
        return $isExist;

    }


    //////////////////////////////////////////////////////////////////
    public function showSpecialtie() {
        $data = $this->specialtieModel->getSpecialties();
        $this->jsonResponse($data);
    }

    /////////////////////////////////////////////////////////////////////////////
    public function deleteSpeialtie($id) {
        if ($this->specialtieModel->deleteSpecialtie($id)) {
            echo json_encode(['msg' => 'specialtie deleted successfully!']);
        } else {
            echo json_encode(['msg' => "Failed to delete specialtie."]);
        }
    }

    //////////////////////////////////////////////////////////////////////////////
    public function updateSpeialtie($id) {

        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data,true);

        $nameIsValid=$this->validator->nameIsValid($data);

        
        if(is_null($nameIsValid)){
            if ($this->specialtieModel->updateSpecialtie($id, $data)) {
                echo json_encode(['msg' => 'specialtie updated successfully!']);
            } else {
                echo json_encode(['msg' => ' specialtie dos not exist.']);
                
            }
        }else{
           echo $nameIsValid;
        }

}

//////////////////////////////////////////////////////////////////////////
public function searchSpecialtie($searchTerm) {
    $data = $this->specialtieModel->searchSpecialties($searchTerm);
    $this->jsonResponse($data);
}
/////////////////////////////////////////////////////////////////////////
public function getSpecialtieById($id){
    $data = $this->specialtieModel->getSpecialtieById($id);
    $this->jsonResponse($data);
}
 }