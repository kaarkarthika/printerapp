<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\LabTesting;
use backend\models\Testgroup;
use backend\models\MainTestgroup;
/* @var $this yii\web\View */
/* @var $model backend\models\LabPayment */
/* @var $form yii\widgets\ActiveForm */
 Html::encode($this->title) ;







?>

<link href="<?php echo Url::base(); ?>/css/billing.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>  

<link href="<?php echo Url::base(); ?>/alert/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/alert/jquery-confirm.min.js"></script>  



<style>
fieldset.scheduler-calculation{
    border: 1px solid #000;
    padding: 11px 3px;
}
.finalbill_cal {
	border: 1px solid #000;    padding: 0;
}
table#tbUser th, table#tbUser td, {
    border: 1px solid #b1adad;
}
table.cancel-form-de.finalbill fieldset{
	    top: 0px; margin-bottom: 10px;
}
.calculation_part_head {
	border: 1px solid #000;
    padding: 11px 3px;
    margin-bottom:6px;
}
.cancel-border label.control-label {
    width: 35%;
    text-align: right;
        font-size: 12px;
}
.cancel-border input, .cancel-border select, .cancel-border textarea {
    border: none;
    border-bottom: 1px solid #adabab;
    margin-left: 5px;     
        width: 50%;
    float: right;
    margin-right: 15px;
    margin-top: 3px;
}
.cancel-border .form-group{
	margin-bottom: 8px !important;
}
fieldset.scheduler-border legend.form-head {
    background: #fffda6;
    padding-left: 10px;    margin-bottom: 6px;
        font-size: 15px;
    font-weight: bold;
}
.table-bordered{
	width:100$;
}
.table-bordered input,.table-bordered select,.table-bordered textarea{
	width: 100px;
}
.head-border {
    border: 1px solid #000;     margin-bottom: 10px;
}
table.cancel-form-de td {
    border-right: 1px solid #000;
}
table.cancel-form-de td:last-child{
	border-right:none; text-align: center;
}
table.cancel-form-de fieldset {
    top: 0px;
    position: relative;
}
ol.breadcrumb {
    margin-bottom: 0;
}

table.ccancel-cal td {
    padding: 0 6px !important;
}
table.ccancel-cal input, #batch_no select {
    height: 25px!important;     border: 1px solid #7d7d7d;
}
table.ccancel-cal select {
    width: 100%;    height: 25px;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fbfbfb;
    opacity: 1;
}

.cancel-form-de,.calculation_part_head {
    border: 1px solid #9e9a9a;
    margin-bottom: 10px;
}
.cancel-form-de .col-md-4:last-child,.cancel-form-de .col-md-3:last-child{
	border-right: none;
}
.cancel-form-de .col-md-4,.cancel-form-de .col-md-3 {
    padding: 0;
    border-right: 1px solid #9e9a9a;
    min-height: 175px;
}
.inner-des.button-select-re {
    padding: 63px;
}

