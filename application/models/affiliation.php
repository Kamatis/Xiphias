<?php

class Affiliation extends CI_Model {
	public function addAffiliation($data) {
		$this->db->insert('student_affiliations', $data);	
	}
	
	public function getAffiliations($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('student_affiliations');
		$data;
		$x = 0;
		foreach($query->result() as $row) {
			$data[$x]['organization'] = $row->affiliation;
			$data[$x]['position'] = $row->position;
			$data[$x]['start_date'] = date("M j, Y", strtotime($row->start_date));
			$data[$x]['end_date'] = date("M j, Y", strtotime($row->end_date));
			$x++;
		}
		return $data;
	}
}