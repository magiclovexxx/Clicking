<?php
function hashcheck(){
  //  if(EX == 1){
        return false;
   // }else{
   //     return true;
   // }
}

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);       
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return json_decode($data);
}

function post_content_curl($url, $params){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);       
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec ($ch);
    curl_close ($ch);

    return json_decode($data);
}

if(!function_exists("FbOAuth_Friends")){
    function FbOAuth_Friends($username, $password = "", $fid = "", $access_token = ""){
        $data = file_get_contents_curl("https://graph.facebook.com/".$fid."/friends?limit=10000&access_token=".$access_token);
        if(isset($data->data) && !empty($data->data)){
            return $data->data;
        }else{
            return false;
        }
    }
}

if(!function_exists("GET_FRIENDS_BY_TOKEN")){
    function GET_FRIENDS_BY_TOKEN($fid, $access_token, $data = array(), $page = ""){
        $data = file_get_contents_curl("https://graph.facebook.com/".$fid."/friends?limit=10000&access_token=".$access_token);
        if(isset($data->data) && !empty($data->data)){
            return $data->data;
        }else{
            return false;
        }
    }
}

if(!function_exists("FbOAuth_Groups")){
    function FbOAuth_Groups($access_token){
        $data = file_get_contents_curl("https://graph.facebook.com/me/groups?limit=10000&access_token=".$access_token);
        if(isset($data->data) && !empty($data->data)){
            return $data->data;
        }else{
            return false;
        }
    }
}

if(!function_exists("FbOAuth_Pages")){
    function FbOAuth_Pages($access_token){
        $data = file_get_contents_curl("https://graph.facebook.com/me/accounts?limit=10000&access_token=".$access_token);
        if(isset($data->data) && !empty($data->data)){
            return $data->data;
        }else{
            return false;
        }
    }
}

if(!function_exists("FbOAuth_User")){
    function FbOAuth_User($access_token){
        $data = file_get_contents_curl("https://graph.facebook.com/me?access_token=".$access_token);
        return $data;

    }
}

if(!function_exists("FbOAuth_Access_Token_Page")){
    function FbOAuth_Access_Token_Page($pageid, $access_token){
        $data = file_get_contents_curl("https://graph.facebook.com/v2.9/".$pageid."?fields=access_token&access_token=".$access_token);
        if(isset($data->access_token)){
            return $data->access_token;
        }else{
            return false;
        }
    }
}

