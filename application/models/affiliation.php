<?php

class Affiliation extends CI_Model {
	public function addAffiliation($data) {
		$this->db->insert('student_affiliations', $data);	
	}
	
	public function getOrganization($aff_id) {
		$this->db->where('affiliation_id', $aff_id);
		return $this->db->get('affiliation')->row()->name;
	}
	
	public function getAffiliations($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('student_affiliations');
		
		$data;
		$x = 0;
		foreach($query->result() as $row) {
			$data[$x]['organization'] = $this->affiliation->getOrganization($row->affiliation_id);
			$data[$x]['position'] = $row->position;
			$data[$x]['start_date'] = $row->start_date;
			$data[$x]['end_date'] = $row->end_date;
			$x++;
		}
		return $data;
	}
}