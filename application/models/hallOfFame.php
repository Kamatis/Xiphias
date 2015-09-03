<?php
    
class HallOfFame extends CI_Model {
    public function getHallOfFame() {
        $hof = $this->db->get('hall_of_fame');
        $x = $hof->num_rows() - 1;
        foreach($hof->result() as $row) {
            $ranking = $this->ranking->getHouseRankings($row->hof_id);
            $data[$x]['date']         = $row->description;
            $data[$x]['houseLogo1st'] = $this->house->getHouseLogo($ranking[0]['house_id']);
            for($y = 0; $y < count($ranking); $y++)
                $data[$x]['house'][$y] = $ranking[$y]['house_name'];
            $x--;
        }
        return $data;
    }
  
  public function addHallOfFameEntry($data) {
    $this->db->insert('hall_of_fame', $data);
    return mysql_insert_id();
  }
}