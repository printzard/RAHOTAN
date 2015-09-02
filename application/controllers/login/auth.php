<?php
class Auth extends CI_controller{
	
	private $uid;
	private $access_token;

	public function __construct(){
			parent::__construct();

			$this->load->library("session");
			$this->load->library("facebook",array(
				'appId' => '490769621090935', 
				'secret' => '7bfffaf7bc5cff3c4d7a2ce29f270b0d'
			));

			$this->uid = $this->facebook->getUser();
			$this->access_token = $this->facebook->getAccessToken();
			$this->facebook->setAccessToken($this->access_token);
	}

	public function index(){
		$this->load->view("test.html", $this);
	}

	public function login(){
		if($this->uid){
			try{
				$me = $this->facebook->api("/me");
				$this->session->set_userdata($me);
				redirect("test.html");
			}catch(FacebookApiException $e){
				$this->uid = NULL;
			}
		}else{
			//login for access token
			die("<script>top.location='".$this->facebook->getLoginUrl(array(
				"scope" => "email",
				"redirect_url" => site_url("login/auth")	 
			))."'</script>");
		}
	}

	public function logout(){
		$this->session->set_userdata("facebook","");
		redirect("login/auth");
	}
}
?>