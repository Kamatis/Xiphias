<?php

class House extends CI_Model {
    public function getHouseInfo($house_id){
        $this->db->where('house_id', $house_id);
        $house = $this->db->get('house')->row();
        $data['house_id']   = $house_id;
        $data['house_name'] = $house->house_name;
        return $data;
    }
}