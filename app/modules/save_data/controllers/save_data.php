<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class save_data extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$type = segment(2);
		$data = array(
			"result" => $this->model->getSave($type)
		);
		$this->template->title(l('Save management'));
		$this->template->build('index', $data);
	}
	
	public function ajax_save(){
		$data = array();
		switch (post("category")) {
			case 'post':
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
					case 'images':
						if(!post('images_url[]')){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Images is required')
							));
						}

						if(count(post('images_url[]')) < 2){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Add at least two images')
							));
						}

				/*		if(count(post('images_url[]')) > 3){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Add maximum three images')
							));
						} */

						$data = array(
							"category"    => "post",
							"type"        => post('type'),
							"image"       => json_encode(post("images_url[]")),
							"message"     => html_convert(post('message')),
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
					case 'text':
						if(post('message') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Message is required'),
							));
						}

						$data = array(
							"category"  => "post",
							"type"      => post('type'),
							"message"   => post('message'),
						);
						break;
				}
				break;
			
			case 'friend':
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
							"category"    => "friend",
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
							"category"  => "friend",
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
							"category"    => "friend",
							"type"        => post('type'),
							"image"       => post('video_url'),
							"description" => post('video_description'),
							"message"     => post('message'),
						);
						break;
					case 'text':
						if(post('message') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Message is required'),
							));
						}

						$data = array(
							"category"  => "friend",
							"type"      => post('type'),
							"message"   => post('message'),
						);
						break;
				}
				break;

			case 'message':
				if(post('message') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Message is required')
					));
				}

				if (post('link') != "" && !filter_var(post('link'), FILTER_VALIDATE_URL) === true) {
				    ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Link is not a valid')
					));
				}

				$data = array(
					"category"    => "message",
					"type"        => "message",
					"url"         => post('link'),
					"message"     => post('message'),
				);
				break;

			case 'comment':
				if(post('message') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Message is required')
					));
				}

				if (post('link') != "" && !filter_var(post('link'), FILTER_VALIDATE_URL) === true) {
				    ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Link is not a valid')
					));
				}

				$data = array(
					"category"    => "comment",
					"type"        => "comment",
					"url"         => post('link'),
					"message"     => post('message'),
				);
				break;

			default:
				# code...
				break;
		}

		if(post('title') == ""){
			ms(array(
				"st"    => "title",
			));
		}else{
			$data["name"]    = filter_input_xss(post('title'));
			$data["uid"]     = (int)session("uid");
			$data["cat_data"]= post('cat_dat');
			$data["created"] = NOW;
		/*	$checkname = $this->model->get("*", SAVE_DATA, "name = '".$data[name]."'");
				if(!empty($checkname)){
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => l('This title already exists')
					));
				} else {*/
			        $this->db->insert(SAVE_DATA, $data);
		        	ms(array(
			        	"st"    => "success",
			        	"label" => "bg-light-green",
			        	"txt"   => l('Save successfully')
		            ));
			//	}
		}
	}

	public function ajax_get_save(){
		$check = $this->model->get("*", SAVE_DATA, "id = '".post("value")."'".getDatabyUser());
		print_r(json_encode($check));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', SAVE_DATA, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(SAVE_DATA, "id = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(SAVE_DATA, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(SAVE_DATA, array("status" => 0), "id = '{$id}'");
					break;
			}
		}

		$json= array(
			'st' 	=> 'success',
			'txt' 	=> l('successfully')
		);

		print_r(json_encode($json));
	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', SAVE_DATA, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(SAVE_DATA, "id = '{$id}'");
							break;
						case 'active':
							$this->db->update(SAVE_DATA, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(SAVE_DATA, array("status" => 0), "id = '{$id}'");
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('-successfully')
		)));
	}
	
	 public function ajax_save_cat (){
	   $data = array(
	       'name' => post('cat_data')
	       );
	       $checkname = $this->model->get("*", CATEGORY_DATA, "name = '".$data[name]."'");
				if(!empty($checkname)){
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => l('This category already exists')
					));
				} else {
			        $this->db->insert(CATEGORY_DATA, $data);
			        ms(array(
				    "st"    => "success",
				    "label" => "bg-light-green",
				    "txt"   => l('Save successfully')
			        ));
				}
    } 
    
    	public function ajax_get_save_cat(){
		$check = $this->model->get("*", CATEGORY_DATA);
		print_r(json_encode($check));
	}
}