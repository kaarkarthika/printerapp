<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\TreatmentOverall */
/* @var $form yii\widgets\ActiveForm */


/*if(!empty($subvisit_map))
{
	$mr_col_json=array();
	foreach ($subvisit_map as $key => $value) 
	{
		$mr_col_json[]=array('subnumber'=>$key,'mrnumber'=>$value);	
	}
	$mr_col_json=json_encode($mr_col_json);
}*/

if(!empty($treatment))
{
	$treatment_json=array();
	foreach ($treatment as $key => $value) 
	{
		$treatment_json[]=array('treatid'=>$value['id'],'treatment_name'=>$value['treatment_name'] .'-'. $value['code'],'amount'=>$value['amount'],'hsn'=>$value['hsn_code']);
	}
	$treatment_json=json_encode($treatment_json);
}
?>
  <style>
  	.date_show {
    border: 1px solid #eaeaea;
    padding: 30px 15px 15px 15px;
    margin-top: 30px;
    right: 20px;
}
.dis_remark{
	    position: relative;
    left: 15px;
}
  	.date_show>span {
    position: absolute;
    top: -10px;
    background: #f98585;
    padding: 4px 10px;
    color: #ffff;
}

.error{
	color: red !important;
}
  </style>  
 
<link href="<?php echo Url::base(); ?>/validation_plugin/site-demos.css" rel="stylesheet" type="text/css" />  
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>  
 
<link href="<?php echo Url::base(); ?>/css/billing.css" rel="stylesheet" type="text/css" />

<style>

td div.input-group-btn .btn {
    height: 23px!important;
    padding: 3px 12px!important;
}
/*.panel-border .panel-body {
    padding: 0px 0px !important;
}*/
</style>


<style>


table.table.table-bordered.table-striped > tbody > tr.exp:nth-of-type(odd) {
   /* background-color: #e01c1c !important; */
   background-color:#f4f4cf !important;
}
input#treatmentoverall-overall_due_amount{
	text-align: right;
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
   /* height: 550px; */
    background: #eaeaea;
}
#patient_common_search.placeholder {
    text-align: center;
}
.ss_v.fwidth {
    width: auto !important;
}

.panel.panel-border.panel-custom.home-body {
    /* min-height: 510px; */
}
</style>
<style>
.panel-border .panel-body form {
    /* height: 150px; */
    width: 100% !important;
}
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
	  fieldset.scheduler-border {
    border: 1px solid #dee6e4 !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 0.5em 0 !important;
   /* -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;*/
}

    legend.scheduler-border {
        font-size:12px;
        font-weight:normal;
        text-align: left !important;
        width:auto;
        padding:5px;
        border-bottom:none;
    }
	legend{
		margin-bottom:0;
	}
	.form-head{background-color: #487397;
    color: #fff;}
 .cus-fld{
height: 25px !important;
    margin-right: 15px;
    margin-bottom: 10px;
    padding: 0px 10px;
 }
	.inpatientblock fieldset .col-md-2 {
    padding: 0 3px;
    width: 140px;
    float: left;
}

.inpatientblock fieldset .col-md-2.width-inc{
	width: 160px;
}
.inpatientblock fieldset {
    padding: 4px 0 !important;
}
.table-bordered .table-bordered td,.table-bordered th,.inpatientblock.desc fieldset.scheduler-border {
    /* border: 1px solid #a3a1a1 !important; */
}input.form-control{
	/* border: 1px solid #a3a1a1 !important; */
}
.form-group label {
    color: #444;
}

fieldset.scheduler-border,fieldset.scheduler-border .col-sm-12 {
    padding: 0 !important;
}
.panel-border .panel-body{
	/* padding: 18px 8px !important; */
}
fieldset.scheduler-border .col-md-2 {
    width: 15%;
}
.inpatient-details i.glyphicon.glyphicon-search {
    top: 4px!important;
}
.form-group.field-treatmentindividual-treatment_id ul.typeahead.dropdown-menu{
    min-width: 150px !important;
    width: 253px;
    padding: 0 0;
}

ul.typeahead.dropdown-menu{
	    min-width: 125px !important;
    width: 125px;
    padding: 0 0;
}

ul.typeahead.dropdown-menu li a.dropdown-item {
    font-size: 12px;
    padding: 1px 11px;
}

ul.typeahead.dropdown-menu li.active{
		background:#eee!important;
}

input#treatmentindividual-rate, input#treatmentindividual-qty {
    text-align: right;
}
.dataTables_scrollHeadInner,.dataTables_scrollHeadInner table.table.table-striped {
    width: 100% !important;
}


.patient_details .inner-des {
    padding: 0 10px;
}
.button-select button {
    margin: 3px 0;     width: 100%;
}
.button-select {
    margin: 30px 0;
}

.finanical .inner-des input{
	text-align:right;
}

.finanical .inner-des input ,.finanical .inner-des textarea {
    width: 55%;
}
input#treatmentoverall-discount_authority {
    text-align: left !important;
}
.finanical {
    
    padding: 10px;
    
}

.form-group.field-treatmentoverall-remarks textarea {
    height: 60px !important;
    min-height: 50px !important;
}
.finanical .inner-des label.control-label {
    width: 40%;
    float: left;
    text-align: right;
    margin-right: 10px;    margin-bottom: 1px;
}

