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
use backend\models\Physicianmaster;
use backend\models\SubVisit;
use backend\models\Insurance;
use backend\models\Newpatient;
use backend\models\InChangeroom;
use backend\models\BlockIpEntries;
use backend\models\InTreatmentOverall;
use backend\models\InTreatmentIndividual;
use backend\models\Treatment;
use backend\models\TaxgroupingLog;
use backend\models\InProcedureCancelation;
use backend\models\InProcCanIndividual;
use backend\models\InTreatmentOverallSearch;
use backend\models\BranchAdmin;
use backend\models\IpMoneyreceiptsLog;
use backend\models\IpMoneyreceipts;
use backend\models\InMedicalRecordingCharge;
use backend\models\InCategorygroup;
use backend\models\InRegistration;
use backend\models\LabTesting;
use backend\models\Testgroup;
use backend\models\MainTestgroup;

 /* @var $this yii\web\View */
/* @var $model backend\models\Finalbill */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<link href="<?php echo Url::base(); ?>/alert/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/alert/jquery-confirm.min.js"></script>  
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />

<style>
table.tbl-scrol thead, table.tbl-scrol tbody tr {
    display: unset!important;
  
    table-layout: fixed!important;
    font-size: 12px;
}
.pr-b7{
	position:relative;
	bottom:7px;
}
.form-group.field-finalbill-ipno {
    width: 50px;
    float: left;
}
.ipt.input-group-btn.fetch_record.patient_fetch_details {
    position: relative;
    top: 14px;
}
.form-control{padding:0px!important;
font-size:12px;}
body{line-height:1;}
table.dataTable th.focus,
table.dataTable td.focus {
  outline: none;
}
.panel-border.panel-custom .panel-heading{
	background-color:#fff;
}
.table>thead>tr>td{padding:0px;}
.b-width{width:100%;}
 .btn-default{color:#333!important;}
 .panel-border .panel-body {
    padding: 0px 20px 0px 20px;
	background-color: ;
}
.panel-border .panel-heading{    padding: 0px 20px 0px;}
.form-group label{margin-bottom: 0px;}
.c.panel{
	margin-bottom:3px;
	
}
h5.box-title{
	line-height: 0;
	font-size:12px;
}
textarea.txtaddress {
    min-height: 66px!important;
}
.content-page > .content{
	margin-top: 45px;
}
label.control-label{
	color:#444;
	font-weight:normal;
}
.br-rt{
	border-right:1px solid #F0F7FF;
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
    border: 1px solid #808080;     margin-bottom: 20px;
}
.patient_details .head {
    background: #337ab7;
 
    padding: 3px 0;
    font-size: 12px;
	margin: 0px 0px 10px 0px;
}
button.btn.btn-success.physician {
    padding: 1px 4px;
}
.patient_details .head span {
  /*   background: #dadada; */
  background:#337ab7;
    position: relative;
    /*top: -10px;
    left: 15px; */
    padding: 3px 15px;
    /* font-weight: bold; */
    color: #fff;
}
.nav.nav-tabs + .tab-content{
	padding: 5px;
}
.form-group label.control-label {
    font-size: 12px;
}
.form-group {
    margin-bottom: 0;
}
.nav-tabs > li.active > a:hover,.nav-tabs > li.active > a{
	  color: #fff !important; 
}
ul.nav.nav-tabs,ul.nav.nav-tabs li a {
    background: #031d33 ;
    color: #fff !important;     font-size: 13px;     line-height: 30px;
}
.nav.nav-tabs > li.active > a{
	    background-color: #d0a6ea !important;
}

.patient_details .form-group label.control-label {
    width: 37%;
    /*float: left;
    text-align: right;*/
    margin-right: 10px;
}
.patient_details .form-group input,.patient_details .form-group select,.patient_details .form-group textarea {
       padding: 0 8px;
    height: 22px!important;
    width: 56%;
    margin-bottom: .5em;
    font-size: 12px;
}
.dob {
    float: right;
    margin-bottom: 6px;
}
.dob input{
	/* border-top: none;
    border-left: none;
    border-right: none; */
}
.mid-width {
    width: 12.5%;
}
 #fetch_update_lab{
 	display: none;
 }
.patient_btn {
    padding: 0 0 10px 0;
}
.patient_btn>.form-group{
	float: right;
}
.patient_details .col-md-3 .form-group {
    padding: 0 10px;
}
.patient_details .col-md-3 {
    padding: 0 0;
    border-right: 1px solid #808080;
  	 min-height:390px;
}
.final_list a {
       list-style: none;
  width: 12.5%;
    background: #000;
    float: left;
    color: #fff;
    padding: 8.4px 10px;
    cursor: pointer;
	font-size:12px;
}
.summery-detail tr td,.final_list_det tr td {
    font-size: 12px;
}
.total-detail input {
    width: 70px;
    text-align: right;
    height: 20px!important;
    font-size: 12px;
}
.summery-detail td {
    padding: 2px 5px !important;
}
.total-detail td {
    padding: 2px 0 !important;
}
@media (min-width:769px) and (max-width:1024px){
   ul.nav.nav-tabs,ul.nav.nav-tabs li a {
         font-size: 11px;  
}  
table.tbl-scrol thead, table.tbl-scrol tbody tr{
  font-size:10px;
}

}
</style>
<div class="finalbill-form">
	<?php $form = ActiveForm::begin(); ?>
<div class="c panel panel-border panel-custom">
    <div class="panel-heading">
         <h5 class="box-title"><strong>Final Details</strong></h5> 
     </div>
 <div class="panel-body">
	<div class="row">
		<div class="col-sm-2">
		   <div class="row">
		      <div class="col-sm-6">
				<?= $form->field($model, 'ipno')->textInput(['maxlength' => true,'autocomplete'=>"off",'onkeyup'=>'EmptyESC(this,event)', 'class'=>'form-control ipnumber']) ?>
				<div class="ipt input-group-btn fetch_record patient_fetch_details" value='click' >
					<label class="control-label" for="finalbill-ipno">.</label>
						<span class="btn btn-default inpatient-details"  ><i class="glyphicon glyphicon-search"></i></span>
				</div>	
			  </div>
		      <div class="col-sm-6">
				<?= $form->field($model, 'mrno')->textInput(['maxlength' => true,'readonly'=>"readonly",'class'=>'form-control']) ?>
			  </div>
		   </div>
			
			 
			 <!-- <?= $form->field($model, 'locipno')->textInput(['maxlength' => true,'readonly'=>"readonly",'class'=>'form-control']) ?> -->
			 <span class="pr-b7">
			 <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>"readonly",'class'=>'form-control ']) ?>
			 </span>
		    			 		
		</div>
		<div class="col-sm-3">
		     <div class="row">
		      <div class="col-sm-4">
				<?= $form->field($model, 'age')->textInput(['maxlength' => true,'class'=>"age_field",'readonly'=>"readonly",'class'=>'form-control']) ?>
			  </div>
		      <div class="col-sm-8">
				<?= $form->field($model, 'gender')->textInput(['maxlength' => true,'class'=>"control-label gender_field",'readonly'=>"readonly"])->label('Gender'); ?>
			  </div>
			  </div>
			  
			  <div class="row pr-b7">
		      <div class="col-sm-4">
				<div class="form-group field-finalbill-address has-success">
				<label class="control-label" for="finalbill-address">Bed </label>
				<input type="text" id="finalbill-bed_no" class="form-control  " name="finalbill[bed_no]" maxlength="25" readonly="readonly" required="" aria-invalid="false">
			</div>
			  </div>
		      <div class="col-sm-8">
				<div class="form-group field-finalbill-paytype has-success">
				<label class="control-label" for="finalbill-paytype">Pay Type</label>
				<input type="text" id="finalbill-paytype" class="form-control  " name="finalbill[paytype]"  required="" readonly="readonly" aria-invalid="false">
			</div>
			  </div>
			  </div>
			  
			  
			  
			 
		</div>
		<div class="col-sm-2">
			 <div class="form-group field-inregistration-address has-success">
				<label class="control-label" for="finalbill-address">Address</label>
				<textarea id="finalbill-address" class="form-control txtaddress" name="finalbill[address]" readonly="readonly"  rows="1" required="" aria-invalid="false"></textarea>
			</div>
		</div>
		

		<div class="col-md-2">
			
			
			<div class="form-group field-finalbill-cons_dr has-success">
				<label class="control-label" for="finalbill-cons_dr">Cons.Dr</label>
				<input type="text" id="finalbill-cons_dr" class="form-control  " name="finalbill[cons_dr]"  required="" readonly="readonly" aria-invalid="false">
			</div>
			<div class="row">
				<div class="col-sm-6"><?= $form->field($model, 'doa')->textInput() ?></div>
				<div class="col-sm-6"><?= $form->field($model, 'dod')->textInput() ?></div>
			</div>
			
		</div>
		 
		<div class="col-md-3">
		  
			<div class="form-group field-finalbill-insurance has-success">
				<label class="control-label" for="finalbill-insurance">Insurance</label>
				<input type="text" id="finalbill-insurance" class="form-control  " name="finalbill[insurance]"  required="" readonly="readonly" aria-invalid="false">
			</div>
		   <div class="row">
			<div class="col-sm-6">
				<div class="form-group field-finalbill-general has-success">
				<label class="control-label" for="finalbill-general">General</label>
				<input type="text" id="finalbill-general" class="form-control  " name="finalbill[general]"  required="" readonly="readonly" aria-invalid="false">
			</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group field-finalbill-pat_type has-success">
				<label class="control-label" for="finalbill-pat_typ">Patient Type</label>
				<input type="text" id="finalbill-pat_typ" class="form-control  " name="finalbill[pat_typ]"  required="" aria-invalid="false" readonly="readonly">
			</div>
			</div>
		   </div>
			
			
		</div>
	</div>
	<div class="row">
		
	</div>	
   </div>
