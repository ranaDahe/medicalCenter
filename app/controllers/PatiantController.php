<?php
namespace app\controllers;

require __DIR__.'/../models/PatiantModel.php';
require_once __DIR__.'/../controllers/ValidationController.php';

use app\models\PatiantModel;
use app\controllers\ValidationController;

class PatiantController{
    private $patiantModel; 
    protected $validator;

    public function __construct($db)
    {
        $this->patiantModel=new PatiantModel($db);
        $this->validator= new ValidationController();
    }


    ////////////////////////////////////////////////////////////////////
    private function jsonResponse($data){

        header("content-type: application/json");
        echo json_encode($data);
        exit;
    }

    /////////////////////////////////////////////////////////////////////
    public function index() {
        $patiants = $this->patiantModel->getPatiants();
        $this->jsonResponse($patiants);
    }

    /////////////////////////////////////////////////////////////////////
    public function addPatiant() {

            $json_data = file_get_contents('php://input');

            $data = json_decode($json_data,true);


            $nameIsValid=$this->validator->nameIsValid($data);
            $phoneIsValid=$this->validator->phoneIsValid($data);
            $ageIsValid=$this->validator->ageIsValid($data);


            if(!$this->patiantIsExist($data)){
                if(is_null($nameIsValid)){
                    if(is_null($phoneIsValid)){
                        if(is_null($ageIsValid)){
                            if ($this->patiantModel->addPatiant($data)) {

                                echo json_encode(['msg' => 'adding Patiant Successfully!']);
                            } else {
                
                                echo json_encode(['msg' => "Failed to add Patiant."]);
                            }
                        }else{
                            echo $ageIsValid;
                        }

                    }else{
                        echo $phoneIsValid;
                    }

                }else{
                    echo $nameIsValid;
                }

            }else{
                    echo json_encode(['msg' => "this patiant already exist."]);
            }
 
 
    }

    ////////////////////////////////////////////////////////////////////
    public function showPatiant() {
        $data = $this->patiantModel->getPatiants();
        $this->jsonResponse($data);
    }
    //////////////////////////////////////////////////////////////////////
    public function deletePatiant($id) {
        if ($this->patiantModel->deletePatiant($id)) {
            echo json_encode(['msg' => 'patiant deleted successfully!']);
        } else {
            echo json_encode(['msg' => "Failed to delete patiant."]);
        }
    }

    /////////////////////////////////////////////////////////////////////
    public function updatePatiant($id) {

             $json_data = file_get_contents('php://input');
             $data = json_decode($json_data,true);
             

             $nameIsValid=$this->validator->nameIsValid($data);
             $phoneIsValid=$this->validator->phoneIsValid($data);
             $ageIsValid=$this->validator->ageIsValid($data);
 



             if(is_null($nameIsValid)){
                if(is_null($phoneIsValid)){
                    if(is_null($ageIsValid)){
                        
                            if ($this->patiantModel->updatePatiant($id, $data)) {
                                echo json_encode(['msg' => 'Patiant updated successfully!']);
                            } else {
                                echo json_encode(['msg' => 'Patiant does not exist.']);
                                
                            }
                    }else{
                        echo $ageIsValid;
                    }

                }else{
                    echo $phoneIsValid;
                }

            }else{
                echo $nameIsValid;
            }
     }

    ////////////////////////////////////////////////////////////////////////////

    public function searchPatiant($searchTerm) {
        $patiant = $this->patiantModel->searchPatiants($searchTerm);
        $this->jsonResponse($patiant);
    }
//////////////////////////////////////////////////////////////////////////////////
public function getPatiantById($id){
    $data = $this->patiantModel->getPatiantById($id);
    $this->jsonResponse($data);
}
////////////////////////////////////////////////////////////////////////////////////
public function patiantIsExist($data){
    $isExit=true;
    $name=$data['name'];
    $patiant=$this->patiantModel->searchPatiants($name);
    if(count($patiant)==0){
        $isExit=false;
    }else{
        $isExit=true;
    }
    return $isExit;

}

}

?>