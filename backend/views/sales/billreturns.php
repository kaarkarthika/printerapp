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
	
	
	//echo '<pre>';
	//print_r($newpatient);die;
	
	if(!empty($sales))
	{
		if($sales['sales_type'] == 'O')
		{
			$pat_name=$sales['name'];
			$phone_number=$sales['phonenumber'];
			if($sales['dob'] == '1970-01-01' || $sales['dob'] == '1970-01-01')
			{
				$dob='';
			}
			else 
			{
				$dob=date('d-m-Y',strtotime($sales['dob']));
			}
		}
		else if($sales['sales_type'] == 'I')
		{
			$pat_name=$sales['name'];
			$phone_number=$sales['phonenumber'];
			if($sales['dob'] == '1970-01-01' || $sales['dob'] == '1970-01-01')
			{
				$dob='';
			}
			else 
			{
				$dob=date('d-m-Y',strtotime($sales['dob']));
			}
		}
				
	}
	
	
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
}

legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
}
	.form-head{
		background-color: #5fbeaa;
    	color: #fff;
    }
.cus-fld{
	height: 25px;
    margin-right: 15px;
    margin-bottom: 10px;
    padding: 0px 10px;
	font-size:12px;
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
     <div class="col-sm-12">
	   <div class="row">
         <div class="panel panel-border panel-custom">
            <div class="panel-heading"></div>
            <div class="panel-body">
			   <div class="row">
				<div class="col-sm-12">
		    <div class="inpatientblock  desc"  style="position: relative;top: 2px;" > 
			 <h6><strong>Patient Details</strong></h6>
			<div class="row">
		 
	 		<div class="col-sm-12">
	 		<div class='col-sm-1'>
    			<div class="form-group">
        			<label>BILL NO</label>
            		<input type='text' class="form-control cus-fld ipnumber"  name="BILLNUMBER" value='<?php echo $sales['billnumber']; ?>'>
            		<input type='hidden' class="form-control cus-fld"  name="SALE_ID" value='<?php echo $sales['opsaleid']; ?>'>
				</div>
   			</div>
   			<div class='col-sm-1'>
    			<div class="form-group">
        			<label>MR NO</label>
            		<input type='text'   class="form-control cus-fld" readonly value='<?php echo $sales['mrnumber']; ?>' name="MRNUMBER">
				</div>
   			</div>
   			<div class='col-md-2 width-inc'>
    			<div class="form-group">
        			<label>PAT NAME</label>
            		<input type='text'  class="form-control cus-fld" id='patient_name' value='<?php echo $pat_name; ?>' readonly name="PATIENTNAME">
				</div>
   			</div>
   			<div class='col-md-2'>
    			<div class="form-group">
        			<label>MOB NO</label>
            		<input type='text' class="form-control cus-fld" readonly value='<?php echo $phone_number; ?>' name="MOBILENUMBER">
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
	 		<div class='col-md-1'>
    			<div class="form-group">
        			<label>DOB</label>
            		<input type='text' class="form-control cus-fld" value='<?php echo $dob; ?>' readonly name="PATIENTDOB">
				</div>
   			</div>
   			<div class='col-md-1'>
    			<div class="form-group">
        			<label>GENDER</label>
            		<select id="gender" onclick="isReadOnly()" readonly class="form-control cus-fld"  name="GENDER">
					  <option value='<?php echo $newpatient->pat_sex; ?>'><?php echo $newpatient->pat_sex; ?></option>
					</select>
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
</div>
 <div class="row mt-5">
    <div class="col-sm-12">
	   <div class="row">
         <div class="panel panel-border panel-custom">
            <div class="panel-heading"></div>
            <div class="panel-body">
			    <div class="row">
				  <div class="col-sm-12">
	 		    <div class='col-md-2 width-inc'>
    			<div class="form-group">
        			<label>Product</label>
            		<select id="product_name" prompt='SELECT PRODUCT' onchange='TabletChosen(this.value);' class="clear_field form-control cus-fld"  name="GENDER">
            			<option value=''></option>
					 <?php if(!empty($sales_detail)){ 
					 		foreach ($sales_detail as $key => $value) {
						?>
					 	<option value='<?php echo $value['opsale_detailid']; ?>'><?php echo $product_index[$value['productid']]['productname']; ?></option>
					 <?php } } ?> 
					</select>
				</div>
   			</div>
   			<div class='col-md-1' style="width:6%;">
    			<div class="form-group">
        			<label>Batch No</label>
            		<input type='text' id='batch_no' readonly class="clear_field form-control cus-fld"  name="BATCHNO">
				</div>
   			</div>
   			<div class='col-md-1' style="width:8%;">
    			<div class="form-group">
        			<label>EXP DATE</label>
            		<input type='text' id='exp_date' readonly class="clear_field form-control cus-fld"  name="EXPIREDDATE">
				</div>
   			</div>
   			<div class='col-md-1 w-90'>
    			<div class="form-group">
        			<label>ISSUE QTY</label>
            		<input type='text' id="issue_qty" readonly class="clear_field form-control cus-fld"  name="ISSUEDQTY">
				</div>
   			</div>
   			<div class='col-md-1 w-90'>
    			<div class="form-group ">
        			<label>RET QTY</label>
            		<input type='text' id='ret_qty'  onkeyup="CalculatedAmoumt(this.value,event);"  class="clear_field form-control cus-fld number"  name="RETURNQTY">
				</div>
   			</div>
   			<div class='col-md-1 w-90'>
    			<div class="form-group">
        			<label>Price</label>
            		<input type='text' id='mrp'  readonly class="clear_field form-control cus-fld"  name="MRP">
				</div>
   			</div>
   			<div class='col-md-1 w-90'>
    			<div class="form-group">
        			<label>BILL DIS(%)</label>
            		<input type='text'  id='bill_disc' readonly class="clear_field form-control cus-fld"  name="BILL_PERCENT">
				</div>
   			</div>
   			
   			<div class='col-md-1 w-90'>
    			<div class="form-group">
        			<label>BILL DIS(F)</label>
            		<input type='text'  id='bill_disc_flat' readonly class="clear_field form-control cus-fld"  name="BILL_FLAT">
				</div>
   			</div>
   			
   			<div class='col-md-1 w-90'>
    			<div class="form-group">
        			<label>GST(%)</label>
            		<input type='text'  id='gst_percent' readonly class="clear_field form-control cus-fld"  name="GST_PERCENT">
				</div>
   			</div>
   			<div class='col-md-1 w-90'>
    			<div class="form-group">
        			<label>GST(F)</label>
            		<input type='text'  id='gst_flat' readonly  class="clear_field form-control cus-fld"  name="GST_FLAT">
				</div>
   			</div>
   			<div class='col-md-1 w-90'>
    			<div class="form-group">
        			<label>AMOUNT</label>
            		<input type='text'  id='amount' readonly class="clear_field form-control cus-fld"  name="AMOUNT">
				</div>
   			</div>
   			<div class='col-md-1 w-90 add_btn'>
    			<div class="form-group">
        			<button type="button" id='add_to_grid' onclick='AddToGrid();' title='Add To Grid' class='clear_field add_to_grid btn btn-primary btn-xs'><i class="fa fa-plus"></i> Add To Grid</button>
				</div>
   			</div>
   		</div>
				</div>
            </div>
          </div>
       </div>
    </div>
    </div>
	 <div class="row mt-5">
      <div class="col-sm-12">
	   <div class="row">
         <div class="panel panel-border  ">
            <div class="panel-heading"></div>
            <div class="panel-body">
			    <div class="row">
				  <div class="col-sm-9">
				     <table class="table table-bordered table-striped tbl-scrol" id="tbUser">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center hide">#</th>
                              <th rowspan="2" style="width:7.8%" class="text-center">Stock / Drug</th>
                              <th rowspan="2" style='width:4%;' class="text-center">Batch</th>
                              <th rowspan="2" style='width:8%;' class="text-center">Exp Date</th>
                              <th rowspan="2" style='width:5%;' class="text-center">Return<br>Qty</th>
                              <th rowspan="2" style='width:7.2%;' class="text-center">Unit<br>Form</th>
                              <th rowspan="2" style='width:7.7%;' class="text-center">MRP</th>
                              <!--th rowspan="2" width="5%" class="text-center">Discount Type</th-->
                              <th colspan="2" style='width:15.4%;' class="text-center th-discount"  >Discount</th>
                              <!--th colspan="2" class="text-center">IGST</th-->
                              <th colspan="2" class="text-center th-cgst">CGST</th>
                              <th colspan="2" class="text-center th-sgst">SGST</th>
                              <th rowspan="2" class="text-center th-total">Total</th>
                              <th rowspan="2" class="text-center">Remove</th>
                           </tr>
                           <tr>
                              <th class="text-center">Val</th>
                              <th width="5%" class="text-center">Amt</th>
                              <!--th class="text-center">%</th>
                              <th width="5%" class="text-center">Amt</th-->
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
				    <div class="col-sm-3" style="background-color: #ebeff2;margin-top:5px;position: " >
				   <div class=" ">
				      
				       <table class="table">
                        <tr>
							<th>Details</th>
							<td> 
								<div class="input-group">
								  <div class="input-group-btn" data-toggle="buttons" >
                                    <label disabled class="inp btn btn-default  " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-percentage" disabled value="percentage"  autocomplete="off">Items
                                    </label>         
                                  </div>
		                          <input type="text" class="clear_field form-control total_items ansrefrsh" name='total_items' readonly id="no_of_items">
										<input type="hidden" class="form-control total_items ansrefrsh" name='total_items_hidden'  id="no_of_items_hidden">
                                  <div class="input-group-btn" data-toggle="buttons" >
                                     <label  disabled class="inp btn btn-default   " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-flat" value="flat" disabled autocomplete="off">Qty
                                     </label>         
                                  </div>
		                          <input type="text"   class="clear_field form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
										<input type="hidden"   class="clear_field form-control total_quantity ansrefrsh" name='total_quantity_hidden'  id="total_quantity_hidden">
                                 </div> 
							   </td>
						</tr>					   
						
						
						<tr>
							<th>GST</th>
							<td><input type="text" style=" "  class="clear_field form-control text-right total_vat ansrefrsh" name='total_gst' readonly id="total_gst_amount">
										<input type="hidden" style=" "  class="clear_field form-control text-right total_vat ansrefrsh" name='total_gst_hidden'  id="total_gst_amount_hidden"></td>
						</tr>
						
						<tr>
							<th>Discount</th>
							<td> 
								<div class="input-group">
								  <div class="input-group-btn" data-toggle="buttons">
                                    <label  disabled  class="inp btn btn-default " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-percentage" disabled value="percentage"  autocomplete="off">%
                                    </label>         
                                  </div>
		                         <input type="text" class="clear_field form-control total_disc_original ansrefrsh number"  name='overall_discount_percent' readonly   id="total_discountvaluetype">
								 <input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='overall_discount_percent_hidden'   id="total_discountvaluetype_hidden">
                                  <div class="input-group-btn" data-toggle="buttons">
                                     <label disabled class="inp btn btn-default  " style="padding:3px!important;">
                                       <input   type="radio" name="discount" class="enable-textbox-flat" value="flat" disabled autocomplete="off">$
                                     </label>         
                                  </div>
		                          <input type="text" class="clear_field form-control total_disc_original ansrefrsh number"  name='total_disc_original' readonly  id="total_discountamount">
								  <input type="hidden" class="form-control total_disc_original ansrefrsh number"  name='total_disc_original_hidden'   id="total_discountamount_hidden">
                                 </div> 
							   </td>
						</tr>
						<tr>
						<th>Sub Total</th>
							<td><input type="text"     class="text-right  clear_field form-control total_sub_total ansrefrsh" name='total_sub_total' readonly id="total_sub_total">
							<input type="hidden"     class="clear_field form-control total_sub_total ansrefrsh" name='total_sub_total_hidden' id="total_sub_total_hidden"></td>
						</tr>
						<tr>
							<th>NET Amount</th>
							<td><input type="text" class="clear_field form-control text-right  total-netamt ansrefrsh  " name='total_net_amount' style=" font-size: 14pt;" readonly id="total_net_amount">
										<input type="hidden" class="clear_fiel text-rightt form-control total-netamt ansrefrsh bg-primary" name='total_net_amount_hidden' style="color: #fff;font-size: 14pt;"  id="total_net_amount_hidden"></td>
						</tr>
						<tr>
							<th>Round Off</th>
							<td><input type="text" class="form-control text-right round_off" id="round_off" name="round_off"></td>
						</tr>
						<tr>
							<th>Return Paid</th>
							<td>
								<input type="text" class="clear_field form-control text-right  total-netamt ansrefrsh  " name='total_paid_amount' style=" font-size: 14pt;" readonly id="total_paid_amount">
						</tr>
						<tr>
							<th class="col-sm-5">Balance</th>
							<td class="col-sm-7"><input type="text" class="form-control text-right  balance_amount" style=" font-size: 14pt;" readonly id='balance_amount'></td>
						</tr>
					  </table>
					   
					
					   <div class="form-group col-sm-12">
							<label class="control-label " for=" ">Remarks</label>	
							<textarea style="min-height: 30px; " class="form-control rounded-0 remarks" id="remarks" name="remarks" rows="2"></textarea>															
					   </div>
					   
					   <div class="form-group">
					 <div class="panel">
            <input type="hidden" name="saved_val" id='saved_val'>
                       <div class="panel panel-border">
                        <div class="res-btn panel-body" style="padding: 6px 7px 8px 35px;">					   
						    <button type="button" value='save_bill' name='saved_bill' style="z-index: 9999;" onclick='SavedReturnTablet();' class="clear_field btn btn-success btn-xs fwidth ss_v save_billing" data-toggle="tooltip" title="Ctrl+s">Save</button>
						 <button type="button" class="btn  btn-xs btn-warning remove_all" onclick='RemoveAll();'>Clear</button>
						
						 <a href="<?php  echo Yii::$app->request->BaseUrl;?>/index.php?r=sales/index" class="btn text-right btn-xs btn-default btn-bk" title="Back To Grid">Grid </a>

						<!-- <button type="button" class="btn   inp btn-sm btn-default remove_all">Close</button> -->
						
						<button type='reset' style="z-index: 9999;" class="inp clear_field btn btn-default btn-xs fwidth ss_v remove_all" data-toggle="tooltip" title="Ctrl+c">Close</button>						 
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
	   </div>
	  </div>

  <?php ActiveForm::end(); ?>
    
    

<?php  $url1 = Yii::$app->homeUrl .'?r=sales/opreturns';  ?>

    
<script type="text/javascript">window.onload = date_time('date_time');</script>
<script type="text/javascript" src="js/shortcut.js" ></script>
<script>
	var onetimesave=1;
	

	<?php if(!empty($sales_json)){?>
	var obj = $.parseJSON('<?php echo $sales_json; ?>');
	
	<?php } else {?>
	var obj = [];
	<?php } ?>	
	<?php if(!empty($product_json)){?>
	var product = $.parseJSON('<?php echo $product_json; ?>');
	<?php } else {?>
	var product = [];	
	<?php } ?>	
	<?php if(!empty($composition_json)){?>
	var composition = $.parseJSON('<?php echo $composition_json; ?>');
	<?php } else {?>
	var composition = [];	
	<?php } ?>
	<?php if(!empty($unit_json)){?>
	var unit = $.parseJSON('<?php echo $unit_json; ?>');
	<?php } else {?>
	var unit =[];	
	<?php } ?>

	
	
	
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
               //alert(id);
                var ur = "<?php echo $url1; ?>&id="+id;
                window.open(ur,"_self")    
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
			//$('#bill_disc_flat').val(obj[tablet_id]['discountvalueperquantity']);
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
	
	
	function CalculatedAmoumt(return_qty,event) 
	{
		var keycode = (event.keyCode ? event.keyCode : event.which);
		
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
				var gst=parseFloat(obj[tablet_id]['gstvalue']/issue_qty).toFixed(3);
				
				
				gst=parseFloat(gst*return_qty);
				//var bill_disc_flat=parseFloat(obj[tablet_id]['discountvalueperquantity']);
				
				//new code 
				
				var bill_disc=$('#bill_disc').val();
				if(bill_disc !== '')
				{
					if(!isNaN(mrp))
					{
						var calc_disc=parseFloat(mrp*return_qty)+gst;
					}
					
					var calculated_discount=(calc_disc*bill_disc)/100;
					$('#bill_disc_flat').val(calculated_discount);
					var bill_disc_flat=parseFloat(calculated_discount);
				}
				else
				{
					$('#bill_disc_flat').val('');
				}
				
				
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
					
					
				}
				
				if(isNaN($('#amount').val()))
				{
					$('#amount').val('');
				}
			}
		}  
		
		if(keycode === 13)
		{
			$('#add_to_grid').focus();
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
$('#total_paid_amount').val('');
$('#total_discountvaluetype').val('');
$('#round_off').val('');


var gst=parseFloat(obj[tablet_id]['gstvalue']/issue_qty).toFixed(3);
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


if(obj[tablet_id]['new_mrp_perunit'] !== null)
{
var mrp_per_qty=obj[tablet_id]['new_mrp_perunit'];
}
else
{
var mrp_per_qty=0;	
}


//DISCOUNT VALUE
var discount_flat='';
var discount_percent='';


/*if(obj[tablet_id]['discountvalueperquantity'] != '')
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
}*/
var bill_disc=parseFloat($('#bill_disc').val());
var bill_disc_flat=parseFloat($('#bill_disc_flat').val());

if(!isNaN(bill_disc) && !isNaN(bill_disc_flat))
{
	discount_percent=bill_disc;
	discount_flat=bill_disc_flat;
}
else
{
	bill_disc=0;
}

//GST VALUE
var igst_percent=0;
var igst_value=0;
var cgst_percent=parseFloat(obj[tablet_id]['cgst_percent']);
var cgst_value=parseFloat(parseFloat(gst/2));
var sgst_percent=parseFloat(obj[tablet_id]['sgst_percent']);
var sgst_value=parseFloat(parseFloat(gst/2));


	
	
var markup = "<tr  class='save_data_table' data-id="+tablet_id+" id='table_del"+tablet_id+"'>"
+"<td class='td-product'><div class='trunctext'>"+product_name+"</div></td><td class='td-batch' style='width:4%;text-align:center;'>"+batchnumber+"</td><td style='width:8%;'>"+expire_date_id+"</td>"
+"<td style='width:5%;' class='quantity_add text-center' id='quantity_add"+tablet_id+"'>"+required_id+"</td><td style='width:7%;'id='unit_value_medicine"+tablet_id+"'>"+unit_value+"</td>"
+"<td class='td-price'><input type='hidden' name='medicine_type_ins[]' id='medicine_type_ins"+tablet_id+"' value='"+unit_value+"'>"
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
+"<input type='hidden' readonly name='price[]' class='disctxt price_mrp text-right w-53' data_price_mrp="+tablet_id+" value="+price_per_quantity+" id="+'price'+tablet_id+">"
+"<input type='text' readonly name='mrp_individual_price[]' class='disctxt mrp_individual_price text-right w-53' data_price_mrp="+tablet_id+" value="+mrp_per_qty+" id="+'mrp_individual_price'+tablet_id+"></td>"
+"<td class='td-dis-val'><div class='input-group'> <input type='text' value='"+discount_percent+"' name='discount_value[]' data_disc_value='"+tablet_id+"' id='enabledisc"+tablet_id+"'  class='enabledisc disctxt w-53' readonly></div></td>"
+"<td class='td-dis-amt'><div class='input-group'> <input type='text' value='"+discount_flat+"' name='discountext_value[]' id='disc_amount"+tablet_id+"' class='add_discount text-right disctxt w-53' readonly>"
+"</div></td>"

+"<td class='td-cgst-percent'><input type='hidden' class='form-control' data_gst_percent='"+tablet_id+"' name='gst_percent[]' id='gst_percent"+tablet_id+"' value='"+gst_sale_percent+"' readonly><input type='text' value='"+cgst_percent+"' class='w-53 disctxt cgst_percent text-right' name='cgst_percent[]' data_cgst_percent='"+tablet_id+"' id='cgst_percent"+tablet_id+"' readonly></td>"
+"<td class='td-cgst-amt'><input type='text' value='"+cgst_value.toFixed(3)+"' class='w-53 disctxt cgst_value text-right' name='cgst_value[]' data_cgst_value='"+tablet_id+"' id='cgst_value"+tablet_id+"' readonly></td>"
+"<td class='td-sgst-percent'><input type='text'  class='w-53 disctxt sgst_percent' value='"+sgst_percent+"' name='sgst_percent[]' data_sgst_percent='"+tablet_id+"' id='sgst_percent"+tablet_id+"' readonly></td>"
+"<td class='td-sgst-amt'><input type='text' value='"+sgst_value.toFixed(3)+"' class='w-53 sgst_value text-right disctxt' name='sgst_value[]' data_sgst_value='"+tablet_id+"' id='sgst_value"+tablet_id+"' readonly></td>"
+"<td class='td-total'><input type='text'  class='disctxt w-53 total_amt_cal text-right' value='"+total_amount+"' name='total_amt_cal[]' data_total='"+tablet_id+"' id='total_amount"+tablet_id+"' readonly>"
+"<input type='hidden'  class='form-control reduired_qty_hidden text-right' name='reduired_qty_hidden[]' data_total='"+tablet_id+"' value="+required_id+" id='reduired_qty_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control price_hidden text-right' name='price_hidden[]' data_total='"+tablet_id+"' id='price_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control cgst_percentage_hidden text-right' name='cgst_percentage_hidden[]' data_total='"+tablet_id+"' id='cgst_percentage_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control cgst_value_hidden text-right' name='cgst_value_hidden[]' data_total='"+tablet_id+"' id='cgst_value_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control sgst_percentage_hidden text-right' name='sgst_percentage_hidden[]' data_total='"+tablet_id+"' id='sgst_percentage_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control sgst_value_hidden text-right' name='sgst_value_hidden[]' data_total='"+tablet_id+"' id='sgst_value_hidden"+tablet_id+"'>"
+"<input type='hidden'  class='form-control total_amt_cal1 text-right' name='total_amt_cal1[]' data_total='"+tablet_id+"' id='total_amount1"+tablet_id+"'></td>"
+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tablet_id+" id='delrow"+tablet_id+"'><i class='fa fa-remove'></i></button></td></tr>";
																																																	
$("#fetch_update_data").append(markup);
 $( "#fetch_update_data" ).scrollTop(200); 
											
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

//new code 15/11/2018
var round_off_value=Math.round(total_net_amount.toFixed(2));
$('#total_paid_amount').val(round_off_value);
$('#total_discountvaluetype').val(bill_disc);	
if(total_net_amount > round_off_value)
{
	var round_off=total_net_amount - round_off_value;
	$('#round_off').val(round_off.toFixed(2));
}
else if(total_net_amount < round_off_value)
{
	var round_off= round_off_value - total_net_amount;
	$('#round_off').val(round_off.toFixed(2));
}
		
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

    var res=parseFloat($('#total_gst_amount').val())-parseFloat(total_gst_val);

    $('#total_gst_amount').val(parseFloat(res).toFixed(2));

    var ressubtotal =parseFloat($('#total_sub_total').val())-parseFloat(total_sub_total);
    $('#total_sub_total').val(parseFloat(ressubtotal).toFixed(2));

    var netamounttotal=parseFloat($('#total_net_amount').val())-parseFloat(total_net_total);

    $('#total_net_amount').val(parseFloat(netamounttotal).toFixed(2));


    var sub_total_amount=parseFloat($('#treatmentoverall-overalltotal').val())-parseFloat(total_sub_total);
    $('#treatmentoverall-overalltotal').val(parseFloat(sub_total_amount).toFixed(2));
   
    $('#no_of_items').val($("#fetch_update_data tr").length-item_less); 
   // $('#no_of_items').val(parseFloat($('#no_of_items').val())-length_arr);
    $('#treatmentoverall-overalldiscountpercent').val();
    $('#treatmentoverall-overalldiscountamount').val();
    
    
    //var total_amount=Math.round(parseFloat($('#total_amount'+data_addid).val()));
   	var total_paid_amount=Math.round(netamounttotal);
   	
   	$('#total_paid_amount').val(total_paid_amount);
   	
    
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
	        	if(confirm('Are You Sure to return bill ?')) 
	        	{
	        		$("#saved_val").val(1);
		  			if(onetimesave === 1)
		   			{
						$.ajax({
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/opreturns&id=";?>"+encodeURIComponent(url_id),
				            data: $("#bill_returns").serialize(),
				            success: function (result) 
				            { 
				            	var obj = $.parseJSON(result);
				            	if(obj[0] === 'Saved')
				            	{
		                    		$("#saved_val").val(obj[1]);
				            		$('.save_billing').attr('disabled','disabled');
				            		var url='<?php echo Yii::$app->homeUrl ?>?r=sales/returntabletbill&id='+obj[1];
			 						window.open(url,'_blank');
				            	}
				            }
						});
						onetimesave=2;
		      		}
				}
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
		$("#wrapper").addClass("enlarged");
        $("#wrapper").addClass("forced");   			
    
        $("ul.list-unstyled").css("display","none");
		$("body").on('keypress', '.number', function (e) 
		{
		   //if the letter is not digit then display error and don't type anything
		   if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		   {
		      return false;
		   }
      	});
      	
      	
      	$('.save_billing').keydown(function(event) {
          if (event.keyCode == 13 || event.keyCode == 32) 
          {
             event.preventDefault();
             return false;
          }
        });
      	$('#balance_amount').val('');
      	<?php if($sales['due_amt'] != ''){?>
      	$('#balance_amount').val('<?php echo $sales['due_amt']; ?>');
      	<?php }else{ ?>
      	$('#balance_amount').val('');
      	<?php } ?>
	});
	
	
	
	function RemoveAll()
	{
		$('#fetch_update_data tr').remove();
		$('.clear_field').val('');
		var url='<?php echo Yii::$app->homeUrl ?>?r=sales/opreturns&id=';
		window.open(url,"_self");
	}
	
	
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) 
    {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's': 

              event.preventDefault();
            var  saved_val = $("#saved_val").val(); 
              if(saved_val===""){
              SavedReturnTablet();
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
           	RemoveAll();
            break;
        }
    }
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
