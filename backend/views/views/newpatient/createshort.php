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
	
	.btn-group.bootstrap-select.form-control.w-cus {
    padding: 0px!important;
}

.btn.dropdown-toggle.btn-default {
    padding: 1px 4px;
    width: 110px;
    font-size:12px;
}
.form-deails label.control-label.col-sm-6 {
    width: 100%;
    text-align: left;
}

.form-deails .w-165 {
    width: 33%;
    float: left;
}

.form-deails label.control-label.col-sm-6 {
    width: 100%;
    text-align: left;
}

.form-deails .w-cus {
    width: 95% !important;
}

.ucil_popup>.modal-body {
border-top: 2px solid #e2e2e2;
border-bottom: 2px solid #e2e2e2;
}

.ucil_popup>.modal-body .modal-footer {
BORDER: NONE;
}

.modal-content.ucil_popup .w-165 {
    width: 100%;
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
	<button type='button' class="btn-xs btn-primary save_data" onclick='SaveRegisterForm()'>Save</button> 
	 
	<button type='reset' class="btn-xs btn-primary"  onclick='clearForm();'>Clear</button>  
	<button type="button" class="btn-xs btn-primary" onclick='Refresh()'>Refresh</button> 
  </span>
  </div>
						
					  <fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Patient Details</legend>
							  <div class="row">
								 
								<?= $form->field($model, 'mr_no')->textInput(['maxlength' => true ,'class' => ' form-control col-sm-6 w-cus', 'placeholder'=>'Mr Num','tabindex'=>331,'readonly'=>true ])->label('Mr Num') ?>
							    
							
							
						 
								
							  
							<?= $form->field($model, 'pat_inital_name')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['maxlength' => true,'class' => '  form-control col-sm-6 w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true])->label('  Inital') ?>
							
							    <?= $form->field($model, 'patientname')->textInput(['maxlength' => true ,'class' => '  form-control col-sm-6 w-cus','placeholder'=>'Name','tabindex'=>333 ,'required'=> true])->label('Name') ?>
							
							
							
							
							 
							   <?= $form->field($model, 'dob')->textInput(['maxlength' => 10 ,'class' => ' col-sm-6 form-control w-cus ' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true,'onblur'=>'Agecalculation(this.value);'])->label('DOB')   ?>
								
								
							  
							   <?= $form->field($model, 'pat_age')->textInput(['maxlength' => 3 ,'class' => 'col-sm-6  form-control w-cus  number' ,'placeholder'=>'Age','tabindex'=>335,'required'=> true,'onchange'=>'Datecalculation(this.value);'])->label('Age') ?>
							  
							     
							    <?= $form->field($model, 'pat_relation')->dropDownList([ 'Wife' => 'Wife', 'Mother' => 'Mother','Father' => 'Father','Brother' => 'Brother','Husband' => 'Husband'], ['prompt' => '' ,'class' => ' form-control col-sm-6 w-cus','prompt'=>'- Relation -' ,'style'=>' ','tabindex'=>336,'required'=> true])->label('Relation') ?>
								
							   
								<?= $form->field($model, 'par_relationname')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Relation Name','tabindex'=>337 ,'required'=> true])->label('Rel Name') ?>
								 
								 
								 	 
							 </div>
							 <div class="row">
							 	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 	 <span  id='0' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
								 <span id='1'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
								 <span id='2'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
								 <span id='3'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
								<span id='4'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
								<span id='5'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>	
								 </div>
							 <div class="row">
							 
							   
								
						 
							  <?= $form->field($model, 'pat_marital_status')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO'], ['prompt' => '' ,'class' => '  form-control w-cus ','prompt'=>'- Marital Status -'  ,'style'=>' ','tabindex'=>338,'required'=> true])->label('Mar Stat') ?>
							  
							
							  
							<?= $form->field($model, 'pat_sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['prompt' => '' ,'class' => '  form-control w-cus','prompt'=>'- Gender -'  ,'style'=>' ','tabindex'=>339,'required'=> true])->label('Gender') ?>
							 
							
							
							
							
							 
							 <?= $form->field($model, 'pat_city')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'City','tabindex'=>340 ,'required'=> true])->label('City') ?>
							 
						
						  
						<?= $form->field($model, 'pat_distict')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'District','tabindex'=>341,'required'=> true ])->label('District') ?>
						
						<?= $form->field($model, 'pat_state')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'State','tabindex'=>342,'required'=> true ])->label('State') ?>
						 
						 
						<?= $form->field($model, 'pat_pincode')->textInput(['maxlength' => 6 ,'class' => 'col-md-3 form-control w-cus number','placeholder'=>'Pincode','tabindex'=>343,'required'=> true ])->label('Pincode') ?>
						<?= $form->field($model, 'pat_phone')->textInput(['maxlength' => 10 ,'class' => ' form-control w-cus number','placeholder'=>'Phone Number','tabindex'=>344 ])->label('Ph Numb') ?>
						
						</div>
						
						<div class="row">
						 	<span id='6' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
						 	 <span  id='7' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							 <span id='8'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	
						 </div>
						
						<div class="row">
					     				    
 					     
				 			
				 	       
				 		<?= $form->field($model, 'pat_mobileno')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile Number','tabindex'=>345 ,'required'=> true])->label('Mob Num') ?> 
						 
						
						  
					  <?= $form->field($model, 'pat_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>346 ])->label('Email') ?>
					  
					 <?= $form->field($model, 'pat_source')->textInput(['maxlength' => true ,'class' => '  form-control w-cus  ','placeholder'=>'Source','tabindex'=>347 ])->label('Source') ?>
					 
					 <?= $form->field($model, 'pat_education')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Education','tabindex'=>348 ])->label('Education') ?>
					 
					 
							<?= $form->field($model, 'pat_occupation')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Occupation','tabindex'=>349])->label('Occupation') ?>
							 
							 
					    <?= $form->field($model, 'pat_religion')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Religion' ,'style'=>'width:','tabindex'=>350 ])->label('Religion') ?>
						 <?= $form->field($model, 'pat_nationality')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Nationality','tabindex'=>351 ])->label('Nationality') ?>
					 
					 </div>
					 
					 <div class="row">
						 	<span id='9' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
						 	 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	
					 </div>
					 
					 <div class="row">
					  
					
						 
                         
					 
					   
					 
						<?= $form->field($model, 'pat_type')->dropDownList($patienttype, ['title'=>'Patient Type','class' => '  form-control w-cus','style'=>' ','tabindex'=>352,'required'=> true,'onchange'=>'Patienttypemodule(this.value);'])->label('Pat Type') ?>
						 
						 
							  
							<?= $form->field($model, 'insurance_type_id')->dropDownList($insurancelist,['prompt' => '-SELECT-' ,'class' => '  form-control w-cus','tabindex'=>353,'onchange'=>'UCIL(this.value);'])->label('Ins Type') ?>
						
						 
						 <?= $form->field($model, 'pat_address')->textInput(['maxlength' => true , 'class' => ' form-control w-cus','placeholder'=>'Address','tabindex'=>354])->label('Address') ?>
						 
						  
						</div>	
						
						 <div class="row">
						 	<span id='10' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
						 	 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	
					 	</div>
						
						</fieldset>
						
						<div class="row">
                        <div class="col-sm-6">						
						<fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Relative Details</legend>
						 <div class="row">
					 
    					<?= $form->field($model, 'rel_dob')->textInput(['maxlength' => true ,'data-date-format'=>"mm/dd/yyyy",'class' => ' datepicker form-control w-cus','placeholder'=>'DOB','tabindex'=>355])->label('DOB') ?>
						 
 						 
 						<?= $form->field($model, 'rel_mobile')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile No','tabindex'=>356])->label('MobNum') ?> 
						  
						<?= $form->field($model, 'rel_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>357])->label('Email') ?> 
 						 
 						
 						  
					    <?= $form->field($model, 'rel_annual')->dropDownList([ '< 1 Lakh' => '< 1 Lakh', '1-5 Lakh' => '1-5 Lakh','5-10 Lakh' => '5-10 Lakh' ,'10 Lakh' => '10 Lakh'],['maxlength' => true ,'class' => 'form-control w-cus','placeholder'=>'Annual Income','tabindex'=>358])->label('Ann Inc') ?> 
 						 </div>	
						 <div class="row">
						 	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						 	 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 
					 	</div>			
						
						
						</fieldset>
						
						 </div>	
						
						<div class="col-sm-6">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Consultant Details</legend>
							<div class="row">
							<?php 
								$today_date=date('Y-m-d H:i:s');
								if(date('A',strtotime($today_date)) == 'AM') { ?>	
							
    					 	<?= $form->field($model, 'con_timing')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Morning' => ['selected'=>true]],'maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
 						<?php }else if(date('A',strtotime($today_date)) == 'PM') { ?>
 						 	<?= $form->field($model, 'con_timing')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Evening' => ['selected'=>true]],'maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
 						<?php } ?>
 						
 						<?= $form->field($model, 'con_consultant')->dropDownList($physicianmaster, ['class' => '  form-control w-cus','prompt'=>'-DoctorName-'  ,'style'=>' ','tabindex'=>360,'onblur'=>'Specialization(this.value);', 'onclick' => 'Specialization(this.value);'])->label('Consultant') ?>
							
 					
			 				<?= $form->field($model, 'con_department')->dropDownList($specialistdoctor,['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Department','tabindex'=>361,'required'=> true,'readonly'=> true])->label('Department') ?>
 						
					    <?= $form->field($model, 'con_turn')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Turn On','tabindex'=>362])->label('Turn On') ?>
						
						</div>
						<div class="row">
						 	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						 	 <span id='11' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							 <span  id='12' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							
					 	</div>
						</fieldset>
						
						 </div>	
						
						</div>
						
						
						
						
						<fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Financial Details</legend>
							<div class="row">
    					<?= $form->field($model, 'fin_total')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Total Amount','tabindex'=>363,'required'=> true,'readOnly'=>true])->label('Tot Amt') ?>
 						
 						<?= $form->field($model, 'fin_lessdisc_percent')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Less Disc(%)','tabindex'=>364,'onblur'=>'Discountcalculation(this.value);'])->label('LesDis(%)') ?>
 						
 						<?= $form->field($model, 'fin_less_discount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Less Discount','tabindex'=>365,'onblur'=>'Discountflatcalculation(this.value);'])->label('Less Disc') ?>
 						
					    <?= $form->field($model, 'fin_net_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Net Amount','tabindex'=>366,'readOnly'=>true])->label('Net Amt') ?>
 						 
						
							<?= $form->field($model, 'fin_paid_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Paid Amount','tabindex'=>367,'onblur'=>'Paidflatcalculation(this.value);'])->label('Paid Amt') ?>
 						
 						<?= $form->field($model, 'fin_due_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Due Amount','tabindex'=>368,'readOnly'=>true])->label('Due Amt') ?>
 						
 					
						<?= $form->field($model, 'fin_pay_mode')->dropDownList($paymenttype,['placeholder'=>'Pay Mode','maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Pay Mode','tabindex'=>369,'readonly'=> true])->label('Pay Mode') ?>
 						
						</div>
						
						<div class="row">
						 	<span id='13' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
						 	 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span id='14'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
							 <span id='15' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
							  <span id='16' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
							   <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
					 	</div>
						
 						<div class="row">
					    
						
						<?= $form->field($model, 'fin_discountby')->dropDownList(['Both' => 'Both', 'Hospital' => 'Hospital', 'Doctor' => 'Doctor'],['prompt' => '-SELECT-' ,'maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Discount By','tabindex'=>370,'required'=> true])->label('Disc By') ?>
 						
			 	
			 		    <?= $form->field($model, 'fin_remarks')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Remarks','tabindex'=>371])->label('Remarks') ?>
 						
 						
			 		
			 			<?= $form->field($model, 'fin_paycategory')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Pay Category','tabindex'=>372])->label('PayCategory') ?>
 						
					    <?= $form->field($model, 'fin_cardial')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Curtial','tabindex'=>373])->label('Curtial') ?>
 						 
						<?= $form->field($model, 'fin_pancardno')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'PAN Card No','tabindex'=>374])->label('PAN No') ?>
 						
					    <?= $form->field($model, 'fin_aadhar_card')->textInput(['maxlength' => 12 ,'class' => '  form-control w-cus number','placeholder'=>'Aadhar Card No','tabindex'=>375])->label('AadharNo') ?>
						
							
							<?= $form->field($model, 'hide_radio_value')->hiddenInput(['maxlength' => true ])->label(false) ?>
							<?= $form->field($model, 'hide_ucil_id')->hiddenInput(['maxlength' => true ])->label(false) ?>
				 			<?= $form->field($model, 'hide_curr_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
				 			<?= $form->field($model, 'hide_ucil_issue_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
						 
						
						</div>
						</fieldset>
    						
    						
    							
    						
    						
							     
					    
					
					    
					   
						
						
     
						
     
						  
						 
	
			 	
					</div>
					</br>
					 <div class="row">
					 <div class="form-group col-md-12 text-right" >
				 
			    </div>	
    			</div>	
						
					</span>
				
			</div>
		</div>
		
		
		
		
		
	</div>

		 	
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

<!--UCIL Pop-Up-->
	
<div class="modal" id='mr_modal_ucil' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content ucil_popup">
      <div class="modal-header">
        <h5 class="modal-title">UCIL Register</h5>
      </div>
      <div class="modal-body">
      		<div class="col-md-12 text-right">
      		<div class="col-md-2 text-right">
      	   	<?= $form->field($model, 'ucilval')->radio(['label' => 'Yes', 'value' => 1,'onclick'=>'ShowyesUCIL(this.value);'])?>
      	   				
      	   </div>
      	   <div class="col-md-2 text-right">
      	    <?= $form->field($model, 'ucilval')->radio(['id'=>'newpatient-ucilval1','label' => 'No', 'value' => 0,'onclick'=>'ShowyesUCIL(this.value);'])?>
      	    </div>
      	   <div class="form-deails">
      	   	<?= $form->field($model, 'ucil_id')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'UCIL Emp ID'])->label(false) ?>
 			<?= $form->field($model, 'curr_date')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'Today Date','readOnly'=>true])->label(false) ?>
 		
 			<?= $form->field($model, 'ucil_issue_date')->textInput(['data-date-format'=>"mm/dd/yyyy",'maxlength' => true ,'class' => ' datepicker form-control w-cus number','placeholder'=>'Issue Date'])->label(false) ?>
		  </div>
      </div>
      <div class="modal-footer">
      	<span id='req_all_val' style='color: red;font-size: 12px;'>Required All Fields</span>
        <button type="button" class="btn btn-xs btn-success" onclick='SaveUCIL()'>Submit</button>
       
        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>	
