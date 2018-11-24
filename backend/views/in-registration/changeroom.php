<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\InBedno;
use backend\models\InRoomtypes;
use backend\models\InRoomno;
use backend\models\InCategory;
use backend\models\InFloormaster;
use yii\helpers\ArrayHelper;

?>
  
<link href="<?php echo Url::base(); ?>/validation_plugin/site-demos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>  
<!-- <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" /> -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />
<script  src="ubold/dist/js/select2.js"></script>


<style>

table.dataTable th.focus,
table.dataTable td.focus {
  outline: none;
}
.patient_details .form-group label.error {
    text-align: right;
    float: right;
}
.dataTables_wrapper .dataTables_paginate .paginate_button{
	    padding: 0;
}
table#example tr.selected td {
    background: #4e60e8;
    color: #fff;
}
.patient_details {
    border: 1px solid #eee;     margin-bottom: 20px;
}
.patient_details .head {
    background:#4682b4;
 
    padding: 3px 0;
    font-size: 12px;
}
button.btn.btn-success.physician {
    padding: 1px 4px;
}
.patient_details .head span {
    background: #4682b4;
    position: relative;
    /*top: -10px;
    left: 15px; */
    padding: 3px 15px;
    font-weight: normal;
    color: #fff;
}
.form-group label.control-label {
    font-size: 12px;
}
.form-group {
    margin-bottom: 0;
}
.patient_details .form-group label.control-label {
    width: 37%;
    float: left;
    text-align: right;
    margin-right: 10px;
}
.patient_details .form-group input,.patient_details .form-group select,.patient_details .form-group textarea {
    padding: 0 8px;
    height: 25px;
    width: 56%;
    border-top: none;
    border-left: none;
    border-right: none;
}
.dob {
    /* float: right;
    margin-bottom: 6px; */
}
.dob input{
	border-top: none;
    border-left: none;
    border-right: none;
}
.mid-width {
    width: 12.5%;
}
.form-group textarea {
    height: 46px;
    min-height: 30px;
}
.patient_btn {
    /* padding: 0 0 10px 0; */
}
.patient_btn>.form-group{
	/* float: right; */
}
.form-group.field-inregistration-ip_no,.form-group.field-inregistration-bed_no,.form-group.field-inregistration-room_no,
.form-group.field-inregistration-consultant_dr,.form-group.field-inregistration-dr_unit,.form-group.field-inregistration-speciality,
.form-group.field-inregistration-co_consultant{
    /* width: 84%;
    float: left; */
}
.form-group.field-inregistration-address label.control-label,.form-group.field-inregistration-remarks label.control-label {
    text-align: left;
}

.patient_details .col-md-3 .form-group {
    padding: 0 10px;
}
.patient_details .col-md-3 {
    padding: 0 0;
    border-right: 1px solid #eee;
    min-height: 500px;
}
.ogs_name{
	display: none;
}
.patient_details .col-md-4 {
    border-right: 1px solid #d6d6d6;
    padding: 0px 0;
}
.btn-bk {
    background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
}

