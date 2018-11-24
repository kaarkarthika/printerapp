<?php
	
   use yii\helpers\Html;
   use yii\grid\GridView;
   use yii\widgets\Pjax;
   use yii\bootstrap\Modal;
   use yii\helpers\Json;
   use yii\helpers\Url;
   use yii\widgets\ActiveForm;
   use yii\helpers\ArrayHelper;
	use backend\models\Product;
	use backend\models\Insurance;
	use kartik\typeahead\TypeaheadBasic;
	use kartik\typeahead\Typeahead;

    use backend\models\Composition;
   
    use yii\jui\AutoComplete;
	use yii\web\JsExpression;
   
    $this->title = 'Modules';
    $session = Yii::$app->session;
	$insurance=Insurance::find()->where(['is_active'=>1])->asArray()->all();
							
   ?>
   <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
   <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>
   <link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />
  
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
.w-55{width:55px;}
  </style>  
  
  
 
<link href="<?php echo Url::base(); ?>/css/billing.css" rel="stylesheet" type="text/css" />

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
 
.button-select-re button.btn.btn-success {
    position: relative;
    top: 40px;
}

.financial .inner-des label {
    width: 40%;
    float: left;
    text-align: right;
    margin-right: 10px;    margin-bottom: 1px;
	color:#444;
}
.financial .inner-des input{
	text-align:right;
}
.financial .inner-des input {
    width: 55%;
}
.financial .inner-des label.error {
    width: 100%;
    text-align: right;
}
.inner-des textarea{
	width:55%;
}
.input-sm{
	height:20px!important;
}
</style>
<script type="text/javascript">
   /* function date_time(id)
   {
      date = new Date;
      year = date.getFullYear();
      month = date.getMonth();
      months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
      d = date.getDate();
      day = date.getDay();
      days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
      h = date.getHours();
      if(h<10)
      {
              h = "0"+h;
      }
      m = date.getMinutes();
      if(m<10)
      {
              m = "0"+m;
      }
      s = date.getSeconds();
      if(s<10)
      {
              s = "0"+s;
      }
      result = ''+days[day]+', '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
      document.getElementById(id).innerHTML = result;
      setTimeout('date_time("'+id+'");','1000');
      return true;
   }
   */
   
</script>
<?php $form = ActiveForm::begin(['id' => 'saved_data_value_ajax']); ?> 
<div class="container">
   <div class="row">
      <div class="col-sm-12">
	   <div class="row">
         <div class="panel panel-border panel-custom">
            <div class="panel-heading"></div>
            <div class="panel-body">
			  <span> <strong id='fetch_bill'><?php echo $billformat; ?></strong></span>
			    &nbsp;&nbsp;&nbsp;&nbsp;<div class="radio radio-info radio-inline">
		          <input type="radio" id="inPatient" class="inPatient" value="inpatient" name="patient" checked="" >
		          <label for="inlineRadio1" id="inPatient1">  MR Number <i><strong>[Alt+2]<strong></i></label>
		        </div>
				&nbsp;&nbsp;&nbsp;&nbsp;
												
			    <div class="radio radio-info radio-inline">
		           <input type="radio" id="outPatient" class="outPatient" value="outpatient" name="patient"   >
		           <label for="inlineRadio1" id="outPatient1">  Patient <i><strong>[Alt+1]</strong></i> </label>
		        </div>&nbsp;
		        <div class="radio radio-info radio-inline">
		           <input type="radio" id="tempPatient" class="tempPatient" value="temppatient" name="patient"  >
		           <label for="inlineRadio1" id="tempPatient1"> Temporary-Sales  <i><strong>[Alt+3]<strong></i></label>
		        </div>
		        <!--<div class="radio radio-info radio-inline">  
			        <button type="button" class="btn btn-xs btn-warning refresh sales-refresh-btn"   data-toggle="tooltip" title="Refresh" class="btn btn-success" tooltip='Refresh' name="refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button>
			        <i><strong><small>[Alt+r]</small><strong></i>
			    </div>  -->			    
            </div>
        </div>
       </div>
      </div>
      <div class="row ">
		<div class="col-sm-12 mt-5">
	      <div class=" ">
            <div class="panel panel-border panel-custom">
              <div class="panel-heading"></div>
              <div class="panel-body">
			     <div class="col-sm-12"  style="position: relative;top:4px;" >
					<div class="outpatientblock  desc" hidden >
					  <div class="row">
					     <!-- <div class="col-sm-1"></div> -->
					     <div class="form-group col-sm-3">
                          <div class="input-group fwidth">
                           <span class="ipt input-group-btn">
                          	<select class="btn text-cap " id='sur_name' onchange="AutomaticRelation();" name='sur_name' tabindex="4"  >
                                <option value="Mr">Mr</option>
								<option value="Miss">Miss</option>
								<option value="Baby">Baby</option>
								<option value="Mrs">Mrs</option>
								<option value="Master">Master</option>
								<option value="Baby Of">Baby Of</option>
								<option value="Empty">Empty</option>
								<option value="Dr">Dr</option>
								<option value="Ms.">Ms.</option>
                            </select>
                           </span>
                           <input type="text" placeholder="Patient Name" name='patient_name' class="form-control text-cap fwidth key outrefrsh" id='out_patient_name' tabindex="1">
                       	  </div>
                          <span class='out_pat_validated' hidden style="color:red">Enter Patient Details</span>
                         </div>
                      	 <div class="form-group col-sm-1">
                         	<input type="text" name='sales_dob' id='sales_pat_dob' class="datepicker form-control fwidth key outrefrsh"  placeholder="DOB"  tabindex="3" >
                         </div>  
                        
                         <div class="form-group col-sm-1">
                         	<input type="text" name='sales_age' id='sales_pat_age' class="form-control fwidth key outrefrsh number" onkeyup='Datecalculation(this.value);'; placeholder="AGE" maxlength="3" tabindex="3" >
                         </div>  
                        
                         <div class="form-group col-sm-1">
                         	<select class="form-control" id='patient_gender' name='patient_gender' tabindex="4"  >
                                <option value="Male">Male</option>
								<option value="Female">Female</option>
                            </select>
                         </div>  
                        
                        
                         <div class="form-group col-sm-2">
                         	<input type="text" name='mobile_number' id='out_pat_mob' class="form-control fwidth key number outrefrsh phone" placeholder="Mobile Number" onkeypress="phoneno()" maxlength="10" tabindex="3" >
                           <span class='out_num_validated' hidden style="color:red">Enter Mobile Number</span>
                         </div>

                        
						 <div class="form-group col-sm-2">
                         	<input type="text" name='out_patient_address' id='out_patient_address' class="form-control fwidth key outrefrsh" placeholder="Address"  tabindex="3" >
                         </div>
                        
                         <div class="form-group col-sm-2">
                         	<select class="form-control text-cap" name='sales_patient_type' tabindex="4"  >
                         		<?php if(isset($patient_type)){
                                foreach($patient_type as $key => $value){ ?>
                               	<option value='<?php echo $key;?>'><?php echo  $value; ?></option>
                               <?php }  }?>
                            </select>
                         </div>
                        
						<!--div class="form-group col-sm-2">
                       
                           <div class="input-group fwidth " >
                              <span class="ipt input-group-btn  ">
                                 <select class="btn text-cap " tabindex="4"  >
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                              <input placeholder="Doctor Name" type="text" name='doctor_name' id='out_pat_doc' class="form-control text-cap outrefrsh" tabindex="5">
                           </div>
                        </div-->
                        
                        <!--div class="form-group col-sm-2"  >
                         
                           <select   class="form-control fwidth  text-cap" name='insurance_type_ins' prompt="Selct Insurance" id="pat_insurance_ins" tabindex="6">
                              <option value="">--Insurance--</option>
                             <?php 
                             	
								if(!empty($insurance))
								{
									foreach ($insurance as $key => $value) 
									{
                             ?>
                             <option value="<?php echo $value['insurance_typeid']?>"><?php echo $value['insurance_type']?></option>
                             <?php }} ?>
                           </select>
                        </div-->
                        
                        </div>
                      </div>						
					 </div>
					 
                     <div class="col-sm-12"     >
					    <div class="inpatientblock  desc"  style="position: relative;top: 9px;" > 
						  <div class="row">
						    <div class="col-sm-3">
						      <div class="form-group col-sm-7 " >
                                <div class="input-group add-on fwidth" >
                           		  <input class=" mrnumber  form-control mrn inrefrsh number" placeholder="MRN Search" name="mr_number"  onkeyup="Patient_details(this.value,event)"  id="mrnumber" type="text" tabindex="8">
								  <input class="form-control" name="hidden_mr_number"   id="hiddenmrnumber" type="hidden">
								  <div class="ipt input-group-btn fetch_record" value='click'>
									<span class="btn btn-default inpatient-details"  ><i class="glyphicon glyphicon-search"></i></span>
								  </div>								
							     </div>
								 <span id='mr_validated' style="color:red" hidden>Invalid MR Number</span>
							     <span class='in_pat_validated' style="color:red" hidden>Enter Patient Record</span>
                               </div>
						
						       <div class="form-group col-sm-5" style="position: relative;  z-index: 1;    padding: 0;">
							      <!-- <button type="button" style="float: left;background: #800080 !important;   margin-right: 5px;margin-top:2px;" class="btn  btn-xs" id="patient_history_detils" disabled onclick='Patient_modal()'><i class="glyphicon glyphicon-user" aria-hidden="true"></i> </button> -->
						          <button type="button" class="btn btn-primary btn-xs" style="margin-top:2px;"id="history_detils">Details</button>						
						       </div>
						      </div>
						
						      <div class="col-sm-9">
							    <div class="row">
								  <div class="col-sm-9">
								    <div class="col-sm-4">
									  <div class="form-group">                     
                                         <input type="text" placeholder="Patient Name" class="form-control text-cap fwidth mrn inrefrsh" name='in_patient' id="pat_name" readonly>          
                                      </div>
						              <div class="form-group">                     
                                         <input type="text" placeholder="Mobile Number" class="form-control fwidth mrn number phone inrefrsh" name='in_patient_mobile'   onkeypress="phoneno()"  id="pat_mob" readonly>
                                      </div>
									</div>
								    <div class="col-sm-4">
										
						           <div class="form-group ">                       
                                     <div class="input-group fwidth">
                                        <span class="ipt input-group-btn">
                                          <select class="btn mrn text-cap"  disabled>
                                            <option>Mr</option>
                                            <option>Ms</option>
                                            <option>Mrs</option>
                                          </select>
                                       </span>
                                       <input type="text" placeholder="Doctor Name" class="form-control mrn inrefrsh text-cap" name='in_doctor_name' id="pat_doctor"  readonly>
                                     </div>
                                    </div>						
                                    <div class=" form-group "> 
                                    	<!-- <input type="text" placeholder="Insurance Type" class="form-control fwidth key mrn inrefrsh" name='insurance_type' id="pat_insurance" readonly> -->
                                    	
                                       <select placeholder="Insurance Type" class="form-control fwidth key mrn inrefrsh text-cap" name='insurance_type' id="pat_insurance" readonly>   
                                       </select>
                                    </div>
									</div>
								    <div class="col-sm-4">
								     <div class="form-group">
                                       <input type="text" placeholder="Date of Birth" class="form-control fwidth key mrn inrefrsh" name='date_of_birth' id="pat_dob" readonly>
                                     </div>
									 <div class="form-group ">		                        
									 	<input type="text" placeholder="Gender" class="form-control fwidth key mrn inrefrsh" name='Gender' id="gender" readonly>
		                               <!-- <select placeholder="Gender" class="form-control fwidth key mrn inrefrsh text-cap" name='Gender' id="gender" readonly>  
		                               </select> -->
		                            </div>
									</div>
								 </div>
								 <div  class="col-sm-3">
								    <div class="form-group col-sm-12">
		                               <!-- <input type="text" placeholder="Address" class="form-control fwidth key mrn inrefrsh" name='Address' id="address_patient" readonly> -->
		                                <textarea placeholder="Address" style="min-height:55px;" class="form-control fwidth key mrn inrefrsh" name='Address' id="address_patient" readonly> </textarea>
		                            </div>
								 </div>
								 </div>
                               
                               </div>
						    
							
							</div>
						</br>
                        </div>
                     </div>			     
			      </div>
			</div>
		  </div>
	    </div>
	  
	  
   
      <div class="col-sm-12 sales-design mt-5">
	  
	 
                                              
	  <!-- <strong><span class="pull-right" id="date_time"></span></strong> -->
           <div class="panel panel-border panel-custom home-body"> <!-- ss -->
          
            <div class="panel-body">
			 <div class="col-sm-9">
               <div class="row">
     		     <div class="col-sm-10">
                   <div class="panel panel-border panel-custom" style="">
                     <div class="panel-body">
					    <div class=" row" style="position: relative;left: 100px; ">
                         <div class=" form-group  col-sm-9" style="background-color: #ebeff2;padding-top: 10px;padding-bottom:10px;margin-top:5px;">
						  <div class="">
						  	<?php
						 	  $productlist=Product::find()->where(['is_active'=>1])->asArray()->all();
							  $comp_map = ArrayHelper::map($productlist, 'productid', 'composition_id');
							  
							  $composition=Composition::find()->where(['IN','composition_id',$comp_map])->all();
							  $comp_index=ArrayHelper::index($composition,'composition_id');
							 	 							
							  foreach ($productlist as $key => $value)
							  {
									$productlist_col_val[] = array('value' => $value['productname'].' - '.$comp_index[$value['composition_id']]['composition_name'],'value1' => $value['productid']);
							  }
								$productlist_col_json = json_encode($productlist_col_val);	
							?>
						   <input type="text" class="typehead text-cap form-control input-lg fwidth  medienter inrefrsh" placeholder="Enter prescription" tabindex="7" id="medicines">
						   <input type="hidden" class="form-control" id='name'>      
						   <h5 class="text-center stock_no" hidden><span style="color:red;font-weight:bold;">Stock not Available</span></h5>
					    </div>
                        </div>
						 <div class="col-sm-1 altp-label"><label id="shortcut"><i><strong class="f-10">[Alt+p]</strong></i></label></div> 
						 <div class="  col-sm-1" style="position:relative;top:10px;">
						     <button type="button" id="temp_med_fetch" data-toggle="tooltip" title="Temporary Sale" class="btn btn-sm btn-success" tooltip='Temp Sale'><i class="fa fa-shopping-cart" ></i></button> <i><strong class="f-10">[Alt+t]</strong></i> 
						 </div>
						 </div>
                     </div>
                  </div>
               </div>
               <div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>
               <div class=" ">
                  <table class="table table-bordered table-striped tbl-scrol" id="tbUser">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center hide">#</th>
                              <th rowspan="2" style="width:7%"  class="text-center">Stock / Drug</th>
                              <th rowspan="2" style='width:6%;' class="text-center">Batch</th>
                              <th rowspan="2" style='width:8%;' class="text-center">Exp Date</th>
                              <th rowspan="2" style='width:5%;'  class="text-center">Qty</th>
                              <th rowspan="2" style='width:7%;' class="text-center">Unit<br>Form</th>
                              <th rowspan="2" style='width:8%;' class="text-center">MRP</th>
                              <th colspan="2" style='width:14.8%;'  class="text-center"  >Discount</th>
                              <th colspan="2"  style='width:15.1%;' class="text-center">CGST</th>
                              <th colspan="2" style='width:15%;' class="text-center">SGST</th>
                              <th rowspan="2"   class="text-center">Total</th>
                              <th rowspan="2"   class="text-center">Remove</th>
                           </tr>
                           <tr>
                              <th class="text-center">Val</th>
                              <th width="5%" class="text-center">Amt</th>
                              <th class="text-center">%</th> 
                              <th width="5%" class="text-center" > Amt</th>
                              <th class="text-center" >%</th>
                              <th width="5%" class="text-center" > Amt</th>
                           </tr>
                        </thead>
                        <tbody id='fetch_update_data'>  
                        </tbody>
                     </table>
                  </div>
				  <div class="panel panel-border panel-custom">
                   <div class="panel-body dtblock">
					  <div class="row">
					    <div class="col-sm-5">
					     <div class="panel" style="margin: 2px 0px 0px 3px;background-color:#fff;">
						   <div class="panel-body" style="padding:5px 0px 3px 0px;"> 
						     <div class="col-sm-6">
							  <!-- FROM DATE -->
							  <div class="row">							 
					           <div class="form-group">
                                <div class="col-sm-4"> <label>From</label></div>
                                 <div class="col-sm-8"> <div class='input-group date' >
                                  <input type='text' class="form-control cus-fld input-sm fromDate" id='fromDate' onkeyup="defaultdatevalidated(this.value)"  name="fromDate"   required>                               
                                 </div>
                                </div>                     
					           </div>
					          </div>
					          <!-- TO DATE -->
					          <div class="row">					   
					           <div class="form-group">
                                <div class="col-sm-4"> <label>To</label></div>
                                <div class="col-sm-8">                         
						          <div class='input-group date'   >
                                    <input type='text' class="form-control cus-fld toDate input-sm" id='toDate' onkeyup="defaultdatevalidated(this.value)" name="toDate" required> 
                                  </div>
                                </div>
                              </div>					 
					        </div>
					       </div>
					       <!-- SEARCH -->
					       <div class="col-sm-6">					  
					        <label>Search</label>
					        <div class="input-group add-on fwidth"  >					   
                              <input class="  form-control input-sm " style=" " placeholder=" " name=" " id=" " type="text" tabindex=" ">
					          <div class="input-group-btn  ">
						        <span class="btn btn-default  " id='bill_hist_btn' style="height:20px!important;padding:1px 6px!important;"><i class="ssearch glyphicon glyphicon-search"></i></span>
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
			    </div>
			    <div class="col-sm-3" style="background-color: #ebeff2;margin-top:5px;position:relative;left:15px;" >
				   <div class=" ">
				       <table class="table"  >
					   <tr>
							<th>Details</th>
							<td> 
								<div class="input-group">
								  <div class="input-group-btn" data-toggle="buttons" >
                                    <label disabled class="inp btn btn-default  " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-percentage" disabled value="percentage"  autocomplete="off">Items
                                    </label>         
                                  </div>
		                         <input type="text" class="form-control total_items ansrefrsh" name='total_items' readonly id="no_of_items">
										<input type="hidden" class="form-control total_items ansrefrsh" name='total_items_hidden'  id="no_of_items_hidden">
									<div class="input-group-btn" data-toggle="buttons" >
                                     <label  disabled class="inp btn btn-default   " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-flat" value="flat" disabled autocomplete="off">Qty
                                     </label>         
                                  </div>
		                          <input type="text" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
										<input type="hidden" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity_hidden'  id="total_quantity_hidden">
									</div> 
							   </td>
						</tr>
						<tr>
							<th class="col-sm-5">Price</th>
							<td class="col-sm-7"><input type="text"  class="form-control total_sub_total text-right ansrefrsh" name='total_sub_total' readonly id="total_sub_total">
							<input type="hidden"  class="form-control total_sub_total ansrefrsh" name='total_sub_total_hidden' id="total_sub_total_hidden"></td>
						</tr>
						<tr>
							<th>GST</th>
							<td><input type="text"   class="form-control total_vat text-right ansrefrsh" name='total_gst' readonly id="total_gst_amount">
							<input type="hidden"    class="form-control total_vat ansrefrsh" name='total_gst_hidden'  id="total_gst_amount_hidden"></td>
						</tr>
						<tr>
							<th>Discount</th>
							<td> 
								<div class="input-group">
								  <div class="input-group-btn" data-toggle="buttons">
                                    <label disabled class="inp btn btn-default enable-textbox-percentage" style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-percentage" disabled value="percentage"  autocomplete="off">%
                                    </label>         
                                  </div>
		                          <input type="text" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent' onkeyup="OverallPercentageDiscount();"  id="total_discountvaluetype">
						          <input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent_hidden'   id="total_discountvaluetype_hidden">
                                  <div class="input-group-btn" data-toggle="buttons">
                                     <label disabled class="inp btn btn-default enable-textbox-flat " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-flat" value="flat" disabled autocomplete="off">$
                                     </label>         
                                  </div>
		                          <input type="text" class="form-control total_disc_original ansrefrsh number" readonly='readonly'  name='total_disc_original'   id="total_discountamount">
							      <input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original_hidden' disabled  id="total_discountamount_hidden">
                                 </div> 
							   </td>
						</tr>
						
						<tr>
							<th class="col-sm-5">TOTAL AMOUNT</th>
							<td class="col-sm-7"><input type="text" style='color: blue;font-size: 14pt;' class="form-control total_amount_mrp text-right ansrefrsh" name='total_amount_mrp' readonly id="total_amount_mrp">
						</tr>
						
						<tr>
							<th>NET Amount</th>
							<td><input type="text" class="form-control total-netamt ansrefrsh text-right bg-primary" name='total_net_amount' style="color: #031d33;font-size: 14pt;" readonly id="total_net_amount">
							<input type="hidden" class="form-control total-netamt text-right ansrefrsh bg-primary" name='total_net_amount_hidden' style="color: #031d33;font-size: 14pt;"  id="total_net_amount_hidden"></td>
						</tr>
						
						
						
						<tr>
							<th>Round Off</th>
							<td><input type=" text" class="form-control text-right" name="round_off_value" id="round_off_value" readonly placeholder=" "></td>
						</tr>
						<tr>
							<th>Cash</th>
							<td><input type=" text" class="form-control text-right" name="cash_value" id="cash_value" readonly placeholder=" "></td>
						</tr>
						<tr>
							<th>Paid Amount</th>
							<td><input type=" text" class="form-control text-right number" name="paid_value" id="paid_value" onkeyup="PaidAmountCalculated(this.value);"  placeholder=" "></td>
						</tr>
						<tr>
							<th>Due Amount</th>
							<td><input type=" text" class="form-control text-right" name="due_value" id="due_value" readonly placeholder=" "></td>
						</tr>
					   </table>
					   <div class="form-group  col-sm-12">
							<label class="control-label text-default" for=" ">Amount in Words</label>
							<div>							
								<input type=" text" class="form-control" name="amt_in_words" id="amt_in_words" placeholder=" " readonly style="text-transform:uppercase;">
							</div>
					   </div>
					   
					   <div class="form-group  col-sm-12">
							<label class="control-label text-default" for=" ">Authority</label>
							<div>							
								<select name='authority' id='authority' class='authority form-control'>
								        <option value=""></option>
								  <?php if(!empty($authority_master)){ foreach($authority_master as $key => $value){ ?>
								  		<option value=<?php echo $value['autoid'];?>><?php echo $value['authorityname'];?></option>
								  <?php } }?>
								</select>
							</div>
					   </div>
					
					   <div class="form-group col-sm-12">
							<label class="control-label " for=" ">Remarks</label>	
							<textarea style="min-height: 30px; " class="form-control rounded-0 remarks" id="remarks" name="remarks" rows="2"></textarea>															
					   </div>
					   
					   <div class="form-group">
					 <div class="panel">
			            <input type="hidden" name="saved_val" id='saved_val'>
                       <div class="panel panel-border">
                        <div class="panel-body" style="padding: 2% 10%!important;">					   
						   <button type="button" value='save_bill' name='saved_bill' style="z-index: 9999;" class="btn btn-success btn-xs fwidth ss_v save_billing"  onclick='SaveBilling();' data-toggle="tooltip" title="Ctrl+s"> Save</button>
						 <button type="button" class="btn  btn-xs btn-warning remove_all">Clear</button>
						
						 <a href="<?php  echo Yii::$app->request->BaseUrl;?>/index.php?r=sales/index" class="btn text-right btn-xs btn-default btn-bk" title="Back To Grid">Grid </a>

						<button type="button" class="btn   inp btn-xs btn-default remove_all"  data-toggle="tooltip" title="Ctrl+c">Close</button>						 
			           </div>
			          </div>
			          </div>
				   </div>
				   </div>
				  </div>
			    <input type='hidden' class='get_slno'>
			    <input type='hidden' name='get_temp_no' class='get_temp_no'>
			    <input type='hidden' name='return_status' class='return_tablet' id='return_tablet'>
			   <div class=" ">
                <!--   <div class="panel panel-border panel-custom total-area"  >
                     <div class="panel-body" style="padding: 0 5px !important;">
                        <div class="row">
						
						
                           <div class="t-10  col-sm-9">
                              <div class="row">
							     
								 <div class="form-group col-sm-2">
									<!-- <div class="input-group  ">
										<label class="input-group-addon"  > Items: </label>
										<input type="text" class="form-control total_items ansrefrsh" name='total_items' readonly id="no_of_items">
										<input type="hidden" class="form-control total_items ansrefrsh" name='total_items_hidden'  id="no_of_items_hidden">
									</div> 
								 </div>
							  
							    <div class="form-group col-sm-1" style="position: relative;left: -16px;">
									<!-- <div class="input-group  ">
										<label class="input-group-addon" style="padding: 0 6px;" > Qty: </label>
										<input type="text" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
										<input type="hidden" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity_hidden'  id="total_quantity_hidden">
									</div> 
								 </div>
                                
								  <div class="form-group col-sm-2">
									<!--<div class="input-group  ">
										<label class="input-group-addon"  >  GST: </label>
										<input type="text" style="width: 75px;"  class="form-control total_vat ansrefrsh" name='total_gst' readonly id="total_gst_amount">
										<input type="hidden" style="width: 75px;"  class="form-control total_vat ansrefrsh" name='total_gst_hidden'  id="total_gst_amount_hidden">
									</div>   
								 </div>
								 
                              <!-- 
							  
							   <div class="form-group col-sm-2 " style="padding: 0;left: -3px;">
									<div class="input-group  ">
										
										<label class="input-group-addon" style="    padding: 8px 10px;" >Dis Type: </label>
										 <input type="text" class="form-control  over_all_discount_percent number" name='overall_discount_percent'   id="over_all_discount_percent"> 
									<ul class="donate-now per_flat_val">
										<li>
											<input type="radio" name="overall_discount_type" style="margin-left: 5px;" id="overall_discount_type_radio" value="F" class="btn btn-success overall_disount">
											<label for="flat_discount"  style="" class=" text-center testrad">F</label>
										</li>
										<li>
											<input type="radio" id="overall_percent_type" class="btn btn-success overall_disount" value="P" name="overall_discount_type">
											<label for="percent_discount" style="" class="text-center testrad">%</label>	
										</li>
									</ul>
									</div>
								 </div>
								 
								 <div class="form-group col-sm-3" style="padding: 0;">
									<div class="input-group  ">
										<!-- <label class="input-group-addon"  >Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number" name='total_disc_original'   id="total_discountvalue"> 
										<label class="input-group-addon"  >%: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent'   id="total_discountvaluetype">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent_hidden'   id="total_discountvaluetype_hidden">
										
										<label class="input-group-addon"  >Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original'   id="total_discountamount">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original_hidden'   id="total_discountamount_hidden">
									</div>
								 </div>
								 
								 	 
							  
							  
							  
								 <div class="form-group col-sm-2">
									<!--<div class="input-group  ">
										<label class="input-group-addon"  >Sub.Tot</label>
										<input type="text" style="width: 90px;"   class="form-control total_sub_total ansrefrsh" name='total_sub_total' readonly id="total_sub_total">
										<input type="hidden" style="width: 90px;"   class="form-control total_sub_total ansrefrsh" name='total_sub_total_hidden' id="total_sub_total_hidden">
									</div>  
								 </div>
							  
                                </div>
                           </div>
                           <div class="t-10  col-sm-3" style="    right: -24px;">
						   
                          	<div class="row"> 
							  <!-- <div class=" col-sm-1"></div> -->
						 <!-- <div class="form-group col-sm-7">
									<div class="input-group  ">
										<label class="input-group-addon bg-primary" style="color:#fff;" >Net Amt : </label>
										<input type="text" class="form-control total-netamt ansrefrsh bg-primary" name='total_net_amount' style="color: #fff;font-size: 14pt;" readonly id="total_net_amount">
										<input type="hidden" class="form-control total-netamt ansrefrsh bg-primary" name='total_net_amount_hidden' style="color: #fff;font-size: 14pt;"  id="total_net_amount_hidden">
									</div>
								 </div>  
							  <div class="form-group col-sm-2" style="z-index: 9999;">
                                 
                                 <button type="button" value='save_bill' name='saved_bill' style="z-index: 9999;" class="btn btn-success btn-sm fwidth ss_v save_billing" onclick='SaveBilling();' data-toggle="tooltip" title="Save and Submit"><i class="fa fa-save"></i></button>
                                 <i><strong><small>[Ctrl+S]</small><strong></i>
                              </div>
                              <div class="form-group col-sm-2" style="z-index: 9999;">
                               
                                 <button type='reset' style="z-index: 9999;" class="btn btn-warning btn-sm fwidth ss_v remove_all" data-toggle="tooltip" title="Cancel"><i class="fa fa-close"></i> </button>
                                 <i><strong><small>[Alt+z]</small><strong></i>
                              </div>
                         </div><!-- Row end  
                         </div>
                        </div>
                        <div class="row " style="position: relative;">
                           	<div class="col-sm-6 dis_remark">
                           		<!--<div class="row">
                           		 <div class="form-group col-sm-3 " style="padding: 0;left: 15px;">
									<div class="input-group  ">
										
										<label class="input-group-addon" style="    padding: 8px 10px;" >Dis Type: </label>
										<!-- <input type="text" class="form-control  over_all_discount_percent number" name='overall_discount_percent'   id="over_all_discount_percent">  
									<ul class="donate-now per_flat_val">
										<li>
											<input type="radio" name="overall_discount_type" style="margin-left: 5px;" id="overall_discount_type_radio" value="F" class="btn btn-success overall_disount">
											<label for="flat_discount"  style="" class=" text-center testrad">F</label>
										</li>
										<li>
											<input type="radio" id="overall_percent_type" class="btn btn-success overall_disount" value="P" name="overall_discount_type">
											<label for="percent_discount" style="" class="text-center testrad">%</label>	
										</li>
									</ul>
									</div>
								 </div> 
								 
								 
								 <div class="form-group col-sm-6" style="padding: 0;">
									<div class="input-group  ">
										<label class="input-group-addon"  >%: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent' onkeyup="OverallPercentageDiscount();"  id="total_discountvaluetype">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent_hidden'   id="total_discountvaluetype_hidden">
										
										<label class="input-group-addon"  >Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original'   id="total_discountamount">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original_hidden'   id="total_discountamount_hidden">
									</div>
								 </div>
								 </div> -->
								<!-- <div class="row">
								 	  <div class="form-group col-sm-11">
										    <label for="exampleFormControlTextarea1">Remarks</label>
										      <textarea style="min-height: 50px;width: 250px;" class="form-control rounded-0 remarks" id="remarks" name="remarks" rows="2"></textarea>
										</div>
								 	</div>  
                           	</div>
                           <!-- 	<div class="col-sm-6 date_show">
                           		<span>Datewise Sales History Details</span>
                              		<div class="col-sm-5">
                              			<div class="input-group " >
                              				<label>From</label>
										    <input type="text" class="form-control from_date" id="from_date" name="from_date">
										    
										</div>
                              		</div>
                              		<div class="col-sm-5">
                              		<div class="input-group " >
                              				<label>To</label>
										    <input type="text" class="form-control to_date" id="to_date" name="to_date">
										  
										</div>
                              		</div>
                              		<div class="col-sm-2">
                              			<label style="visibility:hidden">From</label><!-- ss 
                              			<button type='button' class="btn btn-warning btn-sm fwidth sale_his " id="sale_his" data-toggle="tooltip" title="Show">Show</button>
                              		</div>
                              	</div>	 
                              	</div>
                        
                        
                        
                        
                        
                        <br>
                        <div class='row'>
                        	<div class='col-sm-1 pull-right print_rules'>
                        		
                        	</div>
                        	
                        </div>
						
						
						
						
						
                     </div>
					 
                  </div>
				  
               </div> -->
			   
			    <div class="col-sm-12">  
				<div class="panel panel-border panel-custom  "  >
                     <div class="panel-body" style="padding: 0 5px !important;">

			   <fieldset class="scheduler-border  ">
			   <!--  <legend class="scheduler-border form-head">FINANCIAL DETAILS</legend> -->
			   <div class="row financial">
			      
					  <!-- <div class="row">
					   
					   <div class="col-sm-4" style="border-right: 1px solid #dee6e4;">
			          <div class=" inner-des">
			           
				 
				        <div class="form-group">
					        <label class="control-label " for=" ">QTY</label>						 
							<input type="text"   class="form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
							<input type="hidden"   class="form-control total_quantity ansrefrsh" name='total_quantity_hidden'  id="total_quantity_hidden">
									
						</div>
				 
						<div class="form-group">
							<label class="control-label  " for=" ">GST</label>
							
									
						</div>
					   </div>
			         </div>
					  <div class="col-sm-4" style="border-right: 1px solid #dee6e4;">
					  <div class=" inner-des">
					    <div class="form-group">
					        <label class="control-label" for=" ">DISC (%)</label>					    
							<input type="text" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent' onkeyup="OverallPercentageDiscount();"  id="total_discountvaluetype">
						    <input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent_hidden'   id="total_discountvaluetype_hidden">
												
				        </div>
						
						<div class="form-group">
					        <label class="control-label" for=" ">DISC (AMT)</label>					    
							<input type="text" class="form-control total_disc_original ansrefrsh number" readonly='readonly'  name='total_disc_original'   id="total_discountamount">
							<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original_hidden'   id="total_discountamount_hidden">
											
				        </div>
					  <div class="form-group" style="visibility:hidden;">
					  <label class="control-label" for=" ">Test</label>
					  <input type="text">
					  
					  </div>
					  
						
						
			          </div>
 					</div>
					  
			         <div class="col-sm-4" style="border-right: 1px solid #dee6e4;">
					   <div class=" inner-des">
					   
					   
					   <div class="form-group">
					        <label class="control-label" for=" ">Sub Total</label>						 
							
															 
				        </div>
				 
				        <div class="form-group">
					        <label class="control-label" for=" ">Net Amount</label>					    
							
									
				        </div>

                        <div class="form-group">
					        <label class="control-label" for=" ">Round Off</label>					    
							<input type=" text" class="form-control" id="round_off_value" readonly placeholder=" ">
				        </div>
				        <div class="form-group">
					        <label class="control-label" for=" ">CASH</label>					    
							<input type=" text" class="form-control" id="cash_value" readonly placeholder=" ">
				        </div>
				       </div>	   
			         </div></div>-->
					   <div class="row">
					</div>
					</div>
					<div class="col-sm-3"> </div>                				 
			   </div>
			    </fieldset>
			   </div>
			   </div>
	           </div>
			  </div>
	  </div>
   </div>
 </div>
	 

   

   
    
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header tmp-head">
            <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title" id='medcine_name'></h4>
         </div>
		  <div class=" modal-body" style="width: 1110px;">
         	 
			  <div class="">
			  <div class=" ">
			  <div class="form-inline">
				<div class="form-group  ">
					 
						<label class="control-label  "> Stock: </label>
						<input type="text" class="form-control   number" name=" "  style="width:50px;" id="stk" readonly>
					 
				</div>
								 
					&nbsp;&nbsp;			 
				<div id=" " class="  form-group   " >						
                           <div class="input-group add-on fwidth" >
                           		<input class="  form-control  number"  style="width:80px;"  placeholder="Req Qty" name=" " onkeyup="BatchQty(event);"    id="fetch_batch_qty" type="text" tabindex=" ">
								
								<div class="input-group-btn  ">
									<span class="btn btn-default  "  ><i class=" ssearch glyphicon glyphicon-search"></i></span>
								</div>								
							</div>								 
                        </div>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="form-group ">
				<button type="button" class="btn btn-primary btn-sm fetch_data" id='add_to_grid' onclick="Add_to_grid()" onkeyup="Add_to_grid(event)" tabindex="105" data-toggle="tooltip" title="Add to Grid"><i class="fa fa-save"></i></button>&nbsp;<i><small>[Alt+7]</small></i> &nbsp;&nbsp;
              	<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Close" data-dismiss="modal"><i class="fa fa-close"></i></button>&nbsp;<i><small>[Esc]</small></i>
			 
				</div>
				
				
				</div>
		 
		 </div>
		 </div>
		 </br>
			 <div class="scroll-modal">
         	
            <div class=" " id="fetch_table">
            	<h3 id="fetch_table_id"></h3>
            	
			  </div>
			  
			
         
         </div></div>
       
      </div>
   </div>
