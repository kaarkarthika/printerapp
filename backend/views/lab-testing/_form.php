<?php
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\LabTesting */ 
/* @var $form yii\widgets\ActiveForm */ 

?>
<?php  $form = ActiveForm::begin(['id'=>"labtesting"]); ?>
<style>
.savebtn button,.savebtn a {
    width: 110px;
 /*   float: right;*/
    margin-right: 7px;
}
body.fixed-left.widescreen div#wrapper > .footer{
	position: relative !important; 
    right: 0px;
    left: 0 !important;
}
</style>
<div class="section-cat">
	<div class="category-pannel row">
<div class="lab-testing-form">

    <div class="row"> 	
	<div class="col-sm-4"> 
		
		
	<?php if($model->isNewRecord){  ?>
		 <?php 
     
     echo $form->field($catmodel, 'category_name')->dropDownList($catgorylist,['prompt'=>'--Select Category--','required'=>true,'data-live-search'=>'true','class'=>'form-control selectpicker tabind','data-style'=>'btn-default btn-custom', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getsubcategory').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	
							  $("#labsubcategorysearch-lab_subcategory").html(data);	
                              $("#labsubcategorysearch-lab_subcategory").selectpicker("refresh");                                            
                        }
                   );'])->label('Select Category');?>
		
			 <?php }else{ ?>
			 	
			 	
			 	 <?php 
     
     echo $form->field($model, 'cat_id')->dropDownList($catgorylist,['prompt'=>'--Select Category--','required'=>true,'data-live-search'=>'true','class'=>'form-control selectpicker tabind','data-style'=>'btn-default btn-custom', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getsubcategory').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	
															$("#labsubcategorysearch-lab_subcategory").html(data);	
                                                              $("#labsubcategorysearch-lab_subcategory").selectpicker("refresh");                                            
                                                        }
                                                    );'])->label('Select Category');?>
			 	<?php } ?>
	
   	</div>
   	
   	
   	
	<div class="col-sm-4">
			
			<?php if($model->isNewRecord){  ?>
				<?= $form->field($unitmodel, 'unit_name')->dropdownlist($unitlist,['prompt'=>'Select unit','class'=>'selectpicker', 'data-live-search'=>'true',
    		 		'data-style'=>"btn-default btn-custom1"])->label('Select Unit') ?>
   			<?php }else{ ?>
   				<?= $form->field($model, 'unit_id')->dropdownlist($unitlist,['prompt'=>'Select unit','class'=>'selectpicker', 'data-live-search'=>'true',
    		 		'data-style'=>"btn-default btn-custom1"])->label('Select Unit') ?>
   			<?php }?>
   				
    </div>
    <div class="col-sm-4">
	 	<?= $form->field($model, 'hsncode')->dropdownlist($tax_grouping,['options'=>['159'=>['Selected'=>true]],'class'=>'selectpicker', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('HSN Code') ?>
    	</div>
	</div>
	<div class="row">
		<div class="col-sm-1">
		 	<?= $form->field($model, 'shortcode')->textInput(['maxlength' => true,'required' => true]) ?>
    	</div>	  
		<div class="col-sm-3">
				<?= $form->field($model, 'test_name')->textInput(['maxlength' => true,'required' => true]) ?>
					<Span class="test_msg_price" style="color:red"></span>		
		</div>
		
	
		<div class="col-sm-2">
			<?= $form->field($model, 'price')->textInput(['maxlength' => true,'required' => true,'onkeypress'=>'javascript:return isNumber(event)'])->label('Price') ?>
			<Span class="test_msg_alert" style="color:red;text-align:right;"></span>
		</div>	
		    
		
    	<div class="col-sm-2">
		 	<?= $form->field($model, 'method')->textInput(['maxlength' => true]) ?>
    	</div>
    	
    	
  		 <div class="col-sm-4">
		<?php
			$result=array('posneg' => 'Free Text', 'numeric' =>'Numeric','multichoice'=>'Multiple Choice');
			echo $form->field($model, 'result_type')->dropDownList($result,['prompt'=>'-- Select --','class'=>'result_type_val selectpicker', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true] )->label('Result Type')  ?>
    	</div>
		</div>
  	<div class="row">
    	<div class="col-sm-4">
		 	<?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>
    	</div>
    	
    	<div class="col-sm-1" style="    position: relative;    top: 05px;">
    
       <?php 
     	if($model->isNewRecord){
     	$model->isactive = 1;
     	}?> 
    <?= $form->field($model, 'isactive', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
		])->checkbox([],false) ?>
		    
    </div>
   </div> 
  
   	<div class=" row mul_choice">
 		<div class="col-sm-2">
				<Label>Multiple Choice</label>
		</div>
		<div class="col-sm-3">
		 <button class="btn btn-primary btn-lg hide" id="mul_choice" >
       		ADD
   		</button> </div>
    	<div class="row refernce-content">
 		<div class="col-sm-12">
 	<table id="list1" class="list_val1" align="Center" border="1">
					<tr>
					  	<td>Name</td>
					  	<td>Normal Value</td>
					  	<td>Action</td>
				</tr>
				<tr>
					<td><input type='text' id="mul_text" class="mul_text" name="mul_text" /><div class="alert_msg" style="color:red"></div></td>
					 <td><input type="checkbox" name="normal" class="normal" id="normal" value=""></td>
					<td><input type='button' class="btn btn-success" value = ' +' id = 'addmuldata'></td>
				</tr>
				</table>
					
					  <table id="list" class="list_vals" align="Center">
					  	<tr>
					  		<td>Name</td><td>Normal Value</td>
					  		<td>Action</td>
					  	</tr>
    <?php  $i=1;
	      if(!empty($mulmodel)){ 
    	  foreach ($mulmodel as $key => $value) {
	 		 ?>
	 		<tr>
	 			<td><?php echo $value ->mulname ?><input type="hidden" id="hid_mul_text<?php echo $i;?>" name="hid_mul_text[]" value="<?php echo $value ->mulname ?>">	</td>
	 			<?php if($value->normal_value==1){ ?>
	 				<td><?php echo "Yes"; ?><input type="hidden" id="hid_norm<?php echo $i;?>" name="hid_norm[]" value="<?php echo $value ->normal_value ?>">	</td>
	 			<?php }else{ ?>
	 				 <td><?php echo "-"; ?><input type="hidden" id="hid_norm<?php echo $i;?>" name="hid_norm[]" value="<?php echo $value ->normal_value ?>">	</td>
	 			 <?php } ?>
	 			<td><span class="remove_li" data-toggle="tooltip" title="Remove">X</span>	</td>	
	 		</tr>	 
		<?php  $i++; }
    	}else{ 
    		?>
    		<tr class="noresult">
	 			<td colspan='8' class="noresult" > No Records	</td>
	 		</tr>
     <?php	}
    	?>
    </table> 
		 </div>
	 </div>
</div>
 	
 	
   <div class="reference_val">
  <div class="row refernce-contents">
		<div class="col-sm-2">
	<Label>Reference Value</label>
		</div>
		<div class="col-sm-3">
	 <button class="btn btn-primary btn-lg" id="myBtn" >
       ADD
    </button>
 </div> 
 </div>
 
 <div class="row refernce-content">
 		<div class="col-sm-12">
 			<table class="table table-bordered table-striped list_val1" id="list1" align="Center" border="1">
                        <thead>
                           <tr rowspan="2">
                       
                              <th rowspan="2" class="text-center refname">Reference Name <input type="checkbox" id="reference_name_check" class="reference_name_check" name="reference_name_check" value="">  </th>
                              <th rowspan="2" class="text-center gen">Gender <input type="checkbox" class="gender_check" id="gender_check" name="gender_check" value=""> </th>
                              <th colspan="2" class="text-center ref_age_check">Age <input type="checkbox" class="age_check" id="age_check" name="age_check" value=""> </th>
                       
                              <th colspan="2" class="text-center agefrom_ch"> Range </th>
                              <th rowspan="2" class="text-center ageto_ch">Action</th>
                           </tr>
                            <tr>                                      
                                                                    
                              <th colspan=" " class="text-center ref_age_check">From </th>
                              <th colspan=" " class="text-center ref_age_check">To</th>
                       
                              <th colspan=" " class="text-center">From <input type="checkbox" id="rangefrom_check" class="rangefrom_check" name="rangefrom_check" value=""> </th>
                              <th colspan=" " class="text-center">To <input type="checkbox" id="rangeto_check" class="rangeto_check" name="rangeto_check" value=""> </th>                                                                                
                           </tr>
                        	<tr>
                       
					<td><input type='text' id="idea" class="idea" name="idea" /></td>
					<td class="gen"><select name="gender" id="gender" class="refval bootstrap-select btn-group dropdown-toggle filter-option" >
						  <option value="">-- Select --</option>	
						  <option value="male">Male</option>
						  <option value="female">Female</option>
						  <option value="both">Both</option>
						</select>
					</td>
				 	<td class="ref_age_check"><input type='text' id="age" class="age" name="age" onkeypress="javascript:return isNumber(event)"  />
				 		<select name="agefrom_cal" id="agefrom_cal" class="refval bootstrap-select btn-group dropdown-toggle filter-option" >
						  <option value="">-- Select --</option>	
						  <option value="Day">Days</option>
						  <option value="Month">Month</option>
						  <option value="Year">Year</option>
						</select>
				 	</td>
				 	<td class="ref_age_check"><input type='text' id="range" class="range" name="range" onkeypress="javascript:return isNumber(event)"  />
				 		<select name="ageto_cal" id="ageto_cal" class="refval bootstrap-select btn-group dropdown-toggle filter-option" >
						  <option value="">-- Select --</option>	
						  <option value="Day">Days</option>
						  <option value="Month">Month</option>
						  <option value="Year">Year</option>
						</select>
				 	</td>
					<td><input type='text' id="range_from" class="range_from" name="range_from" onkeypress="javascript:return isNumber(event)" />	</td>
					<td><input type='text' id="range_to" class="range_to" name="range_to" onkeypress="javascript:return isNumber(event)"  /></td>
					<td>	<input type='button' class="btn btn-success" value = ' +' id = 'adddata'></td>
				</tr>
                        </thead>
                        <tbody id="fetch_update_data">
                          
                        </tbody>
                     </table>
 
				
					<div class="alert_msg" style="color:red"></div>
					  <table id="list" class="table table-bordered table-striped list_val" align="Center" border="1">
					  	<thead>
						  <tr rowspan="2">
						  	
                              <th rowspan="2" class="text-center refname">Reference Name</th>
                              <th rowspan="2" class="text-center gen">Gender </th>
                              <th colspan="2" class="text-center ref_age_check">Age </th>
                           
                              <th colspan="2" class="text-center"> Range </th>
                              <th rowspan="2" class="text-center">Action</th>
                           </tr>
                            <tr>                                                      
                                                        
                              <th colspan=" " class="text-center ref_age_check">From </th>
                              <th colspan=" " class="text-center ref_age_check">To</th>
                                
                              <th colspan=" " class="text-center">From</th>
                              <th colspan=" " class="text-center">To  </th>                                                                                
                           </tr>
					</thead>
    <?php   $i=1; 
    if(!empty($refmodel)){ 
    	 foreach ($refmodel as $key => $value) {
	 		?>
	 		<tr>
	 				<td><?php echo $value ->reference_name ?><input type="hidden" id="hid_ref_name<?php echo $i;?>" name="hid_ref_name[]" value="<?php echo $value ->reference_name ?>">	</td>	
	 				<td style="text-transform: capitalize;" class="gen"><?php echo $value ->gender ?>	<input type="hidden" id="hid_ref_gen<?php echo $i;?>" name="hid_ref_gen[]" value="<?php echo $value ->gender ?>"></td>
	 				<td class="ref_age_check"><?php echo $value ->age ?>	<input type="hidden" id="hid_ref_age<?php echo $i;?>" name="hid_ref_age[]" value="<?php echo $value ->age ?>">
	 					<?php echo $value ->agefrom_cal	 ?>	<input type="hidden" id="hid_ref_agefrom_cal<?php echo $i;?>" name="hid_ref_agefrom_cal[]" value="<?php echo $value ->agefrom_cal ?>">
	 				</td>
	 				<td class="ref_age_check"><?php echo $value ->range ?> <input type="hidden" id="hid_ref_range<?php echo $i;?>" name="hid_ref_range[]" value="<?php echo $value ->range ?>">	
	 					<?php echo $value ->ageto_cal	 ?>	<input type="hidden" id="hid_ref_ageto_cal<?php echo $i;?>" name="hid_ref_ageto_cal[]" value="<?php echo $value ->ageto_cal ?>"></td>
	 				<td><?php echo $value ->ref_from ?>	<input type="hidden" id="hid_ref_from<?php echo $i;?>" name="hid_ref_from[]" value="<?php echo $value ->ref_from ?>"></td>
	 				<td><?php echo $value ->ref_to ?>	<input type="hidden" id="hid_ref_to<?php echo $i;?>" name="hid_ref_to[]" value="<?php echo $value ->ref_to ?>"></td>
	 			
	 			<td><span class="remove_li" data-toggle="tooltip" title="Remove">X</span>	</td>
	 		</tr>	 
		<?php  $i++;}
    	}else{ ?>
    		<tr class="noresult">
	 			<td colspan='8' class="noresult" > No Records	</td>
	 		</tr>
     <?php	}
    	?>
    </table> 
			   </div>
 </div></div>
 </div>
 
 <div class=" ">
 	<div class="col-sm-6"></div>
 	<div class="col-sm-6 savebtn">
   	<input type="hidden" name="saved_val" id='saved_val'>
   	<a href="<?php echo Yii::$app->homeUrl .'?r=lab-testing/index'?>" class="btn btn-primary b-width btn btn-bk b-width pull-right" >Grid </a>
   	 
 <button type="reset" class="btn inp btn-default b-width clearform pull-right" onclick="ClearForm();">Clear</button>
    	<?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right savecategory' : 'btn btn-primary pull-right updatecategory']) ?>
    	<!-- <button type="button" class="btn  btn-sm btn-success save_billing" id="saves_sucess" onclick="savesdata();">Save</button> -->
    <span id="loadtex" style="display: none; "></span>
    </div>
</div>
    
</div></div>
	</div>
 <?php ActiveForm::end(); ?>
<style>
.result_type{
	display:none
}
input#adddata,#addmuldata {
    width: 34px;
}
.mul_choice table#list1, .mul_choice table#list,.posneg table#list1, .posneg table#list {
    width: 30%;
    margin: 20px;
}
.panel-border .panel-body {
    	min-height: 410px !important;
	}