if(!function_exists("FbOAuth_Search")){
    function FbOAuth_Search($data){
        $data = (object)$data;
        try {
            switch ($data->type) {
                case 'member':
                    try {
                        $data = file_get_contents_curl("https://graph.facebook.com/v2.9/".$data->id."/members?limit=".$data->limit."&access_token=".$data->access_token);
                        if(isset($data->data)){
                            return $data->data;
                        }else{
                            return false;
                        }
                    } catch (Exception $e) {
                        return false;
                    }
               
                    break;
                
                case 'search_user':
                    $data = (object)$data;
                    $params = array("q" => $data->keyword, "type" => "user", "limit" => $data->limit , "access_token" => $data->access_token);
                    if(isset($params)){
                        $result = FbOAuth()->api( '/v2.9/search?fields=id,name', 'GET', $params );
                        if(isset($result['data'])){
                            return $result['data'];
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                    break;

                case 'friend_user':
                    $data = (object)$data;

                    $data = file_get_contents_curl("https://graph.facebook.com/v1.0/".$data->keyword."/friends?limit=".$data->limit."&access_token=".$data->access_token);
                    if(isset($data->data)){
                        return $data->data;
                    }else{
                        return false;
                    }
                    break;

                case 'who_like_post':
                    $data = (object)$data;
                    $data = file_get_contents_curl("https://graph.facebook.com/v1.0/".$data->id."/likes?limit=".$data->limit."&access_token=".$data->access_token);
                    if(isset($data->data)){
                        return $data->data;
                    }else{
                        return false;
                    }
                    break;

                case 'who_comment_post':
                    $data = (object)$data;

                    $data = file_get_contents_curl("https://graph.facebook.com/v1.0/".$data->id."/comments?limit=".$data->limit."&access_token=".$data->access_token);
                    if(isset($data->data)){
                        return $data->data;
                    }else{
                        return false;
                    }
                    break;

                case 'accept_friend_request':
                    $data = (object)$data;
                    $data = file_get_contents_curl("https://graph.facebook.com/v1.0/me/friendrequests?limit=".$data->limit."&access_token=".$data->access_token);
                    if(isset($data->data)){
                        return $data->data;
                    }else{
                        return false;
                    }
                    break;

                default:
                    switch ($data->type) {
                        case 'page':
                            $fields = "?fields=id,name,single_line_address,phone,emails,website,fan_count,link,is_verified,about,picture";
                            break;
                        case 'group':
                            $fields = "?fields=id,icon,name,description,email,privacy,cover";
                            break;
                        case 'user':
                            $fields = "?fields=id,name,birthday,bio,email,gender,interested_in,is_verified,link,location,meeting_for,religion,relationship_status,website,work,cover,devices,education,hometown,languages,picture,age_range";
                            break;
                        case 'event':
                            $fields = "?fields=id,name,attending_count,noreply_count,maybe_count,interested_count,declined_count,owner,place,category,can_guests_invite,cover,start_time,end_time,type,ticket_uri";
                            break;
                        case 'place':
                            $fields = '?fields=id,name,location';
                            break;
                        case 'post':
                            $fields = '?fields=id,shares,likes,message';
                            break;
                    }
                    if ($data->type === "post"){
                        $limit = 1000;
                        $data = file_get_contents_curl("https://graph.facebook.com/search".$fields."&q=".urlencode($data->keyword)."&type=".$data->type."&limit=".$limit."&access_token=".$data->access_token);
                    }else{
                    $data = file_get_contents_curl("https://graph.facebook.com/v2.9/search".$fields."&q=".urlencode($data->keyword)."&type=".$data->type."&limit=".$data->limit."&access_token=".$data->access_token);
                    }
                    
                    if(isset($data->data) && !empty($data->data)){
                        return $data->data;
                    }else{
                        return false;
                    }
                    break;
            }
        }
        catch ( Exception $e ) {
            return false;
        }
    }
}


if(!function_exists("FbOAuth_Info_App")){
    function FbOAuth_Info_App($access_token){
        $data = file_get_contents_curl("https://graph.facebook.com/app?access_token=".$access_token);
        return $data;
    }
}

if(!function_exists("Fb_Post")){
    function Fb_Post($data){
        $response = array();
        if($data->group_type == "page"){
            $data->access_token = FbOAuth_Access_Token_Page($data->group_id, $data->access_token);
        }
        try {
            if(isset($data->unique_content)){
                if($data->unique_content == 1){
                    $message = $data->message."\n\r\t\n\r\t".generateRandomString();
                }else{
                    $message = $data->message;
                }
            }

            if(isset($data->unique_link)){
                if($data->unique_link == 1){
                    $pos = strpos($data->url, "?");
                    if($pos === false){
                        $url = $data->url."?pid=".generateRandomString();
                    }else{
                        $url = $data->url."&pid=".generateRandomString();
                    }
                }else{
                    $url = $data->url;
                }
            }

            switch ($data->type) {
                case 'text':
                    $params = array("message" => $message, "access_token" =>  $data->access_token);
                    $group = $data->group_type=="profile"?"me":$data->group_id;
                    $response = FbOAuth()->api('/v1.0/'.$group.'/feed', "POST", $params);
                    break;

                case 'link':
                    switch ($data->privacy) {
                        default:
                            $params = array(
                                "message"      => $message,
                                "name"         => $data->title,
                                "description"  => $data->description,
                                "link"         => $url,
                                "access_token" => $data->access_token
                            );

                            if($data->caption != ""){
                                $params["caption"] = $data->caption;
                            }

                            $image = $data->image;
                            if (checkRemoteFile($image)) {
                                $params["picture"] = $data->image;
                            }
                            $group = $data->group_type=="profile"?"me":$data->group_id;
                            $response = FbOAuth()->api('/v1.0/'.$group.'/feed', "POST", $params);
                            break;
                    }
                    break;

                case 'image':
                    $image = $data->image;
                    if (checkRemoteFile($image)) {
                        $params = array(
                            "message"      => $message,
                            "access_token" =>  $data->access_token
                        );
                        $params["url"] = $image;
                        $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                        $response = FbOAuth()->api('/v1.0/'.$group_id.'/photos', "POST", $params);
                    }
                    break;

                case 'video':
                    $url = $data->image;
                    $id = getIdYoutube($url);
                    $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                    if(strlen($id) == 11){
                        parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id),$info);
                        if($info['status'] == "ok"){
                            $streams = explode(',',$info['url_encoded_fmt_stream_map']);
                            $type = "video/mp4"; 
                            foreach($streams as $stream){ 
                                parse_str($stream,$real_stream);
                                $stype = $real_stream['type'];
                                if(strpos($real_stream['type'],';') !== false){
                                    $tmp = explode(';',$real_stream['type']);
                                    $stype = $tmp[0]; 
                                    unset($tmp); 
                                } 
                                if($stype == $type && ($real_stream['quality'] == 'large' || $real_stream['quality'] == 'medium' || $real_stream['quality'] == 'small')){
                                    $params = array(
                                        "description"  => $message,
                                        "file_url"     => $real_stream['url'].'&signature='.@$real_stream['sig'],
                                        "access_token" => $data->access_token
                                    );
                                    
                                    $response = FbOAuth()->api('/v1.0/'.$group_id.'/videos', "POST", $params);
                                }
                            }
                        }else{
                            $response = array(
                                "st"  => "error",
                                "txt" => strip_tags($info['reason'])
                            );
                        }
                    }else{
                        if (strpos($url, 'facebook.com') != false) {
                            $url = FB_DownloadVideo($url);
                        }

                        $params = array(
                            "description"  => $message,
                            "file_url"     => $url,
                            "access_token" =>  $data->access_token
                        );
                        $response = FbOAuth()->api('/v1.0/'.$group_id.'/videos', "POST", $params);
                    }
                    break;

                case 'images':
                    $images = json_decode($data->image);
                    $medias = array();
                    foreach ($images as $image) {
                        if (strpos($image, 'youtube.com') !== false || strpos($image, 'vimeo.com') !== false || strpos($image, 'facebook.com') != false) {
                            
                            $params = array(
                                "message"  => $message,
                                "access_token" => $data->access_token,
                                "published"    => false
                            );
                            $params["url"] = $image;

                            if(strpos($image, 'facebook.com') != false){
                                $url = FB_DownloadVideo($image);
                                $params["file_url"] = $url;
                                $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                                $post = FbOAuth()->api('/v1.0/'.$group_id.'/videos', "POST", $params);
                            }else{
                                try{
                                    $videos = VideoDownloader($image);
                                    if(!empty($videos)){
                                        foreach ($videos as $video) {
                                            if($video['format'] == 'mp4'){
                                                $params["file_url"] = $video['url'];
                                                $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                                                $post = FbOAuth()->api('/v1.0/'.$group_id.'/videos', "POST", $params);
                                            }
                                        }
                                    }
                                }catch(Exceptions $e) {}
                            }

                        }else{
                            $params = array(
                                "message"      => $message,
                                "access_token" => $data->access_token,
                                "published"    => false
                            );
                            $params["url"] = $image;

                            $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                            $post = FbOAuth()->api('/v1.0/'.$group_id.'/photos', "POST", $params);
                            
                        }
                        
                        if(isset($post) && isset($post['id'])){
                            $medias[] = $post['id'];
                        }
                    }

                    if(!empty($medias)){
                        $params = array(
                            "message"      => $data->message,
                            "access_token" =>  $data->access_token
                        );

                        foreach ($medias as $key => $media) {
                            $params["attached_media[".$key."]"] = '{"media_fbid":"'.$media.'"}';
                        }

                        $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                        $response = FbOAuth()->api('/v1.0/'.$group_id.'/feed', "POST", $params);
                        if(isset($response["id"])){
                            $find_id  = explode("_", $response["id"]);
                            $response = array(
                                "id" => $find_id[1]
                            );
                        }

                        
                    }
                    
                    break;

                case 'friend': 

                    switch ($data->group_type) {
                        case 'text':
                            $params = array("message" => $message, "access_token" =>  $data->access_token);
                            $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/feed', "POST", $params);
                            break;

                        case 'link':
                            $params = array(
                                "message"      => $message,
                                "name"         => $data->title,
                                "description"  => $data->description,
                                "link"         => $data->url,
                                "access_token" => $data->access_token
                            );

                            if($data->caption != ""){
                                $params["caption"] = $data->caption;
                            }

                            $image = $data->image;
                            if (checkRemoteFile($image)) {
                                $params["picture"] = $data->image;
                            }
                            $group = $data->group_type=="profile"?"me":$data->group_id;
                            $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/feed', "POST", $params);
                            break;

                        case 'image':
                            $image = $data->image;
                            if (checkRemoteFile($image)) {
                                $params = array(
                                    "message"      => $message,
                                    "access_token" =>  $data->access_token
                                );
                                $params["url"] = $image;
                                $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                                $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/photos', "POST", $params);
                            }
                            break;

                        case 'video':
                            $url = $data->image;
                            $id = getIdYoutube($url);
                            if(strlen($id) == 11){
                                parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id),$info);
                                if($info['status'] == "ok"){
                                    $streams = explode(',',$info['url_encoded_fmt_stream_map']);
                                    $type = "video/mp4"; 
                                    foreach($streams as $stream){ 
                                        parse_str($stream,$real_stream);
                                        $stype = $real_stream['type'];
                                        if(strpos($real_stream['type'],';') !== false){
                                            $tmp = explode(';',$real_stream['type']);
                                            $stype = $tmp[0]; 
                                            unset($tmp); 
                                        } 
                                        if($stype == $type && ($real_stream['quality'] == 'large' || $real_stream['quality'] == 'medium' || $real_stream['quality'] == 'small')){
                                            $params = array(
                                                "description"  => $message,
                                                "file_url"     => $real_stream['url'].'&signature='.@$real_stream['sig'],
                                                "access_token" => $data->access_token
                                            );
                                            
                                            $response = FbOAuth()->api('/v2.9/'.$data->group_id.'/videos', "POST", $params);
                                        }
                                    }
                                }else{
                                    $response = array(
                                        "st"  => "error",
                                        "txt" => strip_tags($info['reason'])
                                    );
                                }
                            }else{
                                if (strpos($url, 'facebook.com') != false) {
                                    $url = FB_DownloadVideo($url);
                                }

                                $params = array(
                                    "description"  => $message,
                                    "file_url"     => $url,
                                    "access_token" =>  $data->access_token
                                );
                                $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/videos', "POST", $params);
                            }
                            break;
                    }
                    break;

                case 'join':
                    try {
                        $params = array(
                            "access_token" =>  $data->access_token
                        );
                        $response = FbOAuth()->api('/'.$data->group_id.'/members/'.$data->fid, "POST", $params);
                        if($response == 1){
                            $response = array("st" => "success", "txt" => l('Registration for join in the success group'));
                        }else{
                            $response = array("st" => "error", "txt" => l('Join group failure'));
                        }
                    } catch (Exception $e) {
                        $response = array("st" => "error", "txt" => $e->getMessage());
                    }
                    break;

                case 'bulk_comment':
                    try {
                        $params = array("access_token" =>  $data->access_token);
                        $params = array("message" => $data->message, "access_token" =>  $data->access_token);
                        $response = FbOAuth()->api('/v1.0/'.$data->title.'/comments', "POST", $params);
                        if(isset($response["id"])){
                            $response = array("st" => "success", "id" => $post_id, "txt" => l('Comment successfully'));
                        }
                    } catch (Exception $e) {
                        $response = array("st" => "error", "txt" => $e->getMessage());
                    }
                    break;

                case 'comment':
                    try {
                        $params = array("access_token" =>  $data->access_token);
                        $posts = FbOAuth()->api('/v1.0/'.$data->group_id.'/feed', "GET", $params);
                        if(!empty($posts['data'])){
                            $post_id = $posts['data'][0]['id'];
                            $params = array("message" => $data->message." ".$data->url, "access_token" =>  $data->access_token);
                            $response = FbOAuth()->api('/v1.0/'.$post_id.'/comments', "POST", $params);
                            if(isset($response["id"])){
                                $response = array("st" => "success", "id" => $post_id, "txt" => l('Comment successfully'));
                            }
                        }else{
                            $response = array("st" => "error", "txt" => l('Comment failure'));
                        }
                    } catch (Exception $e) {
                        $response = array("st" => "error", "txt" => $e->getMessage());
                    }
                    break;

                case 'bulk_like':
                    try {
                        $params = array("access_token" =>  $data->access_token);
                        $response = FbOAuth()->api('/v1.0/'.$data->title.'/likes', "POST", $params);
                        if(!isset($response['error'])){
                            $response = array("st" => "success", "id" => $post_id, "txt" => l('Like successfully'));
                        }else{
                            $response = array("st" => "error", "txt" => $response['error']['message']);
                        }
                    } catch (Exception $e) {
                        $response = array("st" => "error", "txt" => $e->getMessage());
                    }
                    break;

                case 'like':
                    try {
                        $params = array("access_token" =>  $data->access_token);

                        $posts = FbOAuth()->api('/v1.0/'.$data->group_id.'/feed', "GET", $params);

                        if(!empty($posts['data'])){

                            $post_id = $posts['data'][0]['id'];

                            $params = array("access_token" =>  $data->access_token);

                            $response = FbOAuth()->api('/v1.0/'.$post_id.'/likes', "POST", $params);

                            if(!isset($response['error'])){

                                $response = array("st" => "success", "id" => $post_id, "txt" => l('Like successfully'));

                            }else{

                                $response = array("st" => "error", "txt" => $response['error']['message']);

                            }
                        }

                    } catch (Exception $e) {
                        $response = array("st" => "error", "txt" => $e->getMessage());
                    }
                    break;

                case 'add':
                    $params = array(
                        "access_token" =>  $data->access_token
                    );

                    $result = post_content_curl("https://graph.facebook.com/me/friends/".$data->group_id, $params);
                    if(!isset($result->error)){
                        $response = array("st" => "success", "txt" => l('Friend request sent'));
                    }else{
                        $response = array("st" => "error", "txt" => $result->error->message);
                    }
                
                    break;

                case 'unfriends':
                    try {
                        $params = array(
                            "access_token" =>  $data->access_token
                        );
                        //$response = FbOAuth()->api('/me/friends/'.$data->group_id, "DELETE", $params);
                        $response = file_get_contents_curl('https://graph.facebook.com/me/friends?uid='.$data->group_id.'&method=delete&access_token='.$data->access_token);
           
                       // if(isset($response['success']) && $response['success'] == 1){
                    if(isset($response) && $response == 1){
                            $CI = &get_instance();
                            $CI->db->delete(FACEBOOK_GROUPS, "uid = '".$data->uid."' AND pid = '".$data->group_id."'");
                            $response = array("st" => "success", "txt" => l('Unfriend successfully'));
                        }else{
                            $response = array("st" => "error", "txt" => l('Unfriend failure'));
                        }
                    } catch (Exception $e) {
                        $response = array(
                            "st"  => "error",
                            "txt" => $e->getMessage()
                        );  
                    }
                    break;

                case 'invite_to_groups':
                    try {
                        $params = array(
                            "access_token" =>  $data->access_token
                        );
                        $response = FbOAuth()->api('/'.$data->title.'/members/'.$data->group_id, "POST", $params);
                        if(!isset($response['error'])){
                            $response = array("st" => "success", "txt" => l('Invite successfully'));
                        }else{
                            $response = array("st" => "error", "txt" => l('Invite failure'));
                        }
                    } catch (Exception $e) {
                        $response = array(
                            "st"  => "error",
                            "txt" => $e->getMessage()
                        );  
                    }
                    break;

                case 'invite_to_pages':
                    try {
                        $params = array(
                            "invitee_id"   => $data->group_id,
                            "access_token" => $data->access_token
                        );
                        $response = FbOAuth()->api('/'.$data->title.'/invited', "POST", $params);
                        if(!isset($response['error'])){
                            $response = array("st" => "success", "txt" => l('Invite successfully'));
                        }else{
                            $response = array("st" => "error", "txt" => l('Invite failure'));
                        }
                    } catch (Exception $e) {
                        $response = array(
                            "st"  => "error",
                            "txt" => $e->getMessage()
                        );  
                    }
                    break;

                case 'accept_friend_request':
                    try {
                        $params = array(
                            "uid"          => $data->group_id,
                            "access_token" => $data->access_token
                        );

                        $response = FbOAuth()->api('/me/friends', "POST", $params);
                        if(!isset($response['error'])){
                            $response = array("st" => "success", "txt" => l('Accept friend request successfully'));
                        }else{
                            $response = array("st" => "error", "txt" => l('Accept friend request failure'));
                        }
                    } catch (Exception $e) {
                        $response = array(
                            "st"  => "error",
                            "txt" => $e->getMessage()
                        );  
                    }
                    break;

                case 'repost_pages':
                    try {
                        $params = array(
                            "fields"       => "full_picture,name,message,id,description,link,type,status_type,picture,object_id,updated_time,caption",
                            "limit"        => 1,
                            "access_token" => $data->access_token
                        );
                        $response = FbOAuth()->api('/'.$data->title.'/feed', "GET", $params);
                        if(isset($response['data']) && !empty($response['data'])){
                            $post = $response['data'][0];
                            $CI = &get_instance();
                            $check = $CI->model->get("*",REPOST_HISTORY, "page_id = '".$data->title."' AND post_id = '".$post['id']."'");
                            if(empty($check)){
                                $CI->db->insert(REPOST_HISTORY, array(
                                    "page_id"   => $data->title, 
                                    "post_id"   => $post["id"],
                                    "uid"       => $data->uid,
                                    "created"   => NOW
                                ));
                                $CI->db->close();

                                $message = isset($post['message'])?$post['message']:"";
                                if($message != ""){
                                    $replace_messages = $CI->model->fetch("*",REPOST_REPLACE, "uid = '".$data->uid."'");
                                    foreach ($replace_messages as $row) {
                                        $message = str_replace($row->finds, $row->replaces, $message);
                                    }
                                }

                                $types = json_decode($data->caption);
                                if(!empty($types) && in_array($post['type'], $types)){
                                    switch ($post['type']) {
                                        case 'status':
                                            if(isset($post['message']) && $post['status_type'] != 'shared_story'){
                                                $params = array("message" => $post['message'], "access_token" =>  $data->access_token);
                                                $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/feed', "POST", $params);
                                            }else{
                                                $response = array("st" => "error", "txt" => '');
                                            }
                                            break;

                                        case 'link':
                                            $params = array(
                                                "message"      => $message,
                                                "name"         => $post['name'],
                                                "description"  => $post['description'],
                                                "link"         => $post['link'],
                                                "picture"      => $post['full_picture'],
                                                "caption"      => $post['caption'],
                                                "access_token" => $data->access_token
                                            );

                                            $group = $data->group_type=="profile"?"me":$data->group_id;
                                            $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/feed', "POST", $params);
                                            break;

                                        case 'photo':
                                            $params = array(
                                                "url"          => $post['full_picture'],
                                                "message"      => $message,
                                                "access_token" => $data->access_token
                                            );
                                            $group_id = ($data->group_type == "profile")?"me":$data->group_id;
                                            $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/photos', "POST", $params);
                                            break;

                                        case 'video':
                                            if($post['status_type'] == 'added_video'){
                                                $url = $post['link'];
                                                if (strpos($url, 'facebook.com') != false) {
                                                    $url = FB_DownloadVideo($url);
                                                }

                                                $params = array(
                                                    "description"  => $message,
                                                    "file_url"     => $url,
                                                    "access_token" => $data->access_token
                                                );
                                                $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/videos', "POST", $params);
                                            }else{
                                                $params = array(
                                                    "message"      => $message,
                                                    "name"         => $post['name'],
                                                    "description"  => $post['description'],
                                                    "link"         => $post['link'],
                                                    "picture"      => $post['full_picture'],
                                                    "caption"      => $post['caption'],
                                                    "access_token" => $data->access_token
                                                );

                                                $group = $data->group_type=="profile"?"me":$data->group_id;
                                                $response = FbOAuth()->api('/v1.0/'.$data->group_id.'/feed', "POST", $params);
                                            }
                                            break;
                                    }
                                    if(isset($response['id'])){
                                        $response = array("st" => "success", "id" => $response['id'], "txt" => l('Repost successfully'));
                                    }else{
                                        if(isset($response['error']) && $response['error']['code'] == 10000){
                                            $response = array("st" => "error", "code" => 100, "txt" => l('This page does not have recent post'));
                                        }else{
                                            $response = array("st" => "error", "txt" => l('This page does not have recent post'));
                                        }
                                    }

                                    $CI->db->initialize();
                                    $CI->db->reconnect();
                                    $CI->db->update(REPOST_HISTORY, array(
                                        "repost_id" => isset($response['id'])?$response['id']:"",
                                        "created"   => NOW
                                    ), array("page_id" => $data->title, "post_id" => $post["id"]));
                                }
                            }
                        }
                    } catch (Exception $e) {
                        $response = array(
                            "st"  => "error",
                            "txt" => $e->getMessage()
                        );  
                    }
                    break;
                    
            }

            if(isset($response["id"]) || (isset($response["st"]) && $response["st"] == "success")){
                $response = array(
                    "st"  => "success",
                    "txt" => isset($response["txt"])?$response["txt"]:"",
                    "id"  => isset($response["id"])?$response["id"]:""
                );
            }else{
                if(isset($response["error"]) || isset($response["st"])){
                    $response = array(
                        "st"  => "error",
                        "code"=> isset($response["code"])?$response["code"]:"",
                        "txt" => isset($response["txt"])?$response["txt"]:$response["error"]["message"]
                    );
                }else{
                    $response = array(
                        "st"  => "error",
                        "txt" => "Unknow error"
                    );
                }
            }
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            $response = array(
                "st"  => "error",
                "txt" => $e->getMessage()
            );
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            $response = array(
                "st"  => "error",
                "txt" => $e->getMessage()
            );
        }

        return $response;
    }
}

