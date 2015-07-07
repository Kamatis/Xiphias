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
            'questExp'         => $row->experience
        );
            
        return $quest;
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
}