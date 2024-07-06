<?php
namespace app\models;

class SpecialtieModel{
    private $db;
    public function __construct($db)
    {
       $this->db = $db;
    }
    
public function getSpecialties() {
    return $this->db->get('specialties');
}

public function addSpecialtie($data) {
    return $this->db->insert('specialties', $data);
}

public function getSpecialtieById($id) {
    return $this->db->where('id', $id)->getOne('specialties');
}

public function updateSpecialtie($id, $data) {
    if(!is_null($this->getSpecialtieById($id))){
        $this->db->where('id', $id);
        return $this->db->update('specialties', $data);
    }else{
        return false;
    }

}

public function deleteSpecialtie($id) {
    $this->db->where('id', $id);
    return $this->db->delete('specialties');
}

public function searchSpecialties($searchTerm) {
    $this->db->where('name', $searchTerm, 'LIKE');
    return $this->db->get('specialties');
}

}