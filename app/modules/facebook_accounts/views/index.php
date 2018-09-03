<form class="ScheduleList" action="<?=cn('ajax_action_multiple')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-facebook-official" aria-hidden="true"></i> <?=l('Hướng dẫn thêm và update tài khoản facebook')?>
                    </h2>
                </div>
                <iframe width="100%" height="360" src="https://www.youtube.com/embed/KfHVFUbCpeQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-facebook-official" aria-hidden="true"></i> <?=l('Facebook accounts')?>
                    </h2>
                </div>
                <div class="header">
                	<div class="form-inline">
                        <div class="btn-group" role="group">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn bg-red waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?=l('Action')?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btnActionModule" data-action="active" href="javascript:void(0);"><?=l('Active')?></a></li>
                                    <li><a class="btnActionModule" data-action="disable" href="javascript:void(0);"><?=l('Deactive')?></a></li>
                                    <li><a class="btnActionModule" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this items?')?>" href="javascript:void(0);"><?=l('Delete')?></a></li>
                                </ul>
                            </div>
                            <a href="<?=url('facebook_accounts/update')?>" class="btn bg-light-green waves-effect"><i class="fa fa-plus" aria-hidden="true"></i> Thêm tài khoản facebook</a>
                        </div>
                    </div>
                </div>
                <div class="body p0">
                    <table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0">
                        <thead>
                            <tr>
                                <th style="width: 10px;">
                                    <input type="checkbox" id="md_checkbox_211" class="filled-in chk-col-red checkAll">
                                    <label class="p0 m0" for="md_checkbox_211">&nbsp;</label>
                                </th>
                                <?php if(IS_ADMIN == 1){?>
                                <th><?=l('User')?></th>
                                <?php }?>
                                <th><?=l('Facebook ID')?></th>
                                <th><?=l('Fullname')?></th>
                                <th><?=l('Username')?></th> 
                                <th><?=l('Token')?></th>
                                <th class="text-center"><?=l('Update Groups')?></th>
                                <th class="text-center"><?=l('Update Pages')?></th>
                                <th class="text-center"><?=l('Update Friends')?></th>
                                <th><?=l('Status')?></th>
                                <th><?=l('Option')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($result)){
                            foreach ($result as $key => $row) {
                            ?>
                            <tr class="pending" data-action="<?=cn('ajax_action_item')?>" data-action-groups="<?=cn('ajax_get_groups')?>" data-id="<?=$row->id?>">
                                <td>
                                    <input type="checkbox" name="id[]" id="md_checkbox_<?=$key?>" class="filled-in chk-col-red checkItem" value="<?=$row->id?>">
                                    <label class="p0 m0" for="md_checkbox_<?=$key?>">&nbsp;</label>
                                </td>
                                <?php if(IS_ADMIN == 1){?>
                                <td><a href="<?=url('user_management/update?id='.$row->uid)?>"><?=$row->user?></a></td>
                                <?php }?>
                                <td><a href="https://facebook.com/<?=$row->fid?>" target="_blank"><?=$row->fid?></a></td>
                                <td><?=$row->fullname?></td>
                                <td><?=$row->username?></td>
                                <?php $get_postid = file_get_contents_curl("https://graph.facebook.com/me?access_token=".$row->access_token);
                                    ?>
                                <?php if(empty($get_postid->id)){ ?> 
                                <td class = "bg-red">  <?php echo "Token Die"; } else { ?>
                                <td class = "bg-light-green"> <?php echo "Ok";} ?> </td>
                                <td class="text-center"><button type="button" class="btn bg-blue waves-effect btnUpdateGroups" data-type="group"><?=l('Update Groups')?></button></td>
                                <td class="text-center"><button type="button" class="btn bg-blue waves-effect btnUpdateGroups" data-type="page"><?=l('Update Pages')?></button></td>
                                <td class="text-center"><button type="button" class="btn bg-blue waves-effect btnUpdateGroups" data-type="friend"><?=l('Update Friends')?></button></td>
                                <td style="width: 60px;">
                                    <div class="switch">
                                        <label><input type="checkbox" class="btnActionModuleItem" <?=$row->status==1?"checked":""?>><span class="lever switch-col-light-blue"></span></label>
                                    </div>
                                </td>
                                <td style="width: 80px;">
                                    <div class="btn-group" role="group">
                                        <a href="<?=url('facebook_accounts/update?id='.$row->id)?>" class="btn bg-light-green waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <button type="button" class="btn bg-light-green waves-effect btnActionModuleItem" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this item?')?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </div>
</form>