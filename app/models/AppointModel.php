<?php
namespace app\models;

class AppointModel
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function addappoint($data)
    {
        return $this->db->insert('appointments', $data);


    }
    public function showdoctorappoint($id)
    {
        $this->db->where('doctorid', $id);
        $cols=["date","time","status"];
        $appoints = $this->db->get ("appointments", null, $cols);
        return $appoints;



    }
    public function showpatiantappoint($id)
    {
        $this->db->where('patiantid', $id);
        $cols=["date","time","doctorid"];
        $appoints = $this->db->get ("appointments", null, $cols);
        return $appoints;
    }
    public function appointisempty($date, $time, $id)
    {
        $this->db->where('doctorid', $id);
        $this->db->where('date', $date);
        $this->db->where('time', $time);
        $empty = $this->db->get('appointments');
        if ($empty) {
            return false;
        } else {
            return true;
        }


    }
    public function deleteappoint($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('appointments');


    }
}


?>