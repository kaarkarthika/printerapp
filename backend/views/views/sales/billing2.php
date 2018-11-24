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
   
  use yii\jui\AutoComplete;
use yii\web\JsExpression;
   
   $this->title = 'Modules';
    $session = Yii::$app->session;
	$insurance=Insurance::find()->where(['is_active'=>1])->asArray()->all();
								
  // print_r(Yii::$app->homeUrl);die;
   ?>
<!--<link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<script src="plugins/select2/select2.min.js" type="text/javascript"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
  <!--script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->
  
  
  
  
  <!-- Bootstrap files -->


<!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script-->



  <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
  
   <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>
  
  
  
  
 
<link href="<?php echo Url::base(); ?>/css/billing.css" rel="stylesheet" type="text/css" />
<style>
table.table.table-bordered.table-striped > tbody > tr.exp:nth-of-type(odd) {
   /* background-color: #e01c1c !important; */
   background-color:#f4f4cf !important;
}
</style>
<script type="text/javascript">
   function date_time(id)
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
   
   
</script>
<?php $form = ActiveForm::begin(['id' => 'saved_data_value_ajax']); ?> 
<div class="container">
   <div class="row">
   
      <div class="col-sm-12">
	  <span> <strong id='fetch_bill'><?php echo $billformat; ?></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 
       <div class="radio radio-info radio-inline">
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
		<div class="radio radio-info radio-inline">  
			<button type="button" class="btn btn-default refresh" style="padding: 3px 16px;margin-bottom: 6px;font-size: 12px;" data-toggle="tooltip" title="Refresh" class="btn btn-success" tooltip='Refresh' name="refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button>
			<i><strong><small>[Alt+r]</small><strong></i>
			</div>                                        
	  <strong><span class="pull-right" id="date_time"></span></strong>
         <div class="panel panel-border panel-custom">
          
            <div class="panel-body">
               <div class="row">
     				 
					 <div class="col-sm-12   "  style="position: relative;top:10px;" >
					  <div class="outpatientblock  desc" hidden >
					  <div class="row">
					  <div class="col-sm-1"  ></div>
					  
					  <div class="form-group col-sm-2"  >
                         	<?= $form->field($patient, 'mr_no',['enableAjaxValidation' => true])->textInput(['id'=>'new_mr_name' ,'maxlength' => true ,'class' => 'form-control text-cap fwidth key outrefrsh', 'placeholder'=>'MR Number','tabindex'=>"1"])->label(false) ?>
                           <!--input type="text" placeholder="MR Number"  class="form-control text-cap fwidth key outrefrsh" id='new_mr_name' tabindex="1"-->
                       		 <span class='out_mr_validated' hidden style="color:red">MR Details Not Found</span>
                        </div>
					  
					  <div class="form-group col-sm-2"  >
                         
                           <input type="text" placeholder="Patient Name" name='patient_name' class="form-control text-cap fwidth key outrefrsh" id='out_patient_name' tabindex="2">
                       		 <span class='out_pat_validated' hidden style="color:red">Enter Patient Details</span>
                        </div>
                        <div class="form-group col-sm-2">
                         
                           <input type="text" name='mobile_number' id='out_pat_mob' class="form-control fwidth key number outrefrsh phone" placeholder="Mobile Number" onkeypress="phoneno()" maxlength="10" tabindex="3" >
                        </div>
						
						<div class="form-group col-sm-2">
                       
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
                        </div>
                        
                        <div class="form-group col-sm-2"  >
                         
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
                        </div>
                        
                        </div>
                        </div>
						
					 </div>
					 
                     <div class="col-sm-12"     >
					    <div class="inpatientblock  desc"  style="position: relative;top: 9px;" > 
						<div class="row">
						<div class="col-sm-3">
						 <div class="form-group col-sm-8  " >
						
                           <div class="input-group add-on fwidth" >
                           		<input class="form-control mrn inrefrsh" placeholder="MRN Search" name="mr_number"   id="mrnumber" type="text" tabindex="8">
								
								<div class="ipt input-group-btn fetch_record">
									<span class="btn btn-default inpatient-details"  ><i class="glyphicon glyphicon-search"></i></span>
								</div>
								
							</div>
								<span id='mr_validated' style="color:red" hidden>Invalid MR Number</span>
							 <span class='in_pat_validated' style="color:red" hidden>Enter Patient Record</span>
                        </div>
						
						<div class="form-group col-sm-4" style="position: relative;
    z-index: 1;">
						    <button class="btn btn-default btn-sm">Details</button>
						
						</div>
						</div>
						
						<div class="col-sm-9">
						 <div class="form-group col-sm-3"  >
                     
                           <input type="text" placeholder="Patient Name" class="form-control text-cap fwidth mrn inrefrsh" name='in_patient' id="pat_name" readonly>
                          
                                 
                        </div>
						 <div class="form-group col-sm-2">
                       
                           <input type="text" placeholder="Mobile Number" class="form-control fwidth mrn number phone inrefrsh" name='in_patient_mobile'   onkeypress="phoneno()"  id="pat_mob" readonly>
                        </div>
						<div class="form-group col-sm-3">
                        
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
						
                        <div class=" form-group col-sm-2" >
                        
                            
                           <select placeholder="Insurance Type" class="form-control fwidth key mrn inrefrsh text-cap" name='insurance_type' id="pat_insurance" readonly>
                             
                           </select>
                        </div>
                        <div class="form-group col-sm-2" >
                        
                           <input type="text" placeholder="Date of Birth" class="form-control fwidth key mrn inrefrsh" name='date_of_birth' id="pat_dob" readonly>
                        </div>
                        </div>
						
						
						
						</div>
						</br>
					
                        </div>
                     </div>
               					            
               </br>
               <div class="row">
                  <div class="panel panel-border panel-custom" style="">
                     <div class="panel-body">
					    <div class=" row" style="position: relative;left: 155px; ">
                        <div class=" form-group  col-sm-9" style="background-color: #ebeff2;padding-top: 10px;padding-bottom:10px; ">
						  <div class="">
						 
						  	<?php
						  	
							  $productlist=Product::find()->where(['is_active'=>1])->asArray()->all();							
								foreach ($productlist as $key => $value)
								{
									$productlist_col_val[] = array('value' => $value['productname'],'value1' => $value['productid']);
								}
								$productlist_col_json = json_encode($productlist_col_val);	
								//print_r($productlist_col_json);die;
								
							?>
							    
							
							  
							   <input type="text" class="typehead text-cap form-control input-lg fwidth  medienter inrefrsh" placeholder="Enter prescription" tabindex="7" id="medicines">
							  	
							   <input type="hidden" class="form-control" id='name'>      
								 <h5 class="text-center stock_no" hidden><span style="color:red">Stock not Available</span></h5>
								
                        </div>
                        </div>
						 <div class="col-sm-1 altp-label"><label id="shortcut"><i><strong class="f-10">[Alt+p]</strong></i></label></div> 
						 <div class="  col-sm-1" style="position:relative;top:10px;">
						     <button type="button" id="temp_med_fetch" data-toggle="tooltip" title="Temporary Sale" class="btn btn-success" tooltip='Temp Sale'><i class="fa fa-shopping-cart" ></i></button> <i><strong class="f-10">[Alt+t]</strong></i> 
						 </div>
						 </div>
                      
                     </div>
                   
                  </div>
               </div>

    
               <div class="row">
                  <div class="col-sm-12">
