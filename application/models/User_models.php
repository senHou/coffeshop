<?php

class User_models extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function register(){
        $data = array(
	        'first_name' => $this->input->post('firstname'),
	        'last_name' => $this->input->post('lastname'),
	        'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'email' => $this->input->post('email'),
                'status' => '1',
                'create_time' => date("Y/m/d h:i:s"),
                'is_logged_in' => '0'
    	);

    	return $this->db->insert('user', $data);
    }
    
    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $array = array('username' => $username, 'password' => md5($password));
        $query = $this->db->get_where('user',$array);
        return $query;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

