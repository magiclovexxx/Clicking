<table class="table table-bordered table-striped table-hover js-ExportTable dataTable mb0">
    <thead>
        <tr>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Description')?></th>
            <th><?=l('Email')?></th>
            <th><?=l('Privacy')?></th>
            <th><?=l('Member')?></th>
        </tr>
    </thead>
    <tbody> 
        <?php if(!empty($result)){
        foreach ($result as $key => $row) {
            $row = (object)$row;
        ?>
        <tr>
            <td><?=$row->id?></td>
            <td><img src="<?=$row->icon?>"> <a href="https://facebook.com/<?=$row->id?>" target="_blank"><?=$row->name?></a></td>
            <td><?=isset($row->description)?CutText($row->description):""?></td>
            <td><?=$row->email?></td>
            <td><?=$row->privacy?></td>
            <td><a href="javascript:void(0);" class="getMembersOnGroup" data-id="<?=$row->id?>" data-action="<?=cn('ajax_search')?>"><?=l('Member')?></a></td>
        </tr>
        <?php }}?>
    </tbody>
</table>
<script type="text/javascript">
    $(function(){
        Page.ExportTable(".js-ExportTable");
    });
</script> 