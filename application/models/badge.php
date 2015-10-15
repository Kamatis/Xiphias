<?php

class Badge extends CI_Model{
    
    public function getBadgeDescription($badge_id) {
        $this->db->where('badge_id', $badge_id);
        return $this->db->get('badge')->row()->badge_description;
    }
    
    public function getBadgeCreator($badge_id) {
        $this->db->where('badge_id', $badge_id);
        return $this->db->get('badge')->row()->creator_id;
    }
    
    public function getBadgeThumbnail($badge_id, $level){
        $this->db->where('badge_ups_id', $badge_id);
        $this->db->where('badge_ups_lvl', $level);
        $query = $this->db->get('badge_ups');
        return base_url($query->row()->badge_ups_pix);
    }
    
    public function getBadgeName($badge_id, $level){
        $this->db->where('badge_ups_id', $badge_id);
        $this->db->where('badge_ups_lvl', $level);
        $query = $this->db->get('badge_ups');
        return $query->row()->badge_ups_name;    
    }
    
    public function getBadgeInfo($badge_id){
        $this->db->where('badge_id', $badge_id);
        $query = $this->db->get('badge');
        $row = $query->row();
        
        $badge = array(
            'name' => $this->getBadgeName($badge_id, 1),
            'description' => $row->badge_description,
            'baseLvlBadge' => $this->getBadgeThumbnail($badge_id, 1)
        );

        return $badge;
    }
    
    public function getMyBadges($user_id){
        $this->db->where('creator_id', $user_id);
        $query = $this->db->get('badge');
        $x = 0;
        foreach($query->result() as $row){
            $badge[$x]['badgeId'] = $row->badge_id;  
            $badge[$x]['imageSource'] = $this->getBadgeThumbnail($row->badge_id, 1);
            $badge[$x]['badgeName'] = $this->getBadgeName($row->badge_id, 1);
            $x++;
        }
        return $badge;
    }
    
    public function getEarnedBadges($user_id) {
        $this->db->distinct();
        $this->db->select('badge_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('earned_badge');
        $x = 0;
        foreach($query->result() as $row){
            $badge[$x]['badgeId'] = $row->badge_id;  
            $badge[$x]['imageSource'] = $this->getBadgeThumbnail($row->badge_id, 1);
            $x++;
        }
        return $badge;
    }
    
    public function addBadge($data){
        $this->db->insert('badge', $data);
        return mysql_insert_id();
    }
    
    public function addBadgeUpgrade($data){
        $this->db->insert('badge_ups', $data);   
    }
    
    public function getBadgeUpgrades($badge_id){
        $this->db->where('badge_ups_id', $badge_id);
        $this->db->where('badge_ups_lvl >', '1');
        $query = $this->db->get('badge_ups');
        $x = 0;
        foreach($query->result() as $row){
            $badgelvl[$x]['badgeName'] = $row->badge_ups_name;
            $badgelvl[$x]['imageSource'] = base_url($row->badge_ups_pix);
            $badgelvl[$x]['requirement'] = $row->requirement;
            $x++;
        }
        return $badgelvl;
    }
}