</style>
<div class="container">
 <!-- <div class="row">
   <div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
	<ol class="breadcrumb" >
									 <li><a href="<?php // echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php // echo $this->title;?></a></li>
								</ol>
		 	</div>
		<div class="col-sm-6 text-right ">
		<a href="<?php // echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/index" class="btn text-right btn-default btn-bk" Title="BACK To Grid">Back to Grid </a> 
		</div>
   </div>  -->
   <div class="row">
     
   
     <?php $form = ActiveForm::begin(); ?>
     
	 
	 <!-- PATIENT DETAILS -->
	 <div class="col-sm-6">
	   <div class="panel panel-border panel-custom">
		  <div class="panel-heading">
			<h5 class="box-title"><strong>Patient Details</strong></h5> 
		  </div>
	      <div class="panel-body"> 
		    <div class="row">
			  <div class="col-sm-6">
			    <label class="control-label">IP No</label><br>  
			    <div class="input-group input-group-sm">							   
				   <?= $form->field($model, 'ip_no')->textInput(['class'=>'ipnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true])->label('') ?>
				   <span class="input-group-btn"  >
					 <button type="button"   class="btn inp btn-default patient_fetch_details"><i class="ssearch glyphicon glyphicon-search"></i></button>
				   </span>
				</div>
			  </div>		
		      <div class="col-sm-6">
			    <?= $form->field($model, 'mr_no')->textInput(['class'=>'mrnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true,'readonly'=>"readonly"]) ?>
			  </div>
		    </div>
			<div class="row">
			  <div class="col-sm-6">
			    <div class="form-group ">
			      <label class="control-label" for="Admission_date"> Admission Date </label>
			      <input type="text" id="admission_date" class="form-control " name="admission_date"  >
		        </div>
			  </div>
			  <div class="col-sm-6">
			    <div class="form-group ">
			      <label class="control-label" for="Admission_time"> Admission Time </label>
			      <input type="text" id="admission_time" class="form-control " name="admission_time" >
		        </div>
			  </div>
			</div>
			<div class="row">
			   <div class="col-sm-2">
			     <?= $form->field($model, 'name_initial')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['class' => 'form-control select-custom w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'onchange'=>'AutomaticInitial()'])->label('Inital') ?>
			   </div>
			   <div class="col-sm-4">
			     <?= $form->field($model, 'patient_name')->textInput(['required'=> true]) ?>
			   </div>
			   <div class="col-sm-6">
			     <?= $form->field($model, 'sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['class' => '  form-control w-cus','style'=>' ','tabindex'=>339,'required'=> true])->label('Gender') ?>			    
			   </div>
			</div>
			
			<div class="row">
			   <div class="col-sm-6">
			     <?= $form->field($model, 'dob')->textInput(['class' => '  form-control w-cus ' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true])->label('DOB')?>
			   </div>
			   <div class="col-sm-6">
				<div class="row">
				   <div class="dob ">
				      <div class="col-sm-4">
				         <label class="control-label" for="newpatient-pat_age">YEAR</label>
				         <input type="text" placeholder="YYYY" name="year_dob" readonly="readonly" id="year_dob" class="form-control year_dob">  
				      </div>
				      <div class="col-sm-4">
				         <label class="control-label" for="newpatient-pat_age">MONTH</label>
				         <input type="text" placeholder="MM" name="month_dob" readonly="readonly" id="month_dob" class="form-control month_dob"> 
				      </div>
				      <div class="col-sm-4">
				         <label class="control-label" for="newpatient-pat_age">DATE</label>
				         <input type="text" placeholder="DD" name="date_dob" readonly="readonly" id="date_dob" class="form-control date_dob"> 
				      </div>
				   </div>
				</div>
 
			</div>
			</div>
			
			<div class="row">
			  <div class="col-sm-6">
			    <?= $form->field($model, 'mobile_no')->textInput(['required' => true]) ?>
			  </div>
			  <div class="col-sm-3">
			    <div class="form-group ">
				  <label class="control-label" for="inregistration-country">Current Date</label>
				  <input type="text" id="current_date" class="form-control" name="current_date">
			    </div>
			  </div>
			  <div class="col-sm-3">
			    <div class="form-group ">
				  <label class="control-label" for="inregistration-country">Current Time</label>
				  <input type="text" id="current_time" class="form-control" name="current_time">
			    </div>
			  </div>
			</div>
			
		  </div>
        </div>
	 </div>
	 <!-- PATIENT DETAILS Ends -->
	 
	 
	 
	 
	 <!-- CURRENT ROOM DETAILS -->
	 <div class="col-sm-6">
	   <div class="panel panel-border panel-custom">
		  <div class="panel-heading">
			<h5 class="box-title"><strong>Current Room Details</strong></h5> 
		  </div>
	      <div class="panel-body">
		    <div class="row">
			  <div class="col-sm-3">
			     <?= $form->field($model, 'paytype')->dropDownList(['Economy' => 'ECONOMY'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Pay Type') ?>
			  </div>
			  <div class="col-sm-3">
			     <label class="control-label">Bed No</label><br>  
			    <div class="input-group input-group-sm">							   
				   <?= $form->field($model, 'bed_no')->textInput(['maxlength' => true,'required'=> true])->label(false) ?>
				   <span class="input-group-btn"  >
					 <button type=" "   class="btn btn-default inp patient_bed" onmousedown="Patient_bed()"><i class="ssearch glyphicon glyphicon-search"></i></button>
				   </span>
				</div>			     
			  </div>
			 
			  <div class="col-sm-3">
			    <label class="control-label">Room No</label><br>  
			    <div class="input-group input-group-sm">							   
				   <?= $form->field($model, 'room_no')->textInput(['maxlength' => true,'required'=> true])->label(false) ?>
				   <span class="input-group-btn"  >
					 <button type=" "   class="inp btn btn-default"><i class="ssearch glyphicon glyphicon-search"></i></button>
				   </span>
				</div>
			  </div>
			  
			  <div class="col-sm-3">
			     <?= $form->field($model, 'floor_no')->textInput(['maxlength' => true,'required'=> true]) ?>
			  </div>
			</div>
			<div class="row">
			  <div class="col-sm-6">
			     <?= $form->field($model, 'room_type')->textInput(['maxlength' => true,'required'=> true]) ?>
			  </div>
			  <div class="col-sm-6">
			    <label class="control-label">Doctor Unit</label><br>  
			    <div class="input-group input-group-sm">							   
				   <?= $form->field($model, 'dr_unit')->dropDownList($physicianmaster,['required'=> true,'prompt'=>'-DoctorName-'])->label('') ?>
				   <span class="input-group-btn">
					  <button type="button" onclick='Doctor_unit_fetch();' class="btn inp btn-default btn-flat btn  unit_consultant_details"><i class="ssearch glyphicon glyphicon-search"></i></button>
				   </span>
				</div>
			  </div>
			</div>	
		  </div>
        </div>
	 </div>
	 <!-- CURRENT ROOM DETAILS Ends -->
     
	 
	 
	 
	 <!-- CHANGE ROOM DETAILS -->
	 <div class="col-sm-6">
	   <div class="panel panel-border panel-custom">
		  <div class="panel-heading">
			<h5 class="box-title"><strong>Change Room Details</strong></h5> 
		  </div>
	      <div class="panel-body">
		    <div class="row">
			  <div class="col-sm-3">
			     <div class="form-group field-inregistration-paytype">
			      <label class="control-label" for="inregistration-paytype">Pay Type</label>
			      <select id="current_paytype" class=" form-control w-cus " name="current_paytype" style=" " tabindex="338" required="">
			       <option value="Economy">ECONOMY</option>
			      </select>
		         </div>
			  </div>
			  <div class="col-sm-3">			   
			   <div class="form-group field-inregistration-bed_">
			     <label class="control-label">Bed No</label><br>  
			     <div class="input-group input-group-sm">							   
				   <input type="text" id="current_bed_no" class="form-control" name="current_bed_no" maxlength="25" required="">
				   <span class="input-group-btn"  >
					 <button type=" "   class="btn btn-default inp patient_bed1" onmousedown="Patient_bed1()"><i class="ssearch glyphicon glyphicon-search"></i></button>
				   </span>
				</div>
               </div>				
			  </div>
			 
			  <div class="col-sm-3">
			   <div class="form-group field-inregistration-room_no">
			    <label class="control-label">Room No</label><br>  
			    <div class="input-group input-group-sm">							   
				   <?= $form->field($model, 'room_no')->textInput(['maxlength' => true,'required'=> true])->label(false) ?>
				   <span class="input-group-btn"  >
					 <button type=" "   class="inp btn btn-default"><i class="ssearch glyphicon glyphicon-search"></i></button>
				   </span>
				</div>
			   </div>
			  </div>
			  <div class="col-sm-3">
			    <div class="form-group field-inregistration-floor">
			      <label class="control-label" for="inregistration-floor_no">Floor No</label>
			      <input type="text" id="current_floor_no" class="form-control" name="current_floor_no" maxlength="25" required="">
		        </div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-sm-6">
			     <div class="form-group field-inregistration-room_type ">
			      <label class="control-label" for="inregistration-room_type">Room Type</label>
			      <input type="text" id="current_room_type" class="form-control" name="current_room_type" maxlength="25" required="">
		         </div>
			  </div>
			  <div class="col-sm-6">
			    <label class="control-label">Doctor Unit</label><br>  
			    <div class="input-group input-group-sm">							   
				  <?= $form->field($model, 'dr_unit')->dropDownList($physicianmaster,['required'=> true,'prompt'=>'-DoctorName-','id'=>"current_dr_unit",'name'=>"current_dr_unit"])->label('') ?>
				   <span class="input-group-btn">
					  <button type="button" onclick='Doctor_unit_fetch1();' class="btn inp btn-default btn-flat btn  unit_consultant_details1"><i class="ssearch glyphicon glyphicon-search"></i></button>
				   </span>
				</div>
			  </div>
			</div>	
		  </div>
        </div>
	 </div>
	  <!-- CHANGE ROOM DETAILS Ends-->
   </div>
   
   <div class="row">
      <div class="panel panel-border ">
		 <div class="panel-heading"></div>
	     <div class="panel-body">
		   <div id="load1" style='display:none;text-align:center;'><img  class="load-image" src="<?= Url::to('@web/loader1.gif') ?>" /></div> <div class="row">
           <div class="patient_btn">
 	          <div class="form-group pull-right">
              <!--?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success physician' : 'btn btn-primary updatephysician']) ?-->
    	        <button type="button" class="btn btn-success" id='saves_sucess' onclick="SaveIPForm();">Save</button>
    	        <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     	        <span id="loadtexts" style="display: none; "></span>
				<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/index" class="btn text-right btn-default btn-bk" Title="BACK To Grid">Back to Grid </a>
              </div>
         </div>	
		 </div>
      </div>
   </div>
  </div>
   
   
			
  <!-- <div class="row">
  



	
		 <div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body"> 
<div class="in-registration-create">
	
	
						
<div class="in-registration-form">

<div id="load1" style='display:none;text-align:center;'><img  class="load-image" src="<?= Url::to('@web/loader1.gif') ?>" /></div> <div class="row">

  <div class="row patient_btn">
 	    <div class="form-group">
        <!--?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success physician' : 'btn btn-primary updatephysician']) ?
    	<button type="button" class="btn btn-success" id='saves_sucess' onclick="SaveIPForm();">Save</button>
    	<span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     	<span id="loadtexts" style="display: none; "></span>
    </div>

 </div>	   
<div class=" patient_details"> -->
	<!-- <div class="col-md-4 ">
	<div class="head">
		<Span> Patient Details </span>
	</div>
		<?php //= $form->field($model, 'ip_no')->textInput(['class'=>'ipnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true]) ?>
		<!-- <span class="btn patient_fetch_details" type='button' ><i class="ssearch glyphicon glyphicon-search"></i></span>  -->
		
		<?php //= $form->field($model, 'mr_no')->textInput(['class'=>'mrnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true,'readonly'=>"readonly"]) ?>
		
		<!--<div class="form-group ">
			<label class="control-label" for="Admission_date"> Admission Date </label>
			<input type="text" id="admission_date" class="form-control " name="admission_date"  >
		</div>
		<div class="form-group ">
			<label class="control-label" for="Admission_time"> Admission Time </label>
			<input type="text" id="admission_time" class="form-control " name="admission_time" >
		</div>  -->
		<?php //= $form->field($model, 'name_initial')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['class' => 'form-control col-sm-6 w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'onchange'=>'AutomaticInitial()'])->label('Inital') ?>
		<?php //= $form->field($model, 'patient_name')->textInput(['required'=> true]) ?>
		<!--<div class="form-group">
		<?php //= $form->field($model, 'dob')->textInput(['class' => ' col-sm-6 form-control w-cus ' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true])->label('DOB')?>
		<div class="dob">
			<input type="text" placeholder="YYYY" name="year_dob" readonly="readonly" id="year_dob" class="form-group year_dob" style="width:39px;" >year's
			<input type="text" placeholder="MM" name="month_dob" readonly="readonly" id="month_dob" class="form-group month_dob" style="width:48px;" >month
			<input type="text" placeholder="DD" name="date_dob" readonly="readonly" id="date_dob" class="form-group date_dob" style="width:39px;" >day
		</div>
		</div> <br/><br/>   
<?php //= $form->field($model, 'sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['class' => '  form-control w-cus','style'=>' ','tabindex'=>339,'required'=> true])->label('Gender') ?>			    
	</div>  
		<div class="col-md-4 ">
			<?php //= $form->field($model, 'mobile_no')->textInput(['required' => true]) ?>
			<!--<div class="form-group ">
					<label class="control-label" for="inregistration-country">Current Date</label>
					<input type="text" id="current_date" class="form-control" name="current_date">
			</div>
			<div class="form-group ">
					<label class="control-label" for="inregistration-country">Current Time</label>
					<input type="text" id="current_time" class="form-control" name="current_time">
			</div>	-->
		<!--<div class="head">
			<Span> Current Room Details </span>
		</div> -->
		<?php //= $form->field($model, 'paytype')->dropDownList(['Economy' => 'ECONOMY'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Pay Type') ?>
		<?php //= $form->field($model, 'bed_no')->textInput(['maxlength' => true,'required'=> true]) ?>
		<!-- <span class="btn patient_bed" onmousedown="Patient_bed()"><i class="ssearch glyphicon glyphicon-search"></i></span> -->
			<?php //= $form->field($model, 'room_no')->textInput(['maxlength' => true,'required'=> true]) ?>
		<!-- <span class="btn "><i class="ssearch glyphicon glyphicon-search"></i></span> -->
		<?php //= $form->field($model, 'floor_no')->textInput(['maxlength' => true,'required'=> true]) ?>
		<?php //= $form->field($model, 'room_type')->textInput(['maxlength' => true,'required'=> true]) ?>
		<?php //= $form->field($model, 'dr_unit')->dropDownList($physicianmaster,['required'=> true,'prompt'=>'-DoctorName-'])->label('') ?>
		<!-- <span class="input-group-btn">
							  <button type="button" onclick='Doctor_unit_fetch();' class="btn btn-default btn-flat btn  unit_consultant_details"><i class="ssearch glyphicon glyphicon-search"></i></button>
							</span>  -->
		<input type="hidden" name="bedid" id="bedid" >
		<input type="hidden" name="roomnoid" id="roomnoid" >
		<input type="hidden" name="roomtypeid" id="roomtypeid" >
		<input type="hidden" name="floorid" id="floorid" >
		
	<!--</div>
	<div class="col-md-4 "> -->
		<div class="ogs_name" >
			<?= $form->field($model, 'refered_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ucil_from')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ucil_to')->textInput(['maxlength' => true]) ?>
		</div>	
		<!--<div class="head">
			<Span> Change Room Details </span>
		</div>
		<div class="form-group field-inregistration-paytype">
			<label class="control-label" for="inregistration-paytype">Pay Type</label>
			<select id="current_paytype" class=" form-control w-cus " name="current_paytype" style=" " tabindex="338" required="">
			<option value="Economy">ECONOMY</option>
			</select>
		</div> -->
		<!--<div class="form-group field-inregistration-bed_">
			<label class="control-label" for="inregistration-bed_no">Bed No</label>
			<input type="text" id="current_bed_no" class="form-control" name="current_bed_no" maxlength="25" required="">
			<span class="btn patient_bed1" onmousedown="Patient_bed1()"><i class="ssearch glyphicon glyphicon-search"></i></span>
		</div>  -->
		<!-- <div class="form-group field-inregistration-room_no">
			<label class="control-label" for="inregistration-room_no">Room No</label>
			<input type="text" id="current_room_no" class="form-control" name="current_room_no" maxlength="25" required="">
		</div> -->
		<!-- <div class="form-group field-inregistration-floor">
			<label class="control-label" for="inregistration-floor_no">Floor No</label>
			<input type="text" id="current_floor_no" class="form-control" name="current_floor_no" maxlength="25" required="">
		</div> -->
		<!--<div class="form-group field-inregistration-room_type ">
			<label class="control-label" for="inregistration-room_type">Room Type</label>
			<input type="text" id="current_room_type" class="form-control" name="current_room_type" maxlength="25" required="">
		</div> -->
		<!-- <div class="form-group field-inregistration-dr_unit has-success">
			<label class="control-label" for="inregistration-dr_unit">Dr Unit</label>
			<!-- <input type="text" id="current_dr_unit" class="form-control" name="current_dr_unit" maxlength="50" required="" aria-invalid="false">  
				<?php //= $form->field($model, 'dr_unit')->dropDownList($physicianmaster,['required'=> true,'prompt'=>'-DoctorName-','id'=>"current_dr_unit",'name'=>"current_dr_unit"])->label('') ?>
		<span class="input-group-btn">
							  <button type="button" onclick='Doctor_unit_fetch1();' class="btn btn-default btn-flat btn  unit_consultant_details1"><i class="ssearch glyphicon glyphicon-search"></i></button>
							</span>
		</div> -->

		<input type="hidden" name="bedid" id="bedid" >
		<input type="hidden" name="roomnoid" id="roomnoid" >
		<input type="hidden" name="roomtypeid" id="roomtypeid" >
		<input type="hidden" name="floorid" id="floorid" >
		
	<!-- </div> -->


    
 <div id="patient_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Details</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="patient_history_report">
      
      <table id="reg_table" class="display" style="width:100%">
        <thead>
            <tr>
            	<th>IP Number</th>
                <th>MR Number</th>
                <th>Patient name</th>
                <th>Relation Name</th>
                <th>Mobile Number</th>
            </tr>
        </thead>
        
    </table>		
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn inp btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
  
<div id="unit_consultant_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Doctor Details</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="doctor_history_report">
      
      <table id="unit_consultant_table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Specialist</th>
            </tr>
        </thead>
      </table>		
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn inp btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
 
 <div id="unit_consultant_details1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Doctor Details</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="doctor_history_report">
      
      <table id="unit_consultant_table1" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Specialist</th>
            </tr>
        </thead>
      </table>		
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn inp btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
 
 
    <div class="col-md-12 hide">
       	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     		<?= $form->field($model, 'is_active', [
    		'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
			])->checkbox([],false) ?>
	</div>

    <?php ActiveForm::end(); ?>
   
</div>
 


<div id="patient_hist-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Bed List</h4>
      </div>
      <div class="modal-body">
      	
      	 <div class="" id="patient_history_report">
            	<table id="bednofetch" class="table table-striped table-bordered nowrap display" style="width:100%">
				<thead>
				  <tr>
				  	<th>BED NO</th>
				    <th>ROOM NO</th>
				    <th>ROOM TYPES</th>
				    <th>BED CHARAGE</th>
				    
				    <!-- <th>Action</th> -->
				  </tr>
				</thead>
				
				</table>
		</div>
     
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn inp btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  	


<div id="patient_hist-modal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Bed List</h4>
      </div>
      <div class="modal-body">
      	
      	 <div class="" id="patient_history_report1">
            	<table id="bednofetch1" class="table table-striped table-bordered nowrap display" style="width:100%">
				<thead>
				  <tr>
				  	<th>BED NO</th>
				    <th>ROOM NO</th>
				    <th>ROOM TYPES</th>
				    <th>BED CHARAGE</th>
				    
				    <!-- <th>Action</th> -->
				  </tr>
				</thead>
				
				</table>
		</div>
     
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn inp btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  	



<script>
	function Patient_bed() 
	{
		$modal = $('#patient_hist-modal');
		$modal.modal('show');
	}

	function Patient_bed1() 
	{
		$modal = $('#patient_hist-modal1');
		$modal.modal('show');
	}
	
	function Doctor_unit_fetch() 
{
	$modal = $('#unit_consultant_details');
	$modal.modal('show');
}
	function Doctor_unit_fetch1() 
{
	$modal = $('#unit_consultant_details1');
	$modal.modal('show');
}
	$(document).ready(function() {
		var currentdate = new Date(); 
		var date = currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear();
        var time= currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
        $('#current_date').val(date);
		$('#current_time').val(time);
        //alert(time);        
  	});
 
$(document).ready(function() {
	//$(".pagination > li > a").attr("href", "javascript:void(0)");
	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=in-registration/jqgrid';
	
    var disable_buttons = function(){
    $("._edit_save_btn").unbind("click").click(function(e){

        $("._edit_save_btn").not(this).prop('disabled', true);  
    });
};

	jtable_pd();
	bedbo_fetch();
	bedbo_fetch1();    
	doctor_fetched();
	doctor_unit_consultant();
	doctor_unit_consultant1();

});

 $(".ipnumber").typeahead({
	
	source: function(query,result) {
	  		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxipnumber";?>',
	  			method:'POST',
	  			data:{query:query},
	  			dataType:'json',
	  			success:function(data)
	  			{
	  				result($.map(data, function(item){
	  				return item.ip_no;
	  			  }));
	  				
	  			}
	  		})
	},
	autoSelect: true,
	displayText: function(result)
	{
		 return result;
	},
	afterSelect: function(result) 
	{  $('#load1').show();
		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxipnumberselect&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{   $('#load1').hide();
	  			 	
	  			 	$('#inregistration-patient_type').val(data['patient_type']);
	  			 	$('#inregistration-registered').val(data['registered']);
	  			 	$('#inregistration-panel_type').val(data['panel_type']);
	  			 	$('#inregistration-mr_no').val(data['mr_no']);
	  			 	$('#inregistration-name_initial').val(data['name_initial']);
	  			 	$('#inregistration-patient_name').val(data['patient_name']);
	  			 	$('#inregistration-dob').val(formatDate(data['dob']));
	  			 	$('#inregistration-sex').val(data['sex']);
	  			 	$('#inregistration-marital_status').val(data['marital_status']);
	  			 	$('#inregistration-relation_suffix').val(data['relation_suffix']);
	  			 	$('#inregistration-relative_name').val(data['relative_name']);
	  			 	$('inregistration-address').val(data['address']);
	  			 	$('#inregistration-city').val(data['city']);
	  			 	$('#inregistration-district').val(data['district']);
	  			 	$('#inregistration-state').val(data['state']);
	  			 	
	  			 	$('#inregistration-pincode').val(data['pincode']);
	  			 	$('#inregistration-phone_no').val(data['phone_no']);
	  			 	$('#inregistration-mobile_no').val(data['mobile_no']);
	  			 	$('#inregistration-country').val(data['country']);
	  			 	$('#inregistration-religion').val(data['religion']);
	  			 	$('#inregistration-type').val(data['type']);
	  			 	
	  			 	$('#inregistration-paytype').val(data['paytype']);
	  			 	$('#inregistration-bed_no').val(data['bed_no']);
	  			 	$('#inregistration-room_no').val(data['room_no']);
	  			 	$('#inregistration-floor_no').val(data['floor_no']);
	  			 	$('#inregistration-room_type').val(data['room_type']);
	  			 	$('#inregistration-consultant_dr').val(data['consultant_dr']);
	  			 	$('#inregistration-dr_unit').val(data['dr_unit']);
	  			 	$('#inregistration-speciality').val(data['speciality']);
	  			 	$('#inregistration-co_consultant').val(data['co_consultant']);
	  			 	
					
					var fromDate = new Date(data['created_date']); 
    			    var createddate = formatDate(fromDate);
    			    var createdtime = formatDate2(fromDate);
					$('#admission_date').val(createddate);
					$('#admission_time').val(createdtime);
					
	  			
  		var now = new Date();
  		var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  		var yearNow = now.getYear();
  		var monthNow = now.getMonth();
  		var dateNow = now.getDate();
  		var dateString=formatDate1(data['dob']);	
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
	
	$('#year_dob').val(age.years);
	$('#month_dob').val(age.months);
	$('#date_dob').val(age.days);
	  			}
	  		})
	  }
});

function bedbo_fetch(){
    	
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=in-registration/bednofetch';
  var table_reg= $('#bednofetch').DataTable( {
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
            { "data": "bedno","defaultContent": '<input type="text" value="0" />' },
            { "data": "room_no","defaultContent": "NA" },
            { "data": "room_types","defaultContent":"NA" },
            { "data": "price","defaultContent": '<input type="text" value="0" />'  },
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#bednofetch').on('key-focus.dt', function(e, datatable, cell){
     
         $('#bednofetch_filter input').focus();
    });
  $('#bednofetch').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#bednofetch").DataTable();
        if(key === 13){
        	
        	$('#bednofetch thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#bednofetch_filter input').focus();
        }
    }); 
    
$('#bednofetch').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	Roomdetailsfetch(data);
 	
});

$('#bednofetch').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		Roomdetailsfetch(data);
   		
 	}
});    
    
}



