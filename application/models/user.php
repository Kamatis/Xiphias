<?php

class User extends CI_Model{
    
    public function getUsername($user_id){
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row()->username;
    }
    
    public function valid_login($data){
        $this->db->where('username like binary \'' .$data['username'] .'\'');
        $this->db->where('password', md5($data['password']));
        $query = $this->db->get('user');
        if($query->num_rows() == 1)
            return true;
        return false;
    }
        
    public function validate_account($serial){
        $this->db->where('serial', $serial);
        $query = $this->db->get('temp_user');
        if($query->num_rows() == 1){
            $row = $query->row();
            $data = array (
                'first_name' => $row->user_name,
                'middle_name' => $row->middle_name,
                'last_name' => $row->last_name,
                'username' => $row->username,
                'password' => $row->password,
                'email' => $row->email
            );
            $query = $this->db->insert('user', $data);
            if($query){
                $this->db->where('serial', $serial);
                $this->db->delete('temp_user');
                return true;
            }
            return false;
        }
        return false;
    }
    
    
    public function getUserInfo($username){
        $this->db->where('username like binary \''.$username. '\'');
        $query = $this->db->get('user');
        if($query->num_rows() == 1){
            $data['user_image'] = "http:/" . $query->row()->profile_pic;
            $data['username']   = $username;
            $data['firstname']  = $query->row()->first_name;
            $data['middlename'] = $query->row()->middle_name;
            $data['lastname']   = $query->row()->last_name;
            $data['name']       = $data['firstname'] . " " . $data['middlename'][0] . ". " . $data['lastname'];
            $data['isOwner']    = ($this->session->userdata('username') == $username); 
            $data['isNPC']      = ($query->row()->user_type == 2);
            return $data;
        }
    }
    
    public function awardBadge($data){
        $this->db->insert('earned_badge', $data);
    }
    
    public function getUserId($username){
        $this->db->where('username', $username);
        return $this->db->get('user')->row()->user_id;
    }
    
    public function getUserType($username){
        $this->db->where('username', $username);
        return $this->db->get('user')->row()->user_type;
    }
    
    public function isNPC($userId) {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('user')->row();
        if($query->user_type != 1)
            return true;
        return false;
    }
    
    public function isAdmin($userId) {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('user')->row();
        if($query->user_type == 3)
            return true;
        return false;
    }
    
    public function isVerified($userId) {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('npc')->row();
        if($query->is_verified == 1)
            return true;
        return false;
    }
    
    public function verify($vcode, $username) {
        $this->db->where('serial_code', $vcode);
        $this->db->where('username', $username);
        if($this->db->get('user_registration')->num_rows() == 1){
            $userId = $this->getUserId($username);
            $this->db->where('user_id', $userId);
            $this->db->update('npc', array('is_verified' => 1));
            return true;
        }
        return false;
    }
    
    public function getSerial($username){
        $this->db->where('username', $username);
        $query = $this->db->get('user_registration');
        if($query->num_rows() == 1)
           return $query->row()->serial_code;
        else{
            $userId = $this->getUserId($username);
            $this->db->where('user_id', $userId);
            $query = $this->db->get('npc');

            if($query->num_rows() == 1){
                $serial = uniqid();
                $data['username'] = $username;
                $data['serial_code'] = $serial;
                $this->db->insert('user_registration', $data);
                return $serial;
            }
            else
                return "Invalid user!";
        }
    }

}