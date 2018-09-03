function Page(){
	var self= this;
	var timeout = 0;
    var status = 0;
    var running = 0;
    var el;
    var w = $(window);
    var clock = $('.countDown span');
    var SPINTAX_PATTERN = /\{[^"\r\n\}]*\}/;
	this.init= function(){
        self.FacebookAccount();
        self.FaceboookPost();
        self.FacebookSearch();
        self.FacebookJoinGroup();
        self.Editor();
        self.Category();

        $('.form-datetime').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm',
            minDate: moment().format('YYYY-MM-DD 00:00'),
            currentDate: moment().format('YYYY-MM-DD HH:mm'),
        });

        $('.form-date').bootstrapMaterialDatePicker({
            time: false,
            currentDate: moment().format('YYYY-MM-DD'),
        });

        $('.form-time').bootstrapMaterialDatePicker({
            date: false,
            format: 'HH:mm',
            currentDate: moment().format('HH:mm'),
        });

        
        $('.form-time').bootstrapMaterialDatePicker({switchOnClick:true}).on('change', function(e, date){
             _that = $(this);
         $.post(PATH + "auto_all/get_times_post")

        });

        
        if($('.js-dataTable').length > 0 || $('.js-dataTableSchedule').length > 0 || $('.js-dataTableScheduleAjax').length > 0){
            _dataTable = $('.js-dataTable').DataTable({
                paging: false,
                columnDefs: [ {
                    targets: 0,
                    orderable: false
                }],
                aaSorting: [],
                language: {
                    search: 'Search ',
                },
                bPaginate: false,
                bLengthChange: false,
                bFilter: true,
                bInfo: false,
                bAutoWidth: false,
                responsive: false,
                emptyTable: Lang['emptyTable']
            });

            $('.filter_account,.filter_profile,.filter_group,.filter_page,.filter_friend').change( function() {
                _dataTable.draw();
            });

            _dataTableSchedule = $('.js-dataTableSchedule').DataTable({
                paging: true,
                pageLength: 50,
                lengthMenu: [[10, 25, 50, 100, 200, 500, 1000, -1], [10, 25, 50, 100, 200, 500, 1000, "All"]],
                columnDefs: [ {
                    targets: 0,
                    orderable: false
                }],
                aaSorting: [],
                language: {
                    search: 'Search ',
                },
                bFilter: true,
                bInfo: true,
                bAutoWidth: false,
                responsive: true,
                pagingType: "full_numbers",
                emptyTable: Lang['emptyTable']
            });

            $('.filter_category').change( function() {
                _dataTableSchedule.draw();
            });

            _dataTableScheduleAjax = $('.js-dataTableScheduleAjax').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [ {
                    targets: 0,
                    orderable: false
                }],
                ajax: $.fn.dataTable.pipeline( {
                    url: CURRENT_URL+'/ajax_page',
                    pages: 1 // number of pages to cache
                }),
                paging: true,
                pageLength: 50,
                lengthMenu: [[10, 25, 50, 100, 200, 500], [10, 25, 50, 100, 200, 500]],
                
                aaSorting: [],
                language: {
                    search: 'Search ',
                },
                bFilter: true,
                bInfo: true,
                bAutoWidth: false,
                responsive: true,
                pagingType: "full_numbers",
                emptyTable: Lang['emptyTable']
            });

            $('.filter_account').change( function() {
                _dataTableSchedule.draw();
            });

            //CUSTOM FILTER
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var el_profile = $('.filter_profile');
                    var el_group   = $('.filter_group');
                    var el_page    = $('.filter_page');
                    var el_friend  = $('.filter_friend');
                    var fbuser     = $('.filter_account').val();
                    var profile    = el_profile.is(':checked')?"profile":"";
                    var group      = el_group.is(':checked')?"group":"";
                    var page       = el_page.is(':checked')?"page":"";
                    var friend     = el_friend.is(':checked')?"friend":"";
                    var _account   = data[1];
                    var _type      = data[3];

                    if(fbuser != "" && fbuser != undefined){
                        if(el_profile.length > 0 || el_friend.length > 0){
                            if ((fbuser == _account) && (profile == _type || group == _type || page == _type || friend == _type)){
                                return true;
                            }
                        }else{
                            if (fbuser == _account){
                                return true;
                            }
                        }
                        return false; 
                    }else{
                        if(el_profile.length > 0 || el_friend.length > 0){
                            if (profile == _type || group == _type || page == _type || friend == _type){
                                return true;
                            }
                            return false; 
                        }
                        return true;
                    }
                    
                }
            );
        }

        $('[data-toggle="tooltip"]').tooltip(); 

        $(document).on('click', '.checkAll', function(){
            _that = $(this);
            if(_that.is(":checked")){
                _that.parents("table").find('.checkItem').prop('checked', true);
            }else{
                _that.parents("table").find('.checkItem').prop('checked', false);
            }
        });

        $(document).on('click', '.open-schedule', function(){
            _that = $(this);
            _box_schedule = $('.box-post-schedule');
            if(_that.hasClass('active')){
                _box_schedule.hide();
                _that.removeClass('active');
            }else{
                _box_schedule.show();
                _that.addClass('active');
            }
        });

        $(document).on('click', '.btnActionModule', function(){
            _that     = $(this);
            _type     = _that.data("action");
            _category = _that.data("categoty");
            _form     = _that.closest("form");
            _action   = _form.attr("action");
            _redirect = _form.data("redirect");
            _data     = _form.serialize();
            _data     = _data + '&' + $.param({token:token, action: _type, category: _category});
            _confirm = _that.data("confirm");
            _valid   = $('.checkItem:checkbox:checked').length;
            if(_valid > 0 || _type == "delete_all"){
                if(_type == "delete" || _type == "delete_all"){
                    self.showConfirmMessage(_confirm, function(){
                        $.post(_action, _data, function(result){
                            setTimeout(function(){
                                window.location.reload();
                            },2000);
                            self.showSuccessAutoClose(Lang["deleted"], "success", 2000);
                        },'json');
                    });
                }else{
                    $.post(_action, _data, function(result){
                        window.location.reload();
                    },'json');
                }
            }else{
                self.showSuccessAutoClose(Lang["selectoneitem"], "info", 2000);
            }
            
            return false;
        });

        $(document).on('click', '.btnActionModuleItem', function(){
            _that    = $(this);
            _action  = _that.parents("tr").data("action");
            _type    = _that.data("action");
            _confirm = _that.data("confirm");
            _id      = _that.parents("tr").data("id");
           
            if(_that.parents("tr").hasClass("child")){
                _action  = _that.parents("tr").prev("tr").data("action");
                _id  = _that.parents("tr").prev("tr").data("id");
            }
            if(_type == "delete"){
                _data    = $.param({token:token, action: _type, id: _id});
                self.showConfirmMessage(_confirm, function(){
                    $.post(_action, _data, function(result){
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                        self.showSuccessAutoClose(Lang["deleted"], "success", 2000);
                    },'json');
                });
            }else{
                _type  = (_that.is(":checked"))?"active":"disable";
                _data    = $.param({token:token, action: _type, id: _id});
                $.post(_action, _data, function(result){
                    //window.location.reload();
                },'json');
            }
        });
        
                $(document).on('click', '.btnActionModuleItemcontent', function(){
            _that    = $(this);
            _action  = _that.parents("tr").data("action");
            _type    = _that.data("action");
            _confirm = _that.data("confirm");
            _id      = _that.parents("tr").data("id");
           
            if(_that.parents("tr").hasClass("child")){
                _action  = _that.parents("tr").prev("tr").data("action");
                _id  = _that.parents("tr").prev("tr").data("id");
            }

                _data    = $.param({token:token, action: _type, id: _id});
                self.showConfirmMessage(_confirm, function(){
                    $.post(_action, _data, function(result){
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                        self.showSuccessAutoClose(Lang["deleted"], "success", 2000);
                    },'json');
                });

        });

        $(document).on('click', '.btnUpdateGroups', function(){
            _that    = $(this);
            _action  = _that.parents("tr").data("action-groups");
            _type    = _that.data("type");
            _id      = _that.parents("tr").data("id");
            _data    = $.param({token:token, type: _type, id: _id});
            $(".page-loader-action").fadeIn();
            $.post(_action, _data, function(result){
                self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                $(".page-loader-action").fadeOut();
            },'json');
        });

        $(document).on('click', '.btnActionUpdate', function(){
            _that    = $(this);
            _form     = _that.closest("form");
            _action   = _form.attr("action");
            _redirect = _form.data("redirect");
            _data     = _form.serialize();
             _rfurl   = decodeURIComponent(window.location.search.substring(1));
             _rf      = _rfurl.split('=')[1];
            _data     = _data + '&' + $.param({token:token, rf:_rf});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');
                $.post(_action, _data, function(result){
                    self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
                    if(result['st'] == "success")
                        window.location.assign(_redirect);
                },'json');
            }
            return false;
        });
	};

    this.Editor = function(){
        $('.tab_import, .nav-tabs').click(function(){
            $(".result_search").html("");
            $(".ListUidImport").html("");
        });
        $('.dialog-upload').click(function() {

            var _that = $(this);
            var fm = $('<div/>').dialogelfinder({
                url : BASE+'assets/plugins/elfinder/php/connector.php',
                lang : 'en',
                width : ($(window).width() > 840)?840:$(window).width() - 30,
                resizable: false,
                destroyOnClose : true,
                getFileCallback : function(files, fm) {                    
                    _that.parents(".input-group").find("input").val(BASE+files.url);
                    switch(_type){
                        case "link":
                            $(".preview-box-2 .preview-box-image").css('background-image', 'url(' + self.spintax(BASE+files.url) + ')')
                            break;

                        case "image":
                            $(".preview-box-3 .preview-box-image").css('background-image', 'url(' + self.spintax(BASE+files.url) + ')')
                            break;
                    }
                },
                commandsOptions : {
                    getfile : {
                        oncomplete : 'close',
                        folders : true
                    }
                }
            }).dialogelfinder('instance');
        });

        $('.dialog-uploads').click(function() {
            var _that = $(this);
            var fm = $('<div/>').dialogelfinder({
                url : BASE+'assets/plugins/elfinder/php/connector.php',
                lang : 'en',
                width : ($(window).width() > 840)?840:$(window).width() - 30,
                resizable: false,
                destroyOnClose : true,
                getFileCallback : function(files, fm) {
                    $.each(files, function(index,value){
                        html  = '<li style="background-image: url('+BASE+value.url+')">';
                        html += '<div class="icon-remove remove-files fa fa-times"></div>';
                        html += '<input type="hidden" class="form-control" name="images_url[]" value="'+BASE+value.url+'">';
                        html += '</li>';
                        _that.parents(".tab-pane").find(".list-images").append(html);
                        history.pushState("", document.title, window.location.pathname);
                    });
                },
                commandsOptions : {
                    getfile : {
                        oncomplete : 'close',
                        folders : false,
                        multiple: true
                    }
                }
            }).dialogelfinder('instance');
        });

        $(".btn-add-image").click(function(){
            if($(".remote-image").val() != ""){
                _that = $(".remote-image");
                url   = _that.val();
                _that.val("");
                html  = '<li style="background-image: url('+url+')">';
                html += '<div class="icon-remove remove-files fa fa-times"></div>';
                html += '<input type="hidden" class="form-control" name="images_url[]" value="'+url+'">';
                html += '</li>';
                _that.parents(".tab-pane").find(".list-images").append(html);
            }
        });

        $(document).on("click", ".list-images .remove-files", function(){
            $(this).parents("li").remove();
        });

        $('.dialog-import-add').click(function() {
            var _that = $(this);
            _account = _that.parents(".tab-pane").find(".list_account").val();
            _account = _account.split("{|}");
            var fm = $('<div/>').dialogelfinder({
                url : BASE+'assets/plugins/elfinder/php/connector.php',
                lang : 'en',
                width : ($(window).width() > 840)?840:$(window).width() - 30,
                resizable: false,
                destroyOnClose : true,
                getFileCallback : function(files, fm) {
                    $.get(files.url, function(data) {
                        var lines = data.split("\n");
                        $.each(lines, function(n, elem) {
                            elem = elem.replace(/(?:\r\n|\r|\n)/g, '');
                            if(elem != ""){
                                $row = '<tr class="post-pending">';
                                $row +='<td>';
                                $row +='<input type="checkbox" name="id[]" id="md_checkbox_'+elem+'" class="filled-in chk-col-red checkItem" value="add{-}'+elem+'{-}Facebook User{-}0">';
                                $row +='<label class="p0 m0" for="md_checkbox_'+elem+'">&nbsp;</label>';
                                $row +='</td>';
                                $row +='<td>'+elem+'</td>';
                                $row +='<td>Facebook User</td>';
                                $row +='<td>-----</td>';
                                $row +='<td><a href="https://facebook.com/'+elem+'" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> Visit page</a></td>';
                                $row +='<td class="status-post"></td>';
                                $row +='</tr>';
                                $(".ListUidImport").append($row);
                            }
                        });
                    }, 'text');
                    _that.parents(".input-group").find("input").val(files.url);
                },
                commandsOptions : {
                    getfile : {
                        oncomplete : 'close',
                        folders : true
                    }
                }
            }).dialogelfinder('instance');
        });

        $('.dialog-import-message').click(function() {
            var _that = $(this);
            _account_id   = _that.parents(".tab-pane").find(".list_account").val();
            _account_name = _that.parents(".tab-pane").find(".list_account option:selected").text();
            var fm = $('<div/>').dialogelfinder({
                url : BASE+'assets/plugins/elfinder/php/connector.php',
                lang : 'en',
                width : ($(window).width() > 840)?840:$(window).width() - 30,
                resizable: false,
                destroyOnClose : true,
                getFileCallback : function(files, fm) {
                    $.get(files.url, function(data) {
                        var lines = data.split("\n");
                        $.each(lines, function(n, elem) {
                            elem = elem.replace(/(?:\r\n|\r|\n)/g, '');
                            if(elem != ""){
                                $row = '<tr class="post-pending">';
                                $row +='<td>';
                                $row +='<input type="checkbox" name="id[]" id="md_checkbox_'+elem+'" class="filled-in chk-col-red checkItem" value="friend{-}'+_account_id+'{-}'+_account_name+'{-}'+elem+'{-}Facebook User{-}0">';
                                $row +='<label class="p0 m0" for="md_checkbox_'+elem+'">&nbsp;</label>';
                                $row +='</td>';
                                $row +='<td>'+elem+'</td>';
                                $row +='<td>Facebook User</td>';
                                $row +='<td>-----</td>';
                                $row +='<td><a href="https://facebook.com/'+elem+'" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> Visit page</a></td>';
                                $row +='<td class="status-post"></td>';
                                $row +='</tr>';
                                $(".ListUidImport").append($row);
                            }
                        });
                    }, 'text');
                    _that.parents(".input-group").find("input").val(files.url);
                },
                commandsOptions : {
                    getfile : {
                        oncomplete : 'close',
                        folders : true
                    }
                }
            }).dialogelfinder('instance');
        });

        $('.dialog-import-group').click(function() {
            var _that = $(this);
            _account_id   = _that.parents(".tab-pane").find(".list_account").val();
            _account_name = _that.parents(".tab-pane").find(".list_account option:selected").text();
            var fm = $('<div/>').dialogelfinder({
                url : BASE+'assets/plugins/elfinder/php/connector.php',
                lang : 'en',
                width : ($(window).width() > 840)?840:$(window).width() - 30,
                resizable: false,
                destroyOnClose : true,
                getFileCallback : function(files, fm) {
                    $.get(files.url, function(data) {
                        var lines = data.split("\n");
                        $.each(lines, function(n, elem) {
                            elem = elem.replace(/(?:\r\n|\r|\n)/g, '');
                            if(elem != ""){
                                $row = '<tr class="post-pending">';
                                $row +='<td>';
                                $row +='<input type="checkbox" name="id[]" id="md_checkbox_'+elem+'" class="filled-in chk-col-red checkItem" value="join{-}'+elem+'{-}Facebook Group{-}0">';
                                $row +='<label class="p0 m0" for="md_checkbox_'+elem+'">&nbsp;</label>';
                                $row +='</td>';
                                $row +='<td>'+elem+'</td>';
                                $row +='<td>Facebook Group</td>';
                                $row +='<td>-----</td>';
                                $row +='<td><a href="https://facebook.com/'+elem+'" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> Visit page</a></td>';
                                $row +='<td class="status-post"></td>';
                                $row +='</tr>';
                                $(".ListUidImport").append($row);
                            }
                        });
                    }, 'text');
                    _that.parents(".input-group").find("input").val(files.url);
                },
                commandsOptions : {
                    getfile : {
                        oncomplete : 'close',
                        folders : true
                    }
                }
            }).dialogelfinder('instance');
        });

        $("[name='link_title']").keyup(function(){
            _that = $(this);
            $title = _that.val();
            if($title != ""){
                $(".preview-box-2 .preview-box-title").html(self.spintax($title));
            }else{
                $(".preview-box-2 .preview-box-title").html('<div class="line-no-text"></div>');
            }
        });

        $(".link_message").keyup(function(){
            _that = $(this);
            $link = _that.val();
            console.log($link);
            if($link != ""){
                $(".message-preview .preview-link").show();
                $(".message-preview .preview-link").html('<a href="javscript:void(0);">'+self.spintax($link)+'</a>');
            }else{
                $(".message-preview .preview-link").hide();
                $(".message-preview .preview-link").html('');
            }
        });
        

        $("[name='link_description']").keyup(function(){
            _that = $(this);
            $desc = _that.val();
            console.log($desc);
            if($desc != ""){
                $(".preview-box-2 .preview-box-desc").html(self.cutText(self.spintax($desc),250));
            }else{
                $(".preview-box-2 .preview-box-desc").html('<div class="line-no-text"></div><div class="line-no-text w50"></div>');
            }
        });

        $("[name='link_caption']").keyup(function(){
            _that = $(this);
            $caption = _that.val();
            if($caption != ""){
                $(".preview-box-2 .preview-box-caption").html(self.spintax($caption));
            }else{
                $(".preview-box-2 .preview-box-caption").html('<div class="line-no-text w25"></div>');
            }
        });

        $("[name='link_picture']").keyup(function(){
            _that = $(this);
            $image = _that.val();
            if($image != ""){
                $(".preview-box-2 .preview-box-image").css('background-image', 'url(' + self.spintax($image) + ')')
            }else{
                $(".preview-box-2 .preview-box-image").removeAttr("style");
            }
        });

        $("[name='image_url']").keyup(function(){
            _that = $(this);
            $image = _that.val();
            if($image != ""){
                $(".preview-box-3 .preview-box-image").css('background-image', 'url(' + self.spintax($image) + ')')
            }else{
                $(".preview-box-3 .preview-box-image").removeAttr("style");
            }
        });

        $(document).on("click", ".post_type li", function(){
            $(".preview-box").hide();
            _type = $('.post_type .active').data("type");
            switch(_type){
                case "text":
                    $(".preview-box-1").show();
                    break;

                case "link":
                    $(".preview-box-2").show();
                    break;

                case "image":
                    $(".preview-box-3").show();
                    break;

                case "video":
                    $(".preview-box-4").show();
                    break;
                case "images":
                    $(".preview-box-5").show();
                    break;
            }
        });
        
        
        $('.btnfilterfriends').click(function(){
            _that = $(this);
            _form = _that.closest(".formSchedule");
            _data     = _form.serialize();
            _posts_not    = $(".filter-posts-not").val();
            _data     = _data + '&' + $.param({posts_not : _posts_not});
             $('#test').html('hello');   
            $.post(PATH + "unfriends/ajax_filter_friends", _data, function(result){
                $('#test').html('result');
            });
        });
        
        $(document).on("click", ".btn-modal-save", function(){
            $('.btnSavePost').trigger("click");
        });

        $('.btnSavePost').click(function(){
            _that     = $(this);
            _form     = _that.closest(".formSchedule");
            _data     = _form.serialize();
            _type     = $('.post_type .active').data('type');
            _title    = $(".save_title").val();
            _category = _that.data("type");
            _data     = _data + '&' + $.param({token:token, title: _title, type: _type, category: _category});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');

                $.post(PATH + "save/ajax_save", _data, function(result){
                    if(result.st == "error"){
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                        _form.removeClass('disable');
                    }else if(result.st == "title"){
                        $('#modal-save').modal('toggle');
                    }else{
                        $(".save_title").val("");
                        $('#modal-save').modal('hide');
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
                },'json');
            }

            return false;
        });


        $('.btnaddcat').click(function(){
            _that     = $(this);
            _form     = _that.closest(".formSchedule");
            _data     = _form.serialize();
            _type     = $('.post_type .active').data('type');
            _title    = $(".save_title").val();
            _category = _that.data("type");
            _data     = _data + '&' + $.param({token:token, title: _title, type: _type, category: _category});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');

                $.post(PATH + "save_data/ajax_save_cat", _data, function(result){
                    if(result.st == "error"){
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                        _form.removeClass('disable');
                    }else if(result.st == "title"){
                        $('#modal-save').modal('toggle');
                    }else{
                        $(".save_title").val("");
                        $('#modal-save').modal('hide');
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
                },'json');
            }

            return false;
        }); 
        
        // add_data

        $(document).on("click", ".btn-modal-save", function(){
            $('.btnaddPost').trigger("click");
        }); 
    
        $('.btnaddPost').click(function(){
            _that     = $(this);
            _form     = _that.closest(".formSchedule");
            _data     = _form.serialize();
            _type     = $('.post_type .active').data('type');
            _title    = $(".save_title").val();
            _cat= $("#getcatdata :selected").text();
            _category = _that.data("type");
            _data     = _data + '&' + $.param({token:token, title: _title, type: _type, category: _category, cat_dat: _cat});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');

                $.post(PATH + "save_data/ajax_save", _data, function(result){
                    if(result.st == "error"){
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                        _form.removeClass('disable');
                    }else if(result.st == "title"){
                        $('#modal-save').modal('toggle');
                    }else{
                        $(".save_title").val("");
                        $('#modal-save').modal('hide');
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                        window.location.reload();
                       
                    }
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
                },'json');
            }

            return false;
        }); 
        
        $(document).on("change", ".getSavePost", function(){
            _that = $(this);
            _value = _that.val();
            if(!_that.hasClass('disable')){
                _that.addClass('disable');
                $.post(PATH + "save/ajax_get_save", {token: token, value: _value}, function(data){
                    _that.removeClass('disable');
                    if(data != "" && data != null){
                        switch(data.category){
                            case "post":
                                el[0].emojioneArea.setText(data.message);
                                $("[name="+data.type+"_title]").val(data.title).trigger("keyup");
                                $("[name="+data.type+"_description]").val(data.description).trigger("keyup");
                                if(data.type == "image" || data.type == "video"){
                                    $("[name="+data.type+"_url]").val(data.image).trigger("keyup");
                                }else{
                                    $("[name="+data.type+"_url]").val(data.url).trigger("keyup");
                                }
                                $("[name="+data.type+"_image]").val(data.image).trigger("keyup");
                                $("[name="+data.type+"_picture]").val(data.image).trigger("keyup");
                                $("[name="+data.type+"_caption]").val(data.caption).trigger("keyup");
                                $("li[data-type='"+data.type+"'] a").trigger("click");
                                break;

                            case "friend":
                                el[0].emojioneArea.setText(data.message);
                                $("[name="+data.type+"_title]").val(data.title).trigger("keyup");
                                $("[name="+data.type+"_description]").val(data.description).trigger("keyup");
                                if(data.type == "image" || data.type == "video"){
                                    $("[name="+data.type+"_url]").val(data.image).trigger("keyup");
                                }else{
                                    $("[name="+data.type+"_url]").val(data.url).trigger("keyup");
                                }
                                $("[name="+data.type+"_image]").val(data.image).trigger("keyup");
                                $("[name="+data.type+"_picture]").val(data.image).trigger("keyup");
                                $("[name="+data.type+"_caption]").val(data.caption).trigger("keyup");
                                $("li[data-type='"+data.type+"'] a").trigger("click");
                                break;

                            default:
                                el[0].emojioneArea.setText(data.message);
                                $("[name=link]").val(data.url).trigger("keyup");
                                break;
                        }
                    }
                },'json');
            }
        });

        if($('.post-message').length > 0){
            el = $(".post-message").emojioneArea({
                hideSource: true,
                useSprite: false,
                pickerPosition    : "bottom",
                filtersPosition   : "top",
            });

            el[0].emojioneArea.on("keyup", function(editor) {
                _data = editor.html();
                _type = $('.post_type .active').data("type");
                if($(".data-message").length > 0){
                    if(_data != ""){
                        $(".data-message").html(_data);
                    }else{
                        $(".data-message").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                    }
                }else{
                    _el = $(".data-message-content");
                    if(_data != ""){
                        _el.show()
                    }else{
                        _el.hide();
                    }
                    _el.html(_data);
                }
            });

            el[0].emojioneArea.on("change", function(editor) {
                _data = editor.html();
                _type = $('.post_type .active').data("type");
                if($(".data-message").length > 0){
                    if(_data != ""){
                        $(".data-message").html(_data);
                    }else{
                        $(".data-message").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                    }
                }else{
                    _el = $(".data-message-content");
                    if(_data != ""){
                        _el.show()
                    }else{
                        _el.hide();
                    }
                    _el.html(_data);
                }
            });

            el[0].emojioneArea.on("emojibtn.click", function(editor) {
                _data = $(".emojionearea-editor").html();
                _type = $('.post_type .active').data("type");
                if($(".data-message").length > 0){
                    if(_data != ""){
                        $(".data-message").html(_data);
                    }else{
                        $(".data-message").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                    }
                }else{
                    _el = $(".data-message-content");
                    if(_data != ""){
                        _el.show()
                    }else{
                        _el.hide();
                    }
                    _el.html(_data);
                }
            });
        }
    }

    this.FacebookAccount = function(){
        $(document).on("click", ".btnFBAccountUpdate", function(){
            _that     = $(this);
            _form     = _that.closest("form");
            _action   = _form.attr("action");
            _redirect = _form.data("redirect");
            _data     = _form.serialize();
            _data     = _data + '&' + $.param({token:token});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');
                $.post(_action, _data, function(result){
                    self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
                    if(result['st'] == "success")
                        window.location.assign(_redirect);
                },'json');
            }

            return false;
        });

        $(document).on("click", ".btnFBGetToken", function(){
            _that     = $(this);
            _form     = _that.closest("form");
            _action   = _form.data("action-token");
            _redirect = _form.data("redirect");
            _data     = _form.serialize();
            _data     = _data + '&' + $.param({token:token});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');
                $.post(_action, _data, function(result){
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
              //      if(result['st'] == "success"){
                      //  $(".open_iframe").html('<iframe src="'+result['url']+'"></iframe>');
                      $(".open_iframe").html(result['url']);
                //    }else{
              //          self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
              //      }
                },'json');
            }

            return false;
        });
    }

    this.FaceboookPost = function(){
        $(document).on("click", ".btnPostnow", function(){
            self.Postnow($(this));
        });

        $(document).on("click", ".btnResumePost", function(){
            clock.countdown('resume');
            self.Postnow($(this));
        });

        $(document).on("click", ".btnPausePost", function(){
            clock.countdown('pause');
            clearTimeout(timeout);
        });

        $(document).on("click", ".btnSaveSchedules", function(){
            _that     = $(this);
            _form     = _that.closest("form");
            _action   = _form.data("action");
            _type     = $('.post_type .active').data('type');
            _data     = _form.serialize();
            _data     = _data + '&' + $.param({token:token, type: _type});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');
                $.post(_action, _data, function(result){
                    if(result.st == 'valid'){
                        self.showNotification(result.label, result.txt, 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }else{
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                        self.showSuccessAutoClose(result.txt, "success", 2000);
                        $(".page-loader-action").fadeOut();
                    }
                    $(".page-loader-action").fadeOut();
                    _form.removeClass('disable');
                },'json');
            }
        });
        
    }

    this.Postnow = function(_that){
        _form     = _that.closest("form");
        _action   = _form.attr("action");
        _redirect = _form.data("redirect");
        _type     = $('.post_type .active').data('type');
        _deplay   = $('.deplay_post_now').val();
        _group    = "";
        _item     = "";
        _stop     = false;

        $(".js-dataTable tbody tr, .js-dataTableImport tbody tr, .js-dataTableImport2 tbody tr").each(function(index,value){
            _tr   = $(this);
            if(_tr.hasClass('post-pending') && _tr.find(".checkItem").is(":checked")){
                running = 1;
                if(!_stop){
                    _item  = _tr;
                    _group = _tr.find(".checkItem").val();
                    _stop  = true;
                }
            }
        });
        _data     = $("form.formSchedule :input[name!='id[]']").serialize();
        _data     = _data + '&' + $.param({token:token, type: _type, group: _group});
        if(_group != ""){
            _item.removeClass("post-pending").addClass("post-processing");
            _item.find(".status-post").html(Lang['processing']);
            $.post(_action, _data, function(result){
                if(result.st == 'valid'){
                    self.showNotification(result.label, result.txt, 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    _item.removeClass("post-processing").addClass("post-pending");
                    _item.find(".status-post").html('');
                    clearTimeout(timeout);
                }else{
                    count_process = $(".post-pending input:checkbox:checked").length;
                    clock.countdown(self.getMinutes(count_process*_deplay), function(event) {
                        $(this).html(event.strftime('%H:%M:%S'));
                    });
                    _item.removeClass("post-processing").addClass("post-"+result.st);
                    _item.find(".status-post").html(result.txt);
                }
            },'json');

            timeout = setTimeout(function(){
                self.Postnow(_that);
            },_deplay*1000);
        }
    }

    this.Category = function(){
        $(document).on("click", ".btn-modal-add-category", function(){
            $('.btnAddCategory').trigger("click");
        });

        $(document).on("click", ".btnAddCategory", function(){
            _that     = $(this);
            _form     = _that.closest("form");
            _data     = _form.serialize();
            _title    = $(".category_title").val();
            _category = _that.data("type");
            _data     = _data + '&' + $.param({token:token, title: _title, category: _category});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');
                $.post(PATH + "category/ajax_add_category", _data, function(result){
                    if(result.st == "error"){
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }else if(result.st == "title"){
                        $('#modal-category').modal('toggle');
                    }else{
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                        $(".category_title").val("");
                        $('#modal-category').modal('hide');
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
                },'json');
            }
        });

        $(document).on("click", ".btn-modal-update-category", function(){
            $('.btnUpdateCategory').trigger("click");
        });

        $(document).on("click", ".btnUpdateCategory", function(){
            _that     = $(this);
            _form     = _that.closest("form");
            _data     = _form.serialize();
            _cid      = $(".category_id").val();
            _data     = _data + '&' + $.param({token:token, cid: _cid});
            $(".page-loader-action").fadeIn();
            if(!_form.hasClass('disable')){
                _form.addClass('disable');
                $.post(PATH + "category/ajax_update_category", _data, function(result){
                    if(result.st == "error"){
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }else if(result.st == "id"){
                        $('#modal-update-category').modal('toggle');
                    }else{
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                        $('#modal-update-category').modal('hide');
                        self.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }
                    _form.removeClass('disable');
                    $(".page-loader-action").fadeOut();
                },'json');
            }
        });

        $(document).on("change", ".categories", function(){
            _that  = $(this);
            _id    = _that.val();
            _data  = $.param({token:token, id: _id});
            $.post(PATH + "category/ajax_get_category", _data, function(result){
                window.location.reload();
            });
        });

        $(document).on("click", ".btnDeleteCategory", function(){
            _that  = $(this);
            _id    = $(".categories").val();
            _data  = $.param({token:token, id: _id});
            $(".page-loader-action").fadeIn();
            if(!_that.hasClass('disable')){
                _that.addClass('disable');
                $.post(PATH + "category/ajax_delete_category", _data, function(result){
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                    $(".page-loader-action").fadeOut();
                    self.showSuccessAutoClose(result['txt'], "success", 2000);
                },'json');
            }
        });
    }

    this.FacebookJoinGroup = function(){
        $(".formFacebookSearch .enter-keyword").keypress(function(e){
            if(e.keyCode == 13){
                $(".btnSearchGroups").trigger("click");      
            }
        });

        $(document).on("click", ".tab_add_friend a", function(){
            _that = $(this);
            _id   = _that.attr("href");
            $(".list_account").attr("name", "account_temp");
            $(_id + " .list_account").attr("name", "account");
        });

        $(document).on("click", ".btnSearchGroups",  function(){
            _that    = $(this);
            _form    = _that.parents(".list-filter-search");
            _action  = _form.data("action");
            _limit   = _form.find("select[name=limit]").val();
            _account = _form.find("select[name=account]").val();
            _keyword = _form.find("input[name=keyword]").val();
            _groupid = _form.find("input[name=groupid]").val();
            _likeid  = _form.find("input[name=likeid]").val();
            _commentid = _form.find("input[name=commentid]").val();
            _type    = _form.find("select[name=type]").val();
            if(_type == "" || _type == undefined){
                _type    = $(".tab_add_friend .active").data("type");
            }

            if(!_that.hasClass('disable')){
                _that.addClass('disable');
                $(".page-loader-action").fadeIn();
                $.post(_action, {token: token, limit: _limit, account: _account, keyword: _keyword, type: _type, groupid: _groupid, likeid: _likeid, commentid: _commentid}, function(result){
                    if(result.length <= 200){
                        result = jQuery.parseJSON(result);
                        self.showNotification(result.label, result.txt, 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }else{
                        $(".result_search").html(result);
                    }

                    $(".page-loader-action").fadeOut();
                    _that.removeClass('disable');
                });
            }
        });
    }

    this.FacebookSearch = function(){
        $(".geocomplete").geocomplete();

        $(document).on('click', '.list-type-search .item', function(){
            $('.list-type-search .item').removeClass('active');
            $(this).addClass('active');
        });

        $(document).on('click', '.map-event', function (){
            _title = $(this).data('title');
            _lat = $(this).data('lat');
            _lng = $(this).data('lng');
            $('#mdModal .modal-content').removeAttr('class').addClass('modal-content');
            $('#mdModal .modal-title').html(_title);
            $('#mdModal .modal-body').html('<div id="gmap_markers" class="gmap"></div>');
            $('#mdModal').modal('show');
            setTimeout(function(){
                var markers = new GMaps({
                    div: '#gmap_markers',
                    lat: _lat,
                    lng: _lng
                });
                markers.addMarker({
                    lat: _lat,
                    lng: _lng,
                    infoWindow: {
                        content: '<p>'+_title+'</p>'
                    }
                });
            },1000);
        });

        $('.formFacebookSearch').submit(function(){
            _that     = $(this);
            _action   = _that.attr("action");
            _type     = $(".list-type-search .active").data("type");
            _data     = _that.serialize();
            _data     = _data + '&' + $.param({token:token, type: _type});

            if(!_that.hasClass('disable')){
                _that.addClass('disable'); 
                $(".page-loader-action").fadeIn();
                $.post(_action, _data, function(result){
                    if(result.length <= 200){
                        result = jQuery.parseJSON(result);
                        self.showNotification(result.label, result.txt, 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }else{
                        $(".result_search").html(result);
                    }

                    $(".page-loader-action").fadeOut();
                    _that.removeClass('disable');
                });
            }
            return false;
        });

        $(document).on("click", ".getMembersOnGroup", function(){
            _that    = $(this);
            _id      = _that.data("id");
            _action  = _that.data("action");
            _form    = _that.closest("form");
            _limit   = _form.find("select[name=limit]").val();
            _account = _form.find("select[name=account]").val(); 
            _data    = $.param({token:token, limit: _limit, account: _account, id: _id, type: "member"});
            if(!_that.hasClass('disable')){
                _that.addClass('disable');
                $(".page-loader-action").fadeIn();
                $.post(_action, _data, function(result){
                    if(result.length <= 200){
                        result = jQuery.parseJSON(result);
                        self.showNotification(result.label, result.txt, 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    }else{
                        $(".result_search").html(result);
                    }

                    $(".page-loader-action").fadeOut();
                    _that.removeClass('disable');
                });
            }
        });
    }

    this.showNotification = function(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
        if (colorName === null || colorName === '') { colorName = 'bg-black'; }
        if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
        if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
        if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
        var allowDismiss = true;

        $.notify({
            message: text
        },
            {
                type: colorName,
                allow_dismiss: allowDismiss,
                newest_on_top: true,
                timer: 1000,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                animate: {
                    enter: animateEnter,
                    exit: animateExit
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">x</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
    };

    this.ExportTable = function(element) {
        $(element).DataTable({
            paging: false,
            columnDefs: [ {
                targets: 0,
                orderable: false
            }],
            aaSorting: [],
            language: {
                search: 'Search ',
            },
            bPaginate: false,
            bLengthChange: false,
            bFilter: true,
            bInfo: false,
            bAutoWidth: false,
            responsive: true,
            emptyTable: Lang['emptyTable'],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        });
    }

    this.getMinutes = function(seconds){
        return new Date(new Date().valueOf() + seconds * 1000);
    }

    this.cutText = function(text, number){
        if(text.length > number){
            return text.substring(0, number)+"...";
        }else{
            return text;
        }
    } 

    this.spintax = function (spun) {
        var match;
        while (match = spun.match(SPINTAX_PATTERN)) {
            match = match[0];
            var candidates = match.substring(1, match.length - 1).split("|");
            spun = spun.replace(match, candidates[Math.floor(Math.random() * candidates.length)])
        }
        return spun;
    }

    this.showConfirmMessage = function($message, $function) {
        swal({
            title: $message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: Lang["yes"],
            closeOnConfirm: false
        }, $function);
    }

    this.showSuccessAutoClose = function($message, $label, $timeout) {
        swal({
            title: $message,
            type: $label,
            timer: $timeout,
            closeOnConfirm: false,
            showConfirmButton: false
        });
    }
}
Page= new Page();
$(function(){
	Page.init();
});

$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );
 
    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;
 
    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;
         
        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                  JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                  JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }
         
        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );
 
        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));
 
                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }
             
            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);
 
            request.start = requestStart;
            request.length = requestLength*conf.pages;
 
            // Provide the same `data` options as DataTables.
            if ( $.isFunction ( conf.data ) ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }
 
            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);
 
                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }
                     
                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );
 
            drawCallback(json);
        }
    }
};

// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );