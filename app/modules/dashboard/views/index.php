<div class="row">
    <!--
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">send</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l('Total process')?></div>
                <div class="number"><?=$total->total?></div>
            </div>
        </div>

    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">beenhere</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l("Total success")?></div>
                <div class="number"><?=$total->success?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">sms_failed</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l("Total failure")?></div>
                <div class="number"><?=$total->failure?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">layers</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l("Total processing")?></div>
                <div class="number"><?=$total->processing?></div>
            </div>
        </div>
    </div>
-->

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">contacts</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l('Profile')?></div>
                <div class="number"><?=$group->profile?></div>
            </div>
        </div>

    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">group</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l("Group")?></div>
                <div class="number"><?=$group->group?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">library_books</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l("Page")?></div>
                <div class="number"><?=$group->page?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-2 bg-<?=THEME?> hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">person</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l("Friend")?></div>
                <div class="number"><?=$group->friend?></div>
            </div>
        </div>
    </div>
</div>

<?php 
foreach ($accounts as $key => $row){
    $get_friendinfos = file_get_contents_curl("https://graph.facebook.com/me?access_token=".$row->access_token);
    
    if (empty($get_friendinfos->name)){?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-black">
                <h2 class="uc">
                    <?php echo ("Tài khoản " .$row->fullname . " hết hạn mã token   ");?>
                    <a href="/facebook_accounts/" target="_blank" title="Click" rel="follow, index"><?=l('Click để lấy lại mã token ')?></a>
                </h2>
            </div>
        </div>
    </div>
</div>    
    
<?php }}?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-<?=THEME?>">
                <h2 class="uc">
                    <?=l('Report by day')?>
                </h2>
            </div>
            <div class="body">
                <div class="ajax_post_by_day"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
            <div class="header bg-<?=THEME?>" style="border: 1px solid #ddd; border-bottom: none;">
                <h2 class="uc">
                    <?=l('Post')?>
                </h2>
            </div>
            <div class="body">
                <div class="post_pie_chart"></div>
            </div>
            <div class="body p0">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-check col-light-green" aria-hidden="true"></i> <?=l('Success')?> <span class="badge bg-grey"><?=$post->success?></span></li>
                    <li class="list-group-item"><i class="fa fa-exclamation-circle col-red" aria-hidden="true"></i> <?=l('Failure')?> <span class="badge bg-grey"><?=$post->failure?></span></li>
                    <li class="list-group-item"><i class="fa fa-tasks col-blue" aria-hidden="true"></i> <?=l('Processing')?> <span class="badge bg-grey"><?=$post->processing?></span></li>
                    <li class="list-group-item"><i class="fa fa-repeat col-deep-purple" aria-hidden="true"></i> <?=l('Repeat')?> <span class="badge bg-grey"><?=$post->repeat?></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
            <div class="header bg-<?=THEME?>" style="border: 1px solid #ddd; border-bottom: none;">
                <h2 class="uc">
                    <?=l("Post to friend's wall")?>
                </h2>
            </div>
            <div class="body">
                <div class="friend_pie_chart"></div>
            </div>
            <div class="body p0">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-check col-light-green" aria-hidden="true"></i> <?=l('Success')?> <span class="badge bg-grey"><?=$friend->success?></span></li>
                    <li class="list-group-item"><i class="fa fa-exclamation-circle col-red" aria-hidden="true"></i> <?=l('Failure')?> <span class="badge bg-grey"><?=$friend->failure?></span></li>
                    <li class="list-group-item"><i class="fa fa-tasks col-blue" aria-hidden="true"></i> <?=l('Processing')?> <span class="badge bg-grey"><?=$friend->processing?></span></li>
                    <li class="list-group-item"><i class="fa fa-repeat col-deep-purple" aria-hidden="true"></i> <?=l('Repeat')?> <span class="badge bg-grey"><?=$friend->repeat?></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
            <div class="header bg-<?=THEME?>" style="border: 1px solid #ddd; border-bottom: none;">
                <h2 class="uc">
                    <?=l("Like")?>
                </h2>
            </div>
            <div class="body">
                <div class="like_pie_chart"></div>
            </div>
            <div class="body p0">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-check col-light-green" aria-hidden="true"></i> <?=l('Success')?> <span class="badge bg-grey"><?=$like->success?></span></li>
                    <li class="list-group-item"><i class="fa fa-exclamation-circle col-red" aria-hidden="true"></i> <?=l('Failure')?> <span class="badge bg-grey"><?=$like->failure?></span></li>
                    <li class="list-group-item"><i class="fa fa-tasks col-blue" aria-hidden="true"></i> <?=l('Processing')?> <span class="badge bg-grey"><?=$like->processing?></span></li>
                    <li class="list-group-item"><i class="fa fa-repeat col-deep-purple" aria-hidden="true"></i> <?=l('Repeat')?> <span class="badge bg-grey"><?=$like->repeat?></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
            <div class="header bg-<?=THEME?>" style="border: 1px solid #ddd; border-bottom: none;">
                <h2 class="uc">
                    <?=l("Join Groups")?>
                </h2>
            </div>
            <div class="body">
                <div class="join_pie_chart"></div>
            </div>
            <div class="body p0">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-check col-light-green" aria-hidden="true"></i> <?=l('Success')?> <span class="badge bg-grey"><?=$join->success?></span></li>
                    <li class="list-group-item"><i class="fa fa-exclamation-circle col-red" aria-hidden="true"></i> <?=l('Failure')?> <span class="badge bg-grey"><?=$join->failure?></span></li>
                    <li class="list-group-item"><i class="fa fa-tasks col-blue" aria-hidden="true"></i> <?=l('Processing')?> <span class="badge bg-grey"><?=$join->processing?></span></li>
                    <li class="list-group-item"><i class="fa fa-repeat col-deep-purple" aria-hidden="true"></i> <?=l('Repeat')?> <span class="badge bg-grey"><?=$add->repeat?></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
            <div class="header bg-<?=THEME?>" style="border: 1px solid #ddd; border-bottom: none;">
                <h2 class="uc">
                    <?=l("Add friends")?>
                </h2>
            </div>
            <div class="body">
                <div class="add_pie_chart"></div>
            </div>
            <div class="body p0">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-check col-light-green" aria-hidden="true"></i> <?=l('Success')?> <span class="badge bg-grey"><?=$add->success?></span></li>
                    <li class="list-group-item"><i class="fa fa-exclamation-circle col-red" aria-hidden="true"></i> <?=l('Failure')?> <span class="badge bg-grey"><?=$add->failure?></span></li>
                    <li class="list-group-item"><i class="fa fa-tasks col-blue" aria-hidden="true"></i> <?=l('Processing')?> <span class="badge bg-grey"><?=$add->processing?></span></li>
                    <li class="list-group-item"><i class="fa fa-repeat col-deep-purple" aria-hidden="true"></i> <?=l('Repeat')?> <span class="badge bg-grey"><?=$add->repeat?></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
            <div class="header bg-<?=THEME?>" style="border: 1px solid #ddd; border-bottom: none;">
                <h2 class="uc">
                    <?=l("Comment")?>
                </h2>
            </div>
            <div class="body">
                <div class="comment_pie_chart"></div>
            </div>
            <div class="body p0">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-check col-light-green" aria-hidden="true"></i> <?=l('Success')?> <span class="badge bg-grey"><?=$comment->success?></span></li>
                    <li class="list-group-item"><i class="fa fa-exclamation-circle col-red" aria-hidden="true"></i> <?=l('Failure')?> <span class="badge bg-grey"><?=$comment->failure?></span></li>
                    <li class="list-group-item"><i class="fa fa-tasks col-blue" aria-hidden="true"></i> <?=l('Processing')?> <span class="badge bg-grey"><?=$comment->processing?></span></li>
                    <li class="list-group-item"><i class="fa fa-repeat col-deep-purple" aria-hidden="true"></i> <?=l('Repeat')?> <span class="badge bg-grey"><?=$comment->repeat?></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('.ajax_post_by_day').highcharts({
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    day: '%b %e',
                },
                tickInterval: 0,
                labels: {
                    enabled: true,
                    formatter: function() { return moment(this.value).format("MMM D"); },
                }
            },
            yAxis: {
                title: ''
            },
            tooltip: {
                crosshairs: true,
                animation: true,
                shared: true,
            },
            series: [
                {
                    name: '<?=l('Post')?>',
                    data: [<?=$post_by_day?>]
                },{
                    name: "<?=l("Post to friend's wall")?>",
                    data: [<?=$friend_by_day?>]
                },{
                    name: "<?=l('Join groups')?>",
                    data: [<?=$join_by_day?>]
                },{
                    name: "<?=l('Add friends')?>",
                    data: [<?=$add_by_day?>]
                },{
                    name: "<?=l('Comment')?>",
                    data: [<?=$comment_by_day?>]
                },{
                    name: "<?=l('Like')?>",
                    data: [<?=$like_by_day?>]
                }
            ]
        });

        Analytics.Highcharts({
            element : '.post_pie_chart',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : '<?=l('Posts')?>',
            data    : [<?=!empty($post_pie_chart)?$post_pie_chart:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Analytics.Highcharts({
            element : '.friend_pie_chart',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : '<?=l('Posts')?>',
            data    : [<?=!empty($friend_pie_chart)?$friend_pie_chart:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Analytics.Highcharts({
            element : '.like_pie_chart',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : '<?=l('Like')?>',
            data    : [<?=!empty($like_pie_chart)?$like_pie_chart:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Analytics.Highcharts({
            element : '.join_pie_chart',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : '<?=l('Groups')?>',
            data    : [<?=!empty($join_pie_chart)?$join_pie_chart:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Analytics.Highcharts({
            element : '.add_pie_chart',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : '<?=l('Friend')?>',
            data    : [<?=!empty($add_pie_chart)?$add_pie_chart:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Analytics.Highcharts({
            element : '.comment_pie_chart',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : '<?=l('Comment')?>',
            data    : [<?=!empty($comment_pie_chart)?$comment_pie_chart:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });
    });
    </script>
