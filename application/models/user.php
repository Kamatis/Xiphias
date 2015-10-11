<?php

class User extends CI_Model{
    
    public function getUserId($username){
        $this->db->where('username', $username);
        return $this->db->get('user')->row()->user_id;
    }
    
    public function getUsername($user_id){
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row()->username;
    }
  
    public function getFirstName($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row()->first_name;
    }
	
		public function getLastName($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row()->last_name;
    }
	
		public function getMiddleName($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row()->middle_name;
    }
    
    public function getDescription($user_id){
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row()->description;
    }
    
    public function getUserType($username){
        $this->db->where('username', $username);
        return $this->db->get('user')->row()->user_type;
    }
    
    public function addUser($data){
        $this->db->insert('user', $data);
        return mysql_insert_id();
    }
    
    public function addPlayer($data){
        $this->db->insert('player', $data);
    }
    
    public function addNPC($data){
        $this->db->insert('npc', $data);
    }
    
    public function assignHouse(){
        $this->db->select('count(*) as counter');
        return ($this->db->get('player')->row()->counter % 4) + 1;
    }
    
    public function valid_login($data){
        $this->db->where('username like binary \'' .$data['username'] .'\'');
        $this->db->where('password', md5($data['password']));
        $query = $this->db->get('user');
        if($query->num_rows() == 1)
            return true;
        return false;
    }
        
    public function validate_account($serial){
        $this->db->where('serial', $serial);
        $query = $this->db->get('temp_user');
        if($query->num_rows() == 1){
            $row = $query->row();
            $data = array (
                'first_name' => $row->user_name,
                'middle_name' => $row->middle_name,
                'last_name' => $row->last_name,
                'username' => $row->username,
                'password' => $row->password,
                'email' => $row->email
            );
            $query = $this->db->insert('user', $data);
            if($query){
                $this->db->where('serial', $serial);
                $this->db->delete('temp_user');
                return true;
            }
            return false;
        }
        return false;
    }
    
    public function getPlayerInfo($user_id){
        $this->db->where('user_id', $user_id);
        return $this->db->get('player');
    }
    
    public function getLvlExp($level){
        $this->db->where('lvl', $level);
        return $this->db->get('avatar')->row()->experience_needed;
    }
    
    public function getLvlImage($level){
        $this->db->where('lvl', $level);
        return base_url($this->db->get('avatar')->row()->image);
    }
    
    public function updateDescription($user_id, $data){
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
    }
    
    public function updateProgramCode($user_id, $data){
        $this->db->where('user_id', $user_id);
        $this->db->update('player', $data);
    }
    
    public function getUserPhoto($user_id) {
        if($this->user->isNPC($user_id))
            return base_url('assets/images/new_logo.png');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('player');
        return $this->user->getLvlImage($query->row()->player_level);
    }

    public function getHouseId($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('player')->row()->house_id;
    }
    
    public function levelUp($user_id) {
        $this->db->set('player_level', 'player_level + 1', false);
        $this->db->where('user_id', $user_id);
        $this->db->update('player');
    }
    
    public function getExpNeeded($level) {
        $this->db->where('lvl', $level);
        return $this->db->get('avatar')->row()->experience_needed;
    }
    
    public function awardExperience($user_id, $exp) {
        $this->db->set('experience', 'experience + ' . $exp, false);
        $this->db->where('user_id', $user_id);
        $this->db->update('player');
        $success = "";
        while(true) {
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('player')->row();
            $curr_exp = $query->experience;
            $next_exp = $this->user->getExpNeeded($query->player_level + 1);
            if($curr_exp >= $next_exp){
                $this->user->levelUp($user_id);
                $event['username']    = $this->user->getUsername($user_id);
                $event['description'] = 'is now level ' . $this->player->getPlayerLevel($user_id);
                $event['date']        = date("F j, Y, g:i a");
                $this->event->addEvent($event);
                $success = $this->load->view('index/streamItem', $event, true) . $success;
            }
            else
                break;
        }
        return $success;
    }
    
