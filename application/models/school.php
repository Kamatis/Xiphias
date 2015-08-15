<?php

class School extends CI_Model {
    
    public function getSchoolName($school_id) {
        $this->db->where('school_id', $school_id);
        return $this->db->get('school')->row()->school_name;
    }
    
    public function getSchoolLevel($school_id) {
        $this->db->where('school_id', $school_id);
        return $this->db->get('school')->row()->school_level;
    }
    
    public function getSchools($param) {
        $this->db->where('school_level', $param);
        return $this->db->get('school');
    }
}