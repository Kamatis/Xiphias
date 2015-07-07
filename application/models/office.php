<?php

class Office extends CI_Model{
    public function getOfficeThumbnail($office_id){
        $this->db->where('office_id', $office_id);
        return $this->db->get('office')->row()->office_logo;
    }
    
    public function getOfficeInfo($office_id){
        $this->db->where('office_id', $office_id);
        $query = $this->db->get('office');
        $row = $query->row();
        
        $office['officeAbbr']        = $row->office_abbreviation;
        $office['officeDescription'] = $row->office_description;
        $office['officeLogo']        = $row->office_logo;
        $office['officeName']        = $row->office_name;
        return $office;
    }
    
    public function getMyOffices($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('office');
        $x = 0;
        foreach($query->result() as $row){
            $office[$x]['officeId']          = $row->office_id; 
            $office[$x]['officeName']        = $row->office_name;
            $x++;
        }
        return $office;
    }
    
    public function addOffice($data){
        $this->db->insert('office', $data);   
    }
}