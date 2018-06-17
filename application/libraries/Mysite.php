<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mysite {

    protected $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function is_logged_in($person) {
        if($person == 'admin')
            return $this->CI->session->has_userdata('admin_id');
        if($person == 'user')
            return $this->CI->session->has_userdata('user_id');
        return FALSE;
    }

    public function load_page($path_string, $title = 'Home', $context = NULL) {
        $data['title'] = $title;
        $this->CI->load->view('template/header', $data);
        $this->CI->load->view('template/nav');
        $this->CI->load->view($path_string, $context);
        $this->CI->load->view('template/footer');
    }

    public function logout() {
        $this->CI->session->sess_destroy();
        redirect('/');
    }

    public function attach_meal($arr) {
        $this->CI->load->model('restaurantmodel');
        foreach ($arr as $data) {
            $meal_name = $this->CI->restaurantmodel->get_meal($data->meal_id,$data->restaurant)->name;
            unset($data->meal_id);
            unset($data->restaurant);
            $data->meal = $meal_name;
        }
        return $arr;
    }

}