.button-select-re button.btn.btn-success {
    position: relative;
    top: 53px;
}
.inner-des label.error {
    width: 100%;
    text-align: right;
}
.bk-btn{
	background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
}
/*.btn-group-sm>.btn, .btn-sm {
padding: 1px 5px;
font-size: 12px;
}*/
.ip-btn-style{border:1px solid  #cccccc; }
</style>
<!-- 
<div class="row col-sm-12">
<div class="col-sm-6">

<h4 class="page-title"> <?//= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
<li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
<li><a href="#"><?php echo 'Treatment Overall';?></a></li>
</ol>
</div>
<div class="col-sm-6 text-right ">
	<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=treatment-overall/index" class="btn text-right bk-btn btn-default" Title="Back To Grid">Back to Grid </a> 
</div>
</div> -->

 <?php $form = ActiveForm::begin(); ?>
 <div class="container">
<div class="row  ">
    <div class="col-sm-12">
      <div class="panel panel-border panel-custom">
        <div class="panel-heading"></div>
      <div class="panel-body panel-padding">
    	  <div class=" treatment-overall-form">
	 		<div class="row">
				<div class='col-sm-2'>




          
				 <!--  <div class="form-group col-sm-10 ">
                    <div class="input-group add-on fwidth mr-num" style="position:relative;bottom:10px;">
					  <div class="form-group field-mrnumber has-success">
						 <?php //= $form->field($model, 'mrnumber')->textInput(['class'=>'mrnumber form-control cus-fld number','required' => true,'onkeypress'=>'MRNUMBER(this,event);'])->label('MR NO') ?>
						 <input type="hidden" id="pat_id" name="PATID">
						 <input type="hidden" id="subvisit_id" name="SUBVISITID">
						 <input type="hidden" id="subvisit_number" name="SUBVISITNUMBER">
						 <input type="hidden" id="hidden_mr_number" name="HIDDENMRNUMBER">
					  	 <div class="help-block"></div>
					  </div>
					  <div class="ipt input-group-btn fetch_record" value="click" onmousedown="Patient_details()">
						<span class="btn btn-default inpatient-details" style="position: relative;top: 16px;left: 0px;height: 25px!important;padding: 0px 6px!important;"><i class="glyphicon glyphicon-search"></i></span>
					  </div>	
					</div>					
   			      </div>  -->


                   <div class="form-group col-sm-9">
						   <label class="control-label">MR NO</label><br>  
						   <div class="input-group input-group-sm add-on mr-num">	   
							     <div class="field-mrnumber has-success"> 
								  <?= $form->field($model, 'mrnumber')->textInput(['class'=>'mrnumber ip-btn-style cus-fld number','required' => true,'onkeypress'=>'MRNUMBER(this,event);'])->label(false) ?>
						           <input type="hidden" id="pat_id" name="PATID">
						           <input type="hidden" id="subvisit_id" name="SUBVISITID">
						           <input type="hidden" id="subvisit_number" name="SUBVISITNUMBER">
						           <input type="hidden" id="hidden_mr_number" name="HIDDENMRNUMBER">
						   	      </div>
							   <span class="ipt input-group-btn fetch_record" value="click" onmousedown="Patient_details()" >
							      <button type="button" class="btn inp btn-default btn-flat btn patient_fetch_details "><i class="ssearch glyphicon glyphicon-search"></i></button>
							    </span>
						   </div>
						    <span id="mr_validated" style="color: red; display: none;" hidden="">Invalid MR Number</span>
                              <span class="in_pat_validated" style="color: red; display: none;" hidden="">Enter Patient Record</span>
                           </div>
				  <div class='col-sm-3'>
					<label style="visibility: hidden">MRNUMBER </label>
   				    <button type="button" style="float: left;margin-right: 5px; color:#fff;" class="btn btn-xs btn-detail"   id="patient_history_detils1" onclick="Patientdetails_modal1()">  Details  </button>
   			      </div>
   			    </div>
   			    <div class='col-sm-9'>
   			       <div class='col-md-2'>
    			       <div class="form-group">
        			      <?= $form->field($model, 'name')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required' => true])->label('PAT NAME') ?>
      			       </div>
   			       </div>
   			      <div class='col-md-2 width-inc'>
    			       <div class="form-group">
        			      <?= $form->field($model, 'dob')->textInput(['class'=>'form-control cus-fld','readonly' => true])->label('DOB') ?>
				       </div>
   			      </div>
   			
   			      <div class='col-md-2'>
    			     <div class="form-group">	
            		     <?= $form->field($model, 'gender')->dropDownList([],['class'=>'form-control  cus-fld ','readonly' => true]) ?>
				     </div>
   			      </div>
   			      <div class='col-md-2 width-inc'>
        			<?= $form->field($model, 'insurancetype')->dropDownList([''],['class'=>'form-control cus-fld','readonly' => true])->label('INSURANCE') ?>
   			      </div>
   			      <div class='col-md-2'>
    			    <div class="form-group">
        			 <?= $form->field($newpatient, 'par_relationname')->textInput(['class'=>'form-control cus-fld','readonly' => true])->label('RELATION') ?>
				    </div>
   			      </div>
   			    </div>  			
   		    </div>
   		   </div>
   		</div>
   	  </div>
   	</div>
   
		
	<div class="col-sm-12" style="padding-top: 3px;">
      <div class="panel panel-border panel-custom">
           <div class="panel-heading"></div>
        <div class="panel-body panel-padding">
    	  <div class=" row">
		    <div class="col-sm-12">
		      <div class="inpatientblock  desc"> 
	 		    <div class="col-sm-12" style="padding:5px 0!important;">
	 		      <div class='col-md-3 width-inc'>
    			     <div class="form-group">
        			   <?= $form->field($treatmentindividual, 'treatment_id')->textInput(['class'=>'form-control cus-fld procedures','onkeyup'=>'EmptyESC(this,event);'])->label('PROCEDURES') ?>
					   <input type="hidden" id="treatment_id" name="treatment">
				      </div>
   			       </div>
   			       <div class='col-md-1'>
    			     <div class="form-group">
        			    <?= $form->field($treatmentindividual, 'rate')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'RateCalCulation(this,event);'])->label('RATE') ?>
				     </div>
   			       </div>
   			       <div class='col-md-1'>
    			     <div class="form-group">
        			    <?= $form->field($treatmentindividual, 'qty')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'QtyCalCulation(this,event);'])->label('QTY') ?>
				     </div>
   			       </div>
   			       <div class='col-md-1'>
    			     <div class="form-group">
        			   <?= $form->field($treatmentindividual, 'gstpercent')->textInput(['class'=>'form-control cus-fld number','readonly'=>true])->label('GST(%)') ?>
				     </div>
   			        </div>
   			        <div class='col-md-1'>
    			      <div class="form-group">
        		  	    <?= $form->field($treatmentindividual, 'gstvalue')->textInput(['class'=>'form-control cus-fld number','readonly'=>true])->label('GST(AMT)') ?>
				      </div>
   			        </div>
   			        <div class='col-md-1'>
    			      <div class="form-group">
        			    <?= $form->field($treatmentindividual, 'mrp')->textInput(['class'=>'form-control cus-fld','readonly'=>true])->label('Total AMT') ?>
				      </div>
   			        </div>
   			        <div class='col-md-1'>
    			      <div class="form-group">
        			    <?= $form->field($treatmentindividual, 'total_price')->textInput(['class'=>'form-control cus-fld','readonly'=>true])->label('NET AMT') ?>
				      </div>
   			        </div>
   			
   			        <div class='col-md-1'>
    			      <div class="form-group">
    				    <label style="visibility:hidden;width:100%;">Button</label>
        			    <button type="button" id='add_to_grid' onclick='AddToGrid();' title='Add To Grid' class='add_to_grid btn btn-primary btn-xs'><i class="fa fa-plus"></i> <b>Add</b></button>
				      </div>
   			        </div>
   		        </div>
		      </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	<div id="load1" style='display:none;text-align: center;'><img  class="load-image" src="<?= Url::to('@web/loader1.gif') ?>" /></div>
    <div class="col-sm-12">
	<div class="panel panel-border ">
	  <div class="panel-heading"></div>
      <div class="panel-body"  >
        <div class="col-sm-9">
          <table class="table table-bordered table-striped tbl-scrol" id="tbUser" style="margin-top:20px;">
            <thead>
              <tr>
                <th rowspan="2" class="text-center hide">#</th>
                <th rowspan="2" class="text-center"style="width:18%;">PROCEDURE NAME</th>
                <th rowspan="2" class="text-center">RATE</th>
                <th rowspan="2" class="text-center">QTY</th>
                <th rowspan="2" class="text-center">TAXABLE <br/> AMOUNT </th>
                <th colspan="2" class="text-center">GST(%)</th>
                <th colspan="2" class="text-center">GST(AMT)</th>
                <th colspan="2" class="text-center">Discount</th>
                <th rowspan="2" class="text-center">Total</th>
                <th rowspan="2" class="text-center">Remove</th>
              </tr>
              <tr>
                <th class="text-center">CGST </th>
                <th  class="text-center">SGST </th>
                <th class="text-center">CGST </th>
                <th class="text-center">SGST </th>
                <th class="text-center">DIS(%)</th>
                <th class="text-center" >DIS(Amt)</th>
              </tr>
            </thead>
            <tbody id='fetch_update_data'>  
            </tbody>
          </table>
         </div>
		 <div class="col-sm-3 bg-div billing-right-panel">
		   <div class="panel bg-div">
		      <table class="table disable-label">
			     <tr>
					<th class="col-sm-5">Price</th>
					<td class="col-sm-7"><?= $form->field($model, 'overall_sub_total')->textInput(['class'=>'form-control cus-fld text-right','readonly' => true,'required'=>true])->label('Rate') ?> </td>							 
				 </tr>
				 <tr>
					<th>GST</th>
					<td><?= $form->field($model, 'totalgstvalue')->textInput(['class'=>'form-control cus-fld text-right','readonly' => true,'required'=>true])->label('GST(AMT)') ?></td>
			     </tr>	
				 <tr>
					<th>Bill Total</th>
					<td><input type="text" class="form-control text-right " name="bill total" id="tre_bill_total"></td>
				 </tr>
				 
				 <tr>
				  <th>Discount</th>
					<td> 
					  <div class="input-group">
						<div class="input-group-btn" data-toggle="buttons">
                          <label class="inp btn btn-default enable-textbox-percentage" disabled style="padding:3px!important;">
                           <input type="radio" name="discount" class="enable-textbox-percentage percentradio" value="percentage"  autocomplete="off">%
                          </label>         
                         </div>
		                 <?= $form->field($model, 'overalldiscountpercent')->textInput(['class'=>'form-control w-40  pr-11 number','onkeyup'=>'DiscountPercentCalCulation(this,event);'])->label('Less Discount(%)') ?>
                         <div class="input-group-btn" data-toggle="buttons">
                           <label class="inp btn btn-default enable-textbox-flat" disabled style="padding:3px!important;">
                             <input type="radio" name="discount" class="enable-textbox-flat" value="flat"  autocomplete="off">$
                           </label>         
                         </div>
		                 <?= $form->field($model, 'overalldiscountamount')->textInput(['class'=>'form-control text-right  number pr-11','onkeyup'=>'DiscountValueCalCulation(this,event);'])->label('Less Disc Amount')  ?>
                         <input type="hidden" name="total_subvalue" id="total_subvalue" value="0"> 					
						</div> 
					   </td>
				  </tr>
				  
				  <tr>
					<th>NET Amount</th>
					<td><?= $form->field($model, 'overall_net_amount')->textInput(['class'=>'form-control bg-info1 cus-fld text-right','readonly' => true,'required'=>true])->label('Net Amount') ?> </td>
				  </tr>
						
				  <tr>
					<th>Paid Amount</th>
					<td><?= $form->field($model, 'overalltotal')->textInput(['class'=>'form-control cus-fld bg-success1 number text-right','onkeyup'=>'PaidAmountCalculation(this,event);','required'=>true])->label('Paid Amount') ?></td>
				  </tr>
		
				  <tr>
					<th>Due Amount</th>
					<td><?= $form->field($model, 'overall_due_amount')->textInput(['class'=>'form-control bg-danger1 cus-fld','readonly' => true])->label('Due Amount')  ?></td>
				  </tr> 
			    </table>
				<?= $form->field($model, 'discount_authority')->dropdownlist($authority_master,['class'=>'form-control cus-fld','prompt'=>'Select'])->label('Authority')  ?>
				<?= $form->field($model, 'remarks')->textArea(['class'=>'form-control cus-fld','required'=>true])->label('Remarks')  ?>
				
				<div class="form-group">
				  <div class="panel">
                    <div class="panel panel-border">
                     <div class="panel-body padding-btns">	
                        <button type="button" class="btn ml-5  inp btn-xs btn-default pull-right remove_all">Close</button>		
                        <a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=treatment-overall/index" class="btn btn-xs text-right pull-right ml-5 bk-btn btn-default" Title="Back To Grid">Grid </a> 
					  		<button type="button" class="btn  btn-xs btn-warning pull-right ml-5 remove_all">Refresh</button>
					 					
                     	<input type="hidden" name="saved_val" id='saved_val'>
					     <button type="button" class="btn  btn-xs btn-success pull-right ml-5" id='saves_sucess' onclick="SaveProcedures();">Save</button>
					  				 
			         </div>
			        </div>
			      </div>
				</div>
				
			 
			<!-- <div class="  patient_details" style="border-right: 1px solid #d6c8c8;">
								
					<div class="inner-des">
					<?//= $form->field($model, 'tot_quantity')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('Qty')  ?>
							
					<?//= $form->field($model, 'overall_sub_total')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('Rate') ?> 
					
					<?//= $form->field($model, 'overalldiscountpercent')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'DiscountPercentCalCulation(this,event);'])->label('Less Discount(%)') ?>
					
					<?//= $form->field($model, 'overalldiscountamount')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'DiscountValueCalCulation(this,event);'])->label('Less Disc Amount')  ?>
					<input type="hidden" name="total_subvalue" id="total_subvalue" value="0"> 
					
					</div>
			</div>  
			<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
				<div class="inner-des">
					<?//= $form->field($model, 'total_gst_percent')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('GST(%)') ?> 
					
					<?//= $form->field($model, 'totalgstvalue')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('GST(AMT)') ?>
					
					<?//= $form->field($model, 'overall_net_amount')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('Net Amount') ?> 
					
					<?//= $form->field($model, 'overalltotal')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'PaidAmountCalculation(this,event);','required'=>true])->label('Paid Amount') ?>
					
					<?//= $form->field($model, 'overall_due_amount')->textInput(['class'=>'form-control cus-fld','readonly' => true])->label('Due Amount')  ?>
			</div>
			</div> -->
			<!--<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
				<div class="inner-des">
					<?//= $form->field($model, 'remarks')->textArea(['class'=>'form-control cus-fld'])->label('Remarks')  ?>
					<?//= $form->field($model, 'discount_authority')->textInput(['class'=>'form-control cus-fld'])->label('Authority')  ?>
				</div>
			</div> -->
			<!--<div class="col-sm-3" style="border-right: 1px solid #d6c8c8;">
				<div class="inner-des button-select-re">
				<button type="button" class="btn btn-success" id='saves_sucess' onclick="SaveProcedures();">Save</button>
	        	<button type="button" class="btn btn-success">Clear</button>
	        	<button type="button" class="btn btn-success">Close</button>
	        				
				</div>
			</div>  -->
			 
		</div>
		 
				  
	      
		  
		  
		  </div>
         </div>
    </div>
              
		
		</div>
		</div>
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

