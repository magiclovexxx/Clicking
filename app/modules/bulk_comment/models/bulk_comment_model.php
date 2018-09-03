<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bulk_comment_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getAllAccount(){
		$result = $this->model->fetch("*", FACEBOOK_ACCOUNTS, "status = 1".getDatabyUser(), "id", "asc");
		return $result;
	}
}
