<?php

class Involvement extends CI_Model {
	public function addInvolvement($data) {
		$this->db->insert('involvement', $data);	
	}

	
	public function getInvolvements($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('involvement');
		
		$data;
		$x = 0;
		foreach($query->result() as $row) {
			$data[$x]['name'] = $row->involvement_name;
			$data[$x]['venue'] = $row->involvement_venue;
			$data[$x]['start_date'] = $row->start_date;
			$data[$x]['end_date'] = $row->end_date;
			$x++;
		}
		return $data;
	}
	
}