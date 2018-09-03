<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class auto_seeding extends MX_Controller {

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
		$this->template->title(l('Auto seeding'));
		$this->template->build('index', $data);
	}

	public function ajax_save_schedules(){
		$data   = array();
		$groups = $this->input->post('id');
		$ids    = json_encode($this->input->post('type_post'));
        $token  = $this->model->fetch("*", token, "status = 1"); 
        
		if(!post("group_id")){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Page ID is requied')
			));
		}

		$data = array(
			"title"       => post("group_id"),
			"caption"     => $ids,
			"category"    => "auto_seeding",
			"type"        => "bulk_comment"
		);

		if(post('time_post') == ""){
			$json[] = array(
				"st"    => "valid",
				"label" => "bg-red",
				"text"  => l('Time post is required')
			);
		}

		if(post('message') == ""){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Message is required'),
			));
		}

/*		if(empty($groups)){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Select at least a profiles')
			));
		} */
		
		$data["repeat_post"] = 1;
		
		$count = 0;
		$deplay = (int)post('deplay');
		//$number_comment = (int) post('number_comment');

		$time_post_show = strtotime(post('time_post').":00");
		$time_now  = strtotime(NOW) + 60;
		if($time_post_show < $time_now){
			$time_post_show = $time_now;
		}

		$date = new DateTime(date("Y-m-d H:i:s", $time_post_show), new DateTimeZone(TIMEZONE_USER));
		$date->setTimezone(new DateTimeZone(TIMEZONE_USER));
		$time_post = $date->format('Y-m-d H:i:s');

		$data["uid"]            = session("uid");
		$data["group_type"]     = "profile";
		$data["account_id"]     = "0";
		$data["account_name"]   = "0";
        
		$data["group_id"]       = "0";
		$data["name"]           = "0";
		$data["privacy"]        = "0";

		
		$messages               = post ('message');
		$data["message"]        = $messages;
		$messages2              = explode("\n", $messages) ;
		
		$data["auto_comment"]   =  count ($messages2);
		
		$data["time_post"]      = date("Y-m-d H:i:s", strtotime($time_post));
		$data["time_post_show"] = date("Y-m-d H:i:s", $time_post_show);
		$data["status"]         = 1;

		$data["deplay"]         = $deplay;
		$data["changed"]        = NOW;
		$data["created"]        = NOW;
        $data["bot_like"]       = "";
		$this->db->insert(FACEBOOK_SCHEDULES, $data);
		$count++;

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