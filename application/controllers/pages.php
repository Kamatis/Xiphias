<?php 

// just to make some things work while views@php are at work
// comment when working on this php file
error_reporting(0);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function index() {
        if($this->session->userdata('is_logged_in')){
            $query = $this->db->get('user');
            $data['title']      = 'Xiphias | Home';
            $data['user_image'] = $this->session->userdata('image');
            $data['username']   = $this->session->userdata('username');
            $data['isNPC']      = $this->session->userdata('isNPC');
            $data['isAdmin']    = $this->session->userdata('isAdmin');
            $data['isVerified'] = $this->session->userdata('isVerified');
            
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
  
  public function profile($username) {
    // Data fields
    $user_profile = $this->user->getUserInfo($username);
    
    $data['title']      = $username . "@Xiphias";
    $data['user_image'] = $this->session->userdata('image');
    $data['username']   = $this->session->userdata('username');
    $data['isNPC']      = $this->session->userdata('isNPC');
    $data['isAdmin']    = $this->session->userdata('isAdmin');
    $data['isVerified'] = $this->session->userdata('isVerified');
    
    $description = $this->user->getDescription($user_profile['user_id']);
    $badges['badge'] = $this->badge->getMyBadges($user_profile['user_id']);
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
  
  public function dashboard() {
    $query = $this->db->get('user');
    $data['title'] =  $this->session->userdata('username') . "@Xiphias";
    $data['user_image'] = $this->session->userdata('image');
    $data['username']   = $this->session->userdata('username');
    $data['isNPC']      = $this->session->userdata('isNPC');
    $data['isAdmin']    = $this->session->userdata('isAdmin');
    $data['isVerified'] = $this->session->userdata('isVerified');

    $data['offices'][0] = "Ateneo Coders' Circle";
    $data['offices'][1] = "TACTICS";
    
//    $data['firstname'] = "Matthew Allan";
//    $data['middlename'] = "Atienza";
//    $data['lastname'] = "Rosales";
//    $data['name'] = $data['firstname'] . " " .    $data['middlename'][0] . ". " . $data['lastname'];
    
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
    
    $myParties = $this->party->getMyParties($user_id);
    for($x = 0; $x < count($myParties); $x++)
      $party['myParties'] .= $this->load->view('dashboard/myparties', $myParties[$x], true);
    
      
    $views['error'] = $this->load->view('warningAndErrors/UnverifiedNPC', $data, true);
    $views['dashboardMenu']   = $this->load->view('dashboard/dashboardMenu', $data, true);
    $views['dashboardBadge']  = $this->load->view('dashboard/dashboardBadge', $badges, true);
    $views['dashboardQuest']  = $this->load->view('dashboard/dashboardQuest', $quest, true);
    $views['dashboardParty']  = $this->load->view('dashboard/dashboardParty', $party, true);
    $views['dashboardOffice'] = $this->load->view('dashboard/dashboardOffice', '', true);
    $views['dashboardSerial'] = $this->load->view('dashboard/dashboardSerial', $data, true);
      
    $body['menu'] = $this->load->view('menu', $data, true);
    $body['content'] = $this->load->view('dashboard', $views, true);
    
    $this->load->view('header');
    $this->load->view('body', $body);
  }
  
  public function getAwardingBadge() {
    $user_id = $this->session->userdata('user_id');
    $myBadges = $this->badge->getMyBadges($user_id);
    for($x = 0; $x < count($myBadges); $x++)
      $badges['mybadges'] .= $this->load->view('dashboard/mybadges', $myBadges[$x], true);
    echo $badges['mybadges'];
  }
  
  public function getEmptyUpgrade() {
    $badge_id = $this->input->post('badge_id');
    
    if($badge_id == 0)
      $badge['imageSource'] = base_url('assets/images/emptyBadge.png');
    
    $this->load->view('dashboard/badgeUpgrade.php', $badge);
  }
  
    public function getBadgeDetails() {
        $badge_id = $this->input->post('badge_id');
        $badge = $this->badge->getBadgeInfo($badge_id); 
        $badgelvls = $this->badge->getBadgeUpgrades($badge_id);
        for($x = 0; $x < count($badgelvls); $x++) 
            $badge['upgradeViews'] .= $this->load->view('dashboard/badgeUpgrade.php', $badgelvls[$x], true);
        $json = array(
              'baseLvlBadge'  => base_url($badge['baseLvlBadge']),
              'name'          => $badge['name'],
              'description'   => $badge['description'],
              'badgeLvls'     => $badge['upgradeViews']
        );
        echo json_encode($json);
    }
    
    public function getQuestDetails() {
        $questId = $this->input->post('quest_id');
        $quest = $this->quest->getQuestInfo($questId);
        $registrants = $this->quest->getQuestRegistrants($questId);
      
        foreach($registrants as $reg) {
          $registrantView .= $this->load->view('dashboard/questRegistrants', $reg, true);
        }
        $quest['questRegistrant'] = $registrantView;
        echo json_encode($quest);
    }
  
    public function getPartyDetails(){
        $partyId = $this->input->post('party_id');
//        $partyId = 1;
        $party = $this->party->getPartyInfo($partyId);
        $members = $this->party->getPartyMembers($partyId);
        
        foreach($members as $mem) {
          $memberView .= $this->load->view('dashboard/partyMembers', $mem, true);
        }
        $party['partyMember'] = $memberView;
//        $party['partyMember '] = $this->party->getPartyMembers($partyId);
        echo json_encode($party);
    }
    
    public function getOfficeDetails(){
        $officeId = $this->input->post('office_id');
        $office = $this->office->getOfficeInfo($officeId);
        echo json_encode($office);
    }
    
    public function getMyQuests() {

    }
    
    public function addBadge() {
//      $_POST names
//      txtBadgeName[]            = badge names (lvl 1 = [0])
//      txtaBadgeDescription      = badge description
//      txtRequirement[]          = badge requirements(lvl 2 = [0])
//      badge-pix[]               = badge pictures (lvl 1 = [0])
        $badgeName        = $this->input->post('txtBadgeName');
        $badgeDescription = $this->db->escape_str($this->input->post('txtaBadgeDescription'));
        $badgeRequirement = $this->db->escape_str($this->input->post('txtRequirement'));
        $badgePictures    = $_FILES['badge-pix'];
        
        $badge['badge_description'] = $badgeDescription;
        $badge['creator_id']        = $this->session->userdata('user_id');
        $badge['date_created']      = date('Y-m-d');
        
        
        $badgeId = $this->badge->addBadge($badge);
        $upgradesCount = count($badgeName);
        
        for($x = 1; $x <= $upgradesCount; $x++){
            $filePath = $_SERVER['DOCUMENT_ROOT'] . "xiphias/assets/images/badges/" . $badgePictures['name'][$x-1];
            move_uploaded_file($badgePictures['tmp_name'][$x-1], $filePath);
            $badge_ups['badge_ups_id'  ] = $badgeId;
            $badge_ups['badge_ups_name'] = $this->db->escape_str($badgeName[$x-1]);
            $badge_ups['badge_ups_lvl' ] = $x;
            $badge_ups['badge_ups_pix' ] = 'assets/images/badges/' . $badgePictures['name'][$x-1];
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
//      $_POST names
//      questName         
//      questDescription
//      rarity[]
//      date-range
//      questVenue
//      questEXP
        
        $time = explode(' ', $this->input->post('date-range'));
        $quest['quest_title']       = $this->db->escape_str($this->input->post('questName'));
        $quest['quest_description'] = $this->db->escape_str($this->input->post('questDescription'));
        $quest['quest_rarity']      = $this->input->post('rarity');
        $quest['date_created']      = date('Y-m-d');
        $quest['start_date']        = date('Y-m-d', strtotime($time[0]));
        $quest['end_date']          = date('Y-m-d', strtotime($time[2]));
        $quest['experience']        = $this->db->escape_str($this->input->post('questExp'));
        $quest['quest_type']        = "Academic";
        $quest['creator_id']        = $this->session->userdata('user_id');
        $this->quest->addQuest($quest);
        echo "ok";
    }
  
    public function addParty() {
//      $_POST names
//      partyName        
//      partyPasscode    
//      partyDescription 
//      partyMembers[]        = list of party members
        $party['creator_id']     = $this->session->userdata('user_id');
        $party['party_name']     = $this->db->escape_str($this->input->post('partyName'));
        $party['party_password'] = md5($this->input->post('partyPasscode'));
        $this->party->addParty($party);
    }
  
    public function addOffice() {
//      $_POST names
//      officeLogo          = office logo
//      txtOfficeName
//      txtShortForm
//      txtaOfficeDescription
        $office['office_name']         = $this->db->escape_str($this->input->post('txtOfficeName'));
        $office['office_logo']         = base_url('assets/images') . '/' . $_FILE['officeLogo']['name'];
        $office['office_abbreviation'] = $this->db->escape_str($this->input->post('txtShortForm'));
        $office['office_description']  = $this->db->escape_str($this->input->post('txtOfficeDescription'));
        $this->office->addOffice($office);
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
        $badgeId  = $this->input->post('badge_id');
        $memberId = $this->input->post('memberId');
        $memberCount = count($menberId);
        for($x = 0; $x < $memberCount; $x++){
            $data['user_id'] = $memberId[$x];
            $data['badge_id'] = $badgeId;
            $data['date_earned'] = date('Y-m-d');
            $this->user->awardBadge($data);
        }
    }
    
    public function changePartyPassword(){
        $partyId = $this->input->post('party_id');
        $data['party_password'] = $this->input->post('new_password');
        $this->party->changePassword($partyId, $data);
    }
  
    public function account_registration() {
        $data = array (
            'first_name'  => $this->db->escape_str($this->input->post('first_name')),
            'middle_name' => $this->db->escape_str($this->input->post('middle_name')),
            'last_name'   => $this->db->escape_str($this->input->post('last_name')),
            'username'    => $this->db->escape_str($this->input->post('username')),
            'password'    => md5($this->input->post('password')),
            'email'       => $this->db->escape_str($this->input->post('email')),
            'serial'      => md5(uniqid())
        );
        
        $config = array (
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => 'kellymilla18@gmail.com',
            'smtp_pass' => '09164735962',  
            'mailtype' => 'html'
        );
            
        $message = "<p> Thank you for signing up! </p>";
        $message .= "<p> <a href='" . base_url() . "user/validation/$serial'>Click Here</a> to confirm your account. </p>";

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('kellymilla18@gmail.com', 'Kelly Milla');
        $this->email->to($this->db->escape_str($this->input->post('email')));
        $this->email->subject('Xhipias : Account Confirmation');
        $this->email->message($message);
        
        if($this->user->add_user($data)){
            $this->email->send();
        }
        redirect(base_url() . 'index.php');
    }
}
