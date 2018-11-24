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
<link href="<?php echo Url::base(); ?>/validation_plugin/site-demos.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Url::base(); ?>/alert/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/alert/jquery-confirm.min.js"></script>  



<style>


td div.input-group-btn .btn {
    height: 23px!important;
    padding: 3px 12px!important;
}

label.control-label{
	color:#444;
}
.form-group.field-mrnumber ul.typeahead.dropdown-menu {
    width: 146px !important;
    min-width: 146px !important;
}
table.table.table-bordered.table-striped > tbody > tr.exp:nth-of-type(odd) {
   /* background-color: #e01c1c !important; */
   background-color:#f4f4cf !important;
}
ul.typeahead.dropdown-menu a.dropdown-item span.first_gr{
	    margin-right: 51px;
}
.pat-details span {
    padding-right: 5%;
    font-size: 17px;
    font-weight: normal;
}
.input-group-addon {
    font-weight: bold !important;
   }
   
 tbody#fetch_update_data tr td:first-child {
    text-align: left !important;
}
.pat-details {
    width: 90%;
    float: left;
}
ul.typeahead.dropdown-menu a.dropdown-item span:last-child {
    float: right;
}
.per_flat_val #overall_discount_type_radio,.per_flat_val #overall_percent_type {
    width: 27px;
    height: 20px;
}
th.equal_space {
    width: 13%;
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
input#total_paid_amount,input#total_net_amount1 {
   /* font-size: 14px; */
}
#patient_common_search.placeholder {
    text-align: center;
}
.ss_v.fwidth {
    width: auto !important;
}
.form-group.field-mrnumber,.mr-num {
    position: relative;
   /* top: -5px;*/
}
ul.typeahead.dropdown-menu {
    width: 686px;
}
tbody#fetch_update_data tr td{
/*	padding:7px!important;*/
    text-transform: uppercase;
}
.finanical .inner-des label {
    width: 40%;
    float: left;
    text-align: right;
    margin-right: 10px;    margin-bottom: 1px;
}
.finanical .inner-des input{
	text-align:right;
}
.finanical .inner-des input ,.finanical .inner-des textarea {
    width: 55%;
}
.finanical .inner-des label.error {
    width: 100%;
    text-align: right;
}
.form-head {
   /*  background-color: #5fbeaa; */
    background-color: #487397;
    color: #fff;
    width: 18%;
    padding: 0 4px;
}
fieldset.scheduler-border .col-sm-3 {
    min-height: 140px;
}
fieldset.scheduler-border, fieldset.scheduler-border .col-sm-12 {
    padding: 0 !important;
}
fieldset.scheduler-border {
    border: 1px solid #dee6e4 !important;
    
    margin: 0 0 1.5em 0 !important;
}
.finanical {
    padding: 10px;
}
.button-select-re button.btn.btn-success {
    position: relative;
    top: 70px;
}
tbody#fetch_update_data input {
    width: 100%;
     text-align: right;
   }
   
   .form-head {
    font-size: 16px;
}  
   

.field-pat_doctor div.help-block, .field-no_of_items div.help-block,.field-total_sub_total div.help-block, .field-total_net_amount div.help-block, .field-total_gst_amount div.help-block{display:none;}
</style>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body"  >

