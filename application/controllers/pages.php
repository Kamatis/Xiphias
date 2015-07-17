<?php 

// just to make some things work while views@php are at work
// comment when working on this php file
error_reporting(0);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function index() {
        if($this->session->userdata('is_logged_in')){
            $data = $this->user->getSessionData();
            $data['title']      = 'Xiphias | Home';
            
            $views['carousel'] = $this->load->view('index/carousel', '', true);
          
            $body['menu']    = $this->load->view('menu', $data, true);
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
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php');
    }
  
    public function editProfile() {
      $query = $this->course->getCourses();
      $data['programs'] = "<option value=\"0\" disabled selected>Select your course</option>\n";
      foreach ($query->result() as $row) 
          $data['programs'] .= "<option value = \"$row->program_code\">$row->program_name</option>\n";
        
      for($yr = 2015; $yr>=1900; $yr--)
        $data['years'] .= "<option value = \"$yr\">$yr</option>\n";
      
          
      $view = $this->load->view('profile/editProfile', $data , true);
      echo $view;
    }
  
    public function createResume() {
      $query1 = $this->school->getSchools(1);
      $query2 = $this->school->getSchools(2);
      
      $data['primary'] = "<option></option>\n";
      foreach($query1->result() as $row)
          $data['primary'] .= "<option value = \"$row->school_id\">$row->school_name</option>\n";
      
      $data['secondary'] = "<option></option>\n";
      foreach($query2->result() as $row)
          $data['secondary'] .= "<option value = \"$row->school_id\">$row->school_name</option>\n";
      
      for($yr = 2015; $yr>=1900; $yr--)
        $data['years'] .= "<option value = \"$yr\">$yr</option>\n";
      
      $view = $this->load->view('profile/createResume', $data , true);
      echo $view;
    }
  
    public function showAddAffiliation() {
      $data['affiliations'] .= '<option></option>'; // always include this as first in the <option> list (don't delete)
      
      //      iterate all affiliations to be put to $data with format:
//      $data['affiliations'] .= '<option value= [affil_id] >[affil_name]</option>';
      $data['affiliations'] .= '<option>TACTICS</option>';  //sample only (can be deleted after)
      $data['affiliations'] .= '<option>GROUPIE</option>';  //sample only (can be deleted after)
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
    $data['title']      = $username . "@Xiphias";

    $description = $this->user->getDescription($user_profile['user_id']);
    $description['isOwner'] = ($data['username'] == $username);
    
    if($user_profile['isNPC'])
        $badges['badge'] = $this->badge->getMyBadges($user_profile['user_id']);
    else
        $badges['badge'] = $this->badge->getEarnedBadges($user_profile['user_id']);
    
    $views['profileInfo']         = $this->load->view('profile/profileInfo', $user_profile, true);
    $views['profileDescription']  = $this->load->view('profile/profileDescription', $description, true);
    $views['profileBadges']       = $this->load->view('profile/profileBadges', $badges, true);
    $views['profileTimeline']     = $this->load->view('profile/profileTimeline', '', true);

    // views in <body>
    $body['menu'] = $this->load->view('menu', $data, true);
    $body['content'] = $this->load->view('profile', $views, true);

    // Main views inserted in <html>
    $this->load->view('header');
    $this->load->view('body', $body);
    }

    public function settings() {
        $user_profile = $this->user->getUserInfo($username);

        $data = $this->user->getSessionData();
        $data['title']      = $username . "@Xiphias";

        $body['menu'] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('settings', '', true);

        // Main views inserted in <html>
        $this->load->view('header');
        $this->load->view('body', $body);
    }

    public function questboard() {
        $query = $this->db->get('user');
        $data = $this->user->getSessionData();
        $data['title'] = 'Quest Board';


        $quests = $this->quest->getAllQuests();
        
        // this should be iterated to get the quest data to be pushed to the view
        $questCount = count($quests);
        for($x = 0; $x < $questCount; $x++)
        {
          $quests[$x]['isNPC'] = $data['isNPC'];
          $views['questpins'] .= $this->load->view('questboard/questpin', $quests[$x], true);
        }
            

        $body['menu'] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('questboard', $views, true);

        $this->load->view('header');
        $this->load->view('body', $body);
    }

    public function leaderboards() {
        $query = $this->db->get('user');

        $data = $this->user->getSessionData();
        $data['title'] =  'Quest Board';

        $body['menu'] = $this->load->view('menu', $data, true);
        $body['content'] = $this->load->view('leaderboards', $views, true);

        $this->load->view('header');
        $this->load->view('body', $body);
    }

    public function dashboard() {
        $query = $this->db->get('user');

        $data = $this->user->getSessionData();  
        $data['title'] =  $this->session->userdata('username') . "@Xiphias";

        $user_id = $this->session->userdata('user_id');

        // Badges
        $myBadges = $this->badge->getMyBadges($user_id);
        for($x = 0; $x < count($myBadges); $x++)
          $badges['mybadges'] .= $this->load->view('dashboard/mybadges', $myBadges[$x], true);

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

        $views['error'] = $this->load->view('warningAndErrors/UnverifiedNPC', $data, true);
        $views['dashboardMenu']   = $this->load->view('dashboard/dashboardMenu', $data, true);
        $views['dashboardBadge']  = $this->load->view('dashboard/dashboardBadge', $badges, true);
        $views['dashboardQuest']  = $this->load->view('dashboard/dashboardQuest', $quest, true);
        $views['dashboardParty']  = $this->load->view('dashboard/dashboardParty', $party, true);
        $views['dashboardOffice'] = $this->load->view('dashboard/dashboardOffice', $office, true);
        $views['dashboardSerial'] = $this->load->view('dashboard/dashboardSerial', $data, true);

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
        $badge['creator_id']        = $this->session->userdata('user_id');
        $badge['date_created']      = date('Y-m-d');
        
        $badgeId = $this->badge->addBadge($badge);
        $upgradesCount = count($badgeName);
        if(!file_exists($_SERVER['DOCUMENT_ROOT'] . 'xiphias/assets/images/badges'))
             mkdir($_SERVER['DOCUMENT_ROOT'] . 'xiphias/assets/images/badges', 0777, true);
        for($x = 1; $x <= $upgradesCount; $x++){
            $ext = pathinfo($badgePictures['name'][$x-1], PATHINFO_EXTENSION);
            $newfilename = "badge".$badgeId."_".$x.".".$ext;
            $filePath = $_SERVER['DOCUMENT_ROOT'] . "xiphias/assets/images/badges/" . $newfilename;
            
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
        $quest['quest_title']       = $this->input->post('questName');
        $quest['quest_description'] = $this->input->post('questDescription');
        $quest['quest_rarity']      = $this->input->post('rarity');
        $quest['date_created']      = date('Y-m-d');
        $quest['start_date']        = date('Y-m-d', strtotime($time[0]));
        $quest['end_date']          = date('Y-m-d', strtotime($time[2]));
        $quest['experience']        = $this->input->post('range');
        $quest['venue']             = $this->input->post('questVenue');
        $quest['quest_type']        = "Academic";
        $quest['house_points']      = 1;
        $quest['badge_id']          = $this->input->post('badge_id');
        $quest['creator_id']        = $this->session->userdata('user_id');
        $this->quest->addQuest($quest);
        
        $user_id = $this->session->userdata('user_id');
        $myQuests = $this->quest->getMyQuests($user_id);
      
        for($x = 0; $x < count($myQuests); $x++)
            $questRefresh .= $this->load->view('dashboard/myquests', $myQuests[$x], TRUE);
        echo $questRefresh;
    }
  
    public function addParty() {
        $party['creator_id']        = $this->session->userdata('user_id');
        $party['party_name']        = $this->input->post('partyName');
        $party['party_description'] = $this->input->post('partyDescription');
        $party['party_password']    = md5($this->input->post('partyPasscode'));
        $this->party->addParty($party);
        
        $user_id = $this->session->userdata('user_id');
        $myParties = $this->party->getMyParties($user_id);
      
        for($x = 0; $x < count($myParties); $x++)
            $partyRefresh .= $this->load->view('dashboard/myparties', $myParties[$x], TRUE);
        echo $partyRefresh;
    }
  
    public function addOffice() {
        $office['office_name']         = $this->input->post('officeName');
        $office['office_abbreviation'] = "HELLO"; // $this->input->post('txtShortForm');
        $office['office_description']  = $this->input->post('officeDescription');
        $office['user_id'] = $this->session->userdata('user_id');
        $officeId = $this->office->addOffice($office);
         
        $officeLogo = $_FILES['office-pix'];
        
        if(!file_exists($_SERVER['DOCUMENT_ROOT'] . 'xiphias/assets/images/offices'))
             mkdir($_SERVER['DOCUMENT_ROOT'] . 'xiphias/assets/images/offices', 0777, true);
        
        $ext = pathinfo($officeLogo['name'], PATHINFO_EXTENSION);
        $newfilename = "office".$officeId.".".$ext;
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "xiphias/assets/images/offices/" . $newfilename;
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
    
    public function awardBadge() {
        $questId    = 1; //$this->input->post('quest_id');
        $badgeId    = $this->input->post('badge_id');
        $memberId   = $this->input->post('qRegID');
        $housePoint = 1; //$this->input->post('house_point');
        $experience = 2; // $this->input->post('experience');
        
        $memberCount = count($memberId);
        for($x = 0; $x < $memberCount; $x++){
            // update house point
            $houseId = $this->user->getHouseId($memberId[$x]);
            $this->house->awardHousePoint($houseId, $housePoint);
            
            // update player experience
            $this->user->awardExperience($memberId[$x], $experience);
            
            // award badge
            if(!$this->quest->doneAwarding($questId, $memberId[$x])){
                $data['user_id'] = $memberId[$x];
                $data['badge_id'] = $badgeId;
                $data['date_earned'] = date('Y-m-d');
                $this->user->awardBadge($data);
            }
        }
    }
    
    public function changePartyPassword(){
        $partyId = $this->input->post('party_id');
        $data['party_password'] = $this->input->post('new_password');
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
            $player['experience']   = 0;
            $player['house_id']     = $this->user->assignHouse();
            $player['user_id']      = $user_id;
            $dataPass['house'] = $this->house->getHouseInfo($player['house_id']);
            $this->user->addPlayer($player);
        } else {
            $npc['user_id']     = $user_id;
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
        $data['user_id']  = $this->session->userdata('user_id');
        $data['quest_id'] = $this->input->post('quest_id');
        $data['date_registered'] = date('Y-m-d');
        $this->quest->register($data);
    }
  
    public function questAbort() {
        $quest_id = $this->input->post('quest_id');
        $user_id  = $this->session->userdata('user_id');
        $this->quest->abortQuest($quest_id, $user_id);  
    }
    
    public function getAllPrograms() {
      $query = $this->course->getCourses();
      $options = "<option value=\"0\" disabled selected>Select your course</option>\n";
      foreach ($query->result() as $row) 
          $options .= "<option value = \"$row->program_code\">$row->program_name</option>\n";
      return $options;
    }
}
