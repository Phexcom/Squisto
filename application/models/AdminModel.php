<?php

class AdminModel extends CI_Model {
    
    public $id;

    public $username;
    
    public $password;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save() {
        return $this->db->insert('admin', $this);
    }

    public function authenticate($username, $password) {
        if (!$admin = $this->getByUsername($username)) {
            return FALSE;
        }
        if (!password_verify($password, $admin->password)) {
            return FALSE;
        }
        return $admin;
    }

    public function delete($id) {
        return $this->db->delete('admin', array('id' => $id));
    }

    public function getByUsername($username) {
        $query = $this->db->get_where('admin', array('username' => $username));
        return $query->row(0, 'AdminModel');
    }

    public function getById($id = NULL) {
        if (!$id) {
            $id = $this->$admin_id;
        }
        if ($admin=$this->db->get_where('admin', array('id'=> $id), 1)) {
            
        }
        return FALSE;
    }

    public function getAll() {
        $query = $this->db->get('admin');
        return $query->result('AdminModel');
    }

    public function create(array $values) {
        $fields = array_keys(get_object_vars($this));
        foreach ($values as $key => $value) {
            if (in_array($key, $fields)) {
                $this->$key = $value;
            }
        }
    }

}