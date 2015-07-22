<?php

class House extends CI_Model {
    public function getHouseInfo($house_id){
        $this->db->where('house_id', $house_id);
        $house = $this->db->get('house')->row();
        $data['house_id']   = $house_id;
        $data['house_name'] = $house->house_name;
        return $data;
    }
    
    public function awardHousePoint($houseId, $housePoint) {
        $this->db->set('house_points', 'house_points + ' . $housePoint ,false);
        $this->db->where('house_id', $houseId);
        $this->db->update('house');
    }
    
    public function getHouseName($house_id) {
        $this->db->where('house_id', $house_id);
        return $this->db->get('house')->row()->house_name;
    }
    
    public function getHousePoints() {
        $houses = $this->db->get('house');
        $x = 0;
        foreach($houses->result() as $house) {
            $house_id = $house->house_id;
            $map[$house_id] = $x;
            $data[$x]['name'] = $house->house_name;
            $data[$x]['y']    = 0;
            $x++;
        }
        
        $this->db->where('`date_completed` IS NOT NULL', null, false);
        $completed = $this->db->get('quest_registration');
        
        foreach($completed->result() as $quest) {
            $house_id = $this->user->getHouseId($quest->user_id);
            $data[$map[$house_id]]['y'] += $this->quest->getHousePoints($quest->quest_id);
        }
        return $data;
    }
}