</div>

  
    <?php ActiveForm::end(); ?>

</div>




 
	<script>
  	//Hide Insurance 'style'=>'pointer-events:none;', 
  	$('#newpatient-insurance_type_id').attr('style','pointer-events:none;');
  	
  
   //Show UCIL
   $('#newpatient-ucil_id').hide();
   $('#newpatient-curr_date').hide();
   $('#newpatient-ucil_issue_date').hide();
   //Req Fields
   $('#req_all_val').hide();	


	
   $(document).ready(function(){
   	
   	$("body").addClass("fixed-left-void");
	$("body").removeClass("fixed-left");
	$("#wrapper").addClass("enlarged");
    $("#wrapper").addClass("forced");   			
    $(".list-unstyled").css("display","none");
	
	
	
   	
   	  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
});
   	
	
	 $('[tabindex="332"]').focus();
   jQuery.fn.tabEnter = function() {
		this.keypress(function(e){
		// get key pressed (charCode from Mozilla/Firefox and Opera / keyCode in IE)
		var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
		
		if(key == 13) 
		{
			// get tabindex from which element keypressed	
			var ntabindex = parseInt($(this).attr("tabindex")) + 1;
			$("[tabindex=" + ntabindex + "]").focus();
			return false;
		}
		else if(key == 92)
		{
			// get tabindex from which element keypressed	
			var ntabindex = parseInt($(this).attr("tabindex")) - 1;
			$("[tabindex=" + ntabindex + "]").focus();
			return false;
		}
		});
		}
		$("[tabindex]").tabEnter();



	$("body").on('keypress', '.number', function (e) 
	{
		//if the letter is not digit then display error and don't type anything
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
		 	return false;
		}
     });

  }); 
  	
  	
  	//Saved Register Form
  	function SaveRegisterForm() 
    {
  		var pat_initial=$('#newpatient-pat_inital_name').val();
  		var pat_name=$('#newpatient-patientname').val();
  		var pat_dob=$('#newpatient-dob').val();
  		var pat_age=$('#newpatient-pat_age').val();
  		var pat_blood_rel=$('#newpatient-pat_relation').val();
  		var pat_rel=$('#newpatient-par_relationname').val();
  		var pat_mar=$('#newpatient-pat_marital_status').val();
  		var pat_gender=$('#newpatient-pat_sex').val();
  		var pat_city=$('#newpatient-pat_city').val();
  		var pat_mob_num=$('#newpatient-pat_mobileno').val();
  		var pat_type=$('#newpatient-pat_type').val();
  		var pat_cons=$('#newpatient-con_consultant').val();
  		var pat_dept=$('#newpatient-con_department').val();
  		var tot_amt=$('#newpatient-fin_total').val();
  		var tot_net=$('#newpatient-fin_net_amount').val();
  		var tot_paid=$('#newpatient-fin_paid_amount').val();
  		var tot_due=$('#newpatient-fin_due_amount').val();
  		
  		
  		var validated_array = new Array(pat_initial,pat_name,pat_dob,pat_age,pat_blood_rel,pat_rel,pat_mar,pat_gender,pat_city,pat_mob_num,pat_type,pat_cons,pat_dept,tot_amt,tot_net,tot_paid,tot_due);
  		var equality=0;
  		
  		for (var i=0; i < validated_array.length; i++) 
  		{
			if(validated_array[i] == '')
			{
				 var element = document.getElementById(''+i);
				 element.style.visibility = 'visible';
			}
			else
			{
				var element = document.getElementById(''+i);
				element.style.visibility = 'hidden';
				equality++;	
			}
		}
		
		
		if(validated_array.length == equality)
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
		        		
		        		$('#newpatient-pat_address').val(obj[1]['pat_address']);
		        		$('#newpatient-rel_dob').val(obj[1]['rel_dob']);
		        		$('#newpatient-rel_mobile').val(obj[1]['rel_mobile']);
		        		$('#newpatient-rel_email').val(obj[1]['rel_email']);
		        		$('#newpatient-rel_qualify').val(obj[1]['rel_qualify']);
		        		$('#newpatient-rel_occupation').val(obj[1]['rel_occupation']);
		        		$('#newpatient-rel_religion').val(obj[1]['rel_religion']);
		        		$('#newpatient-rel_annual').val(obj[1]['rel_annual']);
		        		
		        		
		        		$('#newpatient-con_timing').val(obj[2]['consultant_time']);
		        		$('#newpatient-con_consultant').val(obj[2]['consultant_doctor']);
		        		$('#newpatient-con_department').val(obj[2]['department']);
		        		$('#newpatient-con_turn').val(obj[2]['con_turn']);
		        		
		        		
		        		//CONSULTANT AMOUNT TABLE 
		        		$('#newpatient-fin_total').val(obj[2]['total_amount']);
		        		$('#newpatient-fin_lessdisc_percent').val(obj[2]['less_disc_percent']);
		        		$('#newpatient-fin_less_discount').val(obj[2]['less_disc_flat']);
		        		
		        		$('#newpatient-fin_net_amount').val(obj[2]['net_amt']);
		        		$('#newpatient-fin_paid_amount').val(obj[2]['paid_amt']);
		        		$('#newpatient-fin_due_amount').val(obj[2]['due_amt']);
		        		
		        		$('#newpatient-fin_pay_mode').val(obj[2]['pay_mode']);
		        		//$('#newpatient-fin_emergency').val(obj[3]['fin_emergency']);
		        		$('#newpatient-fin_discountby').val(obj[2]['disc_by']);
		        		$('#newpatient-fin_remarks').val(obj[2]['remarks']);
		        		$('#newpatient-fin_paycategory').val(obj[1]['fin_paycategory']);
		        		$('#newpatient-fin_cardial').val(obj[1]['fin_cardial']);
		        		$('#newpatient-fin_pancardno').val(obj[1]['fin_pancardno']);
		        		$('#newpatient-fin_aadhar_card').val(obj[1]['fin_aadhar_card']);
		        		
		        		//mr number show
		        		
		        		$('#show_mrnumber').html(obj[1]['mr_no']);
		        		
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
		}
		else
		{
			return false;
		}
		   	
   }
  	
  	
  	
  	
  	//Save UCIL in Another Field
  	function SaveUCIL() 
    {
  		if ($("#newpatient-ucilval").is(":checked"))
  		{
  			var UCIL_id=$('#newpatient-ucil_id').val(); 
  			var Curr_date=$('#newpatient-curr_date').val();
		   	var Issue_date=$('#newpatient-ucil_issue_date').val(); 
  			
  			$modal=$('#mr_modal_ucil');
				
  			
  			if(UCIL_id != '' && Curr_date != '' && Issue_date !='')
  			{
	  			 $.ajax({
		    			type: 'POST',
				        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/validateddate";?>",
				        data: {ucil: UCIL_id, curr_date: Curr_date, issue_date: Issue_date},
				        success: function (result) 
				        {
				    		if(result == 'OK')
				    		{ 
				    			$('#newpatient-hide_radio_value').val('YES');
				    			$('#newpatient-hide_ucil_id').val(UCIL_id);
				    			$('#newpatient-hide_curr_date').val(Curr_date);
				    			$('#newpatient-hide_ucil_issue_date').val(Issue_date);
				    			
				    			//Consultant Amount
			        			$('#newpatient-fin_total').val('150');
				        		$('#newpatient-fin_lessdisc_percent').val('0');
				        		$('#newpatient-fin_less_discount').val('0');
				        		$('#newpatient-fin_net_amount').val('150');
				        		$('#newpatient-fin_paid_amount').val('0');
				        		$('#newpatient-fin_due_amount').val('0');
				    			
				    			
				    			$modal.modal('hide');	
				    		}
				    		else if(result == 'EXP')
				    		{
				    			$('#newpatient-ucil_issue_date').val('');
				    			alert('Referral Letter is Expiry');
				    			return false;
				    		} 
				    		else if(result == 'INV')
				    		{
				    			$('#newpatient-ucil_issue_date').val('');
				    			alert('Referral Letter is Expiry');
				    			return false;
				    		}    		
				        },
				        error: function () 
				        {
				            alert("Something went wrong");
				        }
		   		   });
	   		 }
	   		 else
	   		 {
	   		 	 $('#req_all_val').delay('fast').fadeIn();
				 $('#req_all_val').delay(4000).fadeOut();
				 return false;
	   		 }
  		}
  		else if($("#newpatient-ucilval1").is(":checked"))
  		{
  			var UCIL_id=$('#newpatient-ucil_id').val(); 
  			if(UCIL_id != '')
  			{
  				$('#newpatient-hide_radio_value').val('NO');
  				$('#newpatient-hide_ucil_id').val(UCIL_id);
  				
  				//Consultant Amount
  				$('#newpatient-fin_total').val('150');
        		$('#newpatient-fin_lessdisc_percent').val('0');
        		$('#newpatient-fin_less_discount').val('0');
        		$('#newpatient-fin_net_amount').val('150');
        		$('#newpatient-fin_paid_amount').val('0');
        		$('#newpatient-fin_due_amount').val('0');
    			
  				
  				$modal.modal('hide');
  			}
  			else
  			{
  				 $('#req_all_val').delay('fast').fadeIn();
				 $('#req_all_val').delay(4000).fadeOut();
				 return false;
  			}
  			
  		}
  		else
  		{
  			alert('Required Field Need');
  			return false;
  		}
  	}
  	
  	//ShowUCIL
  	function ShowyesUCIL(data_value) 
    {
    	if(data_value == '1')
    	{
	       $('#newpatient-ucil_id').show();
		   $('#newpatient-curr_date').show();
		   $('#newpatient-ucil_issue_date').show();
		   
		    var dt=new Date();
	    	var date=dt.getDate();
	    	var month=dt.getMonth()+1;
	    	var year=dt.getFullYear();
	    	$('#newpatient-curr_date').val(date+'-'+month+'-'+year); 
    	}
    	else if(data_value == '0')
    	{
	       $('#newpatient-ucil_id').show();
		   $('#newpatient-curr_date').hide();
		   $('#newpatient-ucil_issue_date').hide();
		   
		   //$('#newpatient-ucil_id').val('');
	       $('#newpatient-curr_date').val('');
		   $('#newpatient-ucil_issue_date').val(''); 
    	}
    }
  	
  	
  	//Patient Module	
  	function UCIL(data_value) 
    {
    	if(data_value == '1')
    	{
    		//Calculation
    		$('#newpatient-fin_total').val('');
			$('#newpatient-fin_lessdisc_percent').val('');
			$('#newpatient-fin_less_discount').val('');
			$('#newpatient-fin_net_amount').val('');
			$('#newpatient-fin_paid_amount').val('');
			$('#newpatient-fin_due_amount').val('');
    		
    		//Empty value
    		$('#newpatient-hide_radio_value').val('');
			$('#newpatient-hide_ucil_id').val('');
			$('#newpatient-hide_curr_date').val('');
			$('#newpatient-hide_ucil_issue_date').val('');
    		
    		$modal=$('#mr_modal_ucil');
			$modal.modal('show');
    	}
    	else
    	{
    		//Calculation
    		$('#newpatient-fin_total').val('');
			$('#newpatient-fin_lessdisc_percent').val('');
			$('#newpatient-fin_less_discount').val('');
			$('#newpatient-fin_net_amount').val('');
			$('#newpatient-fin_paid_amount').val('');
			$('#newpatient-fin_due_amount').val('');
			
			//Empty value
    		$('#newpatient-hide_radio_value').val('');
			$('#newpatient-hide_ucil_id').val('');
			$('#newpatient-hide_curr_date').val('');
			$('#newpatient-hide_ucil_issue_date').val('');
    		
    	}
    }
  
  	//Patient Module	
  	function Patienttypemodule(data_value) 
    {
    	if(data_value == '3')
    	{
    		$('#newpatient-insurance_type_id').removeAttr('style');
    	}
    	else
    	{
    		$("#newpatient-insurance_type_id").val("");
    		$('#newpatient-insurance_type_id').attr('style','pointer-events:none;');
    		
    	}
    }
  
  
    //Date wise Age Calculation Code
   	function Agecalculation(data_date) 
    {
    	
    	if(data_date != '')
    	{
    	   var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
           var Val_date=data_date;
           var data_type=true;
           var yy;
          if(Val_date.match(dateformat))
          {
              var seperator1 = Val_date.split('/');
              var seperator2 = Val_date.split('-');

              if (seperator1.length>1)
              {
                  var splitdate = Val_date.split('/');
              }
              else if (seperator2.length>1)
              {
                  var splitdate = Val_date.split('-');
              }
              var dd = parseInt(splitdate[0]);
              var mm  = parseInt(splitdate[1]);
              yy = parseInt(splitdate[2]);
              var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
              if (mm==1 || mm>2)
              {
                  if (dd>ListofDays[mm-1])
                  {
                      alert('Invalid date format!');
                      $('#newpatient-dob').val('');
                     // data_type=false;
                      return false;
                  }
              }
              if (mm==2)
              {
                  var lyear = false;
                  if ( (!(yy % 4) && yy % 100) || !(yy % 400))
                  {
                      lyear = true;
                  }
                  if ((lyear==false) && (dd>=29))
                  {
                      alert('Invalid date format!');
                      $('#newpatient-dob').val('');
                      return false;
                  }
                  if ((lyear==true) && (dd>29))
                  {
                      alert('Invalid date format!');
                      $('#newpatient-dob').val('');
                      return false;
                  }
              }
          }
          else
          {
              alert("Invalid date format!");
			  $('#newpatient-dob').val('');
              return false;
          }
    	}
    	
    	
    	if(data_type == true)
    	{
    		getAge(yy);
    	}
    }
  	
  	
  	function getAge(dateString) 
  	{
    	var curYear = new Date().getUTCFullYear();
    	var age = parseInt(curYear - dateString);
    	$('#newpatient-pat_age').val(age);
   
	}
	
	function Datecalculation(dateString) 
	{
		if(dateString != '')
		{
			var current_date = new Date();
			var Val_date=current_date;
    		var dd = parseInt(Val_date.getUTCDate());
        	var mm  = parseInt(Val_date.getUTCMonth()+1);
        	var yy = parseInt(Val_date.getUTCFullYear());
        	var age = parseInt(yy - dateString);	
        	$('#newpatient-dob').val(dd+'-'+mm+'-'+age);	
        }	
	}
  	
  	
  	function Specialization(dateString) 
	{
		if(dateString != '')
		{
			var ins_id=$('#newpatient-insurance_type_id').val();
			var radio_val_ucil=$('#newpatient-hide_radio_value').val();
			  $.ajax({
	    			type: 'POST',
			        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/getspecialization&id=";?>"+encodeURIComponent(dateString),
			       // data: formData,
			        success: function (result) 
			        {
			        	var obj = $.parseJSON(result);
			        	if(obj[0] != '' && obj[1] != '' && obj[2] != '')
			        	{
			        		if(ins_id != '1')
			        		{
			        			if(radio_val_ucil == '')
			        			{
					        		$('#newpatient-con_department').html(obj[0]);
					        		$('#newpatient-fin_total').val(obj[2]);
					        		$('#newpatient-fin_lessdisc_percent').val('0');
					        		$('#newpatient-fin_less_discount').val('0');
					        		$('#newpatient-fin_net_amount').val(obj[2]);
					        		$('#newpatient-fin_paid_amount').val('0');
					        		$('#newpatient-fin_due_amount').val('0');
					        	}
				        	}
				        	else if(ins_id == '1')
				        	{
				        		if(radio_val_ucil != '')
			        			{
				        			$('#newpatient-con_department').html(obj[0]);
				        		}
				        		else if(radio_val_ucil == '')
				        		{
				        			alert('Fill UCIL details Properly');
				        			return false;
				        		}
				        	}
			        	}
			        },
			        error: function () 
			        {
			            alert("Something went wrong");
			        }
	   		   });
	   		}
	   		
			
	}
	
	
	//Percent Calculation
	function Discountcalculation(dateString) 
	{	
		if(dateString != '')
		{
			var total_amount=parseInt($('#newpatient-fin_total').val());
			var total_percent_disc=parseInt(dateString);
			
			//Calculation
			var calc=parseInt(total_amount*total_percent_disc);
			var div=parseInt(calc/100);
			
			$('#newpatient-fin_less_discount').val(div);
			
			//Flat Disc Cal
			var sub=total_amount-div;
			$('#newpatient-fin_net_amount').val(sub);
			//$('#newpatient-fin_less_discount').attr('readonly','readonly');
		}
	}
     
    //Flat Calculation
	function Discountflatcalculation(dateString) 
	{	
		if(dateString != '')
		{
			var total_amount=parseInt($('#newpatient-fin_total').val());
			var total_percent_disc=parseInt(dateString);		
			
			//Calculative Percent
			var calc=parseInt(total_percent_disc*100);
			var tot_amt=parseFloat(calc/total_amount);
			
			var tot_rounded=Math.ceil(tot_amt);
			$('#newpatient-fin_lessdisc_percent').val(tot_rounded);
			
			var sub=total_amount-total_percent_disc;
			$('#newpatient-fin_net_amount').val(sub);
			//$('#newpatient-fin_lessdisc_percent').attr('readonly','readonly');	
		}
	}
	
	//Flat Calculation
	function Paidflatcalculation(dateString) 
	{	
		if(dateString != '')
		{
			var net_Amt=parseInt($('#newpatient-fin_net_amount').val());
			var paid_amt=parseInt(dateString);
			
			if(net_Amt >= paid_amt)
			{
				var calc=parseInt(net_Amt-paid_amt);
				$('#newpatient-fin_due_amount').val(calc);
			}	
		}
	}
	
	//Clear Form
	function clearForm() 
	{
    	  
 	}
	
	//Refresh Form
	function Refresh() 
	{	
		window.location.reload();
	}
   </script>
   
   <script>
   $(document).ready(function(){
	   
	  $('label.control-label').addClass('col-sm-6'); 
	  $('.form-group').addClass('w-165'); 
	  $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile, .field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').addClass('w-140'); 
	  
	   $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile,.form-group.field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').removeClass('w-165'); 
	});
   </script>
   

   