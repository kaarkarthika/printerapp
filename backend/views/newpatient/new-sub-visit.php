<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */




	if($subvisit->ucil_letter_status == 'NO')
	{
		echo ("<script LANGUAGE='JavaScript'>
		    window.alert('You Did Not Give Refferal Letter in Previous Visit');
		    </script>");
	}
	else if($subvisit->ucil_letter_status == 'YES')
	{
		if($subvisit->ucil_date != '')
		{
			$issue_date=date_create(date('Y-m-d',strtotime($subvisit->ucil_date)));
   			date_add($issue_date,date_interval_create_from_date_string("10 days"));
			$issue_date=date_format($issue_date,"Y-m-d");
			if($issue_date < date('Y-m-d'))
			{
				echo ("<script LANGUAGE='JavaScript'>
		    		window.alert('Your Refferal Letter Will Be Expired');
		    		</script>");
			}
			else 
			{
				echo ("<script LANGUAGE='JavaScript'>
		    		window.alert('Your Refferal Letter Will Be Expired in ".date('d-m-Y',strtotime($issue_date))."');
		    		</script>");
			}
		}
	}




//Free UP TO
$free_up_to=date_create(date('Y-m-d',strtotime($subvisit->created_at)));

date_add($free_up_to,date_interval_create_from_date_string("7 days"));
$free_up_to=date_format($free_up_to,"Y-m-d");
if($free_up_to < date('Y-m-d'))
{
	$subvisit->is_freevisit='NO';
	$subvisit->free_upto=date('d-m-Y',strtotime($free_up_to));
	
}
else {
	$subvisit->is_freevisit='YES';
	$subvisit->free_upto=date('d-m-Y',strtotime($free_up_to));
}







//CONSULTANT TIME

$today_date=date('Y-m-d H:i:s');
if(date('A',strtotime($today_date)) == 'AM') 
{
	$subvisit->consultant_time='Morning';
}
else if(date('A',strtotime($today_date)) == 'PM') 
{
	$subvisit->consultant_time='Evening';
} 


$subvisit->ucil_letter_status='';
$subvisit->ucil_date = '';


?>
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
  .form-group {
    margin-bottom: 0px;
}
</style>

<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>
<div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />
<div class="newpatient-form">
  <div class="container">
    
    <!-- <div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo 'Sub-Visit';?></a></li>
</ol>
</div>
</div>  -->





    <?php $form = ActiveForm::begin(); ?>
	 <div class="row">
	   <!--Patient Details Begins-->
       <div class="col-sm-9">
         <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Patient Details</strong></h5></div>
	       <div class="no-pd panel-body">
	         <div class="row">
		        <div class="col-sm-3 ">
                   <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Sub Visit No') ?>
                   <div class="input-group input-group-sm">	
                   <?= $form->field($model, 'mr_no')->textInput(['class' => 'form-control w-cus number','onkeyup'=>'FormClear(this.value);','required'=>true])->label('MR No') ?>
                    <span class="input-group-btn">
					   <button type="button" style="top: 13px;" class="inp btn btn-default btn-flat btn  patient_fetch_details "><i class="ssearch glyphicon glyphicon-search"></i></button>
				    </span>
				    </div>
				 			
                   <?= $form->field($model, 'pat_inital_name')->dropDownList(['Mr'=>'Mr','Miss'=>'Miss','Baby'=>'Baby','Mrs'=>'Mrs','Master'=>'Master','Baby Of'=>'Baby Of','Empty'=>'Empty','Dr'=>'Dr','Ms.'=>'Ms.'],['class' => 'form-control w-cus','readonly'=>true])->label('Name Initial') ?>
                   <?= $form->field($model, 'patientname')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Name') ?>
                   <?= $form->field($model, 'pat_age')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Age') ?>				   
		        </div>
				<div class="col-sm-3">
				  <?= $form->field($model, 'pat_sex')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Sex') ?>
				  <?= $form->field($model, 'pat_relation')->dropDownList(['W/O'=>'W/O','S/O'=>'S/O','Partner'=>'Partner','D/O'=>'D/O','H/O'=>'H/O'],['class' => 'form-control w-cus','readonly'=>true])->label('Relative') ?>
				  <?= $form->field($model, 'par_relationname')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Relative Name') ?>
				  <?= $form->field($model, 'pat_address')->textArea(['class' => 'form-control w-cus','readonly'=>true])->label('Address') ?>
				</div>
				<div class="col-sm-3">
				  <?= $form->field($model, 'pat_pincode')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Pincode') ?>
				  <?= $form->field($model, 'pat_mobileno')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Mobile') ?>
				  <?= $form->field($subvisit, 'patient_type')->dropDownList($patienttype,['class' => 'form-control w-cus','required'=>true,'onchange'=>'PatientTypeValidation(this.value);','required'=>true])->label('Patient Type') ?>
                 <div class="ucil_validation">
                 <?php if($subvisit->patient_type == 3 && $model->insurance_type_id == 'UCIL') {?>
                 	<?= $form->field($model, 'insurance_type_id')->textInput(['class' => ' form-control w-cus','onkeyup'=>'InsuranceFetchdata(this.value);'])->label('Insurance'); ?>
				  <?php } else {?>
				  	<?= $form->field($model, 'insurance_type_id')->textInput(['class' => ' form-control w-cus','onkeyup'=>'InsuranceFetchdata(this.value);','disabled'=>true])->label('Insurance'); ?>
				  <?php } ?>
				  </div>
				</div>
				<div class="col-sm-3 ucil_validation">
				<?php if($subvisit->patient_type == 3 && $model->insurance_type_id == 'UCIL') { ?>	
				  	
				  	<?= $form->field($subvisit, 'ucil_letter_status')->dropdownlist(['YES'=>'YES','NO'=>'NO'],['prompt'=>'-SELECT-','class' => ' form-control w-cus','onchange'=>'UCILLetterStatus(this.value);'])->label('UCIL LETTER STATUS') ?>
				  	
				  	<?= $form->field($subvisit, 'ucil_emp_id')->textInput(['class' => ' form-control w-cus number'])->label('UCIL EMP ID') ?>
				
					<?= $form->field($subvisit, 'patient_date')->textInput(['class' => ' form-control w-cus','readonly'=>true])->label('Patient Date') ?>
				
                  	<?= $form->field($subvisit, 'ucil_date')->textInput(['class' => 'datepicker form-control w-cus','disabled'=>true,'onblur'=>'SaveUCIL();','onmouseup'=>'SaveUCIL();'])->label('Issue Date') ?>
				
				<?php } else { 	?>
					
					<?= $form->field($subvisit, 'ucil_letter_status')->dropdownlist(['YES'=>'YES','NO'=>'NO'],['prompt'=>'-SELECT-','class' => ' form-control w-cus ','disabled'=>true,'onchange'=>'UCILLetterStatus(this.value);'])->label('UCIL LETTER STATUS') ?>
					
					<?= $form->field($subvisit, 'ucil_emp_id')->textInput(['class' => ' form-control w-cus number','disabled'=>true])->label('UCIL EMP ID') ?>
				
					<?= $form->field($subvisit, 'patient_date')->textInput(['class' => ' form-control w-cus','readonly'=>true])->label('Patient Date') ?>
				
                  	<?= $form->field($subvisit, 'ucil_date')->textInput(['class' => 'datepicker form-control w-cus','disabled'=>true,'onblur'=>'SaveUCIL();','onmouseup'=>'SaveUCIL();'])->label('Issue Date') ?>
				
				<?php } ?>	
				</div>
		     </div>
	       </div>
	     </div>
       </div>
	   <!--Patient Details Ends-->
		
	   <!--Consultant Details Begins-->
	   <div class="col-sm-3">
         <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Consultant Details</strong></h5></div>
	       <div class="no-pd panel-body">
	         <div class="row">
			    <div class="col-sm-12">
				   <?= $form->field($subvisit, 'consultant_time')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Timing') ?>
					<div class="input-group input-group-sm">	
                   <?= $form->field($subvisit, 'consultant_doctor')->textInput(['class' => 'form-control w-cus','onkeyup'=>'EmptyConsultant(this.value);','required'=>true])->label('Consultant') ?>
                    <span class="input-group-btn">
					   <button type="button" style="top: 13px;" onclick="ConsultantDoctor();" class="inp btn btn-default btn-flat btn"><i class="ssearch glyphicon glyphicon-search"></i></button>
				    </span>
				    </div>
					
					<div class="input-group input-group-sm">	
                    <?= $form->field($subvisit, 'department')->textInput(['class' => 'form-control w-cus','readonly'=>true,'required'=>true])->label('Department') ?>
                    <span class="input-group-btn">
					   <button type="button" style="top: 13px;" class="inp btn btn-default btn-flat btn    "><i class="ssearch glyphicon glyphicon-search"></i></button>
				    </span>
				    </div>
					
					<?= $form->field($model, 'con_turn')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Turn No') ?>
					
					<div class="form-group" style="visibility:hidden;">
					  <label>df</label>
					  <input type="text" class="form-control">
					</div>
				</div>
	         </div>
	       </div>
	      </div>
	   </div>
	    <!--Consultant Details Ends-->
     </div>
	 
	 
	 
	  <div class="row">
	   <!--FINANCIAL Details Begins-->
       <div class="col-sm-7">
         <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Financial Details</strong></h5></div>
	       <div class="no-pd panel-body">
	         <div class="row">
			   <div class="col-sm-3">
			       <?= $form->field($subvisit, 'total_amount')->textInput(['class' => 'form-control w-cus','readonly'=>true,'required'=>true])->label('Total Amount') ?>
				     	 <?= $form->field($subvisit, 'paid_amt')->textInput(['class' => 'number form-control w-cus','onkeyup'=>'PaidAmountCalculation(this.value);','required'=>true])->label('Paid Amount') ?>
				                             				   
			   </div>
			   <div class="col-sm-3">
			   	 <?= $form->field($subvisit, 'less_disc_percent')->textInput(['class' => 'number form-control w-cus','onkeyup'=>'DiscountPercentCalculation(this.value);'])->label('Less Disc(%)') ?> 
			        
                      <?= $form->field($subvisit, 'due_amt')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Due Amount') ?>
			   </div>
			   <div class="col-sm-3">
			       <?= $form->field($subvisit, 'less_disc_flat')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Less Disc(Amt)') ?>
                       <?= $form->field($subvisit, 'disc_by')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Discount By') ?>        
			   </div>
			   <div class="col-sm-3">
			  
			     <?= $form->field($subvisit, 'net_amt')->textInput(['class' => 'form-control w-cus','readonly'=>true,'required'=>true])->label('Net Amount') ?>
                    <?= $form->field($subvisit, 'pay_mode')->dropdownlist($paymenttype,['class' => 'form-control w-cus'])->label('Pay Mode') ?>
			   </div>
		   </div>
		   <div class="row">
				<div class="col-sm-3">
					
				     <?= $form->field($subvisit, 'remarks')->textInput(['class' => 'form-control w-cus'])->label('Remarks') ?>
				      
				</div>
				<div class="col-sm-3">
				<?= $form->field($subvisit, 'authority')->dropdownlist($authority_master,['prompt'=>'--SELECT--','class' => 'form-control w-cus','disabled'=>true])->label('Authority') ?>
				</div>	
				<div class="col-sm-3">
				<?= $form->field($subvisit, 'reason')->textInput(['class' => 'form-control w-cus','disabled'=>true])->label('Reason') ?>
				</div>	
		   </div>
		 </div>
	    </div>
	   </div>
	    <!--FINANCIAL Details Ends-->
		
		<!--OTHER DETAILS Begins-->
		<div class="col-sm-3">
		 <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Other Details</strong></h5></div>
	       <div class="no-pd panel-body">
		     <div class="row">
			    <div class="col-sm-6"> 
				   <?= $form->field($subvisit, 'free_upto')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Free UP To') ?></div>
			    <div class="col-sm-6">
				   <?= $form->field($subvisit, 'is_freevisit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Isfreevisit') ?></div>
			 </div>
	         <div class="row">
			   <div class="col-sm-12">  
                  
				  
				  <?= $form->field($subvisit, 'created_at')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Last Consulted Date') ?>
                  
				  
				  
				  <?= $form->field($subvisit, 'consultant_name')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Last Consulted Doctor') ?> 
			   </div>
		     </div>
		   </div>
		 </div>
		</div>
		<!--OTHER DETAILS Ends-->
		<div class="col-sm-2">
		 <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong> </strong></h5></div>
	       <div class="panel-body">
	         <div class="row">
			   <div class="col-sm-12"> 
				<button type='button' id='save_register_form' onclick='SaveRegisterForm();' name='SAVEFORM' value='formsubmit' class="btn btn-success b-width">Save</button>
			   </div>
			   <div class="col-sm-12 mt-5"> 
				<button type='button' class="btn btn-warning b-width" onclick='ClearField();'>Clear</button>
			   </div>
			   <div class="col-sm-12 mt-5"> 
				<button type='button' class="inp btn btn-default b-width">Close</button>
			   </div>
			 </div>
		   </div>
		  </div>
	    </div>
	  </div>
    <?php ActiveForm::end(); ?>
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
	    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	  </div>
	</div>
	
	  </div>
</div> 

<script>

function CommonRules()
{
	$('#newpatient-mr_no').focus();
}

$(document).ready(function(){
	
	CommonRules();
	//InsuranceFetch();
	jtable_pd();
	doctor_unit_consultant();
	$("body").on('keypress', '.number', function (e) 
	{
		//if the letter is not digit then display error and don't type anything
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
		 	return false;
		}
     });
     
    $('.datepicker').datepicker({
    	format: 'dd-mm-yyyy',
	});
});

$("#newpatient-mr_no").typeahead({
  
  source: function(query,result) {
	  $.ajax(
	  {
		url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/subvisitfetch";?>',
		method:'POST',
		data:{query:query},
		dataType:'json',
		success:function(data)
		{
			result($.map(data, function(item){
				return item.mr_no;
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
		var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/sub-visit-new1&mrnumber='+encodeURIComponent(result);
	    window.open(url,'_self');
		$('#load1').show(6000);
		//$('#load1').hide();
  }
});

function ClearField()
{
	var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/sub-visit-new1&mrnumber='+'';
	window.open(url,'_self');
}

function FormClear(data)
{
	if(data === '')
	{
		ClearField();
	}
}

function InsuranceFetch()
{
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
	  		$('#subvisit-ucil_emp_id').val('');
	  	}
	  	
	  	$('#load1').hide();
  }
});
}


   function jtable_pd(){
    	
    	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=in-registration/jqgrid';
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



$("body").on('click', '.patient_fetch_details', function ()
{
	$modal = $('#patient_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#reg_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});

function PatientDetailsFetch(data)
{
	
	
	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/ipfetchmrnumber&id=";?>"+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        	
        	$('#load1').show();
		var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/sub-visit-new1&mrnumber='+encodeURIComponent(obj[0]['mr_no']);
	    window.open(url,'_self');
		
		$('#load1').show(6000);
        	
        	$('#newpatient-mr_no').val(obj[0]['mr_no']);
        	$('#newpatient-pat_inital_name').val(obj[0]['pat_inital_name']);
        	$('#newpatient-patientname').val(obj[0]['patientname']);
        	$('#inregistration-dob').val(formatDate(obj[0]['dob']));
        	$('#newpatient-pat_age').val(obj[0]['age']);
        	$('#newpatient-pat_sex').val(obj[0]['pat_sex']);
        	$('#newpatient-marital_status').val(obj[0]['pat_marital_status']);
        	$('#newpatient-pat_relation').val(obj[0]['pat_relation']);
        	$('#newpatient-par_relationname').val(obj[0]['par_relationname']);
        	$('#newpatient-pat_address').val(obj[0]['pat_address']);
        	//$('#inregistration-city').val(obj[0]['pat_city']);
        	//$('#inregistration-district').val(obj[0]['pat_distict']);
        	$('#subvisit-patient_type').val(obj[0]['pat_state']);
        	$('#newpatient-pat_pincode').val(obj[0]['pat_pincode']);	
        	$('#newpatient-pat_mobileno').val(obj[0]['pat_mobileno']);
        	//$('#inregistration-religion').val(obj[0]['pat_religion']);
        	$('#subvisit-pat_type').val(obj[0]['pat_type']);
        	$('#subvisit-ucil_emp_id').val(obj[0]['ucil_emp_id']);
        	$('#subvisit-patient_date').val(formatDate(obj[0]['create_at']));
        	$('#subvisit-ucil_date').val(formatDate(obj[0]['hide_ucil_issue_date']));
        	$('#subvisit-insurance_type_id').val(obj[0]['insurance_type_id']);
        	
        	CalculateAge(obj[0]['dob']);
        	
        	$modal = $('#patient_details');
        	$modal.modal('hide');
        }
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
 

function InsuranceFetchdata(data)
{
if(data !== '')
{
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
			  		$('#subvisit-ucil_letter_status').removeAttr('disabled');
			  		//$('#subvisit-ucil_emp_id').removeAttr('disabled');
			  		//$('#subvisit-ucil_date').removeAttr('disabled');
			  	}
			  	else
			  	{
			  		$('#subvisit-ucil_letter_status').attr('disabled','disabled');
			  		$('#subvisit-ucil_emp_id').attr('disabled','disabled');
			  		$('#subvisit-ucil_date').attr('disabled','disabled');
			  		
			  		$('#subvisit-ucil_letter_status').val('');
			  		$('#subvisit-ucil_emp_id').val('');
			  		$('#subvisit-ucil_date').val('');
			  	}
			  	$('#load1').hide();
		  }
		});
}
else if(data === '')
{
	$('#subvisit-ucil_letter_status').attr('disabled','disabled');
	$('#subvisit-ucil_emp_id').attr('disabled','disabled');
	$('#subvisit-ucil_date').attr('disabled','disabled');
	
	$('#subvisit-ucil_letter_status').val('');
	$('#subvisit-ucil_emp_id').val('');
	$('#subvisit-ucil_date').val('');
}
/*
else
{
	var mrnumber='<?php echo $_GET['mrnumber']; ?>';
	var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/sub-visit-new1&mrnumber='+encodeURIComponent(mrnumber);
	window.open(url,'_self');
}*/

}


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


function EmptyConsultant(data)
{
	if(data === '')
	{
		$('#subvisit-department').val('');
		$('#subvisit-total_amount').val('');
		$('#subvisit-less_disc_flat').val('');
		$('#subvisit-less_disc_percent').val('');
		$('#subvisit-net_amt').val('');
		$('#subvisit-paid_amt').val('');
		$('#subvisit-due_amt').val('');
	}
}


function UCILvalidation()
{
	$('#newpatient-insurance_type_id').val('');
	$('#subvisit-ucil_letter_status').val('');
	$('#subvisit-ucil_emp_id').val('');
	$('#subvisit-patient_date').val('');
	$('#subvisit-ucil_date').val('');
}

function PatientTypeValidation(data)
{
	var patient_type_new =$('#subvisit-patient_type').val();

	if(patient_type_new==3){

   $('#subvisit-total_amount').val(0);

   
	}
	else{
		$('#subvisit-total_amount').val('');


	}

	if(data === '3')
	{
		//$('.ucil_validation').show();
		
		$('#newpatient-insurance_type_id').removeAttr('disabled');
		//$('#subvisit-ucil_letter_status').removeAttr('disabled');
		//$('#subvisit-ucil_emp_id').removeAttr('disabled');
		//$('#subvisit-patient_date').removeAttr('disabled');
		//$('#subvisit-ucil_date').removeAttr('disabled');
		
		UCILvalidation();
		var dt=new Date();
    	var date=dt.getDate();
    	var month=dt.getMonth()+1;
    	var year=dt.getFullYear();
    	$('#subvisit-patient_date').val(date+'-'+month+'-'+year); 
		
		
	}
	else
	{	
		//$('.ucil_validation').hide();
		
		$('#newpatient-insurance_type_id').attr('disabled','disabled');
		$('#subvisit-ucil_letter_status').attr('disabled','disabled');
		$('#subvisit-ucil_emp_id').attr('disabled','disabled');
		$('#subvisit-patient_date').attr('readonly','readonly');
		$('#subvisit-ucil_date').attr('disabled','disabled');
		
		UCILvalidation();
	}
}


$("#subvisit-consultant_doctor").typeahead({
  
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
		  			 	
		  			 	EmptyConsultant('');
		  			 	
		  			 	//UCIL AMOUNT CODE
		  			 	var insurance_type=$('#newpatient-insurance_type_id').val();
		  			 	var is_free_visit=$('#subvisit-is_freevisit').val();
		  			 	var previous_consultant_name=$('#subvisit-consultant_name').val();
		  			 	
		  			 	
		  			 	if(insurance_type !== '')
		  			 	{
		  			 		var validatedtype=InsuranceMasterValidation(insurance_type);
		  			 		if(validatedtype === 'OK')
		  			 		{
		  			 			if(insurance_type === 'UCIL')
				  			 	{
				  			 		if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === result)
		  			 					{
		  			 						if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
								  			$('#subvisit-net_amt').val(0);
								  			$('#subvisit-paid_amt').val(0);
							  			 	$('#subvisit-due_amt').val('');
		  			 					}
					  			 		else
					  			 		{
					  			 			if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['ucil_amount']);
							  				$('#subvisit-net_amt').val(data[1]['ucil_amount']);
							  				$('#subvisit-paid_amt').val(0);
						  			 		$('#subvisit-due_amt').val(data[1]['ucil_amount']);
					  			 		}
						  			 }
						  			 else if(is_free_visit === 'NO')
						  			 {
						  			 	if(data[1]['specialist'] !== '')
						  			 	{
						  			 		$('#subvisit-department').val(data[1]['specialist']);
						  			 	}
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['ucil_amount']);
							  			$('#subvisit-net_amt').val(data[1]['ucil_amount']);
							  			$('#subvisit-paid_amt').val(0);
						  			 	$('#subvisit-due_amt').val(data[1]['ucil_amount']);
						  			 }
					  			 	
				  			 	}
				  			 	else if(insurance_type === 'Aarogyasri')
				  			 	{
				  			 		if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === result)
		  			 					{
		  			 						if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
								  			$('#subvisit-net_amt').val(0);
								  			$('#subvisit-paid_amt').val(0);
							  			 	$('#subvisit-due_amt').val('');
		  			 					}
					  			 		else
					  			 		{
					  			 			if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  				$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  				$('#subvisit-paid_amt').val(0);
						  			 		$('#subvisit-due_amt').val(data[1]['consult_amount']);
					  			 		}
						  			 }
						  			 else if(is_free_visit === 'NO')
						  			 {
						  			 	if(data[1]['specialist'] !== '')
						  			 	{
						  			 		$('#subvisit-department').val(data[1]['specialist']);
						  			 	}
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  			$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  			$('#subvisit-paid_amt').val(0);
						  			 	$('#subvisit-due_amt').val(data[1]['consult_amount']);
						  			 }
					  			 	
				  			 	}
		  			 			else
		  			 			{
		  			 				
		  			 				
		  			 				if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === result)
		  			 					{
				  			 				if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
							  			 	$('#subvisit-net_amt').val(0);
							  			 	$('#subvisit-paid_amt').val(0);
						  			 	}
						  			 	else
						  			 	{
						  			 		if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			 	}
						  			}
						  			else if(is_free_visit === 'NO')
						  			{
						  				if(data[1]['specialist'] !== '')
						  			 	{
						  			 		$('#subvisit-department').val(data[1]['specialist']);
						  			 	}
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
						  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
						  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			}
					  			}
		  			 		}
		  			 		else
		  			 		{
		  			 			$('#newpatient-insurance_type_id').val('');
		  			 			$('#subvisit-consultant_doctor').val('');
		  			 			$('#newpatient-insurance_type_id').focus();
		  			 			alert('Invalid Insurance Type');
		  			 		}
		  			 	}
		  			 	else if(insurance_type === '')
		  			 	{
		  			 		if(data[1]['specialist'] !== '')
			  			 	{
			  			 		$('#subvisit-department').val(data[1]['specialist']);
			  			 	}
			  			 	
			  			 			if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === result)
		  			 					{
				  			 				
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
							  			 	$('#subvisit-net_amt').val(0);
							  			 	$('#subvisit-paid_amt').val(0);
						  			 	}
						  			 	else
						  			 	{
						  			 		
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			 	}
						  			}
						  			else if(is_free_visit === 'NO')
						  			{
						  				
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
						  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
						  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			}
		  			 	}
			        	
		  			}
		  	});
	  	}
    }
});

