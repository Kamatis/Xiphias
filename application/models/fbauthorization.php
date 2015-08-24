<?php

class Fbauthorization extends CI_Model {
  
  public function getAccessTokens($memberId) {
      $this->db->select('access_token');
      $this->db->where('user_id', $memberId);
      $query = $this->db->get('facebook_settings');      
      return $query->row()->access_token;
  }
  
  public function hasAccessToken($user_id) {
      $this->db->where('user_id', $memberId);
      $query = $this->db->get('facebook_settings');      
      if($query->num_rows() == 0)
          return false;
      return true;
  }
  
  public function addAccessToken($data) {
    $fb['user_id']          = $data['user_id'];
    $fb['access_token']     = $data['access_token'];
    $fb['expiration_date']  = $data['expiration_date'];
    $this->db->insert('facebook_settings', $fb);
  }
}