</div>

<div class="c panel panel-border panel-custom">
 <div class="panel-heading" style="padding: 0;">   
   <div class="panel-body" style="padding: 0px 0px;">
   	 <div class="row">
   	 	<div class="col-md-9" style="padding-right: 0px;">
   	 	
   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#roomrent">Room Rent</a></li>
    <li><a data-toggle="tab" href="#drvisit">Dr Visit </a></li>
    <li><a data-toggle="tab" href="#invest">Invest</a></li>
    <li><a data-toggle="tab" href="#pharmacy">Pharmacy</a></li>
    <li><a data-toggle="tab" href="#service">services</a></li>
    <li><a data-toggle="tab" href="#package">OT Packages</a></li>
    <li><a data-toggle="tab" href="#salesreturn">Sales Return</a></li>
    
  </ul>
   	<div class="" style="height:305px;">
<div class="tab-content">
	<div id="package" class="tab-pane fade">
	</div>	
	<div id="salesreturn" class="tab-pane fade">
	</div>	
	<div id="roomrent" class="tab-pane fade in active">
		 <table class="table table-bordered table-striped tbl-scrol" id="tbUser">
                        <thead>
                           <thead>
                              <tr rowspan="2">
                              <th style="width:8.2%" rowspan="2" class="text-center equal_space" style="">Remove</th>
                              <th rowspan="2" class="text-center">S.No</th>
                              <th style="width:10.5%" rowspan="2" class="text-center equal_space">Date</th>
                              <th style="width:10.2%" rowspan="2" class="text-center equal_space">S.Name  <a class="text-right btn addroom" > ADD + </a> </th>
                              <th style="width:10.3%" colspan="2" class="text-center equal_space"> Pay Type </th>
  								<th  style="width:9.3%" colspan="2" class="text-center equal_space"> Room Type </th>
								<th style="width:6%" colspan="2" class="text-center equal_space"> Room No </th>
								<th style="width:5%" colspan="2" class="text-center equal_space"> Bed No </th>
								<th style="width:7%"  colspan="2" class="text-center equal_space"> Floor No </th>
								<th style="width:5%" colspan="2" class="text-center equal_space"> unit </th>
                              <th style="width:7%" rowspan="2" class="text-center equal_space">Total</th>
                              <th style="width:5%" colspan="2" class="text-center equal_space">GST (%)</th>
                              <th style="width:5%" colspan="2" class="text-center equal_space">GST (Amt)</th>
                              <th rowspan="2" class="text-center equal_space">Net Amount</th>
                              
                           </tr>
                           <!--  <tr>                                                                                   
                              <th colspan=" " class="text-center">CGST(%)</th>
                              <th colspan=" " class="text-center">SGST(%)</th>
                              <th colspan=" " class="text-center">CGST(Amt)</th>
                              <th colspan=" " class="text-center">SGST(Amt)</th>  
                              <th colspan=" " class="text-center">Disc(%)</th>
                              <th colspan=" " class="text-center">Disc(Amt)</th>                                                                                
                           </tr> -->  
					    </thead>
                       <tbody id="fetch_update_room" style="height:190px !important;">
                        </tbody>
                     </table>
            <table class="table table-bordered table-striped  total-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 		<tfoot>
   	 			<tr> <td> <a> Bed Transfer </a> </td><td>  Total </td> 
   	 				<td> <input type="text" id="room_total_value" class="form-control room_total_value" name="room_total_value" value="0" > </td> 
   	 				<td> Disc (%) </td><td> <input type="text" name="room_dis_pre" id="room_dis_pre" class="form-control  room_dis_pre" value="0" ></td>
   	 				<td> Disc (Amt) </td><td> <input type="text" name="room_dis_amt" id="room_dis_amt" class="form-control  room_dis_amt" value="0" ></td>
   	 				<td> Net Amount </td><td> <input type="text" name="room_net_amt" id="room_net_amt" class="form-control  room_net_amt" value="0" ></td>
   	 				 </tr>
   	 		</tfoot>
   	 	 </table>
    </div>
    <div id="pharmacy" class="tab-pane fade">
		 <table class="table table-bordered table-striped tbl-scrol" id="tbUser"   >
                        <thead>
                           <tr rowspan="2">
                           	<th rowspan="2" class="text-center equal_space" style="">Remove</th>
                              <th rowspan="2" class="text-center ">S.No</th>
                              <th rowspan="2" class="text-center equal_space">Date</th>
                              <th rowspan="2" class="text-center equal_space">S.Name <a class="text-right btn addpharmachy" > + </a> </th>
                              <th rowspan="2" class="text-center equal_space">Rate</th>
                              <th rowspan="2" class="text-center equal_space">QTY</th>
                              <th rowspan="2" class="text-center equal_space">Total</th>
                              <th colspan="2" class="text-center equal_space">GST(%)</th>
                              <th colspan="2" class="text-center equal_space">GST(Amt)</th>
                              <th colspan="2" class="text-center equal_space">Discount</th>
                              <th rowspan="2" class="text-center equal_space">Net Amount</th>
                          </tr>
                            <tr>                                                                                   
                              <th colspan=" " class="text-center">CGST(%)</th>
                              <th colspan=" " class="text-center">SGST(%)</th>
                              <th colspan=" " class="text-center">CGST(Amt)</th>
                              <th colspan=" " class="text-center">SGST(Amt)</th>  
                              <th colspan=" " class="text-center">Disc(%)</th>
                              <th colspan=" " class="text-center">Disc(Amt)</th>                                                                                
                           </tr>
                        	
                        </thead>
                       <tbody id="fetch_update_treatment" style="height:190px !important;">
                        </tbody>
                     </table>
           <table class="table table-bordered table-striped  total-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 		<tfoot>
   	 			<tr> <td> <a> Bed Transfer </a> </td><td>  Total </td> 
   	 				<td> <input type="text" id="pharmacy_total_value" class="form-control pharmacy_total_value" name="pharmacy_total_value" value="0" > </td> 
   	 				<td> Disc (%) </td><td> <input type="text" name="pharmacy_dis_pre" id="pharmacy_dis_pre" onkeyup="DiscountPercentCalCulation(this,event);" class="form-control  pharmacy_dis_pre" value="0" ></td>
   	 				<td> Disc (Amt) </td><td> <input type="text" name="pharmacy_dis_amt" id="pharmacy_dis_amt" onkeyup="DiscountValueCalCulation(this,event);" class="form-control  pharmacy_dis_amt" value="0" ></td>
   	 				<td> Net Amount </td><td> <input type="text" name="pharmacy_net_amt" id="pharmacy_net_amt" class="form-control  pharmacy_net_amt" value="0" ></td>
   	 				 </tr>
   	 		</tfoot>
   	 	 </table>          
    </div>
    <div id="service" class="tab-pane fade">
		 <table class="table table-bordered table-striped tbl-scrol" id="tbUser"   >
                        <thead>
                           <tr rowspan="2">
                           	  <th rowspan="2" class="text-center equal_space" style="">Remove</th>
                              <th rowspan="2" class="text-center ">S.No</th>
                              <th rowspan="2" class="text-center equal_space">Date</th>
                              <th rowspan="2" class="text-center equal_space">S.Name <a class="text-right btn add_service" > + </a> </th>
                              <th rowspan="2" class="text-center equal_space">Rate</th>
                              <th rowspan="2" class="text-center equal_space">QTY</th>
                              <th rowspan="2" class="text-center equal_space">Total</th>
                              <th colspan="2" class="text-center equal_space">GST(%)</th>
                              <th colspan="2" class="text-center equal_space">GST(Amt)</th>
                              <th colspan="2" class="text-center equal_space">Discount</th>
                              <th rowspan="2" class="text-center equal_space">Net Amount</th>
                              
                           </tr>
                            <tr>                                                                                   
                              <th colspan=" " class="text-center">CGST(%)</th>
                              <th colspan=" " class="text-center">SGST(%)</th>
                              <th colspan=" " class="text-center">CGST(Amt)</th>
                              <th colspan=" " class="text-center">SGST(Amt)</th>  
                              <th colspan=" " class="text-center">Disc(%)</th>
                              <th colspan=" " class="text-center">Disc(Amt)</th>                                                                                
                           </tr>
                        </thead>
                       <tbody id="fetch_update_service" style="height:190px !important;">
                        </tbody>
                     </table>
                     <table class="table table-bordered table-striped  total-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 		<tfoot>
   	 			<tr> <td> <a> Bed Transfer </a> </td><td>  Total </td> 
   	 				<td> <input type="text" id="service_total_value" class="form-control service_total_value" name="service_total_value" value="0" > </td> 
   	 				<td> Disc (%) </td><td> <input type="text" name="service_dis_pre" id="service_dis_pre" class="form-control  service_dis_pre" value="0" ></td>
   	 				<td> Disc (Amt) </td><td> <input type="text" name="service_dis_amt" id="service_dis_amt" class="form-control  service_dis_amt" value="0" ></td>
   	 				<td> Net Amount </td><td> <input type="text" name="service_net_amt" id="service_net_amt" class="form-control  service_net_amt" value="0" ></td>
   	 				 </tr>
   	 		</tfoot>
   	 	 </table>
    </div>
    <div id="drvisit" class="tab-pane fade">
		 <table class="table table-bordered table-striped tbl-scrol" id="tbUser"  >
                        <thead>
                           <tr rowspan="2">
                           	<th rowspan="2" class="text-center equal_space" style="">Remove</th>
                              <th rowspan="2" class="text-center ">S.No</th>
                              <th rowspan="2" class="text-center equal_space">Date</th>
                              <th rowspan="2" class="text-center equal_space">S.Name</th>
                              <th rowspan="2" class="text-center equal_space">Rate</th>
                              <th rowspan="2" class="text-center equal_space">QTY</th>
                              <th rowspan="2" class="text-center equal_space">Total</th>
                              <th colspan="2" class="text-center equal_space">GST(%)</th>
                              <th colspan="2" class="text-center equal_space">GST(Amt)</th>
                              <th colspan="2" class="text-center equal_space">Discount</th>
                              <th rowspan="2" class="text-center equal_space">Net Amount</th>
                              
                           </tr>
                            <tr>                                                                                   
                              <th colspan=" " class="text-center">CGST(%)</th>
                              <th colspan=" " class="text-center">SGST(%)</th>
                              <th colspan=" " class="text-center">CGST(Amt)</th>
                              <th colspan=" " class="text-center">SGST(Amt)</th>  
                              <th colspan=" " class="text-center">Disc(%)</th>
                              <th colspan=" " class="text-center">Disc(Amt)</th>                                                                                
                           </tr>
                        	
                        </thead>
                       <tbody id="fetch_update_room" style="height:190px !important;">
                        </tbody>
                     </table>
		<table class="table table-bordered table-striped  total-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 		<tfoot>
   	 			<tr> <td> <a> Bed Transfer </a> </td><td>  Total </td> 
   	 				<td> <input type="text" id="drvisit_total_value" class="form-control drvisit_total_value" name="drvisit_total_value" value="0" > </td> 
   	 				<td> Disc (%) </td><td> <input type="text" name="drvisit_dis_pre" id="drvisit_dis_pre" class="form-control  drvisit_dis_pre" value="0" ></td>
   	 				<td> Disc (Amt) </td><td> <input type="text" name="drvisit_dis_amt" id="drvisit_dis_amt" class="form-control  drvisit_dis_amt" value="0" ></td>
   	 				<td> Net Amount </td><td> <input type="text" name="drvisit_net_amt" id="drvisit_net_amt" class="form-control  drvisit_net_amt" value="0" ></td>
   	 				 </tr>
   	 		</tfoot>
   	 	 </table>
    </div>    
    <div id="invest" class="tab-pane fade ">
   	 	   <table class="table table-bordered table-striped tbl-scrol" id="tbUser"  >
                        <thead>
                           <tr rowspan="2">
                           	<th rowspan="2" class="text-center equal_space" style="">Remove</th>
                              <th rowspan="2" class="text-center ">S.No</th>
                              <th rowspan="2" class="text-center equal_space">Date</th>
                              <th rowspan="2" class="text-center equal_space">S.Name <a class="text-right btn addinvest"> + </a> </th>
                              <th rowspan="2" class="text-center equal_space">Rate</th>
                              <th rowspan="2" class="text-center equal_space">QTY</th>
                              <th rowspan="2" class="text-center equal_space">Total</th>
                              <th colspan="2" class="text-center equal_space">GST(%)</th>
                              <th colspan="2" class="text-center equal_space">GST(Amt)</th>
                              <th colspan="2" class="text-center equal_space">Discount</th>
                              <th rowspan="2" class="text-center equal_space">Net Amount</th>
                              
                           </tr>
                            <tr>                                                                                   
                              <th colspan=" " class="text-center">CGST(%)</th>
                              <th colspan=" " class="text-center">SGST(%)</th>
                              <th colspan=" " class="text-center">CGST(Amt)</th>
                              <th colspan=" " class="text-center">SGST(Amt)</th>  
                              <th colspan=" " class="text-center">Disc(%)</th>
                              <th colspan=" " class="text-center">Disc(Amt)</th>                                                                                
                           </tr>
                        	
                        </thead>
                       <tbody id="fetch_update_lab" style="height:190px !important;">
                        </tbody>
                     </table>
		<table class="table table-bordered table-striped  total-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 		<tfoot>
   	 			<tr> <td> <a> Bed Transfer </a> </td><td>  Total </td> 
   	 				<td> <input type="text" id="inv_total_value" class="form-control inv_total_value" name="inv_total_value" value="0" > </td> 
   	 				<td> Disc (%) </td><td> <input type="text" name="inv_dis_pre" id="inv_dis_pre" class="form-control  inv_dis_pre" value="0" ></td>
   	 				<td> Disc (Amt) </td><td> <input type="text" name="inv_dis_amt" id="inv_dis_amt" class="form-control  inv_dis_amt" value="0" ></td>
   	 				<td> Net Amount </td><td> <input type="text" name="inv_net_amt" id="inv_net_amt" class="form-control  inv_net_amt" value="0" ></td>
   	 				 </tr>
   	 		</tfoot>
   	 	 </table>
   	 	 
    		</div>
		</div>                     
   	 	
   	 </div>	
   	 	
   	 	</div>
   	 	<div class="col-md-3" style="padding-left:0">
   	 		<div class="final_list">
   				<a style="width:100%;text-align:center"> Summary </a>
   			</div>
   		<table class="table table-bordered table-striped  summery-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 	  <thead>
		  <tr></tr>
   	 	  	 <tr> <td style="width:50%;"> Room Rent </td> <td style="width:50%;"> <input type="text" readonly="readonly" id="roomrent_txt"> </td> </tr>
			 <tr> <td style="width:50%;"> Dr Visit </td>  <td style="width:50%;"> <input type="text" readonly="readonly" id="dr_visit_txt"> </td> </tr>
			 <tr> <td style="width:50%;"> Invest </td> <td style="width:50%;"> <input type="text" readonly="readonly" id="invest_txt"> </td> </tr>
			 <tr> <td style="width:50%;"> Pharmacy </td> <td style="width:50%;"> <input type="text" readonly="readonly" id="pharmacy_txt">  </td> </tr>
			 <tr> <td style="width:50%;"> Services </td> <td style="width:50%;"> <input type="text" readonly="readonly" id="service_txt"> </td> </tr>
			 <tr> <td style="width:50%;"> OT Package </td><td style="width:50%;"> <input type="text" readonly="readonly" id="optpackage_txt"> </td> </tr>
			 <tr> <td style="width:50%;"> Sales Return </td> <td style="width:50%;"> <input type="text" readonly="readonly" id="sal_ret_txt"> </td> </tr>
		  </thead>
   	 	</table>
   	 	<div style="height:75px;">
   	 	<table class="table table-bordered table-striped  summery-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 		<thead>
   	 			<tr>
   	 				<td> Date </td>
   	 				<td> Rc.No </td>
   	 				<td> Amount </td>
   	 				<td> Payment </td>
   	 				<td> Type </td>
   	 			</td>	
   	 		</thead>
   	 		<tbody id="fetch_update_moneyreceipts" >
			</tbody>	
   	 	</table>
   	 	</div>
   	 	<table class="table table-bordered table-striped  summery-detail" style="width:100%;" ALIGN="center;text-align:center">
   	 		<tr><td> Total Advance </td><td> <input type="text" name="total_advance" class="total_advance" id="total_advance" > </td></tr>
   	 	</table>	
   	 	</div>	
   	 </div>	
    </div>
  </div>
