<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class repost_pages extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"result"  => $this->model->getAllAccount(),
			"accounts" => $this->model->fetch("*", FACEBOOK_ACCOUNTS, "status = 1".getDatabyUser())
		);
		$this->template->title(l('Auto repost pages'));
		$this->template->build('index', $data);
	}

	public function replace(){
		$data = array(
			"result" => $this->model->fetch("*", REPOST_REPLACE, "uid = '".session("uid")."'")
		);
		$this->template->title(l('Auto repost pages'));
		$this->template->build('replace', $data);
	}

	public function ajax_update(){
		$find     = post('find');
		$replace  = post('replace');

		if($find == ""){
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Find text is requied')
			));
		}

		$id = (int)post("id");

		$data = array(
			"finds" => $find,
			"replaces" => $replace,
			"uid" => session("uid")
		);

		if($id == 0){
			$check = $this->model->get("*", REPOST_REPLACE, "finds = '".$find."' AND uid = '".session("uid")."'");
			if(!empty($check)){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('This find text already exists')
				));
			}

			$this->db->insert(REPOST_REPLACE, $data);
			$id = $this->db->insert_id();
		}else{
			$check = $this->model->get("*", REPOST_REPLACE, "finds = '".$find."' AND id != '".$id."' AND uid = '".session("uid")."'");
			if(!empty($check)){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('This facebook account already exists')
				));
			}

			$this->db->update(REPOST_REPLACE, $data, array("id" => post("id")));
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', REPOST_REPLACE, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(REPOST_REPLACE, "id = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(REPOST_REPLACE, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(REPOST_REPLACE, array("status" => 0), "id = '{$id}'");
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
				$POST = $this->model->get('*', REPOST_REPLACE, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(REPOST_REPLACE, "id = '{$id}'");
							break;
						case 'active':
							$this->db->update(REPOST_REPLACE, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(REPOST_REPLACE, array("status" => 0), "id = '{$id}'");
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


	public function ajax_save_schedules(){
		$data   = array();
		$groups = $this->input->post('id');
		$ids    = json_encode($this->input->post('type_post'));

		if(!post("group_id")){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Page ID is requied')
			));
		}

		$check_types = $this->input->post('type_post');
		if(empty($check_types)){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Please select a type post')
			));
		}

		$data = array(
			"title"       => post("group_id"),
			"caption"     => $ids,
			"category"    => "repost_pages",
			"type"        => "repost_pages"
		);

		if(post('time_post') == ""){
			$json[] = array(
				"st"    => "valid",
				"label" => "bg-red",
				"text"  => l('Time post is required')
			);
		}

		if(empty($groups)){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Select at least a Pages/Groups/Profiles')
			));
		}

		$data["repeat_post"] = 1;
		
		$count = 0;
		$deplay = (int)post('deplay')*60;
		$list_deplay = array();
		for ($i=0; $i < count($groups); $i++) { 
			$list_deplay[] = $deplay*$i;
		}

		$auto_pause = (int)post('auto_pause');
		if($auto_pause != 0){
			$pause = 0;
			$count_deplay = 0;
			for ($i=0; $i < count($list_deplay); $i++) { 
				$item_deplay = 1;
				if($auto_pause == $count_deplay){
					$pause += post('time_pause')*60;
					$count_deplay = 0;
				}

				$list_deplay[$i] += $pause;
				$count_deplay++;
			}
		}

		shuffle($list_deplay);

		$time_post_show = strtotime(post('time_post').":00");
		$time_now  = strtotime(NOW) + 60;
		if($time_post_show < $time_now){
			$time_post_show = $time_now;
		}

		$date = new DateTime(date("Y-m-d H:i:s", $time_post_show), new DateTimeZone(TIMEZONE_USER));
		$date->setTimezone(new DateTimeZone(TIMEZONE_USER));
		$time_post = $date->format('Y-m-d H:i:s');

		foreach ($groups as $key => $group) {
			$group  = explode("{-}", $group);
			if(count($group) == 6){
				$data["uid"]            = session("uid");
				$data["group_type"]     = $group[0];
				$data["account_id"]     = $group[1];
				$data["account_name"]   = $group[2];
				$data["group_id"]       = $group[3];
				$data["name"]           = $group[4];
				$data["privacy"]        = $group[5];
				$data["time_post"]      = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", $time_post_show + $list_deplay[$key]);
				$data["status"]         = 1;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;
				$data["created"]        = NOW;

				$this->db->insert(FACEBOOK_SCHEDULES, $data);
				$count++;
			}
		}

		if($count != 0){
			ms(array(
				"st"    => "success",
				"label" => "bg-green",
				"txt"   => l('Successfully')
			));
		}else{
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('The error occurred during processing')
			));
		}
	}
}