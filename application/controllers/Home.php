<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct(){
		
		parent::__construct();

		$this->load->model("Admin");

		if($this->session->userdata("loginId") && $this->session->userdata("loginId") > 0){
			//redirect("companies");
		}
	}

	
	function index() {
		redirect("login");
	}

	function login(){

		if(!empty($this->input->post())){

			$email = $this->input->post("email");		
			$password = $this->input->post("password");			
		
			$data = array();
			$data["email"] = $email;
			$data["password"] =	$password;
			
			$loggedIn = $this->Admin->login($data);

			//echo 'loggedIn:'.$loggedIn; die;

			if($loggedIn > 0){
				$result = array("C" => 100, "R" => array(), "M" => "success");
			}else{
				$result = array("C" => 101, "R" => array(), "M" => "error");
			}

			echo json_encode($result); die;

		}else{

			$data = array();
			$data["pageType"] = "login";
			$this->load->view("admin/login", $data);
		}
		
	}

	function logout(){
		
		$this->session->unset_userdata("loginId");
		$this->session->sess_destroy();

		redirect("login");
	}

	function register(){
		
		if(!empty($this->input->post())){

			//save registeration

			$name = $this->input->post("name");		
			$email = $this->input->post("email");		
			$password = $this->input->post("password");		
			$confirmpassword = $this->input->post("confirmpassword");		

			$exist = $this->checkEmailExist($email);
			
			if($exist == 1){

				$result = array("C" => 101, "R" => array("msg" => "email is already associated with us."), "M" => "error");

			}else if($exist == 2){
				
				$result = array("C" => 102, "R" => array("msg" => "email is already associated with us."), "M" => "error");
				
			}else{

				//---- save
				$data = array();
				$data["id"] = db_randomnumber();
				$data["name"] = $name;
				$data["email"] = $email;
				$data["password"] = sha1($password);

				$resp = $this->Admin->register($data);
				$result = array("C" => 100, "R" => array("msg" => ""), "M" => "success");
			}

			echo json_encode($result); die;
		}else{
			$data = array();
			$data["pageType"] = "register";
			$this->load->view("admin/login", $data);
		}

	}

	function checkEmailExist($emailParm = false){


		if($emailParm){
			//call by parameter
			$email = $emailParm;
			$isPost = 0;
		}else{
			//call by http request
			$email = $this->input->post("email");	
			$isPost = 1;
		}


		if($email && $email != "" && $email != "undefined"){
			$exist = $this->Admin->checkEmailExist($email);
		}else{ 
			$exist = 2;
		}	
		
		if($isPost > 1){
			//call by http request
				
			if($exist == 1){

				$result = array("C" => 101, "R" => array("msg" => "email is already associated with us."), "M" => "error");

			}else if($exist == 2){
				
				$result = array("C" => 102, "R" => array("msg" => "email is already associated with us."), "M" => "error");
				
			}else{

				$result = array("C" => 100, "R" => array("msg" => ""), "M" => "success");
			}

			echo json_encode($result); die;

		}else{
			//call by parameter
			return $exist;
		}

	}

}
?>