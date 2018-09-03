<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class facebook_accounts extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$data = array(
			"result" => $this->model->fetch("*", facebook_accounts, "uid = '".session('uid')."' AND status != 2")
		);
		$this->template->title(l('Facebook accounts'));
		$this->template->build('index', $data);
	}

	public function update(){
		$accounts = $this->model->fetch("*", FACEBOOK_ACCOUNTS, getDatabyUser(0));
		$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".get("id")."'".getDatabyUser());
		$data = array(
			'result' => $account,
			'count'  => count($accounts)
		);
		$this->template->title(l('Facebook accounts'));
		$this->template->build('update', $data);
	}

	public function ajax_get_page_token(){
		$username     = post('username');
		$password     = post('password');
	//	$app = post('app');


		if($username == "" && $password == "" && $app == ""){
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Please input all fields')
			));
		}

		if(strlen($password) < 6){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Passwords must be at least 6 characters long')
			));
		}
		$app = session('uid');
		$url = GET_PAGE_ACCESS_TOKEN($username, $password, $app);
        
        //$data = REQUEST_CURL($url);
        //$data = json_decode($data);
        
        if(!empty($data->error_msg)){
		    ms(array(
		    	"st"    => "failed",
		    	"label" => "bg-red",
		    	"txt"   => l('Update failed'),
		    	"url"   => $data->error_msg
		    ));            
        }else {
		    ms(array(
		    	"st"    => "success",
		    	"label" => "bg-light-green",
		    	"txt"   => l('Update successfully'),
		    //	"url"   => $data->access_token
		    	"url"   => $url
		    ));
        }
	}

	public function ajax_update(){
		$username     = post('username');
		$password     = post('password');
		$access_token = $this->input->post('access_token');
		$access_token_parse = json_decode($access_token);
		if(is_object($access_token_parse)){
			if(isset($access_token_parse->access_token)){
				$access_token = $access_token_parse->access_token;
			}
		}

		if($access_token == ""){
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Please enter access token')
			));
		}

		$FbOAuth_App = FbOAuth_Info_App($access_token);

		if(!empty($FbOAuth_App) && isset($FbOAuth_App->error)){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l($FbOAuth_App->error->message)
			));
		}

		$FbOAuth_User = FbOAuth_User($access_token);

		$fid = $FbOAuth_User->id;
		$data = array(
			"uid"           => session("uid"),
			"fid"           => $fid,
			"username"      => (isset($FbOAuth_User->email))?$FbOAuth_User->email:$fid,
			"fullname"      => $FbOAuth_User->name,
			//"password"      => $password,
			"token_name"    => $FbOAuth_App->name,
			"access_token"  => $access_token
		);

		$id = (int)post("id");
		$accounts = $this->model->fetch("*", FACEBOOK_ACCOUNTS, getDatabyUser(0));
		if($id == 0){
			if(count($accounts) < getMaximumAccount()){
				$checkAccount = $this->model->get("*", FACEBOOK_ACCOUNTS, "fid = '".$fid."'".getDatabyUser());
				if(!empty($checkAccount)){
				    $this->db->update(FACEBOOK_ACCOUNTS, $data, "fid = '".$fid."'" );
					ms(array(
						"st"    => "success",
		            	"label" => "bg-light-green",
		            	"txt"   => l('Update successfully')
					));
				} 

				$this->db->insert(FACEBOOK_ACCOUNTS, $data);
				$id = $this->db->insert_id();
				$this->getPages($id, $access_token);
				$this->getGroups($id, $access_token);
				$this->getFriends($id, $username, $password, $fid, $access_token);
			}else{
				ms(array(
					"st"    => "error",
					"label" => "bg-orange",
					"txt"   => l('Oh sorry! You have exceeded the number of accounts allowed, You are only allowed to update your account')
				));
			}
		}else{
			$checkAccount = $this->model->get("*", FACEBOOK_ACCOUNTS, "fid = '".$fid."' AND id != '".$id."'".getDatabyUser());
			if(!empty($checkAccount)){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('This facebook account already exists')
				));
			}

			$this->db->update(FACEBOOK_ACCOUNTS, $data, array("id" => post("id")));
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function getFriends($id, $username, $password = "", $fid = "", $access_token = ""){
		$fiends = FbOAuth_Friends($username, $password, $fid, $access_token);
		//pr($fiends,1);
		if(!empty($fiends)) {
			$count=0;
	        $insert_string = "INSERT INTO `".FACEBOOK_GROUPS."` (`account_id`,`type`,`uid`,`pid`,`name`,`privacy`,`category`,`status`) VALUES ";
			$this->db->delete(FACEBOOK_GROUPS,"account_id = '".$id."' AND type = 'friend'");
			foreach ($fiends as $row) {
				if(isset($row->name)){
					$insert_string .= "('".$id."','friend','".session("uid")."','".$row->id."','".clean($row->name)."','','','1')";
	            	$insert_string .= ",";
            		$count++;
	            }
	        }

	        if($count != 0){
		        $insert_string=substr($insert_string,0,-1);
		        $this->db->query($insert_string);
	        }
		}
	}

	public function getPages($id, $access_token){
		$pages = FbOAuth_Pages($access_token);
		if(isset($pages) && !empty($pages)) {
			$count=0;
	        $insert_string = "INSERT INTO `".FACEBOOK_GROUPS."` (`account_id`,`type`,`uid`,`pid`,`name`,`privacy`,`category`,`status`) VALUES ";
			$this->db->delete(FACEBOOK_GROUPS,"account_id = '".$id."' AND type = 'page'");
			foreach ($pages as $row) {
				if(isset($row->name)){
					$insert_string .= "('".$id."','page','".session("uid")."','".$row->id."','".clean($row->name)."','','".clean($row->category)."','1')";
	            	$insert_string .= ",";
            		$count++;
	            }
	        }

	        if($count != 0){
		        $insert_string=substr($insert_string,0,-1);
		        $this->db->query($insert_string);
	        }
		}
	}

	public function getGroups($id, $access_token){
		$groups = FbOAuth_Groups($access_token);
		if(isset($groups) && !empty($groups)) {
			$count=0;
	        $insert_string = "INSERT INTO `".FACEBOOK_GROUPS."` (`account_id`,`type`,`uid`,`pid`,`name`,`privacy`,`category`,`status`) VALUES ";
			$this->db->delete(FACEBOOK_GROUPS,"account_id = '".$id."' AND type = 'group'");
			foreach ($groups as $row) {
				if(isset($row->name)){
					$insert_string .= "('".$id."','group','".session("uid")."','".$row->id."','".clean($row->name)."','".$row->privacy."','','1')";
	            	$insert_string .= ",";
            		$count++;
	            }
	        }

	        if($count != 0){
		        $insert_string=substr($insert_string,0,-1);
		        $this->db->query($insert_string);
	        }
		}
	}

	public function ajax_get_groups(){
		$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".post("id")."'".getDatabyUser());
		if(!empty($account)){
			switch (post("type")) {
				case 'group':
					$this->getGroups($account->id, $account->access_token);
					break;

				case 'page':
					$this->getPages($account->id, $account->access_token);
					break;

				case 'friend':
					$this->getFriends($account->id, $account->username, $account->password, $account->fid, $account->access_token);
					break;
			}
			ms(array(
				'st' 	=> 'success',
				"label" => "bg-light-green",
				'txt' 	=> l('Successfully')
			));
		}else{
			ms(array(
				'st' 	=> 'error',
				"label" => "bg-red",
				'txt' 	=> l('Update failure')
			));
		}
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', FACEBOOK_ACCOUNTS, "id = '{$id}'".getDatabyUser());
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(FACEBOOK_GROUPS,"account_id = '".$id."'");
					$this->db->delete(FACEBOOK_ACCOUNTS, "id = '{$id}'".getDatabyUser());
					break;
				
				case 'active':
					$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 1), "id = '{$id}'".getDatabyUser());
					break;

				case 'disable':
					$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 0), "id = '{$id}'".getDatabyUser());
					break;
			}
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		));
	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', FACEBOOK_ACCOUNTS, "id = '{$id}'".getDatabyUser());
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(FACEBOOK_GROUPS,"account_id = '".$id."'");
							$this->db->delete(FACEBOOK_ACCOUNTS, "id = '{$id}'".getDatabyUser());
							break;
						case 'active':
							$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 1), "id = '{$id}'".getDatabyUser());
							break;

						case 'disable':
							$this->db->update(FACEBOOK_ACCOUNTS, array("status" => 0), "id = '{$id}'".getDatabyUser());
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		)));
	}
	
}