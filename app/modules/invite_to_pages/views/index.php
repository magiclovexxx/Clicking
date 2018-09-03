<form class="formSchedule" action="<?=cn('ajax_post_now')?>" data-action="<?=cn('ajax_save_schedules')?>">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-flag-o" aria-hidden="true"></i> <?=l("Auto invite friends to like pages")?> 
                    </h2>
                </div>
                <div class="body pt0">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 mt15">
                                    <b><?=l('Page ID')?></b>
                                    <div class="input-group mb0">
                                        <div class="form-line">
                                            <input type="text" name="group_id" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 mt15" style="display:none">
                                    <b><?=l('Delay (seconds)')?></b>
                                    <select class="form-control deplay_post_now">
                                        <?php for ($i = 5; $i <= 900; $i++) {
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
                                     <!--   <button type="button" class="btn bg-light-green waves-effect btnPostnow"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <?=l('Invite now')?></button> -->
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
<iframe width="100%" height="360" src="https://www.youtube.com/embed/MSyPpemnCpI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?=l('Select Friends')?>
                    </h2>
                </div>
                <div class="tab-content">
                    <div class="header">
                        <div class="form-inline form-manage-groups">
                            <div class="form-group wa">
                                <select class="form-control mr5 filter_account" name="account">
                                    <option value=""><?=l('All accounts')?></option>
                                    <?php if(!empty($result)){
                                    foreach ($result as $row) {
                                    ?>
                                    <option value="<?=$row->username?>"><?=$row->username?></option>
                                    <?php }}?>
                                </select>
                            </div>
                            <div class="form-group wa">
                                <select class="form-control mr5 categories">
                                    <option><?=l('All categories')?></option>
                                    <?php if(!empty($categories)){
                                    foreach ($categories as $row) {
                                    ?>
                                    <option value="<?=$row->id?>" <?=(session("category") == $row->id)?"selected":""?>><?=$row->name?></option>
                                    <?php }}?>
                                </select>
                            </div> 
                            <div class="form-group wa mr15">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn bg-blue-grey waves-effect btnAddCategory" data-type="message" data-toggle="tooltip" title="<?=l('Add new category')?>" data-action="<?=cn('ajax_add_category')?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    <button type="button" class="btn bg-blue-grey waves-effect btnUpdateCategory" data-type="post" data-toggle="tooltip" title="<?=l('Update category')?>" data-action="<?=cn('ajax_update_category')?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button type="button" class="btn bg-blue-grey waves-effect btnDeleteCategory" data-toggle="tooltip" title="<?=l('Remove category selected')?>"> <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body p0">
                        <table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">
                                        <input type="checkbox" id="md_checkbox_all" class="filled-in chk-col-red checkAll">
                                        <label class="p0 m0" for="md_checkbox_all">&nbsp;</label>
                                    </th>
                                    <th><?=l('Account')?></th>
                                    <th><?=l('Name')?></th>
                                    <th><?=l('Type')?></th>
                                    <th><?=l('Link')?></th>
                                    <th><?=l('Process')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($result)){
                                foreach ($result as $key => $row) {
                                ?>
                                    <?php if(!empty($row->groups)){
                                    foreach ($row->groups as $key => $group) {
                                    ?>
                                    <tr class="post-pending">
                                        <td>
                                            <input type="checkbox" name="id[]" id="md_checkbox_<?=$group->pid?>" class="filled-in chk-col-red checkItem" value="<?=$group->type."{-}".$row->id."{-}".$row->username."{-}".$group->pid."{-}".$group->name."{-}0"?>">
                                            <label class="p0 m0" for="md_checkbox_<?=$group->pid?>">&nbsp;</label>
                                        </td>
                                        <td><?=$row->username?></td>
                                        <td><?=$group->name?></td>
                                        <td><?=$group->type?></td>
                                        <td><a href="https://facebook.com/<?=$group->pid?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> <?=l('Visit page')?></a></td>
                                        <td class="status-post"></td>
                                    </tr>
                                    <?php }}?>
                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</form>