$("body").on('click', '.doctor_details', function ()
{
	$modal = $('#doctor_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#doctor_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});	

$("body").on('click', '.unit_consultant_details', function ()
{
	$modal = $('#unit_consultant_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#unit_consultant_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});	


$("body").on('click', '.unit_consultant_details1', function ()
{
	$modal = $('#unit_consultant_details1');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#unit_consultant_table1").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});	

function MRNUMBER(data,event)
{
	if(data.value === '')
	{
		EmptyPatientDetails();
	}
	else if(event.keyCode === 13 && data.value !== '')
	{
		$('#load1').show();
		$.ajax({	
	     type: "POST",
		 url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/mr-number-fetch&id=";?>"+data.value,
	     success: function (result) 
	     { //alert(result);
	     	$('#load1').hide();
	     	var obj = JSON.parse(result);
     		if(obj[0] === 'Empty')
     		{
     			EmptyPatientDetails();
     			$('#treatmentoverall-mrnumber').focus('');
     			Alertment('Invalid MR Number !!! Check It');
     		}
     		else if(obj[0] === 'Set')
     		{
     			//EmptyPatientDetails();
     			$('#select#inregistration-name_initial').val(obj[2]['pat_inital_name']);
     			$('input#inregistration-patient_name').val(obj[2]['patientname']);
     			$('input#inregistration-dob').val(formatDate(obj[2]['dob']));
     			$('select#inregistration-sex').val(obj[2]['pat_sex']);
     			$('select#inregistration-marital_status').val(obj[2]['pat_marital_status']);
     			$('select#inregistration-relation_suffix').val(obj[2]['pat_relation']);
     			$('input#inregistration-relative_name').val(obj[2]['par_relationname']);
     			$('textarea#inregistration-address').val(obj[2]['pat_address']);
     			$('input#inregistration-city').val(obj[2]['pat_city']);
     			$('input#inregistration-district').val(obj[2]['pat_distict']);
     			$('input#inregistration-state').val(obj[2]['pat_state']);
     			$('input#inregistration-pincode').val(obj[2]['pat_pincode']);
     			$('input#inregistration-phone_no').val(obj[2]['pat_phone']);
     			$('input#inregistration-mobile_no').val(obj[2]['pat_mobileno']);
     			$('input#inregistration-religion').val(obj[2]['pat_religion']);
     			
     			
     			alert(obj[2]);
     			
			}
	     }
		 });
	}	
}

     function jtable_pd(){
    	
    	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=in-registration/injqgrid';
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
        	{ "data": "ipno","defaultContent": '<input type="text" value="0" />' },
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
    var data = table_reg.row(this).id(); 
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

$("body").on('click', '.patient_bed', function ()
{
	$modal = $('#patient_hist-modal');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#bednofetch").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});
$("body").on('click', '.patient_bed1', function ()
{
	$modal = $('#patient_hist-modal1');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#bednofetch1").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});

function PatientDetailsFetch(data)
{
	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/inipfetchmrnumber&id=";?>"+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        	
        	$('.ipnumber').val(obj[0]['ip_no']);
        	$('#inregistration-mr_no').val(obj[0]['mr_no']);
        	$('#inregistration-name_initial').val(obj[0]['name_initial']);
        	$('#inregistration-patient_name').val(obj[0]['patient_name']);
        	$('#inregistration-dob').val(formatDate(obj[0]['dob']));
        	$('#inregistration-sex').val(obj[0]['sex']);
        	$('#inregistration-marital_status').val(obj[0]['marital_status']);
        	$('#inregistration-relation_suffix').val(obj[0]['relation_suffix']);
        	$('#inregistration-relative_name').val(obj[0]['relative_name']);
        	$('#inregistration-address').val(obj[0]['address']);
        	$('#inregistration-city').val(obj[0]['city']);
        	$('#inregistration-district').val(obj[0]['district']);
        	$('#inregistration-state').val(obj[0]['state']);
        	$('#inregistration-pincode').val(obj[0]['pincode']);	
        	$('#inregistration-mobile_no').val(obj[0]['mobile_no']);
        	$('#admission_date').val(formatDate1(obj[0]['created_date']));
        	$('#admission_time').val(formatDate2(obj[0]['created_date']));
        	
        	CalculateAge(obj[0]['dob']);
        	
        	$modal = $('#patient_details');
        	$modal.modal('hide');
        }
	});
}
   function formatDate2(date) 
{
     var d = new Date(date),
     month = '' + (d.getHours() + 1),
     day = '' + d.getMinutes(),
     year = d.getSeconds();
   
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [month,day, year].join(':');
 }

function Unitdetailsfetch(data)
{
	var data_split=data.split('_');
	
	$('#inregistration-dr_unit').val(data_split[0]);
	$('#inregistration-speciality').val(data_split[1]);
	$modal = $('#unit_consultant_details');
	$modal.modal('hide');
}

function Unitdetailsfetch1(data)
{
	var data_split=data.split('_');
	
	$('#current_dr_unit').val(data_split[0]);
	$('#inregistration-speciality').val(data_split[1]);
	$modal = $('#unit_consultant_details1');
	$modal.modal('hide');
}

function Doctordetailsfetch(data)
{
	$('#inregistration-consultant_dr').val(data);
	$modal = $('#doctor_details');
	$modal.modal('hide');
}
function doctor_unit_consultant(){
    	
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=in-registration/unitconsultant';
  var table_reg= $('#unit_consultant_table').DataTable({
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
            { "data": "doctorname"},
            { "data": "specialist"},
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#unit_consultant_table').on('key-focus.dt', function(e, datatable, cell){
     
         $('#unit_consultant_table_filter input').focus();
    });
  $('#unit_consultant_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#unit_consultant_table").DataTable();
        if(key === 13){
        	
        	$('#unit_consultant_table thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#unit_consultant_table_filter input').focus();
        }
    }); 
    
$('#unit_consultant_table').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	Unitdetailsfetch(data);
});

$('#unit_consultant_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		Unitdetailsfetch(data);
 	}
});    
    
}


function doctor_unit_consultant1(){
    	
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=in-registration/unitconsultant';
  var table_reg= $('#unit_consultant_table1').DataTable({
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
            { "data": "doctorname"},
            { "data": "specialist"},
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#unit_consultant_table1').on('key-focus.dt', function(e, datatable, cell){
     
         $('#unit_consultant_table1_filter input').focus();
    });
  $('#unit_consultant_table1').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#unit_consultant_table1").DataTable();
        if(key === 13){
        	
        	$('#unit_consultant_table1 thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#unit_consultant_table1_filter input').focus();
        }
    }); 
    
$('#unit_consultant_table1').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	Unitdetailsfetch1(data);
});

$('#unit_consultant_table1').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		Unitdetailsfetch1(data);
 	}
});    
    
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
	
	$('#year_dob').val(age.years);
	$('#month_dob').val(age.months);
	$('#date_dob').val(age.days);
}