<div id="" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Identification List</h4>
      </div>
      <div class="modal-body">
      	
      	
        <div class="" id="patient_history_report">
            	<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
				<thead>
				  <tr>
				  	<th>MR NUMBER</th>
				    <th>Sub-Visit Number</th>
				    <th>Patient Name</th>
				    <th>Mobile Number</th>
				    <th>Consultant Doctor</th>
				    <th>Action</th>
				  </tr>
				</thead>
				<tbody id='set_patient_data'>
				 	<?php if(!empty($today_visiting)) { foreach ($today_visiting as $key => $value) { ?>
								<tr id='<?php echo $value['sub_id'];?>'>
									<td><?php echo $value['mr_number'];?></td>
									<td><?php echo $value['sub_visit'];?></td>
									<td><?php echo $new_patient_index[$value['mr_number']]['patientname'];?></td>
									<td><?php echo $new_patient_index[$value['mr_number']]['pat_mobileno'];?></td>
									<td><?php echo $physicianmaster[$value['consultant_doctor']];?></td>
									<td><button type="button" class='btn btn-xs btn-success select_sub_visit' onclick="SubVisitFetch(<?php echo $value['sub_id']?>,<?php echo $value['mr_number']?>);" >Select</button></td>
								</tr>
					<?php } }?>	
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
// <?php
// echo"<pre>";
    	// print_r($tax_grouping_log_index_json); die;
// ?>
    	<?php ActiveForm::end(); ?>
    
	<!--div class="col-md-12">
		<div class="col-md-6">
		
    <?= $form->field($model, 'refund_status')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'physicianname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insurancetype')->textInput(['maxlength' => true]) ?>
		</div>
		</div>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phonenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoicedate')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'tot_no_of_items')->textInput() ?>

    <?= $form->field($model, 'tot_quantity')->textInput() ?>

    <?= $form->field($model, 'total_gst_percent')->textInput() ?>

    <?= $form->field($model, 'total_cgst_percent')->textInput() ?>

    <?= $form->field($model, 'total_sgst_percent')->textInput() ?>

    <?= $form->field($model, 'totalgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalcgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalsgstvalue')->textInput() ?>

    <?= $form->field($model, 'totaldiscountvalue')->textInput() ?>

   

    <?= $form->field($model, 'overalldiscounttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overalldiscountpercent')->textInput() ?>

    <?= $form->field($model, 'overalldiscountamount')->textInput() ?>

    <?= $form->field($model, 'overall_sub_total')->textInput() ?>

    <?= $form->field($model, 'overalltotal')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div-->
    
    
    

<script type="text/javascript">






<?php if(empty($mr_col_json)){ ?>
var availableTags = [];

var newpatient = [];
var subvisit = [];

<?php }else{ ?>
var availableTags = <?= $mr_col_json; ?>;

var newpatient = <?= $new_patient_json; ?>;
var subvisit = <?= $subvisit_json; ?>;


<?php } ?>
var Insurance = <?= json_encode($insurancelist)?>;
var TaxGrouping = <?= $tax_grouping_log_index_json; ?>;

function TotalNetAmountAddition()
{
var hidden_amt_val=[];
$("#fetch_update_data tr").each(function() 
{
	var attr_id=$(this).attr('data-id');
	//Hidden JOKER 
	hidden_amt_val.push(parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val()));
});
var overall_amount=hidden_amt_val.reduce((a, b) => a + b, 0);
return overall_amount;
}


function DiscountValueCalCulation(data,event)
{
	var length_arr=$("#fetch_update_data tr").length;
	$('#treatmentoverall-overall_due_amount').val('');
	if(length_arr > 0)
	{
		var overall_amount=TotalNetAmountAddition();
		
		if(overall_amount < data.value)
		{
			//alert(overall_amount);
			//alert(data.value);
			$("#treatmentoverall-overalldiscountamount").val('0');
			
				Alertment('Discount Amount Not More Than Net Amount!!!');
			
			/*var flat_amount=overall_amount;
			var percentage_flat=parseFloat((flat_amount*100)/overall_amount);
			
			$("#fetch_update_data tr").each(function() 
			{
				var attr_id=$(this).attr('data-id');
				//Hidden JOKER 
				var hidden_net_amt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());
				
				var cal=Math.round(parseFloat((hidden_net_amt*percentage_flat)/100));
				
				var per=Math.round(parseFloat(cal*100/overall_amount));
				
				var hiden_amt_disc=hidden_net_amt-cal;
				
				$('#treatmentindividual-discountvalue'+attr_id).val(cal);
				$('#treatmentindividual-discount_percent'+attr_id).val(per);
				$('#treatmentindividual-total_price'+attr_id).val(hiden_amt_disc);
			});
			OverallTotalDisAmtCalculation(); */
			
		}
		else if(overall_amount >= data.value)
		{
			var flat_amount=data.value;
			var percentage_flat=parseFloat((flat_amount*100)/overall_amount);
			
			$("#fetch_update_data tr").each(function() 
			{
				var attr_id=$(this).attr('data-id');
				//Hidden JOKER 
				var hidden_net_amt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());
				
				var cal=parseFloat((hidden_net_amt*percentage_flat)/100);
				//var cal=Math.round(parseFloat((hidden_net_amt*percentage_flat)/100));
				
				var per=parseFloat(cal*100/overall_amount);
				//var per=Math.round(parseFloat(cal*100/overall_amount));
				
				var hiden_amt_disc=hidden_net_amt-cal;

				
				$('#treatmentindividual-discountvalue'+attr_id).val(cal);
				$('#treatmentindividual-discount_percent'+attr_id).val(per);
				$('#treatmentindividual-total_price'+attr_id).val(hiden_amt_disc);
				
				
			});
			OverallTotalDisAmtCalculation();
		}
		else if(data.value === '')
		{
			OverallTotalCalculation();
		}
	}
	else
	{
		$('#treatmentoverall-overalldiscountamount').val('');
		ClearAddGrid();
		Alertment('Choose PROCEDURES!!!');
	}
}