</div>

<div class="c panel panel-border panel-custom">
 <div class="panel-heading"> </div>  
   <div class="panel-body">
    <div class="row">
	   <div class="col-sm-10"> 
	    <div class="row">
		<div class="col-sm-10">
		<div class="col-sm-2"><?= $form->field($model, 'total_amt')->textInput(['maxlength' => true,'readonly'=>"readonly"]) ?></div>
	    <div class="col-sm-2"><?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?></div>
	    <div class="col-sm-2"><?= $form->field($model, 'net_amount')->textInput(['maxlength' => true,'readonly'=>"readonly"]) ?></div>
	    <div class="col-sm-3"> <?= $form->field($model, 'paid_amount')->textInput(['maxlength' => true,"onkeyup"=>"PaidAmountCalculation(this,event);",'readonly'=>"readonly"]) ?></div>
    	<div class="col-sm-3"> <?= $form->field($model, 'balance_amount')->textInput(['maxlength' => true,'readonly'=>"readonly"]) ?>	</div>
		<div class="col-sm-4"><?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?></div>
		<div class="col-sm-4"><?= $form->field($model, 'refundable')->textInput(['maxlength' => true]) ?></div>
		<div class="col-sm-4"> <?= $form->field($model, 'auth_by')->textInput(['maxlength' => true]) ?></div>
		</div>
		
		<div class="col-sm-2">
			<div class="col-sm-12">
    		<?= $form->field($model, 'remark')->textarea(['rows' => 6,'class'=>'form-control'] ) ?>
	   </div>
		</div>
		
		
		
	  
		</div>
 
		</div>
		
		<div class="col-sm-2">
					   <div class="row" style="margin-top:30%;">
					      <div class="form-group"> 
					      	 <button type="button" class="btn btn-xs btn-success  " id='saves_sucess' onclick="SaveIPForm();">Save</button> 
							 <button type="button" class="btn btn-xs btn-warning  " onclick='Refresh()'>Refresh</button>
							<button type='reset' class="btn btn-xs btn-default  "  onclick='clearForm();'>Clear</button> 							 
						  <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
				<span id="loadtexts" style="display: none; "></span>
						  </div>
            </div>
	</div>
	
	<!-- Bed Number --> 
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
 		<div class="panel-body">
				   <div class="row">
				       <div class="col-sm-4">
							<div class="form-group field-inregistration-paytype">
							<label class="control-label" for="inregistration-paytype">Pay Type</label>
							<select id="inregistration-paytype" class="  form-control w-cus " name="InRegistration[paytype]" style=" " tabindex="338" required="">
							<option value="Economy">ECONOMY</option>
							</select>
							
							<div class="help-block"></div>
							</div>
							  </div>
				     <div class="col-sm-4">
						    <label class="control-label">Bed No</label><br>  
							<div class="input-group input-group-sm">							   
								<div class="form-group field-inregistration-bed_no">
									<label class="control-label" for="inregistration-bed_no"></label>
									<input type="text" id="inregistration-bed_no" class="form-control  " name="InRegistration[bed_no]" maxlength="25" required="">
									
									<div class="help-block"></div>
									</div>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-flat btn  patient_bed"><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>
						</div>
					   

					   <div class="col-sm-4">
						    <label class="control-label">Room No</label><br>  
							<div class="input-group input-group-sm">
							   
								<div class="form-group field-inregistration-room_no">
									<label class="control-label" for="inregistration-room_no"></label>
									<input type="text" id="inregistration-room_no" class="form-control pl-15" name="InRegistration[room_no]" maxlength="25" required="">
									
									<div class="help-block"></div>
									</div>
									<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-flat btn  "><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>
						</div>
                      </div>
                      <div class="row">					  
					   <div class="col-sm-4">
						<div class="form-group field-inregistration-floor_no has-success">
							<label class="control-label" for="inregistration-floor_no">Floor No</label>
							<input type="text" id="inregistration-floor_no" class="form-control" name="InRegistration[floor_no]" maxlength="25" required="" aria-invalid="false">
							</div>					   
					</div>
					<div class="col-sm-4">
							<div class="form-group field-inregistration-room_type">
							<label class="control-label" for="inregistration-room_type">Room Type</label>
							<input type="text" id="inregistration-room_type" class="form-control" name="InRegistration[room_type]" maxlength="25" required="">
							
							<div class="help-block"></div>
							</div>							
					  </div>
					  <div class="col-sm-4">
							<div class="form-group field-inregistration-room_type">
							<label class="control-label" for="inregistration-room_type">DR UNIT</label>
							<input type="text" id="inregistration-dr_unit" class="form-control" name="InRegistration[dr_unit]" maxlength="25" required="">
							<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-flat btn  unit_consultant_details" onclick="Doctor_unit_fetch();"><i class="ssearch glyphicon glyphicon-search"></i></button>
								</span>
							</div>							
					  </div>
					  	 
						<input type="hidden" name="bedid" id="bedid" value="100">
						<input type="hidden" name="roomnoid" id="roomnoid" value="400">
						<input type="hidden" name="roomtypeid" id="roomtypeid" value="300">
						<input type="hidden" name="floorid" id="floorid" value="200">
					  </div>
					  
					  <div class="row">
					   		<div class="form-group"> 
					      	 <button type="button" class="btn btn-xs btn-success  " id="saves_bedroom" onclick="Saveroom();">Save</button>
					      	</div>  
					  </div>	
				   </div>
  	
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