.row.refernce-contents {
    margin-top: 10px;
}
select#gender,select#agefrom_cal,select#ageto_cal{
	    width: 80px !important;
	        float: right;     padding: 2px 0;
}
.refernce-content input {
    width: 135px;     float: Left; 
}
.btn-custom.btn-default{
	    color: #fff !important;
	}
table#list tbody tr:nth-child(odd) td {
    background: #e2e2e2 !important;
 }
table#list tbody>tr:first-child td {
    background: #ff8f8f;
    
}
button#myBtn{display:none;}
.lab-testing-update .refernce-content{display:block}

.modal .modal-dialog .modal-content .modal-footer{    border: none;}
button#myBtn {
    padding: 5px 10px;
    font-size: 14px;
}
table#list1, table#list {
    width: 100%;
    text-align: center;     margin-bottom: 25px;
}
table#list1 td,table#list td {
    padding: 7px 7px;
}
.modal .modal-dialog .modal-content .modal-body{
	margin-top: 20px;
}
span.remove_li {
    cursor: pointer;
    background: #f00;
    padding: 4px 8px;
    border-radius: 6px;
    color: #fff;
}
table#list,table#list td {
    border: 1px solid #b5b5b5;
    background: #fff;
}
table#list1 {
    border: 1px solid #dadada;
}
.posneg,.reference_val,.mul_choice{
	    display: none;
}
.row.posneg {
    padding: 20px 2px;
}
input#labtestingsearch-price {
    text-align: right;
}
input#labtesting-price {
    text-align: right;
}
.refernce-content input[type="checkbox"] {
   	 	float: left;
    	width: 20px;
	} 
