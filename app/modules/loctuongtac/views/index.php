<form class="formSchedule" action="<?=cn('ajax_post_now')?>" data-action="<?=cn('ajax_save_schedules')?>">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-users" aria-hidden="true"></i> <?=l("Lọc bạn bè không tương tác")?> 
                    </h2>
                </div>
                <div class="body pt0">
                    <div class="row">
                       <p>Tính năng giúp bạn lọc ra những bạn bè không tương tác
                       với một số lượng bài post nhất định, tự động hủy kết bạn với những bạn bè được chọn</p>
                    </div>         
                </div>    
                    
                <div class="body pt0">
                    
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 mt15" style="display:none">
                                    <b><?=l('Delay (seconds)')?></b>
                                    <select class="form-control deplay_post_now">
                                        <?php for ($i = 100; $i <= 900; $i++) {
                                        if($i%5 == 0){
                                            if(MINIMUM_DEPLAY_POST_NOW <= $i){
                                        ?>
                                            <option value="<?=$i?>" <?=(DEFAULT_DEPLAY_POST_NOW == $i)?"selected":""?>><?=$i." ".l('seconds')?></option>
                                        <?php }}} ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb0">
                                    <div class="btn-group right" role="group">
                                   <!--     <button type="button" class="btn bg-light-green waves-effect btnPostnow"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <?=l('Join now')?></button> -->
                                        <button type="button" class="btn bg-light-green waves-effect open-schedule"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?=l('Schedule')?></button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt15 box-post-schedule">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb0">
                                    <div class="custom-card">
                                        <div class="body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-clock-o" aria-hidden="true"></i> <?=l('Time post')?></b>
                                                    <div class="input-group mb0">
                                                        <div class="form-line">
                                                            <input type="text" name="time_post" class="form-control form-datetime">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-bullseye" aria-hidden="true"></i> <?=l('Delay (minutes)')?></b>
                                                    <div class="input-group mb0">
                                                        <select name="deplay" class="form-control">
                                                            <?php for ($i = 1; $i <= 720; $i++) {
                                                                if(MINIMUM_DEPLAY <= $i){
                                                            ?>
                                                                <option value="<?=$i?>" <?=(DEFAULT_DEPLAY == $i)?"selected":""?>><?=$i." ".l('minutes')?></option>
                                                            <?php }} ?>                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="display:none">
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-pause-circle-o" aria-hidden="true"></i> <?=l('Auto pause after complete')?></b>
                                                    <div class="input-group mb0">
                                                        <select name="auto_pause" class="form-control">
                                                            <option value="0"><?=l('No')?></option>
                                                            <?php for ($i = 1; $i <= 50; $i++) {
                                                            ?>
                                                                <option value="<?=$i?>"><?=$i." ".l('posts')?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-clock-o" aria-hidden="true"></i> <?=l('Time pause')?></b>
                                                    <select name="time_pause" class="form-control">
                                                        <?php for ($i = 15; $i <= 900; $i++) {
                                                        if($i%5 == 0){
                                                        ?>
                                                            <option value="<?=$i?>"><?=$i." ".l('minutes')?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb0">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn bg-light-blue waves-effect btnSaveSchedules"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?=l('Save the schedule')?></button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="footer" style="display:none">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn bg-light-blue waves-effect btnPausePost"><i class="fa fa-pause" aria-hidden="true"></i> <?=l('Pause')?></button>
                        <button type="button" class="btn bg-light-blue waves-effect btnResumePost"><i class="fa fa-repeat" aria-hidden="true"></i> <?=l('Resume')?></button>
                    </div>
                    <div class="countTimer right pt5">
                        <div class="countDown col-black"><b><?=l('Time left:')?> <span class="col-red">--:--</span></b></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-desktop" aria-hidden="true"></i> <?=l('Huong dan su dung')?> 
                    </h2>
                     
                </div>
<iframe width="100%" height="360" src="https://www.youtube.com/embed/KYAf9vLJJkc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formFacebookSearch">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?=l('Chọn bạn bè không tương tác')?>
                    </h2>
                </div>
                <div class="header pt0">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tab_add_friend" role="tablist">
                                <li role="presentation" data-type="friend_group" class="active">
                                    <a href="#join_group_1" data-toggle="tab">
                                        <i class="material-icons">search</i> <?=l('Search Groups')?>
                                    </a>
                                </li>
                               <!-- <li role="presentation" data-type="import" class="tab_import">
                                    <a href="#join_group_2" data-toggle="tab">
                                        <i class="material-icons">file_upload</i> <?=l('Import Groups ID')?>
                                    </a>
                                </li> -->
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="join_group_1">
                                    <div class="list-filter-search clearfix" data-action="<?=cn('ajax_search_group')?>">
                                        <div class="col-md-1">
                                            <b><?=l('Limit')?></b>
                                            <div class="form-group">
                                                <select class="form-control" name="limit">
                                                    <?php for ($i=100; $i <= 5000; $i++) {
                                                    if($i%200==0){
                                                    ?> 
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <b><?=l('Facebook accounts')?></b>
                                            <div class="form-group">
                                                <select class="form-control" name="account">
                                                    <?php if(!empty($accounts)){
                                                    foreach ($accounts as $row) {?>
                                                    <option value="<?=$row->id?>"><?=$row->username?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <b><?=l('Keyword')?></b>
                                            <div class="input-group"style="background: white; border: 1px solid #ddd;">
                                                <div class="form-line" style="border: none;">
                                                    <input type="text" name="keyword" class="form-control enter-keyword" placeholder="Nhập số bài post (vd: 20, tìm những người không tương tác trong 20 bài post)">
                                                </div>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn bg-red waves-effect btnSearchGroups"><i class="fa fa-search" aria-hidden="true"></i> <?=l('Search')?></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="join_group_2">
                                    <div class="list-filter-search clearfix" data-action="<?=cn('ajax_search_group')?>">
                                        <div class="col-md-2">
                                            <b><?=l('Facebook accounts')?></b>
                                            <div class="form-group">
                                                <select class="form-control list_account account_temp">
                                                    <?php if(!empty($accounts)){
                                                    foreach ($accounts as $row) {
                                                    ?>
                                                    <option value="<?=$row->id?>"><?=$row->username?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-10">
                                            <b><?=l('Import List Groups ID')?></b>
                                            <div class="input-group"style="background: white; border: 1px solid #ddd;">
                                                <div class="form-line" style="border: none;">
                                                    <input type="text" name="list_uid" class="form-control enter-keyword">
                                                </div>
                                                <span class="input-group-btn">
                                                    <a class="btn bg-red waves-effect dialog-import-group"><i class="fa fa-upload" aria-hidden="true"></i> <?=l('Upload')?></a>
                                                </span>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="body p0">
                                        <table class="table table-bordered table-striped table-hover js-dataTableImport dataTable mb0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">
                                                        <input type="checkbox" id="md_checkbox_all1" class="filled-in chk-col-red checkAll">
                                                        <label class="p0 m0" for="md_checkbox_all1">&nbsp;</label>
                                                    </th>
                                                    <th><?=l('ID')?></th>
                                                    <th><?=l('Name')?></th>
                                                    <th><?=l('Type')?></th>
                                                    <th><?=l('Link')?></th>
                                                    <th><?=l('Process')?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="ListUidImport">
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body p0 result_search">
                    
                </div>
            </div>
        </div>
    </div>
</form>