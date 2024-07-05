<?php
namespace app\models;

class ReviewModel
{
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function addreview($data)
    {
        return $this->db->insert('reviews', $data);
    }
    public function getreviews($id)
    {
        // return $this->db->get('reviews');
        $cols = Array ("rate");
        $this->db->where ('doctorid', $id);
        $rates = $this->db->get("reviews", null,$cols );
        if ($this->db->count > 0) {
            return $rates;
        }

    }
}

?>