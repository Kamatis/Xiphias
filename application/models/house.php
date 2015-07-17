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
}