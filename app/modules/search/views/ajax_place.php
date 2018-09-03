<table class="table table-bordered table-striped table-hover js-ExportTable dataTable mb0">
    <thead>
        <tr>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Street')?></th>
            <th><?=l('City')?></th>
            <th><?=l('State')?></th>
            <th><?=l('Country')?></th>
            <th><?=l('Zip')?></th>
            <th><?=l('Map')?></th>
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
            <td><?=isset($row->location->street)?$row->location->street:""?></td>
            <td><?=isset($row->location->city)?$row->location->city:""?></td>
            <td><?=isset($row->location->state)?$row->location->state:""?></td>
            <td><?=isset($row->location->country)?$row->location->country:""?></td>
            <td><?=isset($row->location->zip)?$row->location->zip:""?></td>
            <td>
                <a class="map-event col-red" data-lat="<?=$row->location->latitude?>" data-lng="<?=$row->location->longitude?>" data-lat="<?=$row->location->latitude?>" data-title="<?=$row->name?>" href="javascript:void(0);"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
            </td>
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