<?php

class OfficeRole extends CI_Model {
  public function addRoleMember($data) {
    $this->db->insert('office_role', $data); 
  }
}