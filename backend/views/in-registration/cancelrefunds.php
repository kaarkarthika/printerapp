<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\TreatmentOverall */
/* @var $form yii\widgets\ActiveForm */


?>
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
    background: #337ab7;
    padding-left: 10px;    margin-bottom: 6px;
        font-size: 15px;
    font-weight: normal;
	color:#fff;
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
</style>
<div class="row treatment-overall-form">
	<div class=" ">
		<div class="col-sm-6">
			<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
			<ol class="breadcrumb">
				<li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
				<li><a href="#"><?php echo 'Treatment Overall';?></a></li>
			</ol>
		</div>
		<div class="col-sm-6 text-right ">
		</div>
	</div>
	
	<div class="col-sm-12">
	<div class="panel panel-border panel-custom">

	<div class="panel-body" style="min-height:600px;">
    <?php $form = ActiveForm::begin(); ?>


    
    	<div class="row head-border">
    	  <table class="cancel-form-de" style="width:100%;">
    	  	<tr><td style="vertical-align: top;">
    	  	<fieldset class="scheduler-border cancel-border">
			<legend class="scheduler-border form-head ">CANCELLATION TYPE</legend>
	 			<div class="form-group field-no_of_items">
						<?= $form->field($procedure_cancelation, 'can_bill')->textInput(['class'=>'cancel_type cancel_bill_no  form-control','readonly' => true])->label('Cancel No') ?>
				</div>
	 			<div class="form-group field-no_of_items">
						<label class="control-label" for="no_of_items">Transaction Type</label>
	 						<select name='transaction_type'>
							  <option value="P">Procedures</option>
							  <option value="R">Requistions</option>
							</select>
	 			</div>
	 			<div class="form-group field-no_of_items">
						<label class="control-label" for="no_of_items">Cancel Type</label>
	 					<select name='cancel_type'>
							  <option value="C">Cancel</option>
						</select>	
	 			</div>
   				</fieldset>
		</td>
			<td style="vertical-align: top;">
    	    	  	<fieldset class="scheduler-border cancel-border">
					<legend class="scheduler-border form-head ">PATIENT DETAILS</legend>
	 		
	 			<div class="form-group field-no_of_items">
					<?= $form->field($treatment_overall, 'billnumber')->textInput(['class'=>'cancel_type  form-control','readonly' => true,'required' => true])->label('Bill No') ?>
				</div>
				<div class="form-group field-no_of_items">
					<?= $form->field($treatment_overall, 'mrnumber')->textInput(['class'=>'cancel_type  form-control','readonly' => true,'required' => true])->label('MRN No') ?>
				</div>
	 			<div class="form-group field-no_of_items">
					<?= $form->field($treatment_overall, 'name')->textInput(['class'=>'cancel_type  form-control','readonly' => true])->label('Patient Name') ?>
	 			</div>
	 			<div class="form-group field-no_of_items">
						<?= $form->field($treatment_overall, 'gender')->dropDownList(['Male'=>'Male','Female'=>'Female'],['class'=>'form-control  cus-fld ','readonly' => true])->label('Gender') ?>
	 			</div>
   			
   	
		</fieldset>
    	</td>
    	<td>
    	  	<div class="col-sm-12 cancel-border">
	 			<div class="form-group field-no_of_items">
				<?php $dob=""; if($treatment_overall->dob!=NULL){ 
					$dob = date('d-m-Y', strtotime($treatment_overall->dob)); } ?>
				<?= $form->field($treatment_overall, 'dob')->textInput(['class'=>'cancel_type  form-control','readonly' => true, 'value'=>$dob ])->label('DOB') ?>
				</div>
	 			<div class="form-group field-no_of_items">
						
	 					<?= $form->field($treatment_overall, 'insurancetype')->dropDownList($insurancelist,['class'=>'form-control  cus-fld ','readonly' => true])->label('Insurance') ?>
	 			</div>
	 			<div class="form-group field-no_of_items">
				<?php $created_at=""; if(!empty($treatment_overall->created_at)){ 
					$created_at = date('d-m-Y', strtotime($treatment_overall->created_at)); 
					} ?>
	 			<?= $form->field($treatment_overall, 'created_at')->textInput(['class'=>'cancel_type  form-control','readonly' => true, 'value'=>$created_at])->label('Bill Date') ?>
	 			</div>
   				<div class="form-group field-no_of_items">
				<?php $created_time=""; if(!empty($treatment_overall->created_at)){ 
					$created_time = date('H:i:s', strtotime($treatment_overall->created_at)); 
					} ?>		

	 			<?= $form->field($treatment_overall, 'created_at')->textInput(['class'=>'cancel_type  form-control','readonly' => true, 'value'=>$created_time])->label('Bill Time') ?>
	 			</div>
	 			
   			</div>
   			</td>
   			</tr>
   			</table>
    	  </div>
    	
    	 		
    	 <div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>
		
	 
	<div class="row calculation_part_head">
			
			<table class="ccancel-cal" style="width:100%">
				<tr>
					<td style="width:18%;position: relative;top: -6px;">
						<label>Procedure List</label>
            			<select name='procedurelist' id='procedurelist' onchange='ProceduresChosen(this.value);' >
							  <option value=""></option>
							  <?php if(!empty($treatment_individual)) { foreach ($treatment_individual as $key => $value) {?>
							  <option value="<?php echo $value['ind_id']; ?>"><?php echo $procedure_index[$value['treatment_id']]['treatment_name']; ?></option>
							  <?php }} ?>
						</select>
						  <span hidden id="already1" style="color: red; font-size: 12px; display: none;" hidden="">Issue Qty Not Greater Than Return Qty!!!</span>
						  <span hidden id="already" style="color: red; font-size: 12px; display: none;" hidden="">Return Qty Not Less Than Issue Qty!!!</span>
            			
					</td>	
					<td style="width:8%">
					
            			<?= $form->field($treatment_ind_obj, 'qty')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('ISSUE QTY') ?>
					</td>
					<td style="width:8%">
					
            			<?= $form->field($treatment_ind_obj, 'qty')->textInput(['class'=>'cancel_type  form-control number','id'=>'ret_qty','onkeyup'=>'ReturnQty(this.value,event);'])->label('RET QTY') ?>
					</td>
					<td style="width:8%">
					
            			<?= $form->field($treatment_ind_obj, 'rate')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('RATE') ?>
					</td>
					<td style="width:8%">
						<?= $form->field($treatment_ind_obj, 'gstpercent')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('GST(%)') ?>
					</td>
					<td style="width:8%">
						<?= $form->field($treatment_ind_obj, 'gstvalue')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('GST(AMT)') ?>
					</td>
					<td style="width:8%">
						<?= $form->field($treatment_ind_obj, 'discount_percent')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('DISC(%)') ?>
					</td>
					<td style="width:8%">
							<?= $form->field($treatment_ind_obj, 'discountvalue')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('DISC(AMT)') ?>
					</td>
						
					<td style="width:8%">
						<?= $form->field($treatment_ind_obj, 'total_price')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('Total') ?>
					</td>
					<td style="width:4%">
						<div class="form-group add_btur">
							<label style="visibility:hidden">Add</label>
							<button type="button" id="add_to_grid" onclick="AddToGrid();" title="Add To Grid" class="add_to_grid btn btn-danger btn-xs"><i class="fa fa-plus"></i> Return</button>
						</div>
					</td>	
				</tr>
			</table>
			</div>
			<div class="row calculation_part">
			
				<table class="table table-bordered table-striped" id="tbUser">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center hide">#</th>
                              <th rowspan="2" class="text-center">PROCEDURE NAME</th>
                              <th rowspan="2" class="text-center">RATE</th>
                              <th rowspan="2" class="text-center">ISSUE QTY</th>
                              <th rowspan="2" class="text-center">RETURN QTY</th>
                              <th colspan="2" class="text-center">GST(%)</th>
                              <th colspan="2" class="text-center">GST(AMT)</th>
                              <th colspan="2" class="text-center">Discount</th>
                              <th rowspan="2" class="text-center">Total</th>
                              <th rowspan="2" class="text-center">Remove</th>
                           </tr>
                           <tr>
                              <th class="text-center">CGST(%)</th>
                              <th class="text-center">SGST(%)</th>
                              <th class="text-center">CGST(AMT)</th>
                              <th class="text-center">SGST(AMT)</th>
                              <th class="text-center">DIS(%)</th>
                              <th class="text-center">DIS(Amt)</th>
                           </tr>
                        </thead>
                        <tbody id="fetch_update_data">  
                        </tbody>
                     </table>
         </div>
		<div class="row finalbill_cal ">
			<table class="cancel-form-de finalbill" style="width:100%">
				<tr><td style="    vertical-align: top;" >
				<fieldset class="scheduler-border cancel-border">
				<legend class="scheduler-border form-head ">FINANCIAL DETAILS</legend>
	 				<div class="form-group field-no_of_items">
						<?= $form->field($procedure_cancelation, 'can_qty')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('QTY') ?>
					</div>
	 				<div class="form-group field-no_of_items">
						<?= $form->field($procedure_cancelation, 'cancel_unitprice')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('RATE') ?>
	 				</div>
	 				<div class="form-group field-no_of_items">
						<?= $form->field($procedure_cancelation, 'can_dis_percent')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('DISC(%)') ?>
	 				</div>
	 				<div class="form-group field-no_of_items">
						<?= $form->field($procedure_cancelation, 'can_dis_value')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('DISC(AMT)') ?>
	 				</div>
	 					<input type="hidden" name="total_subvalue" id="total_subvalue" value="0">
   				</fieldset>
				</td>
				<td >
					
				<fieldset class="scheduler-border cancel-border">
					
	 				<div class="form-group field-no_of_items">
						<?= $form->field($procedure_cancelation, 'can_gst_percent')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('GST(%)') ?>
	 				</div>
	 					<div class="form-group field-no_of_items">
						<?= $form->field($procedure_cancelation, 'can_gst_amt')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('GST(AMT)') ?>
	 				</div>
				<div class="form-group field-no_of_items">
					<?= $form->field($procedure_cancelation, 'can_total')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('NET AMT') ?>
				</div>
   				<div class="form-group field-no_of_items">
					<?= $form->field($procedure_cancelation, 'can_due_amt')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('DUE AMT') ?>
	 			</div>
	 			<div class="form-group field-no_of_items">
					<?= $form->field($treatment_overall, 'overalltotal')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('PAID AMT') ?>
	 			</div>
	 			
	 			</fieldset>
   				</td>
   				<td >
   					<fieldset class="scheduler-border cancel-border">
   						
	 			<div class="form-group field-no_of_items">
					<?= $form->field($procedure_cancelation, 'return_amt')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('Return Amount') ?>
	 			</div>
	 			<div class="form-group field-no_of_items">
					<?= $form->field($procedure_cancelation, 'balance_amt')->textInput(['class'=>'cancel_type  form-control','readonly'=>true])->label('Balance Amount') ?>
	 			</div>
	 			<div class="form-group field-no_of_items">
					<?= $form->field($procedure_cancelation, 'reason_cancel')->textInput(['class'=>'cancel_type  form-control','required'=>true])->label('REASON') ?>	
	 			</div> 
	 			<div class="form-group field-no_of_items">
					<?= $form->field($procedure_cancelation, 'authority')->textInput(['class'=>'cancel_type  form-control','required'=>true])->label('AUTHORITY') ?>	
	 			</div> 
	 			</fieldset>
	 			</td>	
   				<td  >
   					<div class="inner-des button-select-re">
   						<input type="hidden" name="saved_val" id='saved_val'>
				<button type="button" class="btn btn-success" id="saves_sucess" onclick="SaveProcedures();">Save</button>
	        	<button type="button" class="btn btn-success">Clear</button>
	        	<button type="button" class="btn btn-success">Close</button>
	        				
				</div>
   				</td>	
   				
   				</tr>
			</table>
		 </div>
		
		<!--Common Search-->
		<div id="patient_hist-modal_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Details</h4>
      </div>
      <div class="modal-body">
      	
        <div class="" id="patient_history_report">
            	<table class="table table-striped table-bordered">
				<tbody id='set_patient_data1'>
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

