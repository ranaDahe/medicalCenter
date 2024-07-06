<?php
namespace app\models;

class PatiantModel{
    private $db;
     public function __construct($db)
     {
        $this->db = $db;
     }

public function getPatiants() {
    return $this->db->get('patiants');
}

public function addPatiant($data) {
    return $this->db->insert('patiants', $data);
}

public function getPatiantById($id) {
    return $this->db->where('id', $id)->getOne('patiants');
}

public function updatePatiant($id, $data) {
    if(!is_null($this->getPatiantById($id))){
        $this->db->where('id', $id);
        return $this->db->update('patiants', $data);
    }else{
        return false;
    }

}

public function deletePatiant($id) {
    $this->db->where('id', $id);
    return $this->db->delete('patiants');
}

public function searchPatiants($searchTerm) {
    $this->db->where('name', $searchTerm, 'LIKE');
    return $this->db->get('patiants');
}
}
?>