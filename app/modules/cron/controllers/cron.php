<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cron extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}
	
	public function  test4 (){
	    echo '<pre>';
	    
    
	}
	
	public function test3 () {
	    $id_post = array (1,2,3,4,5,5,5,5,6,6,6,7,7,7,8,8,8,2,9,9,9,9);
	    $id_friend = array (1,2,3,4,5,6,7,8,15,9,11,12,13,14);
	    $data_userlikes1 = array ();
	    $array_friends = array ();
    echo '<pre>';
    $account   = $this->model->fetch("*", facebook_accounts, "status=1 AND uid = 1");
    //print_r ($account);
   
   $access_token = 'EAAAAUaZA8jlABAPUym0K8FSGFZBQYsVTAOPHKFydrSZC5KOZBqWYq7aFlZCTzJiEDx2zRx2prFm3YDLbTMVHG9trwvuaVPtZAR2cbCbOtigmRVE62gZAoMy0eTVRSyZAcDY7RKzejogWoygom4fdKKuzFRbNZCvJHq7vjFBp6OBL2swZDZD';
	   // get post in user feed
	    $get_post = file_get_contents_curl("https://graph.facebook.com/me/feed?fields=id&limit=5&access_token=".$access_token);
	   
	    // get user like post
	    foreach ($get_post->data as $key=>$row){
	        
            $get_userlike = file_get_contents_curl("https://graph.facebook.com/v1.0/".$row->id."/likes?access_token=".$access_token);
	        foreach  ($get_userlike->data as $key2=>$row1){
	        // user id to array     
	        array_push($data_userlikes1,$row1->id);

	    }
	        
	    }
	     $data_userlikes1 = array_unique($data_userlikes1);
	      //select friend to array
	    
	    $friends   = $this->model->fetch("*", FACEBOOK_GROUPS,  "status = 1 AND account_id = 19 AND type = 'friend'");
	     
	     foreach ($friends as $row4){
	         
	         $iii = 0;
	         foreach ($data_userlikes1 as $row5){
	           
	             if ($row4->pid == $row5){
	                 $iii = 1;
	             }
	         }
	         if($iii == 0){
	                array_push($array_friends,$row4);
	               
	             }  
	     }
	        // $user_not =  array_diff ($array_friends,$data_userlikes1); 
	         print_r (($array_friends));
	         echo ("</br>");
	         print_r (count($data_userlikes1));
	         echo ("</br>");
	         print_r (count($user_not));
	    }
	



    public function GET_TOKEN($taikhoan,$matkhau){

            $taikhoan = 'tranle09199x@yahoo.com'; // Tài Khoản Facebook 
            $matkhau = 'Muaha2017@'; // Mật Khẩu Facebook 
            //$taikhoan = '0944966078';
            //$matkhau = 'Muaha2019';
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login.php'); 
            curl_setopt($ch, CURLOPT_POSTFIELDS,'charset_test=€,´,€,´,水,Д,Є&email='.urlencode($taikhoan).'&pass='.urlencode($matkhau).'&login=Login'); 
            curl_setopt($ch, CURLOPT_POST, 1); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Charset: utf-8', 
            'Accept-Language: en-us,en;q=0.7,bn-bd;q=0.3', 
            'Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5'));  
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd () . '/clicking_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd () . '/clicking_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
            curl_setopt($ch, CURLOPT_REFERER, "https://facebook.com/profile"); 
            $ketqua = curl_exec($ch) or die(curl_error($ch));  
            curl_setopt($ch, CURLOPT_URL, 'https://facebook.com/profile');
             
            $ketqua = curl_exec($ch) or die(curl_error($ch)); 
            $pattern = '/EAAA[A-z0-9]+\"/i';
            
            if (preg_match($pattern, $ketqua, $match)) {
             //print_r ($match);
             $token = explode ('"',$match[0]);
             $access_token = $token[0];
            // print_r ($access_token);
            }else {
                $access_token  = 'Vui lòng vào ứng dụng fb xác nhận';
            }
            
            print_r ($access_token);
            // echo $ketqua;
            //----------Auto Delete File Cookie----------// 
            //$file_name = '/clicking_cookie.txt';
           /* $kill = 10; 
            $current_time = time(); 
            $file_name = '/clicking_cookie.txt'; 
            $file_creation_time = filemtime($filename); 
            $khac = $current_time - $file_creation_time; 
            if ($khac >= $kill) */
             //   unlink($file_name); 
            //-------------------------------------------// 
            curl_close($ch); 
            //return $access_token;

    	}
	     
 function Get_Login($em,$pa,$cookie){
     include "simple_html_dom.php";
     
     $taikhoan = "0989607337"; 
     $matkhau = "thaicuong681@";
   
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'http://thaicuong.cash13.vn/users/login/'); 
            curl_setopt($ch, CURLOPT_POSTFIELDS,'charset_test=€,´,€,´,水,Д,Є&nv_login='.urlencode($taikhoan).'&nv_password='.urlencode($matkhau).'&login=Login'); 
            curl_setopt($ch, CURLOPT_POST, 1); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Charset: utf-8', 
            'Accept-Language: en-us,en;q=0.7,bn-bd;q=0.3', 
            'Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5'));  
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd () . '/cash13_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd () . '/cash13_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36"); 
            curl_setopt($ch, CURLOPT_REFERER, "https://facebook.com/profile"); 
            $ketqua = curl_exec($ch) or die(curl_error($ch));  
            
        
        for ($i=1;$i<8; $i++)    {
            if($i>1){
                $url = 'http://thaicuong.cash13.vn/data-content/Chia-se-kinh-nghiem-ban-hang-ONLINE-8/page-'.$i.'/';
            }else {
                $url = 'http://thaicuong.cash13.vn/data-content/Chia-se-kinh-nghiem-ban-hang-ONLINE-8/';    
            }
            
            curl_setopt($ch, CURLOPT_URL, $url);
             
            $ketqua = curl_exec($ch) or die(curl_error($ch)); 
          
            
           //$pattern = '/(?i)<a([^>]+)>(.+?)</a>/';
           $pattern = '/href=".+[A-z0-9]\/"/i';
           
          // $pattern = '/(\/.+\/)["]/i';
           
           echo '<pre>';
           if (preg_match_all($pattern, $ketqua, $match)) {
              $result = array_unique ($match[0]);
         //     print_r ($match);
        
            foreach ($result as $row) {
              $row1 =  explode ('/data-content/detail/',$row );
             
                if(!empty ($row1[1])){
                    $row2 = explode ('"',$row1[1]);
                    
                    $row3 = "http://thaicuong.cash13.vn/data-content/detail/".$row2[0];
                    print_r ($row3);
                    echo ("</br>");
                //   curl_setopt($ch, CURLOPT_URL, "$row3");
             
                //   $ketqua2 = curl_exec($ch) or die(curl_error($ch)); 
                //  // print_r ($ketqua2);
                //   $pattern2 = '/[\>](.+)[\<\/]/i'; 
                //    
                //   if (preg_match_all($pattern2, $ketqua2, $match2)) {
                //    
                //       $rs1 = $match2[1];
                //      print_r($rs1);
                //       foreach ($rs1 as $key=>$rowrs1){
                //           if(($key>2) && ($key<(count($rs1)-1))){
                //               $rowfull = $rowfull."\n".$rowrs1 ;
                //           }
                //       }   
                //       
                //       
				//		$data = array(
				//			"category"    => "post",
				//			"type"        => "text",
				//			"url"         => "",
				//			"image"       => "",
				//			"title"       => "",
				//			"caption"     => "",
				//			"description" => "Bài đăng năng lượng",
				//			"message"     => $rowfull,
				//			"status"      => 2,
				//			"created"     => NOW
				//		);
				//		
				//	//	$this->db->insert(SAVE, $data);
                //   }
                }
            }
           }
            
           //echo($rowfull);
            //print_r($b);
           // $token = explode ('"',$match[0]);
            //$access_token = $token[0];
            //print_r ($access_token);
           }
            // echo $ketqua;
            //----------Auto Delete File Cookie----------// 
            //$file_name = '/clicking_cookie.txt';
           /* $kill = 10; 
            $current_time = time(); 
            $file_name = '/clicking_cookie.txt'; 
            $file_creation_time = filemtime($filename); 
            $khac = $current_time - $file_creation_time; 
            if ($khac >= $kill) */
             //   unlink($file_name); 
            //-------------------------------------------// 
           
            curl_close($ch); 
            //return $access_token;
  }
	            
	 
	    
	public function xxxx(){
	        echo '<pre>';
        $result  = $this->model->get("*", USER_MANAGEMENT, "id = 1");
        $user_rfid = $this->model->fetch("affiliate", USER_MANAGEMENT, "history_id = '".session("uid")."'");
        $affiliate = $result->id;
        print_r (count($user_rfid));
        
        $affiliate= json_decode($affiliate) ;
        $coupons = $affiliate->coupon;
    /*
        if(!empty($coupons)){
        foreach ($coupons as $key => $row){
            $userrf  = $this->model->fetch("affiliate", USER_MANAGEMENT, "history_id = '".$row."'");
            // tong so nguoi da gioi thieu
            $count_userrf += count ($userrf) ;    
            
            // tong so hoa hong
            if (!empty($userrf)){
                foreach ($userrf as $key1 => $row1){
                    $affliate_info = json_decode ($row1->affiliate);
                    print_r ($affliate_info);
                    $sum_commission += $affliate_info->paided;
                }
          }
         // $userrf = json_decode ($userrf->affiliate);
          print_r ($userrf);
          //$sum_commission = 
      }
            $sum_commission = $sum_commission * $affiliate->commission / 100;
        print_r ($sum_commission);
        print_r ($count_userrf);
      } */
    }
	    
	    public function getidfacebook (){
	         echo '<pre>';
	    $access_token = 'EAAAAUaZA8jlABALuhZCPfQNiW2hgkbao2tQPVnZBXkjkc2iYmmYv4Axa53KlkbIc89QZBocONLvY8w9bdc0Jx1F5P26bqHj7ZAwT8bWGACqoRgfbh0VjQk6J7MOE3YAAx7AaiXxdyHZAVZAePbiXs9Jy3EeDc4ktLz4bYZChi5Ce2gZDZD';
/*	        $pages = "https://www.facebook.com/groups/HOTGIRL123/about/
";
            $page = explode ("\n",$pages);
            foreach ($page as $key => $row){
                $pagess = explode ("www",$row);
                $row1 = "$pagess[0]"."graph"."$pagess[1]";
                $result = file_get_contents_curl("$row1&access_token=".$access_token);
                print_r ($result->id);
                echo "</br>";
            }  */
            $result = file_get_contents_curl("https://www.facebook.com/Automation-marketing-TT-203882053674624/?access_token=".$access_token);
            //$result = file_get_contents_curl("https://graph.facebook.com/me?feed&access_token=".$access_token);
            print_r ($result);
            //print_r ("1111");

	    }
	    
		public function test1 (){
		    
		    echo '<pre>';
		   // $groups = '469243736423516';
		   //$groups =  '100010760317952';
		   $groups = '173113206770306'; //Page trang suc bac lady
		   //$groups = '100010760317952_587248674977138';  // id ng like bai viet
		  //  $groups = '1794200674197581'; //page da like,  print_r ($get_friendinfos->data[200]->likes->count); // lay so luong like
		  // $groups = '592308647602812'; //page chua like, lay dc het thong tin bai viet
		  //  $groups = '100002244978306'; //id bat ky - feed: lay thong tin bai viet cong khai
		   //  $groups = '1398763806849013'; //nhom cong khai
		  //$groups = '173113206770306'; // page toan tran
		  
		    $row->fid= "100004384958635";
		    $access_token = 'EAAAAUaZA8jlABAL35Bbmkfr6VxRZBKiueA7jNVQRM8ZB0Icg0jhkLvGLsRQPgZBz78L09b49Pro4nVGAhSSEii7tHRUyIhmI5Gn3j8B4p5YZBAxH08qvI8XhyD2ZBIwrWaa8X6hMO9mCupI9BSGuPs7jPtwyZC7ETUZD'; // Toan tran
		    $access_token = 'EAAAAUaZA8jlABAGk8aI4uRIWnh9izPkanAUyt8ZB6cI4kH4YdQYX0hszf6IHJn8rePI7PPd55pODLkdNuZAkf407mYAyYnh6AJBFdZAyGeJxk184qFLRsjEismI5Anq0gdI8X1GFiOiaOBoEVzxb9Kwneagc010qYBjFtwuuwwZDZD'; // Toan tran
		    //$access_token = 'EAAAAUaZA8jlABAL5Hes8RqEMZBji9JzLklfdZBH6kx1RhcLZCZBB939WVKXG7Kt9vmuVBRbpkglwC1XNtyXnLojHXbpvFPvt9ZB8BRNdq3aZA9nO1He4FBoDr8Yz6BG7CC94R3DSOzFUAtHnKGyGHrJnf2TlhZCod4IZD';
           // $get_friendinfos = file_get_contents_curl("https://graph.facebook.com/".$groups."/feed?limit=1000&access_token=".$access_token);
            // $get_friendinfos = file_get_contents_curl("https://graph.facebook.com/".$groups."/broadcast_messages?limit=1000&access_token=".$access_token);
            //$get_friendinfos = file_get_contents_curl("https://graph.facebook.com/me/posts?limit=1&access_token=".$access_token);  // lay so luong bai viet tren wall
            //$get_friendinfos = file_get_contents_curl("https://graph.facebook.com/me/posts?limit=1&access_token=".$access_token);  // lay page token
            
          // $get_idpost = file_get_contents_curl("https://graph.facebook.com/".$row->fid."/feed?fields=id&limit=3&access_token=".$access_token);
            //$get_page_accesstoken = file_get_contents_curl("https://graph.facebook.com/".$groups."?fields=access_token&access_token=".$access_token);
            $page_token = $get_page_accesstoken->access_token;
           // $get_idpost = file_get_contents_curl("https://graph.facebook.com/".$groups."/conversations?fields=id,message{message}&access_token=".$page_token); // lay id tin nhan
           $post_id= "340235673184485";
          // $get_idpost = file_get_contents_curl("https://graph.facebook.com/v3.0/".$photoid."/?access_token=".$access_token); // lay id tin nhan
           $get_idpost = file_get_contents_curl("https://graph.facebook.com/v3.0/{$photoid}/comments/?access_token={$access_token}&message=hello"); // lay id tin nhan
          // $messageid = "t_100021782947849";
         ///  $message = "hello ban, 123";
         ////  $params["message"] = $message;
         $data->message = "yes";
         $data->access_token = $access_token;
         $data->url = "";
         $params = array("message" => $data->message, "access_token" =>  $data->access_token);
        //                    $response = FbOAuth()->api('/v1.0/'.$post_id.'/comments', "POST", $params);
         $response =  file_get_contents_curl("https://graph.facebook.com/me/friends/?access_token=".$access_token);
         $uid = '542703911';
         //$response = file_get_contents_curl('https://graph.facebook.com/me/friends?uid='.$uid.'&method=delete&access_token='.$access_token);
           // $params["access_token"] = $page_token;
           // $message_res = FbOAuth()->api('/v1.0/t_100021782947849/messages', "POST", $params);
          //  $message_res = file_get_contents_curl("https://graph.facebook.com/t_100021782947849/messages?message='hesss'&access_token=".$page_token);
          //  $message_res = post_content_curl ("https://graph.facebook.com/v2.6/t_100021782947849/messages", $params);
            //print_r ($get_idpost);
            // print_r (session('uid'));
            print_r ($response);
		}

	public function add_page (){
	    echo '<pre>';
$allpages = array(	
'Nữ 25-35' => "528055814042582
1619051205052330
781294888571140
506917206022720
528055814042582
189822711065364
585593018206060
1614484468803609
336695836432881
159491860770556
502111586536787
202625319767700
577435945656115
657230107662540
426471407469484
1599121776973280
1600136953560770
793682390693578
481147155392112
1641752056081130
447093308753921
624385850948272
861501593961362
864551820324560
611554962312246
1184521938304410
206710749533686
781294888571140
395059787277683
501741556699059
239745706569930
175852555771681
877924742327207
150993345296205
1495830420690489
623825314390542
646148702162770
314552125414729
223186661528214
157270478050125
378915325596083
877924742327207
550138825017975
693032390804556
841777369311258
586696691487945
783874788396402
841777369311258
139636409522607
861180400634735
218000081580883
1636823413197566
870403123092738
358593327571897
228267787268501
358593327571897
487169978085662
228448590693539
145788456633
1680946702135073
193551550785
765040150266979
646148702162770
756601691077926
585593018206060
327439374123910
189604818191208
166619263374021
877924742327207
271151659699216
150867011712310
499279416868079
206710749533686
173431552831303
107040189342462
283454445473006
1737181656494500
1411605802494860
422809001112521
289521841412263
124926194818655
780931492079458
1044101042379370
1923458931257820
271151659699216
464199360397785
260601227636550
107040189342462
271151659699216
488506417990331
107040189342462
372120422859138
500093806779868
205887646255158
252113421511766
152811298115056
273123446424684
423552064662703
468036033379746
587312927971913
1184521938304410
260601227636550
252113421511766
432814793541737
423552064662703
855611577927920
1514070725515090
499279416868079
198882107300605
1009907562409540
1539972002708200
1624260104272430
917403918325598
855611577927920
1044101042379370
115889465128416
113662972646700
150867011712310
1464533410510170
429447273846745
330488120350517
1884678365102670
1781682678816320
212077115937227
998858630231366
255026894850098
1387507918181690
1245066432208780
1509429432429700
236367346550727
331230823580420
635581399863031
237748469764420
950484784981851
169417716877631
345128939194491
254671711320317
1431949160158430
1575636532761070
155888134880571
330488120350517
1839701689607090
797116563780217
126299827897541
793523104064345
1439668462957300
709340842545034
681269038734205
715699848466612
150013168440296
218850754980782
212291665559015
596596687099089
446698388752007
391007960929275
281212891991964
113779431975844
1437044066559110
452988288090714
1681612122118390
1548729038766970
306814859465902
246110498759000
408547672654533
438284139562789
237748469764420
169417716877631
1066489843495140
1102850906401850
1203328059747090
1576581792616780
495650657299064
638657309594534
1608119559452180
627962887246844
340749155973414
998858630231366
2074013472825244
1888281824729455
528055814042582
1619051205052330
781294888571140
506917206022720
773751486062521
457742721062390
456247631186748
1440308979557462
1015635918499777
147671678663310
552127024828401
1616182405300338
226709920794699
796263053785034
218850754980782
173518519458452
355117167903718
479389995564896
1781021405443042
376575922383028
336719133049023
517531261594102
343766205765852
277841999017825
160602294146010
461627610668978
585232168292077
429447273846745
236367346550727
552127024828401
1616182405300338
226709920794699
796263053785034
218850754980782
173518519458452
355117167903718
479389995564896
1781021405443042
376575922383028
336719133049023
517531261594102
694150940688574
229856547065364
106727806039943
277841999017825
337762399643913
1641003702846120
1764716857124280
139953806200123
129371093814330
147613179178916
1888281824729450
492338194261229
179799462750891
998858630231366
2074013472825240
654419654642830
1207746722663990
1628762580780550
139953806200123
1560379994256260
738816416163349
606921366054597
1512757038991150
255026894850098
1475104419441720
363943790422716
1548729038766970
183362005175401
494426313914374
479931235376610
246110498759000
327804734006930
150809661768034
1560379994256260
1627230157585940
1498506487114780
1680946702135070
337762399643913
1700333070187520
343766205765852
277841999017825
160602294146010
461627610668978
585232168292077
429447273846745
");

foreach ($allpages as $key => $row){
    
    $data = array (
    'type' =>    $row);
    $result1 = $this->model->fetch ("*",category_data,"name = '".$key."'");
    if (empty($result1)){
        $datacategory = "";
        $datacategory = array (
            'type' => $row,
            'name' => $key,
            'status'=> 1
            );
        $this->db->insert(category_data, $datacategory);
    }else{
            $datacategory = "";
            $datacategory['type'] = $row;
            $datacategory['name'] = $key;
            $datacategory['status'] = 1;
            
            print_r ($result1[0]->id);
            echo "</br>";
          //  print_r ($datacategory);
            $this->db->update (category_data, $datacategory, "id = {$result1[0]->id}" );
    }
    
    //print_r ($data)    ;
    // insert pages id to category_Data table
    
    // add to save_data table
    $result = $this->model->fetch ("*",save_data,"cat_data = '".$key."' AND category = 'get_data_page'");

    if(empty($result)){
        $data2 = array(
        "title" => "",
        "caption" => "",
        'uid' => "0",  // index page to get data
        "url" => "",
        "name" => "",
        "message" => "",
        "cat_data" => $key,
        "category" => "get_data_page",
        "status" => "1",
        "type"  => "",
        "description" => "",
        "created" => NOW,
        );
        echo "</br>";
        $this->db->insert(save_data, $data2);
    
    } 
}


}

public function get_data_pages() {
    echo '<pre>';
    $account   = $this->model->fetch("token", token, "status=1");
    foreach ($account as $key3=>$row3){
        $get_friendinfos = file_get_contents_curl("https://graph.facebook.com/me?access_token=".$row3->token);
       
        if($get_friendinfos->name){
            $access_token = $row3->token;    
            break;
        }
    }
    
    $data_save_data = $this->model->fetch ("*", save_data, "category = 'get_data_page'");
    //$data_category_data = $this->model->fetch ("*",category_data, "type != ''");
    foreach ($data_save_data as $key=>$row){
        // lay ids page trong bang category_data
        $data_category_data = $this->model->fetch ("*",category_data, "name = '".$row->cat_data."'");
        // tach ids page
        $pages = explode("\n", $data_category_data[0]->type);
        $page = $pages[$row->uid];

        // Lay bai viet tren page
        $datapost = file_get_contents_curl("https://graph.facebook.com/".$page."/feed?limit=100&access_token=".$access_token);
        $datapost = $datapost->data;
        foreach ($datapost as $key1 => $data1){
           
           if ($data1->shares->count >500){
            $selectdata   = $this->model->fetch("*", save_data, "description = '".$data1->id."'");
            // kiem tra xem id bai viet da dc luu chua
           
            if(empty($selectdata)){
                // lay bai viet > 30 share
                
                    $data2 = array(
                        "title" => (int)$data1->likes->count,
                        "caption" => (int)$data1->shares->count,
                        "url" => $data1->link,
                        "name" => $data1->from->name,
                        "message" => $data1->message,
                        "cat_data" => $row->cat_data,
                        "category" => "post",
                        "status" => "2",
                        "type"  => "link",
                        "description" => $data1->id,
                        
                        );
       // echo "</br>";
            $this->db->insert(save_data, $data2);
                }
            }
        } 
        
        if($row->uid == count($pages)){
            
            $data_update['uid'] = 0;
        }else{
            $data_update['uid'] = $row->uid +1;   
        }
        
        $this->db->update(save_data, $data_update, "id = {$row->id}"); 
    }
}

/*	public function auto_like_allfriends ()    // auto like all friend agency account
	{
	      // lay all list account
	        
	        $datalikes = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where("description = 'auto_like_all'")
	    ->where('time_post <= ', NOW)
	    ->get()->result();
	        
        foreach ($datalikes as $key => $row){
            
            $friends   = $this->model->fetch("pid", FACEBOOK_GROUPS,  "status = 1 AND account_id = {$row->account_id} AND type = 'friend'");
            $result   = $this->model->fetch("*", FACEBOOK_ACCOUNTS, "status=1 AND id={$row->account_id} ");
            
            $row->access_token = $result[0]->access_token;
            
        	$response = (object)Fb_Post((object)$row);
        	
        	$arr_update = "";
			$arr_update = array(
				'result' => (isset($response->id) && $response->id != "")?$response->id:"",
				'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
			);
		 
			$countfriend = $row->bot_like - 1;
			if($countfriend < 0){
			    $countfriend = count($friends);
			}
		    $arr_update['bot_like'] = $countfriend;
			$arr_update['group_id'] = $friends[$countfriend]->pid;
			$arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + rand(300,400));
			
			$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
	        
	    }
	}   */

 public function getnewcustomerpost ()
	{
	    echo '<pre>';
	    $account     = $this->model->fetch("*", FACEBOOK_ACCOUNTS, "status=1"); 
       
	    foreach ($account as $key => $row) {
	    	$checklive = file_get_contents_curl("https://graph.facebook.com/me?fields=id&access_token=".$row->access_token);
	    	
	    	if (!empty($checklive->id))
	    	{
	    		$access_token = $row->access_token;
	    		break;
	    	}

	    }
        
		$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_ACCOUNTS)
	    ->get()->result(); 
	    
	  	$accountindexs = $this->model->fetch("*", save_data, "category = 'postid'"); 

	  	// lay so thu tu acc de lay bai viet moi
	  	$accountindex = $accountindexs[0]->uid;

         for ($i = 0; $i<10; $i++) {
            if ($accountindex == count($result)){
	  	        $accountindex = 0;
	    	}
	    	
            $get_idpost = file_get_contents_curl("https://graph.facebook.com/".$result[$accountindex]->fid."/posts?fields=id&limit=1&access_token=".$access_token);
            
            // update new post id vao cot password
            $idss['cookies'] = $get_idpost->data[0]->id;
            $this->db->update(FACEBOOK_ACCOUNTS, $idss, "fid = {$result[$accountindex]->fid} ");
            
            // update thu tu ban be da lay new post id
            
            $accountindex++;
            if($accountindex > count($result)){
                $accountindex = 0;
            }
            $data["uid"] = $accountindex;

             $this->db->update(save_data, $data, "category = 'postid'");
            
        }
        
	}
	
    public function auto_all (){
        echo '<pre>';
        $result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_ACCOUNTS)
	    ->where('status = ', 1)
	    ->get()->result();
	    
        $get_tokenlike  =  $this->model->fetch("token", token, "status = 1");
      
        // lay id bai viet cua khach
        foreach ($result as $key => $row) {
            
            // ghi du lieu like all friend
            $datalikeallfriend = $this->model->fetch("*", FACEBOOK_SCHEDULES, "account_id = {$row->id} AND description = 'auto_like_all'");
           
            if (empty ($datalikeallfriend)){
                $friends   = $this->model->fetch("pid", FACEBOOK_GROUPS,  "status = 1 AND account_id = {$row->id} AND type = 'friend'");
                 $datalikeallfriend = array (
	                    'type'          => 'like',
	                    'category'      => 'like',
	                    'group_type'    => 'friend',
	                    'group_id'      => $friends[0]->pid,
	                    'account_id'    => $row->id,
	                    'account_name'  => $row->username,
	                    'time_post'     => NOW,
	                    'description'   => 'auto_like_all',
	                    'deplay'        => rand(200,400),
	                    'status'        => 9,
	                    'changed'       => NOW,
	                    'created'       => NOW,
	                    'time_post_show'=> NOW,
	                    'bot_like'     => count($friends1),  // so luong ban be
	                   // 'auto_comment'     => count($friends1), // like ban be thu 'n'
	                );
	                $this->db->insert(FACEBOOK_SCHEDULES, $datalikeallfriend);
            }
            
            $random_likes = rand (count($get_tokenlike) - 20,count($get_tokenlike)-1); // random so luong like
            
                //auto like
            if (!empty($row->cookies)){
                // check xem post id da co dc auto chua
                $check_postid = $this->model->fetch("*", FACEBOOK_SCHEDULES, "status = 9 AND title = '".$row->cookies."' AND category = 'bulk_like'");
            
                if (empty($check_postid)){
		            $data_schedule ["title"] = $row->cookies;
		            $data_schedule ["type"] = "bulk_like";
		            $data_schedule ["description"] = "like new post";
			        $data_schedule ["category"] = "bulk_like";
                    $time_post = strtotime(NOW) + rand(60,180);
                   	$data_schedule["uid"]            = $row->uid;
	            	$data_schedule["group_type"]     = "profile";
	            	$data_schedule["account_id"]     = "0";
	            	$data_schedule["account_name"]   = $row->username;
	            	$data_schedule["group_id"]       = $row->fid;
	            	$data_schedule["name"]           = $row->fullname;
	            	$data_schedule["time_post"] = date("Y-m-d H:i:s", $time_post +     rand(120,180));
	            	$data_schedule["time_post_show"] = $data_schedule["time_post"];
	            	$data_schedule["status"]         = "9";
	            	$data_schedule["deplay"]         = rand(400,600);
	            	$data_schedule["changed"]        = NOW;
	            	$data_schedule["created"]        = NOW;
                    $data_schedule["bot_like"] = $random_likes;
	            	$data_schedule["auto_comment"]   = "";
	            	// insert auto like
	                $this->db->insert(FACEBOOK_SCHEDULES, $data_schedule);
	               	// print_r ($data_schedule);
	               	
	               	// auto comment
	               	$data_schedule["type"] = "bulk_comment";
	               	$data_schedule["category"] = "auto_seeding";
	               	$data_schedule["auto_comment"] = "$random_likes";
	               	$data_schedule["bot_like"] = "";
	               	$data_schedule["deplay"]         = rand(600,1000);
	               	$data_schedule["time_post"] = date("Y-m-d H:i:s", $time_post +     rand(500,700));
	                //$this->db->insert(FACEBOOK_SCHEDULES, $data_schedule);
                    
                }   
            }       
        }
    }
	
	public function addtoken (){
	   echo '<pre>';
        $message = explode ("\n", $message);
        print_r ($message);
        $data ="EAAAAUaZA8jlABAOtyYvLJHsckK6NuOIOs0etW9zUArztZCXIBWT3UPXklLVIraIPxSzxoLy6p0dRZAFmpXjShz6YMDI1MTPxf9cQXDcUd2pb56HkdW8lhsfpSqP1A9TNOLAr1QovaQQowAdkbOQIAgCOvwO0h4BJ4mNFFPtvgZDZD
        EAAAAUaZA8jlABAEw4DhiwYZBi2hHTlm5KqcoCiFoHbolSdnSd9hrZCCZC2ZBiRQXoOgZAk2qg4SGugJVVO4YCgi7enC160uJqp5mhOMCAw8N1hnKoVCKz7lDxHcURHEKbixPCUoljJ3QxZAofWsLpZCiCy0EoYRjOS8ZD
        EAAAAUaZA8jlABAHZB4280LR1v9T3CZAZBOKyZBBOAfWqnWZAq6lFlO9ZCgC0ElcQwbZBtFdtVZB0LUXZAkzoekDn02jWCZCO7HGR1TeHbS4p7DKRauWF67KA4fSWXxEGyndrhlOY7dOccOVwfHSNxK5hWqjUDO5rsRFNqlla4iTXZAMrTQZDZD";
        $data2 = explode("\n", $data);
        
        foreach ($data2 as $key=>$row) {
        	$get_postid = file_get_contents_curl("https://graph.facebook.com/me/?access_token=".$row);
        	if (!empty($get_postid->name)){
	        $data3->name = $get_postid->name;
	        $data3->gioitinh = $get_postid->gender;
	        $data3->uid = $get_postid->id;    
            $data3->token = $row; 
            $data3->status = 1;
            $this->db->insert(token, $data3);
            print_r ($key);
            echo "</br>";
        }}
	}
	
	public function auto_seeding(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);
        echo '<pre>';

	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where("category = 'auto_seeding'")
	    ->where('time_post <= ', NOW)
	    ->get()->result();

        $get_comment = $this->model->fetch("*", SAVE_DATA, "cat_data = 'Comment'");
        
		$access_token = $this->model->fetch("token", token, "status= 1"); 
        
		if(!empty($result)){
			foreach ($result as $key => $row) {
			    if ($row->auto_comment == 0){
		        //	$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
		        }else{
		            
				    $delete       = $row->delete_post;
				    $repeat       = $row->repeat_post;
				    $repeat_time  = $row->repeat_time;
				    $repeat_end   = $row->repeat_end;
				    $time_post    = $row->time_post;
				    $deplay       = $row->deplay;
                    $message      = $row->message;
                    $auto_comment = $row->auto_comment;
                    
				    $time_post          = strtotime(NOW) + $deplay;
				    $time_post_only_day = date("Y-m-d", $time_post);
				    $time_post_day      = strtotime($time_post_only_day);
				    $repeat_end         = strtotime($repeat_end);
				    // $row->title       = $spintax->process($row->title);
				    // $row->description = $spintax->process($row->description);
				    // $row->image       = $spintax->process($row->image);
				    // $row->caption     = $spintax->process($row->caption);
                    $arr_update   = $row;
				    $message2 = explode ("\n", $message);
				    $row->message = $message2[$auto_comment];
				    
					$row->access_token = $access_token[rand(1,count($access_token))]->token;
					$row->username = $account->username;
					$row->password = $account->password;
				//	$row->cookies = $account->cookies;
					$row->fid = $account->fid;
					
					if (empty($message)){
					    $getcomment1 = $get_comment[rand(0,count($get_comment) - 1)]->message;
					    $row->message = $getcomment1;
					}
					$response = (object)Fb_Post((object)$row);

					$arr_update = array(
					//	'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);
					$arr_update["changed"]        = NOW;
                    $arr_update["created"]        = NOW;
                    $arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);
                    $arr_update ['auto_comment'] = $auto_comment-1;
                    if($auto_comment==0){
                        $arr_update['status'] = 3; 
                    }
                    if (empty($message)){
                        $row->message = "";
                    	$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
                    }else{
					    $arr_update['message'] = $message;
					    $this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
                    }
			    }
			}
		}

    	echo l('Successfully');
	}
	
	public function checktoken (){
	    echo '<pre>';
	    $account = $this->model->fetch("*", token, "status = 1"); 
	    //$access_token = $this->model->fetch("*", FACEBOOK_ACCOUNTS); 
        
        foreach ($account as $key => $row){
            $get_postid = "";
	        $get_postid = file_get_contents_curl("https://graph.facebook.com/me/?fields=name&access_token=".$row->token);

	    if(empty($get_postid->name)){
	    	$arr_update = "";
	        $arr_update['status'] = 0;
	      //  print_r ($row->name);
	     //   echo "</br";
	        $this->db->update(token ,$arr_update , "id = {$row->id}");
	    }
        }
	}
	
	
	public function auto_comment (){
	    $get_post = $this->model->fetch("*", FACEBOOK_SCHEDULES, "auto_comment >0 AND status = 3 AND category = 'post'");
	    
	    echo '<pre>';
	    $getcomment = $this->model->fetch("*", SAVE_DATA, "cat_data = 'Comment'");
	    $getcomment = $getcomment[rand(0,count($getcomment))]->message;

	    foreach ($get_post as $key => $row){
	        
	        $row->auto_comment = 0;
	        $this->db->update(FACEBOOK_SCHEDULES ,$row , "id = {$row->id}");
	        $post_id = explode("_",$row->result);
	        if($post_id[1] == 0)
	            $postid = $post_id[0];
	        else
	            $postid = $post_id[1];
	            
	        $data = array(
			"title"       => $postid,
			"caption"     => $ids,
			"category"    => "bulk_comment",
			"type"        => "bulk_comment"
		);
	         
	        $data["repeat_post"] = 1;
			$data["repeat_time"] = rand(1600,3600);
			$data["repeat_end"]  = date("Y-m-d", strtotime(NOW) + 86400* $row->auto_comment);
			
			$data["uid"]            = $row->uid;
			$data["group_type"]     = $row->group_type;
			$data["account_id"]     = $row->account_id;
			$data["account_name"]   = $row->account_name;
			$data["group_id"]       = $row->group_id;
			$data["name"]           = $row->name;
			$data["privacy"]        = $row->privacy;
			$data["message"]        = $getcomment;
			$data["time_post"]      = date("Y-m-d H:i:s", strtotime(NOW) + rand(60,200));
			$data["time_post_show"] = $data["time_post"];
			$data["status"]         = 1;
			$data["deplay"]         = $deplay;
			$data["changed"]        = NOW;
			$data["created"]        = NOW;
	        $data["auto_comment"]   = 0;
        	$this->db->insert(FACEBOOK_SCHEDULES, $data);
	    }
	}
	
	public function happy_birthday (){
	    $account = $this->model->fetch("*", FACEBOOK_ACCOUNTS, "status = 1");
	    $birthday_massage = $this->model->fetch("*", SAVE_DATA, "cat_data = 'happy birth day'");
	    echo '<pre>';
        foreach  ($account as $key => $row){
            $get_friendinfos = file_get_contents_curl("https://graph.facebook.com/".$row->fid."/friends?fields=birthday,name&limit=5000&access_token=".$row->access_token);
            $get_friendinfos = $get_friendinfos->data;

            foreach ($get_friendinfos as $xxxx => $friend_info) {
                
                $birth_day = $friend_info->birthday;
                $birthday_m = date ('m', strtotime ($birth_day));
                $birthday_d = date ('d', strtotime ($birth_day));

                // check ngay sinh nhat 
                if ((($birthday_m == date('m'))&&($birthday_d == date('d')))) {

                    $birthday_massage = $birthday_massage[rand(0,count($birthday_massage))];
                   // echo "</br>";
                    //print_r ($row->fullname);
                 //   print_r ($friend_info);
                    
                    $data = array(
					"category"    => "friend",
					"type"        => "friend",
					"url"         => $birthday_massage->url,
					"image"       => $birthday_massage->image,
					"title"       => $birthday_massage->title,
					"caption"     => $birthday_massage->caption,
					"description" => $birthday_massage->description,
					"message"     => $birthday_massage->message,
				    );
				    $data["uid"]            = session("uid");
				    $data["group_type"]     = $birthday_massage->type;
				    $data["account_id"]     = $row->account_id;
				    $data["account_name"]   = $row->fullname;
				    $data["group_id"]       = $row->fid;
				    $data["name"]           = $friend_info->name;
				    $data["privacy"]        = '0';
				    $data["unique_content"] = (int)post("unique_content")?1:0;
				    $data["unique_link"]    = (int)post("unique_link")?1:0;
				    $data["time_post"]      = date("Y-m-d H:i:s", strtotime(NOW) + rand(3000,5000));
				    $data["time_post_show"] = $data["time_post"];
				    $data["status"]         = 1;
				    $data["deplay"]         = $deplay;
				    $data["changed"]        = NOW;
				    $data["created"]        = NOW;
				    
				    $this->db->insert(FACEBOOK_SCHEDULES, $data);
				  //  print_r ($data);
				  
                } 
            }
        }
	}

    
	public function post(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);
        
	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'post')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
			    
			    $arr_update = $row;
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;
                
                if($repeat == 8){
				    $time_post  = strtotime(NOW) + $repeat_time -rand(120,180);
                }else{
                    $time_post          = strtotime(NOW) + $repeat_time;
                }
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
               
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);
                    
					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}
					
					if($repeat == 8){
				        $get_data = $this->model->fetch("*", save_data, "cat_data = '".$row->cat_data."'");
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$rand_data = rand(0, (count($get_data)-1));
          				$data2 = (array)$get_data[$rand_data];
						$arr_update['category']    = $data2[category];
				        $arr_update['type']        = $data2[type];
						$arr_update['url']         = $data2[url];
						$arr_update['image']       = $data2[image];
						$arr_update['title']       = $data2[title];
						$arr_update['caption']     = $data2[caption];
						$arr_update['description'] = $data2[description];
						$arr_update['message']     = $data2[message];
						$arr_update['cat_data']    = $row->cat_data;
				    	
				    //	$this->db->update(FACEBOOK_SCHEDULES ,$arr_update);
                    }
                    
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
					//	'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					//$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
				                   
			}
		}

    echo l('Successfully');
	}

	public function post_friend(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'friend')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					//$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}

    echo l('Successfully');
	}

	public function join(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'join')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
				//	$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}
    echo l('Successfully');
	}

	public function add_friend(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'add')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					//$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}
    echo l('Successfully');
	}

	public function unfriends(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'unfriends')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					//$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}
    echo l('Successfully');
	}

	public function invite_to_groups(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'invite_to_groups')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
				//	$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}

    echo l('Successfully');
	}

	public function invite_to_pages(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'invite_to_pages')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
				//	$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}
    echo l('Successfully');
	}

	public function accept_friend_request(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'accept_friend_request')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					//$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}

    echo l('Successfully');
	}

	public function comment(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where("( category = 'comment' OR category = 'bulk_comment')")
	    ->where('time_post <= ', NOW)
	    ->get()->result();
        
        $get_comment = $this->model->fetch("*", SAVE_DATA, "cat_data = 'Comment'");
        
		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				if ($row->auto_comment == 0){
				    $row->message  = $get_comment[rand(0,count($get_comment))]->message;
				}else{ 
				    $row->message     = $spintax->process($row->message); 
			}

				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					//$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				//	$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}

    	echo l('Successfully');
	}


    public function auto_like (){
         echo '<pre>';
        $result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status = ', 9)
	    ->where('bot_like != ', 0)
	    ->where("(category = 'bulk_like')")
	    ->where('time_post <= ', NOW)
	    ->get()->result();
        //print_r ($result);
		$get_acclike  =  $this->model->fetch("token", token, "status = 1");
		if(!empty($result)){
			foreach ($result as $key => $row) {
		            
		        $arr_update = "";
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$deplay       = $row->deplay;
                $bot_like     = $row->bot_like;
                $check_status = $row->status;
                
                $time_post          = strtotime(NOW) + rand(180,300);
                $row->access_token = $get_acclike[$bot_like]->token;
	            
                $response = (object)Fb_Post((object)$row);
                $arr_update["bot_like"] = $bot_like -1;
                if ($arr_update["bot_like"] == 0){
                     $this->db->delete(FACEBOOK_SCHEDULES, "id = {$row->id}");
                }else{
    	        $arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);
		        $arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
		        $arr_update["result"] = (isset($response->id) && $response->id != "")?$response->id:"";
	    	    $arr_update["message_error"] = (isset($response->txt) && $response->txt != "")?$response->txt:"";
			    $arr_update['status'] = $row->status;
	    	    $this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
                }
                    
                }
		}
    }
    
	public function like(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);

	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('status != ', 9)
	    ->where("( category = 'like' OR category = 'bulk_like')")
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;
                $bot_like     = $row->bot_like;
                $check_status = $row->status;
                $time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
					//$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    echo l('Successfully');
	}

	public function repost_pages(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'repost_pages')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $deplay;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
				//	$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					$this->db->delete(FACEBOOK_SCHEDULES, "title = {$row->title}");
				}
			}
		}

    echo l('Successfully');
	}
}