</div>



<!-- Modal -->
<div id="temp_fetch_model" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header  tmp-head">
            <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title" id='medcine_name'>Temporary Sales Bill Report</h4>
         </div>
         <br>
          <div class="row" style=" ">
			<div class="col-sm-offset-4 form-group col-sm-2  " >
						    
                           <div class="input-group add-on fwidth" >
								<input class="form-control  " placeholder="Bill Number" name=" "   id="billtxtbox" type="text" tabindex=" ">
								<div class="ipt input-group-btn  ">
									<span class="btn btn-default inpatient-details"  ><i class="glyphicon glyphicon-search"></i></span>
								</div>
							</div>
                        </div>
			   
		      <button type="button" class="btn btn-warning refresh_model" tabindex="105">Refresh</button>
              <button type="button" class="btn btn-danger btn-sm  " data-dismiss="modal">Close</button>  
			  <span><i><small>[Esc]</small></i></span>&nbsp;
         </div>
         
          <div class="scroll-modal">	
         <div class=" modal-body" style="width: 1110px;">
         
         	
            <div class=" " id="temp_fetch_model_tbl">
            	<!--new table start-->
            	
                <!--new table end-->
			  </div>
			  
			
         
         </div></div>
    
         
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
                <th>DOB</th>
                <th>AGE</th>
               	<th>Relation Name</th>
               	<th>Mobile Number</th>
                <th>City</th>
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

<!--Inner modal -->

<div id="inner-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Temporary Sales Tablet Report</h4>
      </div>
      <div class="modal-body">
        <div class=" " id="temp_fetch_model_tbl_view">
            	<!--new table start-->
            	
                <!--new table end-->
			  </div>
      </div>
      <div class="modal-footer">
	    <span><i><small>[Alt+c]</small></i></span>&nbsp;
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		
		
      </div>
    </div>

  </div>
</div>
<!--Inner modal -->

<!--Inner modal -->

<div id="mr_hist-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Sales History Record</h4>
      </div>
      <div class="modal-body">
        <div class="" id="sale_history_report">
            	<!--new table start-->
            	
                <!--new table end-->
			  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
      	
      	<input onkeyup="Patient_List_Show(this,event)" type="text" style='width: 60% !important;margin: auto;margin-bottom: 30px;' name="patient_field_record" id='patient_common_search' class="form-control" placeholder="Enter Patient Name,Ph.No,Sub-Visit">
      	
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


 
    
    

 <div id="sales_his_model" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header  tmp-head">
            <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title" id='medcine_name'>Sales History Details</h4>
         </div>
         <br>
          
         
          <div class="scroll-modal">	
         <div class=" modal-body" style="width: 1110px;">
         
         	
            <div class=" " id="sales_model_tbl">
            	<!--new table start-->
            	
                <!--new table end-->
			  </div>
			  
			
         
         </div></div>
     <?php ActiveForm::end(); ?>
         
      </div>
   </div>
</div>


<div id="bill_history_model" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bill History Table</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="bill_history_report">
      
      <table id="bill_history" class="display" style="width:100%">
	        <thead>
	            <tr>
	                <th>Bill Number</th>
	                <th>MR Number</th>
	                <th>Patient Name</th>
	                <th>Invoice Date</th>
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

    
<script type="text/javascript">window.onload = date_time('date_time');</script>
<script type="text/javascript" src="js/shortcut.js" ></script>
<script type="text/javascript">

$(document).ready(function(){
	
$('.inpatient-details').click(function(){
	
	$(".mrn").prop('disabled',false);
        
});



});


   </script>

   <!-- TRUNCATE TEXT -->
   <script>
	$(document).on('mouseenter', ".trunctext", function () {
		
     var $this = $(this);
    // alert($this);
     if (this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
         $this.tooltip({
             title: $this.text(),
             placement: "bottom"
         });
         $this.tooltip('show');
     }
 });
   </script>

<script>
$(document).ready(function(e){
    $( document ).on( 'click', '.bs-dropdown-to-select-group .dropdown-menu li', function( event ) {
    	var $target = $( event.currentTarget );
		$target.closest('.bs-dropdown-to-select-group')
			.find('[data-bind="bs-drp-sel-value"]').val($target.attr('data-value'))
			.end()
			.children('.dropdown-toggle').dropdown('toggle');
		$target.closest('.bs-dropdown-to-select-group')
    		.find('[data-bind="bs-drp-sel-label"]').text($target.context.textContent);
		return false;
	});
});
</script>


 
 <script>

$(function () {
	    
        $("input[name='patient']").click(function () {
               if ($("#outPatient").is(":checked")) 
               {
               	
               		$(".get_slno").val('');
    				$(".get_temp_no").val('');
					
               	 	
				    $('.inrefrsh').val('');
				    $('.ansrefrsh').val('');
					$('#temp_med_fetch').prop('disabled', true);
					 $("#tbUser tbody tr").remove(); 
                   $(".outpatientblock").show();
   				$('[tabindex="1"]').focus();
   				$(".inpatientblock").hide();  
   				
   				ClearBillField();
   				
   				 var out_patient=$('#outPatient').val();
  				 if(out_patient != '')
  				 {
			  		 $.ajax({
						 type: "POST",
						 url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchbillnumber&id=";?>"+out_patient,
						success: function (result) 
						{
							 $('#fetch_bill').html(result);    	    
						}
					});
  				}
   				 				
               }
			   else if ($("#inPatient").is(":checked")) 
               {
              
               	
               		$(".get_slno").val('');
    				$(".get_temp_no").val('');
					
				    $('.outrefrsh').val('');
					$('.ansrefrsh').val('');
					$('#temp_med_fetch').prop('disabled', false);
					 $("#tbUser tbody tr").remove(); 
                   $(".inpatientblock").show();
   				$('[tabindex="8"]').focus();
   				$(".outpatientblock").hide();
   				 
   				 ClearBillField();
   				  
   				 var in_patient=$('#inPatient').val();
  				 if(in_patient != '')
  				 {
			  		 $.ajax({
						 type: "POST",
						 url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchbillnumber&id=";?>"+in_patient,
						success: function (result) 
						{
							 $('#fetch_bill').html(result);    	    
						}
					});
  				}
   				  
               }
               else if ($("#tempPatient").is(":checked")) 
               {
               	
               		$(".get_slno").val('');
    				$(".get_temp_no").val('');
					
				    $('.outrefrsh').val('');
					$('.ansrefrsh').val('');
					$("#tbUser tbody tr").remove(); 
                   	$('.inrefrsh').val('');
				    $('.ansrefrsh').val('');
					$("#tbUser tbody tr").remove(); 
                   	$('[tabindex="7"]').focus();
                   	$(".inpatientblock").hide();
   					$(".outpatientblock").hide();
   					$('#temp_med_fetch').attr('disabled','disabled');
   				 
   				 ClearBillField();
   				 
   				 var temp_patient=$('#tempPatient').val();
   				 if(temp_patient != '')
  				 {
			  		 $.ajax({
						 type: "POST",
						 url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchbillnumber&id=";?>"+temp_patient,
						success: function (result) 
						{
							 $('#fetch_bill').html(result);    	    
						}
					});
  				  }
   	            }			
           }); 
	    }); 
 
</script>

<!-- Fetch Script-->
<script>
	$(document).ready(function() 
	{

    jtable_pd();
		$('.stock_no').hide();
		$('#mr_validated').hide();
				
		$('#medicines').keyup(function(e)
   		{
		    var keycode = (e.keyCode ? e.keyCode : e.which);
		    
			if(e.keyCode == 13)
			{
				
				var product_id=$('#name').val();
				//var encodeproduct_id=encodeURIComponent(product_id);
				if(product_id != '')
				{
					$.ajax({
						type: "POST",
			            url: "<?php echo Yii::$app->homeUrl . "?r=sales/medicinefetch&product_id=";?>"+product_id,
			            success: function (result) 
			            { 
			            	var obj = $.parseJSON(result);
			            	 
			            	 if(obj == 'NULL' || obj == '' || obj == 'null' || obj == null)
			            	 {
			            	 	
			            	 	/*$('.stock_no').delay('fast').fadeIn();
					            $('.stock_no').delay(1000).fadeOut();*/
					            $('.stock_no').show();
			            	 	$modal = $('#myModal');
								$modal.modal('hide');
									    
			            	 }
			            	 else
			            	 {
			            	 	 var medicine_temp=[];
			            	 	 var medicinename='';
			            	 	 $('.stock_no').hide();
			            	 	 document.getElementById('fetch_table').innerHTML=obj;
			            	 	 medicinename=$('.prd_name1').html();
			            	 	 $('#medcine_name').html('<b>'+medicinename+'</b>');
				            	 $modal = $('#myModal');
   								 $modal.modal('show');
   								 $('#name').val('');
   								var total_qty= $('#total_available_qty').val();
   								$('#stk').val(total_qty);
   								$('#fetch_batch_qty').val('');
   								$('.save_data_table').each(function ()
								{	
									//alert("work");
									var data_table=$(this).attr('data-id');
									var temp_select_qty=$('#quantity_add'+data_table).html();
			   	  					var temp_tab_type=$('#tablet_type'+data_table).val();
			   	  					var temp_tablet_type=$('#tablet_tot_unit'+data_table).val();
			   	  					var med_type=$('#unit_value_medicine'+data_table).html();
			   	  					
			   	  					$('#required_id'+data_table).val(temp_select_qty);
			   	  					$('#data_unit'+data_table).val(temp_tab_type);
			   	  					$('#total_unit'+data_table).val(temp_tablet_type);
			   	  					$('#data-unit-name'+data_table).val(med_type);
								});
   								 	 
			            	 }
			            }
			        });
				}
			}
			else if(e.keyCode == 27)
			{
				$(this).val('');
				$('#name').val('');
				$('.stock_no').hide();
			}
	  });	
		 
		 	$('body').on("keypress",'.required_qty',function(e)
   			{
   				var available_id=$(this).attr('data-id');
   				$(this).val();
   				$('#total_unit'+available_id).val('');
   			});
			
   			$('body').on("keyup",'.required_qty',function(e)
   			{
   				var keycode = (e.keyCode ? e.keyCode : e.which);
        		
        		
   				
   				var available_id=$(this).attr('data-id');
   				
   				var available_value=parseInt($('#quanity_id'+available_id).html());
   				var required_value=parseInt($(this).val());
   				var keycode = (e.keyCode ? e.keyCode : e.which);
   				
   				
   				
   				$('#fetch_batch_qty').val('');
   				
   				if(required_value > available_value)
   				{
   					Alertment('You enter more than Availability');
   					$(this).val("");
   					$('#total_unit'+available_id).val('');
   				}
   				else if(required_value === 0 || isNaN(required_value))
   				{
   					$(this).val("");
   					$('#total_unit'+available_id).val('');
   					
   					
   				}
   				else if(required_value >= available_value || required_value < available_value)
   				{
   					var available_id=$(this).attr('data-id');
	   				var available_value=parseInt($('#quanity_id'+available_id).html());
	   				var required_value=parseInt($('#required_id'+available_id).val());
	   				
	   				var product_qty=$('#data_unit'+available_id).val();
	   				
	   				$.ajax({
		            type: "POST",
		            url: "<?php echo Yii::$app->homeUrl . "?r=sales/getunitquantity&id=";?>"+encodeURIComponent(product_qty),
		            success: function (result) 
		            { 
		            	var result = $.parseJSON(result);
		            	var value_unit=result[0];
		            	var value_type=result[1];
		            	
		            	$('#data_no_of_unit'+available_id).val(value_unit);
		            	$('#data-unit-name'+available_id).val(value_type);
		            	
		            	var data_unit=parseInt($('#data_no_of_unit'+available_id).val());
		            	var required_qty=parseInt($('#required_id'+available_id).val());
		            	var total_unit=required_qty*data_unit;
		            	
		            	var availablity=parseInt($('#quanity_id'+available_id).html());
		            	
		            	
		            	
		            	if(availablity < total_unit)
		            	{
		            		//alert("Total Units is greater than Availability");
		            		Alertment("Total Units is greater than Availability");
		            		$('#total_unit'+available_id).val('');
		            		$('#required_id'+available_id).val('');
		            		$('#data_unit'+available_id).val('');
		            		$('#validated_field'+available_id).hide();
		            			
		            	}
		            	else
		            	{
		            		
		            		if(isNaN($('#total_unit'+available_id).val()))
		            		{
		            			$('#total_unit'+available_id).val('');
		            		}
		            		else
		            		{
		            			var total_available_getting=parseInt($('#stk').val());
		            			var adding_qty=0;
		            			$('#total_unit'+available_id).val(total_unit);
		            			$('.total_unit').each(function ()
								{	
									var dat=$(this).attr('data-id');
									var tot_unit_id=parseInt($('#total_unit'+dat).val());
									
									if(!isNaN(tot_unit_id))
									{
										adding_qty=adding_qty+tot_unit_id;
									}
									
										
			   					});
			   					
			   					if(total_available_getting >= adding_qty || total_available_getting > adding_qty)
			   					{
			   						$('#fetch_batch_qty').val(adding_qty);
			   						if(keycode === 13)
							        {
							        	Add_to_grid(e);
							        }
			   					}
			   					else
			   					{
			   						Alertment('You enter more than Availability');
   									$(this).val("");
   									$('#total_unit'+available_id).val('');
			   					}
		            		}
			            		
		            			
		            	}
		            	
		            }
		                });	
	   						
   				}
   				
   				
   				
   			});
   			
   			
   			
   			
   			
   			
   			/*$('body').on("keypress",'.tabenter_acc',function(e)
   			{
   				var keycode = (e.keyCode ? e.keyCode : e.which);
        		
        		if(keycode == '13')
		        {
		          var ntabindex = parseInt($(this).attr("tabindex")) + 1;
		          $("[tabindex=" + ntabindex + "]").focus();
		          return false;
		        }
   				
   			});	
   			
   			$('body').on("keyup",'.tabenter_acc',function(e)
   			{
   				var keycode = (e.keyCode ? e.keyCode : e.which);
        		
        		if(keycode == '8')
		        {
		          var ntabindex = parseInt($(this).attr("tabindex")) - 1;
		          $("[tabindex=" + ntabindex + "]").focus();
		          return false;
		        }
   				
   			});	*/
   		
   			

	}); 
	
		//auto start
			
			
	
    var availableTags = <?= $productlist_col_json; ?>;

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

