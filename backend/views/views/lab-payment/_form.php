<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\LabTesting;
use backend\models\Testgroup;
/* @var $this yii\web\View */
/* @var $model backend\models\LabPayment */
/* @var $form yii\widgets\ActiveForm */
 Html::encode($this->title) ;
?>


<link href="<?php echo Url::base(); ?>/css/billing.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>  
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>
	


<style>

table.table.table-bordered.table-striped > tbody > tr.exp:nth-of-type(odd) {
   /* background-color: #e01c1c !important; */
   background-color:#f4f4cf !important;
}

.pat-details span {
    padding-right: 5%;
    font-size: 17px;
    font-weight: normal;
}
.input-group-addon {
    font-weight: bold !important;
   }
.pat-details {
    width: 90%;
    float: left;
}
.per_flat_val #overall_discount_type_radio,.per_flat_val #overall_percent_type {
    width: 27px;
    height: 20px;
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
ul.donate-now.per_flat_val label{
	height: 29px;
	padding: 5px;
	color: #000;
}
.glyphicon-user:before {
    color: #fff;
    
}
.sales-design {
    height: 550px;
    background: #eaeaea;
}
#patient_common_search.placeholder {
    text-align: center;
}
.ss_v.fwidth {
    width: auto !important;
}
.form-group.field-mrnumber,.mr-num {
    position: relative;
    top: -5px;
}
ul.typeahead.dropdown-menu {
    width: 686px;
}
tbody#fetch_update_data tr td{
	padding:7px!important;
    text-transform: uppercase;
}
.field-pat_doctor div.help-block, .field-no_of_items div.help-block,.field-total_sub_total div.help-block, .field-total_net_amount div.help-block, .field-total_gst_amount div.help-block{display:none;}
</style>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body" style="height:600px;">
    <?php $form = ActiveForm::begin(); ?>
	




<div class="inpatientblock  desc" style="position: relative;top: 9px;"> 
						<div class="row">
						<div class="col-sm-3">
						 <div class="form-group col-sm-7 ">
						
                           <div class="input-group add-on fwidth mr-num">
                           		<!--input class="form-control mrn inrefrsh" placeholder="MRN Search" name="mr_number" onkeyup="Patient_details(event)" id="mrnumber" type="text" tabindex="8"-->
								<?= $form->field($main, 'mr_number')->textInput(['required' => true,'class'=>'form-control mrn inrefrsh','placeholder'=>'MRN Search','id'=>'mrnumber',
											'onkeyup'=>'Patient_details(event)'
								])->label(false) ?>
								<div class="ipt input-group-btn fetch_record" value="click" onmousedown="Patient_details(event)">
									<span class="btn btn-default inpatient-details"><i class="glyphicon glyphicon-search"></i></span>
								</div>
								
							</div>
								<span id="mr_validated" style="color: red; display: none;" hidden="">Invalid MR Number</span>
							 <span class="in_pat_validated" style="color: red; display: none;" hidden="">Enter Patient Record</span>
                        </div>
						
						<div class="form-group col-sm-5" style="position: relative;  z-index: 1;    padding: 0;">
							<button type="button" style="float: left;background: #800080 !important;   margin-right: 5px;" class="btn  btn-sm" id="patient_history_detils" onclick="Patient_modal()"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> </button>
						    <!--button type="button" class="btn btn-default btn-sm" id="history_detils">Details</button-->
						
						</div>
						</div>
						
						<div class="col-sm-9">
						 <div class="form-group col-sm-3">
                     
                           <!--input type="text" placeholder="Patient Name" class="form-control text-cap fwidth mrn inrefrsh" name="in_patient" id="pat_name" required readonly=""-->
                          <?= $form->field($main, 'name')->textInput(['placeholder'=>"Patient Name",'required' => true,'readonly'=>true,'class'=>'form-control text-cap fwidth mrn inrefrsh','id'=>'pat_name'])->label(false) ?>
                                 
                        </div>
						 <div class="form-group col-sm-2">
                       
                           <!--input type="text" placeholder="Mobile Number" class="form-control fwidth mrn number phone inrefrsh" name="in_patient_mobile" onkeypress="phoneno()" id="pat_mob" readonly=""-->
                        
                        	<?= $form->field($main, 'ph_number')->textInput(['readonly' => true,'class'=>'form-control fwidth mrn number phone inrefrsh','placeholder'=>'Mobile Number','id'=>'pat_mob'])->label(false) ?>
                        
                        </div>
						<div class="form-group col-sm-3">
                        
                           <div class="input-group fwidth">
                              <span class="ipt input-group-btn">
                                 <select class="btn mrn text-cap" disabled="">
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                              <!--input type="text" placeholder="Doctor Name" class="form-control mrn inrefrsh text-cap" name="in_doctor_name" id="pat_doctor" readonly=""-->
                              
                              <?= $form->field($main, 'physican_name')->textInput(['readonly' => true,'class'=>'form-control mrn inrefrsh text-cap','placeholder'=>'Doctor Name','id'=>'pat_doctor'])->label(false) ?>
                              
                           </div>
                        </div>
						
                        <div class=" form-group col-sm-2">
                        
                             <?= $form->field($main, 'insurance')->dropDownList([],['readonly' => true,'class'=>'form-control fwidth key mrn inrefrsh text-cap','placeholder'=>'Insurance Type','id'=>'pat_insurance'])->label(false) ?>
                           <!--select placeholder="Insurance Type" class="form-control fwidth key mrn inrefrsh text-cap" name="insurance_type" id="pat_insurance" readonly="">
                             
                           </select-->
                        </div>
                        <div class="form-group col-sm-2">
                        
                           <!--input type="text" placeholder="Date of Birth" class="form-control fwidth key mrn inrefrsh" name="date_of_birth" id="pat_dob" readonly=""-->
                           <?= $form->field($main, 'dob')->textInput(['readonly' => true,'class'=>'form-control fwidth key mrn inrefrsh','placeholder'=>'Date of Birth','id'=>'pat_dob'])->label(false) ?>
                        </div>
                        </div>
						
						
						
						</div>
						<br>
					
                        </div>



