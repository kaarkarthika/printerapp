<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
  use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */


 //print_r($subvisit_last_date['patient_type']);die;
 $discount_autocomplete=array();
$discount_autocomplete[]=array('authority' => strtoupper("E.C Dinesh Reddy"),'reason' => strtoupper("Discount"));
$discount_autocomplete[]=array('authority' => strtoupper("E.C Gangi Reddy"),'reason' => strtoupper("Discount"));
$discount_autocomplete[]=array('authority' => strtoupper("E.C Sugunamma"),'reason' => strtoupper("Discount"));
$discount_autocomplete_json = json_encode($discount_autocomplete);
?>

<style>
.val_pre input{
	    width: 70px !important;
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
.inpatientblock.desc {
    margin: 15px auto;
}
.inpatient-details .glyphicon-search {
    position: relative;
    top: 6px;
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


.newpatient-form .form-group{
	margin-left: 15px;
}
fieldset.scheduler-border{
    border: none!important;
  }

.newpatient-form .form-group {
    width: 135px;
}

.newpatient-form fieldset.scheduler-border {
    float: left;
}

.last_con_doc {
    color: #f00;
    font-weight: bold;
     width: 170px;
    float: left;
}
.last_con_doc label {
    color: initial;
    float: none;
}
.newpatient-form .form-group {
    float: left;
}

.newpatient-form .ucil_popup .form-group {
    float: none;
    width: auto;
}

.free_up_date {
    position: absolute;
    right: 0;
    width: 180px;
     font-weight: bold;
     color: #000;

}
.free_up_date p {
    color: #ad00b9;
    font-weight: bold;
}
.newpatient-form .field-subvisit span {
    width: 120px !important;
}
.newpatient-form .field-subvisit .form-group   {
    width: 120px !important;
}
.newpatient-form .appointment_details .inpatientblock .form-control{
	    height: 30px!important;
    padding: 0px 7px!important;
}.newpatient-form .appointment_details .inpatientblock .form-group{
	margin-left: 0 !important;
	margin-bottom: auto !important;
}
.newpatient-form .inpatientblock .form-group {
    width: 170px;
}
.appointment_details .panel-custom label{
	    float: none;
}

.appointment_details .panel-custom input{
    height:30px;	
}
.appointment_details .panel-custom .form-control{
	    height: 30px !important;
	    margin-right: 0px;
    	padding: 0;
}
.newpatient-form .panel-custom .form-group{
	    margin-left: 0px;
}
.gst-cls{
	position: relative;
	    left: -36px;
}
.donate-now {
    list-style-type: none;
    padding: unset;
}
.donate-now li {
    width: 100px;
    height: 30px;
    position: relative;
    display: table-cell;
    top: 8px;
}
ul.donate-now.per_flat_val {
    padding: 0;
}
.donate-now li {
    width: 27px;
}
ul.donate-now.per_flat_val {
    width: 60px;
    margin: auto 0;
    position: relative;
    top: -7px;
}
.per_flat_val #overall_discount_type_radio, .per_flat_val #overall_percent_type {
    width: 27px;
    height: 20px;
}
ul.donate-now.per_flat_val label {
    height: 29px;width: 30px;
    padding: 5px;
}
.donate-now label {
    padding: 2px;
    border: 1px solid #CCC;
    cursor: pointer;
    z-index: 90;
}
.donate-now label, .donate-now input {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.donate-now input[type="radio"] {
    opacity: 0.011;
    z-index: 100;
}
.donate-now input[type="radio"]:checked+label {
    background: #5fbeaa;
    color: #fff;
}
.subvisit-main{
	border:1px solid #000;
}









</style>
 
  
  <div class="alert alert-danger" id="validated_refferal">
  <strong>Danger!</strong> Refferal Letter Not Given.
</div>

<div class="alert alert-danger" id="validated_refferal_expiry">
  <strong>Danger!</strong> Refferal Letter Is Expiry.
</div>
  
<div class="newpatient-form">
	<div class="container">
		
		<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo 'Sub-Visit';?></a></li>
</ol>
</div>
</div>
<div class="row appointment_details ">
	
			<div class="col-sm-12">
				  <div class="col-sm-12"     >
					    <div class="inpatientblock  desc"  style="position: relative;top: 9px;" > 
						<div class="row">
						<div class="col-sm-3">
						
						<div class="form-group" style="width: 270px;">
						   <div class="input-group add-on fwidth" >
                           		<input class="form-control mrn inrefrsh" placeholder="MRN Search" name="mr_number" onkeyup="Patient_details(event,this)" style="width: 120px;    margin-right: 0;"  id="mrnumber" type="text" tabindex="8">
									<div class="ipt input-group-btn fetch_record" value='click' onmousedown="Patient_details(event,this)" style="width: auto;">
									<span class="btn btn-default inpatient-details" style="    float: left;    margin-right: 15px;"  ><i class="glyphicon glyphicon-search"></i></span>
									<button type="button" style="float: left;background: #800080 !important;   margin-right: 10px;" class="btn  btn-sm" id="patient_history_detils" onclick="Patient_modal()"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> </button>
									<a onclick="Patient_reload()" dataID='' class="btn btn-default btn-sm" id="history_detils">Set</a>
						
								</div>

						   </div>
								<span id='mr_validated' style="color:red" hidden>Invalid MR Number</span>
							    <span class='in_pat_validated' style="color:red" hidden>Enter Patient Record</span>
                        </div>
						<div class="form-group">
						</div>
					</div>
						<div class="col-sm-9">
						<div class="form-group col-sm-3"  >
                     
                           <input type="text" placeholder="Patient Name" class="form-control text-cap fwidth mrn inrefrsh" name='in_patient' id="pat_name" readonly>
                          
                                 
                        </div>
						 <div class="form-group col-sm-2">
                           <input type="text" placeholder="Mobile Number" class="form-control fwidth mrn number phone inrefrsh" name='in_patient_mobile'   onkeypress="phoneno()"  id="pat_mob" readonly>
                        </div>
						<div class="form-group col-sm-3">
                        
                           <div class="input-group fwidth">
                              <span class="ipt input-group-btn">
                                 <select class="btn mrn text-cap"  disabled>
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                              <input type="text" placeholder="Doctor Name" class="form-control mrn inrefrsh text-cap" name='in_doctor_name' id="pat_doctor"  readonly>
                           </div>
                        </div>
						
                        <div class=" form-group col-sm-2" >
                        
                            
                           <select placeholder="Insurance Type" class="form-control fwidth key mrn inrefrsh text-cap" name='insurance_type' id="pat_insurance" readonly>
                             
                           </select>
                        </div>
                        <div class="form-group col-sm-2" >
                        
                           <input type="text" placeholder="Date of Birth" class="form-control fwidth key mrn inrefrsh" name='date_of_birth' id="pat_dob" readonly>
                        </div>
                        </div>
						
						
						
						</div>
						</br>
					
                        </div>
                    </div>
				<div class="card-box">
					<div class="row">
							<span class="patient_details  ">
					        <!-- <h5 class="form-head">Patient Details</h5>		 -->
						
				 		<?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>
						<div class="row">
						 <span class="col-sm-3 pull-right l-40">
							<button type='button' class="btn-xs btn-primary update_data hide" onclick='UpdateRegisterForm()'>Update</button> 
	
  						</span>
  				</div>	
  
  						
  	<table class="table table-bordered">
    <thead>
      <tr>
        <th>MR NUMBER</th>
        <th>Name</th>
        <th>DOB</th>
        <th>Age</th>
        <th>Relation</th>
        <th>Relation Name</th>
        <th>Martial Status</th>
        <th>Gender</th>
        <th>City</th>
        <th>Mobile Number</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="color: #1b00ff;font-weight: bold;"><?php echo $model->mr_no; ?></td>
        <td style="color: #1b00ff;font-weight: bold;"><?php echo $model->pat_inital_name.' '.$model->patientname; ?></td>
        <td><?php echo date('d-m-Y',strtotime($model->dob)); ?></td>
        <td><?php echo $model->pat_age; ?></td>
        <td><?php echo $model->pat_relation; ?></td>
        <td><?php echo $model->par_relationname; ?></td>
        <td><?php echo $model->pat_marital_status; ?></td>
        <td><?php echo $model->pat_sex; ?></td>
        <td><?php echo $model->pat_city; ?></td>
        <td><?php echo $model->pat_mobileno; ?></td>
       	<td><button type="button" class='btn btn-success btn-xs' onclick='View()'>View</button></td>
      </tr>
    </tbody>
  </table>	
  		
  		<div class='free_up_date'>
  			<label>Free Up To</label>
  				<p><?php
	  					$date_up_to=date('Y-m-d',strtotime($subvisit_last_date['created_at']));
						$date=date_create($date_up_to);
						date_add($date,date_interval_create_from_date_string("7 days"));
						$a=date_format($date,"Y-m-d");
						if(date('Y-m-d') <= $a)
						{
							echo date('d-m-Y',strtotime($a));
						}
						else {
							echo "Over";
						}
					?>
  				</p>
  		</div>
  		
  		<div class="row">
  		<fieldset class="scheduler-border">
  			
			<legend class="scheduler-border form-head ">Patient Details</legend>
			<br>
			<div class="row">
				
				 <?= $form->field($subvisit, 'patient_type')->dropDownList($patienttype, ['options' => [$subvisit_last_date['patient_type'] => ['selected'=>true]],'title'=>'Patient Type','class' => '  form-control','onchange'=>'Patienttypemodule(this.value);'])->label('Patient Type') ?>
						 
				 <?= $form->field($subvisit, 'insurance_type')->dropDownList($insurancelist,['options' => [$subvisit_last_date['insurance_type'] => ['selected'=>true]],'prompt' => '-SELECT-' ,'class' => '  form-control','onchange'=>'UCIL(this.value);'])->label('Insurance Type') ?>
         <?php // echo "<pre>"; print_r($subvisit); die; ?>
          <?= $form->field($subvisit, 'ucil_emp_id')->textInput(['class' => 'form-control','value'=>$subvisit_last_date['ucil_emp_id']])->label('UCIL Emp No') ?> 
			</div>
						
		</fieldset>
  		
  		
  		
  		<fieldset class="scheduler-border">
  			
			<legend class="scheduler-border form-head ">Consultant Name</legend>
			<br>
			<div class="row ">
				
				
					<?php 
								$today_date=date('Y-m-d H:i:s');
								if(date('A',strtotime($today_date)) == 'AM') { ?>	
							
    					 	<?= $form->field($subvisit, 'consultant_time')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Morning' => ['selected'=>true]],'class' => 'form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
 						<?php }else if(date('A',strtotime($today_date)) == 'PM') { ?>
 						 	<?= $form->field($subvisit, 'consultant_time')->dropDownList(['Evening' => 'Evening', 'Morning' => 'Morning'],['options' => ['Evening' => ['selected'=>true]] ,'class' => 'form-control w-cus','placeholder'=>'Timing','tabindex'=>359,'required'=> true])->label('Timing') ?>
 						<?php } ?>
				
				
			 	
				<?= $form->field($subvisit, 'consultant_doctor')->dropDownList($physicianmaster, ['class' => '  form-control w-cus','prompt'=>'-DoctorName-'  ,'style'=>' ','tabindex'=>360, 'onblur' => 'Specialization(this.value);'])->label('Consultant') ?>
				
				<?= $form->field($subvisit, 'department')->dropDownList($specialistdoctor,['prompt'=>'-Specialized-','class' => '  form-control w-cus','placeholder'=>'Department','tabindex'=>361,'required'=> true,'readonly'=> true])->label('Department') ?>
			
		    	<?= $form->field($subvisit, 'con_turn')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Turn On','tabindex'=>362])->label('Turn On') ?>
				
				
				<div class='last_con_doc'><label>Last Consultated Doctor</label><p><?php echo $physicianmaster[$subvisit_last_date['consultant_doctor']];?></p></div>
				<div class='last_con_doc'><label>Last Date Visit</label><p><?php echo date('d-m-Y',strtotime($subvisit_last_date['created_at']));?></p></div>
				
			</div>
			<div class="row">
			 	<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
			 	<span id='0' class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span id='1'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
			 	<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				
			</div>			
		</fieldset>
  		</div>
  		
  		<?php if(date('Y-m-d') <= $free_up_to) { ?>
  		<div class="row">
  		<fieldset class="scheduler-border">
  			
			<legend class="scheduler-border form-head ">Financial Details</legend>
			<br>
			<div class="row field-subvisit">
			 	<?= $form->field($subvisit, 'total_amount')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Total Amount','tabindex'=>363,'required'=> true,'disabled'=>true,'readOnly'=>true])->label('Tot Amt') ?>
 						
 				<?= $form->field($subvisit, 'less_disc_percent')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Less Disc(%)','tabindex'=>364,'onkeyup'=>'Discountvalidated(this,event);','disabled'=>true])->label('LesDis(%)') ?>
 						
 				<?= $form->field($subvisit, 'less_disc_flat')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Less Discount','tabindex'=>365,'onblur'=>'Discountflatcalculation(this.value);','disabled'=>true])->label('Less Disc') ?>
 						
				<?= $form->field($subvisit, 'net_amt')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Net Amount','tabindex'=>366,'disabled'=>true,'readOnly'=>true])->label('Net Amt') ?>
 						 
				<?= $form->field($subvisit, 'paid_amt')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Paid Amount','tabindex'=>367,'onblur'=>'Paidflatcalculation(this.value);','disabled'=>true])->label('Paid Amt') ?>
 						
 				<?= $form->field($subvisit, 'due_amt')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Due Amount','tabindex'=>368,'disabled'=>true,'readOnly'=>true])->label('Due Amt') ?>
 						
 				<?= $form->field($subvisit, 'pay_mode')->dropDownList($paymenttype,['placeholder'=>'Pay Mode','class' => '  form-control w-cus','placeholder'=>'Pay Mode','tabindex'=>369,'disabled'=>true])->label('Pay Mode') ?>
 				
 				<?= $form->field($subvisit, 'disc_by')->dropDownList(['Both' => 'Both', 'Hospital' => 'Hospital', 'Doctor' => 'Doctor'],['prompt' => '-SELECT-' ,'maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Discount By','disabled'=>true])->label('Disc By') ?>
 						
			 	<?= $form->field($subvisit, 'remarks')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Remarks','disabled'=>true])->label('Remarks') ?>
 				<div id='valitated_authority'>
 					
 				</div>	
 				
 				<?= $form->field($model, 'hide_radio_value')->hiddenInput(['maxlength' => true ])->label(false) ?>
				<?= $form->field($model, 'hide_ucil_id')->hiddenInput(['maxlength' => true ])->label(false) ?>
	 			<?= $form->field($model, 'hide_curr_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
	 			<?= $form->field($model, 'hide_ucil_issue_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
 				
 				<?= $form->field($subvisit, 'cons_status')->hiddenInput(['maxlength' => true,'value'=>'F' ])->label(false) ?>
 				<?= $form->field($model, 'mr_no')->hiddenInput(['maxlength' => true])->label(false) ?>
 			</div>
 			
 			<div class="row field-subvisit">
			 	<span id='2' class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
			 	<span  class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
			 	<span  class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
			 	<span id='3' class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span    class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
			 	<span id='4'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				
			</div>	
						
		</fieldset>
  		</div>
  		<?php }else if(date('Y-m-d') >= $free_up_to){ ?>
  		
  		<div class="row">
  		<fieldset class="scheduler-border">
  			
			<legend class="scheduler-border form-head ">Financial Details</legend>
			<br>
			<div class="row field-subvisit">
			 	<?= $form->field($subvisit, 'total_amount')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Total Amount','tabindex'=>363,'required'=> true,'readOnly'=>true])->label('Tot Amt') ?>
 						
 				<?= $form->field($subvisit, 'less_disc_percent')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Less Disc(%)','tabindex'=>364,'onblur'=>'Discountcalculation(this.value);'])->label('LesDis(%)') ?>
 						
 				<?= $form->field($subvisit, 'less_disc_flat')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Less Discount','tabindex'=>365,'onblur'=>'Discountflatcalculation(this.value);','readonly'=>true])->label('Less Disc') ?>
 						
				<?= $form->field($subvisit, 'net_amt')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Net Amount','tabindex'=>366,'readOnly'=>true])->label('Net Amt') ?>
 						 
				<?= $form->field($subvisit, 'paid_amt')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Paid Amount','tabindex'=>367,'onblur'=>'Paidflatcalculation(this.value);'])->label('Paid Amt') ?>
 						
 				<?= $form->field($subvisit, 'due_amt')->textInput(['maxlength' => true ,'class' => ' number form-control w-cus number','placeholder'=>'Due Amount','tabindex'=>368,'readOnly'=>true])->label('Due Amt') ?>
 						
 				<?= $form->field($subvisit, 'pay_mode')->dropDownList($paymenttype,['placeholder'=>'Pay Mode','class' => '  form-control w-cus','placeholder'=>'Pay Mode','tabindex'=>369])->label('Pay Mode') ?>
 				
 				<?= $form->field($subvisit, 'disc_by')->dropDownList(['Both' => 'Both', 'Hospital' => 'Hospital', 'Doctor' => 'Doctor'],['prompt' => '-SELECT-' ,'maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Discount By'])->label('Disc By') ?>
 						
			 	<?= $form->field($subvisit, 'remarks')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'Remarks'])->label('Remarks') ?>
 				<div id='valitated_authority'>
 					
 				</div>		
 				
 				<?= $form->field($model, 'hide_radio_value')->hiddenInput(['maxlength' => true ])->label(false) ?>
				<?= $form->field($model, 'hide_ucil_id')->hiddenInput(['maxlength' => true ])->label(false) ?>
	 			<?= $form->field($model, 'hide_curr_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
	 			<?= $form->field($model, 'hide_ucil_issue_date')->hiddenInput(['maxlength' => true ])->label(false) ?>
 				
 				<?= $form->field($subvisit, 'cons_status')->hiddenInput(['maxlength' => true,'value'=>'N' ])->label(false) ?>
 				<?= $form->field($model, 'mr_no')->hiddenInput(['maxlength' => true])->label(false) ?>
 			</div>
 			
 			<div class="row field-subvisit">
			 	<span id='2' class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
			 	<span  class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
			 	<span  class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
			 	<span id='3' class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span id='5' class="form-group field-newpatient-mr_no " style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
			 	<span id='4'  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span>
				<span class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				<span  class="form-group field-newpatient-mr_no w-165" style='color: red;font-size: 12px;visibility: hidden;'>Required</span> 
				
			</div>	
				
		</fieldset>
  		</div>
  		
  		<?php  } ?>
  		</div>
  		
  		
  		
  		
					</br>
					 <div class="panel panel-border panel-custom total-area hide"  >
                     <div class="panel-body" style="padding: 0 5px !important;">
                        <div class="row">
						
						
                           <div class="t-10  col-sm-9">
                              <div class="row">
							     
								 <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  > Items: </label>
										<input type="text" class="form-control total_items ansrefrsh" name='total_items' readonly id="no_of_items">
										<input type="hidden" class="form-control total_items ansrefrsh" name='total_items_hidden'  id="no_of_items_hidden">
									</div>
								 </div>
							  
							    <div class="form-group col-sm-1">
									<div class="input-group  ">
										<label class="input-group-addon" style="padding: 0 6px;" > Qty: </label>
										<input type="text" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
										<input type="hidden" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity_hidden'  id="total_quantity_hidden">
									</div>
								 </div>
                                
								  <div class="form-group col-sm-2 gst-cls">
									<div class="input-group  ">
										<label class="input-group-addon"  >  GST: </label>
										<input type="text" style="width: 75px;"  class="form-control total_vat ansrefrsh" name='total_gst' readonly id="total_gst_amount">
										<input type="hidden" style="width: 75px;"  class="form-control total_vat ansrefrsh" name='total_gst_hidden'  id="total_gst_amount_hidden">
									</div>
								 </div>
								 
                               
							  
							   <div class="form-group col-sm-2 " style="padding: 0;left: -25px;">
									<div class="input-group  ">
										
										<label class="input-group-addon" style="    padding: 8px 10px;" >Dis Type: </label>
										<!-- <input type="text" class="form-control  over_all_discount_percent number" name='overall_discount_percent'   id="over_all_discount_percent"> -->
									<ul class="donate-now per_flat_val">
										<li>
											<input type="radio" name="overall_discount_type" style="margin-left: 5px;" id="overall_discount_type_radio" value="F" class="btn btn-success overall_disount">
											<label for="flat_discount"  style="" class=" text-center testrad">F</label>
										</li>
										<li>
											<input type="radio" id="overall_percent_type" class="btn btn-success overall_disount" value="P" name="overall_discount_type">
											<label for="percent_discount" style="" class="text-center testrad">%</label>	
										</li>
									</ul>
									</div>
								 </div>
								 
								 <div class="form-group col-sm-3 val_pre" style="padding: 0;left: -22px;">
									<div class="input-group  ">
										<!-- <label class="input-group-addon"  >Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number" name='total_disc_original'   id="total_discountvalue"> -->
										<label class="input-group-addon"  >%: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent'   id="total_discountvaluetype">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent_hidden'   id="total_discountvaluetype_hidden">
										
										<label class="input-group-addon"  >Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original'   id="total_discountamount">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original_hidden'   id="total_discountamount_hidden">
									</div>
								 </div>
								 
								 	<div class="form-group col-sm-2 hide">
									<div class="input-group  ">
										<label class="input-group-addon"  >Dis Amt: </label>
										<input type="text" style="width: 50px;" class="form-control   total_sub_total ansrefrsh" name=' ' readonly id=" ">
										
									</div>
								 </div>
							  
							  
							  
								 <div class="form-group col-sm-2 " style="    left: 67px;">
									<div class="input-group  ">
										<label class="input-group-addon"  >Sub.Tot</label>
										<input type="text" style="width: 90px;"   class="form-control total_sub_total ansrefrsh" name='total_sub_total' readonly id="total_sub_total">
										<input type="hidden" style="width: 90px;"   class="form-control total_sub_total ansrefrsh" name='total_sub_total_hidden' id="total_sub_total_hidden">
									</div>
								 </div>
							  
                                </div>
                           </div>
                           <div class="t-10  col-sm-3" style="    right: -24px;">
						   
                           
							  <!-- <div class=" col-sm-1"></div> -->
						  <div class="form-group col-sm-12">
									<div class="input-group  ">
										<label class="input-group-addon bg-primary" style="color:#fff;" >Net Amt : </label>
										<input type="text" style="width: auto;" class="form-control total-netamt ansrefrsh bg-primary" name='total_net_amount' style="color: #fff;font-size: 14pt;" readonly id="total_net_amount">
										<input type="hidden" class="form-control total-netamt ansrefrsh bg-primary" name='total_net_amount_hidden' style="color: #fff;font-size: 14pt;"  id="total_net_amount_hidden">
									</div>
								 </div>
							  
                           </div>
                        </div>
                        <br>
                        <div class='row'>
                        	<div class='col-sm-1 pull-right print_rules'>
                        		
                        	</div>
                        	
                        </div>
                     </div>
                  </div>
					 <div class="row">
					 <div class="form-group col-md-12 text-right"  style="    width: 100%;    position: relative;right: 30px;">
				 
			        <?= Html::Button('Save', ['id'=>'save_data','class' => 'btn btn-success btn-xm ','style'=>'position:relative;float:right;','onclick'=>'Save_data()']) ?>
    			</div>	
    			</div>	
						
					</span>
				
			</div>
		</div>
		
		
		
		
		
	</div>

		 	
	</div>
	
	
	
	<!--Patient Pop-Up-->
	
<div class="modal" id='modal_sub_visit' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content ucil_popup">
      <div class="modal-header">
        <h5 class="modal-title">Patient Details</h5>
      </div>
      <div class="modal-body">
      		<div class="col-md-12 text-right">
      			<table class="table table-bordered">
				    <tbody>
				      <tr>
				        <th>MR NUMBER</th>
				        <td style="color: #1b00ff;font-weight: bold;"><?php echo $model->mr_no; ?></td>
				         <th>Name</th>
				        <td style="color: #1b00ff;font-weight: bold;"><?php echo $model->pat_inital_name.' '.$model->patientname; ?></td>
				      </tr>
				      <tr>
				        <th>DOB</th>
				        <td><?php echo date('d-m-Y',strtotime($model->dob)); ?></td>
				         <th>Age</th>
				        <td><?php echo $model->pat_age; ?></td>
				      </tr>
				      <tr>
				        <th>Relation</th>
				        <td><?php echo $model->pat_relation; ?></td>
				         <th>Relation Name</th>
				        <td><?php echo $model->par_relationname; ?></td>
				      </tr>
				      <tr>
				      	 <th>Gender</th>
				        <td><?php echo $model->pat_sex; ?></td>
				        <th>Martial Status</th>
				        <td><?php echo $model->pat_marital_status; ?></td>
				      </tr>
				      <tr>
				       
				      </tr>
				      <tr>
				        <th>City</th>
				        <td><?php $pat_city = (!empty($model->pat_city)) ? $model->pat_city :'-Nil-'; echo $pat_city; ?></td>
				         <th>State</th>
				        <td><?php $pat_state = (!empty($model->pat_state)) ? $model->pat_state :'-Nil-'; echo $pat_state; ?></td>
				      </tr>
				      <tr>
				        <th>Mobile Number</th>
				        <td><?php echo $model->pat_mobileno; ?></td>
				        <th>Address</th>
				        <td><?php $pat_address = (!empty($model->pat_address)) ? $model->pat_address :'-Nil-'; echo $pat_address; ?></td>
				      </tr>
				   
				      <tr>
				        <th>Pincode</th>
				        <td><?php $pat_pincode = (!empty($model->pat_pincode)) ? $model->pat_pincode :'-Nil-'; echo $pat_pincode; ?></td>
				          <th>Phone Number</th>
				        <td><?php $pat_phone = (!empty($model->pat_phone)) ? $model->pat_phone :'-Nil-'; echo $pat_phone; ?></td>
				      </tr>
				      <tr>
				      
				      </tr>
				      <tr>
				        <th>Email</th>
				        <td><?php $pat_email = (!empty($model->pat_email)) ? $model->pat_email :'-Nil-'; echo $pat_email; ?></td>
				          <th>Source</th>
				        <td><?php $pat_source = (!empty($model->pat_source)) ? $model->pat_source :'-Nil-'; echo $pat_source; ?></td>
				      </tr>
				      <tr>
				      
				      </tr>
				      <tr>
				        <th>Occupation</th>
				        <td><?php $pat_occupation = (!empty($model->pat_occupation)) ? $model->pat_occupation :'-Nil-'; echo $pat_occupation; ?></td>
				        <th>Education</th>
				        <td><?php $pat_education = (!empty($model->pat_education)) ? $model->pat_education :'-Nil-'; echo $pat_education; ?></td>
				      </tr>
				      <tr>
				        <th>PAN NO</th>
				        <td><?php $pancard = (!empty($model->fin_pancardno)) ? $model->fin_pancardno :'-Nil-'; echo $pancard; ?></td>
				        <th>Aadhar</th>
				        <td><?php $fin_aadhar_card = (!empty($model->fin_aadhar_card)) ? $model->fin_aadhar_card :'-Nil-'; echo $fin_aadhar_card; ?></td>
				      </tr>
				    </tbody>
				 </table>
      	  	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
      </div>
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
      	   	<?= $form->field($subvisit, 'ucil_letter_status')->radio(['label' => 'Yes', 'value' => 1,'onclick'=>'ShowyesUCIL(this.value);'])?>
      	   				
      	   </div>
      	   <div class="col-md-2 text-right">
      	    <?= $form->field($subvisit, 'ucil_letter_status')->radio(['id'=>'subvisit-ucilval1','label' => 'No', 'value' => 0,'onclick'=>'ShowyesUCIL(this.value);'])?>
      	    </div>
      	   <div class="form-deails">
      	   	<?= $form->field($subvisit, 'ucil_emp_id')->textInput(['maxlength' => true ,'class' => '  form-control w-cus','placeholder'=>'UCIL Emp ID'])->label(false) ?>
 			<?= $form->field($subvisit, 'patient_date')->textInput(['maxlength' => true ,'class' => ' form-control w-cus','placeholder'=>'Today Date','readOnly'=>true])->label(false) ?>
 		
 			<?= $form->field($subvisit, 'ucil_date')->textInput(['data-date-format'=>"mm/dd/yyyy",'maxlength' => true ,'class' => ' datepicker form-control w-cus number','placeholder'=>'Issue Date'])->label(false) ?>
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


<!--Show Sub Visit Number-->
<div class="modal" id='mr_modal' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Medical Record Number Generated</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" style="color:red;font-size:20px;">Sub Visit Number is <span id='show_mrnumber'> </span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  


<!--Common Search-->
<div id="patient_hist-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Identification List</h4>
      </div>
      <div class="modal-body">
      	
      	<input onkeyup="Patient_List_Show(this)" type="text" style='width: 60% !important;margin: auto;margin-bottom: 30px;' name="patient_field_record" id='patient_common_search' class="form-control" placeholder="Enter Patient Name,Ph.No,Sub-Visit">
      	
        <div class="" id="patient_history_report">
            	<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th>MR Number</th>
				    <th>Patient Name</th>
				    <th>Mobile Number</th>
				    <th>Address</th>
				    <th>Last Date Visit</th>
				    <th>Action</th>
				  </tr>
				</thead>
				<tbody id='set_patient_data'>
				  <!--new table start-->
				  
				  <!--new table end-->
				</tbody>
				</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




    <?php ActiveForm::end(); ?>

</div>
 
   
   <script>
   	 var ty = $("#subvisit-insurance_type").val();
    if(ty==="1"){ //alert(ty);
      $('#.subvisit-ucil_emp_id').css({ "display": "block" });
    }

   	$('#validated_refferal').hide();
    $('#validated_refferal_expiry').hide();
   
   
	$('#subvisit-insurance_type').attr('style','pointer-events:none;');
	
	//Hide UCIL Required Field
	$('#req_all_val').hide();
	
	//UCIL Form Hide Default
	$('#subvisit-ucil_emp_id').hide();
    $('#subvisit-patient_date').hide();
    $('#subvisit-ucil_date').hide();
	
	//Side Menu Toggle  
	$("body").addClass("fixed-left-void");
	$("body").removeClass("fixed-left");
	$("#wrapper").addClass("enlarged");
    $("#wrapper").addClass("forced");   			
    $(".list-unstyled").css("display","none");
	 
	 
	 $(document).ready(function()
	 { 
			$('.datepicker').datepicker
			({
		    	format: 'dd-mm-yyyy',
			});
			
			$("body").on('keypress', '.number', function (e) 
			{
				//if the letter is not digit then display error and don't type anything
				if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
				{
				 	return false;
				}
		    });  
		    
		    
		   
						
	<?php 
		if($subvisit_last_date['insurance_type'] == '1'){
		if($subvisit_last_date['ucil_letter_status'] == 'YES'){
   		$issue_date=date_create(date('Y-m-d',strtotime($subvisit_last_date['ucil_date'])));
   		date_add($issue_date,date_interval_create_from_date_string("10 days"));
		$issue_date=date_format($issue_date,"Y-m-d");
		if($issue_date < date('Y-m-d')){
	?>
			alert('Refferal Letter Is Expired');
   			// $('#validated_refferal_expiry').show();
   			$modal=$('#mr_modal_ucil');
			$modal.modal('show');	
			  $('#newpatient-hide_radio_value').val('NO');
				$('#newpatient-hide_ucil_id').val('<?php echo $subvisit_last_date['ucil_emp_id'];?>');
   <?php }else { ?>
   			<?php if($subvisit_last_date['ucil_letter_status'] == 'YES'){?>
	   			$('#newpatient-hide_radio_value').val('YES');
				$('#newpatient-hide_ucil_id').val('<?php echo $subvisit_last_date['ucil_emp_id'];?>');
				$('#newpatient-hide_curr_date').val('<?php echo $subvisit_last_date['patient_date'];?>');
				$('#newpatient-hide_ucil_issue_date').val('<?php echo $subvisit_last_date['ucil_date'];?>');
				
			<?php }else if($subvisit_last_date['ucil_letter_status'] == 'NO'){ ?>
				
				$('#newpatient-hide_radio_value').val('NO');
				$('#newpatient-hide_ucil_id').val('<?php echo $subvisit_last_date['ucil_emp_id'];?>');
				
			<?php } ?>
   <?php } ?>   
   <?php } else if($subvisit_last_date['ucil_letter_status'] == 'NO') {?>
   			
   	
		  alert('Refferal Letter Not Given'); 
		  $('#newpatient-hide_radio_value').val('NO');
				$('#newpatient-hide_ucil_id').val('<?php echo $subvisit_last_date['ucil_emp_id'];?>');
			
		   //$('#validated_refferal').show();
	<?php } }?>
		    
	 }); 
	  //Patient Details Brief
	function View()
	{
	  	$modal=$('#modal_sub_visit');
		$modal.modal('show');
	}
	  
   	  //Consultant
   	function Specialization(dateString) 
	{
		
		if(dateString != '')
		{
			var last_consulted_doctor='<?php echo $subvisit_last_date['consultant_doctor'];?>';
			
			if(last_consulted_doctor != dateString)
			{
				$('#subvisit-total_amount').removeAttr("disabled");
				$('#subvisit-less_disc_percent').removeAttr("disabled");
				$('#subvisit-less_disc_flat').removeAttr("disabled");
				$('#subvisit-less_disc_flat').removeAttr("disabled");
				$('#subvisit-net_amt').removeAttr("disabled");
				$('#subvisit-paid_amt').removeAttr("disabled");
				$('#subvisit-due_amt').removeAttr("disabled");
				$('#subvisit-pay_mode').removeAttr("disabled");
				$('#subvisit-disc_by').removeAttr("disabled");
				$('#subvisit-remarks').removeAttr("disabled");
				
				var ins_id=$('#subvisit-insurance_type').val();
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
				        			$('#subvisit-department').html(obj[0]);
					        		$('#subvisit-total_amount').val(obj[2]);
					        		$('#subvisit-less_disc_percent').val('0');
					        		$('#subvisit-less_disc_flat').val('0');
					        		$('#subvisit-net_amt').val(obj[2]);
					        		$('#subvisit-paid_amt').val('0');
					        		$('#subvisit-due_amt').val('0');
					        	}
			        		}
			        		else if(ins_id == '1')
				        	{
				        		if(radio_val_ucil != '')
			        			{
			        				if(radio_val_ucil == 'YES' || radio_val_ucil == 'NO')
			        				{
			        					$('#subvisit-department').html(obj[0]);
					        			$('#subvisit-total_amount').val(150);
					        			$('#subvisit-less_disc_percent').val(0);
					        			$('#subvisit-less_disc_flat').val(0);
					        			$('#subvisit-net_amt').val(150);
					        			$('#subvisit-paid_amt').val(0);
					        			$('#subvisit-due_amt').val(150);
					        						
			        				}
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
			else if(last_consulted_doctor == dateString)
			{
			
				<?php if(date('Y-m-d') <= $free_up_to || date('Y-m-d') == $free_up_to){ ?>
				$('#subvisit-total_amount').attr( 'disabled', 'disabled' );
				$('#subvisit-less_disc_percent').attr( 'disabled', 'disabled' );
				$('#subvisit-less_disc_flat').attr( 'disabled', 'disabled' );
				$('#subvisit-less_disc_flat').attr( 'disabled', 'disabled' );
				$('#subvisit-net_amt').attr( 'disabled', 'disabled' );
				$('#subvisit-paid_amt').attr( 'disabled', 'disabled' );
				$('#subvisit-due_amt').attr( 'disabled', 'disabled' );
				$('#subvisit-pay_mode').attr( 'disabled', 'disabled' );
				$('#subvisit-disc_by').attr( 'disabled', 'disabled' );
				$('#subvisit-remarks').attr( 'disabled', 'disabled' );
				<?php } ?>
			
				$('#subvisit-total_amount').val('');
				$('#subvisit-less_disc_percent').val('');
				$('#subvisit-less_disc_flat').val('');
				$('#subvisit-less_disc_flat').val('');
				$('#subvisit-net_amt').val('');
				$('#subvisit-paid_amt').val('');
				$('#subvisit-due_amt').val('');
				$('#subvisit-pay_mode').val('');
				$('#subvisit-disc_by').val('');
				$('#subvisit-remarks').val('');
				
				var ins_id=$('#subvisit-insurance_type').val();
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
				        			$('#subvisit-department').html(obj[0]);
				        			<?php if(date('Y-m-d') > $free_up_to){ ?>
				        				
					        		
					        		$('#subvisit-total_amount').val(obj[2]);
					        		$('#subvisit-less_disc_percent').val('0');
					        		$('#subvisit-less_disc_flat').val('0');
					        		$('#subvisit-net_amt').val(obj[2]);
					        		$('#subvisit-paid_amt').val('0');
					        		$('#subvisit-due_amt').val('0');
					        		<?php }elseif(date('Y-m-d') < $free_up_to) { ?>
					        			
					        		$('#subvisit-total_amount').val('');
					        		$('#subvisit-less_disc_percent').val('');
					        		$('#subvisit-less_disc_flat').val('');
					        		$('#subvisit-net_amt').val('');
					        		$('#subvisit-paid_amt').val('');
					        		$('#subvisit-due_amt').val('');
					        		
					        		<?php }elseif(date('Y-m-d') == $free_up_to) { ?>
					        		
					        		$('#subvisit-total_amount').val('');
					        		$('#subvisit-less_disc_percent').val('');
					        		$('#subvisit-less_disc_flat').val('');
					        		$('#subvisit-net_amt').val('');
					        		$('#subvisit-paid_amt').val('');
					        		$('#subvisit-due_amt').val('');
					        		<?php } ?>
					        	}
			        		}
			        		else if(ins_id == '1')
				        	{
				        		if(radio_val_ucil != '')
			        			{
				        			$('#subvisit-department').html(obj[0]);
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
			else
			{
				var ins_id=$('#subvisit-insurance_type').val();
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
				        			$('#subvisit-department').html(obj[0]);
				        			<?php if(date('Y-m-d') >= $free_up_to){ ?>
					        		$('#subvisit-total_amount').val(obj[2]);
					        		$('#subvisit-less_disc_percent').val('0');
					        		$('#subvisit-less_disc_flat').val('0');
					        		$('#subvisit-net_amt').val(obj[2]);
					        		$('#subvisit-paid_amt').val('0');
					        		$('#subvisit-due_amt').val('0');
					        		<?php } ?>
					        	}
			        		}
			        		else if(ins_id == '1')
				        	{
				        		if(radio_val_ucil != '')
			        			{
				        			$('#subvisit-department').html(obj[0]);
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
	   	else if(dateString == '')
	   	{
	   			$('#subvisit-department').html('<option value="">-Specialized-</option>');
        		$('#subvisit-total_amount').val('');
        		$('#subvisit-less_disc_percent').val('');
        		$('#subvisit-less_disc_flat').val('');
        		$('#subvisit-net_amt').val('');
        		$('#subvisit-paid_amt').val('');
        		$('#subvisit-due_amt').val('');
	   	}			
	}
	
	//Patient Module	
  	function Patienttypemodule(data_value) 
    {
    	if(data_value == '3')
    	{
    		$('#subvisit-insurance_type').removeAttr('style');

        var ty = $("#subvisit-insurance_type").val();
      if(ty==="1"){
        $('.field-subvisit-ucil_emp_id').show();
      }else{
        $('.field-subvisit-ucil_emp_id').hide();
      }
    }
    	else
    	{
        $('.field-subvisit-ucil_emp_id').hide();
    		$("#subvisit-insurance_type").val("");
    		$('#subvisit-insurance_type').attr('style','pointer-events:none;');
    		
    	}
    }
    
    
    //UCIL Module	
  	function UCIL(data_value) 
    {
    	if(data_value == '1')
    	{
     
      $('.field-subvisit-ucil_emp_id').show();
       
    	$('#subvisit-total_amount').val('');
			$('#subvisit-less_disc_percent').val('');
			$('#subvisit-less_disc_flat').val('');
			$('#subvisit-net_amt').val('');
			$('#subvisit-paid_amt').val('');
			$('#subvisit-due_amt').val('');
    		
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
      $('.field-subvisit-ucil_emp_id').hide();
    	$('#subvisit-total_amount').val('');
			$('#subvisit-less_disc_percent').val('');
			$('#subvisit-less_disc_flat').val('');
			$('#subvisit-net_amt').val('');
			$('#subvisit-paid_amt').val('');
			$('#subvisit-due_amt').val('');
			
			//Empty value
    		$('#newpatient-hide_radio_value').val('');
			$('#newpatient-hide_ucil_id').val('');
			$('#newpatient-hide_curr_date').val('');
			$('#newpatient-hide_ucil_issue_date').val('');
    		
    	}
    }
    
    //ShowUCIL
  	function ShowyesUCIL(data_value) 
    {
    	if(data_value == '1')
    	{
	       $('#subvisit-ucil_emp_id').show();
		   $('#subvisit-patient_date').show();
		   $('#subvisit-ucil_date').show();
		   
		    var dt=new Date();
	    	var date=dt.getDate();
	    	var month=dt.getMonth()+1;
	    	var year=dt.getFullYear();
	    	$('#subvisit-patient_date').val(date+'-'+month+'-'+year); 
    	}
    	else if(data_value == '0')
    	{
	       $('#subvisit-ucil_emp_id').show();
		   $('#subvisit-patient_date').hide();
		   $('#subvisit-ucil_date').hide();
		   
		   //$('#newpatient-ucil_id').val('');
	       $('#subvisit-patient_date').val('');
		   $('#subvisit-ucil_date').val(''); 
    	}
    }
    
    
    //Save UCIL in Another Field
  	function SaveUCIL() 
    {
  		if ($("#subvisit-ucil_letter_status").is(":checked"))
  		{
  			var UCIL_id=$('#subvisit-ucil_emp_id').val(); 
  			var Curr_date=$('#subvisit-patient_date').val();
		   	var Issue_date=$('#subvisit-ucil_date').val(); 
  			
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
				    			<?php if(date('Y-m-d') >= $free_up_to){ ?>
				    			$('#subvisit-total_amount').val('150');
								$('#subvisit-less_disc_percent').val('0');
								$('#subvisit-less_disc_flat').val('0');
								$('#subvisit-net_amt').val('150');
								$('#subvisit-paid_amt').val('0');
								$('#subvisit-due_amt').val('150');
				    			<?php } ?>
				    			$modal.modal('hide');	
				    		}
				    		else if(result == 'EXP')
				    		{
				    			$('#subvisit-ucil_date').val('');
				    			alert('Referral Letter is Expiry');
				    			return false;
				    		} 
				    		else if(result == 'INV')
				    		{
				    			$('#subvisit-ucil_date').val('');
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
  		else if($("#subvisit-ucilval1").is(":checked"))
  		{
  			var UCIL_id=$('#subvisit-ucil_emp_id').val(); 
  			if(UCIL_id != '')
  			{
  				$('#newpatient-hide_radio_value').val('NO');
  				$('#newpatient-hide_ucil_id').val(UCIL_id);
  				
  				//Consultant Amount
    			$('#subvisit-total_amount').val('150');
				$('#subvisit-less_disc_percent').val('0');
				$('#subvisit-less_disc_flat').val('0');
				$('#subvisit-net_amt').val('150');
				$('#subvisit-paid_amt').val('0');
				$('#subvisit-due_amt').val('150');
    			
  				
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
  	
  	//Percent Calculation
	function Discountcalculation(dateString) 
	{	
		if(dateString != '')
		{
			var total_amount=parseInt($('#subvisit-total_amount').val());
			var total_percent_disc=parseInt(dateString);
			
			//Calculation
			var calc=parseInt(total_amount*total_percent_disc);
			var div=parseInt(calc/100);
			
			$('#subvisit-less_disc_flat').val(div);
			
			//Flat Disc Cal
			var sub=total_amount-div;
			$('#subvisit-net_amt').val(sub);
		}
	}
	
	
	//Flat Calculation
	function Discountflatcalculation(dateString) 
	{	
		if(dateString != '')
		{
			var total_amount=parseInt($('#subvisit-total_amount').val());
			var total_percent_disc=parseInt(dateString);		
			
			//Calculative Percent
			var calc=parseInt(total_percent_disc*100);
			var tot_amt=parseFloat(calc/total_amount);
			
			var tot_rounded=Math.ceil(tot_amt);
			$('#subvisit-less_disc_percent').val(tot_rounded);
			
			var sub=total_amount-total_percent_disc;
			$('#subvisit-net_amt').val(sub);	
		}
	}
	
	
	//Flat Calculation
	function Paidflatcalculation(dateString) 
	{	
		if(dateString != '')
		{
			var net_Amt=parseInt($('#subvisit-net_amt').val());
			var paid_amt=parseInt(dateString);
			
			if(net_Amt >= paid_amt)
			{
				var calc=parseInt(net_Amt-paid_amt);
				$('#subvisit-due_amt').val(calc);
			}	
		}
	}
	
	
	function Save_data()
	{
	  <?php if(date('Y-m-d') < $free_up_to){ ?>
	 	
	  	var consultant=$('#subvisit-consultant_doctor').val();
  		var depart=$('#subvisit-department').val();
  		
  		
  		var validated_array = new Array(consultant,depart);
  		var equality=0;
  		
  		for (var i=0; i < validated_array.length; i++) 
  		{
			if(validated_array[i] == '')
			{
				 var element = document.getElementById(i);
				 element.style.visibility = 'visible';
			}
			else
			{
				var element = document.getElementById(i);
				element.style.visibility = 'hidden';
				equality++;	
			}
		}
	<?php }else if(date('Y-m-d') > $free_up_to){ ?>

	
		var consultant=$('#subvisit-consultant_doctor').val();
  		var depart=$('#subvisit-department').val();
  		var tot_amt=$('#subvisit-total_amount').val();
  		var net_amt=$('#subvisit-net_amt').val();
  		var due_amt=$('#subvisit-due_amt').val();
  		var paid_amt=$('#subvisit-paid_amt').val();
  		
  		var validated_array = new Array(consultant,depart,tot_amt,net_amt,due_amt,paid_amt);
  		var equality=0;
  		alert(validated_array.length);
  		for (var i=0; i < validated_array.length; i++) 
  		{
			if(validated_array[i] == '')
			{
				 var element = document.getElementById(i);
				 element.style.visibility = 'visible';
			}
			else
			{
				var element = document.getElementById(i);
				element.style.visibility = 'hidden';
				equality++;	
			}
		}
	
	<?php } if(date('Y-m-d') == $free_up_to) { ?>	
		
		var consultant=$('#subvisit-consultant_doctor').val();
  		var depart=$('#subvisit-department').val();
  		
  		
  		var validated_array = new Array(consultant,depart);
  		var equality=0;
  		
  		for (var i=0; i < validated_array.length; i++) 
  		{
			if(validated_array[i] == '')
			{
				 var element = document.getElementById(i);
				 element.style.visibility = 'visible';
			}
			else
			{
				var element = document.getElementById(i);
				element.style.visibility = 'hidden';
				equality++;	
			}
		}
	<?php } ?>
		
		if(validated_array.length == equality)
		{
			var valid=$("#w0").valid(); 
			if(valid == true)
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
					        	$('#subvisit-patient_type').val(obj[1]['patient_type']);
					        	$('#subvisit-insurance_type').val(obj[1]['insurance_type']);
                    $('#subvisit-ucil_emp_id').val(obj[1]['hide_ucil_id']);
					        	$('#subvisit-consultant_time').val(obj[1]['consultant_time']);
					        	$('#subvisit-consultant_doctor').val(obj[1]['consultant_doctor']);
					        	$('#subvisit-department').val(obj[1]['department']);
					        	$('#subvisit-con_turn').val(obj[1]['con_turn']);
					        	$('#subvisit-total_amount').val(obj[1]['total_amount']);
					        	$('#subvisit-less_disc_percent').val(obj[1]['less_disc_percent']);
					        	$('#subvisit-less_disc_flat').val(obj[1]['less_disc_flat']);
					        	$('#subvisit-net_amt').val(obj[1]['net_amt']);
					        	$('#subvisit-paid_amt').val(obj[1]['paid_amt']);
					        	$('#subvisit-due_amt').val(obj[1]['due_amt']);
					        	$('#subvisit-pay_mode').val(obj[1]['pay_mode']);
					        	$('#subvisit-disc_by').val(obj[1]['disc_by']);
					        	$('#subvisit-remarks').val(obj[1]['remarks']);
					        	
					        	var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/subvistreportpdf&id='+obj[1]['sub_id'];
	    						window.open(url,'_blank');
					        	
					        	
					        	$('#show_mrnumber').html(obj[1]['sub_visit']);
					        	$('#mr_modal').modal({backdrop: 'static', keyboard: false});
								$("#save_data").attr("disabled", "disabled");
								
								
							} 	
				        },
				        error: function () 
				        {
				            alert("Something went wrong");
				        }
		   		   });
			}
		}
	}
	
	
	function Patient_details(event,e)
	{
		if(event.keyCode == 13 && e.value != '')
		{
			var mrnumber=e.value;
			var encodemrnumber=encodeURIComponent(mrnumber);
			$.ajax
			({
    			type: 'POST',
		        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/fetchmrnumber&mrnumber=";?>"+encodemrnumber,
		        success: function (result) 
		        {
		        	
		    		if(result == '[]')
	            	{
	            		$('#pat_name').val('');
	            		$('#pat_mob').val('');
	            		$('#pat_doctor').val('');
	            		$('#pat_insurance').val('');
	            		$('#pat_dob').val('');
	            		$('#history_detils').attr('dataID','');
	            		alert('Invalid MR Number');
	            		return false;
	            	}
	            	else
	            	{
	            		var obj = $.parseJSON(result);
	            		
	            		if(obj[6] == 'N')
	            		{
	            			$('#pat_name').val(obj[0]);
			           		$('#pat_mob').val(obj[1]);
			           		$('#pat_doctor').val(obj[2]);
							
			           		if(obj[3] != '01-01-1970')
			           		{
			           			$('#pat_dob').val(obj[3]);
			           		}
			           		document.getElementById('pat_insurance').innerHTML=obj[4];
			           		
			           		$('#history_detils').attr('dataID',obj[5]);
			           		//$('#history_detils').focus();
			           		//Patient_reload();
			           		var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/sub-visit&id='+obj[5];
		    				//alert(url);
		    				window.open(url);
	            		}
	            		else if(obj[6] == 'Y')
	            		{
	            			alert('This Patient Temporary Blocked');
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
	
	
	function Patient_reload()
	{
		var id=$('#history_detils').attr('dataid');
		
		if(id != '')
		{
			var attribute_value=encodeURIComponent(id);
			var href_url="<?php echo Yii::$app->homeUrl . "?r=newpatient/sub-visit&id=";?>"+attribute_value;
			$('#history_detils').attr('href',href_url);
		}
		else if(id == '')
		{
			window.location.reload();
		}
		
	}
	
 function Patient_modal()
 {
 	$('#patient_common_search').val('');
 	$('#set_patient_data tr').remove();
 	$modal = $('#patient_hist-modal');
	$modal.modal('show');
 }
 
 function Patient_List_Show(e)
 {
 	if(e.value != '')
 	{
 		$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=sales/patientkey&id=";?>"+e.value,
        success: function (result) 
        { 
        	var obj = JSON.parse(result);
			$('#set_patient_data').html(obj);
        }
    	});
 	}
 	
 }
 
 function Select_Patient(sub_id)
 {
 	 if(sub_id != '')
 	 {
 	 	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=sales/patientvalueset&id=";?>"+sub_id,
        success: function (result) 
        { 
        	var obj = JSON.parse(result);
        	$('#mrnumber').val(obj[5]);
        	$('#pat_name').val(obj[0]);
        	$('#pat_mob').val(obj[1]);
        	$('#pat_doctor').val(obj[2]);
        	$('#pat_insurance').html(obj[3]);
        	$('#pat_dob').val(obj[4]);
        	
        	$('#history_detils').attr('dataID',obj[6]);
        	
        	$('#patient_common_search').val('');
		 	$('#set_patient_data tr').remove();
		 	$modal = $('#patient_hist-modal');
			$modal.modal('hide');
        }
    	});
 	 }
 }
 
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
	
	
	function Discountvalidated(e,event)
	{
		
		
		var total_amount=parseInt($('#subvisit-total_amount').val());
		if(!isNaN(total_amount))
		{
			if(e.value != '')
			{
				if(e.value >= 100)
				{
					
					var total_percent_disc=parseInt(100);
					//Calculation
					var calc=parseInt(total_amount*total_percent_disc);
					var div=parseInt(calc/100);
						
					$('#subvisit-less_disc_flat').val(div);
						
					//Flat Disc Cal
					var sub=total_amount-div;
					$('#subvisit-net_amt').val(sub);
						
					var validated='<div class="form-group field-newpatient-fin_paycategory w-165"><label class="control-label col-sm-6" for="newpatient-fin_paycategory">Authority</label>'
								   +'<input type="text" onkeyup="Authority()" id="newpatient-fin_paycategory" required class="form-control w-cus" name="Newpatient[fin_paycategory]" placeholder="Authority" tabindex="371">'
								   +'<div class="help-block"></div></div><div class="form-group field-newpatient-fin_cardial w-165"><label class="control-label col-sm-6" for="newpatient-fin_cardial">Reason</label>'
								   +'<input type="text" id="newpatient-fin_cardial" required class="form-control w-cus" name="Newpatient[fin_cardial]" placeholder="Reason" tabindex="372">'
								   +'<div class="help-block"></div></div>';
						
					$('#valitated_authority').html(validated);
					$('#subvisit-less_disc_percent').val(100);
				}
				else if(e.value > 0  ||e.value <= 100)
				{
					var total_percent_disc=parseInt(e.value);
					//Calculation
					var calc=parseInt(total_amount*total_percent_disc);
					var div=parseInt(calc/100);
						
					$('#subvisit-less_disc_flat').val(div);
						
					//Flat Disc Cal
					var sub=total_amount-div;
					$('#subvisit-net_amt').val(sub);
						
					var validated='<div class="form-group field-newpatient-fin_paycategory w-165"><label class="control-label col-sm-6" for="newpatient-fin_paycategory">Authority</label>'
								   +'<input type="text" onkeyup="Authority()" id="newpatient-fin_paycategory" required class="form-control w-cus" name="Newpatient[fin_paycategory]" placeholder="Authority" tabindex="371">'
								   +'<div class="help-block"></div></div><div class="form-group field-newpatient-fin_cardial w-165"><label class="control-label col-sm-6" for="newpatient-fin_cardial">Reason</label>'
								   +'<input type="text" id="newpatient-fin_cardial" required class="form-control w-cus" name="Newpatient[fin_cardial]" placeholder="Reason" tabindex="372">'
								   +'<div class="help-block"></div></div>';
						
					$('#valitated_authority').html(validated);
				}
				else if(e.value == 0  ||e.value != '')
				{
					
					$('#subvisit-less_disc_flat').val(0);
					$('#subvisit-net_amt').val(total_amount);
				
					$('#valitated_authority div').remove();
				}
						 			
			}
			else
			{
				
				$('#subvisit-less_disc_flat').val(0);
				$('#subvisit-net_amt').val(total_amount);
				
				$('#valitated_authority div').remove();
			}
				
		}
		
		if(e.value == 0)
		{
			$('#subvisit-less_disc_flat').val(0);
				$('#subvisit-net_amt').val(total_amount);
				
				$('#valitated_authority div').remove();
		}
	}
 </script>
<style>
   .modal-dialog {
    	width: 750px;
   }
   button.btn.btn-xs.btn-secondary {
    	padding: 5px 10px;
    	background: #da5858;
    	color: #fff;
	}
</style>