function SaveIPForm()
{
	var mr_no=$('#inregistration-mr_no').val();
	var valid=$("#w0").valid();  
	if(valid == true)
	{
    if (confirm('Are You Sure to Save ?')) {
		$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/changeroomupdate&id=";?>"+mr_no,
	            data: $("#w0").serialize(),
	            success: function (result) 
	            { 
	            	if(result=="1"){
	             		Alertment("Room Changed Sucessfully...");
		              		document.getElementById('w0').reset()
	            	}
	            }
			});
		}
	}
}



$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
           	SaveIPForm();
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
            alert('ctrl-c');
            break;
        }
    }
});


 
$(".mrnumber").typeahead({
	
	source: function(query,result) {
	  		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxfetch";?>',
	  			method:'POST',
	  			data:{query:query},
	  			dataType:'json',
	  			success:function(data)
	  			{	
	  				result($.map(data, function(item){
	  					
	  					return item.mr_no;
	  				}));
	  				
	  			}
	  		})
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
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxchangeroom&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{  
	  				$('#load1').hide();
	  		 //	alert(data['bed_no']);
	  		 
	  		 var dob_mr = new Date(data['dob']);
	  		 var createddate = new Date(dob_mr).toDateString("dd-MM-yyyy H:i");
	  		 
	  				$('#inregistration-name_initial').val(data['name_initial']);
					$('#inregistration-patient_name').val(data['patient_name']);
					$('#inregistration-dob').val((formatDate(data['dob'])));
					$('#inregistration-sex').val(data['sex']);
					$('#inregistration-mobile_no').val(data['mobile_no']);
					$('#inregistration-ip_no').val(data['ip_no']);
					$('#inregistration-paytype').val(data['paytype']);
					$('#inregistration-bed_no').val(data['bed_no']);
					$('#inregistration-room_no').val(data['room_no']);
					$('#inregistration-floor_no').val(data['floor_no']);
					$('#inregistration-room_type').val(data['room_type']);
					$('#inregistration-dr_unit').val(data['dr_unit']);
					
					
					var fromDate = new Date(data['created_date']); 
    			    var createddate = formatDate(fromDate);
    			    var createdtime = formatDate2(fromDate);
					$('#admission_date').val(createddate);
					$('#admission_time').val(createdtime);
					
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();
  var dateString=formatDate1(data['dob']);	
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
	
	$('#year_dob').val(age.years);
	$('#month_dob').val(age.months);
	$('#date_dob').val(age.days);
	  			}
	  		})
	  }
});


