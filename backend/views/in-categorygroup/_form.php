<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategorygroup */
/* @var $form yii\widgets\ActiveForm */
//	echo"<pre>";print_r($room_typeval); die;
?>

<div class="in-categorygroup-form" style="min-height:350px">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
    	<div class="col-md-3">
    		<!-- <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?> -->
    		<?php	if(!empty($roomtype_list)){
			?>
			<?= $form->field($model, 'category_id')->dropdownlist($category_list,['prompt'=>'Select Category ','data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'class' =>"selectpicker" , 'required' => true])->label('Select Category') ?>
		 <?php }  ?> 
    	</div>
    	<div class="col-md-3">
			<!-- <?= $form->field($model, 'room_typeid')->textInput(['maxlength' => true]) ?> -->
		<?php	if(!empty($roomtype_list)){
			?>
			<?= $form->field($model, 'room_typeid')->dropdownlist($roomtype_list,['prompt'=>'Select Room ','data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'class' =>"selectpicker" , 'required' => true])->label('Select Room') ?>
		 <?php }  ?> 
    	</div>
    	<div class="col-md-2">
    		<label style="visibility: hidden;width: 100%;"> TEST </label>
    		<input type='button' class="btn btn-success" value = ' +' id = 'addmuldata'>
    	</div>	
    	<div class="col-md-3">
    			<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     		<?= $form->field($model, 'is_active', [
    		'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
			])->checkbox([],false) ?>
    	</div>	
    
    </div>	
  <div class="row">
		
		<table id="list1" class="table table-bordered table-striped list_val1" align="left" border="1">
			<thead>
					<tr>
					  	<td style="width: 40%;"></td>
					  	<td style="width: 30%;text-align:center">HSN Code</td>
					  	<td style="width: 30%;text-align:center">Price</td>
					</tr>
			</thead>
			
			<tbody>
				<tr>
					<td>Doctor Visit</td>
					<td> 
			<div class="hsncode" id="hsncode" >
				
			<select id="hsncode_dr" class="selectpicker hsncode_dr " name="hsncode_dr" style="color: #fff !important;" size="4"  data-style="btn-default btn-custom cus-fld" required="required" data-live-search="true" aria-required="true" tabindex="-98" aria-invalid="false"  >
			<?php
    		if(!empty($tax_grouping)){
    				 foreach($tax_grouping as $key => $value ){
    				 	 
    				 	 if($room_typeval['2']==$value){ ?> 
    				 	<option value="<?php echo $key; ?>" selected ><?php echo $value;?></option>
    				 <?php }else{ ?>
						<option value="<?php echo $key; ?>"><?php echo $value;?></option>	
				<?php } } }
				    	
				?>
    	  </select>
    		</div>
					</td>
					<td><input type='text' id="dr_price" style='text-align:right' class="dr_price price_value" onkeyup="price_val" name="dr_price" required="required" onkeypress="javascript:return isNumber(event)" value="<?php echo $cat_ref['dr_visit_price']; ?>" /></td>
				</tr>
				<tr>
					<td>Nurse Charge</td>
					<td>	
						<div class="hsncode" id="hsncode" >	
						<select id="hsncode_nurse" class="selectpicker hsncode_nurse" name="hsncode_nurse" required="required" style="color: #fff !important;" size="4" data-style="btn-default btn-custom cus-fld" data-live-search="true" aria-required="true" tabindex="-98" aria-invalid="false" required >
						<?php  
			    		if(!empty($tax_grouping)){  
			    				 foreach($tax_grouping as $key => $value ){ 
			    				 	if($room_typeval['3']==$value){  ?>
			    				 		<option value="<?php echo $key; ?>" selected><?php echo $value;?></option>
			    				<?php 	} else{  
			    				 	?>
								<option value="<?php echo $key; ?>"><?php echo $value;?></option>	
							<?php } } } ?>
			    	  
			    		</select> </div>
			    	</td>
					<td><input type='text' style='text-align:right' id="nurse_price" onkeyup="price_val" class="nurse_price price_value" name="nurse_price" required="required" onkeypress="javascript:return isNumber(event)" value="<?php echo $cat_ref['nurse_price']; ?>" /></td>
					
				</tr>
				<tr>
					<td>Room Price</td>
					<td><input type='text' style='text-align:right' id="room_hsncode" class="room_price price_value" name="room_hsncode" required="required" readonly=""  value="<?php echo $room_typeval['1'] ?>"/></td>
					<td><input type='text' style='text-align:right' id="room_price" class="room_price price_value" name="room_price" required="required" readonly=""  value="<?php echo $room_typeval['0'] ?>" /></td>
				</tr>	
				<tr>
					<td>Total</td>
					<td></td>
					<td><input type='text' style='text-align:right' id="total" class="total" name="total" required="required" readonly=""  value="<?php echo $model->total; ?>"/></td>
				</tr>	
			</tbody>
		</table>
	</div>
	<div class="clearfix"></div>
	<hr>
	
	<div class="form-group">
      	 
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right physician' : 'btn btn-primary pull-right updatephysician']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    </div>		
    <?php ActiveForm::end(); ?>

</div>
<style>
table#list1 thead td {
    background: lightgray;
    color: #000;
    font-weight: 700;
}
table#list1{
    width: 60%;     display: none;
}
div#hsncode .btn-custom.cus-fld {
    color: #fff !important;
}
.in-categorygroup-update input#addmuldata{
	display:none;
}
</style>
<script>
	 $('#addmuldata').click(function(){
	 	$("#list1").css("display","block");
	 	
	 });	
	 	
	  $("#incategorygroup-room_typeid").change(function() {
	  	 var res_select=$('option:selected', $(this)).text();
	  	 var res_val=$('option:selected', $(this)).val();
	  //	 alert(res_select);
	  	 
	  	 $.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=in-categorygroup/getroomprice&roomtype=";?>"+res_val,
	        success: function (result) 
	        {
	        	//alert(result);
	        	var obj=jQuery.parseJSON(result);
	        	var price=parseFloat(obj['0']);
	        	var hsncode=parseFloat(obj['1']);
	        	$("input#room_hsncode").val(parseFloat(obj['1']));
	       		$("input#room_price").val(parseFloat(obj['0'])); 	
	         //alert(parseFloat(obj['price']));
	        }
	    });
	  });	
	  
	  $(".price_value").keyup(function(){
	 	 	var dr_price=parseFloat($("input#dr_price").val());
	  	 	var nur_price=parseFloat($("input#nurse_price").val());
	  	 	var room_price=parseFloat($("input#room_price").val());
	  	 	var res=(nur_price+dr_price+room_price);
	  	   $("input#total").val(res); 
		});

	  $("input#nurse_price").change(function() {
	  	 var dr_price=parseFloat($("input#dr_price").val());
	  	 var nur_price= parseFloat($(this).val());
	  	 var room_price=parseFloat($("input#room_price").val());
	  	 var res=(nur_price+dr_price+room_price);
	  	  $("input#total").val(res); 
	  	 	  	 
	  	});	
	  
</script>