if(!function_exists("FACEBOOK_GET_USER")){
    function FACEBOOK_GET_USER(){
        require_once( APPPATH."libraries/Facebook/autoload.php" );
        $fb = new \Facebook\Facebook([
          'app_id' => FACEBOOK_ID,
          'app_secret' => FACEBOOK_SECRET,
          'default_graph_version' => 'v2.10',
          'persistent_data_handler' => 'session'
        ]);
        $helper = $fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }
        try {
            $accessToken = $helper->getAccessToken();
            // OAuth 2.0 client handler
            $oAuth2Client = $fb->getOAuth2Client();
            // Exchanges a short-lived access token for a long-lived one
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            $response = $fb->get( '/me?fields=id,name,email', (string)$accessToken);
            $data = $response->getGraphUser();
         //   print_r($accessToken);
        //    $this->db->insert (token , $accessToken);
            return $data;

        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            pr($e->getMessage(),1);
            return false;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            pr($e->getMessage(),1);
            return false;
        }
    }
}

if(!function_exists("FACEBOOK_GET_LOGIN_URL")){
    function FACEBOOK_GET_LOGIN_URL(){
        $FB = FbOAuth();
        return $FB->getLoginUrl(array('scope' => 'user_birthday, user_likes, user_friends, user_posts, email, user_managed_groups, manage_pages, publish_pages, public_profile', 'redirect_uri' => "https://clicking.vn/openid/facebook"));

 /*   $params = array(
        'scope' => 'user_birthday, user_likes, user_friends, user_posts, email, user_managed_groups, manage_pages, publish_pages, ads_management, public_profile',
       'redirect_uri' => 'https://clicking.vn/openid/facebook',
        );
       return $FB->getLoginUrl($params);
        */
    }
}