<?php
	
	$lab_testing=LabTesting::find()->where(['isactive'=>'1'])->asArray()->all();
	$merge_lab_array=array();
	if(!empty($lab_testing))
	{
		foreach ($lab_testing as $key => $value) 
		{
			$merge_lab_array[]=array('value' =>$value['test_name'],'value1' => 'LabTesting_'.$value['autoid']);
		}
	}
	//$productlist_col_val[] = array('value' => $value['productname'].' - '.$comp_index[$value['composition_id']]['composition_name'],'value1' => $value['productid']);
	$testgroup=Testgroup::find()->where(['isactive'=>'1'])->asArray()->all();
	if(!empty($testgroup))
	{
		foreach ($testgroup as $key => $value) 
		{
			$merge_lab_array[]=array('value'=>$value['testgroupname'],'value1' => 'TestGroup_'.$value['autoid']);			
		}
	}
	
	$merge_lab_json = json_encode($merge_lab_array);
?>

<div class=" form-group  col-sm-9" style="margin: auto !important;width: 100%;">
						  <div class=""  style="margin: auto !important;width: 60%;background-color: #ebeff2;padding: 10px;margin-bottom: 15px !important;">
						 	   <input type="text" class="typehead text-cap form-control input-lg fwidth  medienter inrefrsh" placeholder="Enter Lab Name" tabindex="7" id="medicines">
							   <input type="hidden" class="form-control" id="name">      
								 <h5 class="text-center stock_no" style="display: none;"><span style="color:red;font-weight:bold;">No Result Found</span></h5>
						</div>
 </div>

<div class="row">
                  <div class="col-sm-12">
