<?php

class OfficeRole extends CI_Model {
  public function addRoleMember($data) {
    $this->db->insert('office_role', $data); 
  }
  
  public function getOfficeMembers($office_id) {
    $this->db->where('office_id', $office_id);
    $query = $this->db->get('office_role');
    $x = 0;
    foreach($query->result() as $member) {
      $data[$x]['approved'] = ($member->approved == 1);
      $data[$x]['username'] = $this->user->getUsername($member->user_id);
      $data[$x]['role']     = $member->role;
      $data[$x]['quest-actions'] = ($member->quest_permission == 1);
      $data[$x]['badge-actions'] = ($member->badge_permission == 1);
      $data[$x]['deleteRole'] = "1111";
      $x++;
    }
    return $data;
  }
}