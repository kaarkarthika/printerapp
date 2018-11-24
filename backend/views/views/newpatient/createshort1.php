<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Create New patient';
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */


?>

<style>
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
.appointment_details .form-control {
   height: 22px !important;
    margin-right: 15px;
    margin-bottom: 0px;
    padding: 0px 10px;
    font-size: 13px;
}
.button-section {
    position: relative;
    top: -14px;
    border-top: 1px solid #cbcbcb !important;
}
.newpatient-form .form-group {
    margin-bottom: 0px;
}
.appointment_details>.col-md-12 {
    background: #fff;
    margin: 6px 27px;
    width: 95%;
    padding: 10px 10px;
    border-top: 3px solid #5fbeaa;
}
.appointment_details label {
   font-size: 12px;    float: left;
    margin-right: 10px;
}

.appointment_detail label.control-label {
    float: left;
    width: 40%;
}
.appointment_details h4 {
    font-weight: 600;
}
.headtitle h5 {
    background: #a9daff;
    padding: 5px;
    font-weight: 600;
}
input.form-inputsmall {
    width: 10% !important;
}
.card-box {
    padding: 20px;
    border: 1px solid rgba(54, 64, 74, 0.05);
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-border-radius: 5px;
    background-clip: padding-box;
    margin-bottom: 20px;
    background-color: #ffffff;
}
.form-head{
	background-color: #5fbeaa;
    color: #fff;
    padding: 5px;
}
 fieldset.scheduler-border {
    border: 1px solid #dee6e4 !important;
    padding:0 0em 0em 1em !important;
    margin: 0 0 0.5em 0 !important;
   /* -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;*/
}

    legend.scheduler-border {
        font-size: 1em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
	 legend{
		margin-bottom:2px!important;
	}
	.w-cus
	{
		width:115px!important;
	}
	.w-165{
		width:165px;
	}
	.w-140{
		width:140px!important;
	}
	.l-40{
		position:relative;
		left:40px;
	}
</style>
 
  
  
  
  
<div class="newpatient-form">
	<div class="container">
		
		<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>
		<div class="row appointment_details">
			<div class="col-sm-12">
				<div class="card-box">
					<div class="row">
					     
					
					
						 
							
							<span class="patient_details  ">
							
							
				 	        <!-- <h5 class="form-head">Patient Details</h5>		 -->
					
				 	
				 		
				 		<?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>
						<div class="row">
						 <span class="col-sm-3 pull-right l-40">
	<button class="btn-sm btn-primary">Save</button> 
	 
	<button class="btn-sm btn-primary">Clear</button>  
	<button class="btn-sm btn-primary">Refresh</button> 
  </span>
  </div>
						
					  <fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Patient Details</legend>
							  <div class="row">
								 
								<?= $form->field($model, 'mr_no')->textInput(['maxlength' => true ,'class' => ' form-control col-sm-6 w-cus', 'placeholder'=>'Mr Num','tabindex'=>331,'readonly'=>true ])->label('Mr Num') ?>
							    
							
							
						 
								
							  
							<?= $form->field($model, 'pat_inital_name')->textInput(['maxlength' => true,'class' => '  form-control col-sm-6 w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true])->label('  Inital') ?>
							 
							    <?= $form->field($model, 'patientname')->textInput(['maxlength' => true ,'class' => '  form-control col-sm-6 w-cus','placeholder'=>'Name','tabindex'=>333 ,'required'=> true])->label('Name') ?>
								 
							
							
							
							 
							   <?= $form->field($model, 'dob')->textInput(['class' => 'datepicker col-sm-6 form-control w-cus ' ,'placeholder'=>'Date of Birth','tabindex'=>334,'required'=> true])->label('DOB')   ?>
								 
								
							  
							   <?= $form->field($model, 'pat_age')->textInput(['class' => 'col-sm-6  form-control w-cus  ' ,'placeholder'=>'Age','tabindex'=>335,'required'=> true])->label('Age') ?>
							   
							     
							    <?= $form->field($model, 'pat_relation')->dropDownList([ 'wife' => 'Wife', 'mother' => 'Mother','father' => 'Father','Brother' => 'Brother'], ['prompt' => '' ,'class' => ' form-control col-sm-6 w-cus','prompt'=>'- Relation -' ,'style'=>' ','tabindex'=>336,'required'=> true])->label('Relation') ?>
								
								<?= $form->field($model, 'par_relationname')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Relation Name','tabindex'=>337 ,'required'=> true])->label('Rel Name') ?>
								 
							 </div>
							
							 <div class="row">
							 
							   
								
						 
							  <?= $form->field($model, 'pat_marital_status')->dropDownList([ 'yes' => 'YES', 'no' => 'NO'], ['prompt' => '' ,'class' => '  form-control w-cus ','prompt'=>'- Marital Status -'  ,'style'=>' ','tabindex'=>338,'required'=> true])->label('Mar Stat') ?>
							  
							
							  
							<?= $form->field($model, 'pat_sex')->dropDownList([ 'male' => 'Male', 'female' => 'Female'], ['prompt' => '' ,'class' => '  form-control w-cus','prompt'=>'- Gender -'  ,'style'=>' ','tabindex'=>339,'required'=> true])->label('Gender') ?>
							 
							
							
							  
							<?= $form->field($model, 'insurance_type_id')->dropDownList($insurancelist,['class' => '  form-control w-cus ','tabindex'=>340 ])->label('Ins Type') ?>
							 
							
							
							 
							 <?= $form->field($model, 'pat_city')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'City','tabindex'=>341 ,'required'=> true])->label('City') ?>
							 
						
						  
						<?= $form->field($model, 'pat_distict')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'District','tabindex'=>342,'required'=> true ])->label('District') ?>
						 
						<?= $form->field($model, 'pat_pincode')->textInput(['maxlength' => true ,'class' => 'col-md-3 form-control w-cus','placeholder'=>'Pincode','tabindex'=>343,'required'=> true ])->label('Pincode') ?>
						<?= $form->field($model, 'pat_phone')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'Phone Number','tabindex'=>344 ])->label('Ph Numb') ?>
						
						</div>
						
						<div class="row">
					     				    
 					     
				 			
				 	       
				 		<?= $form->field($model, 'pat_mobileno')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Mobile Number','tabindex'=>345 ,'required'=> true])->label('Mob Num') ?> 
						 
						
						  
					  <?= $form->field($model, 'pat_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>346 ])->label('Email') ?>
					  
					 <?= $form->field($model, 'pat_source')->textInput(['maxlength' => true ,'class' => '  form-control w-cus  ','placeholder'=>'Source','tabindex'=>347  ])->label('Source') ?>
					 
					 <?= $form->field($model, 'pat_education')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Education','tabindex'=>348 ])->label('Education') ?>
					 
					 
							<?= $form->field($model, 'pat_occupation')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Occupation','tabindex'=>349 ])->label('Occupation') ?>
							 
							 
					    <?= $form->field($model, 'pat_religion')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Religion' ,'style'=>'width:','tabindex'=>350 ])->label('Religion') ?>
						 <?= $form->field($model, 'pat_nationality')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Nationality','tabindex'=>351 ])->label('Nationality') ?>
					 
					 </div>
					 
					 <div class="row">
					  
					
						 
                         
					 
					   
					 
						<?= $form->field($model, 'pat_type')->dropDownList([ 'IN' => 'Inpatient', 'OUT' => 'Outpatient'], ['title'=>'Patient Type','class' => '  form-control w-cus','style'=>' ','tabindex'=>352,'required'=> true])->label('Pat Type') ?>
						 
						 
						 
						 
						 <?= $form->field($model, 'pat_address')->textInput(['maxlength' => true , 'class' => ' form-control w-cus','placeholder'=>'Address','tabindex'=>353])->label('Address') ?>
						 
						  
						</div>	
						</fieldset>
						
						<div class="row">
                        <div class="col-sm-6">						
						<fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Relative Details</legend>
						 <div class="row">
					 
    					<?= $form->field($model, 'rel_dob')->textInput(['maxlength' => true ,'data-date-format'=>"mm/dd/yyyy",'class' => ' datepicker form-control w-cus','placeholder'=>'DOB','tabindex'=>354])->label('DOB') ?>
						 
 						 
 						<?= $form->field($model, 'rel_mobile')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Mobile No','tabindex'=>355])->label('MobNum') ?> 
						  
						<?= $form->field($model, 'rel_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>356])->label('Email') ?> 
 						 
 						
 						  
					    <?= $form->field($model, 'rel_annual')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Annual Income','tabindex'=>360])->label('Ann Inc') ?> 
 						 </div>	
									
						
						
						</fieldset>
						
						 </div>	
						
						<div class="col-sm-6">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Consultant Details</legend>
							<div class="row">
    					 	<?= $form->field($model, 'con_timing')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>361,'required'=> true])->label('Timing') ?>
 						
 						<?= $form->field($model, 'con_consultant')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Consultant','tabindex'=>362,'required'=> true])->label('Consultant') ?>
 						
 					
			 				<?= $form->field($model, 'con_department')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Department','tabindex'=>363,'required'=> true])->label('Department') ?>
 						
					    <?= $form->field($model, 'con_turn')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Turn On','tabindex'=>364])->label('Turn On') ?>
						
						</div>
						</fieldset>
						
						 </div>	
						
						</div>
						
						
						
						
						<fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Financial Details</legend>
							<div class="row">
    					<?= $form->field($model, 'fin_total')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Total Amount','tabindex'=>365,'required'=> true,'readOnly'=>true])->label('Tot Amt') ?>
 						
 						<?= $form->field($model, 'fin_lessdisc_percent')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Less Disc(%)','tabindex'=>366])->label('LesDis(%)') ?>
 						
 						<?= $form->field($model, 'fin_less_discount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Less Discount','tabindex'=>367])->label('Less Disc') ?>
 						
					    <?= $form->field($model, 'fin_net_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Net Amount','tabindex'=>368])->label('Net Amt') ?>
 						 
						
							<?= $form->field($model, 'fin_paid_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Paid Amount','tabindex'=>369])->label('Paid Amt') ?>
 						
 						<?= $form->field($model, 'fin_due_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Due Amount','tabindex'=>370])->label('Due Amt') ?>
 						
 						<?= $form->field($model, 'fin_pay_mode')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Pay Mode','tabindex'=>371])->label('Pay Mode') ?>
						
						</div>
						
 						<div class="row">
					    <?= $form->field($model, 'fin_emergency')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Emergency','tabindex'=>372])->label('Emergency') ?>
						
						
						<?= $form->field($model, 'fin_discountby')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Discount By','tabindex'=>373,'required'=> true])->label('Disc By') ?>
 						
			 	
			 		<?= $form->field($model, 'fin_remarks')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Remarks','tabindex'=>374])->label('Remarks') ?>
 						
 						
			 		
			 			<?= $form->field($model, 'fin_paycategory')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Pay Category','tabindex'=>375])->label('PayCategory') ?>
 						
					    <?= $form->field($model, 'fin_cardial')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Curtial','tabindex'=>376])->label('Curtial') ?>
 						 
						<?= $form->field($model, 'fin_pancardno')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'PAN Card No','tabindex'=>377])->label('PAN No') ?>
 						
					    <?= $form->field($model, 'fin_aadhar_card')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Aadhar Card No','tabindex'=>378])->label('AadharNo') ?>
						</div>
						</fieldset>
    						
    						
    							
    						
    						
							     
					    
					
					    
					   
						
						
     
						
     
						  
						 
	
			 	
					</div>
					</br>
					 <div class="row">
					 <div class="form-group col-md-12 button-section text-right" >
				 
			        <?= Html::Button('Save', ['class' => 'btn btn-success btn-xm save_data','style'=>'position:relative;top:20px']) ?>
    			</div>	
    			</div>	
						
					</span>
				
			</div>
		</div>
		
		
		
		
		
	</div>

		 	
	</div>


  
    <?php ActiveForm::end(); ?>

