<table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0">
    <thead>
        <tr>
            <th style="width: 10px;">
                <input type="checkbox" id="md_checkbox_all" class="filled-in chk-col-red checkAll">
                <label class="p0 m0" for="md_checkbox_all">&nbsp;</label>
            </th>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Privacy')?></th>
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
                <input type="checkbox" name="id[]" id="md_checkbox_<?=$row->id?>" class="filled-in chk-col-red checkItem" value="<?="join{-}".$row->id."{-}".$row->name."{-}0"?>">
                <label class="p0 m0" for="md_checkbox_<?=$row->id?>">&nbsp;</label>
            </td>
            <td><?=$row->id?></td>
            <td><img src="<?=$row->icon?>"> <a href="https://facebook.com/<?=$row->id?>" target="_blank"><?=$row->name?></a></td>
            <td><?=$row->privacy?></td>
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