    public function getUserInfo($username){
        $this->db->where('username like binary \''.$username. '\'');
        $query = $this->db->get('user');
        if($query->num_rows() == 1) {
            $data['username']   = $username;
            $data['user_id']    = $query->row()->user_id;
            $data['firstname']  = $query->row()->first_name;
            $data['middlename'] = $query->row()->middle_name;
            $data['lastname']   = $query->row()->last_name;
            $data['name']       = $data['firstname'] . " " . $data['middlename'][0] . ". " . $data['lastname'];
            $data['isOwner']    = ($this->session->userdata('username') == $username); 
            $data['isNPC']      = ($query->row()->user_type != 1);
            if(!$data['isNPC']){
                $playerData = $this->user->getPlayerInfo($query->row()->user_id);
                $data['experience']   = $playerData->row()->experience;
                $data['course']       = $playerData->row()->program_code;
                $data['player_level'] = $playerData->row()->player_level;
                $data['house_id']     = $playerData->row()->house_id;
                $data['min_exp']      = $this->user->getLvlExp($data['player_level']);
                $data['max_exp']      = $this->user->getLvlExp($data['player_level'] + 1);
                $data['lvl_image']    = $this->user->getLvlImage($data['player_level']);
            }
            return $data;
        }
    }
    
    public function getPlayerExp($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('player')->row()->experience;
    }
    
    public function getProfileLink($username) {
        return base_url('index.php/pages/profile/'.$username);
    }
    
    public function getPlayerPoints($user_id, $type) {
        $this->db->where('user_id', $user_id);
        $this->db->where('`date_completed` IS NOT NULL', null, false);
        $quests = $this->db->get('quest_registration');
        $points = 0;
        foreach($quests->result() as $quest) {
            if($this->quest->getQuestType($quest->quest_id) == $type)
                $points += $this->quest->getHousePoints($quest->quest_id);
        }
        return $points;
    }
  
    public function getTopThree($type) {
//      select QR.user_id, P.house_id, P.player_level from quest_registration QR, quest Q, player P
//      where QR.quest_id = Q.quest_id and QR.user_id = P.user_id and Q.quest_type = $type and P.experience > 0
//      group by QR.user_id order by P.experience desc limit 3
        $this->db->select('QR.user_id');
        $this->db->select('P.house_id');
        $this->db->select('P.player_level');
        $this->db->from('quest_registration QR');
        $this->db->join('quest Q', 'QR.quest_id=Q.quest_id', 'left');
        $this->db->join('player P', 'P.user_id = QR.user_id', 'left');
        $this->db->where('Q.quest_type', $type);
        $this->db->where('P.experience >', 0);
        $this->db->group_by('QR.user_id');
        $this->db->order_by('P.experience', 'desc');
        $this->db->limit(3);
      
        $players = $this->db->get();
        $x = 0;
        
        foreach($players->result() as $player) {
            $data['name' . $x]        = $this->user->getUsername($player->user_id);
            $data['namelink' . $x]    = $this->user->getProfileLink($this->user->getUsername($player->user_id));
            $data['houseid' . $x]     = $player->house_id;
            $data['playerLevel' . $x] = $player->player_level;
            $data['points' . $x]      = $this->user->getPlayerPoints($player->user_id, $type);
            $x++;
        }
        return $data;
    }
    
    public function getRankings($type) {
        $this->db->order_by('experience', 'desc');
        $players = $this->db->get('player');
        $x = 0;
        foreach($players->result() as $player) {
            $points = $this->user->getPlayerPoints($player->user_id, $type);
            if($points > 0) {
                $data[$x]['name']   = $this->user->getProfileLink($this->user->getUsername($player->user_id));
                $data[$x]['level']  = $player->player_level;
                $data[$x]['house']  = $this->house->getHouseName($player->house_id);
                $data[$x]['points'] = $points;
                $x++;
            }
        }
        usort($data, function($a, $b) {
            return $b['points'] - $a['points'];
        });
        
        for($y = 0; $y < $x; $y++) {
            $data[$y]['id'] = $y + 1;
            if($y != 0 && $data[$y]['points'] == $data[$y-1]['points'])
                $data[$y]['id'] = $data[$y-1]['id'];
        }
        return $data;
    }
    
    public function awardBadge($data){
        $this->db->insert('earned_badge', $data);
    }
    