function UCILLetterStatus(data)
{
	if(data === 'YES')
	{
		$('#subvisit-ucil_emp_id').removeAttr('disabled');
		$('#subvisit-ucil_date').removeAttr('disabled');
		
	}
	else if(data === 'NO')
	{
		$('#subvisit-ucil_emp_id').removeAttr('disabled');
		$('#subvisit-ucil_date').attr('disabled','disabled');
		$('#subvisit-ucil_date').val('');
	}
	else if(data === '')
	{
		$('#subvisit-ucil_emp_id').attr('disabled','disabled');
		$('#subvisit-ucil_date').attr('disabled','disabled');
		$('#subvisit-ucil_date').val('');
	}
}


//Save UCIL in Another Field
  	function SaveUCIL() 
    {
    	var ucil_letter_status=$('#subvisit-ucil_letter_status').val();
  		if (ucil_letter_status === 'YES')
  		{
  			var UCIL_id=$('#subvisit-ucil_emp_id').val(); 
  			var Curr_date=$('#subvisit-patient_date').val();
		   	var Issue_date=$('#subvisit-ucil_date').val(); 
  			
  			
				
  			
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
				    			
				    		}
				    		else if(result == 'EXP')
				    		{
				    			$('#subvisit-ucil_date').val('');
				    			alert('Referral Letter is Expiry');
				    			$('#subvisit-ucil_date').focus();
				    			return false;
				    		} 
				    		else if(result == 'INV')
				    		{
				    			$('#subvisit-ucil_date').val('');
				    			alert('Referral Letter is Expiry');
				    			$('#subvisit-ucil_date').focus();
				    			return false;
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

function DiscountPercentCalculation(data)
{
	var total_amount=parseFloat($('#subvisit-total_amount').val());
	$('#subvisit-net_amt').val(total_amount);
	if(!isNaN(total_amount) && data !== '')
	{
		if(data <= 100)
		{
			var data_val=parseFloat(data);
		}
		else if(data > 100)
		{
			var data_val=100;
			
		}
		var calc=(total_amount*data_val)/100;
		var net_amt=parseFloat(total_amount-calc)
		
		$('#subvisit-less_disc_flat').val(calc);
		$('#subvisit-net_amt').val(net_amt.toFixed(2));
		$('#subvisit-paid_amt').val(net_amt.toFixed(2));
		$('#subvisit-less_disc_percent').val(data_val);
		$('#subvisit-due_amt').val('');
		
		//Authority AND Reason
		$('#subvisit-authority').removeAttr('disabled');
		$('#subvisit-authority').attr('required','required');
		
		$('#subvisit-reason').removeAttr('disabled');
		$('#subvisit-reason').attr('required','required');
		
		$('#subvisit-authority').val('');
		$('#subvisit-reason').val('');
		
	}
	else if(data === '')
	{
		$('#subvisit-less_disc_flat').val(0);
		$('#subvisit-net_amt').val(total_amount.toFixed(2));
		$('#subvisit-paid_amt').val(total_amount.toFixed(2));
		$('#subvisit-due_amt').val('');
		
		//Authority AND Reason
		$('#subvisit-authority').attr('disabled','disabled');
		$('#subvisit-authority').removeAttr('required');
		
		$('#subvisit-reason').attr('disabled','disabled');
		$('#subvisit-reason').removeAttr('required');
		
		$('#subvisit-authority').val('');
		$('#subvisit-reason').val('');
	}
}


function PaidAmountCalculation(data)
{
	var net_amount=$('#subvisit-net_amt').val();
	var total_amount=parseFloat($('#subvisit-total_amount').val());
	
	var disc_percent=parseFloat($('#subvisit-less_disc_percent').val());
	var disc_amount=parseFloat($('#subvisit-less_disc_flat').val());
	var due_amount=parseFloat($('#subvisit-due_amt').val());
	
	var data_value=parseFloat(data);
	if(!isNaN(total_amount))
	{
		if(data_value <= total_amount)
		{
			$('#subvisit-net_amt').val(total_amount);
			var calculation=total_amount - data_value;
			$('#subvisit-due_amt').val(calculation);
			
			$('#subvisit-less_disc_percent').val('');
			$('#subvisit-less_disc_flat').val('');	
		
			//Authority AND Reason
			$('#subvisit-authority').removeAttr('disabled');
			$('#subvisit-authority').attr('required','required');
			
			$('#subvisit-reason').removeAttr('disabled');
			$('#subvisit-reason').attr('required','required');
			
			$('#subvisit-authority').val('');
			$('#subvisit-reason').val('');
		}
		else
		{
			$('#subvisit-net_amt').val(total_amount);
			$('#subvisit-paid_amt').val(total_amount);
			$('#subvisit-due_amt').val('');
			
			$('#subvisit-paid_amt').val(total_amount);
			$('#subvisit-due_amt').val('');
			
			//Authority AND Reason
			$('#subvisit-authority').attr('disabled','disabled');
			$('#subvisit-authority').removeAttr('required');
			
			$('#subvisit-reason').attr('disabled','disabled');
			$('#subvisit-reason').removeAttr('required');
			
			$('#subvisit-authority').val('');
			$('#subvisit-reason').val('');
			
			alert('Net Amount Not Greater Than Paid Amount');
		}
		
	}
	else if(data === '')
	{
		$('#subvisit-net_amt').val(total_amount);
		$('#subvisit-paid_amt').val(total_amount);
		$('#subvisit-due_amt').val('');
		
		//Authority AND Reason
		$('#subvisit-authority').attr('disabled','disabled');
		$('#subvisit-authority').removeAttr('required');
		
		$('#subvisit-reason').attr('disabled','disabled');
		$('#subvisit-reason').removeAttr('required');
		
		$('#subvisit-authority').val('');
		$('#subvisit-reason').val('');
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

function SaveRegisterForm()
{
	$('#subvisit-ucil_emp_id').removeAttr('required');
	$('#subvisit-ucil_date').removeAttr('required');
	
	var patient_type=$('#subvisit-patient_type').val();
	if(patient_type === '3')
	{
		$('#newpatient-insurance_type_id').removeAttr('disabled');
		$('#newpatient-insurance_type_id').attr('required','required');
	}
	else
	{
		$('#newpatient-insurance_type_id').removeAttr('required');
		$('#newpatient-insurance_type_id').attr('disabled','disabled');
	}
	
	var ucil_letter_status=$('#subvisit-ucil_letter_status').val();
	if(ucil_letter_status === 'YES')
	{
		$('#subvisit-ucil_emp_id').attr('required','required');
		$('#subvisit-ucil_date').attr('required','required');
	}
	else if(ucil_letter_status === 'NO')
	{
		$('#subvisit-ucil_emp_id').attr('required','required');
	}
	else
	{
		$('#subvisit-ucil_emp_id').removeAttr('required');
		$('#subvisit-ucil_date').removeAttr('required');
	}
	
	var valid=$("#w0").valid(); 
	if(valid === true)
	{
		//Doctor Validation
		var doctor=$('#subvisit-consultant_doctor').val();
		var consultant_validation=ConsultantValidation(doctor);
		
		//Specialist Validation
		var specialist=$('#subvisit-department').val();
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
		
		if(consultant_validation === 'OK' && specialist_validataion === 'OK')
		{
			if(insurance_validataion === 'OK')
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
			        	
			        	if(obj[0] === 'Save')
			        	{
			        		
			        		$('#subvisit-sub_visit').val(obj[1]['sub_visit']);
	    					
	    					$('#save_register_form').attr('disabled','disabled');
	    					$('#show_mrnumber').html(obj[1]['sub_visit']);
				        	$('#mr_modal').modal({backdrop: 'static', keyboard: false});
							$("#save_data").attr("disabled", "disabled");
							$('#mr_modal').show();
			        		
			        		
			        		var url='<?php echo Yii::$app->homeUrl ?>?r=newpatient/subvistreportpdf&id='+obj[1]['sub_id'];
	    					window.open(url,'_blank');
	    					
	    					
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
				$('#newpatient-insurance_type_id').val('');
				$('#newpatient-insurance_type_id').focus();
				alert('Invalid Insurance Type');
			}
		}
		else
		{
			$('#subvisit-consultant_doctor').val('');
			$('#subvisit-department').val('');
			$('#subvisit-consultant_doctor').focus();
			alert('Invalid Consultant Name');
			
		}
	}
}


$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
           	SaveRegisterForm();
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
           // ClearForm();
            break;
        }
    }
});

