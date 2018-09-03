<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class search extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"accounts" => $this->model->fetch("*", FACEBOOK_ACCOUNTS, "status = 1".getDatabyUser())
		);
		$this->template->title(l('Facebook search'));
		$this->template->build('index', $data); 
	}
	
	public function ajax_search(){
		$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "status = 1 AND id = '".post("account")."'".getDatabyUser());
		if(empty($account)){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Facebook account not exist')
			));
		}

		if(post('keyword') == "" && post("type") != "member"){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Keyword is requied')
			)); 
		}

		$result = FbOAuth_Search(array(
			"access_token" => $account->access_token,
			"limit"        => post("limit"),
			"type"         => post("type"),
			"id"           => post("id"),
			"keyword"      => post("keyword")
		));

		$data = array(
			"result" => $result
		);

		$this->load->view("ajax_".post("type"), $data);
	}
}