<?php

class Quest extends CI_model{
    public function getMyQuests($user_id){
        $this->db->where('creator_id', $user_id);
        $query = $this->db->get('quest');
        
        $x = 0;
        foreach($query->result() as $row){
            $quest[$x]['questId'] = $row->quest_id;
            $quest[$x]['questName'] = $row->quest_title;
            $x++;
        }
        return $quest;
    }
    
    public function getQuestInfo($quest_id){
        $this->db->where('quest_id', $quest_id);
        $query = $this->db->get('quest');
        $row = $query->row();
        
        $quest = array(
            'questTitle'       => $row->quest_title,
            'questdescription' => $row->quest_description,
            'questRarity'      => $row->quest_rarity,
            'questDate'        => $row->start_date . ' to ' . $row->end_date,
            'questVenue'       => $row->venue,
            'questExp'         => $row->experience,
            'badge_id'         => $row->badge_id,
            'badge_image'      => $this->badge->getBadgeThumbnail($row->badge_id, 1)
        );
            
        return $quest;
    }
  
    public function getQuestRegistrants($quest_id){
        $this->db->where('quest_id', $quest_id);
        $query = $this->db->get('quest_registration');
        $x = 0;
        foreach($query->result() as $row){
            $questRegistrants[$x]['userId'] = $row->user_id;
            $questRegistrants[$x]['username'] = $this->user->getUsername($row->user_id);
            $x++;
        }
        return $questRegistrants;
    }
    
    public function addQuest($data){
        $this->db->insert('quest', $data);
    }
    
    public function getBadgeId($creatorId){
        $this->db->where('creator_id', $creatorId);
        $this->db->where('badge_id', 'MAX(badge_id)');
        return $this->db->get('badge')->row()->badge_id;
    }
    
    public function updateQuestInfo($quest_id, $data){
        $this->db->where('quest_id', $quest_id);
        $this->db->update('quest', $data);
    }
  
    public function getRarityInfo() {
        $query = $this->db->get('rarity');
        $x = 0;
        foreach($query->result() as $row) {
          $rarities[$x]['rarity_id'] = $row->rarity_id;
          $rarities[$x]['rarity_name'] = $row->rarity_name;
          $rarities[$x]['rarity_range_min'] = $row->rarity_range_min;
          $rarities[$x]['rarity_range_max'] = $row->rarity_range_max;
          $rarities[$x]['rarity_icon'] = $row->rarity_icon;
          $x++;
        }
        return $rarities;
    }
    
    public function isRegistered($user_id, $quest_id) {
        $this->db->where('quest_id', $quest_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('quest_registration');
        if($query->num_rows() == 1)
            return true;
        return false;
    }
    
    public function doneAwarding($quest_id, $user_id) {
        $this->db->where('quest_id', $quest_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('date_completed', null);
        $query = $this->db->get('quest_registration');
        if($query->num_rows() == 1)
            return false;
        return true;
    }
    
    public function getAllQuests(){
        $query = $this->db->get('quest');
        $x = 0;
        $user_id = $this->session->userdata('user_id');
        foreach($query->result() as $row){
            $quest[$x]['quest_id']     = $row->quest_id;
            $quest[$x]['title']        = $row->quest_title;
            $quest[$x]['description']  = $row->quest_description;
            $quest[$x]['rarity']       = $row->quest_rarity;
            $quest[$x]['date_created'] = $row->date_created;
            $quest[$x]['venue']        = $row->venue;
            $quest[$x]['experience']   = $row->experience;
            $quest[$x]['house_points'] = $row->house_points;
            $quest[$x]['quest_type']   = $row->quest_type;
            $quest[$x]['creator_id']   = $row->creator_id;
            $quest[$x]['badge_id']     = $row->badge_id;
            $quest[$x]['badge_name']   = $this->badge->getBadgeName($row->badge_id, 1);
            $quest[$x]['badge_image']  = $this->badge->getBadgeThumbnail($row->badge_id, 1);
            $quest[$x]['joined']       = $this->quest->isRegistered($user_id, $row->quest_id);
            $quest[$x]['creator_logo'] = $this->user->getUserPhoto($row->creator_id);
            if($row->start_date == $row->end_date)
                $quest[$x]['quest_date'] = $row->start_date;
            else
                $quest[$x]['quest_date'] = $row->start_date . ' - ' . $row->end_date;
            $x++;
        }
        return $quest;
    }
    
    public function register($data) {
        $this->db->insert('quest_registration', $data);   
    }
    
    public function abortQuest($quest_id, $user_id) {
        $this->db->where('quest_id', $quest_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('quest_registration');
    }
    
    public function completeQuest($quest_id, $user_id) {
        $this->db->where('quest_id', $quest_id);
        $this->db->where('user_id', $user_id);
        $data['date_completed'] = date('Y-m-d');
        $this->db->update('quest_registration', $data);
    }
}