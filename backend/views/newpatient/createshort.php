<?php
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Newpatient;
use yii\helpers\Url;
//$this->title = 'Create New patient';
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */


$newpatient_city=ArrayHelper::index(Newpatient::find()->where(['!=','pat_city',''])->groupBy('pat_city')->asArray()->all(),'patientid');
/*
if(!empty($newpatient_city))
{
	foreach ($newpatient_city as $key => $value) 
	{
		$productlist_col_val[] = array('pat_city' => strtoupper($value['pat_city']),'pat_distict' => strtoupper($value['pat_distict']),'pat_state' => strtoupper($value['pat_state']));	
	}
	$productlist_col_json = json_encode($productlist_col_val);	
}
*/
$discount_autocomplete=array();
$discount_autocomplete[]=array('authority' => strtoupper("E.C Dinesh Reddy"),'reason' => strtoupper("Discount"));
$discount_autocomplete[]=array('authority' => strtoupper("E.C Gangi Reddy"),'reason' => strtoupper("Discount"));
$discount_autocomplete[]=array('authority' => strtoupper("E.C Sugunamma"),'reason' => strtoupper("Discount"));
$discount_autocomplete_json = json_encode($discount_autocomplete);

?>


<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script> 


<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />


<style>
body{
	line-height:0.7;
}
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