    public function getUserActivity($user_id) {
        $quests = $this->quest->getCompletedQuests($user_id);
        $x = 0;
        $y = 0;
        $level = 1;
        foreach($quests->result() as $quest) {
            if($x != 0 && $data[$x-1]['x'] == (strtotime($quest->date_completed))*1000) {
                $x--;
                $y++;
            } else {
                if($x != 0)
                    $data[$x]['y'] = $data[$x-1]['y'];    
                $y = 0;
            }
			$data[$x]['x']            = (strtotime($quest->date_completed))*1000;
            $data[$x]['exp'][$y]     += $this->quest->getQuestExp($quest->quest_id);
            $data[$x]['y']           += $data[$x]['exp'][$y];
            $data[$x]['activity'][$y] = ($this->quest->getQuestTitle($quest->quest_id));
            while($data[$x]['y'] >= $this->user->getLvlExp($level + 1)) {
                $level++;
                $data[$x]['marker']['symbol'] = "url(http://www.highcharts.com/demo/gfx/sun.png)";
            }
            $x++;
        }
        return $data;
    }
    
    public function isNPC($userId) {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('user')->row();
        if($query->user_type != 1)
            return true;
        return false;
    }
    
    public function isAdmin($userId) {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('user')->row();
        if($query->user_type == 3)
            return true;
        return false;
    }
    
    public function isVerified($userId) {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('npc')->row();
        if($query->is_verified == 1)
            return true;
        return false;
    }
    
    public function verify($vcode, $username) {
        $this->db->where('serial_code', $vcode);
        $this->db->where('username', $username);
        if($this->db->get('user_registration')->num_rows() == 1){
            $userId = $this->getUserId($username);
            $this->db->where('user_id', $userId);
            $this->db->update('npc', array('is_verified' => 1));
            return true;
        }
        return false;
    }
    
    public function getSerial($username){
        $this->db->where('username', $username);
        $query = $this->db->get('user_registration');
        if($query->num_rows() == 1)
           return $query->row()->serial_code;
        else{
            $userId = $this->getUserId($username);
            $this->db->where('user_id', $userId);
            $query = $this->db->get('npc');

            if($query->num_rows() == 1){
                $serial = uniqid();
                $data['username'] = $username;
                $data['serial_code'] = $serial;
                $this->db->insert('user_registration', $data);
                return $serial;
            }
            else
                return "Invalid user!";
        }
    }
    
    public function getSessionData(){
        $data['user_image'] = $this->session->userdata('image');
        $data['username']   = $this->session->userdata('username');
        $data['isNPC']      = $this->session->userdata('isNPC');
        $data['isAdmin']    = $this->session->userdata('isAdmin');
        $data['isVerified'] = $this->session->userdata('isVerified');
        $data['offices']    = $this->office->getMyOffices($this->session->userdata('user_id'));
        return $data;    
    }
  
    public function getCourse($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('player')->row()->program_code;
    }
    
    public function passwordMatched($user_id, $pass) {
        $this->db->where('user_id', $user_id);
        $this->db->where('password', md5($pass));
        $query = $this->db->get('user');
        if($query->num_rows() == 1)
            return true;
        return false;
    }
    
    public function changePassword($user_id, $pass) {
        $data['password'] = md5($pass);
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
    }
		
		public function updateProfile($user_id, $data) {
				$this->db->where('user_id', $user_id);
				$this->db->update('user', $data);
		}
	
	public function getHomeAddress($user_id) {
		$this->db->where('user_id', $user_id);
		return $this->db->get('user')->row()->home_address;
	}
	
	public function getPhoneNumber($user_id) {
		$this->db->where('user_id', $user_id);
		return $this->db->get('user')->row()->phone_number;
	}
	
	public function getEmailAddress($user_id) {
		$this->db->where('user_id', $user_id);
		return $this->db->get('user')->row()->email_address;
	}
	
	public function updateCareerObj($user_id, $data) {
		$this->db->where('user_id', $user_id);
		$this->db->update('player', $data);
	}
	
	public function validUsername($user_name) {
		$this->db->where('username like binary \'' .$user_name .'\'');
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
			return true;
		return false;
	}
}
