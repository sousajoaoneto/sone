<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	private $data;

	public function index(){
		$this->load->view('template/404', $this->data);
	}
	public function error_404(){
		$this->load->view('template/404', $this->data);
	}
}
