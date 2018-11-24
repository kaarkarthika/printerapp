<?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   use yii\helpers\Url;
   $this->title="Create Stock";
   
   ?>


<script type="text/javascript" src="<?php echo Url::base(); ?>/date_pick_dmc/js/jquery.plugin.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/date_pick_dmc/js/jquery.datepick.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/date_pick_dmc/css/jquery.datepick.css" />

<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>




<style>
   #load{display: none;position: fixed;left: 128px;top: 27px;width: 100%;height: 100%;z-index: 9999;/*opacity: 0.6;*/margin-top: 20%; }
   input.error{background: rgb(251, 227, 228);border: 1px solid #fbc2c4;color: #8a1f11;}
   #wrapper,.content-page{
   overflow:unset;
   }
    table.table.thf-11>tbody>tr>td{
	   padding:1px!important;
   }

</style>
<div class="">
   <!-- container -->
   <!-- <div class="row">
      <div class="col-sm-12">
      <div class="btn-group pull-right m-t-15">
      </div>
      <!--h4 class="page-title"> <?= Html::encode($this->title) ?></h4-->
   <!--ol class="breadcrumb">
      <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
      <li><a href="#"><?php echo $this->title;?></a></li>
      <a class='btn btn-primary' style="float: right;" title="Stock Grid Table" href="<?php echo Yii::$app->homeUrl . "?r=stockmaster/index";?>">Grid</a>	
      
      	<a class='btn btn-primary' style="float: right;" title="Add Product Group" href="<?php echo Yii::$app->homeUrl . "?r=productgrouping/create";?>">Group</a>	
      </ol 
      </div>  
      </div>  -->
   <div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>
   <div class="row" >
      <div class="">
         <!-- col-sm-12 -->
         <div class="">
            <!-- panel panel-border panel-custom -->
            <!-- <div class="panel-heading">
               </div> -->
            <div class="">
               <!-- .panel-body -->
               <?php $form = ActiveForm::begin([
                  'id'=>'addnewstock', 
                        //'action' => ['newstock'],
                        //'method' => 'post',
                  'options' => ['class' => ' '             ]
                        
                    ]); 
                   		$session = Yii::$app->session;
                  $role=$session['authUserRole'];
                  $companybranchid=$session['branch_id'];
                  
                  ?>
               <div class="col-sm-12">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="panel pd-panel h-118">
                           <div class="panel-heading pd-panel-head">SUPPLIER DETAILS</div>
                           <div class="panel-body pd-panel-body">
                              <div class=" ">
                                 <div class=" form-group col-sm-2  ">
                                    <label class="control-label  lbl-width">Supplier Name</label>
                                    <div class="input-group input-group-sm   ">	   			
                                    	<select id='vendorname' name='VENDORNAME' class='vendorname freezed form-control' required>
                                    	<option value=''></option>
                                    	<?php if(!empty($vendor)){ foreach($vendor as $key => $value){?>
                                    	<option value='<?php echo $value['vendorid']?>'><?php echo $value['vendorname']?></option>
                                    	<?php } }?>
                                    	</select>
                                       <!--input type="text" id=" " class="  ip-btn-style  f-11" name=" " required placeholder=" "-->
                                        								  		 					 
                                       <!--span class="ipt input-group-btn " value="click">
                                       <button type="button" class="btn inp btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                       </span-->   
                                    </div>
                                 </div>
								 <div class="  form-group col-sm-2">
                                    <label class="control-label   lbl-width">Address</label>
                                    <textarea class="  f-11  freezed form-control txtarea-max" readonly name="Address" id="address"></textarea>
                                 </div>
								 <div class=" form-group col-sm-2 ">
                                    <label class="control-label   lbl-width">Phone No</label>
                                    <input type="text" class="  h-20 f-11  freezed form-control" readonly name="PhoneNo" id="phone_no">
                                 </div>
								 <div class="  form-group col-sm-1 ">
                                    <label class="control-label   lbl-width">Invoice No</label>
                                    <input type="text" class=" form-control h-20 f-11  freezed" name="INVOICEBILL" id="invoice_bill" required>
                                 </div>
								 <div class=" form-group col-sm-2">
                                    <label class="control-label lbl-width">Invoice Date</label>
                                    <input type="text" class="form-control  h-20 f-11  freezed" name="INVOICEDATE" id="invoicedate" required>
                                 </div>
								 <div class="  form-group col-sm-1 ">
                                    <label class="control-label  lbl-width">PO No</label>
                                    <div class="input-group input-group-sm   ">	   			
                                       <input type="text" style="color:#0000ff;" id=" " class="  ip-btn-style f-11 " name=" " placeholder=" "> 								  		 					 
                                       <span class="ipt input-group-btn " value="click">
                                       <button type="button" class="btn inp btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                       </span>   
                                    </div>
                                 </div>
								  <div class="  form-group col-sm-2">
                                    <label class="control-label   lbl-width">  Date</label>
                                    <input type="text" class="form-control h-20   " name=" " id=" " required>
                                 </div>
								 
                              </div>
                              <div class="row">
                                 
                              </div>
                              <div class="row">
                                 
                              </div>
                           </div>
                        </div>
                     </div>
 
                    <!-- <div class="col-sm-3">
                        <div class="panel pd-panel ">
                           <div class="panel-body pd-panel-body">
                              <div class="row">
                                 <div class=" ">
                                    <label class="control-label col-sm-6 lbl-width">DC No</label>
                                    <input type="text" class="col-sm-6  h-20 f-11" name="" id="" value="">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class=" ">
                                    <label class="control-label col-sm-6 lbl-width">Security No</label>
                                    <input type="text" class="col-sm-6 h-20  f-11" name="" id="" value="">
                                 </div>
                              </div>
                           </div>
                           <div class="panel-heading pd-panel-head">GRN DETAILS</div>
                           <div class="panel-body pd-panel-body">
                              <div class="row">
                                 <div class=" ">
                                    <label class="control-label col-sm-6 lbl-width">Purchase Type:</label>                                    
									<select class="col-sm-6 h-20 f-11">
									  <option>Direct</option>
									</select>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class=" ">
                                    <label class="control-label col-sm-6 lbl-width">Challan Type</label>
                                    <select class="col-sm-6 h-20 f-11">
									  <option>Direct</option>
									  <option>Challan</option>
									  
									</select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="panel pd-panel h-118">
                           <div class="panel-body pd-panel-body">
                             
                              <div class="row">
                                 <div class=" ">
                                    <label class="control-label col-sm-6 lbl-width">Received By</label>
                                    <input type="text" class="col-sm-6 h-20 f-11 " name="" id="" value="">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class=" ">
                                    <label class="control-label col-sm-6 lbl-width">GRN No</label>
                                    <input type="text" class="col-sm-6 h-20 f-11" name="" id="" value="">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>-->
                  </div>
                  <div class=" ">
                     <div class="panel pd-panel">
                        <div class="panel-heading pd-panel-head">ITEM GRID</div>
                        <div class="panel-body  pd-panel-body">
                           <table class="table table-bordered table-striped tbl-scrol thf-11" id="tbUser">
                              <thead>
                                 <tr>
                                    <th style="width:6%"></th>
                                    <th style="width:18%">Item Name</th>
                                    <th style="width:4%">Quantity</th>
                                    <th style="width:4%">Free<br>Quantity</th>
                                    <th style="width:4%">Pack</th>
                                    <th style="width:4%">Total<br>Unit</th>
                                    <th style="width:6%">Rate/Pack</th>
                                    <th style="width:6%">Batch No</th>
                                    <th style="width:6%">Expired<br>Date</th>
                                    <th style="width:4%">Dis<br>(%)</th>
                                    <th style="width:4%">Dis<br>(AMT)</th>
                                    <th style="width:4%">GST<br>(%)</th>
                                    <th style="width:4%">GST<br>(AMT)</th>
                                    <th style="width:6%">MRP</th>
                                    <th style="width:6%">Total<br>Amount</th>
                                 </tr>
                              </thead>
                              <tbody id='tbody_fetch'>
                              	<tr id='tr_fetch_table1' class="tr_fetch_table" data-id='1'>
                                 <td style="width:6%"><button type="button" onclick='Add_Grid();' class="freezed add_grid btn btn-xs btn-success">Add</button>
                                    <button type="button" data-id='1' onclick='Del_Grid(1);' class="freezed del_grid btn btn-xs btn-success">Del</button>
                                 </td>
                                 
                                 <td style="width:18%">
                                    <div class="  ">	   		<!--input-group input-group-sm -->	
                                       <!--input type="text" id=" " class="  ip-btn-style f-11 " name=" " required placeholder=" "-->
                                       <select id='product_name1' name="PRODUCT_NAME[]" style="width: 280px;" data-id='1' class='product_name  freezed form-control tabind ' required>
                                       	
                                       </select> 								  		 					 
                                       <!--span class="ipt input-group-btn " value="click">
                                       <button type="button" class="btn inp btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                       </span-->   
                                    </div>
                                 </td>
                                 <td style="width:4%"><input type="text" id="quantity1" data-id='1' required onkeypress="return isNumberKey(event);" onkeyup='Quantity(this.value,event,1);' class=" freezed quantity text-right ip-btn-style f-11" name="QUANTITY[]"></td>
                                 <td style="width:4%"><input type="text" id="free_quantity1" data-id='1'  onkeypress="return isNumberKey(event);" onkeyup='FreeQuantity(this.value,event,1);' class=" freezed free_quantity text-right ip-btn-style f-11" name="FREE_QUANTITY[]"></td>
                                 <td style="width:4%"><input type="text" id="pack_size1" data-id='1' required readonly required onkeypress="return isNumberKey(event);" class=" freezed pack_size text-right ip-btn-style f-11" name="PACK_SIZE[]"></td>
                                 <td style="width:4%"><input type="text" id="total_unit1" data-id='1' readonly required onkeypress="return isNumberKey(event);" class=" freezed total_unit text-right ip-btn-style f-11" name="TOTAL_UNIT[]"></td>
                                 <td style="width:6%"><input type="text" id="rate_per_unit1" data-id='1'  required onkeypress="return isNumberKey(event);" onkeyup='RateCalculation(this.value,event,1);' class=" freezed rate_per_unit text-right ip-btn-style f-11" name="RATE_PER_UNIT[]"></td>
                                 <td style="width:6%"><input type="text" id="batch_no1" data-id='1'  required  class=" freezed batch_no ip-btn-style f-11" name="BATCH_NO[]"></td>
                                 <td style="width:6%"><input type="text" id="expired_date1" data-id='1'  required onkeypress="return isNumberKey(event);" class=" freezed expired_date ip-btn-style f-11" name="EXPIRED_DATE[]"></td>
                                 <td style="width:4%"><input type="text" id="discount_percent1" data-id='1' onkeypress="return isNumberKey(event);" onkeyup='DiscountCalculation(this.value,event,1);' class=" freezed discount_percent text-right ip-btn-style f-11" name="DISCOUNT_PERCENT[]"></td>
                                 <td style="width:4%"><input type="text" id="discount_amount1" data-id='1' readonly onkeypress="return isNumberKey(event);" class=" freezed discount_amount text-right ip-btn-style f-11" name="DISCOUNT_AMOUNT[]"></td>
                                 <td style="width:4%"><input type="text" id="gst_percent1" data-id='1' required readonly onkeypress="return isNumberKey(event);" class=" freezed gst_percent text-right ip-btn-style f-11" name="GST_PERCENT[]"></td>
                                 <td style="width:4%"><input type="text" id="gst_amount1" data-id='1' readonly onkeypress="return isNumberKey(event);" class=" freezed gst_amount text-right ip-btn-style f-11" name="GST_AMOUNT[]"></td>
                                 <td style="width:6%"><input type="text" id="mrp1" data-id='1' required onkeypress="return isNumberKey(event);" class=" freezed mrp ip-btn-style text-right f-11" name="MRP[]"></td>
                                 <td style="width:6%"><input type="text" id="total_amount1" data-id='1' required readonly onkeypress="return isNumberKey(event);" class=" freezed total_amount text-right ip-btn-style f-11" name="TOTALAMOUNT[]">
                                 					  <input type="hidden" id="sub_total_amount1" data-id='1'  class="sub_total_amount text-right ip-btn-style f-11" name="SUBTOTALAMOUNT[]">
                                 </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class=" row">
                     <div class="col-sm-6">
                        <div class="panel pd-panel  ">
                           <div class="panel-heading pd-panel-head">FINANCIAL  DETAILS</div>
                           <div class="panel-body pd-panel-body">
                              <div class="row">
                                 <div class=" form-group col-sm-3 ">
                                    <label class="control-label  lbl-width">SUB TOTAL</label>
                                    <input type="text" class=" freezed form-control   h-20 text-right" required readonly name="OverallSubTotal" id="overall_sub_total" >
                                 </div>
								 <div class=" form-group col-sm-3">
                                    <label class="control-label  lbl-width">DISCOUNT AMOUNT</label>
                                    <input type="text" class=" freezed form-control     text-right" readonly name="DiscountAmount" id="discount_amount">
                                 </div>
								 <div class="form-group col-sm-3 ">
                                    <label class="control-label  lbl-width">GST AMOUNT</label>
                                    <input type="text" class=" freezed form-control     text-right" required readonly name="OVERALLGSTAMOUNT" id="overall_gst_amount">
                                 </div>
								 <div class="form-group col-sm-3 ">
                                    <label class="control-label  lbl-width">TOTAL EXPENSES</label>
                                    <input type="text" class=" freezed form-control    text-right" name="TOTALEXPENSES" id="total_expenses">
                                 </div>
                               
                                  <div class="form-group col-sm-3">
                                    <label class="control-label  lbl-width">NET AMOUNT</label>
                                    <input type="text" class=" freezed form-control     text-right" required readonly name="NETAMOUNT" id="overall_net_amount">
                                 </div>
								 <div class="form-group col-sm-3">
                                    <label class="control-label   lbl-width">ROUND OFF</label>
                                    <input type="text" class=" freezed form-control  text-right" readonly name="ROUNDOFF" id="round_off">
                                 </div>
								 <div class="form-group col-sm-3">
                                    <label class="control-label   lbl-width">TOTAL AMOUNT</label>
                                    <input type="text" class=" freezed form-control     text-right" required readonly name="OVERALLTOTALAMOUNT" id="overalltotalamount">
                                 </div>
								 
                              </div>
                              
                           </div>
                        </div>
                     </div>
					 
					 <div class="col-sm-4">
					   <div class="panel pd-panel  ">
                           <div class="panel-heading pd-panel-head">SEARCH</div>
                           <div class="panel-body pd-panel-body">
					            
							  <!-- FROM DATE -->
							  <div class="row">							 
					           <div class="form-group col-sm-6">
                                  <label>From</label>                          
                                  <input type='text' class="form-control   input-sm fromDate  " id='' onkeyup=" "  name="fromDate"   required>                                                                                                              
					           </div>
					           
					          <!-- TO DATE -->
					          				   
					           <div class="form-group col-sm-6">
                               <label>To</label>                             		           
                                    <input type='text' class="form-control toDate " id='' onkeyup=" " name="toDate" required>  
                              </div>					 
					        </div>
							<div class=" ">
							 <div class="form-group">
							 <button type="button" class="btn btn-primary b1-width  freezed">Search</button>
							 </div>
							</div>
					       
					       </div>
					 </div>
					 </div>
					 
					 <div class="col-sm-2">
					     <div class="form-group ">
						     <div class="form-group col-sm-6"><button type="button" class="btn btn-primary b1-width  freezed" onclick='SaveRegisterForm();' id='save_button' >Save</button></div>
						     <div class="form-group col-sm-6"><button type="button" class="btn btn-primary b1-width  freezed">Delete</button></div>
						 </div>
						 
						  <div class="form-group ">
						     <div class="form-group col-sm-6"> <button type="button" class="btn btn-primary b1-width ">Clear</button></div>
						     <div class="form-group col-sm-6"><button type="button" class="btn btn-primary b1-width  freezed">Close</button></div>
						 </div>
					  
					 </div>
					 
					 
                      
                  </div>
               </div>
              <!-- <div class="col-sm-12  text-right">
                  <div class="row">
                     <div class="form-group ">
                        <button type="button" class="btn btn-primary b1-width  freezed" onclick='SaveRegisterForm();' id='save_button' >Save</button>
                        <button type="button" class="btn btn-primary b1-width  freezed">Delete</button>
                         <button type="button" class="btn btn-primary b1-width ">Clear</button>
                          <button type="button" class="btn btn-primary b1-width  freezed">Close</button>
                            
                     </div>
                  </div>
                 
               </div>  -->
            </div>
         </div>
      </div>
   </div>
 