function showAge(dobYear, dobMonth, dobDay) {
	var bthDate, curDate, days;
	var ageYears, ageMonths, ageDays;
	bthDate = new Date(dobYear, dobMonth-1, dobDay);
	curDate = new Date();
	if (bthDate>curDate) return;
	days = Math.floor((curDate-bthDate)/(1000*60*60*24));
	ageYears = Math.floor(days/365);
	ageMonths = Math.floor((days%365)/31);
	ageDays = days - (ageYears*365) - (ageMonths*31);
	if (ageYears>0) {
		document.write(ageYears+" year");
		if (ageYears>1) document.write("s"); 
		if ((ageMonths>0)||(ageDays>0)) document.write(", ");
	}
	if (ageMonths>0) {
		document.write(ageMonths+" month");
		if (ageMonths>1) document.write("s");
		if (ageDays>0) document.write(", ");
	}
	if (ageDays>0) {
		document.write(ageDays+" day");
		if (ageDays>1) document.write("s");
	}
}

function ConsultantDoctor()
{
	$modal = $('#unit_consultant_details');
	$modal.modal('show');
}

$("body").on('click', '.unit_consultant_details', function ()
{
	$modal = $('#unit_consultant_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#unit_consultant_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});


function doctor_unit_consultant(){
    	
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=newpatient/unitconsultant';
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

$('#unit_consultant_table').off('click.rowClick').on('click.rowClick', 'td', function () {      
	var data = table_reg.row( this ).id();
 	Unitdetailsfetch(data);
});

$('#unit_consultant_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		//Unitdetailsfetch(data);
 	}
});    
    
}

function Unitdetailsfetch(data_val)
{
	$('#load1').show();
			$.ajax({
		  			url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/specialistdatatable&id=";?>'+data_val,
		  			method:'POST',
		  			dataType:'json',
		  			success:function(data)
		  			{   
		  			 	$('#load1').hide();
		  			 	
		  			
		  			 	
		  			 	EmptyConsultant('');
		  			 	
		  			 	$('#subvisit-consultant_doctor').val(data[2]['physician_name']);
		  			 	var consultant_name=$('#subvisit-consultant_doctor').val();
		  			 	
		  			 	//UCIL AMOUNT CODE
		  			 	var insurance_type=$('#newpatient-insurance_type_id').val();
		  			 	var is_free_visit=$('#subvisit-is_freevisit').val();
		  			 	var previous_consultant_name=$('#subvisit-consultant_name').val();
		  			 	
		  			 	
		  			 	if(insurance_type !== '')
		  			 	{
		  			 		var validatedtype=InsuranceMasterValidation(insurance_type);
		  			 		if(validatedtype === 'OK')
		  			 		{
		  			 			if(insurance_type === 'UCIL')
				  			 	{
				  			 		if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === data[2]['physician_name'])
		  			 					{
		  			 						if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
								  			$('#subvisit-net_amt').val(0);
								  			$('#subvisit-paid_amt').val(0);
							  			 	$('#subvisit-due_amt').val('');
		  			 					}
					  			 		else
					  			 		{
					  			 			if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['ucil_amount']);
							  				$('#subvisit-net_amt').val(data[1]['ucil_amount']);
							  				$('#subvisit-paid_amt').val(0);
						  			 		$('#subvisit-due_amt').val(data[1]['ucil_amount']);
					  			 		}
						  			 }
						  			 else if(is_free_visit === 'NO')
						  			 {
						  			 	if(data[1]['specialist'] !== '')
						  			 	{
						  			 		$('#subvisit-department').val(data[1]['specialist']);
						  			 	}
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['ucil_amount']);
							  			$('#subvisit-net_amt').val(data[1]['ucil_amount']);
							  			$('#subvisit-paid_amt').val(0);
						  			 	$('#subvisit-due_amt').val(data[1]['ucil_amount']);
						  			 }
					  			 	
				  			 	}
				  			 	else if(insurance_type === 'Aarogyasri')
				  			 	{
				  			 		if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === data[2]['physician_name'])
		  			 					{
		  			 						if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
								  			$('#subvisit-net_amt').val(0);
								  			$('#subvisit-paid_amt').val(0);
							  			 	$('#subvisit-due_amt').val('');
		  			 					}
					  			 		else
					  			 		{
					  			 			if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  				$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  				$('#subvisit-paid_amt').val(0);
						  			 		$('#subvisit-due_amt').val(data[1]['consult_amount']);
					  			 		}
						  			 }
						  			 else if(is_free_visit === 'NO')
						  			 {
						  			 	if(data[1]['specialist'] !== '')
						  			 	{
						  			 		$('#subvisit-department').val(data[1]['specialist']);
						  			 	}
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  			$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  			$('#subvisit-paid_amt').val(0);
						  			 	$('#subvisit-due_amt').val(data[1]['consult_amount']);
						  			 }
					  			 	
				  			 	}
		  			 			else
		  			 			{
		  			 				
		  			 				
		  			 				if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === data[2]['physician_name'])
		  			 					{
				  			 				if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
							  			 	$('#subvisit-net_amt').val(0);
							  			 	$('#subvisit-paid_amt').val(0);
						  			 	}
						  			 	else
						  			 	{
						  			 		if(data[1]['specialist'] !== '')
							  			 	{
							  			 		$('#subvisit-department').val(data[1]['specialist']);
							  			 	}
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			 	}
						  			}
						  			else if(is_free_visit === 'NO')
						  			{
						  				if(data[1]['specialist'] !== '')
						  			 	{
						  			 		$('#subvisit-department').val(data[1]['specialist']);
						  			 	}
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
						  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
						  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			}
					  			}
		  			 		}
		  			 		else
		  			 		{
		  			 			$('#newpatient-insurance_type_id').val('');
		  			 			$('#subvisit-consultant_doctor').val('');
		  			 			$('#newpatient-insurance_type_id').focus();
		  			 			alert('Invalid Insurance Type');
		  			 		}
		  			 	}
		  			 	else if(insurance_type === '')
		  			 	{
		  			 		if(data[1]['specialist'] !== '')
			  			 	{
			  			 		$('#subvisit-department').val(data[1]['specialist']);
			  			 	}
			  			 	
			  			 			if(is_free_visit === 'YES')
		  			 				{
		  			 					if(previous_consultant_name === data[2]['physician_name'])
		  			 					{
				  			 				
							  			 	
							  			 	$('#subvisit-total_amount').val(0);
							  			 	$('#subvisit-net_amt').val(0);
							  			 	$('#subvisit-paid_amt').val(0);
						  			 	}
						  			 	else
						  			 	{
						  			 		
							  			 	
							  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
							  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
							  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			 	}
						  			}
						  			else if(is_free_visit === 'NO')
						  			{
						  				
						  			 	
						  			 	$('#subvisit-total_amount').val(data[1]['consult_amount']);
						  			 	$('#subvisit-net_amt').val(data[1]['consult_amount']);
						  			 	$('#subvisit-paid_amt').val(data[1]['consult_amount']);
						  			}
		  			 	}
			        	
		  			}
		  	});
		  	
		  	$modal = $('#unit_consultant_details');
			$modal.modal('hide');
}


</script>
