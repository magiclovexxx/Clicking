<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class package_settings extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view(true);
	}

	public function index(){
		$data = array(
			"result" => $this->model->fetch("*", PACKAGE, "", "id", "DESC")
		);
		$this->template->title(l('Package settings'));
		$this->template->build('index', $data);
	}

	public function update(){
		$data = array(
			"result" => $this->model->get("*", PACKAGE, "id = '".get("id")."'")
		);
		$this->template->title(l('Package settings'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
		$id = (int)post("id");

		if(post("name") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Name is required')
			));
		}

		$groups = (int)post("maximum_groups");
		$pages  = (int)post("maximum_pages");
		$friends  = (int)post("maximum_friends");

		$modules = array(
			"maximum_account"        => (int)post("maximum_account"),
			"maximum_groups"         => $groups,
			"maximum_pages"          => $pages,
			"maximum_friends"        => $friends,
			"agency"                 => (int)post("agency_lv1"),
			"add_data"               => (int)post("add_data"),
			"auto_all"               => (int)post("auto_all"),
			"auto_seeding"           => (int)post("auto_seeding"),
			"loctuongtac"            => (int)post("loctuongtac"),
			"content"                => (int)post("content"),
			"post"                   => (int)post("post"),
			"post_wall_friends"      => (int)post("post_wall_friends"),
			"repost_pages"           => (int)post("repost_pages"),
			"bulk_comment"           => (int)post("bulk_comment"),
			"bulk_like"              => (int)post("bulk_like"),
			"join_groups"            => (int)post("join_groups"),
			"add_friends"            => (int)post("add_friends"),
			"unfriends"              => (int)post("unfriends"),
			"invite_to_groups"       => (int)post("invite_to_groups"),
			"invite_to_pages"        => (int)post("invite_to_pages"),
			"accept_friend_request"  => (int)post("accept_friend_request"),
			"comment"                => (int)post("comment"),
			"like"                   => (int)post("like"),
			"search"                 => (int)post("search"),
			"analytics"              => (int)post("analytics")
		);

		if(post("type") == ""){
			if(post("price") == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Price is required')
				));
			}

			if(post("day") == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Day is required')
				));
			}

			$data = array(
				"name"  => post("name"),
				"type"  => 2,
				"price" => (float)post("price"),
				"day"   => (int)post("day"),
				"orders"=> (int)post("orders"),
				"permission" => json_encode($modules),
				"default_package" => (int)post("default"),
				"changed" => NOW
			);
		}else{
			$data = array(
				"name"  => post("name"),
				"type"  => (int)post("type"),
				"price" => 0,
				"day"   => (int)post("day"),
				"orders"=> (int)post("orders"),
				"permission" => json_encode($modules),
				"default_package" => (int)post("default"),
				"changed" => NOW
			);
		}
		
		if($id == 0){
			$data['created'] = NOW;
			$this->db->insert(PACKAGE, $data);
			$id = $this->db->insert_id();
		}else{
			$this->db->update(PACKAGE, $data, array("id" => $id));
		}

		if((int)post("default") == 1){
			$this->db->update(PACKAGE, array("default_package" => 0), "id != '".$id."'");
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', PACKAGE, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(PACKAGE, "id = '{$id}' AND type = '2'");
					break;
				
				case 'active':
					$this->db->update(PACKAGE, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(PACKAGE, array("status" => 0), "id = '{$id}'");
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
				$POST = $this->model->get('*', PACKAGE, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(PACKAGE, "id = '{$id}' AND type = '2'");
							break;
						case 'active':
							$this->db->update(PACKAGE, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(PACKAGE, array("status" => 0), "id = '{$id}'");
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
}