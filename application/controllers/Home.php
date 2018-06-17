<?php

class Home extends CI_Controller {

    public function index()
    {
        $data['title'] = "Home";
        $this->load->view('template/header', $data);
        $this->load->view('template/hero');
        $this->load->view('template/nav');
        $this->load->view('home/index');
        $this->load->view('template/footer');
    }


    public function contactus()
    {
        $this->load->view('template/header');
        $this->load->view('template/nav');
        $this->load->view('home/contactus');
        $this->load->view('template/footer');
    }


}
