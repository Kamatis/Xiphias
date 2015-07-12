<?php

error_reporting(0);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    public function getBadgeDetails() {
        $badge_id = $this->input->post('badge_id');
        $badge = $this->badge->getBadgeInfo($badge_id); 
        $badgelvls = $this->badge->getBadgeUpgrades($badge_id);
        for($x = 0; $x < count($badgelvls); $x++) 
            $badge['upgradeViews'] .= $this->load->view('dashboard/badgeUpgrade.php', $badgelvls[$x], true);
        $json = array(
              'baseLvlBadge'  => $badge['baseLvlBadge'],
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
        
        foreach($registrants as $reg) 
            $registrantView .= $this->load->view('dashboard/questRegistrants', $reg, true);
        
        $quest['questRegistrant'] = $registrantView;
        echo json_encode($quest);
    }
    
    public function getPartyDetails(){
        $partyId = $this->input->post('party_id');
        $party = $this->party->getPartyInfo($partyId);
        $members = $this->party->getPartyMembers($partyId);
        
        foreach($members as $mem) 
          $memberView .= $this->load->view('dashboard/partyMembers', $mem, true);

        $party['partyMember'] = $memberView;
        echo json_encode($party);
    }
    
}