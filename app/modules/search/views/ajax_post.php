<table class="table table-bordered table-striped table-hover js-ExportTable dataTable mb0">
    <thead>
        <tr>
            <th><?=l('ID')?></th>
            <th><?=l('Shares')?></th>
            <th><?=l('Likes')?></th>
            <th><?=l('Message')?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($result)){
        foreach ($result as $key => $row) {
            $row = (object)$row;
        ?>
        <tr>
            <td><a href="https://facebook.com/<?=$row->id?>" target="_blank">Xem ngay</a></td>
            <td><?=isset($row->shares->count)?$row->shares->count:""?></td>
            <td><?=isset($row->likes->count)?$row->likes->count:""?></td>
            <td><?=isset($row->message)?$row->message:""?></td>
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