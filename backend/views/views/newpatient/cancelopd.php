<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
   use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */


?>

<link href="<?php echo Url::base(); ?>/validation_plugin/site-demos.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo Url::base(); ?>/validation_plugin/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/validation_plugin/additional-methods.min.js"></script>

<style>
.heading {
    padding: 5px 5px;
    background: #dcea5f;
    font-size: 14px;
    font-family: -webkit-pictograph;
    font-weight: bold;
    color: #000;
    
}

label.control-label {
    font-family: -webkit-pictograph;
}

form#w0 select, form#w0 input {
    height: 30px;
    width: 90%;
    padding: 0 8px;
}

.row.body-content {
    margin: 20px 0;
}


.inpatient-details i.glyphicon.glyphicon-search {
    top: 7px;
}

.fwidth .ipt.input-group-btn.fetch_record {
    left: -18px;
}
.body-content.body-style input, .body-content select {
    border-top: none;
    border-left: none;
    border-right: none;
    background: #fff !important;
    width: 45% !important;
    border-radius: 0;
}
.body-content.body-style label.control-label {
    float: left;
    width: 35%;
    text-align: right;
    margin-right: 15px;
}
.body-content.body-sty1 select, .body-content.body-sty1 input {
    width: 100% !important;
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
 <li><a href="#"><?php echo 'CancelOPD';?></a></li>
</ol>
</div>
</div>
		
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body" style="height:1000px;">
    <?php $form = ActiveForm::begin(); ?>
    
    
    <!--div class='heading'>COMMON SEARCH</div-->
    
    
    
    
    <div class='heading'>CANCELLATION TYPE</div>
    
    <div class="row body-content body-sty1">
	<div class="col-md-12">				
		<div class="col-md-2">		
			<?= $form->field($cancellog, 'cancel_trans_type')->dropDownList(['S' => 'Sub-Visit'], ['class' => '  form-control'])->label('Cancel Trans Type') ?>
		</div>
		<div class="col-md-2">		
			<?= $form->field($cancellog, 'cancel_type')->dropDownList(['T' => 'Total Fees'], ['title'=>'Cancel Type','class' => 'form-control'])->label('Cancel Type') ?>
		</div>	
		<div class="col-md-2">		
			<?= $form->field($subvisit, 'sub_visit')->textInput(['class' => '  form-control number','name'=>'subVisit_sub_visit','onkeyup'=>'SubVisit(event,this);'])->label('Sub Visit No') ?>
		</div>
		<div class="col-md-2">		
			<?= $form->field($subvisit, 'mr_number')->textInput(['class' => 'form-control number','readOnly'=>true,'name'=>'subVisit_mr_number'])->label('MR Number') ?>
		</div>
		<div class="col-md-2" style="top: 25px">		
		
			<button type="button" style="float: left;background: #800080 !important;   margin-right: 10px;" class="btn  btn-sm" id="patient_history_detils" onclick="Patient_modal()"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> </button>
		 	<!--a onclick="Patient_reload()" dataid="" class="btn btn-default btn-sm" id="history_detils">Set</a-->	
		 </div>						
	</div>
	</div>
    
    
    <!--div class="row body-content">
		<div class="col-sm-4">
			  <div class="form-group col-sm-8  ">
					<div class="input-group add-on fwidth">
		           		<input class="form-control mrn inrefrsh" placeholder="MRN Search" name="mr_number" onkeyup="Patient_details(event,this)" id="mrnumber" type="text" tabindex="8">
						
						<div class="ipt input-group-btn fetch_record" value="click" onmousedown="Patient_details(event,this)">
							<span class="btn btn-default inpatient-details"><i class="glyphicon glyphicon-search"></i></span>
						</div>
						
					</div>
						<span id="mr_validated" style="color:red" hidden="">Invalid MR Number</span>
					 	<span class="in_pat_validated" style="color:red" hidden="">Enter Patient Record</span>
	        </div>
		
			<div class="form-group col-sm-4" style="position: relative; z-index: 1;width: 116px !important;">
			    <button type="button" style="float: left;background: #800080 !important;   margin-right: 10px;" class="btn  btn-sm" id="patient_history_detils" onclick="Patient_modal()"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> </button>
			    <a onclick="Patient_reload()" dataid="" class="btn btn-default btn-sm" id="history_detils">Set</a>
			</div>
		</div>
						
		
						
						
						
	</div-->
    
    
    <!--table class="table table-bordered">
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
        <td style="color: #1b00ff;font-weight: bold;">100015</td>
        <td style="color: #1b00ff;font-weight: bold;">Master Dolu</td>
        <td>06-08-1995</td>
        <td>23</td>
        <td>Mother</td>
        <td>bolu</td>
        <td>YES</td>
        <td>Male</td>
        <td>nam</td>
        <td>9788440809</td>
       	<td><button type="button" class="btn btn-success btn-xs" onclick="View()">View</button></td>
      </tr>
    </tbody>
  </table-->
    					
	<div class="row">
		<div class="col-md-6">
			<div class='heading'>PATIENT DETAILS</div>
			<div class="row body-content body-style">
	<div class="col-md-12">
		<div class="col-md-12">		
			<?= $form->field($newpatient, 'patientname')->textInput(['class' => 'form-control','readOnly'=>true,'name'=>'newpatient_patientname'])->label('Patient Name') ?>
		</div>
		<div class="col-md-12">		
			<?= $form->field($newpatient, 'pat_age')->textInput(['class' => 'form-control','readOnly'=>true,'name'=>'newpatient_pat_age'])->label('Age') ?>
		</div>	
		<div class="col-md-12">		
			<?= $form->field($newpatient, 'pat_sex')->dropDownList(['Male' => 'Male','Female' => 'Female'], ['class' => 'form-control','name'=>'newpatient_pat_sex','readOnly'=>true])->label('Gender') ?>
		</div>
		
		<div class="col-md-12">		
			<?= $form->field($subvisit, 'consultant_doctor')->dropDownList($physicianmaster, ['prompt'=>'--SELECT--','class' => 'form-control','readOnly'=>true,'name'=>'subVisit_consultant_doctor'])->label('Doctor Name') ?>
		</div>				
		<div class="col-md-12">		
			<?= $form->field($cancellog, 'opd_type')->dropDownList(['O' => 'Private OPD'], ['class' => '  form-control','name'=>'cancelLogTable_opd_type'])->label('OPD Type') ?>
		</div>
		<div class="col-md-12">		
			<?= $form->field($cancellog, 'towards')->textInput(['class' => 'form-control','value'=> 'Towards OP Visit Refund','readOnly'=>true])->label('Towards') ?>
		</div>	
		<div class="col-md-12">		
			<?= $form->field($cancellog, 'refund_type')->dropDownList(['C' => 'Cancelled'], ['class' => 'form-control','readOnly'=>true])->label('Refund Type') ?>
		</div>
		<div class="col-sm-12">		
			<?= $form->field($subvisit, 'pay_mode')->dropDownList($paymenttype, ['class' => 'form-control','readOnly'=>true])->label('Payment Mode') ?>
		</div>							
	</div>
	</div>
		</div>
		<div class="col-md-6">
			<div class='heading'>FINANCIAL DETAILS</div>
	<div class="row body-content body-style">
	<div class="col-md-12">				
		
		<div class="col-sm-12">		
			<?= $form->field($subvisit, 'net_amt')->textInput(['class' => 'form-control number','name'=>'subVisit_net_amt','readOnly'=>true])->label('Consultant Amount') ?>
		</div>	
		<div class="col-sm-12">		
			<?= $form->field($cancellog, 'cancel_amt')->textInput(['class' => 'form-control number','onkeyup'=>'AmtInWords(this.value);','name'=>'cancelLogTable_cancel_amt'])->label('Cancel Amount') ?>
		</div>
		<div class="col-sm-12">		
			<?= $form->field($cancellog, 'amt_words')->textInput(['class' => 'form-control','readOnly'=>true,'name'=>'cancelLogTable_amt_words'])->label('Amount In Words') ?>
		</div>	
		<div class="col-sm-12">		
			<?= $form->field($cancellog, 'paid')->textInput(['class' => 'form-control number','onkeyup'=>'PaidAmount(this.value);','name'=>'cancelLogTable_paid'])->label('Paid') ?>
		</div>
		<div class="col-sm-12">		
			<?= $form->field($cancellog, 'reason_cancelled')->textArea(['class' => 'form-control','name'=>'cancelLogTable_reason_cancelled'])->label('Reason For Cancellation') ?>
		</div>							
	</div>
	</div>	
		</div>
	</div>
	
	 <?= Html::submitButton('Save', ['class' => 'summited btn btn-success']) ?>
	
						
    						
    						
    							
    						
    						
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
      	
      	<input onkeyup="Patient_List_Show(this)" type="text" style='width: 60% !important;margin: auto;margin-bottom: 30px;' name="patient_field_record" id='patient_common_search' class="form-control" placeholder="Enter MR Number,Patient Name,Ph.No">
      	
        <div class="" id="patient_history_report">
            	<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th>Sub-Visit Number</th>
				    <th>Patient Name</th>
				    <th>Mobile Number</th>
				    <th>Consultant Doctor</th>
				    <th>Date of Visit</th>
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
</div>
</div>
</div>
 
 <script>
 
 //Side Menu Toggle  
	$("body").addClass("fixed-left-void");
	$("body").removeClass("fixed-left");
	$("#wrapper").addClass("enlarged");
    $("#wrapper").addClass("forced");   			
    $(".list-unstyled").css("display","none");
    
    $('#subvisit-sub_visit').focus();
 

	 
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
        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/cancelkey&id=";?>"+e.value,
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
        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/cancelpatientvalueset&id=";?>"+sub_id,
        success: function (result) 
        { 
        	var obj = JSON.parse(result);
        	
        	//SET VALUE IN TABLE
        	$('#subvisit-sub_visit').val(obj[0][0]['sub_visit']);
        	$('#subvisit-mr_number').val(obj[0][0]['mr_number']);
        	$('#newpatient-patientname').val(obj[0][0]['patientname']);
        	$('#newpatient-pat_age').val(obj[1]);
        	$('#newpatient-pat_sex').val(obj[0][0]['pat_sex']);
        	$('#subvisit-consultant_doctor').val(obj[0][0]['consultant_doctor']);
        	
        	
        	$('#subvisit-pay_mode').val(obj[0][0]['pay_mode']);
        	$('#subvisit-net_amt').val(obj[0][0]['paid_amt']);
        	$('#cancellogtable-cancel_trans_type').val('S');
        	$modal = $('#patient_hist-modal');
			$modal.modal('hide');
        }
    	});
 	 }
 }
 
 function AmtInWords(datas)
 {
 	if(datas != '')
 	{
 		var consultant_amount=parseFloat($('#subvisit-net_amt').val());
 		
 		var cancellogtable_cancel_amt=parseInt(datas);
 		if(consultant_amount != '' && cancellogtable_cancel_amt <= consultant_amount)
 		{
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/amtinwords&number=";?>"+datas,
	        success: function (result) 
	        { 
	        	
	        	$('#cancellogtable-amt_words').val(result);
	        }
	    	});
 		}
 		else if(consultant_amount == '' || isNaN(consultant_amount))
 		{
 			alert('Need Consultant Amount');
 			$('#cancellogtable-cancel_amt').val('');
 			$('#cancellogtable-amt_words').val('');
 		}
 		else if(cancellogtable_cancel_amt >= consultant_amount)
 		{
 			alert('Consultant Amount Greater Cancel Amount');
 			$('#cancellogtable-cancel_amt').val('');
 			$('#cancellogtable-amt_words').val('');
 		}
 	}
 	else if(datas == '')
 	{
 		$('#cancellogtable-amt_words').val('');
 	}
 }
 
 function PaidAmount(datas)
 {
 	if(datas != '')
 	{
 		var cancel_amount=parseInt($('#cancellogtable-cancel_amt').val());
 		var datas=parseInt(datas);
 		if(cancel_amount >= datas)
 		{
 			return false;
 		}
 		else
 		{
 			alert('Invalid Entry');
 			$('#cancellogtable-paid').val('');
 			return false;
 		}
 	}
 }
 
 function PaidAmountBlur(datas)
 {
 	var cancel_amount=parseInt($('#cancellogtable-cancel_amt').val());
 	var datas_amt=parseInt(datas);
 	if(cancel_amount != datas_amt)
 	{
 		alert('Cancel Amount Not Equal');
 		$('#cancellogtable-paid').val('');
 		
 		return false;
 	}
 	return false;
 }
 
 
 function SubVisit(event,e)
 {		
 	if(event.keyCode == 13 && e.value != '')
	{
 		if(e.value != '')
 		{
 			var subvisit=e.value;
 			
 			$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/cancelsubvisit&subvisit=";?>"+subvisit,
	        success: function (result) 
	        { 
	        	var obj = JSON.parse(result);
        		if(obj == 'F')
        		{
        			alert('Invalid Sub-Visit');
        		}
        		else
        		{
        			//SET VALUE IN TABLE
		        	$('#subvisit-sub_visit').val(obj[0][0]['sub_visit']);
		        	$('#subvisit-mr_number').val(obj[0][0]['mr_number']);
		        	$('#newpatient-patientname').val(obj[0][0]['patientname']);
		        	$('#newpatient-pat_age').val(obj[1]);
		        	$('#newpatient-pat_sex').val(obj[0][0]['pat_sex']);
		        	$('#subvisit-consultant_doctor').val(obj[0][0]['consultant_doctor']);
		        	
		        	
		        	$('#subvisit-pay_mode').val(obj[0][0]['pay_mode']);
		        	$('#subvisit-net_amt').val(obj[0][0]['paid_amt']);
		        	$('#cancellogtable-cancel_trans_type').val('S');	
        		}
	        }
	    	});
 		}
 	}
 }
 