</div>
<?php ActiveForm::end(); ?>
<div id="formdetails"></div>
</div>       
</div>
</div>
</div>
</div>
<script type="text/javascript" src="js/shortcut.js" ></script>
<script>

var vendor_json=$.parseJSON('<?php echo $vendor_branch_json;?>');

$(document).ready(function(){
   	 
$("#wrapper").addClass("enlarged");
$("#wrapper").addClass("forced");   			
$("ul.list-unstyled").css("display","none");   

$("#vendorname").select2({ placeholder: "SLECT VENDORNAME"});
$('#vendorname').bind('change keyup',function () {
 
//get value of selected option
var value = $(this).children("option:selected").attr('value');

// do something here
if(value !== '')
{
	
	if(vendor_json[value]['address1'] !== null)
	{
		$('#address').val(vendor_json[value]['address1']);
	}
	else if(vendor_json[value]['address1'] === null)
	{
		$('#address').val('');
	}
	if(vendor_json[value]['branch_phonenumber'] !== null)
	{
		$('#phone_no').val(vendor_json[value]['branch_phonenumber']);
	}
	
}
}).change();


var current_date = new Date();
var dd = parseInt(current_date.getUTCDate());
var mm  = parseInt(current_date.getUTCMonth()+1);
var yy = parseInt(current_date.getUTCFullYear());
$('#invoicedate').val(dd+'-'+mm+'-'+yy);



});

