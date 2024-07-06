<?php
namespace app\models;

class DoctorModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDoctors() {
        return $this->db->get('doctors');
    }

    public function addDoctor($data) {
        return $this->db->insert('doctors', $data);
    }

    public function getDoctorById($id) {
        return $this->db->where('id', $id)->getOne('doctors');
    }

    public function updateDoctor($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('doctors', $data);
    }

    public function deleteDoctor($id) {
        $this->db->where('id', $id);
        return $this->db->delete('doctors');
    }

    public function searchDoctors($keyword) {
        $this->db->where('name', $keyword, 'LIKE');
        return $this->db->get('doctors');
    }
}
