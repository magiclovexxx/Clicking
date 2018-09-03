<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class agency extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"result" => $this->model->fetch("*", USER_MANAGEMENT, "history_id = '".session('uid')."'")
		);
		$this->template->title(l('Quản lý'));
		$this->template->build('index', $data);
	}

	public function update(){
	//	if(IS_ADMIN != 1) redirect(PATH."dashboard");
		$data = array(
			"result"  => $this->model->get("*", USER_MANAGEMENT, "id = '".get("id")."'"),
			"package" => $this->model->fetch("*", PACKAGE)
		);
		$this->template->title(l('User management'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
	//	if(IS_ADMIN != 1) redirect(PATH."dashboard");
		$id = (int)post("id");
        $result  = $this->model->get("*", USER_MANAGEMENT, "id = {$id}");
        $affiliate = $result->affiliate;
        $affiliate = json_decode ($affiliate);
        
		if(post("fullname") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Fullname is required')
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

		if(post("timezone") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Timezone is required')
			));
		}

		$groups = (int)post("maximum_groups");
		$pages  = (int)post("maximum_pages");
		$friends  = (int)post("maximum_friends");
       		$package_id = post("package-id");
        	$package_id = explode('|', $package_id);
		$data = array(
			"fullname"         => post("fullname"),
			"package_id"       => $package_id[1],
			"email"            => post("email"),
			"admin"            => (int)post("admin"),
			"maximum_account"  => (int)post("maximum_account"),
			"maximum_groups"   => $groups,
			"maximum_pages"    => $pages,
			"maximum_friends"  => $friends,
			"expiration_date"  => date("Y-m-d", strtotime(post("expiration_date"))),
			"timezone"         => post("timezone"),
			"status"           => (int)post("status"),
			"changed"          => NOW
		);

		if((post("commission")) > 100){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Commission < 100%')
			));
		}
		
		if (!post("commission")){
		    $affiliate->commission = "15";
		}else{ 
            $affiliate->commission = (int)post("commission");
		}
		
		$affiliate->paided = (int)post("paided");
		$affiliate->user_rf = "0";
		$affiliate->coupon = array ();
        $data["affiliate"] = json_encode ($affiliate);
        
        
		if($id == 0){
			if(post("password") == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Password is required')
				));
			}

			if(strlen(post("password")) < 6){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Passwords must be at least 6 characters')
				));
			}

			if(post("password") != post("repassword")){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Password incorrect')
				));
			}

			$data["password"] = md5(post("password"));
			$data["type"]     = "direct";
			$data["created"]  = NOW;

			$this->db->insert(USER_MANAGEMENT, $data);
			$id = $this->db->insert_id();
		}else{
			if(post("password") != ""){
				if(strlen(post("password")) < 6){
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => l('Passwords must be at least 6 characters')
					));
				}

				if(post("password") != post("repassword")){
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => l('Password incorrect')
					));
				}

				$data["password"] = md5(post("password"));
			}

			$this->db->update(USER_MANAGEMENT, $data, array("id" => $id));
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
	//	if(IS_ADMIN != 1) redirect(PATH."dashboard");
		$id = (int)post('id');
		$POST = $this->model->get('*', USER_MANAGEMENT, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(USER_MANAGEMENT, "id = '{$id}'");
					$this->db->delete(FACEBOOK_ACCOUNTS, "uid = '{$id}'");
					$this->db->delete(FACEBOOK_SCHEDULES, "uid = '{$id}'");
					$this->db->delete(SAVE, "uid = '{$id}'");
					$this->db->delete(CATEGORIES, "uid = '{$id}'");
					$this->db->delete(facebook_groups, "uid = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(USER_MANAGEMENT, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(USER_MANAGEMENT, array("status" => 0), "id = '{$id}'");
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
	//	if(IS_ADMIN != 1) redirect(PATH."dashboard");
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', USER_MANAGEMENT, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(USER_MANAGEMENT, "id = '{$id}'");
							$this->db->delete(FACEBOOK_ACCOUNTS, "uid = '{$id}'");
							$this->db->delete(FACEBOOK_SCHEDULES, "uid = '{$id}'");
							$this->db->delete(SAVE, "uid = '{$id}'");
							$this->db->delete(CATEGORIES, "uid = '{$id}'");
							$this->db->delete(facebook_groups, "uid = '{$id}'");
							break;
						case 'active':
							$this->db->update(USER_MANAGEMENT, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(USER_MANAGEMENT, array("status" => 0), "id = '{$id}'");
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