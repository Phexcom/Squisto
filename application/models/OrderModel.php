<?php

/**
* Restaurant model class
*/
class OrderModel extends CI_Model {

    public $id;
    public $datetime;
    public $name;
    public $restaurant;
    public $meal_id;
    public $card;
    public $price;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save($user, $card, $meal, $restaurant, $price) {
        if (!ctype_digit(strval($meal)) || !ctype_digit(strval($restaurant)) || !ctype_digit(strval($card))) return false;
        $card = str_replace(substr($card, 4),'-xxxx-xxxx-xxxx', $card);
        $arr = array(
            'user_id'           => $user,
            'card'              => $card,
            'restaurant'        => $restaurant,
            'meal_id'           => $meal,
            'datetime'          => date('Y-m-d H:i:s'),
            'price'             => $price
        );
        return $this->db->insert('orders', $arr);
    }

    public function get($param, $type="user") {
        if (!$param || ($type != "user" && $type != "date")) return false;
        if ($type == "user") {
            $this->db->select('orders.id, restaurant, restaurant.name, meal_id, card, price, datetime');
            $this->db->from('orders');
            $this->db->where('user_id',$param);
            $this->db->join('restaurant', 'restaurant.id = orders.restaurant');
            $this->db->order_by('datetime', 'DESC');
            $query = $this->db->get();
        }
        if ($type == "date") {
            $this->db->select('orders.id, restaurant, restaurant.name, meal_id, user.username, card, price, datetime');
            $this->db->from('orders');
            $this->db->where('datetime >',$param);
            $this->db->join('restaurant', 'restaurant.id = orders.restaurant');
            $this->db->join('user', 'user.id = orders.user_id');
            $this->db->order_by('datetime', 'DESC');
            $query = $this->db->get();
        }
        if (!$query) return false;
        $orders = $query->result('OrderModel');
        return $orders;
    }

}