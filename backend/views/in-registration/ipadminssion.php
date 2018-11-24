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


$this->title = 'IP Admission ';
$this->params['breadcrumbs'][] = ['label' => 'In Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 
?>
<link href="<?php echo Url::base(); ?>/validation_plugin/site-demos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>  

<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />

<script  src="ubold/dist/js/select2.js"></script>

<style>
.panel-border.panel-custom .panel-heading{
	background-color:#fff;
}
.b-width{width:100%;}
 .btn-default{color:#333!important;}
 .panel-border .panel-body {
    padding: 5px 20px 10px 20px;
	background-color: ;
}
.c.panel{
	margin-bottom:10px;
	
}
label.control-label{
	color:#444;
	font-weight:normal;
}
.br-rt{
	border-right:1px solid #F0F7FF;
}

</style>

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
    background: #dadada;
 
    padding: 3px 0;
    font-size: 12px;
}
button.btn.btn-success.physician {
    padding: 1px 4px;
}
.patient_details .head span {
    background: #dadada;
    position: relative;
    /*top: -10px;
    left: 15px; */
    padding: 3px 15px;
    font-weight: bold;
    color: #000;
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
    float: right;
    margin-bottom: 6px;
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
    min-height: 77px;
}
.patient_btn {
    padding: 0 0 10px 0;
}
.patient_btn>.form-group{
	float: right;
}
div#example_wrapper {
    display: none;
}
.form-group.field-inregistration-ip_no,.form-group.field-inregistration-bed_no,.form-group.field-inregistration-room_no,
.form-group.field-inregistration-consultant_dr,.form-group.field-inregistration-dr_unit,.form-group.field-inregistration-speciality,
.form-group.field-inregistration-co_consultant{
    /* width: 84%; */
    float: left;
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
</style>
<style>
.btn-right{
  float:right;	position: relative;
    top: -13px;
}

	.modal .modal-dialog .modal-content .modal-body {
    	/* padding: 0px; */
	}
	button.close {
    	/* padding: 2px 7px;
    	background: #ff0c0c;
    	color: #fff;
    	border-radius: 27px; */
	}
	
	button.close:hover {    	/* color: #fff; */	}
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<!-- <div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
	<ol class="breadcrumb" >
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
		 	</div>
		<div class="col-sm-6 text-right ">
		<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/index" class="btn text-right btn-default" Title="BACK To Grid">Back to Grid </a> 
		</div>
						</div> -->
						
						
						
<?php $form = ActiveForm::begin(); ?>
						
		<div class=" ">
		  <div class="col-sm-12">
		     <div class="c panel panel-border panel-custom">
			    <div class="panel-heading">
			        <h5 class="box-title"><strong>Patient Details</strong></h5> 
		        </div>
	            <div class="panel-body"> 
	                 <div class="row">
					    <div class="col-sm-2 br-rt">
						  <div class="form-group" style="margin-bottom:10px;">
						    <label class="control-label">IP NO</label><br>  
							<div class="input-group input-group-sm">							   
								<input type="text" class="ipnumber form-control cus-fld number" autocomplete="off" onkeyup='EmptyESC(this,event)' required placeholder="IP Number">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-flat btn patient_fetch_details"><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>
						  </div> 
						   <?= $form->field($model, 'mr_no')->textInput(['class'=>'form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'readonly'=>"readonly"]) ?>
						  
						  <?= $form->field($model, 'patient_type')->dropDownList([ 'opd' => 'OPD','ipd' => 'IPD'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Patient Type') ?>
						  
						  <?= $form->field($model, 'registered')->dropDownList([ 'Booked' => 'Booked', 'UnBooked' => 'UnBooked'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Registered') ?>
						  
						  <?= $form->field($model, 'panel_type')->dropDownList([ 'cash' => 'Cash', 'credit' => 'Credit'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Panel Type') ?>
						  		  
						</div>
						
						<div class="col-sm-3 br-rt">
						     <?= $form->field($model, 'name_initial')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['class' => 'form-control   w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'onchange'=>'AutomaticInitial()'])->label('Inital') ?>
						 
						     <?= $form->field($model, 'patient_name')->textInput(['required'=> true]) ?>
							 
							 <?= $form->field($model, 'sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['class' => '  form-control w-cus','style'=>' ','tabindex'=>339,'required'=> true])->label('Gender') ?>
							 
							 <?= $form->field($model, 'marital_status')->dropDownList([ 'Married' => 'Married', 'Unmarried' => 'Unmarried','Widow'=>'Widow'], ['class' => '  form-control w-cus ','required'=> true,'tabindex'=>338,'required'=> true])->label('Marital Status') ?>
							 
							 <?= $form->field($model, 'type')->dropDownList($patienttype, ['title'=>'Patient Type','class' => '  form-control w-cus','style'=>' ','tabindex'=>352,'required'=> true,'onchange'=>'Patienttypemodule(this.value);'])->label('Pat Type') ?>
								 
						</div>
						 
						
						
						<div class="col-sm-3 br-rt">
							    <?= $form->field($model, 'dob')->textInput(['class' => '  form-control w-cus datepicker' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true])->label('DOB')?>
							 
		  <div class="form-group" >
<div class="dob">
	<div class="row">
   <div class="col-sm-4">
      <div class="form-group">
         <label class="control-label" for="newpatient-pat_age">YEAR(S)</label>
         <input type="text" placeholder="YYYY" name="year_dob" readonly="readonly" id="year_dob" class="form-control year_dob">  
      </div>
   </div>
   <div class="col-sm-4">
      <div class="form-group">
         <label class="control-label" for="newpatient-pat_age">MONTH(S)</label>
         <input type="text" placeholder="MM" name="month_dob" readonly="readonly" id="month_dob" class="form-control month_dob"> 
      </div>
   </div>
   <div class="col-sm-4">
      <div class="form-group ">
         <label class="control-label" for="newpatient-pat_age">DAY(S)</label>
         <input type="text" placeholder="DD" name="date_dob" readonly="readonly" id="date_dob" class="form-control date_dob"> 
      </div>
   </div>
 </div>
</div>
    </div>
							 
							 	<?= $form->field($model, 'address')->textarea(['rows' => 1,'required' => true]) ?>	
							    <?= $form->field($model, 'mobile_no')->textInput(['required' => true]) ?>
							 
						</div>
						
						<div class="col-sm-2 br-rt">
							<?= $form->field($model, 'city')->textInput(['required' => true]) ?>
							
							<?= $form->field($model, 'district')->textInput(['required' => true]) ?>
							
							<?= $form->field($model, 'state')->textInput(['required' => true]) ?>
							<?= $form->field($model, 'pincode')->textInput() ?>
							<?= $form->field($model, 'country')->textInput() ?>
							
						</div>
						
						<div class="col-sm-2 br-rt">
						    <?= $form->field($model, 'relation_suffix')->dropDownList([ 'S/O' => 'S/O', 'D/O' => 'D/O','W/O' => 'W/O','H/O'=>'H/O','C/O'=>'C/O','Empty'=>'Empty','Sis/O'=>'Sis/O','B/O'=>'B/O','M/O'=>'M/O','F/O'=>'F/O','Self'=>'Self'], ['class' => ' form-control   w-cus','style'=>' ','tabindex'=>336,'required'=> true,'onchange'=>'AutomaticRelation()'])->label('Relation') ?>
							
							<?= $form->field($model, 'relative_name')->textInput(['required' => true]) ?>
							
							<?= $form->field($model, 'phone_no')->textInput() ?>
							
							<?= $form->field($model, 'religion')->textInput() ?>
						</div>
						
					 </div>
 
					 <div class="row">
						<div class="ogs_name">
						  <div class="col-sm-2">
						    <?= $form->field($model, 'refered_name')->textInput(['maxlength' => true]) ?>
						  </div>
						  <div class="col-sm-3">
						    <?= $form->field($model, 'ucil_from')->textInput(['maxlength' => true]) ?>
						  </div>
						  <div class="col-sm-3">
						    <?= $form->field($model, 'ucil_to')->textInput(['maxlength' => true]) ?>
						   </div>
						</div>
						 
					 </div>
					 
		        </div>
		    </div>				
		   </div>				
		</div>	

        <div class=" ">
		  <div class="col-sm-5">
		     <div class="c panel panel-border panel-custom">
			    <div class="panel-heading">
			        <h5 class="box-title"><strong>Room Details</strong></h5> 
		        </div>
	            <div class="panel-body">
				   <div class="row">
				       <div class="col-sm-4">
							<?= $form->field($model, 'paytype')->dropDownList(['Economy' => 'ECONOMY'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true,'readonly'=>"readonly"])->label('Pay Type') ?>
					   </div>
				   
					   <div class="col-sm-4">
						    <label class="control-label">Bed No</label><br>  
							<div class="input-group input-group-sm">							   
								<?= $form->field($model, 'bed_no')->textInput(['maxlength' => true,'required'=> true,'readonly'=>true])->label('') ?>
								<span class="input-group-btn"  >
									<button type="button" onmousedown="Patient_bed()" class="btn btn-default btn-flat btn  patient_bed"><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>
						</div>
					   

					   <div class="col-sm-4">
						    <label class="control-label">Room No</label><br>  
							<div class="input-group input-group-sm">
							   
								<?= $form->field($model, 'room_no')->textInput(['maxlength' => true,'required'=> true,'readonly'=>true])->label('') ?>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>
						</div>
                      </div>
                      <div class="row">					  
					   <div class="col-sm-4">
						<?= $form->field($model, 'floor_no')->textInput(['maxlength' => true,'required'=> true,'readonly'=>true]) ?>
					   </div>
					   <div class="col-sm-4">
							<?= $form->field($model, 'room_type')->textInput(['maxlength' => true,'required'=> true,'readonly'=>true]) ?>
					   </div>
					  </div>
				   </div>
		        </div>
		     </div>
		   
		    <div class="col-sm-5">
		     <div class="c panel panel-border panel-custom">
			    <div class="panel-heading">
			        <h5 class="box-title"><strong>Admission Under Doctor Details</strong></h5> 
		        </div>
	            <div class="panel-body">
				   <div class="row">
				      <div class="col-sm-6">
						<label class="control-label">Consultant</label><br>  
						<div class="input-group input-group-sm">	   
							<?= $form->field($model, 'consultant_dr')->dropDownList($physicianmaster, ['class' => '  form-control w-cus','prompt'=>'-DoctorName-'  ,'style'=>' ','tabindex'=>360,'required'=>true])->label(' ') ?>
							<span class="input-group-btn">
						 <button type="button" onclick='Doctor_fetch();' class="btn btn-default btn-flat btn doctor_details"><i class="ssearch glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					  </div>
					  <div class="col-sm-6">
						<label class="control-label">Dr Unit</label><br>  
						<div class="input-group input-group-sm">	   
							<?= $form->field($model, 'dr_unit')->dropDownList($physicianmaster,['required'=> true,'prompt'=>'-DoctorName-'])->label('') ?>
							<span class="input-group-btn">
							  <button type="button" onclick='Doctor_unit_fetch();' class="btn btn-default btn-flat btn  unit_consultant_details"><i class="ssearch glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					  </div>
				      
				   </div>
				    
				   <div class="row" style="margin-top:15px;">
				      <div class="col-sm-6">
						<label class="control-label">Speciality</label><br>  
						<div class="input-group input-group-sm">	   
							<?= $form->field($model, 'speciality')->dropDownList($physicianmaster,['required'=> true,'prompt'=>'-DoctorName-'])->label('') ?>
							<span class="input-group-btn">
							  <button type="button" class="btn btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					  </div>
				      <div class="col-sm-6">
						<label class="control-label">Co Consultant</label><br>  
						<div class="input-group input-group-sm">	   
							<?= $form->field($model, 'co_consultant')->dropDownList($physicianmaster,['required'=> true,'prompt'=>'-DoctorName-'])->label('') ?>
							<span class="input-group-btn">
							  <button type="button" class="btn btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					  </div>
				   </div>
		        </div>
		     </div>
		   </div>
		   
		   
		   <div class="col-sm-2">
		     <div class="c panel panel-border panel-custom"  style="margin-top:15%;">
			    <div class="panel-heading" hidden>
			        <h5 class="box-title">   </h5> 
		        </div>  
	            <div class="panel-body" style="padding:20px;">
				   <div class="row">
				     <div class="col-sm-12">
					     <div class="form-group"> 
    	                    <button type="button" class="btn btn-success b-width" id='saves_sucess' onclick="SaveIPForm();">Save</button>
    	                    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     	                    <span id="loadtexts" style="display: none; "></span>
                         </div>
					 </div>
				   </div>
				  <br>
				   <div class="row">
					 <div class="col-sm-12">
						<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/index" class="btn text-right btn-default b-width" Title="BACK To Grid">Back to Grid </a> 
					 </div>
				   </div>
		        </div>
		     </div>
		   </div>
		   </div>
	    </div>
						
		 <div id="load1" style='display:none;text-align: center;'><img  class="load-image" src="<?= Url::to('@web/loader1.gif') ?>" /></div>				
						
						
 
    
  <div class="col-md-12 hide">
       	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     		<?= $form->field($model, 'is_active', [
    		'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
			])->checkbox([],false) ?>
	</div>

    <!-- <?= $form->field($model, 'created_date')->textInput() ?>
    <?= $form->field($model, 'updated_date')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'userrole')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>
    <label for="search_cells">
		Search Grid: 
	</label>
<input id="search_cells" name="filterInput" type="search"/>
	<table id="jqGrid"></table>
	<div id="jqGridPager"></div>  -->
    

<!--- Test -->

    
<!--- test end ------>



    <?php ActiveForm::end(); ?>
   <!-- 
   <table id="example" class="table table-striped table-bordered nowrap display" style="width:100%">
				<thead>
				  <tr>
				  	<th>BED NO</th>
				    <th>ROOM NO</th>
				    <th>ROOM TYPES</th>
				    <th>BED CHARAGE</th>
				    
	
				  </tr>
				</thead>
				<tbody id='set_patient_data'>
					<?php  if(!empty($bed_list)){
						foreach($bed_list as $bed_val) { 
						$room_list=InRoomno::find()->where(['is_active'=>1])->andWhere(['autoid'=>$bed_val['room_id']])->asArray()->one();
						$roomtype_list=InRoomtypes::find()->where(['is_active'=>1])->andWhere(['autoid'=>$room_list['roomtypeid']])->asArray()->one();
						$floor_list=InFloormaster::find()->where(['is_active'=>1])->andWhere(['autoid'=>$room_list['floorid']])->asArray()->one();
	
					?>
					<tr id='<?php echo $bed_val['autoid']; ?>'>
						<td><?php echo $bed_val['bedno']; ?><input type="hidden" name="bedid" id="bedid<?php echo $bed_val['autoid']; ?>" value="<?php echo $bed_val['bedno']; ?>"></td>
						<td><?php echo $room_list['room_no']; ?><input type="hidden" name="roomid" id="roomid<?php echo $bed_val['autoid']; ?>" value="<?php echo $room_list['autoid']; ?>"></td>
						<td><?php echo $roomtype_list['room_types']; ?><input type="hidden" name="roomtypeid<?php echo $bed_val['autoid']; ?>" id="roomtypeid<?php echo $bed_val['autoid']; ?>" value="<?php echo $roomtype_list['autoid']; ?>"></td>
						<td><?php echo $roomtype_list['price']; ?><input type="hidden" name="floorid" id="floorid<?php echo $bed_val['autoid']; ?>" value="<?php echo $floor_list['autoid']; ?>"></td>
						
	
					</tr>
				<?php } } ?>	
				</tbody>
		</table> -->
</div>

</div>


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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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
      <div class="inp modal-footer" >
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> 
    </div>

  </div>
</div> 	


 <div id="doctor_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Doctor Details</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="doctor_history_report">
      
      <table id="doctor_table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Doctor Name</th>
            </tr>
        </thead>
      </table>		
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
 
 
<div class="modal" id='mr_modal' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
        <div class="text-center" style="color:red;font-size:20px;">IP Number is <span id='show_mrnumber'> </span></div>
      </div>
      <div class="inp modal-footer">
        <a href='<?php echo Yii::$app->homeUrl . "?r=in-registration/index";?>' class="btn btn-xs btn-default">Go Grid</a>
        <a href='<?php echo Yii::$app->homeUrl . "?r=in-registration/creates";?>' class="btn btn-xs btn-success">New Reg</a>
        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	

<!-- 
<div id="patient_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
   <!--  <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Details</h4>
      </div>
      <div class="modal-body">
      	
      	
        <div class="" id="patient_history_report">
            	<table id="tree"></table>
    			<div id="pager"></div>
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>  --> 
 
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>	
		

<script>
function Patient_bed() 
{
	$modal = $('#patient_hist-modal');
	$modal.modal('show');
}
function Doctor_fetch() 
{
	$modal = $('#doctor_details');
	$modal.modal('show');
}
function Doctor_unit_fetch() 
{
	$modal = $('#unit_consultant_details');
	$modal.modal('show');
}

 
$(document).ready(function() {
	jtable_pd();
	bedbo_fetch();    
	doctor_fetched();
	doctor_unit_consultant();


	$( ".ipnumber" ).focus();
	
	//$(".pagination > li > a").attr("href", "javascript:void(0)");
	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=in-registration/jqgrid';
	
    var disable_buttons = function(){
    $("._edit_save_btn").unbind("click").click(function(e){
        // disable all other buttons but selected
        $("._edit_save_btn").not(this).prop('disabled', true);  
    });
};


//call the above function on dataTable init and page change events like:

    
  $('#example').dataTable( {
    	// 'ajax': ajax_url,
    	   'stateSave': true,
		"responsive": true,
		//"paging": false,
 // "bInfo" : false,
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			},
			
			 "drawCallback": function () {
        $('#example_paginate > .pagination a').addClass('myNewClassName');
    },
			
		}
	} );
	
	
	/* $('#example1').dataTable( {
    	"bProcessing": true,
    	"serverSide" : true,
    	"ajax":{
    		url :ajax_url,
    		type : "POST"
    	}
	} );
	*/
    	 
 /*    $('#example').on('key-focus.dt', function(e, datatable, cell){
        
        $(table.row(cell.index().row).node()).addClass('selected');
    });

    $('#example').on('key-blur.dt', function(e, datatable, cell){
        $(table.row(cell.index().row).node()).removeClass('selected');
    });
        
    $('#example').on('key.dt', function(e, datatable, key, cell, originalEvent){
        if(key === 13){
            var data = table.row(cell.index().row).data();
            $("#example-console").html(data.join(', '));
        }
    });       
 		
*/
    
    


 	/*("#example tbody tr").on("click", "td", function() {
     	var a=$(this).closest('tr').attr('id');
     	
     	
     	var tdval=$(this).closest('tr');
     	var bed_no=tdval.find("td:eq(0)").text();
     	var room_no=tdval.find("td:eq(1)").text();
     	var room_types=tdval.find("td:eq(2)").text();
     	var flor_no=tdval.find("td:eq(3)").text();
     	
     	//Prime Id
     	var bed_id=$('#bedid'+a).val();
     	var room_id=$('#roomid'+a).val();
     	var room_type=$('#roomtypeid'+a).val();
     	var flor_id=$('#floorid'+a).val();
     	
     	
     	
     	$('#inregistration-bed_no').val(bed_no);
     	$('#inregistration-room_no').val(room_no);
     	$('#inregistration-floor_no').val(flor_no);
     	$('#inregistration-room_type').val(room_types);
     	
     	$('#bedid').val(bed_id);
     	$('#roomnoid').val(room_id);
     	$('#roomtypeid').val(room_type);
     	$('#floorid').val(flor_id);
     	
     	
     	
     	$modal = $('#patient_hist-modal');
		$modal.modal('hide');
     	
  }); */
 	
    $('#example tbody').on( 'click', 'tr', function () {
        
    } );
 $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
   // format: 'dd-mm-yyyy',
   endDate: "today",
	autoclose: true,
});
    
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



function SaveIPForm()
{
	var valid=$("#w0").valid();  
	if(valid == true)
	{
		if (confirm('Are You Sure to Save ?')) {
		$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/ip-admission";?>",
	            data: $("#w0").serialize(),
	            success: function (result) 
	            { 
	            	Alertment('Update Successfully..!');
	            }
			});
		}
	}else{
		
		
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
	  			 	
	  			 	//alert(data['dob']);
	  			
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
</script>	

  <script type="text/javascript"> 
    
        $(document).ready(function() {
			
		
$("body").on('click', '.patient_fetch_details', function ()
{
	$modal = $('#patient_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#reg_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});

 
		});
	
	function Patienttypemodule(){
		if($('#inregistration-type').val()=="3"){
		$(".ogs_name").css("display", "block");
	}else{
		$(".ogs_name").css("display", "none");
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
  				//alert(columnData);
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

$("body").on('click', '.patient_fetch_details', function ()
{
	$modal = $('#patient_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#reg_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});

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


function Unitdetailsfetch(data)
{
	var data_split=data.split('_');
	
	$('#inregistration-dr_unit').val(data_split[0]);
	$('#inregistration-speciality').val(data_split[1]);
	$modal = $('#unit_consultant_details');
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
        	$('#inregistration-religion').val(obj[0]['religion']);
        	
        	CalculateAge(obj[0]['dob']);
        	
        	$modal = $('#patient_details');
        	$modal.modal('hide');
        }
	});
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
	
function Patienttypemodule()
{
	if($('#inregistration-type').val()=="3"){
		$(".ogs_name").css("display", "block");
	}else{
		$(".ogs_name").css("display", "none");
	}
}



    </script>
 
