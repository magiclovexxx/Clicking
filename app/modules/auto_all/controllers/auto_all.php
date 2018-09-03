<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class auto_all extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"result"     => $this->model->getAllAccount(),
			"category_data"       => $this->model->fetch("*", category_data, "status = 1"),
			"get_data"       => $this->model->fetch("*", save_data, "status = 1"),
			"categories" => $this->model->fetch("*", CATEGORIES, "category = 'post'".getDatabyUser()),
		);
		$this->template->title(l('Auto all')); 
		$this->template->build('index', $data);
		 
	}

	public function ajax_page(){
		$results = $this->model->get_cd_list();
        echo json_encode($results);
	}
	    

	public function ajax_save_schedules(){
		
		$groups = $this->input->post('id');
    	$select_data_cat = post('select_data_cat');
		$get_data = $this->model->fetch("*", save_data, "cat_data = '$select_data_cat'");
		
	    $repeat_end = strtotime(post('repeat_end'));
	    $auto_repeat = ((int)post("auto_repeat"));
	    if(post('time_post') == ""){
			$json[] = array(
				"st"    => "valid",
				"label" => "bg-red",
				"text"  => l('Time post is required')
			);
		}
        
        $time_now  = strtotime(NOW) + 60;
        $time_post_show1 = strtotime(post('time_post').":00");
        
			if(empty($groups)){
				ms(array(
					"st"    => "valid",
					"label" => "bg-red",
					"txt"   => l('Select at least a Page/Group/Profile')
				));
			}
	
			$count = 0;
			$deplay = (int)post('deplay')*60;
			$list_deplay = array();
			
			for ($i=0; $i < count($groups); $i++) { 
				$list_deplay[] = $deplay*$i;
			}

			shuffle($list_deplay);
			$time_post_show = strtotime(post('time_post').":00");
	
			$date = new DateTime(date("Y-m-d H:i:s", $time_post_show), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			
			foreach ($groups as $key => $group) {
			    $data = 0;
		    	$rand_data = rand(0, (count($get_data)-1));
                $data2 = (array)$get_data[$rand_data];
		    	$data = array(
		    		"category"    => $data2[category],
		    		"type"        => $data2[type],
		    		"url"         => $data2[url],
		    		"image"       => $data2[image],
		    		"title"       => $data2[title],
		    		"caption"     => $data2[caption],
		    		"description" => $data2[description],
		    		"message"     => $data2[message],
		    		"bot_like"    => 0
		    	);
                $data["cat_data"] = $select_data_cat;
			    
				$group  = explode("{-}", $group);
				if(count($group) == 6){
					$data["uid"]            = session("uid");
					$data["group_type"]     = $group[0];
					$data["account_id"]     = $group[1];
					$data["account_name"]   = $group[2];
					$data["group_id"]       = $group[3];
					$data["name"]           = $group[4];
					$data["privacy"]        = $group[5];
					$data["unique_content"] = 0;
					$data["unique_link"]    = 0;
					$rand_post = rand(120,180);
					$data["time_post"]      = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key] + $rand_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", $time_post_show + $list_deplay[$key] + $rand_post);
					$data["deplay"]         = $deplay;
					$data["changed"]        = NOW;
					$data["created"]        = NOW;
					$data["status"]         = 1;
					if($auto_repeat != 0){
				        $data["repeat_post"] = 8;
				        $data["repeat_time"] = $auto_repeat;
				        $data["repeat_end"]  = date("Y-m-d", $repeat_end);
			        }else{
				    $data["repeat_post"] = 0;
			        }
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