<table class="table table-bordered table-striped" id="tbUser">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center hide">#</th>
                              <th rowspan="2" class="text-center">Stock / Drug</th>
                              <th rowspan="2" class="text-center">Batch</th>
                              <th rowspan="2" width="7%"; class="text-center">Exp Date</th>
                              <th rowspan="2" class="text-center">Qty</th>
                              <th rowspan="2" class="text-center">Unit<br>Form</th>
                              <th rowspan="2" width="5%" class="text-center">Price</th>
                              <th rowspan="2" width="5%" class="text-center">Discount Type</th>
                              <th colspan="2" class="text-center"  >Discount</th>
                              <th colspan="2" class="text-center">IGST</th>
                              <th colspan="2" class="text-center">CGST</th>
                              <th colspan="2" class="text-center">SGST</th>
                              <th rowspan="2" class="text-center">Total</th>
                              <th rowspan="2" class="text-center">Remove</th>
                           </tr>
                           <tr>
                               <th class="text-center">Val</th>
                              <th width="5%" class="text-center">Amt</th>
                              <th class="text-center">%</th>
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
               </div>
			   
			   
			   
			   
			   
			   
			    <input type='hidden' class='get_slno'>
			    <input type='hidden' name='get_temp_no' class='get_temp_no'>
			   <div class=" ">
                  <div class="panel panel-border panel-custom total-area"  >
                     <div class="panel-body">
                        <div class="row">
						
						
                           <div class="t-10  col-sm-8">
                              <div class="row">
							     
								 <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  > Items: </label>
										<input type="text" class="form-control total_items ansrefrsh" name='total_items' readonly id="no_of_items">
									</div>
								 </div>
							  
							    <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  > Qty: </label>
										<input type="text" class="form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
									</div>
								 </div>
                                
								  <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  >  GST: </label>
										<input type="text" class="form-control total_vat ansrefrsh" name='total_gst' readonly id="total_gst_amount">
									</div>
								 </div>
								 
                               
							  
							   <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  >Dis %: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh" name='total_disc_original'   id="total_discountvalue">
									</div>
								 </div>
								 
								 <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  >Flat %: </label>
										<input type="text" class="form-control  " name=' '   id=" ">
									</div>
								 </div>
								 
								 	<div class="form-group col-sm-2 hide">
									<div class="input-group  ">
										<label class="input-group-addon"  >Dis Amt: </label>
										<input type="text" style="width: 50px;" class="form-control   total_sub_total ansrefrsh" name=' ' readonly id=" ">
									</div>
								 </div>
							  
							  
							  
								 <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  >Sub.Tot</label>
										<input type="text" style="width: 90px;"   class="form-control total_sub_total ansrefrsh" name='total_sub_total' readonly id="total_sub_total">
									</div>
								 </div>
							  
                                </div>
                           </div>
                           <div class="t-10  col-sm-4">
						   
                           
							  <div class=" col-sm-1"></div>
							  <div class="form-group col-sm-7">
									<div class="input-group  ">
										<label class="input-group-addon bg-primary" style="color:#fff;" >Net Amount : </label>
										<input type="text" class="form-control total-netamt ansrefrsh bg-primary" name='total_net_amount' style="color: #fff;font-size: 14pt;" readonly id="total_net_amount">
									</div>
								 </div>
							  
							  
							  
                              <div class="form-group col-sm-2">
                                 
                                 <button type="button" value='save_bill' name='saved_bill' class="btn btn-default btn-sm fwidth save_billing" data-toggle="tooltip" title="Save and Submit"><i class="fa fa-save"></i></button>
                                 <i><strong><small>[Alt+s]</small><strong></i>
                              </div>
                              <div class="form-group col-sm-2">
                               
                                 <button type='reset' class="btn btn-warning btn-sm fwidth remove_all" data-toggle="tooltip" title="Cancel"><i class="fa fa-close"></i> </button>
                                 <i><strong><small>[Alt+z]</small><strong></i>
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
                           		<input class="  form-control  number"  style="width:80px;"  placeholder="Req Qty" name=" "   id="fetch_batch_qty" type="text" tabindex=" ">
								
								<div class="input-group-btn  ">
									<span class="btn btn-default  "  ><i class=" ssearch glyphicon glyphicon-search"></i></span>
								</div>								
							</div>								 
                        </div>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="form-group ">
				<button type="button" class="btn btn-primary btn-sm fetch_data" tabindex="105" data-toggle="tooltip" title="Add to Grid"><i class="fa fa-save"></i></button>&nbsp;<i><small>[Alt+7]</small></i> &nbsp;&nbsp;
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
         <!--div class="modal-footer" style="border-top:1px solid #ccc;">
		 <button type="button" class="btn btn-primary  fetch_data" tabindex="105">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            
         </div>
         
         <div class="row"  >
           <span class="col-sm-offset-10" style="position: relative;left: 55px;"> <i>[Alt+7]<i></span> 
             <span style="position: relative;left: 85px;"> <i>[Esc]<i></span>   
         </div-->
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
			   
		      <button type="button" class="btn btn-primary refresh_model" tabindex="105">Refresh</button>
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
         <!--div class="modal-footer" style="border-top:1px solid #ccc;">
			<div class="col-sm-offset-4 form-group col-sm-4  " >
						    
                           <div class="input-group add-on fwidth" >
								<input class="form-control  " placeholder="Bill Number" name=" "   id="billtxtbox" type="text" tabindex=" ">
								<div class="ipt input-group-btn  ">
									<span class="btn btn-default inpatient-details"  ><i class="glyphicon glyphicon-search"></i></span>
								</div>
							</div>
                        </div>
		  <span><i><small>[Esc]</small></i></span>&nbsp;
		 <button type="button" class="btn btn-primary  temp_fetch_data hide" tabindex="105">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
			
         </div-->
         
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
</div
<!--Inner modal -->

  <?php ActiveForm::end(); ?>
    
    
    
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

 <script type="text/javascript">
  $(document).ready(function(){
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");   			
    //  $(".list-unstyled > li").removeClass("active1 active");
        $(".list-unstyled").css("display","none");
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
					$('#temp_med_fetch').prop('disabled', false);
					 $("#tbUser tbody tr").remove(); 
                   $(".outpatientblock").show();
   				$('[tabindex="1"]').focus();
   				$(".inpatientblock").hide();  
   				
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
		
	
			$('.stock_no').hide();
		
   			$('body').on("click",'.fetch_record',function(e)
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
				            	
				            	var obj = $.parseJSON(result);
				            	
				           		$('#pat_name').val(obj[0]);
				           		$('#pat_mob').val(obj[1]);
				           		$('#pat_doctor').val(obj[2]);
				           		if(obj[3] != '01-01-1970')
							    {
							      $('#pat_dob').val(obj[3]);
							    }
				           		document.getElementById('pat_insurance').innerHTML=obj[4];
				           		
				            }
				        });
				}
					
			});
			
			$('#mr_validated').hide();
			//Enter Key Fetch Record
			$('#mrnumber').keyup(function(e)
   			{
					if(e.keyCode == 13)
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
											//alert(obj[3]);
							           		if(obj[3] != '01-01-1970')
							           		{
							           			$('#pat_dob').val(obj[3]);
							           		}
							           		
							           		document.getElementById('pat_insurance').innerHTML=obj[4];
						            	}
						            	
						            }
						        });
						}
					}
		 	});	
		 			
   		$('#medicines').keyup(function(e)
   		{
				if(e.keyCode == 13)
				{
					
					var product_id=$('#name').val();
   					//var encodeproduct_id=encodeURIComponent(product_id);
   					if(product_id != '')
					{
						$.ajax({
						
				            type: "POST",
				           // data: $("#saved_data_value_ajax").serialize(),
          					//dataType: "json",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/medicinefetch&product_id=";?>"+product_id+"&tablet="+''+"&tablet_qty="+''+"&tablet_type="+'',
				            success: function (result) 
				            { 
				            	
				            	 var obj = $.parseJSON(result);
				            	 if(obj == 'NULL' || obj == '')
				            	 {
				            	 	
				            	 	$('.stock_no').delay('fast').fadeIn();
						            $('.stock_no').delay(1000).fadeOut();
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
		 });	
		 
		
   			$('body').on("keyup",'.required_qty',function(e)
   			{
   				var available_id=$(this).attr('data-id');
   				var available_value=parseInt($('#quanity_id'+available_id).html());
   				var required_value=parseInt($(this).val());
   				var keycode = (e.keyCode ? e.keyCode : e.which);
   				
   				if(required_value > available_value)
   				{
   					alert("You enter more than Availability");
   					$(this).val("");
   					return false;
   				}
   			});
   			
   			
   			$('body').on("blur",'.required_qty',function(e)
   			{
   				var available_id=$(this).attr('data-id');
   				var available_value=parseInt($('#quanity_id'+available_id).html());
   				var required_value=parseInt($('#required_id'+available_id).val());
   				
   				var product_qty=$('#data_unit'+available_id).val();
   				var keycode = (e.keyCode ? e.keyCode : e.which);
   				
   						if(keycode == '0')
   						{
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
				            		alert("Total Units is greater than Availability");
				            		$('#total_unit'+available_id).val('');
				            		$('#required_id'+available_id).val('');
				            		$('#data_unit'+available_id).val('');
				            		$('#validated_field'+available_id).hide();
				            			
				            	}
				            	else
				            	{
				            		$('#total_unit'+available_id).val(total_unit);
				            		if($('#total_unit'+available_id).val() == 'NaN')
				            		{
				            			$('#total_unit'+available_id).val('');
				            		}
				            		
				            	}
				            	
				            }
				        });	
   						}
   			});
   			
   			
   			
   			$('body').on("keypress",'.tabenter_acc',function(e)
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
   				
   			});	
   		
   			

	}); 
	
		//auto start
			
			
	
                  var availableTags = <?= $productlist_col_json; ?>;

          $(".typehead").typeahead({

        minLength: 1,
        delay: 100,
  source: availableTags,
  autoSelect: true,
 displayText: function(item)
 {
 	//$("#medicines").val(item.value);
    
     //return false;
 	 return item.value;
 	
 },
  afterSelect: function(item) {
  	$("#name").val(item.value1);
  }
	  
});