$('#invoicedate').datepick({
	dateFormat: 'dd-mm-yyyy'
	});

    $('.fromDate').datepick({
	  dateFormat: 'dd-mm-yyyy'
	});
	
    $('.toDate').datepick({
		useCurrent: false,
	 dateFormat: 'dd-mm-yyyy'
	});	
	
	$(".fromDate").on("dp.change", function (e) {
           $('.toDate').data("DateTimePicker").minDate(e.date);
       });
       $(".toDate").on("dp.change", function (e) {
           $('.fromDate').data("DateTimePicker").maxDate(e.date);
       });
	
   
jQuery(document).ready(function($){

$("body").on('click', '.product_name', function () 
{

var data_id=$(this).attr('data-id');
	
$('#product_name'+data_id).select2({
   minimumInputLength: 1,
    tags: [],
    ajax: {
        url: '<?php echo Yii::$app->homeUrl . "?r=stockmaster/productfetchselect";?>',
        dataType: 'json',
        type: "GET",
        quietMillis: 50,
        data: function (term) {
            return {
                term: term
            };
        },
        results: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.text,
                        id: item.id
                    }
                })
            };
        }
    }
});

$('.product_name').bind('change keyup',function () {
 
//get value of selected option
var value = $(this).children("option:selected").attr('value');
var data_id=$(this).attr('data-id');
// do something here
if(value !== undefined)
{
$.ajax({
    type: "POST",
    url: "<?php echo Yii::$app->homeUrl . "?r=stockmaster/singleproductfetchselect&id=";?>"+value,
    success: function (result) 
    { 
    	var obj = $.parseJSON(result);
    	
    	//ClearTableValue(data_id);
    	
    	
    	
    	$('#quantity'+data_id).focus();
    	
    	if(obj[1]['no_of_unit'] !== null)
    	{
    		$('#pack_size'+data_id).val(obj[1]['no_of_unit']);
    	}
    	else if(obj[1] === null)
    	{
    		Alertment('Pls Choose Pack Size in Product Master');
    	}
    	
    	if(obj[3]['tax'] !== null)
    	{
    		$('#gst_percent'+data_id).val(obj[3]['tax']);
    	}
    	else if(obj[3] === null)
    	{
    		Alertment('Check GST Percentage Not Fetched');
    		
    	}
    	
    	
    	
    	
    }
});	
}
 
}).change();








});


