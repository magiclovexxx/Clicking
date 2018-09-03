<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-server" aria-hidden="true"></i> <?=l('Update package')?> 
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                            <b><?=l('Package name')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" value="<?=!empty($result)?$result->name:""?>">
                                </div>
                            </div>
                            <?php if((!empty($result) && $result->type==2) || empty($result)){?>
                                <b><?=l('Package price')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="price" value="<?=!empty($result)?$result->price:""?>">
                                    </div>
                                </div>
                                <b><?=l('Package day')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="day" value="<?=!empty($result)?$result->day:""?>">
                                    </div>
                                </div>
                                <b><?=l('Package order')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="orders" value="<?=!empty($result)?$result->orders:"0"?>">
                                    </div>
                                </div>
                                <b><?=l('Package default')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group demo-radio-button mb0">
                                    <input name="default" type="radio" id="default_yes" class="radio-col-red" <?=(!empty($result) && $result->default_package == 1)?"checked=''":""?> value="1">
                                    <label for="default_yes"><?=l('Yes')?></label>

                                    <input name="default" type="radio" id="default_no" class="radio-col-red" <?=(!empty($result) && $result->default_package == 0)?"checked=''":""?> value="0">
                                    <label for="default_no"><?=l('No')?></label>
                                </div>
                            <?php }else{?>
                                <b><?=l('Package price')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <select name="type" class="form-control package-type">
                                        <option value="0" <?=(!empty($result) && $result->type==0)?"selected":""?>><?=l('Free')?></option>
                                        <option value="1" <?=(!empty($result) && $result->type==1)?"selected":""?>><?=l('Trial')?></option>
                                    </select>
                                </div>
                                <div class="package-day" style="<?=(!empty($result) && $result->type==0)?"display: none;":""?>">
                                    <b><?=l('Package day')?> (<span class="col-red">*</span>)</b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="day" value="<?=!empty($result)?$result->day:""?>">
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <?php 
                                $modules = array();
                                if(!empty($result)){
                                    $modules = json_decode($result->permission);
                                }
                            ?>
                            <b><?=l('Maximum Facebook account on user')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_account" value="<?=!empty($modules)?$modules->maximum_account:""?>">
                                </div>
                            </div>
                            <b><?=l('Maximum groups')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_groups" value="<?=!empty($modules)?$modules->maximum_groups:""?>">
                                </div>
                            </div>
                            <b><?=l('Maximum pages')?>  (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_pages" value="<?=!empty($modules)?$modules->maximum_pages:""?>">
                                </div>
                            </div>
                            <b><?=l('Maximum friends')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_friends" value="<?=!empty($modules)?$modules->maximum_friends:""?>">
                                </div>
                            </div>
                            <b><?=l('List modules')?></b>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <input type="checkbox" name="agency_lv1" id="md_checkbox_17" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && $modules->agency_lv1 == 1)?"checked":""?>>
                                    <label for="md_checkbox_17" class="mb0"><?=l('Agency LV1')?></label>
                                </li>
                               <li class="list-group-item">
                                    <input type="checkbox" name="add_data" id="md_checkbox_20" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && $modules->add_data == 1)?"checked":""?>>
                                    <label for="md_checkbox_20" class="mb0"><?=l('Add data')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="loctuongtac" id="md_checkbox_21" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && $modules->loctuongtac == 1)?"checked":""?>>
                                    <label for="md_checkbox_21" class="mb0"><?=l('Lọc bạn bè')?></label>
                                </li>                                
                                <li class="list-group-item">
                                    <input type="checkbox" name="content" id="md_checkbox_19" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && $modules->content == 1)?"checked":""?>>
                                    <label for="md_checkbox_19" class="mb0"><?=l('Content hot trend')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="auto_all" id="md_checkbox_16" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && $modules->auto_all == 1)?"checked":""?>>
                                    <label for="md_checkbox_16" class="mb0"><?=l('Auto all')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="auto_seeding" id="md_checkbox_18" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && $modules->auto_seeding == 1)?"checked":""?>>
                                    <label for="md_checkbox_18" class="mb0"><?=l('Auto seeding')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="post" id="md_checkbox_1" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && $modules->post == 1)?"checked":""?>>
                                    <label for="md_checkbox_1" class="mb0"><?=l('Auto post')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="post_wall_friends" id="md_checkbox_2" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->post_wall_friends) && $modules->post_wall_friends == 1)?"checked":""?>>
                                    <label for="md_checkbox_2" class="mb0"><?=l("Auto post to friend's wall")?></label>
                                </li>
				        <li class="list-group-item">
                                    <input type="checkbox" name="bulk_comment" id="md_checkbox_143" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->bulk_comment) && $modules->bulk_comment == 1)?"checked":""?>>
                                    <label for="md_checkbox_143" class="mb0"><?=l('Bulk comment a post')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="bulk_like" id="md_checkbox_145" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->bulk_like) && $modules->bulk_like == 1)?"checked":""?>>
                                    <label for="md_checkbox_145" class="mb0"><?=l('Bulk like a post')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="repost_pages" id="md_checkbox_14" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->repost_pages) && $modules->repost_pages == 1)?"checked":""?>>
                                    <label for="md_checkbox_14" class="mb0"><?=l('Auto repost pages')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="join_groups" id="md_checkbox_4" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->join_groups) && $modules->join_groups == 1)?"checked":""?>>
                                    <label for="md_checkbox_4" class="mb0"><?=l('Auto join groups')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="add_friends" id="md_checkbox_9" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->add_friends) && $modules->add_friends == 1)?"checked":""?>>
                                    <label for="md_checkbox_9" class="mb0"><?=l('Auto add friends')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="unfriends" id="md_checkbox_10" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->unfriends) && $modules->unfriends == 1)?"checked":""?>>
                                    <label for="md_checkbox_10" class="mb0"><?=l('Auto unfriends')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="invite_to_groups" id="md_checkbox_11" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->invite_to_groups) && $modules->invite_to_groups == 1)?"checked":""?>>
                                    <label for="md_checkbox_11" class="mb0"><?=l('Auto invite to groups')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="invite_to_pages" id="md_checkbox_12" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->invite_to_pages) && $modules->invite_to_pages == 1)?"checked":""?>>
                                    <label for="md_checkbox_12" class="mb0"><?=l('Auto invite to pages')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="accept_friend_request" id="md_checkbox_13" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->accept_friend_request) && $modules->accept_friend_request == 1)?"checked":""?>>
                                    <label for="md_checkbox_13" class="mb0"><?=l('Auto accept friend request')?></label>
                                </li>
                                
                                <li class="list-group-item">
                                    <input type="checkbox" name="comment" id="md_checkbox_5" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->comment) && $modules->comment == 1)?"checked":""?>>
                                    <label for="md_checkbox_5" class="mb0"><?=l('Auto comment')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="like" id="md_checkbox_6" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->like) && $modules->like == 1)?"checked":""?>>
                                    <label for="md_checkbox_6" class="mb0"><?=l('Auto like')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="search" id="md_checkbox_7" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset( $modules->search) && $modules->search == 1)?"checked":""?>>
                                    <label for="md_checkbox_7" class="mb0"><?=l('Facebook search')?></label>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" name="analytics" id="md_checkbox_8" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->analytics) && $modules->analytics == 1)?"checked":""?>>
                                    <label for="md_checkbox_8" class="mb0"><?=l('Analytics page')?></label>
                                </li>
                            </ul>
                            <button type="submit" class="btn bg-red waves-effect btnActionUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(document).on("change", ".package-type", function(){
            value = $(this).val();
            if(value == 0){
                $(".package-day").hide();
            }else{
                $(".package-day").show();
            }
        });
    });
</script>