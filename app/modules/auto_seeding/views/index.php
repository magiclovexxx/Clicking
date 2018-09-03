<form class="formSchedule" action="<?=cn('ajax_post_now')?>" data-action="<?=cn('ajax_save_schedules')?>">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-comments-o" aria-hidden="true"></i> <?=l("Tự động seeding bài viết")?> 
                    </h2>
                </div>
                <div class="body pt0">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 mt15">
                                    <b><?=l('ID bài viết')?></b>
                                    <div class="input-group mb0">
                                        <div class="form-line">
                                            <input type="text" name="group_id" class="form-control">
                                        </div>
                                    </div>
                                    <a href="https://kienthuc.t-q-t.com/lay-id-bai-post-facebook/" target="_blank" title="Lay ID bai viet" rel="follow, index"><?=l('How to get id post')?></a>
                                </div>
                               <!-- <div class="col-md-12 col-xs-12 mt15">
                                    <b><?=l('Số lượng seeding')?></b>
                                    <div class="input-group mb0">
                                        <div class="form-line">
                                            <input type="text" name="number_comment" class="form-control">
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                            <label><?=l('Comment')?></label>
                            <div class="form-group">
                                <div class="form-line p5">
                                    <textarea rows="4" name="message" class="form-control no-resize post-message" placeholder="<?=l('Viet noi dung ban muon seeding, xuong dong de them noi dung khac')?>"></textarea>
                                </div>
                            </div>

                            <div class="row box-post-schedule" style="display:block;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb0">
                                    <div class="custom-card">
                                        <div class="body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-clock-o" aria-hidden="true"></i> <?=l('Time start')?></b>
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
                                                                <option value="<?=$i*60?>" <?=(DEFAULT_DEPLAY == $i)?"selected":""?>><?=$i." ".l('minutes')?></option>
                                                            <?php }} ?>                                  
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        <!--    <div class="row">
                                                <div class="col-md-6">
                                                    <b><i class="fa fa-repeat" aria-hidden="true"></i> <?=l('Repeat post')?></b>
                                                    <div class="input-group mb0">
                                                        <select name="auto_repeat" class="form-control">
                                                            <option value="0"><?=l('No')?></option>
                                                            <?php for ($i = 1; $i <= 60; $i++) {
                                                            ?>
                                                                <option value="<?=$i*60?>"><?=$i." ".l('minutes')?></option>
                                                            <?php } ?>
                                                            <?php for ($i = 1; $i <= 23; $i++) {
                                                            ?>
                                                                <option value="<?=$i*60*60?>"><?=$i." ".l('hours')?></option>
                                                            <?php } ?>
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
                                            </div> -->
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
            </div>

        </div>
        
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-desktop" aria-hidden="true"></i> <?=l('Huong dan su dung')?> 
                    </h2>   
                </div>
<iframe width="100%" height="360" src="https://www.youtube.com/embed/KF3CafPDUAI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>

        
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="card">
               <div class="header" style="padding-top: 25px;">
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?=l('Select Facebook Accounts')?>
                    </h2>
                </div>
                <div class="tab-content">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($result)){
                                foreach ($result as $key => $row) {
                                ?>
                                    <tr class="post-pending">
                                        <td>
                                            <input type="checkbox" name="id[]" id="md_checkbox_<?=$row->fid?>" class="filled-in chk-col-red checkItem" value="<?="profile{-}".$row->id."{-}".$row->username."{-}".$row->fid."{-}".$row->fullname."{-}0"?>">
                                            <label class="p0 m0" for="md_checkbox_<?=$row->fid?>">&nbsp;</label>
                                        </td>
                                        <td><?=$row->username?></td>
                                        <td><?=$row->fullname?></td>
                                        <td>profile</td>
                                        <td><a href="https://facebook.com/<?=$row->fid?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> <?=l('Visit page')?></a></td>
                                    </tr>
                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>-->
        </div> 
    </div>
</form>