$("body").on('mouseenter', '.expired_date', function () 
{
var data_id=$(this).attr('data-id');
$('#expired_date'+data_id).datepick({
	dateFormat: 'dd-mm-yyyy',
	minDate: 0
	});

});

});


function Quantity(value,event,data_id)
{
var keycode = (event.keyCode ? event.keyCode : event.which);

if(keycode !== 9)
{
	var datavalue=parseFloat(value);
	var pack_size=parseInt($('#pack_size'+data_id).val());
	var free_quantity=parseFloat($('#free_quantity'+data_id).val());
	if(isNaN(pack_size))
	{
		$('#quantity').val('');
		Alertment('Choose Pack Size');
		return false;	
	}
	
	if(isNaN(free_quantity))
	{
		free_quantity=0;
	}
		
	if(!isNaN(datavalue))
	{
		if(datavalue !== 0)
		{
			var mul=parseFloat(pack_size*(datavalue+free_quantity));
			$('#total_unit'+data_id).val(mul);
		}
	}
	else if(isNaN(datavalue))
	{
		if(!isNaN(free_quantity))
		{
			if(free_quantity !== 0)
			{
				var mul=parseFloat(pack_size*free_quantity);
				$('#total_unit'+data_id).val(mul);
			}
			else
			{
				$('#total_unit'+data_id).val('');
			}
		}
		else
		{
			$('#total_unit'+data_id).val('');
		}
	}
}
}

