<?php

class Party extends CI_Model{
    
    public function getPartyName($party_id) {
        $this->db->where('party_id', $party_id);
        return $this->db->get('party')->row()->party_name;
    }
    
    public function getPartyDescription($party_id) {
        $this->db->where('party_id', $party_id);
        return $this->db->get('party')->row()->party_description;
    }
    
    public function getPartyCreator($party_id) {
        $this->db->where('party_id', $party_id);
        return $this->db->get('party')->row()->creator_id;
    }
    
    public function getMyParties($user_id){
        $this->db->where('creator_id', $user_id);
        $query = $this->db->get('party');
        $x = 0;
        foreach($query->result() as $row){
            $party[$x]['partyId']   = $row->party_id;
            $party[$x]['partyName'] = $row->party_name;
            $x++;  
        }
        return $party;
    }
    
    public function getPartyInfo($party_id){
        $this->db->where('party_id', $party_id);
        $query = $this->db->get('party');
        $row = $query->row();
        $party = array(
            'partyName'        => $row->party_name,
            'partyDescription' => $row->party_description
        );
        return $party;
    }
    
    public function getPartyMembers($party_id){
        $this->db->where('party_id', $party_id);
        $query = $this->db->get('party_member');
        $x = 0;
        foreach($query->result() as $row){
            $partyMembers[$x]['userId'] = $row->user_id;
            $partyMembers[$x]['username'] = $this->user->getUsername($row->user_id);
            $x++;
        }
        return $partyMembers;
    }
    
    public function addParty($data){
        $this->db->insert('party', $data);
    }
    
    public function updatePartyInfo($party_id,$data){
        $this->db->where('party_id', $party_id);
        $this->db->update('party', $data);
    }
    
    public function changePassword($partyId, $data){
        $this->db->where('party_id', $partyId);
        $this->db->update('party', $data);
    }
}