<?php

namespace frontend\components;

use Yii;
use yii\web\AssetManager;
use yii\web\View;
use yii\widgets\InputWidget;
use yii\helpers\ArrayHelper;

/* @var $form \yii\widgets\ActiveForm */

class ModelWidget extends InputWidget
{
    public $baseUrl;
    public $model_name;
    public $modal_form_header;
    public $form;

    public function run()
    {
        parent::run();
        //$inputId = \yii\helpers\Html::getInputId($this->model, $this->attribute);
        $inputId = $this->getId();
        $input_name = \yii\helpers\Html::getInputName($this->model, $this->attribute);
        $record_id = $this->model[$this->attribute];

        $html = $this->form->field($this->model, $this->attribute)->textInput(['id'=> $inputId.'-input']);

        $html = (string)$html;

        $newContent = '';
        $newContent .= \yii\helpers\Html::hiddenInput($input_name , $record_id, ['id' => $inputId . '-hidden']);
        $newContent .= '<div class="input-group">';
        $newContent .= '<input type="text" id="'.$inputId . '-input' . '" class="form-control" value="'.$this->value.'">';
        $newContent .= '<span class="input-group-btn">';
        $newContent .= '<a href="'.$this->baseUrl."/modal-list?fld_id=".$inputId."&returnName=".$inputId . "-input&returnId=".$inputId . "-hidden&search=$this->model_name&header=$this->modal_form_header".'" class="btn btn-default selectRecordBtn" id="'.$inputId.'-selectRecordBtn"><b>...</b></a>';
        $newContent .= '<label class="btn btn-default recordBtn" id="'.$inputId.'-editRecordBtn">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"><a href="'.$this->baseUrl."/record-modal-form?fld_id=".$inputId."&returnName=".$inputId . "-input&returnId=".$inputId . "-hidden&search=$this->model_name&rec_id=$record_id&header=$this->modal_form_header".'"></a></span>
                  </label>';
        $newContent .= '<label class="btn btn-default recordBtn" id="'.$inputId.'-newRecordBtn">
                   <span class="glyphicon glyphicon-plus" aria-hidden="true"><a href="'.$this->baseUrl."/record-modal-form?fld_id=".$inputId."&returnName=".$inputId . "-input&returnId=".$inputId . "-hidden&search=$this->model_name&header=$this->modal_form_header".'"></a></span>
                  </label>';
        $newContent .= '</span>';
        $newContent .= '</div>';

        $html = preg_replace('|<input(.+)>|isU',$newContent, $html);

        $html .= "
<script>
$(function () {
        var edit_btn_id = '$inputId-editRecordBtn';
        var edit_btn_tg_a = $('#' + edit_btn_id + ' a');
        var edit_btn_url = edit_btn_tg_a.attr('href');

        $('#$inputId-input').autocomplete({
        serviceUrl: '$this->baseUrl/ajax-list?search=$this->model_name',
		minChars: 0,
		preserveInput: true,
		noCache: true,
		triggerSelectOnValidInput: false,
		//tabDisabled: true,
        onSelect: function(suggestion) {
            $('#$inputId-hidden').val(suggestion.data);
            edit_btn_url = setAttr(edit_btn_url, 'rec_id', suggestion.data);
            edit_btn_tg_a.attr('href', edit_btn_url);
        }
    });
	$('#$inputId-input').on('change',function(){
        if ($('#$inputId-input').val() != ''){
            var a =  $('#$inputId-input').autocomplete();
            //alert(a.suggestions.length);
            w = a.selectedIndex;
            if (a.selectedIndex<=0){
                if (a.suggestions.length>0){
                    //$('#$inputId-input').val(a.suggestions[0].value);
                    $('#$inputId-input').attr('value', a.suggestions[0].value);
                    $('#$inputId-input').val(a.suggestions[0].value);
                    //a.preserveInput = false;
                    a.select(0);
                    //a.preserveInput = true;
                } else{
                    $('#$inputId-input').val('');
                    $('#$inputId-hidden').val('');
                    edit_btn_url = setAttr(edit_btn_url, 'rec_id', '');
                    edit_btn_tg_a.attr('href', edit_btn_url);
                }
            }
        }
    });
	$('#$inputId-input').on('blur',function(){
        if ( $('#$inputId-input').val()==''){
            $('#$inputId-hidden').val('');
            edit_btn_url = setAttr(edit_btn_url, 'rec_id', '');
            edit_btn_tg_a.attr('href', edit_btn_url);
        }
    });
	window.addEventListener('resize', function() {
		setTimeout(function() {
			var a =  $('#$inputId-input').autocomplete();
			a.fixPosition();
			//alert('Прошла 1 секунда');
		}, 500);
	}, false);
	
	//$('#$inputId-input').on('focus',function(){
	//	setTimeout(function() {
	//		var a =  $('#$inputId-input').autocomplete();
	//		a.fixPosition();
	//		alert('Прошла 1 секунда');
	//	}, 500);
	//});

});
</script>
";
        return $html;
    }
}