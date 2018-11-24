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

use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
   
  use yii\jui\AutoComplete;
use yii\web\JsExpression;
   
   $this->title = 'Modules';
    $session = Yii::$app->session;
  // print_r(Yii::$app->homeUrl);die;
   ?>
<!--<link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<script src="plugins/select2/select2.min.js" type="text/javascript"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
  
  
  <!-- Bootstrap files -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>


  
  <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
  
   <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>
  
  
  
  
 
<style>
   .fwidth{
   width:100%!important;}
   .input-group-btn select {
   border-color: #ccc;
   margin-top: 0px;
   margin-bottom: 0px;
   padding-top: 7px;
   padding-bottom: 7px;
   }
   .form-control:focus,input[type="checkbox"]:focus,.select2-container .select2-selection--single:focus {    border: 2px solid #5fbeaa!important;}
    .gross-area{
   background-color: #6c7a86;
   color: #fff;
   border-radius:10px;
   text-align: center;
   }
   .total-area{background-color: #f4f8fb;
   color: #6c7a86;}
	.panel-body{
		font-size:13px;
	}
	.panel-border .panel-body {
   /* padding: 0px 20px 20px 20px; */
}
.percent:after {content:none;}
.form-group {
   /*margin-bottom: 0px; */
}
   .panel-info > .panel-heading{
		background-color:#3e678a;
	}
	.scroll-modal{
		height: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
	}
	.input-group-btn:first-child>.btn{margin-right:-19px;}
	.bg-block{background-color: #ebeff2;
    padding: 10px;}
	.delrow{cursor:pointer;color:#ce5656;}
	.total-tr{background-color: #6c7a86!important;
    color: #fff;}
	span a.text-white{color:#fff;}
span a.text-white:hover{color:#ccc!important;}
.btn-tbl{padding: 0px;
    width: 50px;
    font-size: 13px;
	background-color:#fff;
	border:2px solid #5fbeaa;
	color:#000;}
	.mt-5{margin-top:5px;}
	.w-75{width:75px;}
	
	.total-netamt{text-align: center; font-size: 26px; color: #36404a;}
	
	.donate-now {
     list-style-type:none;
	 padding:unset;
     
}
.w-50{width:50px;}
.ft-12{font-size:12px;}
.disctxt{
	height:35px;
	/* width:100px; */
	border:1px solid #ccc;
	padding-left:5px;
}
.donate-now li {
     
     
   /* width:100px; */
    height:40px;
    position:relative;
}

.donate-now label, .donate-now input {
    display:block;
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
}

.donate-now input[type="radio"] {
    opacity:0.011;
    z-index:100;
}

.donate-now input[type="radio"]:checked + label {
   background: #5fbeaa;
    color: #fff;
}

.donate-now label {
     padding:5px;
     border:1px solid #CCC; 
     cursor:pointer;
    z-index:90;
}

.donate-now label:hover {
     background:#DDD;
}
	
	
	.table>tbody>tr>td{padding:7px!important;}	
	
	
	
	
	ul.typeahead.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  text-align: left;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
}
ul.typeahead.dropdown-menu.pull-right {
  right: 0;
  left: auto;
}
ul.typeahead.dropdown-menu .divider {
  height: 1px;
  margin: 9px 0;
  overflow: hidden;
  background-color: #e5e5e5;
}
ul.typeahead.dropdown-menu > li > a {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333333;
  white-space: nowrap;
}
ul.typeahead.dropdown-menu > li > a:hover,
ul.typeahead.dropdown-menu > li > a:focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
}
ul.typeahead.dropdown-menu > .active > a,
ul.typeahead.dropdown-menu > .active > a:hover,
ul.typeahead.dropdown-menu > .active > a:focus {
  color: #ffffff;
  text-decoration: none;
  outline: 0;
  background-color: #337ab7;
}
ul.typeahead.dropdown-menu > .disabled > a,
ul.typeahead.dropdown-menu > .disabled > a:hover,
ul.typeahead.dropdown-menu > .disabled > a:focus {
  color: #777777;
}
ul.typeahead.dropdown-menu > .disabled > a:hover,
ul.typeahead.dropdown-menu > .disabled > a:focus {
  text-decoration: none;
  background-color: transparent;
  background-image: none;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
  cursor: not-allowed;
}
.open > ul.typeahead.dropdown-menu {
  display: block;
}
.pull-right > ul.typeahead.dropdown-menu {
  right: 0;
  left: auto;
}
.dropup ul.typeahead.dropdown-menu,
.navbar-fixed-bottom .dropdown ul.typeahead.dropdown-menu {
  top: auto;
  bottom: 100%;
  margin-bottom: 1px;
}
.w-100{width:100px;}
@media (min-width: 768px) {
  .navbar-right ul.typeahead.dropdown-menu {
    left: auto;
    right: 0;
  }
}
ul.typeahead.dropdown-menu a,
ul.typeaheadul.typeahead.dropdown-menu a {
  text-decoration: none;
}
.modal-lg {
    width: 1200px;
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
      result = ''+days[day]+' '+','+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
      document.getElementById(id).innerHTML = result;
      setTimeout('date_time("'+id+'");','1000');
      return true;
   }
   
   
</script>

<div class="container"  >
   <div class="row">
   
      <div class="col-sm-12">
	  <span> <strong>BILL/DMC-234560</strong>  </span><strong><span class="pull-right" id="date_time"></span></strong>
         <div class="panel panel-border panel-custom">
            <div class="panel-heading text-right"></div>
            <div class="panel-body">
               <div class="row">
     
            	<?php $form = ActiveForm::begin(['id' => 'saved_data_value_ajax']); ?> 
    
                     <div class="col-sm-12">

                      	   
                        <div class="radio radio-info radio-inline">
		                                            <input type="radio" id="outPatient" class="outPatient" value="outpatient" name="patient" checked=""  >
		                                            <label for="inlineRadio1" id="outPatient">  Out-Patient <i><strong>[Alt+1]</strong></i> </label>
		                                        </div>
                       <div class="radio radio-info radio-inline">
		                                            <input type="radio" id="inPatient" class="inPatient" value="inpatient" name="patient"  >
		                                            <label for="inlineRadio1" id="inPatient"> In-Patient <i><strong>[Alt+2]<strong></i></label>
		                                        </div> 
												
												
						<span class=" pull-right hide"> <span><i>[Alt+3]</i></span>
						<a class=" btn btn-primary text-white hide" href="<?php echo Yii::$app->homeUrl;?>?r=sales/draft">Temp</a></span>
						
                        
                       
                     </div>
					 </br>
					  
					 
					 <div class="col-sm-12   "  style="margin-top:30px;" >
					  <div class="outpatientblock bg-block desc"  >
					  <div class="row">
					  <div class="form-group col-sm-4"  >
                           <label for="name">Patient Name:</label>
                           <input type="text" name='patient_name' class="form-control fwidth key outrefrsh" id='out_patient_name' tabindex="1">
                        </div>
                        <div class="form-group col-sm-4">
                           <label for="">Mobile Number:</label>
                           <input type="text" name='mobile_number' id='out_pat_mob' class="form-control fwidth key number outrefrsh phone" onkeypress="phoneno()" maxlength="10" tabindex="2" >
                        </div>
						
						<div class="form-group col-sm-4">
                           <label for="">Doctor Name:</label>
                           <div class="input-group fwidth " >
                              <span class="input-group-btn  ">
                                 <select class="btn  " tabindex="3"  >
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                              <input type="text" name='doctor_name' id='out_pat_doc' class="form-control outrefrsh" tabindex="4">
                           </div>
                        </div>
                        </div>
                        </div>
						
					 </div>
					 
                     <div class="col-sm-12   " style="margin-top:10px;"    >
					    <div class="inpatientblock bg-block desc" hidden> 
						<div class="row">
						 <div class="form-group col-sm-4  " >
						   <label for="name">MRN:</label>
                           <div class="input-group add-on fwidth" >
                           		<input class="form-control mrn inrefrsh" placeholder="Search" name="mr_number"   id="mrnumber" type="text" tabindex="6">
								
								<div class="input-group-btn fetch_record">
									<span class="btn btn-default inpatient-details"  ><i class="glyphicon glyphicon-search"></i></span>
								</div>
								
							</div>
							<span id='mr_validated' style="color:red">Invalid MR Number</span>
                        </div>
						 <div class="form-group col-sm-4"  >
                           <label for="name">Patient Name:</label>
                           <input type="text" class="form-control fwidth mrn inrefrsh" name='in_patient' id="pat_name" readonly>
                        </div>
						 <div class="form-group col-sm-4">
                           <label for="">Mobile Number:</label>
                           <input type="text" class="form-control fwidth mrn number phone inrefrsh" name='in_patient_mobile'   onkeypress="phoneno()"  id="pat_mob" readonly>
                        </div>
						</div>
						</br>
						<div class="row">
						<div class="form-group col-sm-4">
                           <label for="">Doctor Name:</label>
                           <div class="input-group fwidth">
                              <span class="input-group-btn">
                                 <select class="btn mrn"  disabled>
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                              <input type="text" class="form-control mrn inrefrsh" name='in_doctor_name' id="pat_doctor"  readonly>
                           </div>
                        </div>
						
                        <div class=" form-group col-sm-4" >
                           <label for="name">Insurance Type:</label>
                           <br>
                           <select class="form-control fwidth key mrn inrefrsh" name='insurance_type' id="pat_insurance" readonly>
                             
                           </select>
                        </div>
                        <div class="form-group col-sm-4" >
                           <label for="name">Date of Birth:</label>
                           <input type="text" class="form-control fwidth key mrn inrefrsh" name='date_of_birth' id="pat_dob" readonly>
                        </div>
                        </div>
                        </div>
                     </div>
                  <!--/form-->
                

					            
               </br>
               <div class=" ">
                  <div class="panel panel-border panel-custom" style="background-color:#ebeff2;">
                     <div class="panel-body">
                        <div class="row form-group  col-sm-10">
						  <div class="col-sm-offset-2">
						 
						  	<?php
						  	
							  $productlist=Product::find()->where(['is_active'=>1])->asArray()->all();							
								foreach ($productlist as $key => $value)
								{
									$productlist_col_val[] = array('value' => $value['productname'],'value1' => $value['productid']);
								}
								$productlist_col_json = json_encode($productlist_col_val);	
												
							?>
							    
							
							  
							   <input type="text" class="typehead form-control input-lg fwidth  medienter inrefrsh" placeholder="Enter prescription" tabindex="5" id="medicines">
							  	<label id="shortcut"><i><strong>[Shift+F1]<strong></i></label>
							   <input type="hidden" class="form-control" id='name'>      
								 <h5 class="text-center stock_no"><span style="color:red">Stock not Available</span></h5>   
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
                              <th rowspan="2" >#</th>
                              <th rowspan="2" >Stock/<br>Drug</th>
                              <th rowspan="2" >Batch</th>
                              <th rowspan="2" width="7%";>Exp Date</th>
                              <th rowspan="2" >Qty</th>
                              <th rowspan="2" >Unit<br>Form</th>
                              <th rowspan="2" >Price</th>
                              <th rowspan="2" width="5%">Dis Type</th>
                              <th rowspan="2" >Dis</th>
                             
                              
                              <th colspan="2" class="text-center">IGST</th>
                              <th colspan="2" class="text-center">CGST</th>
                              <th colspan="2" class="text-center">SGST</th>
							  
							  
                              <th rowspan="2" >Total</th>
                              <th rowspan="2" >Remove</th>
                           </tr>
                           <tr>
                               
                              <th >%</th>
                              <th >Amt</th>
                              <th>%</th>
                              <th> Amt</th>
                              <th>%</th>
                              <th> Amt</th>
                           </tr>
                        </thead>
                        <tbody id='fetch_update_data'>
                        
                           
                          
                        </tbody>
                        <tfoot>
                        	<tr style="background-color: #6c7a86!important;color: #fff;">
                              <td colspan="4" class="text-center" ><strong>TOTAL</strong></td>
                              <td></td>
                              <td></td>
                              <td ></td>
                              <td ></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td id='total_amount'></td>
                              <td></td>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
                  
                  
                  
                  
               </div>
			   
			   
			   
			   <br><br>
			   
			   
			    <input type='hidden' class='get_slno'>
			   <div class=" ">
                  <div class="panel panel-border panel-custom total-area"  >
                     <div class="panel-body">
                        <div class="row">
                           <div class="    col-sm-8">
                              <div class="row">
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">No Of Items:</label>
                                    <input type="text" class="form-control total_items ansrefrsh" name='total_items' readonly id="no_of_items">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Total Quantity:</label>
                                    <input type="text" class="form-control total_quantity ansrefrsh" name='total_quantity' readonly id="total_quantity">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Total GST:</label>
                                    <input type="text" class="form-control total_vat ansrefrsh" name='total_gst' readonly id="total_gst_amount">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Sub Total:</label>
                                    <input type="text" class="form-control total_sub_total ansrefrsh" name='total_sub_total' readonly id="total_sub_total">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Rounded Off:</label>
                                    <input type="text" class="form-control total_rounded ansrefrsh" name='total_rounded' readonly id="total_roundedvalue">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Discount:</label>
                                    <input type="text" class="form-control total_disc_original ansrefrsh" name='total_disc_original' readonly id="total_discountvalue">
                                 </div>
                              </div>
                           </div>
                           <div class=" gross-area   col-sm-4">
                              <div class="form-group col-sm-12">
                                 <label   for=" ">Net Amount</label>
                                 <input type="text" class="form-control total-netamt ansrefrsh" name='total_net_amount' readonly id="total_net_amount">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label  style="visibility:hidden;"  for=" ">Net Amount</label>
                                 <button type="button" value='save_bill' name='saved_bill' class="btn btn-primary fwidth save_billing">Save and Submit</button>
                                 <span class='in_pat_validated' style="color:red">Enter Patient Record</span>
                                 <span class='out_pat_validated' style="color:red">Enter Patient Details</span>
                              </div>
                              <div class="form-group col-sm-6">
                                 <label  style="visibility:hidden;" for=" ">Net Amount</label>
                                 <button type='reset' class="btn btn-default fwidth">Cancel </button>
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
    
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title" id='medcine_name'></h4>
         </div>
         <div class="scroll-modal">
         <div class=" modal-body" style="width: 1110px;">
         	 
         	
            <div class="row" id="fetch_table">
            	<h3 id="fetch_table_id"></h3>
            	<!--new table start-->
            	
                <!--new table end-->
			  </div>
			  
			
         
         </div></div>
         <div class="modal-footer" style="border-top:1px solid #ccc;">
		 <button type="button" class="btn btn-primary  fetch_data" tabindex="105">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            
         </div>
         
         <div class="row"  >
           <span class="col-sm-offset-10" style="position: relative;left: 55px;"> <i>[Alt+7]<i></span> 
             <span style="position: relative;left: 85px;"> <i>[Esc]<i></span>   
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
  });
</script>
 
 <script>

$(function () {
	    
        $("input[name='patient']").click(function () {
               if ($("#outPatient").is(":checked")) { 	
				    $('.inrefrsh').val('');
				    $('.ansrefrsh').val('');
					
					 $("#tbUser tbody tr").remove(); 
                   $(".outpatientblock").show();
   				$('[tabindex="1"]').focus();
   				$(".inpatientblock").hide();   				
               } else if ($("#inPatient").is(":checked")) {
				    $('.outrefrsh').val('');
					$('.ansrefrsh').val('');
					 $("#tbUser tbody tr").remove(); 
                   $(".inpatientblock").show();
   				$('[tabindex="6"]').focus();
   				$(".outpatientblock").hide();
   				  
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
				            	var currentDt = new Date(obj[4]);
				            	var mm = currentDt.getMonth() + 1;
							    var dd = currentDt.getDate();
							    var yyyy = currentDt.getFullYear();
							    var date = dd + '/' + mm + '/' + yyyy;
				           		$('#pat_name').val(obj[0]);
				           		$('#pat_mob').val(obj[1]);
				           		$('#pat_doctor').val(obj[2]);
				           		document.getElementById('pat_insurance').innerHTML=obj[3];
				           		$('#pat_dob').val(date);
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
						            		$('#mr_validated').delay('fast').fadeIn();
						            		$('#mr_validated').delay(4000).fadeOut();
						            	}
						            	else
						            	{
						            		var obj = $.parseJSON(result);
							            	var currentDt = new Date(obj[4]);
							            	var mm = currentDt.getMonth() + 1;
										    var dd = currentDt.getDate();
										    var yyyy = currentDt.getFullYear();
										    var date = dd + '/' + mm + '/' + yyyy;
							           		$('#pat_name').val(obj[0]);
							           		$('#pat_mob').val(obj[1]);
							           		$('#pat_doctor').val(obj[2]);
							           		document.getElementById('pat_insurance').innerHTML=obj[3];
							           		$('#pat_dob').val(date);
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
   					var encodeproduct_id=encodeURIComponent(product_id);
   					if(encodeproduct_id != '')
					{
						$.ajax({
						
				            type: "POST",
				            url: "<?php echo Yii::$app->homeUrl . "?r=sales/medicinefetch&product_id=";?>"+encodeproduct_id,
				            success: function (result) 
				            { 
				            	 var obj = $.parseJSON(result);
				            	 if(obj == 'NULL' || obj == '')
				            	 {
				            	 	
				            	 	$('.stock_no').show();
				            	 	 $modal = $('#myModal');
									   $modal.modal('hide'); 
				            	 }
				            	 else
				            	 {
				            	 	var medicinename='';
				            	 	 $('.stock_no').hide();
				            	 	 document.getElementById('fetch_table').innerHTML=obj;
				            	 	 medicinename=$('.prd_name1').html();
				            	 	 $('#medcine_name').html('<b>Medicine Name-'+medicinename+'</b>');
					            	 $modal = $('#myModal');
	   								 $modal.modal('show');
	   								$('#name').val('');	 
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

        minLength: 2,
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
   // this.$element[0].value = item.value
  }
	  
});

</script>
<script>


$(document).ready(function(){
	$('#myModal').on('shown.bs.modal', function ()
{
	//alert("iop");
    $('.focus_first').focus();
})
  
});
	 

</script>
<script type="text/javascript">
        
 $('[tabindex="1"]').focus();

shortcut.add("Alt+1",
function() {
	    $('.inrefrsh').val('');
		$('.ansrefrsh').val('');
		 $("#tbUser tbody tr").remove(); 
	 	$('#inPatient').prop('checked', false);
		 $('#outPatient').prop('checked', true);
	 
$(".outpatientblock").show();
$(".inpatientblock").hide();
  $('[tabindex="1"]').focus();
       
},
{ 'type':'keydown', 'propagate':true, 'target':document}
); 


shortcut.add("Alt+2",
function() {
	  $('.outrefrsh').val('');
	  $('.ansrefrsh').val('');
	  $("#tbUser tbody tr").remove(); 
	  
	  $('#outPatient').prop('checked', false);
	 $('#inPatient').prop('checked', true); 
$(".inpatientblock").show();
$(".outpatientblock").hide();
$('[tabindex="6"]').focus();
       
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


 shortcut.add("shift+f1",
   function() {
    $('[tabindex="5"]').focus();
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
			
			
			var sgst_value=parseInt($('#sgst_value'+unique_id).val());
			var cgst_value=parseInt($('#cgst_value'+unique_id).val());
			var igst_value=parseInt($('#igst_value'+unique_id).val());
			var delete_gst=sgst_value+igst_value+cgst_value;
			
			var total_gst_amount=parseInt($('#total_gst_amount').val());
			var delete_total_gst_amount=total_gst_amount-delete_gst;
			$('#total_gst_amount').val(delete_total_gst_amount);
			
			//Total Amount variable apply subtotal,rounded value,net amount
			var total_amount=parseInt($('#total_amount'+unique_id).val());
			var total_sub_total=parseInt($('#total_sub_total').val());
			var delete_total_sub_total=total_sub_total-total_amount;
			$('#total_sub_total').val(delete_total_sub_total);
			
			var total_roundedvalue=parseInt($('#total_roundedvalue').val());
			var delete_total_roundedvalue=total_roundedvalue-total_amount;
			$('#total_roundedvalue').val(delete_total_roundedvalue);
			
			var total_net_amount=parseInt($('#total_net_amount').val());
			var delete_total_net_amount=total_net_amount-total_amount;
			$('#total_net_amount').val(delete_total_net_amount);
    		$(this).closest('tr').remove();
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
			
			$('.out_pat_validated').hide();
			$('.in_pat_validated').hide();
			

			
			$("body").on('click', '.fetch_data', function () {
					var arr = [];
					var tbl_value = [];
					var validated = [];
					
					
					$('.required_qty').each(function ()
					{	
   						arr.push($(this).val());
   						tbl_value.push($(this).attr('data-id'));
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
								 	
								 	
							  		
							  var markup = "<tr  class='save_data_table' id='table_del"+tbl_value[i]+"'><td >"+slno+"</td><td>"+product_name+"</td><td>"+batchnumber+"</td><td>"+expire_date_id+"</td><td class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td>"+unit_value+"</td><td><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='text' name='price[]' class='price_mrp form-control number' value="+price_per_quantity+" id="+'price'+tbl_value[i]+"></td>"
						  								+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>Flat</label></li><li>"
						  								+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+" class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'><span class='input-group-addon ft-12 w-50'>Val</span><input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"' class='enabledisc disctxt w-50 number' readonly></div><div class='input-group mt-5'><span class='input-group-addon ft-12'>Amt</span><input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount disctxt w-50' readonly></div>"
						  								+"</td><td><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control cgst_percent' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control cgst_value' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control sgst_percent' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control sgst_value' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control total_amt_cal' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																												
																								
																															
																													
														
						  		 $("#fetch_update_data").append(markup);
						  		
						  		
						  		
						  		if($('#price'+tbl_value[i]).val() == 'NaN')
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
						  			
						  			var price=$('#price'+tbl_value[i]).val();
						  			//Total
						  			$('#total_amount'+tbl_value[i]).val(price);
						  			
						  			
						  		}
						  		else
						  		{
						  			var gst_divide=gst_sale_percent/2;
						  			var total_amount=parseFloat($('#price'+tbl_value[i]).val());
						  			
						  			
						  			var cgst_value=total_amount*gst_divide;
						  			var cgst_amt=cgst_value/100;
						  			var cgst_amount=parseFloat(cgst_amt);
						  			
						  			var sgst_value=total_amount*gst_divide;
						  			var sgst_amt=sgst_value/100;
						  			var sgst_amount=parseFloat(sgst_amt);
						  			
						  			
						  			var total=total_amount+cgst_amount+sgst_amount;
						  			
						  		
						  			$('#cgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#cgst_value'+tbl_value[i]).val(cgst_amount);
						  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#sgst_value'+tbl_value[i]).val(sgst_amount);
						  			$('#igst_percent'+tbl_value[i]).val(0);
						  			$('#igst_value'+tbl_value[i]).val(0);
						  			//Total
						  			$('#total_amount'+tbl_value[i]).val(total);
						  			
						  		}
						  		
						  		total_net_amount=total_net_amount+parseInt($('#total_amount'+tbl_value[i]).val());
						  		
						  		total_net_quantity=total_net_quantity+parseInt($('#quantity_add'+tbl_value[i]).html());
						  		
						  		no_of_items=no_of_items+1;
						  		
						  		var a=parseFloat($('#igst_value'+tbl_value[i]).val());
						  		var b=parseFloat($('#cgst_value'+tbl_value[i]).val());
						  		var c=parseFloat($('#sgst_value'+tbl_value[i]).val());
						  		var d=a+b+c;
						  		total_gst_amount=total_gst_amount+d;
						  		
						  		sub_total=sub_total+parseFloat($('#price'+tbl_value[i]).val());
						  		
						  		
						  		
						  		if(isNaN($('#disc_amount'+tbl_value[i]).val()))
						  		{
						  			disc_amount=disc_amount+parseFloat($('#disc_amount'+tbl_value[i]).val(0));
						  			
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
						
						$('#total_net_amount').val(total_net_amount);
						
						$('#total_quantity').val(total_net_quantity);
						
						$('#no_of_items').val(no_of_items);
						
						$('#total_gst_amount').val(total_gst_amount);
						
						$('#total_sub_total').val(sub_total);
						
						var tot_sub=parseInt($('#total_sub_total').val());
					
						$('#total_roundedvalue').val(tot_sub);
						
						$('#total_discountvalue').val(disc_amount);
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
							  		
							  		var gst_sale_percent=$('#gst_sale_percent'+tbl_value[i]).val();
							  		
							  		var product_id=$('#product_id'+tbl_value[i]).val();
							  		var brandcode_id=$('#brandcode_id'+tbl_value[i]).val();
								 	var stockcode_id=$('#stockcode_id'+tbl_value[i]).val();
								 	var composition_id=$('#composition_id'+tbl_value[i]).val();
								 	var unit_id=$('#unit_id'+tbl_value[i]).val();
								 	var stock_id=$('#stock_id'+tbl_value[i]).val();
								 	var mrp_id=$('#mrp_id'+tbl_value[i]).html();
								 	
								 	
							  		
							  var markup = "<tr  class='save_data_table' id='table_del"+tbl_value[i]+"'><td >"+slno+"</td><td>"+product_name+"</td><td>"+batchnumber+"</td><td>"+expire_date_id+"</td><td class='quantity_add' id='quantity_add"+tbl_value[i]+"'>"+required_id+"</td><td>"+unit_value+"</td><td><input type='hidden' name='mrp_rate_per_unit[]' value='"+mrp_id+"'><input type='hidden' name='stock_id[]' value='"+stock_id+"'><input type='hidden' name='unit_id[]' value='"+unit_id+"'><input type='hidden' name='composition_id[]' value='"+composition_id+"'>"
							  							+"<input type='hidden' name='stockcode_id[]' value='"+stockcode_id+"'><input type='hidden' name='brandcode_id[]' value='"+brandcode_id+"'><input type='hidden' name='product_name_id[]' value='"+product_id+"'><input type='hidden' name='expire_date_id[]' value='"+expire_date_id+"'>"
							  							+"<input type='hidden' name='batchnumber[]' value='"+batchnumber+"'><input type='hidden' name='product_name[]' value='"+product_name+"'><input type='hidden' name='quantity[]' value='"+required_id+"'><input type='hidden' name='primeid[]' value='"+tbl_value[i]+"'><input type='text' name='price[]' class='price_mrp form-control number' value="+price_per_quantity+" id="+'price'+tbl_value[i]+"></td>"
						  								+"<td><ul class='donate-now'><input type='hidden' name='discount_method[]' id='disc_method"+tbl_value[i]+"' ><li><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"' class='deselect flat testrad'  onchange='descChanged("+tbl_value[i]+")'><label for='flat_discount"+tbl_value[i]+"' class='w-50 text-center testrad'>Flat</label></li><li>"
						  								+"<input type='radio' id='percent"+tbl_value[i]+"' data-deselect="+tbl_value[i]+" class='deselect percent testrad' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' ><label for='percent"+tbl_value[i]+"' class='w-50 text-center testrad'>%</label></li></ul></td>"
						  								+"<td><div class='input-group'><span class='input-group-addon ft-12 w-50'>Val</span><input type='text' name='discount_value[]' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"' class='enabledisc disctxt w-50 number' readonly></div><div class='input-group mt-5'><span class='input-group-addon ft-12'>Amt</span><input type='text' name='discountext_value[]' id='disc_amount"+tbl_value[i]+"' class='add_discount disctxt w-50' readonly></div>"
						  								+"</td><td><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' readonly><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control cgst_percent' name='cgst_percent[]' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control cgst_value' name='cgst_value[]' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control sgst_percent' name='sgst_percent[]' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' readonly></td><td><input type='text'  class='form-control sgst_value' name='sgst_value[]' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' readonly></td>"
						  								+"<td><input type='text'  class='form-control total_amt_cal' name='total_amt_cal[]' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' readonly></td>"
						  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' data_delete_row="+tbl_value[i]+" id='delrow"+tbl_value[i]+"'><i class='fa fa-remove'></i></button></td></tr>";
																							
																										
																																						
										
									$("#fetch_update_data").append(markup); 
									
									
									
									
									
								if($('#price'+tbl_value[i]).val() == 'NaN')
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
						  			
						  			var price=$('#price'+tbl_value[i]).val();
						  			//Total
						  			$('#total_amount'+tbl_value[i]).val(price);
						  		}
						  		else
						  		{
						  			var gst_divide=gst_sale_percent/2;
						  			var total_amount=parseFloat($('#price'+tbl_value[i]).val());
						  			
						  			
						  			var cgst_value=total_amount*gst_divide;
						  			var cgst_amt=cgst_value/100;
						  			var cgst_amount=parseFloat(cgst_amt);
						  			
						  			var sgst_value=total_amount*gst_divide;
						  			var sgst_amt=sgst_value/100;
						  			var sgst_amount=parseFloat(sgst_amt);
						  			
						  			
						  			var total=total_amount+cgst_amount+sgst_amount;
						  			
						  		
						  			$('#cgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#cgst_value'+tbl_value[i]).val(cgst_amount);
						  			$('#sgst_percent'+tbl_value[i]).val(gst_divide);
						  			$('#sgst_value'+tbl_value[i]).val(sgst_amount);
						  			$('#igst_percent'+tbl_value[i]).val(0);
						  			$('#igst_value'+tbl_value[i]).val(0);
						  			//Total
						  			$('#total_amount'+tbl_value[i]).val(total);
						  			
						  		}
						  			total_net_amount=total_net_amount+parseInt($('#total_amount'+tbl_value[i]).val());
						  			
						  			total_net_quantity=total_net_quantity+parseInt($('#quantity_add'+tbl_value[i]).html());
						  			
						  			no_of_items=no_of_items+1;
						  			
							  		var a=parseFloat($('#igst_value'+tbl_value[i]).val());
							  		var b=parseFloat($('#cgst_value'+tbl_value[i]).val());
							  		var c=parseFloat($('#sgst_value'+tbl_value[i]).val());
							  		var d=a+b+c;
							  		total_gst_amount=total_gst_amount+d;
						  			
						  			sub_total=sub_total+parseFloat($('#price'+tbl_value[i]).val());
						  			
						  			//disc_amount=disc_amount+parseFloat($('#disc_amount'+tbl_value[i]).val());
						  			
						  			
						  			if(isNaN($('#disc_amount'+tbl_value[i]).val()))
						  		{
						  			disc_amount=disc_amount+parseFloat($('#disc_amount'+tbl_value[i]).val(0));
						  			
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
					}
					$('.get_slno').val(slnovalue);
					 $modal = $('#myModal');
					$modal.modal('hide'); 
					$('#total_net_amount').val(total_net_amount+value);
					
					$('#total_quantity').val(total_net_quantity+total_quantity_exist);
					
					$('#no_of_items').val(no_of_items+no_of_items1);
					
					$('#total_gst_amount').val(total_gst_amount1+total_gst_amount);
					
					$('#total_sub_total').val(sub_total+sub_total1);
					
					var tot_sub=parseInt($('#total_sub_total').val());
					
					$('#total_roundedvalue').val(tot_sub);
					
					$('#total_discountvalue').val(disc_amount+disc_amount1);
					
					}
					
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
        						alert(data2);
        						if(data1=="Y")
	    						{
	    							$(".save_billing").prop('disabled', true);
	    							 $(".print_rules").append("<a target='_blank' class='btn btn-danger' style='position: relative;left: 15px;' href='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id="+data2+"'>Invoice</a>" );	
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
        						alert(data2);
        						if(data1=="Y")
	    						{
	    							$(".save_billing").prop('disabled', true);
	    							 $(".print_rules").append("<a target='_blank' class='btn btn-danger' style='position: relative;left: 15px;' href='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id="+data2+"'>Invoice</a>" );	
				            	}
				            }
				        	});
				    	}
              		}
				
			});
			
			
			
			
			
			
			
			
			
			$("body").on('keyup', '.enabledisc', function () 
			{
				
				var id_value=$(this).attr('data_disc_value');
				
				var keycode = (event.keyCode ? event.keyCode : event.which);
				
				
				if($('#percent'+id_value).is(":checked"))
          		{
          			
          			if(keycode == '13')
          			{
						var price=parseFloat($('#price'+id_value).val());
						var flat_discount_percent=parseFloat($('#enabledisc'+id_value).val());
						
						var discount_percent=price*flat_discount_percent;
						var discount_value=discount_percent/100;
						
						$('#disc_amount'+id_value).val(discount_value);
						
						var discount_val=parseFloat($('#disc_amount'+id_value).val());
						
						var total_disc_val=price-discount_val;
						
						var gst_percent=parseInt($('#gst_percent'+id_value).val());
						var gst_percent_divide=gst_percent/2;
						
						
						var cgst_amount=total_disc_val*gst_percent_divide;
						var cgst_amount_total=cgst_amount/100;
						var cgst_total=cgst_amount_total;
						
						var sgst_amount=total_disc_val*gst_percent_divide;
						var sgst_amount_total=sgst_amount/100;
						var sgst_total=sgst_amount_total;
						
						var total=parseFloat(cgst_total+sgst_total);
						var total_amount=parseFloat(total_disc_val+total);
						
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
						
						$('#disc_amount'+id_value).val(flat_discount_amt);
						
						var discount_amt=$('#disc_amount'+id_value).val();
						
						var discount_value=price-discount_amt;
						
						var gst_percent=parseInt($('#gst_percent'+id_value).val());
						var gst_percent_divide=gst_percent/2;
						
						var cgst_amount=discount_value*gst_percent_divide;
						var cgst_amount_total=cgst_amount/100;
						var cgst_total=cgst_amount_total;
						
						var sgst_amount=discount_value*gst_percent_divide;
						var sgst_amount_total=sgst_amount/100;
						var sgst_total=sgst_amount_total;
						
						var total=parseFloat(cgst_total+sgst_total);
						var total_amount=parseFloat(discount_value+total);
						
						
						$('#cgst_percent'+id_value).val(gst_percent_divide);
						$('#sgst_percent'+id_value).val(gst_percent_divide);
						$('#cgst_value'+id_value).val(cgst_total);
						$('#sgst_value'+id_value).val(sgst_total);
						$('#total_amount'+id_value).val(total_amount);
					}
				}
				
				var tot=0;
				var quantity_add=0;
				var disctxt=0;
				$('.total_amt_cal').each(function ()
					{	
   						tot = tot+parseInt($(this).val());
   						quantity_add=quantity_add+parseFloat($('.quantity_add').html());
   						disctxt=disctxt+parseFloat($('.add_discount').val());
   						
   						$('#total_amount').html(tot);
   						$('#total_net_amount').val(tot);
   						$('.total_sub_total').val(tot);
   						$('.total_rounded').val(tot);
   						
   						$('.total_quantity ').val(quantity_add);
   						$('.total_disc_original').val(disctxt);
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
          	
          	$('#cgst_percent'+datavalueid).val(0);
          	$('#cgst_value'+datavalueid).val(0);
          	$('#sgst_percent'+datavalueid).val(0);
          	$('#sgst_value'+datavalueid).val(0);
          	$('#igst_percent'+datavalueid).val(0);
          	$('#igst_value'+datavalueid).val(0);
          	
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
   	    	$('#cgst_percent'+datavalueid).val(0);
          	$('#cgst_value'+datavalueid).val(0);
          	$('#sgst_percent'+datavalueid).val(0);
          	$('#sgst_value'+datavalueid).val(0);
          	$('#igst_percent'+datavalueid).val(0);
          	$('#igst_value'+datavalueid).val(0);
          	//$('#total_amount'+datavalueid).val(0);
          	$('#disc_method'+datavalueid).val('Flat');
          } 
              
      } 
      
    
	</script>
	
	<script>
// $(document).ready(function(){
    // $(".deselect").data("chk",true);
    // $(".deselect").click(function(){
		// alert("hi");
		// return false;
        // $("input[name='"+$(this).attr("name")+"']:radio").not(this).removeData("chk");
        // $(this).data("chk",!$(this).data("chk"));
        // $(this).prop("checked",$(this).data("chk"));
    // });
// });



$(document).ready(function(){
    $("input:radio:checked").data("chk",true);
   // $("input:radio").click(function(){
		$("body").on('click', 'input:radio', function (){
        $("input[name='"+$(this).attr("name")+"']:radio").not(this).removeData("chk");
        $(this).data("chk",!$(this).data("chk"));
        $(this).prop("checked",$(this).data("chk"));
    });
    
    
   
});
 </script>
	