</style>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body" style="min-height:100px;">
<div class="inpatientblock  desc" style="position: relative;top: 9px;"> 
  <div class="row cancel-form-de">
  	<div class="col-md-4">
  		<fieldset class="scheduler-border cancel-border">
			<legend class="scheduler-border form-head ">CANCELLATION TYPE</legend>
	 			<div class="form-group field-no_of_items">
						<div class="form-group field-procedurecancelation-can_bill">
				<label class="control-label" for="procedurecancelation-can_bill">Cancel No</label>
					<input type="text" id="procedurecancelation-can_bill" class="cancel_type  form-control" name="ProcedureCancelation[can_bill]" readonly="">
				</div>			
				</div><br>
	 			<div class="form-group field-no_of_items">
						<label class="control-label" for="no_of_items">Transaction Type</label>
	 						<select name="transaction_type">
	 						  <option value="R">Requistions</option>
							  <option value="P">Procedures</option> 
							</select>
	 			</div>
	 			<div class="form-group field-no_of_items">
						<label class="control-label" for="no_of_items">Cancel Type</label>
	 					<select name="cancel_type">
							  <option value="C">Cancel</option>
						</select>	
	 			</div>
   				</fieldset>
  	</div>
  	<div class="col-md-4">
  		<fieldset class="scheduler-border cancel-border">
					<legend class="scheduler-border form-head ">PATIENT DETAILS</legend>
	 		 			<div class="form-group field-no_of_items">
						    <?= $form->field($main, 'bill_number')->textInput(['readonly' => true,'class'=>'form-control mrn inrefrsh text-cap'])->label('Bill Number') ?>
						</div>
						
						<div class="form-group field-no_of_items">
							<?= $form->field($main, 'mr_number')->textInput(['readonly' => true,'class'=>'form-control mrn inrefrsh text-cap'])->label('MR Number') ?>			
						</div>
						<div class="form-group field-no_of_items">
							<?= $form->field($main, 'name')->textInput(['readonly' => true,'class'=>'form-control mrn inrefrsh text-cap'])->label('Patient Name') ?> 			
						</div>
						<div class="form-group field-no_of_items">
							<?= $form->field($main, 'dob')->textInput(['readonly' => true,'class'=>'form-control mrn inrefrsh text-cap'])->label('DOB') ?>							 			
						</div>
			</fieldset>
  			</div>
  		<div class="col-md-4">
  			<div class="col-sm-12 cancel-border">
	 			<div class="form-group field-no_of_items">
						<?= $form->field($main, 'insurance')->dropDownList($insurancelist,['readonly' => true,'class'=>'form-control'])->label('Insurance') ?>			
				</div>
										 			
				<div class="form-group field-no_of_items">
						<?= $form->field($main, 'created_at')->textInput(['readonly' => true,'class'=>'form-control'])->label('Date') ?>	 			
				</div>
				<div class="form-group field-no_of_items">
						<?= $form->field($main, 'created_at')->textInput(['readonly' => true,'class'=>'form-control'])->label('Time') ?>									
				</div>
	 			
   			</div>
  		</div>		
  	
  </div>	
  <div class="row calculation_part_head">
			
			<table class="ccancel-cal" style="width:100%">
				<tbody><tr>
					<td style="width:18%;position: relative;top: -6px;">
						<label>Select Lab List</label>
            			<select name="requistionslist" id="requistionslist" onchange="RequistionsChosen(this.value,event);">
							<option value=''></option>
							<?php 
							   if(!empty($model)) 
							   {
							   	 foreach($model as $key => $value)
							   	 { 
										if($value['lab_test_name'] == 'MasterGroup')
										{
											echo '<option value='.$value['autoid'].'>'.$mastergroup[$value['lab_common_id']]['testgroupname'].'</option>';
										}								
										else if ($value['lab_test_name'] == 'LabTesting') 
										{
											echo '<option value='.$value['autoid'].'>'.$labtesting[$value['lab_common_id']]['test_name'].'</option>';
										}
										else if ($value['lab_test_name'] == 'TestGroup') 
										{
											echo '<option value='.$value['autoid'].'>'.$testgroup[$value['lab_common_id']]['testgroupname'].'</option>';
										}
							   	 }
							   }	
							?>
						</select>
            			
					</td>	
					
					<td style="width:4%">
						<div class="form-group add_btur">
							<label style="visibility:hidden">Add</label>
							<button type="button" id="add_to_grid" onclick="AddToGrid();" title="Add To Grid" class="add_to_grid btn btn-danger btn-xs"><i class="fa fa-plus"></i> Return</button>
						</div>
					</td>	
				</tr>
			</tbody></table>
			</div>
			
			
			
 <div class="row">
                  <div class="col-sm-12">
					<table class="table table-bordered table-striped" id="tbUser">
                        <thead>
                           <tr rowspan="2">
                             
                              <th rowspan="2" class="text-center">Item</th>
                              <th rowspan="2" class="text-center equal_space">Price</th>
                              <th colspan="2" class="text-center equal_space">GST(%)</th>
                              <th colspan="2" class="text-center equal_space">GST(Amt)</th>
                              <th colspan="2" class="text-center equal_space">Discount</th>
                              <th rowspan="2" class="text-center equal_space">Net Amount</th>
                              <th rowspan="2" class="text-center equal_space">Remove</th>
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
                        <tbody id="fetch_update_data">
                          
                        </tbody>
                     </table>
                  </div>
 </div>
  
  
  
  					
 <div class="row cancel-form-de">
   <div class="col-md-3">
   	<fieldset class="scheduler-border cancel-border">
				<legend class="scheduler-border form-head ">FINANCIAL DETAILS</legend>
	 				<div class="form-group field-no_of_items">
						<?= $form->field($lab_payment_prime_cancel, 'overall_item')->textInput(['readonly' => true,'class'=>'form-control'])->label('QTY') ?>	
					</div>
					<div class="form-group field-no_of_items">
						<?= $form->field($lab_payment_prime_cancel, 'rate')->textInput(['readonly' => true,'class'=>'form-control'])->label('RATE') ?>	
					</div>
					<div class="form-group field-no_of_items">
						<?= $form->field($lab_payment_prime_cancel, 'can_overall_dis_percent')->textInput(['readonly' => true,'class'=>'form-control'])->label('DISC (%)') ?>											
					</div>
					<div class="form-group field-no_of_items">
						<?= $form->field($lab_payment_prime_cancel, 'can_overall_dis_amt')->textInput(['readonly' => true,'class'=>'form-control'])->label('DISC (AMT)') ?>							 				
					</div>
   				</fieldset>
   </div>
   <div class="col-md-3">
   		<fieldset class="scheduler-border cancel-border">
					
	 				<div class="form-group field-no_of_items">
						<?= $form->field($lab_payment_prime_cancel, 'can_overall_gst_per')->textInput(['readonly' => true,'class'=>'form-control'])->label('GST (%)') ?>	 				
					</div>
					<div class="form-group field-no_of_items">
						<?= $form->field($lab_payment_prime_cancel, 'can_overall_gst_amt')->textInput(['readonly' => true,'class'=>'form-control'])->label('GST (AMT)') ?>							 				
					</div>
					<div class="form-group field-no_of_items">
						<?= $form->field($lab_payment_prime_cancel, 'can_overall_net_amt')->textInput(['readonly' => true,'class'=>'form-control'])->label('NET AMT') ?>									
					</div>
					<div class="form-group field-no_of_items">
						<?= $form->field($main, 'overall_due_amt')->textInput(['readonly' => true,'class'=>'form-control'])->label('DUE AMT') ?>							
					</div>
					<div class="form-group field-no_of_items">
						<?= $form->field($main, 'overall_paid_amt')->textInput(['readonly' => true,'class'=>'form-control'])->label('PAID AMT') ?>							
					</div>
	 			
	 			</fieldset>
   </div>
   <div class="col-md-3">
   		<fieldset class="scheduler-border cancel-border">
   						
	 			<div class="form-group field-no_of_items">
					<div class="form-group field-procedurecancelation-return_amt">
						<label class="control-label" for="procedurecancelation-return_amt">Return Amount</label>
						<input type="text" id="procedurecancelation-return_amt" class="cancel_type  form-control" name="ProcedureCancelation[return_amt]" readonly="">
						
						<div class="help-block"></div>
						</div>	 			
				</div>
							 			<div class="form-group field-no_of_items">
											<div class="form-group field-procedurecancelation-balance_amt">
						<label class="control-label" for="procedurecancelation-balance_amt">Balance Amount</label>
						<input type="text" id="procedurecancelation-balance_amt" class="cancel_type  form-control" name="ProcedureCancelation[balance_amt]" readonly="">
						
						<div class="help-block"></div>
						</div>	 			</div>
						<div class="form-group field-no_of_items">
								<?= $form->field($lab_payment_prime_cancel, 'remarks')->textInput(['readonly' => true,'class'=>'form-control'])->label('REMARKS') ?>	
						</div> 
						<div class="form-group field-no_of_items">
								<?= $form->field($lab_payment_prime_cancel, 'authority')->textInput(['readonly' => true,'class'=>'form-control'])->label('AUTHORITY') ?>			
	 					</div> 
	 			</fieldset>
	 </div>
	 
	 <div class="col-md-3">
	 	<div class="inner-des button-select-re">
	 			<input type="hidden" name="saved_val" id='saved_val'>   
				<button type="button" class="btn btn-success" id="saves_sucess" onclick="SaveLab();">Save</button>
	        	<button type="button" class="btn btn-success remove_all">Refresh</button>
	        	<button type="button" class="btn btn-success remove_all">Close</button>
		</div>
   	 </div>
						
					
 </div>


