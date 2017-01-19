<?php

class  User extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('user_models');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    function register(){
      
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|is_unique[user .username]',
                'errors' => array(
                    'required'  => 'The {field} field is required.',
                    'is_unique'  => 'This %s already exists.'
                )
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
            ),
            array(
                'field' => 'passconf',
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]'
            ),
             array(
                'field' => 'firstname',
                'label' => 'First Name',
                'rules' => 'required'
            ),
             array(
                'field' => 'lastname',
                'label' => 'Last Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|is_unique[user.email]',
                'errors' => array(
                    'required'  => 'The {field} field is required.',
                    'is_unique'  => 'This %s already exists.'
                )
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() === FALSE) {
            $this->template->load('layout', 'user/register_form', null);
        }else{
            $this->user_models->register();
            redirect(site_url('user/register'));
	    
        }
    }
        
    public function login() {
        
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required',
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() === FALSE) {
            if(isset($this->session->userdata['logged_in'])){
                $this->template->load('layout', 'home', null);
            }else {
                $this->template->load('layout', 'user/login_form', null);
            }
        }else{
            $query = $this->user_models->login();
            $row = $query->row_array();
        
            if (isset($row)) {
                $session_data = array(
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'firstname' => $row['first_name'],
                    'lastname' => $row['last_name']
                );
                $this->session->set_userdata('logged_in', $session_data);
                $this->template->load('layout', 'home',null);
            }else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->template->load('layout', 'user/login_form', $data);
            }
        }
    }
    
    public function logout() {

        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->template->load('layout', 'user/login_form', $data);
    }

}