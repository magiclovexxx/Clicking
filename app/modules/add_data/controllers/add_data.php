<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class add_data extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
	    //$save       = $this->model->fetch("*", SAVE_DATA, "uid = '".session("uid")."'","id", "DESC");
	    date_default_timezone_set('Asia/Ho_Chi_Minh');
	    $date = date('Y-m-d');
	    $dates = strtotime($date);
		$data = array(
			"save_day"       => $this->model->fetch("*", SAVE_DATA, "uid = '".session("uid")."' AND created > '".$date."'","id", "DESC"),
			'save' => $this->model->fetch("*", SAVE_DATA, "uid = '".session("uid")."'","id", "DESC"),
			"category_data"       => $this->model->fetch("*", category_data, "status = 1"),
			
		);
		$this->template->title(l('Thêm nội dung')); 
		$this->template->build('index', $data);
	}

	public function ajax_page(){
	 $save       = $this->model->fetch("*", SAVE_DATA, "uid = '".session("uid")."' AND  ","id", "DESC");
	 
	    
	    
		$data = array(
			
			
			"category_data"       => $this->model->fetch("*", category_data, "status = 1"),
			
		);
	}
	
	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', save_data, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(save_data,"id = '".$id."'");
					break;

			}
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		));
	}

	public function ajax_save_schedules(){
		$data = array();
		$groups = $this->input->post('id');
		switch (post('type')) {
			case 'link':
				if(post('link_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Link is required')
					));
				}

				if (!filter_var(post('link_url'), FILTER_VALIDATE_URL) === true) {
				    ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Link is not a valid')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"url"         => post('link_url'),
					"image"       => post('link_picture'),
					"title"       => post('link_title'),
					"caption"     => post('link_caption'),
					"description" => post('link_description'),
					"message"     => post('message'),
				);
				break;
			case 'image':
				if(post('image_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Image is required')
					));
				}

				$data = array(
					"category"  => "post",
					"type"      => post('type'),
					"image"     => post('image_url'),
					"message"   => post('message')
				);
				break;
			case 'video':
				if(post('video_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Video is required')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"image"       => post('video_url'),
					"description" => post('video_description'),
					"message"     => post('message'),
				);
				break;
			default:
				if(post('message') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Message is required'),
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"message"     => post('message'),
				);
				break;
		}

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
				"txt"   => l('Select at least a Page/Group/Profile')
			));
		}

		if(post('auto_repeat') != 0){
			$data["repeat_post"] = 1;
			$data["repeat_time"] = (int)post("auto_repeat");
			$data["repeat_end"]  = date("Y-m-d", strtotime(post('repeat_end')));
		}else{
			$data["repeat_post"] = 0;
		}

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
		$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
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