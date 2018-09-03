<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-user" aria-hidden="true"></i> <?=l('Update user')?> 
                </h2>
            </div>
            <div class="body pt0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                 <!--   <li role="presentation" class="active"><a href="#home" data-toggle="tab" aria-expanded="true"><?=l('Profile')?></a></li> -->
                    <li role="presentation" class="active><a href="#profile" data-toggle="tab"><?=l('Package')?></a></li>
                </ul>

                    <!-- Tab panes -->
                <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                    <div class="tab-content pt15">
                        <div role="tabpanel" class="tab-pane fade active in" id="profile">
                            <b><?=l('Select Package')?></b>
                            <div class="form-group">
                                <select name="package-id" class="package_change form-control">
                                    <option value="0"><?=l('--- Select package ---')?></option>
                                    <?php if(!empty($package)){
                                        foreach ($package as $row) {
                                    ?>
                                        <option value='<?=$row->permission?>|<?=$row->id?>'><?=$row->name?></option>
                                    <?php }}?>
                                </select>
                            </div>
                            <b><?=l('Maximum facebook accounts')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_account" value="<?=!empty($result)?(int)$result->maximum_account:""?>">
                                </div>
                            </div>
                            <b><?=l('Maximum groups')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_groups" value="<?=!empty($result)?(int)$result->maximum_groups:""?>">
                                </div>
                            </div>
                            <b><?=l('Maximum pages')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_pages" value="<?=!empty($result)?(int)$result->maximum_pages:""?>">
                                </div>
                            </div>
                            <b><?=l('Maximum friends')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_friends" value="<?=!empty($result)?(int)$result->maximum_friends:""?>">
                                </div>
                            </div>
                            <b><?=l('Expiration date')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-date" name="expiration_date" value="<?=!empty($result)?$result->expiration_date:""?>">
                                </div>
                            </div>
                            <b><?=l('Thanh toán')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="paided">
                                </div>
                            </div>
                            <b><?=l('Commission')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="commission">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-red waves-effect btnActionUpdate"><?=l('Submit')?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(".package_change").change(function(){
            _value = $(this).val();
            _value = _value.split("|");
            _permission = JSON.parse(_value[0]);
            $("[name='maximum_account']").val(_permission.maximum_account);
            $("[name='maximum_groups']").val(_permission.maximum_groups);
            $("[name='maximum_pages']").val(_permission.maximum_pages);
            $("[name='maximum_friends']").val(_permission.maximum_friends);
        });
    });
</script>