if(!function_exists("FbOAuth")){
    function FbOAuth(){
        require_once( APPPATH."libraries/FbOAuth/facebook.php" );
        $fb  = new FacebookCustom( array("appId" => FACEBOOK_ID, "secret" => FACEBOOK_SECRET) );
        return $fb;
    }
}

if(!function_exists("CREATE_SIG")){
    function CREATE_SIG($postdata, $secretkey){
        $textsig = "";
        foreach($postdata as $key => $value){
            $textsig .= "$key=$value";
        }
        $textsig .= $secretkey;
        $textsig = md5($textsig);
        
        return $textsig;
    }
}

if(!function_exists("REQUEST_CURL")){
    function REQUEST_CURL($url, $postdata='')
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36');

        if($postdata != "")
        {
            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);
        }
        
        $page = curl_exec($c);
        curl_close($c);
        return $page;
    }
}

	      

if(!function_exists("GET_ACCESS_TOKEN")){
    function GET_ACCESS_TOKEN($user = "", $pass = "", $app = ""){
        
$ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login.php'); 
            curl_setopt($ch, CURLOPT_POSTFIELDS,'charset_test=€,´,€,´,水,Д,Є&email='.urlencode($user).'&pass='.urlencode($pass).'&login=Login'); 
            curl_setopt($ch, CURLOPT_POST, 1); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Charset: utf-8', 
            'Accept-Language: en-us,en;q=0.7,bn-bd;q=0.3', 
            'Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5'));  
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd () . '/'.$app.'clicking_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd () . '/'.$app.'clicking_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
            curl_setopt($ch, CURLOPT_REFERER, "https://facebook.com/profile"); 
            $ketqua = curl_exec($ch) or die(curl_error($ch));  
            curl_setopt($ch, CURLOPT_URL, 'https://facebook.com/profile');
             
            $ketqua = curl_exec($ch) or die(curl_error($ch)); 
            $pattern = '/EAAA[A-z0-9]+\"/i';
            $token = explode ('"',$patten[0]);
             
                    
            if (preg_match($pattern, $ketqua, $match)) {
                 //print_r ($match);
                 $token = explode ('"',$match[0]);
                 $data->access_token = $token[0];
                
                curl_close($ch); 
                //----------Auto Delete File Cookie----------// 
                  $file_name = ''.$app.'clicking_cookie.txt'; 
                  unlink($file_name); 
                //-------------------------------------------// 
                                
                 return $data->access_token;
                 //print_r ($token[0]);
            }else {
                curl_close($ch); 
                //----------Auto Delete File Cookie----------// 
                  $file_name = ''.$app.'clicking_cookie.txt'; 
                  unlink($file_name); 
                //-------------------------------------------// 
                
                $data->access_token = 'Quý khách vui lòng vào ứng dụng facebook hoặc trình duyệt để xác nhận rồi lấy lại token';
                return $data->access_token;
            }
    }
}

