<?php

class Office extends CI_Model{
    
    public function getOfficeName($office_id) {
        $this->db->where('office_id', $office_id);
        return $this->db->get('office')->row()->office_name;
    }
    
    public function getOfficeAbbreviation($office_id) {
        $this->db->where('office_id', $office_id);
        return $this->db->get('office')->row()->office_abbreviation;
    }
    
    public function getOfficeDescription($office_id) {
        $this->db->where('office_id', $office_id);
        return $this->db->get('office')->row()->office_description;
    }
    
    public function getOfficeThumbnail($office_id){
        $this->db->where('office_id', $office_id);
        return base_url($this->db->get('office')->row()->office_logo);
    }
    
    public function getOfficeInfo($office_id){
        $this->db->where('office_id', $office_id);
        $query = $this->db->get('office');
        $row = $query->row();
        $office['officeId']          = $office_id;
        $office['officeAbbr']        = $row->office_abbreviation;
        $office['officeDescription'] = $row->office_description;
        $office['officeLogo']        = $this->office->getOfficeThumbnail($office_id);
        $office['officeName']        = $row->office_name;
        return $office;
    }
    
    public function getMyOffices($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('office_role');
        $x = 0;
        foreach($query->result() as $row){
            $office[$x]['officeId']   = $row->office_id; 
            $office[$x]['officeName'] = $this->office->getOfficeName($row->office_id);
            $x++;
        }
        return $office;
    }
    
    public function addOffice($data){
        $this->db->insert('office', $data);
        return mysql_insert_id();
    }
    
    public function updateLogo($officeId, $logo){
        $this->db->where('office_id', $officeId);
        $this->db->update('office', $logo);
    }
}