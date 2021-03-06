<?php 

// just to make some things work while views@php are at work
// comment when working on this php file
error_reporting(0);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
		$this->load->library('facebook');
    }
  
    public function index() {
        if($this->session->userdata('is_logged_in')){
			$user_id = $this->session->userdata('user_id');
            $data = $this->user->getSessionData($user_id);
            $data['title'] = 'Xiphias | Home';
			$data['noti' ] = $this->notification->getNotificationCount($user_id);
            
            $events = $this->event->getLiveEvents();
          
            for($x = 0; $x < count($events); $x++) {
            	$views['stream'] .= $this->load->view('index/streamItem', $events[$x], true); 
            }
          
//            $views['stream']    = $this->load->view('index/streamItem', '', true); 
            $views['carousel']  = $this->load->view('index/carousel', '', true);
          
            $body['menu'   ] = $this->load->view('menu', $data, true);
            $body['content'] = $this->load->view('index', $views, true);
          
            $this->load->view('header');
            $this->load->view('body', $body);
        } else{
            $this->load->view('landing');
        }
	}

    public function login() {
        $this->load->view('landing');
    }
    
    public function updateUserDescription(){
        $data['description'] = $this->input->post('description');
        $this->user->updateDescription($this->session->userdata('user_id'), $data);
    }
    
	public function register() {
        $query = $this->db->get('program');
        $data['courses'] = "<option value=\"0\" disabled selected>Select your course</option>\n";
        foreach ($query->result() as $row) 
            $data['courses'] .= "<option value = \"$row->program_code\">$row->program_name</option>\n";
		$this->load->view('register', $data);
	}
    
    public function checkUser() {
        $data = array(
            'username' => $this->db->escape_str($this->input->post('username')),
            'password' => $this->input->post('password')
        );
        if($this->user->valid_login($data))
            echo "ok";
        else
            echo "no";
    }
    
    public function login_attempt() {
        $data = array(
            'username' => $this->db->escape_str($this->input->post('txtUsername')),
            'password' => $this->input->post('txtPassword')
        );
        if($this->user->valid_login($data)){
            $userId = $this->user->getUserId($this->input->post('txtUsername'));
            $data_session = array (
                'image'        => $this->user->getUserPhoto($userId),
                'username'     => $this->input->post('txtUsername'),
                'user_id'      => $userId,
                'login_type'   => $this->user->getUserType($data['username']),
                'is_logged_in' => 1,
                'isNPC'        => $this->user->isNPC($userId),
                'isAdmin'      => $this->user->isAdmin($userId),
                'isVerified'   => $this->user->isVerified($userId)
            );
            $this->session->set_userdata($data_session);
            redirect(base_url() . 'index.php');
        }
        else
            redirect(base_url() . 'index.php/pages/login');
    }
    
    public function getRankings($type) {
        echo json_encode($this->user->getRankings($type));
    }
    
    public function getHousePoints() {
        echo json_encode($this->house->getHousePoints());
    }
    
    public function getUserActivity($username) {
		$user_id = $this->user->getUserId($username);
        echo json_encode($this->user->getUserActivity($user_id));
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php');
    }
  
    public function editProfile() {
		$query = $this->course->getCourses();
		$user_id = $this->session->userdata('user_id');
		$data['description'] = $this->user->getDescription($user_id);
		$data['programs'] = "<option value=\"0\" disabled selected>Select your course</option>\n";
		foreach ($query->result() as $row) {
			if($this->user->getCourse($user_id) == $row->program_code)
				$data['programs'] .= "<option value = \"$row->program_code\" selected>$row->program_name</option>\n";
			else
				$data['programs'] .= "<option value = \"$row->program_code\">$row->program_name</option>\n";
		}

		for($yr = 2015; $yr>=1900; $yr--)
			$data['years'] .= "<option value = \"$yr\">$yr</option>\n";

		$view = $this->load->view('profile/editProfile', $data , true);
		echo $view;
    }
  
    public function createResume() {
		$query1 = $this->school->getSchools(1);
		$query2 = $this->school->getSchools(2);
		
		$u_id = $this->session->userdata('user_id');
		$data['school'   ] = $this->school->getSchoolAttended($u_id);
		$data['address'  ] = $this->user->getHomeAddress($u_id); 
		$data['contact'  ] = $this->user->getPhoneNumber($u_id);
		$data['emailadd' ] = $this->user->getEmailAddress($u_id);
		$data['objective'] = $this->player->getCareerObjective($u_id);
		
		$data['primary'] = "<option></option>\n";
		foreach($query1->result() as $row) {
			if($row->school_id == $data['school'][0]['school_id'])
				$data['primary'] .= "<option value = \"$row->school_id\" selected>$row->school_name</option>\n";		
			else
				$data['primary'] .= "<option value = \"$row->school_id\">$row->school_name</option>\n";
		}
		
		$data['secondary'] = "<option></option>\n";
		foreach($query2->result() as $row) {
			if($row->school_id == $data['school'][1]['school_id'])
				$data['secondary'] .= "<option value = \"$row->school_id\" selected>$row->school_name</option>\n";
			else
				$data['secondary'] .= "<option value = \"$row->school_id\">$row->school_name</option>\n";
		}
		for($yr = 2015; $yr>=1900; $yr--)
			$data['years'] .= "<option value = \"$yr\">$yr</option>\n";
      
		
		$view = $this->load->view('profile/createResume', $data , true);
		echo $view;
    }
  
    public function showAddAffiliation() {
		$view = $this->load->view('profile/affiliation', $data, true);
		echo $view;
    }
  
    public function showAddInvolvement() {
//      iterate all quests completed
//      put into json to be passed to $view as $data
      $view = $this->load->view('profile/involvement', $data, true);
      echo $view;
    }
  
    public function profile($username) {
        // Data fields
        $user_profile = $this->user->getUserInfo($username);

        $data = $this->user->getSessionData();
        $data['title'] = "Xiphias | ".$username;
		$user_id = $this->session->userdata('user_id');
		$data['noti'] = $this->notification->getNotificationCount($user_id);

        $description['description'] = $this->user->getDescription($user_profile['user_id']);
        $description['isOwner'    ] = ($data['username'] == $username);

        if($user_profile['isNPC'])
            $badges['badge'] = $this->badge->getMyBadges($user_profile['user_id']);
        else
            $badges['badge'] = $this->badge->getEarnedBadges($user_profile['user_id']);

        $views['profileInfo'       ] = $this->load->view('profile/profileInfo', $user_profile, true);
        $views['profileDescription'] = $this->load->view('profile/profileDescription', $description, true);
        $views['profileBadges'     ] = $this->load->view('profile/profileBadges', $badges, true);
        $views['profileTimeline'   ] = $this->load->view('profile/profileTimeline', '', true);

        // views in <body>
        $body['menu'   ] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('profile', $views, true);

        // Main views inserted in <html>
        $this->load->view('header');
        $this->load->view('body', $body);
    }

    public function settings() {
        $user_profile = $this->user->getUserInfo($username);

        $data = $this->user->getSessionData();
        $data['title']      = "Xiphias | Settings";
		$user_id = $this->session->userdata('user_id');
		$data['noti'   ] = $this->notification->getNotificationCount($user_id);
        $body['menu'   ] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('settings', '', true);

        // Main views inserted in <html>
        $this->load->view('header');
        $this->load->view('body', $body);
    }

    public function questboard() {
        $query = $this->db->get('user');
        $data = $this->user->getSessionData();
        $data['title'] = 'Xiphias | Quest Board';
		$user_id = $this->session->userdata('user_id');
		$data['noti'] = $this->notification->getNotificationCount($user_id);
        $user_id = $this->session->userdata('user_id');

        $quests = $this->quest->getAllQuests();
        
        // this should be iterated to get the quest data to be pushed to the view
        $questCount = count($quests);
        for($x = 0; $x < $questCount; $x++)
        {
			$quests[$x]['isNPC'  ] = $data['isNPC'];
			$quests[$x]['awarded'] = $this->quest->doneAwarding($quests[$x]['quest_id'], $user_id);
			$views['questpins'   ] .= $this->load->view('questboard/questpin', $quests[$x], true);
        }
            

        $body['menu'   ] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('questboard', $views, true);

        $this->load->view('header');
        $this->load->view('body', $body);
    }

    public function leaderboards() {
        $query = $this->db->get('user');

        $data = $this->user->getSessionData();
        $data['title'] =  'Xiphias | Leaderboards';
		$user_id = $this->session->userdata('user_id');
        $data['noti'] = $this->notification->getNotificationCount($user_id);

        $viewdata = $this->user->getTopThree(1);
        
        $views['steps'] = $this->load->view('leaderboards/steps', $viewdata, true);
        
        $body['menu'   ] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('leaderboards', $views, true);

        $this->load->view('header');
        $this->load->view('body', $body);
    }
  
    public function famehall() {
		$query = $this->db->get('user');
		$data = $this->user->getSessionData();
		$data['title'] = 'Xiphias | Hall of Fame';
		$user_id = $this->session->userdata('user_id');
		$data['noti'] = $this->notification->getNotificationCount($user_id);
		$viewdata = $this->hallOfFame->getHallOfFame();
		for($i = 0; $i < count($viewdata); $i++)
			$views['fameitem'] .= $this->load->view('famehall/fameitem', $viewdata[$i], true);

		$body['menu'] = $this->load->view('menu', $data, true);
		$body['content'] = $this->load->view('famehall', $views, true);

		$this->load->view('header');
		$this->load->view('body', $body);
    }
  
    public function changeTopThree() {
        $type = $this->input->post('quest_type');
        $viewdata = $this->user->getTopThree($type);
        $view = $this->load->view('leaderboards/steps', $viewdata, true);
      
        echo $view;
    }
    
    public function updateProfile() {
        $user_id = $this->session->userdata('user_id');
        $program['program_code'] = $this->input->post('program_code');
        $data['description'] = $this->input->post('description');
        $this->user->updateProgramCode($user_id, $program);
        $this->user->updateDescription($user_id, $data);
    }
    
    public function dashboard() {
        $query = $this->db->get('user');

        $data = $this->user->getSessionData();  
        $data['title'] =  "Xiphias | Dashboard";
		$user_id = $this->session->userdata('user_id');
		$data['noti'] = $this->notification->getNotificationCount($user_id);
        $user_id = $this->session->userdata('user_id');

        // Badges
        $myBadges = $this->badge->getMyBadges($user_id);
        for($x = 0; $x < count($myBadges); $x++) {
          $badges['mybadges'   ] .= $this->load->view('dashboard/mybadges', $myBadges[$x], true);
          $quest['badgeRewards'] .= $this->load->view('dashboard/badgeRewards', $badgeRewards[$x], true);
        }

        // Quests
        $myQuests = $this->quest->getMyQuests($user_id);
        for($x = 0; $x < count($myQuests); $x++)
          $quest['myQuests'] .= $this->load->view('dashboard/myquests', $myQuests[$x], true);

        $rarities = $this->quest->getRarityInfo();
        for($x = 0; $x < count($rarities); $x++)
        	$quest['questRarities'] .= $this->load->view('dashboard/questRarity.php', $rarities[$x], true);
        $quest['rare'] = count($rarities);

        // Parties
        $myParties = $this->party->getMyParties($user_id);
        for($x = 0; $x < count($myParties); $x++)
        	$party['myParties'] .= $this->load->view('dashboard/myparties', $myParties[$x], true);

        // Offices
        $myOffices = $this->office->getMyOffices($user_id);
        for($x = 0; $x < count($myOffices); $x++)
            $office['myOffices'] .= $this->load->view('dashboard/myoffices', $myOffices[$x], true);

		// Semestral Award
		// @kelly
		// *date*
		$semaward['started'  ] = $this->semester->isStarted();
		$semaward['startdate'] = date("F j, Y", strtotime($this->semester->getStartDate()));
	  	
	  	$notif['notif'] = $this->notification->getNotifications($user_id);	
	  
        $views['error'            ] = $this->load->view('warningAndErrors/UnverifiedNPC', $data, true);
        $views['dashboardMenu'    ] = $this->load->view('dashboard/dashboardMenu', $data, true);
        $views['dashboardBadge'   ] = $this->load->view('dashboard/dashboardBadge', $badges, true);
        $views['dashboardQuest'   ] = $this->load->view('dashboard/dashboardQuest', $quest, true);
        $views['dashboardParty'   ] = $this->load->view('dashboard/dashboardParty', $party, true);
        $views['dashboardOffice'  ] = $this->load->view('dashboard/dashboardOffice', $office, true);
        $views['dashboardSerial'  ] = $this->load->view('dashboard/dashboardSerial', $data, true);
        $views['dashboardNoti'    ] = $this->load->view('dashboard/dashboardNoti', $notif, true);
		$views['dashboardSemAward']	= $this->load->view('dashboard/dashboardSemAward', $semaward, true);

        $body['menu'] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('dashboard', $views, true);

        $this->load->view('header');
        $this->load->view('body', $body);
    }

    public function getAwardingBadge() {
        $activeBadge = $this->input->post('badge_id');
        $user_id = $this->session->userdata('user_id');
        $myBadges = $this->badge->getMyBadges($user_id);
        for($x = 0; $x < count($myBadges); $x++) {
            $myBadges[$x]['active'] = $activeBadge;
            $badges['mybadges'] .= $this->load->view('dashboard/mybadges', $myBadges[$x], true);
        }
        echo $badges['mybadges'];
    }

    public function getEmptyUpgrade() {
        $badge_id = $this->input->post('badge_id');

        if($badge_id == 0)
            $badge['imageSource'] = base_url('assets/images/emptyBadge.png');

        $this->load->view('dashboard/badgeUpgrade.php', $badge);
    }
    
    public function addBadge() {
        $badgeName        = $this->input->post('txtBadgeName');
        $badgeDescription = $this->input->post('txtaBadgeDescription');
        $badgeRequirement = $this->input->post('txtRequirement');
        $badgePictures    = $_FILES['badge-pix'];
        
        $badge['badge_description'] = $badgeDescription;
        $badge['creator_id'       ] = $this->session->userdata('user_id');
        $badge['date_created'     ] = date('Y-m-d');
        
        $badgeId = $this->badge->addBadge($badge);
        $upgradesCount = count($badgeName);
        if(!file_exists('c:/Apache24/htdocs/xiphias/assets/images/badges'))
             mkdir('c:/Apache24/htdocs/xiphias/assets/images/badges', 0777, true);
        for($x = 1; $x <= $upgradesCount; $x++){
            $ext = pathinfo($badgePictures['name'][$x-1], PATHINFO_EXTENSION);
            $newfilename = "badge".$badgeId."_".$x.".".$ext;
            $filePath = "c:/Apache24/htdocs/xiphias/assets/images/badges/" . $newfilename;
            
            move_uploaded_file($badgePictures['tmp_name'][$x-1], $filePath);
            $badge_ups['badge_ups_id'  ] = $badgeId;
            $badge_ups['badge_ups_name'] = $badgeName[$x-1];
            $badge_ups['badge_ups_lvl' ] = $x;
            $badge_ups['badge_ups_pix' ] = 'assets/images/badges/' . $newfilename;
            if($x != 1)
                $badge_ups['requirement'] = $badgeRequirement[$x-2];
            else
                $badge_ups['requirement'] = 1;
            $this->badge->addBadgeUpgrade($badge_ups);
        }
        
        $user_id = $this->session->userdata('user_id');
        $myBadges = $this->badge->getMyBadges($user_id);
      
        for($x = 0; $x < count($myBadges); $x++)
            $badgeRefresh .= $this->load->view('dashboard/mybadges', $myBadges[$x], TRUE);
    
        echo $badgeRefresh;
    }
  
    public function addQuest() {
        $time = explode(' ', $this->input->post('date-range'));
        $quest['quest_title'      ] = $this->input->post('questName');
        $quest['quest_description'] = $this->input->post('questDescription');
        $quest['quest_rarity'     ] = $this->input->post('quest_frequency');
        $quest['date_created'     ] = date('Y-m-d');
        $quest['start_date'       ] = date('Y-m-d', strtotime($time[0]));
        $quest['end_date'         ] = date('Y-m-d', strtotime($time[2]));
        $quest['experience'       ] = 1;
        $quest['venue'            ] = $this->input->post('questVenue');
        $quest['quest_type'       ] = $this->input->post('quest_type');
        $quest['house_points'     ] = 1;
        $quest['creator_id'       ] = $this->session->userdata('user_id');
        
        $badge_id = $this->input->post('badge_id');
        if($badge_id != -1)
            $quest['badge_id'] = $badge_id;
      
        $this->quest->addQuest($quest);
        
        $user_id = $this->session->userdata('user_id');
        $myQuests = $this->quest->getMyQuests($user_id);
    
        for($x = 0; $x < count($myQuests); $x++)
            $questRefresh .= $this->load->view('dashboard/myquests', $myQuests[$x], TRUE);
        echo $questRefresh;
    }
  
    public function addParty() {
        $party['creator_id'       ] = $this->session->userdata('user_id');
        $party['party_name'       ] = $this->input->post('partyName');
        $party['party_description'] = $this->input->post('partyDescription');
        $party['party_password'   ] = md5($this->input->post('partyPasscode'));
        $this->party->addParty($party);
        
        $user_id = $this->session->userdata('user_id');
        $myParties = $this->party->getMyParties($user_id);
      
        for($x = 0; $x < count($myParties); $x++)
            $partyRefresh .= $this->load->view('dashboard/myparties', $myParties[$x], TRUE);
        echo $partyRefresh;
    }
  
    public function addOffice() {
        $office['office_name'        ] = $this->input->post('officeLongName');
        $office['office_abbreviation'] = $this->input->post('officeShortName');
        $office['office_description' ] = $this->input->post('officeDescription');
        $office['user_id'            ] = $this->session->userdata('user_id');
        $officeId = $this->office->addOffice($office);
         
        $officeLogo = $_FILES['office-pix'];
        
        if(!file_exists('c:/Apache24/htdocs/xiphias/assets/images/offices'))
             mkdir('c:/Apache24/htdocs/xiphias/assets/images/offices', 0777, true);
        
        $ext = pathinfo($officeLogo['name'], PATHINFO_EXTENSION);
        $newfilename = "office".$officeId.".".$ext;
        $filePath = "c:/Apache24/htdocs/xiphias/assets/images/offices/" . $newfilename;
        move_uploaded_file($officeLogo['tmp_name'], $filePath);
        $logo['office_logo'] = "assets/images/offices/" . $newfilename;
        $this->office->updateLogo($officeId, $logo);
        
        $user_id = $this->session->userdata('user_id');
        $myOffices = $this->office->getMyOffices($user_id);
      
        for($x = 0; $x < count($myOffices); $x++)
            $officeRefresh .= $this->load->view('dashboard/myoffices', $myOffices[$x], TRUE);
        echo $officeRefresh;
    }
    
    public function checkVerification() {
        $vcode = $this->input->post('verificationCode');
        $username = $this->session->userdata('username');
        if($this->user->verify($vcode, $username)){
            $data['isVerified'] = true;
            $this->session->set_userdata($data);
            echo "ok";   
        }
        else
            echo "failed";
    }
    
    public function generateSerial(){
        $username = $this->db->escape_str($this->input->post('npcID'));
        echo $this->user->getSerial($username);
    }
    
    public function awardReward() {
        $questId    = $this->input->post('quest_id');
        $badgeId    = $this->quest->getBadgeReward($questId);
        $memberId   = $this->input->post('qRegID');
        $housePoint = $this->quest->getHousePoints($questId);
        $experience = $this->quest->getQuestExp($questId);
        $memberCount = count($memberId);
        $success = "";
        for($x = 0; $x < $memberCount; $x++){
            if(!$this->quest->doneAwarding($questId, $memberId[$x])) {
                $houseId = $this->user->getHouseId($memberId[$x]);
                $this->house->awardHousePoint($houseId, $housePoint);
                $this->quest->completeQuest($questId, $memberId[$x]);
                
                $event['username'   ] = $this->user->getUsername($memberId[$x]);
                $event['description'] = 'completed "' . $this->quest->getQuestTitle($questId) . '"';
                $event['date'       ] = date("F j, Y, g:i a");
                
                $first_name = $this->user->getFirstName($memberId[$x]);
                $linkData['description'] = 'This is a sample description for a sample facebook post.';
                $linkData['picture'    ] = 'http://foursquareguru.com/media/badges/apple_big.png';
                $linkData['name'       ] = $first_name . ' ' . $event['description'];
                if($badgeId != false){
                    $data['user_id'    ] = $memberId[$x];
                    $data['badge_id'   ] = $badgeId;
                    $data['date_earned'] = date('Y-m-d');
                    $this->user->awardBadge($data);
                    $event['description'] .= ' and earned a "' . $this->badge->getBadgeName($badgeId, 1) . '"';
                    $linkData['name']      = $first_name . ' ' . $event['description'];
                }
                $linkData['name'] .= ' | XIPHIAS';
                if($this->fbauthorization->hasAccessToken($memberId[$x])) {
                    $accessToken = $this->fbauthorization->getAccessTokens($memberId[$x]);
                    $this->facebook->batchPost($accessToken, $linkData);
                }
                $this->event->addEvent($event);
                $success = $this->load->view('index/streamItem', $event, true) . $success;
                $success = $this->user->awardExperience($memberId[$x], $experience) . $success;
            }
        }
        echo $success;
    }
    
    public function changePasscode(){
        $partyId = $this->input->post('party_id');
        $data['party_password'] = md5($this->input->post('passcode'));
        $this->party->changePassword($partyId, $data);
    }
  
    public function accountRegistration() {
        $data = array (
            'first_name'  => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name'   => $this->input->post('last_name'),
            'username'    => $this->input->post('username'),
            'password'    => md5($this->input->post('password')),
            'user_type'   => $this->input->post('user_type')
        );
        $user_id = $this->user->addUser($data);
        if($data['user_type'] == 1){
            $player['player_level'] = 1;
            $player['experience'  ] = 0;
            $player['house_id'    ] = $this->user->assignHouse();
            $player['user_id'     ] = $user_id;
            $dataPass['house'     ] = $this->house->getHouseInfo($player['house_id']);
            $this->user->addPlayer($player);
        } else {
            $npc['user_id'    ] = $user_id;
            $npc['is_verified'] = 0;
            $this->user->addNPC($npc);
        }
        if($data['user_type'] == 1)
            $dataPass['isPlayer'] = true;
        else
            $dataPass['isPlayer'] = false;
        $nextPanel = $this->load->view('register/lastPanel', $dataPass, true);
        echo $nextPanel;
    }
    
    public function questRegistration() {
        $data['user_id'        ] = $this->session->userdata('user_id');
        $data['quest_id'       ] = $this->input->post('quest_id');
        $data['date_registered'] = date('Y-m-d');
        $this->quest->register($data);
        
        $event['username'   ] = $this->user->getUsername($data['user_id']);
        $event['description'] = 'joined ' . $this->quest->getQuestTitle($data['quest_id']);
        $event['date'       ] = date("F j, Y, g:i a");
        $this->event->addEvent($event);
        echo $this->load->view('index/streamItem', $event, true);
    }
  
    public function questAbort() {
        $quest_id = $this->input->post('quest_id');
        $user_id  = $this->session->userdata('user_id');
        $this->quest->abortQuest($quest_id, $user_id);
        
        $event['username'   ] = $this->user->getUsername($user_id);
        $event['description'] = 'quits ' . $this->quest->getQuestTitle($quest_id);
        $event['date'       ] = date("F j, Y, g:i a");
        $this->event->addEvent($event);
        echo $this->load->view('index/streamItem', $event, true);
    }
    
    public function getAllPrograms() {
      $query = $this->course->getCourses();
      $options = "<option value=\"0\" disabled selected>Select your course</option>\n";
      foreach ($query->result() as $row) 
          $options .= "<option value = \"$row->program_code\">$row->program_name</option>\n";
      return $options;
    }
    
    public function getLiveEvents() {
        echo json_encode($this->event->getLiveEvents());
    }
    
    public function changePassword() {
        $user_id     = $this->session->userdata('user_id');
        $old_pass    = $this->input->post('old-pass');
        $new_pass    = $this->input->post('new-pass');
        $re_new_pass = $this->input->post('re-new-pass');
        if($this->user->passwordMatched($user_id ,$old_pass) && $new_pass == $re_new_pass)
            $this->user->changePassword($user_id, $new_pass);
        redirect(base_url('index.php/pages/settings'));
    }
    
    public function connectToFacebook(){
        require_once(__DIR__ . '/facebook-sdk-v5/autoload.php');
        $fb = new Facebook\Facebook([
            'app_id' => '',
            'app_secret' => '',
            'default_graph_version' => 'v2.3',
        ]);
        $u_id = $this->session->userdata('user_id');
        $this->db->where('user_id',$uid);
        $query = $this->db->get('access_token');
        if($query->num_rows()==0){
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['public_profile,email,publish_actions,user_birthday'];
            $loginUrl = $helper->getLoginUrl('http://localhost/xiphias/',$permissions);
        }
    }
  
  
  // facebook functions
  // Note:  Some of these are not really used in the system
  //        But used as testing the library modules
	public function FB_link() {
		$login_url = $this->facebook->loginUrl();
		echo $login_url;
	}
  
	public function FB_getAccessToken($memberId) {
		$members[] = $memberId;
		$accesstoken = $this->fbauthorization->getAccessTokens($members);
		foreach($accesstoken as $toks) {
			echo $toks;
		}
	}
  
	public function FB_exchangeToken() {
		$fbSet = $this->facebook->exchangeToken();
		$fbSet['user_id'] = $this->session->userdata('user_id');
		$this->fbauthorization->addAccessToken($fbSet);
	}
  
	public function FB_batchPost() {
		$this->facebook->batchPost();
	}

	public function getOfficeMembers($office_id) {
        $data = $this->officeRole->getOfficeMembers($office_id);
		echo json_encode($data);
	}

	// @KELLY
	// semestral awards
	// no post inputs.. just use the current time of for startsem
	public function startsem() {
		// get current datetime and put in database
		// reset house rankings
        $this->house->resetHousePoints();
		$this->semester->start();
		echo "date";
	}

	public function stopSem() {
		// get current datetime and put in database
		// finalize house rankings by double-checking the exp accumulated by each houses between the start and stop date
		// put in hall of fame
        $data['description'] = "SY Year-(Year+1) nth Semester";
        $hof_id = $this->hallOfFame->addHallOfFameEntry($data);
        $this->ranking->addRankingsEntry($hof_id);
		$this->semester->stop();
		// don't reset house rankings
		// ^this is so that users can still see the previous ranking without going to the hall of fame
	}
  
  	public function addRoleMember() {
		$user_name = $this->input->post('username');
		$role = $this->input->post('role');
		$data['approved'        ] = false;
		$data['user_id'         ] = $this->user->getUserId($user_name);
		$data['office_id'       ] = $this->input->post('officeid');
		$data['role'            ] = $role;
		$data['quest_permission'] = 0;
		$data['badge_permission'] = 0;
		$retdata['url'          ] = $data['office_id'];
		if(!$this->user->validUsername($user_name) || !$this->user->isNPC($data['user_id']))
			$retdata['ok']  = 1;
		else if($this->office->isInvited($data['office_id'], $data['user_id']))
			$retdata['ok']  = 2;
		else {
			$this->officeRole->addRoleMember($data);
		  	$notif['noti_from'] = $this->session->userdata('user_id');
			$notif['noti_to'  ] = $data['user_id'];
			$notif['noti_type'] = 1;
			$notif['office_id'] = $data['office_id'];
		  	$notif['noti_date'] = date('Y-m-d');
		  	$this->notification->addNotification($notif);
		  
		  	$retdata['from'       ] = $this->user->getUsername($notif['noti_from']);
		  	$retdata['office_name'] = $this->office->getOfficeName($notif['office_id']);
		  	$retdata['noti_type'  ] = 1;
		  	$retdata['noti_date'  ] = date("F j, Y", strtotime($notif['noti_date']));
			$retdata['to_id'      ] = $data['user_id'];
			$retdata['from_id'    ] = $notif['noti_from'];
			$retdata['ok'         ] = 0;
		}
		echo json_encode($retdata);
  	}
		
	public function passLeadership() {
		$username = $this->input->post('username');
		$user_id = $this->user->getUserId($username);
		$office_id = $this->input->post('officeid');
		$data['user_id'  ] = $user_id;
		$data['office_id'] = $office_id;
		
		$retdata['url'] = $data['office_id'];
		if(!$this->user->validUsername($username) || !$this->user->isNPC($data['user_id'])) {
			$retdata['ok']  = 1;
		} else if ($this->office->isInvitedasAdmin($data['office_id'], $data['user_id'])){
			$retdata['ok']  = 2;
		} else {
			$data['approved'        ] = false;
			$data['role'            ] = 'Admin';
			$data['quest_permission'] = 1;
			$data['badge_permission'] = 1;
			$this->officeRole->addRoleMember($data);

			$notif['noti_from'] = $this->session->userdata('user_id');
			$notif['noti_to'  ] = $user_id;
			$notif['noti_type'] = 4;
			$notif['office_id'] = $office_id;
			$notif['noti_date'] = date('Y-m-d');
			$this->notification->addNotification($notif);
			
			$retdata['from'       ] = $this->user->getUsername($notif['noti_from']);
		  	$retdata['office_name'] = $this->office->getOfficeName($notif['office_id']);
		  	$retdata['noti_type'  ] = 4;
		  	$retdata['noti_date'  ] = date("F j, Y", strtotime($notif['noti_date']));
			$retdata['to_id'      ] = $data['user_id'];
			$retdata['from_id'    ] = $notif['noti_from'];
			$retdata['ok'         ] = 0;
		}
		echo json_encode($retdata);
	}
		
	public function debug() {
		echo json_encode($this->involvement->getInvolvements($this->session->userdata('user_id')));
	}
	
    // function for generating resume
	public function resume(){
		$u_id = $this->session->userdata('user_id');
		$info['address'           ] = $this->input->post('address');
		$info['contact'           ] = $this->input->post('contact');
		$info['emailadd'          ] = $this->input->post('emailadd');
		$info['primary_school'    ] = $this->input->post('pschool');
		$info['primary_school_s'  ] = $this->input->post('pstart');
		$info['primary_school_e'  ] = $this->input->post('pend');
		$info['secondary_school'  ] = $this->input->post('sschool');
		$info['secondary_school_s'] = $this->input->post('sstart');
		$info['secondary_school_e'] = $this->input->post('send');
		
		$user['home_address' ] = $info['address'];
		$user['phone_number' ] = $info['contact'];
		$user['email_address'] = $info['emailadd'];
		$this->user->updateProfile($u_id, $user);
		
		$this->school->clearData($u_id);
		$school['school_id' ] = $info['primary_school'];
		$school['start_date'] = $info['primary_school_s'];
		$school['end_date'  ] = $info['primary_school_e'];
		$school['user_id'   ] = $u_id;
		$this->school->addSchoolAttended($school);
		$school['school_id' ] = $info['secondary_school'];
		$school['start_date'] = $info['secondary_school_s'];
		$school['end_date'  ] = $info['secondary_school_e'];
		$school['user_id'   ] = $u_id;
		$this->school->addSchoolAttended($school);
		
		$info['primary_school'  ] = $this->school->getSchoolName($info['primary_school'  ]);
		$info['secondary_school'] = $this->school->getSchoolName($info['secondary_school']);
		$info['objective'       ] = $this->input->post('objective');
		$obj['career_objectives'] = $info['objective'];
		$this->user->updateCareerObj($u_id, $obj);

		$info['fullname']  = $this->user->getFirstName($u_id);
		$info['fullname'] .= " " . $this->user->getMiddleName($u_id)[0];
		$info['fullname'] .= ". " . $this->user->getLastName($u_id);

		$info['affiliations'] = $this->affiliation->getAffiliations($u_id);
		$info['involvement' ] = $this->involvement->getInvolvements($u_id);
			
		$data = $this->load->view('resume', $info, true);
		$this->htmlpdf->convert($data);
	}
		
	public function addAffiliation() {
		$time = explode(' ', $this->input->post('date'));
		$data['user_id'       ] = $this->session->userdata('user_id');
		$data['affiliation'   ] = $this->input->post('name');
		$data['position'      ] = $this->input->post('position');
		$data['start_date'    ] = date('Y-m-d', strtotime($time[0]));
		$data['end_date'      ] = date('Y-m-d', strtotime($time[2]));
		$this->affiliation->addAffiliation($data);
	}
		
	public function addInvolvement() {
		$time = explode(' ', $this->input->post('date'));
		$data['user_id'          ] = $this->session->userdata('user_id');
		$data['involvement_name' ] = $this->input->post('name');
		$data['involvement_venue'] = $this->input->post('venue');
		$data['start_date'       ] = date('Y-m-d', strtotime($time[0]));
		$data['end_date'         ] = date('Y-m-d', strtotime($time[2]));
		$this->involvement->addInvolvement($data);
		echo $data['involvement_name'];
	}
		
	public function getAffilJson() {
		echo json_encode($this->affiliation->getAffiliations($this->session->userdata('user_id')));
	}
		
	public function getInvolvementJson() {
		echo json_encode($this->involvement->getInvolvements($this->session->userdata('user_id')));		
	}

	public function confirmRole() {
		$office_id = $this->input->post('office_id');
		$from = $this->input->post('user_id');
	  	$user_id = $this->session->userdata('user_id');
	  	$this->officeRole->confirmRole($office_id, $user_id);
		
		$notif['noti_from'] = $this->session->userdata('user_id');
		$notif['noti_to'  ] = $this->user->getUserId($from);
		$notif['noti_type'] = 2;
		$notif['office_id'] = $office_id;
		$notif['noti_date'] = date('Y-m-d');
		$this->notification->addNotification($notif); 
	}
  
	public function declineRole() {
	  	$office_id = $this->input->post('office_id');
	  	$user_id = $this->session->userdata('user_id');
		$from = $this->input->post('from');
	  	$this->officeRole->declineRole($office_id, $user_id);
		
		$notif['noti_from'] = $this->session->userdata('user_id');
		$notif['noti_to'  ] = $this->user->getUserId($from);
		$notif['noti_type'] = 3;
		$notif['office_id'] = $office_id;
		$notif['noti_date'] = date('Y-m-d');
		$this->notification->addNotification($notif); 
	}
	
	public function deleteRole() {
		$office_id = $this->input->post('office_id');
		$user_id = $this->input->post('user_id');
		$this->officeRole->deleteRole($office_id, $user_id);
	}
	
	public function confirmLeaderShip() {
		$office_id = $this->input->post('office_id');
		$user_id = $this->session->userdata('user_id');
		$this->officeRole->confirmLeaderShip($office_id, $user_id);
	}
	
	public function declineLeadership() {
		$office_id = $this->input->post('office_id');
		$user_id = $this->session->userdata('user_id');
		$this->officeRole->declineLeadership($office_id, $user_id);
	}
	
	public function alterBadgePermission() {
		$user_id = $this->input->post('userid');
		$office_id = $this->input->post('officeid');
		$role = $this->input->post('role');
		$this->officeRole->alterBadgePermission($office_id, $user_id, $role);
	}
	
	public function alterQuestPermission() {
		$user_id = $this->input->post('userid');
		$office_id = $this->input->post('officeid');
		$role = $this->input->post('role');
		$this->officeRole->alterQuestPermission($office_id, $user_id, $role);	
	}
}
