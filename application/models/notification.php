<?php

class Notification extends CI_Model {
	public function addNotification($data) {
		$this->db->insert('notification', $data);	
	}
	
	public function getNotifications($user_id) {
		$this->db->where('noti_to', $user_id);
		$query = $this->db->get('notification');
		$x = 0;
		foreach($query->result() as $row) {
			$data[$x]['from'       ] = $this->user->getUsername($row->noti_from);
			$data[$x]['from_url'   ] = $this->user->getProfileLink($data[$x]['from']);
			$data[$x]['noti_type'  ] = $row->noti_type;
			$data[$x]['to'         ] = $row->noti_to;
			$data[$x]['office_id'  ] = $row->office_id;
			if($row->noti_type == 1)
				$data[$x]['role'   ] = $this->officeRole->getRole($row->office_id, $user_id);
			else if($row->noti_type == 2 || $row->noti_type == 3)
				$data[$x]['role'   ] = $this->officeRole->getRole($row->office_id, $row->noti_from);	
			$data[$x]['office_name'] = $this->office->getOfficeName($row->office_id);
			$data[$x]['noti_date'  ] = date("F j, Y", strtotime($row->noti_date));
			$x++;	
		}
		return $data;
	}
	
	public function getNotificationCount($user_id) {
		$this->db->where('noti_to', $user_id);
		$query = $this->db->get('notification');
		return $query->num_rows();
	}
	
}