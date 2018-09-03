<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class dashboard extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$result = $this->model->fetch("*", FACEBOOK_SCHEDULES, getDatabyUser(0));
		$accounts = $this->model->fetch("*", FACEBOOK_ACCOUNTS, getDatabyUser(0));
		$groups = $this->model->countGroup();
		
		//PROCESS GROUPS
		$group_count = array(
			"profile" => count($accounts),
			"page"    => 0,
			"group"   => 0,
			"friend"  => 0
		);

		if(!empty($groups)){
			foreach ($groups as $key => $row) {
				switch ($row->type) {
					case 'friend':
						$group_count['friend'] = $row->total;
						break;
					case 'page':
						$group_count['page'] = $row->total;
						break;
					case 'group':
						$group_count['group'] = $row->total;
						break;
					case 'friend':
						$group_count['friend'] = $row->total;
						break;
				}
			}
		}

		//PROCESS SCHEDULE
		$minday = "";
		$maxday = "";

		$total = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);

		//POST
		$post = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);
		$post_day  = array();

		//FRIEND
		$friend = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);
		$friend_day  = array();

		//LIKE
		$like = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);
		$message_day  = array();

		//JOIN
		$join = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);
		$join_day  = array();

		//ADD FRIEND
		$add = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);
		$add_day  = array();

		//COMMENT
		$comment = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);
		$comment_day  = array();

		//LIKE
		$like = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);
		$like_day  = array();

		if(!empty($post)){
			foreach ($result as $key => $row) {
				switch ($row->category) {
					case 'post':
						$post['total']++;
						$total['total']++;
						switch ($row->status) {
							case 1:
								$post['processing']++;
								$total['processing']++;
								break;
							case 2:
								$post['queue']++;
								$total['queue']++;
								break;
							case 3:
								$post['success']++;
								$total['success']++;

								//Process day
								if(compare_day($minday, $row->created)){
									$minday = date("Y-m-d", strtotime($row->created));
								}

								if(compare_day($maxday, $row->created, "max")){
									$maxday = date("Y-m-d", strtotime($row->created));
								}

								//Process chart day
								$date = date("Y-m-d", strtotime($row->created));
								if(!isset($post_day[$date])){
									$post_day[$date] = 0;
								}
								$post_day[$date] += 1;
								break;
							case 4:
								$post['failure']++;
								$total['failure']++;
								break;
							case 5:
								$post['repeat']++;
								$total['repeat']++;
								break;
						}
						break;

					case 'friend':
						$friend['total']++;
						$total['total']++;
						switch ($row->status) {
							case 1:
								$friend['processing']++;
								$total['processing']++;
								break;
							case 2:
								$friend['queue']++;
								$total['queue']++;
								break;
							case 3:
								$friend['success']++;
								$total['success']++;

								//Process day
								if(compare_day($minday, $row->created)){
									$minday = date("Y-m-d", strtotime($row->created));
								}

								if(compare_day($maxday, $row->created, "max")){
									$maxday = date("Y-m-d", strtotime($row->created));
								}

								//Process chart day
								$date = date("Y-m-d", strtotime($row->created));
								if(!isset($friend_day[$date])){
									$friend_day[$date] = 0;
								}
								$friend_day[$date] += 1;
								break;
							case 4:
								$friend['failure']++;
								$total['failure']++;
								break;
							case 5:
								$friend['repeat']++;
								$total['repeat']++;
								break;
						}
						break;

					case 'like':
						$like['total']++;
						$total['total']++;
						switch ($row->status) {
							case 1:
								$like['processing']++;
								$total['processing']++;
								break;
							case 2:
								$like['queue']++;
								$total['queue']++;
								break;
							case 3:
								$like['success']++;
								$total['success']++;

								//Process day
								if(compare_day($minday, $row->created)){
									$minday = date("Y-m-d", strtotime($row->created));
								}

								if(compare_day($maxday, $row->created, "max")){
									$maxday = date("Y-m-d", strtotime($row->created));
								}

								//Process chart day
								$date = date("Y-m-d", strtotime($row->created));
								if(!isset($like_day[$date])){
									$like_day[$date] = 0;
								}
								$like_day[$date] += 1;
								break;
							case 4:
								$like['failure']++;
								$total['failure']++;
								break;
							case 5:
								$like['repeat']++;
								$total['repeat']++;
								break;
						}
						break;
					
					case 'join':
						$join['total']++;
						$total['total']++;
						switch ($row->status) {
							case 1:
								$join['processing']++;
								$total['processing']++;
								break;
							case 2:
								$join['queue']++;
								$total['queue']++;
								break;
							case 3:
								$join['success']++;
								$total['success']++;

								//Process day
								if(compare_day($minday, $row->created)){
									$minday = date("Y-m-d", strtotime($row->created));
								}

								if(compare_day($maxday, $row->created, "max")){
									$maxday = date("Y-m-d", strtotime($row->created));
								}

								//Process chart day
								$date = date("Y-m-d", strtotime($row->created));
								if(!isset($join_day[$date])){
									$join_day[$date] = 0;
								}
								$join_day[$date] += 1;
								break;
							case 4:
								$join['failure']++;
								$total['failure']++;
								break;
							case 5:
								$join['repeat']++;
								$total['repeat']++;
								break;
						}
						break;

					case 'add':
						$add['total']++;
						$total['total']++;
						switch ($row->status) {
							case 1:
								$add['processing']++;
								$total['processing']++;
								break;
							case 2:
								$add['queue']++;
								$total['queue']++;
								break;
							case 3:
								$add['success']++;
								$total['success']++;

								//Process day
								if(compare_day($minday, $row->created)){
									$minday = date("Y-m-d", strtotime($row->created));
								}

								if(compare_day($maxday, $row->created, "max")){
									$maxday = date("Y-m-d", strtotime($row->created));
								}

								//Process chart day
								$date = date("Y-m-d", strtotime($row->created));
								if(!isset($add_day[$date])){
									$add_day[$date] = 0;
								}
								$add_day[$date] += 1;
								break;
							case 4:
								$add['failure']++;
								$total['failure']++;
								break;
							case 5:
								$add['repeat']++;
								$total['repeat']++;
								break;
						}
						break;

					case 'comment':
						$comment['total']++;
						$total['total']++;
						switch ($row->status) {
							case 1:
								$comment['processing']++;
								$total['processing']++;
								break;
							case 2:
								$comment['queue']++;
								$total['queue']++;
								break;
							case 3:
								$comment['success']++;
								$total['success']++;

								//Process day
								if(compare_day($minday, $row->created)){
									$minday = date("Y-m-d", strtotime($row->created));
								}

								if(compare_day($maxday, $row->created, "max")){
									$maxday = date("Y-m-d", strtotime($row->created));
								}

								//Process chart day
								$date = date("Y-m-d", strtotime($row->created));
								if(!isset($comment_day[$date])){
									$comment_day[$date] = 0;
								}
								$comment_day[$date] += 1;
								break;
							case 4:
								$comment['failure']++;
								$total['failure']++;
								break;
							case 5:
								$comment['repeat']++;
								$total['repeat']++;
								break;
						}
						break;

					case 'like':
						$like['total']++;
						$total['total']++;
						switch ($row->status) {
							case 1:
								$like['processing']++;
								$total['processing']++;
								break;
							case 2:
								$like['queue']++;
								$total['queue']++;
								break;
							case 3:
								$like['success']++;
								$total['success']++;

								//Process day
								if(compare_day($minday, $row->created)){
									$minday = date("Y-m-d", strtotime($row->created));
								}

								if(compare_day($maxday, $row->created, "max")){
									$maxday = date("Y-m-d", strtotime($row->created));
								}

								//Process chart day
								$date = date("Y-m-d", strtotime($row->created));
								if(!isset($like_day[$date])){
									$like_day[$date] = 0;
								}
								$like_day[$date] += 1;
								break;
							case 4:
								$like['failure']++;
								$total['failure']++;
								break;
							case 5:
								$like['repeat']++;
								$total['repeat']++;
								break;
						}
						break;
				}
			}
		}

		//Pie Chart
		$post_pie_chart    = "['Success',".$post['success']."],['Failure',".$post['failure']."],['Repeat',".$post['repeat']."],['Processing',".$post['processing']."]";
		$friend_pie_chart  = "['Success',".$friend['success']."],['Failure',".$friend['failure']."],['Repeat',".$friend['repeat']."],['Processing',".$friend['processing']."]";
		$like_pie_chart = "['Success',".$like['success']."],['Failure',".$like['failure']."],['Repeat',".$like['repeat']."],['Processing',".$like['processing']."]";
		$join_pie_chart    = "['Success',".$join['success']."],['Failure',".$join['failure']."],['Repeat',".$join['repeat']."],['Processing',".$join['processing']."]";
		$add_pie_chart     = "['Success',".$add['success']."],['Failure',".$add['failure']."],['Repeat',".$add['repeat']."],['Processing',".$add['processing']."]";
		$comment_pie_chart = "['Success',".$comment['success']."],['Failure',".$comment['failure']."],['Repeat',".$comment['repeat']."],['Processing',".$comment['processing']."]";
		$like_pie_chart    = "['Success',".$like['success']."],['Failure',".$like['failure']."],['Repeat',".$like['repeat']."],['Processing',".$like['processing']."]";

		//Chart by days
		$post_day_full = array();
		$friend_day_full = array();
		$message_day_full = array();
		$join_day_full = array();
		$add_day_full = array();
		$comment_day_full = array();
		$like_day_full = array();

		$begin = new DateTime($minday);
		$end = new DateTime($maxday);
		$end = $end->modify( '+1 day' ); 
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		foreach ($period as $dt){
			$day = $dt->format("Y-m-d");
			if(isset($post_day[$day])){
				$post_day_full[$day] = $post_day[$day];
			}else{
				$post_day_full[$day] = 0;
			}

			if(isset($friend_day[$day])){
				$friend_day_full[$day] = $friend_day[$day];
			}else{
				$friend_day_full[$day] = 0;
			}

			if(isset($message_day[$day])){
				$message_day_full[$day] = $message_day[$day];
			}else{
				$message_day_full[$day] = 0;
			}

			if(isset($join_day[$day])){
				$join_day_full[$day] = $join_day[$day];
			}else{
				$join_day_full[$day] = 0;
			}

			if(isset($add_day[$day])){
				$add_day_full[$day] = $add_day[$day];
			}else{
				$add_day_full[$day] = 0;
			}

			if(isset($comment_day[$day])){
				$comment_day_full[$day] = $comment_day[$day];
			}else{
				$comment_day_full[$day] = 0;
			}
			
			if(isset($like_day[$day])){
				$like_day_full[$day] = $like_day[$day];
			}else{
				$like_day_full[$day] = 0;
			}
		}

		//POST
		$post_by_day = "";
		if(!empty($post_day_full)){
			foreach ($post_day_full as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$post_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		$post_by_day = substr($post_by_day, 0, -1);

		//FRIEND
		$friend_by_day = "";
		if(!empty($friend_day_full)){
			foreach ($friend_day_full as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$friend_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		$friend_by_day = substr($friend_by_day, 0, -1);

		//MESSAGE
		$message_by_day = "";
		if(!empty($message_day_full)){
			foreach ($message_day_full as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$message_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		$message_by_day = substr($message_by_day, 0, -1);

		//JOIN
		$join_by_day = "";
		if(!empty($join_day_full)){
			foreach ($join_day_full as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$join_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		$join_by_day = substr($join_by_day, 0, -1);

		//ADD FRIEND
		$add_by_day = "";
		if(!empty($add_day_full)){
			foreach ($add_day_full as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$add_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		$add_by_day = substr($add_by_day, 0, -1);

		//COMMENT
		$comment_by_day = "";
		if(!empty($comment_day_full)){
			foreach ($comment_day_full as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$comment_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		$comment_by_day = substr($comment_by_day, 0, -1);

		//LIKE
		$like_by_day = "";
		if(!empty($like_day_full)){
			foreach ($like_day_full as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$like_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		$like_by_day = substr($like_by_day, 0, -1);

		$data = array(
			'group'             => (object)$group_count,
			'total'             => (object)$total,
			'post'              => (object)$post,
			'friend'            => (object)$friend,
			'like'              => (object)$like,
			'join'              => (object)$join,
			'add'               => (object)$add,
			'comment'           => (object)$comment,
			'like'              => (object)$like,
			'post_by_day'       => $post_by_day,
			'friend_by_day'     => $friend_by_day,
			'message_by_day'    => $message_by_day,
			'join_by_day'       => $join_by_day,
			'add_by_day'        => $add_by_day,
			'comment_by_day'    => $comment_by_day,
			'like_by_day'       => $like_by_day,
			'post_pie_chart'    => $post_pie_chart,
			'friend_pie_chart'  => $friend_pie_chart,
			'like_pie_chart'    => $like_pie_chart,
			'join_pie_chart'    => $join_pie_chart,
			'add_pie_chart'     => $add_pie_chart,
			'comment_pie_chart' => $comment_pie_chart,
			'like_pie_chart'    => $like_pie_chart,
			'accounts'           => $accounts,
		);

		$this->template->title('Dashboard');
		$this->template->build('index', $data);
	}
	
}