var treatment_individual=$.parseJSON('<?php echo json_encode($treatment_individual_index); ?>');
var procedure_tbl_array=$.parseJSON('<?php echo json_encode($procedure_index); ?>');
var treatment_overall_array=$.parseJSON('<?php echo json_encode($treatment_overall_array); ?>');
//alert(treatment_overall_array[12]['overall_due_amount']);
$('#procedurelist').focus();
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

function SaveProcedures()
 {	
 	var getid = '<?php echo $_GET['id']; ?>';
 	var mrnumber=$('#intreatmentoverall-mrnumber').val(); 
 	var billnumber=$('#intreatmentoverall-billnumber').val();
 	var patient_name=$('#intreatmentoverall-name').val();
 	var gender=$('#intreatmentoverall-gender').val();
 	var dob=$('#intreatmentoverall-dob').val();
 	var reason_cancel=$('#inprocedurecancelation-reason_cancel').val();
 	var authority=$('#inprocedurecancelation-authority').val(); 
 	
 	var length_arr=$("#fetch_update_data tr").length;
 	
 	if(length_arr === 0)
	{
			Alertment('Choose Refund Procedures!!!');
			return false;  
	}
	else 
	{
		var valid=$("#w0").valid();  
		if(valid === true)
		{
			if (confirm('Are You Sure to Save ?')) {
			$('#load1').show();
			$.ajax({	
				     type: "POST",
	 				 url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/procedure-refunds&id=";?>"+getid,
	 				 data: $("#w0").serialize(),
				     success: function (result) 
				     {
				     	$('#load1').hide();
				     	//alert(result);
				     	obj=$.parseJSON(result);
				     	$("#saved_val").val(obj[2]);
                         $('#saves_sucess').attr('disabled','disabled');
				     		//$('.cancel_type').html(result);
				     	$('.cancel_bill_no').val(obj[0]);  

				     	if(obj[1] === 'S')
				     	{
				     		$("#saved_val").val(obj[2]);
				     		$('#load1').hide();
				     		Alertment('Saved Success..');
				     		$('#saves_sucess').attr('disabled','disabled');
				     	}	
				     }
			});
		}
	  }
	}
 }