<div class="inpatientblock  desc" style="position: relative;top: 9px;"> 
						<div class="row">
						<div class="col-sm-3">
						 <div class="form-group col-sm-10 ">
						
                           <div class="input-group add-on fwidth mr-num">
                           		<!--input class="form-control mrn inrefrsh" placeholder="MRN Search" name="mr_number" onkeyup="Patient_details(event)" id="mrnumber" type="text" tabindex="8"-->
								<?= $form->field($main, 'ip_no')->textInput(['required' => true,'class'=>'ipnumber number form-control mrn inrefrsh','placeholder'=>'IP Search','id'=>'ipnumber'])->label('IP Search') ?>
								<?= $form->field($main, 'mr_number')->hiddenInput(['required' => true,'class'=>'mrnumber number form-control mrn inrefrsh','placeholder'=>'MRN Search','id'=>'mrnumber'])->label(false) ?>
								<?= $form->field($main, 'mr_id')->hiddenInput(['required' => true,'class'=>'mrnumber number form-control mrn inrefrsh','placeholder'=>'MRN Search'])->label(false) ?>
								<?= $form->field($main, 'sub_id')->hiddenInput(['required' => true,'class'=>'mrnumber number form-control mrn inrefrsh','placeholder'=>'MRN Search'])->label(false) ?>
								<?= $form->field($main, 'subvisit_num')->hiddenInput(['required' => true,'class'=>'mrnumber number form-control mrn inrefrsh','placeholder'=>'MRN Search'])->label(false) ?>
								
								<input type='hidden' name='HIDDENMRNUMBER' id='hidenmrnumber'>
									<div class="ipt input-group-btn fetch_record" value="click" >
									<span class="btn btn-default inpatient-details patient_fetch_details"  style="position: relative;top:11px;"><i class="glyphicon glyphicon-search"></i></span>
								</div>
								
							</div>
								<span id="mr_validated" style="color: red; display: none;" hidden="">Invalid MR Number</span>
							 <span class="in_pat_validated" style="color: red; display: none;" hidden="">Enter Patient Record</span>
                        </div>
						
						<div class="form-group col-sm-2" style="position: relative;  z-index: 1;    padding: 0;">
							<!--button type="button" style="float: left;background: #800080 !important;   margin-right: 5px;" class="btn  btn-sm" id="patient_history_detils" onclick="Patient_modal()"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> </button-->
							<button type="button" style="float: left;background: #800080 !important;margin-top: 23px;color:#fff;" class="btn  btn-xs" id="patient_history_detils1" onclick="Patientdetails_modal()"> Details  </button>
						    <!--button type="button" class="btn btn-default btn-sm" id="history_detils">Details</button-->
						
						</div>
						</div>
						
						<div class="col-sm-9">
						 <div class="form-group col-sm-3">
                     
                           <!--input type="text" placeholder="Patient Name" class="form-control text-cap fwidth mrn inrefrsh" name="in_patient" id="pat_name" required readonly=""-->
                          <?= $form->field($main, 'name')->textInput(['placeholder'=>"Patient Name",'required' => true,'readonly'=>true,'class'=>'form-control text-cap fwidth mrn inrefrsh','id'=>'pat_name'])->label('Patient Name') ?>
                           
                           
                                 
                        </div>
						 <div class="form-group col-sm-2">
                       
                           <!--input type="text" placeholder="Mobile Number" class="form-control fwidth mrn number phone inrefrsh" name="in_patient_mobile" onkeypress="phoneno()" id="pat_mob" readonly=""-->
                        
                        	<?= $form->field($main, 'ph_number')->textInput(['readonly' => true,'class'=>'form-control fwidth mrn number phone inrefrsh','placeholder'=>'Mobile Number','id'=>'pat_mob'])->label('Mobile Number') ?>
                        
                        </div>
						<div class="form-group col-sm-3">
                        <label class="control-label">Doctor Name</label>
                           <div class="input-group fwidth">
                              <span class="ipt input-group-btn">
                                 <select class="btn mrn text-cap" disabled="">
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                             
                              
                              <?= $form->field($main, 'physican_name')->textInput(['readonly' => true,'class'=>'form-control mrn inrefrsh text-cap','placeholder'=>'Doctor Name','id'=>'pat_doctor'])->label(false) ?>
                              
                           </div>
                        </div>
						
                        <div class=" form-group col-sm-2">
                        
                             <?= $form->field($main, 'insurance')->dropDownList([],['readonly' => true,'class'=>'form-control fwidth key mrn inrefrsh text-cap','placeholder'=>'Insurance Type','id'=>'pat_insurance'])->label('Insurance Type') ?>
                          
                        </div>
                        <div class="form-group col-sm-2">
                        
                           
                           <?= $form->field($main, 'dob')->textInput(['readonly' => true,'class'=>'form-control fwidth key mrn inrefrsh','placeholder'=>'Date of Birth','id'=>'pat_dob'])->label('Date of Birth') ?>
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



</div>	
</div>
</div>
</div>

			<div class="row">
			<div class="col-sm-12">
<div class="panel panel-border ">
<div class="panel-heading">

</div>
<div class="panel-body"  >
         <div class="col-sm-9">
		 <div class=" form-group  col-sm-9" style="margin: auto !important;width: 100%;">
						  <div class=""  style="margin: auto !important;width: 60%;background-color: #ebeff2;padding: 10px;margin-bottom: 3px !important;">
						 	   <input type="text" class="typehead text-cap form-control input-lg fwidth  medienter inrefrsh" placeholder="Enter Lab Name" tabindex="7" id="medicines">
						 	   <span hidden id="already" style="color: red; font-size: 15px; display: none;" hidden="">Data Already Exist</span>
							   <input type="hidden" class="form-control" id="name">      
								 <h5 class="text-center stock_no" style="display: none;"><span style="color:red;font-weight:bold;">No Result Found</span></h5>
						</div>
 </div>
<div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>
		 
