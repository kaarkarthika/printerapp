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
    height: 550px;
    background: #eaeaea;
}
#patient_common_search.placeholder {
    text-align: center;
}
.ss_v.fwidth {
    width: auto !important;
}

.panel.panel-border.panel-custom.home-body {
    min-height: 510px;
}
</style>
<style>
.panel-border .panel-body form {
    height: 150px;
    width: 100% !important;
}
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
	  fieldset.scheduler-border {
    border: 1px solid #dee6e4 !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
   /* -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;*/
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
	.form-head{background-color: #5fbeaa;
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
    border: 1px solid #a3a1a1 !important;
}input.form-control{
	border: 1px solid #a3a1a1 !important;
}
.form-group label {
    color: #000;
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
<?php $form = ActiveForm::begin(['id' => 'bill_returns']); ?> 
<div class="container">
   <div class="row">
   
      

	
		                                       
	  <strong><span class="pull-right" id="date_time"></span></strong>
           <div class="panel panel-border panel-custom home-body"> <!-- ss -->
          
            <div class="panel-body">
               <div class="row">
     		<div class="col-sm-12">
		    <div class="inpatientblock  desc"  style="position: relative;top: 9px;" > 
			<div class="row">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border form-head ">PATIENT DETAILS</legend>
	 		<div class="col-sm-12">
	 		<div class='col-md-2'>
    			<div class="form-group">
        			<label>BILL NO</label>
            		<input type='text' class="form-control cus-fld ipnumber"  name="BILLNUMBER" value='<?php echo $sales['billnumber']; ?>'>
            		<input type='hidden' class="form-control cus-fld"  name="SALE_ID" value='<?php echo $sales['opsaleid']; ?>'>
				</div>
   			</div>
   			<div class='col-md-2'>
    			<div class="form-group">
        			<label>MR NO</label>
            		<input type='text'   class="form-control cus-fld" readonly value='<?php echo $sales['mrnumber']; ?>' name="MRNUMBER">
				</div>
   			</div>
   			<div class='col-md-2 width-inc'>
    			<div class="form-group">
        			<label>PAT NAME</label>
            		<input type='text'  class="form-control cus-fld" id='patient_name' value='<?php echo $newpatient->patientname; ?>' readonly name="PATIENTNAME">
				</div>
   			</div>
   			<div class='col-md-2'>
    			<div class="form-group">
        			<label>MOB NO</label>
            		<input type='text' class="form-control cus-fld" readonly value='<?php echo $newpatient->pat_mobileno; ?>' name="MOBILENUMBER">
				</div>
   			</div>
   			<div class='col-md-2 width-inc'>
    			<div class="form-group ">
        			<label>DOC NAME</label>
            		<!--input type='text'   class="form-control cus-fld"  name="MOBILENUMBER"-->
            		<select id="doctor_name" onclick="isReadOnly()" readonly  class="form-control cus-fld"  name="DOCTORNAME">
					  <option value='<?php echo $sales['physicianname']; ?>'><?php echo $sales['physicianname']; ?></option>
					</select>
				</div>
   			</div>
   			<div class='col-md-2'>
    			<div class="form-group">
        			<label>INSURANCE</label>
            		<select id="insurance" onclick="isReadOnly()" readonly class="form-control cus-fld"  name="INSURANCE">
					  <option value='<?php echo $insurance_type; ?>'><?php echo $insurance_name; ?></option>
					</select>
				</div>
   			</div>
   			
   			
   			
	 		<div class='col-md-2'>
    			<div class="form-group">
        			<label>DOB</label>
            		<input type='text' class="form-control cus-fld" value='<?php echo date('d-m-Y',strtotime($sales['dob'])); ?>' readonly name="PATIENTDOB">
				</div>
   			</div>
   			<div class='col-md-2'>
    			<div class="form-group">
        			<label>GENDER</label>
            		<select id="gender" onclick="isReadOnly()" readonly class="form-control cus-fld"  name="GENDER">
					  <option value='<?php echo $newpatient->pat_sex; ?>'><?php echo $newpatient->pat_sex; ?></option>
					</select>
				</div>
   			</div>
   			
   			
   			</div>
   			
		</fieldset>
		</div>
		
		</div>
        </div>
       
             
         <div class="col-sm-12">
		    <div class="inpatientblock  desc"  style="position: relative;top: 9px;" > 
			<div class="row">
		<fieldset class="scheduler-border">
			
	 		<div class="col-sm-12">
	 		<div class='col-md-2 width-inc'>
    			<div class="form-group">
        			<label>Product</label>
            		<select id="product_name" prompt='SELECT PRODUCT' onchange='TabletChosen(this.value);' class="form-control cus-fld"  name="GENDER">
            			<option value=''></option>
					 <?php if(!empty($sales_detail)){ 
					 		foreach ($sales_detail as $key => $value) {
						?>
					 	<option value='<?php echo $value['opsale_detailid']; ?>'><?php echo $product_index[$value['productid']]['productname']; ?></option>
					 <?php } } ?> 
					</select>
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>Batch No</label>
            		<input type='text' id='batch_no' readonly class="form-control cus-fld"  name="BATCHNO">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>EXP DATE</label>
            		<input type='text' id='exp_date' readonly class="form-control cus-fld"  name="EXPIREDDATE">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>ISSUE QTY</label>
            		<input type='text' id="issue_qty" readonly class="form-control cus-fld"  name="ISSUEDQTY">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group ">
        			<label>RET QTY</label>
            		<input type='text' id='ret_qty'  onkeyup="CalculatedAmoumt(this.value);"  class="form-control cus-fld number"  name="RETURNQTY">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>MRP</label>
            		<input type='text' id='mrp'  readonly class="form-control cus-fld"  name="MRP">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>BILL DIS(%)</label>
            		<input type='text'  id='bill_disc' readonly class="form-control cus-fld"  name="BILL_PERCENT">
				</div>
   			</div>
   			
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>BILL DIS(F)</label>
            		<input type='text'  id='bill_disc_flat' readonly class="form-control cus-fld"  name="BILL_FLAT">
				</div>
   			</div>
   			
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>GST(%)</label>
            		<input type='text'  id='gst_percent' readonly class="form-control cus-fld"  name="GST_PERCENT">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>GST(F)</label>
            		<input type='text'  id='gst_flat' readonly  class="form-control cus-fld"  name="GST_FLAT">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>AMOUNT</label>
            		<input type='text'  id='amount' readonly class="form-control cus-fld"  name="AMOUNT">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<button type="button" id='add_to_grid' onclick='AddToGrid();' title='Add To Grid' class='add_to_grid btn btn-primary btn-xs'><i class="fa fa-plus"></i></button>
				</div>
   			</div>
   		</div>
   			
		</fieldset>
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
                              <th rowspan="2" class="text-center">Return<br>Qty</th>
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
			    <input type='hidden' name='return_status' class='return_tablet' id='return_tablet'>
			   <div class=" ">
                  <div class="panel panel-border panel-custom total-area"  >
                     <div class="panel-body" style="padding: 0 5px !important;">
                        <div class="row">
						
						
                           <div class="t-10  col-sm-9">
                              <div class="row">
							     
								 <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  > Items: </label>
										<input type="text" class="form-control total_items ansrefrsh" name='total_items' readonly id="no_of_items">
										<input type="hidden" class="form-control total_items ansrefrsh" name='total_items_hidden'  id="no_of_items_hidden">
									</div>
								 </div>
							  
							    <div class="form-group col-sm-1" style="position: relative;left: -16px;">
									<div class="input-group  ">
										<label class="input-group-addon" style="padding: 0 6px;" > Qty: </label>
										<input type="text" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
										<input type="hidden" style="width: 50px;" class="form-control total_quantity ansrefrsh" name='total_quantity_hidden'  id="total_quantity_hidden">
									</div>
								 </div>
                                
								  <div class="form-group col-sm-2">
									<div class="input-group  ">
										<label class="input-group-addon"  >  GST: </label>
										<input type="text" style="width: 75px;"  class="form-control total_vat ansrefrsh" name='total_gst' readonly id="total_gst_amount">
										<input type="hidden" style="width: 75px;"  class="form-control total_vat ansrefrsh" name='total_gst_hidden'  id="total_gst_amount_hidden">
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
										<input type="hidden" style="width: 90px;"   class="form-control total_sub_total ansrefrsh" name='total_sub_total_hidden' id="total_sub_total_hidden">
									</div>
								 </div>
							  
                                </div>
                           </div>
                           <div class="t-10  col-sm-3" style="    right: -24px;">
						   
                          	<div class="row"> 
							  <!-- <div class=" col-sm-1"></div> -->
						  <div class="form-group col-sm-7">
									<div class="input-group  ">
										<label class="input-group-addon bg-primary" style="color:#fff;" >Net Amt : </label>
										<input type="text" class="form-control total-netamt ansrefrsh bg-primary" name='total_net_amount' style="color: #fff;font-size: 14pt;" readonly id="total_net_amount">
										<input type="hidden" class="form-control total-netamt ansrefrsh bg-primary" name='total_net_amount_hidden' style="color: #fff;font-size: 14pt;"  id="total_net_amount_hidden">
									</div>
								 </div>
							  <div class="form-group col-sm-2" style="z-index: 9999;">
                                 
                                 <button type="button" value='save_bill' name='saved_bill' style="z-index: 9999;" onclick='SavedReturnTablet();' class="btn btn-default btn-sm fwidth ss_v save_billing" data-toggle="tooltip" title="Save and Submit"><i class="fa fa-save"></i></button>
                                 <i><strong><small>[Alt+s]</small><strong></i>
                              </div>
                              <div class="form-group col-sm-2" style="z-index: 9999;">
                               
                                 <button type='reset' style="z-index: 9999;" class="btn btn-warning btn-sm fwidth ss_v remove_all" data-toggle="tooltip" title="Cancel"><i class="fa fa-close"></i> </button>
                                 <i><strong><small>[Alt+z]</small><strong></i>
                              </div>
                         </div><!-- Row end -->
                         </div>
                        </div>
                        <div class="row " style="position: relative;">
                           	<div class="col-sm-6 dis_remark">
                           		<div class="row">
                           		<div class="form-group col-sm-3 " style="padding: 0;left: 15px;">
									<div class="input-group  ">
										
										<label class="input-group-addon" style="    padding: 8px 10px;" >Dis Type: </label>
										<!-- <input type="text" class="form-control  over_all_discount_percent number" name='overall_discount_percent'   id="over_all_discount_percent"> -->
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
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent' readonly onkeyup="OverallPercentageDiscount();"  id="total_discountvaluetype">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent_hidden'   id="total_discountvaluetype_hidden">
										
										<label class="input-group-addon"  >Flat: </label>
										<input type="text" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original' readonly  id="total_discountamount">
										<input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original_hidden'   id="total_discountamount_hidden">
									</div>
								 </div>
								 </div>
								 <div class="row">
								 	  <div class="form-group col-sm-11">
										    <label for="exampleFormControlTextarea1">Remarks</label>
										      <textarea style="min-height: 50px;width: 250px;" class="form-control rounded-0 remarks" id="remarks" name="remarks" rows="2"></textarea>
										</div>
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
	 
	 






  <?php ActiveForm::end(); ?>
    
    

<?php  $url1 = Yii::$app->homeUrl .'?r=sales/opreturns';  ?>

    
<script type="text/javascript">window.onload = date_time('date_time');</script>
<script type="text/javascript" src="js/shortcut.js" ></script>
<script>
	
	var obj = $.parseJSON('<?php echo $sales_json; ?>');
	var product = $.parseJSON('<?php echo $product_json; ?>');
	var composition = $.parseJSON('<?php echo $composition_json; ?>');
	var unit = $.parseJSON('<?php echo $unit_json; ?>');
	
	
	$(".ipnumber").typeahead({
  
  source: function(query,result) {
        $.ajax({
          url:'<?php echo Yii::$app->homeUrl . "?r=sales/ajaxbillnumber";?>',
          method:'POST',
          data:{query:query},
          dataType:'json',
          success:function(data)
          {
            result($.map(data, function(item){
            return item.bill_no;
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
          url:'<?php echo Yii::$app->homeUrl . "?r=sales/opdetails&id=";?>'+result,
          method:'POST',
          dataType:'json',
          success:function(data)
          {   $('#load1').hide();
            
            //if (confirm('Are You Sure to Move Back to Upcoming Job Schedule??')) {
              
              var id = data[0]['opsaleid'];
              
                window.location = "<?php echo $url1; ?>&id="+id;    
      //  }           
           
          
          }
        })
    }
});
  
	function isReadOnly() 
	{
		$('#doctor_name').attr("style", "pointer-events: none;");
		$('#gender').attr("style", "pointer-events: none;");
		$('#insurance').attr("style", "pointer-events: none;");
	}
	
	function TabletChosen(value_tab) 
	{
		var tablet_id=$('#product_name').val();
		
		if(tablet_id != '')
		{
			
			//SET VALUE
			var date = new Date(obj[tablet_id]['expiredate']);
			var format_date=formatDate(date);
			
			
			$('#batch_no').val(obj[tablet_id]['batchnumber']);
			$('#exp_date').val(format_date);
			$('#issue_qty').val(obj[tablet_id]['productqty']);
			//$('#mrp').val(obj[tablet_id]['mrpperunit']);
			$('#bill_disc').val(obj[tablet_id]['discountvalue']);
			$('#bill_disc_flat').val(obj[tablet_id]['discountvalueperquantity']);
			$('#gst_percent').val(obj[tablet_id]['gstrate']);
			//$('#gst_flat').val(obj[tablet_id]['gstvalue']);
			$('#amount').val('');
			$('#ret_qty').val('');
			
			$('#ret_qty').focus();
		}
		else if(tablet_id == '')
		{
			$('#batch_no').val('');
			$('#exp_date').val('');
			$('#issue_qty').val('');
			$('#mrp').val('');
			$('#bill_disc').val('');
			$('#bill_disc_flat').val('');
			$('#gst_percent').val('');
			$('#gst_flat').val('');
			$('#amount').val('');
			$('#ret_qty').val('');
		}  
	}
	
	
	function CalculatedAmoumt(return_qty) 
	{
		var tablet_id=$('#product_name').val();
		if(tablet_id != '')
		{
			return_qty=parseInt(return_qty);
			var issue_qty=parseInt($('#issue_qty').val());
			if(return_qty > issue_qty)
			{
				$('#ret_qty').val('');
				alert('Return Qty Is Not Greater Than Issue Qty');
				$('#ret_qty').focus();
				return false;
			}
			else if(return_qty <= 0)
			{
				$('#ret_qty').val('');
				alert('Invalid Return Qty');
				$('#ret_qty').focus();
				return false;
			}
			else
			{
				var mrp=parseFloat(obj[tablet_id]['mrpperunit']);
				var gst=parseFloat(obj[tablet_id]['gstvalue']/issue_qty).toFixed(2);
				gst=parseFloat(gst*return_qty);
				var bill_disc_flat=parseFloat(obj[tablet_id]['discountvalueperquantity']);
				
				if(!isNaN(mrp))
				{
					var mrp_amt=parseFloat(mrp*return_qty);
					
					
					var calc=parseFloat(mrp*return_qty)+gst;
					
					
					if(!isNaN(bill_disc_flat))
					{
						calc=calc-bill_disc_flat;
					}
					
					$('#mrp').val(mrp_amt);
					$('#amount').val(calc);
					$('#gst_flat').val(gst);
					
					$('#add_to_grid').focus();
				}
				
				if(isNaN($('#amount').val()))
				{
					$('#amount').val('');
				}
			}
		}  
	}
	
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
	
	
function AddToGrid() 
{
var tablet_id=$('#product_name').val();
var amount=parseFloat($('#amount').val());
var ret_qty=parseInt($('#ret_qty').val());
var issue_qty=parseInt($('#issue_qty').val());
if(tablet_id != '')
{
	if(!isNaN(amount) && !isNaN(ret_qty))
	{

//Remove Duplicates Row
var length_arr=$("#fetch_update_data tr").length;

if(length_arr > 0)
{
	$("#fetch_update_data tr").each(function() 
	{
	 	var attr_id=$(this).attr('data-id');
	 	if(attr_id == tablet_id)
	 	{
	 		$('#table_del'+tablet_id).remove();
	 	}
	});
}

$('#total_sub_total').val('');
$('#total_net_amount').val('');
$('#total_gst_amount').val('');
$('#total_quantity').val('');
$('#total_discountamount').val('');


var gst=parseFloat(obj[tablet_id]['gstvalue']/issue_qty).toFixed(2);
gst=parseFloat(gst*ret_qty);

		
var product_name=product[obj[tablet_id]['productid']]['productname']+'/'+composition[obj[tablet_id]['compositionid']]['composition_name'] ;
var batchnumber=obj[tablet_id]['batchnumber'];
var expire_date_id=$('#exp_date').val();
var required_id=ret_qty;
var unit_value=unit[obj[tablet_id]['unitid']]['unitvalue'];
var unit_value=unit[obj[tablet_id]['unitid']]['unitvalue'];
var total_unit='';
var tablet_type='';
var mrp_id=obj[tablet_id]['mrpperunit'];
var stock_id=obj[tablet_id]['stockid'];
var unit_id=obj[tablet_id]['unitid'];
var composition_id=obj[tablet_id]['compositionid'];
var stockcode_id=obj[tablet_id]['stock_code'];
var brandcode_id=obj[tablet_id]['brandcode'];
var product_id=obj[tablet_id]['productid'];
var expire_date_id=$('#exp_date').val();
var batchnumber=obj[tablet_id]['batchnumber'];
var stock_respose_id=obj[tablet_id]['stockresponseid'];
var price_per_quantity=parseFloat(obj[tablet_id]['mrpperunit']*ret_qty).toFixed(2);
var gst_sale_percent=parseFloat(obj[tablet_id]['gstrate']);
var total_amount=parseFloat(amount.toFixed(2));

//DISCOUNT VALUE
var discount_flat='';
var discount_percent='';
if(obj[tablet_id]['discountvalueperquantity'] != '')
{
	
	discount_flat=parseFloat(obj[tablet_id]['discountvalueperquantity']);
	if(isNaN(discount_flat))
	{
		discount_flat=0;
	}
    discount_percent=parseFloat(obj[tablet_id]['discountvalue']);
	if(isNaN(discount_percent))
	{
		discount_percent=0;
	}
}

//GST VALUE
var igst_percent=0;
var igst_value=0;
var cgst_percent=parseFloat(obj[tablet_id]['cgst_percent']);
var cgst_value=parseFloat(parseFloat(gst/2));
var sgst_percent=parseFloat(obj[tablet_id]['sgst_percent']);
var sgst_value=parseFloat(parseFloat(gst/2));


	
	
var markup = "<tr  class='save_data_table' data-id="+tablet_id+" id='table_del"+tablet_id+"'>"
+"<td><div class='trunctext wd100'>"+product_name+"</div></td><td>"+batchnumber+"</td><td>"+expire_date_id+"</td>"
+"<td class='quantity_add' id='quantity_add"+tablet_id+"'>"+required_id+"</td><td id='unit_value_medicine"+tablet_id+"'>"+unit_value+"</td>"
+"<td><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tablet_id+"' value='"+unit_value+"'>"
+"<input type='hidden' name='tablet_tot_unit_ins[]' id='tablet_tot_unit"+tablet_id+"' value='"+total_unit+"'>"
+"<input type='hidden' name='tablet_type[]' id='tablet_type"+tablet_id+"' value='"+tablet_type+"'>"
+"<input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'>"
+"<input type='hidden' name='stock_id[]' value='"+stock_id+"'>"
+"<input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
+"<input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'>"
+"<input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'>"
+"<input type='hidden' name='product_name_id[]' value='"+product_id+"'>"
+"<input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'>"
+"<input type='hidden' name='product_name[]' value='"+product_name+"'>"
+"<input type='hidden' name='quantity[]' value='"+required_id+"'>"
+"<input type='hidden' name='primeid[]' value='"+tablet_id+"'>"
+"<input type='hidden' name='stock_respose_id[]' value='"+stock_respose_id+"'>"
+"<input type='text' name='price[]' class='price_mrp text-right form-control' data_price_mrp="+tablet_id+" value="+price_per_quantity+" id="+'price'+tablet_id+"></td>"
+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tablet_id+"' >"
+"<li><input type='radio'  name='desc"+tablet_id+"' data_flat='"+tablet_id+"' id='flat_discount"+tablet_id+"'  disabled='disabled' class='deselect flat testrad'  onchange='descChanged("+tablet_id+")'>"
+"<label for='flat_discount"+tablet_id+"' class='w-50 text-center testrad'>F</label></li><li>"
+"<input type='radio' id='percent"+tablet_id+"' data-deselect="+tablet_id+"  disabled='disabled' class='deselect percent testrad' name='desc"+tablet_id+"'  onchange='descChanged("+tablet_id+")' >"
+"<label for='percent"+tablet_id+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
+"<td><div class='input-group'> <input type='text' value='"+discount_percent+"' name='discount_value[]' data_disc_value='"+tablet_id+"' id='enabledisc"+tablet_id+"'  class='enabledisc disctxt w-50' readonly></div></td>"
+"<td><div class='input-group'> <input type='text' value='"+discount_flat+"' name='discountext_value[]' id='disc_amount"+tablet_id+"' class='add_discount text-right disctxt w-50' readonly>"
+"</div></td><td class='w-xss'><input type='hidden' class='form-control' data_gst_percent='"+tablet_id+"' name='gst_percent[]' id='gst_percent"+tablet_id+"' value='"+gst_sale_percent+"' readonly>"
+"<input type='text' class='form-control' data_igst_percent='"+tablet_id+"' value='"+igst_percent+"' id='igst_percent"+tablet_id+"' readonly></td><td><input type='text'  class='form-control'  value='"+igst_value+"' data_igst_value='"+tablet_id+"' id='igst_value"+tablet_id+"' readonly></td>"
+"<td class='w-xss'><input type='text' value='"+cgst_percent+"' class='form-control cgst_percent text-right' name='cgst_percent[]' data_cgst_percent='"+tablet_id+"' id='cgst_percent"+tablet_id+"' readonly></td>"
+"<td><input type='text' value='"+cgst_value.toFixed(2)+"' class='form-control cgst_value text-right' name='cgst_value[]' data_cgst_value='"+tablet_id+"' id='cgst_value"+tablet_id+"' readonly></td>"
+"<td class='w-xss'><input type='text'  class='form-control sgst_percent' value='"+sgst_percent+"' name='sgst_percent[]' data_sgst_percent='"+tablet_id+"' id='sgst_percent"+tablet_id+"' readonly></td>"
+"<td><input type='text' value='"+sgst_value.toFixed(2)+"' class='form-control sgst_value text-right' name='sgst_value[]' data_sgst_value='"+tablet_id+"' id='sgst_value"+tablet_id+"' readonly></td>"
+"<td><input type='text'  class='form-control total_amt_cal text-right' value='"+total_amount+"' name='total_amt_cal[]' data_total='"+tablet_id+"' id='total_amount"+tablet_id+"' readonly>"
+"<input type='hidden'  class='form-control reduired_qty_hidden text-right' name='reduired_qty_hidden[]' data_total='"+tablet_id+"' value="+required_id+" id='reduired_qty_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control price_hidden text-right' name='price_hidden[]' data_total='"+tablet_id+"' id='price_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control cgst_percentage_hidden text-right' name='cgst_percentage_hidden[]' data_total='"+tablet_id+"' id='cgst_percentage_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control cgst_value_hidden text-right' name='cgst_value_hidden[]' data_total='"+tablet_id+"' id='cgst_value_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control sgst_percentage_hidden text-right' name='sgst_percentage_hidden[]' data_total='"+tablet_id+"' id='sgst_percentage_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control sgst_value_hidden text-right' name='sgst_value_hidden[]' data_total='"+tablet_id+"' id='sgst_value_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control total_amt_cal1 text-right' name='total_amt_cal1[]' data_total='"+tablet_id+"' id='total_amount1"+tablet_id+"'></td>"
+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tablet_id+" id='delrow"+tablet_id+"'><i class='fa fa-remove'></i></button></td></tr>";
																																
																		
$("#fetch_update_data").append(markup); 
											
//Total Amount Calculation
var total_sub_total=0;
var total_net_amount=0;
var total_gst_amount=0;
var cgst_value=0;
var sgst_value=0;
var total_quantity=0;
var total_discountamount=0;
$("#fetch_update_data tr").each(function() 
{
	var attr_id=$(this).attr('data-id');
	var price_total=parseFloat($('#price'+attr_id).val());
	var total_amount=parseFloat($('#total_amount'+attr_id).val());
	var cgst_value_t=parseFloat($('#cgst_value'+attr_id).val());
	var sgst_value_t=parseFloat($('#sgst_value'+attr_id).val());
	var quantity_add=parseInt($('#quantity_add'+attr_id).html());
	var disc_amount=parseFloat($('#disc_amount'+attr_id).val());
	if(!isNaN(price_total))
	{
		total_sub_total=total_sub_total+price_total;
	}
	else if(isNaN(price_total))
	{
		total_sub_total=total_sub_total+0;
	}
	if(!isNaN(total_amount))
	{
		total_net_amount=total_net_amount+total_amount;
	}
	else if(isNaN(total_amount))
	{
		total_net_amount=total_net_amount+0;
	}
	if(!isNaN(cgst_value))
	{
		cgst_value=cgst_value+cgst_value_t;
	}
	else if(isNaN(cgst_value))
	{
		cgst_value=cgst_value+0;
	}
	if(!isNaN(sgst_value))
	{
		sgst_value=sgst_value+sgst_value_t;
	}
	else if(isNaN(sgst_value))
	{
		sgst_value=sgst_value+0;
	}
	if(!isNaN(quantity_add))
	{
		total_quantity=total_quantity+quantity_add;
	}
	else if(isNaN(quantity_add))
	{
		total_quantity=total_quantity+0;
	}
	if(!isNaN(disc_amount))
	{
		total_discountamount=total_discountamount+disc_amount;
	}
	else if(isNaN(disc_amount))
	{
		total_discountamount=total_discountamount+0;
	}
});

var length_arr=$("#fetch_update_data tr").length;
	
$('#total_sub_total').val(total_sub_total.toFixed(2));
$('#total_net_amount').val(total_net_amount.toFixed(2));
$('#total_gst_amount').val((sgst_value+cgst_value).toFixed(2));
$('#total_quantity').val(total_quantity);
$('#no_of_items').val(length_arr);		
$('#total_discountamount').val(total_discountamount.toFixed(2));			
	

		
		$('#batch_no').val('');
		$('#exp_date').val('');
		$('#issue_qty').val('');
		$('#mrp').val('');
		$('#bill_disc').val('');
		$('#bill_disc_flat').val('');
		$('#gst_percent').val('');
		$('#gst_flat').val('');
		$('#amount').val('');
		$('#ret_qty').val('');
		$('#product_name').val('');
		
		$('#product_name').focus();
		}
	}
}



  $("body").on('click', '.delrow', function () 
  {
    //alert("test");
       var data_addid = $(this).attr('data_delete_row')
       var item_less=1;
       var total_items=parseInt($('#quantity_add'+data_addid).html()); 

      // var length_arr=$("#fetch_update_data tr").length;

       var total_gst_pre=(parseFloat($('#cgst_percent'+data_addid).val())+parseFloat($('#sgst_percent'+data_addid).val()));
       var total_gst_val=(parseFloat($('#cgst_value'+data_addid).val())+parseFloat($('#sgst_value'+data_addid).val()));
       var total_sub_total=parseFloat($('#price'+data_addid).val()).toFixed(2);
       var total_net_total=parseFloat($('#total_amount'+data_addid).val()).toFixed(2);
       var rate=parseFloat($('#treatmentindividual-rate'+data_addid).val());
      
    $('#total_quantity').val(parseInt($('#total_quantity').val())-total_items);
    $('#treatmentoverall-overall_sub_total').val(parseFloat($('#treatmentoverall-overall_sub_total').val()).toFixed(2)-rate);
    //$('#treatmentoverall-total_gst_percent').val(parseFloat($('#treatmentoverall-total_gst_percent').val()).toFixed(2)-parseFloat(total_gst_pre).toFixed(2));
    $('#total_gst_amount').val(parseFloat($('#total_gst_amount').val()).toFixed(2)-parseFloat(total_gst_val).toFixed(2));
    $('#total_sub_total').val(parseFloat($('#total_sub_total').val()).toFixed(2)-total_sub_total);

     $('#total_net_amount').val(parseFloat($('#total_net_amount').val()).toFixed(2)-total_net_total);

    $('#treatmentoverall-overalltotal').val(parseFloat($('#treatmentoverall-overalltotal').val()).toFixed(2)-total_sub_total);
   
    $('#no_of_items').val($("#fetch_update_data tr").length-item_less); 
   // $('#no_of_items').val(parseFloat($('#no_of_items').val())-length_arr);
    $('#treatmentoverall-overalldiscountpercent').val();
    $('#treatmentoverall-overalldiscountamount').val();
    $('#table_del'+data_addid).remove();
            
 });

function SavedReturnTablet() 
{
	var table=$("#fetch_update_data tr").length;
	
	if(table > 0)
	{
		var remarks=$('#remarks').val();
		var url_id='<?php echo $sales['opsaleid'];?>';
		if(remarks != '')
		{
			if(patient_name != '')
			{
				$.ajax({
		            type: "POST",
		            url: "<?php echo Yii::$app->homeUrl . "?r=sales/opreturns&id=";?>"+encodeURIComponent(url_id),
		            data: $("#bill_returns").serialize(),
		            success: function (result) 
		            { 
		            	alert(result);
		            	if(result == 'Saved')
		            	{
		            		$('.save_billing').attr('disabled','disabled');
		            	}
		            }
				});
			}
			else
			{
				alert('Patient Name required');
				return false;
			}
		}
		else
		{
			alert('Remarks required');
			return false;
		}
	}
	else
	{
		alert('No Tablet To Selected');
		return false;
	}
}



	
	$('#product_name').focus();
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
	});
</script>

