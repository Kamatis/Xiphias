<?php

class Event extends CI_Model {
    public function getLiveEvents() {
        $this->db->order_by('date_time', 'desc');
        $events = $this->db->get('event');
        $x = 0;
        foreach($events->result() as $event) {
            $data[$x]['username']    = $event->username;
            $data[$x]['description'] = $event->description;
            $data[$x]['date']        = date("F j, Y, g:i a", strtotime($event->date_time));
            $x++;
        }
        return $data;
    }
    
    public function addEvent($data) {
        $event['username']    = $data['username'];
        $event['description'] = $data['description'];
        $this->db->insert('event', $event);
    }
}