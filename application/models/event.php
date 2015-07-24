<?php

class Event extends CI_Model {
    public function getLiveEvents() {
        $events = $this->db->get('events');
        $x = 0;
        foreach($events->result() as $event) {
            $data[$x]['username']    = $event->username;
            $data[$x]['description'] = $event->description;
            $data[$x]['date']        = $event->date_time;
        }
        return $data;
    }
    
    public function addEvent($data) {
        $this->db->insert('event', $data);
    }
}