<!-- pharmacy details--> 
<div id="pharmacy_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pharmacy Details</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="patient_history_report">
 		
  	
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

<!-- invest details--> 
<div id="Invest_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invest Details</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="patient_history_report">
 		  <div class="row ">
 			   <div class=""  style="margin: auto !important;width: 60%;background-color: #ebeff2;padding: 10px;margin-bottom: 3px !important;">
						 	   <input type="text" class="typehead text-cap form-control input-lg fwidth  medienter inrefrsh" placeholder="Enter Lab Name" tabindex="7" id="medicines">
						 	   <span hidden id="already" style="color: red; font-size: 15px; display: none;" hidden="">Data Already Exist</span>
							   <input type="hidden" class="form-control" id="name">      
								 <h5 class="text-center stock_no" style="display: none;"><span style="color:red;font-weight:bold;">No Result Found</span></h5>
						</div>	  	
 		  </div>	
  		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
		 
		 <!-- Services Details -->
<div id="services_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Services </h4>
      </div>
      <div class="modal-body">
      	<div class="" id="patient_history_report">
 		  <div class="row">
 		    <div class="form-group col-md-3">
 		    	<div class="form-group field-inregistration-room_type">
				 <label class="control-label" > Date </label>
				 <input type="text" id="services_date" class="form-control" name="services_date" required="">
				</div>	
 		    </div>	
 		    <div class="col-md-3">
 		    	<div class="form-group ">
					<label class="control-label" >NAME</label>
					<input type="text" id="services_name" class="form-control" name="services_name" required="">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default btn-flat btn  services_list" onclick="servicesno_list();"><i class="ssearch glyphicon glyphicon-search"></i></button>
					</span>
				</div>
 		    </div>
 		    <div class="form-group col-md-3">
 		    	<div class="form-group field-inregistration-room_type">
				 <label class="control-label" > QTY </label>
				 <input type="text" id="services_qty" class="form-control" name="services_qty" >
				</div>	
 		    </div>
 		    <div class="form-group col-md-3">
 		    	<div class="form-group field-inregistration-room_type">
				 <label class="control-label" > Rate </label>
				 <input type="text" id="services_rate" class="form-control" name="services_rate" required="">
				</div>	
 		    </div>
 		    <div class="col-md-3">
 		    	<div class="form-group ">
					<label class="control-label" > UNIT NAME</label>
					<input type="text" id="unit_name" class="form-control" name="unit_name" readonly="readonly">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default btn-flat btn  unitfetch" onclick="unitfetch();" ><i class="ssearch glyphicon glyphicon-search"></i></button>
					</span>
				</div>
 		    </div>
 		    <div class="col-md-3">
 		    	<div class="form-group ">
					<label class="control-label" > Per Doctor </label>
					<input type="text" id="per_dr" class="form-control" name="per_dr" readonly="readonly">
				</div>
 		    </div>
 		    <div class="col-md-3">
 		    	<div class="form-group ">
 		    		<button type="button" class="btn btn-success b-width" id="saves_services" onclick="Saveservices();"> Add </button>
 		    		
				</div>
 		    </div>
 		    
 		  </div>
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
		
	    <div class="form-group">
        <!-- <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?> -->
    </div>
		

    <!--
    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'created_date')->textInput() ?>
    <?= $form->field($model, 'updated_date')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?> -->
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
				  </tr>
				</thead>
				
				</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

