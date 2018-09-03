<form class="formSchedule" action="<?=cn('ajax_post_now')?>" data-action="<?=cn('ajax_save_schedules')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?=l('List page')?>
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
                    </div>
                </div>
                <div class="body p0">
                	<table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0">
                        <thead>
                            <tr>
                                <th style="width: 10px;">
                                    <?=l('No.')?>
                                </th>
                                <th><?=l('Account')?></th>
                                <th><?=l('Name')?></th>
                                <th><?=l('Category')?></th>
                                <th><?=l('Type')?></th>
                                <th><?=l('Link')?></th>
                                <th style="width: 100px;"><?=l('Analytics')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($result)){
                            foreach ($result as $key => $row) {
                            ?>
                                <?php if(!empty($row->groups)){
                                foreach ($row->groups as $key => $group) {
                                ?>
                                <tr>
                                    <td>
                                        <?=$key+1?>
                                    </td>
                                    <td><?=$row->username?></td>
                                    <td><?=$group->name?></td>
                                    <td><?=$group->category?></td>
                                    <td><?=$group->type?></td>
                                    <td><a href="https://facebook.com/<?=$group->pid?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> <?=l('Visit page')?></a></td>
                                    <td>
                                        <a href="<?=url('analytics/page/'.$group->id)?>" class="btn bg-orange waves-effect"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
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