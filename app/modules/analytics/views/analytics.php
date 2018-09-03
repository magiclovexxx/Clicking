<link rel="stylesheet" href="<?=BASE?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
<div class="row analytics-page">
    <div class="col-md-12">
    	<!--SEARCH-->
    	<section class="head-sort">
        	<div class="row">
        		<div class="col-md-12">
        			<form class="form">
        				<div class="input-group input-group-sm" style="width: 320px;">
	        				<span class="input-group-btn">
								<div class="btn btn-primary"><i class="fa fa-calendar"></i></div>
							</span>
							<?php $date = date('m/d/Y', strtotime(NOW.' -29 day'))." - ".date('m/d/Y', strtotime(NOW.'-1 day'))?>
							<input type="text" class="form-control datepicker daterange" style="background: #fff;" name="daterange" value="<?=(get('daterange') != '')?get('daterange'):$date?>">
							<span class="input-group-btn">
								<button class="btn btn-primary btn-flat btnDateRange" type="submit">Submit</button>
							</span>
						</div>
        			</form>
        		</div>
        	</div>
    	</section>	

    	<!--INFO-->
    	<?php if(!empty($info)){
    		$info = (object)$info;
    	?>
    	<section class="item-metric" id="section-0">
		    <div class="card widget-user">
		        <div class="widget-user-header bg-green" style="height: 265px; background: url(<?=(isset($info->cover)?$info->cover["source"]:"")?>) center center;">
		            <h3 class="widget-user-username"><?=$info->name?></h3>
		            <h5 class="widget-user-desc"><?=$info->category?></h5>
		        </div>
		        <div class="widget-user-image" style="top: 209px;">
		            <img class="img-circle" src="<?=(isset($info->picture)?$info->picture:"")?>" alt="">
		        </div>
		        <div class="box-footer">
		            <div class="row">
		                <div class="col-sm-6 col-xs-6 border-right">
		                    <div class="description-block">
		                        <h5 class="description-header text-red"><?=format_number($info->fan_count)?></h5>
		                        <span class="description-text">Likes</span>
		                    </div>
		                </div>
		                <div class="col-sm-6 col-xs-6 border-right">
		                    <div class="description-block">
		                        <h5 class="description-header text-red"><?=format_number($info->talking_about_count)?></h5>
		                        <span class="description-text">Talking About</span>
		                    </div>
		                </div>
		            </div>
		        </div>
			    </div>
		</section>
		<?php }?>

    	<section class="item-metric" id="section-1">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-reach.png">
			            <span class="username" style="line-height: 40px;">Reach and Impressions</span>
			        </div>
			    </div>
			    <div class="body">
			        <div class="reachchart"></div>
			    </div>
			</div>
		</section>

		<section class="item-metric" id="section-2">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-posts.png">
			            <span class="username" style="line-height: 40px;">Interactive Posts</span>
			        </div>
			    </div>
			    <div class="body">
			        <div class="postschart"></div>
			    </div>
			</div>
		</section>

		<section class="item-metric" id="section-3">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-page.png">
			            <span class="username" style="line-height: 40px;">Page and Tab Visits</span>
			        </div>
			    </div>
			    <div class="body">
			        <div class="tabchart"></div>
			    </div>
			</div>
		</section>

		<section class="item-metric" id="section-4">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-fan.png">
			            <span class="username" style="line-height: 40px;">Fans Online</span>
			        </div>

			    </div>

			    <div class="body">
			        <div class="fanschart"></div>
			    </div>
			</div>
		</section>

		<section class="item-metric" id="section-5">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-like.png">
			            <span class="username" style="line-height: 40px;">Likes & Unlikes</span>
			        </div>
			    </div>
			    <div class="body">
			        <div class="likeschart"></div>
			    </div>
			</div>
		</section>

		<section class="item-metric" id="section-6">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-gender.png">
			            <span class="username" style="line-height: 40px;">Age and Gender</span>
			        </div>

			    </div>
			    <div class="body">
			        <div class="genderchart"></div>
			    </div>
			</div>
		</section>

		<section class="item-metric" id="section-7">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-country.png">
			            <span class="username" style="line-height: 40px;">Country</span>
			        </div>
			    </div>
			    <div class="body">
			        <div class="countrychart"></div>
			    </div>
			</div>
		</section>
		<section class="item-metric" id="section-8">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-city.png">
			            <span class="username" style="line-height: 40px;">City</span>
			        </div>
			    </div>
			    <div class="body">
			        <div class="citychart"></div>
			    </div>
			</div>
		</section>
		<section class="item-metric" id="section-9">
		    <div class="card">
			    <div class="header">
			        <div class="user-block">
			            <img class="img-circle" src="<?=BASE?>assets/images/icon-source.png">
			            <span class="username" style="line-height: 40px;">Referrers & Sources</span>
			        </div>
			    </div>
			    <div class="body">
			        <div class="sourcechart"></div>
			    </div>
			</div>
		</section>
    </div>
</div>
<script src="<?=BASE?>assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?=BASE?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
	$(function(){
		if($('.datepicker').length > 0){
			$('.datepicker').daterangepicker({dateLimit: { months: 3 }});
		}
	});
</script>