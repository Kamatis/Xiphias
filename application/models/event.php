<?php

class Event extends CI_Model {
    public function getLiveEvents() {
        $events = $this->db->get('event');
        $x = 0;
        foreach($events->result() as $event) {
            $data[$x]['username']    = $event->username;
            $data[$x]['description'] = $event->description;
            $data[$x]['date']        = $event->date_time;
            $x++;
        }
        return $data;
    }
    
    public function addEvent($data) {
        $this->db->insert('event', $data);
    }
}