<div id="services_fetch" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Bed List</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="patient_history_report">
            <table id="servicenofetch" class="table table-striped table-bordered nowrap display" style="width:100%">
				<thead>
				  <tr>
				  	<th>Services Name</th>
				    <th>Rate</th>
				  </tr>
				</thead>
			</table>
		</div>
      </div>
      <div class="modal-footer">
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

<?php
	
	$lab_testing=LabTesting::find()->where(['isactive'=>'1'])->asArray()->all();
	$merge_lab_array=array();
	if(!empty($lab_testing))
	{
		foreach ($lab_testing as $key => $value) 
		{
			$merge_lab_array[]=array('value' =>$value['test_name'],'value1' => 'LabTesting_'.$value['autoid'],'value2' => $value['price']);
		}
	}
	//$productlist_col_val[] = array('value' => $value['productname'].' - '.$comp_index[$value['composition_id']]['composition_name'],'value1' => $value['productid']);
	$testgroup=Testgroup::find()->where(['isactive'=>'1'])->asArray()->all();
	if(!empty($testgroup))
	{
		foreach ($testgroup as $key => $value) 
		{
			$merge_lab_array[]=array('value'=>$value['testgroupname'],'value1' => 'TestGroup_'.$value['autoid'],'value2' => $value['price']);			
		}
	}
	
	$mastergroup=MainTestgroup::find()->where(['isactive'=>'1'])->asArray()->all();
	if(!empty($mastergroup))
	{
		foreach ($mastergroup as $key => $value) 
		{ 
			$merge_lab_array[]=array('value'=>$value['testgroupname'],'value1' => 'MasterGroup_'.$value['autoid'],'value2' => $value['price']);			
		}
	}
	
	$merge_lab_json = json_encode($merge_lab_array);

?>

<div id="ippatient_details" class="modal fade" role="dialog">
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

    <?php ActiveForm::end(); ?>

</div>
</div>

</div>
<script>
$( function() {
    $( "#services_date" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
 });
 
 // bed 
function Patient_bed() 
{
	$modal = $('#patient_hist-modal');
	$modal.modal('show');
}

$("body").on('click', '.patient_bed', function ()
{
	$modal = $('#patient_hist-modal');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#bednofetch").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});

// dr
$("body").on('click', '.unit_consultant_details', function ()
{
	$modal = $('#unit_consultant_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#unit_consultant_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});	

// service list
$("body").on('click', '.services_list', function ()
{
	$modal = $('#services_fetch');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#servicenofetch").DataTable();
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
function Doctor_unit_fetch() 
{
	$modal = $('#unit_consultant_details');
	$modal.modal('show');
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
$(document).ready(function() {
	bedbo_fetch();
	doctor_unit_consultant();
	services_fetch();
});

//Bed No Master

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

function servicesno_list() 
{
	$modal = $('#services_fetch');
	$modal.modal('show');
}

// service ni
function services_fetch(){
    	
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=finalbill/servicefetch';
  var table_reg= $('#servicenofetch').DataTable( {
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
            { "data": "servicename", },
            { "data": "rate","defaultContent": "NA" },
            ],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#servicenofetch').on('key-focus.dt', function(e, datatable, cell){
     
         $('#servicefetch_filter input').focus();
    });
  $('#servicenofetch').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#servicenofetch").DataTable();
        if(key === 13){
        	
        	$('#servicenofetch thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#servicenofetch_filter input').focus();
        }
    }); 
    
$('#servicenofetch').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
    alert(data);
 	servicedetailsfetch(data);
});

$('#servicenofetch').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		servicedetailsfetch(data);
 	}
});    
    
}

function servicedetailsfetch(data) 
{
	alert(data);
 	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/bednogrid&id=";?>"+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        	
        	$modal = $('#patient_hist-modal');
        	$modal.modal('hide');
        }
	});
}

function clearForm() 
{
	  	window.location.reload(true);  
 	}
function Refresh() 
{	
	window.location.reload();
	}
	