function DiscountPercentCalCulation(data,event)
{

	var length_arr=$("#fetch_update_data tr").length;
	$('#treatmentoverall-overall_due_amount').val('');
		
	if(length_arr > 0)
	{
		if(data.value > 100)
		{
			var discount_percent=100;
			$('#treatmentoverall-overalldiscountpercent').val(discount_percent);
			$("#fetch_update_data tr").each(function() 
			{
			 	var attr_id=$(this).attr('data-id');
			 	var total_amt_add=parseFloat($('#treatmentindividual-rate'+attr_id).val());
			 	var total_qty=parseInt($('#treatmentindividual-qty'+attr_id).val());
			 	var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
			 	var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
			 	var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
			 	//Hidden JOKER 
			 	var hidden_amt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());
			 	
			 	var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
			 	
			 	if(calculation > hidden_amt)
			 	{
			 		$('#treatmentindividual-total_price'+attr_id).val(0);
			 	}
			 	else if(calculation <= hidden_amt)
			 	{
			 		var discountvalue=hidden_amt-calculation;
			 		$('#treatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
			 	}
			 	
			 	
			 	$('#treatmentindividual-discount_percent'+attr_id).val(discount_percent);
			 	$('#treatmentindividual-discountvalue'+attr_id).val(calculation);
				
			});
			OverallTotalDiscPercentCalculation();
			
			Alertment('Discount Percentage Not More Than 100%!!!');
		}
		else if(data.value <= 100)
		{
			var discount_percent=data.value;
			$("#fetch_update_data tr").each(function() 
			{
			 	var attr_id=$(this).attr('data-id');
			 	var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
			 	var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
			 	var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
			 	//Hidden JOKER 
			 	var hidden_amt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());
			 	
			 	var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
			 	
			 	if(calculation > hidden_amt)
			 	{
			 		$('#treatmentindividual-total_price'+attr_id).val(0);
			 	}
			 	else if(calculation <= hidden_amt)
			 	{
			 		var discountvalue=hidden_amt-calculation;
			 		$('#treatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
			 	}
			 	
			 	
			 	$('#treatmentindividual-discount_percent'+attr_id).val(discount_percent);
			 	$('#treatmentindividual-discountvalue'+attr_id).val(calculation);
			 	
			 	
			});
			OverallTotalDiscPercentCalculation();
		}
		else if(data.value === '' && data.value === 0)
		{	
			
			OverallTotalDiscPercentCalculation();
		}else{
			// $("#treatmentoverall-overalltotal").removeAttr("readonly");
			// 	$("#treatmentoverall-overalltotal").attr('readonly','true');
		}
	}
	else
	{
		 
		//$('#treatmentoverall-overalltotal').attr('readonly','false');
		$('#treatmentoverall-overalldiscountpercent').val('');
		ClearAddGrid();
		Alertment('Choose PROCEDURES!!!');
	}
}

//Discountpercent copy for Add procudures with discount

function DiscountPercentCalCulationProcedure(data,event)
{
  //alert(data);
	$('#treatmentoverall-overalltotal').attr('readonly','true');
  var length_arr=$("#fetch_update_data tr").length;
  
  $('#treatmentoverall-overall_due_amount').val('');
  if(length_arr > 0)
  {
    if(data> 100)
    {
      var discount_percent=100;
      
      $('#treatmentoverall-overalldiscountpercent').val(discount_percent);
      
      $("#fetch_update_data tr").each(function() 
      {
        var attr_id=$(this).attr('data-id');
        var total_amt_add=parseFloat($('#treatmentindividual-rate'+attr_id).val());
        var total_qty=parseInt($('#treatmentindividual-qty'+attr_id).val());
        var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
        var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
        var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
        //Hidden JOKER 
        var hidden_amt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());
        
        var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
        
        if(calculation > hidden_amt)
        {
          $('#treatmentindividual-total_price'+attr_id).val(0);
        }
        else if(calculation <= hidden_amt)
        {
          var discountvalue=hidden_amt-calculation;
          $('#treatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
        }
        
        
        $('#treatmentindividual-discount_percent'+attr_id).val(discount_percent);
        $('#treatmentindividual-discountvalue'+attr_id).val(calculation);
        
      });
      OverallTotalDiscPercentCalculation();
      
      Alertment('Discount Percentage Not More Than 100%!!!');
    }
    else if(data <= 100)
    {
      var discount_percent=data;
     // alert('resss');
      $("#fetch_update_data tr").each(function() 
      {
        var attr_id=$(this).attr('data-id');
        var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
        var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
        var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
        //Hidden JOKER 
        var hidden_amt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());
        
        var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
        
        if(calculation > hidden_amt)
        {
          $('#treatmentindividual-total_price'+attr_id).val(0);
        }
        else if(calculation <= hidden_amt)
        {
          var discountvalue=hidden_amt-calculation;
          $('#treatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
        }
        
        
        $('#treatmentindividual-discount_percent'+attr_id).val(discount_percent);
        $('#treatmentindividual-discountvalue'+attr_id).val(calculation);
        
        
      });
      OverallTotalDiscPercentCalculation();
    }
    else if(data=== '')
    {
      OverallTotalDiscPercentCalculation();
    }
  }
  else
  {
    $('#treatmentoverall-overalldiscountpercent').val('');
    ClearAddGrid();
    Alertment('Choose PROCEDURES!!!');
  }
} 


//Remove functions

function AddtoGridProcedure(){


      $("#fetch_update_data tr").each(function() 
      {

        var attr_id=$(this).attr('data-id');
        var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
        var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
        var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
        //Hidden JOKER 
        var hidden_amt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());

        //alert(hidden_amt);
        
        //var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
          $('#treatmentindividual-total_price'+attr_id).val(hidden_amt);
        
      });
      OverallTotalDiscPercentCalculation();
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

