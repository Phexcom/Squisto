<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function index() {
        if (!$this->mysite->is_logged_in('user')) {
            redirect('/user/login/');
        }
        $this->load->model('ordermodel');
        $recent = $this->ordermodel->get($this->session->user_id);
        $recent = $this->mysite->attach_meal($recent);
        $data['recent'] = $recent;
        $this->mysite->load_page('user/index', 'Recent Orders', $data);
    }

    public function register() {
        if ($this->mysite->is_logged_in('user')) {
            redirect('/user/index');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //set validation rules
        $this->form_validation->set_rules(
            'email','Email',
            'required|max_length[150]|valid_email|is_unique[user.email]|trim',
            array('is_unique' => 'The email is already registered.')
        );
        $this->form_validation->set_rules(
            'username', 'Username',
            'required|max_length[60]|trim|is_unique[user.username]|alpha_numeric',
            array('is_unique' => 'The username is not available')
        );
        $this->form_validation->set_rules(
            'password', 'Password',
            'required|min_length[4]'
        );
        $this->form_validation->set_rules(
            'password_conf', 'Password Confirmation',
            'required|matches[password]'
        );

        if ($this->form_validation->run() !== FALSE) {
            // compile array of values
            $arr = array(
                'email'         => $this->input->post('email'),
                'username'    => $this->input->post('username'),
                'is_active'     => TRUE,
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            // save data in db
            $this->load->model('usermodel');
            $this->usermodel->create($arr);
            if ($this->usermodel->save()) {
                $this->session->set_flashdata('info', 'Registration successful!');
                redirect('/user/login');
            }
            
            $this->session->set_flashdata('error', 'There was a problem creating your account. Please try again later.');
        }

        $this->mysite->load_page('user/register', 'Sign up');
    }

    public function logout() {
        return $this->mysite->logout();
    }

    public function login() {
        if ($this->mysite->is_logged_in('user')) {
            redirect('/user/index');
        } 
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        // validation rules

        $this->form_validation->set_rules(
            'username','Username',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'password', 'Password',
            'required'
        );

        if ($this->form_validation->run() !== FALSE) {
            // authenticate and check active
            $this->load->model('usermodel');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($user = $this->usermodel->authenticate($username, $password)) {
                if (!$user->is_active) {
                    $this->session->set_flashdata('error',
                        'Account deactivated! Contact an administrator');
                } else {
                    // set session data
                    $sess_arr = array(
                        'user_id'   => $user->id,
                        'email'     => $user->email,
                        'username'  => $user->username,
                        'cart'      => array()
                    );
                    $this->session->set_userdata($sess_arr);
                    redirect('/user/index');
                }
            } else {
                $this->session->set_flashdata('error', 'Username/Password incorrect!');
            }
        }
        $this->mysite->load_page('user/login', 'Log in');
    }

}