$(document).ready(function()
{ 
	$("body").on('keypress', '.number', function (e) 
	{
		//if the letter is not digit then display error and don't type anything
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});
		    
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	$("#w0").validate({	
	   rules: {
	    newpatient_patientname: {
	    required: true, 	
	    },
	   
	    newpatient_pat_age: {
	    required: true, 	
	    },
	   
	    newpatient_pat_age: {
	    required: true, 	
	    },
	    
	    newpatient_pat_sex: {
	    required: true, 	
	    },
	    
	    subVisit_consultant_doctor: {
	    required: true, 	
	    },
	    
	    cancelLogTable_opd_type: {
	    required: true, 	
	    },
	    
	    subVisit_net_amt: {
	    required: true, 	
	    },
	    
	    cancelLogTable_cancel_amt: {
	    required: true, 	
	    },
	    
	    cancelLogTable_amt_words: {
	    required: true, 	
	    },
	    
	    cancelLogTable_paid: {
	    required: true, 	
	    },
	    
	    cancelLogTable_reason_cancelled: {
	    required: true, 	
	    },
	    
	    subVisit_sub_visit:{
	    required: true, 	
	    },
	    subVisit_mr_number:{
	    required: true, 	
	    },
	    
	   },
	   submitHandler: function(form) {
	        // do some stuff here
	       form.submit();
	    }
	   
	});
	

	    
});


 </script>
	