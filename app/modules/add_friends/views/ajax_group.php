<table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0">
    <thead>
        <tr>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Privacy')?></th>
            <th><?=l('Member')?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($result)){
        foreach ($result as $key => $row) {
            $row = (object)$row;
        ?>
        <tr class="post-pending">
            <td><?=$row->id?></td>
            <td><img src="<?=$row->icon?>"> <a href="https://facebook.com/<?=$row->id?>" target="_blank"><?=$row->name?></a></td>
            <td><?=$row->privacy?></td>
            <td>
                <button type="button" class="btn bg-red btn-block btn-sm waves-effect getMembersOnGroup" data-id="<?=$row->id?>" data-action="<?=cn('ajax_search_member')?>"><?=l('Get members')?></button>
            </td>
        </tr>
        <?php }}?>
    </tbody>
</table>
<script type="text/javascript">
    $(function(){
        Page.ExportTable(".js-dataTable");
    });
</script>