</div>

<div class="modal" id='mr_modal' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Medical Record Number Generated</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" style="color:red;font-size:20px;">MR Number is <span id='show_mrnumber'> </span></div>
      </div>
      <div class="modal-footer">
        <a href='<?php echo Yii::$app->homeUrl . "?r=newpatient/index";?>' class="btn btn-xs btn-default">Go Grid</a>
        <a href='<?php echo Yii::$app->homeUrl . "?r=newpatient/createshort";?>' class="btn btn-xs btn-success">New Reg</a>
        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



 
	<script>
   $(document).ready(function(){
   	
   	$("body").addClass("fixed-left-void");
	  $("body").removeClass("fixed-left");
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");   			
    //  $(".list-unstyled > li").removeClass("active1 active");
        $(".list-unstyled").css("display","none");

   	
   	  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    
});
   	
	
	   $("[tabindex='51']").focus();
   jQuery.fn.tabEnter = function() {
		this.keypress(function(e){
		// get key pressed (charCode from Mozilla/Firefox and Opera / keyCode in IE)
		var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
		
		if(key == 13) {
		// get tabindex from which element keypressed
		
		var ntabindex = parseInt($(this).attr("tabindex")) + 1;
		
		$("[tabindex=" + ntabindex + "]").focus();
		 //alert("test");
		return false;
		}
		});
		}
		$("[tabindex]").tabEnter();


	
	$('body').on("click",'.save_data', function() 
	{	
		var form = $('#w0');
		
	    var formData = form.serialize();
	    $.ajax({
	    			type: 'POST',
			        url: form.attr("action"),
			        data: formData,
			        success: function (result) 
			        {
			        	var obj = $.parseJSON(result);
			        	
			        	if(obj[0] == 'Save')
			        	{
			        		$('#newpatient-mr_no').val(obj[1]['mr_no']);
			        		$('#newpatient-pat_inital_name').val(obj[1]['pat_inital_name']);
			        		$('#newpatient-patientname').val(obj[1]['patientname']);
			        		$('#newpatient-dob').val(obj[1]['dob']);
			        		$('#newpatient-pat_age').val(obj[1]['pat_age']);
			        		$('#newpatient-pat_relation').val(obj[1]['pat_relation']);
			        		
			        		$('#newpatient-par_relationname').val(obj[1]['par_relationname']);
			        		$('#newpatient-pat_marital_status').val(obj[1]['pat_marital_status']);
			        		$('#newpatient-pat_sex').val(obj[1]['pat_sex']);
			        		$('#newpatient-insurance_type_id').val(obj[1]['insurance_type_id']);
			        		$('#newpatient-pat_city').val(obj[1]['pat_city']);
			        		$('#newpatient-pat_distict').val(obj[1]['pat_distict']);
			        		$('#newpatient-pat_state').val(obj[1]['pat_state']);
			        		$('#newpatient-pat_pincode').val(obj[1]['pat_pincode']);
			        		$('#newpatient-pat_phone').val(obj[1]['pat_phone']);
			        		$('#newpatient-pat_mobileno').val(obj[1]['pat_mobileno']);
			        		$('#newpatient-pat_email').val(obj[1]['pat_email']);
			        		$('#newpatient-pat_source').val(obj[1]['pat_source']);
			        		$('#newpatient-pat_education').val(obj[1]['pat_education']);
			        		$('#newpatient-pat_occupation').val(obj[1]['pat_occupation']);
			        		$('#newpatient-pat_religion').val(obj[1]['pat_religion']);
			        		$('#newpatient-pat_nationality').val(obj[1]['pat_nationality']);
			        		$('#newpatient-pat_type').val(obj[1]['pat_type']);
			        		
			        		$('#newpatient-pat_address').val(obj[1]['pat_nationality']);
			        		$('#newpatient-rel_dob').val(obj[1]['rel_dob']);
			        		$('#newpatient-rel_mobile').val(obj[1]['rel_mobile']);
			        		$('#newpatient-rel_email').val(obj[1]['rel_email']);
			        		$('#newpatient-rel_qualify').val(obj[1]['rel_qualify']);
			        		$('#newpatient-rel_occupation').val(obj[1]['rel_occupation']);
			        		$('#newpatient-rel_religion').val(obj[1]['rel_religion']);
			        		$('#newpatient-rel_annual').val(obj[1]['rel_annual']);
			        		
			        		
			        		$('#newpatient-con_timing').val(obj[1]['con_timing']);
			        		$('#newpatient-con_consultant').val(obj[1]['con_consultant']);
			        		$('#newpatient-con_department').val(obj[1]['con_department']);
			        		$('#newpatient-con_turn').val(obj[1]['con_turn']);
			        		$('#newpatient-fin_total').val(obj[1]['fin_total']);
			        		$('#newpatient-fin_lessdisc_percent').val(obj[1]['fin_lessdisc_percent']);
			        		$('#newpatient-fin_less_discount').val(obj[1]['fin_less_discount']);
			        		
			        		$('#newpatient-fin_net_amount').val(obj[1]['fin_net_amount']);
			        		$('#newpatient-fin_paid_amount').val(obj[1]['fin_paid_amount']);
			        		$('#newpatient-fin_due_amount').val(obj[1]['fin_due_amount']);
			        		
			        		$('#newpatient-fin_pay_mode').val(obj[1]['fin_pay_mode']);
			        		$('#newpatient-fin_emergency').val(obj[1]['fin_emergency']);
			        		$('#newpatient-fin_discountby').val(obj[1]['fin_discountby']);
			        		$('#newpatient-fin_remarks').val(obj[1]['fin_remarks']);
			        		$('#newpatient-fin_paycategory').val(obj[1]['fin_paycategory']);
			        		$('#newpatient-fin_cardial').val(obj[1]['fin_cardial']);
			        		$('#newpatient-fin_pancardno').val(obj[1]['fin_pancardno']);
			        		$('#newpatient-fin_aadhar_card').val(obj[1]['fin_aadhar_card']);
			        		
			        		//mr number show
			        		
			        		$('#show_mrnumber').html(obj[1]['mr_no']);
			        		//$modal = $('#mr_modal');
						 	//$modal.modal('show');
						 	$('#mr_modal').modal({backdrop: 'static', keyboard: false});
						 	$(".save_data").attr("disabled", "disabled");  
			        	}
			        	else if(result == 'N')
			        	{
			        		alert('Not Done');
			        	}	
			        },
			        error: function () 
			        {
			            alert("Something went wrong");
			        }
	   		   });
	    	
    });




  }); 
  

  
   </script>
   
   <script>
   $(document).ready(function(){
	   
	  $('label.control-label').addClass('col-sm-6'); 
	  $('.form-group').addClass('w-165'); 
	  $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile, .field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').addClass('w-140'); 
	  
	   $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile,.form-group.field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').removeClass('w-165'); 
	  
	   
	  
   });
   </script>
   
   <script>
   $('[tabindex="332"]').focus();
   $('body').on("keypress",'.patient_details',function(e)
   			{
   				var keycode = (e.keyCode ? e.keyCode : e.which);
        		if(keycode == '13')
		        {
		          var ntabindex = parseInt($(this).attr("tabindex")) + 1;
		          $("[tabindex=" + ntabindex + "]").focus();
		          return false;
		        }
   			});	
   			
   			$('body').on("keyup",'.patient_details',function(e)
   			{
   				var keycode = (e.keyCode ? e.keyCode : e.which);
        		if(keycode == '8')
		        {
		          var ntabindex = parseInt($(this).attr("tabindex")) - 1;
		          $("[tabindex=" + ntabindex + "]").focus();
		          return false;
		        }
   			});	
   </script>
   