<table class="table table-bordered table-striped tbl-scrol" id="tbUser">
                        <thead>
                           <tr rowspan="2">
                             
                              <th rowspan="2" class="text-center" style="width:20% ">Item</th>
                              <th rowspan="2" class="text-center equal_space" style="width:13% ">Price</th>
                              <th colspan="2" class="text-center equal_space" style="width:25% ">GST(%)</th>
                              <th colspan="2" class="text-center equal_space" style="width:29% ">GST(Amt)</th>
                              <th colspan="2" class="text-center equal_space" style="width:22% ">Discount</th>
                              <th rowspan="2" class="text-center equal_space" style="width:12% ">Net Amount</th>
                              <th rowspan="2" class="text-center equal_space" style="width:8%">Remove</th>
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
				  
				  <div class="col-sm-3 billing-right-panel " style="background-color:#ebeff2;">
				   <div class="panel">
				     <div class=" " style="background-color:#ebeff2;">  
					  <table class="table disable-label">
						<tr>
							<th class="col-sm-5">Price</th>
							<td class="col-sm-7"><?= $form->field($main, 'overall_sub_total')->textInput(['readonly' => true,'class'=>' total_sub_total form-control ansrefrsh text-right','id'=>'total_sub_total'])->label(' ') ?></td>							 
						</tr>
						<tr>
							<th>GST</th>
							<td><?= $form->field($main, 'overall_gst_amt')->textInput(['readonly' => true,'class'=>' total_items form-control ansrefrsh text-right','id'=>'total_gst_amount'])->label(' ') ?></td>
						</tr>
						
						<tr>
							<th>Bill Total</th>
							<td>
								<!-- <?= $form->field($main, 'overall_sub_total')->textInput(['readonly' => true,'class'=>'  form-control total_sub_total ansrefrsh text-right','id'=>'total_sub_total'])->label(' ') ?> -->
								<div class="form-group field-total_sub_total">
									<input type="text" id="bill_total" class="  form-control total_sub_total ansrefrsh text-right" name="LabPaymentPrime[bill_total]" readonly="">
								</div>
								
								</td>
						</tr>
						
						<tr>
							<th>Discount</th>
							<td> 
								<div class="input-group">
								  <div class="input-group-btn" data-toggle="buttons">
                                    <label class="inp btn btn-default enable-textbox-percentage" disabled style="padding:3px!important;">
                                       <input type="radio" name="discount" class="enable-textbox-percentage" value="percentage"  autocomplete="off">%
                                    </label>         
                                  </div>
		                          <?= $form->field($main, 'overall_dis_percent')->textInput(['class'=>'form-control w-40 total_sub_total  ansrefrsh number','id'=>'total_discountvaluetype','onkeyup'=>'DiscountPercent(this,event);'])->label('Less Discount(%)') ?>
								  
								  <div class="input-group-btn" data-toggle="buttons">
                                     <label class="inp btn btn-default enable-textbox-flat" disabled style="padding:3px!important;">
                                       <input type="radio" name="discount" class="enable-textbox-flat" value="flat"  autocomplete="off">$
                                     </label>         
                                  </div>
		                          <?= $form->field($main, 'overall_dis_amt')->textInput(['class'=>'form-control total_sub_total  ansrefrsh number','id'=>'total_discountamount','onkeyup'=>'DiscountAmount(this,event);'])->label('Less Disc Amount') ?>
                                 </div> 
							   </td>
						</tr>
 						<tr></tr>
						<tr>
							<th>NET Amount</th>
							<td><?= $form->field($main, 'overall_net_amt')->textInput(['readonly' => true,'class'=>'bg-info1  ansrefrsh form-control text-right','id'=>'total_net_amount','required' => true])->label(' ') ?></td>
						</tr>
						
					 
						
						<tr>
							<th>Paid Amount</th>
							<td><?= $form->field($main, 'overall_paid_amt')->textInput(['required' => true,'class'=>' bg-success1 text-right form-control  ansrefrsh number','onkeyup'=>'PaidAmountCalculation(this,event);','id'=>'total_paid_amount'])->label(' ') ?></td>
						</tr>
						
						
						
						<tr>
							<th>Due Amount</th>
							<td><?= $form->field($main, 'overall_due_amt')->textInput(['readonly' => true,'class'=>'form-control bg-danger1 total-netamt ansrefrsh ','id'=>'total_due_amount'])->label('Due Amount') ?></td>
						</tr>
					  </table>
					   
					  
					  
				  <!-- div class="form-group">
					<label class="">Authority</label>
					    <select class="form-control">
							<option>-Select-</option>
							<option>Dinesh</option>
							<option>Select 1 </option>
							<option>Select 2</option>
						</select>
						<!-- <input type="text" class="form-control Authority ansrefrsh" name="authority" id="authority">
				  </div> --> 

				  <?= $form->field($main,'authority')->dropdownlist($authority_master,['class'=>'form-control cus-fld Authority ansrefrsh','prompt'=>'Select'])->label('Authority')?>


				   <div class="form-group">	
					<label class="">Remarks</label>
						<textarea class="form-control remarks ansrefrsh" style="min-height: 45px;" name="remarks" id="remarks"></textarea>
				  </div>
				  
				  <div class="form-group">
					 <div class="panel">
                       <div class="panel panel-border">
                        <div class="panel-body padding-btns">
                        	<input type="hidden" name="saved_val" id='saved_val'>					   
						 <button type="button" class="btn  btn-sm btn-success save_billing" id='saves_sucess' onclick="SaveLabBill();">Save</button>
						 <button type="button" class="btn  btn-sm btn-warning remove_all">Refresh</button>
						
						 <a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-lab-payment-prime/index" class="btn text-right btn-sm btn-default btn-bk" Title="Back To Grid">Grid </a>

						<button type="button" class="btn   inp btn-sm btn-default remove_all">Close</button>						 
			           </div>
			          </div>
			          </div>
				   </div>
				  
					 
				     <div class="row">
					   <!-- <div class="col-sm-4">
				          <?= $form->field($main, 'overall_item')->textInput(['readonly' => true,'class'=>'form-control   ansrefrsh','id'=>' '])->label('ID') ?>
					    </div>
					    <div class="col-sm-4">
				          <?= $form->field($main, 'overall_item')->textInput(['readonly' => true,'class'=>'form-control total_items ansrefrsh','id'=>'no_of_items'])->label('QTY') ?>
					    </div> -->
						
						<div class="col-sm-4">
							 <?//= $form->field($main, 'overall_sub_total')->textInput(['readonly' => true,'class'=>'form-control total_sub_total ansrefrsh','id'=>'total_sub_total'])->label('Price') ?>
						</div>
					  </div>
					  <div class="row">
					     <div class="col-sm-6">
						      <?//= $form->field($main, 'overall_gst_amt')->textInput(['readonly' => true,'class'=>'form-control total_items ansrefrsh','id'=>'total_gst_amount'])->label('GST') ?>
						 </div>
						 
						 <div class="col-sm-6">
							<?//= $form->field($main, 'overall_sub_total')->textInput(['readonly' => true,'class'=>'form-control total_sub_total ansrefrsh','id'=>'total_sub_total'])->label('Bill Total') ?>
						 </div>
					  
					  </div>
					 
				       <?//= $form->field($main, 'overall_dis_percent')->textInput(['class'=>'form-control total_sub_total ansrefrsh number','id'=>'total_discountvaluetype','onkeyup'=>'DiscountPercent(this,event);'])->label('Less Discount(%)') ?>
				       <?//= $form->field($main, 'overall_dis_amt')->textInput(['class'=>'form-control total_sub_total ansrefrsh number','id'=>'total_discountamount','onkeyup'=>'DiscountAmount(this,event);'])->label('Less Disc Amount') ?>
					   
					   <div class="row">
					     <div class="col-sm-4">
							<?//= $form->field($main, 'overall_net_amt')->textInput(['readonly' => true,'class'=>'form-control total-netamt ansrefrsh ','id'=>'total_net_amount','required' => true])->label('Net Amount') ?>
						 </div>
					     <div class="col-sm-4">
							<?//= $form->field($main, 'overall_paid_amt')->textInput(['required' => true,'class'=>'form-control total-netamt ansrefrsh number','onkeyup'=>'PaidAmountCalculation(this,event);','id'=>'total_paid_amount'])->label('Paid Amount') ?>
						 </div>
						 <div class="col-sm-4">
							<?//= $form->field($main, 'overall_due_amt')->textInput(['readonly' => true,'class'=>'form-control total-netamt ansrefrsh ','id'=>'total_due_amount'])->label('Due Amount') ?>
					     </div>
					    </div>
					</div>
				  </div>
				  </div>
				  </div>
				  </div>
               </div>
			 
			   
	
	
	
	
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