function FreeQuantity(value,event,data_id)
{
var keycode = (event.keyCode ? event.keyCode : event.which);

if(keycode !== 9)
{
	var datavalue=parseFloat(value);
	var pack_size=parseInt($('#pack_size'+data_id).val());
	var quantity=parseFloat($('#quantity'+data_id).val());
	if(isNaN(pack_size))
	{
		$('#free_quantity').val('');
		Alertment('Choose Pack Size');
		return false;	
	}
	
	if(isNaN(quantity))
	{
		quantity=0;
	}
		
	if(!isNaN(datavalue))
	{
		if(datavalue !== 0)
		{
			var mul=parseFloat(pack_size*(datavalue+quantity));
			$('#total_unit'+data_id).val(mul);
		}
	}
	else if(isNaN(datavalue))
	{
		if(!isNaN(quantity))
		{
			if(quantity !== 0)
			{
				var mul=parseFloat(pack_size*quantity);
				$('#total_unit'+data_id).val(mul);
			}
			else
			{
				$('#total_unit'+data_id).val('');
			}
		}
		else
		{
			$('#total_unit'+data_id).val('');
		}
		
	}
}
}


function RateCalculation(value,event,data_id)
{
var keycode = (event.keyCode ? event.keyCode : event.which);

if(keycode !== 9)
{
	var datavalue=parseFloat(value);
	var pack_size=parseInt($('#pack_size'+data_id).val());
	var quantity=parseFloat($('#quantity'+data_id).val());
	var gst_percent=parseFloat($('#gst_percent'+data_id).val());
	
	
	
	if(isNaN(pack_size))
	{
		$('#rate_per_unit'+data_id).val('');
		Alertment('Choose Pack Size');
		return false;	
	}
	
	if(isNaN(quantity))
	{
		$('#rate_per_unit'+data_id).val('');
		Alertment('Choose Quantity');
		return false;	
	}
	
	if(isNaN(gst_percent))
	{
		$('#rate_per_unit'+data_id).val('');
		Alertment('GST cannot be Empty');
		return false;	
	}
	
	if(!isNaN(datavalue))
	{
		var calculation=parseFloat(datavalue*quantity);
		
		var gst_calc=(gst_percent*calculation)/100;
		
		var cal=parseFloat(gst_calc+calculation);
		
		$('#gst_amount'+data_id).val(gst_calc.toFixed(2));
		$('#total_amount'+data_id).val(cal.toFixed(2));
		$('#sub_total_amount'+data_id).val(calculation.toFixed(2));
	}
	else if(isNaN(datavalue))
	{
		$('#discount_percent'+data_id).val('');
		$('#discount_amount'+data_id).val('');
		$('#gst_amount'+data_id).val('');
		$('#total_amount'+data_id).val('');
		$('#sub_total_amount'+data_id).val('');
	}
	TotalCalculationAmount();
}


	
}