$("body").on('click', '.addroom', function ()
{
	$modal = $('#patient_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#reg_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});

$("body").on('click', '.add_service', function ()
{
	$modal = $('#services_details');
	$modal.modal('show');
	setTimeout(function(){ 
		var table_as = $("#service_table").DataTable(); 
		table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});

// pharmacy popup

$("body").on('click', '.addpharmachy', function ()
{
	$modal = $('#pharmacy_details');
	$modal.modal('show');
	
});

// Invest Details
$("body").on('click', '.addinvest', function ()
{
	$modal = $('#Invest_details');
	$modal.modal('show');
	
});

	
function EmptyESC(data,event)
 {
 	if(data.value === '' || event.keyCode === 27)
	{
		$('#finalbill-name').val('');
		$('#finalbill-age').val('');
		$('#finalbill-gender').val('');
		$('#finalbill-address').val('');
		$('#finalbill-bed_no').val('');
		$('#finalbill-paytype').val('');
		$('#finalbill-cons_dr').val('');
		$('#finalbill-doa').val('');
		$('#finalbill-dod').val('');
		$('#finalbill-insurance').val('');
		$('#finalbill-general').val('');
		$('#finalbill-pat_typ').val('');
		$('#finalbill-total_amt').val('');
		$('#finalbill-mrno').val('');
		$('#finalbill-discount').val('');
		$('#finalbill-paid_amount').val('');
		$('#finalbill-balance_amount').val('');
	}
 }
	
$(document).ready(function() {
	$( ".ipnumber" ).focus();
	
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
	  			url:'<?php echo Yii::$app->homeUrl . "?r=finalbill/ajaxipnumberselect&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{
	  				$('#load1').hide();
	  				$('#finalbill-doa').val(formatDate(data['user']['created_date']));
	  				$('#finalbill-dod').val(formatDate(data['user']['updated_date']));
	  				
	  			 	$('#finalbill-mrno').val(data['user']['mr_no']);
	  			 	$('#finalbill-name').val(data['user']['patient_name']);
	  			 	$('#finalbill-age').val(formatDate(data['user']['dob']));
	  			 	$('#finalbill-gender').val(data['user']['sex']);
	  			 	$('#finalbill-address').val(data['user']['address']);
	  			 	$('#finalbill-pat_typ').val(data['user']['paytype']);
	  			 	$('#finalbill-bed_no').val(data['user']['bed_no']);
	  			 	$('#finalbill-cons_dr').val(data['user']['consultant_dr']);
	  			 	
					$('#finalbill-paytype').val(0);
					$('#finalbill-insurance').val(0);
					$('#finalbill-general').val(0);
	
	  			 	$('#roomrent_txt').val(data['room_total']);
	  			 	$('#dr_visit_txt').val(0);
	  			 	if(data['labpaymentprime']===""){
	  			 		$('#invest_txt').val(0);	
	  			 	}else{
	  			 		$('#invest_txt').val(data['labpaymentprime']['overall_net_amt']);
	  			 	}
	  			 	$('#pharmacy_txt').val(data['treatment']['overall_net_amount']);
	  			 	$('#service_txt').val(data['service_amt'][0]['amount']);
	  			 	$('#optpackage_txt').val(0);
	  			 	$('#sal_ret_txt').val(0);
	  			 	$('#total_advance').val(data['money_total']);
	  			 	$('#finalbill-paid_amount').val(data['money_total']);
	 				var paidamt=parseFloat($('#finalbill-paid_amount').val());
					var netamt=parseFloat($('#finalbill-net_amount').val()).toFixed(2);
					var balamt=parseFloat($('#finalbill-balance_amount').val()).toFixed(2);
					$('#finalbill-balance_amount').val(netamt-paidamt);
						if(isNaN(balamt)){
							$('#finalbill-balance_amount').val(0)
						} 			 	
	  			 	
	  			 	
	  			 	$('#room_total_value').val(data['room_total']);
	  			 	$('#drvisit_total_value').val(0);
	  			 	$('#inv_total_value').val(data['labpaymentprime']['overall_sub_total']);
	  			 	$('#pharmacy_total_value').val(data['treatment']['overall_sub_total']);
	  			 	$('#service_total_value').val(data['service_amt'][0]['amount']);
	  			 	
	  			 	var final_total_amt=parseFloat($('#service_total_value').val())+parseFloat($('#pharmacy_total_value').val())+parseFloat($('#inv_total_value').val())+parseFloat($('#drvisit_total_value').val())+parseFloat($('#room_total_value').val());
	  			 	$('#finalbill-total_amt').val(parseFloat(final_total_amt).toFixed(2));
	  			 	
	  			 	$('#room_net_amt').val(data['room_total']);
	  			 	$('#drvisit_net_amt').val(0);
	  			 	$('#inv_net_amt').val(data['labpaymentprime']['overall_net_amt']);
	  			 	$('#pharmacy_net_amt').val(data['treatment']['overall_net_amount']);
	  			 	$('#service_net_amt').val(data['service_amt'][0]['amount']);
	  			 	var finalbill_netamount=parseFloat($('#service_net_amt').val())+parseFloat($('#pharmacy_net_amt').val())+parseFloat($('#inv_net_amt').val())+parseFloat($('#drvisit_net_amt').val())+parseFloat($('#room_net_amt').val());
	  			 	$('#finalbill-net_amount').val(parseFloat(finalbill_netamount).toFixed(2));
	  			 	
	  			 	$('#fetch_update_lab').html(data['tbl_lap'])
	  			 	$('#fetch_update_room').html(data['room'])
	  			 	$('#fetch_update_treatment').html(data['tbl_treatent'])
	  			 	$('#fetch_update_service').html(data['service_tbl'])
	  			 	$('#fetch_update_moneyreceipts').html(data['money_re'])
	  			 	
	  			 	
	  			 	 
	  			}
	  		})
	  }
});


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
function PaidAmountCalculation(data,event) 
{
	var paid_amount=data.value;
	//var overall_net_amount=DefaultAmount();
	var paidamt=parseFloat($('#finalbill-paid_amount').val());
	var netamt=parseFloat($('#finalbill-net_amount').val()).toFixed(2);
	var balamt=parseFloat($('#finalbill-balance_amount').val()).toFixed(2);
	$('#finalbill-balance_amount').val(netamt-paidamt);
	if(isNaN(balamt)){
		$('#finalbill-balance_amount').val(0)
	}
}


function SaveIPForm()
{
	var valid=$("#w0").valid();  
	if(valid == true)
	{
		$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . "?r=finalbill/create";?>",
	            data: $("#w0").serialize(),
	            success: function (result) 
	            { 
	            	alert("save");
	            }
			});
	}
}