table#list thead th,table#list1 thead th {
    background: #4682b4;
    border: 1px solid #fff;
    color: #fff;
}
table#list tbody tr:nth-child(odd) {
    background: #fff;
}
table#list tbody tr:nth-child(even) {
    background: #eee;
}

</style>
<script>
 $(document).ready(function () {
 	
  	$("#labtestingsearch-test_name").change(function() {
 		var testname=$("input#labtestingsearch-test_name").val();
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=lab-testing/testnamecheck&testname=";?>"+testname,
	        success: function (result) 
	        {
	          if(result=="1"){
	          	alert(testname+" Already exists");
	          	$(".savecategory").css("pointer-events","none");
	          	$(".updatecategory").css("pointer-events","none");
	          	
	          } else{
	          	$(".savecategory").css("pointer-events","auto");
	          	$(".updatecategory").css("pointer-events","auto");
	          }
	        }
	    });
 	 });
 	
	if($('.result_type_val').val()=="posneg"){ 
 		$(".lab-testing-update .reference_val").css("display","none");
 		$(".lab-testing-update .mul_choice").css("display","none");
 		$(".lab-testing-update .posneg").css("display","block");
 		$(".result_type").css("display","block");
 	}else if("numeric"==$('.result_type_val').val()){
 		$(".lab-testing-update .posneg").css("display","none");
 		$(".lab-testing-update .mul_choice").css("display","none");
 		$(".lab-testing-update .reference_val").css("display","block");
 		$(".result_type").css("display","none");
 	}else{
 		$(".lab-testing-update .posneg").css("display","none");
 		$(".lab-testing-update .mul_choice").css("display","block");
 		$(".lab-testing-update .reference_val").css("display","none");
 		$(".result_type").css("display","none");
 	}
 	
 });
 
 $(".result_type_val").change(function() {
 	var result_ty=$('option:selected', $(this)).text();
 	if(result_ty=="Free Text"){
 		$(".reference_val").css("display","none");
 		$(".mul_choice").css("display","none");
 		$(".posneg").css("display","block");
 		$(".result_type").css("display","block");
 		
 	}else if(result_ty=="Numeric"){
 		$(".posneg").css("display","none");
 		$(".mul_choice").css("display","none");
 		$(".reference_val").css("display","block");
 		$(".result_type").css("display","none");
 	}
 	else{
 		$(".posneg").css("display","none");
 		$(".reference_val").css("display","none");
 		$(".mul_choice").css("display","block");
 		$(".result_type").css("display","none");
 	}
  });


	$(document).ready(function () {

    $("#myBtn").click(function(){
    	
    	var testname=$("input#labtestingsearch-test_name").val();
    	var testprice=$("input#labtestingsearch-price").val();
    	
    	if(testname=="" || testprice==""){
    		if(testname == ""){
    			 $(".test_msg_alert").html('Required');
    		}
    		if(testprice==""){
    			$(".test_msg_price").html('Required');
    		}
    	}else{
    		  $(".refernce-content").css("display","block");
    	}
		
		return false;
    });
    
    $(document).ready(function() {
    	
    	var resltype=$("#labtesting-result_type").val();
    	
    	if("numeric"==resltype){
    		$(".reference_val").css("display","block");
    		$(".mul_choice").css("display","none");
    	}else if("multichoice"==resltype){
    		$(".reference_val").css("display","none");
    		$(".mul_choice").css("display","block");
    	}else{
    	$(".reference_val").css("display","none");
    		$(".mul_choice").css("display","none");
    	}
    	
    	$(".lab-testing-update table#list1 #reference_name_check").css("display","none");
    	$(".lab-testing-update table#list1 #gender_check").css("display","none");
    	$(".lab-testing-update table#list1 #age_check").css("display","none");
    	$(".lab-testing-update table#list1 #rangefrom_check").css("display","none");
    	$(".lab-testing-update table#list1 #rangeto_check").css("display","none");
    	
    	var gen = $("#hid_ref_gen2").val();
    	var gen_va = $("#hid_ref_age2").val();
    	if(gen==""){
    		$(".gen").css("display","none");
    	}
    	if(gen_va==""){
    		$(".ref_age_check").css("display","none");
    	}

    var $fs='<?php echo $i; ?>';
    $('#adddata').click(function(){ 
    	
    	document.getElementById("reference_name_check").disabled = true;
    	document.getElementById("gender_check").disabled = true;
    	document.getElementById("age_check").disabled = true;
    	document.getElementById("rangefrom_check").disabled = true;
    	document.getElementById("rangeto_check").disabled = true;
    	
    	
	    var text = $("#idea").val();
	    $(".noresult").css("display","none");
	    var refgen = $("#gender").val();
	    var refagefrom_cal = $("#agefrom_cal").val();
	    var refageto_cal = $("#ageto_cal").val();
	    var refage = $("#age").val();
	    var refrange = $("#range").val();
	    var reffrom = $("#range_from").val();
	    var refto = $("#range_to").val();
	  
	    
	    
	    if(text!="" || refgen!="" || refagefrom_cal!="" || refageto_cal!="" || refage!="" || refrange!="" || reffrom!="" || refto!="" ){
	    		 //$fa='<input type="hidden" id="hid_val'+$fs+'" name="hid_ref_val[]" value="'+refval+'" >';
	    $fa_val='<input type="hidden" id="hid_ref_name'+$fs+'" name="hid_ref_name[]" value="'+text+'" >';
	    $fa_gen='<input type="hidden" id="hid_ref_gen'+$fs+'" name="hid_ref_gen[]" value="'+refgen+'" >';
	    $fa_agefrom_cal='<input type="hidden" id="hid_ref_agefrom_cal'+$fs+'" name="hid_ref_agefrom_cal[]" value="'+refagefrom_cal+'" >';
	    $fa_ageto_cal='<input type="hidden" id="hid_ref_ageto_cal'+$fs+'" name="hid_ref_ageto_cal[]" value="'+refageto_cal+'" >';
	    $fa_age='<input type="hidden" id="hid_ref_age'+$fs+'" name="hid_ref_age[]" value="'+refage+'" >';
	    $fa_range='<input type="hidden" id="hid_ref_range'+$fs+'" name="hid_ref_range[]" value="'+refrange+'" >';
	    $fa_ran_from='<input type="hidden" id="hid_ref_from'+$fs+'" name="hid_ref_from[]" value="'+reffrom+'" >';
	    $fa_ran_to='<input type="hidden" id="hid_ref_to'+$fs+'" name="hid_ref_to[]" value="'+refto+'" >';
	    
	    $cls='<span class="remove_li" data-toggle="tooltip" title="Remove">X</span>';	    
	    var li = "<tr><td>"+ text +$fa_val+ " </td><td class='gen' style='text-transform: capitalize'>"+refgen+$fa_gen+ "</td><td class='ref_age_check'>"+refage+refagefrom_cal+$fa_age+$fa_agefrom_cal+ " </td><td class='ref_age_check'>"+refrange+refageto_cal+$fa_range+$fa_ageto_cal+ " </td><td>"+reffrom+$fa_ran_from+ " </td><td>"+refto+$fa_ran_to+ " </td><td>" + $cls +"</td></tr>"; 
	    $(".list_val").append(li);
	     
	      if(refgen==""){
	    	$("#list .gen").css("display","none");
	    }
	    if(refage==""){
	   		$("#list .ref_age_check").css("display","none");
	   	}
	   	$fs++;
	   	 $("#idea").focus();
	    	document.getElementById('idea').value = "";
	    	document.getElementById('gender').value = "";
	    	document.getElementById('agefrom_cal').value = "";
	    	document.getElementById('ageto_cal').value = "";
	    	document.getElementById('age').value = "";
	    	document.getElementById('range').value = "";
	    	document.getElementById('range_from').value = "";
	    	document.getElementById('range_to').value = "";
	    		
	    }else{
	    		alert("Required..");
	    }
	});
	
	  $('#addmuldata').click(function(){
	    var text = $("#mul_text").val();
	   	if($("#normal"). prop("checked") == true){
				var norm="1";
		}
		else if($("#normal").prop("checked") == false){
				var norm="0";
		}
		
 	    $(".noresult").css("display","none"); 
	    if(text!=""){
	    	$fa_multext='<input type="hidden" id="hid_mul_text'+$fs+'"name="hid_mul_text[]" value="'+text+'" >';
	    	if(norm==1){
	    		$fa_normal='<input type="hidden" id="hid_norm'+$fs+'"name="hid_norm[]" value="'+norm+'" >';
	    		var norm_val="Yes";
	    	}else{
	    		$fa_normal='<input type="hidden" id="hid_norm'+$fs+'"name="hid_norm[]" value="'+norm+'" >';
	    		var norm_val="-";
	    	}
	    	$cls='<span class="remove_li" data-toggle="tooltip" title="Remove">X</span>';
	   		var li = "<tr><td>"+ text +$fa_multext+ " </td><td>"+norm_val+ $fa_normal+ " </td><td>" + $cls +"</td></tr>"; 

	    $(".list_vals").append(li); 
	   	 $fs++; $( "#mul_text" ).focus();
	      document.getElementById('mul_text').value = "";
	        document.getElementById("normal").checked = false;
	    }else{
	    	  document.getElementById('mul_text').value = "";
	    	  document.getElementById('normal').value = "";
	    	  document.getElementById("normal").checked = false;
	    	$(".alert_msg").html("Required");
			$( "#mul_text" ).focus();
	    }
	});

   $('body').on('click','.remove_li', function(){ 	
    	$(this).closest('tr').remove();
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    }) 
});
});