</script>
<script>


 function jtable_pd(){
      
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=sales/jqgrid';
  var table_reg= $('#reg_table').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
         "ajax": {
          "url": ajax_url,
           "type": "POST"
          },
          keys: {
              keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
          },
          "columns": [
            { "data": "mrno"},
            { "data": "pname"},
            { "data": "dob"},
            { "data": "age"},
            { "data": "rname"},
            { "data": "mno"},
            { "data": "city"},
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
           $('#reg_table_filter input').focus();
        }
    }); 
    
$('#reg_table').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
    
    PatientDetailsFetch(data);
});

$('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      
      var data = table_reg.row(cell.index().row).id();
      
      PatientDetailsFetch(data);
  }
});    
    
}



$("body").on('click', '.inpatient-details', function ()
{
  $("#tbUser tbody tr").remove(); 
  $modal = $('#patient_details');
  $modal.modal('show');
 /* setTimeout(function(){ 
  var table_as = $("#reg_table").DataTable();
  table_as.ajax.reload(function(json) {table_as.cell(':eq(0)').focus();});},200);*/
  var table_as = $("#reg_table").DataTable();
  table_as.ajax.reload(function(json) {table_as.cell(':eq(0)').focus();});
});

function PatientDetailsFetch(data)
{
  
  $('#load1').show();
  
  $.ajax({
    type: "POST",
    url: "<?php echo Yii::$app->homeUrl . "?r=sales/ajaxsinglefetch&id=";?>"+data,
  	//dataType:'json',
  	success: function (result) 
    {
    	$('#load1').hide();
    	$modal = $('#patient_details');
        $modal.modal('hide');
		ClearBillField();
    	var obj = $.parseJSON(result);
    	
		$('#mrnumber').val(obj[1]['mr_no']);
		$('#pat_name').val(obj[1]['patientname']);
		$('#pat_mob').val(obj[1]['pat_mobileno']); 
		$('#pat_doctor').val(obj[2]['physician_name']);
		
		if(obj[0]['insurance_type'] !== '' || obj[0]['insurance_type'] !== null)
		{
			if(obj[3] !== null)
			{
				$('#pat_insurance').html('<option value='+obj[3]['insurance_typeid']+'>'+obj[3]['insurance_type']+'</option>');
			}
			else if(obj[3] === null)
			{
				$('#pat_insurance').html('');
			}
		}
		else
		{
			$('#pat_insurance').html('');
		}
		$('#pat_dob').val(formatDate(obj[1]['dob']));
		$('#gender').val(obj[1]['pat_sex']);
		$('#address_patient').val(obj[1]['pat_address']);
      		
      	  
        
          
        $('#medicines').focus();	
        
    }
  });
}


