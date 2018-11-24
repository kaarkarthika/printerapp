<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */

//Create a DateTime object using the user's date of birth.
		$dob = new \DateTime($model->dob);
		//We need to compare the user's date of birth with today's date.
		$now = new \DateTime();
		//Calculate the time difference between the two dates.
		$difference = $now->diff($dob);
		
		//Get the difference in years, as we are looking for the user's age.
		$year = $difference->y;
		$month = $difference->m;
		$day = $difference->d;
		
		if($subvisit->insurance_type != '1')
		{
			$subvisit->patient_date='';
			$subvisit->ucil_date='';
		}
		
?>



<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script> 

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
    border: 1px solid none !important;
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

table.new_patient_table .w-165,table.new_patient_table .w-140  {
    width: 100%;
}
.new_patient_table label.control-label {
      width: 38%;
    text-align: right;
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
div#load1 {
    position: relative;
}
div#load1 img {
    position: absolute;
}
</style>
  
<div class="newpatient-form">
	<div class="container">
		
<div class="row">
<div class="col-sm-6">
	<div class="btn-group pull-right m-t-15">
</div>
<!-- <h4 class="page-title"> <?php //Html::encode($this->title) ?></h4> -->
<!-- <ol class="breadcrumb">
 <li><a href="<?php // echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php //echo $this->title;?></a></li>
</ol> -->
</div>
<div class="col-sm-6 text-right ">
			<!-- 	<a href="<?php //echo Yii::$app->request->BaseUrl;?>/index.php?r=newpatient/index" class="btn text-right btn-default" Title="BACK To Grid">Back to Grid </a>  -->
			</div>
