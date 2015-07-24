<?php

class Player extends CI_Model{
    
    public function getPlayerLevel($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('player')->row()->player_level;
    }
    
    public function getPlayerExp($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('player')->row()->experience;
    }
    
    public function getPlayerHouse($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('player')->row()->house_id;
    }
    
    public function getPlayerCourse($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('player')->row()->program_code;
    }
}