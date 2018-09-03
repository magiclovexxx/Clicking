<table class="table table-bordered table-striped table-hover js-ExportTable dataTable mb0">
    <thead>
        <tr>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Address')?></th>
            <th><?=l('Phone')?></th>
            <th><?=l('Email')?></th>
            <th><?=l('Website')?></th>
            <th><?=l('Likes')?></th>
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
            <td><?=isset($row->single_line_address)?$row->single_line_address:""?></td>
            <td><?=isset($row->phone)?$row->phone:""?></td>
            <td><?=isset($row->emails)?implode(" , ", $row->emails):""?></td>
            <td><?=isset($row->website)?$row->website:""?></td>
            <td><?=format_number($row->fan_count)?></td>
        </tr>
        <?php }}?>
    </tbody>
</table>

<script type="text/javascript">
    $(function(){
        Page.ExportTable(".js-ExportTable");
    });
</script>