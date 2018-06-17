<?php

class Meal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('restaurantmodel');
    }

	public function index() {
        if(!$this->mysite->is_logged_in('admin') && !$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/user/login/');
        }
        $meals = $this->restaurantmodel->get_meals();
        $data['meals'] = $meals;
        $this->mysite->load_page('meal/index', 'Meals', $data);
	}

    public function search() {
        if(!$this->mysite->is_logged_in('admin') && !$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/user/login/');
        }
        $this->load->helper('form');

        if ($this->input->method() == "post") {
            $arr = array();
            if ($this->input->post('name')) $arr['name'] = $this->input->post('name');
            if ($this->input->post('ingredient')) $arr['ingredient'] = $this->input->post('ingredient');
            if ($this->input->post('cuisine')) $arr['cuisine'] = $this->input->post('cuisine');
            if ($this->input->post('price')) $arr['price'] = $this->input->post('price');
            $result = $this->restaurantmodel->search_meal($arr);
            $data['meals'] = $result;
            return $this->mysite->load_page('meal/search_result', 'Search Results', $data);
        } else {
            return $this->mysite->load_page('meal/search', 'Search');
        }
    }

    public function add() {
        if(!$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/user/login/');
        }
        $data = $this->input->post('add');
        if (!$data) return false;
        $data = explode("-", $data);
        $restaurant = $data[0];
        $meal = $data[1];
        if (!$restaurant || !$meal) return false;
        $cart = $this->session->cart;
        $cart[count($cart)+1] = array('restaurant'=> $restaurant, 'meal' => $meal);
        $this->session->cart = $cart;
        echo count($this->session->cart);
    }

    public function remove() {
        if(!$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/user/login/');
        }
        $data = $this->input->post('id');
        if (!$data || !ctype_digit($data)) return false;
        $cart = $this->session->cart;
        if (!$cart || !$cart[$data]) return false;
        unset($cart[$data]);
        $this->session->cart = $cart;
        echo count($this->session->cart);
    }

    public function cart() {
        if(!$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/admin/login/');
        }
        $cart = $this->session->cart;
        $meals = array();
        if(!empty($cart)) {
            $cart = array_unique($cart, SORT_REGULAR);
            foreach ($cart as $data) {
                $meal = $this->restaurantmodel->get_meal($data['meal'], $data['restaurant']);
                $meals[] = $meal;
            }
        }
        $data['meals'] = $meals;
        $this->mysite->load_page('meal/cart', 'Cart', $data);
    }

    public function checkout() {
        if(!$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/admin/login/');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('ordermodel');

        $cart = $this->session->cart;
        if(empty($cart)) {
            $this->session->set_flashdata('info', 'Your cart is currently empty, you can add items below');
            redirect('meal');
        }

        //set validation rules
        $this->form_validation->set_rules(
            'card_no','Card number',
            'required|numeric|trim'
        );
        $this->form_validation->set_rules(
            'exp', 'Expiry date',
            'required|max_length[7]|trim'
        );
        $this->form_validation->set_rules(
            'c_name', 'Card name',
            'required|trim|alpha_numeric_spaces'
        );
        $this->form_validation->set_rules(
            'cvv', 'CVV',
            'required|max_length[4]|trim|numeric'
        );

        if ($this->form_validation->run() !== FALSE) {
            $card = $this->input->post('card_no');
            $results = array();
            foreach ($cart as $data) {
                $response = $this->restaurantmodel->order_meal(
                    $data['meal'],
                    $data['restaurant'],
                    $card
                );
                if(!$response) {
                    $results[] = $data;
                    continue;
                }
                $this->ordermodel->save(
                    $this->session->user_id,
                    $card,
                    $data['meal'],
                    $data['restaurant'],
                    $this->restaurantmodel->get_meal($data['meal'], $data['restaurant'])->price
                );
            }
            $this->session->cart = array();
            if (!empty($results)) {
                $this->session->set_flashdata('failed', $results);
            }
            redirect('meal/order');
        }

        $price = 0;
        foreach ($cart as $data) {
            $meal = $this->restaurantmodel->get_meal($data['meal'], $data['restaurant']);
            $price += $meal->price;
        }
        $data['price'] = $price;
        $data['count'] = count($cart);
        $this->mysite->load_page('meal/checkout', 'Checkout', $data);
    }

    public function order() {
        if(!$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/admin/login/');
        }
        $data = array();
        if ($this->session->flashdata('failed')) {
            $temp = $this->session->flashdata('failed');
            foreach ($temp as $value) {
                $meal = $this->restaurantmodel->get_meal($value['meal'], $value['restaurant']);
                $data['failed'][] = $meal;
            }
        }
        $this->mysite->load_page('meal/order', 'Order details', $data);
    }

    public function view($restaurant, $meal) {
        if(!$this->mysite->is_logged_in('admin') && !$this->mysite->is_logged_in('user')) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            return redirect('/user/login/');
        }
        if (!ctype_digit($restaurant) || !ctype_digit($meal)) redirect('meal');
        if (!$meal_details = $this->restaurantmodel->get_meal($meal, $restaurant)) redirect('meal');
        $data['meal'] = $meal_details;
        $this->mysite->load_page('meal/view', $meal_details->name, $data);
    }

}