.field-newpatient-pat_address{
	padding-top: 10px;
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
.btn-bk {
    background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
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
	/* background-color: #5fbeaa; */
	background-color: #4682b4;
    color: #fff;
    padding: 5px;
}
 fieldset.scheduler-border {
    
    padding:0 0em 0em 1em !important;
    margin: 0 0 0.5em 0 !important;
   /* -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;*/
}

	legend.ucil-register {
		font-size: 14px !important;
		padding-right: 59.5% !important;     
		padding-left: 10% !important; 
		padding-bottom: 7px !important; 
		padding-top: 7px !important;

	}
    legend.scheduler-border {
        font-size: 1em !important;
        font-weight:normal!important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
        float: left;
    }
	 legend{
		margin-bottom:2px!important;
	}
	/*.w-cus
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
	*/
	.btn-group.bootstrap-select.form-control.w-cus {
    padding: 0px!important;
}

.btn.dropdown-toggle.btn-default {
    padding: 1px 4px;
    width: 110px;
    font-size:12px;
}
.form-deails label.control-label.col-sm-6 {
   /* width: 100%;
    text-align: left; */
}

.form-deails .w-165 {
   /* width: 33%;
    float: left;*/
}

.form-deails label.control-label.col-sm-6 {
  /*  width: 100%;
    text-align: left;*/
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

table.new_patient_table .w-165,table.new_patient_table .w-140  {
    width: 100%;
}
.new_patient_table label.control-label {
     /* width: 38%;
    text-align: right; */
}
.new_patient_table input, .new_patient_table select,.new_patient_table textarea {
    width: 50% !important;
}
.new_patient_add {
    padding: 0 00px;
    margin: 0;
    border: 1px solid #a2a2a2;
}
fieldset.scheduler-border legend.scheduler-border {
    width: 100%;
    padding: 8px 8px;
    position: relative;
    top: 0px;
    margin-bottom: 10px !important;
}
.new_patient_table td{
	border-right: 1px solid #a2a2a2;	
}
.new_patient_table td:last-child {
    border-right:none;
}
.new_patient_table fieldset.scheduler-border {
    padding: 0 !important;
}
.help-block{	display: none;}
.appointment_details label {
    width: 100%;
    text-align: center;
}
table.new_patient_table button {
    width: 84%;
    MARGIN: 3px 6px;
}
.final_det .form-group {
    margin-bottom: 10px;
}
ol.breadcrumb {
    margin-bottom: 0;
}
/*div#load1 {
    position: relative;
}
div#load1 img {
    position: absolute;
}*/

.form-group.field-newpatient-con_consultant ul.typeahead.dropdown-menu {
    position: absolute;
}

.form-group.field-newpatient-con_consultant{
   position: relative; 
}
</style>

<!--  new style -->
<style>
  .panel-border.panel-custom .panel-heading {
    background-color: #fff;
  }
  .b-width {
    width: 100%;
  }
  .no-pd.panel-body {
    padding: 0px 20px 0px 20px;
  }
  label.control-label{
	  font-size:12px!important;
  }
  .form-group {
   margin-bottom: 0px;  
   padding:0px 0px 0px 2px;
   font-size:11px!important;
}
#globalsearch.form-group{padding:0px 12px!important;}
  select.form-control{
	font-size: 11px;
	padding:0px 2px;
  }
  textarea.form-control {
    min-height: 70px;
}
label.control-label {
    color: #444;
    font-weight: normal;
}
.form-control{
	font-size:12px!important;
}
.datepicker td, .datepicker th{height:30px;}
label.error{    padding-top: 5px;
    font-size: 11px!important;}
</style>
<div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>


  
<div class=""><!-- .newpatient-form -->
  <div class="container">
	 <?php $form = ActiveForm::begin(['options' => ['class'=>' ','enctype' => 'multipart/form-data']]) ?>
	 <div class="row">
	   <!--Patient Details Begins-->
       <div class="col-sm-10">
         <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Patient Details</strong></h5></div>
	       <div class="no-pd panel-body">
	         <div class="row">
		        <div class="col-sm-4">
				  <?= $form->field($model, 'mr_no')->textInput(['maxlength' => true ,'class' => ' form-control  ', 'placeholder'=>'MR NUMBER','tabindex'=>331,'readonly'=>true ])->label('MR No') ?>
				  <span class="form-group field-newpatient-mr_no  " style='color: red;font-size: 12px;'></span>
				  <div class="row">
				    <div class="col-sm-4">
					  <?= $form->field($model, 'pat_inital_name')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['class' => 'form-control  ', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'onchange'=>'AutomaticInitial()'])->label('Name Inital') ?>
				      <span  id='0' class="form-group field-newpatient-mr_no  " style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				    </div>
				    <div class="col-sm-8">
					  <?= $form->field($model, 'patientname')->textInput(['maxlength' => true ,'style'=>'text-transform:uppercase;background-color:white;border: solid 1px #6E6E6E;height: 30px;font-size:12px; vertical-align:9px;color:blue;font-weight:bold;','class' => 'not_numbers form-control ','placeholder'=>'Patient Name','tabindex'=>333 ,'required'=> true])->label('Name') ?>
				      <span id='1'  class="form-group field-newpatient-mr_no  " style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				    </div>
				  </div>
				  
				  <div class="row">
				      <div class="col-sm-4">
					   <?= $form->field($model, 'dob')->textInput(['maxlength' => 10 ,'class' => 'datepicker_age    form-control   ' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true,  'onchange'=>'CalculateAge(this.value);'])->label('DOB')?>
				       <span id='2'  class="form-group field-newpatient-mr_no  " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
					 </div>
					<div class="col-sm-8"> 
					  <div class="row">
					<div class="col-sm-4">
					     <?= $form->field($model, 'pat_age')->textInput(['maxlength' => 3 ,'class' => '  form-control   number' ,'placeholder'=>'Year','tabindex'=>335,'required'=> true, 'onkeyup'=>'yeardatecalculation(this.value,event);'])->label('YEAR(S)') ?>				       
					 </div>
					 <div class="col-sm-4">
					     <div class="form-group field-newpatient-pat_age has-success">
							<label class="control-label" for="newpatient-pat_age">MONTH(S)</label>
							<input type="text" id="newpatient-pat_month" class="  form-control   number" name="Newpatient[pat_age]" maxlength="3" placeholder="Month" tabindex="335" required="" onkeyup="monthdatecalculation(this.value,event);" aria-invalid="false">
						</div>
					 </div>
					 <div class="col-sm-4">
					   <div class="form-group field-newpatient-pat_age has-success">
							<label class="control-label" for="newpatient-pat_age">DAY(S)</label>
							<input type="text" id="newpatient-pat_date" class="  form-control   number" name="Newpatient[pat_age]" maxlength="3" placeholder="Day" tabindex="335" required="" onkeyup="daydatecalculation(this.value,event);" aria-invalid="false">
						</div>
					 </div>
					 </div>
					  
					 </div>
					 
					 <div class="col-sm-4">
					   <span id='3'  class="form-group field-newpatient-mr_no  " style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				       
					 </div>
				    
				  </div>				  
				  <div class="row">
				     <div class="col-sm-4">
					   <?= $form->field($model, 'pat_relation')->dropDownList([ 'S/O' => 'S/O', 'D/O' => 'D/O','W/O' => 'W/O','H/O'=>'H/O','C/O'=>'C/O','Empty'=>'Empty','Sis/O'=>'Sis/O','B/O'=>'B/O','M/O'=>'M/O','F/O'=>'F/O','Self'=>'Self'], ['class' => ' form-control  ','style'=>' ','tabindex'=>336,'required'=> true,'onchange'=>'AutomaticRelation()'])->label('Relation') ?>
				       <span id='4'  class="form-group field-newpatient-mr_no  " style='color: red;font-size: 12px;visibility: hidden;'>Required</span>			  
					 </div>
					  <div class="col-sm-8">
						<?= $form->field($model, 'par_relationname')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers  form-control w-cus','placeholder'=>'Relation Name','tabindex'=>337 ,'required'=> true])->label('Relative Name') ?>
				        <span id='5'  class="form-group field-newpatient-mr_no  " style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
					  </div>
				  </div>
				  <div class="row">
				      <div class="col-sm-4">
				        <?= $form->field($model, 'pat_sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['class' => '  form-control w-cus','style'=>' ','tabindex'=>338,'required'=> true,'placeholder'=>'Gender'])->label('Gender') ?>
				        <span  id='7' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				      </div>
				      <div class="col-sm-8">
				        <?= $form->field($model, 'pat_marital_status')->dropDownList([ 'Married' => 'Married', 'Unmarried' => 'Unmarried','Widow'=>'Widow'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>339,'required'=> true,'placeholder'=>'Marital Status'])->label('Marital Status') ?>
				        <span id='6' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				      </div>			  
				  </div>  
                </div>
				<div class="col-sm-4">
				  <?= $form->field($model, 'pat_address')->textArea(['style'=>'text-transform:uppercase','rows'=>2 ,'cols'=>25,'maxlength' => true , 'class' => ' form-control w-cus','placeholder'=>'Address','tabindex'=>340,'required'=> true])->label('Address') ?>
			      <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  <div class="row">
				     <div class="col-sm-6">
						    <label class="control-label">City</label><br>  
							<div class="input-group input-group-sm">							   
								<?= $form->field($model, 'pat_city')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'onkeyup'=>'ClearCity(this.value);','class' => 'not_numbers  form-control w-cus','placeholder'=>'City','tabindex'=>341 ,'required'=> true])->label(false) ?>
								<span id='8'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;display:none;'>Required</span>						    
								<span class="input-group-btn"  >
									<button type="button" id='pat_city'  class="btn inp btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>
					</div>
				  
				   <!-- <div class="col-sm-6">
					   <?php //= $form->field($model, 'pat_city')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers  form-control w-cus','placeholder'=>'City','tabindex'=>341 ,'required'=> true])->label('City') ?>
					   <span id='8'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>						    
					</div>  
				    <div class="col-sm-6">
					   <?php //= $form->field($model, 'pat_distict')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers form-control w-cus','placeholder'=>'District','tabindex'=>342 ])->label('District') ?>
					   <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>								
					</div> -->
					
					
					 <div class="col-sm-6">
						    <label class="control-label">District</label><br>  
							<div class="input-group input-group-sm">							   
								<?= $form->field($model, 'pat_distict')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers form-control w-cus','placeholder'=>'District','tabindex'=>342 ])->label(false) ?>
								 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;display:none;'></span>							    
								<!--span class="input-group-btn"  >
									<button type="button"   class="btn inp btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span-->
							</div>
						</div>
					
				  </div>
                  <div class="row mt-10">
                  	
                  	 <div class="col-sm-6">
                  	 <?= $form->field($model, 'pat_state')->textInput(['class' => 'col-md-3 form-control w-cus','placeholder'=>'Pincode','tabindex'=>343 ])->label('State') ?>
                  	</div>	
                 	 <div class="col-sm-6">
					    <?= $form->field($model, 'pat_pincode')->textInput(['maxlength' => 6 ,'class' => 'col-md-3 form-control w-cus number','placeholder'=>'Pincode','tabindex'=>343 ])->label('Pincode') ?>
						<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>								
					 </div>		  
                 	 <div class="col-sm-6">
					    <?= $form->field($model, 'pat_phone')->textInput(['maxlength' => 10 ,'class' => ' form-control w-cus number','placeholder'=>'Phone Number','tabindex'=>344 ])->label('Phone Number') ?>
				        <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	
					    </div>	
					 <div class="col-sm-6">
					       <?= $form->field($model, 'pat_mobileno')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile Number','tabindex'=>345 ,'required'=> true])->label('Mobile Number') ?> 
				  <span id='9' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 							 	 
			  
					   </div>	 	  
				  </div>
				  </div>
				
				<div class="col-sm-4">
				 <div class="row">
				   <div class="col-sm-6">
				     <?= $form->field($model, 'pat_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>346 ])->label('Email') ?>
				     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
				   </div>
				    <div class="col-sm-6">
					   <?= $form->field($model, 'pat_source')->textInput(['maxlength' => true ,'class' => '  form-control w-cus  ','placeholder'=>'Source','tabindex'=>347 ])->label('Source') ?>
					   <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>			
					</div>
				 </div>
				   
                   <div class="row">
				     <div class="col-sm-6">
					   <label class="control-label">Education</label><br>  
					   <div class="input-group input-group-sm">							   
						  <?= $form->field($model, 'pat_education')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Education','tabindex'=>348 ])->label(false) ?>							 
						  <span class="input-group-btn"  >
							<button type="button"   class="btn inp btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
						  </span>
					   </div>
					   <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>							    
					 </div>
				   
				    <!-- <div class="col-sm-6">
					   <?php //= $form->field($model, 'pat_education')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Education','tabindex'=>348 ])->label('Education') ?>
					   <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
					</div>  -->
					<div class="col-sm-6">
					   <?= $form->field($model, 'pat_occupation')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Occupation','tabindex'=>349])->label('Occupation') ?>
					   <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>						    	
					 </div>
				  </div>
                  <div class="row">
                     <div class="col-sm-6">
					   <label class="control-label">Religion</label>  
					   <div class="input-group input-group-sm">							   
						  <?= $form->field($model, 'pat_religion')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Religion' ,'style'=>'width:','tabindex'=>350 ])->label(false) ?>
						  <span class="input-group-btn"  >
							<button type="button"   class="btn inp btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
						  </span>
					   </div>
					   <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>							 	
					 </div>                  
                     
					 <!-- <div class="col-sm-6">
					   <?php //= $form->field($model, 'pat_religion')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Religion' ,'style'=>'width:','tabindex'=>350 ])->label('Religion') ?>
					   <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>							 	
					 </div> 
					  
					  <div class="col-sm-6">
					   <?php //= $form->field($model, 'pat_nationality')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Nationality','tabindex'=>351 ])->label('Nationality') ?>
					   <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	 	
					 </div>  -->
					 
					  <div class="col-sm-6">
					   <label class="control-label">Nationality</label>   
					   <div class="input-group input-group-sm">							   
						  <?= $form->field($model, 'pat_nationality')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Nationality','tabindex'=>351 ])->label(false) ?>
						  <span class="input-group-btn"  >
							<button type="button"   class="btn inp btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
						  </span>
					   </div>
					    <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>						 	
					 </div>
					 
					 
                  </div>
				  <?= $form->field($model, 'pat_type')->dropDownList($patienttype, ['title'=>'Patient Type','class' => '  form-control w-cus','style'=>' ','tabindex'=>352,'required'=> true,'onchange'=>'Patienttypemodule(this.value);'])->label('Patient Type') ?>
				  <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
				  <?= $form->field($model, 'insurance_type_id')->textInput(['class' => 'form-control w-cus','tabindex'=>353, 'onkeyup'=>'UCIL(this.value);'])->label('Insurance Type') ?>
				  <span id='10' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>				  
				</div>
		     
	       </div>
	     </div>
       </div>
      </div>
	  <div class="col-sm-2 ucil_fields" hidden>
		 <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>UCIL Register</strong></h5></div>
	       <div class="panel-body h-235" >
	         <div class="row ">
				<div class="col-sm-12  ">
				  <div class=" " style="margin-top:8px;"> 
					<label>STATUS</label>
				  </div>
				  <div class="col-sm-6  ">
				  	<input type='hidden' name='UCILSTATUS' id='ucilstatus' />
					<?= $form->field($model, 'ucilval')->radio(['label' => 'Yes', 'value' => 1,'onclick'=>'ShowyesUCIL(this.value);','tabindex'=>354,])?>
			      </div>
				  <div class="col-sm-6  ">
				    <?= $form->field($model, 'ucilval')->radio(['id'=>'newpatient-ucilval1','label' => 'No', 'value' => 0,'onclick'=>'ShowyesUCIL(this.value);','tabindex'=>355,])?>
				  </div>
				 
			      <div class="form-deails prt-20">
	                <label id="newpatient-ucil_id_label" class="control-label">UCIL Emp ID</label>
				    <?= $form->field($model, 'ucil_id')->textInput(['class' => '  form-control w-cus','placeholder'=>'UCIL Emp ID','tabindex'=>356,])->label(false) ?>
		           <br>
				   <label id="newpatient-curr_date_label" class="control-label">Today Date</label>
				   <?= $form->field($model, 'curr_date')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'Today Date','readOnly'=>true])->label(false) ?>
					<br>
					<label id="newpatient-ucil_issue_date_label" class="control-label">Issue Date</label>
					<?= $form->field($model, 'ucil_issue_date')->textInput(['class' => ' datepicker form-control w-cus','placeholder'=>'Issue Date','onchange'=>'SaveUCIL();','tabindex'=>357])->label(false) ?>
				  </div>
			    </div>
						           <!--  <div class="modal-footer" style="margin-left: 3%; width: 94%;">
						      			<span id='req_all_val' style='color: red;font-size: 12px;'>Required All Fields</span> 
						      	  </div>  -->					    
			 </div>
		   </div>
		  </div>
	    </div>
	 </div>
	 <div class="row">
	   <div class="col-sm-4">
	     
	     <div class=" "> 
		   <div class="c panel panel-border panel-custom">
	          <div class="panel-heading"><h5 class="box-title"><strong>Consultant Details</strong></h5></div>
	            <div class="no-pd panel-body" style="padding:0px 20px 5px 20px;">
	               <div class="row">
		              <div class="col-sm-6">
					    <?php 
						 $today_date=date('Y-m-d H:i:s');
						 if(date('A',strtotime($today_date)) == 'AM') { ?>	
						<?= $form->field($model, 'con_timing')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Morning' => ['selected'=>true]],'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
						<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
		 				<?php }else if(date('A',strtotime($today_date)) == 'PM') { ?>
		 				<?= $form->field($model, 'con_timing')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Evening' => ['selected'=>true]],'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
		 				<span id='11' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
		 				<?php } ?>
 
					 
					 
					 <div class="">
						     <label class="control-label">Consultant</label><br>  
							<div class="input-group input-group-sm">							   
								<?= $form->field($model, 'con_consultant')->textInput(['class' => '  form-control w-cus ','placeholder'=>'Consultant'  ,'style'=>' ','tabindex'=>360,'required'=>true])->label(false) ?>
								
								<span class="input-group-btn"  >
									<button type="button"   class="btn inp btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>
							 <span  id='12' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;display:none;'>Required</span> 
						</div>
						
						
		 				
										
		              </div>
					  
					  
					  <div class="col-sm-6">
					   <label class="control-label">Department</label><br>  
					   <div class="input-group input-group-sm">							   
						  <?= $form->field($model, 'con_department')->textInput(['class' => '  form-control w-cus','placeholder'=>'Department','tabindex'=>361,'required'=> true,'readonly'=>true])->label(false) ?>
						  <span class="input-group-btn"  >
							<button type="button"   class="btn inp btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
						  </span>
					   </div>
					   <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
					 </div>
					  
					   <div class="col-sm-6"> 
		 				 <?= $form->field($model, 'con_turn')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Turn On','tabindex'=>362])->label('Turn On') ?>			
		              </div>
		           </div>
		        </div>
		    </div>
		 </div>
		 <div class=" "> 
		    <div class="c panel panel-border panel-custom">
	          <div class="panel-heading"><h5 class="box-title"><strong>Relative Details</strong></h5></div>
	            <div class="no-pd panel-body">
	               <div class="row">
		              <div class="col-sm-6">
					    <?= $form->field($model, 'rel_dob')->textInput(['maxlength' => true ,'data-date-format'=>"mm/dd/yyyy",'class' => ' datepicker form-control w-cus','placeholder'=>'DOB','tabindex'=>355])->label('DOB') ?>
						<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						<?= $form->field($model, 'rel_mobile')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile No','tabindex'=>356])->label('Mobile No') ?> 
					   <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	  				
		              </div>
					   <div class="col-sm-6">
					     <?= $form->field($model, 'rel_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>357])->label('Email') ?> 
		 				<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
		 				<?= $form->field($model, 'rel_annual')->dropDownList([ '< 1 Lakh' => '< 1 Lakh', '1-5 Lakh' => '1-5 Lakh','5-10 Lakh' => '5-10 Lakh' ,'10 Lakh' => '10 Lakh'],['class' => 'form-control w-cus','placeholder'=>'Annual Income','tabindex'=>358])->label('Ann Inc') ?>
		 				<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
		 						 
		              </div>
		           </div>
		        </div>
		    </div>
		 </div>
	   </div>
	   
	   <div class="col-sm-6">
	       <div class=" "> 
		    <div class="c panel panel-border panel-custom">
	          <div class="panel-heading"><h5 class="box-title"><strong>Financial Details</strong></h5></div>
	            <div class="no-pd panel-body h-249">
	               <div class="row">
		              <div clas=="col-sm-4">
					     <div class="col-sm-4">
					      <?= $form->field($model, 'fin_total')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Total Amount','tabindex'=>363,'required'=> true,'readOnly'=>true])->label('Total Amount') ?>
				 		  <span id='13' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
						  <?= $form->field($model, 'fin_lessdisc_percent')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Less Disc(%)','tabindex'=>364,'onkeyup'=>'Discountvalidated(this,event);','onblur'=>'FinalValidated(this);'])->label('Less Disc(%)') ?>
				 		  <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						  <?= $form->field($model, 'fin_less_discount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Less Discount','tabindex'=>365,'readOnly'=>true/*'onkeyup'=>'AutomaticflatValidated(this);'*/])->label('Less Discount') ?>
				 		  <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                          <?= $form->field($model, 'fin_net_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Net Amount','tabindex'=>366,'readOnly'=>true])->label('Net Amount') ?>
				 		  <span id='14'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
						  <?= $form->field($model, 'fin_paid_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','onkeyup'=>'PaidAmountCalculation(this.value);','placeholder'=>'Paid Amount','tabindex'=>367])->label('Paid Amount') ?>
				 		  <span id='15' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 											  
					   </div>
					   <div class="col-sm-4">
					      <?= $form->field($model, 'fin_due_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Due Amount','tabindex'=>368,'readOnly'=>true])->label('Due Amount') ?>
				 		  <span id='16' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
						  <?= $form->field($model, 'fin_pay_mode')->dropDownList($paymenttype,['placeholder'=>'Pay Mode','class' => '  form-control w-cus','placeholder'=>'Pay Mode','tabindex'=>369])->label('Pay Mode') ?>
						  <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						  <?= $form->field($model, 'fin_discountby')->dropDownList(['Both' => 'Both', 'Hospital' => 'Hospital', 'Doctor' => 'Doctor'],['prompt' => '-SELECT-' ,'class' => '  form-control w-cus','placeholder'=>'Discount By','tabindex'=>370])->label('Disc By') ?>
		 				  <span  class="form-group" id="validation_discount">
						  </span>
						  
					   </div>
					   <div class="col-sm-4">
					   	<?= $form->field($model, 'fin_pancardno')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'PAN Card No','tabindex'=>374])->label('PAN No') ?>
			 			  <span class="form-group"></span>
						  <?= $form->field($model, 'fin_aadhar_card')->textInput(['maxlength' => 12 ,'class' => '  form-control w-cus number','placeholder'=>'Aadhar Card No','tabindex'=>375])->label('AadharNo') ?>			
					      <span class="form-group"></span>
					      <?= $form->field($model, 'fin_remarks')->textArea(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Remarks','tabindex'=>373])->label('Remarks') ?> 		    
					   </div>
					 </div>   
		           </div>   
		        </div>
		    </div>
		 </div>
	   </div>
	   <div class="col-sm-2 prt-10">
		 <div class="c panel "><!-- /.panel-border panel-custom -->
	       <div class="panel-heading"><h5 class="box-title"><strong> </strong></h5></div>
	       <div class="panel-body h-235">
	         <div class="row prt-5">
			   <div class="col-sm-12"> 
				<!-- <button class="btn btn-success b-width save_data"  onclick="SaveRegisterForm();" >Save</button> -->
				<button type='button' class="btn b-width btn-success save_data" onclick="SaveRegisterForm();" >Save</button>
			   </div>
			   <div class="col-sm-12 mt-5"> 
				<button type='reset' class="btn btn-warning b-width clearform" onclick='ClearForm();'>Clear</button>
				<!-- <button type='reset' class="btn-xs btn-primary clearform"  onclick='ClearForm();'>Clear</button> -->
			   </div>
			   <div class="col-sm-12 mt-5"> 
				<!-- <button type="button" class="btn btn-primary b-width" onclick='Refresh()'>Refresh</button> -->
				 <button  type='button' class="inp btn btn-default b-width clearform">Close</button>
			   </div>
			   <div class="col-sm-12 mt-5">
			     <a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=newpatient/index" class="btn btn-bk b-width">Grid </a>
			   </div>
			    <div class="col-sm-12 mt-5">
			      <button  type='button' class="inp btn btn-danger b-width clearform citymaster">City Master</button>
			   </div>
			 </div>
		   </div>
		  </div>
	    </div>
	 </div>
	</div>
	 
	
	
	
	
	
	
		
		<!-- <div class="row">
			<div class="col-sm-6">
				<div class="btn-group pull-right m-t-15">
			</div>
			<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
				<ol class="breadcrumb">
			 		<li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
					 <li><a href="#"><?php echo $this->title;?></a></li>
				</ol>
			</div-->
			<!--div class="col-sm-6 text-right ">
				 
			</div 
				
		
		<div class="row appointment_details">
			<div class="col-sm-12">
				<div class="card-box">
					<div class="row">
							<span class="patient_details  ">
				 	        <!-- <h5 class="form-head">Patient Details</h5>		  
	
					<div class="row new_patient_add">	
				<div id="load1" style='display:none;text-align: center;'><img class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>
						<table class="new_patient_table" style="width:100%">
  						<tr><td style="width:22%;vertical-align: top;">
  								 <fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Patient Details</legend>
							  <div class="row">
								<?php // $form->field($model, 'mr_no')->textInput(['maxlength' => true ,'class' => ' form-control col-sm-6 w-cus', 'placeholder'=>'MR NUMBER','tabindex'=>331,'readonly'=>true ])->label('MR No') ?>
								<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
								<?php // $form->field($model, 'pat_inital_name')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['class' => 'form-control col-sm-6 w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'onchange'=>'AutomaticInitial()'])->label('Name Inital') ?>
								<span  id='0' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
								<?php // $form->field($model, 'patientname')->textInput(['maxlength' => true ,'style'=>'text-transform:uppercase;background-color:white;border: solid 1px #6E6E6E;height: 30px;font-size:12px; vertical-align:9px;color:blue;font-weight:bold;','class' => 'not_numbers form-control col-sm-6 w-cus','placeholder'=>'Patient Name','tabindex'=>333 ,'required'=> true])->label('Name') ?>
							    <span id='1'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							    <?php // $form->field($model, 'dob')->textInput(['maxlength' => 10 ,'class' => ' col-sm-6 form-control w-cus ' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true,'onblur'=>'Agecalculation(this.value);'])->label('DOB')?>
							    <span id='2'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
								<?php // $form->field($model, 'pat_age')->textInput(['maxlength' => 3 ,'class' => 'col-sm-6  form-control w-cus  number' ,'placeholder'=>'Age','tabindex'=>335,'required'=> true,'onchange'=>'Datecalculation(this.value);'])->label('Age') ?>
							    <span id='3'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							    <?php // $form->field($model, 'pat_relation')->dropDownList([ 'S/O' => 'S/O', 'D/O' => 'D/O','W/O' => 'W/O','H/O'=>'H/O','C/O'=>'C/O','Empty'=>'Empty','Sis/O'=>'Sis/O','B/O'=>'B/O','M/O'=>'M/O','F/O'=>'F/O','Self'=>'Self'], ['class' => ' form-control col-sm-6 w-cus','style'=>' ','tabindex'=>336,'required'=> true,'onchange'=>'AutomaticRelation()'])->label('Relation') ?>
								<span id='4'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
								<?php // $form->field($model, 'par_relationname')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers  form-control w-cus','placeholder'=>'Relation Name','tabindex'=>337 ,'required'=> true])->label('Relative Name') ?>
								<span id='5'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							 </div>
							  <div class="row">
								<?php // $form->field($model, 'pat_marital_status')->dropDownList([ 'Married' => 'Married', 'Unmarried' => 'Unmarried','Widow'=>'Widow'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true,'placeholder'=>'Marital Status'])->label('Marital Status') ?>
							  	<span id='6' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							  	<?php // $form->field($model, 'pat_sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['class' => '  form-control w-cus','style'=>' ','tabindex'=>339,'required'=> true,'placeholder'=>'Gender'])->label('Gender') ?>
							 	<span  id='7' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							 	<?php // $form->field($model, 'pat_city')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers  form-control w-cus','placeholder'=>'City','tabindex'=>340 ,'required'=> true])->label('City') ?>
							    <span id='8'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
							    <?php  // $form->field($model, 'pat_distict')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers form-control w-cus','placeholder'=>'District','tabindex'=>341 ])->label('District') ?>
								<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
								<?php  // $form->field($model, 'pat_state')->textInput(['style'=>'text-transform:uppercase','maxlength' => true ,'class' => 'not_numbers form-control w-cus','placeholder'=>'State','tabindex'=>342 ])->label('State') ?>
						 		<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						 		<?php  // $form->field($model, 'pat_address')->textArea(['style'=>'text-transform:uppercase','rows'=>2 ,'cols'=>25,'maxlength' => true , 'class' => ' form-control w-cus','placeholder'=>'Address','tabindex'=>354,'required'=> true])->label('Address') ?>
								<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							</div>
						</fieldset>
  							</td >
  							<td style="width:22%;padding-top:0px;vertical-align: top;padding-top:15px;">
  						<div class="row">
  								<?php // $form->field($model, 'pat_pincode')->textInput(['maxlength' => 6 ,'class' => 'col-md-3 form-control w-cus number','placeholder'=>'Pincode','tabindex'=>343 ])->label('Pincode') ?>
								<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
								<?php // $form->field($model, 'pat_phone')->textInput(['maxlength' => 10 ,'class' => ' form-control w-cus number','placeholder'=>'Phone Number','tabindex'=>344 ])->label('Phone Number') ?>
								<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
								<?php  // $form->field($model, 'pat_mobileno')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile Number','tabindex'=>345 ,'required'=> true])->label('Mobile Number') ?> 
						 		<span id='9' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
						 		<?php  // $form->field($model, 'pat_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>346 ])->label('Email') ?>
					  			<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
					  			<?php // $form->field($model, 'pat_source')->textInput(['maxlength' => true ,'class' => '  form-control w-cus  ','placeholder'=>'Source','tabindex'=>347 ])->label('Source') ?>
					 			<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
					 			<?php // $form->field($model, 'pat_education')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Education','tabindex'=>348 ])->label('Education') ?>
					 			<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
					 			<?php //  $form->field($model, 'pat_occupation')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Occupation','tabindex'=>349])->label('Occupation') ?>
						    	<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						    	<?php // $form->field($model, 'pat_religion')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Religion' ,'style'=>'width:','tabindex'=>350 ])->label('Religion') ?>
							 	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 	<?php // $form->field($model, 'pat_nationality')->textInput(['maxlength' => true ,'class' => '   form-control w-cus','placeholder'=>'Nationality','tabindex'=>351 ])->label('Nationality') ?>
							 	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 	<?php // $form->field($model, 'pat_type')->dropDownList($patienttype, ['title'=>'Patient Type','class' => '  form-control w-cus','style'=>' ','tabindex'=>352,'required'=> true,'onchange'=>'Patienttypemodule(this.value);'])->label('Patient Type') ?>
						  		<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
						  		<?php // $form->field($model, 'insurance_type_id')->textInput(['class' => 'form-control w-cus','tabindex'=>353, 'onkeyup'=>'UCIL(this.value);'])->label('Insurance Type') ?>
						 		<span id='10' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
						 	</div>
						  		 <div class="ucil_fields">
								<legend class="scheduler-border form-head ucil-register">UCIL Register</legend>
        						<!-- <h5 class="modal-title" style="margin-left: 10%; width: 88%;">UCIL Register</h5>  
        						<div class="row">
						      		<div class="col-sm-12 text-right">
									   <div class="col-sm-4" style="margin-top:8px;"> 
						      			<label>STATUS</label>
										   </div>
							      		<div class="col-sm-3 text-right">
							      			<?php // $form->field($model, 'ucilval')->radio(['label' => 'Yes', 'value' => 1,'onclick'=>'ShowyesUCIL(this.value);'])?>
							      	   	</div>
							      	    <div class="col-sm-3 text-right">
							      	    	<?php // $form->field($model, 'ucilval')->radio(['id'=>'newpatient-ucilval1','label' => 'No', 'value' => 0,'onclick'=>'ShowyesUCIL(this.value);'])?>
							      	    </div>
										
										
							      	    <div class="form-deails">
										    
							      	   		<?php // $form->field($model, 'ucil_id')->textInput(['class' => '  form-control w-cus','placeholder'=>'UCIL Emp ID'])->label(false) ?>
							 				<br><?php // $form->field($model, 'curr_date')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'Today Date','readOnly'=>true])->label(false) ?>
							 				<br><?php // $form->field($model, 'ucil_issue_date')->textInput(['class' => ' datepicker form-control w-cus','placeholder'=>'Issue Date','onblur'=>'SaveUCIL()','onmouseup'=>'SaveUCIL();',''])->label(false) ?>
									    </div>
						      		</div>
						         <div class="modal-footer" style="margin-left: 3%; width: 94%;">
						      			<span id='req_all_val' style='color: red;font-size: 12px;'>Required All Fields</span> 
						      	  </div>
					    		</div>
					     <!--  -->

	
						 <div class="row hide">
						 	
						 	 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
							 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
							<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	
					 	</div>
  								
							<!-- </td>
  							<td style="width:22%; vertical-align: top;">
  						
  							<fieldset class="scheduler-border">
  								
									<legend class="scheduler-border form-head ">Relative Details</legend>
								<div class="row">
							 		<?php // $form->field($model, 'rel_dob')->textInput(['maxlength' => true ,'data-date-format'=>"mm/dd/yyyy",'class' => ' datepicker form-control w-cus','placeholder'=>'DOB','tabindex'=>355])->label('DOB') ?>
									<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
									<?php // $form->field($model, 'rel_mobile')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile No','tabindex'=>356])->label('Mobile No') ?> 
								  	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
								  	<?php // $form->field($model, 'rel_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>357])->label('Email') ?> 
		 						 	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
		 						 	<?php // $form->field($model, 'rel_annual')->dropDownList([ '< 1 Lakh' => '< 1 Lakh', '1-5 Lakh' => '1-5 Lakh','5-10 Lakh' => '5-10 Lakh' ,'10 Lakh' => '10 Lakh'],['class' => 'form-control w-cus','placeholder'=>'Annual Income','tabindex'=>358])->label('Ann Inc') ?>
		 						 	<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
		 						 </div>	
								</fieldset>
  									<fieldset class="scheduler-border">
									<legend class="scheduler-border form-head ">Consultant Details</legend>
									<div class="row">
									<?php 
										$today_date=date('Y-m-d H:i:s');
										if(date('A',strtotime($today_date)) == 'AM') { ?>	
											<?php //= $form->field($model, 'con_timing')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Morning' => ['selected'=>true]],'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
											<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
		 								<?php }else if(date('A',strtotime($today_date)) == 'PM') { ?>
		 						 			<?php //= $form->field($model, 'con_timing')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Evening' => ['selected'=>true]],'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
		 						 			<span id='11' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
		 								<?php } ?>
		 								<?php //= $form->field($model, 'con_consultant')->textInput(['class' => '  form-control  ','placeholder'=>'Consultant'  ,'style'=>' ','tabindex'=>360,'required'=>true])->label('Consultant') ?>
		 								 <span  id='12' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
											
										<?php //= $form->field($model, 'con_department')->textInput(['class' => '  form-control w-cus','placeholder'=>'Department','tabindex'=>361,'required'=> true,'readonly'=>true])->label('Department') ?>
										<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
		 								<?php //= $form->field($model, 'con_turn')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Turn On','tabindex'=>362])->label('Turn On') ?>
									</div>
									</fieldset>
  								</td>
  								
								
								
								<td style="width:22%; vertical-align: top;">
		  							<fieldset class="scheduler-border">
									<legend class="scheduler-border form-head ">Financial Details</legend>
									<div class="row">
				    					<?php //= $form->field($model, 'fin_total')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Total Amount','tabindex'=>363,'required'=> true,'readOnly'=>true])->label('Total Amount') ?>
				 						<span id='13' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
									 	<?php //= $form->field($model, 'fin_lessdisc_percent')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Less Disc(%)','tabindex'=>364,'onkeyup'=>'Discountvalidated(this,event);','onblur'=>'FinalValidated(this);'])->label('Less Disc(%)') ?>
				 						 <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
										<?php //= $form->field($model, 'fin_less_discount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Less Discount','tabindex'=>365,'readOnly'=>true/*'onkeyup'=>'AutomaticflatValidated(this);'*/])->label('Less Discount') ?>
				 						 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
										<?php //= $form->field($model, 'fin_net_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Net Amount','tabindex'=>366,'readOnly'=>true])->label('Net Amount') ?>
				 						 <span id='14'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
										<?php //= $form->field($model, 'fin_paid_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Paid Amount','tabindex'=>367,'onkeyup'=>'Paidflatcalculation(this.value);'])->label('Paid Amount') ?>
				 						 <span id='15' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
										<?php //= $form->field($model, 'fin_due_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','placeholder'=>'Due Amount','tabindex'=>368,'readOnly'=>true])->label('Due Amount') ?>
				 						 <span id='16' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
										<?php //= $form->field($model, 'fin_pay_mode')->dropDownList($paymenttype,['placeholder'=>'Pay Mode','class' => '  form-control w-cus','placeholder'=>'Pay Mode','tabindex'=>369])->label('Pay Mode') ?>
										 <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
			 						</div>
								<div class="row final_det">
							    <?= $form->field($model, 'fin_discountby')->dropDownList(['Both' => 'Both', 'Hospital' => 'Hospital', 'Doctor' => 'Doctor'],['prompt' => '-SELECT-' ,'class' => '  form-control w-cus','placeholder'=>'Discount By','tabindex'=>370])->label('Disc By') ?>
		 						<span id="validation_discount">
						 			<!--?= $form->field($model, 'fin_paycategory')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Authority','tabindex'=>371])->label('Authority') ?>
			 						<?php //= $form->field($model, 'fin_cardial')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Reason','tabindex'=>372])->label('Reason') ?>
									!-- 			 			
					 			</span> -->
						 		    <?php //= $form->field($model, 'fin_remarks')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Remarks','tabindex'=>373])->label('Remarks') ?>
						 		    
			 						<?php //= $form->field($model, 'fin_pancardno')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'PAN Card No','tabindex'=>374])->label('PAN No') ?>
			 						
			 						<?php //= $form->field($model, 'fin_aadhar_card')->textInput(['maxlength' => 12 ,'class' => '  form-control w-cus number','placeholder'=>'Aadhar Card No','tabindex'=>375])->label('AadharNo') ?>
			 						
									<?= $form->field($model, 'hide_radio_value')->hiddenInput(['maxlength' => true ])->label(false) ?>
									
									<?= $form->field($model, 'hide_ucil_id')->hiddenInput(['maxlength' => true ])->label(false) ?>
									
						 			<?= $form->field($model, 'hide_curr_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
						 			
						 			<?= $form->field($model, 'hide_ucil_issue_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
							<!--	</div>
								</fieldset>
  							</td>
  							
							
							
							
							
							<td style="width:8%;vertical-align: top;    padding-top: 20px;">
  								<div class="row">
						 			<span class="col-sm-12 ">
										<button type='button' class="btn-xs btn-primary save_data" onclick="SaveRegisterForm();" >Save</button> 
										<button type='reset' class="btn-xs btn-primary clearform"  onclick='ClearForm();'>Clear</button>  
										<button type="button" class="btn-xs btn-primary" onclick='Refresh()'>Refresh</button> 
										<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=newpatient/index" class="btn-xs btn-primary">Back to Grid </a>
  									</span>
  								</div>
  							</td>	
  						  </tr>	
  						</table>	
					  <div>
					</div>
			 </div>
		</div>
	</div>
</div> -->
	
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
        <a href='<?php echo Yii::$app->homeUrl . "?r=newpatient/index";?>' class="btn btn-xs btn-warning">Go Grid</a>
        <a href='<?php echo Yii::$app->homeUrl . "?r=newpatient/createshort";?>' class="btn btn-xs btn-success">New Reg</a>
        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id='city_model' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">City Table</h5>
      </div>
      <div class="modal-body">
        <div class="" id="patient_history_report">
      
      <table id="city_table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>City</th>
                <th>District</th>
                <th>State</th>
            </tr>
        </thead>
        
    </table>		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--UCIL Pop-Up-->
	
<!--div class="modal" id='mr_modal_ucil' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content ucil_popup">
      <div class="modal-header">
        <h5 class="modal-title">UCIL Register</h5>
      </div>
      <div class="modal-body">
      		<div class="col-md-12 text-right">
      		<div class="col-md-2 text-right">
      	   	<?= $form->field($model, 'ucilval')->radio(['label' => 'Yes', 'value' => 1,'onclick'=>'ShowyesUCIL(this.value);'])->label('STATUS')?>
      	   				
      	   </div>
      	   <div class="col-md-2 text-right">
      	    <?= $form->field($model, 'ucilval')->radio(['id'=>'newpatient-ucilval1','label' => 'No', 'value' => 0,'onclick'=>'ShowyesUCIL(this.value);'])->label('STATUS')?>
      	    </div>
      	   <div class="form-deails">
      	   	<?= $form->field($model, 'ucil_id')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'UCIL Emp ID'])->label('Emp ID') ?>
 			<?= $form->field($model, 'curr_date')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'Today Date','readOnly'=>true])->label('Today Date') ?>
 		
 			<?= $form->field($model, 'ucil_issue_date')->textInput(['data-date-format'=>"mm/dd/yyyy",'maxlength' => true ,'class' => ' datepicker form-control w-cus number','placeholder'=>'Issue Date'])->label('Issue Date') ?>
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
</div-->

  
    <?php ActiveForm::end(); ?>