function ProceduresChosen(data)
{
	if(data !== '')
	{
	$('#intreatmentindividual-qty').val(treatment_individual[data]['qty']);
	$('#ret_qty').val(treatment_individual[data]['qty']);
	$('#intreatmentindividual-rate').val(treatment_individual[data]['rate']);
	$('#intreatmentindividual-gstpercent').val(treatment_individual[data]['gstpercent']);
	$('#intreatmentindividual-gstvalue').val(treatment_individual[data]['gstvalue']);
	$('#intreatmentindividual-discount_percent').val(treatment_individual[data]['discount_percent']);
	$('#intreatmentindividual-discountvalue').val(treatment_individual[data]['discountvalue']);
	$('#intreatmentindividual-total_price').val(treatment_individual[data]['total_price']);
	$('#ret_qty').focus();
	}
	else if(data === '')
	{
		EmptyProceduresChosen();
		
	}	
	
}


function DefaultProceduresChosen(data)
{
	$('#intreatmentindividual-qty').val(treatment_individual[data]['qty']);
	$('#ret_qty').val(treatment_individual[data]['qty']);
	$('#intreatmentindividual-rate').val(treatment_individual[data]['rate']);
	$('#intreatmentindividual-gstpercent').val(treatment_individual[data]['gstpercent']);
	$('#intreatmentindividual-gstvalue').val(treatment_individual[data]['gstvalue']);
	$('#intreatmentindividual-discount_percent').val(treatment_individual[data]['discount_percent']);
	$('#intreatmentindividual-discountvalue').val(treatment_individual[data]['discountvalue']);
	$('#intreatmentindividual-total_price').val(treatment_individual[data]['total_price']);
}

