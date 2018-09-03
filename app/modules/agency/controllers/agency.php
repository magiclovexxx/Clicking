<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class agency extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
	    if(IS_ADMIN != 1){
		$data = array(
			"result" => $this->model->fetch("*", facebook_accounts, "uid = '".session('uid')."' AND status = 2")
		);}else
		{
		    $data = array(
			"result" => $this->model->fetch("*", facebook_accounts, "status = 2")
		);
		   
		}
		$this->template->title(l('User management'));
		$this->template->build('index', $data);
	}

	public function update(){
	    if(IS_ADMIN != 1){
		$data = array(
			"result" => $this->model->fetch("*", facebook_accounts, "uid = '".session('uid')."' AND status = 2")
		);}else
		{
		    $data = array(
			"result" => $this->model->fetch("*", facebook_accounts, "status = 2")
		);
		}
		$this->template->title(l('Update customer'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
	//	if(IS_ADMIN != 1) redirect(PATH."dashboard");
		//$id = (int)post("id");

		if(post("id_facebook") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('id is required')
			));
		}

		if(post("email") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Email is required')
			));
		}

		if(!filter_var(post("email"), FILTER_VALIDATE_EMAIL)){
		  	ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Invalid email format')
			));
		}

		if(post("expiration_date") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Expiration date is required')
			));
		}

		$data = array(
			"fid"         => post("id_facebook"),
			"uid"         => session('uid'),
			"username"            => post("email"),
			"status"    => "2",
			"expiration_date"  => date("Y-m-d", strtotime(post("expiration_date"))),
		);

        $checkid = $this->model->fetch("*", facebook_accounts, "fid ='".$data["fid"]."'");
        
		if(empty($checkid)){
 
			$this->db->insert(facebook_accounts, $data);

		}else{

			$this->db->update(facebook_accounts, $data, "fid = '".$data["fid"]."'");
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', FACEBOOK_ACCOUNTS, "fid = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(FACEBOOK_ACCOUNTS, "fid = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 2), "fid = '{$id}'");
					break;

				case 'disable':
					$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 0), "fid = '{$id}'");
					break;
			}
		}
    		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));

	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', FACEBOOK_ACCOUNTS, "fid = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(FACEBOOK_ACCOUNTS, "fid = '{$id}'");
							break;
						case 'active':
							$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 2), "fid = '{$id}'");
							break;

						case 'disable':
							$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 0), "fid = '{$id}'");
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('Update successfully')
		)));
	}

}