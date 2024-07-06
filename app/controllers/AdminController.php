<?php
namespace app\controllers;

require __DIR__ . '/../models/AdminModel.php';
use app\models\AdminModel;

class AdminController
{
    private $model;


    public function __construct($db)
    {

        $this->model = new AdminModel($db);
    }
    public function jsonresponse($data)
    {
        header("content-type: application/json");
        echo json_encode($data);
        exit;
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $admins = $this->model->getadmin();
            var_dump($admins);
            if ($email == $admins[0]["email"] && $password == $admins[0]["password"]) {
                $a = ['message' => 'welcome admin'];
              $this->jsonresponse($a);

            }
        }
    }
}

?>