function EmptyProceduresChosen()
{
	$('#intreatmentindividual-qty').val('');
	$('#ret_qty').val('');
	$('#intreatmentindividual-rate').val('');
	$('#intreatmentindividual-gstpercent').val('');
	$('#intreatmentindividual-gstvalue').val('');
	$('#intreatmentindividual-discount_percent').val('');
	$('#intreatmentindividual-discountvalue').val('');
	$('#intreatmentindividual-total_price').val('');
	$('#procedurelist').val('');
	$('#procedurelist').focus();
}



function ReturnQty(data,event)
{		
							$("#already").hide();
							$("#already1").hide();
		var issue_qty=parseInt($('#intreatmentindividual-qty').val());
		var procedure_val=$('#procedurelist').val();
		data=parseInt(data);
		if(procedure_val !== '')
		{
			if(event.keyCode === 13)
			{
				if(!isNaN(issue_qty))
				{
					if(!isNaN(data))
					{
						if(issue_qty < data)
						{
							
							DefaultProceduresChosen(procedure_val);
							//$('#ret_qty').val(treatment_individual[procedure_val]['qty']);
							//Alertment('Issue Qty Not Greater Than Return Qty!!!');
							$("#already1").show(); return false;
						}
						else if(data <= 0)
						{
							DefaultProceduresChosen(procedure_val);
							//$('#ret_qty').val(treatment_individual[procedure_val]['qty']);
							//Alertment('Return Qty Not Less Than Issue Qty!!!');
							$("#already1").show(); return false;
						}
						else
						{
							$("#already").hide();
							$("#already1").hide();
							var rate=parseFloat($('#intreatmentindividual-rate').val());
							
							var gst=parseFloat($('#intreatmentindividual-gstpercent').val());
							//DISC AMOUNT
							var disc_percent=parseFloat($('#intreatmentindividual-discount_percent').val());
							var disc=parseFloat($('#intreatmentindividual-discountvalue').val());
							
							var curr_rate=parseFloat(data*rate);
							var gst_calc=parseFloat(curr_rate*gst/100);
							
							var overall_rate=curr_rate+gst_calc;
							
							var disc_calc=parseFloat(disc_percent*overall_rate/100);
							
							var disc_amt=overall_rate-disc_calc;
							
							//alert(overall_rate);
							$('#intreatmentindividual-gstvalue').val(gst_calc);
							$('#intreatmentindividual-discountvalue').val(disc_calc);
							$('#intreatmentindividual-total_price').val(disc_amt);
							$('#add_to_grid').focus();
						}
					}
					else if(isNaN(data))
					{
						DefaultProceduresChosen(procedure_val);
						$('#ret_qty').val(treatment_individual[procedure_val]['qty']);
					}
					
				}
			}
		}
		else
		{
			EmptyProceduresChosen();
			$('#ret_qty').val('');
			$('#procedurelist').focus();
			Alertment('Choose Procedure List!!!');
		}

}



