<?php

class House extends CI_Model {
    
    public function getHouseName($house_id) {
        $this->db->where('house_id', $house_id);
        return $this->db->get('house')->row()->house_name;
    }
    
    public function getHouseDescription($house_id) {
        $this->db->where('house_id', $house_id);
        return $this->db->get('house')->row()->house_description;
    }
    
    public function getHousePoint($house_id) {
        $this->db->where('house_id', $house_id);
        return $this->db->get('house')->row()->house_points;    
    }
    
    public function getHouseInfo($house_id){
        $this->db->where('house_id', $house_id);
        $house = $this->db->get('house')->row();
        $data['house_id']   = $house_id;
        $data['house_name'] = $house->house_name;
        return $data;
    }
    
    public function getHouseLogo($house_id) {
        $this->db->where('house_id', $house_id);
        return base_url($this->db->get('house')->row()->house_logo);
    }
    
    public function awardHousePoint($houseId, $housePoint) {
        $this->db->set('house_points', 'house_points + ' . $housePoint ,false);
        $this->db->where('house_id', $houseId);
        $this->db->update('house');
    }
    
    public function getHousePoints() {
        $houses = $this->db->get('house');
        $x = 0;
        foreach($houses->result() as $house) {
            $house_id = $house->house_id;
            $map[$house_id] = $x;
            $data[$x]['name'] = $house->house_name;
            $data[$x]['y']    = 0 + $this->house->getHousePoint($house_id);
            $x++;
        }
        return $data;
    }
  
  public function resetHousePoints() {
    $data['house_points'] = 0;
    $this->db->update('house', $data); 
  }
}