</div>


	<?php $form = ActiveForm::begin(['options'=>['class'=>' ']]); ?>
  <div class="row">
   <div class="col-sm-12">
      <div class="c panel panel-border panel-custom">
         <div class="panel-heading">
            <h5 class="box-title"><strong>Patient Details</strong></h5>
         </div>
         <div class="no-pd panel-body">

            <div class="col-sm-3">

               <div class="row">
                  <div class="col-sm-4">
			<?= $form->field($model, 'mr_no')->textInput(['class' => ' form-control w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'readonly'=>true,'onchange'=>'AutomaticInitial()'])->label('Inital') ?>
                     <span  id='0' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>	



                  </div>
                  <div class="col-sm-4">
			<?= $form->field($model, 'pat_inital_name')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['class' => ' form-control w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'onchange'=>'AutomaticInitial()'])->label('Inital') ?>
                     <span  id='0' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>	



                  </div>
                  <div class="col-sm-8">
                     <?= $form->field($model, 'patientname')->textInput(['style'=>'text-transform:uppercase;background-color:white;color:blue;','class' => '  form-control col-sm-6 w-cus','placeholder'=>'Name','tabindex'=>333 ,'required'=> true])->label('Name') ?>
                     <span id='1'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span> 
                  </div>
               </div>

               <div class="row">
                  <div class="col-sm-4">
                     <?= $form->field($model, 'dob')->textInput(['value'=>date('Y-m-d',strtotime($model->dob)),'maxlength' => 10 ,'class' => 'datepicker_age form-control w-cus ' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true,'onchange'=>'CalculateAge(this.value);'])->label('DOB')   ?>
                     <span id='2'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span> 	
                  </div>
                  <!--div class="col-sm-8">
                     <?= $form->field($model, 'pat_age')->textInput(['maxlength' => 3 ,'class' => ' form-control w-cus  number' ,'placeholder'=>'Age','tabindex'=>335,'required'=> true,'onchange'=>'Datecalculation(this.value);'])->label('Age') ?>
                     <span id='3'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div-->
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
               </div>

               <div class="row">
                  <div class="col-sm-4">
                     <?= $form->field($model, 'pat_relation')->dropDownList([ 'S/O' => 'S/O', 'D/O' => 'D/O','W/O' => 'W/O','H/O'=>'H/O','C/O'=>'C/O','Empty'=>'Empty','Sis/O'=>'Sis/O','B/O'=>'B/O','M/O'=>'M/O','F/O'=>'F/O','Self'=>'Self'], ['class' => ' form-control col-sm-6 w-cus','style'=>' ','tabindex'=>336,'required'=> true,'onchange'=>'AutomaticRelation();'])->label('Relation') ?>
                     <span id='4'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
                  <div class="col-sm-8">
                     <?= $form->field($model, 'par_relationname')->textInput(['style'=>'text-transform:uppercase;background-color:white;color:blue;','maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Relation Name','tabindex'=>337 ,'required'=> true])->label('Rel Name') ?>
                     <span id='5'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-4">
                     <?= $form->field($model, 'pat_marital_status')->dropDownList([ 'Married' => 'Married', 'Unmarried' => 'Unmarried','Widow'=>'Widow'], ['class' => 'form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Mar Stat') ?>
                     <span id='6' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
                  <div class="col-sm-8">
                     <?= $form->field($model, 'pat_sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['prompt' => '' ,'class' => '  form-control w-cus','prompt'=>'- Gender -'  ,'style'=>' ','tabindex'=>339,'required'=> true])->label('Gender') ?>
                     <span  id='7' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
               </div>
            </div>


            <div class="col-sm-3">
               <div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($model, 'pat_address')->textArea(['required' => true , 'class' => ' form-control w-cus','placeholder'=>'Address','tabindex'=>352])->label('Address') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_city')->textInput(['required' => true ,'class' => '   form-control w-cus','placeholder'=>'Nationality','tabindex'=>351 ])->label('City') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_distict')->textInput(['readonly'=>true,'class' => '   form-control w-cus','placeholder'=>'Religion' ,'style'=>'width:','tabindex'=>350 ])->label('District') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
               <div class="row">
                  
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_state')->textInput(['readonly'=>true,'class' => ' form-control w-cus','placeholder'=>'State','tabindex'=>342,'required'=> true ])->label('State') ?>
                     <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_pincode')->textInput(['maxlength' => 6 ,'class' => 'col-md-3 form-control w-cus number','placeholder'=>'Pincode','tabindex'=>343,'required'=> true ])->label('Pincode') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
               
               <div class="row">
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_phone')->textInput(['maxlength' => 10 ,'class' => ' form-control w-cus number','placeholder'=>'Phone Number','tabindex'=>344 ])->label('Ph Numb') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_mobileno')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile Number','tabindex'=>345 ,'required'=> true])->label('Mob Num') ?> 
                     <span id='9' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span> 
                  </div>
               </div>
            </div>


            <div class="col-sm-3">
               <!--div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($model, 'pat_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>346 ])->label('Email') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div-->
               
               <!--div class="row">
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_source')->textInput(['maxlength' => true ,'class' => '  form-control w-cus  ','placeholder'=>'Source','tabindex'=>347  ])->label('Source') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
                  <div class="col-sm-6">
                     <?= $form->field($model, 'pat_education')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Education','tabindex'=>348 ])->label('Education') ?>
                     <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>	
                  </div>
               </div-->
               <!--div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($model, 'pat_occupation')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Occupation','tabindex'=>349 ])->label('Occupation') ?>
                     <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div-->
            </div>


            <div class="col-sm-3">
               <div class="row">
                  <div class="col-sm-6">
                     <?= $form->field($subvisit, 'ucil_letter_status')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','required'=> true,'disabled'=>true])->label('Status') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
                  <div class="col-sm-6">
                     <?= $form->field($subvisit, 'ucil_emp_id')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number','required'=> true,'disabled'=>true])->label('UCIL ID') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($subvisit, 'patient_type')->dropDownList($patienttype, ['title'=>'Patient Type','class' => '  form-control w-cus','style'=>' ','disabled'=> true])->label('Pat Type') ?>
                     <span id='10' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
                  <div class="col-sm-8">
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($subvisit, 'insurance_type')->dropDownList($insurancelist,['prompt' => '-SELECT-' ,'class' => '  form-control w-cus','disabled'=> true])->label('Ins Type') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <?= $form->field($subvisit, 'patient_date')->textInput(['value'=>date('d-m-Y',strtotime($subvisit->patient_date)),'maxlength' => true ,'class' => '  form-control w-cus number','required'=> true,'disabled'=>true])->label('Reg Date') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
                  <div class="col-sm-6">
                     <?= $form->field($subvisit, 'ucil_date')->textInput(['value'=>date('d-m-Y',strtotime($subvisit->ucil_date)),'maxlength' => true ,'class' => '  form-control w-cus number','required'=> true,'disabled'=>true])->label('Exp Date') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
            </div>


         </div>
      </div>
   </div>
</div>



<div class="row">
   <!--div class="col-sm-3">
      <div class="c panel panel-border panel-custom">
         <div class="panel-heading">
            <h5 class="box-title"><strong>Relative Details</strong></h5>
         </div>
         <div class="no-pd panel-body">
            <div class="col-sm-12">
               <div class="row">
                  <div class="col-sm-12">

                     <?php if($model->rel_dob != '1970-01-01' ){?>
                     <?= $form->field($model, 'rel_dob')->textInput(['value'=>date('d-m-Y',strtotime($model->rel_dob)),'maxlength' => true ,'data-date-format'=>"mm/dd/yyyy",'class' => ' datepicker form-control w-cus','placeholder'=>'DOB','tabindex'=>353])->label('DOB') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                     <?php }else if($model->rel_dob == '1970-01-01'){ ?>
                     <?= $form->field($model, 'rel_dob')->textInput(['value'=>'','maxlength' => true ,'data-date-format'=>"mm/dd/yyyy",'class' => ' datepicker form-control w-cus','placeholder'=>'DOB','tabindex'=>353])->label('DOB') ?>
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
                     <?php }?>


                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($model, 'rel_mobile')->textInput(['maxlength' => 10 ,'class' => '  form-control w-cus number','placeholder'=>'Mobile No','tabindex'=>354])->label('MobNum') ?> 
                     <span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($model, 'rel_email')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Email','tabindex'=>355])->label('Email') ?>
                     <span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span> 
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <?= $form->field($model, 'rel_annual')->dropDownList([ '< 1 Lakh' => '< 1 Lakh', '1-5 Lakh' => '1-5 Lakh','5-10 Lakh' => '5-10 Lakh' ,'10 Lakh' => '10 Lakh'],['maxlength' => true ,'class' => 'form-control w-cus','placeholder'=>'Annual Income','tabindex'=>356])->label('Ann Inc') ?> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div-->

   <div class="col-sm-3">
      <div class="c panel panel-border panel-custom">
         <div class="panel-heading">
            <h5 class="box-title"><strong>Consultant Details</strong></h5>
         </div>
         <div class="no-pd panel-body">
            <div class="col-sm-12">
               <div class="row">
                  <div class="col-sm-12">
                  <?= $form->field($subvisit, 'consultant_time')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Timing','tabindex'=>357,'disabled'=> true])->label('Timing') ?>
<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                <?= $form->field($subvisit, 'consultant_doctor')->dropDownList($physicianmaster, ['class' => '  form-control w-cus','prompt'=>'-DoctorName-'  ,'style'=>' ','disabled'=> true])->label('Consultant') ?>
<span id='11' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
               <?= $form->field($subvisit, 'department')->dropDownList($specialistdoctor,['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Department','required'=> true,'disabled'=> true])->label('Department') ?>
<span  id='12' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
         <?= $form->field($subvisit, 'con_turn')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Turn On','tabindex'=>358,'disabled'=> true])->label('Turn On') ?>
<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>



   <!--div class="col-sm-4">
      <div class="c panel panel-border panel-custom">
         <div class="panel-heading">
            <h5 class="box-title"><strong>Financial Details</strong></h5>
         </div>
         <div class="no-pd panel-body">
            <div class="col-sm-12">
               <div class="row">
                  <div class="col-sm-4">
                <?= $form->field($subvisit, 'total_amount')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number text-right','placeholder'=>'Total Amount','required'=> true,'disabled'=>true])->label('Tot Amt') ?>
<span id='13' class="form-group field-newpatient-mr_no w-165 " style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>

					<div class="col-sm-4">
						<?= $form->field($subvisit, 'less_disc_percent')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number text-right','placeholder'=>'Less Disc(%)','onblur'=>'Discountcalculation(this.value);','disabled'=>true])->label('LesDis(%)') ?>
<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>

				</div>
					<div class="col-sm-4">
<?= $form->field($subvisit, 'less_disc_flat')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number text-right','placeholder'=>'Less Discount','onblur'=>'Discountflatcalculation(this.value);','disabled'=>true])->label('Less Disc') ?>
<span  class="form-group field-newpatient-mr_no w-165 " style='color: red;font-size: 12px;'></span>
					</div>

               </div>


               <div class="row">
                  <div class="col-sm-4">
               <?= $form->field($subvisit, 'net_amt')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number text-right','placeholder'=>'Net Amount','disabled'=>true])->label('Net Amt') ?>
<span id='14'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
          <div class="col-sm-4">
             <?= $form->field($subvisit, 'paid_amt')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number text-right','placeholder'=>'Paid Amount','onblur'=>'Paidflatcalculation(this.value);','disabled'=>true])->label('Paid Amt') ?>
<span id='15' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>
                            <div class="col-sm-4">
            <?= $form->field($subvisit, 'due_amt')->textInput(['maxlength' => true ,'class' => '  form-control w-cus number text-right','placeholder'=>'Due Amount','disabled'=>true])->label('Due Amt') ?>
<span id='16' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;/*visibility: hidden*/display: none;'>Required</span>
                  </div>

               </div>




               <div class="row">
                  <div class="col-sm-4">
               <?= $form->field($subvisit, 'pay_mode')->dropDownList($paymenttype,['placeholder'=>'Pay Mode','maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Pay Mode','disabled'=>true])->label('Pay Mode') ?>
				<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;'></span>
                  </div>

                  <div class="col-sm-4">
               <?= $form->field($subvisit, 'disc_by')->dropDownList(['Both' => 'Both', 'Hospital' => 'Hospital', 'Doctor' => 'Doctor'],['prompt' => '-SELECT-' ,'maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Discount By','disabled'=> true])->label('Disc By') ?>
               <?php if($model->fin_paycategory != ''){ ?>
<?= $form->field($model, 'fin_paycategory')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Pay Category','tabindex'=>359,'disabled'=>true])->label('Authority') ?>
<?= $form->field($model, 'fin_cardial')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Curtial','tabindex'=>360,'disabled'=>true])->label('Reason') ?>
<?php } ?>
                  </div>




                  <div class="col-sm-4">
                  	        <?= $form->field($model, 'fin_pancardno')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'PAN Card No','tabindex'=>361])->label('PAN No') ?>
            
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
        <?= $form->field($model, 'fin_aadhar_card')->textInput(['maxlength' => 12 ,'class' => '  form-control w-cus number','placeholder'=>'Aadhar Card No','tabindex'=>362])->label('AadharNo') ?>
        <?= $form->field($model, 'hide_radio_value')->hiddenInput(['maxlength' => true ])->label(false) ?>
<?= $form->field($model, 'hide_ucil_id')->hiddenInput(['maxlength' => true ])->label(false) ?>
<?= $form->field($model, 'hide_curr_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
<?= $form->field($model, 'hide_ucil_issue_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
                  </div>

                  <div class="col-sm-6">


   <?= $form->field($subvisit, 'remarks')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Remarks','disabled'=> true])->label('Remarks') ?>
                  </div>


               </div>

            </div>
         </div>
      </div>
   </div-->






   <div class="col-sm-2">
      <div class="c panel ">
         <div class=" ">
            <h5 class="box-title"><strong> </strong></h5>
         </div>
         <div class="no-pd panel-body">
          
  
               <div class="row">
   <div class="col-sm-12">
<button type="button" class="btn b-width btn-success update_data" onclick='UpdateRegisterForm()'>Update</button></div></div>

<!-- <button type='button' class="btn-xs btn-primary update_data" onclick='UpdateRegisterForm()'>Update</button>  -->
<!-- <button type='button' class="btn-xs btn-primary update_data" onclick='UpdateRegisterForm()'>Update</button>  --><br>
 <div class="row">
    <div class="col-sm-12">
<!-- <a href="/2018/dmcpharmacy/backend/web/index.php?r=newpatient/index" class="btn btn-bk b-width">Grid </a> -->


<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=newpatient/index" class="btn btn-bk b-width">Back to Grid </a> 
    


               </div>

            </div>

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
	  
   	  
	  
   $(document).ready(function(){
	  	//On Load Focus Text Field
	  	 $('[tabindex="332"]').focus();
	  	
	  	//Enter -> move to next field
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
	  	
	  	
	  	//Date Picker DOB
	  	$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
});
	  	
	  	
	  	$('.datepicker_age').datepicker({
    format: 'yyyy-mm-dd',
   // format: 'dd-mm-yyyy',
    endDate: "today",
	autoclose: true,
});
	  	
	  	
	  	
	  	//Type only Number
	  	$("body").on('keypress', '.number', function (e) 
		{
			//if the letter is not digit then display error and don't type anything
			if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
			{
			 	return false;
			}
     	});
	  	
	  	
	  	$("body").addClass("fixed-left-void");
		$("body").removeClass("fixed-left");
		$("#wrapper").addClass("enlarged");
		$("#wrapper").addClass("forced");   			
		$(".list-unstyled").css("display","none");
	  
	   
	 // $('label.control-label').addClass('col-sm-6'); 
	 // $('.form-group').addClass('w-165'); 
	  $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile, .field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').addClass('w-140'); 
	  
	   $(' .field-newpatient-rel_dob, .field-newpatient-rel_mobile,.form-group.field-newpatient-rel_email,.field-newpatient-rel_qualify,.field-newpatient-rel_occupation,.field-newpatient-rel_religion,.field-newpatient-rel_annual,.field-newpatient-con_timing,.field-newpatient-con_consultant,.field-newpatient-con_department,.field-newpatient-con_turn').removeClass('w-165'); 
	
		
		$('#newpatient-pat_age').val('<?php echo $year;?>');
		$('#newpatient-pat_month').val('<?php echo $month;?>');
		$('#newpatient-pat_date').val('<?php echo $day;?>');
	
	});
	
	
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
	
	function UpdateRegisterForm()
	{
		/*var pat_initial=$('#newpatient-pat_inital_name').val();
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
  		
  		
  		var validated_array = new Array(pat_initial,pat_name,pat_dob,pat_age,pat_blood_rel,pat_rel,pat_mar,pat_gender,pat_city,pat_mob_num);
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
		}*/
	
		var valid=$("#w0").valid();
		if(valid === true)
		{
			var form = $('#w0');	
	    	var formData = form.serialize();
	    	$.ajax({
    			type: 'POST',
		        url: form.attr("action"),
		        data: formData,
		        success: function (result) 
		        {
		        	//var obj = $.parseJSON(result);
		          if(result == 'S')
		          {
		          	noti ();
		          	$('.update_data').attr('disabled','disabled');
		        	//alert('Success fully Updated');
		          }
		        },
		        error: function () 
		        {
		            alert("Something went wrong");
		        }
   		   });	
		}
	}
	
function noti () 
{
  $.Notification.autoHideNotify('custom', 'top right', 'Register Successfully.');
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
   </script>

<style>
label.control-label {
    color: #444;
    font-weight: normal;
}

label.control-label {
    font-size: 12px!important;
}
textarea.form-control {
    min-height: 73px;
}
.form-control {
    font-size: 12px!important;
}

.panel-border .panel-body {
    padding: 0px 20px 20px 20px;
}
</style>