//Date Format
function formatDate(date) 
{
     var d = new Date(date),
     month = '' + (d.getMonth() + 1),
     day = '' + d.getDate(),
     year = d.getFullYear();
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [day, month, year].join('-');
 }
 
 function formatDate1(date) 
{
     var d = new Date(date),
     month = '' + (d.getMonth() + 1),
     day = '' + d.getDate(),
     year = d.getFullYear();
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [month,day, year].join('/');
 }
  function formatDate2(date) 
{
     var d = new Date(date),
     month = '' + (d.getHours() + 1),
     day = '' + d.getMinutes(),
     year = d.getSeconds();
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [month,day, year].join(':');
 }
 
 function EmptyESC(data,event)
 {
 	if(data.value === '' || event.keyCode === 27)
	{
		$('#inregistration-name_initial').val('');
		$('#inregistration-patient_name').val('');
		$('#inregistration-dob').val('');
		$('#inregistration-sex').val('');
		$('#inregistration-marital_status').val('');
		$('#inregistration-relation_suffix').val('');
		$('#inregistration-relative_name').val('');
		$('#inregistration-address').val('');
		$('#inregistration-city').val('');
		$('#inregistration-district').val('');
		$('#inregistration-state').val('');
		$('#inregistration-pincode').val('');
		$('#inregistration-phone_no').val('');
		$('#inregistration-mobile_no').val('');
		$('#inregistration-mr_no').val('');
	}
 }

 function Roomdetailsfetch(data) 
{
 	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/bednogrid&id=";?>"+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        	
        	$('#inregistration-bed_no').val(obj[0]['bedno']);
        	$('#inregistration-room_no').val(obj[1]['room_no']);
        	$('#inregistration-floor_no').val(obj[3]['floor_no']);
        	$('#inregistration-room_type').val(obj[2]['room_types']);
        	
        	$modal = $('#patient_hist-modal');
        	$modal.modal('hide');
        }
	});
}

 function Currentroomdetailsfetch(data) 
{
 	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/crbednogrid&id=";?>"+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        	
        	$('#current_bed_no').val(obj[0]['bedno']);
        	$('#current_room_no').val(obj[1]['room_no']);
        	$('#current_floor_no').val(obj[3]['floor_no']);
        	$('#current_room_type').val(obj[2]['room_types']);
        	
        	$modal = $('#patient_hist-modal1');
        	$modal.modal('hide');
        }
	});
}
	
  function doctor_fetched(){
    	
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=in-registration/doctorfetch';
  var table_reg= $('#doctor_table').DataTable( {
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
            { "data": "doctorname"},
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#doctor_table').on('key-focus.dt', function(e, datatable, cell){
     
         $('#doctor_table_filter input').focus();
    });
  $('#doctor_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#doctor_table").DataTable();
        if(key === 13){
        	
        	$('#doctor_table thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#doctor_table_filter input').focus();
        }
    }); 
    
