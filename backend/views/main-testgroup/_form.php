<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\MainTestgroup */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row main-testgroup-form">

      <?php $form = ActiveForm::begin(['id'=>'main-testgroup-form']); ?>

     <?= $form->field($model, 'testgroupname')->textInput(['maxlength' => true,'required' => true])->label('Group Name') ?>
     <?= $form->field($model, 'price')->textInput(['required' => true,'onkeypress'=>'javascript:return isNumber(event)'])->label('Price') ?> 
     <?= $form->field($model, 'shortcode')->textInput(['required' => true])?>
     <?= $form->field($model, 'hsncode')->dropdownlist($tax_grouping,['prompt'=>'Select HSN Code',  'options'=>['159'=>['Selected'=>true]],'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('HSN Code') ?> 
     <?php 
     	if($model->isNewRecord){
     	$model->isactive = 1;
     	}?> 
    <?= $form->field($model, 'isactive', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
<hr>
 
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right savecategory' : 'btn btn-primary pull-right updatecategory']) ?>
	
	   <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
	
   <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
     <br>
      <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr>
    			<td>S.No</td>
    			<td>Test Name List</td>
    		</tr>
    		</thead>
    		<tbody>
    <?php  $i=1;
    if(!empty($testname_det_index)){ //echo"<pre>";print_r($testname_det_index); die;
    	 foreach ($testname_det_index as $key => $value) {
	 		?>
	 		<tr>
	 			<td><?php echo $i++ ?>	</td>	
	 			<td><?php echo $value->testgroupname  ?>	</td>
	 		</tr>	 
		<?php }
    	}else{ ?>
    		<tr>
	 			<td> No Records	</td><td></td>	
	 		</tr>
     <?php	}
    	?>
     </tbody>
</table>
</div>
<style>
table.table.table-striped.table-bordered.detail-view thead td {
   /* background: #ff7272; */
    background: #4682b4;
    color: #fff;
}
.main-testgroup-create table.table.table-striped.table-bordered.detail-view {
    display: none;
}.main-testgroup-update table.table.table-striped.table-bordered.detail-view {
    margin-top: 30px;
}
</style>

    <?php ActiveForm::end(); ?>

</div>
<script>
	$('#main-testgroup-form').on('beforeSubmit', function(e) {
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
	$("#maintestgroup-testgroupname").change(function() {
 		var testgname=$("#maintestgroup-testgroupname").val();
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=main-testgroup/testnamecheck&testname=";?>"+testgname,
	        success: function (result) 
	        {
	          if(result=="1"){
	          	alert(testgname+" Already exists");
	          	$(".savecategory").css("pointer-events","none");
	          	$(".updatecategory").css("pointer-events","none");
	          	
	          } else{
	          	$(".updatecategory").css("pointer-events","auto");
	          	$(".savecategory").css("pointer-events","auto");
	          }
	        }
	    });
 	 });
 	 $("#maintestgroup-shortcode").change(function() {
 		var testgname=$("#maintestgroup-shortcode").val();
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=main-testgroup/shortcheck&testname=";?>"+testgname,
	        success: function (result) 
	        {
	          if(result=="1"){
	          	alert(testgname+" Already exists");
	          	$(".savecategory").css("pointer-events","none");
	          	$(".updatecategory").css("pointer-events","none");
	          } else{
	          	$(".savecategory").css("pointer-events","auto");
	          	$(".updatecategory").css("pointer-events","auto");
	          }
	        }
	    });
 	 });
 	
</script>
