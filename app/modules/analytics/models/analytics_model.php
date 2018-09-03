<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class analytics_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getAllAccount(){
		$result = $this->model->fetch("*", FACEBOOK_ACCOUNTS, "status = 1".getDatabyUser(), "id", "asc");
		if(!empty($result)){
			foreach ($result as $key => $row) {
				$result[$key]->groups = $this->model->fetch("*", FACEBOOK_GROUPS, "account_id = '".$row->id."' ".getDatabyUser()." AND type = 'page'", "type", "desc");
			}
		}

		return $result;
	}
}