</script>
<script>


$(document).ready(function(){
	$('#myModal').on('shown.bs.modal', function ()
{
	//alert("iop");
    $('.focus_first').focus();
    $('#fetch_batch_qty').focus();
})
  
});

$(document).ready(function(){
	$('#temp_fetch_model').on('shown.bs.modal', function ()
{
	//alert("iop");
    $('#billtxtbox').focus();
})
  
});
	 

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
	 $('#temp_med_fetch').prop('disabled', false);
$(".outpatientblock").show();
$(".inpatientblock").hide();
  $('[tabindex="1"]').focus();
  
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

	shortcut.add("Alt+7",
   function() {
    	$( ".fetch_data" ).trigger( "click" );
   },
    
   { 'type':'keydown', 'propagate':true, 'target':document}
   );


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

	
	 shortcut.add("Alt+s",
   function (){
    	 
		if ($("#outPatient").is(":checked"))
					{
						$out_pat_doc=$('#out_pat_doc').val();
						$out_pat_mob=$('#out_pat_mob').val();
						$out_patient_name=$('#out_patient_name').val();
						$new_mr_name=$('#new_mr_name').val();
						if($new_mr_name == '' || $out_pat_doc == '')
						{
							$('.out_pat_validated').delay('fast').fadeIn();
						    $('.out_pat_validated').delay(4000).fadeOut();
						    $('[tabindex="1"]').focus();
						    return false;
						}
						else
						{
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
	    								$(".save_billing").prop('disabled', true);
	    								 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
	    								 window.open(url,'_blank');
	    								 window.location.reload(true);
	    							}	
				            	}
				            }
				        	});
						};	 	
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
				    		$('.in_pat_validated').delay('fast').fadeIn();
						    $('.in_pat_validated').delay(4000).fadeOut();
						    return false;
				    	}
				    	else
				    	{
				    		$.ajax({
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/saveddata";?>",
				            data: $("#saved_data_value_ajax").serialize(),
				            success: function (result) 
				            { 
				            	
				            	var data1=result.split("=")[0];
        						var data2=result.split("=")[1];
        						//alert(data2);
        						if(data1=="Y")
	    						{
	    							if(data2=='OPTEMPSAVED')
	    							{
	    								alert('Data Saved');
	    								window.location.reload(true);
	    							}
	    							else
	    							{
	    								 $(".save_billing").prop('disabled', true);
	    								 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
	    								 
	    								 window.open(url,'_blank');
	    								 window.location.reload(true);
	    							}
	    								
				            	}
				            }
				        	});
				    	}
              		}
              		else if ($("#tempPatient").is(":checked")) 	
				    {
						 
						
				    	var gh=$("#saved_data_value_ajax").serialize();
				    	if(gh != '')
				    	{
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
	    							 //$(".save_billing").prop('disabled', true);
	    							 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
	    								 window.open(url,'_blank');
	    								 window.location.reload(true);
				            	}
				            }
				        	});	
				    	}
              		}
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
			$('#total_gst_amount').val(delete_total_gst_amount);
			
			//Total Amount variable apply subtotal,rounded value,net amount
			var total_amount=parseFloat($('#price'+unique_id).val());
			var total_sub_total=parseFloat($('#total_sub_total').val());
			var delete_total_sub_total=total_sub_total-total_amount;
			$('#total_sub_total').val(delete_total_sub_total);
			
			
			
			var total_net_amount=parseInt($('#total_net_amount').val());
			var total_value_amount=parseInt($('#total_amount'+unique_id).val());
			
			var delete_total_net_amount=total_net_amount-total_value_amount;
			$('#total_net_amount').val(delete_total_net_amount);
			
			//Discount value
			var discount_amount=$('#disc_amount'+unique_id).val();
			var discount_total=$('#total_discountvalue').val();
			if(isNaN(discount_amount))
			{
				discount_amount=0;
			}
			var subdiscount=discount_total-discount_amount;
			$('#total_discountvalue').val(subdiscount);
			
			
    		$(this).closest('tr').remove();
    		
    		if($('#fetch_update_data tr').length == 0)
    		{
    			$('#total_sub_total').val(0);
    			$('#total_net_amount').val(0);
    			$('#total_gst_amount').val(0);
    			$('#no_of_items').val(0);
    			$('#total_quantity').val(0);
    			$('#total_discountvalue').val(0);
    		}
    		
		});
	});
	
	</script>
	
	
	
	<script>
   $(document).ready(function(){
   jQuery.fn.tabEnter = function() {
this.keypress(function(e){
// get key pressed (charCode from Mozilla/Firefox and Opera / keyCode in IE)
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;

if(key == 13) {
// get tabindex from which element keypressed

var ntabindex = parseInt($(this).attr("tabindex")) + 1;

$("[tabindex=" + ntabindex + "]").focus();

return false;
}
});
}
$("[tabindex]").tabEnter();
  }); 
   </script>
	
	
	
	<script>
	

	
	
