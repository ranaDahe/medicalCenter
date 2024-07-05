<?php
namespace app\controllers;

require __DIR__ . '/../models/ReviewModel.php';
use app\models\ReviewModel;

class ReviewController
{
    private $model;


    public function __construct($db)
    {

        $this->model = new ReviewModel($db);
    }
    public function addreview()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $patiantid = $_POST["patiantid"];
            $doctorid = $_POST["doctorid"];
            $rate = $_POST['rate'];
            $comment = $_POST['comment'];
            $data = [
                "patiantid" => $patiantid,
                "doctorid" => $doctorid,
                'rate' => $rate,
                'comment' => $comment,
            ];
            if ($this->model->addreview($data)) {
                header("content-type: application/json");
                $a = ['message' => 'add review done'];
                echo json_encode($a);
            } else {
                header("content-type: application/json");
                $a = ['message' => 'add review failed'];
                echo json_encode($a);
            }
        }

    }
    public function averagerate($id)
    {
        $rates = $this->model->getreviews($id);
        $rate = 0;
        // var_dump($rates);
        for($i=0;$i<count($rates);$i++){
            $rate+=$rates[$i]["rate"];

        }
        // foreach ($rates as $v) {
        //     $rate += $v;
        // }
        $count=count($rates);
        $average=$rate/$count;
        echo $average;
    }}

// }



?>