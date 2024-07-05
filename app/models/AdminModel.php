<?php
namespace app\models;

class AdminModel{
    private $db;
    public function __construct($db)
    {
       $this->db = $db;
    }
    public function getadmin(){
        return $this->db->get('admins');
    }
}


?>