$(document).ready(function(){
	
	$('.out_mr_validated').hide();		
	$('.out_pat_validated').hide();
	$('.in_pat_validated').hide();
			

			
	$("body").on('click', '.fetch_data', function () 
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
						  	var mrp_id=parseInt($('#mrp_id'+tbl_value[i]).html());
						  	var total_unit=parseInt($('#total_unit'+tbl_value[i]).val());
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
												//alert(data_no_of_unit_value);
												
							
								var markup = "<tr  class='save_data_table' data-id="+tbl_value[i]+" id='table_del"+tbl_value[i]+"'><td class='hide'>"+slno+"</td><td><div class='trunctext wd100'>"+product_name+"</div></td><td>"+batchnumber+"</td><td>"+expire_date_id+"</td><td class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td id='unit_value_medicine"+tbl_value[i]+"'>"+unit_value+"</td><td><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tbl_value[i]+"' value='"+unit_value+"'><input type='hidden' name='tablet_tot_unit_ins[]' id='tablet_tot_unit"+tbl_value[i]+"' value='"+total_unit+"'><input type='hidden' name='tablet_type[]' id='tablet_type"+tbl_value[i]+"' value='"+tablet_type+"'><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='text' name='price[]' class='price_mrp text-right form-control' data_price_mrp="+tbl_value[i]+" value="+price_per_quantity+" id="+'price'+tbl_value[i]+"></td>"
						  								+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>F</label></li><li>"
						  								+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+" class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'> <input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"' class='enabledisc disctxt w-50' readonly></div></td><td><div class='input-group'> <input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount text-right disctxt w-50' readonly>"
						  								+"</div></td><td class='w-xss'><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' name='gst_percent[]' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='w-xss'><input type='text'  class='form-control cgst_percent text-right' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control cgst_value text-right' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='w-xss'><input type='text'  class='form-control sgst_percent' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control sgst_value text-right' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control total_amt_cal text-right' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																																					
																													
														
						  	 $("#fetch_update_data").append(markup);
						  	
						  	 
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
						  		//Total
						  		$('#total_amount'+tbl_value[i]).val(price.toFixed(2));
						  			
						  			
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
						  			$('#cgst_value'+tbl_value[i]).val(cgst_amount);
						  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#sgst_value'+tbl_value[i]).val(sgst_amount);
						  			$('#igst_percent'+tbl_value[i]).val(0);
						  			$('#igst_value'+tbl_value[i]).val(0);
						  			//Total
						  			$('#total_amount'+tbl_value[i]).val(totfloat.toFixed(2));
						  			
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
								 var value=parseInt($('#total_net_amount').val());
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
											  	var mrp_id=parseInt($('#mrp_id'+tbl_value[i]).html());
											  	var total_unit=parseInt($('#total_unit'+tbl_value[i]).val());
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
												
												
												var markup = "<tr  class='save_data_table' data-id="+tbl_value[i]+" id='table_del"+tbl_value[i]+"'><td class='hide'>"+slno+"</td><td><div class='trunctext wd100'>"+product_name+"</div></td><td>"+batchnumber+"</td><td>"+expire_date_id+"</td><td class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td id='unit_value_medicine"+tbl_value[i]+"'>"+unit_value+"</td><td><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tbl_value[i]+"' value='"+unit_value+"'><input type='hidden' name='tablet_tot_unit_ins[]' id='tablet_tot_unit"+tbl_value[i]+"' value='"+total_unit+"'><input type='hidden' name='tablet_type[]' id='tablet_type"+tbl_value[i]+"' value='"+tablet_type+"'><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='text' name='price[]' class='price_mrp text-right form-control' data_price_mrp="+tbl_value[i]+" value="+price_per_quantity+" id="+'price'+tbl_value[i]+"></td>"
						  								+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>F</label></li><li>"
						  								+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+" class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'> <input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"' class='enabledisc disctxt w-50' readonly></div></td><td><div class='input-group'> <input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount text-right disctxt w-50' readonly>"
						  								+"</div></td><td class='w-xss'><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' name='gst_percent[]' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='w-xss'><input type='text'  class='form-control cgst_percent text-right' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control cgst_value text-right' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='w-xss'><input type='text'  class='form-control sgst_percent' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control sgst_value text-right' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control total_amt_cal text-right' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																						
												$("#fetch_update_data").append(markup); 
													
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
										  			$('#cgst_value'+tbl_value[i]).val(cgst_amount);
										  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
										  			$('#sgst_value'+tbl_value[i]).val(sgst_amount);
										  			$('#igst_percent'+tbl_value[i]).val(0);
										  			$('#igst_value'+tbl_value[i]).val(0);
										  			//Total Price
										  			$('#total_amount'+tbl_value[i]).val(totalceil.toFixed(2));
										  			
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
						
						$('.save_data_table').each(function ()
						{	
							var data_id=$(this).attr('data-id');
							total_amount=parseFloat($('#price'+data_id).val());
							total_quantity=parseInt($('#quantity_add'+data_id).html());
							var sgst=parseFloat($('#sgst_value'+data_id).val());
							var cgst=parseFloat($('#cgst_value'+data_id).val());
							disc_amount=parseFloat($('#disc_amount'+data_id).val());
							total_net_amount=parseFloat($('#total_amount'+data_id).val());
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
							//Math.ceil(total_gst_amount_final);
							disc_amount_final+=disc_amount;
							total_net_amount_final+=total_net_amount
							inc++;				
						});
						
						$('#no_of_items').val(inc);
						$('#total_sub_total').val(total_amount_final);
						$('#total_quantity').val(total_quantity_final);
						$('#total_gst_amount').val(total_gst_amount_final);
						$('#total_discountvalue').val(disc_amount_final);
						$('#total_roundedvalue').val(total_net_amount_final.toFixed(2));
						
						$('#total_net_amount').val(Math.ceil(total_net_amount_final));
									
						$('.medienter').val('');
						$('.medienter').focus();
				});	
			
			
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
				            		alert("Total Units is greater than Availability");
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
			
			
			
			
			
			
			$("body").on('click', '.save_billing', function () 
			{
				
					if ($("#outPatient").is(":checked"))
					{
						$out_pat_doc=$('#out_pat_doc').val();
						$out_pat_mob=$('#out_pat_mob').val();
						$out_patient_name=$('#out_patient_name').val();
						
						if($out_pat_doc == '' && $out_pat_mob == '' && $out_patient_name == '')
						{
							$('.out_pat_validated').delay('fast').fadeIn();
						    $('.out_pat_validated').delay(4000).fadeOut();
						    $('[tabindex="1"]').focus();
						    return false;
						}
						else
						{
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
	    								$(".save_billing").prop('disabled', true);
	    								 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
	    								 window.open(url,'_blank');
	    								 window.location.reload(true);
	    							}	
				            	}
				            }
				        	});
						};	 	
				    }
					else if ($("#inPatient").is(":checked")) 
				    {
				    	$mrnumber=$('#mrnumber').val();
				    	$pat_name=$('#pat_name').val();
				    	$pat_mob=$('#pat_mob').val();
				    	$pat_doctor=$('#pat_doctor').val();
				    	$pat_insurance=$('#pat_insurance').val();
				    	$pat_dob=$('#pat_dob').val();
				    	if($mrnumber == '' || $pat_name == '' || $pat_mob == '' || $pat_doctor == '' || $pat_insurance == '' || $pat_dob == '')
				    	{
				    		$('.in_pat_validated').delay('fast').fadeIn();
						    $('.in_pat_validated').delay(4000).fadeOut();
						    return false;
				    	}
				    	else
				    	{
				    		$.ajax({
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/saveddata";?>",
				            data: $("#saved_data_value_ajax").serialize(),
				            success: function (result) 
				            { 
				            	
				            	var data1=result.split("=")[0];
        						var data2=result.split("=")[1];
        						//alert(data2);
        						if(data1=="Y")
	    						{
	    							if(data2=='OPTEMPSAVED')
	    							{
	    								alert('Data Saved');
	    								window.location.reload(true);
	    							}
	    							else
	    							{
	    								 $(".save_billing").prop('disabled', true);
	    								 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
	    								 
	    								 window.open(url,'_blank');
	    								 window.location.reload(true);
	    							}
	    								
				            	}
				            }
				        	});
				    	}
              		}
              		else if ($("#tempPatient").is(":checked")) 	
				    {
						 
						
				    	var gh=$("#saved_data_value_ajax").serialize();
				    	if(gh != '')
				    	{
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
	    							 //$(".save_billing").prop('disabled', true);
	    							 var url='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id='+data2;
	    								 window.open(url,'_blank');
	    								 window.location.reload(true);
				            	}
				            }
				        	});	
				    	}
              		}
				
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
          //	alert("Percent");
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
          	//alert("Flat");
          	
          	$('#disc_amount'+datavalueid).val(0);
          	$("#enabledisc"+datavalueid).val();
          	$("#enabledisc"+datavalueid).prop('readonly',false);
   	    	$('#enabledisc'+datavalueid).focus();
   	    	
   	    	/*$('#cgst_percent'+datavalueid).val(0);
          	$('#cgst_value'+datavalueid).val(0);
          	$('#sgst_percent'+datavalueid).val(0);
          	$('#sgst_value'+datavalueid).val(0);
          	$('#igst_percent'+datavalueid).val(0);
          	$('#igst_value'+datavalueid).val(0);
          	*/
          	//$('#total_amount'+datavalueid).val(0);
          	$('#disc_method'+datavalueid).val('Flat');
          } 
              
      } 
      
    
	</script>
	
	<script>

