<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\InRegistration;
/* @var $this yii\web\View */
/* @var $model backend\models\TreatmentOverall */
/* @var $form yii\widgets\ActiveForm */

$subvisit_map = InRegistration::find()->where(['is_Active'=>1])->all();
if(!empty($subvisit_map))
{
	$mr_col_json=array();
	foreach ($subvisit_map as $key => $value) 
	{
		$mr_col_json[]=array('subnumber'=>$key,'ip_no'=>$value);	
	}
	$mr_col_json=json_encode($mr_col_json);
}


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
.bg-div.table>tbody>tr>td, .bg-div.table>tbody>tr>th{padding:0px 7px!important;}

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

label.control-label{
	color:#444;
}
.btn-group-sm>.btn, .btn-sm {
    padding: 2px 10px;
}
</style>

<div class=""> <!-- row treatment-overall-form -->
<!-- 
<div class="row col-sm-12">
<div class="col-sm-6">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
<li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
<li><a href="#"><?php echo 'Treatment Overall';?></a></li>
</ol>
</div>
<div class="col-sm-6 text-right ">
	<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/in-index" class="btn text-right bk-btn btn-default" Title="Back To Grid">Back to Grid </a> 
</div>
</div>  -->
<?php $form = ActiveForm::begin(); ?>
<div class="row">
   <div class="col-sm-12">
     <div class="panel panel-border  ">
       <div class="panel-heading">
       </div>
       <div class="panel-body"  >
          <div class="inpatientblock  desc"  > 
		    <div class="row">
			  <div class="col-sm-3">
			    <div class="form-group col-sm-10 ">	
                   <div class="input-group add-on fwidth mr-num pr-b10">  
                      <div class="form-group field-mrnumber has-success">
						<?= $form->field($model, 'ip_no')->textInput(['class'=>'ipnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true])->label('IP NO') ?>
						<input type="hidden" id="pat_id" name="PATID">
						<input type="hidden" id="subvisit_id" name="SUBVISITID">
						<input type="hidden" id="subvisit_number" name="SUBVISITNUMBER">
						<div class="help-block"></div>
					  </div>
                      <div class="ipt input-group-btn fetch_record" value="click" onmousedown="Patient_details()">
						 <span class="btn btn-default inpatient-details" style="position: relative;top: 16px;left: 0px;height: 25px!important;padding: 0px 6px!important;"><i class="glyphicon glyphicon-search"></i></span>	
					  </div>										
				   </div>
				   <span id="mr_validated" style="color: red; display: none;" hidden="">Invalid MR Number</span>
				   <span class="in_pat_validated" style="color: red; display: none;" hidden="">Enter Patient Record</span>
                </div>
				
				<div class="  col-sm-2"  >	 
				 
				   <label style="visibility: hidden">ipNUMBER </label>
				  <button type="button" style="float: left;background: #800080 !important;margin-right: 5px; color:#fff;" class="btn  btn-sm  "   id="patient_history_detils1" onclick="Patientdetails_modal1()">  Details  </button>
			    </div>		
             </div>
			 <div class="col-sm-9">			 
   			    <div class='col-md-2'>
    			  <div class="form-group">
        			<?= $form->field($model, 'name')->textInput(['class'=>'form-control ','readonly' => true,'required' => true])->label('PAT NAME') ?>
      			  </div>
   			   </div>
   			   <div class='col-md-2 width-inc'>
    			   <div class="form-group">
        			 <?= $form->field($model, 'dob')->textInput(['class'=>'form-control ','readonly' => true])->label('DOB') ?>	
				   </div>
   			   </div>
   			
   			   <div class='col-md-2'>
    			<div class="form-group">
            		<?= $form->field($model, 'gender')->textInput(['class'=>'form-control    ','readonly' => true]) ?>
				</div>
   			   </div>
   			   <div class='col-md-2 width-inc'>
        		 <?= $form->field($model, 'insurancetype')->textInput(['class'=>'form-control ','readonly' => true])->label('INSURANCE') ?>
   			   </div>
   			   <div class='col-md-2'>
    			<div class="form-group">
        			 <?= $form->field($newpatient, 'par_relationname')->textInput(['class'=>'form-control  ','readonly' => true])->label('RELATION') ?>
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

<div class="row">
   <div class="col-sm-12">
     <div class="panel panel-border  ">
       <div class="panel-heading">
       </div>
       <div class="panel-body"  >
		  <div class="row">
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
        			<?= $form->field($treatmentindividual, 'mrp')->textInput(['class'=>'form-control cus-fld','readonly'=>true])->label('Total AmT') ?>
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


<div class="row" >
  <div class="col-sm-12">
     <div class="panel panel-border  ">
       <div class="panel-heading">
       </div>
       <div class="panel-body"  >
		  <div class="row">
            <div class="col-sm-9">
               <table class="table table-bordered table-striped" id="tbUser" style="margin-top:20px;">
                  <thead>
                    <tr>
                      <th rowspan="2" class="text-center hide">#</th>
                      <th rowspan="2" class="text-center">PROCEDURE NAME</th>
                      <th rowspan="2" class="text-center">RATE</th>
                      <th rowspan="2" class="text-center">QTY</th>
                      <th colspan="2" class="text-center">GST(%)</th>
                      <th colspan="2" class="text-center">GST(AMT)</th>
                      <th colspan="2" class="text-center">Discount</th>
                      <th rowspan="2" class="text-center">Total</th>
                      <th rowspan="2" class="text-center">Remove</th>
                    </tr>
                    <tr>
                      <th class="text-center">CGST(%)</th>
                      <th  class="text-center">SGST(%)</th>
                      <th class="text-center">CGST(AMT)</th>
                      <th class="text-center">SGST(AMT)</th>
                      <th class="text-center">DIS(%)</th>
                      <th class="text-center" >DIS(Amt)</th>
                    </tr>
                  </thead>
                  <tbody id='fetch_update_data'>  
                  </tbody>
                </table>
            </div>
		    <div class="col-sm-3 bg-div">
			  <div class="panel">
				     <div class="bg-div">  
					  <table class="table disable-label">
					    <tr>
							<th class="col-sm-5">Price</th>
							<td class="col-sm-7"> <?= $form->field($model, 'overall_sub_total')->textInput(['class'=>'form-control cus-fld text-right','readonly' => true,'required'=>true])->label(' ') ?> </td>
						</tr>
						
						<tr>
						  <th>GST</th>
						  <td><?= $form->field($model, 'totalgstvalue')->textInput(['class'=>'form-control cus-fld text-right','readonly' => true,'required'=>true])->label('') ?></td>
						</tr>
						
						<tr>
						  <th>Bill Total</th>
						  <td><input type="text" class="form-control"></td>
						</tr>
						
						
						<tr>
							<th>Discount</th>
							<td> 
								<div class="input-group">
								  <div class="input-group-btn" data-toggle="buttons">
                                    <label class="inp btn btn-default enable-textbox-percentage" style="padding:3px!important;">
                                       <input type="radio" name="discount" class="enable-textbox-percentage" value="percentage"  autocomplete="off">%
                                    </label>         
                                  </div>
		                           <?= $form->field($model, 'overalldiscountpercent')->textInput(['class'=>'form-control cus-fld number pr-5 text-right','onkeyup'=>'DiscountPercentCalCulation(this,event);'])->label('Less Discount(%)')->label('') ?>
                                  <div class="input-group-btn" data-toggle="buttons">
                                     <label class="inp btn btn-default enable-textbox-flat " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-flat" value="flat"  autocomplete="off">$
                                     </label>         
                                  </div>
		                          <?= $form->field($model, 'overalldiscountamount')->textInput(['class'=>'form-control cus-fld number pr-5 text-right','onkeyup'=>'DiscountValueCalCulation(this,event);'])->label('')  ?>
				                  <input type="hidden" name="total_subvalue" id="total_subvalue" value="0"> 
                                 </div> 
							   </td>
						</tr>
						
						
						
						<tr>
						  <th>NET Amount</th>
						  <td>  <?= $form->field($model, 'overall_net_amount')->textInput(['class'=>'form-control cus-fld info1 text-right','readonly' => true,'required'=>true])->label(' ') ?> </td>
						</tr>
						
						
						
						<tr>
						  <th>Paid Amount</th>
						  <td><?= $form->field($model, 'overalltotal')->textInput(['class'=>'form-control success1 cus-fld number text-right','onkeyup'=>'PaidAmountCalculation(this,event);','required'=>true])->label(' ') ?></td>
						</tr>
						
						
						<tr>
						  <th>Due Amount</th>
						  <td><?= $form->field($model, 'overall_due_amount')->textInput(['class'=>'form-control cus-fld danger1 text-right','readonly' => true])->label(' ')  ?></td>
						</tr>
					  
					  </table>
					  </div>
					  </div>
 
							
			   
					
			   
					
				
				
  
					

					
			  
					
				
				
				   <?= $form->field($model, 'discount_authority')->dropdownlist($authority_master,['class'=>'form-control cus-fld'])->label('Authority')  ?> 
				<?= $form->field($model, 'remarks')->textArea(['class'=>'form-control cus-fld'])->label('Remarks')  ?>
			   
				
				<div class="form-group">
					 <div class="panel">
                       <div class="panel panel-border">
                        <div class="panel-body" style="padding: 6px 7px 8px 35px!important;">					   
						  <button type="button" class="btn  btn-sm  btn-success" id='saves_sucess' onclick="SaveProcedures();">Save</button>
						 <button type="button" class="btn  btn-sm btn-warning remove_all">Refresh</button>
						
						 <a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/in-index" class="btn btn-sm text-right bk-btn btn-default" Title="Back To Grid">Grid </a>

						<button type="button" class="btn   inp btn-sm btn-default remove_all">Close</button>						 
			           </div>
			          </div>
			          </div>
				   </div>
				
 
				
				
				
				
				
			</div>
           </div>
       </div>
      </div>
    </div>
 </div>





			   
<!--
<div class="col-sm-12">
<div class="panel panel-border panel-custom">

<div class="panel-body"  >
    
    
    
    	<fieldset class="scheduler-border">
			<legend class="scheduler-border form-head ">PATIENT DETAILS</legend>
	 		<div class="col-sm-12">
	 		<div class='col-md-2'>
    	
         <div class="input-group add-on fwidth mr-num" style="position:relative;bottom:10px;">
								<div class="form-group field-mrnumber has-success">
									<?= $form->field($model, 'ip_no')->textInput(['class'=>'ipnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true])->label('IP NO') ?>
									 <input type="hidden" id="pat_id" name="PATID">
									 <input type="hidden" id="subvisit_id" name="SUBVISITID">
									 <input type="hidden" id="subvisit_number" name="SUBVISITNUMBER">
									<div class="help-block"></div>
									</div>
									
									<div class="ipt input-group-btn fetch_record" value="click" onmousedown="Patient_details()">
									<span class="btn btn-default inpatient-details" style="position: relative;top: 16px;left: 0px;height: 25px!important;padding: 0px 6px!important;"><i class="glyphicon glyphicon-search"></i></span>
									
								</div>
								
							</div>
								
   			</div>
   			<div class='col-md-1'>
   				<!--<label style="visibility: hidden">MRNUMBER </label>
   				<button type="button" style="float: left;margin-right: 5px; color:#fff;" class="btn  btn-sm btn-info"   id="patient_history_detils1" onclick="Patientdetails_modal1()">  Details  </button>-->
   	<!--		</div>
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
        			
            		<?= $form->field($model, 'gender')->textInput(['class'=>'form-control  cus-fld ','readonly' => true]) ?>
				</div>
   			</div>
   			<div class='col-md-2 width-inc'>
    			
        			<?= $form->field($model, 'insurancetype')->textInput(['class'=>'form-control cus-fld','readonly' => true])->label('INSURANCE') ?>
   			</div>
   			<div class='col-md-2'>
    			<div class="form-group">
        			 <?= $form->field($newpatient, 'par_relationname')->textInput(['class'=>'form-control cus-fld','readonly' => true])->label('RELATION') ?>
				</div>
   			</div>
   			
   		</div>
   		
		</fieldset>
		
		
		
		 <div class="col-sm-12">
		    <div class="inpatientblock  desc"  style="position: relative;top: 9px;" > 
			<div class="row">
		<fieldset class="scheduler-border">
			
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
        			<?= $form->field($treatmentindividual, 'mrp')->textInput(['class'=>'form-control cus-fld','readonly'=>true])->label('Total AmT') ?>
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
   			
		</fieldset>
		</div>
		
		</div>
        </div>
		
		
		
		
		 <div id="load1" style='display:none;text-align: center;'><img  class="load-image" src="<?= Url::to('@web/loader1.gif') ?>" /></div>
		
		 
		
		
		
		
		  <div class="row" >
                  <div class="col-sm-12">
<table class="table table-bordered table-striped" id="tbUser" style="margin-top:20px;">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center hide">#</th>
                              <th rowspan="2" class="text-center">PROCEDURE NAME</th>
                              <th rowspan="2" class="text-center">RATE</th>
                              <th rowspan="2" class="text-center">QTY</th>
                              <th colspan="2" class="text-center">GST(%)</th>
                              <th colspan="2" class="text-center">GST(AMT)</th>
                              <th colspan="2" class="text-center">Discount</th>
                              <th rowspan="2" class="text-center">Total</th>
                              <th rowspan="2" class="text-center">Remove</th>
                           </tr>
                           <tr>
                              <th class="text-center">CGST(%)</th>
                              <th  class="text-center">SGST(%)</th>
                              <th class="text-center">CGST(AMT)</th>
                              <th class="text-center">SGST(AMT)</th>
                              <th class="text-center">DIS(%)</th>
                              <th class="text-center" >DIS(Amt)</th>
                           </tr>
                        </thead>
                        <tbody id='fetch_update_data'>  
                        </tbody>
                     </table>
                  </div>
               </div>
	<!-- 	<div class="row finanical">
			<fieldset class="scheduler-border">
			<legend class="scheduler-border form-head">FINANICAL DETAILS</legend>
			<div class="col-sm-3 patient_details" style="border-right: 1px solid #d6c8c8;">
								
					<div class="inner-des">
					<?= $form->field($model, 'tot_quantity')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('Qty')  ?>
							
					<?= $form->field($model, 'overall_sub_total')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('Rate') ?> 
					
					<?= $form->field($model, 'overalldiscountpercent')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'DiscountPercentCalCulation(this,event);'])->label('Less Discount(%)') ?>
					
					<?= $form->field($model, 'overalldiscountamount')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'DiscountValueCalCulation(this,event);'])->label('Less Disc Amount')  ?>
					<input type="hidden" name="total_subvalue" id="total_subvalue" value="0"> 
					
					</div>
			</div>
			<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
				<div class="inner-des">
					<?= $form->field($model, 'total_gst_percent')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('GST(%)') ?> 
					
					<?= $form->field($model, 'totalgstvalue')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('GST(AMT)') ?>
					
					<?= $form->field($model, 'overall_net_amount')->textInput(['class'=>'form-control cus-fld','readonly' => true,'required'=>true])->label('Net Amount') ?> 
					
					<?= $form->field($model, 'overalltotal')->textInput(['class'=>'form-control cus-fld number','onkeyup'=>'PaidAmountCalculation(this,event);','required'=>true])->label('Paid Amount') ?>
					
					<?= $form->field($model, 'overall_due_amount')->textInput(['class'=>'form-control cus-fld','readonly' => true])->label('Due Amount')  ?>
			</div>
			</div>
			<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
				<div class="inner-des">
          <?= $form->field($model, 'discount_authority')->dropdownlist($authority_master,['class'=>'form-control cus-fld','prompt'=>'Select'])->label('Authority')  ?>
					<?= $form->field($model, 'remarks')->textArea(['class'=>'form-control cus-fld'])->label('Remarks')  ?>
					<!-- <?= $form->field($model, 'discount_authority')->textInput(['class'=>'form-control cus-fld'])->label('Authority')  ?> -->
			<!--	</div>
			</div>
			<div class="col-sm-3" style="border-right: 1px solid #d6c8c8;">
				<div class="inner-des button-select-re">
				<button type="button" class="btn btn-success" id='saves_sucess' onclick="SaveProcedures();">Save</button>
	        	<button type="button" class="btn btn-success">Clear</button>
	        	<button type="button" class="inp btn btn-success">Close</button>
	        				
				</div>
			</div>
			</fieldset>
		</div> -->
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
      <div class="inp modal-footer">
        <button type="button" class="inp btn btn-default" data-dismiss="modal">Close</button>
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
/*var availableTags = <?= $mr_col_json; ?>;

var newpatient = <?= $new_patient_json; ?>;
var subvisit = <?= $subvisit_json; ?>;*/
var availableTags = <?= $mr_col_json; ?>;

