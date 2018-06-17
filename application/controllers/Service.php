<?php

class Service {

    public function index () {
        $classmap = array(
            'meal'  => 'Meal',
            'query' => 'Query',
            'order' => 'Order'
        );
        try {
            $service = new ServiceWrapper();
            $server = new SoapServer(
                base_url('webservice/service.wsdl'),
                array(
                    'classmap' => $classmap,
                    'cache_wsdl' => WSDL_CACHE_NONE
                )
            );
            $server->setObject($service);
            $server->handle();
        } catch (SoapFault $f) {
            print $f->faultstring;
        }
    }
}

class ServiceWrapper {

    protected $soap_service;

    public function __construct() {
        $this->soap_service = new SoapService();
    }

    public function auth($header) {
        if ($header->username && $header->password) {
            $CI =& get_instance();
            $CI->load->model('usermodel');
            $user = $CI->usermodel->authenticate($header->username, $header->password);
            if ($user) {
                $this->soap_service->user = $user; 
            }
        }
    }

    public function __call($method, $arguments) {
        if (!method_exists($this->soap_service, $method)) {
            throw new Exception('method not found');
        }
        if (!isset($this->soap_service->user)) {
            return new SoapFault("Sender", "403 Forbidden: Invalid authentication details");
        }
        return call_user_func_array(array($this->soap_service, $method), $arguments);
    }

}

class SoapService extends CI_Controller {

    public $user;

    public function getMenu() {
        $this->load->model('restaurantmodel');
        return $this->restaurantmodel->get_meals();
    }

    public function getMeal($rest_id, $meal_id) {
        $rest_id = strval($rest_id);
        $meal_id = strval($meal_id);
        if(!ctype_digit($rest_id) || !ctype_digit($meal_id)) return false;
        $this->load->model('restaurantmodel');
        return $this->restaurantmodel->get_meal($meal_id, $rest_id);
    }

    public function searchMeal($query) {
        $query = (array) $query;
        foreach ($query as $key => $value) {
            if (!$query[$key]) unset($query[$key]);
        }
        $this->load->model('restaurantmodel');
        return $this->restaurantmodel->search_meal($query);
    }

    public function orderMeal($order) {
        $order = (array) $order;
        $this->load->model('restaurantmodel');
        if (!$order['quantity']) {
            $response = $this->restaurantmodel->order_meal(
                $order['mealId'],
                $order['restaurantId'],
                $order['creditcard']
            );
        } else {
            $response = $this->restaurantmodel->order_meal(
                $order['mealId'],
                $order['restaurantId'],
                $order['creditcard'],
                $order['quantity']
            );
        }
        if ($response) {
            $this->load->model('ordermodel');
            $this->ordermodel->save(
                $this->user->id,
                $order['creditcard'],
                $order['mealId'],
                $order['restaurantId'],
                $this->restaurantmodel->get_meal(
                    $order['mealId'],
                    $order['restaurantId']
                )->price
            );
        }
        return $response;
    }

}

// class maps
/**
* Class structure for a meal 
*/
class Meal {
    public $id;
    public $name;
    public $cuisine;
    public $price;
    public $ingredient;
    public $period;
    public $description;
    public $restaurant;
}

/**
* Class structure for a search query 
*/
class Query {
    public $name;
    public $cuisine;
    public $mainIngredient;
    public $maxPrice;
}

/**
* Class structure for an order request 
*/
class Order {
    public $mealId;
    public $restaurantId;
    public $creditcard;
    public $quantity;
}