function AddToGrid()
{
	
var procedure_list=$('#procedurelist').val();
var issue_qty=parseInt($('#intreatmentindividual-qty').val());
var ret_qty=parseInt($('#ret_qty').val());
var rate=parseFloat($('#intreatmentindividual-rate').val());
var gst_percent=parseFloat($('#intreatmentindividual-gstpercent').val());
var gst_value=parseFloat($('#intreatmentindividual-gstvalue').val());
var disc_percent=parseFloat($('#intreatmentindividual-discount_percent').val());
var disc_value=parseFloat($('#intreatmentindividual-discountvalue').val());
var total_price=parseFloat($('#intreatmentindividual-total_price').val()); 
var common_gst_percent=gst_percent/2;
var common_gst_amt=gst_value/2;
var treatment_id=treatment_individual[procedure_list]['treatment_id'];
var treatment=procedure_tbl_array[treatment_id]['treatment_name'];
var total_subvalue=parseFloat($('#total_subvalue').val());
var tot_rate=rate*ret_qty;
var sub_totval=tot_rate+total_subvalue;
$('#total_subvalue').val(tot_rate+total_subvalue);	

if(procedure_list !== '' && !isNaN(issue_qty) && !isNaN(ret_qty))
{
	
	
//Remove Duplicates Row
var length_arr=$("#fetch_update_data tr").length;
if(length_arr > 0)
{
	$("#fetch_update_data tr").each(function() 
	{
	 	var attr_id=$(this).attr('data-id');
	 	if(attr_id == procedure_list)
	 	{
	 		$('#table_del'+procedure_list).remove();
	 	}
	});
}

//DUE Amount Showing
var treatment_overall=treatment_overall_array[treatment_individual[procedure_list]['treat_ove_id']]['overall_due_amount'];

if(treatment_overall !== null)
{
	$('#inprocedurecancelation-can_due_amt').val(treatment_overall);
}
else
{
	$('#inprocedurecancelation-can_due_amt').val(0);
}	

		
var markup = "<tr class='save_data_table' data-id="+procedure_list+" id='table_del"+procedure_list+"'>"
+"<td><div class='trunctext wd100'>"+treatment+"</div></td>"
+"<td><input type='hidden' name='treatmentprimeid[]' id='treatmentprimeid"+procedure_list+"' value='"+treatment_id+"'>"
+"<input type='hidden' name='procedureindividual[]' id='procedureindividualid"+procedure_list+"' value='"+procedure_list+"'>"
+"<input type='text'  style='text-align:right;' id='intreatmentindividual-rate"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[rate][]' value='"+rate+"'></td>"
+"<td><input type='text' style='text-align:right;' id='intreatmentindividual-issue-qty"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIssueIndividual[qty][]' value='"+issue_qty+"'></td>"
+"<td><input type='text' style='text-align:right;' id='intreatmentindividual-qty"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[qty][]' value='"+ret_qty+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-cgst_percent"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[cgst_percent][]' value='"+common_gst_percent+"'></td>"																																
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-sgst_percent"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[sgst_percent][]' value='"+common_gst_percent+"'></td>"	
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-cgst_value"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[cgst_value][]' value='"+common_gst_amt+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-sgst_value"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[sgst_value][]' value='"+common_gst_amt+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-discount_percent"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[discount_percent][]' value='"+disc_percent+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-discountvalue"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[discountvalue][]' value='"+disc_value+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-total_price"+procedure_list+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[total_price][]' value='"+total_price+"'>"
+"<input type='hidden' id='intreatmentindividual-total_price_joker"+procedure_list+"' class='hidden_price form-control' name='InTreatmentIndividual[hidden_total_price][]' value='"+total_price+"'></td>"
+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+procedure_list+" id='delrow"+procedure_list+"'><i class='fa fa-remove'></i></button></td></tr>";
																	
$("#fetch_update_data").append(markup); 		

OverallTotalCalculation();

EmptyProceduresChosen();


}

}



