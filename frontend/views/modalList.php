<?php

echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'responsiveWrap' => false,
    'id' => "$returnId-modal-list-grid",
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'enablePushState' => false,
            'clientOptions' => [
                'method' => 'GET',
                'push' => false,

            ]
        ]
    ],

    'columns' => $searchModel->getGridColumns(),
]);

?>
<script type="text/javascript">
<?php
if ($returnId)
{
?>
//    function setAttr(url, prmName, val){
//        var reg_str = new RegExp("("+prmName+")[^&]+","ig");
//        return url.replace(reg_str, '$1' + '=' + val);
//    }

    function afterGridRefresh()
    {
        <?php
            $recordName = 'recordName';
            $recordGUID = 'GUID';
        ?>
        $('td[data-col-seq="<?php echo $recordName; ?>"]').addClass('modalReturnLink');
        $('#<?php echo $returnId; ?>-modal-list-grid td[data-col-seq="<?php echo $recordName; ?>"]').click(function() {
            var id = $(this).parent().children('td[data-col-seq="<?php echo $recordGUID; ?>"]').html();
            $('#<?php echo $returnId; ?>').val(id);
            <?php if ($returnName) { ?>
            var name = $(this).html();
            $('#<?php echo $returnName; ?>').attr("value", name);
            $('#<?php echo $returnName; ?>').val(name);
            <?php } ?>
            var edit_btn_id = '<?php echo $fld_id; ?>' + '-editRecordBtn';
            var edit_btn_tg_a = $('#' + edit_btn_id + ' a');
            var edit_btn_url = edit_btn_tg_a.attr('href');
            edit_btn_url = setAttr(edit_btn_url, 'rec_id', id);
            edit_btn_tg_a.attr('href', edit_btn_url);

            $('#recordsListModal').modal('hide');
        });
        $('#recordsListModal').on('hide.bs.modal',function() {
            $('#<?php echo $returnName; ?>').blur();
        });
    }
<?php }
else
{
    ?>
    function afterGridRefresh(){}
    <?php
}
?>
afterGridRefresh();
$(document).on('pjax:success', afterGridRefresh);
</script>