<div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>

			   
	
	
	
	
	<!--Inner modal -->

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
<div id="patient_hist-modal2" class="modal fade" role="dialog">
	 <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Details</h4>
      </div>
      <div class="modal-body">
      	 <p> Please Enter MR NUMBER</p>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>	



 
</div>
</div>

<?php ActiveForm::end(); ?>

<script>
 $("body").on('click', '.remove_all', function ()
    {
    	$("#fetch_update_data tr").remove();
    	window.location.reload(true);
    });
    
    
 $('#requistionslist').focus();
 
 var labtesting=$.parseJSON('<?php echo json_encode($labtesting);?>');
 var testgroup=$.parseJSON('<?php echo json_encode($testgroup);?>');
 var mastergroup=$.parseJSON('<?php echo json_encode($mastergroup);?>');
 var lab_payemnt=$.parseJSON('<?php echo json_encode($lab_index_array);?>');
 var lab_payment_prime=$.parseJSON('<?php echo json_encode($lab_payment_array);?>');
 function RequistionsChosen(data,event)
 {
 	
 	if(data !== '')
 	{
 	
var lab_test_name=lab_payemnt[data]['lab_test_name'];     
var lab_common_id=lab_payemnt[data]['lab_common_id'];     




var price=lab_payemnt[data]['price']; 
var gst_percentage=lab_payemnt[data]['gst_percentage']; 
var cgst_percentage=lab_payemnt[data]['cgst_percentage']; 
var sgst_percentage=lab_payemnt[data]['sgst_percentage']; 
var gst_amount=lab_payemnt[data]['gst_amount']; 
var cgst_amount=lab_payemnt[data]['cgst_amount']; 
var sgst_amount=lab_payemnt[data]['sgst_amount']; 
var total_amount=lab_payemnt[data]['total_amount']; 
var discount_percent=lab_payemnt[data]['discount_percent']; 
var discount_amount=lab_payemnt[data]['discount_amount']; 
var net_amount=lab_payemnt[data]['net_amount']; 

price = (price === null) ? 0 : price;
gst_percentage = (gst_percentage === null) ? 0 : gst_percentage;
cgst_percentage = (cgst_percentage === null) ? 0 : cgst_percentage;
sgst_percentage = (sgst_percentage === null) ? 0 : sgst_percentage;
gst_amount = (gst_amount === null) ? 0 : gst_amount;
cgst_amount = (cgst_amount === null) ? 0 : cgst_amount;
sgst_amount = (sgst_amount === null) ? 0 : sgst_amount;
total_amount = (total_amount === null) ? 0 : total_amount;
discount_percent = (discount_percent === null) ? 0 : discount_percent;
discount_amount = (discount_amount === null) ? 0 : discount_amount;
net_amount = (net_amount === null) ? 0 : net_amount;



if(lab_test_name === 'MasterGroup')
{
	var labname='MasterGroup_'+mastergroup[lab_common_id]['testgroupname'];
	var labname_fetch=mastergroup[lab_common_id]['testgroupname'];	
}	     	
else if(lab_test_name === 'LabTesting')
{
	var labname='LabTesting_'+labtesting[lab_common_id]['test_name'];
	var labname_fetch=labtesting[lab_common_id]['test_name'];
}
else if(lab_test_name === 'TestGroup')
{
	var labname='TestGroup_'+testgroup[lab_common_id]['testgroupname'];
	var labname_fetch=testgroup[lab_common_id]['testgroupname'];
}


	     	
var result='<tr class="calculation" id="lab_test'+data+'" dataid="'+data+'">'+
'<td style="text-align:center" id="lab_name'+data+'" dataid="'+labname+'">'+labname_fetch+''+
'<input type="hidden" name="LabPayment[primeid][]"  value="'+data+'">'+
'<input type="hidden" name="LabPayment[lab_common_id][]"  value="'+lab_common_id+'">'+
'<input type="hidden" name="LabPayment[lab_test_name][]"  value="'+labname_fetch+'"></td>'+
'<td style="text-align:center" ><input type="text" readonly="readonly" id="price_test_lab'+data+'" dataid="'+data+'" name="LabPayment[price][]" value="'+price+'" ></td>'+
'<td  style="text-align:center" ><input type="text" readonly="readonly" id="cgst_per_lab'+data+'" dataid="'+data+'" name="LabPayment[cgst_percentage][]" value="'+cgst_percentage+'" ></td>'+
'<td  style="text-align:center" ><input type="text" readonly="readonly" id="sgst_per_lab'+data+'" dataid="'+data+'" name="LabPayment[sgst_percentage][]" value="'+sgst_percentage+'"  ></td>'+
'<td  style="text-align:center" ><input type="text" readonly="readonly" id="cgst_amt_lab'+data+'" dataid="'+data+'" name="LabPayment[cgst_amount][]"  value="'+cgst_amount+'"></td>'+
'<td  style="text-align:center" ><input type="text" readonly="readonly" id="sgst_amt_lab'+data+'" dataid="'+data+'" name="LabPayment[sgst_amount][]"  value="'+sgst_amount+'" ></td>'+
'<td  style="text-align:center" ><input type="text" readonly="readonly" id="discount_percent_lab'+data+'" dataid="'+data+'" name="LabPayment[discount_percent][]" value="'+discount_percent+'" ></td>'+
'<td  style="text-align:center" ><input type="text" readonly="readonly" id="discount_amount_lab'+data+'" dataid="'+data+'" name="LabPayment[discount_amount][]" value="'+discount_amount+'" ></td>'+
'<td  style="text-align:center" ><input type="text" readonly="readonly" id="net_lab'+data+'" dataid="'+data+'" name="LabPayment[total_amount][]" value="'+net_amount+'"></td>'+
'<td  class="hide" style="text-align:center" ><input type="text" readonly="readonly" id="net_lab_hidden'+data+'" dataid="'+data+'" name="LabPayment[total_amount_hidden][]" value="'+net_amount+'"></td>'+
'<td  style="text-align:center"  id="remove_lab'+data+'" dataid="LabTesting_'+data+'"><button dataid="'+data+'" class="remove btn btn-danger btn-xs" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>'+
'</tr>';
	        	

var verify=true;
$(".calculation").each(function() 
{
  	var data_id=$(this).attr('dataid');
  	if(data_id == data)
  	{
  		Alertment('Data Already Exist');
  		verify = false;
  		return false;
  	}
});					
				
if(verify == true)
{
	$('#fetch_update_data').append(result);
	Calculation();
}
	
}
}
 
 
function Calculation()
{
	var i=0;
	var price=0;
	var gst_amt=0;
	var gst_per=0;
	var net=0;
	var disc_percent=0;
	var disc_amt=0;
	
	//DUE Amount Calculation
	var due_amount=parseFloat($('#labpaymentprime-overall_due_amt').val());
	
	
	$("#fetch_update_data tr").each(function() 
	{
		var data_addid=$(this).attr('dataid');
	  	
		//Price Amount
		if(isNaN(parseFloat($('#price_test_lab'+data_addid).val())))
		{
			price=price+0;
		}
		else
		{
			price=price+parseFloat($('#price_test_lab'+data_addid).val());
			
		}
		
		//CGST Percentage
		if(isNaN(parseFloat($('#cgst_per_lab'+data_addid).val())))
		{
			gst_per=gst_per+0;	
		}
		else
		{
			gst_per=gst_per+parseFloat($('#cgst_per_lab'+data_addid).val());	
		}
		//SGST Percentage
		if(isNaN(parseFloat($('#sgst_per_lab'+data_addid).val())))
		{
			gst_per=gst_per+0;	
		}
		else
		{
			gst_per=gst_per+parseFloat($('#sgst_per_lab'+data_addid).val());	
		}
		
		//CGST Amt
		if(isNaN(parseFloat($('#cgst_amt_lab'+data_addid).val())))
		{
			gst_amt=gst_amt+0;	
		}
		else
		{
			gst_amt=gst_amt+parseFloat($('#cgst_amt_lab'+data_addid).val());	
		}
		//SGST Amt
		if(isNaN(parseFloat($('#sgst_amt_lab'+data_addid).val())))
		{
			gst_amt=gst_amt+0;	
		}
		else
		{
			gst_amt=gst_amt+parseFloat($('#sgst_amt_lab'+data_addid).val());	
		}
		
		
		//Net Amount
		if(isNaN(parseFloat($('#net_lab'+data_addid).val())))
		{
			net=net+0;	
		}
		else
		{
			net=net+parseFloat($('#net_lab'+data_addid).val());	
		}
		
		
	
		//Disc Percent
		if(isNaN(parseFloat($('#discount_percent_lab'+data_addid).val())))
		{
			disc_percent=disc_percent+0;	
		}
		else
		{
			disc_percent=disc_percent+parseFloat($('#discount_percent_lab'+data_addid).val());	
		}
		
		//Disc Amt
		if(isNaN(parseFloat($('#discount_amount_lab'+data_addid).val())))
		{
			disc_amt=disc_amt+0;	
		}
		else
		{
			disc_amt=disc_amt+parseFloat($('#discount_amount_lab'+data_addid).val());	
		}
		i++;
	});
	
	if(!isNaN(due_amount))
	{
		var paid_amount=parseFloat($('#inlabpaymentprime-overall_paid_amt').val());
		var balance_amt=parseFloat(due_amount-net);
		if(balance_amt <= 0)
		{
			var balance_amt=parseFloat(net-due_amount);
			$('#inprocedurecancelation-balance_amt').val(0);
			$('#inprocedurecancelation-return_amt').val(balance_amt.toFixed(2));
		}
		else
		{
			$('#inprocedurecancelation-balance_amt').val(balance_amt.toFixed(2));
			$('#inprocedurecancelation-return_amt').val(0);
		}		
	}
	else if(isNaN(due_amount))
	{
		$('#procedurecancelation-balance_amt').val(net);
		$('#procedurecancelation-return_amt').val(0);
	}
	
	$('#inlabpaymentprimecancel-overall_item').val(i);
	$('#inlabpaymentprimecancel-can_overall_gst_per').val(gst_per);
	$('#inlabpaymentprimecancel-can_overall_gst_amt').val(gst_amt);
	$('#inlabpaymentprimecancel-rate').val(price);
	$('#inlabpaymentprimecancel-can_overall_net_amt').val(net);
	$('#inlabpaymentprimecancel-can_overall_dis_percent').val(disc_percent);
	$('#inlabpaymentprimecancel-can_overall_dis_amt').val(disc_amt);
	
	$('#requistionslist').val('');
}
 

 $("body").on('click', '.remove', function () 
	{

     var length_arr=$("#fetch_update_data tr").length;

     var quantitycount=length_arr-1;


    if(length_arr!=1)
    {
    }
    else{
$('#treatmentoverall-overalldiscountpercent').val('');
$('#treatmentoverall-overalldiscountamount').val('');
    }
   // 
		var data_addid = $(this).attr('dataid')
  		var item_less=1;
  		//var total_items=parseInt($('#treatmentindividual-qty'+data_addid).val());
		var total_gst_pre=(parseFloat($('#cgst_per_lab'+data_addid).val())+parseFloat($('#sgst_per_lab'+data_addid).val()));
		var total_gst_val=(parseFloat($('#cgst_amt_lab'+data_addid).val())+parseFloat($('#sgst_amt_lab'+data_addid).val()));
		var discountvalue=parseFloat($('#discount_percent_lab'+data_addid).val()).toFixed(2);
		var discountamount=parseFloat($('#discount_amount_lab'+data_addid).val()).toFixed(2);
		var total_sub_total=parseFloat($('#net_lab'+data_addid).val()).toFixed(2);
		var rate=parseFloat($('#price_test_lab'+data_addid).val());

	   $('#inlabpaymentprimecancel-overall_item').val(quantitycount);
		$('#inlabpaymentprimecancel-rate').val(parseFloat($('#inlabpaymentprimecancel-rate').val()).toFixed(2)-rate);
		$('#inlabpaymentprimecancel-can_overall_gst_per').val(parseFloat($('#inlabpaymentprimecancel-can_overall_gst_per').val()).toFixed(2)-parseFloat(total_gst_pre).toFixed(2));
		$('#inlabpaymentprimecancel-can_overall_gst_amt').val(parseFloat($('#inlabpaymentprimecancel-can_overall_gst_amt').val()).toFixed(2)-parseFloat(total_gst_val).toFixed(2));
		$('#inlabpaymentprimecancel-can_overall_net_amt').val(parseFloat($('#inlabpaymentprimecancel-can_overall_net_amt').val()).toFixed(2)-total_sub_total);

		$('#inlabpaymentprimecancel-can_overall_dis_percent').val(parseFloat($('#inlabpaymentprimecancel-can_overall_dis_percent').val()).toFixed(2)-discountvalue);
		$('#inlabpaymentprimecancel-can_overall_dis_amt').val(parseFloat($('#inlabpaymentprimecancel-can_overall_dis_amt').val()).toFixed(2)-discountamount);


		
		/*$('#treatmentoverall-overalltotal').val(parseFloat($('#treatmentoverall-overalltotal').val()).toFixed(2)-total_sub_total);*/
		var netamount =parseFloat($('#inlabpaymentprimecancel-can_overall_net_amt').val());
		var dueamount =parseFloat($('#inlabpaymentprime-overall_due_amt').val());
		var paid =parseFloat($('#inlabpaymentprime-overall_paid_amt').val());
		var balance_amount=(dueamount+paid)-netamount;

		var paidamountcalcu=paid-balance_amount;

		if(dueamount<netamount){

        	var returnamount=netamount-dueamount;

        	$('#procedurecancelation-return_amt').val(returnamount);
        	 $('#procedurecancelation-balance_amt').val('0');

        }

        else{
            $('#procedurecancelation-return_amt').val('0');
        	var balancecorrect=dueamount-netamount;
         $('#procedurecancelation-balance_amt').val(balancecorrect.toFixed(2));

        }

         if(netamount==0){
         	$('#procedurecancelation-balance_amt').val('0');
         }
		$('#procedurecancelation-can_dis_percent').val();
		$('#procedurecancelation-can_dis_value').val();
		//$('#intreatmentoverall-overalldiscountpercent').val();
		//$('#intreatmentoverall-overalldiscountamount').val();
		$('#lab_test'+data_addid).remove();
		        
 });
 
 
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