function AddToGrid()
{	
	var treatment=$('#treatmentindividual-treatment_id').val();
	var rate=$('#treatmentindividual-rate').val();
	var qty=$('#treatmentindividual-qty').val();
	var treat_id=$('#treatment_id').val();
	var gst=$('#treatmentindividual-gstpercent').val();
	var gst_amt=$('#treatmentindividual-gstvalue').val();
	//var tax_grouping=
	var total_subvalue=parseFloat($('#total_subvalue').val());
	var tot_rate=rate*qty;
	var sub_totval=tot_rate+total_subvalue;
	$('#total_subvalue').val(tot_rate+total_subvalue);	
	
	if(treatment !== '' && rate !== '' && qty !== '' && treat_id !== '' && gst !== '' && gst_amt !== '')
	{

 var discountpercent=$('#treatmentoverall-overalldiscountpercent').val();




		//Remove Duplicates Row
		var length_arr=$("#fetch_update_data tr").length;
		if(length_arr > 0)
		{
			$("#fetch_update_data tr").each(function() 
			{
			 	var attr_id=$(this).attr('data-id');
			 	if(attr_id == treat_id)
			 	{
			 		$('#table_del'+treat_id).remove();
			 	}
			});
		}		
		var total_sub=0;
	/*	alert(parseFloat($('#total_subvalue').val()));
		alert(total_sub*$('#total_subvalue').val());
		alert(parseFloat($('#total_subvalue').val()*total_sub));
		*/
		//GST CALCULATION
		gst=parseFloat(gst);
		gst_amt=parseFloat(gst_amt);
		var common_gst_percent=gst/2;
		var common_gst_amt=gst_amt/2;
		
		var multiply=parseFloat(rate*qty);
		var over_net=parseFloat(multiply+gst_amt).toFixed(2);
		
		$('#treatmentindividual-mrp').val(over_net);
		$('#treatmentindividual-total_price').val(over_net);
	//$('#total_subvalue').val(parseFloat($('#total_subvalue').val())+total_sub);

		
var markup = "<tr class='save_data_table' data-id="+treat_id+" id='table_del"+treat_id+"'>"
+"<td style='width:18%;'><div class='trunctext wd100'>"+treatment+"</div></td>"
+"<td><input type='hidden' name='treatmentprimeid[]' id='treatmentprimeid"+treat_id+"' value='"+treat_id+"'>"
+"<input type='text'  style='text-align:right;' id='treatmentindividual-rate"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[rate][]' value='"+rate+"'></td>"
+"<td><input type='text' style='text-align:right;' id='treatmentindividual-qty"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[qty][]' value='"+qty+"'></td>"
+"<td><input type='text' style='text-align:right;' id='treatmentindividual-taxamount"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[taxamount][]' value='"+multiply+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='treatmentindividual-cgst_percent"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[cgst_percent][]' value='"+common_gst_percent+"'></td>"																																
+"<td><input type='text'  style='text-align:right;' id='treatmentindividual-sgst_percent"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[sgst_percent][]' value='"+common_gst_percent+"'></td>"	
+"<td><input type='text'  style='text-align:right;' id='treatmentindividual-cgst_value"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[cgst_value][]' value='"+common_gst_amt+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='treatmentindividual-sgst_value"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[sgst_value][]' value='"+common_gst_amt+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='treatmentindividual-discount_percent"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[discount_percent][]' value='0'></td>"
+"<td><input type='text'  style='text-align:right;' id='treatmentindividual-discountvalue"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[discountvalue][]' value='0'></td>"
+"<td><input type='text'  style='text-align:right;width:90px;' id='treatmentindividual-total_price"+treat_id+"' readonly='readonly' class='form-control' name='TreatmentIndividual[total_price][]' value='"+over_net+"'>"
+"<input type='hidden' id='treatmentindividual-total_price_joker"+treat_id+"' class='hidden_price form-control' name='TreatmentIndividual[hidden_total_price][]' value='"+over_net+"'></td>"
+"<td class='text-center'><button type='button' class='btn btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+treat_id+" id='delrow"+treat_id+"'><i class='fa fa-remove'></i></button></td></tr>";
																	
$("#fetch_update_data").append(markup); 
$( "#fetch_update_data" ).scrollTop(200);		

OverallTotalCalculation();
if(discountpercent!=''){
 // alert(discountpercent);
  DiscountPercentCalCulationProcedure(discountpercent,event);

 }

ClearAddGrid();		
	}
	else if(treatment === '' || rate === '' || qty === '')
	{
		ClearAddGrid();
		Alertment('Add Procedures,Rate & Qty Fields Are Required');
	}
}


function OverallTotalCalculation()
{
var overall_total_amount=0;
var overall_total_qty=0;
//var overall_disc_percentage=0;
//var overall_disc_amount=0;
var gst_percent=0;
var gst_amount=0;
var taxamount=0;
var billamountfinal=0;
var overall_net_amount=0;
$("#fetch_update_data tr").each(function() 
{
 	var attr_id=$(this).attr('data-id');
 	var total_amt_add=parseFloat($('#treatmentindividual-rate'+attr_id).val());
 	var total_qty=parseInt($('#treatmentindividual-qty'+attr_id).val());
 	
 	var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
 	var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
 	var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
 	
 	var cgst_per_add=parseFloat($('#treatmentindividual-cgst_percent'+attr_id).val());
 	var sgst_per_add=parseFloat($('#treatmentindividual-sgst_percent'+attr_id).val());
 	
 	var cgst_amt_add=parseFloat($('#treatmentindividual-cgst_value'+attr_id).val());
 	var sgst_amt_add=parseFloat($('#treatmentindividual-sgst_value'+attr_id).val());
 	
 	
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
 	
 	taxamount=total_qty*total_amt_add;
 	billamountfinal=billamountfinal+taxamount;
 	
 	/*if(!isNaN(disc_perct))
 	{
 		overall_disc_percentage=overall_disc_percentage+disc_perct;
 	}*/
 	
 	/*if(!isNaN(disc_amunt))
 	{
 		overall_disc_amount=overall_disc_amount+disc_amunt;
 	}*/
 	
 	if(!isNaN(net_amunt))
 	{
 		overall_net_amount=overall_net_amount+net_amunt;
 	}
 	
 	
});

//Quantity
$('#treatmentoverall-tot_quantity').val(overall_total_qty);

$('#treatmentoverall-totalgstvalue').val(gst_amount.toFixed(2));
var priceamountt=parseFloat($('#treatmentoverall-overall_sub_total').val());
var gstamonutt=parseFloat($('#treatmentoverall-totalgstvalue').val());

//billamountfinal=(billamountfinal+taxamount);
var taxamount=(billamountfinal+gst_amount); 
$('#treatmentoverall-overall_sub_total').val(billamountfinal.toFixed(2));

$('#tre_bill_total').val(taxamount.toFixed(2));
 

//alert(netamountfinal);
//$('#treatmentoverall-overalldiscountpercent').val(overall_disc_percentage);
//$('#treatmentoverall-overalldiscountamount').val(overall_disc_amount);
$('#treatmentoverall-overall_net_amount').val(overall_net_amount.toFixed(2));
//$('#treatmentoverall-overalltotal').val(netamountfinal.toFixed(2));


//GST
$('#treatmentoverall-total_gst_percent').val(gst_percent.toFixed(2));
$('#treatmentoverall-totalgstvalue').val(gst_amount.toFixed(2));

	var insurance=$("#treatmentoverall-insurancetype").val();
						
						if(insurance=="1" || insurance=="3" ){
							$('#treatmentoverall-overalltotal').attr('readonly','readonly');
							document.getElementById("treatmentoverall-overalldiscountpercent").disabled = true;
							document.getElementById("treatmentoverall-overalldiscountamount").disabled = true;
							
							$('#treatmentoverall-overalltotal').val('0');
							$('#treatmentoverall-overall_due_amount').val(overall_net_amount.toFixed(2));
							
									
						}else {
							$("#treatmentoverall-overalltotal").attr("readonly", false); 
							document.getElementById("treatmentoverall-overalltotal").disabled = false;
							document.getElementById("treatmentoverall-overalldiscountpercent").disabled = false;
							document.getElementById("treatmentoverall-overalldiscountamount").disabled = false;
							$('#treatmentoverall-overalltotal').val(overall_net_amount.toFixed(2));
							$('#treatmentoverall-overall_due_amount').val('0');
						}

//$('#treatmentoverall-overall_due_amount').val('');
}

function OverallTotalDiscPercentCalculation()
{
var overall_total_amount=0;
var overall_total_qty=0;
//var overall_disc_percentage=0;
var overall_disc_amount=0;
var overall_net_amount=0;
$("#fetch_update_data tr").each(function() 
{
 	var attr_id=$(this).attr('data-id');
 	var total_amt_add=parseFloat($('#treatmentindividual-rate'+attr_id).val());
 	var total_qty=parseInt($('#treatmentindividual-qty'+attr_id).val());
 	var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
 	var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
 	var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
 	
 	if(!isNaN(total_amt_add))
 	{
 		overall_total_amount=overall_total_amount+total_amt_add;
 	}
 	
 	if(!isNaN(total_qty))
 	{
 		overall_total_qty=overall_total_qty+total_qty;
 	}
 	
 	/*if(!isNaN(disc_perct))
 	{
 		overall_disc_percentage=overall_disc_percentage+disc_perct;
 	}*/
 	
 	if(!isNaN(disc_amunt))
 	{
 		overall_disc_amount=overall_disc_amount+disc_amunt;
 	}
 	
 	if(!isNaN(net_amunt))
 	{
 		overall_net_amount=overall_net_amount+net_amunt;
 	}
 	
});

//Quantity
$('#treatmentoverall-tot_quantity').val(overall_total_qty);
//$('#treatmentoverall-overall_sub_total').val(overall_total_amount);
//$('#treatmentoverall-overalldiscountpercent').val(overall_disc_percentage);
$('#treatmentoverall-overalldiscountamount').val(overall_disc_amount);
$('#treatmentoverall-overall_net_amount').val(overall_net_amount.toFixed(2));
$('#treatmentoverall-overalltotal').val(overall_net_amount.toFixed(2));

}