<div id="patient_hist-modal1" class="modal fade" role="dialog">
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

 <div id="load1" style='display:none;text-align: center;position: relative;'><img  style="width:15%;margin:auto;    position: absolute; left: 34%;top: 55px;z-index: 9999;"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>
 
 
    
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
 
 
 
<!-- 
	<div class="row finanical">
			<fieldset class="scheduler-border  ">
			<legend class="scheduler-border form-head">FINANCIAL DETAILS</legend>
		<div class="row">	
			<div class="col-sm-3 patient_details" style="border-right: 1px solid #dee6e4;">
				<div class="inner-des">
					<?//= $form->field($main, 'overall_item')->textInput(['readonly' => true,'class'=>'form-control total_items ansrefrsh','id'=>'no_of_items'])->label('QTY') ?>
					<?//= $form->field($main, 'overall_sub_total')->textInput(['readonly' => true,'class'=>'form-control total_sub_total ansrefrsh','id'=>'total_sub_total'])->label('RATE') ?>
					<!-- <?= $form->field($main, 'overall_item')->textInput(['readonly' => true,'class'=>'form-control total_items ansrefrsh','id'=>'no_of_items_qty'])->label('QTY') ?> 
					<?= $form->field($main, 'overall_sub_total')->textInput(['readonly' => true,'class'=>'form-control total_sub_total ansrefrsh','id'=>'total_sub_total1'])->label('Rate') ?>-->
					<div class="form-group">
						<?//= $form->field($main, 'overall_dis_percent')->textInput(['class'=>'form-control total_sub_total ansrefrsh number','id'=>'total_discountvaluetype','onkeyup'=>'DiscountPercent(this,event);'])->label('Less Discount(%)') ?>
					</div>
					<div class="form-group">
							<?//= $form->field($main, 'overall_dis_amt')->textInput(['class'=>'form-control total_sub_total ansrefrsh number','id'=>'total_discountamount','onkeyup'=>'DiscountAmount(this,event);'])->label('Less Disc Amount') ?>				
					</div>
			<div class="col-sm-3 " style="border-right: 1px solid #dee6e4;">
				<div class="inner-des">
					<?//= $form->field($main, 'overall_net_amt')->textInput(['readonly' => true,'class'=>'form-control total-netamt ansrefrsh ','id'=>'total_net_amount','required' => true])->label('Net Amount') ?>
					<?//= $form->field($main, 'overall_paid_amt')->textInput(['required' => true,'class'=>'form-control total-netamt ansrefrsh number','onkeyup'=>'PaidAmountCalculation(this,event);','id'=>'total_paid_amount'])->label('Paid Amount') ?>
					<?//= $form->field($main, 'overall_due_amt')->textInput(['readonly' => true,'class'=>'form-control total-netamt ansrefrsh ','id'=>'total_due_amount'])->label('Due Amount') ?>
					<div class="form-group">
							<?//= $form->field($main, 'overall_gst_amt')->textInput(['readonly' => true,'class'=>'form-control total_items ansrefrsh','id'=>'total_gst_amount'])->label('GST') ?>
					</div>
					</div>
			</div>
		
