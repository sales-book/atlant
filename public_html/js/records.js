function setAttr(url, prmName, val){
	var reg_str = new RegExp("("+prmName+")[^&]+","ig");
	return url.replace(reg_str, '$1' + '=' + val);
}

function getUrlVars(url) {
	var vars = {};
	var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}

$(document).ready(function() {

    var my_modal_form = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h2></h2></div><div class="modal-body"><div class="my_load_img"><img src="/img/load.gif" width="25" alt=""></div></div></div>';

    $('.selectRecordBtn').click(function() {
        $('body').append('<div id="recordsListModal" class="fade modal" role="dialog" tabindex="-1"></div>');
        $('#recordsListModal').append(my_modal_form);
        $('#recordsListModal .modal-dialog .modal-content .modal-header h2').html('Выбрать '+getUrlVars($(this).attr('href'))["header"]);
        $('#recordsListModal .modal-dialog .modal-content .modal-body').attr('id', 'modal-list');
        var modalContainer = $('#recordsListModal');
        modalContainer.modal('show');
        $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            dataType: "html",
            success: function (data) {
                $('#modal-list').html(data);
            }
        });
        $('#recordsListModal').on('hidden.bs.modal', function (event) {
            $('#recordsListModal').remove();
        });
        return false;
    });


    $('.recordBtn').click(function() {
        $('body').append('<div id="recordModal" class="fade modal" role="dialog" tabindex="-1"></div>');
        var btn_tg_a = $('#' + this.id + ' a');
        var btn_url = btn_tg_a.attr('href');
        var json_mode = {};
        var mode = '';
        var mode_str = '';
        var rec_id = getUrlVars(btn_url)['rec_id'];
        if (rec_id == undefined) {
            var edit_btn_id = getUrlVars(btn_url)['fld_id'] + '-editRecordBtn';
            var edit_btn_tg_a = $('#' + edit_btn_id + ' a');
            var edit_btn_url = edit_btn_tg_a.attr('href');
            json_mode = {"set":"true"};
            mode = 'set';
            mode_str = 'Создать';
        }
        else{
            json_mode = {"update":"true"};
            mode = 'update';
            mode_str = 'Изменить';
        }
        var emty_field = false;
        if ((rec_id =="") && (mode == "update")){emty_field = true;}
        if (!emty_field) {
            $('#recordModal').append(my_modal_form);
            $('#recordModal .modal-dialog .modal-content .modal-header h2').html(mode_str + ' ' + getUrlVars(btn_url)["header"]);
            $('#recordModal .modal-dialog .modal-content .modal-body').attr('id', 'modal-record');
            var modalContainer = $('#recordModal');
            modalContainer.modal('show');
            $.ajax({
                url: btn_url,
                type: "GET",
                success: function (data3) {
                    $('#modal-record').html(data3);
                    $('#record_form').on('afterValidate', function (event, attribute, messages, deferreds) {
                        if (messages.length==0) {
                            $('#record_form').on('submit', function () {
/*                                var $form = $(this);
                                var data = $form.data('yiiActiveForm');
                                var form_new_fields = data.attributes;
                                form_new_data = {};
                                for (var key in form_new_fields)  {
                                    form_new_data[form_new_fields[key].name] = form_new_fields[key].value;
                                }*/
                                var form_fields = $('#record_form input[name*="Model"]');
                                form_data = {};
                                form_fields.each(function () {
                                    if (this.value != "") {
                                        form_data[this.name] = this.value;
                                    }
                                });
                                var form_data_str = JSON.stringify(form_data);
                                var fields_json = JSON.parse(form_data_str);
                                $.ajax({
                                    url: btn_url,
                                    type: "POST",
                                    dataType: "json",
                                    data: $.extend(json_mode, fields_json),
                                    success: function (response_data) {
                                        //$.each(data2, function (i, val) {
                                            $('#' + getUrlVars(btn_url)['returnName']).attr("value", response_data.record_name);
                                            $('#' + getUrlVars(btn_url)['returnName']).val(response_data.record_name);
                                            $('#' + getUrlVars(btn_url)['returnId']).val(response_data.record_id);
                                            if (mode == "set") {
                                                edit_btn_url = setAttr(edit_btn_url, 'rec_id', response_data.record_id);
                                                edit_btn_tg_a.attr('href', edit_btn_url);
                                            }
                                        //});
                                        $('#recordModal').modal('hide');
                                        return false;
                                    }

                                });
                                return false;
                            });
                        }
                    });
                }
            });
            $('#recordModal').on('hidden.bs.modal', function (event) {
                $('#recordModal').remove();
            });
        }
        return false;
    });


});


