<form class="formFacebookSearch" action="<?=cn('ajax_search')?>">
    <div class="row">
        <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-desktop" aria-hidden="true"></i> <?=l('Huong dan su dung')?> 
                    </h2>   
                </div>
<iframe width="640" height="360" src="https://www.youtube.com/embed/ChDrdg8z7xU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-search" aria-hidden="true"></i> <?=l('Facebook Search')?>
                    </h2>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="list-filter-search clearfix">
                                <div class="col-md-1">
                                    <b><?=l('Limit')?></b>
                                    <div class="form-group">
                                        <select class="form-control" name="limit">
                                            <?php for ($i=20; $i <= 1000; $i++) {
                                            if($i%20==0){
                                            ?> 
                                                <option value="<?=$i?>"><?=$i?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b><?=l('Facebook accounts')?></b>
                                    <div class="form-group">
                                        <select class="form-control" name="account">
                                            <?php if(!empty($accounts)){
                                            foreach ($accounts as $row) {?>
                                            <option value="<?=$row->id?>"><?=$row->fullname?> (<?=$row->username?>)</option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <b><?=l('Keyword')?></b>
                                    <div class="input-group"style="background: white; border: 1px solid #ddd;">
                                        <div class="form-line" style="border: none;">
                                            <input type="text" name="keyword" class="form-control">
                                        </div>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn bg-red waves-effect"><i class="fa fa-search" aria-hidden="true"></i> <?=l('Search')?></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row list-type-search">
                        <div class="col-md-2 col-sm-3 col-xs-6 col-md-offset-1">
                            <div class="item active" data-type="page">
                                <div class="icon col-blue"><i class="fa fa-flag-checkered" aria-hidden="true"></i></div>
                                <div class="title"><?=l('Page')?></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="item" data-type="group">
                                <div class="icon col-orange"><i class="fa fa-users" aria-hidden="true"></i></div>
                                <div class="title"><?=l('Group')?></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="item" data-type="user">
                                <div class="icon col-green"><i class="fa fa-user" aria-hidden="true"></i></div>
                                <div class="title"><?=l('User')?></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="item" data-type="event">
                                <div class="icon col-purple"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                <div class="title"><?=l("Event")?></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="item" data-type="place">
                                <div class="icon col-pink"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                <div class="title"><?=l('Place')?></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="item" data-type="post">
                                <div class="icon col-yellow"><i class="fa fa-clipboard" aria-hidden="true"></i></div>
                                <div class="title"><?=l('Content')?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body p0 result_search"></div>
            </div>
        </div>
    </div>
</form>