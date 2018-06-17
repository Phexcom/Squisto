<?php

/**
* Class containing all web service functions
*/
class WebService {
    
    protected $db;

    /**
    * Constructor: initializes the database
    * and stores its link resource in the
    * class variable
    */
    public function __construct() {
        // establish databse connection
        try {
            $db = new PDO('mysql:host=localhost;dbname=bluechillies', 'root', 'root');
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->db = $db;
        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage()."<br/>";
        }
    }

    /**
    * Returns all available meals in the
    * database
    */
    public function getMenu() {
        $query = $this->db->prepare("SELECT * FROM meals");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->__createObjs($result);
    }

    /**
    * Returns a meal when given its id,
    * returns false if meal does not
    * exist in database
    */
    public function getMeal($mealId) {
        $query = $this->db->prepare("SELECT * FROM meals WHERE id = :id");
        $query->bindParam(':id', $mealId);
        $query->execute();
        $entry = $query->fetch(PDO::FETCH_ASSOC);
        if (!$entry) return false;
        $meal = new Meal();
        $meal->id           = $this->__sanitize($entry['id']);
        $meal->name         = $this->__sanitize($entry['name']);
        $meal->cuisine      = $this->__sanitize($entry['cuisine']);
        $meal->price        = $this->__sanitize($entry['price']);
        $meal->ingredient   = $this->__sanitize($entry['main_ingredient']);
        $meal->period       = $this->__sanitize($entry['meal_type']);
        $meal->description  = $this->__sanitize($entry['description']);
        return $meal;
    }

    /**
    * Performs a databse search for meals
    * matching the search criteria sent by
    * the client. if no valid criteria is
    * sent, it returns all meals in the databse
    */
    public function searchMeal($query) {
        $name           = ($query->name) ? $query->name : NULL;
        $cuisine        = ($query->cuisine) ? $query->cuisine : NULL;
        $mainIngredient = ($query->mainIngredient) ? $query->mainIngredient : NULL;
        $maxPrice       = ($query->maxPrice) ? $query->maxPrice : NULL;
        
        $sql = "SELECT * FROM meals";
        if ($name || $cuisine || $maxPrice || $mainIngredient) {
            $sql.= " WHERE ";
            $sql.= $name ? "name LIKE :name ": "";
            if ($cuisine) {$sql.= $name?"AND ":'';$sql.="cuisine LIKE :cuisine ";}
            //$sql.= $cuisine ? ($name ? $sql.= "AND " : ''), "cuisine LIKE :cuisine ": "";
            if ($mainIngredient) {$sql.=($name || $cuisine)?"AND ":'';$sql.="main_ingredient LIKE :main ";}
            //$sql.= $mainIngredient ? "main LIKE :main ": "";
            $sql.= (($name || $cuisine || $mainIngredient) && $maxPrice) ? "AND ": "";
            $sql.= $maxPrice ? "price <= :maxPrice": "";
        }
        $sql.= ";";

        $searchName = '%'.$name.'%';
        $searchCuisine = '%'.$cuisine.'%';
        $searchMainIngredient = '%'.$mainIngredient.'%';

        $query = $this->db->prepare($sql);
        if ($name) $query->bindParam(':name', $searchName);
        if ($cuisine) $query->bindParam(':cuisine', $searchCuisine);
        if ($mainIngredient) $query->bindParam(':main', $searchMainIngredient);
        if ($maxPrice) $query->bindParam(':maxPrice', $maxPrice);
        
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->__createObjs($result);
    }

    /**
    * Receives order details from client
    * and confirms if the order is successful
    * or nor by returning a TRUE or FALSE value 
    */
    public function orderMeal($order) {
        $mealId     = ($order->id) ? $order->id : NULL;
        $creditcard = ($order->creditcard) ? $order->creditcard : NULL;
        $quantity   = ($order->quantity) ? $order->quantity : NULL;
        // check if meal exists in db
        if (!$mealId || !$creditcard) return FALSE;
        $query = $this->db->prepare("SELECT * FROM meals WHERE id = :id");
        $query->bindParam(':id', $mealId);
        $query->execute();
        $meal = $query->fetch(PDO::FETCH_ASSOC);
        if (!$meal) return FALSE;
        // validate credit card
        if (!$this->__validateCard($creditcard)) return FALSE;
        return TRUE;
    }

    /**
    * Helper function: validates creditcard 
    * number using the Luhn algorithm
    */
    private function __validateCard($creditcard) {
        $creditcard = (string) $creditcard;
        $sum = 0;
        $alt = false;
        for($i = strlen($creditcard) - 1; $i >= 0; $i--) {
            if($alt)
            {
               $temp = $creditcard[$i];
               $temp *= 2;
               $creditcard[$i] = ($temp > 9) ? $temp = $temp - 9 : $temp;
            }
            $sum += $creditcard[$i];
            $alt = !$alt;
        }
        return $sum % 10 == 0;
    }

    /**
    * Helper function: receives an array of 
    * database objects, creates meal objects
    * using the objects and returns the objects
    * as an array
    */
    private function __createObjs($result = array()) {
        $meal_array = array();
        foreach ($result as $entry) {
            $meal = new Meal();
            $meal->id           = $this->__sanitize($entry['id']);
            $meal->name         = $this->__sanitize($entry['name']);
            $meal->cuisine      = $this->__sanitize($entry['cuisine']);
            $meal->price        = $this->__sanitize($entry['price']);
            $meal->ingredient   = $this->__sanitize($entry['main_ingredient']);
            $meal->period       = $this->__sanitize($entry['meal_type']);
            $meal->description  = $this->__sanitize($entry['description']);
            $meal_array[]       = $meal;
        }
        return $meal_array;
    }

    /**
    * Helper function: converts text from database
    * into their Unicode counterparts
    */
    private function __sanitize($source, $target_encoding="UTF-8") {
        // escape all of the question marks so we can remove artifacts from
        // the unicode conversion process
        $target = str_replace( "?", "[question_mark]", $source );
           
        // convert the string to the target encoding
        $target = mb_convert_encoding( $target, $target_encoding);
           
        // remove any question marks that have been introduced because of illegal characters
        $target = str_replace( "?", "", $target );
           
        // replace the token string "[question_mark]" with the symbol "?"
        $target = str_replace( "[question_mark]", "?", $target );
       
        return $target;
    }

}
 
// class maps

/**
* Class structure for a meal 
*/
class Meal
{
    public $id;
    public $name;
    public $cuisine;
    public $price;
    public $ingredient;
    public $period;
    public $description;
}

/**
* Class structure for a search query 
*/
class Query
{
    public $name;
    public $cuisine;
    public $mainIngredient;
    public $maxPrice;
}

/**
* Class structure for an order request 
*/
class Order
{
    public $id;
    public $creditcard;
    public $quantity;
}

$classmap = array(
    'meal'  => 'Meal',
    'query' => 'Query',
    'order' => 'Order',
);

try {
    $server = new SoapServer(
        'service.wsdl',
         array('classmap' => $classmap,
        'cache_wsdl' => WSDL_CACHE_NONE)
    );
    $server->setClass('WebService');
    $server->handle();
} catch (SoapFault $f) {
    print $f->faultstring;
}
