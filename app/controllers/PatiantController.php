<?php
namespace app\controllers;

require __DIR__.'/../models/PatiantModel.php';

use app\models\PatiantModel;

class PatiantController{
    private $patiantModel;

    public function __construct($db)
    {
        $this->patiantModel=new PatiantModel($db);
    }
}

?>