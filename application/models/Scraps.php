<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scraps extends CI_Model{

    public $userFrom;
    public $userTo;
    public $message;

    public function __construct(){
        parent::__construct();
    }

    public function create(){
        return $this->db->insert('scraps', $this);
    }
    public function delScrap( $id ){
        return $this->db->delete('scraps', array(
            'id' => $id
        ));
    }
    public function editScrap( $message, $id ){
        return  $this->db->set('message', $message, TRUE)
            ->where('id', $id)
            ->update('scraps');
    }
    public function allTo( $userId ){
        return $this->db->select('
            scraps.id,
            scraps.userTo,
            scraps.userFrom,
            scraps.message,
            scraps.createdAt,
            scraps.updatedAt,
            users.firstname,
            users.lastname,
            users.username')
            ->from('scraps')
            ->where( 'scraps.userTo' , $userId )
            ->join('users','users.id = scraps.userFrom')
            ->get()->result();
    }

    public function scrapsLength(){
        return $this->db->count_all('scraps');
    }

    public function find( $value, $param = 'id' ){
        return $this->db->get_where('scraps', array(
            $param => $value
        ))->row();
    }
}