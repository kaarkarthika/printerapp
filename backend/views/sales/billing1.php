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
   
   ?>
<link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<script src="plugins/select2/select2.min.js" type="text/javascript"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
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

.form-group {
   /*margin-bottom: 0px; */
}
   .panel-info > .panel-heading{
		background-color:#3e678a;
	}
	.scroll-modal{
		height: 460px;
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
               	 
    <?php $form = ActiveForm::begin(); ?>
                  <!--form class="form-inline" action=" "-->
                     <div class="col-sm-12">
					 
<!-- <div class="checkbox checkbox-primary col-sm-2" style="margin-top:30px;">
                           <input id=" " type="checkbox" class="coupon_question key" onchange="valueChanged()">
                           <label for=" ">
                           In-Patient
                           </label>
                        </div>
						
						 <div class="checkbox checkbox-primary col-sm-2" style="margin-top:30px;">
                           <input id=" " type="checkbox" class="coupon_question key" onchange="valueChanged()">
                           <label for=" ">
                           Out-Patient
                           </label>
                        </div> -->
                      	   
                        <div class="radio radio-info radio-inline">
		                                            <input type="radio" id="outPatient" class="outPatient" value="outpatient" name="patient" checked=""  >
		                                            <label for="inlineRadio1" id="outPatient">  Out-Patient <i><strong>[Alt+1]</strong></i> </label>
		                                        </div>
                       <div class="radio radio-info radio-inline">
		                                            <input type="radio" id="inPatient" class="inPatient" value="inpatient" name="patient"  >
		                                            <label for="inlineRadio1" id="inPatient"> In-Patient <i><strong>[Alt+2]<strong></i></label>
		                                        </div> 
												
												
						<span class=" pull-right"> <span><i>[Alt+3]</i></span>
						<a class=" btn btn-primary text-white" href="<?php echo Yii::$app->homeUrl;?>?r=sales/draft">Temp</a></span>
						
                        
                       
                     </div>
					 </br>
					  
					 
					 <div class="col-sm-12   "  style="margin-top:30px;" >
					  <div class="outpatientblock bg-block desc"  >
					  <div class="row">
					  <div class="form-group col-sm-4"  >
                           <label for="name">Patient Name:</label>
                           <input type="text" class="form-control fwidth key " tabindex="1">
                        </div>
                        <div class="form-group col-sm-4">
                           <label for="">Mobile Number:</label>
                           <input type="number" class="form-control fwidth key" >
                        </div>
						
						<div class="form-group col-sm-4">
                           <label for="">Doctor Name:</label>
                           <div class="input-group fwidth">
                              <span class="input-group-btn">
                                 <select class="btn "  >
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                              <input type="text" class="form-control ">
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
								<input class="form-control mrn" placeholder="Search" name="srch-term"   id="mrnumber" type="text" tabindex="6">
								<div class="input-group-btn fetch_record">
									<span class="btn btn-default inpatient-details"  ><i class="glyphicon glyphicon-search"></i></span>
								</div>
							</div>
                        </div>
						 <div class="form-group col-sm-4"  >
                           <label for="name">Patient Name:</label>
                           <input type="text" class="form-control fwidth mrn  " id="pat_name" disabled>
                        </div>
						 <div class="form-group col-sm-4">
                           <label for="">Mobile Number:</label>
                           <input type="number" class="form-control fwidth mrn " id="pat_mob" disabled>
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
                              <input type="text" class="form-control mrn " id="pat_doctor"  disabled>
                           </div>
                        </div>
						
                        <div class=" form-group col-sm-4" >
                           <label for="name">Insurance Type:</label>
                           <br>
                           <select class="form-control fwidth key mrn" id="pat_insurance" disabled>
                             
                           </select>
                        </div>
                        <div class="form-group col-sm-4" >
                           <label for="name">Date of Birth:</label>
                           <input type="text" class="form-control fwidth key mrn" id="pat_dob" disabled>
                        </div>
                        </div>
                        </div>
                     </div>
                  <!--/form-->
                

					               </div>
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
							    
							
							  
							   <input type="text" class="form-control input-lg fwidth  medienter" placeholder="Enter prescription" tabindex="4" id="medicines">
							   <input type="hidden" class="form-control" id='name'>      
							  
                          <!-- <label for="">Choose Medicine:</label>
                            <select class="form-control input-lg select2 key" id="medicines">
                            	<option>-Select-</option>
                           <?php
                          
                           $productlist=Product::find()->where(['is_active'=>1])->all();
							if(!empty($productlist))
							{
                           foreach ($productlist as $key) 
                           {
                           
                           ?>
                             <option value="<?php echo $key->productid; ?>"><?php echo $key->productname; ?></option>
                          
                           <?php }}  ?> 
                           
                         
                           </select> -->
                            <h4 class="stock_no"><span style="color:red">Stock not Available</span></h4>
                        </div>
                        </div>
                      
                     </div>
                      
                  </div>
               </div>

                  
                   <?php ActiveForm::end(); ?>   
    


               <div class="row">
                  <div class="col-sm-12">
<table class="table table-bordered table-striped" id="tbUser">
                        <thead>
                           <tr>
                              <th rowspan="2" >#</th>
                              <th rowspan="2" >Stock/<br>Drug</th>
                              <th rowspan="2" >Batch</th>
                              <th rowspan="2" >Exp Date</th>
                              <th rowspan="2" >Qty</th>
                              <th rowspan="2" >Unit<br>Form</th>
                              <th rowspan="2" >Price</th>
                              <th rowspan="2" >Dis Type</th>
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
                              <td><strong>Qty</strong></td>
                              <td></td>
                              <td ><strong>Price</strong></td>
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
                                    <input type="text" class="form-control" disabled id="no_of_items">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Total Quantity:</label>
                                    <input type="text" class="form-control" disabled id="total_quantity">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Total VAT:</label>
                                    <input type="" class="form-control" disabled id=" ">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Sub Total:</label>
                                    <input type=" " class="form-control" disabled id=" ">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Rounded Off:</label>
                                    <input type="text" class="form-control" disabled id="total_roundedvalue">
                                 </div>
                                 <div class="form-group col-sm-4">
                                    <label   for=" ">Discount:</label>
                                    <input type="text" class="form-control" disabled id="total_discountvalue">
                                 </div>
                              </div>
                           </div>
                           <div class=" gross-area   col-sm-4">
                              <div class="form-group col-sm-12">
                                 <label   for=" ">Net Amount</label>
                                 <input type="text" class="form-control" disabled id="total_net_amount">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label  style="visibility:hidden;"  for=" ">Net Amount</label>
                                 <button class="btn btn-primary fwidth">Save and Submit </button>
                              </div>
                              <div class="form-group col-sm-6">
                                 <label  style="visibility:hidden;" for=" ">Net Amount</label>
                                 <button class="btn btn-default fwidth">Cancel </button>
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
 <?php $form = ActiveForm::begin(['id'=>'quanityinsert']); ?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title">Medicine Name</h4>
         </div>
         <div class="scroll-modal modal-body">
         	
         	
            <div class="row" id="fetch_table">
            	
            	<!--new table start-->
            	
                <!--new table end-->
			  </div>
			  
			
         </div>
         <div class="modal-footer" style="border-top:1px solid #ccc;">
		 <button type="button" class="btn btn-primary  fetch_data" data-dismiss="modal">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            
         </div>
      </div>
   </div>
</div>
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

<!-- <script type="text/javascript">
$(document).ready(function(){
  $('input,select').keydown( function(e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if(key == 13) {
            e.preventDefault();
            var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
        }
    });
});
</script> -->
 
<!-- <script>
$(document).ready(function(){
	$('.key').keydown(function (e) {
         if ((e.which === 13) || (e.which === 9 && e.shiftKey === false)) {
             var index = $('.key').index(this) + 1;
             if(index<12){
             	 if(index==9){index++;}
            	 $('.key').eq(index).focus();
            	 /* var total=Number($('#Quantity').val())-Number($('#Wastage').val());
            	  $('#bweight').val(total);
            	  $('#bweight_label').text(total);
            	  var purchase_cost=Number(total.toFixed(2))*Number($('#rate').val());
            	  $('#cost').val(purchase_cost.toFixed(2)); */
              return false;
             }else{
             	return true;
             }
         }
         if(e.keyCode == 65 && e.altKey === true){
         	document.getElementById('advance').focus();
         }
         if(e.keyCode == 85 && e.altKey === true){
         	$("#sales").submit();
         }
     });
  });
</script>  -->
 
<script type="text/javascript">
     $(document).ready(function () {

         var inputs = $(':input').keypress(function (e) {
             if (e.which == 13) {
                 e.preventDefault();
                 var nextInput = inputs.get(inputs.index(this) + 1);
                 if (nextInput) {
                     nextInput.focus();
                 }
             }
         });

              });
              
              
              
 
 </script> 
 <script>
/* $(document).ready(function() {
    $("div.desc").hide();
    $("input[name$='patient']").click(function() {
        var test = $(this).val();
        $("div.desc").hide();
        $("." + test).show();
    });
}); */
 
$(function () {
	/*$(".inpatientblock").hide();
        $("input[name='patient']").click(function () {
            if ($(".outPatient").is(":checked")) {
				 $('[tabindex="1"]').focus();
                $(".outpatientblock").show();
				$(".inpatientblock").hide();
            } else if ($(".inPatient").is(":checked")) {
                $('[tabindex=""]').focus();
                $(".inpatientblock").show();
				$(".outpatientblock").hide();
            }
			
			 
			
        });*/
        
        
        $("input[name='patient']").click(function () {
               if ($("#outPatient").is(":checked")) { 				 
                   $(".outpatientblock").show();
   				$('[tabindex="1"]').focus();
   				$(".inpatientblock").hide();   				
               } else if ($("#inPatient").is(":checked")) {
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
			
			
			
			$('body').on("blur",'#medicines',function(e)
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
				            	 }
				            	 else
				            	 {
				            	 	 $('.stock_no').hide();
				            	 	 document.getElementById('fetch_table').innerHTML=obj;
					            	 $modal = $('#myModal');
	   								 $modal.modal('show');
	   								 $('[tabindex="8"]').focus();
	   								 $('#name').val('');	
				            	 }
				            }
				        });
				}
				
				
				
				
				
				
   			});
   			
   			
   			$('#myModal').on('shown.bs.modal', function() {
					 
         document.activeElement.blur();
         $(this).find(":input").first().focus();
    });
   			
   			
   			$('#medicines').keyup(function(e){
   if(e.keyCode == 13) {
    
   $modal = $('#myModal');
   $modal.modal('show'); 
   }
   });
   			
   			$('body').on("keyup",'.required_qty',function(e)
   			{
   				var available_id=$(this).attr('data-id');
   				var available_value=parseInt($('#quanity_id'+available_id).html());
   				var required_value=parseInt($(this).val());
   				
   				if(required_value > available_value)
   				{
   					alert("You enter more than Availability");
   					$(this).val("");
   					//$modal.modal('hide');
   					return false;
   				}
   				
   				
   			});
   			
   			
   			
   			
   			
   		
   			

	}); 
	
		//auto start
			
			
                var availableTags = <?= $productlist_col_json; ?>;
            // alert(availableTags);
                $("#medicines").autocomplete({
                	 classes: {
    			"ui-autocomplete": "highlight"
  					},	
  					 position: { my : "right top", at: "right bottom" },
                    autoFocus: true,
                    source: availableTags,
                    select: function (event, ui) {
                        $("#medicines").val(ui.item.value);
                        $("#name").val(ui.item.value1);
                        return false;
                    }
                });
               
        
			//auto end
	

