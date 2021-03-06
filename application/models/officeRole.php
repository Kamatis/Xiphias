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
	public function getRole($office_id, $user_id) {
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		return $this->db->get('office_role')->row()->role;
	}
	
	public function confirmRole($office_id, $user_id) {
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$data['approved'] = 1;
		$this->db->update('office_role', $data);
		$this->db->where('office_id', $office_id);
		$this->db->where('noti_to', $user_id);
		$this->db->delete('notification');
	}
	
	public function declineRole($office_id, $user_id) {
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('office_role');
		$this->db->where('office_id', $office_id);
		$this->db->where('noti_to', $user_id);
		$this->db->delete('notification');	
	}
	
	public function confirmLeadership($office_id, $user_id) {
		$this->db->where('office_id', $office_id);
		$this->db->where('role', 'Admin');
		$this->db->where('approved', 1);
		$this->db->delete('office_role');
		
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('role', 'Admin');
		$data['approved'] = 1;
		$this->db->update('office_role', $data);
		
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('role !=', 'Admin');
		$this->db->delete('office_role');
		
		$this->db->where('office_id', $office_id);
		$this->db->where('noti_to', $user_id);
		$this->db->delete('notification');
	}
	
	public function declineLeadership($office_id, $user_id) {
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('role', 'Admin');
		$this->db->delete('office_role');
		
		$this->db->where('office_id', $office_id);
		$this->db->where('noti_to', $user_id);
		$this->db->delete('notification');
	}
	
	public function deleteRole($office_id, $user_id) {
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('office_role');
	}
	
	public function alterBadgePermission($office_id, $user_id, $role) {
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('role', $role);
		$data['badge_permission'] = 1 - $this->db->get('office_role')->row()->badge_permission;
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('role', $role);
		$this->db->update('office_role', $data);
	}
	
	public function alterQuestPermission($office_id, $user_id, $role) {
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('role', $role);
		$data['quest_permission'] = 1 - $this->db->get('office_role')->row()->quest_permission;
		$this->db->where('office_id', $office_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('role', $role);
		$this->db->update('office_role', $data);			
	}
}