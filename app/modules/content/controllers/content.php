<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class content extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
	     
		$data = array(
		    "category_data" => $this->model->fetch("*", category_data, "status = 1"),
			"result"  => $this->model->fetch("*", save_data, "caption>2000", "id", "DESC"),
		);
		$this->template->title(l('Content'));
		$this->template->build('index', $data);
	}
}