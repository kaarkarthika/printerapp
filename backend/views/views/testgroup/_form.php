<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Testgroup */
/* @var $form yii\widgets\ActiveForm */

//echo "<pre>"; print_r($testname_det_index); die;

?>

<div class="testgroup-form">

    <?php $form = ActiveForm::begin(['id'=>'testgroup-form']); ?>

    <?= $form->field($model, 'testgroupname')->textInput(['maxlength' => true,'required' => true])->label('Group Name') ?>
     <?= $form->field($model, 'price')->textInput()->label('Price') ?> 
    
     	<?= $form->field($model, 'hsncode')->dropdownlist($tax_grouping,['prompt'=>'Select HSN Code', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('HSN Code') ?>
     <?php 
     	if($model->isNewRecord){
     	$model->isactive = 1;
     	}?> 
    <?= $form->field($model, 'isactive', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>

    <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success savecategory' : 'btn btn-primary updatecategory']) ?>
   <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
     
       <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr>
    			<td>S.No</td>
    			<td>Test Name List</td>
    		</tr>
    		</thead>
    		<tbody>
    <?php  $i=1;
    if(!empty($testname_det_index)){
    	 foreach ($testname_det_index as $key => $value) {
	 		?>
	 		<tr>
	 			<td><?php echo $i++ ?>	</td>	
	 			<td><?php echo $value->test_name  ?>	</td>
	 		</tr>	 
		<? }
    	}else{ ?>
    		<tr>
	 			<td> No Records	</td><td></td>	
	 		</tr>
     <?PHP	}
    	?>
     </tbody>
</table>
</div>
<style>
table.table.table-striped.table-bordered.detail-view thead td {
    background: #ff7272;
    color: #fff;
}
.testgroup-create table.table.table-striped.table-bordered.detail-view {
    display: none;
}.testgroup-update table.table.table-striped.table-bordered.detail-view {
    margin-top: 30px;
}
</style>

    <?php ActiveForm::end(); ?>

</div>
<script>
	$('#testgroup-form').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".savecategory").attr('disabled','disabled');
    var form = $(this);
    var formData = form.serialize();
  //  alert(form.attr("action"));
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
	    	$("#loadtex").text("Successfully Saved.");
			$("#loadtex").css('color','green ');
	  		$("#loadtex").show(4);
	    },
        
    });
}).on('submit', function(e){
    e.preventDefault();
});
	
</script>