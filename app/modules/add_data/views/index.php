<form class="formSchedule" action="<?=cn('ajax_post_now')?>" data-action="<?=cn('ajax_save_schedules')?>">
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <div class="card">
                <div class="body pt0">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right tab-col-pink post_type post_tab_feature" role="tablist">
                                <li role="presentation" class="active" data-type="text"><a href="#home_animation_1" data-toggle="tab" aria-expanded="true"><i class="material-icons">view_headline</i> <?=l('TEXT')?></a></li>
                                <li role="presentation" class="" data-type="link"><a href="#profile_animation_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">link</i> <?=l('LINK')?></a></li>
                                <li role="presentation" class="" data-type="image"><a href="#messages_animation_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">camera_alt</i> <?=l('IMAGE')?></a></li>
                                <li role="presentation" class="" data-type="video"><a href="#settings_animation_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">videocam</i> <?=l('VIDEO')?></a></li>
				<li role="presentation" class="" data-type="images"><a href="#images_animation_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">perm_media</i> <?=l('MULTI IMAGE')?></a></li>
                                <li role="presentation" class="" data-type="cat_data"><a href="#add_category_data_1" data-toggle="tab" aria-expanded="false"><i class="material-icons">link</i> <?=l('CATEGORYS')?></a></li>
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
                                <div class="card">
                                    <div class="body">
                                        <b>Add data category</b>
                                    <select class="form-control mr5 input" id="getcatdata">
                                        <?php foreach ($category_data as $row) {?>
                                        <option value="<?=$row->id?>"><?=$row->name?></option>
                                        <?php }?>
                                    </select>
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
                                <div role="tabpanel" class="tab-pane" id="add_category_data_1">
                                    <label><?=l('Categorys')?></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="cat_data" class="form-control">
                                        </div>
                                        <span class="input-group-btn">
                                          <a class="btn bg-red btnaddcat"><i class="fa fa-plus" aria-hidden="true" type="submit"></i> <?=l('Add')?></a>
                                        </span>
                                    </div>
                                </div>
				<div role="tabpanel" class="tab-pane" id="images_animation_1">
                                    <label><?=l('Images')?></label> <span class="col-grey"><?=l('(add at least two and maximum three images)')?></span>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="images_url" class="form-control remote-image" placeholder="<?=l('Enter image url and then click add image')?>">
                                        </div>
                                        <span class="input-group-btn">
                                          <a class="btn bg-black waves-effect btn-add-image"><i class="fa fa-plus-square" aria-hidden="true"></i> <?=l('Add image')?></a>
                                          <a class="btn bg-red waves-effect dialog-uploads"><i class="fa fa-upload" aria-hidden="true"></i> <?=l('Upload')?></a>
                                        </span>
                                    </div>
                                    <div class="list-images"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb0">
                                    <button type="button" class="btn bg-grey waves-effect btnaddPost" data-type="post"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?=l('Lưu bài')?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="card">
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
                            <div class="preview-box preview-box-5 box-hide">
                                <div class="box-preview-link">
                                    <img src="<?=BASE?>assets/images/preview5.png" style="width: 100%;">
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

    </div>
</form>

<div class="row"> 
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header"> 
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?php echo('Bài đã lưu  - Tổng Số bài: '); echo(count($save)); echo(' - Số bài hôm nay: '); echo(count($save_day));?>
                    </h2>
                </div>
    <div class="body p0">
                        <table id = "xxxx" class="table table-bordered table-striped table-hover js-dataTableSchedule3 dataTable mb0">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">
                                            <input type="checkbox" id="md_checkbox_all" class="filled-in chk-col-red checkAll">
                                            <label class="p0 m0" for="md_checkbox_all">&nbsp;</label>
                                        </th>
                                        <th><?=l('Category')?></th>
                                        <th><?=l('title')?></th>
                                        <th><?=l('Message')?></th>
                                        <th><?=l('name')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                   <?php if(!empty($save)){
                                    for  ($i = 0; $i<20;  $i++ ) {
                                        $row = $save[$i];
                                    ?> 
                                        <tr class="post-pending" data-action="<?=cn('ajax_action_item')?>" data-id="<?=$row->id?>">
                                            <td>
                                                <input type="checkbox" name="id[]" id="md_checkbox_<?=$row->id?>" class="filled-in chk-col-red checkItem" value="<?=$row->id?>">
                                                <label class="p0 m0" for="md_checkbox_<?=$row->id?>">&nbsp;</label>
                                            </td>
                                            <td><?=$row->cat_data?></td> 
                                            <td><?=$row->name?></td>
                                            <td><?=$row->message?></td>
                                            <td><?=$row->title?></td>
                                            <td style="width: 80px;">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn bg-light-green waves-effect btnActionModuleItemcontent" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this item?')?>"><i class="fa fa-trash" aria-hidden="true"></i></button
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
</div>