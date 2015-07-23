<?php

class Course extends CI_Model{
    public function getCourseName($program_id) {
        $this->db->where('program_id', $program_id);
        return $this->db->get('program')->row()->program_name;
    }
    
    public function getCourses(){
        return $this->db->get('program');   
    }
}