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
        $cols = array("rate");
        $this->db->where('doctorid', $id);
        $rates = $this->db->get("reviews", null, $cols);
        if ($this->db->count > 0) {
            return $rates;
        }

    }
    public function rateexist($doctorid, $patiantid)
    {
        $this->db->where('doctorid', $doctorid);
        $this->db->where('patiantid', $patiantid);
        $rateexist = $this->db->get("reviews");
        if ($rateexist) {
            return true;
        } else {
            return false;
        }
    }
    public function updatereview($data)
    {
        $this->db->where('doctorid', $data["doctorid"]);
        $this->db->where('patiantid', $data["patiantid"]);
        return $this->db->update('reviews', $data);

    }
}

?>