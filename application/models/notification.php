<?php

class Notification extends CI_Model {
	public function addNotification($data) {
		$this->db->insert('notification', $data);	
	}
	
	public function getNotifications($user_id) {
		$this->db->where('noti_to', $user_id);
		$query = $this->db->get('notification');
		foreach($query->result() as $row) {
			$data[$x]['from'       ] = $this->user->getUsername($row->noti_from);
			$data[$x]['from_url'   ] = $this->user->getProfileLink($row->noti_from);
			$data[$x]['office_id'  ] = $row->office_id;
			$data[$x]['role'       ] = $this->officeRole->getRole($row->office_id, $user_id);
			$data[$x]['office_name'] = $this->office->getOfficeName($row->office_id);
			$data[$x]['noti_type'  ] = $row->noti_type;
			$data[$x]['node_date'  ] = $row->noti_date;
			$x++;	
		}
		return $data;
	}
	
}