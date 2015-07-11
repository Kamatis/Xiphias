<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
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
}