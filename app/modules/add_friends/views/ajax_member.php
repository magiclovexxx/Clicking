<table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0">
    <thead>
        <tr>
            <th style="width: 10px;">
                <input type="checkbox" id="md_checkbox_all" class="filled-in chk-col-red checkAll">
                <label class="p0 m0" for="md_checkbox_all">&nbsp;</label>
            </th>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Process')?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($result)){
        foreach ($result as $key => $row) {
            $row = (object)$row;
        ?>
        <tr class="post-pending">
            <td>
                <input type="checkbox" name="id[]" id="md_checkbox_<?=$row->id?>" class="filled-in chk-col-red checkItem" value="<?="add{-}".$row->id."{-}".$row->name."{-}0"?>">
                <label class="p0 m0" for="md_checkbox_<?=$row->id?>">&nbsp;</label>
            </td>
            <td><?=$row->id?></td>
            <td><img src="http://graph.facebook.com/<?=$row->id?>/picture?type=square"> <a href="https://facebook.com/<?=$row->id?>" target="_blank"><?=$row->name?></a></td>
            <td class="status-post"></td>
        </tr>
        <?php }}?>
    </tbody>
</table>
<script type="text/javascript">
    $(function(){
        Page.ExportTable(".js-dataTable");
    });
</script>