function DiscountCalculation(value,event,data_id)
{
var keycode = (event.keyCode ? event.keyCode : event.which);
if(keycode !== 9)
{
	var datavalue=parseFloat(value);
	var pack_size=parseInt($('#pack_size'+data_id).val());
	var quantity=parseFloat($('#quantity'+data_id).val());
	var gst_percent=parseFloat($('#gst_percent'+data_id).val());
	var rate_per_unit=parseFloat($('#rate_per_unit'+data_id).val());
	var total_amount=parseFloat($('#total_amount'+data_id).val());
	var hidden_sub_total=parseFloat($('#sub_total_amount').val());
	
	
	
	if(isNaN(pack_size))
	{
		$('#rate_per_unit'+data_id).val('');
		Alertment('Choose Pack Size');
		return false;	
	}
	
	if(isNaN(quantity))
	{
		$('#rate_per_unit'+data_id).val('');
		Alertment('Choose Quantity');
		return false;	
	}
	
	if(isNaN(gst_percent))
	{
		$('#rate_per_unit'+data_id).val('');
		Alertment('GST cannot be Empty');
		return false;	
	}
	
	if(isNaN(rate_per_unit))
	{
		$('#rate_per_unit'+data_id).val('');
		Alertment('Rate cannot be Empty');
		return false;	
	}
	
	if(datavalue > 100)
	{
		
		$('#discount_percent'+data_id).val('');
		var calculation=parseFloat(rate_per_unit*quantity);
			var gst_calca=(gst_percent*calculation)/100;
			var calz=parseFloat(gst_calca+calculation);
			$('#gst_amount'+data_id).val(gst_calca.toFixed(2));
			$('#total_amount'+data_id).val(calz.toFixed(2));
			$('#sub_total_amount'+data_id).val(calculation.toFixed(2));
			$('#discount_amount'+data_id).val('');
		Alertment('Discount Percentage Not Greater than 100%');
		return false;
	}
	
	if(!isNaN(datavalue))
	{
		if(datavalue === 0)
		{
			var calculation=parseFloat(rate_per_unit*quantity);
			var gst_calca=(gst_percent*calculation)/100;
			var calz=parseFloat(gst_calca+calculation);
			$('#gst_amount'+data_id).val(gst_calca.toFixed(2));
			$('#total_amount'+data_id).val(calz.toFixed(2));
			$('#sub_total_amount'+data_id).val(calculation.toFixed(2));
			$('#discount_amount'+data_id).val('');
		}
		else if(datavalue !== 0)
		{
			var calculation=parseFloat(rate_per_unit*quantity);
			var gst_calca=(gst_percent*calculation)/100;
			var calz=parseFloat(gst_calca+calculation);
			
			
			var calculated=(datavalue*calz)/100;
			var calculated_subtotal=(datavalue*calculation)/100;
			//alert(total_amount);
			
			var sub=calz - calculated;
			$('#total_amount'+data_id).val(sub.toFixed(2));
			$('#discount_amount'+data_id).val(calculated_subtotal.toFixed(2));
			
			//gst_amount
			var gst_discount=(gst_calca*datavalue)/100;
			if(gst_discount < 0)
			{
				var subtract_gst_amount=0;
				$('#gst_amount'+data_id).val(subtract_gst_amount.toFixed(2));
			}
			else
			{
				var subtract_gst_amount=gst_calca - gst_discount;
				$('#gst_amount'+data_id).val(subtract_gst_amount.toFixed(2));
			}
			
		
		}
	}
	else if(isNaN(datavalue))
	{
		
		var calculation=parseFloat(rate_per_unit*quantity);
		var gst_calca=(gst_percent*calculation)/100;
		var calz=parseFloat(gst_calca+calculation);
		$('#gst_amount'+data_id).val(gst_calca.toFixed(2));
		$('#total_amount'+data_id).val(calz.toFixed(2));
		$('#sub_total_amount'+data_id).val(calculation.toFixed(2));
		$('#discount_amount'+data_id).val('');
	}
	TotalCalculationAmount();
}	

}


function ClearTableValue(data_id)
{
	$('#free_quantity'+data_id).val(0);
	$('#pack_size'+data_id).val('');
	$('#total_unit'+data_id).val('');
	$('#rate_per_unit'+data_id).val(0);
	$('#batch_no'+data_id).val('');
	$('#expired_date'+data_id).val('');
	$('#discount_percent'+data_id).val(0);
	$('#discount_amount'+data_id).val('');
	$('#gst_percent'+data_id).val('');
	$('#gst_amount'+data_id).val('');
	$('#mrp'+data_id).val('');
	$('#total_amount'+data_id).val('');
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



function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
         return false;

  return true;
}

