<form class="formSchedule" action="<?=cn('ajax_post_now')?>" data-action="<?=cn('ajax_save_schedules')?>">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card active">
                <div class="header">
                    <h2>
                        <i class="fa fa-user" aria-hidden="true"></i> <?=l("Post to friend's wall")?> 
                    </h2>
                </div>
                <div class="body pt0">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right tab-col-pink post_type post_tab_feature" role="tablist">
                                <li role="presentation" class="active" data-type="text"><a href="#home_animation_1" data-toggle="tab" aria-expanded="true"><i class="material-icons">view_headline</i> <?=l('TEXT')?></a></li>
                                <li role="presentation" class="" data-type="link"><a href="#profile_animation_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">link</i> <?=l('LINK')?></a></li>
                                <li role="presentation" class="" data-type="image"><a href="#messages_animation_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">camera_alt</i> <?=l('IMAGE')?></a></li>
                                <li role="presentation" class="" data-type="video"><a href="#settings_animation_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">videocam</i> <?=l('VIDEO')?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="row mt15">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                                    <label><?=l('Message')?></label>
                                    <div class="form-group">
                                        <div class="form-line p5">
                                            <textarea rows="4" class="form-control no-resize post-message" name="message" placeholder="<?=l('Write something...')?>"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home_animation_1">
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile_animation_1">
                                    <label><?=l('Link')?></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="link_url" class="form-control">
                                        </div>
                                    </div>
                                    <label><?=l('Picture')?></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="link_picture" class="form-control">
                                        </div>
                                        <span class="input-group-btn">
                                          <a class="btn bg-red waves-effect dialog-upload"><i class="fa fa-upload" aria-hidden="true"></i> <?=l('Upload')?></a>
                                        </span>
                                    </div>
                                    <label><?=l('Title')?></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="link_title" class="form-control">
                                        </div>
                                    </div>
                                    <label><?=l('Caption')?></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="link_caption" class="form-control">
                                        </div>
                                    </div>
                                    <label><?=l('Description')?></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" name="link_description" class="form-control no-resize"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages_animation_1">
                                    <label><?=l('Image')?></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="image_url" class="form-control">
                                        </div>
                                        <span class="input-group-btn">
                                          <a class="btn bg-red waves-effect dialog-upload"><i class="fa fa-upload" aria-hidden="true"></i> <?=l('Upload')?></a>
                                        </span>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="settings_animation_1">
                                    <label><?=l('Video URL')?></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="video_url" class="form-control">
                                        </div>
                                        <span class="input-group-btn">
                                          <a class="btn bg-red waves-effect dialog-upload"><i class="fa fa-upload" aria-hidden="true"></i> <?=l('Upload')?></a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
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
                                <div class="col-md-12 col-xs-12">
                                    <b><?=l('Advanced options')?></b>
                                    <div class="form-group wa" style="margin-top: 8px;">
                                        <input type="checkbox" id="md_checkbox_unique_content" name="unique_content" class="filled-in chk-col-deep-orange" value="1">
                                        <label class="mb0 mr15" for="md_checkbox_unique_content">Unique content</label>

                                        <input type="checkbox" id="md_checkbox_unique_link" name="unique_link" class="filled-in chk-col-deep-orange" value="1">
                                        <label class="mb0 mr15" for="md_checkbox_unique_link">Unique link</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb0">
                                    <button type="button" class="btn bg-grey waves-effect btnSavePost" data-type="friend"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?=l('Save post')?></button>
                                    <div class="btn-group right" role="group">
                                        <button type="button" class="btn bg-light-green waves-effect btnPostnow"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> <?=l('Post now')?></button>
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
                                                            <?php }} ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
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
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-repeat" aria-hidden="true"></i> <?=l('Repeat post')?></b>
                                                    <div class="input-group mb0">
                                                        <select name="auto_repeat" class="form-control">
                                                            <option value="0"><?=l('No')?></option>
                                                            <?php for ($i = 1; $i <= 365; $i++) {
                                                            ?>
                                                                <option value="<?=$i*86400?>"><?=$i." ".l('days')?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-calendar" aria-hidden="true"></i> <?=l('End day')?></b>
                                                    <div class="input-group mb0">
                                                        <div class="form-line">
                                                            <input type="text" name="repeat_end" class="form-control form-date">
                                                        </div>
                                                    </div>
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
                <div class="footer">
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
<iframe width="100%" height="360" src="https://www.youtube.com/embed/6h4Pkht9iM0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <div class="header">
                    <h2>
                        <i class="fa fa-desktop" aria-hidden="true"></i> <?=l('Preview')?> 
                    </h2>
                </div>
                <div class="body p0">
                    <div class="post-preview">
                        <div class="preview-header">
                            <img src="<?=BASE?>assets/images/avatar.png">
                            <div class="box-info">
                                <div class="title"><?=l('Anonymous')?></div>
                                <div class="desc"><?=l('Just now')?> <i class="fa fa-globe" aria-hidden="true"></i></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="preview-content">
                            <div class="data-message">
                                <div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>
                            </div>
                            <div class="preview-box preview-box-2 box-hide">
                                <div class="box-preview-link">
                                    <div class="bg-grey preview-box-image"></div>
                                    <div class="preview-footer-link">
                                        <div class="description-block">
                                            <h5 class="description-header preview-box-title"><div class="line-no-text"></div></h5>
                                            <span class="description-text preview-box-desc"><div class="line-no-text"></div><div class="line-no-text w50"></div></span>
                                            <span class="description-caption preview-box-caption"><div class="line-no-text w25"></div></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-box preview-box-3 box-hide">
                                <div class="box-preview-link">
                                    <div class="bg-grey preview-box-image"></div>
                                </div>
                            </div>
                            <div class="preview-box preview-box-4 box-hide">
                                <div class="box-preview-link">
                                    <div class="bg-grey preview-box-video">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($save)){?>
            <div class="card">
                <div class="body">
                    <select class="form-control mr5 getSavePost">
                        <option><?=l('Save list')?></option>
                        <?php foreach ($save as $row) {?>
                        <option value="<?=$row->id?>"><?=$row->name?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <?php }?>
        </div>

        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?=l('Select Friends')?>
                    </h2>
                </div>
                <div class="header">
                	<div class="form-inline form-manage-groups">
    	            	<div class="form-group wa">
    	            		<select class="form-control mr5 filter_account" name="account">
                                <option value=""><?=l('All accounts')?></option>
                                <?php if(!empty($result)){
                                foreach ($result as $row) {
                                ?>
                                <option value="<?=$row->username?>"><?=$row->fullname." (".$row->username.")"?></option>
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
</form>

<div class="modal fade" id="modal-update-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-grey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?=l('Select category')?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control mr5 category_id">
                        <option value="">----</option>
                        <?php if(!empty($categories)){
                        foreach ($categories as $row) {
                        ?>
                        <option value="<?=$row->id?>" <?=(session("category") == $row->id)?"selected":""?>><?=$row->name?></option>
                        <?php }}?>
                    </select>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-modal-update-category"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?=l('Update')?></button>
            </div>
        </div>
    </div>
</div>