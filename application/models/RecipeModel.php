<?php

class RecipeModel extends CI_Model {
    
    public $recipe_id;

    public $name;
    
    public $owner;

    public $short_descr;

    public $long_descr;

    public $is_approved;

    public $nutri_val;

    public $cost_est;

    public $type;

    public $comment;

    public $date_posted;

    public $img_name;

    // Other methods

    public function __construct() {
        parent::__construct();
        $this->load->database();

    }

    /*
    * Save new and update existing
    */
    public function save() {
        if ($this->recipe_id) {
            // update
        }
        // new
    }

    public function get_types() {
        $sql = "SHOW COLUMNS FROM recipe LIKE 'type'";
        $row = $this->db->query($sql)->row()->Type;
        preg_match_all("/'(.*?)'/" , $row, $enum_array);
        return $enum_array[1];
    }

    public function get($id) {
        // TO-DO: grab and load database data into object
        $query = $this->db->get_where('recipe',array('recipe_id' => $id));
        return $query->row(0,'RecipeModel');
    }

    public function delete($id) {
        // TO-DO: Remove steps and ingredients
    }

    /*
    * Takes an array, stores object's attribute values
    */
    public function create(array $values) {
        $fields = array_keys(get_object_vars($this));
        foreach ($values as $key => $value) {
            if (in_array($key, $fields)) {
                $this->$key = $value;
            }
        }
    }

}