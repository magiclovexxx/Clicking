    <div class="row">
        <form class="formSchedule" action="<?=cn('ajax_update')?>" data-redirect="<?=cn("replace")?>">
            <input type="hidden" class="form-control" name="id" value="<?=get("id")?>">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <i class="fa fa-plus" aria-hidden="true"></i> <?=l("Add new")?> 
                        </h2>
                    </div>
                    <div class="body pt0">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12 mt15 mb0">
                                        <b><?=l('Find text')?></b>
                                        <div class="input-group mb0">
                                            <textarea name="find" class="form-control" rows="5" style="padding-left: 10px; padding-right: 10px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mt15 mb0">
                                        <b><?=l('Replace with')?></b>
                                        <div class="input-group mb0">
                                            <textarea name="replace" class="form-control" rows="5" style="padding-left: 10px; padding-right: 10px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn bg-red waves-effect btnActionUpdate"><?=l('Update')?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form class="formSchedule" action="<?=cn('ajax_action_multiple')?>">
                <div class="card">
                    <div class="header">
                        <h2>
                            <i class="fa fa-bars" aria-hidden="true"></i> <?=l('List Replace')?>
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
                            </div>
                        </div> 
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
                                        <th><?=l('Find')?></th>
                                        <th><?=l('Replace')?></th>
                                        <th><?=l('Option')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($result)){
                                    foreach ($result as $key => $row) {
                                    ?>
                                    <tr class="pending" data-action="<?=cn('ajax_action_item')?>" data-id="<?=$row->id?>">
                                        <td>
                                            <input type="checkbox" name="id[]" id="md_checkbox_<?=$key?>" class="filled-in chk-col-red checkItem" value="<?=$row->id?>">
                                            <label class="p0 m0" for="md_checkbox_<?=$key?>">&nbsp;</label>
                                        </td>
                                        <td><?=$row->finds?></td>
                                        <td><?=$row->replaces?></td>
                                        <td style="width: 80px;">
                                            <div class="btn-group" role="group">
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
            </form>
        </div> 
    </div>
</form>