var newpatient = [];
var subvisit = [];


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
	hidden_amt_val.push(parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val()));
});
var overall_amount=hidden_amt_val.reduce((a, b) => a + b, 0);
return overall_amount;
}


function DiscountValueCalCulation(data,event)
{
	var length_arr=$("#fetch_update_data tr").length;
	$('#intreatmentoverall-overall_due_amount').val('');
	if(length_arr > 0)
	{
		var overall_amount=TotalNetAmountAddition();
		
		if(overall_amount < data.value)
		{
			var flat_amount=overall_amount;
			var percentage_flat=parseFloat((flat_amount*100)/overall_amount);
			
			$("#fetch_update_data tr").each(function() 
			{
				var attr_id=$(this).attr('data-id');
				//Hidden JOKER 
				var hidden_net_amt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());
				
				var cal=Math.round(parseFloat((hidden_net_amt*percentage_flat)/100));
				
				var per=Math.round(parseFloat(cal*100/overall_amount));
				
				var hiden_amt_disc=hidden_net_amt-cal;
				
				$('#intreatmentindividual-discountvalue'+attr_id).val(cal);
				$('#intreatmentindividual-discount_percent'+attr_id).val(per);
				$('#intreatmentindividual-total_price'+attr_id).val(hiden_amt_disc);
			});
			OverallTotalDisAmtCalculation();
			Alertment('Discount Amount Not More Than Net Amount!!!');
		}
		else if(overall_amount >= data.value)
		{
			var flat_amount=data.value;
			var percentage_flat=parseFloat((flat_amount*100)/overall_amount);
			
			$("#fetch_update_data tr").each(function() 
			{
				var attr_id=$(this).attr('data-id');
				//Hidden JOKER 
				var hidden_net_amt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());
				
				var cal=Math.round(parseFloat((hidden_net_amt*percentage_flat)/100));
				
				var per=Math.round(parseFloat(cal*100/overall_amount));
				
				var hiden_amt_disc=hidden_net_amt-cal;
				
				$('#intreatmentindividual-discountvalue'+attr_id).val(cal);
				$('#intreatmentindividual-discount_percent'+attr_id).val(per);
				$('#intreatmentindividual-total_price'+attr_id).val(hiden_amt_disc);
				
				
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
		$('#intreatmentoverall-overalldiscountamount').val('');
		ClearAddGrid();
		Alertment('Choose PROCEDURES!!!');
	}
}


function DiscountPercentCalCulation(data,event)
{
	var length_arr=$("#fetch_update_data tr").length;
	
	$('#intreatmentoverall-overall_due_amount').val('');
	if(length_arr > 0)
	{
		if(data.value > 100)
		{
			var discount_percent=100;
			
			$('#intreatmentoverall-overalldiscountpercent').val(discount_percent);
			
			$("#fetch_update_data tr").each(function() 
			{
			 	var attr_id=$(this).attr('data-id');
			 	var total_amt_add=parseFloat($('#intreatmentindividual-rate'+attr_id).val());
			 	var total_qty=parseInt($('#intreatmentindividual-qty'+attr_id).val());
			 	var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
			 	var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
			 	var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
			 	//Hidden JOKER 
			 	var hidden_amt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());
			 	
			 	var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
			 	
			 	if(calculation > hidden_amt)
			 	{
			 		$('#intreatmentindividual-total_price'+attr_id).val(0);
			 	}
			 	else if(calculation <= hidden_amt)
			 	{
			 		var discountvalue=hidden_amt-calculation;
			 		$('#intreatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
			 	}
			 	
			 	
			 	$('#intreatmentindividual-discount_percent'+attr_id).val(discount_percent);
			 	$('#intreatmentindividual-discountvalue'+attr_id).val(calculation);
				
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
			 	var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
			 	var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
			 	var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
			 	//Hidden JOKER 
			 	var hidden_amt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());
			 	
			 	var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
			 	
			 	if(calculation > hidden_amt)
			 	{
			 		$('#intreatmentindividual-total_price'+attr_id).val(0);
			 	}
			 	else if(calculation <= hidden_amt)
			 	{
			 		var discountvalue=hidden_amt-calculation;
			 		$('#intreatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
			 	}
			 	
			 	
			 	$('#intreatmentindividual-discount_percent'+attr_id).val(discount_percent);
			 	$('#intreatmentindividual-discountvalue'+attr_id).val(calculation);
			 	
			 	
			});
			OverallTotalDiscPercentCalculation();
		}
		else if(data.value === '')
		{
			OverallTotalDiscPercentCalculation();
		}
	}
	else
	{
		$('#intreatmentoverall-overalldiscountpercent').val('');
		ClearAddGrid();
		Alertment('Choose PROCEDURES!!!');
	}
}

//add grid with discount

 function DiscountPercentCalCulationProcedure(data,event)
{

 // alert('test');
  //alert(data);
  var length_arr=$("#fetch_update_data tr").length;
  
  $('#intreatmentoverall-overall_due_amount').val('');
  if(length_arr > 0)
  {
    if(data> 100)
    {
      var discount_percent=100;
      
      $('#intreatmentoverall-overalldiscountpercent').val(discount_percent);
      
      $("#fetch_update_data tr").each(function() 
      {
        var attr_id=$(this).attr('data-id');
        var total_amt_add=parseFloat($('#intreatmentindividual-rate'+attr_id).val());
        var total_qty=parseInt($('#intreatmentindividual-qty'+attr_id).val());
        var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
        var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
        var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
        //Hidden JOKER 
        var hidden_amt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());
        
        var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
        
        if(calculation > hidden_amt)
        {
          $('#intreatmentindividual-total_price'+attr_id).val(0);
        }
        else if(calculation <= hidden_amt)
        {
          var discountvalue=hidden_amt-calculation;
          $('#intreatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
        }
        
        
        $('#intreatmentindividual-discount_percent'+attr_id).val(discount_percent);
        $('#intreatmentindividual-discountvalue'+attr_id).val(calculation);
        
      });
      OverallTotalDiscPercentCalculation();
      
      Alertment('Discount Percentage Not More Than 100%!!!');
    }
    else if(data<= 100)
    {
      var discount_percent=data;
      $("#fetch_update_data tr").each(function() 
      {
        var attr_id=$(this).attr('data-id');
        var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
        var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
        var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
        //Hidden JOKER 
        var hidden_amt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());
        
        var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
        
        if(calculation > hidden_amt)
        {
          $('#intreatmentindividual-total_price'+attr_id).val(0);
        }
        else if(calculation <= hidden_amt)
        {
          var discountvalue=hidden_amt-calculation;
          $('#intreatmentindividual-total_price'+attr_id).val(discountvalue.toFixed(2));
        }
        
        
        $('#intreatmentindividual-discount_percent'+attr_id).val(discount_percent);
        $('#intreatmentindividual-discountvalue'+attr_id).val(calculation);
        
        
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
    $('#intreatmentoverall-overalldiscountpercent').val('');
    ClearAddGrid();
    Alertment('Choose PROCEDURES!!!');
  }
}

//remove function

function AddtoGridProcedure(){


      $("#fetch_update_data tr").each(function() 
      {

       
        var attr_id=$(this).attr('data-id');
        var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
        var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
        var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
        //Hidden JOKER 
        var hidden_amt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());

        //alert(hidden_amt);
        
        //var calculation=parseFloat((hidden_amt*discount_percent)/100).toFixed(2);
          $('#intreatmentindividual-total_price'+attr_id).val(hidden_amt);
        
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
	var treatment=$('#intreatmentindividual-treatment_id').val();
	var rate=$('#intreatmentindividual-rate').val();
	var qty=$('#intreatmentindividual-qty').val();
	var treat_id=$('#treatment_id').val();
	var gst=$('#intreatmentindividual-gstpercent').val();
	var gst_amt=$('#intreatmentindividual-gstvalue').val();
	//var tax_grouping=
	var total_subvalue=parseFloat($('#total_subvalue').val());
	var tot_rate=rate*qty;
	var sub_totval=tot_rate+total_subvalue;
	$('#total_subvalue').val(tot_rate+total_subvalue);	
	
	
	if(treatment !== '' && rate !== '' && qty !== '' && treat_id !== '' && gst !== '' && gst_amt !== '')
	{
   var discountpercent=$('#intreatmentoverall-overalldiscountpercent').val();

  // alert(discountpercent);
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
		
		$('#intreatmentindividual-mrp').val(over_net);
		$('#intreatmentindividual-total_price').val(over_net);
	//$('#total_subvalue').val(parseFloat($('#total_subvalue').val())+total_sub);

		
var markup = "<tr class='save_data_table' data-id="+treat_id+" id='table_del"+treat_id+"'>"
+"<td><div class='trunctext wd100'>"+treatment+"</div></td>"
+"<td><input type='hidden' name='treatmentprimeid[]' id='treatmentprimeid"+treat_id+"' value='"+treat_id+"'>"
+"<input type='text'  style='text-align:right;' id='intreatmentindividual-rate"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[rate][]' value='"+rate+"'></td>"
+"<td><input type='text' style='text-align:right;' id='intreatmentindividual-qty"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[qty][]' value='"+qty+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-cgst_percent"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[cgst_percent][]' value='"+common_gst_percent+"'></td>"																																
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-sgst_percent"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[sgst_percent][]' value='"+common_gst_percent+"'></td>"	
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-cgst_value"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[cgst_value][]' value='"+common_gst_amt+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-sgst_value"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[sgst_value][]' value='"+common_gst_amt+"'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-discount_percent"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[discount_percent][]' value='0'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-discountvalue"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[discountvalue][]' value='0'></td>"
+"<td><input type='text'  style='text-align:right;' id='intreatmentindividual-total_price"+treat_id+"' readonly='readonly' class='form-control' name='InTreatmentIndividual[total_price][]' value='"+over_net+"'>"
+"<input type='hidden' id='intreatmentindividual-total_price_joker"+treat_id+"' class='hidden_price form-control' name='InTreatmentIndividual[hidden_total_price][]' value='"+over_net+"'></td>"
+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+treat_id+" id='delrow"+treat_id+"'><i class='fa fa-remove'></i></button></td></tr>";
																	
$("#fetch_update_data").append(markup); 		

OverallTotalCalculation();

if(discountpercent!=''){
 // alert(discountpercent);
  DiscountPercentCalCulationProcedure(discountpercent,window.event);

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
$('#intreatmentoverall-tot_quantity').val(overall_total_qty);
$('#intreatmentoverall-overall_sub_total').val(overall_total_amount);
//$('#intreatmentoverall-overalldiscountpercent').val(overall_disc_percentage);
//$('#intreatmentoverall-overalldiscountamount').val(overall_disc_amount);
/*$('#intreatmentoverall-overall_net_amount').val(overall_net_amount);
$('#intreatmentoverall-overalltotal').val(overall_net_amount);*/
//GST
$('#intreatmentoverall-total_gst_percent').val(gst_percent.toFixed(2));
$('#intreatmentoverall-totalgstvalue').val(gst_amount.toFixed(2));


var priceamountt=parseFloat($('#intreatmentoverall-overall_sub_total').val());
var gstamonutt=parseFloat($('#intreatmentoverall-totalgstvalue').val());
var netamountfinal=(priceamountt+gstamonutt);
$('#intreatmentoverall-overall_net_amount').val(netamountfinal.toFixed(2));
$('#intreatmentoverall-overalltotal').val(netamountfinal.toFixed(2));





$('#intreatmentoverall-overall_due_amount').val('');
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
 	var total_amt_add=parseFloat($('#intreatmentindividual-rate'+attr_id).val());
 	var total_qty=parseInt($('#intreatmentindividual-qty'+attr_id).val());
 	var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
 	var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
 	var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
 	
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
$('#intreatmentoverall-tot_quantity').val(overall_total_qty);
$('#intreatmentoverall-overall_sub_total').val(overall_total_amount);
//$('#intreatmentoverall-overalldiscountpercent').val(overall_disc_percentage);
$('#intreatmentoverall-overalldiscountamount').val(overall_disc_amount);
$('#intreatmentoverall-overall_net_amount').val(overall_net_amount.toFixed(2));
$('#intreatmentoverall-overalltotal').val(overall_net_amount.toFixed(2));
$('#intreatmentoverall-overall_due_amount').val('');
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
 	var total_amt_add=parseFloat($('#intreatmentindividual-rate'+attr_id).val());
 	var total_qty=parseInt($('#intreatmentindividual-qty'+attr_id).val());
 	var disc_perct=parseFloat($('#intreatmentindividual-discount_percent'+attr_id).val());
 	var disc_amunt=parseFloat($('#intreatmentindividual-discountvalue'+attr_id).val());
 	var net_amunt=parseFloat($('#intreatmentindividual-total_price'+attr_id).val());
 	
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
$('#intreatmentoverall-tot_quantity').val(overall_total_qty);
$('#intreatmentoverall-overall_sub_total').val(overall_total_amount);
$('#intreatmentoverall-overalldiscountpercent').val(overall_disc_percentage);
//$('#intreatmentoverall-overalldiscountamount').val(overall_disc_amount);
$('#intreatmentoverall-overall_net_amount').val(overall_net_amount);
$('#intreatmentoverall-overalltotal').val(overall_net_amount);
$('#intreatmentoverall-overall_due_amount').val('');
}




function PaidAmountCalculation(data,event) 
{
	var paid_amount=data.value;
	var overall_net_amount=0;
	
	$('#intreatmentoverall-overalldiscountpercent').val('');
	$('#intreatmentoverall-overalldiscountamount').val('');
	
	$("#fetch_update_data tr").each(function() 
	{
	 	var attr_id=$(this).attr('data-id');
	 	var net_amunt=parseFloat($('#intreatmentindividual-total_price_joker'+attr_id).val());
	 	if(!isNaN(net_amunt))
	 	{
	 		overall_net_amount=overall_net_amount+net_amunt;
	 	}
	});
	$('#intreatmentoverall-overall_net_amount').val(overall_net_amount.toFixed(2));
	if(overall_net_amount >= paid_amount)
	{
		var amount=overall_net_amount-paid_amount;
		$('#intreatmentoverall-overall_due_amount').val(amount.toFixed(2));	
	}
	else if(overall_net_amount < paid_amount)
	{
		$('#intreatmentoverall-overalltotal').val(overall_net_amount);
		$('#intreatmentoverall-overall_due_amount').val(0);
		Alertment('Paid Amount Not Greater Than Net Amount');
	}
	
	if(data.value === '')
	{
		$('#intreatmentoverall-overalltotal').val(overall_net_amount);
		$('#intreatmentoverall-overall_due_amount').val(0);
	}
	
	
}

$(".ipnumber").typeahead({
  
  source: function(query,result) {
        $.ajax({
          url:'<?php echo Yii::$app->homeUrl . "?r=in-treatment-overall/ajaxipnumber";?>',
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
          url:'<?php echo Yii::$app->homeUrl . "?r=in-treatment-overall/ajaxipnumberselectblockipentries&id=";?>'+result,
          method:'POST',
          dataType:'json',
          success:function(data)
          {   $('#load1').hide();
            
            //$('#blockipentries-patient_type').val(data[0]['patient_type']);
           //alert(data[0]['ip_no']);
            $('#blockipentries-panel_type').val(data[0]['panel_type']);
            $('#blockipentries-mr_no').val(data[0]['mr_no']);
            $('#intreatmentoverall-dob').val(formatDate(data[0]['dob']));
            $('#intreatmentoverall-name').val(data[0]['patient_name']);
            $('.ipnumber').val(data[0]['ip_no']);
            //$('#blockipentries-age').val(Agecalc(data[0]['dob']));
            $('#intreatmentoverall-gender').val(data[0]['sex']);
            $('#blockipentries-marital_status').val(data[0]['marital_status']);
            $('#blockipentries-relation_suffix').val(data[0]['relation_suffix']);
            $('#newpatient-par_relationname').val(data[0]['relative_name']);
            $('#blockipentries-address').val(data[0]['address']+', '+data[0]['city']+', '+data[0]['state']+', '+data[0]['pincode']);
           
            $('#blockipentries-pincode').val(data[0]['pincode']);
            $('#blockipentries-phone_no').val(data[0]['phone_no']);
          
              var fromDate = new Date(data[0]['created_date']); 
              var createddate = formatDate(fromDate);
              var createdtime = formatDate2(fromDate);
               //alert(createdtime);
            //var createtime = formatAMPM(fromDate);
       //   $('#blockipentries-admit_date').val(createddate);
        //  $('#blockipentries-admit_time').val(createtime);
          
          
          }
        })
    }
});
function Agecalc(date) {
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();
  var dateString=formatDate1(date); 
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
    ageString = age.years;
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years;
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years;
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";
  
  $('#year_dob').val(age.years);
  $('#month_dob').val(age.months);
  $('#date_dob').val(age.days);
  return ageString;
}
/*
$(".mrnumber").typeahead({

minLength: 1,
delay: 5,
source: availableTags,
autoSelect: true,
displayText: function(item)
{
	 return item.mrnumber;
},
afterSelect: function(item) 
{
	
	$('#intreatmentoverall-name').val('');
	$('#newpatient-par_relationname').val('');
	$('#intreatmentoverall-dob').val('');
	$('#intreatmentoverall-gender').val('');
	$('#intreatmentoverall-insurancetype').html('');
	$('#pat_id').val('');
	$('#subvisit_id').val('');
	$('#subvisit_number').val('');
	
	var new_pat=newpatient[item.mrnumber];
	if(new_pat !== '')
	{
		var formatdate= formatDate(newpatient[item.mrnumber]['dob']);
		$('#intreatmentoverall-name').val(newpatient[item.mrnumber]['patientname']);
		$('#newpatient-par_relationname').val(newpatient[item.mrnumber]['par_relationname']);
		$('#intreatmentoverall-dob').val(formatdate);
		$('#intreatmentoverall-gender').html('<option value='+newpatient[item.mrnumber]['pat_sex']+'>'+newpatient[item.mrnumber]['pat_sex']+'</option>');
		if(subvisit[item.subnumber]['insurance_type'] !== '')
		{
			var insurance_id=subvisit[item.subnumber]['insurance_type'];
			var ins_type=(Insurance[insurance_id]['insurance_type']=== '' ? "" : Insurance[insurance_id]['insurance_type']);
			$('#intreatmentoverall-insurancetype').html('<option value='+insurance_id+'>'+ins_type+'</option>');
		}
		
		$('#pat_id').val(subvisit[item.subnumber]['pat_id']);
		$('#subvisit_id').val(subvisit[item.subnumber]['sub_id']);
		$('#subvisit_number').val(subvisit[item.subnumber]['sub_visit']);
	}
	
	$('#intreatmentindividual-treatment_id').focus();
} 
});*/

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
	$('#intreatmentindividual-qty').val(1);
	$('#intreatmentindividual-rate').val(item.amount);
	
	$('#intreatmentindividual-gstpercent').val(tax_percent);
	$('#intreatmentindividual-rate').focus();
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
$('#intreatmentoverall-mrnumber').focus();

});


function Patient_details() 
{ 
	$('#example_filter input.form-control.input-sm').focus();
	$modal = $('#patient_hist-modal');
	$modal.modal('show');
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

function SubVisitFetch(subvisitid,mrnumber) 
{
	if(subvisitid !== '' && mrnumber !== '')
	{
		$('#intreatmentoverall-name').val('');
		$('#newpatient-par_relationname').val('');
		$('#intreatmentoverall-dob').val('');
		$('#intreatmentoverall-gender').val('');
		$('#intreatmentoverall-insurancetype').html('');
		
		$('#pat_id').val('');
		$('#subvisit_id').val('');
		$('#subvisit_number').val('');
		
		
		var formatdate= formatDate(newpatient[mrnumber]['dob']);
		$('#intreatmentoverall-name').val(newpatient[mrnumber]['patientname']);
		$('#newpatient-par_relationname').val(newpatient[mrnumber]['par_relationname']);
		$('#intreatmentoverall-dob').val(formatdate);
		$('#intreatmentoverall-gender').html('<option value='+newpatient[mrnumber]['pat_sex']+'>'+newpatient[mrnumber]['pat_sex']+'</option>');
		$('#intreatmentoverall-mrnumber').val(mrnumber);
		
		if(subvisit[subvisitid]['insurance_type'] !== '')
		{
			var insurance_id=subvisit[subvisitid]['insurance_type'];
			var ins_type=(Insurance[insurance_id]['insurance_type']=== '' ? "" : Insurance[insurance_id]['insurance_type']);
			$('#intreatmentoverall-insurancetype').html('<option value='+insurance_id+'>'+ins_type+'</option>');
		}
		
		$('#pat_id').val(subvisit[subvisitid]['pat_id']);
		$('#subvisit_id').val(subvisitid);
		$('#subvisit_number').val(subvisit[subvisitid]['sub_visit']);
		
	    $modal = $('#patient_hist-modal');
		$modal.modal('hide');
	   	$('#intreatmentindividual-treatment_id').focus();
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
     			$('#intreatmentoverall-mrnumber').focus('');
     			Alertment('Invalid MR Number !!! Check It');
     		}
     		else if(obj[0] === 'Set')
     		{
     			EmptyPatientDetails();
     			$('#intreatmentoverall-mrnumber').val(obj[2]['mr_no']);
     			$('#intreatmentoverall-name').val(obj[2]['patientname']);
				$('#newpatient-par_relationname').val(obj[2]['par_relationname']);
				$('#intreatmentoverall-dob').val(formatDate(obj[2]['dob']));
				$('#intreatmentoverall-gender').html('<option value='+obj[2]['pat_sex']+'>'+obj[2]['pat_sex']+'</option>');
			
				if(obj[1]['insurance_type'] !== '')
				{
				   $('#intreatmentoverall-insurancetype').html('<option value='+Insurance[obj[1]['insurance_type']]['insurance_typeid']+'>'+Insurance[obj[1]['insurance_type']]['insurance_type']+'</option>');
				}
				$('#pat_id').val(obj[1]['pat_id']);
				$('#subvisit_id').val(obj[1]['sub_id']);
				$('#subvisit_number').val(obj[1]['sub_visit']);
				$('#intreatmentoverall-mrnumber').val(obj[1]['mr_number']);
				$('#intreatmentindividual-treatment_id').focus();
				var lastdate=obj[3];
				Alertment('Last Visiting is '+lastdate+'');
     		}
	     }
		 });
	}	
}


function EmptyPatientDetails()
{
		$('#intreatmentoverall-name').val('');
		$('#newpatient-par_relationname').val('');
		$('#intreatmentoverall-dob').val('');
		$('#intreatmentoverall-gender').val('');
		$('#intreatmentoverall-insurancetype').html('');
		$('#pat_id').val('');
		$('#subvisit_id').val('');
		$('#subvisit_number').val('');
		$('#intreatmentoverall-mrnumber').val('');
	
		
}


function EmptyESC(data,event) 
{
  	if(data.value === '')
  	{
  		$('#intreatmentindividual-treatment_id').val('');
  		$('#intreatmentindividual-rate').val('');
  		$('#intreatmentindividual-qty').val('');
  		$('#intreatmentindividual-mrp').val('');
  		$('#intreatmentindividual-total_price').val('');
  		$('#intreatmentindividual-gstpercent').val('');
  		$('#intreatmentindividual-gstvalue').val('');
  		
  		$('#treatment_id').val('');
  		$('#intreatmentindividual-treatment_id').focus();
  	}
  	
  	if(event.keyCode === 27)
  	{
  		$('#intreatmentindividual-treatment_id').val('');
  		$('#intreatmentindividual-rate').val('');
  		$('#intreatmentindividual-qty').val('');
  		$('#intreatmentindividual-mrp').val('');
  		$('#intreatmentindividual-total_price').val('');
  		$('#intreatmentindividual-gstpercent').val('');
  		$('#intreatmentindividual-gstvalue').val('');
  		
  		$('#treatment_id').val('');
  		$('#intreatmentindividual-treatment_id').focus();
  	}
}

function ClearAddGrid() 
{
$('#intreatmentindividual-treatment_id').val('');
$('#intreatmentindividual-rate').val('');
$('#intreatmentindividual-qty').val('');
$('#intreatmentindividual-mrp').val('');
$('#intreatmentindividual-total_price').val('');
$('#intreatmentindividual-gstpercent').val('');
$('#intreatmentindividual-gstvalue').val('');


$('#treatment_id').val('');
$('#intreatmentindividual-treatment_id').focus();
}

function RateCalCulation(data,event)
{
	var procedures=$('#intreatmentindividual-treatment_id').val();
  var rate_val=$('#intreatmentindividual-rate').val();   
	var qty=$('#intreatmentindividual-qty').val();
	var gst=$('#intreatmentindividual-gstpercent').val();
  
   if(rate_val =="0")
    {
      ClearAddGrid();
      alert('Rate Field Is must be greater than 0.');
    }
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
				$('#intreatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate_qty*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#intreatmentindividual-mrp').val(tot);
				$('#intreatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate_qty*qty).toFixed(2);
				$('#intreatmentindividual-mrp').val(multiply);
				$('#intreatmentindividual-total_price').val(multiply);
			}
			
			
			$('#intreatmentindividual-qty').focus();
		
	}
	}
	else if(procedures === '')
	{
		ClearAddGrid();
		alert('Procedures Field Is Mandatory');
	}else if(data.value === '')
  	{
  		$('#intreatmentindividual-rate').val('');
  		
  	}

  	if(event.keyCode === 27)
  	{
  		$('#intreatmentindividual-rate').val('');
  		
  	}
}