/*$('#labtesting-form').on('beforeSubmit', function(e) {
		
	$("#load").show();
    $(".savecategory").attr('disabled','disabled');
    var form = $(this);
    var formData = form.serialize();
    
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
}); */

function savesdata(){
	
	var testname=$("#labtestingsearch-test_name").val();
	
	if(testname!=""){
				if (confirm('Are You Sure to Lab Test ?')) {
				$.ajax({
		            type: "POST",
		            url: "<?php echo Yii::$app->homeUrl . "?r=lab-testing/create";?>",
		            data: $("form#labtesting").serialize(),
		            success: function (result) 
		            { 
		            	var obj = $.parseJSON(result); //alert(obj[0]);alert(obj[1]);
		            	if(obj[0] === 'saved')
		            	{
                   			$("#saved_val").val(obj[1]);
		            		$('.save_billing').attr('disabled','disabled');
		            	}else if(obj[0] === 'notsave'){
		            		alert("Amount Value is Zero, So Not Saved ..");
		            		$("#saved_val").val(obj[1]);
		            		
		            	}
		            }
				});
		}		
	}else{
		alert("Lab Test Name is Required..");
	}
	$('#labtestingsearch-test_name').focus();
}


function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    } 
    
      $('.reference_name_check').click(function(){
      	  if($("#reference_name_check").prop('checked') == true){
      	 	 	$('#idea').prop('readonly', true);
      			document.getElementById("idea").value = "";
      	  }else{
      	  		$('#idea').prop('readonly', false);
      	  }
      	  
      		
      }); 
      	
      $('.gender_check').click(function(){
      	 if($("#gender_check").prop('checked') == true){
      	 	$('#gender').prop('readonly', true);
      		 document.getElementById("gender").disabled = true;
      		 document.getElementById("gender").value = "";
      	 }else{
      	 	  $('#gender').prop('readonly', false);
      	 	 document.getElementById("gender").disabled = false;
      	 }
      	 
      });	
     $('.age_check').click(function(){
     	if($("#age_check").prop('checked') == true){
     		document.getElementById("agefrom_cal").disabled = true;
     		$('#age').prop('readonly', true);
      		$('#agefrom_cal').prop('readonly', true);
      	 	$('#range').prop('readonly', true);
      	 	$('#ageto_cal').prop('readonly', true);
      		 document.getElementById("ageto_cal").disabled = true;
	      	 document.getElementById("age").value = "";
     	 	 document.getElementById("agefrom_cal").value = "";
      		 document.getElementById("range").value = "";
      		 document.getElementById("ageto_cal").value = "";
     	}
     	else{
     			$('#age').prop('readonly', false);
      			$('#agefrom_cal').prop('readonly', false);
      	 		$('#range').prop('readonly', false);
      	 		$('#ageto_cal').prop('readonly', false);
     			document.getElementById("ageto_cal").disabled = false;
     			document.getElementById("agefrom_cal").disabled = false;
     	}
      	 
      });
      $('.rangefrom_check').click(function(){
      	if($("#rangefrom_check").prop('checked') == true){
      		$('#range_from').prop('readonly', true);
      	 	document.getElementById("range_from").value = "";
      	}else{
      		$('#range_from').prop('readonly', false);
      	}
      	 
      }); 	  
      $('.rangeto_check').click(function(){
      	if($("#rangeto_check").prop('checked') == true){
      		$('#range_to').prop('readonly', true);
      	 	document.getElementById("range_to").value = "";
      	}else{
      		$('#range_to').prop('readonly', false);
      	}
      	 
      }); 	   
      
      $('#agefrom_cal').change(function(){
      	
  		var agefrom_cal=document.getElementById("agefrom_cal").value;
  		if("Day"==agefrom_cal){
  			document.getElementById("ageto_cal").value =agefrom_cal;
  		}else if("Month"==agefrom_cal){
  			document.getElementById("ageto_cal").value =agefrom_cal;
  			//$("#ageto_cal option[value='Day']").remove();
  		}else if("Year"==agefrom_cal){
  			document.getElementById("ageto_cal").value =agefrom_cal;
  			/*$("#ageto_cal option[value='Day']").remove();
  			$("#ageto_cal option[value='Month']").remove();*/
  		}	    	
      });
      
  $(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) 
    {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's': 
              event.preventDefault();
            var  saved_val = $("#saved_val").val(); 
              	if(saved_val==""){
              		  savesdata();
            	}else{ 
              		alert("already Saved");
            	}	
            	break;
        case 'f':
            event.preventDefault();
          	  remove_all();
            alert('ctrl-f');
            break;
        case 'g':
            event.preventDefault();
            alert('ctrl-g');
            break;
        case 'c':
            event.preventDefault();
           	RemoveAll();
            break;
        }
    }
});    
function ClearForm () {
  $("#labcategorysearch-category_name").val('');
  $("#labunitsearch-unit_name").val('');
  $("#labtestingsearch-hsncode").val('');
  $("#labtestingsearch-test_name").val('');
  $("#labtestingsearch-price").val('');
  $("#labtestingsearch-method").val('');
  $("#labtestingsearch-result_type").val('');
  $("#labtestingsearch-description").val('');
  window.location.reload(true);
}



       
</script>
 
