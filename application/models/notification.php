<?php

class Notification extends CI_Model {
	public function addNotification($data) {
		$this->db->insert('notification', $data);	
	}
	
}