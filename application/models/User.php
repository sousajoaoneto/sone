<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{

    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    public function __construct(){
        parent::__construct();
    }
    public function create(){
        return $this->db->insert('users', $this);
    }
    public function find( $value, $param = 'username' ){
        return $this->db->select('*')
            ->from('users')
            ->where($param, $value)
            ->or_where($param,'@'.$value)
            ->get()->row();
    }
    public function listAll($limit = 0){
        return $this->db->select('
            username,
            firstname,
            lastname')
            ->from('users')
            ->order_by('firstname','ASC')
            ->order_by('lastname','ASC')
            ->limit($limit,0)
            ->get()->result();
    }
}