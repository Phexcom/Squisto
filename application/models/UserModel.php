<?php

class UserModel extends CI_Model {
    
    public $id;

    public $email;

    public $username;

    public $is_active;

    public $password;

    // methods

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
    * Save new
    */
    public function save() {
        // new data
        if ($this->db->insert('user', $this)) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    /*
    * Updating existing
    */
    public function update($id) {
        
    }    

    /*
    * Set user active
    */
    public function set_active($id) {
        $this->db->set('is_active', TRUE);
        $this->db->where('user_id', $id);
        return $this->db->update('user');
    } 

    public function authenticate($username, $password) {
        $query = $this->db->get_where('user', array('username' => $username));
        if (!$user = $query->row(0,'UserModel')) {
            return FALSE;
        }
        if (!password_verify($password, $user->password)) {
            return FALSE;
        }
        return $user;
    }

    public function delete($id = NULL) {
        // Remove all associated orders before deleting
    }

    public function get($id) {
        $query = $this->db->get_where('user',array('user' => $id));
        return $query->row(0,'UserModel');
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