<?php
namespace app\controllers;




//use app\models\PatiantModel;
//use app\models\SpecialtieModel;

class ValidationController {

/*     private $patiantModel ;
    private $specialtieModel;
    public function __construct($db)
    {
        $this->patiantModel = new PatiantModel($db);
        $this->specialtieModel = new SpecialtieModel($db);
    } */

public function nameIsValid($data){
    $isValid=null;
    $name=$data['name'];
    if(empty($name)){
        $isValid=' name is required';
      }elseif(!preg_match("/^[a-z A-Z ]*$/",$name)){
        $isValid=" name only latters allowed";
      }
      return $isValid;
}

public function emailIsValid($data){
    $iaValid=null;
    $email=$data['email'];
    if (empty($email)) {
        $isValid = 'Email is required';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $isValid = 'Invalid email format';
    }
    return $isValid;
}

public function passwordIsValid($data){
    $isValid=null;
    $password=$data['password'];
    if (empty($password)) {
        $isValid = 'Password is required';
    } elseif (strlen($password) < 8) {
        $isValid = 'Password must be at least 8 characters';
    }
    return $isValid;
}
 public function phoneIsValid($data)  {
    $phone=$data['phone'];
    $isValid=null;

    if(empty($phone)){
        $isValid="mobile number can not be empty";
        return $isValid;
    }elseif(!preg_match("/^[0-9]{10}$/",$phone)) {
        $isValid="mobile number is not valid";
        return $isValid;
    }else{ 
        return $isValid;
    }
 }
 public function ageIsValid($data){
    $isValid=null;
    $age=$data['age'];
    if($age<=0){
        $isValid='age not valid';
        return $isValid;
    }elseif($age>150){
        $isValid='age not valid';
        return $isValid;
    }else{
        return $isValid;
    } 

 }

}

?>