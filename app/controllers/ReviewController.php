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
    public function jsonresponse($data)
    {
        header("content-type: application/json");
        echo json_encode($data);
        exit;
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
            $rateexist = $this->model->rateexist($data["doctorid"], $data["patiantid"]);
            if ($rateexist) {
                $done = $this->model->updatereview($data);
            } else {
                $done = $this->model->addreview($data);

            }

            if ($done) {
                $a = ['message' => 'add review done'];
                $this->jsonresponse($a);
            } else {
                $a = ['message' => 'add review failed'];
                $this->jsonresponse($a);
            }
        }

    }
    public function averagerate($id)
    {
        $rates = $this->model->getreviews($id);
        $rate = 0;
        // var_dump($rates);
        for ($i = 0; $i < count($rates); $i++) {
            $rate += $rates[$i]["rate"];

        }

        $count = count($rates);
        $average = $rate / $count;
        $data = [
            "doctorid" => $id,
            "averagerate" => $average
        ];
        $this->jsonresponse($data);
    }
}

// }



?>