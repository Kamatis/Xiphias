<?php

class Npc extends CI_Model{
    public function isVerified($user_id) {
        $this->db->where('user_id', $user_id);
        if($this->db->get('npc')->row()->is_verified == 1)
            return true;
        return false;
    }
}