$('#doctor_table').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	Doctordetailsfetch(data);
});

$('#doctor_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		Doctordetailsfetch(data);
 	}
});    
    
}


function Patienttypemodule(){
	if($('#inregistration-type').val()=="3"){
		$(".ogs_name").css("display", "block");
	}else{
		$(".ogs_name").css("display", "none");
	}
}

$(document).ready(function() {
	
		$("body").on('click', '.patient_fetch_details', function ()
    		{
    			$modal = $('#patient_details');
				$modal.modal('show');  
			});
	
		var url=('<?php echo Url::base('https'); ?>');
		var table = $('#reg_table1').DataTable();
		var ajax_url=url+'/index.php?r=in-registration/ipgrid';
 var table= $('#reg_table1').DataTable( {
        "processing": true,
        "serverSide": true,
          "retrieve": true,
         "ajax": {
        	"url": ajax_url,
        	 "type": "POST"
        	},
        	keys: {
           		keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
        	},
        	"columns": [
        	{ "data": "ipno",},
            { "data": "mrno",},
            { "data": "pname",},
            { "data": "rname",},
            { "data": "mno", },
        ]
    } );
    
     $('#reg_table1').on('key-focus.dt', function(e, datatable, cell){
        $(table.row(cell.index().row).node()).addClass('selected');
    });

    
    $('#reg_table1').on('key-blur.dt', function(e, datatable, cell){
        $(table.row(cell.index().row).node()).removeClass('selected');
    });
        
    
    $('#reg_table1').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
        if(key === 13){
            var data = table.row(cell.index().row).data();
            $("#reg_table1-console").html(data.join(', '));
        }
    });   
 
  	
  	 $('#reg_table1 tbody').on( 'click', 'tr', function () {
  	 	 if ( $(this).hasClass('selected') ) {
  	 	 	  $(this).removeClass('selected'); 
  	 	 } else {
  	 	 	 table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); 
  	 	 	} 
  	 	 }); 
  });

</script>	
<script type="text/javascript">
	function bedbo_fetch1(){
    	
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=in-registration/bednofetch';
  var table_reg= $('#bednofetch1').DataTable( {
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
            { "data": "bedno","defaultContent": '<input type="text" value="0" />' },
            { "data": "room_no","defaultContent": "NA" },
            { "data": "room_types","defaultContent":"NA" },
            { "data": "price","defaultContent": '<input type="text" value="0" />'  },
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#bednofetch1').on('key-focus.dt', function(e, datatable, cell){
     
         $('#bednofetch1_filter input').focus();
    });
  $('#bednofetch1').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#bednofetch1").DataTable();
        if(key === 13){
        	
        	$('#bednofetch1 thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#bednofetch1_filter input').focus();
        }
    }); 
    
$('#bednofetch1').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	//Roomdetailsfetch(data);
 	Currentroomdetailsfetch(data);
});

$('#bednofetch1').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		//Roomdetailsfetch(data);
   		Currentroomdetailsfetch(data);
 	}
});    
    
}

</script>

 