</script>
<script type="text/javascript">
        
 $('[tabindex="1"]').focus();

shortcut.add("Alt+1",
function() {
	
	 	$('#inPatient').prop('checked', false);
		 $('#outPatient').prop('checked', true);
	 
$(".outpatientblock").show();
$(".inpatientblock").hide();
  $('[tabindex="1"]').focus();
        /*$("input[name='patient']").click(function () {
            if ($(".outPatient").is(":checked")) {
				 
                $(".outpatientblock").show();
				$(".inpatientblock").hide();
            } else if ($(".inPatient").is(":checked")) {
                $(".inpatientblock").show();
				$(".outpatientblock").hide();
            }
			
			 
			
        }); */
},
{ 'type':'keydown', 'propagate':true, 'target':document}
); 


shortcut.add("Alt+2",
function() {
	
	  $('#outPatient').prop('checked', false);
	 $('#inPatient').prop('checked', true); 
$(".inpatientblock").show();
$(".outpatientblock").hide();
$('[tabindex="6"]').focus();
        /*$("input[name='patient']").click(function () {
            if ($(".outPatient").is(":checked")) {
				 
                $(".outpatientblock").show();
				$(".inpatientblock").hide();
            } else if ($(".inPatient").is(":checked")) {
                $(".inpatientblock").show();
				$(".outpatientblock").hide();
            }
			
			 
			
        }); */
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
    $('[tabindex="4"]').focus();
   },
    
   { 'type':'keydown', 'propagate':true, 'target':document}
   );


    </script>