$("body").on('click', '.delrow', function (){
	var data_addid = $(this).attr('data_delete_row')
	var data_price = $(this).attr('data_price')
	var total=parseFloat($('#roomrent_txt').val());
	var final_paid_amt=parseFloat($('#finalbill-paid_amount').val());
	$('#roomrent_txt').val(parseFloat(total-data_price).toFixed(2));
	$('#room_net_amt').val(parseFloat(total-data_price).toFixed(2));
	
	var finalbill_netamount=parseFloat($('#service_net_amt').val())+parseFloat($('#pharmacy_net_amt').val())+parseFloat($('#inv_net_amt').val())+parseFloat($('#drvisit_net_amt').val())+parseFloat($('#room_net_amt').val());
	$('#finalbill-net_amount').val(parseFloat(finalbill_netamount).toFixed(2));
	  PaidAmountCalculation(final_paid_amt,event);		 	
	$('#room_del'+data_addid).remove();
 });
 
 $("body").on('click', '.delrowlab', function (){
	var data_addid = $(this).attr('data_delete_row')
	var data_price = $(this).attr('data_price')
	var total=parseFloat($('#invest_txt').val());
	var final_paid_amt=parseFloat($('#finalbill-paid_amount').val());
	$('#invest_txt').val(parseFloat(total-data_price).toFixed(2));
	$('#invest_net_amt').val(parseFloat(total-data_price).toFixed(2));
	var finalbill_netamount=parseFloat($('#service_net_amt').val())+parseFloat($('#pharmacy_net_amt').val())+parseFloat($('#inv_net_amt').val())+parseFloat($('#drvisit_net_amt').val())+parseFloat($('#room_net_amt').val());
	$('#finalbill-net_amount').val(parseFloat(finalbill_netamount).toFixed(2));
	PaidAmountCalculation(final_paid_amt,event);
	$('#lap_del'+data_addid).remove();
 });
 
 $("body").on('click', '.delrowtreatment', function (){
	var data_addid = $(this).attr('data_delete_row')
	var data_price = $(this).attr('data_price')
	var total=parseFloat($('#pharmacy_txt').val());
	var final_paid_amt=parseFloat($('#finalbill-paid_amount').val());
	 $('#pharmacy_txt').val(parseFloat(total-data_price).toFixed(2));
	 $('#pharmacy_net_amt').val(parseFloat(total-data_price).toFixed(2));
	 
	var finalbill_netamount=parseFloat($('#service_net_amt').val())+parseFloat($('#pharmacy_net_amt').val())+parseFloat($('#inv_net_amt').val())+parseFloat($('#drvisit_net_amt').val())+parseFloat($('#room_net_amt').val());
	$('#finalbill-net_amount').val(parseFloat(finalbill_netamount).toFixed(2));
	PaidAmountCalculation(final_paid_amt,event);	
	 $('#treatment_del'+data_addid).remove();
 });
 
 $("body").on('click', '.delrowservice', function (){
	var data_addid = $(this).attr('data_delete_row')
	var data_price = $(this).attr('data_price')
	var total=parseFloat($('#service_txt').val());
	var final_paid_amt=parseFloat($('#finalbill-paid_amount').val());
	$('#service_txt').val(parseFloat(total-data_price).toFixed(2));
	$('#service_net_amt').val(parseFloat(total-data_price).toFixed(2));
	
	var finalbill_netamount=parseFloat($('#service_net_amt').val())+parseFloat($('#pharmacy_net_amt').val())+parseFloat($('#inv_net_amt').val())+parseFloat($('#drvisit_net_amt').val())+parseFloat($('#room_net_amt').val());
	$('#finalbill-net_amount').val(parseFloat(finalbill_netamount).toFixed(2));
	PaidAmountCalculation(final_paid_amt,event);
	$('#service_del'+data_addid).remove();
 });

 $(document).ready(function() 
  {
  	$('.stock_no').hide();
 	$('#medicines').keyup(function(e)
   	{ 
	 	 var prime_id=$('#name').val();  
	 	$("#already").hide();
	 	 var keycode = (e.keyCode ? e.keyCode : e.which);
	 	 if(e.keyCode == 13 && prime_id != '')
	     { alert("testsa");
	     	$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=in-lab-payment-prime/labset&id=";?>"+prime_id,
	        success: function (result) 
	        { 
	        	if(result != '')
	        	{
	        		var verify=true;
					$(".calculation").each(function() 
					{
					  	var data_id=$(this).attr('dataid');
					  	if(data_id == prime_id)
					  	{  
					  		//Alertment('Data Already Exist');
					  		$("#already").show();
					  		verify = false;
					  		return false;
					  	}else{
					  		$("#already").hide();
					  	}
					});					
					
					if(verify == true)
					{
						$('#fetch_update_data').append(result);

						var discount_per=$('#total_discountvaluetype').val();
						//alert(discount_per);
						if(discount_per!=''){
							//alert('test');
							DiscountPercentProcedure(discount_per,window.event);	
						}
						var i=0;
						var price=0;
						var gst_amt=0;
						var net=0;
						$(".calculation").each(function() 
						{
							var data_addid=$(this).attr('dataid');
						  	var data1=data_addid.split("_")[0];
        					var data2=data_addid.split("_")[1];
        					
        					if(data1 == 'LabTesting')
        					{
        						//Price Amount
        						if(isNaN(parseFloat($('#price_test_lab'+data2).val())))
   								{
        							price=price+0;
        						}
        						else
        						{
        							price=price+parseFloat($('#price_test_lab'+data2).val());
        							
        						}
        						//CGST
        						if(isNaN(parseFloat($('#cgst_amt_lab'+data2).val())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#cgst_amt_lab'+data2).val());	
        						}
        						//SGST
        						if(isNaN(parseFloat($('#sgst_amt_lab'+data2).val())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#sgst_amt_lab'+data2).val());	
        						}
        						
        						
        						//Net Amount
        						if(isNaN(parseFloat($('#net_lab'+data2).val())))
        						{
        							net=net+0;	
        						}
        						else
        						{
        							net=net+parseFloat($('#net_lab'+data2).val());	
        						}
        					}
        					else if(data1 == 'TestGroup')
        					{
        						//Price Amount
        						if(isNaN(parseFloat($('#price_test_group'+data2).val())))
   								{
        							price=price+0;
        						}
        						else
        						{
        							price=price+parseFloat($('#price_test_group'+data2).val());
        						}
        						
								//CGST
        						if(isNaN(parseFloat($('#cgst_amt_test'+data2).val())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#cgst_amt_test'+data2).val());	
        						}
        						//SGST
        						if(isNaN(parseFloat($('#sgst_amt_test'+data2).val())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#sgst_amt_test'+data2).val());	
        						}
        						
        						
        						
        						//Net Amount
        						if(isNaN(parseFloat($('#net_test_group'+data2).val())))
        						{
        							net=net+0;	
        						}
        						else
        						{
        							net=net+parseFloat($('#net_test_group'+data2).val());	
        						}
        					}
        					else if(data1 == 'MasterGroup')
        					{
        						//Price Amount
        						if(isNaN(parseFloat($('#price_master_group'+data2).val())))
   								{
        							price=price+0;
        						}
        						else
        						{
        							price=price+parseFloat($('#price_master_group'+data2).val());
        						}
        						
								//CGST
        						if(isNaN(parseFloat($('#cgst_amt_master'+data2).val())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#cgst_amt_master'+data2).val());	
        						}
        						//SGST
        						if(isNaN(parseFloat($('#sgst_amt_master'+data2).val())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#sgst_amt_master'+data2).val());	
        						}
        						
        						
        						
        						//Net Amount
        						if(isNaN(parseFloat($('#net_master_group'+data2).val())))
        						{
        							net=net+0;	
        						}
        						else
        						{
        							net=net+parseFloat($('#net_master_group'+data2).val());	
        						}
        					}
        					i++;
						});
						
						$('#no_of_items').val(i);
						$('#total_gst_amount').val(gst_amt);
						$('#total_gst_amount1').val(gst_amt);
						$('#total_sub_total').val(price);
						$('#bill_total').val(price+gst_amt);
						$('#total_net_amount').val(net);
						$('#total_net_amount1').val(net);
						$('#total_paid_amount').val(net);
						$('#total_due_amount').val();
					
						
						$('#no_of_items_qty').val(i);
						$('#total_sub_total1').val(price);
						
						$('#name').val('');
						$('.stock_no').hide();
						$('#medicines').val('');
						$('#medicines').focus();
						$( "#fetch_update_data" ).scrollTop(200);
						
					}
	        	}
	         }
	    	});
	     }
	     else if(e.keyCode == 27)
		 {
			$(this).val('');
			$('#name').val('');
			$('.stock_no').hide();
		 }
    });
    
    
    $("body").on('keypress', '.number', function (e) 
	{
	//if the letter is not digit then display error and don't type anything
	if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
	{
		return false;
	}
	}); 
    
    $("body").on('click', '.remove', function () 
	{

		var tbl_len2=$('#fetch_update_data tr').length;
		if(tbl_len2==1){
			$('#total_discountamount').val(0);

			
		}
  		var data_addid = $(this).attr('dataid')
  		var data1=data_addid.split("_")[0];
        var data2=data_addid.split("_")[1];
        var item_less=1;
       
       
        var total_items=parseInt($('#no_of_items').val());
		var total_gst=parseFloat($('#total_gst_amount').val());
		var total_sub_total=parseFloat($('#total_sub_total').val());
		var total_net_amount=parseFloat($('#total_net_amount').val());
		var total_paid_amount=parseFloat($('#total_paid_amount').val());
        
        
        if(data1 == 'LabTesting')
        {
        	var price_test_lab=parseFloat($('#price_test_lab'+data2).val());
			var cgst_lab_amt=parseFloat($('#cgst_amt_lab'+data2).val());
			var sgst_lab_amt=parseFloat($('#sgst_amt_lab'+data2).val());
        	var gst_lab=cgst_lab_amt+sgst_lab_amt;
        	var net_lab=parseFloat($('#net_lab'+data2).val()); 									
        	
         }
        else if(data1 == 'TestGroup')
        {
        	var price_test_lab=parseFloat($('#price_test_group'+data2).val());
			var cgst_amt_test=parseFloat($('#cgst_amt_test'+data2).val());
        	var sgst_amt_test=parseFloat($('#sgst_amt_test'+data2).val());
        	var gst_lab=cgst_amt_test+sgst_amt_test;
        	var net_lab=parseFloat($('#net_test_group'+data2).val());
        	
        }
        else if(data1 == 'MasterGroup')
        {
        	var price_test_lab=parseFloat($('#price_master_group'+data2).val());
			var cgst_amt_test=parseFloat($('#cgst_amt_master'+data2).val());
        	var sgst_amt_test=parseFloat($('#sgst_amt_master'+data2).val());
        	var gst_lab=cgst_amt_test+sgst_amt_test;
        	var net_lab=parseFloat($('#net_master_group'+data2).val());
        	
        }
       
        $('#no_of_items').val(parseInt(total_items-item_less));
		$('#total_gst_amount').val(parseFloat(total_gst-gst_lab));
		$('#total_sub_total').val(parseFloat(total_sub_total-price_test_lab));
		$('#total_net_amount').val(parseFloat(total_net_amount-net_lab));
		$('#total_net_amount1').val(parseFloat(total_net_amount-net_lab));
		$('#total_paid_amount').val(parseFloat(total_net_amount-net_lab));
		$('#total_due_amount').val(parseFloat($('#total_net_amount').val())-parseFloat($('#total_paid_amount').val()));
		
		$('#bill_total').val(parseFloat(total_sub_total-price_test_lab)+parseFloat(total_gst-gst_lab));
		
		if(data1 == 'LabTesting')
        {
        	$('#lab_test'+data2).remove();
        }
        else if(data1 == 'TestGroup')
        {
        	$('#test_group'+data2).remove();
        }
        else if(data1 == 'MasterGroup')
        {
        	$('#master_group'+data2).remove();
        }

                        var discount_per=$('#total_discountvaluetype').val();
						if(discount_per!=''){
							DiscountPercentProcedure(discount_per,window.event);	
						}
  
});
/*
  $("body").on('click', '.remove', function () 
	{
  		var data_addid = $(this).attr('dataid')
  		var data1=data_addid.split("_")[0];
        var data2=data_addid.split("_")[1];
        var item_less=1;
        alert(data1);
        alert(data2);
        alert(item_less); 
        var total_items=parseInt($('#no_of_items').val());
		var total_gst=parseFloat($('#total_gst_amount').val());
		var total_sub_total=parseFloat($('#total_sub_total').val());
		var total_net_amount=parseFloat($('#total_net_amount').val());
        
        if(data1 == 'LabTesting')
        {
        	var price_test_lab=parseFloat($('#price_test_lab'+data2).html());
        	var cgst_lab_amt=parseFloat($('#cgst_amt_lab'+data2).html());
        	var sgst_lab_amt=parseFloat($('#sgst_amt_lab'+data2).html());
        	var gst_lab=cgst_lab_amt+sgst_lab_amt;
        	var net_lab=parseFloat($('#net_lab'+data2).html());
        	
        }
        else if(data1 == 'TestGroup')
        {
        	var price_test_lab=parseFloat($('#price_test_group'+data2).html());
        	
        	var cgst_amt_test=parseFloat($('#cgst_amt_test'+data2).html());
        	var sgst_amt_test=parseFloat($('#sgst_amt_test'+data2).html());
        	var gst_lab=cgst_amt_test+sgst_amt_test;
        	var net_lab=parseFloat($('#net_test_group'+data2).html());
        }
        
        $('#no_of_items').val(parseInt(total_items-item_less));
		$('#total_gst_amount').val(parseFloat(total_gst-gst_lab));
		$('#total_sub_total').val(parseFloat(total_sub_total-price_test_lab));
		$('#total_net_amount').val(parseFloat(total_net_amount-net_lab));
		$('#total_net_amount1').val(parseFloat(total_net_amount-net_lab));
		$('#total_paid_amount').val(parseFloat(total_net_amount-net_lab));
		if(data1 == 'LabTesting')
        {
        	$('#lab_test'+data2).remove();
        }
        else if(data1 == 'TestGroup')
        {
        	$('#test_group'+data2).remove();
        }
  
});
  */

	$("body").on('click', '.remove_all', function ()
    {
    	$("#fetch_update_data tr").remove();
    	window.location.reload(true);
    });
    
    
   
	$(window).keydown(function(event)
	{
	    if(event.keyCode == 13) 
	    {
	      event.preventDefault();
	      return false;
	    }
    });
	
	

	
	$('.numberfloat').keypress(function(event) 
	{
  		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) 
  		{
    			event.preventDefault();
 	    }
	});
});	

 
 var availableTags = <?= $merge_lab_json; ?>;

    $(".typehead").typeahead({
     
        minLength: 1,
        delay: 5,
  		source: availableTags,
  		autoSelect: true,
 		displayText: function(item)
 		{ 
 		   row=item.value1;
 			//console.log(row[0]);
    		if(row[0]=="L"){
    			var text ="<span class='first_gr'> T </span><span >"+item.value+"</span><span >"+item.value2+"</span>";
    		}if(row[0]=="T"){
    			var text ="<span class='first_gr'> G </span><span >"+item.value+"</span><span >"+item.value2+"</span>";
    		}if(row[0]=="M"){
    			var text ="<span class='first_gr'> MG </span><span >"+item.value+"</span><span >"+item.value2+"</span>";
    		}
    		//alert($(text).text());
    		
    		 return (text) ; 
 		},
 		updater:function(adg){
 			
 			return adg;
 		},
 		afterSelect: function(item) 
  		{
  			$(".typehead").val(item.value);
  			$("#name").val(item.value1);
  		} 
	});
	  
	
</script>

 <script type="text/javascript">
  $(document).ready(function(){
    
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");         
      $("ul.list-unstyled").css("display","none");
        
        
        /***  Ip Number Data table Grid ***/
$("body").on('click', '.patient_fetch_details', function ()
    {
    	$modal = $('#ippatient_details');
		$modal.modal('show');  
	});
	
	jtable_pd();
  });
  
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
		  	 $('#reg_table_filter input').focus();
        }
    }); 
    
