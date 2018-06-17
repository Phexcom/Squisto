<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function index() {
		if (!$this->mysite->is_logged_in('admin')) {
            redirect('/admin/login/');
        }
        $today = new DateTime();
        $today = $today->modify('-1 day')->format('Y-m-d H:i:s');
        $this->load->model('ordermodel');
        $result = $this->mysite->attach_meal($this->ordermodel->get($today, 'date'));
        $data['orders'] = $result;
        $this->mysite->load_page('admin/index', 'Admin', $data);
	}

    public function login() {
        if ($this->mysite->is_logged_in('admin')) {
            redirect('/admin/index');
        }
        // load form
        $this->load->helper('form');
        $this->load->library('form_validation');

        // validation
        $this->form_validation->set_rules(
            'username','Username',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'password', 'Password',
            'required'
        );

        if ($this->form_validation->run() !== FALSE) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $this->load->model('adminmodel');
            if ($admin = $this->adminmodel->authenticate($username, $password)) {
                // set session values
                $sess_arr = array(
                    'admin_id' => $admin->id,
                    'username' => $admin->username
                );
                $this->session->set_userdata($sess_arr);
                redirect('/admin/index');
            }
            
            // set flash message
            $this->session->set_flashdata('error', 'Username/password invalid!');
        }

        return $this->mysite->load_page('admin/login', 'Admin');
    }

    public function view() {
        if (!$this->mysite->is_logged_in('admin')) {
            redirect('admin/login/');
        }
        $this->load->model('adminmodel');
        $admins = $this->adminmodel->getAll();
        $data['admins'] = $admins;
        $this->mysite->load_page('admin/view', 'View Admins', $data);
    }

    public function delete($id) {
        if (!$this->mysite->is_logged_in('admin')) {
            redirect('admin/login');
        }
        if ($this->session->admin_id == $id) {
            $this->session->set_flashdata('error', 'You can not delete the acive admin account!');
            redirect('admin/view');
        }
        $this->load->model('adminmodel');
        if ($this->adminmodel->delete($id)) {
            $this->session->set_flashdata('info', 'Account deleted successfully');
        }
        else {
            $this->session->set_flashdata('error', 'There was a problem deleting this account!');
        }
        redirect('admin/view');
    }

    public function add() {
        if (!$this->mysite->is_logged_in('admin')) {
            redirect('/admin/login/');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('adminmodel');

        // validation
        $this->form_validation->set_rules(
            'username','Username',
            'required|alpha_numeric|is_unique[admin.username]|trim'
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
                'username'  => $this->input->post('username'),
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            // save data in db
            $this->load->model('adminmodel');
            $this->adminmodel->create($arr);
            
            if ($this->adminmodel->save()) {
                $this->session->set_flashdata('info', 'Admin created successfully');
            } else {
                $this->session->set_flashdata('error',
                    'There was a problem processing your request. Please try again later');
            }

            redirect('/admin/view/');
        }

        $this->mysite->load_page('admin/add', 'Create Admin');
    }

    public function logout() {
        return $this->mysite->logout();
    }

}