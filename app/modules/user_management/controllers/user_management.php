<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class user_management extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		if(IS_ADMIN != 1) redirect(PATH."dashboard");
		$data = array(
			"result" => $this->model->getUserList()
		);
		$this->template->title(l('User management'));
		$this->template->build('index', $data);
	}
    public function thanhtoan(){
        $data = array ('amount' => get('amount'),
                        'receiver_account' =>  get('receiver_account')) ;
        print_r ($data);
    }
    
    
	public function update(){
		if(IS_ADMIN != 1) redirect(PATH."dashboard");
		$data = array(
			"result"  => $this->model->get("*", USER_MANAGEMENT, "id = '".get("id")."'"),
			"package" => $this->model->fetch("*", PACKAGE)
		);
		$this->template->title(l('User management'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
		if(IS_ADMIN != 1) redirect(PATH."dashboard");
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
		if(IS_ADMIN != 1) redirect(PATH."dashboard");
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
		if(IS_ADMIN != 1) redirect(PATH."dashboard");
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

    
    
	public function profile(){
		$user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
		if(empty($user)) redirect(PATH);
		
		$user_rfid = $this->model->fetch("affiliate", USER_MANAGEMENT, "history_id = '".session("uid")."'");
		$count_userrf = count ($user_rfid);
        $affiliate = $user->affiliate;
        
        $affiliate= json_decode($affiliate);
        $coupons = $affiliate->coupon;
    
        if(!empty($coupons)){
        foreach ($coupons as $key => $row){
            $userrf  = $this->model->fetch("affiliate", USER_MANAGEMENT, "history_id = '".$row."'");
            // tong so nguoi da gioi thieu
            $count_userrf += count ($userrf) ;    
            
            // tong so hoa hong
            if (!empty($userrf)){
                foreach ($userrf as $key1 => $row1){
                    $affliate_info = json_decode ($row1->affiliate);
                 //   print_r ($affliate_info);
                    $sum_commission += $affliate_info->paided;
                }
          }
      }
            $sum_commission = $sum_commission * $affiliate->commission / 100;
        //print_r ($sum_commission);
        //print_r ($count_userrf);
      }
		
		$affiliate->user_rf = $count_userrf;
		$affiliate->sumcommission = $sum_commission;
		$arr_update['affiliate'] = json_encode ($affiliate);
		 $this->db->update (USER_MANAGEMENT,$arr_update, "id = '".session("uid")."'");
		 
		$data = array(
			"result"  => $user,
			"user_rf" => $count_userrf,
			"commission" =>$sum_commission,
		);
		$this->template->title('Dashboard');
		$this->template->build('profile', $data);
	}

	public function ajax_profile(){
		$id = (int)post("id");

		if(post("fullname") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Fullname is required')
			));
		}
		
		if(post("timezone") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Timezone is required')
			));
		}

		$data = array(
			"fullname"        => post("fullname"),
			"timezone"        => post("timezone"),
			"changed"         => NOW
		);

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

		$this->db->update(USER_MANAGEMENT, $data, array("id" => session("uid")));

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

    public function fb_login (){
        $result = array();
		$PACKAGE = $this->model->get("*", PACKAGE, "default_package = 1");
        if(get('code') && get('state')){
					$USER = FACEBOOK_GET_USER();
					if(!empty($USER) && isset($USER['id'])){
						$data = array(
							"type"            => "facebook",
							"pid"             => $USER['id'],
							"fullname"        => $USER['name'],
							"status"          => AUTO_ACTIVE_USER,
							"changed"         => NOW
						);

						if(!empty($PACKAGE)){
							$permission = json_decode($PACKAGE->permission);
							$data["maximum_account"] = $permission->maximum_account;
							$data["maximum_groups"]  = $permission->maximum_groups;
							$data["maximum_pages"]   = $permission->maximum_pages;
							$data["maximum_friends"] = $permission->maximum_friends;
							$data["expiration_date"] = date('Y-m-d', strtotime("+".$PACKAGE->day." days"));
						}else{
							$data["expiration_date"] = date('Y-m-d');
						}

						if(isset($USER['email'])){
							$data['email'] = $USER['email'];
						}

						if(isset($data['email'])){
							$result = $this->model->get('*', USER_MANAGEMENT, "email = '".$data['email']."'");
						}else{
							$result = $this->model->get('*', USER_MANAGEMENT, "pid = '".$USER['id']."'");
						}
						if(empty($result)){
							if(REGISTER_ALLOWED == 1){
								$data["created"] = NOW;
								$this->db->insert(USER_MANAGEMENT, $data);
								$id = $this->db->insert_id();
								$result = $this->model->get('*', USER_MANAGEMENT, "id = '".$id."'");
							}
						}else{
							$this->db->update(USER_MANAGEMENT, $data, array('id' => $result->id));
						}
					}
				}
    }
    
	public function openid($type = ""){
		$result = array();
		$PACKAGE = $this->model->get("*", PACKAGE, "default_package = 1");
		switch ($type) {
			case 'facebook':
				if(get('code') && get('state')){
					$USER = FACEBOOK_GET_USER();
					if(!empty($USER) && isset($USER['id'])){
						$data = array(
							"type"            => "facebook",
							"pid"             => $USER['id'],
							"fullname"        => $USER['name'],
							"status"          => AUTO_ACTIVE_USER,
							"changed"         => NOW
						);

						if(!empty($PACKAGE)){
							$permission = json_decode($PACKAGE->permission);
							$data["maximum_account"] = $permission->maximum_account;
							$data["maximum_groups"]  = $permission->maximum_groups;
							$data["maximum_pages"]   = $permission->maximum_pages;
							$data["maximum_friends"] = $permission->maximum_friends;
							$data["expiration_date"] = date('Y-m-d', strtotime("+".$PACKAGE->day." days"));
						}else{
							$data["expiration_date"] = date('Y-m-d');
						}

						if(isset($USER['email'])){
							$data['email'] = $USER['email'];
						}

						if(isset($data['email'])){
							$result = $this->model->get('*', USER_MANAGEMENT, "email = '".$data['email']."'");
						}else{
							$result = $this->model->get('*', USER_MANAGEMENT, "pid = '".$USER['id']."'");
						}
						if(empty($result)){
							if(REGISTER_ALLOWED == 1){
								$data["created"] = NOW;
								$this->db->insert(USER_MANAGEMENT, $data);
								$id = $this->db->insert_id();
								$result = $this->model->get('*', USER_MANAGEMENT, "id = '".$id."'");
							}
						}else{
							$this->db->update(USER_MANAGEMENT, $data, array('id' => $result->id));
						}
					}
				}
				break;
			case 'google':
				if(get('code')){
					$USER = GOOGLE_GET_USER(get('code'));
					if(!empty($USER)){
						$data = array(
							"type"            => "google",
							"pid"             => $USER->id,
							"fullname"        => $USER->name,
							"email"           => $USER->email,
							"status"          => AUTO_ACTIVE_USER,
							"changed"         => NOW
						);

						if(!empty($PACKAGE)){
							$permission = json_decode($PACKAGE->permission);
							$data["maximum_account"] = $permission->maximum_account;
							$data["maximum_groups"]  = $permission->maximum_groups;
							$data["maximum_pages"]   = $permission->maximum_pages;
							$data["maximum_friends"] = $permission->maximum_friends;
							$data["expiration_date"] = date('Y-m-d', strtotime("+".$PACKAGE->day." days"));
						}else{
							$data["expiration_date"] = date('Y-m-d');
						}

						$result = $this->model->get('*', USER_MANAGEMENT, "email = '".$USER->email."'");
						if(empty($result)){
							if(REGISTER_ALLOWED == 1){
								$data["created"] = NOW;
								$this->db->insert(USER_MANAGEMENT, $data);
								$id = $this->db->insert_id();
								$result = $this->model->get('*', USER_MANAGEMENT, "id = '".$id."'");
							}
						}else{
							$this->db->update(USER_MANAGEMENT, $data, array('id' => $result->id));
						}
					}
				}
				break;
			case 'twitter':
				if(get('oauth_token') && get('oauth_verifier')){
					$USER = TWITTER_GET_USER();
					if(!empty($USER)){
						$data = array(
							"type"            => "twitter",
							"pid"             => $USER->id_str,
							"fullname"        => $USER->name,
							"status"          => AUTO_ACTIVE_USER,
							"changed"         => NOW
						);

						if(!empty($PACKAGE)){
							$permission = json_decode($PACKAGE->permission);
							$data["maximum_account"] = $permission->maximum_account;
							$data["maximum_groups"]  = $permission->maximum_groups;
							$data["maximum_pages"]   = $permission->maximum_pages;
							$data["maximum_friends"] = $permission->maximum_friends;
							$data["expiration_date"] = date('Y-m-d', strtotime("+".$PACKAGE->day." days"));
						}else{
							$data["expiration_date"] = date('Y-m-d');
						}
						
						if(isset($USER->email)){
							$data['email'] = $USER->email;
						}

						if(isset($data['email'])){
							$result = $this->model->get('*', USER_MANAGEMENT, "email = '".$data['email']."'");
						}else{
							$result = $this->model->get('*', USER_MANAGEMENT, "pid = '".$USER->id_str."'");
						}
						if(empty($result)){
							if(REGISTER_ALLOWED == 1){
								$data["created"] = NOW;
								$this->db->insert(USER_MANAGEMENT, $data);
								$id = $this->db->insert_id();
								$result = $this->model->get('*', USER_MANAGEMENT, "id = '".$id."'");
							}
						}else{
							$this->db->update(USER_MANAGEMENT, $data, array('id' => $result->id));
						}
					}
				}
				break;
		}

		if(!empty($result) && $result->status == 1){
			$this->model->session($result);
			redirect(PATH."#login-success");
		}else{
			redirect(PATH."#not-active");
		}
	}

	public function ajax_login(){
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

		if(post("password") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password is required')
			));
		}

		$user = $this->model->get("*", USER_MANAGEMENT, "email = '".post('email')."' AND password = '".md5(post("password"))."'");
		if(!empty($user)){
			if($user->status == 1){
				if(post("remember")){
					$this->input->set_cookie('uid', $user->id, 72000);
				}
				
				$this->model->session($user);
				ms(array(
					"st"    => "success",
					"label" => "bg-light-green",
					"txt"   => l('Login successfully')
				));
			}else{
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Your account has not been activated')
				));
			}
		}else{
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Username or password incorrect')
			));
		}
	}

	public function ajax_register(){
		if(!REGISTER_ALLOWED) redirect(PATH);

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

		if(strlen(post('password')) == ''){
    		ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password is required')
			));
    		exit(0);
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

		$PACKAGE = $this->model->get("*", PACKAGE, "status = 0 or status = 1");
		$POST = $this->model->get('*', USER_MANAGEMENT, "email = '".post('email')."'");
		if(empty($POST)){
			$data = array(
				'fullname'=> post("fullname"),
				'type'    => 'direct',
	    		'email'   => post('email'),
	    		'password'=> md5(post('password')),
	    		'status'  => AUTO_ACTIVE_USER,
	    		'changed' => NOW,
	    		'created' => NOW
	    	);
            
            if (post ("rf")){
                $data['history_id'] = post("rf"); ; 
            }
            if (post ("coupon")){
                $data['history_id'] = post("coupon"); 
            }
            $rfid = $_COOKIE['rf'];
            if ($rfid){
                $data['history_id'] = $rfid;
            }
            
			if(!empty($PACKAGE)){
				$permission = json_decode($PACKAGE->permission);
				$data["maximum_account"] = $permission->maximum_account;
				$data["maximum_groups"]  = $permission->maximum_groups;
				$data["maximum_pages"]   = $permission->maximum_pages;
				$data["maximum_friends"] = $permission->maximum_friends;
				$data["expiration_date"] = date('Y-m-d', strtotime("+".$PACKAGE->day." days"));
			}else{
				$data["expiration_date"] = date('Y-m-d');
			}

    		$this->db->insert(USER_MANAGEMENT, $data);
    		$id = $this->db->insert_id();
    		if(AUTO_ACTIVE_USER == 1){
	    		set_cookie("uid", $id, 1209600);
				set_session("uid", $id);
				if (!file_exists('uploads/user'.(string)$id)) {
		    		mkdir('uploads/user'.$id, 0777, true);
				}
				set_cookie('folderid', 'user'.(string)$id, 86400);
			}
    		ms(array(
				'st' 	=> 'success',
				'label' => "bg-light-green",
				'txt' 	=> l('Register successfully')
			));
    	}else{
    		ms(array(
				'st' 	=> 'error',
				'label' => "bg-red",
				'txt' 	=> l('Email already exists')
			));
    	}
		
	}

	public function ajax_reset_password(){
		if(strlen(post('password')) == ''){
    		ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password is required')
			));
    		exit(0);
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

		$POST = $this->model->get('*', USER_MANAGEMENT, "reset_key = '".post('reset_key')."'");
		if(!empty($POST)){
			$data = array(
	    		'password'=> md5(post('password')),
	    		'reset_key' => md5(time()),
	    		'changed' => NOW,
	    	);

    		$this->db->update(USER_MANAGEMENT, $data, array("id" => $POST->id));
    		
    		ms(array(
				'st' 	=> 'success',
				'label' => "bg-light-green",
				'txt' 	=> l('Successfully')
			));
    	}else{
    		ms(array(
				'st' 	=> 'error',
				'label' => "bg-red",
				'txt' 	=> l('Reset password key not exists')
			));
    	}
	}

	public function ajax_forgot_password(){
		
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

		$POST = $this->model->get('*', USER_MANAGEMENT, "email = '".post('email')."'");
		if(!empty($POST)){
			$reset_key = md5(time().$POST->password);
			$this->db->update(USER_MANAGEMENT, array("reset_key" => $reset_key), array("id" => $POST->id));

			if(send_mail(post("email"), $reset_key)){
				ms(array(
					'st' 	=> 'success',
					'label' => "bg-light-green",
					'txt' 	=> l('Please check your email to reset password')
				));
			}else{
				ms(array(
					'st' 	=> 'error',
					'label' => "bg-red",
					'txt' 	=> l('An error occurred. Please try again later')
				));
			}
    	}else{
    		ms(array(
				'st' 	=> 'error',
				'label' => "bg-red",
				'txt' 	=> l('This email address does not exist')
			));
    	}
	}

	public function ajax_timezone(){
		if(session("uid")){
			$this->db->update(USER_MANAGEMENT, array("timezone" => post("timezone")), array("id" => (int)session("uid")));
			ms(array(
				"st"    => "success",
				"label" => "bg-light-green",
				"txt"   => l('Update successfully')
			));
		}
	}
}