$('#reg_table').on( 'click', 'tr', function () {
    var data = table_reg.row(this).id(); 
 	PatientDetailsFetch(data);
 	
});

$('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){  
        var data = table_reg.row(cell.index().row).id(); 
   		PatientDetailsFetch(data);
 	}
});    
    
}
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
function PatientDetailsFetch(data)
{   $("#tbUser tbody tr").remove(); //cleartxt();
	$.ajax({
        type: "POST",
      url:'<?php echo Yii::$app->homeUrl . "?r=finalbill/ajaxipnumber&id=";?>'+data,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{
	  				$('#load1').hide();
	  
	  				$('#finalbill-doa').val(formatDate(data['user']['created_date']));
	  				$('#finalbill-dod').val(formatDate(data['user']['updated_date']));
	  				
	  				$('#finalbill-ipno').val(data['user']['ip_no']);
	  			 	$('#finalbill-mrno').val(data['user']['mr_no']);
	  			 	$('#finalbill-name').val(data['user']['patient_name']);
	  			 	$('#finalbill-age').val(formatDate(data['user']['dob']));
	  			 	$('#finalbill-gender').val(data['user']['sex']);
	  			 	$('#finalbill-address').val(data['user']['address']);
	  			 	$('#finalbill-pat_typ').val(data['user']['paytype']);
	  			 	$('#finalbill-bed_no').val(data['user']['bed_no']);
	  			 	$('#finalbill-cons_dr').val(data['user']['consultant_dr']);
	  			 	
					$('#finalbill-paytype').val(0);
					$('#finalbill-insurance').val(0);
					$('#finalbill-general').val(0);
	
	  			 	$('#roomrent_txt').val(data['room_total']);
	  			 	$('#dr_visit_txt').val(0);
	  			 	
	  			 	if(data['labpaymentprime']==""){
	  			 		$('#invest_txt').val(0);	
	  			 	}else{
	  			 		$('#invest_txt').val(data['labpaymentprime']['overall_net_amt']);
	  			 	}
	  			 	
	  			 	if(data['labpaymentprime']==""){
	  			 		$('#pharmacy_txt').val(0);
	  			 	}else{
	  			 		$('#pharmacy_txt').val(data['treatment']['overall_net_amount']);
	  			 	}
	  			 	
	  			 	$('#service_txt').val(data['service_amt'][0]['amount']);
	  			 	$('#optpackage_txt').val(0);
	  			 	$('#sal_ret_txt').val(0);
	  			 	$('#total_advance').val(data['money_total']);
	  			 	$('#finalbill-paid_amount').val(data['money_total']);
	 				var paidamt=parseFloat($('#finalbill-paid_amount').val());
					var netamt=parseFloat($('#finalbill-net_amount').val()).toFixed(2);
					var balamt=parseFloat($('#finalbill-balance_amount').val()).toFixed(2);
					$('#finalbill-balance_amount').val(netamt-paidamt);
						if(isNaN(balamt)){
							$('#finalbill-balance_amount').val(0)
						} 			 	
	  			 	
	  			 	
	  			 	$('#room_total_value').val(data['room_total']);
	  			 	$('#drvisit_total_value').val(0);
	  			 	$('#inv_total_value').val(data['labpaymentprime']['overall_sub_total']);
	  			 	$('#pharmacy_total_value').val(data['treatment']['overall_sub_total']);
	  			 	$('#service_total_value').val(data['service_amt'][0]['amount']);
	  			 	
	  			 	var final_total_amt=parseFloat($('#service_total_value').val())+parseFloat($('#pharmacy_total_value').val())+parseFloat($('#inv_total_value').val())+parseFloat($('#drvisit_total_value').val())+parseFloat($('#room_total_value').val());
	  			 	$('#finalbill-total_amt').val(parseFloat(final_total_amt).toFixed(2));
	  			 	
	  			 	$('#room_net_amt').val(data['room_total']);
	  			 	$('#drvisit_net_amt').val(0);
	  			 	$('#inv_net_amt').val(data['labpaymentprime']['overall_net_amt']);
	  			 	$('#pharmacy_net_amt').val(data['treatment']['overall_net_amount']);
	  			 	$('#service_net_amt').val(data['service_amt'][0]['amount']);
	  			 	var finalbill_netamount=parseFloat($('#service_net_amt').val())+parseFloat($('#pharmacy_net_amt').val())+parseFloat($('#inv_net_amt').val())+parseFloat($('#drvisit_net_amt').val())+parseFloat($('#room_net_amt').val());
	  			 	$('#finalbill-net_amount').val(parseFloat(finalbill_netamount).toFixed(2));
	  			 	
	  			 	$('#fetch_update_lab').html(data['tbl_lap'])
	  			 	$('#fetch_update_room').html(data['room'])
	  			 	$('#fetch_update_treatment').html(data['tbl_treatent'])
	  			 	$('#fetch_update_service').html(data['service_tbl'])
	  			 	$('#fetch_update_moneyreceipts').html(data['money_re'])
	  			 	
	  			 	
	  			 	 
        	$modal = $('#ippatient_details');
        	$modal.modal('hide');
        }
	});
}
 



/*** ***/  
</script>

	
