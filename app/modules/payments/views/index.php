<div class="pricing-table">
	<div class="title"><?=l('NÂNG CẤP TÀI KHOẢN CỦA BẠN!')?></div>
	<?php if(!empty($package)){?>

	<?php foreach ($package as $row) {
		$price = explode(".", $row->price);
		$permission = json_decode($row->permission);
	?>
	<div class="whole">
		<div class="type">
			<p><?=$row->name?></p>
			</div>
		<div class="plan">
			<div class="header" style="font-size:50px; height:100px;">
				<span>đ </span><?=$price[0]?>
				<p class="month">/<?=$row->day?> <?=l('days')?></p>
			</div>
			<div class="content">
				<ul>
					<li class="bg-light-green"><?=$permission->maximum_account?> <?=l('Facebook Accounts')?></li>
					<li><?=$permission->maximum_groups?> <?=l('Groups')?></li>
					<li><?=$permission->maximum_pages?> <?=l('Pages')?></li>
					<li><?=$permission->maximum_friends?> <?=l('Friends')?></li>
					<li><?=l('Auto post')?> <?=permission_list($row->permission, 'post')?></li>
					<li><?=l('Auto content')?> <?=permission_list($row->permission, 'auto_all')?></li>
					<li><?=l('Content hot trend')?> <?=permission_list($row->permission, 'content')?></li>
					<li><?=l("Auto post to friend's wall")?> <?=permission_list($row->permission, 'post_wall_friends')?></li>
				<!--	<li><?=l("Bulk comment a post")?> <?=permission_list($row->permission, 'bulk_comment')?></li>
					<li><?=l("Bulk like a post")?> <?=permission_list($row->permission, 'bulk_like')?></li>
					<li><?=l("Auto repost pages")?> <?=permission_list($row->permission, 'repost_pages')?></li>  -->
					<li><?=l("Auto join groups")?> <?=permission_list($row->permission, 'join_groups')?></li>
					<li><?=l("Auto add friends")?> <?=permission_list($row->permission, 'add_friends')?></li>
					<li><?=l("Auto unfriends")?> <?=permission_list($row->permission, 'unfriends')?></li>
					<li><?=l("Auto invite to groups")?> <?=permission_list($row->permission, 'invite_to_groups')?></li>
					<li><?=l("Auto invite to like page")?> <?=permission_list($row->permission, 'invite_to_pages')?></li>
					<li><?=l("Auto accept friend request")?> <?=permission_list($row->permission, 'accept_friend_request')?></li>
					<li><?=l("Auto comment")?> <?=permission_list($row->permission, 'comment')?></li>
					<li><?=l("Auto like")?> <?=permission_list($row->permission, 'like')?></li>
					<li><?=l("Facebook search")?> <?=permission_list($row->permission, 'search')?></li>
					<li><?=l("Fanpage analytics")?> <?=permission_list($row->permission, 'analytics')?></li>
				</ul>

			</div>
			<div class="price">
			    <h4>Tính năng hot sắp mở</h4>
				<?php if(session("uid")){?>
	      		<!--	<a href="<?=cn("type?package=".$row->id)?>" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('UPGRADE NOW')?></a> -->
				<?php }else{?>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('UPGRADE NOW')?></a>
	      		<?php }?>
	      		-->
			</div>
		</div>
	</div>
	<?php }?>
       <!--     <div class="whole" >
                <div class="guide_bank" style="width:50%; float:left; border: 1px solid #8B2;">
		    	<h4> Hướng dẫn thanh toán </h4>
		    	<p class="suport_text" style="text-align:left; margin: 20px;"> Chuyển số tiền tương ứng với gói bạn muốn nâng cấp vào 1 trong các tài khoản sau đây: </br>
		    	<b>TPbank:</b> </br>
		    	Stk: 00362995001   </br>
		    	Chủ tài khoản: Trần Quốc Toản   </br>
		    	Chinh nhánh : Thăng Long   </br>
		    	</br>
		    	<b>VPbank:   </b> </br>
		    	Stk: 99647175   </br>
	    		Chủ tài khoản:   </br>
		    	Chi nhánh: Hà Thành    </br>
		    	</br>
		    	<b>	Viettinbank  </b> </br>
		    	Stk: 101010009818214   </br>
		    	Chủ tài khoản: Trần Quốc Toản   </br>
			    Chi nhánh: Tp Hà Nội   </br>
			    </br>
			    <b> Paypal </b> </br>
			    email: magic.loveptit@gmail.com </br>
		    	</br>
			    Nội dung chuyển tiền: <b> Tên_Tài_Khoản + Tên_gói</b> </br>
			    Tài khoản của bạn sẽ được kích hoạt ngay khi có thông báo nhận được tiền. Chúc các bạn kinh doanh tốt
		    	</p>
		    	</div>
		    	
		    	<div class="support" style="width:50%; float:right;">
    		    	    <h4>HỖ TRỢ</h4>
    		    	    <p class="suport_text" style="text-align:left; margin: 20px; ">
    		    	    Điện thoại: 0944 966 078  - 0965 966 078 </br>
    		    	    Email: Toantq1908@gmail.com </br>
    		    	    Facebook: <a href="https://www.facebook.com/toan.tran199x" title="Toản Trần" target="_blank" style="color:#000;"> <span><?=l('Toan Tran')?></span>̀ </a> </br>
    		    	    Group chia sẻ kiến thức và công cụ : <a href=" https://www.facebook.com/groups/268449130352497/" title="Toản Trần" target="_blank" style="color:#000;"> <span><?=l('Group facebook')?></span>̀ </a> </br>
    		    	    
    		    	    
		    	    
		    	    </p> 
		    	</div>
	    	</div>    -->
	<?php }?>
</div>
<?=modules::run("blocks/footer")?>