function SaveLab()
 {	
 	var getid = '<?php echo $_GET['id']; ?>';
 	var mrnumber=$('#labpaymentprime-mr_number').val(); 
 	var billnumber=$('#treatmentoverall-billnumber').val();
 	var patient_name=$('#labpaymentprime-name').val();
 	//var gender=$('#treatmentoverall-gender').val();
 	var dob=$('#labpaymentprime-dob').val();
 	
 	
 	var length_arr=$("#fetch_update_data tr").length;
 	
 	if(length_arr === 0)
	{
			Alertment('Choose Refund LabTesting!!!');
			return false;  
	}
	else if(getid !== '')
	{
		var valid=$("#w0").valid();  
		if(valid === true)
		{
			//$('#load1').show();
			$.ajax({	
				     type: "POST",
	 				 url: "<?php echo Yii::$app->homeUrl . "?r=in-lab-payment-prime/labreturn&id=";?>"+getid,
	 				 data: $("#w0").serialize(),
				     success: function (result) 
				     {
				     	obj=$.parseJSON(result);
				     	$("#saved_val").val(obj[2]);
	            		$('#saves_sucess').attr('disabled','disabled');
	            		//var url='<?php echo Yii::$app->homeUrl ?>?r=lab-payment-prime/billreport&id='+obj[1];			window.open(url,'_blank');
	            		Alertment('Lab Cancel Sucessfully');
                       	
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
           	//SaveLab();
           	 var  saved_val = $("#saved_val").val();
              if(saved_val==""){
           			SaveLab();
           			onetimesave=2;
           		}else{
           			//alert('Already Saved ..!');
           			Alertment('Already Saved ..!');
           		}
           		
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
</script>