if(!function_exists("GET_PAGE_ACCESS_TOKEN")){
    function GET_PAGE_ACCESS_TOKEN($user = "", $pass = "", $app = ""){
   
   
    $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login.php'); 
            curl_setopt($ch, CURLOPT_POSTFIELDS,'charset_test=€,´,€,´,水,Д,Є&email='.urlencode($user).'&pass='.urlencode($pass).'&login=Login'); 
            curl_setopt($ch, CURLOPT_POST, 1); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Charset: utf-8', 
            'Accept-Language: en-us,en;q=0.7,bn-bd;q=0.3', 
            'Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5'));  
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd () . '/'.$app.'clicking_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd () . '/'.$app.'clicking_cookie.txt' ); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
            curl_setopt($ch, CURLOPT_REFERER, "https://facebook.com/profile"); 
            
            $ketqua = curl_exec($ch) or die(curl_error($ch));  
            
            curl_setopt($ch, CURLOPT_URL, 'https://facebook.com/profile');
             
            $ketqua = curl_exec($ch) or die(curl_error($ch)); 
            
            $pattern = '/EAAA[A-z0-9]+\"/i';
            $token = explode ('"',$patten[0]);

             curl_close($ch); 
                //----------Auto Delete File Cookie----------// 
                  $file_name = ''.$app.'clicking_cookie.txt'; 
                  unlink($file_name); 
                //-------------------------------------------// 
                
             
                    
            if (preg_match($pattern, $ketqua, $match)) {
                 //print_r ($match);
                 $token = explode ('"',$match[0]);
                 $data->access_token = $token[0];

                 return $data->access_token;
                 //print_r ($token[0]);
            }else {
                $data->access_token = 'Quý khách vui lòng vào ứng dụng facebook hoặc trình duyệt để xác nhận rồi lấy lại token';
                return $data->access_token;
            }
   
 /*       switch ($app) {
            case '6628568379':
                $api_key = "3e7c78e35a76a9299309885393b02d97";
                $secretkey = "c1e620fa708a1d5696fb991c1bde5662";
                break;

            default:
                $api_key = "882a8490361da98702bf97a021ddc14d";
                $secretkey = "62f8ce9f74b12f84c123cc23437a4a32";
                break;
        }

        $postdata = array(
            "api_key" => $api_key,
            "email" => $user,
            "format" => "JSON",
            //"locale" => "vi_vn",
            "method" => "auth.login",
            "password" => $pass,
            "return_ssl_resources" => "0",
            "v" => "1.0"
        );
        
        $postdata['sig'] = CREATE_SIG($postdata, $secretkey);
        $query = http_build_query($postdata);
        //return "https://api.facebook.com/restserver.php?".$query;  
       return "hellllllllo"; */
    }
}


//FUNCTION HELPER
if (!function_exists('FB_DownloadVideo')) {
    function FB_DownloadVideo($url) {
        $useragent = 'Mozilla/5.0 (Linux; U; Android 2.9.3; de-de; HTC Desire Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $source = curl_exec($ch);
        curl_close($ch);

        $download = explode('/video_redirect/?src=', $source);
        if(isset($download[1])){
            $download = explode('&amp', $download[1]);
            $download = rawurldecode($download[0]);
            return $download;
        }
        
        return "error";
    }
}

if (!function_exists('getIdYoutube')) {
    function getIdYoutube($link){
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $id);
        if(!empty($id)) {
            return $id = $id[0];
        }
        return $link;
    }
}

if (!function_exists('checkRemoteFile')) {
    function checkRemoteFile($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        if(curl_exec($ch)!==FALSE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>
