<?php

class Ranking extends CI_Model {
    public function getHouseRankings($hof_id) {
        $this->db->where('hof_id', $hof_id);
        $ranking = $this->db->get('ranking');
        $x = 0;
        foreach($ranking->result() as $row) {
            $data[$x]['house_id']   = $row->house_id; 
            $data[$x]['house_name'] = $this->house->getHouseName($row->house_id);
            $data[$x]['points']     = $row->points;
            $x++;
        }
        usort($data, function($a, $b) {
            return $b['points'] - $a['points'];
        });
        return $data;
    }
    
  public function addRankingsEntry($hof_id) {
    $data['hof_id'] = $hof_id;
    for($x = 1; $x <= 4; $x++) {
       $data['house_id'] = $x;
       $data['points'] = $this->house->getHousePoint($x);
       $this->db->insert('ranking', $data);
    }
  }
}