function OverallTotalDisAmtCalculation()
{
var overall_total_amount=0;
var overall_total_qty=0;
var overall_disc_percentage=0;
//var overall_disc_amount=0;
var overall_net_amount=0;
$("#fetch_update_data tr").each(function() 
{
 	var attr_id=$(this).attr('data-id');
 	var total_amt_add=parseFloat($('#treatmentindividual-rate'+attr_id).val());
 	var total_qty=parseInt($('#treatmentindividual-qty'+attr_id).val());
 	var disc_perct=parseFloat($('#treatmentindividual-discount_percent'+attr_id).val());
 	var disc_amunt=parseFloat($('#treatmentindividual-discountvalue'+attr_id).val());
 	var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
 	
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
 	
 	/*if(!isNaN(disc_amunt))
 	{
 		overall_disc_amount=overall_disc_amount+disc_amunt;
 	}*/
 	
 	if(!isNaN(net_amunt))
 	{
 		overall_net_amount=overall_net_amount+net_amunt;
 	}
 	
});

//Quantity
$('#treatmentoverall-tot_quantity').val(overall_total_qty);
$('#treatmentoverall-overall_sub_total').val(overall_total_amount);
$('#treatmentoverall-overalldiscountpercent').val(overall_disc_percentage);
//$('#treatmentoverall-overalldiscountamount').val(overall_disc_amount);
$('#treatmentoverall-overall_net_amount').val(overall_net_amount);
$('#treatmentoverall-overalltotal').val(overall_net_amount);
$('#treatmentoverall-overall_due_amount').val('0');
}




function PaidAmountCalculation(data,event) 
{
	
	var dis_pre=$("#treatmentoverall-overalldiscountpercent").val();
	var dis_amount=$("#treatmentoverall-overalldiscountamount").val();
	
		
	var paid_amount=data.value;
	var overall_net_amount=0;
	//$('#treatmentoverall-overalltotal').attr('readonly','false');
	$('#treatmentoverall-overalldiscountpercent').val('');
	$('#treatmentoverall-overalldiscountamount').val('');
	
	$("#fetch_update_data tr").each(function() 
	{
	 	var attr_id=$(this).attr('data-id');
	 	var net_amunt=parseFloat($('#treatmentindividual-total_price_joker'+attr_id).val());
	 	//var net_amunt=parseFloat($('#treatmentindividual-total_price'+attr_id).val());
	 	if(!isNaN(net_amunt))
	 	{
	 		overall_net_amount=overall_net_amount+net_amunt;
	 	}
	 	//alert(overall_net_amount);
	});
	$('#treatmentoverall-overall_net_amount').val(overall_net_amount);
	if(overall_net_amount >= paid_amount)
	{
		var amount=overall_net_amount-paid_amount;
		$('#treatmentoverall-overall_due_amount').val(amount.toFixed(2));	
	}
	else if(overall_net_amount < paid_amount)
	{
		$('#treatmentoverall-overalltotal').val(overall_net_amount);
		$('#treatmentoverall-overall_due_amount').val(0);
		Alertment('Paid Amount Not Greater Than Net Amount');
	}
	
	if(data.value === '')
	{
		$('#treatmentoverall-overalltotal').val(overall_net_amount);
		$('#treatmentoverall-overall_due_amount').val(0);
	}
	
	
}





$(".mrnumber").typeahead({
	
	source: function(query,result) {
	  		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=treatment-overall/ajaxfetch";?>',
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
		var mr_hide=$('#hidden_mr_number').val();
		if(mr_hide !== result)
		{
			$('#load1').show();
			$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=treatment-overall/ajaxsinglefetch&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{   
	  			 
	  			 	$('#treatmentoverall-name').val(data[1]['patientname']);
	  				$('#newpatient-par_relationname').val(data[1]['par_relationname']);
	  				
	  				if(data[0]!=""){
	  					$('#pat_id').val(data[0]['pat_id']);
	  					$('#subvisit_id').val(data[0]['sub_id']);
	  				}else{
	  					$('#pat_id').val();
	  					$('#subvisit_id').val();	
	  				}
           			
           			
           		//$('#subvisit_number').val(data[0]['par_relationname']);
           			
           			if(data[1]['pat_sex'] !== '')
           			{
           				$('#treatmentoverall-gender').html('<option value='+data[1]['pat_sex']+'>'+data[1]['pat_sex']+'</option>');
           			}
            
	  				if(data[1]['insurance_type_id'] !== '' || data[1]['insurance_type_id'] !== null)
	  				{
	  					if(data[3] !== null)
	  					{
	  						$('#treatmentoverall-insurancetype').html('<option value='+data[3]['insurance_typeid']+'>'+data[3]['insurance_type']+'</option>');
	  					}
	  					else if(data[3] === null)
	  					{
	  						$('#treatmentoverall-insurancetype').html('');
	  					}
	  				}
	  				else
	  				{
	  					$('#treatmentoverall-insurancetype').html('');
	  				}
	  				$('#treatmentoverall-dob').val(formatDate(data[1]['dob']));
	  				
	  				$('#hidden_mr_number').val(result);
	  				
	  				$("#fetch_update_data tr").remove();
    				$("#saved_val").val('');
    				cleartxt();
    				
	  				$('#load1').hide();
	  				
	  				
	  				
	  			}
	  	});
	  }
	}
});

function cleartxt (argument) {
  $('#treatmentoverall-overall_sub_total').val('');
  $('#treatmentoverall-totalgstvalue').val('');
  $('#tre_bill_total').val('');
  $('#treatmentoverall-overalldiscountpercent').val('');
  $('#treatmentoverall-overalldiscountamount').val('');
  $('#treatmentoverall-overall_net_amount').val('');
  $('#treatmentoverall-overalltotal').val('');
  $('#treatmentoverall-overall_due_amount').val('');
  $('#treatmentoverall-discount_authority').val('');
  $('#treatmentoverall-remarks').val('');
  
}



<?php if(!empty($treatment_json)){ ?>
	var proceduresTags = <?= $treatment_json; ?>;
<?php }else if(empty($treatment_json)){ ?>
		var proceduresTags = [];
<?php } ?>
$(".procedures").typeahead({

minLength: 1,
delay: 5,
source: proceduresTags,
autoSelect: true,
displayText: function(item)
{
	 return item.treatment_name;
},
afterSelect: function(item) 
{
	//var obj = $.parseJSON(TaxGrouping);
	//GST FETCH
	
	var tax_percent=TaxGrouping[item.hsn]['tax'];
	
	
	$('#treatment_id').val(item.treatid);
	$('#treatmentindividual-qty').val(1);
	$('#treatmentindividual-rate').val(item.amount);
	
	$('#treatmentindividual-gstpercent').val(tax_percent);
	$('#treatmentindividual-rate').focus();
} 
});




$(document).ready(function() {
var table = $('#example').DataTable({
"scrollY": "400px",
"paging": false,
});
    
$("body").on('keypress', '.number', function (e) 
{
//if the letter is not digit then display error and don't type anything
if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
{
	return false;
}
}); 

//Default Focus
$('#treatmentoverall-mrnumber').focus();

});


function Patient_details() 
{ 
	$('#example_filter input.form-control.input-sm').focus();
	$modal = $('#patient_hist-modal');
	$modal.modal('show');
}


function SubVisitFetch(subvisitid,mrnumber) 
{
	if(subvisitid !== '' && mrnumber !== '')
	{
		$('#treatmentoverall-name').val('');
		$('#newpatient-par_relationname').val('');
		$('#treatmentoverall-dob').val('');
		$('#treatmentoverall-gender').val('');
		$('#treatmentoverall-insurancetype').html('');
		
		$('#pat_id').val('');
		$('#subvisit_id').val('');
		$('#subvisit_number').val('');
		
		
		var formatdate= formatDate(newpatient[mrnumber]['dob']);
		$('#treatmentoverall-name').val(newpatient[mrnumber]['patientname']);
		$('#newpatient-par_relationname').val(newpatient[mrnumber]['par_relationname']);
		$('#treatmentoverall-dob').val(formatdate);
		$('#treatmentoverall-gender').html('<option value='+newpatient[mrnumber]['pat_sex']+'>'+newpatient[mrnumber]['pat_sex']+'</option>');
		$('#treatmentoverall-mrnumber').val(mrnumber);
		
		if(subvisit[subvisitid]['insurance_type'] !== '')
		{
			var insurance_id=subvisit[subvisitid]['insurance_type'];
			var ins_type=(Insurance[insurance_id]['insurance_type']=== '' ? "" : Insurance[insurance_id]['insurance_type']);
			$('#treatmentoverall-insurancetype').html('<option value='+insurance_id+'>'+ins_type+'</option>');
		}
		
		$('#pat_id').val(subvisit[subvisitid]['pat_id']);
		$('#subvisit_id').val(subvisitid);
		$('#subvisit_number').val(subvisit[subvisitid]['sub_visit']);
		
	    $modal = $('#patient_hist-modal');
		$modal.modal('hide');
	   	$('#treatmentindividual-treatment_id').focus();
	}
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
		 url: "<?php echo Yii::$app->homeUrl . "?r=treatment-overall/mr-number-fetch&id=";?>"+data.value,
	     success: function (result) 
	     {
	     	//alert(result);
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
     			EmptyPatientDetails();
     			$('#treatmentoverall-mrnumber').val(obj[2]['mr_no']);
     			$('#treatmentoverall-name').val(obj[2]['patientname']);
				$('#newpatient-par_relationname').val(obj[2]['par_relationname']);
				$('#treatmentoverall-dob').val(formatDate(obj[2]['dob']));
				$('#treatmentoverall-gender').html('<option value='+obj[2]['pat_sex']+'>'+obj[2]['pat_sex']+'</option>');
			
				if(obj[1]['insurance_type'] !== '')
				{
				   $('#treatmentoverall-insurancetype').html('<option value='+Insurance[obj[1]['insurance_type']]['insurance_typeid']+'>'+Insurance[obj[1]['insurance_type']]['insurance_type']+'</option>');
				}
				$('#pat_id').val(obj[1]['pat_id']);
				$('#subvisit_id').val(obj[1]['sub_id']);
				$('#subvisit_number').val(obj[1]['sub_visit']);
				$('#treatmentoverall-mrnumber').val(obj[1]['mr_number']);
				$('#treatmentindividual-treatment_id').focus();
				var lastdate=obj[3];
				Alertment('Last Visiting is '+lastdate+'');
     		}
	     }
		 });
	}	
}


