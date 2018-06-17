<?php

class Restaurant extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('restaurantmodel');
    }

    public function index() {
        if(!$this->mysite->is_logged_in('admin')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/admin/login/');
        }
        $restaurants = $this->restaurantmodel->get_all();
        $data['restaurants'] = $restaurants;
        $this->mysite->load_page('restaurant/index', 'Restaurants', $data);
    }

    public function view($id) {
        if(!$this->mysite->is_logged_in('user') && !$this->mysite->is_logged_in('admin')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/user/login/');
        }
        if (!$restaurant = $this->restaurantmodel->get_description($id)) redirect('meal');
        
        $data['restaurant'] = $restaurant;
        $this->mysite->load_page('restaurant/view', $restaurant['name'], $data);
    }

    public function add() {
        if(!$this->mysite->is_logged_in('admin')) {
            $this->session->set_flashdata('error', 'You must be logged in to perform this operation');
            redirect('/admin/login/');
        }
        if(!$this->mysite->is_logged_in('admin')) {
            $this->session->set_flashdata('error', 'You must be logged in to perform this operation');
            redirect('/admin/login/');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'name', 'Restaurant name',
            'required|trim|alpha_numeric_spaces'
        );

        $this->form_validation->set_rules(
            'wsdl', 'WSDL URI',
            'required|trim|valid_url'
        );

        $this->form_validation->set_rules(
            'images', 'Images URI path',
            'required|trim|valid_url'
        );

        if ($this->form_validation->run() !== FALSE) {
            // compile array of values
            $arr = array(
                'name'          => $this->input->post('name'),
                'wsdl_url'      => $this->input->post('wsdl'),
                'images_path'   => $this->input->post('images')
            );
            
            if (!$wsdl = simplexml_load_file($arr['wsdl_url'])) {
                $this->session->set_flashdata('error', 'The webservice located at the provided wsdl url does not seem to be active');
                redirect('/restaurant/');
            }
            $result = $this->restaurantmodel->save($arr);
            if ($result) {
                $this->session->set_flashdata('info', 'Admin created successfully');
            } else {
                $this->session->set_flashdata('error',
                    'There was a problem processing your request. Please try again later.');
            }
            redirect('/restaurant/');
        }

        $this->mysite->load_page('restaurant/add', 'Add Restaurant');
    }

    public function edit($id) {
        if(!$this->mysite->is_logged_in('admin')) {
            $this->session->set_flashdata('error', 'You must be logged in to perform this operation');
            redirect('/admin/login/');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'name', 'Restaurant name',
            'required|trim|alpha_numeric_spaces'
        );

        $this->form_validation->set_rules(
            'wsdl', 'WSDL URI',
            'required|trim|valid_url'
        );

        $this->form_validation->set_rules(
            'images', 'Images URI path',
            'required|trim|valid_url'
        );



        if ($this->input->method() == "post") {


            if ($this->form_validation->run() !== FALSE) {

                $arr = array(
                    'id'            => $this->input->post('id'),
                    'name'          => $this->input->post('name'),
                    'wsdl_url'      => $this->input->post('wsdl'),
                    'images_path'   => $this->input->post('images')

                );

               
                
                $result = $this->restaurantmodel->update($arr);
                if ($result) {
                    $this->session->set_flashdata('info', 'Restaurant edited successfully');
                } else {
                    $this->session->set_flashdata('error',
                        'There was a problem processing your request. Please try again later.');
                }
                return redirect('/restaurant/');
            }
            $this->mysite->load_page('restaurant/edit', 'Edit Restaurant');          
        } else {
            if (!$id || !ctype_digit($id)) redirect("/restaurant/");
            if (!$restaurant = $this->restaurantmodel->get($id)) redirect("/restaurant/");

            $context['restaurant'] = $restaurant;
            $this->mysite->load_page('restaurant/edit', 'Edit Restaurant', $context);
        }
    }

    public function delete($id) {
        if(!$this->mysite->is_logged_in('admin')) {
            $this->session->set_flashdata('error', 'You must be logged in to perform this operation');
            redirect('/admin/login/');
        }
        if (!$id || !ctype_digit($id)) redirect("/restaurant/index");
        $result = $this->restaurantmodel->delete($id);
        if ($result) {
            $this->session->set_flashdata('info', 'Restaurant and corresponding orders deleted succesfully!');
        } else {
            $this->session->set_flashdata('error', 'There was an error deleting this restaurant');
        }
        redirect('restaurant/index');
    }

}