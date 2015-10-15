<?php

class School extends CI_Model {
    
    public function getSchoolName($school_id) {
        $this->db->where('school_id', $school_id);
        return $this->db->get('school')->row()->school_name;
    }
    
    public function getSchoolLevel($school_id) {
        $this->db->where('school_id', $school_id);
        return $this->db->get('school')->row()->school_level;
    }
    
    public function getSchools($param) {
        $this->db->where('school_level', $param);
        return $this->db->get('school');
    }
	
	public function clearData($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->delete('school_attended');
	}
	
	public function addSchoolAttended($data) {
		$this->db->insert('school_attended', $data);
	}
	
	public function getSchoolType($school_id) {
		$this->db->where('school_id', $school_id);
		return $this->db->get('school')->row()->school_level;
	}
	
	public function getSchoolAttended($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('school_attended');
		$data;
		$x = 0;
		foreach($query->result() as $row) {
			$data[$x]['school_id'] = $row->school_id;
			$data[$x]['school_name'] = $this->school->getSchoolName($row->school_id);
			$data[$x]['start_year'] = $row->start_date;
			$data[$x]['end_year'] = $row->end_date;
			$data[$x]['school_type'] = $this->school->getSchoolType($row->school_id);
			$x++;
		}
		if($data[0]['school_type'] == 2) {
			$temp = $data[0];
			$data[0] = $data[1];
			$data[1] = $temp;
		}
		return $data;
	}
}