function EmptyPatientDetails()
{
		$('#treatmentoverall-name').val('');
		$('#newpatient-par_relationname').val('');
		$('#treatmentoverall-dob').val('');
		$('#treatmentoverall-gender').val('');
		$('#treatmentoverall-insurancetype').html('');
		$('#pat_id').val('');
		$('#subvisit_id').val('');
		$('#subvisit_number').val('');
		$('#treatmentoverall-mrnumber').val('');
	
		
}


function EmptyESC(data,event) 
{
  	if(data.value === '')
  	{
  		$('#treatmentindividual-treatment_id').val('');
  		$('#treatmentindividual-rate').val('');
  		$('#treatmentindividual-qty').val('');
  		$('#treatmentindividual-mrp').val('');
  		$('#treatmentindividual-total_price').val('');
  		$('#treatmentindividual-gstpercent').val('');
  		$('#treatmentindividual-gstvalue').val('');
  		
  		$('#treatment_id').val('');
  		$('#treatmentindividual-treatment_id').focus();
  	}
  	
  	if(event.keyCode === 27)
  	{
  		$('#treatmentindividual-treatment_id').val('');
  		$('#treatmentindividual-rate').val('');
  		$('#treatmentindividual-qty').val('');
  		$('#treatmentindividual-mrp').val('');
  		$('#treatmentindividual-total_price').val('');
  		$('#treatmentindividual-gstpercent').val('');
  		$('#treatmentindividual-gstvalue').val('');
  		
  		$('#treatment_id').val('');
  		$('#treatmentindividual-treatment_id').focus();
  	}
}

function ClearAddGrid() 
{
$('#treatmentindividual-treatment_id').val('');
$('#treatmentindividual-rate').val('');
$('#treatmentindividual-qty').val('');
$('#treatmentindividual-mrp').val('');
$('#treatmentindividual-total_price').val('');
$('#treatmentindividual-gstpercent').val('');
$('#treatmentindividual-gstvalue').val('');


$('#treatment_id').val('');
$('#treatmentindividual-treatment_id').focus();
}