var increment=1;
function Add_Grid()
{
	increment++;
	
var appended_text='<tr id="tr_fetch_table'+increment+'"  class="tr_fetch_table" data-id="'+increment+'"><td style="width:6%"><button type="button" data-id="'+increment+'" onclick="Add_Grid();" class=" freezed add_grid btn btn-xs btn-success">Add</button>  '+
'<button type="button" data-id="'+increment+'" onclick="Del_Grid('+increment+');" class=" freezed del_grid btn btn-xs btn-success">Del</button></td><td style="width:18%">'+
'<div class=""><select id="product_name'+increment+'" name="PRODUCT_NAME[]" style="width: 280px;" data-id="'+increment+'" class=" freezed product_name form-control tabind " required></select></div></td>'+
'<td style="width:4%"><input type="text" id="quantity'+increment+'" data-id="'+increment+'" required onkeypress="return isNumberKey(event);" onkeyup="Quantity(this.value,event,'+increment+');" class=" freezed quantity text-right ip-btn-style f-11" name="QUANTITY[]"></td>'+
'<td style="width:4%"><input type="text" id="free_quantity'+increment+'" data-id="'+increment+'"  onkeypress="return isNumberKey(event);" onkeyup="FreeQuantity(this.value,event,'+increment+');" class=" freezed free_quantity text-right ip-btn-style f-11" name="FREE_QUANTITY[]"></td>'+
'<td style="width:4%"><input type="text" id="pack_size'+increment+'" data-id="'+increment+'" readonly required onkeypress="return isNumberKey(event);" class=" freezed pack_size text-right ip-btn-style f-11" name="PACK_SIZE[]"></td>'+
'<td style="width:4%"><input type="text" id="total_unit'+increment+'" data-id="'+increment+'" readonly required onkeypress="return isNumberKey(event);" class=" freezed total_unit text-right ip-btn-style f-11" name="TOTAL_UNIT[]"></td>'+
'<td style="width:6%"><input type="text" id="rate_per_unit'+increment+'" data-id="'+increment+'" required  onkeypress="return isNumberKey(event);" onkeyup="RateCalculation(this.value,event,'+increment+');" class=" freezed rate_per_unit text-right ip-btn-style f-11" name="RATE_PER_UNIT[]"></td>'+
'<td style="width:6%"><input type="text" id="batch_no'+increment+'" data-id="'+increment+'" required  class=" freezed batch_no ip-btn-style f-11" name="BATCH_NO[]"></td>'+
'<td style="width:6%"><input type="text" id="expired_date'+increment+'" data-id="'+increment+'" required onkeypress="return isNumberKey(event);" class=" freezed expired_date ip-btn-style f-11" name="EXPIRED_DATE[]"></td>'+
'<td style="width:4%"><input type="text" id="discount_percent'+increment+'" data-id="'+increment+'" onkeypress="return isNumberKey(event);" onkeyup="DiscountCalculation(this.value,event,'+increment+');" class=" freezed discount_percent text-right ip-btn-style f-11" name="DISCOUNT_PERCENT[]"></td>'+
'<td style="width:4%"><input type="text" id="discount_amount'+increment+'" data-id="'+increment+'" readonly onkeypress="return isNumberKey(event);" class=" freezed discount_amount text-right ip-btn-style f-11" name="DISCOUNT_AMOUNT[]"></td>'+
'<td style="width:4%"><input type="text" id="gst_percent'+increment+'" data-id="'+increment+'" readonly  onkeypress="return isNumberKey(event);" class=" freezed gst_percent text-right ip-btn-style f-11" name="GST_PERCENT[]"></td>'+
'<td style="width:4%"><input type="text" id="gst_amount'+increment+'" data-id="'+increment+'" readonly onkeypress="return isNumberKey(event);" class=" freezed gst_amount text-right ip-btn-style f-11" name="GST_AMOUNT[]"></td>'+
'<td style="width:6%"><input type="text" id="mrp'+increment+'" data-id="'+increment+'" required onkeypress="return isNumberKey(event);" class=" freezed mrp ip-btn-style text-right f-11" name="MRP[]"></td>'+
'<td style="width:6%"><input type="text" id="total_amount'+increment+'" data-id="'+increment+'" readonly onkeypress="return isNumberKey(event);" class=" freezed total_amount text-right ip-btn-style f-11" name="TOTALAMOUNT[]">'+
'<input type="hidden" id="sub_total_amount'+increment+'" data-id="'+increment+'" class="sub_total_amount text-right ip-btn-style f-11" name="SUBTOTALAMOUNT[]"></td></tr>';

$('#tbody_fetch').append(appended_text);

}

function Del_Grid(value)
{
	var len_property=$('#tbody_fetch tr').length;
	if(len_property === 1)
	{
		
	}
	else
	{
		$('#tr_fetch_table'+value).remove();
		TotalCalculationAmount();
	}
}