function OverallTotalCalculation()
{
var overall_total_amount=0;
var overall_total_qty=0;
var overall_disc_percentage=0;
var overall_disc_amount=0;
var gst_percent=0;
var gst_amount=0;

var overall_net_amount=0;



$("#fetch_update_data tr").each(function() 
{
 	var attr_id=$(this).attr('data-id');
 	var total_amt_add=parseFloat($('#intreatmentindividual-rate'+attr_id).val());
 	var total_qty=parseInt($('#intreatmentindividual-qty'+attr_id).val());
 	var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
 	var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
 	var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
 	
 	var cgst_per_add=parseFloat($('#intreatmentindividual-cgst_percent'+attr_id).val());
 	var sgst_per_add=parseFloat($('#intreatmentindividual-sgst_percent'+attr_id).val());
 	
 	var cgst_amt_add=parseFloat($('#intreatmentindividual-cgst_value'+attr_id).val());
 	var sgst_amt_add=parseFloat($('#intreatmentindividual-sgst_value'+attr_id).val());
 	
 	
 	if(!isNaN(cgst_per_add) && !isNaN(sgst_per_add))
 	{
 		var add_per=sgst_per_add+cgst_per_add;
 		gst_percent=gst_percent+add_per;
 	}
 	
 	if(!isNaN(cgst_amt_add) && !isNaN(sgst_amt_add))
 	{
 		var add=cgst_amt_add+sgst_amt_add;
 		gst_amount=gst_amount+add;
 	}
 	
 	
 	if(!isNaN(total_amt_add))
 	{
 		overall_total_amount=overall_total_amount+total_amt_add;
 	}
 	
 	if(!isNaN(total_qty))
 	{
 		overall_total_qty=overall_total_qty+total_qty;
 	}
 	
 	if(!isNaN(disc_perct))
 	{
 		overall_disc_percentage=overall_disc_percentage+disc_perct;
 	}
 	
 	if(!isNaN(disc_amunt))
 	{
 		overall_disc_amount=overall_disc_amount+disc_amunt;
 	}
 	
 	if(!isNaN(net_amunt))
 	{
 		overall_net_amount=overall_net_amount+net_amunt;
 	}
 	
});


var due_amt=parseFloat($('#inprocedurecancelation-can_due_amt').val());

if(!isNaN(due_amt))
{
	var paid_amount=parseFloat($('#intreatmentoverall-overalltotal').val());
	var balance_amt=parseFloat(due_amt-overall_net_amount);
	if(balance_amt <= 0)
	{
		var balance_amt=parseFloat(overall_net_amount-due_amt);
		$('#inprocedurecancelation-balance_amt').val(0);
		$('#inprocedurecancelation-return_amt').val(balance_amt.toFixed(2));
	}
	else
	{
		$('#inprocedurecancelation-balance_amt').val(balance_amt.toFixed(2));
		$('#inprocedurecancelation-return_amt').val(0);
	}
}
else if(isNaN(due_amt))
{
	$('#inprocedurecancelation-return_amt').val(overall_net_amount.toFixed(2));
	$('#inprocedurecancelation-balance_amt').val(0);
}

//Quantity
$('#inprocedurecancelation-can_qty').val(overall_total_qty);
//$('#inprocedurecancelation-cancel_sub_total').val(overall_total_amount);
$('#inprocedurecancelation-cancel_unitprice').val(overall_total_amount);
$('#inprocedurecancelation-can_dis_percent').val(overall_disc_percentage.toFixed(2));
$('#inprocedurecancelation-can_dis_value').val(overall_disc_amount.toFixed(2));
$('#inprocedurecancelation-can_total').val(overall_net_amount.toFixed(2));
//$('#intreatmentoverall-overalltotal').val(overall_net_amount);

//GST
$('#inprocedurecancelation-can_gst_percent').val(gst_percent.toFixed(2));
$('#inprocedurecancelation-can_gst_amt').val(gst_amount.toFixed(2));



$('#intreatmentoverall-overall_due_amount').val('');
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


$("body").on('keypress', '.number', function (e) 
{
//if the letter is not digit then display error and don't type anything
if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
{
	return false;
}
}); 


$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            var saved_val = $("#saved_val").val();
              if(saved_val==""){
           			SaveProcedures();
           		}
           		else{
           			alert("Already Saved..");
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

 $("body").on('click', '.delrow', function () 
	{
		//alert("test");
		var data_addid = $(this).attr('data_delete_row')
  		var item_less=1;
  		var total_items=parseInt($('#intreatmentindividual-qty'+data_addid).val());
		var total_gst_pre=(parseFloat($('#intreatmentindividual-cgst_percent'+data_addid).val())+parseFloat($('#intreatmentindividual-sgst_percent'+data_addid).val()));
		var total_gst_val=(parseFloat($('#intreatmentindividual-cgst_value'+data_addid).val())+parseFloat($('#intreatmentindividual-sgst_value'+data_addid).val()));

		var total_disc_pre=(parseFloat($('#intreatmentindividual-discount_percent'+data_addid).val()));
		var total_disc_val=(parseFloat($('#intreatmentindividual-discountvalue'+data_addid).val()));

		var total_sub_total=parseFloat($('#intreatmentindividual-total_price'+data_addid).val()).toFixed(2);
		var rate=parseFloat($('#intreatmentindividual-rate'+data_addid).val());
	   $('#inprocedurecancelation-can_qty').val(parseInt($('#inprocedurecancelation-can_qty').val())-total_items);
		$('#inprocedurecancelation-cancel_unitprice').val(parseFloat($('#inprocedurecancelation-cancel_unitprice').val()).toFixed(2)-rate);
		$('#inprocedurecancelation-can_gst_percent').val(parseFloat($('#inprocedurecancelation-can_gst_percent').val()).toFixed(2)-parseFloat(total_gst_pre).toFixed(2));
		$('#inprocedurecancelation-can_gst_amt').val(parseFloat($('#inprocedurecancelation-can_gst_amt').val()).toFixed(2)-parseFloat(total_gst_val).toFixed(2));

		$('#inprocedurecancelation-can_dis_percent').val(parseFloat($('#inprocedurecancelation-can_dis_percent').val()).toFixed(2)-parseFloat(total_disc_pre).toFixed(2));
		$('#inprocedurecancelation-can_dis_value').val(parseFloat($('#inprocedurecancelation-can_dis_value').val()).toFixed(2)-parseFloat(total_disc_val).toFixed(2));

        var cancel=(parseFloat($('#inprocedurecancelation-can_total').val()).toFixed(2)-total_sub_total);
		$('#inprocedurecancelation-can_total').val(cancel.toFixed(2));

		$('#inprocedurecancelation-return_amt').val(parseFloat($('#inprocedurecancelation-return_amt').val()).toFixed(2)-total_sub_total);

		var netamount =parseFloat($('#inprocedurecancelation-can_total').val());
		var dueamount =parseFloat($('#inprocedurecancelation-can_due_amt').val());
		var paid =parseFloat($('#intreatmentoverall-overalltotal').val());

		var balance_amount=(dueamount+paid)-netamount;

		var balance_amountid=dueamount-netamount;

		var paidamountcalcu=paid-balance_amount;


         //  alert(paidamountcalcu);
        // alert(balance_amountid);

        if(dueamount<netamount){

        	var returnamount=netamount-dueamount;

        	$('#inprocedurecancelation-return_amt').val(returnamount.toFixed(0));
        	 $('#inprocedurecancelation-balance_amt').val('0');

        }

        else{
            $('#inprocedurecancelation-return_amt').val('0');
        	var balancecorrect=dueamount-netamount;
         $('#inprocedurecancelation-balance_amt').val(balancecorrect.toFixed(2));

        }
		/*if(paid<paidamountcalcu){
        $('#inprocedurecancelation-return_amt').val(balance_amountid);
      
		}
		else{
        
         if(paid<balance_amount){

         	alert('else');
         $('#inprocedurecancelation-return_amt').val('0');

         $('#inprocedurecancelation-balance_amt').val(balance_amount.toFixed(2));
         }else{
         	alret('if else');
     	$('#inprocedurecancelation-return_amt').val(paidamountcalcu.toFixed(2));

         $('#inprocedurecancelation-balance_amt').val('0');
        }
		}*/
         if(netamount==0){
         	$('#inprocedurecancelation-balance_amt').val('0');
         }

		$('#inprocedurecancelation-can_dis_percent').val();
		$('#inprocedurecancelation-can_dis_value').val();
		$('#table_del'+data_addid).remove();
		        
 });
</script>


