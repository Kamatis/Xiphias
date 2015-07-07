<?php

class Course extends CI_Model{
    public function getCourses(){
        return $this->db->get('program');   
    }
}