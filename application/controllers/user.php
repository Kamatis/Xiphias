<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
        
    public function profile($username) {
           
    }
    
    public function add_user($data){
        if($this->db->insert('temp_user', data))
            return true;
        return false;
    }
    
    public function validation($serial) {
        if($this->model_users->validate_account($serial)){
            // validation success
            redirect(base_url() . 'index.php');  
        } else {
            // validation error  
            redirect(base_url() . 'index.php');
        }
    }
}