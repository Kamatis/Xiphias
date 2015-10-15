<?php

class Semester extends CI_Model {
	
	public function isStarted() {
		return $this->db->get('semester')->row()->on_going;	
	}
	
	public function start() {
		$data['on_going'] = 1;
		$data['start_date'] = date('Y-m-d')
		$this->db->update('semester', $data);
	}
	
	public function stop() {
		$data['on_going'] = 0;
		$this->db->update('semester', $data);		
	}
}