$(document).ready(function(){
    $("input:radio:checked").data("chk",true);
   // $("input:radio").click(function(){
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
				     	 
				     	 if($('.get_temp_no').val() != '')
				     	 {
				     	 	$("#fetch_update_data tr").remove();  		
				     	 }
				     	
				     	$modal = $('#temp_fetch_model');
	   					$modal.modal('hide'); 
				     	  var obj = $.parseJSON(result);
				     	  
				     	  $("#no_of_items").val(obj[2]);
				          $("#total_quantity").val(obj[1]);
				          $("#total_gst_amount").val(obj[3]);
				          $("#total_sub_total").val(obj[5]);
				          $("#total_roundedvalue").val(obj[6]);
				          $("#total_discountvalue").val(obj[4]);
				          
				          var rounded=Math.ceil(obj[7]);
				          $("#total_net_amount").val(rounded);
				          $('.get_slno').val(obj[8]);
				     	  $('.get_temp_no').val(obj[9]); 
				     	  $("#fetch_update_data").append(obj[0]);  
				          $('[tabindex="5"]').focus();
				     }
				  });
   			}
   			
   			
   
   });
   
   	$("body").on('click', '.remove_all', function ()
    {
    	$("#fetch_update_data tr").remove();
    	$(".get_slno").val('');
    	$(".get_temp_no").val('');
    	window.location.reload(true);
    });
   	
   	
   	$("body").on('click', '.refresh', function ()
    {
    	window.location.reload(true);
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
    
    $("body").on('keyup', '.price_mrp', function ()
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
    
    $("body").on('keyup', '#fetch_batch_qty', function (e)
    {
    		var fetch_batch_qty=parseInt($('#fetch_batch_qty').val());
    		var stk=parseInt($('#stk').val());
    		var keycode = (e.keyCode ? e.keyCode : e.which);
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
					  	var Qty=$('#quanity_id'+strtoarray[i]).html();
					  	
					  	
					  	if($('#quanity_id'+strtoarray[0]).html() >= fetch_batch_qty)
					  	{
					  		$('#required_id'+strtoarray[0]).val(fetch_batch_qty);
					  		var data_unit=$('#data_unit'+strtoarray[i]).val();
					  		var uui=strtoarray[0];
					  		Getunitquantity(data_unit,uui);	
					  		break;
					  	}
					  	else
					  	{
					  		$('#required_id'+strtoarray[i]).val(Qty);
					  		ty=ty+parseInt($('#required_id'+strtoarray[i]).val());
					  		
					  		var data_unit=$('#data_unit'+strtoarray[i]).val();
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
					  	
					};
					
	    		}
	    		else
	    		{
	    			alert('Enter More than Availability Stock');
	    		}
	    	}
    });
    
    
   			function Getunitquantity(data_unit,uui)
    		{
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
				            }
				        });				
    		}
    		
    		
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
   
});
 </script>
 
  <script>
 $(document).ready(function(){
	 $('.open-left').click(function(){		 
		 $('#globalserach').toggleClass('globalsearch')		 
	 });
	
 });
 </script>
 