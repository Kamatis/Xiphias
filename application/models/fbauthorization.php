<?php

class Fbauthorization extends CI_Model {
  
  public function getAccessTokens($memberId) {
    $tokens = array();
    foreach($memberId as $id) {
      $this->db->select('access_token');
      $this->db->where('user_id', $id);
      $query = $this->db->get('facebook_settings');
      
      $tokens[] = $query->row()->access_token;
    }
    return $tokens;
  }
  
  public function addAccessToken($data) {
    $fb['user_id']          = $data['user_id'];
    $fb['access_token']     = $data['access_token'];
    $fb['expiration_date']  = $data['expiration_date'];
    $this->db->insert('facebook_settings', $fb);
  }
}