function QtyCalCulation(data,event)
{
	var procedures=$('#intreatmentindividual-treatment_id').val();
	var rate=$('#intreatmentindividual-rate').val();
  var qty_val=$('#intreatmentindividual-qty').val();
	var gst=$('#intreatmentindividual-gstpercent').val();

  if(qty_val =="0")
    {
      ClearAddGrid();
      alert('Rate Field Is Mandatory');
    }
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
				$('#intreatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#intreatmentindividual-mrp').val(tot);
				$('#intreatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate*qty).toFixed(2);
				$('#intreatmentindividual-mrp').val(multiply);
				$('#intreatmentindividual-total_price').val(multiply);
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
				$('#intreatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#intreatmentindividual-mrp').val(tot);
				$('#intreatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate*qty).toFixed(2);
				$('#intreatmentindividual-mrp').val(multiply);
				$('#intreatmentindividual-total_price').val(multiply);
			}
		}
		else if(data.value === '' && rate !== '' && gst !== '')
		{
			$('#intreatmentindividual-qty').val(1);
			var qty=parseInt(data.value);
			rate=parseFloat(rate);
			
			var multiply=parseFloat(rate*qty);
			
			//GST CALCULATION
			if(rate !== 0)
			{
				var calc=parseFloat((gst*multiply)/100);
				$('#intreatmentindividual-gstvalue').val(calc);
				
				var multiply=parseFloat(rate*qty);
				var tot=parseFloat(multiply+calc);
				
				$('#intreatmentindividual-mrp').val(tot);
				$('#intreatmentindividual-total_price').val(tot);
			}
			else
			{
				
				var multiply=parseFloat(rate*qty).toFixed(2);
				$('#intreatmentindividual-mrp').val(multiply);
				$('#intreatmentindividual-total_price').val(multiply);
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
		$('#intreatmentindividual-qty').val('');
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
 	var overall_discount_percentage=$('#intreatmentoverall-overalldiscountpercent').val();
 	var overall_discount_amount=$('#intreatmentoverall-overalldiscountamount').val();
 	
 	if(overall_discount_percentage !== '' && overall_discount_amount !== '')
 	{
 		$('#intreatmentoverall-remarks').attr('required','required');
 		$('#intreatmentoverall-discount_authority').attr('required','required');
 	}
 	else if(overall_discount_percentage === '' && overall_discount_amount === '')
 	{
 		$('#intreatmentoverall-remarks').removeAttr('required','required');
 		$('#intreatmentoverall-discount_authority').removeAttr('required','required');
 	}
 	
 	var valid=$("#w0").valid();  
	if(valid === true)
	{
		//$('#load1').show();
		$.ajax({	
			     type: "POST",
 				 url: "<?php echo Yii::$app->homeUrl . "?r=in-treatment-overall/create";?>",
 				 data: $("#w0").serialize(),
			     success: function (result) 
			     {
			     	if(result === 'S')
			     	{
			     		$('#load1').hide();
			     		alert('Saved Success');
			     		//$('#saves_sucess').attr('disabled','disabled');
			     	}	
			     }
		 });
	}else{
    alert();
  }
 }
 
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
           	SaveProcedures();
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
		//alert("test");
		var data_addid = $(this).attr('data_delete_row')
  	var item_less=1;
  	var total_items=parseInt($('#intreatmentindividual-qty'+data_addid).val());
		var total_gst_pre=(parseFloat($('#intreatmentindividual-cgst_percent'+data_addid).val())+parseFloat($('#intreatmentindividual-sgst_percent'+data_addid).val()));
		var total_gst_val=(parseFloat($('#intreatmentindividual-cgst_value'+data_addid).val())+parseFloat($('#intreatmentindividual-sgst_value'+data_addid).val()));
		var total_sub_total=parseFloat($('#intreatmentindividual-total_price'+data_addid).val()).toFixed(2);
		var rate=parseFloat($('#intreatmentindividual-rate'+data_addid).val());
    
		$('#intreatmentoverall-tot_quantity').val(parseInt($('#intreatmentoverall-tot_quantity').val())-total_items);
		$('#intreatmentoverall-overall_sub_total').val(parseFloat($('#intreatmentoverall-overall_sub_total').val()).toFixed(2)-rate);
		$('#intreatmentoverall-total_gst_percent').val(parseFloat($('#intreatmentoverall-total_gst_percent').val()).toFixed(2)-parseFloat(total_gst_pre).toFixed(2));
		$('#intreatmentoverall-totalgstvalue').val(parseFloat($('#intreatmentoverall-totalgstvalue').val()).toFixed(2)-parseFloat(total_gst_val).toFixed(2));
		$('#intreatmentoverall-overall_net_amount').val(parseFloat($('#intreatmentoverall-overall_net_amount').val()).toFixed(2)-total_sub_total);
		$('#intreatmentoverall-overalltotal').val(parseFloat($('#intreatmentoverall-overall_net_amount').val()));
    $('#intreatmentoverall-overall_due_amount').val('0');

		//$('#intreatmentoverall-overalldiscountpercent').val();
		//$('#intreatmentoverall-overalldiscountamount').val();
		$('#table_del'+data_addid).remove();

     var discountpercent=$('#intreatmentoverall-overalldiscountpercent').val();
   // alert(discountpercent);
    AddtoGridProcedure();
    if(discountpercent!=''){
 // alert(discountpercent);
  DiscountPercentCalCulationProcedure(discountpercent,event);

 }
		        
 });
 
 function Patientdetails_modal1()
 {
 	
 	//$modal = $('#patient_hist-modal1');
	//$modal.modal('show');
	var mrnumber=$("#intreatmentoverall-mrnumber").val();
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
	   $('#intreatmentoverall-overalldiscountpercent').click(function() {  	 	 
		 $(".enable-textbox-percentage").addClass('active');
         $(".enable-textbox-flat").removeClass('active');		 
       });
	   
	   $('#intreatmentoverall-overalldiscountamount').click(function() { 	     
         $(".enable-textbox-flat").addClass('active');
         $(".enable-textbox-percentage").removeClass('active');		 
       });
	   
	});
</script>