<table class="table table-bordered table-striped" id="tbUser">
                        <thead>
                           <tr rowspan="2">
                             
                              <th rowspan="2" class="text-center">Item</th>
                              <th rowspan="2" class="text-center">Price</th>
                              <th colspan="2" class="text-center">GST(%)</th>
                              <th colspan="2" class="text-center">GST(Amt)</th>
                              <th rowspan="2" class="text-center">Net Amount</th>
                              <th rowspan=" 2" class="text-center">Remove</th>
                           </tr>
                           
                            <tr>                                                                                   
                              <th colspan=" " class="text-center">CGST(%)</th>
                              <th colspan=" " class="text-center">SGST(%)</th>
                               <th colspan=" " class="text-center">CGST(Amt)</th>
                              <th colspan=" " class="text-center">SGST(Amt)</th>                                                                                
                           </tr>
                        	
                        </thead>
                        <tbody id="fetch_update_data">
                          
                        </tbody>
                     </table>
                  </div>
               </div>
			   
			   
			   
			   
			   
			   
			   <div class=" ">
                  <div class="panel panel-border panel-custom total-area">
                     <div class="panel-body" style="padding: 0 5px !important;">
                        <div class="row">
						
						
                           <div class="t-10  col-sm-8">
                              <div class="row">
							     
								 <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"> Items: </label>
										<!--input type="text" class="form-control total_items ansrefrsh" name="total_items" readonly="" id="no_of_items"-->
										<?= $form->field($main, 'overall_item')->textInput(['readonly' => true,'class'=>'form-control total_items ansrefrsh','id'=>'no_of_items'])->label(false) ?>
										<!--input type="hidden" class="form-control total_items ansrefrsh" name="total_items_hidden" id="no_of_items_hidden"-->
									</div>
								 </div>
							  
							    <!--div class="form-group col-sm-1" style="position: relative;left: -16px;">
									<div class="input-group  ">
										<label class="input-group-addon" style="padding: 0 6px;"> Qty: </label>
										<input type="text" style="width: 50px;" class="form-control total_quantity ansrefrsh" name="total_quantity" readonly="" id="total_quantity">
										<input type="hidden" style="width: 50px;" class="form-control total_quantity ansrefrsh" name="total_quantity_hidden" id="total_quantity_hidden">
									</div>
								 </div-->
                                
								  <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon">  GST: </label>
										<!--input type="text" style="width: 75px;" class="form-control total_vat ansrefrsh" name="total_gst" readonly="" id="total_gst_amount"-->
										<?= $form->field($main, 'overall_gst_amt')->textInput(['readonly' => true,'class'=>'form-control total_items ansrefrsh','id'=>'total_gst_amount'])->label(false) ?>
										<!--input type="hidden" style="width: 75px;" class="form-control total_vat ansrefrsh" name="total_gst_hidden" id="total_gst_amount_hidden"-->
									</div>
								 </div>
								 
                               
							  
							   <div class="form-group col-sm-2 ">									<div class="input-group  ">
										
										<label class="input-group-addon" style="    padding: 8px 10px;">Dis Type: </label>
										<!-- <input type="text" class="form-control  over_all_discount_percent number" name='overall_discount_percent'   id="over_all_discount_percent"> -->
									<ul class="donate-now per_flat_val">
										<li>
											<input type="radio" name="overall_discount_type" style="margin-left: 5px;" id="overall_discount_type_radio" value="F" class="btn btn-success overall_disount">
											<label for="flat_discount" style="" class=" text-center testrad">F</label>
										</li>
										<li>
											<input type="radio" id="overall_percent_type" class="btn btn-success overall_disount" value="P" name="overall_discount_type">
											<label for="percent_discount" style="" class="text-center testrad">%</label>	
										</li>
									</ul>
									</div>
								 </div>
								 
								 <div class="form-group col-sm-3" >
									<div class="input-group  ">
										<!-- <label class="input-group-addon"  >Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number" name='total_disc_original'   id="total_discountvalue"> -->
										<label class="input-group-addon">%: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number" name="overall_discount_percent" id="total_discountvaluetype">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number" name="overall_discount_percent_hidden" id="total_discountvaluetype_hidden">
										
										<label class="input-group-addon">Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number" name="total_disc_original" id="total_discountamount">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number" name="total_disc_original_hidden" id="total_discountamount_hidden">
									</div>
								 </div>
								 
								 	
							  
							  
							  
								 <div class="form-group col-sm-3">
									<div class="input-group  ">
										<label class="input-group-addon">Sub.Tot</label>
										<!--input type="text" style="width: 90px;" class="form-control total_sub_total ansrefrsh" name="total_sub_total" readonly="" id="total_sub_total"-->
										<?= $form->field($main, 'overall_sub_total')->textInput(['readonly' => true,'class'=>'form-control total_sub_total ansrefrsh','id'=>'total_sub_total'])->label(false) ?>
										<!--input type="hidden" style="width: 90px;" class="form-control total_sub_total ansrefrsh" name="total_sub_total_hidden" id="total_sub_total_hidden"-->
									</div>
								 </div>
							  
                                </div>
                           </div>
                           <div class="t-10  col-sm-4" style="    right: -24px;">
						   
                           
							  <!-- <div class=" col-sm-1"></div> -->
						  <div class="form-group col-sm-7">
									<div class="input-group  ">
										<label class="input-group-addon bg-primary" style="color:#fff;">Net Amt : </label>
										<!--input type="text" class="form-control total-netamt ansrefrsh bg-primary" name="total_net_amount" style="color: #fff;font-size: 14pt;" readonly="" id="total_net_amount"-->
										<?= $form->field($main, 'overall_net_amt')->textInput(['readonly' => true,'class'=>'form-control total-netamt ansrefrsh bg-primary','id'=>'total_net_amount'])->label(false) ?>
										<!--input type="hidden" class="form-control total-netamt ansrefrsh bg-primary" name="total_net_amount_hidden" style="color: #fff;font-size: 14pt;" id="total_net_amount_hidden"-->
									</div>
								 </div>
							  
							  
							  
                              <div class="form-group col-sm-2">
                                 
                                 <button type="submit" value="save_bill" name="saved_bill" class="btn btn-default btn-sm fwidth ss_v save_billing" data-toggle="tooltip" title="" data-original-title="Save and Submit"><i class="fa fa-save"></i></button>
                                 <i><strong><small>[Alt+s]</small><strong></strong></strong></i><strong><strong>
                              </strong></strong></div><strong><strong>
                              <div class="form-group col-sm-2">
                               
                                 <button type="reset" class="btn btn-warning btn-sm fwidth ss_v remove_all" data-toggle="tooltip" title="" data-original-title="Cancel"><i class="fa fa-close"></i> </button>
                                 <i><strong><small>[Alt+z]</small><strong></strong></strong></i><strong><strong>
                              </strong></strong></div><strong><strong>
                           </strong></strong></strong></strong></div><strong><strong><strong>
                        </strong></strong></strong></div><strong><strong><strong>
                        <br>
                        <div class="row">
                        	<div class="col-sm-1 pull-right print_rules">
                        		
                        	</div>
                        	
                        </div>
                     </strong></strong></strong></div><strong><strong><strong>
                  </strong></strong></strong></div><strong><strong><strong>
               </strong></strong></strong></div>


	
	
	
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
	
	
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
 <script>
 