</div>
 
<script>



	$('.field-newpatient-insurance_type_id').hide();
  	//Hide Insurance 'style'=>'pointer-events:none;', 
  //	$('#newpatient-insurance_type_id').attr('style','pointer-events:none;');
   //Show UCIL
  $('#newpatient-ucil_id').hide();
    $('#newpatient-curr_date').hide();
   $('#newpatient-ucil_issue_date').hide();
   $('#newpatient-ucil_id_label').hide();
    $('#newpatient-curr_date_label').hide();
   $('#newpatient-ucil_issue_date_label').hide();
   //Req Fields
   $('#req_all_val').hide();	
   $(document).ready(function(){
   	$("body").addClass("fixed-left-void");
	$("body").removeClass("fixed-left");
	$("#wrapper").addClass("enlarged");
    $("#wrapper").addClass("forced");   			
    $(".list-unstyled").css("display","none");
  	$('.datepicker').datepicker({
    //format: 'yyyy-mm-dd',
    format: 'dd-mm-yyyy',
    //endDate: "today",
	autoclose: true,
});

$('.datepicker_age').datepicker({
    format: 'yyyy-mm-dd',
   // format: 'dd-mm-yyyy',
    endDate: "today",
	autoclose: true,
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
  	
  	
  	
  	function ClearCity(data)
  	{
  		if(data === '')
  		{
  			$('#newpatient-pat_distict').val('');
  			$('#newpatient-pat_state').val('');
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
				
  			
  			if(Curr_date !== '' && Issue_date !=='')
  			{
	  			 $.ajax({
		    			type: 'POST',
				        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/validateddate";?>",
				        data: {curr_date: Curr_date, issue_date: Issue_date},
				        success: function (result) 
				        {
				        	
				    		if(result == 'OK')
				    		{ 
				    			/*$('#newpatient-hide_radio_value').val('YES');
				    			$('#newpatient-hide_ucil_id').val(UCIL_id);
				    			$('#newpatient-hide_curr_date').val(Curr_date);
				    			$('#newpatient-hide_ucil_issue_date').val(Issue_date);
				    			
				    			//Consultant Amount
			        			$('#newpatient-fin_total').val('150');
				        		$('#newpatient-fin_lessdisc_percent').val('0');
				        		$('#newpatient-fin_less_discount').val('0');
				        		$('#newpatient-fin_net_amount').val('150');
				        		$('#newpatient-fin_paid_amount').val('0');
				        		$('#newpatient-fin_due_amount').val('150');
				    			
				    			
				    			$modal.modal('hide');	*/
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
	   		 /*else
	   		 {
	   		 	 $('#req_all_val').delay('fast').fadeIn();
				 $('#req_all_val').delay(4000).fadeOut();
				 return false;
	   		 }*/
  		}
  		else if($("#newpatient-ucilval1").is(":checked"))
  		{
  			var UCIL_id=$('#newpatient-ucil_id').val(); 
  			if(UCIL_id !== '')
  			{
  				/*$('#newpatient-hide_radio_value').val('NO');
  				$('#newpatient-hide_ucil_id').val(UCIL_id);
  				
  				//Consultant Amount
  				$('#newpatient-fin_total').val('150');
        		$('#newpatient-fin_lessdisc_percent').val('0');
        		$('#newpatient-fin_less_discount').val('0');
        		$('#newpatient-fin_net_amount').val('150');
        		$('#newpatient-fin_paid_amount').val('0');
        		$('#newpatient-fin_due_amount').val('150');*/
    			
  				
  				//$modal.modal('hide');
  			}
  			/*else
  			{
  				 $('#req_all_val').delay('fast').fadeIn();
				 $('#req_all_val').delay(4000).fadeOut();
				 return false;
  			}*/
  			
  		}
  	}

  	//Patient Type
  	
  	//ShowUCIL
  	function ShowyesUCIL(data_value) 
    {
    	if(data_value == '1')
    	{
	       $('#newpatient-ucil_id').show();
		   $('#newpatient-curr_date').show();
		   $('#newpatient-ucil_issue_date').show(); 
		   $('#newpatient-ucil_id_label').show();
		   $('#newpatient-curr_date_label').show();
		   $('#newpatient-ucil_issue_date_label').show();
		   
		    var dt=new Date();
	    	var date=dt.getDate();
	    	var month=dt.getMonth()+1;
	    	var year=dt.getFullYear();
	    	$('#newpatient-curr_date').val(date+'-'+month+'-'+year); 
	    	
	    	//UCIL Required Fields
	    	$('#newpatient-ucil_id').attr('required','required');
	    	$('#newpatient-ucil_issue_date').attr('required','required');
	    	
	    	$('#newpatient-ucilval').attr('required','required');
	    	$('#newpatient-ucilval1').removeAttr('required','required');	
	    	
	    	$('#ucilstatus').val('1');
	    }
    	else if(data_value == '0')
    	{
	       $('#newpatient-ucil_id').show();
	       $('#newpatient-ucil_id_label').show();
		   $('#newpatient-curr_date').hide();
		   $('#newpatient-curr_date_label').hide();
		   $('#newpatient-ucil_issue_date').hide();
		   $('#newpatient-ucil_issue_date_label').hide();
		   
		   //$('#newpatient-ucil_id').val('');
	       $('#newpatient-curr_date').val('');
		   $('#newpatient-ucil_issue_date').val(''); 
		   
		   //UCIL Required Fields
	    	$('#newpatient-ucil_id').attr('required','required');
	    	$('#newpatient-ucil_issue_date').removeAttr('required','required');
	    	
	    	
	    	$('#newpatient-ucilval').removeAttr('required','required');
    		$('#newpatient-ucilval1').attr('required','required');
    		
    		$('#ucilstatus').val('0');
    	}
    }
  	
  	
  	//Patient Module	
  	$('.ucil_fields').hide();
  	function UCIL(data_value) 
    {
    	if(data_value === 'UCIL')
    	{
    		//Calculation
    		$('.ucil_fields').show();
    		$('#newpatient-fin_total').val('');
			$('#newpatient-fin_lessdisc_percent').val('');
			$('#newpatient-fin_less_discount').val('');
			$('#newpatient-fin_net_amount').val('');
			$('#newpatient-fin_paid_amount').val('');
			$('#newpatient-fin_due_amount').val('');
    		
    	/*	//Empty value
    		$('#newpatient-hide_radio_value').val('');
			$('#newpatient-hide_ucil_id').val('');
			$('#newpatient-hide_curr_date').val('');
			$('#newpatient-hide_ucil_issue_date').val('');*/
    		
    		//$modal=$('#mr_modal_ucil');
			//$modal.modal('show');
    	}
    	else
    	{
    		//Calculation
    		$('.ucil_fields').hide();
    		$('#newpatient-fin_total').val('');
			$('#newpatient-fin_lessdisc_percent').val('');
			$('#newpatient-fin_less_discount').val('');
			$('#newpatient-fin_net_amount').val('');
			$('#newpatient-fin_paid_amount').val('');
			$('#newpatient-fin_due_amount').val('');
			
		/*	//Empty value
    		$('#newpatient-hide_radio_value').val('');
			$('#newpatient-hide_ucil_id').val('');
			$('#newpatient-hide_curr_date').val('');
			$('#newpatient-hide_ucil_issue_date').val('');*/
    		
    	}
    }
  
  	//Patient Module	
  	function Patienttypemodule(data_value) 
    {
    	var patienttypenew=$('#newpatient-pat_type').val(); 

//alert(patienttypenew);

	if(patienttypenew==3){
   $('#newpatient-fin_total').val(0);

	}else{
   $('#newpatient-fin_total').val('');

	}
    	
    	if(data_value === '3')
    	{	
    		$('.field-newpatient-insurance_type_id').show();
    		$('#newpatient-insurance_type_id').attr('required','required');
    		$( "#newpatient-insurance_type_id" ).focus();
    	}
    	else
    	{	
    		//New Code
    		$('#newpatient-ucilval').prop("checked", false );
    		$('#newpatient-ucilval1').prop("checked", false );
    		$('#newpatient-ucil_id').val('');
    		$('#newpatient-ucil_issue_date').val('');
			$('.ucil_fields').hide();
    		$('.field-newpatient-insurance_type_id').hide();
    		$("#newpatient-insurance_type_id").val("");
    		
    		$('#newpatient-insurance_type_id').removeAttr('required','required');
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
	
function formatDate1(date) 
{
	 console.log(date);
     var d = new Date(date),
     month = '' + (d.getMonth() + 1),
     day = '' + d.getDate(),
     month = '' + (d.getMonth() + 1),
     year = d.getFullYear();
	 
	// console.log(d);
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [month,day, year].join('/');
 }
 /*	
function CalculateAge(data)
{ 
 
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();
  var dateString=formatDate1(data);	
  var dob = new Date(dateString.substring(6,10),dateString.substring(0,2)-1,dateString.substring(3,5));
  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";
  yearAge = yearNow - yearDob;
  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }
  age = {years: yearAge,months: monthAge,days: dateAge};
  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";
  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";
	
	$('#newpatient-pat_age').val(age.years);
	$('#newpatient-pat_month').val(age.months);
	$('#newpatient-pat_date').val(age.days);
}
*/
	
function CalculateAge(data)
{
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();
  var dateString=formatDate1(data);	
  var dob = new Date(dateString.substring(6,10),dateString.substring(0,2)-1,dateString.substring(3,5));
  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";
  yearAge = yearNow - yearDob;
  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }
  age = {years: yearAge,months: monthAge,days: dateAge};
  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";
  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";
	
	$('#newpatient-pat_age').val(age.years);
	$('#newpatient-pat_month').val(age.months);
	$('#newpatient-pat_date').val(age.days);
}


	function datecalculation(dateString) 
	{
		if(dateString != '')
		{
			var year_val=parseInt($('#newpatient-pat_age').val());
			var month_val=parseInt($('#newpatient-pat_month').val());
			var date_val=parseInt($('#newpatient-pat_date').val());
			
			if(isNaN(date_val)){
				date_val="0";
			}
			if(isNaN(month_val)){
				month_val="0";
			}
			if(isNaN(year_val)){
				year_val="0";
			}
			
			var current_date = new Date();
			var Val_date=current_date;
    		var dd = parseInt(Val_date.getUTCDate());
        	var mm  = parseInt(Val_date.getUTCMonth()+1);
        	var yy = parseInt(Val_date.getUTCFullYear());
        	var date_age = parseInt(dd - date_val);	
        	var month_age = parseInt(mm - month_val);
        	var year_age = parseInt(yy - year_val);
        	
        	$('#newpatient-dob').val(date_age+'-'+month_age+'-'+year_age);	
        }	
	}
	
	
	function Alertment(message)
{
	$.alert({
    		title: 'Alert!',
    		content: message,
    		type: 'red',
    		theme: 'material',
    		escapeKey: true,
    		backgroundDismiss: true,
    		typeAnimated: true,
		});
}
	
	function daydatecalculation(dateString,event)
	{
		if(dateString !== '' && event.keyCode !== 9)
		{
			 var dateString = parseInt(dateString);
			 if(dateString <= 31)
			 {
			 	 var date1 = new Date();
				 date1.setDate(date1.getDate()-dateString);
				 
				 var date=parseInt(date1.getUTCDate());
				 var month=parseInt(date1.getUTCMonth()+1);
				 var year=parseInt(date1.getUTCFullYear());
	        	
	        	 $('#newpatient-pat_month').val(0);
	        	 $('#newpatient-pat_age').val(0);
	        	
	        	 $('#newpatient-dob').val(date+'-'+month+'-'+year);
			
			 }
			 else
			 {
			 	$('#newpatient-pat_month').val('');
	        	$('#newpatient-pat_age').val('');
	        	$('#newpatient-dob').val('');
	        	$('#newpatient-pat_date').val('');
	        	
			 	Alertment('Days Not Greater than 31');
			 }
		}
		else if(dateString === '')
		{
			$('#newpatient-pat_month').val('');
	        $('#newpatient-pat_age').val('');
	        $('#newpatient-dob').val('');
		}
	}
	
	
	function monthdatecalculation(dateString,event)
	{
		if(dateString !== ''  && event.keyCode !== 9)
		{
			 var dateString = parseInt(dateString);
			 if(dateString <= 12)
			 {
			 	 var date1 = new Date();
				 date1.setMonth(date1.getMonth()+1-dateString);
				 
				 var date=parseInt(date1.getUTCDate());
				 var month=parseInt(date1.getUTCMonth()+1);
				 var year=parseInt(date1.getUTCFullYear());
	        	
	        	// $('#newpatient-pat_month').val(0);
	        	 $('#newpatient-pat_age').val(0);
	        	 $('#newpatient-pat_date').val(0);
	        	 
	        	 
	        	 
	        	 $('#newpatient-dob').val(date+'-'+month+'-'+year);
			
			 }
			 else
			 {
			 	
	        	$('#newpatient-pat_age').val('');
	        	$('#newpatient-dob').val('');
	        	$('#newpatient-pat_date').val('');
	        	$('#newpatient-pat_month').val('');
			 	Alertment('Month Not Greater than 12');
			 }
		}
		else if(dateString === '')
		{
			$('#newpatient-pat_date').val('');
	        $('#newpatient-pat_age').val('');
	        $('#newpatient-dob').val('');
		}
	}
	
	function yeardatecalculation(dateString,event)
	{
		if(dateString !== ''  && event.keyCode !== 9)
		{
			
			 var dateString = parseInt(dateString);
			 if(dateString <= 150)
			 {
			 	 var date1 = new Date();
				 date1.setYear(date1.getUTCFullYear()-dateString);
				 
				 var date=parseInt(date1.getUTCDate());
				 var month=parseInt(date1.getUTCMonth()+1);
				 var year=parseInt(date1.getUTCFullYear());
	        	
	        	 $('#newpatient-pat_month').val(0);
	        	 //$('#newpatient-pat_age').val(0);
	        	 $('#newpatient-pat_date').val(0);
	        	 
	        	 
	        	 
	        	 $('#newpatient-dob').val(date+'-'+month+'-'+year);
			
			 }
			 else
			 {
			 	
	        	$('#newpatient-pat_age').val('');
	        	$('#newpatient-dob').val('');
	        	$('#newpatient-pat_date').val('');
	        	$('#newpatient-pat_month').val('');
			 	Alertment('Year Not Greater than 150');
			 }
		}
		else if(dateString === '')
		{
			$('#newpatient-pat_date').val('');
	        $('#newpatient-pat_age').val('');
	        $('#newpatient-dob').val('');
		}
	}
	
	
	function Discountvalidated(e,event)
	{
		
		
		var total_amount=parseInt($('#newpatient-fin_total').val());
		if(!isNaN(total_amount))
		{
			if(e.value != '')
			{
				if(e.value >= 100)
				{
					$("#newpatient-fin_paid_amount").val("0");
					var total_percent_disc=parseInt(100);
					//Calculation
					var calc=parseInt(total_amount*total_percent_disc);
					var div=parseInt(calc/100);
						
					$('#newpatient-fin_less_discount').val(div);
						
					//Flat Disc Cal
					var sub=total_amount-div;
					$('#newpatient-fin_net_amount').val(sub);
					$('#newpatient-fin_paid_amount').val(sub);
						
					var validated='<div class="form-group field-newpatient-fin_paycategory w-165"><label class="control-label  " for="newpatient-fin_paycategory">Authority</label>'
								   +'<input type="text" onkeyup="Authority()" id="newpatient-fin_paycategory" required class="form-control w-cus" name="Newpatient[fin_paycategory]" placeholder="Authority" tabindex="371">'
								   +'<div class="help-block"></div></div><div class="form-group  field-newpatient-fin_cardial w-165"><label class="control-label  " for="newpatient-fin_cardial">Reason</label>'
								   +'<textarea style="min-height:35px;" id="newpatient-fin_cardial" required class="form-control w-cus" name="Newpatient[fin_cardial]" placeholder="Reason" tabindex="372"></textarea>'
								   +'<div class="help-block"></div></div>';
						
					$('#validation_discount').html(validated);
					$('#newpatient-fin_lessdisc_percent').val(100);
				}
				else if(e.value > 0  ||e.value <= 100)
				{
					var total_percent_disc=parseInt(e.value);
					//Calculation
					var calc=parseInt(total_amount*total_percent_disc);
					var div=parseInt(calc/100);
						
					$('#newpatient-fin_less_discount').val(div);
						
					//Flat Disc Cal
					var sub=total_amount-div;
					$('#newpatient-fin_net_amount').val(sub);
						$('#newpatient-fin_paid_amount').val(sub);
					var validated='<div class="form-group field-newpatient-fin_paycategory w-165"><label class="control-label  " for="newpatient-fin_paycategory">Authority</label>'
								   +'<input type="text" onkeyup="Authority()" id="newpatient-fin_paycategory" required class="form-control w-cus" name="Newpatient[fin_paycategory]" placeholder="Authority" tabindex="371">'
								   +'<div class="help-block"></div></div><div class="form-group field-newpatient-fin_cardial w-165"><label class="control-label  " for="newpatient-fin_cardial">Reason</label>'
								   +'<textarea style="min-height:35px;" id="newpatient-fin_cardial" required class="form-control w-cus" name="Newpatient[fin_cardial]" placeholder="Reason" tabindex="372"></textarea>'
								   +'<div class="help-block"></div></div>';
						
					$('#validation_discount').html(validated);
				}
				else if(e.value == 0  ||e.value != '')
				{
					
					$('#newpatient-fin_less_discount').val(0);
					$('#newpatient-fin_net_amount').val(total_amount);
				$('#newpatient-fin_paid_amount').val(total_amount);
					$('#validation_discount div').remove();
				}
						 			
			}
			else
			{
				
				$('#newpatient-fin_less_discount').val(0);
				$('#newpatient-fin_net_amount').val(total_amount);
				$('#newpatient-fin_paid_amount').val(total_amount);
				$('#validation_discount div').remove();
			}
				
		}
		
		if(e.value == 0)
		{
			$('#newpatient-fin_less_discount').val(0);
				$('#newpatient-fin_net_amount').val(total_amount);
				
				$('#validation_discount div').remove();
		}
	}
	
	function FinalValidated(e)
	{
		
		var total_amount=parseInt($('#newpatient-fin_total').val());
		if(e.value != '')
		{
			if(e.value == 0)
			{
				$('#newpatient-fin_less_discount').val(0);
				$('#newpatient-fin_net_amount').val(total_amount);
				//$('#newpatient-fin_paid_amount').val(total_amount);
				$('#validation_discount div').remove();
			}
		}
		else
		{
			
			$('#newpatient-fin_less_discount').val(0);
			$('#newpatient-fin_net_amount').val(total_amount);
			//$('#newpatient-fin_paid_amount').val(total_amount);
			$('#validation_discount div').remove();
		}
	}
	
    //Flat Calculation
	function AutomaticflatValidated(e) 
	{	
		if(e.value != '')
		{
			
			
			var total_amount=parseInt($('#newpatient-fin_total').val());
			
			if(!isNaN(total_amount))
			{
				var total_percent_disc=parseInt(e.value);		
				
				//Calculative Percent
				var calc=parseInt(total_percent_disc*100);
				var tot_amt=parseFloat(calc/total_amount);
				
				var tot_rounded=Math.ceil(tot_amt);
				$('#newpatient-fin_lessdisc_percent').val(tot_rounded);
				
				var sub=total_amount-total_percent_disc;
				$('#newpatient-fin_net_amount').val(sub);
				
				var validated='<div class="form-group field-newpatient-fin_paycategory w-165"><label class="control-label " for="newpatient-fin_paycategory">Authority</label>'
							   +'<input type="text" id="newpatient-fin_paycategory" required class="form-control w-cus" name="Newpatient[fin_paycategory]" placeholder="Authority" tabindex="371">'
							   +'<div class="help-block"></div></div><div class="form-group field-newpatient-fin_cardial w-165"><label class="control-label  " for="newpatient-fin_cardial">Reason</label>'
							   +'<input type="text" id="newpatient-fin_cardial" required class="form-control w-cus" name="Newpatient[fin_cardial]" placeholder="Reason" tabindex="372">'
							   +'<div class="help-block"></div></div>';
					
				$('#validation_discount').html(validated);
				
			}	
		}
		else
		{
			$('#validation_discount div').remove();
		}
	}
	
	
	/*function Discountflatcalculation(dateString) 
	{
		$('#validation_discount div').remove();
		var total_amount=parseInt($('#newpatient-fin_total').val());
		if(!isNaN(total_amount))
		{
			var total_percent_disc=parseInt(dateString);		
			//Calculative Percent
			var calc=parseInt(total_percent_disc*100);
			var tot_amt=parseFloat(calc/total_amount);
			var tot_rounded=Math.ceil(tot_amt);
			$('#newpatient-fin_lessdisc_percent').val(tot_rounded);
			var sub=total_amount-total_percent_disc;
			$('#newpatient-fin_net_amount').val(sub);
			
			
		}  
	}
	*/
	
	
	//Flat Calculation
	function Paidflatcalculation(dateString) 
	{
		var total_amount=$('#newpatient-fin_total').val();	
		if(dateString !== '')
		{
			var net_Amt=parseInt($('#newpatient-fin_net_amount').val());
			var paid_amt=parseInt(dateString);
			
			if(net_Amt >= paid_amt)
			{
				var calc=parseInt(net_Amt-paid_amt);
				$('#newpatient-fin_due_amount').val(calc);
			}	
		}
		else if(dateString === '')
		{
			if(total_amount !== '')
			{
				$('#newpatient-fin_due_amount').val(total_amount);
			}
			
		}
	}
	

	
	//Refresh Form
	function Refresh() 
	{	
		window.location.reload();
	}
	
	//Relation Name Form
	function AutomaticInitial() 
	{	
		var id=$('#newpatient-pat_inital_name').val();
		if(id != '')
		{
			if(id == 'Mr' || id == 'Dr')
			{
				$('#newpatient-pat_relation').val('S/O');
				$('#newpatient-pat_marital_status').val('Married');
				$('#newpatient-pat_sex').val('Male');
			}
			else if(id == 'Miss' || id == 'Baby' || id == 'Baby Of' || id == 'Ms.')
			{
				$('#newpatient-pat_relation').val('D/O');
				$('#newpatient-pat_marital_status').val('Unmarried');
				$('#newpatient-pat_sex').val('Female');
			}
			else if(id == 'Mrs' || id == 'Empty')
			{
				$('#newpatient-pat_relation').val('W/O');
				$('#newpatient-pat_marital_status').val('Married');
				$('#newpatient-pat_sex').val('Female');
			}
			else if(id == 'Master')
			{
				$('#newpatient-pat_relation').val('S/O');
				$('#newpatient-pat_marital_status').val('Unmarried');
				$('#newpatient-pat_sex').val('Male');
			}
		}
	}
	
	function AutomaticRelation() 
	{
		var id=$('#newpatient-pat_relation').val();
		if(id != '')
		{
			if(id == 'W/O' || id == 'S/O')
			{
				$('#newpatient-pat_sex').val('Male');
			}
			else if(id == 'D/O' || id == 'H/O' || id == 'C/O' || id == 'Empty' || id == 'Sis/O' || id == 'B/O' || id == 'M/O' || id == 'F/O' || id == 'Self')
			{
				 $('#newpatient-pat_sex').val('Female');
			}
		}
	}
	
	
/*	function AutomaticErase(event)
	{
		 if(event.keyCode === 27)
         {
         	
         	$('#newpatient-pat_city').val('');
         	$('#newpatient-pat_distict').val('');
         	$('#newpatient-pat_state').val('');
         }
	}*/
	
	
	
	
  //  var availableTags = <?= $productlist_col_json; ?>;

    // $("#newpatient-pat_city").typeahead({
// 
        // minLength: 1,
        // delay: 5,
  		// source: availableTags,
  		// autoSelect: true,
 		// displayText: function(item)
 		// {
 			 // return item.pat_city;
 		// },
  		// afterSelect: function(item) 
  		// {
  			// $("#newpatient-pat_distict").val(item.pat_distict);
  			// $("#newpatient-pat_state").val(item.pat_state);
  		// } 
	// });
	// */
	
	
	function Authority()
	{
		var availableTags1 = <?= $discount_autocomplete_json; ?>;

	    $("#newpatient-fin_paycategory").typeahead({
	
	        minLength: 1,
	        delay: 5,
	  		source: availableTags1,
	  		autoSelect: true,
	 		displayText: function(item)
	 		{
	 			 return item.authority;
	 		},
	  		afterSelect: function(item) 
	  		{
	  			$("#newpatient-fin_cardial").val(item.reason);
	  		} 
		});
	}
   </script>
   
   <script>
   
   $(document).ready(function(){
   	
   	 if($('#newpatient-dob').val()==""){
   	 	$('#newpatient-pat_age').val("");
   	 	$('#newpatient-pat_month').val("");
   	 	$('#newpatient-pat_date').val("");
   	}
	   
	 /*  $('label.control-label').addClass('col-sm-6'); 
	  $('.form-group').addClass('w-165'); 
	  $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile, .field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').addClass('w-140'); 
	  
	   $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile,.form-group.field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').removeClass('w-165'); 
	*/
	
	
	$('body').on("click",".citymaster",function()
	{
         var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=newpatient/createmaster';
         
         $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i> City</span>');
         $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
         return false; 
     });
     
     
     $('body').on("click","#pat_city",function()
	{
         jtable_pd();
         $('#city_model').modal('show');
         
     });
     
	
	});
	
 function jtable_pd(){
    	
    	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=newpatient/jqgrid';
  var table_reg= $('#reg_table').DataTable( {
        "processing": true,
        "serverSide": true,
         "ajax": {
        	"url": ajax_url,
        	 "type": "POST"
        	},
        	keys: {
           		keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
        	},
        	"columns": [
            { "data": "mrno","defaultContent": '<input type="text" value="0" />' },
            { "data": "pname","defaultContent": "NA" },
            { "data": "rname","defaultContent":"NA" },
            { "data": "mno","defaultContent": '<input type="text" value="0" />'  },
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#reg_table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      //  table_reg.row(cell.index().row).select();
      //  $('#reg_table_filter input').val("");
         $('#reg_table_filter input').focus();
    });
  $('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#reg_table").DataTable();
        if(key === 13){
        	
        	$('#reg_table thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#reg_table_filter input').focus();
        }
    }); 
    
$('#reg_table').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	PatientDetailsFetch(data);
});

$('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		PatientDetailsFetch(data);
 	}
});    
    
}
		
$("#newpatient-pat_city").typeahead({
  
  source: function(query,result) {
	  $.ajax(
	  {
		url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/ajaxcity";?>',
		method:'POST',
		data:{query:query},
		dataType:'json',
		success:function(data)
		{
			result($.map(data, function(item){
				return item.city;
			}));
		}
	  });
  },
  autoSelect: true,
  displayText: function(result)
  {
     return result;
  },
  afterSelect: function(result) 
  {  
 		$('#load1').show();
		$.ajax({
  			url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/ajaxsinglefetch&id=";?>'+result,
  			method:'POST',
  			dataType:'json',
  			success:function(data)
  			{   
  			 	$('#load1').hide();
            	$('#newpatient-pat_distict').val(data['district']);
            	$('#newpatient-pat_state').val(data['state']);
            	$('#newpatient-pat_city').val(data['city']);
            	$('#load1').hide();
  			}
		});
    }
});


function ClearForm()
{
	$('.ucil_fields').hide();
	$('.save_data').removeAttr('disabled','disabled');
	$("#w0").trigger('reset');
}

   </script>
   
<script>

	var onetimesave="1";
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            var  saves = $("#newpatient-mr_no").val();
            
            if(saves===""){
            	SaveRegisterForm();
            	onetimesave=2;	
            	//alert(onetimesave);
            }else{
            	//alert(onetimesave);
            	alert("already Saved");
            }

            /*if(onetimesave==1){
            	SaveRegisterForm();
            	onetimesave=2;	
            	//alert(onetimesave);
            }else{
            	//alert(onetimesave);
            	alert("already Saved");
            }
           	*/
        break;
        case 'f':
            event.preventDefault();
            alert('ctrl-f');
            break;
        case 'g':
            event.preventDefault();
            alert('ctrl-g');
            break;
        case 'c':
            event.preventDefault();
            ClearForm();
            break;
        }
    }
});



function InsuranceMasterValidation(data)
{
	
<?php if(!empty($insurancelist)) {?>
	var insurance_master=$.parseJSON('<?php echo json_encode($insurancelist); ?>');
<?php } else{?>var insurance_master=[];<?php } ?>

for (x in insurance_master) 
{
 if(insurance_master[x] === data)
 {
 	return 'OK';	
 	break;
 }       
}


}


function ConsultantValidation(data)
{
<?php if(!empty($physicianmaster)) {?>
var physician_master=$.parseJSON('<?php echo json_encode($physicianmaster); ?>');
<?php } else{?>var physician_master=[];<?php } ?>

for (y in physician_master)
{
if(physician_master[y] === data)
{
	return 'OK';
	break;
}
}

}


function SpecialistValidation(data)
{
<?php if(!empty($specialistdoctor)) {?>
var specialist_master=$.parseJSON('<?php echo json_encode($specialistdoctor); ?>');
<?php } else{?>var specialist_master=[];<?php } ?>

for (y in specialist_master)
{
if(specialist_master[y] === data)
{
	return 'OK';
	break;
}
}
}

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
	
	//Doctor Validation
	var doctor=$('#newpatient-con_consultant').val();
	var consultant_validation=ConsultantValidation(doctor);
	
	//Specialist Validation
	var specialist=$('#newpatient-con_department').val();
	var specialist_validataion=SpecialistValidation(specialist);
	
	var insurance=$('#newpatient-insurance_type_id').val();
	if(insurance !== '')
	{
		var insurance_validataion=InsuranceMasterValidation(insurance);
	}
	else if(insurance === '')
	{
		var insurance_validataion='OK';
	}
		var valid=$("#w0").valid(); 
		if(valid === true)
		{
		if(consultant_validation === 'OK' && specialist_validataion === 'OK')
		{
			if(insurance_validataion === 'OK')
			{

            if (confirm('Are You Sure to Save ?')) {
			//$('#load1').show();
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
		        		//$('#load1').hide();
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
		        		$('.save_data').attr('disabled','disabled');
		        		var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/report&id='+obj[2]['pat_id'];
	    				window.open(url,'_blank');
		        		
					 	$('#mr_modal').modal({backdrop: 'static', keyboard: false});
					 	$("#saves_sucess").attr("disabled", "disabled");  
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

	}
		else
		{
			$('#newpatient-insurance_type_id').val('');
			$('#newpatient-ucilval').prop("checked", false );
    		$('#newpatient-ucilval1').prop("checked", false );
    		$('#newpatient-ucil_id').val('');
	       	$('#newpatient-curr_date').val('');
		   	$('#newpatient-ucil_issue_date').val(''); 
		   	$('#ucil_fields').hide();
			$('#newpatient-insurance_type_id').focus();
			alert('Insurance is Invalid');
		}
		}
		else
		{
			$('#newpatient-con_consultant').val('');
			$('#newpatient-con_department').val('');
			$('#newpatient-con_consultant').focus();
			alert('Invalid Physician Name');
		}								
	}
}


$("#newpatient-con_consultant").typeahead({
  
  source: function(query,result) {
	  $.ajax(
	  {
		url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/consultantfetch";?>',
		method:'POST',
		data:{query:query},
		dataType:'json',
		success:function(data)
		{
			result($.map(data, function(item){
				return item.physician_name;
			}));
		}
	  });
  },
  autoSelect: true,
  displayText: function(result)
  {
     return result;
  },
  afterSelect: function(result) 
  {  
  		var hidden_mr_number=$('#hiddenmrnumber').val();
  		if(hidden_mr_number !== result)
  		{
	    	$('#load1').show();
			$.ajax({
		  			url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/specialist&id=";?>'+result,
		  			method:'POST',
		  			dataType:'json',
		  			success:function(data)
		  			{   
		  			 	$('#load1').hide();
		  			 	
		  			 	//UCIL AMOUNT CODE
		  			 	var insurance_type=$('#newpatient-insurance_type_id').val();
		  			 	
		  			 	if(insurance_type !== '')
		  			 	{
		  			 		var validatedtype=InsuranceMasterValidation(insurance_type);
		  			 		if(validatedtype === 'OK')
		  			 		{
		  			 			if(insurance_type === 'UCIL' )
				  			 	{
				  			 		if(data[1]['specialist'] !== '')
					  			 	{
					  			 		$('#newpatient-con_department').val(data[1]['specialist']);
					  			 	}
					  			 	
					  			 	$('#newpatient-fin_total').val(data[1]['ucil_amount']);
					  			 	$('#newpatient-fin_net_amount').val(data[1]['ucil_amount']);
					  			 	$('#newpatient-fin_paid_amount').val(0);
					  			 	$('#newpatient-fin_due_amount').val(data[1]['ucil_amount']);
					  			 	
					  			 	
				  			 	}
				  			 	else if(insurance_type === 'Aarogyasri')
 		  			 			{
		  			 				if(data[1]['specialist'] !== '')
					  			 	{
					  			 		$('#newpatient-con_department').val(data[1]['specialist']);
					  			 	}
					  			 	
					  			 	$('#newpatient-fin_total').val(data[1]['consult_amount']);
					  			 	$('#newpatient-fin_net_amount').val(data[1]['consult_amount']);
					  			 	$('#newpatient-fin_paid_amount').val(0);
					  			 	$('#newpatient-fin_due_amount').val(data[1]['consult_amount']);
					  			}
		  			 			else
		  			 			{
		  			 				if(data[1]['specialist'] !== '')
					  			 	{
					  			 		$('#newpatient-con_department').val(data[1]['specialist']);
					  			 	}
					  			 	
					  			 	$('#newpatient-fin_total').val(data[1]['consult_amount']);
					  			 	$('#newpatient-fin_net_amount').val(data[1]['consult_amount']);
					  			 	$('#newpatient-fin_paid_amount').val(data[1]['consult_amount']);
					  			}
		  			 		}
		  			 		else
		  			 		{
		  			 			$('#newpatient-insurance_type_id').val('');
		  			 			$('#newpatient-con_consultant').val('');
		  			 			$('#newpatient-insurance_type_id').focus();
		  			 			alert('Invalid Insurance Type');
		  			 		}
		  			 	}
		  			 	else if(insurance_type === '')
		  			 	{
		  			 		if(data[1]['specialist'] !== '')
				  			{
				  			 	$('#newpatient-con_department').val(data[1]['specialist']);
				  			}
				  			
				  			$('#newpatient-fin_total').val(data[1]['consult_amount']);
			  			 	$('#newpatient-fin_net_amount').val(data[1]['consult_amount']);
			  			 	$('#newpatient-fin_paid_amount').val(data[1]['consult_amount']);
		  			 	}
			        	
		  			}
		  	});
	  	}
    }
});

$("#newpatient-insurance_type_id").typeahead({
  
  source: function(query,result) {
	  $.ajax(
	  {
		url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/insurancefetch";?>',
		method:'POST',
		data:{query:query},
		dataType:'json',
		success:function(data)
		{
			result($.map(data, function(item){
				return item.insurance_type;
			}));
		}
	  });
  },
  autoSelect: true,
  displayText: function(result)
  {
     return result;
  },
  afterSelect: function(result) 
  {  
  		$('#load1').show();
		if(result === 'UCIL')	
	  	{
	  		$('.ucil_fields').show();
	  	}
	  	
	  	$('#load1').hide();
  }
});

function PaidAmountCalculation(data)
{
	//alert(data);
	var net_amount=$('#newpatient-fin_net_amount').val();
	var total_amount=parseFloat($('#newpatient-fin_total').val());
	
	var disc_percent=parseFloat($('#newpatient-fin_lessdisc_percent').val());
	var disc_amount=parseFloat($('#newpatient-fin_less_discount').val());
	var due_amount=parseFloat($('#newpatient-fin_due_amount').val());
	
	var data_value=parseFloat(data);
	if(!isNaN(total_amount))
	{
		if(data_value <= total_amount)
		{
			$('#newpatient-fin_net_amount').val(total_amount);
			
			var net_amt=parseFloat($('#newpatient-fin_net_amount').val());
			var calculation=net_amt - data_value;
			$('#newpatient-fin_due_amount').val(calculation);
			
			
			/*if(isNaN($('#newpatient-fin_due_amount').val())){
				$('#newpatient-fin_due_amount').val("0");	
			}*/
			
			$('#newpatient-fin_lessdisc_percent').val('');
			$('#newpatient-fin_less_discount').val('');	
		
			//Authority AND Reason
			$('#newpatient-fin_paycategory').removeAttr('disabled');
			$('#newpatient-fin_paycategory').attr('required','required');
			
			$('#newpatient-fin_cardial').removeAttr('disabled');
			$('#newpatient-fin_cardial').attr('required','required');
			
			$('#newpatient-fin_paycategory').val('');
			$('#newpatient-fin_cardial').val('');
		}
		else
		{
			$('#newpatient-fin_net_amount').val(total_amount);
			$('#newpatient-fin_paid_amount').val(total_amount);
			$('#newpatient-fin_due_amount').val('');
			
			$('#newpatient-fin_paid_amount').val(total_amount);
			$('#newpatient-fin_due_amount').val('0');
			
			//Authority AND Reason
			$('#newpatient-fin_paycategory').attr('disabled','disabled');
			$('#newpatient-fin_paycategory').removeAttr('required');
			
			$('#newpatient-fin_cardial').attr('disabled','disabled');
			$('#newpatient-fin_cardial').removeAttr('required');
			
			$('#newpatient-fin_paycategory').val('');
			$('#newpatient-fin_cardial').val('');
			
			alert('Net Amount Not Greater Than Paid Amount');
		}
		
	}
	else if(data === '')
	{
		$('#newpatient-fin_net_amount').val(total_amount);
		$('#newpatient-fin_paid_amount').val(total_amount);
		$('#newpatient-fin_due_amount').val('0');
		
		//Authority AND Reason
		$('#newpatient-fin_paycategory').attr('disabled','disabled');
		$('#newpatient-fin_paycategory').removeAttr('required');
		
		$('#newpatient-fin_cardial').attr('disabled','disabled');
		$('#newpatient-fin_cardial').removeAttr('required');
		
		$('#newpatient-fin_paycategory').val('');
		$('#newpatient-fin_cardial').val('');
	}
	
}


   function jtable_pd(){
    	
    	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=newpatient/city';
  var table_reg= $('#reg_table').DataTable( {
        "processing": true,
        "serverSide": true,
         "ajax": {
        	"url": ajax_url,
        	 "type": "POST"
        	},
        	keys: {
           		keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
        	},
        	"columns": [
            { "data": "mrno","defaultContent": '<input type="text" value="0" />' },
            { "data": "pname","defaultContent": "NA" },
            { "data": "rname","defaultContent":"NA" },
            { "data": "mno","defaultContent": '<input type="text" value="0" />'  },
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#reg_table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      //  table_reg.row(cell.index().row).select();
      //  $('#reg_table_filter input').val("");
         $('#reg_table_filter input').focus();
    });
  $('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#reg_table").DataTable();
        if(key === 13){
        	
        	$('#reg_table thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#reg_table_filter input').focus();
        }
    }); 
    
$('#reg_table').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	PatientDetailsFetch(data);
});

$('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		PatientDetailsFetch(data);
 	}
});    
    
}


 
 

</script>
   