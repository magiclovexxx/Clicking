<table class="table table-bordered table-striped table-hover js-ExportTable dataTable mb0">
    <thead>
        <tr>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Attending')?></th>
            <th><?=l('No Reply')?></th>
            <th><?=l('Maybe')?></th>
            <th><?=l('Interested')?></th>
            <th><?=l('Declined')?></th>
            <th><?=l('Palce')?></th>
            <th><?=l('Category')?></th>
            <th><?=l('Start time')?></th>
            <th><?=l('End time')?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($result)){
        foreach ($result as $key => $row) {
            $row = (object)$row;
        ?>
        <tr>
            <td><?=$row->id?></td>
            <td><a href="https://facebook.com/<?=$row->id?>" target="_blank"><?=$row->name?></a></td>
            <td><?=$row->attending_count?></td>
            <td><?=$row->noreply_count?></td>
            <td><?=$row->maybe_count?></td>
            <td><?=$row->interested_count?></td>
            <td><?=$row->declined_count?></td>
            <td>
                <?=isset($row->place)?$row->place->name:""?>
                <?php if(isset($row->place) && isset($row->place->location)){?>
                <a class="map-event col-red" data-lat="<?=$row->place->location->latitude?>" data-lng="<?=$row->place->location->longitude?>" data-lat="<?=$row->place->location->latitude?>" data-title="<?=isset($row->place)?$row->place->name:l('Map')?>" href="javascript:void(0);"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                <?php }?>
            </td>
            <td><?=isset($row->category)?$row->category:""?></td>
            <td><?=date("H:i d/m/Y", strtotime($row->start_time))?></td>
            <td><?=isset($row->end_time)?date("H:i d/m/Y", strtotime($row->end_time)):""?></td>
        </tr>
        <?php }}?>
    </tbody>
</table>

<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer bg-red">
                <button type="button" class="btn btn-link waves-effect col-white" data-dismiss="modal"><?=l('CLOSE')?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Page.ExportTable(".js-ExportTable");
    });
</script>