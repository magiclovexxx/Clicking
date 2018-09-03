<form class="formSchedule" action="<?=cn('ajax_post_now')?>" data-action="<?=cn('ajax_save_schedules')?>">
    <div class="row">
        <div class="clearfix"></div>
        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-desktop" aria-hidden="true"></i> <?=l('Huong dan su dung')?> 
                    </h2>   
                </div>
<iframe width="640" height="360" src="https://www.youtube.com/embed/onfu9qTrg_o" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?=l('Content hot trend')?>
                    </h2>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="message_1">
                                                <div class="header">
                            <div class="form-inline form-manage-groups">
                                <div class="form-group wa">
                                    <select class="form-control mr5 filter_account" name="account">
                                       <!-- <option value=""><?=l('All category')?></option> -->
                                        <?php if(!empty($category_data)){
                                        foreach ($category_data as $row) {
                                        ?>
                                        <option value="<?=$row->name?>"><?=$row->name?></option>
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
                            <table class="table table-bordered table-striped table-hover js-dataTableSchedule dataTable mb0">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">
                                            <input type="checkbox" id="md_checkbox_all" class="filled-in chk-col-red checkAll">
                                            <label class="p0 m0" for="md_checkbox_all">&nbsp;</label>
                                        </th>
                                        <th><?=l('Category')?></th>
                                        <th><?=l('Link content')?></th>
                                        <th><?=l('Shares')?></th>
                                        <th><?=l('Likes')?></th>
                                        <th><?=l('Status')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php if(!empty($result)){
                                    for ($i=0; $i<3000;$i++) {
                                        $row = $result[$i];
                                    ?>
                                        <tr class="post-pending">
                                             <td>
                                                <input type="checkbox" name="id[]" id="md_checkbox_<?=$row->id?>" class="filled-in chk-col-red checkItem" value="<?$row->id?>">
                                                <label class="p0 m0" for="md_checkbox_<?=$row->id?>">&nbsp;</label>
                                            </td>
                                            <td><?=$row->cat_data?></td> 
                                            <td> <?php if(!empty($row->description)){ ?> <a href="https://facebook.com/<?=$row->description?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> <?=l('View Content')?></a>  <?php } ?></td>
                                            <td><?=(int)$row->caption?></td>
                                            <td><?=(int)$row->title?></td>
                                            <td><?=$row->message?></td>
                                        </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</form>
