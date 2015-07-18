<?php

class School extends CI_Model {
    
    public function getSchools($param) {
        $this->db->where('school_level', $param);
        return $this->db->get('school');
    }
}