<?php ActiveForm::end(); ?>
<script type="text/javascript">
 $(document).ready(function(){
   	$("body").addClass("fixed-left-void");
	$("body").removeClass("fixed-left");
	$("#wrapper").addClass("enlarged");
    $("#wrapper").addClass("forced");   			
    $(".list-unstyled").css("display","none");
  	 
});

</script>
 <script>
 
 
 $('#mrnumber').focus();
 
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
	  
	

	
 function Patient_modal()
 {
 	$('#patient_common_search').val('');
 	$('#set_patient_data tr').remove();
 	$modal = $('#patient_hist-modal');
	$modal.modal('show');
 }

function Patientdetails_modal()
 {
 	
	var mrnumber=$("#mrnumber").val();
	if(mrnumber==""){
		Alertment('Invalid IP NUMBER');		
	}else{
		$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=sales/patientkey1&id=";?>"+mrnumber,
        success: function (result) 
        { 
        	var obj = JSON.parse(result);
			$('#set_patient_data1').html(obj);
			$modal = $('#patient_hist-modal1');
			$modal.modal('show');
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
	 	$("#already").hide();
	 	 var keycode = (e.keyCode ? e.keyCode : e.which);
	 	 if(e.keyCode == 13 && prime_id != '')
	     {
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
						// $('#total_paid_amount').val(net);
						// $('#total_due_amount').val();
					var insurance=$("#pat_insurance").val();
						
						if(insurance=="UCIL" || insurance=="Aarogyasri" ){
							$('#total_paid_amount').attr('readonly','readonly');
							$('#total_paid_amount').val('0');
							$('#total_due_amount').val(net);
						}else {
							
							$('#total_paid_amount').val(net);
							$('#total_due_amount').val('0');
							
						}
						
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
    	$("#saved_val").val('');
    	$("#saves_sucess").removeAttr("disabled");
    	cleartxt();
    	clearhead();
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

	
$(".ipnumber").typeahead({
  
  source: function(query,result) {
        $.ajax({
          url:'<?php echo Yii::$app->homeUrl . "?r=in-lab-payment-prime/ajaxipnumber";?>',
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
          url:'<?php echo Yii::$app->homeUrl . "?r=in-lab-payment-prime/ajaxipnumberselectblockipentries&id=";?>'+result,
          method:'POST',
          dataType:'json',
          success:function(data)
          {   $('#load1').hide();
             	 
	  			 
	  				$('#pat_name').val(data[0]['patient_name']);
	  				$('#pat_mob').val(data[0]['mobile_no']); 
	  				$('#mrnumber').val(data[0]['mr_no']); 
	  				 
	  				$('#pat_doctor').val(data[1]['physician_name']);
           			 
            
	  				if(data[0]['insurance_type'] !== '' || data[0]['insurance_type'] !== null)
	  				{
	  					if(data[4] !== null)
	  					{
	  						$('#pat_insurance').html('<option value='+data[4]+'>'+data[4]+'</option>');
	  					}
	  					else if(data[4] === null)
	  					{
	  						$('#pat_insurance').html('');
	  					}
	  				}
	  				else
	  				{
	  					$('#pat_insurance').html('');
	  				}
	  				$('#pat_dob').val(formatDate(data[0]['dob']));
	  				
	  				
	  				$('#hidenmrnumber').val(result)
	  				
	  				$('#load1').hide();
	  				$("#fetch_update_data tr").remove();
    				$("#saved_val").val('');
    				cleartxt();
	  				
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



function DiscountPercent(data,event)
{
	$('#total_due_amount').val('');
	var tbl_len=$('#fetch_update_data tr').length;
	if(tbl_len !== 0)
	{
		var percentage=data.value;
		
		if(percentage <= 100)
		{
			OverallDiscountPercentage(percentage);
			$('#total_discountvaluetype').val(percentage);
		}
		else if(percentage > 100)
		{
			percentage=100;
			OverallDiscountPercentage(percentage);
			$('#total_discountvaluetype').val(percentage);
			Alertment('Discount Percent Not More Than 100%');
		}
	}
	else
	{
		$('#total_discountvaluetype').val('');
		Alertment('No Test Row Added');
	}
}
//Discount Percent procedure

function DiscountPercentProcedure(discount_per,event)
{
	$('#total_due_amount').val('');
	var tbl_len=$('#fetch_update_data tr').length;
	if(tbl_len !== 0)
	{
		var percentage=discount_per;
		
		if(percentage <= 100)
		{
			OverallDiscountPercentage(percentage);
			$('#total_discountvaluetype').val(percentage);
		}
		else if(percentage > 100)
		{
			percentage=100;
			OverallDiscountPercentage(percentage);
			$('#total_discountvaluetype').val(percentage);
			Alertment('Discount Percent Not More Than 100%');
		}
	}
	else
	{
		$('#total_discountvaluetype').val('');
		Alertment('No Test Row Added');
	}
}


function DefaultAmount()
{
	var net_hidden_amount=[];
	$(".calculation").each(function() 
	{
		var data_addid=$(this).attr('dataid');
	  	var data1=data_addid.split("_")[0];
		var data2=data_addid.split("_")[1];
		
		if(data1 == 'LabTesting')
		{
			var hiden_amt=parseFloat($('#net_lab_hidden'+data2).val());
			
			if(!isNaN(hiden_amt))
			{
				net_hidden_amount.push(hiden_amt);
			}
			
		}
		else if(data1 == 'TestGroup')
		{
			var hiden_amt=parseFloat($('#net_test_group_hidden'+data2).val());
			
			if(!isNaN(hiden_amt))
			{
				net_hidden_amount.push(hiden_amt);
			}
		}
		else if(data1 == 'MasterGroup')
		{
			var hiden_amt=parseFloat($('#net_test_master_hidden'+data2).val());
			
			if(!isNaN(hiden_amt))
			{
				net_hidden_amount.push(hiden_amt);
			}
		}
	});
	var amt=net_hidden_amount.reduce((a, b) => a + b, 0);
	return amt;
}


function DiscountAmount(data,event)
{
	$('#total_due_amount').val('');
	var tbl_len=$('#fetch_update_data tr').length;
	
	var overall_amount=DefaultAmount();
	if(tbl_len !== 0)
	{
		var amount=data.value;
		
		if(amount <= overall_amount)
		{
			OverallDiscountAmount(amount,overall_amount);
			$('#total_discountamount').val(amount);
		}
		else if(amount > overall_amount)
		{
			amount=overall_amount;
			
			OverallDiscountAmount(amount,overall_amount);
			$('#total_discountamount').val(amount);
			Alertment('Net Amount Not More Than Discount Amount');
		}
	}
	else
	{
		$('#total_discountamount').val('');
		Alertment('No Test Row Added');
	}
}


function OverallDiscountPercentage(percentage)
{
	var netamount=[];
	var paidamount=[];
	var discount_percent=[];
	var discount_amount=[];
	$(".calculation").each(function() 
	{
		var data_addid=$(this).attr('dataid');
	  	var data1=data_addid.split("_")[0];
		var data2=data_addid.split("_")[1];
		
		if(data1 == 'LabTesting')
		{
			var hidden_amt=parseFloat($('#net_lab_hidden'+data2).val());
			if(!isNaN(hidden_amt))
			{
				var disc_amt=parseFloat((hidden_amt*percentage)/100);
				var subtraction_amount=parseFloat(hidden_amt-disc_amt);
				
				netamount.push(subtraction_amount);
				discount_amount.push(disc_amt);
				$('#net_lab'+data2).val(subtraction_amount.toFixed(2));
				$('#discount_amount_lab'+data2).val(disc_amt.toFixed(2));
				$('#discount_percent_lab'+data2).val(percentage);
			}
		}
		else if(data1 == 'TestGroup')
		{
			var hidden_amt=parseFloat($('#net_test_group_hidden'+data2).val());
			if(!isNaN(hidden_amt))
			{
				var disc_amt=parseFloat((hidden_amt*percentage)/100);
				var subtraction_amount=parseFloat(hidden_amt-disc_amt);
				
				netamount.push(subtraction_amount);
				discount_amount.push(disc_amt);
				$('#net_test_group'+data2).val(subtraction_amount.toFixed(2));
				$('#discount_amount_test'+data2).val(disc_amt.toFixed(2));
				$('#discount_percent_test'+data2).val(percentage);
			}
		}
		else if(data1 == 'MasterGroup')
		{
			var hidden_amt=parseFloat($('#net_test_master_hidden'+data2).val());
			if(!isNaN(hidden_amt))
			{
				var disc_amt=parseFloat((hidden_amt*percentage)/100);
				var subtraction_amount=parseFloat(hidden_amt-disc_amt);
				
				netamount.push(subtraction_amount);
				discount_amount.push(disc_amt);
				$('#net_master_group'+data2).val(subtraction_amount.toFixed(2));
				$('#discount_amount_master'+data2).val(disc_amt.toFixed(2));
				$('#discount_percent_master'+data2).val(percentage);
			}
		}
	});
	
	var overall_amount=netamount.reduce((a, b) => a + b, 0);
	var overall_discount_amount=discount_amount.reduce((a, b) => a + b, 0);
	
	
	$('#total_net_amount').val(overall_amount.toFixed(2));
	$('#total_paid_amount').val(overall_amount.toFixed(2));
	$('#total_discountamount').val(overall_discount_amount.toFixed(2));
	
}


function OverallDiscountAmount(amount,overall_amount)
{
	var netamount=[];
	var paidamount=[];
	var discount_percent=[];
	var discount_amount=[];
	
	var percentage_flat=parseFloat((amount*100)/overall_amount);
	
	$(".calculation").each(function() 
	{
		var data_addid=$(this).attr('dataid');
	  	var data1=data_addid.split("_")[0];
		var data2=data_addid.split("_")[1];
		
		if(data1 == 'LabTesting')
		{
			var hidden_amt=parseFloat($('#net_lab_hidden'+data2).val());
			if(!isNaN(hidden_amt))
			{
				var cal=parseFloat((hidden_amt*percentage_flat)/100);
				var per=parseFloat(cal*100/overall_amount);
				var hiden_amt_disc=hidden_amt-cal;
				
				netamount.push(hiden_amt_disc);
				discount_percent.push(per);
				$('#discount_percent_lab'+data2).val(per.toFixed(2));
				$('#discount_amount_lab'+data2).val(cal.toFixed(2));
				$('#net_lab'+data2).val(hiden_amt_disc.toFixed(2));
			}
		}
		else if(data1 == 'TestGroup')
		{
			var hidden_amt=parseFloat($('#net_test_group_hidden'+data2).val());
			if(!isNaN(hidden_amt))
			{
				var cal=parseFloat((hidden_amt*percentage_flat)/100);
				var per=parseFloat(cal*100/overall_amount);
				var hiden_amt_disc=hidden_amt-cal;
				
				netamount.push(hiden_amt_disc);
				discount_percent.push(per);
				$('#discount_percent_test'+data2).val(per.toFixed(2));
				$('#discount_amount_test'+data2).val(cal.toFixed(2));
				$('#net_test_group'+data2).val(hiden_amt_disc.toFixed(2));
			}
		}
		else if(data1 == 'MasterGroup')
		{
			var hidden_amt=parseFloat($('#net_test_master_hidden'+data2).val());
			if(!isNaN(hidden_amt))
			{
				var cal=parseFloat((hidden_amt*percentage_flat)/100);
				var per=parseFloat(cal*100/overall_amount);
				var hiden_amt_disc=hidden_amt-cal;
				
				netamount.push(hiden_amt_disc);
				discount_percent.push(per);
				$('#discount_percent_master'+data2).val(per.toFixed(2));
				$('#discount_amount_master'+data2).val(cal.toFixed(2));
				$('#net_master_group'+data2).val(hiden_amt_disc.toFixed(2));
			}
		}
	});
	
	var overall_amount=netamount.reduce((a, b) => a + b, 0);
	var overall_discount_percent=discount_percent.reduce((a, b) => a + b, 0);
	
	$('#total_net_amount').val(overall_amount.toFixed(2));
	$('#total_paid_amount').val(overall_amount.toFixed(2));
	$('#total_discountvaluetype').val(overall_discount_percent.toFixed(2));
	
}


$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            var  saved_val = $("#saved_val").val();
              if(saved_val==""){
           			SaveLabBill();
           			onetimesave=2;
           		}else{
           			alert('Already Saved ..!');
           		}
           	//SaveLabBill();
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


function PaidAmountCalculation(data,event) 
{
	var paid_amount=data.value;
	var overall_net_amount=DefaultAmount();
	var grid_length=$("#fetch_update_data tr").length;
	
	$('#total_discountvaluetype').val('');
	$('#total_discountamount').val('');
	
	$(".calculation").each(function() 
	{
		var data_addid=$(this).attr('dataid');
	  	var data1=data_addid.split("_")[0];
		var data2=data_addid.split("_")[1];
		if(data1 == 'LabTesting')
		{
			var hidden_amt=parseFloat($('#net_lab_hidden'+data2).val());
			$('#net_lab'+data2).val(hidden_amt);
		}
		else if(data1 == 'TestGroup')
		{
			var hidden_amt=parseFloat($('#net_test_group_hidden'+data2).val());
			$('#net_test_group1'+data2).val(hidden_amt);
		}
		else if(data1 == 'MasterGroup')
		{
			var hidden_amt=parseFloat($('#net_test_master_hidden'+data2).val());
			$('#input#net_master_group'+data2).val(hidden_amt);
		}
				
	});
	
	if(grid_length !== 0)
	{
		if(paid_amount !== '')
		{
			if(overall_net_amount < paid_amount)
			{
				$('#total_paid_amount').val(overall_net_amount);
				$('#total_due_amount').val('');   
				Alertment('Net Amount Not Greater Than Paid Amount');
			}
			else
			{
			   var calculation=	overall_net_amount - paid_amount;
			   $('#total_net_amount').val(overall_net_amount.toFixed(2));
			   $('#total_due_amount').val(calculation.toFixed(2));   
			}
		}
		else if(paid_amount === '')
		{
			 $('#total_paid_amount').val(overall_net_amount);
			 $('#total_due_amount').val('');   
		}
	}
	else
	{
		$('#total_paid_amount').val('');
		Alertment('No Test To Be Add');
	}
		
}

function SaveLabBill() 
{
	var discount_percent=$('#total_discountvaluetype').val();
 	var discount_amount=$('#total_discountamount').val();
 	
 	if(discount_percent !== '' && discount_amount !== '')
 	{
 		$('.remarks').attr('required','required');
 		$('.Authority').attr('required','required');
 	}
 	else if(discount_percent === '' && discount_amount === '')
 	{
 		$('.remarks').removeAttr('required','required');
 		$('.Authority').removeAttr('required','required');
 	}
 	
 	var valid=$("#w0").valid();  
	if(valid == true)
	{
   if (confirm('Are You Sure to Save ?')) {
		$('#load1').show();
	  	$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . "?r=in-lab-payment-prime/create";?>",
	            data: $("#w0").serialize(),
	            success: function (result) 
	            { 
	            	obj=$.parseJSON(result);
	            	$('#load1').hide();
	            	if(result === 'N')
	            	{
	            		Alertment('Invalid IP Number');
	            	}
	            	else
	            	{
	            		$("#saved_val").val(obj[2]);
	            		$('#saves_sucess').attr('disabled','disabled');
	            		//Alertment('Lab Register Number is '+result);
	            		var url='<?php echo Yii::$app->homeUrl ?>?r=in-lab-payment-prime/billreport&id='+obj[1];
		 				window.open(url,'_blank');
		 				Alertment('Lab Register Number is '+obj[0]);
	            	}
	            }
	     });
	  }
	}
}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		jtable_pd();
		
	   $('#total_discountvaluetype').click(function() {  	 	 
		 $(".enable-textbox-percentage").addClass('active');
         $(".enable-textbox-flat").removeClass('active');		 
       });
	   
	   $('#total_discountamount').click(function() { 	     
         $(".enable-textbox-flat").addClass('active');
         $(".enable-textbox-percentage").removeClass('active');		 
       });
	   
	});
	
	
/** Ip Data table **/	
$("body").on('click', '.patient_fetch_details', function ()
{
	$modal = $('#patient_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#reg_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
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
   
function PatientDetailsFetch(data)
{
	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=in-lab-payment-prime/ajaxipnumberselectblockipentriesdata&id=";?>"+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        
        	/*if(obj[2]=="null"){
        		var insurance='<option>-</option>';
        	}else{
        		var insurance='<option value='+obj[2]+'>'+obj[2]+'</option>';	
        	}
        	alert(insurance);*/
        		if(obj[0]['insurance_type'] !== '' || obj[0]['insurance_type'] !== null)
	  				{
	  					if(obj[2] !== null)
	  					{
	  						$('#pat_insurance').html('<option value='+obj[2]+'>'+obj[2]+'</option>');
	  					}
	  					else if(obj[2] === null)
	  					{
	  						$('#pat_insurance').html('');
	  					}
	  				}
	  				else
	  				{
	  					$('#pat_insurance').html('');
	  				}
	  				
        	
        	$('#ipnumber').val(obj[0]['ip_no']);
        	$('#pat_name').val(obj[0]['patient_name']);
        	$('#pat_dob').val(formatDate(obj[0]['dob']));
        //	$('#intreatmentoverall-gender').val(obj[0]['sex']);
        		$('#pat_doctor').val(obj[4]['physician_name']);
        	//$('#pat_insurance').html(insurance);
        	
        	$('#pat_mob').val(obj[0]['mobile_no']);
        	
        
        	
        	$modal = $('#patient_details');
        	$modal.modal('hide');
        }
	});
}

function clearhead (argument) {
  $('#mrnumber').val('');
  $('#pat_name').val('');
  $('#pat_mob').val('');
  $('#pat_doctor').val('');
  $('#pat_insurance').val('');
  $('#pat_dob').val('');
  $('#medicines').val('');
  
}

function cleartxt (argument) {
  $('#total_gst_amount').val('');
  $('#total_sub_total').val('');
  $('#bill_total').val('');
  $('#total_discountvaluetype').val('');
  $('#total_discountamount').val('');
  $('#total_net_amount').val('');
  $('#total_paid_amount').val('');
  $('#total_due_amount').val('');
  $('#labpaymentprime-authority').val('');
  $('#remarks').val('');
  
}
	
	$("body").on('click', '.remove_all', function ()
    {
    	
    	$("#fetch_update_data tr").remove();
    	$("#saved_val").val('');
    	$("#saves_sucess").removeAttr("disabled");
    	cleartxt();
    	clearhead();
    	
    });
     
</script>


 