function TotalCalculationAmount()
{

var total_amount=0;	
var sub_total=0;
var discount_amount=0;
var overall_gst_amount=0;
$('.tr_fetch_table').each(function ()
{	
	var data_table_id=$(this).attr('data-id');
	
	//total amount
	var total_amt=parseFloat($('#total_amount'+data_table_id).val());
	
	if(isNaN(total_amt))
	{
		total_amount=0+total_amount;
	}
	else if(!isNaN(total_amt))
	{
		total_amount=total_amt+total_amount;
	}
	
	//sub total amount
	var sub_total_amt=parseFloat($('#sub_total_amount'+data_table_id).val());
	
	if(isNaN(sub_total_amt))
	{
		sub_total=0+sub_total;
	}
	else if(!isNaN(sub_total_amt))
	{
		sub_total=sub_total_amt+sub_total;
	}
	
	//discount amount
	var discount_amount_total=parseFloat($('#discount_amount'+data_table_id).val());
	
	if(isNaN(discount_amount_total))
	{
		discount_amount=0+discount_amount;
	}
	else if(!isNaN(discount_amount_total))
	{
		discount_amount=discount_amount_total+discount_amount;
	}
	
	//gst amount
	var gst_amount=parseFloat($('#gst_amount'+data_table_id).val());
	
	if(isNaN(gst_amount))
	{
		overall_gst_amount=0+overall_gst_amount;
	}
	else if(!isNaN(gst_amount))
	{
		overall_gst_amount=overall_gst_amount+gst_amount;
	}
	
	
	
});

$('#overall_sub_total').val(sub_total.toFixed(2));
$('#discount_amount').val(discount_amount.toFixed(2));
$('#overall_gst_amount').val(overall_gst_amount.toFixed(2));
$('#overall_net_amount').val(total_amount.toFixed(2));

var round_off_amount=Math.round(total_amount.toFixed(2));
$('#overalltotalamount').val(round_off_amount.toFixed(2));
if(round_off_amount > total_amount)
{
	var sub=round_off_amount - total_amount;
	$('#round_off').val(sub.toFixed(2));
}
else if(round_off_amount < total_amount)
{
	var sub=total_amount - round_off_amount;
	$('#round_off').val(sub.toFixed(2));
}

}




function SaveRegisterForm()
{
var validated=$('#addnewstock').valid();	

if(validated === true)
{
$('.tr_fetch_table').each(function ()
{
	var data_id=$(this).attr('data-id');
	
	var product_name=$('#product_name'+data_id).val();
	
	if(product_name === null)
	{
		$('#product_name'+data_id).focus();
		alert('Product Not Empty');
		return false;
	}
	
	var quantity=$('#quantity'+data_id).val();
	quantity.trim();
	if(quantity === '')
	{
		$('#quantity'+data_id).focus();
		alert('Quantity Not Empty');
		return false;
	}
	
	var pack_size=$('#pack_size'+data_id).val();
	pack_size.trim();
	if(pack_size === '')
	{
		$('#product_name'+data_id).focus();
		alert('Pack Size Not Empty. Check in Product Master');
		return false;
	}
	
	var total_unit=$('#total_unit'+data_id).val();
	total_unit.trim();
	if(total_unit === '')
	{
		$('#total_unit'+data_id).focus();
		alert('Total Unit Not Empty.');
		return false;
	}
	
	var rate_per_unit=$('#rate_per_unit'+data_id).val();
	rate_per_unit.trim();
	if(rate_per_unit === '')
	{
		$('#rate_per_unit'+data_id).focus();
		alert('Rate/Pack Not Empty.');
		return false;
	}
	
	var batch_no=$('#batch_no'+data_id).val();
	batch_no.trim();
	if(batch_no === '')
	{
		$('#batch_no'+data_id).focus();
		alert('Batch Number Not Empty.');
		return false;
	}
	
	var expired_date=$('#expired_date'+data_id).val();
	expired_date.trim();
	if(expired_date === '')
	{
		$('#expired_date'+data_id).focus();
		alert('Expired Date Not Empty.');
		return false;
	}
	
	var gst_percent=$('#gst_percent'+data_id).val();
	gst_percent.trim();
	if(gst_percent === '')
	{
		$('#gst_percent'+data_id).focus();
		alert('GST Percent Not Empty.');
		return false;
	}
	
	var mrp=$('#mrp'+data_id).val();
	mrp.trim();
	if(mrp === '')
	{
		$('#mrp'+data_id).focus();
		alert('MRP Not Empty.');
		return false;
	}
	
	var total_amount=$('#total_amount'+data_id).val();
	total_amount.trim();
	if(total_amount === '')
	{
		$('#total_amount'+data_id).focus();
		alert('Total Amount Not Empty.');
		return false;
	}
});	
	

var form = $('#addnewstock');
var formData = form.serialize();
	
$.ajax({
	 type: "POST",
     url: "<?php echo Yii::$app->homeUrl . "?r=stockmaster/newstockmodule";?>",
     data: formData,
     success: function (result) 
     {
     	var obj=$.parseJSON(result);
     	if(obj[0] === 'save')
     	{
     		//$('.add_grid').attr('disabled','disabled');
     		//$('.del_grid').attr('disabled','disabled');
     		$('.freezed').attr('disabled','disabled');
     		//$('#save_button').attr('disabled','disabled');
     		Alertment('Stock Saved Sucessfully! Your Unique Number is '+obj[1]+'');
     	}
     }
  });		
	
	
	
}	
    
}




$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
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
        case 'a':
            event.preventDefault();
            Add_Grid();
            break;
        }
    }
});
</script>
 
