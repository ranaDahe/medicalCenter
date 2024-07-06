<?php
namespace app\models;

class TreatmentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTreatment() {
        return $this->db->get('treatments');
    }

    public function addTreatment($data) {
        return $this->db->insert('treatments', $data);
    }

    public function getTreatmentById($id) {
        return $this->db->where('id', $id)->getOne('treatments');
    }

    public function updateTreatment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('treatments', $data);
    }

    public function deleteTreatment($id) {
        $this->db->where('id', $id);
        return $this->db->delete('treatments');
    }

    
}
