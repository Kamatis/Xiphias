<?php

class Semester extends CI_Model {
	
	public function isStarted() {
		return $this->db->get('semester')->row()->on_going;	
	}
	
	public function start() {
		$data['on_going'] = 1;
		$this->db->update('semester');
	}
	
	public function stop() {
		$data['on_going'] = 0;
		$this->db->update('semester');		
	}
}