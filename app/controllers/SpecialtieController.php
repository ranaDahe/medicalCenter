<?php
namespace app\controllers;

 require __DIR__.'/../models/SpecialtieModel.php';

 use app\models\SpecialtieModel;

 class SpecialtieController{

    private $specialtieModel;
    
    public function __construct($db)
    {
        $this->specialtieModel = new SpecialtieModel($db);
    }
 }