function ClearBillField()
{
	$("#tbUser tbody tr").remove();
	$('#no_of_items').val('');
	$('#total_quantity').val('');
	$('#total_sub_total').val('');
	$('#total_gst_amount').val('');
	$('#total_discountvaluetype').val('');
	$('#total_discountamount').val('');
	$('#total_amount_mrp').val('');
	$('#total_net_amount').val('');
	$('#round_off_value').val('');
	$('#cash_value').val('');
	$('#paid_value').val('');
	$('#due_value').val('');
	$('#amt_in_words').val('');
	$('#remarks').val('');
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
 



$(document).ready(function(){
$('#myModal').on('shown.bs.modal', function ()
{
    $('.focus_first').focus();
    $('#fetch_batch_qty').focus();
})});

$(document).ready(function(){
$('#temp_fetch_model').on('shown.bs.modal', function ()
{
	$('#billtxtbox').focus();
})});
	 

</script>
<script type="text/javascript">
        
 $('[tabindex="8"]').focus();

shortcut.add("Alt+1",
function() {
	
$(".get_slno").val('');
$(".get_temp_no").val('');		
$('.inrefrsh').val('');
$('.ansrefrsh').val('');
$("#tbUser tbody tr").remove(); 
$('#inPatient').prop('checked', false);
$('#outPatient').prop('checked', true);
$('#temp_med_fetch').prop('disabled', true);
$(".outpatientblock").show();
$(".inpatientblock").hide();
$('[tabindex="1"]').focus();
  
ClearBillField();  
  
  var out_patient=$('#outPatient').val();
  if(out_patient != '')
  {
  		 $.ajax({
			 type: "POST",
			 url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchbillnumber&id=";?>"+out_patient,
			success: function (result) 
			{
				 $('#fetch_bill').html(result);    	    
			}
		});
  }
      
},
{ 'type':'keydown', 'propagate':true, 'target':document}
); 


shortcut.add("Alt+2",
function() {

$(".get_slno").val('');
$(".get_temp_no").val('');	
$('.outrefrsh').val('');
$('.ansrefrsh').val('');
$("#tbUser tbody tr").remove(); 
$('#temp_med_fetch').prop('disabled', false);
$('#outPatient').prop('checked', false);
$('#inPatient').prop('checked', true); 
$(".inpatientblock").show();
$(".outpatientblock").hide();
$('[tabindex="8"]').focus();

ClearBillField();
     
  var in_patient=$('#inPatient').val();
  if(in_patient != '')
  {
  		 $.ajax({
			type: "POST",
			 url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchbillnumber&id=";?>"+in_patient,
			success: function (result) 
			{
				 $('#fetch_bill').html(result);    	    
			}
		});
  }
     
       
},
{ 'type':'keydown', 'propagate':true, 'target':document}
);


shortcut.add("Alt+3",
function() {
	
$(".get_slno").val('');
$(".get_temp_no").val('');

$('.outrefrsh').val('');
$('.ansrefrsh').val('');
$("#tbUser tbody tr").remove(); 
$('.inrefrsh').val('');
$('.ansrefrsh').val('');
$("#tbUser tbody tr").remove(); 
$('[tabindex="7"]').focus();
$(".inpatientblock").hide();
$(".outpatientblock").hide();
$('#outPatient').prop('checked', false);
$('#inPatient').prop('checked', false);
$('#tempPatient').prop('checked', true);
$('#temp_med_fetch').attr('disabled','disabled');

ClearBillField();
	 	
  var temp_patient=$('#tempPatient').val();
  if(temp_patient != '')
  {
  		 $.ajax({
			type: "POST",
			 url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchbillnumber&id=";?>"+temp_patient,
			success: function (result) 
			{
				 $('#fetch_bill').html(result);    	    
			}
		});
  }
},
{ 'type':'keydown', 'propagate':true, 'target':document}
); 
 

shortcut.add("Alt+f2",
function() {
	 $('.percent').prop('checked', true);
	 $(".enabledisc").prop('disabled',false);
     $('.enabledisc').focus();	
	 
},

{ 'type':'keydown', 'propagate':true, 'target':document}
);


 shortcut.add("Alt+p",
   function() {
    $('[tabindex="7"]').focus();
   },
    
   { 'type':'keydown', 'propagate':true, 'target':document}
   );


//Code Start

	/*shortcut.add("ctrl+enter",
   function() {
    	$( ".fetch_data" ).trigger( "click" );
   },
    
   { 'type':'keydown', 'propagate':true, 'target':document}
   );
	*/

//Code End


   shortcut.add("shift+f7",
   function() {
    $('[tabindex="1"]').focus();	 
   },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );
   
   shortcut.add("shift+f8",
   function() {
    $('[tabindex="6"]').focus();	 
   },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );
   
   shortcut.add("ctrl",
   function() {
    },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );
   
   shortcut.add("esc",
   function() {
      $("#myModal").modal('hide');
	
   },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );
   
   
   shortcut.add("Alt+c",
   function() {
      $("#inner-modal").modal('hide');
	
   },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );

 shortcut.add("Alt+t",
   function (){
    	    $('#billtxtbox').focus();
			$.ajax({
						
				     type: "POST",
				     url: "<?php echo Yii::$app->homeUrl . "?r=sales/temptabletfetch";?>",
				     success: function (result) 
				     {
				     	  var obj = $.parseJSON(result);
				     	  document.getElementById('temp_fetch_model_tbl').innerHTML=obj;
				          $modal = $('#temp_fetch_model');
	   					  $modal.modal('show');  	
				            	 
				     }
				  });
		
    },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );

	 shortcut.add("Alt+r",
   function (){
    	 
		window.location.reload(true);
    },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );


 shortcut.add("Alt+z",
   function() {
     $("#fetch_update_data tr").remove();
    	$(".get_slno").val('');
    	$(".get_temp_no").val('');
    	window.location.reload(true);
	
   },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );

    </script>
<script>
	$(document).ready(function(){
		$("#tbUser").on('click', '.delrow', function () 
		{

      //alert('test');
			var unique_id=$(this).attr('data_delete_row');
			var no_of_items=parseInt($('#no_of_items').val());
			var delete_items=no_of_items-1;
			$('#no_of_items').val(delete_items);
			
			var quantity_add=parseInt($('#quantity_add'+unique_id).html());
			var total_quantity=parseInt($('#total_quantity').val());
			var delete_quantity=total_quantity-quantity_add;
			$('#total_quantity').val(delete_quantity);
			
			
			var sgst_value=parseFloat($('#sgst_value'+unique_id).val());
			var cgst_value=parseFloat($('#cgst_value'+unique_id).val());
			var igst_value=parseFloat($('#igst_value'+unique_id).val());
			var delete_gst=sgst_value+igst_value+cgst_value;
			
			var total_gst_amount=parseFloat($('#total_gst_amount').val());
			var delete_total_gst_amount=total_gst_amount-delete_gst;
			$('#total_gst_amount').val(delete_total_gst_amount.toFixed(2));
			
			//Total Amount variable apply subtotal,rounded value,net amount
			var total_amount=parseFloat($('#price'+unique_id).val());
			var total_sub_total=parseFloat($('#total_sub_total').val());
			var delete_total_sub_total=total_sub_total-total_amount;
			$('#total_sub_total').val(delete_total_sub_total.toFixed(2));
			
			var total_net_amount=parseInt($('#total_net_amount').val());
			var total_value_amount=parseInt($('#total_amount'+unique_id).val());
			
			var delete_total_net_amount=total_net_amount-total_value_amount;
			$('#total_net_amount').val(delete_total_net_amount.toFixed(2));
			
			var hidden_mrp_amount=parseFloat($('#total_amount1'+unique_id).val());
			var total_amount_mrp_new=parseFloat($('#total_amount_mrp').val());
			var subtraction_amount_new=total_amount_mrp_new - hidden_mrp_amount;
			 $('#total_amount_mrp').val(subtraction_amount_new.toFixed(2)); 
			
			//Discount value

			var discount_amount=$('#disc_amount'+unique_id).val();
			var discount_total=$('#total_discountvalue').val();
			if(isNaN(discount_amount))
			{
				discount_amount=0;
			}
			var subdiscount=discount_total-discount_amount;
			$('#total_discountvalue').val(subdiscount.toFixed(2));

     

                //alert(disc_percentage);
                

    	$(this).closest('tr').remove();

       var disc_percentage=parseFloat($('#total_discountvaluetype').val());
                if(disc_percentage!=''){
                 setTimeout(function () {                 
                 OverallPercentageDiscountProcedure(disc_percentage);
               },1000);
                } 
      var total_sub_totalre=parseFloat($('#total_sub_total').val());
      var total_gst_amountre=parseFloat($('#total_gst_amount').val());

      var distotal=total_sub_totalre+total_gst_amountre;
      //alert(distotal);
      //alert(distotal);
      $('#total_net_amount').val(distotal); 
      
     
      
       
      var distotalamount= $('#total_net_amount').val();
      var discash_amount=Math.round(distotalamount);
      var calc=discash_amount - distotalamount;
      $('#round_off_value').val(calc.toFixed(2));  
      //$('#round_off_value').val(0);
      $('#cash_value').val(discash_amount);
      $('#paid_value').val(discash_amount);
      var due_val=parseFloat($('#cash_value').val())-parseFloat($('#paid_value').val());
      $('#due_value').val(due_val);
      
      
       var total_net=$('#total_net_amount').val();
       var words =$('#cash_value').val();
       var net_amount_in_words=convertNumberToWords(Math.round(words));
       $('#amt_in_words').val(net_amount_in_words);
        
    		
    		if($('#fetch_update_data tr').length == 0)
    		{
    			$('#total_sub_total').val(0);
    			$('#total_amount_mrp').val(0);
    			$('#total_net_amount').val(0);
    			$('#total_gst_amount').val(0);
    			$('#no_of_items').val(0);
    			$('#total_quantity').val(0);
    			$('#total_discountvalue').val(0);
          $('#total_discountvaluetype').val(0);
          $('#total_discountamount').val(0);
          $('#cash_value').val(0);
          $('#round_off_value').val(0);
          $('#due_value').val(0);
          $('#paid_value').val(0);
          var words=$('#cash_value').val();
          var net_amount_in_words=convertNumberToWords(Math.round(words));
            $('#amt_in_words').val(net_amount_in_words);
    		}
    		
		});
	});
	
	</script>
	
<script>
	
	
$(document).ready(function(){
	
	$('.out_mr_validated').hide();		
	$('.out_pat_validated').hide();
	$('.in_pat_validated').hide();
			

		$("body").on('change', '.unitvalue', function () 
			{
				var get_unit=$(this).attr('data-unit');
				var get_no_of_unit=$(this).val();
				
				
						$.ajax({
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/getunitquantity&id=";?>"+encodeURIComponent(get_no_of_unit),
				            success: function (result) 
				            { 
				            	var result = $.parseJSON(result);
				            	
				            	var value_unit=result[0];
				            	var value_type=result[1];
				            	
				            	$('#data_no_of_unit'+get_unit).val(value_unit);
				            	$('#data-unit-name'+get_unit).val(value_type);
				            	
				            	var data_unit=parseInt($('#data_no_of_unit'+get_unit).val());
				            	var required_qty=parseInt($('#required_id'+get_unit).val());
				            	var total_unit=required_qty*data_unit;
				            	
				            	var availablity=parseInt($('#quanity_id'+get_unit).html());
				            	
				            	if(availablity < total_unit)
				            	{
				            		//alert("Total Units is greater than Availability");
				            		Alertment("Total Units is greater than Availability");
				            		$('#total_unit'+get_unit).val('');
				            		$('#required_id'+get_unit).val('');
				            		$('#data_unit'+get_unit).val('');
				            		$('#validated_field'+get_unit).hide();
				            			
				            	}
				            	else
				            	{
				            		$('#total_unit'+get_unit).val(total_unit);
				            		if($('#total_unit'+get_unit).val() == 'NaN')
				            		{
				            			$('#total_unit'+get_unit).val('');
				            		}
				            	}
				            	
				            }
				        });
			});
			
			
				
			$("body").on('keyup', '.enabledisc', function (e) 
			{
				
				var id_value=$(this).attr('data_disc_value');
				
				var keycode = (e.keyCode ? e.keyCode : e.which);
				
				
				if($('#percent'+id_value).is(":checked"))
          		{
          			//console.log("Worked");
          			if(keycode == '13')
          			{
						var price=parseFloat($('#price'+id_value).val());
						if(isNaN(price))
   						{
   							price=0;
   						}
						var flat_discount_percent=parseFloat($('#enabledisc'+id_value).val());
						if(isNaN(flat_discount_percent))
   						{
   							flat_discount_percent=0;
   						}
						var discount_percent=price*flat_discount_percent;
						if(isNaN(discount_percent))
   						{
   							discount_percent=0;
   						}
						var discount_value=discount_percent/100;
						if(isNaN(discount_value))
   						{
   							discount_value=0;
   						}
						$('#disc_amount'+id_value).val(discount_value);
						
						var discount_val=parseFloat($('#disc_amount'+id_value).val());
						if(isNaN(discount_val))
   						{
   							discount_val=0;
   						}
						var total_disc_val=price-discount_val;
						if(isNaN(total_disc_val))
   						{
   							total_disc_val=0;
   						}
						var gst_percent=parseInt($('#gst_percent'+id_value).val());
						if(isNaN(gst_percent))
   						{
   							gst_percent=0;
   						}
						var gst_percent_divide=gst_percent/2;
						if(isNaN(gst_percent_divide))
   						{
   							gst_percent_divide=0;
   						}
						
						var cgst_amount=total_disc_val*gst_percent_divide;
						if(isNaN(cgst_amount))
   						{
   							cgst_amount=0;
   						}
						
						var cgst_amount_total=cgst_amount/100;
						if(isNaN(cgst_amount_total))
   						{
   							cgst_amount_total=0;
   						}
						var cgst_total=cgst_amount_total;
						if(isNaN(cgst_total))
   						{
   							cgst_total=0;
   						}
						var sgst_amount=total_disc_val*gst_percent_divide;
						if(isNaN(sgst_amount))
   						{
   							sgst_amount=0;
   						}
						var sgst_amount_total=sgst_amount/100;
						if(isNaN(sgst_amount_total))
   						{
   							sgst_amount_total=0;
   						}
						var sgst_total=sgst_amount_total;
						if(isNaN(sgst_total))
   						{
   							sgst_total=0;
   						}
						var total=parseFloat(cgst_total+sgst_total);
						if(isNaN(total))
   						{
   							total=0;
   						}
						var total_amount=parseFloat(total_disc_val+total);
						if(isNaN(total_amount))
   						{
   							total_amount=0;
   						}
						$('#cgst_percent'+id_value).val(gst_percent_divide);
						$('#sgst_percent'+id_value).val(gst_percent_divide);
						$('#cgst_value'+id_value).val(cgst_total);
						$('#sgst_value'+id_value).val(sgst_total);
						$('#total_amount'+id_value).val(total_amount);
					}
				}
				else if($('#flat_discount'+id_value).is(":checked"))
				{
					if(keycode == '13')
					{
						var price=parseFloat($('#price'+id_value).val());
						var flat_discount_amt=parseFloat($('#enabledisc'+id_value).val());
						
						if(isNaN(price))
   						{
   							price=0;
   						}
						
						if(isNaN(flat_discount_amt))
   						{
   							flat_discount_amt=0;
   						}
						
						$('#disc_amount'+id_value).val(flat_discount_amt);
						
						var discount_amt=$('#disc_amount'+id_value).val();
						
						if(isNaN(discount_amt))
   						{
   							discount_amt=0;
   						}
						
						
						var discount_value=price-discount_amt;
						
						if(isNaN(discount_value))
   						{
   							discount_value=0;
   						}
						
						var gst_percent=parseInt($('#gst_percent'+id_value).val());
						
						if(isNaN(gst_percent))
   						{
   							gst_percent=0;
   						}
						
						
						
						var gst_percent_divide=gst_percent/2;
						
						if(isNaN(gst_percent_divide))
   						{
   							gst_percent_divide=0;
   						}
						
						var cgst_amount=discount_value*gst_percent_divide;
						
						if(isNaN(cgst_amount))
   						{
   							cgst_amount=0;
   						}
						
						
						var cgst_amount_total=cgst_amount/100;
						if(isNaN(cgst_amount_total))
   						{
   							cgst_amount_total=0;
   						}
						
						var cgst_total=cgst_amount_total;
						if(isNaN(cgst_total))
   						{
   							cgst_total=0;
   						}
						
						
						var sgst_amount=discount_value*gst_percent_divide;
						if(isNaN(sgst_amount))
   						{
   							sgst_amount=0;
   						}
						
						var sgst_amount_total=sgst_amount/100;
						if(isNaN(sgst_amount_total))
   						{
   							sgst_amount_total=0;
   						}
						
						
						var sgst_total=sgst_amount_total;
						if(isNaN(sgst_total))
   						{
   							sgst_total=0;
   						}
						
						
						
						var total=parseFloat(cgst_total+sgst_total);
						if(isNaN(total))
   						{
   							total=0;
   						}
						
						
						var total_amount=parseFloat(discount_value+total);
						if(isNaN(total_amount))
   						{
   							total_amount=0;
   						}
						
						
						$('#cgst_percent'+id_value).val(gst_percent_divide);
						$('#sgst_percent'+id_value).val(gst_percent_divide);
						$('#cgst_value'+id_value).val(cgst_total);
						$('#sgst_value'+id_value).val(sgst_total);
						$('#total_amount'+id_value).val(total_amount);
					}
				}
				
				var tot=0;
				var quantity_add=0;
				var disctxt_total=0;
				//var def_value=0;
				$('.total_amt_cal').each(function ()
					{	
						var data_total=$(this).attr('data_total');
   						tot = tot+parseInt($(this).val());
   						quantity_add=quantity_add+parseInt($('.quantity_add').html());
   						
   						//alert(quantity_add);
   						$('#total_amount').html(tot);
   						$('#total_net_amount').val(tot);
   						$('.total_sub_total').val(tot);
   						$('.total_rounded').val(tot);
   						
   						//$('.total_quantity ').val(quantity_add);
   						
   						if(isNaN(parseFloat($('#disc_amount'+data_total).val())))
   						{
   							$('#disc_amount'+data_total).val(0);
   							disctxt_total=parseFloat($('#disc_amount'+data_total).val());
   							$('#disc_amount'+data_total).val(disctxt_total);	
   						}
   						else
   						{
   							disctxt_total=disctxt_total+parseFloat($('#disc_amount'+data_total).val());
   							
   						}
   						
   							
   						$('#total_discountvalue').val(disctxt_total);
   						
   						
					});
			
			});			
			$("body").on('keypress', '.number', function (e) 
			{
		      //if the letter is not digit then display error and don't type anything
		      if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		      {
		        return false;
		      }
      		});

		});
		
		 function phoneno(){          
            $('.phone').keypress(function(e) {
                var a = [];
                var k = e.which;

                for (i = 48; i < 58; i++)
                    a.push(i);

                if (!(a.indexOf(k)>=0))
                    e.preventDefault();
            });
        }
		
 	function descChanged(datavalueid)
      {
      	
          if($('#percent'+datavalueid).is(":checked"))
          {
          	$("#enabledisc"+datavalueid).prop('readonly',false);
          	$('#enabledisc'+datavalueid).focus();
          	$('#disc_amount'+datavalueid).val(0);
          	$("#enabledisc"+datavalueid).val();
          	
          /*	$('#cgst_percent'+datavalueid).val(0);
          	$('#cgst_value'+datavalueid).val(0);
          	$('#sgst_percent'+datavalueid).val(0);
          	$('#sgst_value'+datavalueid).val(0);
          	$('#igst_percent'+datavalueid).val(0);
          	$('#igst_value'+datavalueid).val(0);
          	*/
          	//$('#total_amount'+datavalueid).val(0);
          	
          	$('#disc_method'+datavalueid).val('Percent');
          }
          else if($('#flat_discount'+datavalueid).is(":checked"))
          {
          	$('#disc_amount'+datavalueid).val(0);
          	$("#enabledisc"+datavalueid).val();
          	$("#enabledisc"+datavalueid).prop('readonly',false);
   	    	$('#enabledisc'+datavalueid).focus();
   	    	
          	$('#disc_method'+datavalueid).val('Flat');
          } 
              
      } 
      
    
	</script>
	
	<script>

$(document).ready(function(){
    $("input:radio:checked").data("chk",true);

		$("body").on('click', 'input:radio', function (){
        $("input[name='"+$(this).attr("name")+"']:radio").not(this).removeData("chk");
        $(this).data("chk",!$(this).data("chk"));
        $(this).prop("checked",$(this).data("chk"));
    });
    
    
    $("body").on('click', '#temp_med_fetch', function (){
    	
			$.ajax({
						
				     type: "POST",
				     url: "<?php echo Yii::$app->homeUrl . "?r=sales/temptabletfetch";?>",
				     success: function (result) 
				     {
				     	  var obj = $.parseJSON(result);
				     	  document.getElementById('temp_fetch_model_tbl').innerHTML=obj;
				          $modal = $('#temp_fetch_model');
	   					  $modal.modal('show');  	
				            	 
				     }
				  });
		
    });
    
    
    $("body").on('click', '.temp_select', function ()
    {
   			var temp_selectid=$(this).attr('temp_selectid');
   			
   			if(temp_selectid != '')
   			{
   				$.ajax({
						
				     type: "POST",
				     url: "<?php echo Yii::$app->homeUrl . "?r=sales/temptabletindividual&id=";?>"+temp_selectid,
				     success: function (result) 
				     {
				     	 
				     	/* if($('.get_temp_no').val() != '')
				     	 {
				     	 	$("#fetch_update_data tr").remove();  		
				     	 }*/
				     	$("#fetch_update_data tr").remove();  	
				     	//clearhead();
				     	cleartxt();
				     	
				     	$modal = $('#temp_fetch_model');
	   					$modal.modal('hide'); 
				     	  var obj = $.parseJSON(result);
				     	  
				     	  $("#no_of_items").val(obj[2]);
				          $("#total_quantity").val(obj[1]);
				          $("#total_gst_amount").val(obj[3]);
				          $("#total_sub_total").val(obj[5]);
				          $("#total_roundedvalue").val(obj[6]);
				          $("#total_discountamount").val(obj[4]);
				          
				          var rounded=Math.ceil(obj[7]);
				          
				          $("#total_amount_mrp").val(rounded);
				          
				          
				          $("#total_net_amount").val(rounded);
				          $('.get_slno').val(obj[8]);
				     	  $('.get_temp_no').val(obj[9]); 
				     	  
				     	  //New Code
				     	  $("#total_discountvaluetype").val(obj[10]);
				     	  $("#fetch_update_data").append(obj[0]);  
				          $('[tabindex="5"]').focus();
				          
				           $('#round_off_value').val(obj[11]);
					    	 $('#cash_value').val(obj[12]);
					    	 $('#paid_value').val(obj[13]);
					    	 $('#due_value').val(obj[14]);
					    	 
					    	 $('#amt_in_words').val(obj[15]);
					    	 $('#remarks').val(obj[16]);
				          
				          $('#total_discountvaluetype').attr('readonly','readonly');
				          $('#medicines').attr('disabled','disabled');
				          
				          $('.save_billing').removeAttr('disabled','disabled');
				     }
				  });
   			}
   });
   
   
   //Return Tablet
   $("body").on('click', '.return_val', function ()
    {
   			var temp_selectid=$(this).val();
   			//alert(temp_selectid);return false;
   			if(temp_selectid != '')
   			{
   				$.ajax({
						
				     type: "POST",
				     url: "<?php echo Yii::$app->homeUrl . "?r=sales/returntablet&id=";?>"+temp_selectid,
				     success: function (result) 
				     {
				     	 
				     	 if($('.get_temp_no').val() != '')
				     	 {
				     	 	$("#fetch_update_data tr").remove();  		
				     	 }
				     	
				     	$modal = $('#mr_hist-modal');
	   					$modal.modal('hide');
	   					 
				     	var obj = $.parseJSON(result);
				     	  
				     	$("#no_of_items").val(obj[2]);
				        $("#total_quantity").val(obj[1]);
				        $("#total_gst_amount").val(obj[3]);
				        $("#total_sub_total").val(obj[5]);
				        $("#total_roundedvalue").val(obj[6]);
				        $("#total_discountvaluetype").val(obj[4]);
				         
				          
				          
				          var rounded=Math.ceil(obj[7]);
				          $("#total_net_amount").val(rounded);
				          $('.get_slno').val(obj[8]);
				     	  $('.get_temp_no').val(obj[9]);
				     	  $('#return_tablet').val('return');
				     	   
				     	  
				     	  //New Code
				     	  $("#total_discountvaluetype").val(obj[10]);
				     	  $("#total_discountamount").val(obj[11]);
				     	  if(obj[12] == 'P')
				     	  {
				     	  		$('#overall_percent_type').prop('checked', true);
				     	  }
				     	  else if(obj[12] == 'F')
				     	  {
				     	  		$('#overall_discount_type_radio').prop('checked', true);
				     	  }
				     	  
				     	  $("#fetch_update_data").append(obj[0]);  
				     	  
				     	  //Hidden Value
				     	  $("#no_of_items_hidden").val(obj[2]);
				          $("#total_quantity_hidden").val(obj[1]);
				          $("#total_gst_amount_hidden").val(obj[3]);
				          $("#total_sub_total_hidden").val(obj[5]);
				          $("#total_roundedvalue_hidden").val(obj[6]);
				          $("#total_discountvaluetype_hidden").val(obj[10]);
				     	  $("#total_discountamount_hidden").val(obj[11]);
				          $("#total_net_amount_hidden").val(rounded);
				          
				          $('#total_discountvaluetype').attr('readonly','readonly');
				     	  $('#total_discountamount').attr('readonly','readonly');
				     	  $('#overall_percent_type').attr('disabled','disabled');
				     	  $('#overall_discount_type_radio').attr('disabled','disabled');
				     	  
				     	  $('#medicines').attr('disabled','disabled');
				     	  $('[tabindex="5"]').focus();
				     }
				  });
   			}
   	});
   
   
   
   	$("body").on('click', '.remove_all', function ()
    {
    	location.href = "<?php echo Yii::$app->homeUrl . "?r=sales/create";?>";
    	//window.location.reload(true);
    	$("#fetch_update_data tr").remove();
    	$("#saved_val").val('');
    	onetimesave=1;
    	cleartxt();
    	clearhead();
    	//window.location.reload(true);
    });
   	
   	
   	$("body").on('click', '.refresh', function ()
    {
    //	window.location.reload(true);
    });
    
    $("body").on('click', '.temp_view', function ()
    {
    	var temp_sales_medicine=$(this).attr('temp_viewid');
    	if(temp_sales_medicine != '')
    	{
    			$.ajax({	
				     type: "POST",
				     url: "<?php echo Yii::$app->homeUrl . "?r=sales/fetchtempview&id=";?>"+temp_sales_medicine,
				     success: function (result) 
				     {
				     	$("#temp_fetch_model_tbl_view tr").remove();
				     	$("#temp_fetch_model_tbl_view").append(result);
				     }
				  });
    	}
    	
    });
    
  /*  $("body").on('keyup', '.price_mrp', function ()
    {
    	var prime_id=$(this).attr('data_price_mrp');
    	var current_price=parseFloat($(this).val());
    	if(isNaN(current_price))
   		{
    
    	$('#cgst_percent'+prime_id).val(0);
    	$('#sgst_percent'+prime_id).val(0);
    	$('#cgst_value'+prime_id).val(0);
    	$('#sgst_value'+prime_id).val(0);
    	parseFloat($('#total_amount'+prime_id).val(0));
    	}
    	else
    	{
    			if($('#flat_discount'+prime_id).is(":checked"))
		    	{
		    		$('#enabledisc'+prime_id).val('');
		    		$('#disc_amount'+prime_id).val('');
		    	}
		    	else if($('#percent'+prime_id).is(":checked"))
		    	{
		    		$('#enabledisc'+prime_id).val('');
		    		$('#disc_amount'+prime_id).val('');
		    	}
    	
		    	var gst_percent=parseFloat($('#gst_percent'+prime_id).val());
		    	var divide_gst=gst_percent/2;
		    	
		    	var current_price_calc=current_price*divide_gst;
		    	var divide_gst_hun=current_price_calc/100;
		    	var divide_gst_mul=divide_gst_hun*2;
		    	$('#cgst_percent'+prime_id).val(divide_gst);
		    	$('#sgst_percent'+prime_id).val(divide_gst);
		    	$('#cgst_value'+prime_id).val(divide_gst_hun);
		    	$('#sgst_value'+prime_id).val(divide_gst_hun);
		    	var tot=divide_gst_mul+current_price;
		    	
		    	parseFloat($('#total_amount'+prime_id).val(tot));
		    	
		    	var total_amt=0;
		    	var total_amt_discount=0;
		    	var sub_total=0;
		    	var cgst_value=0;
		    	var sgst_value=0;
		    	
		    	$('.total_amt_cal').each(function ()
				{	
					//Primary Amount
					var prime_id=$(this).attr('data_total');
					
					//Total Amount of Sales
					var total_amount_value=parseFloat($('#total_amount'+prime_id).val());
					if(isNaN(total_amount_value))
					{
						total_amt=total_amt+0;	
					}
					else
					{
						total_amt=total_amt+Math.ceil(total_amount_value);
					}
				
					var disc_amount=parseFloat($('#disc_amount'+prime_id).val());
					if(isNaN(disc_amount))
					{
						total_amt_discount=parseFloat(total_amt_discount+0);
					}
					else
					{
						total_amt_discount=parseFloat(total_amt_discount+disc_amount);	
					}
					
					var disc_sub_total=parseFloat($('#price'+prime_id).val());
					if(isNaN(disc_sub_total))
					{
						sub_total=sub_total+0;	
					}
					else
					{
						sub_total=sub_total+Math.ceil(disc_sub_total);
					}
					
					var cgst_total=parseFloat($('#cgst_value'+prime_id).val());
					if(isNaN(cgst_total))
					{
						cgst_value=cgst_value+0;	
					}
					else
					{
						cgst_value=cgst_value+Math.ceil(cgst_total);
					}
					
					var sgst_total=parseFloat($('#sgst_value'+prime_id).val());
					if(isNaN(sgst_total))
					{
						sgst_value=sgst_value+0;	
					}
					else
					{
						sgst_value=sgst_value+Math.ceil(sgst_total);
					}
				});	
				
				var gst_value=sgst_value+cgst_value;
					if(isNaN(gst_value))
					{
						gst_value=0;	
					}
				
				$('#total_net_amount').val(total_amt);
				$('#total_discountvalue').val(total_amt_discount);
				$('#total_sub_total').val(sub_total);
				$('#total_gst_amount').val(gst_value);
		}
    		
    });
    */
    
    		
    		
	function Temptabletfetch() 
	{
		$.ajax({
				
		     type: "POST",
		     url: "<?php echo Yii::$app->homeUrl . "?r=sales/temptabletfetch";?>",
		     success: function (result) 
		     {
		     	  var obj = $.parseJSON(result);
		     	 $('#temp_fetch_model_tbl div').remove();
		          $('#temp_fetch_model_tbl').html(obj); 	
		            	 
		     }
		  });  
	}
    		
    		
    		
    $("body").on('keyup', '#billtxtbox', function (e)
    {
    	var billtxtbox=$('#billtxtbox').val();
    	var keycode = (e.keyCode ? e.keyCode : e.which);
    	if(keycode == '13')
        {
        	if(billtxtbox != '')
        	{
        				$.ajax({
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/getbillcounter&id=";?>"+encodeURIComponent(billtxtbox),
				            success: function (result) 
				            { 
				            	var result = $.parseJSON(result);
				            	
				            	$('#search_filter tr').remove();
				            	$('#search_filter').html(result);
				            }
				        });
        	}	
        }
    });
    
    
    $("body").on('click', '.refresh_model', function ()
    {
    	Temptabletfetch();
    });
    
   
   $("body").on('change', '.overall_disount', function ()
   {
    	if($('#overall_discount_type_radio').attr('readonly') != 'readonly' || $('#overall_percent_type').attr('readonly') != 'readonly' )
    	{
	    	if($('#overall_discount_type_radio').is(":checked"))
	        {
	        	$('#total_discountvaluetype').attr('readonly',true);
	        	$('#total_discountamount').removeAttr('readonly',true);
	        	$('#total_discountvaluetype').val('');
	        	$('#total_discountamount').val('');
	        }
	    	else if($('#overall_percent_type').is(':checked'))
	    	{
	    		$('#total_discountvaluetype').removeAttr('readonly',true);
	    		$('#total_discountamount').attr('readonly',true);
	    		$('#total_discountamount').val('');
	    		$('#total_discountvaluetype').val('');
	    	}
    	}
    });
    
  	
  	
  	
  	
  	
  	
  	  
    /*
    $("body").on('keyup', '#total_discountamount', function (e)
    {
    	  if($('#overall_discount_type_radio').is(":checked"))
          {
          		
          		var discount_value_flat=parseFloat($(this).val());
		    	var keycode = (e.keyCode ? e.keyCode : e.which);
		    	var discount_array=[];
		    	if(keycode == '13' && discount_value_flat != '')
		        {
		        	var net_amt=parseFloat($('#total_net_amount').val());
		        	var net_amt_disc=net_amt-discount_value_flat;
		        		
	        		$('.save_data_table').each(function() {
	        			var prime_id = $(this).attr('data-id');
	        			discount_array.push(prime_id);	
	        		});
	        		
	        		var disc_length=discount_array.length;
	        		var discount_amount_individual=discount_value_flat/disc_length;
	        		var discount_amount_individual=discount_amount_individual.toFixed(2);
	        		
	        		var inc=0;
	        		
	        		$('.save_data_table').each(function() 
	        		{
	        			var total_amount=parseFloat($('#total_amount'+discount_array[inc]).val());
	        			
	        			var inv_disc=total_amount-discount_amount_individual;
	        			
	        			if(inv_disc >= 0)
	        			{
	        				$('#total_amount'+discount_array[inc]).val(inv_disc.toFixed(2));
	        			}
	        			else
	        			{
	        				$('#total_amount'+discount_array[inc]).val(0);
	        			}
	        			
	        			//$('#total_net_amount').val(net_amt_disc.toFixed(2));
	        			var final_total_amount=$('#total_amount'+discount_array[inc]).val();
	        			
	        			var qty_disc=parseInt($('#quantity_add'+discount_array[inc]).html());
	        			
	        			var price_discount_individual=parseFloat(final_total_amount/qty_disc);
	        			
	        			$('#price'+discount_array[inc]).val(price_discount_individual.toFixed(2));
	        			
	        			inc++;
	        		});
	        		
	        		
	        		
	        		
	        		var net_amount=Math.ceil(net_amt_disc);
	        		
	        		$('#total_net_amount').val(net_amount);
	        		
	        		$('#total_sub_total').val(net_amt_disc.toFixed(2));
	        		//$(this).attr('readonly','readonly');
	        		
	        		var disc_amt=discount_value_flat*100;
	        		var div_at_val=disc_amt/net_amt;
	        		var div_at_val=parseFloat(div_at_val);
	        		
	        		$('#total_discountvaluetype').val(div_at_val.toFixed(2));
	        	}
	        		
          }
          else if($('#overall_percent_type').is(":unchecked")  && $('#overall_discount_type_radio').is(":unchecked"))
          {
          	  var discount_value_flat=parseFloat($(this).val());
	    	  var keycode = (e.keyCode ? e.keyCode : e.which);
          	  if(keycode == '13' && discount_value_flat != '')
		      {	
          	   		alert('Select Discount Type');
          	   		$(this).val('');
          	  }
          }
    });
    
    $("body").on('keyup', '#total_discountvaluetype', function (e)
    {
    	if($('#overall_percent_type').is(":checked"))
        {
        		var discount_value_flat=parseFloat($(this).val());
	    		var keycode = (e.keyCode ? e.keyCode : e.which);
		    	var discount_array=[];
		    	if(keycode == '13' && discount_value_flat != '')
		        {
		        		var net_amt=parseFloat($('#total_net_amount').val());
		        		var net_disc_amt=0;
		        		$('.save_data_table').each(function() 
		        		{
	        				var prime_id = $(this).attr('data-id');
	        				discount_array.push(prime_id);	
	        			});
	        			
	        		
	        			var discount_amount_individual=parseFloat(discount_value_flat.toFixed(2));
	        			var inc=0; 
	        			var sec_inc=0;
	        			
	        			var add_disc=0;
	        			$('.save_data_table').each(function() {
	        				
	        			var total_amount=parseFloat($('#total_amount'+discount_array[inc]).val());
	        			var percent_val=total_amount*discount_amount_individual;
	        			var disc_percent=percent_val/100;
	        			
	        			var disc_per_corr_amt=total_amount-disc_percent;
	        			var disc_per_corr_amt=parseFloat(disc_per_corr_amt);
	        			
	        			if(disc_per_corr_amt >= 0)
	        			{
	        				$('#total_amount'+discount_array[inc]).val(disc_per_corr_amt.toFixed(2));
	        				add_disc=add_disc+disc_per_corr_amt;
	        			}
	        			else
	        			{
	        				$('#total_amount'+discount_array[inc]).val(0);	
	        				add_disc=add_disc+0;
	        			}
	        			
	        			inc++;
	        		});
	        		
	        		$('.save_data_table').each(function() {
	        			
	        			var secod_add=parseFloat($('#total_amount'+discount_array[sec_inc]).val());
	        			
	        			var qty_disc=parseInt($('#quantity_add'+discount_array[sec_inc]).html());
	        			
	        			var price_discount_individual=parseFloat(secod_add/qty_disc);
	        			
	        			$('#price'+discount_array[sec_inc]).val(price_discount_individual.toFixed(2));
	        			
	        			net_disc_amt=net_disc_amt+secod_add;
	        			sec_inc++;
	        		});
	        		
	        		var net_amount=Math.ceil(net_disc_amt);
	        		
	        		$('#total_net_amount').val(net_amount);
	        		
	        		$('#total_sub_total').val(net_disc_amt.toFixed(2));
	        		
	        		//Total Disc Amount
	        		var net_amt_disc=net_amt*discount_amount_individual;
	        		var tot_divide=net_amt_disc/100;
	        		var tot_divide=parseFloat(tot_divide);
	        		$('#total_discountamount').val(tot_divide);
		        	//$('#total_discountvalue').attr('readonly','readonly');
		        }
        }
        else if($('#overall_percent_type').is(":unchecked")  && $('#overall_discount_type_radio').is(":unchecked"))
        {
          	  var discount_value_flat=parseFloat($(this).val());
	    	  var keycode = (e.keyCode ? e.keyCode : e.which);
          	  if(keycode == '13' && discount_value_flat != '')
		      {	
          	   		alert('Select Discount Type');
          	   		$(this).val('');
          	  }
        }	
    });
    
    /*$("body").on('keyup', '#total_discountvalue', function (e)
    {
    	var discount_value_flat=parseFloat($(this).val());
    	var keycode = (e.keyCode ? e.keyCode : e.which);
    	var discount_array=[];
    	if(keycode == '13' && discount_value_flat != '')
        {
        	
        		var net_amt=parseFloat($('#total_net_amount').val());
        		var net_amt_disc=net_amt-discount_value_flat;
        		
        		$('.save_data_table').each(function() {
        			var prime_id = $(this).attr('data-id');
        			discount_array.push(prime_id);	
        		});
        		
        		var disc_length=discount_array.length;
        		var discount_amount_individual=discount_value_flat/disc_length;
        		var discount_amount_individual=discount_amount_individual.toFixed(2);
        		
        		var inc=0;
        		
        		
        		
        		
        		$('.save_data_table').each(function() 
        		{
        			var total_amount=parseFloat($('#total_amount'+discount_array[inc]).val());
        			var inv_disc=total_amount-discount_amount_individual;
        			
        			if(inv_disc >= 0)
        			{
        				$('#total_amount'+discount_array[inc]).val(inv_disc.toFixed(2));
        			}
        			else
        			{
        				$('#total_amount'+discount_array[inc]).val(0);
        			}
        			
        			$('#total_net_amount').val(net_amt_disc.toFixed(2));
        			inc++;
        		});
        		
        		$('#total_net_amount').val(net_amt_disc.toFixed(2));
        		$(this).attr('readonly','readonly');
        		
        		var disc_amt=discount_value_flat*100;
        		var div_at_val=disc_amt/net_amt;
        		var div_at_val=parseFloat(div_at_val);
        		
        		$('#over_all_discount_percent').val(div_at_val.toFixed(2));
        		
        		
           	   // $('#over_all_discount_percent').attr('readonly','readonly');
        }
           
    });*/
    
    
/*    $("body").on('keyup', '#over_all_discount_percent', function (e)
    {
    		var discount_value_flat=parseFloat($(this).val());
    		var keycode = (e.keyCode ? e.keyCode : e.which);
	    	var discount_array=[];
	    	if(keycode == '13' && discount_value_flat != '')
	        {
	        		var net_amt=parseFloat($('#total_net_amount').val());
	        		var net_disc_amt=0;
	        		$('.save_data_table').each(function() 
	        		{
        				var prime_id = $(this).attr('data-id');
        				discount_array.push(prime_id);	
        			});
        			
        		
        			var discount_amount_individual=parseFloat(discount_value_flat.toFixed(2));
        			var inc=0; 
        			var sec_inc=0;
        			
        			var add_disc=0;
        			$('.save_data_table').each(function() {
        				
        			var total_amount=parseFloat($('#total_amount'+discount_array[inc]).val());
        			var percent_val=total_amount*discount_amount_individual;
        			var disc_percent=percent_val/100;
        			
        			var disc_per_corr_amt=total_amount-disc_percent;
        			var disc_per_corr_amt=parseFloat(disc_per_corr_amt);
        			
        			if(disc_per_corr_amt >= 0)
        			{
        				$('#total_amount'+discount_array[inc]).val(disc_per_corr_amt.toFixed(2));
        				add_disc=add_disc+disc_per_corr_amt;
        			}
        			else
        			{
        				$('#total_amount'+discount_array[inc]).val(0);	
        				add_disc=add_disc+0;
        			}
        			
        			inc++;
        		});
        		
        		$('.save_data_table').each(function() {
        			
        			var secod_add=parseFloat($('#total_amount'+discount_array[sec_inc]).val());
        			net_disc_amt=net_disc_amt+secod_add;
        			sec_inc++;
        		});
        		
        		$('#total_net_amount').val(net_disc_amt);
        		$(this).attr('readonly','readonly');
        		
        		//Total Disc Amount
        		var net_amt_disc=net_amt*discount_amount_individual;
        		var tot_divide=net_amt_disc/100;
        		var tot_divide=parseFloat(tot_divide);
        		$('#total_discountvalue').val(tot_divide);
	        	$('#total_discountvalue').attr('readonly','readonly');
	        }
	        
     });	*/
     
     
    $("body").on('click', '#history_detils', function (e)
    {
    	var mr_number=$('#mrnumber').val();
    	if(mr_number != '')
    	{
    		$.ajax({
    				
				      type: "POST",
				      url: "<?php echo Yii::$app->homeUrl . "?r=sales/histmrnumberpdf&id=";?>"+mr_number,
				      success: function (result) 
				      {
				      	
				      	 $('#sale_history_report').html(result);
				      	 $modal = $('#mr_hist-modal');
						 $modal.modal('show'); 
				      	
				      }
				  });
    	}
    	else if(mr_number == '')
    	{
    		//alert('Enter MR Number');
    		Alertment('Enter MR Number');
    	}
    });	
   
});
 </script>
 
  <script>
 

 
  
  
  
  //Fetch Qty
  function BatchQty(event)
  {
  		var fetch_batch_qty=parseInt($('#fetch_batch_qty').val());
		var stk=parseInt($('#stk').val());
		var keycode = (event.keyCode ? event.keyCode : event.which);
		$('.required_qty').val('');
		$('.total_unit').val('');
		$('.no_of_unit').val('');
		
		if(keycode == '13')
      	{
    		if(fetch_batch_qty <= stk)
    		{
    			var prime_id_conv=$('#prime_id_conv').val();
    			
    			var strtoarray = prime_id_conv.split(',');
    			var ty=0;
    			var strtoarray1=prime_id_conv.split(',');
    			
    			for (var i=0; i < strtoarray.length; i++) 
    			{
				  	var Qty=parseInt($('#quanity_id'+strtoarray[i]).html());
				  	
				  	
				  	if(parseInt($('#quanity_id'+strtoarray[0]).html()) >= fetch_batch_qty)
				  	{
				  		$('#required_id'+strtoarray[0]).val(fetch_batch_qty);
				  		var data_unit=parseInt($('#data_unit'+strtoarray[i]).val());
				  		var uui=strtoarray[0];
				  		Getunitquantity(data_unit,uui);	
				  		break;
				  	}
				  	else
				  	{
				  		$('#required_id'+strtoarray[i]).val(Qty);
				  		ty=ty+parseInt($('#required_id'+strtoarray[i]).val());
				  		
				  		var data_unit=parseInt($('#data_unit'+strtoarray[i]).val());
				  		var uui=strtoarray[i];
				  		Getunitquantity(data_unit,uui);	
				  		
				  		if(ty >= fetch_batch_qty)
				  		{
				  			
				  			$('#required_id'+strtoarray[i]).val('');
				  			var io=0;
				  			
				  			for (var j=0; j < strtoarray.length; j++)
							{
								var yui=parseInt($('#required_id'+strtoarray[j]).val());
								if(isNaN(yui))
								{
									io=io+0;
								}
								else
								{
									io=io+parseInt($('#required_id'+strtoarray[j]).val());
									
								}
							};
							
							var iop=fetch_batch_qty-io;
							
							$('#required_id'+strtoarray[i]).val(iop);
				  			break;
				  		}
    							
				  	}
				  	
				}
				$('#add_to_grid').focus();
				//Add_to_grid1();
			}
    		else
    		{
    			//alert('Enter More than Availability Stock');
    			Alertment('Enter More than Availability Stock');
    		}
    		
    	}
    
    } 
 
    
    
   	function Getunitquantity(data_unit,uui)
    {
    	$('#load1').show();
		$.ajax({
            type: "POST",
            url: "<?php echo Yii::$app->homeUrl . "?r=sales/getunitquantity&id=";?>"+encodeURIComponent(data_unit),
            success: function (result) 
            { 
            	var result = $.parseJSON(result);
            	var value_unit=result[0];
            	var value_type=result[1];
            	$('#data_no_of_unit'+uui).val(value_unit);
            	$('#data-unit-name'+uui).val(value_type);
            	var unit_mul=parseInt($('#data_no_of_unit'+uui).val());
            	var required_id=parseInt($('#required_id'+uui).val());
            	var tot=required_id*unit_mul;
            	$('#total_unit'+uui).val(tot);
            	$('#load1').hide();
            }
		});				
    }
  
  
  
  //Add To Grid
  function Add_to_grid(event)
  {


  		if(event.keyCode === 13)
  		{
			var arr = [];
			var tbl_value = [];
			var validated = [];
			
			$('.required_qty').each(function ()
			{	
   				arr.push($(this).val());
   				tbl_value.push($(this).attr('data-id'));
   				
			});
			
			var prime_removal=$('#prime_id_conv').val();
			var prime_split=prime_removal.split(',');
			var iny=0;
			$('.save_data_table').each(function ()
			{	
   				$('#table_del'+prime_split[iny]).remove();
   				iny++;
			});
					
			var slnovalue='';
			var total_net_amount=0;
			var total_net_quantity=0;
			var no_of_items=0;
			var total_gst_amount=0;
			var sub_total=0;
			var disc_amount=0;
			
			
					 
			if($('.get_slno').val() == '')
			{
				var slno=1;
					
				for (var i=0; i < arr.length; i++)
				{
					 var product_type=$('#data_unit'+tbl_value[i]).val();
					 if(arr[i] != '' && tbl_value[i] != '')
					 {	
						if(product_type != '')
						{
							//validation
							$('#validated_field'+tbl_value[i]).hide();
							var batch_id=$('#batch_id'+tbl_value[i]).html();
						  	var manu_date_id=$('#manu_date_id'+tbl_value[i]).html();
						  	var expire_date_id=$('#expire_date_id'+tbl_value[i]).html();
						  		
						  	//unit calculation
						  	var mrp_id=parseFloat($('#mrp_id'+tbl_value[i]).html());
						  	var total_unit=parseInt($('#total_unit'+tbl_value[i]).val());
						  	//var price_per_quantity=total_unit*mrp_id.toFixed(1);
						  	var price_per_quantity=total_unit*mrp_id;
						  	
						  	var product_name=$('#prd_name'+tbl_value[i]).html();
						  	var batchnumber=$('#batchnumber'+tbl_value[i]).html();
						  		
						  	//Quanity variable
						  	//var total_qty=$('#total_qty'+tbl_value[i]).html();
						  	var quanity_id=parseInt($('#quanity_id'+tbl_value[i]).html());
						  	var required_id=parseInt($('#required_id'+tbl_value[i]).val());
						  		
						  	//var current_available_stock=quanity_id-required_id;
						  		
						  	var unit_value=$('#data-unit-name'+tbl_value[i]).val();
						  		
						  	var gst_sale_percent=$('#gst_sale_percent'+tbl_value[i]).html();
						  		
						  					
							var product_id=$('#product_id'+tbl_value[i]).val();
							var brandcode_id=$('#brandcode_id'+tbl_value[i]).val();
							var stockcode_id=$('#stockcode_id'+tbl_value[i]).val();
							var composition_id=$('#composition_id'+tbl_value[i]).val();
							var unit_id=$('#unit_id'+tbl_value[i]).val();
							var stock_id=$('#stock_id'+tbl_value[i]).val();
							var mrp_id=$('#mrp_id'+tbl_value[i]).html();
								 	
							var tablet_type=$('#data_unit'+tbl_value[i]).val();
							
							var data_no_of_unit_value=$('#data_no_of_unit'+tbl_value[i]).val();	
							
							
							//New Code 16/11/2018
							var original_mrp_price=$('#mrp_per_qty_hide'+tbl_value[i]).val();
										
							var markup = "<tr  class='save_data_table' data-id="+tbl_value[i]+" id='table_del"+tbl_value[i]+"'><td class='hide'>"+slno+"</td><td style='width:7%'><div class='trunctext '  style=' '  >"+product_name+"</div></td><td  style='width:6%';>"+batchnumber+"</td><td  style='width:8%';>"+expire_date_id+"</td><td style='width:5%'; class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td  style='width:7%'; id='unit_value_medicine"+tbl_value[i]+"'>"+unit_value+"</td><td style='width:8%';><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tbl_value[i]+"' value='"+unit_value+"'><input type='hidden' name='tablet_tot_unit_ins[]' id='tablet_tot_unit"+tbl_value[i]+"' value='"+total_unit+"'><input type='hidden' name='tablet_type[]' id='tablet_type"+tbl_value[i]+"' value='"+tablet_type+"'><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='mrp_per_unit_amount[]' value='"+original_mrp_price+"'><input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='hidden' name='price[]' class='price_mrp text-right disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+price_per_quantity+" id="+'price'+tbl_value[i]+"><input type='text' readonly name='showmrp[]' class='showmrp text-right disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+original_mrp_price+" id="+'show_mrp'+tbl_value[i]+"></td>"
						  								//+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"'  disabled='disabled' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>F</label></li><li>"
						  								//+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+"  disabled='disabled' class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'> <input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"'  class='enabledisc disctxt w-55' readonly></div></td><td><div class='input-group'> <input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount text-right disctxt w-55' readonly>"
						  								+"</div></td><td class='w-xss hide'><input type='hidden' class='form-control w-50' data_gst_percent='"+tbl_value[i]+"' name='gst_percent[]' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td class='hide'><input type='text'  class='form-control w-50' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='cgst_percent disctxt w-55 text-right' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class=' cgst_value disctxt w-53 text-right' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='sgst_percent  disctxt w-55' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class=' w-53 disctxt sgst_value text-right' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='w-53 disctxt total_amt_cal text-right' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly><input type='hidden'  class='form-control reduired_qty_hidden text-right' name='reduired_qty_hidden[]' data_total='"+tbl_value[i]+"' value="+required_id+" id='reduired_qty_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control price_hidden text-right' name='price_hidden[]' data_total='"+tbl_value[i]+"' id='price_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_percentage_hidden text-right' name='cgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_value_hidden text-right' name='cgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_percentage_hidden text-right' name='sgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_value_hidden text-right' name='sgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control total_amt_cal1 text-right' name='total_amt_cal1[]' data_total='"+tbl_value[i]+"' id='total_amount1"+tbl_value[i]+"'></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																																					
																													
														
						 if($("#fetch_update_data").append(markup))
		               	{
		               		var disc_percentage=parseFloat($('#total_discountvaluetype').val());
			                if(disc_percentage!='')
			                {
				                 setTimeout(function () {                 
				                 OverallPercentageDiscountProcedure(disc_percentage);
				               },200);
			                } 
		               	}	
						  	
						  	 
						  	 if(isNaN($('#price'+tbl_value[i]).val()))
   							 {
   								$('#price'+tbl_value[i]).val(0);
   								
   								//$('#price_hidden'+tbl_value[i]).val(0);
   							 }
						  	 else
						  	 {
						  		$('#price'+tbl_value[i]).val();
						  		//$('#price_hidden'+tbl_value[i]).val();
						  	 }
						  		
						  	 if(gst_sale_percent == 0)
						  	 {
						  		$('#cgst_percent'+tbl_value[i]).val(0);
						  		$('#cgst_value'+tbl_value[i]).val(0);
						  		$('#sgst_percent'+tbl_value[i]).val(0);
						  		$('#sgst_value'+tbl_value[i]).val(0);
						  		$('#igst_percent'+tbl_value[i]).val(0);
						  		$('#igst_value'+tbl_value[i]).val(0);
						  			
						  		var price=parseFloat($('#price'+tbl_value[i]).val());
						  		//var priceceil=Math.ceil(price);
						  		//Total
						  		$('#total_amount'+tbl_value[i]).val(price.toFixed(2));
						  		
						  		//Hidden Value Set	
						  		$('#total_amount1'+tbl_value[i]).val(price.toFixed(2));
						  		$('#price_hidden'+tbl_value[i]).val(price.toFixed(2));
						  		$('#cgst_percentage_hidden'+tbl_value[i]).val(0);
						  		$('#cgst_value_hidden'+tbl_value[i]).val(0);
						  		$('#sgst_percentage_hidden'+tbl_value[i]).val(0);
						  		$('#sgst_value_hidden'+tbl_value[i]).val(0);
						  			
						  	 }
						  	 else
						  	 {
						  		var gst_divide=gst_sale_percent/2;
						  		
						  		if(isNaN(gst_divide))
   							 	{
   									gst_divide=0;
   							 	}
						  		
						  		var total_amount=parseFloat($('#price'+tbl_value[i]).val());
						  		
						  		if(isNaN(total_amount))
   							 	{
   									total_amount=0;
   							 	}
						  			
						  		var cgst_value=total_amount*gst_divide;
						  		
						  		if(isNaN(cgst_value))
   							 	{
   									cgst_value=0;
   							 	}
						  		
						  		var cgst_amt=cgst_value/100;
						  		
						  		if(isNaN(cgst_amt))
   							 	{
   									cgst_amt=0;
   							 	}
						  		
						  		var cgst_amount=parseFloat(cgst_amt);
						  		
						  		if(isNaN(cgst_amount))
   							 	{
   									cgst_amount=0;
   							 	}
						  			
						  		var sgst_value=total_amount*gst_divide;
						  		
						  		if(isNaN(sgst_value))
   							 	{
   									sgst_value=0;
   							 	}
						  		
						  		var sgst_amt=sgst_value/100;
						  		
						  		if(isNaN(sgst_amt))
   							 	{
   									sgst_amt=0;
   							 	}
						  		
						  		var sgst_amount=parseFloat(sgst_amt);
						  			
						  		if(isNaN(sgst_amount))
   							 	{
   									sgst_amount=0;
   							 	}	
						  			var total=total_amount+cgst_amount+sgst_amount;
						  			var totfloat=parseFloat(total);
						  		if(isNaN(total))
   							 	{
   									total=0;
   							 	}	
						  		
						  			$('#cgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#cgst_value'+tbl_value[i]).val(cgst_amount.toFixed(2));
						  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#sgst_value'+tbl_value[i]).val(sgst_amount.toFixed(2));
						  			$('#igst_percent'+tbl_value[i]).val(0);
						  			$('#igst_value'+tbl_value[i]).val(0);
						  			//Total
						  			$('#total_amount'+tbl_value[i]).val(totfloat.toFixed(2));
						  			
						  			
						  			
						  			//Hidden Value Set	
							  		$('#total_amount1'+tbl_value[i]).val(totfloat.toFixed(2));
							  		$('#price_hidden'+tbl_value[i]).val(total_amount.toFixed(2));
							  		$('#cgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
							  		$('#cgst_value_hidden'+tbl_value[i]).val(cgst_amount.toFixed(2));
							  		$('#sgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
							  		$('#sgst_value_hidden'+tbl_value[i]).val(sgst_amount.toFixed(2));
						  			
						  		}
						  		
						  		slno++;
						  		slnovalue=slno;	
						  }
							else
							{
								$('#validated_field'+tbl_value[i]).show();
								$("#fetch_update_data tr").remove();
								$modal = $('#myModal');
								$modal.modal('show'); 
								return false;
							}	
							
					  	}
					  	
					}
					
								$('.get_slno').val(slnovalue);
					 			$modal = $('#myModal');
								$modal.modal('hide'); 
									
					}
					else
					{
								 var slno=parseInt($('.get_slno').val());
								 //exist total quanity
								 var value=parseFloat($('#total_net_amount').val());
								 var total_quantity_exist=parseInt($('#total_quantity').val());
								 var no_of_items1=parseInt($('#no_of_items').val());
								 var total_gst_amount1=parseFloat($('#total_gst_amount').val());
								 var sub_total1=parseFloat($('#total_sub_total').val());
								 var disc_amount1=parseFloat($('#total_discountvalue').val())
					 
									for (var i=0; i < arr.length; i++)
									{
										
										var product_type=$('#data_unit'+tbl_value[i]).val();
										
									  	if(arr[i] != '' && tbl_value[i] != '')
									  	{
									  		if(product_type != '')
											{
													
												$("#table_del"+tbl_value[i]).remove();									
											  	var batch_id=$('#batch_id'+tbl_value[i]).html();
											  	var manu_date_id=$('#manu_date_id'+tbl_value[i]).html();
											  	var expire_date_id=$('#expire_date_id'+tbl_value[i]).html();
											  		
											  	//unit calculation
											  	var mrp_id=parseFloat($('#mrp_id'+tbl_value[i]).html());
											  	var total_unit=parseInt($('#total_unit'+tbl_value[i]).val());
											  	//var price_per_quantity=total_unit*mrp_id.toFixed(1);
											  	var price_per_quantity=total_unit*mrp_id;
											  	
											  	var product_name=$('#prd_name'+tbl_value[i]).html();
											  	var batchnumber=$('#batchnumber'+tbl_value[i]).html();
											  		
											  	//Quanity variable
											  	//var total_qty=$('#total_qty'+tbl_value[i]).html();
											  	var quanity_id=parseInt($('#quanity_id'+tbl_value[i]).html());
											  	var required_id=parseInt($('#required_id'+tbl_value[i]).val());
											  	var unit_value=$('#data-unit-name'+tbl_value[i]).val();
											  
											  	var gst_sale_percent=$('#gst_sale_percent'+tbl_value[i]).html();
											  	var product_id=$('#product_id'+tbl_value[i]).val();
											  	var brandcode_id=$('#brandcode_id'+tbl_value[i]).val();
												var stockcode_id=$('#stockcode_id'+tbl_value[i]).val();
												var composition_id=$('#composition_id'+tbl_value[i]).val();
												var unit_id=$('#unit_id'+tbl_value[i]).val();
												var stock_id=$('#stock_id'+tbl_value[i]).val();
												var mrp_id=$('#mrp_id'+tbl_value[i]).html();
												 	
												var tablet_type=$('#data_unit'+tbl_value[i]).val();	
												
												var data_no_of_unit_value=$('#data_no_of_unit'+tbl_value[i]).val();	
												//alert(data_no_of_unit_value);
												
												//New Code 16/11/2018
												var original_mrp_price=$('#mrp_per_qty_hide'+tbl_value[i]).val();
												
												
												var markup = "<tr  class='save_data_table' data-id="+tbl_value[i]+" id='table_del"+tbl_value[i]+"'><td class='hide'>"+slno+"</td><td style='width:7%'><div class='trunctext  '>"+product_name+"</div></td><td style='width:6%';>"+batchnumber+"</td><td style='width:8%';>"+expire_date_id+"</td><td style='width:5%'; class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td style='width:7%'; id='unit_value_medicine"+tbl_value[i]+"'>"+unit_value+"</td><td style='width:8%';><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tbl_value[i]+"' value='"+unit_value+"'><input type='hidden' name='tablet_tot_unit_ins[]' id='tablet_tot_unit"+tbl_value[i]+"' value='"+total_unit+"'><input type='hidden' name='tablet_type[]' id='tablet_type"+tbl_value[i]+"' value='"+tablet_type+"'><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='mrp_per_unit_amount[]' value='"+original_mrp_price+"'><input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='hidden' name='price[]' class='price_mrp text-right  disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+price_per_quantity+" id="+'price'+tbl_value[i]+"><input type='text' readonly name='showmrp[]' class='showmrp text-right disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+original_mrp_price+" id="+'show_mrp'+tbl_value[i]+"></td>"
						  								//+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"'  disabled='disabled' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>F</label></li><li>"
						  								//+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+"  disabled='disabled' class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'> <input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"'  class='enabledisc disctxt w-55' readonly></div></td><td><div class='input-group'> <input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount text-right disctxt w-55' readonly>"
						  								+"</div></td><td class='w-xss hide'><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' name='gst_percent[]' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td class='hide'><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='form-control cgst_percent text-right' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='w-53 cgst_value text-right' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='form-control sgst_percent' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='w-53 sgst_value text-right' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control total_amt_cal text-right' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly><input type='hidden'  class='form-control reduired_qty_hidden text-right' name='reduired_qty_hidden[]' data_total='"+tbl_value[i]+"' value="+required_id+" id='reduired_qty_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control price_hidden text-right' name='price_hidden[]' data_total='"+tbl_value[i]+"' id='price_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_percentage_hidden text-right' name='cgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_value_hidden text-right' name='cgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_percentage_hidden text-right' name='sgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_value_hidden text-right' name='sgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control total_amt_cal1 text-right' name='total_amt_cal1[]' data_total='"+tbl_value[i]+"' id='total_amount1"+tbl_value[i]+"'></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																																					
																			
					
                
                  //	 $("#fetch_update_data").append(markup);


                /* var disc_percentage=parseFloat($('#total_discountvaluetype').val());

                if(disc_percentage!=''){
                 OverallPercentageDiscountProcedure(disc_percentage);
                } */
               	if($("#fetch_update_data").append(markup))
               	{
               		var disc_percentage=parseFloat($('#total_discountvaluetype').val());
	                if(disc_percentage!='')
	                {
		                 setTimeout(function () {                 
		                 OverallPercentageDiscountProcedure(disc_percentage);
		               },200);
	                } 
               	}						
                 
													
											    if(isNaN($('#price'+tbl_value[i]).val()))
				   							 	{
				   									$('#price'+tbl_value[i]).val(0);
				   							 	}
										  		else
										  		{
										  			$('#price'+tbl_value[i]).val();
										  		}
										  		
										  		if(gst_sale_percent == 0)
										  		{
										  			$('#cgst_percent'+tbl_value[i]).val(0);
										  			$('#cgst_value'+tbl_value[i]).val(0);
										  			$('#sgst_percent'+tbl_value[i]).val(0);
										  			$('#sgst_value'+tbl_value[i]).val(0);
										  			$('#igst_percent'+tbl_value[i]).val(0);
										  			$('#igst_value'+tbl_value[i]).val(0);
										  			
										  			var price=parseFloat($('#price'+tbl_value[i]).val());
										  			//var priceceil=Math.ceil(price);
										  			//Total Price
										  			if(isNaN(price))
   							 						{
   													 	price=0;
   							 						}
										  			
										  			$('#total_amount'+tbl_value[i]).val(price.toFixed(2));
										  			
										  			//Hidden Value Set	
											  		$('#total_amount1'+tbl_value[i]).val(price.toFixed(2));
											  		$('#price_hidden'+tbl_value[i]).val(price.toFixed(2));
											  		$('#cgst_percentage_hidden'+tbl_value[i]).val(0);
											  		$('#cgst_value_hidden'+tbl_value[i]).val(0);
											  		$('#sgst_percentage_hidden'+tbl_value[i]).val(0);
											  		$('#sgst_value_hidden'+tbl_value[i]).val(0);
										  			
										  			
										  		}
										  		else
										  		{
										  			var gst_divide=gst_sale_percent/2;
										  			if(isNaN(gst_divide))
   							 						{
   													 	gst_divide=0;
   							 						}
										  			var total_amount=parseFloat($('#price'+tbl_value[i]).val());
										  			if(isNaN(total_amount))
   							 						{
   													 	total_amount=0;
   							 						}
										  			var cgst_value=total_amount*gst_divide;
										  			if(isNaN(cgst_value))
   							 						{
   													 	cgst_value=0;
   							 						}
										  			var cgst_amt=cgst_value/100;
										  			if(isNaN(cgst_amt))
   							 						{
   													 	cgst_amt=0;
   							 						}
										  			var cgst_amount=parseFloat(cgst_amt);
										  			if(isNaN(cgst_amount))
   							 						{
   													 	cgst_amount=0;
   							 						}
										  			var sgst_value=total_amount*gst_divide;
										  			if(isNaN(sgst_value))
   							 						{
   													 	sgst_value=0;
   							 						}
										  			var sgst_amt=sgst_value/100;
										  			if(isNaN(sgst_amt))
   							 						{
   													 	sgst_amt=0;
   							 						}
										  			var sgst_amount=parseFloat(sgst_amt);
										  			if(isNaN(sgst_amount))
   							 						{
   													 	sgst_amount=0;
   							 						}
										  			var total=total_amount+cgst_amount+sgst_amount;
										  			var totalceil=parseFloat(total);
										  			if(isNaN(total))
   							 						{
   													 	total=0;
   							 						}
										  		
										  			$('#cgst_percent'+tbl_value[i]).val(gst_divide);
										  			$('#cgst_value'+tbl_value[i]).val(cgst_amount.toFixed(2));
										  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
										  			$('#sgst_value'+tbl_value[i]).val(sgst_amount.toFixed(2));
										  			$('#igst_percent'+tbl_value[i]).val(0);
										  			$('#igst_value'+tbl_value[i]).val(0);
										  			//Total Price
										  			$('#total_amount'+tbl_value[i]).val(totalceil.toFixed(2));
										  			
										  			//Hidden Value Set	
											  		$('#total_amount1'+tbl_value[i]).val(totalceil.toFixed(2));
											  		$('#price_hidden'+tbl_value[i]).val(total_amount.toFixed(2));
											  		$('#cgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
											  		$('#cgst_value_hidden'+tbl_value[i]).val(cgst_amount.toFixed(2));
											  		$('#sgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
											  		$('#sgst_value_hidden'+tbl_value[i]).val(sgst_amount.toFixed(2));
										  			
										  			
										  		}
											  		slno++;
											  		slnovalue=slno;
											  	
									  		}
											if(product_type == '')
											{
													$('#validated_field'+tbl_value[i]).show();
													$modal = $('#myModal');
													$modal.modal('show'); 
													return false;
											}	
											
											
									  	}
									} // For Loop End
		
									$('.get_slno').val(slnovalue);
									 $modal = $('#myModal');
									$modal.modal('hide'); 
									
									
					}
						
						var inc=0;
						var total_amount=0;
						var total_amount_final=0;
						var total_quantity=0;
						var total_quantity_final=0;
						var total_gst_amount=0;
						var total_gst_amount_final=0;
						var disc_amount=0;
						var disc_amount_final=0;
						var total_net_amount=0;
						var total_net_amount_final=0;
						var hidden_net_amount=0;
						$('.save_data_table').each(function ()
						{	
							var data_id=$(this).attr('data-id');
							total_amount=parseFloat($('#price'+data_id).val());
							total_quantity=parseInt($('#quantity_add'+data_id).html());
							var sgst=parseFloat($('#sgst_value'+data_id).val());
							var cgst=parseFloat($('#cgst_value'+data_id).val());
							disc_amount=parseFloat($('#disc_amount'+data_id).val());
							total_net_amount=parseFloat($('#total_amount'+data_id).val());
							
							var hidden_net_amount_var=parseFloat($('#total_amount1'+data_id).val());
							
							if(isNaN(hidden_net_amount_var))
							{
								hidden_net_amount_var=0;
							}
							
							
							if(isNaN(sgst))
   							{
   								sgst=0;
   							}
   							if(isNaN(cgst))
   							{
   								cgst=0;
   							}
   							
							total_gst_amount=cgst+sgst;
							
							if(isNaN(total_amount))
   							{
   								total_amount=0;
   							}
   							if(isNaN(total_quantity))
   							{
   								total_quantity=0;
   							}
   							if(isNaN(total_quantity))
   							{
   								total_quantity=0;
   							}
   							if(isNaN(disc_amount))
   							{
   								disc_amount=0;
   							}
   							if(isNaN(total_net_amount))
   							{
   								total_net_amount=0;
   							}
							total_amount_final+=total_amount;
							total_quantity_final+=total_quantity;
							total_gst_amount_final+=total_gst_amount;
							
							disc_amount_final+=disc_amount;
							total_net_amount_final+=total_net_amount;
							inc++;	
							
							hidden_net_amount=hidden_net_amount_var+hidden_net_amount;			
						});
						
						$('#no_of_items').val(inc);
						$('#total_sub_total').val(total_amount_final.toFixed(2));
						$('#total_quantity').val(total_quantity_final);
						$('#total_gst_amount').val(total_gst_amount_final.toFixed(2));
						$('#total_discountvalue').val(disc_amount_final.toFixed(2));
						$('#total_roundedvalue').val(total_net_amount_final.toFixed(2));
						
						$('#total_net_amount').val(total_net_amount_final.toFixed(2));
						
						//new code 20/11/2018
						$('#total_amount_mrp').val(hidden_net_amount.toFixed(2));
						
						
						//Amount In Words
						var net_amount_in_words=convertNumberToWords(Math.round(total_net_amount_final));
						$('#amt_in_words').val(net_amount_in_words);
						
						//cash value
						$('#cash_value').val(Math.round(total_net_amount_final));
						
						//Round Off Value
						var round_off_value=Math.round(total_net_amount_final);
						if(round_off_value > total_net_amount_final)
						{
							var round_off_cal=round_off_value - total_net_amount_final;
							$('#round_off_value').val(round_off_cal.toFixed(2));
						}
						else if(round_off_value < total_net_amount_final)
						{
							var round_off_cal=total_net_amount_final - round_off_value;
							$('#round_off_value').val(round_off_cal.toFixed(2));
						}
					
						var get_insurancevalue=$('#pat_insurance').val();
						 if(get_insurancevalue === "1" || get_insurancevalue === "2" || get_insurancevalue === "3")
						 {
						 	
						 		$('#due_value').val(Math.round(total_net_amount_final));
      							$('#paid_value').val('0');	
      					 }
      					 else
      					 {
      							$('#due_value').val('0');
      							$('#paid_value').val(Math.round(total_net_amount_final));
      					 }
      							
						
				
						
						
						
						$('#fetch_update_data').scrollTop(200);
						
						$('#medicines').val('');
						$('#medicines').focus();
						
						//PaidAmountCalculation();
			}
			
  }
  
function PaidAmountCalculation(data,event) 
{
	var cash_val=$('#cash_value').val();
	var paid_amount=data.value;
	if(cash_val>=paid_amount){
		var overall_net_amount=parseFloat($("#total_net_amount").val());
		if(overall_net_amount>=0){
			var due_amt=overall_net_amount-paid_amount;
			$('#due_value').val(due_amt);	
		}else{
			$('#due_value').val('0');
		}	
	}else{
		Alertment('Net AMount is not Equal');
		$('#due_value').val('0');
	}
	
	
	
}

 
 function QtyValidation(id)
 {
 	 var qty_val=parseInt($('#remove_qty'+id).val());
 	 var prevoius_qty=parseInt($('#quantity_add'+id).html());
 	 var tablet_price=$('#price'+id).val();
 	 var total_amount=$('#total_amount'+id).val();
 	 
 	 //Hidden Static Value
 	 var static_total_amount=$('#static_total_amount'+id).val();
 	 var static_price=$('#static_price'+id).val();
 	 var static_product=$('#static_product'+id).val();
 	 var static_qty=$('#total_quantity_hidden').val();
 	 //var static_items=$('#no_of_items_hidden').val();
 	 
 	 
 	 if(static_product < qty_val)
 	 {
 	 	alert('Return Qty is Greater than Typed Qty');
 	 	$('#remove_qty'+id).val('');
 	 	$('#total_sub_total').val($('#total_sub_total_hidden').val());
 	 	$('#total_net_amount').val($('#total_net_amount_hidden').val());
 	 	$('#total_quantity').val($('#total_quantity_hidden').val());
 	 	
 	 }
 	 else if(static_product > qty_val)
 	 {
 	 	
 	 	if(qty_val != 0)
 	 	{
 	 		var tablet_price=parseFloat(static_total_amount/static_product);
 	 		
 	 		$('#price'+id).val(tablet_price.toFixed(1));
 	 		
 	 		var return_qty=$('#remove_qty'+id).val();
 	 		var total_individual_qty=parseFloat(tablet_price*return_qty);
 	 		
 	 		$('#total_amount'+id).val(total_individual_qty.toFixed(1));
 	 		
 	 		
	 	 	
	 	 	var total_net_amount=0;
	 	 	$(".total_amt_cal").each(function() 
	 	 	{
			  	if(isNaN($(this).val()) || $(this).val() == '' || $(this).val() == 'undefined' || $(this).val() == NaN || $(this).val() == 'NaN')
	 	 		{
	 	 			total_net_amount=total_net_amount+0;
	 	 		}
			  	else
			  	{
			  		total_net_amount=total_net_amount+parseFloat($(this).val());
			  	}
			});
	 	 	
	 	 	$('#total_sub_total').val(total_net_amount.toFixed(1));
	 	 	var net_amount_rounded=Math.ceil(total_net_amount);
	 	 	$('#total_net_amount').val(net_amount_rounded);
	 	 	
	 	 	var qty_item=0;
	 	 	$(".qtyreturnstatus").each(function() 
	 	 	{
			  	if(isNaN($(this).val()) || $(this).val() == '' || $(this).val() == 'undefined' || $(this).val() == NaN || $(this).val() == 'NaN')
	 	 		{
	 	 			qty_item=qty_item+0;
	 	 		}
			  	else
			  	{
			  		qty_item=qty_item+parseInt($(this).val());
			  	}
			});
			
	 	 	var subtract_qty=parseInt(static_qty-qty_item);
 	 		$('#total_quantity').val(subtract_qty);
 	 		
 	 		//Item Subtraction
 	 		$('#no_of_items').val($('#no_of_items_hidden').val());
 	 	}
 	 	else
 	 	{
 	 		alert('Enter Return Qty Greater Zero');
 	 		$('#remove_qty'+id).val('');
 	 		$('#price'+id).val(static_price);
 	 		$('#total_amount'+id).val(static_total_amount);
 	 		
 	 		$('#total_sub_total').val($('#total_sub_total_hidden').val());
 	 		$('#total_net_amount').val($('#total_net_amount_hidden').val());
 	 		$('#total_quantity').val($('#total_quantity_hidden').val());
 	 		
 	 	}
 	 }
	 else if(isNaN(qty_val) || static_product == qty_val)
 	 {
 	 	$('#price'+id).val(static_price);
 	 	$('#total_amount'+id).val(static_total_amount);
 	 	
 	 	
 	 	
 	 	var total_net_amount=0;
 	 	$(".total_amt_cal").each(function() 
 	 	{
 	 		if(isNaN($(this).val()) || $(this).val() == '' || $(this).val() == 'undefined' || $(this).val() == NaN || $(this).val() == 'NaN')
 	 		{
 	 			total_net_amount=total_net_amount+0;
 	 		}
		  	else
		  	{
		  		total_net_amount=total_net_amount+parseFloat($(this).val());
		  	}
		});
 	 	var Net_amount=Math.ceil(total_net_amount);
 	 	$('#total_sub_total').val(total_net_amount.toFixed(1));
 	 	$('#total_net_amount').val(Net_amount);
 	 	
 	 	var qty_item=0;
 	 	$(".qtyreturnstatus").each(function() 
 	 	{
 	 		if(isNaN($(this).val()) || $(this).val() == '' || $(this).val() == 'undefined' || $(this).val() == NaN || $(this).val() == 'NaN')
 	 		{
 	 			qty_item=qty_item+0;
 	 		}
		  	else
		  	{
		  		qty_item=qty_item+parseInt($(this).val());
		  	}
		  	
		});
		
		var subtract_qty=parseInt(static_qty-qty_item);
 	 	$('#total_quantity').val(subtract_qty);
 	 }
 	 
 }
 
 
 //New cODE
 
 function QtyValidation1(id,event)
 {
 	 var qty_val=parseInt($('#remove_qty'+id).val());
 	 var prevoius_qty=parseInt($('#quantity_add'+id).html());
 	 var tablet_price=$('#price'+id).val();
 	 var total_amount=$('#total_amount'+id).val();
 	 
 	 //Hidden Static Value
 	 var static_total_amount=$('#static_total_amount'+id).val();
 	 var static_price=$('#static_price'+id).val();
 	 var static_product=$('#static_product'+id).val();
 	 var static_qty=$('#total_quantity_hidden').val();
 	 //var static_items=$('#no_of_items_hidden').val();
 	
 	 
 	 if(static_product < qty_val)
 	 {
 	 	alert('Return Qty is Greater than Typed Qty');
 	 	$('#remove_qty'+id).val('');
 	 	$('#total_sub_total').val($('#total_sub_total_hidden').val());
 	 	$('#total_net_amount').val($('#total_net_amount_hidden').val());
 	 	$('#total_quantity').val($('#total_quantity_hidden').val());
 	 	
 	 }
 	 else if(static_product > qty_val || static_product == qty_val)
 	 {
 	 	
 	 	if(qty_val != 0)
 	 	{
 	 		var cgst=parseFloat($('#cgst_value'+id).val());
 	 		var sgst=parseFloat($('#sgst_value'+id).val());
 	 		var gst_amount=parseFloat(sgst+cgst);
 	 		var sub_total=static_price*qty_val;
 	 		var net_amt=sub_total+gst_amount;
 	 		
 	 		$('#no_of_items').val(1);
 	 		$('#total_quantity').val(qty_val);
 	 		$('#total_gst_amount').val(gst_amount.toFixed(2));
 	 		$('#total_sub_total').val(sub_total.toFixed(2));
 	 		
 	 		var amt_discount=parseFloat($('#disc_amount'+id).val());
 	 	
 	 		if(amt_discount != '')
 	 		{
 	 			var disc_net=net_amt-amt_discount;
 	 			//var calc=(qty_val*disc_net)/static_product;
 	 			$('#total_net_amount').val(disc_net.toFixed(2));
 	 		}
 	 		if(isNaN(amt_discount))
 	 		{
 	 			$('#total_net_amount').val(net_amt.toFixed(2));
 	 		}
 	 		
 	 		
 	 	}
 	 	else
 	 	{
 	 		alert('Enter Return Qty Greater Zero');
 	 		$('#remove_qty'+id).val('');
 	 		$('#price'+id).val(static_price);
 	 		$('#total_amount'+id).val(static_total_amount);
 	 		
 	 		$('#total_sub_total').val($('#total_sub_total_hidden').val());
 	 		$('#total_net_amount').val($('#total_net_amount_hidden').val());
 	 		$('#total_quantity').val($('#total_quantity_hidden').val());
 	 		
 	 	}
 	 }
	 else if(isNaN(qty_val))
 	 {
 	 	
 	 	
 	 	$('#no_of_items').val('');
 	 	$('#total_quantity').val('');
 	 	$('#total_gst_amount').val('');
 	 	$('#total_sub_total').val('');
 	 	$('#total_net_amount').val('');
 	 
 	 }
 	
 }
 
 
 
  function SingleReturnTablet()
 {
 	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=sales/returnsalessingletablet";?>",
        data: $("#saved_data_value_ajax").serialize(),
        success: function (result) 
        { 
        	if(result == 'Singletablet')
        	{
        		alert('Single Stock-Saved Successfully');
        		window.location.reload();
        	}
        }
    	});
 }
 
 
 
 function ReturnTablet()
 {
 	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=sales/returnsalestablet";?>",
        data: $("#saved_data_value_ajax").serialize(),
        success: function (result) 
        { 
        	if(result == 'Return')
        	{
        		alert('Stock Saved Successfully');
        		window.location.reload();
        	}
        }
    	});
 }
 
 
 function Patient_modal()
 {
 	$('#patient_common_search').val('');
 	$('#set_patient_data tr').remove();
 	$modal = $('#patient_hist-modal');
	$modal.modal('show');
 }
 
 function Patient_List_Show(e,event)
 {
 	
 	if(e.value != '' && event.keyCode === 13)
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
        	
        	$('#gender').html(obj[7]);
        	$('#address_patient').val(obj[8]);
        	
        	
        	
        	$('#patient_common_search').val('');
		 	$('#set_patient_data tr').remove();
		 	$modal = $('#patient_hist-modal');
			$modal.modal('hide');
        }
    	});
 	 }
 }
 
 
 //OverAll OverallPercentageDiscount
 function OverallPercentageDiscount()
 {
 	if($('#inPatient').is(":checked"))
    {
		var pat_name=$('#pat_name').val();
		var mrnumber=$('#mrnumber').val();
		var get_insurance=$('#pat_insurance').val();
		
		if(pat_name !== '' && mrnumber !== '')
		{
			if(get_insurance === "1" || get_insurance === "2" || get_insurance === "3")
			{
				$('#total_discountvaluetype').val('');
				Alertment('This is Organization Patient not allowed to Discount');
				return false;
			}
		}
		else
		{
			$('#mrnumber').focus();
			$('#total_discountvaluetype').val('');
			Alertment('Add Patient Name');
			return false;
		}
   	} 
    	if($('#fetch_update_data tr').length > 0)
	    {
	    	var disc_percentage=parseFloat($('#total_discountvaluetype').val());


	    	
	    	if(!isNaN(disc_percentage))
	    	{
	    		
	    		if(disc_percentage <= 100)
	    		{
	    			var net_amount=0;
	    		var disc_amount=0;
		    	$(".total_amt_cal").each(function() 
		 	 	{
		 	 		var data_id=$(this).attr('data_total');
		 	 		
		 	 		var total_amount=parseFloat($('#total_amount1'+data_id).val());
		 	 		var cal_individual=(total_amount*disc_percentage)/100;
		 	 		
		 	 		var tot_show=total_amount-cal_individual;
		 	 		
		 	 		//var disc_amt=parseFloat($('#disc_amount'+data_id).val());
		 	 		
		 	 		$('#enabledisc'+data_id).val(disc_percentage.toFixed(2));
		 	 		$('#disc_amount'+data_id).val(cal_individual.toFixed(2));
		 	 		$('#total_amount'+data_id).val(tot_show.toFixed(2));
		 	 		
		 	 		if(isNaN(tot_show))
		 	 		{
		 	 			net_amount=net_amount+0;	
		 	 		}
		 	 		else
		 	 		{
		 	 			net_amount=net_amount+tot_show;
		 	 		}
		 	 		
		 	 		if(isNaN(disc_amount))
		 	 		{
		 	 			disc_amount=disc_amount+0;
		 	 		}
		 	 		else
		 	 		{
		 	 			disc_amount=disc_amount+cal_individual;
		 	 		}
		 	 		
		 	 	});
		 	 	//alert(net_amount);
		 	 	var cash_amount=Math.round(net_amount);
		 	 	$('#cash_value').val(cash_amount);
		 	 	$('#paid_value').val(cash_amount);
		 	 	$('#due_value').val(0);
		 	 	$('#round_off_value').val(0);
		 	 	
		 	 	$('#total_net_amount').val(net_amount.toFixed(2));
		 	 	$('#total_discountamount').val(disc_amount.toFixed(2));
		 	 	
		 	 		
		 	 		
		 	 		var amt_in_words=convertNumberToWords(cash_amount);
		 	 		$('#amt_in_words').val(amt_in_words);
		 	 		
			 	 	if(cash_amount > net_amount)
			 	 	{
			 	 		var calc=cash_amount - net_amount;
			 	 		$('#round_off_value').val(calc.toFixed(2));
			 	 	}
			 	 	else if(net_amount > cash_amount)
			 	 	{
			 	 		var calc=net_amount - cash_amount;
			 	 		$('#round_off_value').val(calc.toFixed(2));
			 	 	}
	    		}
	    		else if(disc_percentage > 100)
	    		{
	    			var disc_percentage=100;
	    			var net_amount=0;
	    		var disc_amount=0;
		    	$(".total_amt_cal").each(function() 
		 	 	{
		 	 		var data_id=$(this).attr('data_total');
		 	 		
		 	 		var total_amount=parseFloat($('#total_amount1'+data_id).val());
		 	 		var cal_individual=(total_amount*disc_percentage)/100;
		 	 		
		 	 		var tot_show=total_amount-cal_individual;
		 	 		
		 	 		//var disc_amt=parseFloat($('#disc_amount'+data_id).val());
		 	 		
		 	 		$('#enabledisc'+data_id).val(disc_percentage.toFixed(2));
		 	 		$('#disc_amount'+data_id).val(cal_individual.toFixed(2));
		 	 		$('#total_amount'+data_id).val(tot_show.toFixed(2));
		 	 		
		 	 		if(isNaN(tot_show))
		 	 		{
		 	 			net_amount=net_amount+0;	
		 	 		}
		 	 		else
		 	 		{
		 	 			net_amount=net_amount+tot_show;
		 	 		}
		 	 		
		 	 		if(isNaN(disc_amount))
		 	 		{
		 	 			disc_amount=disc_amount+0;
		 	 		}
		 	 		else
		 	 		{
		 	 			disc_amount=disc_amount+cal_individual;
		 	 		}
		 	 		
		 	 	});
		 	 	
		 	 	$('#total_net_amount').val(net_amount.toFixed(2));
		 	 	$('#total_discountamount').val(disc_amount.toFixed(2));
		 	 	$('#total_discountvaluetype').val(100);
		 	 	
		 	 	
		 	 	var cash_amount=Math.round(net_amount);
		 	 	$('#cash_value').val(cash_amount);
		 	 	$('#paid_value').val(cash_amount);
		 	 	$('#due_value').val(0);
		 	 	
		 	 	var amt_in_words=convertNumberToWords(cash_amount);
	 	 		$('#amt_in_words').val(amt_in_words);
	 	 		
		 	 	if(cash_amount > net_amount)
		 	 	{
		 	 		var calc=cash_amount - net_amount;
		 	 		$('#round_off_value').val(calc.toFixed(2));
		 	 	}
		 	 	else if(net_amount > cash_amount)
		 	 	{
		 	 		var calc=net_amount - cash_amount;
		 	 		$('#round_off_value').val(calc.toFixed(2));
		 	 	}
		 	 	
		 	 	
	    		}
	    		
			}
			else if(isNaN(disc_percentage))
			{
				
				var net_amt=0;
				var disc_amount=0;
				$(".total_amt_cal").each(function() 
		 	 	{
		 	 		var data_id=$(this).attr('data_total');
		 	 		
		 	 		var total_amount=parseFloat($('#total_amount1'+data_id).val());
		 	 		//var cal_individual=(total_amount*disc_percentage)/100;
		 	 		
		 	 		$('#enabledisc'+data_id).val('');
		 	 		$('#disc_amount'+data_id).val('');
		 	 		$('#total_amount'+data_id).val(total_amount.toFixed(2));
		 	 		
		 	 		net_amt=net_amt+total_amount;
		 	 		var dis=parseFloat($('#disc_amount'+data_id).val());
		 	 		disc_amount=disc_amount+dis;
		 	 	});
		 	 	
		 	 	$('#total_net_amount').val(net_amt.toFixed(2));
		 	 	if(isNaN(disc_amount))
		 	 	{
		 	 		$('#total_discountamount').val('');	
		 	 	}
		 	 	
		 	 	
		 	 	
			}
      
      if(isNaN(disc_percentage))
      {
	      var distotalamount= $('#total_net_amount').val();
	      var discash_amount=Math.round(distotalamount);
	      var calc=discash_amount - distotalamount;
	      $('#round_off_value').val(calc.toFixed(2));  
	      $('#cash_value').val(discash_amount);
		 
		 //new vvvv
		  $('#paid_value').val(discash_amount);
		  	
	      var cash_amount=$('#cash_value').val();
		  var amt_in_words=convertNumberToWords(cash_amount);
	      $('#amt_in_words').val(amt_in_words);

        }
    	}
    	else
    	{
    		Alertment('No Product added in Grid');
    		$('#total_discountvaluetype').val('');
    	}
 }


 function OverallPercentageDiscountProcedure(disc_percent)
 {
  //alert(disc_percent);
  
      if($('#fetch_update_data tr').length > 0)
      {
        var disc_percentage=disc_percent;
        
        if(!isNaN(disc_percentage))
        {
          
          if(disc_percentage <= 100)
          {
            var net_amount=0;
          var disc_amount=0;
          $(".total_amt_cal").each(function() 
        {
          var data_id=$(this).attr('data_total');
          
          var total_amount=parseFloat($('#total_amount1'+data_id).val());
          var cal_individual=(total_amount*disc_percentage)/100;
          
          var tot_show=total_amount-cal_individual;

          //alert(data_id+"^"+($('#total_amount1'+data_id).val())+"--"+total_amount+"-"+cal_individual+"="+(total_amount-cal_individual));
          
          //var disc_amt=parseFloat($('#disc_amount'+data_id).val());
          $('#enabledisc'+data_id).val(disc_percentage.toFixed(2));
          $('#disc_amount'+data_id).val(cal_individual.toFixed(2));
          $('#total_amount'+data_id).val(tot_show.toFixed(2));
          
          if(isNaN(tot_show))
          {
            net_amount=net_amount+0;  
          }
          else
          {
            net_amount=net_amount+tot_show;
          }
          
          if(isNaN(disc_amount))
          {
            disc_amount=disc_amount+0;
          }
          else
          {
            disc_amount=disc_amount+cal_individual;
          }
          
        });
        //alert(net_amount);
        var cash_amount=Math.round(net_amount);
        $('#cash_value').val(cash_amount);
        
        $('#total_net_amount').val(net_amount.toFixed(2));
        $('#total_discountamount').val(disc_amount.toFixed(2));
        
          
          
          var amt_in_words=convertNumberToWords(cash_amount);
          $('#amt_in_words').val(amt_in_words);
          
          if(cash_amount > net_amount)
          {
            var calc=cash_amount - net_amount;
            $('#round_off_value').val(calc.toFixed(2));
          }
          else if(net_amount > cash_amount)
          {
            var calc=net_amount - cash_amount;
            $('#round_off_value').val(calc.toFixed(2));
          }
          }
          else if(disc_percentage > 100)
          {
            var disc_percentage=100;
            var net_amount=0;
          var disc_amount=0;
          $(".total_amt_cal").each(function() 
        {
          var data_id=$(this).attr('data_total');
          
          var total_amount=parseFloat($('#total_amount1'+data_id).val());
          var cal_individual=(total_amount*disc_percentage)/100;
          
          var tot_show=total_amount-cal_individual;
          
          //var disc_amt=parseFloat($('#disc_amount'+data_id).val());
          
          $('#enabledisc'+data_id).val(disc_percentage.toFixed(2));
          $('#disc_amount'+data_id).val(cal_individual.toFixed(2));
          $('#total_amount'+data_id).val(tot_show.toFixed(2));
          
          if(isNaN(tot_show))
          {
            net_amount=net_amount+0;  
          }
          else
          {
            net_amount=net_amount+tot_show;
          }
          
          if(isNaN(disc_amount))
          {
            disc_amount=disc_amount+0;
          }
          else
          {
            disc_amount=disc_amount+cal_individual;
          }
          
        });
        
        $('#total_net_amount').val(net_amount.toFixed(2));
        $('#total_discountamount').val(disc_amount.toFixed(2));
        $('#total_discountvaluetype').val(100);
        
        
        var cash_amount=Math.round(net_amount);
        $('#cash_value').val(cash_amount);
        
        var amt_in_words=convertNumberToWords(cash_amount);
        $('#amt_in_words').val(amt_in_words);
        
        if(cash_amount > net_amount)
        {
          var calc=cash_amount - net_amount;
          $('#round_off_value').val(calc.toFixed(2));
        }
        else if(net_amount > cash_amount)
        {
          var calc=net_amount - cash_amount;
          $('#round_off_value').val(calc.toFixed(2));
        }
        
        
          }
          
      }
      else if(isNaN(disc_percentage))
      {
        
        var net_amt=0;
        var disc_amount=0;
        $(".total_amt_cal").each(function() 
        {
          var data_id=$(this).attr('data_total');
          
          var total_amount=parseFloat($('#total_amount1'+data_id).val());
          //var cal_individual=(total_amount*disc_percentage)/100;
          
          $('#enabledisc'+data_id).val('');
          $('#disc_amount'+data_id).val('');
          $('#total_amount'+data_id).val(total_amount.toFixed(2));
          
          net_amt=net_amt+total_amount;
          var dis=parseFloat($('#disc_amount'+data_id).val());
          disc_amount=disc_amount+dis;
        });
        
        $('#total_net_amount').val(net_amt.toFixed(2));
        if(isNaN(disc_amount))
        {
          $('#total_discountamount').val(''); 
        }
        
        
        
      }
      }
      else
      {
        //alert('No Product added in Grid');
        Alertment('No Product added in Grid');
        $('#total_discountvaluetype').val('');
      }
  //  }
  /*  else
    {
      //alert('Select Discount Type');
      Alertment('Select Discount Type');
      $('#total_discountvaluetype').val('');
    }
    */
 }
 
 
 
 
 
 	 $(document).ready(function(){
	 $('.open-left').click(function(){		 
		 $('#globalserach').toggleClass('globalsearch');		 
	 });
	
	
 $("body").on('click', '.sale_his', function ()
    { 
    	 var from_date=$('.from_date').val();
		 var to_date=$('.to_date').val();
		 if(from_date != '' && to_date != '')
		 {
		 		$.ajax({	
				     type: "POST",
	 				url: "<?php echo Yii::$app->homeUrl . "?r=sales/saleshis&fromdate=";?>"+from_date+"&todate="+to_date,
				     success: function (result) 
				     {
				     	 var obj = $.parseJSON(result);
				     	  document.getElementById('sales_model_tbl').innerHTML=obj;
				          $modal = $('#sales_his_model');
	   					  $modal.modal('show');  	
				     }
				  });
		 }
		 else
		 {
		 	//alert('Check Date');
		 	Alertment('Check Date');
		 }
		 		
    	
    });
	
	
 });
 
 
 </script>