<script>
	$(document).ready(function(){
		$("#tbUser").on('click', '.delrow', function () {
    $(this).closest('tr').remove();
});
	});
	
	</script>
	
	<script>
	

	
	
		$(document).ready(function(){
			
			

			
			$("body").on('click', '.fetch_data', function () {
					var arr = [];
					var tbl_value = [];
					
					
					
					$('.required_qty').each(function ()
					{	
   						arr.push($(this).val());
   						tbl_value.push($(this).attr('data-id'));
					});
					
					var slnovalue='';
					 if($('.get_slno').val() == '')
					 {
					 	
					
					 var slno=1;
					for (var i=0; i < arr.length; i++)
					{
					  	if(arr[i] != '' && tbl_value[i] != '')
					  	{
					  		
					  		
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
					  		
					  					var markup = "<tr><td >"+slno+"</td><td>"+product_name+"</td><td>"+batchnumber+"</td><td>"+expire_date_id+"</td><td>"+required_id+"</td><td>"+unit_value+"</td><td><input type='text' name='price[]' class='price_mrp form-control number' value="+price_per_quantity+" id="+'price'+tbl_value[i]+"></td>"
					  								+"<td><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"' class='flat'  onchange='descChanged("+tbl_value[i]+")'>Flat<br/><input type='radio' id='percent"+tbl_value[i]+"' class='percent' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' >%</td>"
					  								+"<td><div class='input-group'><span class='input-group-addon ft-12 w-50'>Val</span><input type='text' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"' class='enabledisc disctxt w-50 number' disabled></div><div class='input-group mt-5'><span class='input-group-addon ft-12'>Amt</span><input type='text' id='disc_amount"+tbl_value[i]+"' class='disctxt w-50' disabled></div>"
					  								+"</td><td><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' disabled><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' disabled></td><td><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' disabled></td>"
					  								+"<td><input type='text'  class='form-control' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' disabled></td><td><input type='text'  class='form-control' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' disabled></td>"
					  								+"<td><input type='text'  class='form-control' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' disabled></td><td><input type='text'  class='form-control' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' disabled></td>"
					  								+"<td><input type='text'  class='form-control total_amt_cal' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' disabled></td>"
					  								+"<td><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' ><i class='fa fa-remove'></i></button></td></tr>";
																													
																							
								

					  		 $("#fetch_update_data").append(markup);
					  		
					  		slno++;
					  		slnovalue=slno;
					  		
					  	}
					}
					 $('.get_slno').val(slnovalue);
					 
					}
					else
					{
						
						
					  var slno=parseInt($('.get_slno').val());
					for (var i=0; i < arr.length; i++)
					{
					  	if(arr[i] != '' && tbl_value[i] != '')
					  	{
					  		
					  		
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
					  		
					  		var markup = "<tr><td >"+slno+"</td><td>"+product_name+"</td><td>"+batchnumber+"</td><td>"+expire_date_id+"</td><td>"+required_id+"</td><td>"+unit_value+"</td><td><input type='text' name='price[]' class='price_mrp form-control number' value="+price_per_quantity+" id="+'price'+tbl_value[i]+"></td>"
					  								+"<td><input type='radio'  name='desc"+tbl_value[i]+"' data_flat='"+tbl_value[i]+"' id='flat_discount"+tbl_value[i]+"' class='flat'  onchange='descChanged("+tbl_value[i]+")'>Flat<br/><input type='radio' id='percent"+tbl_value[i]+"' class='percent' name='desc"+tbl_value[i]+"'  onchange='descChanged("+tbl_value[i]+")' >%</td>"
					  								+"<td><div class='input-group'><span class='input-group-addon ft-12 w-50'>Val</span><input type='text' data_disc_value='"+tbl_value[i]+"' id='enabledisc"+tbl_value[i]+"' class='enabledisc disctxt w-50 number' disabled></div><div class='input-group mt-5'><span class='input-group-addon ft-12'>Amt</span><input type='text' id='disc_amount"+tbl_value[i]+"' class='disctxt w-50' disabled></div>"
					  								+"</td><td><input type='hidden' class='form-control' data_gst_percent='"+tbl_value[i]+"' id='gst_percent"+tbl_value[i]+"' value='"+gst_sale_percent+"' disabled><input type='text' class='form-control' data_igst_percent='"+tbl_value[i]+"' id='igst_percent"+tbl_value[i]+"' disabled></td><td><input type='text'  class='form-control' data_igst_value='"+tbl_value[i]+"' id='igst_value"+tbl_value[i]+"' disabled></td>"
					  								+"<td><input type='text'  class='form-control' data_cgst_percent='"+tbl_value[i]+"' id='cgst_percent"+tbl_value[i]+"' disabled></td><td><input type='text'  class='form-control' data_cgst_value='"+tbl_value[i]+"' id='cgst_value"+tbl_value[i]+"' disabled></td>"
					  								+"<td><input type='text'  class='form-control' data_sgst_percent='"+tbl_value[i]+"' id='sgst_percent"+tbl_value[i]+"' disabled></td><td><input type='text'  class='form-control' data_sgst_value='"+tbl_value[i]+"' id='sgst_value"+tbl_value[i]+"' disabled></td>"
					  								+"<td><input type='text'  class='form-control total_amt_cal' data_total='"+tbl_value[i]+"' id='total_amount"+tbl_value[i]+"' disabled></td>"
					  								+"<td class='text-center'><button type='button' class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow' ><i class='fa fa-remove'></i></button></td></tr>";
																													
																																			
								

					  		 $("#fetch_update_data").append(markup);
					  		
					  		slno++;
					  		slnovalue=slno;
					  		
					  	}
					}
					$('.get_slno').val(slnovalue);
					}
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
				            	$('#total_unit'+get_unit).val(total_unit);
				            }
				        });
			});
			
			$("body").on('blur', '.enabledisc', function () 
			{
				
				var id_value=$(this).attr('data_disc_value');
				if($('#percent'+id_value).is(":checked"))
          		{
					var enabledisc_percent=parseInt($(this).val());
					var price_value=parseInt($('#price'+id_value).val());
					var total_discount=enabledisc_percent*price_value;
					var total_divide=total_discount/100;
					var total_disc_percent=price_value-total_divide;
					$('#disc_amount'+id_value).val(total_disc_percent);
					var disc_amt=parseInt($('#disc_amount'+id_value).val());
					if(disc_amt != '')
					{
						var gst_percent=parseInt($('#gst_percent'+id_value).val());
						var gst_percent_divide=gst_percent/2;
						
						
						var cgst_amount=disc_amt*gst_percent_divide;
						var cgst_amount_total=cgst_amount/100;
						var cgst_total=cgst_amount_total;
						
						var sgst_amount=disc_amt*gst_percent_divide;
						var sgst_amount_total=sgst_amount/100;
						var sgst_total=sgst_amount_total;
						
						var total=parseFloat(cgst_total+sgst_total);
						var total_amount=parseFloat(disc_amt+total);
						
						
						$('#cgst_percent'+id_value).val(gst_percent_divide);
						$('#sgst_percent'+id_value).val(gst_percent_divide);
						$('#cgst_value'+id_value).val(cgst_total);
						$('#sgst_value'+id_value).val(sgst_total);
						$('#total_amount'+id_value).val(total_amount);
					
					}
					
				}
				else if($('#flat_discount'+id_value).is(":checked"))
				{
					var enabledisc_flat=parseInt($(this).val());
					var price_value=parseInt($('#price'+id_value).val());
					var total_discount=price_value-enabledisc_flat;
					$('#disc_amount'+id_value).val(total_discount);
					var disc_amt=parseInt($('#disc_amount'+id_value).val());
					if(disc_amt != '')
					{
						var gst_percent=parseInt($('#gst_percent'+id_value).val());
						var gst_percent_divide=gst_percent/2;
						
						
						var cgst_amount=disc_amt*gst_percent_divide;
						var cgst_amount_total=cgst_amount/100;
						var cgst_total=cgst_amount_total;
						
						var sgst_amount=disc_amt*gst_percent_divide;
						var sgst_amount_total=sgst_amount/100;
						var sgst_total=sgst_amount_total;
						
						var total=parseFloat(cgst_total+sgst_total);
						var total_amount=parseFloat(disc_amt+total);
						
						
						$('#cgst_percent'+id_value).val(gst_percent_divide);
						$('#sgst_percent'+id_value).val(gst_percent_divide);
						$('#cgst_value'+id_value).val(cgst_total);
						$('#sgst_value'+id_value).val(sgst_total);
						$('#total_amount'+id_value).val(total_amount);
					}
				}
				
				var tot=0;
				$('.total_amt_cal').each(function ()
					{	
   						tot = tot+parseInt($(this).val());
   						$('#total_amount').html(tot);
   						$('#total_net_amount').val(tot);
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
		
		
		
 	function descChanged(datavalueid)
      {
      	
          if($('#percent'+datavalueid).is(":checked"))
          {
          	
          	$("#enabledisc"+datavalueid).prop('disabled',false);
          	$('#enabledisc'+datavalueid).focus();
          	$('#disc_amount'+datavalueid).val('');
          	$("#enabledisc"+datavalueid).val('');
          	
          	$('#cgst_percent'+datavalueid).val('');
          	$('#cgst_value'+datavalueid).val('');
          	$('#sgst_percent'+datavalueid).val('');
          	$('#sgst_value'+datavalueid).val('');
          	$('#total_amount'+datavalueid).val('');
          	
          }
          else if($('#flat_discount'+datavalueid).is(":checked"))
          {
          	
          	$('#disc_amount'+datavalueid).val('');
          	$("#enabledisc"+datavalueid).val('');
          	
          	$("#enabledisc"+datavalueid).prop('disabled',false);
   	    	$('#enabledisc'+datavalueid).focus();
   	    	
   	    		$('#cgst_percent'+datavalueid).val('');
          	$('#cgst_value'+datavalueid).val('');
          	$('#sgst_percent'+datavalueid).val('');
          	$('#sgst_value'+datavalueid).val('');
          	$('#total_amount'+datavalueid).val('');
          } 
              
      } 
   
	  
	</script>

