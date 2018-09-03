<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class analytics extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"result" => $this->model->getAllAccount()
		);
		$this->template->title(l('Analytics page'));
		$this->template->build('index', $data);
	}

	public function page(){
		if(segment(3) == ""){
			redirect(url('analytics'));
		}

		$page = $this->model->get("*", FACEBOOK_GROUPS, "id = '".segment(3)."'".getDatabyUser());
		if(empty($page)){
			redirect(url('analytics'));
		}

		$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$page->account_id."'".getDatabyUser());
		if(empty($account)){
			redirect(url('analytics'));
		}

		$pageid      = $page->pid;
		$access_token = FbOAuth_Access_Token_Page($page->pid, $account->access_token);

		if(!$access_token){
			redirect(url('analytics'));
		}

		set_session("pageid", $pageid);
		set_session("access_token_page", $access_token);

		$data = array(
			'info'    => FB_PAGE($access_token, $pageid)
		);

		$this->template->title(l('Analytics page'));
		$this->template->build('analytics', $data);
	}

	//Ajax 
	public function ajax_reachchart(){
		$data = array(
			'data_reach'              => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_impressions_unique/day"),
			'data_impressions'        => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_impressions/day"),
			'data_reach_paid'         => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_impressions_paid_unique/day"),
			'data_reach_organic'      => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_impressions_organic_unique/day"),
			'data_impressions_paid'   => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_impressions_paid/day"),
			'data_impressions_organic'=> FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_impressions_organic/day")
		);
		$this->load->view('chart/rearch', $data, false);
	}

	public function ajax_postschart(){
		$data = array(
			'data_page_engaged_users'                            => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_engaged_users/day"),
			'data_page_consumptions'                             => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_consumptions/day"),
			'data_page_consumptions_unique'                      => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_consumptions_unique/day"),
			'data_negative'                                      => FB_DATA_NEGATIVE(session('access_token_page'), session('pageid'), "insights/page_negative_feedback_by_type/day"),
			'data_page_positive_feedback_by_type'                => FB_DATA_POSITIVE_FEEDBACK(session('access_token_page'), session('pageid'), "insights/page_positive_feedback_by_type_unique/day"),
			'data_page_consumptions_by_consumption_type_unique'  => FB_DATA_CLICK_BY_TYPE(session('access_token_page'), session('pageid'), "insights/page_consumptions_by_consumption_type_unique/day"),
			'data_page_posts_impressions_frequency_distribution' => FB_DATA_FREQUENCY(session('access_token_page'), session('pageid'), "insights/page_posts_impressions_frequency_distribution/day"),
			'data_posts_reach'              => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_posts_impressions_unique/day"),
			'data_posts_impressions'        => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_posts_impressions/day"),
			'data_posts_reach_paid'         => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_posts_impressions_paid_unique/day"),
			'data_posts_reach_organic'      => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_posts_impressions_organic_unique/day"),
			'data_posts_impressions_paid'   => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_posts_impressions_paid/day"),
			'data_posts_impressions_organic'=> FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_posts_impressions_organic/day")
		);
		$this->load->view('chart/posts', $data, false);
	}

	public function ajax_tabchart(){
		$data = array(

			'data_tab'                                      => FB_DATA_TAB(session('access_token_page'), session('pageid'), "insights/page_tab_views_login_top_unique/day"),
			'data_page_impressions_frequency_distribution'  => FB_DATA_FREQUENCY(session('access_token_page'), session('pageid'), "insights/page_impressions_frequency_distribution/day"),
			'data_page_storytellers_by_story_type'          => FB_DATA_STRORYTELLERS(session('access_token_page'), session('pageid'), "insights/page_storytellers_by_story_type/day"),
		);
		$this->load->view('chart/tab', $data, false);
	}

	public function ajax_fanschart(){
		$data = array(
			'data_fanshour' => FB_DATA_FANS_ONLINE(session('access_token_page'), session('pageid'), "insights/page_fans_online/day"),
			'data_fansday'  => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_fans_online_per_day/day"),
		);
		$this->load->view('chart/fans', $data, false);
	}

	public function ajax_likeschart(){
		$data = array(
			'data_fans'        => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_fans/lifetime"),
			'data_fan_adds'    => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_fan_adds/day"),
			'data_fan_removes' => FB_Analytics_Data(session('access_token_page'), session('pageid'), "insights/page_fan_removes/day")
		);
		$this->load->view('chart/likes', $data, false);
	}

	public function ajax_genderchart(){
		$data = array(
			'data_fans_gender_age'                       => FB_DATA_GENDER(session('access_token_page'), session('pageid'), "insights/page_fans_gender_age/lifetime"),
			'data_fans_storytellers_gender_age'          => FB_DATA_GENDER(session('access_token_page'), session('pageid'), "insights/page_storytellers_by_age_gender/day"),
			'data_page_impressions_by_age_gender_unique' => FB_DATA_GENDER(session('access_token_page'), session('pageid'), "insights/page_impressions_by_age_gender_unique/day")
		);
		
		$this->load->view('chart/gender', $data, false);
	}

	public function ajax_countrychart(){
		$data = array(
			'data_page_fans_country'                  => FB_DATA_COUNTRY(session('access_token_page'), session('pageid'), "insights/page_fans_country/lifetime"),
			'data_page_storytellers_by_country'       => FB_DATA_COUNTRY(session('access_token_page'), session('pageid'), "insights/page_storytellers_by_country/day"),
			'data_page_impressions_by_country_unique' => FB_DATA_COUNTRY(session('access_token_page'), session('pageid'), "insights/page_impressions_by_country_unique/day")
		);
		
		$this->load->view('chart/country', $data, false);
	}

	public function ajax_citychart(){
		$data = array(
			'data_page_fans_city'                  => FB_DATA_COUNTRY(session('access_token_page'), session('pageid'), "insights/page_fans_city/lifetime"),
			'data_page_storytellers_by_city'       => FB_DATA_COUNTRY(session('access_token_page'), session('pageid'), "insights/page_storytellers_by_city/day"),
			'data_page_impressions_by_city_unique' => FB_DATA_COUNTRY(session('access_token_page'), session('pageid'), "insights/page_impressions_by_city_unique/day")
		);
		
		$this->load->view('chart/city', $data, false);
	}
	
	public function ajax_sourcechart(){
		$data = array(
			'data_page_views_external_referrals' => FB_DATA_REFERRERS(session('access_token_page'), session('pageid'), "insights/page_views_external_referrals/day"),
			'data_page_fans_by_like_source'      => FB_DATA_SOURCE(session('access_token_page'), session('pageid'), "insights/page_fans_by_like_source/day"),
		);
		
		$this->load->view('chart/source', $data, false);
	}
}