$("#wrapper").addClass("enlarged");
$("#wrapper").addClass("forced");
$(".list-unstyled").css("display","none");


 var availableTags = <?= $merge_lab_json; ?>;

    $(".typehead").typeahead({

        minLength: 1,
        delay: 5,
  		source: availableTags,
  		autoSelect: true,
 		displayText: function(item)
 		{
 			 return item.value;
 		},
  		afterSelect: function(item) 
  		{
  			$("#name").val(item.value1);
  		} 
	});


	

	
 function Patient_modal()
 {
 	$('#patient_common_search').val('');
 	$('#set_patient_data tr').remove();
 	$modal = $('#patient_hist-modal');
	$modal.modal('show');
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
        	
        	$('#patient_common_search').val('');
		 	$('#set_patient_data tr').remove();
		 	$modal = $('#patient_hist-modal');
			$modal.modal('hide');
        }
    	});
 	 }
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


 $(document).ready(function() 
  {
  	$('.stock_no').hide();
 	$('#medicines').keyup(function(e)
   	{
	 	 var prime_id=$('#name').val();
	 	 var keycode = (e.keyCode ? e.keyCode : e.which);
	 	 if(e.keyCode == 13 && prime_id != '')
	     {
	     	$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::$app->homeUrl . "?r=lab-payment/labset&id=";?>"+prime_id,
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
					  		alert('Data Already Exist');
					  		verify = false;
					  		return false;
					  	}
					});					
					
					if(verify == true)
					{
						$('#fetch_update_data').append(result);
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
        						if(isNaN(parseFloat($('#price_test_lab'+data2).html())))
   								{
        							price=price+0;
        						}
        						else
        						{
        							price=price+parseFloat($('#price_test_lab'+data2).html());
        						}
        						//CGST
        						if(isNaN(parseFloat($('#cgst_amt_lab'+data2).html())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#cgst_amt_lab'+data2).html());	
        						}
        						//SGST
        						if(isNaN(parseFloat($('#sgst_amt_lab'+data2).html())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#sgst_amt_lab'+data2).html());	
        						}
        						
        						
        						//Net Amount
        						if(isNaN(parseFloat($('#net_lab'+data2).html())))
        						{
        							net=net+0;	
        						}
        						else
        						{
        							net=net+parseFloat($('#net_lab'+data2).html());	
        						}
        					}
        					else if(data1 == 'TestGroup')
        					{
        						//Price Amount
        						if(isNaN(parseFloat($('#price_test_group'+data2).html())))
   								{
        							price=price+0;
        						}
        						else
        						{
        							price=price+parseFloat($('#price_test_group'+data2).html());
        						}
        						
								//CGST
        						if(isNaN(parseFloat($('#cgst_amt_test'+data2).html())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#cgst_amt_test'+data2).html());	
        						}
        						//SGST
        						if(isNaN(parseFloat($('#sgst_amt_test'+data2).html())))
        						{
        							gst_amt=gst_amt+0;	
        						}
        						else
        						{
        							gst_amt=gst_amt+parseFloat($('#sgst_amt_test'+data2).html());	
        						}
        						
        						
        						
        						//Net Amount
        						if(isNaN(parseFloat($('#net_test_group'+data2).html())))
        						{
        							net=net+0;	
        						}
        						else
        						{
        							net=net+parseFloat($('#net_test_group'+data2).html());	
        						}
        					}
        					i++;
						});
						
						$('#no_of_items').val(i);
						$('#total_gst_amount').val(gst_amt);
						$('#total_sub_total').val(price);
						$('#total_net_amount').val(net);
						
						
						$('#name').val('');
						$('.stock_no').hide();
						$('#medicines').val('');
						$('#medicines').focus();
						
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
    
    
    $("body").on('click', '.remove', function () 
	{
  		var data_addid = $(this).attr('dataid')
  		
		var data1=data_addid.split("_")[0];
        var data2=data_addid.split("_")[1];
        var item_less=1;
        
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
		
		if(data1 == 'LabTesting')
        {
        	$('#lab_test'+data2).remove();
        }
        else if(data1 == 'TestGroup')
        {
        	$('#test_group'+data2).remove();
        }
  
});

	$("body").on('click', '.remove_all', function ()
    {
    	$("#fetch_update_data tr").remove();
    	window.location.reload(true);
    });
    
    
    $("body").on('click', '.save_billing', function ()
    {
    	$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . "?r=lab-payment/savedata";?>",
	            data: $("#w0").serialize(),
	            success: function (result) 
	            { 
	            	
	            	
	            }
			});
    });

	$(window).keydown(function(event)
	{
	    if(event.keyCode == 13) 
	    {
	      event.preventDefault();
	      return false;
	    }
    });
	
	
   
	
});

 

   
	
  function Patient_details(event)
  {		
  		  if(event.keyCode == 13)
          {
				var mrnumber=$('#mrnumber').val();
				var encodemrnumber=encodeURIComponent(mrnumber);
				if(encodemrnumber != '')
				{
					$.ajax({
						
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchmrnumber&mrnumber=";?>"+encodemrnumber,
				            success: function (result) 
				            { 
				            	if(result == '[]')
				            	{
				            		$('#pat_name').val('');
				            		$('#pat_mob').val('');
				            		$('#pat_doctor').val('');
				            		$('#pat_insurance').val('');
				            		$('#pat_dob').val('');
				            		
				            		$('#mr_validated').delay('fast').fadeIn();
				            		$('#mr_validated').delay(4000).fadeOut();
				            	}
				            	else
				            	{
				            		var obj = $.parseJSON(result);
					            	$('#pat_name').val(obj[0]);
					           		$('#pat_mob').val(obj[1]);
					           		$('#pat_doctor').val(obj[2]);
									
					           		if(obj[3] != '01-01-1970')
					           		{
					           			$('#pat_dob').val(obj[3]);
					           		}
					           		document.getElementById('pat_insurance').innerHTML=obj[4];
					           		$('#medicines').focus();
				            	}
				           	}
				        });
				}
		}
		else if(event.button == 0)
		{
				var mrnumber=$('#mrnumber').val();
				var encodemrnumber=encodeURIComponent(mrnumber);
				if(encodemrnumber != '')
				{
					$.ajax({
						
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchmrnumber&mrnumber=";?>"+encodemrnumber,
				            success: function (result) 
				            { 
				            	if(result == '[]')
				            	{
				            		$('#pat_name').val('');
				            		$('#pat_mob').val('');
				            		$('#pat_doctor').val('');
				            		$('#pat_insurance').val('');
				            		$('#pat_dob').val('');
				            		
				            		$('#mr_validated').delay('fast').fadeIn();
				            		$('#mr_validated').delay(4000).fadeOut();
				            	}
				            	else
				            	{
				            		var obj = $.parseJSON(result);
					            	$('#pat_name').val(obj[0]);
					           		$('#pat_mob').val(obj[1]);
					           		$('#pat_doctor').val(obj[2]);
									
					           		if(obj[3] != '01-01-1970')
					           		{
					           			$('#pat_dob').val(obj[3]);
					           		}
					           		document.getElementById('pat_insurance').innerHTML=obj[4];
					           		$('#medicines').focus();
				            	}
				           	}
				        });
				}
		}
  }
</script>