<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-user" aria-hidden="true"></i> <?=l('add customer')?> 
                </h2>
            </div>
            <div class="body pt0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#home" data-toggle="tab" aria-expanded="true"><?=l('ID customer')?></a></li>
                    <!-- <li role="presentation"><a href="#profile" data-toggle="tab"><?=l('Package')?></a></li> -->
                </ul>

                    <!-- Tab panes -->
                <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                    <div class="tab-content pt15">
                        <div role="tabpanel" class="tab-pane fade active in" id="home">
                            <div class="row">
                                <div class="col-sm-12 mb0">
                                    <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->fid:""?>">
                                <!--     <b><?=l('Is Admin')?></b>
                                   <div class="form-group">
                                        <select name="admin" class="form-control">
                                            <option value="0" <?=(!empty($result) && $result->admin == 0)?"selected=''":""?>><?=l('No')?></option>
                                            <option value="1" <?=(!empty($result) && $result->admin == 1)?"selected=''":""?>><?=l('Yes')?></option>
                                        </select>
                                    </div> -->
                                    <b><?=l('ID facebook');?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="id_facebook" value="<?=!empty($result)?$result[0]->fid:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('Email')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="email" value="<?=!empty($result)?$result[0]->username:""?>">
                                        </div>
                                    </div>
                                
                            <b><?=l('Expiration date')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-date" name="expiration_date" value="<?=!empty($result)?$result->expiration_date:""?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-red waves-effect btnActionUpdate"><?=l('Add')?></button>
                </form>
            </div>
        </div>
    </div>
</div>
