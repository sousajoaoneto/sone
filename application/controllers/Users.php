<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	private $data;

	public function index(){
		if($this->session->logged_in) redirect('profile');
		else $this->signin();
	}
	# GET /signup
	public function signup(){
		if($this->session->logged_in) redirect(); else{
			$this->data['page_title'] = 'Signup';
			$this->load->view('users/signup', $this->data);
		}
	}
	# POST /signup
	public function create(){
		$this->load->model('User','user');
		$this->user->username = $this->input->post('username');
		$this->user->firstname = $this->input->post('firstname');
		$this->user->lastname = $this->input->post('lastname');
		$this->user->email = $this->input->post('email');
		$this->user->password = hash('sha256',$this->input->post('password'));

		$this->data['USER_DATA'] = new stdClass();
		$this->data['USER_DATA']->firstname = $this->input->post('firstname');
		$this->data['USER_DATA']->lastname = $this->input->post('lastname');

		//username existente?
		$user = $this->user->find($this->input->post('username'));
		if( $user ) {
			$this->data['error'] = new stdClass();
			$this->data['error']->message = "Nome de Usuário Inválido";
			//$this->data['USER_DATA']->erro_username = true;
			$this->data['USER_DATA']->email = $this->input->post('email');
			$this->signup();
		}else {
			//email existente?
			$user = $this->user->find($this->input->post('email'), 'email');
			if ( $user ) {
				$this->data['error'] = new stdClass();
				$this->data['error']->message = "E-mail Inválido";
				//$this->data['USER_DATA']->erro_email = true;
				$this->data['USER_DATA']->username = $this->input->post('username');
				$this->signup();
			}
		}
		//se nao tiver erro cria usuario
		if(!$this->data['error']){
			if($this->user->create()) {
				redirect('signin', $this->data);
			}else {
				$this->data['error']->message = "Erro";
				$this->signup();
			}
		}
	}
	# GET /signin
	public function signin(){
		if($this->session->logged_in) redirect(); else{
			$this->load->view('users/signin', $this->data);
		}
	}
	# POST /signin
	public function auth(){
		$this->load->model('User','user');
		$user = $this->user->find($this->input->post('username'));
		$hashedpw = hash('sha256',$this->input->post('password'));
		if($user && hash_equals($user->password,$hashedpw)){
			$data = array(
				'id' => $user->id,
				'username'  => $user->username,
				'firstname'  => $user->firstname,
				'lastname'  => $user->lastname,
				'email'  => $user->email,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($data);
			$_SESSION['username'] = $user->username;
			redirect();
		}else{
			$this->data['error'] = new stdClass();
			$this->data['error']->message = "Usuário ou Senha incorretos";
			$this->signin();
		}
	}
	public function profile( $username = null){
		if($this->session->logged_in) {
			if($username == null){
				$username = $this->session->username;
			}
			$this->load->model('User', 'user');

			$this->data['me'] = $this->user->find($this->session->username);

			if( $this->user->find($username) ){
				//user data
				$user = $this->user->find($username);
				$this->data['user'] = $user;
				//user scraps data
				$this->load->model('Scraps', 'scraps');
				$scraps = $this->scraps->allTo( $user->id );
				$this->data['scraps'] = $scraps;

				$this->data['users'] = $this->user->listAll();

				//cores
				$this->data['colorUserThumb'] = array(
					'A' => '#1abc9c',
					'B' => '#3498db',
					'C' => '#2ecc71',
					'D' => '#9b59b6',
					'E' => '#34495e',
					'F' => '#16a085',
					'G' => '#2980b9',
					'H' => '#27ae60',
					'I' => '#8e44ad',
					'J' => '#27ae60',
					'K' => '#f1c40f',
					'L' => '#e67e22',
					'M' => '#9b59b6',
					'N' => '#e74c3c',
					'O' => '#95a5a6',
					'P' => '#f39c12',
					'Q' => '#c0392b',
					'R' => '#d35400',
					'S' => '#2980b9',
					'T' => '#1abc9c',
					'U' => '#3498db',
					'V' => '#9b59b6',
					'W' => '#e67e22',
					'X' => '#34495e',
					'Y' => '#2c3e50',
					'Z' => '#16a085'
				);

				$this->data['page_title'] = 'Perfil';
				$this->load->view('template/header', $this->data);
				$this->load->view('users/aside-left', $this->data);
				$this->load->view('users/profile', $this->data);
				$this->load->view('users/aside-right', $this->data);
				$this->load->view('template/footer');
			}else{
				$this->load->view('template/404', $this->data);
			}
			
		}else{
			redirect('signin');
		}
	}
	# GET /signout
	public function signout(){
		$this->session->sess_destroy();
		redirect('signin');
	}
	public function console( $value ){
		echo '<pre>';
		var_dump($value);
		echo '</pre>';
	}

	# POST /signup
	public function postScrap(){
		if($this->session->logged_in) {
			$this->load->model('Scraps','scrap');
			$this->scrap->message = $this->input->post('message');
			$this->scrap->userTo = $this->input->post('userTo');
			$this->scrap->userFrom = $this->session->id;

			$username = $this->input->post('username');

			//$this->console($this->scrap);

			if($this->scrap->create()) {
				//$this->data['message'] = "Postado";
				if($this->session->username == $username) redirect();
				else redirect($username);
			}else {
				$this->data['message'] = "Erro ao postar";
				$this->index();
			}
			//$this->profile();
		}else{
			redirect('signin');
		}
	}
	# GET /delete
	public function delete( $id = null){
		if($this->session->logged_in) {
			$this->load->model('Scraps','scrap');
			if($id != null && $this->scrap->find($id)){
				$scrap = $this->scrap->find($id);
				if( $this->session->id == $scrap->userFrom || $this->session->id == $scrap->userTo){
					$result = $this->scrap->delScrap($id);
					redirect();
				}else{
					$this->load->view('template/404');
				}
			}else{
				$this->load->view('template/404');
			}
		}else{
			redirect('signin');
		}
	}
	# GET /editscrap
	public function editScrap(){
		$this->load->model('Scraps','scrap');
		$message = $this->input->post('message');
		$id = $this->input->post('scrapId');

		$username = $this->input->post('username');

		//$this->console($this->scrap);

			if($this->scrap->editScrap($message, $id)) {
				if($this->session->username == $username) redirect();
				else redirect($username);
			}else {
				$this->data['message'] = "Erro ao postar";
				$this->index();
			}
	}

}
