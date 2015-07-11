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
            'questVenue'       => $row->quest_venue,
            'questExp'         => $row->experience,
            'badge_id'         => $row->badge_id,
            'badge_image'      => base_url($this->badge->getBadgeThumbnail($row->badge_id, 1))
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
}