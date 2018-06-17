<?php

/**
* Restaurant model class
*/
class RestaurantModel extends CI_Model {

    public $id;
    public $name;
    public $wsdl_url;
    public $images_path;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get($param, $type = "id") {
        if (!$param || ($type != "id" && $type != "name")) return false;
        if ($type == "id") {
            $query = $this->db->get_where('restaurant', array('id' => $param), 1);
        }
        if ($type == "name") {
            $query = $this->db->get_where('restaurant', array('name' => $param), 1);
        }
        if (!$query) return false;
        $restaurant = $query->row(0,'RestaurantModel');
        return $restaurant;
    }

    public function get_all() {
        $query = $this->db->get('restaurant');
        return $query->custom_result_object('RestaurantModel');
    }

    public function save($arr) {
        if (!$arr['name'] || !$arr['wsdl_url'] || !$arr['images_path']) return false;
        if ($arr['id']) {
            $id = $arr['id'];
            unset($arr['id']);
            return $this->db->update('restaurant',$arr, array('id' => $id));
        } else {
            return $this->db->insert('restaurant', $arr);
        }
    }


     public function update($arr) {

        if (!$arr['name'] || !$arr['wsdl_url'] || !$arr['images_path']) 
            return false;
            if ($arr['id']) {
                $id = $arr['id'];
                unset($arr['id']);
                return $this->db->update('restaurant',$arr, array('id' => $id));
            }
         else {
            return $this->db->insert('restaurant', $arr);
        }
    }

    public function delete($id) {
        if(!$id) return false;
        $this->db->delete('orders', array('restaurant' => $id));
        return $this->db->delete('restaurant', array('id' => $id));
    }

    public function get_description($id) {
        if (!$restaurant = $this->get($id)) return false;
        if ($wsdl = simplexml_load_file($restaurant->wsdl_url)) {
            $details = $wsdl->documentation->__toString();
        }
        // else: get from cached file
        return array('name' => $restaurant->name,'description' => $details);
    }

    public function get_meals() {
        $restaurants = $this->get_all();
        $meals = array();
        foreach ($restaurants as $restaurant) {
            $client = new SoapClient($restaurant->wsdl_url, array('cache_wsdl' => WSDL_CACHE_NONE));
            $result_set = $client->getMenu();
            if (isset($result_set->meal)) {
                $results = $this->__attach_restaurant($result_set->meal, $restaurant, $meals);
                $meals = $results;
            }
        }
        return $meals;
    }

    public function search_meal($parameters) {
        $restaurants = $this->get_all();
        $meals = array();
        $query = new StdClass();
        if (isset($parameters['name'])) $query->name = $parameters['name'];
        if (isset($parameters['cuisine'])) $query->cuisine = $parameters['cuisine'];
        if (isset($parameters['ingredient'])) $query->mainIngredient = $parameters['ingredient'];
        if (isset($parameters['price'])) $query->maxPrice = $parameters['price'];
        foreach ($restaurants as $restaurant) {
            $client = new SoapClient($restaurant->wsdl_url, array('cache_wsdl' => WSDL_CACHE_NONE));
            $result_set = $client->searchMeal($query);
            if (isset($result_set->meal)) {
                $results = $this->__attach_restaurant($result_set->meal, $restaurant, $meals);
                $meals = $results;
            }
        }
        return $meals;
    }

    public function get_meal($meal_id, $restaurant_id) {
        if (!ctype_digit(strval($meal_id)) || !ctype_digit(strval($restaurant_id))) return false;
        $restaurant = $this->get($restaurant_id);
        if (!$restaurant) return false;
        $client = new SoapClient($restaurant->wsdl_url, array('cache_wsdl' => WSDL_CACHE_NONE));
        $meal = $client->getMeal($meal_id);
        if (!isset($meal->id)) return false;
        $meal->restaurant = $restaurant;
        return $meal;
    }

    public function order_meal($meal_id, $restaurant_id, $credit_card, $quantity = 1) {
        if (!ctype_digit(strval($meal_id)) || !ctype_digit(strval($restaurant_id))) return false;
        $restaurant = $this->get($restaurant_id);
        if (!$restaurant) return false;
        $details = new StdClass();
        $details->id = $meal_id;
        $details->creditcard = $credit_card;
        $details->quantity = $quantity;
        $client = new SoapClient($restaurant->wsdl_url, array('cache_wsdl' => WSDL_CACHE_NONE));
        $result = $client->orderMeal($details);
        return $result;
    }

    private function __attach_restaurant($meals, $restaurant, $storage) {
        if (is_array($meals)) {
            foreach ($meals as $meal) {
                $meal->restaurant = $restaurant;
                $storage[] = $meal;
            }
        } else {
            $meals->restaurant = $restaurant;
            $storage[] = $meals;
        }
        return $storage;
    }

}