<script type="text/javascript">
   var onetimesave=1;
  
    $(function () {
        var crt_id = '<?php echo $_GET['data']; ?>';
   		if(crt_id != '')
   		{
   			
   			$.ajax({
						
				     type: "POST",
				     url: "<?php echo Yii::$app->homeUrl . "?r=sales/singletabletreturn&id=";?>"+crt_id,
				     success: function (result) 
				     {
				     	
				     	 if($('.get_temp_no').val() != '')
				     	 {
				     	 	$("#fetch_update_data tr").remove();  		
				     	 }
				     	
				     	$modal = $('#mr_hist-modal');
	   					$modal.modal('hide');
	   					 
				     	var obj = $.parseJSON(result);
				     
				     	  $("#fetch_update_data").append(obj[0]);  
				     
			
				          //Patient Details
				          $('#mrnumber').val(obj[16]);
				          $('#pat_name').val(obj[13]);
				          $('#pat_mob').val(obj[17]);
				          $('#pat_doctor').val(obj[15]);
				          $('#pat_insurance').html(obj[19]);
				          $('#pat_dob').val(obj[14]);
				          $('#gender').html(obj[20]);
				          $('#fetch_bill').html(obj[18]);	
				          $('#address_patient').val(obj[21]);	
				         
				          $('#return_tablet').val('singlereturn');
				         
				          $('#total_discountvaluetype').attr('readonly','readonly');
				     	  $('#total_discountamount').attr('readonly','readonly');
				     	  $('#overall_percent_type').attr('disabled','disabled');
				     	  $('#overall_discount_type_radio').attr('disabled','disabled');
				     	  
				     	  $('#medicines').attr('disabled','disabled');
				     	  $('[tabindex="5"]').focus();
				     }
				  });	
   		}
   		
   		
   		//Date Wise Model Showing Bill
   		 
        
        
      /*   $('#from_date').datetimepicker({
         
  			format: 'DD-MM-YYYY'
		});
        $('#to_date').datetimepicker({
        	
       		 useCurrent: false,
			 format: 'DD-MM-YYYY'
		});
		
		$("#from_date").on("dp.change", function (e) {
            $('#to_date').data("DateTimePicker").minDate(e.date);
        });
        
        $("#to_date").on("dp.change", function (e) {
            $('#from_date').data("DateTimePicker").maxDate(e.date);
        });
        
        */
        
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




function SaveBilling() 
{	
	//new code 17/11/2018
	var discount_percentage=$('#total_discountvaluetype').val();
	if(discount_percentage != '')
	{
		var remarks=$('#remarks').val();
		if(remarks === '')
		{
			Alertment('Remarks Required');
			return false;
		}
	}
	
		
	
	
   
 if ($("#outPatient").is(":checked"))
	{ 
		$out_pat_doc=$('#out_pat_doc').val();
		$out_pat_mob=$('#out_pat_mob').val();
		$out_patient_name=$('#out_patient_name').val();
		$new_mr_name=$('#new_mr_name').val();  
	if($out_patient_name === "")
	{
    	$('.out_pat_validated').delay('fast').fadeIn();
		$('.out_pat_validated').delay(4000).fadeOut();
		$('[tabindex="1"]').focus();

	    return false;
	}else if($out_pat_mob===""){

    $('.out_num_validated').delay('fast').fadeIn();
    $('.out_num_validated').delay(4000).fadeOut();
    $('[tabindex="1"]').focus(); 
  }
	else
	{
   
    if (confirm('Are You Sure to print Invoice ?')) {
    $("#saved_val").val(1);
  	
    if(onetimesave === 1)
   {
   	
    $('#load1').show();	
$.ajax({
  type: "POST",
	url: "<?php echo Yii::$app->homeUrl . "?r=sales/saveddata";?>",
	data: $("#saved_data_value_ajax").serialize(),
	success: function (result) 
	{ 
	
	var data1=result.split("=")[0];
	var data2=result.split("=")[1];
	
	if(data1=="Y")
	{
		if(data2=='OPTEMPSAVED')
		{
			alert('Data Saved');
			window.location.reload(true);
		}
		else
		{
      		$("#saved_val").val(data2);
			$(".save_billing").prop('disabled', true);
			onetimesave=2;
		 	var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
		 	window.open(url,'_blank');
			// window.location.reload(true);
		}	
	}
	
	$('#load1').hide();
	}
	    	});
  }
  else {
    return false;
}

}
	
    } 	
  }
	
	else if ($("#inPatient").is(":checked")) 
	{
		$mrnumber=$('#mrnumber').val();
	$pat_name=$('#pat_name').val();
	$pat_mob=$('#pat_mob').val();
	$pat_doctor=$('#pat_doctor').val();
	$pat_insurance=$('#pat_insurance').val();
	//$pat_dob=$('#pat_dob').val();
	if($mrnumber == '')
	{
		$('#mrnumber').focus();
		$('.in_pat_validated').delay('fast').fadeIn();
		$('.in_pat_validated').delay(4000).fadeOut();
	    
	    return false;
	}
	else
	{
		
		
  if (confirm('Are You Sure to print Invoice ?')) {
  	$("#saved_val").val(1);
  	
  	if(onetimesave === 1)
   {
	$('#load1').show();
	$.ajax({
	type: "POST",
	url: "<?php echo Yii::$app->homeUrl . "?r=sales/saveddata";?>",
	data: $("#saved_data_value_ajax").serialize(),
	success: function (result) 
	{ 
		$('#medicines').focus();
		var data1=result.split("=")[0];
		var data2=result.split("=")[1];
		var data3=result.split("=")[2];
		
	//alert(data2);
	if(data1=="Y")
	{
		if(data2=='OPTEMPSAVED')
		{	
			alert('Data Saved Succesfully');
			//window.location.reload(true);
			 $(".save_billing").prop('disabled', true);
			 $('.delrow').attr('disabled','disabled');
       		 $("#saved_val").val(data3);
			 $('#total_discountvaluetype').attr('disabled','disabled');
			 onetimesave=2;
			 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data3;
		 	 window.open(url,'_blank');
		}
		else
		{
			 $(".save_billing").prop('disabled', true);
			 $('.delrow').attr('disabled','disabled');
       		 $("#saved_val").val(data2);
			 $('#total_discountvaluetype').attr('disabled','disabled');
			 onetimesave=2;
			 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
		 	 window.open(url,'_blank');
			 // window.location.reload(true);
		}
						
	  }
	  
	  $('#load1').hide();
	  	
	  }
	    	});
  }
  else 
  {
  	alert('Already Saved')
  }
   }
		}
	}
	else if ($("#tempPatient").is(":checked")) 	
	{
		 
		
		var gh=$("#saved_data_value_ajax").serialize();
	if(gh != '')
	{
	
   if (confirm('Are You Sure to print Invoice ?')) {
   	$("#saved_val").val(1);
   	if(onetimesave === 1)
   {
   $('#load1').show();
		$.ajax({
	    type: "POST",
	url: "<?php echo Yii::$app->homeUrl . "?r=sales/saveddata";?>",
	data: gh,
	success: function (result) 
	{ 
		var data1=result.split("=")[0];
		var data2=result.split("=")[1];
		if(data1=="Y")
		{
		     $("#saved_val").val(data2);
		     $('#total_discountvaluetype').attr('disabled','disabled');
		     $('.delrow').attr('disabled','disabled');
			 $(".save_billing").prop('disabled', true);
			 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
			 window.open(url,'_blank');
		}
	    onetimesave=2;
	    $('#load1').hide();
	 }
	    	});	
     }
  else {
   return false;
}
}
		}
	}
}
			
				
					
				
		



$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            
            var  saved_val = $("#saved_val").val();
              if(saved_val===""){
            	SaveBilling();
            	//onetimesave=2;
            	
            }else{
            	alert("Already Saved");
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



function AutomaticRelation() 
{
	var id=$('#sur_name').val();
	if(id != '')
	{
		if(id == 'Mr' || id == 'Master')
		{
			$('#patient_gender').val('Male');
		}
		else if(id == 'Miss' || id == 'Baby' || id == 'Mrs' || id == 'Empty' || id == 'Baby Of' || id == 'Ms.')
		{
			 $('#patient_gender').val('Female');
		}
	}
}




function convertNumberToWords(amount) 
{
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
}
</script>

 <script type="text/javascript">
  $(document).ready(function(){
  	
  	$('#paid_value').val('0');
  	$('#due_value').val('0');
  	
	  
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");   			
	  $("ul.list-unstyled").css("display","none");
        
        


$('.datepicker').datepicker({format: 'dd-mm-yyyy'}).on('change', function(e) {
    var currentDate = new Date();
    var selectedDate = new Date($(this).val());
  // var age = currentDate.getFullYear() - selectedDate.getFullYear();
    var m = currentDate.getMonth() - selectedDate.getMonth();

   /* if (m < 0 || (m === 0 && currentDate.getDate() < selectedDate.getDate())) {
        age--;
    }*/
   var dat=$(this).val();
   var split_data=dat.split('-');
   var age = parseInt(currentDate.getFullYear() - split_data[2]);
  	$('#sales_pat_age').val(age);
 
});
	
	
	
	$('.save_billing').keydown(function(event) {
          if (event.keyCode == 13 || event.keyCode == 32) 
          {
             event.preventDefault();
             return false;
          }
        });
	
	
	default_date();

  });


	function Datecalculation(dateString) 
	{
		if(dateString !== '')
		{
			if(dateString <= 150)
			{
				var current_date = new Date();
				var Val_date=current_date;
	    		var dd = parseInt(Val_date.getUTCDate());
	        	var mm  = parseInt(Val_date.getUTCMonth()+1);
	        	var yy = parseInt(Val_date.getUTCFullYear());
	        	var age = parseInt(yy - dateString);	
	        	$('#sales_pat_dob').val(dd+'-'+mm+'-'+age);	
        	}
        	else if(dateString >= 150)
        	{
        		dateString=150;
        		var current_date = new Date();
				var Val_date=current_date;
	    		var dd = parseInt(Val_date.getUTCDate());
	        	var mm  = parseInt(Val_date.getUTCMonth()+1);
	        	var yy = parseInt(Val_date.getUTCFullYear());
	        	var age = parseInt(yy - dateString);	
	        	$('#sales_pat_dob').val(dd+'-'+mm+'-'+age);	
	        	$('#sales_pat_age').val(150);
        	}
        }
        else if(dateString === '')
        {
        	$('#sales_pat_dob').val('');	
        }	
	}



function Agecalculation(data_date) 
    {
    	
    	if(data_date != '')
    	{
    	   var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
           var Val_date=data_date;
           var data_type=true;
           var yy;
          if(Val_date.match(dateformat))
          {
              var seperator1 = Val_date.split('/');
              var seperator2 = Val_date.split('-');

              if (seperator1.length>1)
              {
                  var splitdate = Val_date.split('/');
              }
              else if (seperator2.length>1)
              {
                  var splitdate = Val_date.split('-');
              }
              var dd = parseInt(splitdate[0]);
              var mm  = parseInt(splitdate[1]);
              yy = parseInt(splitdate[2]);
              var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
              if (mm==1 || mm>2)
              {
                  if (dd>ListofDays[mm-1])
                  {
                      alert('Invalid date format!');
                      $('#newpatient-dob').val('');
                     // data_type=false;
                      return false;
                  }
              }
              if (mm==2)
              {
                  var lyear = false;
                  if ( (!(yy % 4) && yy % 100) || !(yy % 400))
                  {
                      lyear = true;
                  }
                  if ((lyear==false) && (dd>=29))
                  {
                      alert('Invalid date format!');
                      $('#newpatient-dob').val('');
                      return false;
                  }
                  if ((lyear==true) && (dd>29))
                  {
                      alert('Invalid date format!');
                      $('#newpatient-dob').val('');
                      return false;
                  }
              }
          }
          else
          {
              alert("Invalid date format!");
			  $('#newpatient-dob').val('');
              return false;
          }
    	}
    	
    	
    	if(data_type == true)
    	{
    		getAge(yy);
    	}
    }
    


function Patient_details(data,event)
{
	if(data === '')
	{
		$('#pat_name').val('');
		$('#pat_mob').val('');
		$('#pat_doctor').val('');
		$('#pat_insurance').val('');
		$('#pat_dob').val('');
		$('#gender').val('');
		$('#address_patient').val('');
	}
}

$(".mrnumber").typeahead({
	
	source: function(query,result) {
	  		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=lab-payment-prime/ajaxfetch";?>',
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
		var hidenmrnumber=$('#hidenmrnumber').val();
		if(hidenmrnumber !== result)
		{
		$('#load1').show();
		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=sales/ajaxsinglefetch1&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{   
	  			 	ClearBillField();
	  			 	
	  			 	
	  			 	if(data[1] !== null)
	  			 	{
	  			 		$('#pat_name').val(data[1]['patientname']);
	  					$('#pat_mob').val(data[1]['pat_mobileno']); 
	  					$('#pat_dob').val(formatDate(data[1]['dob']));
	  					$('#gender').val(data[1]['pat_sex']);
  						$('#address_patient').val(data[1]['pat_address']);
	  			 	}
	  				
	  				
	  				
	  				
	  				if(data[2] === null)
	  				{
	  					
	  						$('#pat_doctor').val('');
	  				}
	  				else
	  				{
	  					$('#pat_doctor').val(data[2]['physician_name']);
	  						
	  				}
	  			
           
            
	  				if(data[0] !== '' || data[0] !== null)
	  				{
	  					if(data[3] !== null)
	  					{
	  						$('#pat_insurance').html('<option value='+data[3]['insurance_typeid']+'>'+data[3]['insurance_type']+'</option>');
	  					}
	  					else if(data[3] === null)
	  					{
	  						$('#pat_insurance').html('');
	  					}
	  				}
	  				else
	  				{
	  					$('#pat_insurance').html('');
	  				}
	  				
	  				
	  				$('#hidenmrnumber').val(result)
	  				
	  				$('#medicines').focus();
	  				$('#load1').hide();
	  				
	  			}
	  	});
	  }
	}
});

function PaidAmountCalculated(data)
{
	var grid_length=$("#tbUser tbody tr").length;
	var get_insurance=$('#pat_insurance').val();
	var mrnumber=$('#mrnumber').val();
	var pat_name=$('#pat_name').val();
	var set_paidamount=data; 
	
	if ($("#inPatient").is(":checked"))
	{
		if(mrnumber !== '' && pat_name !== '')
		{
			if(get_insurance === "1" || get_insurance === "2" || get_insurance === "3")
			{
				$('#paid_value').val(0);
				Alertment('This is Organization Patient');
			}
			else
			{
				if(grid_length > 0)
				{
					PaidCalc(set_paidamount);
					
				}
				else
				{
					$('#paid_value').val(0);
					$('#medicines').focus();
					Alertment('Add Product in Grid');
				}
				
			}
		}
		else
		{
			ClearBillField();
			$('#mrnumber').focus();
			Alertment('Patient Details Required');
		}
	}
	else if($("#outPatient").is(":checked"))
	{
		PaidCalc(data)
	}
	else if($("#tempPatient").is(":checked"))
	{
		PaidCalc(data)
	}
	    var words =$('#paid_value').val();
       var net_amount_in_words=convertNumberToWords(Math.round(words));
       $('#amt_in_words').val(net_amount_in_words);
       var totamt=parseFloat($('#total_net_amount').val());
	var round_off_value=Math.round(totamt);
	$('#cash_value').val(round_off_value);
}


function PaidCalc(data)
{
	
	
	var total_amount=0;
	$(".total_amt_cal").each(function() 
 	{
 		var data_id=$(this).attr('data_total');
 		var hidden_amount=parseFloat($('#total_amount1'+data_id).val());
 		$('#enabledisc'+data_id).val('');
 		$('#disc_amount'+data_id).val('');
 		$('#total_amount'+data_id).val(hidden_amount);
 		
 		total_amount=total_amount+hidden_amount;
 	});
 

 	
 	$('#total_net_amount').val(total_amount.toFixed(2));
 	$('#total_discountvaluetype').val('');
	$('#total_discountamount').val('');
	
	//Round Off Value
	var round_off_value=Math.round(total_amount);
	//$('#cash_value').val(round_off_value);
	//$('#paid_value').val(round_off_value);
	
	
	if(round_off_value > total_amount)
	{
		var round_off_cal=round_off_value - total_amount;
		$('#round_off_value').val(round_off_cal.toFixed(2));
	}
	else if(round_off_value < total_amount)
	{
		var round_off_cal=total_amount - round_off_value;
		$('#round_off_value').val(round_off_cal.toFixed(2));
	}
	var datacal=0;
	if(round_off_value <= data)
	{
		datacal=round_off_value;
		var calculation=round_off_value - datacal;
		$('#due_value').val(calculation);
		//$('#cash_value').val(datacal);
		$('#paid_value').val(datacal);
		
	}
	else if(round_off_value > data)
	{
		datacal=parseFloat(data);
		var calculation=round_off_value - datacal;
		$('#due_value').val(calculation);
		//$('#cash_value').val(datacal);
		//$('#paid_value').val(datacal);
	}
	
	if(data === '')
	{
		$('#due_value').val(0);
		$('#cash_value').val(round_off_value);
		$('#paid_value').val(round_off_value);
	}
	
}
function cleartxt () {
  $('#no_of_items').val('');
  $('#total_quantity').val('');
  $('#total_sub_total').val('');
  $('#total_gst_amount').val('');
  $('#total_discountvaluetype').val('');
  $('#total_discountamount').val('');
  $('#total_net_amount').val('');
  $('#round_off_value').val('');
  $('#cash_value').val('');
  $('#amt_in_words').val('');
  $('#remarks').val('');
  $('#paid_amt').val('');
  $('#paid_value').val('');
  
  $('#due_amt').val('');
}
function clearhead(){
	
	
	$('#pat_name').val('');
	$('#pat_mob').val('');
	$('#pat_doctor').val('');
	$('#pat_insurance').html('');
	$('#pat_dob').val('');
	$('#gender').val('');
	$('#mrnumber').val('');
	$('#address_patient').val('');
	
	$('#out_patient_name').val('');
	$('#sales_pat_dob').val('');
	$('#sales_pat_age').val('');
	$('#out_pat_mob').val('');
	$('#out_patient_address').val('');
	
}
</script>

<script type="text/javascript">
   $(function () {
       $('.fromDate').datetimepicker({
    format: 'DD-MM-YYYY'
   });
       $('.toDate').datetimepicker({
           useCurrent: false, //Important! See issue #1075
           format: 'DD-MM-YYYY'
       });
	   $(".fromDate").on("dp.change", function (e) {
           $('.toDate').data("DateTimePicker").minDate(e.date);
       });
       $(".toDate").on("dp.change", function (e) {
           $('.fromDate').data("DateTimePicker").maxDate(e.date);
       });
 });
 
 
 function default_date()
 {
 	var dat=new Date();
 	var date=dat.getDate();
	var month=dat.getMonth()+1;
	var year=dat.getFullYear();
	
	$('.fromDate').val(date+'-'+month+'-'+year);
	$('.toDate').val(date+'-'+month+'-'+year);
 }
 
 function defaultdatevalidated(data)
 {
 	default_date();
 }
 
 $("body").on('click', '#bill_hist_btn', function ()
{
	var from_date=$('#fromDate').val();
    var to_date=$('#toDate').val();
  
	bill_history(from_date,to_date);
	$modal = $('#bill_history_model');
	$modal.modal('show');
});
 
function bill_history(from_date,to_date)
{
 
if($("#outPatient").is(":checked")) 
{
	var pat_type='O';
}
else if($("#inPatient").is(":checked"))
{
	var pat_type='I';
}
else if($("#tempPatient").is(":checked"))
{
	var pat_type='T';
}

 
   
if(from_date !== '' && to_date !== '')
{
    var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=sales/billhistory&fromdate='+from_date+'&todate='+to_date+'&pattype='+pat_type;
	//var ajax_url=url+'/index.php?r=sales/billhistory';
  	var table_reg= $('#bill_history').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
         "ajax": {
        	"url": ajax_url,
        	 "type": "POST"
        	},
        	keys: {
           		keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
        	},
        	"columns": [
            { "data": "billno","defaultContent": '<input type="text" value="0" />' },
            { "data": "mrnum","defaultContent": "NA" },
            { "data": "patname","defaultContent":"NA" },
            { "data": "invdate","defaultContent": '<input type="text" value="0" />'  },
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
	   $('#bill_history').on('key-focus.dt', function(e, datatable, cell){
	        // Select highlighted row
	      //  table_reg.row(cell.index().row).select();
	      //  $('#reg_table_filter input').val("");
	         $('#bill_history_filter input').focus();
	    });
	     $('#bill_history').on('key.dt', function(e, datatable, key, cell, originalEvent){
	        
	       
	        var table_as = $("#bill_history").DataTable();
	        if(key === 13){
	        	
	        	$('#bill_history thead').on( 'click', 'th', function () {
					  var columnData = table_as.column( this ).data();
	  				alert(columnData);
					} );
	    				
	            var data_reg = table_as.row(cell.index().row).data();
				// var cell = table_reg.cell( this );
			    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
	            // $("#example-console").html(data.join(', '));
	            // $('#reg_table_filter input').val("");
	          	 $('#bill_history_filter input').focus();
	        }
	    }); 
	    
		$('#bill_history').on( 'click', 'tr', function () {
		    var data = table_reg.row( this ).id();
		 	
		 	BillHistory(data);
		});
	
		$('#bill_history').on('key.dt', function(e, datatable, key, cell, originalEvent){
		     if(key === 13)
		     {
		        var data = table_reg.row(cell.index().row).id();
		        
		        BillHistory(data);
		     }
		});  
		$('#bill_history').DataTable().ajax.reload();
		setTimeout(function(){ 
	//var table_as = $("#bill_history").DataTable();
	table_reg.ajax.reload( function (json) {table_reg.cell( ':eq(0)' ).focus();} );}, 200);
	
	
	
}
}

function BillHistory(data_val)
{
	
	
if(data_val !== '')
{	
	 
	//alert(data_val);
	$.ajax({
	type: "POST",
  	url:'<?php echo Yii::$app->homeUrl . "?r=sales/billhistoryfetch&id=";?>'+data_val,
    success: function (result) 
    { 
    	 $("#fetch_update_data tr").remove(); 
		 clearhead();
		 cleartxt();
    	
    	 $modal = $('#bill_history_model');
		 $modal.modal('hide');
    	 
    	 $("#saved_val").val(1);
    	 
    	 
    	
    	 	
    	 var obj = $.parseJSON(result);
    	 
    	 $("#fetch_update_data").append(obj[0]);  
    	 
    	 $('#no_of_items').val(obj[1]);
    	 $('#total_quantity').val(obj[2]);
    	 $('#total_sub_total').val(obj[3]);
    	 $('#total_gst_amount').val(obj[4]);
    	 $('#total_discountvaluetype').val(obj[5]);
    	 $('#total_discountamount').val(obj[6]);
    	 $('#total_net_amount').val(obj[7]);
    	 $('#round_off_value').val(obj[8]);
    	 $('#cash_value').val(obj[9]);
    	 $('#paid_value').val(obj[10]);
    	 $('#due_value').val(obj[11]);
    	 
    	 $('#amt_in_words').val(obj[21]);
    	 $('#remarks').val(obj[22]);
    	 
    	 if($("#inPatient").is(":checked"))
    	 {
	    	 //Patient Name
	    	 $('#mrnumber').val(obj[12]);
	    	 $('#pat_name').val(obj[13]);
	    	 $('#pat_doctor').val(obj[14]);
	    	 $('#pat_dob').val(obj[15]);
	    	 $('#address_patient').val(obj[16]);
	    	 $('#pat_mob').val(obj[17]);
	    	 $('#pat_insurance').html('<option value='+obj[18]+'>'+obj[19]+'</option>');
	    	 $('#gender').val(obj[20]);
	      }
	      else if($("#outPatient").is(":checked"))
	      {
	      	 $('#out_patient_name').val(obj[13]);
	      	 //$('#sales_pat_dob').val(obj[15]);
	      	 $('#patient_gender').val(obj[20]);
	      	 $('#out_pat_mob').val(obj[17]);
	      	 $('#out_patient_address').val(obj[16]);
	      	 
	      }
    	 
    	 $('#medicines').attr('disabled','disabled');
    	 $('.save_billing').attr('disabled','disabled');
    }
	});
}
}
function Add_to_grid()
{
		
			var arr = [];
			var tbl_value = [];
			var validated = [];
			
			$('.required_qty').each(function ()
			{	
   				arr.push($(this).val());
   				tbl_value.push($(this).attr('data-id'));
   				
			});
			
			var prime_removal=$('#prime_id_conv').val();
			var prime_split=prime_removal.split(',');
			var iny=0;
			$('.save_data_table').each(function ()
			{	
   				$('#table_del'+prime_split[iny]).remove();
   				iny++;
			});
					
			var slnovalue='';
			var total_net_amount=0;
			var total_net_quantity=0;
			var no_of_items=0;
			var total_gst_amount=0;
			var sub_total=0;
			var disc_amount=0;
			
			
					 
			if($('.get_slno').val() == '')
			{
				var slno=1;
					
				for (var i=0; i < arr.length; i++)
				{
					 var product_type=$('#data_unit'+tbl_value[i]).val();
					 if(arr[i] != '' && tbl_value[i] != '')
					 {	
						if(product_type != '')
						{
							//validation
							$('#validated_field'+tbl_value[i]).hide();
							var batch_id=$('#batch_id'+tbl_value[i]).html();
						  	var manu_date_id=$('#manu_date_id'+tbl_value[i]).html();
						  	var expire_date_id=$('#expire_date_id'+tbl_value[i]).html();
						  		
						  	//unit calculation
						  	var mrp_id=parseFloat($('#mrp_id'+tbl_value[i]).html());
						  	var total_unit=parseInt($('#total_unit'+tbl_value[i]).val());
						  	//var price_per_quantity=total_unit*mrp_id.toFixed(1);
						  	var price_per_quantity=total_unit*mrp_id;
						  	
						  	var product_name=$('#prd_name'+tbl_value[i]).html();
						  	var batchnumber=$('#batchnumber'+tbl_value[i]).html();
						  		
						  	//Quanity variable
						  	//var total_qty=$('#total_qty'+tbl_value[i]).html();
						  	var quanity_id=parseInt($('#quanity_id'+tbl_value[i]).html());
						  	var required_id=parseInt($('#required_id'+tbl_value[i]).val());
						  		
						  	//var current_available_stock=quanity_id-required_id;
						  		
						  	var unit_value=$('#data-unit-name'+tbl_value[i]).val();
						  		
						  	var gst_sale_percent=$('#gst_sale_percent'+tbl_value[i]).html();
						  		
						  					
							var product_id=$('#product_id'+tbl_value[i]).val();
							var brandcode_id=$('#brandcode_id'+tbl_value[i]).val();
							var stockcode_id=$('#stockcode_id'+tbl_value[i]).val();
							var composition_id=$('#composition_id'+tbl_value[i]).val();
							var unit_id=$('#unit_id'+tbl_value[i]).val();
							var stock_id=$('#stock_id'+tbl_value[i]).val();
							var mrp_id=$('#mrp_id'+tbl_value[i]).html();
								 	
							var tablet_type=$('#data_unit'+tbl_value[i]).val();
							
							var data_no_of_unit_value=$('#data_no_of_unit'+tbl_value[i]).val();	
							
							
							//New Code 16/11/2018
							var original_mrp_price=$('#mrp_per_qty_hide'+tbl_value[i]).val();
										
							var markup = "<tr  class='save_data_table' data-id="+tbl_value[i]+" id='table_del"+tbl_value[i]+"'><td class='hide'>"+slno+"</td><td style='width:7%'><div class='trunctext '  style=' '  >"+product_name+"</div></td><td  style='width:6%';>"+batchnumber+"</td><td  style='width:8%';>"+expire_date_id+"</td><td style='width:5%'; class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td  style='width:7%'; id='unit_value_medicine"+tbl_value[i]+"'>"+unit_value+"</td><td style='width:8%';><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tbl_value[i]+"' value='"+unit_value+"'><input type='hidden' name='tablet_tot_unit_ins[]' id='tablet_tot_unit"+tbl_value[i]+"' value='"+total_unit+"'><input type='hidden' name='tablet_type[]' id='tablet_type"+tbl_value[i]+"' value='"+tablet_type+"'><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='mrp_per_unit_amount[]' value='"+original_mrp_price+"'><input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='hidden' name='price[]' class='price_mrp text-right disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+price_per_quantity+" id="+'price'+tbl_value[i]+"><input type='text' readonly name='showmrp[]' class='showmrp text-right disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+original_mrp_price+" id="+'show_mrp'+tbl_value[i]+"></td>"
						  								//+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"'  disabled='disabled' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>F</label></li><li>"
						  								//+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+"  disabled='disabled' class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'> <input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"'  class='enabledisc disctxt w-55' readonly></div></td><td><div class='input-group'> <input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount text-right disctxt w-55' readonly>"
						  								+"</div></td><td class='w-xss hide'><input type='hidden' class='form-control w-50' data_gst_percent='"+tbl_value[i]+"' name='gst_percent[]' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td class='hide'><input type='text'  class='form-control w-50' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='cgst_percent disctxt w-55 text-right' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class=' cgst_value disctxt w-53 text-right' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='sgst_percent  disctxt w-55' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class=' w-53 disctxt sgst_value text-right' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='w-53 disctxt total_amt_cal text-right' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly><input type='hidden'  class='form-control reduired_qty_hidden text-right' name='reduired_qty_hidden[]' data_total='"+tbl_value[i]+"' value="+required_id+" id='reduired_qty_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control price_hidden text-right' name='price_hidden[]' data_total='"+tbl_value[i]+"' id='price_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_percentage_hidden text-right' name='cgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_value_hidden text-right' name='cgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_percentage_hidden text-right' name='sgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_value_hidden text-right' name='sgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control total_amt_cal1 text-right' name='total_amt_cal1[]' data_total='"+tbl_value[i]+"' id='total_amount1"+tbl_value[i]+"'></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																																					
																													
														
						 if($("#fetch_update_data").append(markup))
		               	{
		               		var disc_percentage=parseFloat($('#total_discountvaluetype').val());
			                if(disc_percentage!='')
			                {
				                 setTimeout(function () {                 
				                 OverallPercentageDiscountProcedure(disc_percentage);
				               },200);
			                } 
		               	}	
						  	
						  	 
						  	 if(isNaN($('#price'+tbl_value[i]).val()))
   							 {
   								$('#price'+tbl_value[i]).val(0);
   								
   								//$('#price_hidden'+tbl_value[i]).val(0);
   							 }
						  	 else
						  	 {
						  		$('#price'+tbl_value[i]).val();
						  		//$('#price_hidden'+tbl_value[i]).val();
						  	 }
						  		
						  	 if(gst_sale_percent == 0)
						  	 {
						  		$('#cgst_percent'+tbl_value[i]).val(0);
						  		$('#cgst_value'+tbl_value[i]).val(0);
						  		$('#sgst_percent'+tbl_value[i]).val(0);
						  		$('#sgst_value'+tbl_value[i]).val(0);
						  		$('#igst_percent'+tbl_value[i]).val(0);
						  		$('#igst_value'+tbl_value[i]).val(0);
						  			
						  		var price=parseFloat($('#price'+tbl_value[i]).val());
						  		//var priceceil=Math.ceil(price);
						  		//Total
						  		$('#total_amount'+tbl_value[i]).val(price.toFixed(2));
						  		
						  		//Hidden Value Set	
						  		$('#total_amount1'+tbl_value[i]).val(price.toFixed(2));
						  		$('#price_hidden'+tbl_value[i]).val(price.toFixed(2));
						  		$('#cgst_percentage_hidden'+tbl_value[i]).val(0);
						  		$('#cgst_value_hidden'+tbl_value[i]).val(0);
						  		$('#sgst_percentage_hidden'+tbl_value[i]).val(0);
						  		$('#sgst_value_hidden'+tbl_value[i]).val(0);
						  			
						  	 }
						  	 else
						  	 {
						  		var gst_divide=gst_sale_percent/2;
						  		
						  		if(isNaN(gst_divide))
   							 	{
   									gst_divide=0;
   							 	}
						  		
						  		var total_amount=parseFloat($('#price'+tbl_value[i]).val());
						  		
						  		if(isNaN(total_amount))
   							 	{
   									total_amount=0;
   							 	}
						  			
						  		var cgst_value=total_amount*gst_divide;
						  		
						  		if(isNaN(cgst_value))
   							 	{
   									cgst_value=0;
   							 	}
						  		
						  		var cgst_amt=cgst_value/100;
						  		
						  		if(isNaN(cgst_amt))
   							 	{
   									cgst_amt=0;
   							 	}
						  		
						  		var cgst_amount=parseFloat(cgst_amt);
						  		
						  		if(isNaN(cgst_amount))
   							 	{
   									cgst_amount=0;
   							 	}
						  			
						  		var sgst_value=total_amount*gst_divide;
						  		
						  		if(isNaN(sgst_value))
   							 	{
   									sgst_value=0;
   							 	}
						  		
						  		var sgst_amt=sgst_value/100;
						  		
						  		if(isNaN(sgst_amt))
   							 	{
   									sgst_amt=0;
   							 	}
						  		
						  		var sgst_amount=parseFloat(sgst_amt);
						  			
						  		if(isNaN(sgst_amount))
   							 	{
   									sgst_amount=0;
   							 	}	
						  			var total=total_amount+cgst_amount+sgst_amount;
						  			var totfloat=parseFloat(total);
						  		if(isNaN(total))
   							 	{
   									total=0;
   							 	}	
						  		
						  			$('#cgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#cgst_value'+tbl_value[i]).val(cgst_amount.toFixed(2));
						  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#sgst_value'+tbl_value[i]).val(sgst_amount.toFixed(2));
						  			$('#igst_percent'+tbl_value[i]).val(0);
						  			$('#igst_value'+tbl_value[i]).val(0);
						  			//Total
						  			$('#total_amount'+tbl_value[i]).val(totfloat.toFixed(2));
						  			
						  			
						  			
						  			//Hidden Value Set	
							  		$('#total_amount1'+tbl_value[i]).val(totfloat.toFixed(2));
							  		$('#price_hidden'+tbl_value[i]).val(total_amount.toFixed(2));
							  		$('#cgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
							  		$('#cgst_value_hidden'+tbl_value[i]).val(cgst_amount.toFixed(2));
							  		$('#sgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
							  		$('#sgst_value_hidden'+tbl_value[i]).val(sgst_amount.toFixed(2));
						  			
						  		}
						  		
						  		slno++;
						  		slnovalue=slno;	
						  }
							else
							{
								$('#validated_field'+tbl_value[i]).show();
								$("#fetch_update_data tr").remove();
								$modal = $('#myModal');
								$modal.modal('show'); 
								return false;
							}	
							
					  	}
					  	
					}
					
								$('.get_slno').val(slnovalue);
					 			$modal = $('#myModal');
								$modal.modal('hide'); 
									
					}
					else
					{
								 var slno=parseInt($('.get_slno').val());
								 //exist total quanity
								 var value=parseFloat($('#total_net_amount').val());
								 var total_quantity_exist=parseInt($('#total_quantity').val());
								 var no_of_items1=parseInt($('#no_of_items').val());
								 var total_gst_amount1=parseFloat($('#total_gst_amount').val());
								 var sub_total1=parseFloat($('#total_sub_total').val());
								 var disc_amount1=parseFloat($('#total_discountvalue').val())
					 
									for (var i=0; i < arr.length; i++)
									{
										
										var product_type=$('#data_unit'+tbl_value[i]).val();
										
									  	if(arr[i] != '' && tbl_value[i] != '')
									  	{
									  		if(product_type != '')
											{
													
												$("#table_del"+tbl_value[i]).remove();									
											  	var batch_id=$('#batch_id'+tbl_value[i]).html();
											  	var manu_date_id=$('#manu_date_id'+tbl_value[i]).html();
											  	var expire_date_id=$('#expire_date_id'+tbl_value[i]).html();
											  		
											  	//unit calculation
											  	var mrp_id=parseFloat($('#mrp_id'+tbl_value[i]).html());
											  	var total_unit=parseInt($('#total_unit'+tbl_value[i]).val());
											  	//var price_per_quantity=total_unit*mrp_id.toFixed(1);
											  	var price_per_quantity=total_unit*mrp_id;
											  	
											  	var product_name=$('#prd_name'+tbl_value[i]).html();
											  	var batchnumber=$('#batchnumber'+tbl_value[i]).html();
											  		
											  	//Quanity variable
											  	//var total_qty=$('#total_qty'+tbl_value[i]).html();
											  	var quanity_id=parseInt($('#quanity_id'+tbl_value[i]).html());
											  	var required_id=parseInt($('#required_id'+tbl_value[i]).val());
											  	var unit_value=$('#data-unit-name'+tbl_value[i]).val();
											  
											  	var gst_sale_percent=$('#gst_sale_percent'+tbl_value[i]).html();
											  	var product_id=$('#product_id'+tbl_value[i]).val();
											  	var brandcode_id=$('#brandcode_id'+tbl_value[i]).val();
												var stockcode_id=$('#stockcode_id'+tbl_value[i]).val();
												var composition_id=$('#composition_id'+tbl_value[i]).val();
												var unit_id=$('#unit_id'+tbl_value[i]).val();
												var stock_id=$('#stock_id'+tbl_value[i]).val();
												var mrp_id=$('#mrp_id'+tbl_value[i]).html();
												 	
												var tablet_type=$('#data_unit'+tbl_value[i]).val();	
												
												var data_no_of_unit_value=$('#data_no_of_unit'+tbl_value[i]).val();	
												//alert(data_no_of_unit_value);
												
												//New Code 16/11/2018
												var original_mrp_price=$('#mrp_per_qty_hide'+tbl_value[i]).val();
												
												
												var markup = "<tr  class='save_data_table' data-id="+tbl_value[i]+" id='table_del"+tbl_value[i]+"'><td class='hide'>"+slno+"</td><td style='width:7%'><div class='trunctext  '>"+product_name+"</div></td><td style='width:6%';>"+batchnumber+"</td><td style='width:8%';>"+expire_date_id+"</td><td style='width:5%'; class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td style='width:7%'; id='unit_value_medicine"+tbl_value[i]+"'>"+unit_value+"</td><td style='width:8%';><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tbl_value[i]+"' value='"+unit_value+"'><input type='hidden' name='tablet_tot_unit_ins[]' id='tablet_tot_unit"+tbl_value[i]+"' value='"+total_unit+"'><input type='hidden' name='tablet_type[]' id='tablet_type"+tbl_value[i]+"' value='"+tablet_type+"'><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='mrp_per_unit_amount[]' value='"+original_mrp_price+"'><input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='hidden' name='price[]' class='price_mrp text-right  disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+price_per_quantity+" id="+'price'+tbl_value[i]+"><input type='text' readonly name='showmrp[]' class='showmrp text-right disctxt w-53' data_price_mrp="+tbl_value[i]+" value="+original_mrp_price+" id="+'show_mrp'+tbl_value[i]+"></td>"
						  								//+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"'  disabled='disabled' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>F</label></li><li>"
						  								//+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+"  disabled='disabled' class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'> <input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"'  class='enabledisc disctxt w-55' readonly></div></td><td><div class='input-group'> <input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount text-right disctxt w-55' readonly>"
						  								+"</div></td><td class='w-xss hide'><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' name='gst_percent[]' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td class='hide'><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='form-control cgst_percent text-right' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='w-53 cgst_value text-right' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class=''><input type='text'  class='form-control sgst_percent' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='w-53 sgst_value text-right' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control total_amt_cal text-right' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly><input type='hidden'  class='form-control reduired_qty_hidden text-right' name='reduired_qty_hidden[]' data_total='"+tbl_value[i]+"' value="+required_id+" id='reduired_qty_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control price_hidden text-right' name='price_hidden[]' data_total='"+tbl_value[i]+"' id='price_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_percentage_hidden text-right' name='cgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control cgst_value_hidden text-right' name='cgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='cgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_percentage_hidden text-right' name='sgst_percentage_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_percentage_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control sgst_value_hidden text-right' name='sgst_value_hidden[]' data_total='"+tbl_value[i]+"' id='sgst_value_hidden"+tbl_value[i]+"'><input type='hidden'  class='form-control total_amt_cal1 text-right' name='total_amt_cal1[]' data_total='"+tbl_value[i]+"' id='total_amount1"+tbl_value[i]+"'></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																																					
																			
					
                
                  //	 $("#fetch_update_data").append(markup);


                /* var disc_percentage=parseFloat($('#total_discountvaluetype').val());

                if(disc_percentage!=''){
                 OverallPercentageDiscountProcedure(disc_percentage);
                } */
               	if($("#fetch_update_data").append(markup))
               	{
               		var disc_percentage=parseFloat($('#total_discountvaluetype').val());
	                if(disc_percentage!='')
	                {
		                 setTimeout(function () {                 
		                 OverallPercentageDiscountProcedure(disc_percentage);
		               },200);
	                } 
               	}						
                 
													
											    if(isNaN($('#price'+tbl_value[i]).val()))
				   							 	{
				   									$('#price'+tbl_value[i]).val(0);
				   							 	}
										  		else
										  		{
										  			$('#price'+tbl_value[i]).val();
										  		}
										  		
										  		if(gst_sale_percent == 0)
										  		{
										  			$('#cgst_percent'+tbl_value[i]).val(0);
										  			$('#cgst_value'+tbl_value[i]).val(0);
										  			$('#sgst_percent'+tbl_value[i]).val(0);
										  			$('#sgst_value'+tbl_value[i]).val(0);
										  			$('#igst_percent'+tbl_value[i]).val(0);
										  			$('#igst_value'+tbl_value[i]).val(0);
										  			
										  			var price=parseFloat($('#price'+tbl_value[i]).val());
										  			//var priceceil=Math.ceil(price);
										  			//Total Price
										  			if(isNaN(price))
   							 						{
   													 	price=0;
   							 						}
										  			
										  			$('#total_amount'+tbl_value[i]).val(price.toFixed(2));
										  			
										  			//Hidden Value Set	
											  		$('#total_amount1'+tbl_value[i]).val(price.toFixed(2));
											  		$('#price_hidden'+tbl_value[i]).val(price.toFixed(2));
											  		$('#cgst_percentage_hidden'+tbl_value[i]).val(0);
											  		$('#cgst_value_hidden'+tbl_value[i]).val(0);
											  		$('#sgst_percentage_hidden'+tbl_value[i]).val(0);
											  		$('#sgst_value_hidden'+tbl_value[i]).val(0);
										  			
										  			
										  		}
										  		else
										  		{
										  			var gst_divide=gst_sale_percent/2;
										  			if(isNaN(gst_divide))
   							 						{
   													 	gst_divide=0;
   							 						}
										  			var total_amount=parseFloat($('#price'+tbl_value[i]).val());
										  			if(isNaN(total_amount))
   							 						{
   													 	total_amount=0;
   							 						}
										  			var cgst_value=total_amount*gst_divide;
										  			if(isNaN(cgst_value))
   							 						{
   													 	cgst_value=0;
   							 						}
										  			var cgst_amt=cgst_value/100;
										  			if(isNaN(cgst_amt))
   							 						{
   													 	cgst_amt=0;
   							 						}
										  			var cgst_amount=parseFloat(cgst_amt);
										  			if(isNaN(cgst_amount))
   							 						{
   													 	cgst_amount=0;
   							 						}
										  			var sgst_value=total_amount*gst_divide;
										  			if(isNaN(sgst_value))
   							 						{
   													 	sgst_value=0;
   							 						}
										  			var sgst_amt=sgst_value/100;
										  			if(isNaN(sgst_amt))
   							 						{
   													 	sgst_amt=0;
   							 						}
										  			var sgst_amount=parseFloat(sgst_amt);
										  			if(isNaN(sgst_amount))
   							 						{
   													 	sgst_amount=0;
   							 						}
										  			var total=total_amount+cgst_amount+sgst_amount;
										  			var totalceil=parseFloat(total);
										  			if(isNaN(total))
   							 						{
   													 	total=0;
   							 						}
										  		
										  			$('#cgst_percent'+tbl_value[i]).val(gst_divide);
										  			$('#cgst_value'+tbl_value[i]).val(cgst_amount.toFixed(2));
										  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
										  			$('#sgst_value'+tbl_value[i]).val(sgst_amount.toFixed(2));
										  			$('#igst_percent'+tbl_value[i]).val(0);
										  			$('#igst_value'+tbl_value[i]).val(0);
										  			//Total Price
										  			$('#total_amount'+tbl_value[i]).val(totalceil.toFixed(2));
										  			
										  			//Hidden Value Set	
											  		$('#total_amount1'+tbl_value[i]).val(totalceil.toFixed(2));
											  		$('#price_hidden'+tbl_value[i]).val(total_amount.toFixed(2));
											  		$('#cgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
											  		$('#cgst_value_hidden'+tbl_value[i]).val(cgst_amount.toFixed(2));
											  		$('#sgst_percentage_hidden'+tbl_value[i]).val(gst_divide);
											  		$('#sgst_value_hidden'+tbl_value[i]).val(sgst_amount.toFixed(2));
										  			
										  			
										  		}
											  		slno++;
											  		slnovalue=slno;
											  	
									  		}
											if(product_type == '')
											{
													$('#validated_field'+tbl_value[i]).show();
													$modal = $('#myModal');
													$modal.modal('show'); 
													return false;
											}	
											
											
									  	}
									} // For Loop End
		
									$('.get_slno').val(slnovalue);
									 $modal = $('#myModal');
									$modal.modal('hide'); 
									
									
					}
						
						var inc=0;
						var total_amount=0;
						var total_amount_final=0;
						var total_quantity=0;
						var total_quantity_final=0;
						var total_gst_amount=0;
						var total_gst_amount_final=0;
						var disc_amount=0;
						var disc_amount_final=0;
						var total_net_amount=0;
						var total_net_amount_final=0;
						var hidden_net_amount=0;
						$('.save_data_table').each(function ()
						{	
							var data_id=$(this).attr('data-id');
							total_amount=parseFloat($('#price'+data_id).val());
							total_quantity=parseInt($('#quantity_add'+data_id).html());
							var sgst=parseFloat($('#sgst_value'+data_id).val());
							var cgst=parseFloat($('#cgst_value'+data_id).val());
							disc_amount=parseFloat($('#disc_amount'+data_id).val());
							total_net_amount=parseFloat($('#total_amount'+data_id).val());
							
							var hidden_net_amount_var=parseFloat($('#total_amount1'+data_id).val());
							
							if(isNaN(hidden_net_amount_var))
							{
								hidden_net_amount_var=0;
							}
							
							
							if(isNaN(sgst))
   							{
   								sgst=0;
   							}
   							if(isNaN(cgst))
   							{
   								cgst=0;
   							}
   							
							total_gst_amount=cgst+sgst;
							
							if(isNaN(total_amount))
   							{
   								total_amount=0;
   							}
   							if(isNaN(total_quantity))
   							{
   								total_quantity=0;
   							}
   							if(isNaN(total_quantity))
   							{
   								total_quantity=0;
   							}
   							if(isNaN(disc_amount))
   							{
   								disc_amount=0;
   							}
   							if(isNaN(total_net_amount))
   							{
   								total_net_amount=0;
   							}
							total_amount_final+=total_amount;
							total_quantity_final+=total_quantity;
							total_gst_amount_final+=total_gst_amount;
							
							disc_amount_final+=disc_amount;
							total_net_amount_final+=total_net_amount;
							inc++;	
							
							hidden_net_amount=hidden_net_amount_var+hidden_net_amount;			
						});
						
						$('#no_of_items').val(inc);
						$('#total_sub_total').val(total_amount_final.toFixed(2));
						$('#total_quantity').val(total_quantity_final);
						$('#total_gst_amount').val(total_gst_amount_final.toFixed(2));
						$('#total_discountvalue').val(disc_amount_final.toFixed(2));
						$('#total_roundedvalue').val(total_net_amount_final.toFixed(2));
						
						$('#total_net_amount').val(total_net_amount_final.toFixed(2));
						
						//new code 20/11/2018
						$('#total_amount_mrp').val(hidden_net_amount.toFixed(2));
						
						
						//Amount In Words
						var net_amount_in_words=convertNumberToWords(Math.round(total_net_amount_final));
						$('#amt_in_words').val(net_amount_in_words);
						
						//cash value
						$('#cash_value').val(Math.round(total_net_amount_final));
						
						//Round Off Value
						var round_off_value=Math.round(total_net_amount_final);
						if(round_off_value > total_net_amount_final)
						{
							var round_off_cal=round_off_value - total_net_amount_final;
							$('#round_off_value').val(round_off_cal.toFixed(2));
						}
						else if(round_off_value < total_net_amount_final)
						{
							var round_off_cal=total_net_amount_final - round_off_value;
							$('#round_off_value').val(round_off_cal.toFixed(2));
						}
					
						var get_insurancevalue=$('#pat_insurance').val();
						 if(get_insurancevalue === "1" || get_insurancevalue === "2" || get_insurancevalue === "3")
						 {
						 	
						 		$('#due_value').val(Math.round(total_net_amount_final));
      							$('#paid_value').val('0');	
      					 }
      					 else
      					 {
      							$('#due_value').val('0');
      							$('#paid_value').val(Math.round(total_net_amount_final));
      					 }
      							
						
				
						
						
						
						$('#fetch_update_data').scrollTop(200);
						
						$('#medicines').val('');
						$('#medicines').focus();
						
						//PaidAmountCalculation();
			
				}
</script>