function RateCalCulation(data,event)
{
	var procedures=$('#treatmentindividual-treatment_id').val();
	var qty=$('#treatmentindividual-qty').val();
	var gst=$('#treatmentindividual-gstpercent').val();
	if(procedures !== '')
	{
		if(event.keyCode === 13 && data.value !== '' && qty !== '' && gst !== '')
		{
			var rate_qty=parseFloat(data.value);
			qty=parseInt(qty);
			gst=parseFloat(gst);
			
			//GST CALCULATION
			if(rate_qty !== 0)
			{
				var calc=parseFloat((gst*rate_qty)/100);
				$('#treatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate_qty*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#treatmentindividual-mrp').val(tot);
				$('#treatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate_qty*qty).toFixed(2);
				$('#treatmentindividual-mrp').val(multiply);
				$('#treatmentindividual-total_price').val(multiply);
			}
			
			
			$('#treatmentindividual-qty').focus();
		
	}
	}
	else if(procedures === '')
	{
		ClearAddGrid();
		alert('Procedures Field Is Mandatory');
	}else if(data.value === '')
  	{
  		$('#treatmentindividual-rate').val('');
  		
  	}
  	if(event.keyCode === 27)
  	{
  		$('#treatmentindividual-rate').val('');
  		
  	}
}


function QtyCalCulation(data,event)
{
	var procedures=$('#treatmentindividual-treatment_id').val();
	var rate=$('#treatmentindividual-rate').val();
	var gst=$('#treatmentindividual-gstpercent').val();
	if(procedures !== '')
	{
		if(event.keyCode === 13 && data.value !== '' && rate !== '' && gst !== '')
		{
			if(data.value === '0')
			{
				data.value = 1;
			}
			
			var qty=parseInt(data.value);
			rate=parseFloat(rate);
			
			var multiply=parseFloat(rate*qty);
			
			//GST CALCULATION
			if(rate !== 0)
			{
				var calc=parseFloat((gst*multiply)/100);
				$('#treatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#treatmentindividual-mrp').val(tot);
				$('#treatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate*qty).toFixed(2);
				$('#treatmentindividual-mrp').val(multiply);
				$('#treatmentindividual-total_price').val(multiply);
			}
			
			AddToGrid();
		}
		else if(data.value !== '' && rate !== '' && gst !== '')
		{
			if(data.value === '0')
			{
				data.value = 1;
			}
			var qty=parseInt(data.value);
			rate=parseFloat(rate);
			
			var multiply=parseFloat(rate*qty);
			
			//GST CALCULATION
			if(rate !== 0)
			{
				var calc=parseFloat((gst*multiply)/100);
				$('#treatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#treatmentindividual-mrp').val(tot);
				$('#treatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate*qty).toFixed(2);
				$('#treatmentindividual-mrp').val(multiply);
				$('#treatmentindividual-total_price').val(multiply);
			}
		}
		else if(data.value === '' && rate !== '' && gst !== '')
		{
			$('#treatmentindividual-qty').val(1);
			var qty=parseInt(data.value);
			rate=parseFloat(rate);
			
			var multiply=parseFloat(rate*qty);
			
			//GST CALCULATION
			if(rate !== 0)
			{
				var calc=parseFloat((gst*multiply)/100);
				$('#treatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#treatmentindividual-mrp').val(tot);
				$('#treatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate*qty).toFixed(2);
				$('#treatmentindividual-mrp').val(multiply);
				$('#treatmentindividual-total_price').val(multiply);
			}
		}
		
	}
	else if(procedures === '')
	{
		ClearAddGrid();
		alert('Procedures Field Is Mandatory');
	}
	if(event.keyCode === 27)
	{
		$('#treatmentindividual-qty').val('');
	}
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
 
 
 function SaveProcedures()
 {
 	var overall_discount_percentage=$('#treatmentoverall-overalldiscountpercent').val();
 	var overall_discount_amount=$('#treatmentoverall-overalldiscountamount').val();
 	var due_amount=$('#treatmentoverall-overall_due_amount').val();
 	
 	
 	if(overall_discount_percentage !== '' && overall_discount_amount !== '')
 	{
 		$('#treatmentoverall-remarks').attr('required','required');
 		$('#treatmentoverall-discount_authority').attr('required','required');
  		 $('#treatmentoverall-remarks').attr('required','required');
 	}
 	else if(overall_discount_percentage === '' && overall_discount_amount === '')
 	{
 		$('#treatmentoverall-remarks').removeAttr('required','required');
 		$('#treatmentoverall-discount_authority').removeAttr('required','required');
  		//  $('#treatmentoverall-remarks').attr('required','required');
 	}
 	
 	if(due_amount !== '' && due_amount !== '0' )
 	{
 		$('#treatmentoverall-remarks').attr('required','required');
 		$('#treatmentoverall-discount_authority').attr('required','required');
  		 $('#treatmentoverall-remarks').attr('required','required');
 	}
 	else if(due_amount === '' && due_amount === '0' )
 	{
 		$('#treatmentoverall-remarks').removeAttr('required','required');
 		$('#treatmentoverall-discount_authority').removeAttr('required','required');
  		//  $('#treatmentoverall-remarks').attr('required','required');
 	}
 	
 	var valid=$("#w0").valid();  
	if(valid === true)
	{
		//$('#load1').show();
    if (confirm('Are You Sure to Save ?')) {
		$.ajax({	
			     type: "POST",
 				 url: "<?php echo Yii::$app->homeUrl . "?r=treatment-overall/create";?>",
 				 data: $("#w0").serialize(),
			     success: function (result) 
			     {
			     	obj=$.parseJSON(result);
			     	//if(result === 'S')
			     	//{
			     		$("#saved_val").val(obj[2]);
	            		
			     		$('#load1').hide();
			     		$('#saves_sucess').attr('disabled','disabled');
			     		var url='<?php echo Yii::$app->homeUrl ?>?r=treatment-overall/report&id='+obj[1];
		 				window.open(url,'_blank');
	            		Alertment('Treatment Register Number is '+obj[0]);
			     	//}	
			     }
		 });
 		 }
	}
 }
 
 var onetimesave="1";
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
			var  saved_val = $("#saved_val").val();
              if(saved_val==""){
           		SaveProcedures();
           			
           		}else{
           			alert('Already Saved ..!');
           		}             if(onetimesave==1){
              
              
              //alert(onetimesave);
            }else{
              //alert(onetimesave);
              alert("already Saved");
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
    var length_arr=$("#fetch_update_data tr").length;
    if(length_arr!=1)
    {
    }
    else{
		$('#treatmentoverall-overalldiscountpercent').val('');
		$('#treatmentoverall-overalldiscountamount').val('');
    }
   // 
		var data_addid = $(this).attr('data_delete_row')
  		var item_less=1;
  		var total_items=parseInt($('#treatmentindividual-qty'+data_addid).val());
		var total_gst_pre=(parseFloat($('#treatmentindividual-cgst_percent'+data_addid).val())+parseFloat($('#treatmentindividual-sgst_percent'+data_addid).val()));
    
		var total_gst_val=(parseFloat($('#treatmentindividual-cgst_value'+data_addid).val())+parseFloat($('#treatmentindividual-sgst_value'+data_addid).val()));
		var total_sub_total=parseFloat($('#treatmentindividual-total_price'+data_addid).val());
		var rate=parseFloat($('#treatmentindividual-rate'+data_addid).val());
    	
    	var total_subtotal=parseFloat($('#treatmentoverall-overall_sub_total').val());
    	var total_qty=parseFloat($('#treatmentoverall-tot_quantity').val());
    	var taxamount=(total_subtotal)-(rate*total_items);
    	
    	$('#treatmentoverall-tot_quantity').val(parseInt($('#treatmentoverall-tot_quantity').val())-total_items);
		$('#treatmentoverall-overall_sub_total').val(parseFloat(taxamount).toFixed(2));
		$('#treatmentoverall-total_gst_percent').val(parseFloat($('#treatmentoverall-total_gst_percent').val()).toFixed(2)-parseFloat(total_gst_pre).toFixed(2));
		var tot_gst_val=parseFloat($('#treatmentoverall-totalgstvalue').val()).toFixed(2)-parseFloat(total_gst_val).toFixed(2);
		$('#treatmentoverall-totalgstvalue').val(tot_gst_val.toFixed(2));
		
		if($('#treatmentoverall-overall_sub_total').val()!=""){
			var sub_tot=parseFloat($('#treatmentoverall-overall_sub_total').val());
		}else{
			var sub_tot="0";
		} 
		if($('#treatmentoverall-totalgstvalue').val()!=""){
			var tot_gst=parseFloat($('#treatmentoverall-totalgstvalue').val());
		}else{
			var tot_gst="0";
		}
		var billtotla=sub_tot+tot_gst;
		$('#treatmentoverall-overall_sub_total').val(billtotla.toFixed(2));
		$('#tre_bill_total').val(billtotla.toFixed(2));
    
		$('#treatmentoverall-overall_net_amount').val(parseFloat($('#treatmentoverall-overall_net_amount').val()).toFixed(2)-total_sub_total.toFixed(2));
		$('#treatmentoverall-overalltotal').val(parseFloat($('#treatmentoverall-overall_net_amount').val()).toFixed(2));
    $('#treatmentoverall-overall_due_amount').val('0');
  	 //$('#treatmentoverall-overalldiscountpercent').val('');
	 //$('#treatmentoverall-overalldiscountamount').val('');
		$('#table_del'+data_addid).remove();
     var discountpercent=$('#treatmentoverall-overalldiscountpercent').val();
 
    AddtoGridProcedure();
    if(discountpercent!=''){
 
  DiscountPercentCalCulationProcedure(discountpercent,event);

 }

		        
 });
 
 function Patientdetails_modal1()
 {
 	
 	//$modal = $('#patient_hist-modal1');
	//$modal.modal('show');
	
	var mrnumber=$("#treatmentoverall-mrnumber").val();
	if(mrnumber==""){
		Alertment('Invalid MR NUMBER');			
	}else{
		$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=sales/patientkey1&id=";?>"+mrnumber,
        success: function (result) 
        { 
        	var obj = JSON.parse(result);
			$('#set_patient_data1').html(obj);
			$modal = $('#patient_hist-modal_details');
			$modal.modal('show');
         }
    	});
	}
 }
 
</script>
<script type="text/javascript">
 $(document).ready(function(){
   	$("body").addClass("fixed-left-void");
	$("body").removeClass("fixed-left");
	$("#wrapper").addClass("enlarged");
    $("#wrapper").addClass("forced");   			
    $(".list-unstyled").css("display","none");
  	 
});

</script>
<script type="text/javascript">
	$(document).ready(function(){
	   $('#treatmentoverall-overalldiscountpercent').click(function() {  	 	 
		 $(".enable-textbox-percentage").addClass('active');
         $(".enable-textbox-flat").removeClass('active');		 
       });
	   
	   $('#treatmentoverall-overalldiscountamount').click(function() { 	     
         $(".enable-textbox-flat").addClass('active');
         $(".enable-textbox-percentage").removeClass('active');		 
       });
	   
	});
	
/*********************           fetch popup                  *******************************/	

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
$(document).ready(function(){
 	jtable_pd();
//$('#treatmentoverall-overalldiscountamount').attr('readonly','true');
  
  	 
});	
function PatientDetailsFetch(data)
{
	
	$.ajax({
        type: "POST",
        
        url:'<?php echo Yii::$app->homeUrl . "?r=treatment-overall/ajaxsinglefetchdetails&id=";?>'+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        	
        $('#treatmentoverall-mrnumber').val(obj[0]['mr_number']);
        	$('#inregistration-name_initial').val(obj[1]['pat_inital_name']);
        	$('#treatmentoverall-name').val(obj[1]['patientname']);
        	$('#treatmentoverall-dob').val(formatDate(obj[1]['dob']));
        	//$('#treatmentoverall-gender').val(obj[1]['pat_sex']);
        	$('#inregistration-marital_status').val(obj[1]['pat_marital_status']);
        	$('#inregistration-relation_suffix').val(obj[1]['pat_relation']);
        	$('#newpatient-par_relationname').val(obj[1]['par_relationname']);
        	//$('#treatmentoverall-insurancetype').html('<option value='+obj[3]['insurance_type']+'>'+obj[3]['insurance_type']+'</option>');
        	$('#treatmentoverall-gender').html('<option value='+obj[1]['pat_sex']+'>'+obj[1]['pat_sex']+'</option>');
        	$('#pat_doctor').val(obj[2]['physician_name']);	
        	$('#pat_mob').val(obj[1]['pat_mobileno']);
        	
        	//CalculateAge(obj[0]['dob']);
        	
        	$modal = $('#patient_details');
        	$modal.modal('hide');
        }
	});
}

$("body").on('click', '.remove_all', function ()
    {
    	//window.location.reload(true);
    	$("#fetch_update_data tr").remove();
    	$("#saved_val").val('');
    	$('#saves_sucess').removeAttr('disabled');
    	$('#treatmentoverall-overalltotal').removeAttr('readonly');
    	//document.getElementById("treatmentoverall-overalltotal").disabled = false;
		document.getElementById("treatmentoverall-overalldiscountpercent").disabled = false;
		document.getElementById("treatmentoverall-overalldiscountamount").disabled = false;
		$('.enable-textbox-percentage').removeClass('active');
		
    	cleartxt();
    	clearhead();
    	
    });
function clearhead (argument) {
  $('#treatmentoverall-mrnumber').val('');
  $('#treatmentoverall-name').val('');
  $('#treatmentoverall-dob').val('');
  $('#treatmentoverall-gender').val('');
  $('#treatmentoverall-insurancetype').val('');
  $('#newpatient-par_relationname').val('');
  $('#treatmentindividual-treatment_id').val('');
  $('#treatmentindividual-rate').val('');
  $('#treatmentindividual-qty').val('');
  $('#treatmentindividual-gstpercent').val('');
  $('#treatmentindividual-gstvalue').val('');
  $('#treatmentindividual-mrp').val('');
  $('#treatmentindividual-total_price').val('');
  
}	
   	
</script>


