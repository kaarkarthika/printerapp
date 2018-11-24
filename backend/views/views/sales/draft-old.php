<?php
   use yii\helpers\Html;
   use yii\grid\GridView;
   use yii\widgets\Pjax;
   use yii\bootstrap\Modal;
   use yii\helpers\Json;
   use yii\helpers\Url;
   
   
   
   $this->title = 'Modules';
    $session = Yii::$app->session;
   
   ?>
<link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<script src="plugins/select2/select2.min.js" type="text/javascript"></script>

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
	  /* background-color: #264056; */
	  box-shadow:1px 1px 4px 0px #ccc;
    color: #000;
	border-radius:10px;
    text-align: center;
   }
   .total-area{background-color: #fff;
    color: #000;}
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
</style>
<script type="text/javascript">
   function date_time(id)
   {
      date = new Date;
      year = date.getFullYear();
      month = date.getMonth();
      months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
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

<div class="container">
   <div class="row">
   
      <div class="col-sm-12">
	  <span> <strong>BILL/DMC-234560</strong>  </span><strong><span class="pull-right" id="date_time"></span></strong>
         <div class="panel panel-border panel-custom">
            <div class="panel-heading text-right"></div>
            <div class="panel-body">
               <div class="row">
                  <form class="form-inline"  >
                   
                   
					  
					  
					 
					 
					 
                     <div class="col-sm-12   " style="margin-top:0px;"    >
					    <div class="inpatientblock bg-block desc" hidden> 
						  
						<div class="row">
						 <div class="form-group col-sm-4  " >
						   <label for="name">MRN:</label>
                           <div class="input-group add-on fwidth" >
								<input class="form-control mrn" placeholder="Search" name="srch-term" tabindex="6"  id="mrnumber" type="text">
								<div class="input-group-btn fetch_record">
									<span class="btn btn-default inpatient-details" tabindex="7" ><i class="glyphicon glyphicon-search"></i></span>
								</div>
							</div>
                        </div>
						 <div class="form-group col-sm-4"  >
                           <label for="name">Patient Name:</label>
                           <input type="text" class="form-control fwidth mrn  " id="" disabled>
                        </div>
						 <div class="form-group col-sm-4">
                           <label for="">Mobile Number:</label>
                           <input type="number" class="form-control fwidth mrn " id="" disabled>
                        </div>
						</div>
						</br>
						<div class="row">
						<div class="form-group col-sm-4">
                           <label for="">Doctor Name:</label>
                           <div class="input-group fwidth">
                              <span class="input-group-btn">
                                 <select class="btn mrn" disabled>
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                 </select>
                              </span>
                              <input type="text" class="form-control mrn " disabled>
                           </div>
                        </div>
						
                        <div class=" form-group col-sm-4" >
                           <label for="name">Insurance Type:</label>
                           <br>
                           <select class="form-control fwidth key mrn" id="" disabled>
                              <option>-Select-</option>
                              <option>Type 1</option>
                              <option>Type 2</option>
                              <option>Type 3</option>
                           </select>
                        </div>
                        <div class="form-group col-sm-4" >
                           <label for="name">Date of Birth:</label>
                           <input type="text" class="form-control fwidth key mrn" id="" disabled>
                        </div>
                        </div>
                        </div>
                     </div>
                      
                  </form>
               </div>
               </br>
               <div class=" ">
                  <div class=" " style="background-color:#ebeff2;">
                     <div class=" ">
                        <div class="row form-group  col-sm-10">
						  <div class="col-sm-offset-3">
                        <!--    <label for="">Choose Medicine:</label>  -->
						   <input type="text" class="form-control input-lg fwidth  " placeholder="Enter Prescription" tabindex="5" id="medicines">
                           
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
                              <th rowspan="2" >Stock / Drug</th>
                              <th rowspan="2" >Batch/AvailStock</th>
                              <th rowspan="2" >Exp.Date</th>
                              <th rowspan="2" >Qty</th>
                              <th rowspan="2" >UnitForm</th>
                              <th rowspan="2" >Price</th>
                              <th rowspan="2" >Disc Type</th>
                              <th rowspan="2" >Disc</th>
                              <th rowspan="2" >Disc value</th>
                              
                              <th colspan="2" class="text-center">CGST</th>
                              <th colspan="2" class="text-center">IGST</th>
                              <th colspan="2" class="text-center">SGST</th>
                              <th>Total</th>
                              <th></th>
                           </tr>
                           <tr>
                               
                              <th >Rate % </th>
                              <th >Amount </th>
                              <th>Rate % </th>
                              <th> Amount</th>
							  <th>Rate % </th>
                              <th> Amount</th>
                              <th> </th>
                              <th> </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td  >1</td>
                              <td  >stock</td>
                              <td >Batch 1</td>
                              <td>Exp date</td>
                              <td>qty</td>
                              <td>unitform</td>
                               
                              <td>price</td>
                              <td>
                                 
								<input type="radio" name=" " value="Flat"> Flat<br>                              
								<input type="radio" name=" " value="%"> %<br>                              
								
								</td>
                              <td>rate</td>
                              <td>rate</td>
                              <td>rate</td>
                              <td>amt</td>
                              <td>rate</td>
                              <td>amt</td>
							  <td>rate</td>
                              <td>amt</td>
                              <td>Total</td>
                              <td><span class="delrow"><i class="fa fa-times-circle"></i></span></td>
                           </tr>
                           <tr>
                              <td  >2</td>
                              <td  >stock</td>
                              <td >Batch 1</td>
                              <td>Exp date</td>
                              <td>qty</td>
                              <td>unitform</td>
                               
                              <td>price</td>
                              <td>
                                 
								<input type="radio" name=" " value="Flat"> Flat<br>                              
								<input type="radio" name=" " value="%"> %<br>                              
								
								</td>
                              <td>rate</td>
                              <td>rate</td>
                              <td>rate</td>
                              <td>amt</td>
                              <td>rate</td>
                              <td>amt</td>
							  <td>rate</td>
                              <td>amt</td>
                              <td>Total</td>
                              <td><span class="delrow"><i class="fa fa-times-circle"></i></span></td>
                           </tr>
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
                              <td>Total</td>
                              <td></td>
                               
                           </tr>
                           
                           
                           
                           
                        </tbody>
                     </table>
                  </div>
               </div>
			   
			  <!-- <div class="row">
                  <div class="col-sm-12">
                     <table class="table table-bordered table-striped" id="tbUser">
                        <thead>
                           <tr>
                              <th rowspan="2"  >SI.No</th>
                              <th rowspan="2" >Stock / Drug</th>
                              <th rowspan="2" >Batch/AvailStock</th>
                              <th rowspan="2" >Exp.Date</th>
                              <th rowspan="2" >Qty</th>
                              <th rowspan="2" >UnitForm</th>
                              <th rowspan="2" >Price</th>
                              <th rowspan="2" >Disc Type</th>
                              <th rowspan="2" >Disc</th>
                              <th rowspan="2" >Disc value</th>
                              
                              <th colspan="2" class="text-center">GST</th>
                              <th colspan="2" class="text-center">CGST</th>
                              <th>Total</th>
                              <th></th>
                           </tr>
                           <tr>
                               
                              <th >Rate % </th>
                              <th >Amount </th>
                              <th>Rate % </th>
                              <th> Amount</th>
                              <th> </th>
                              <th> </th>
                           </tr>
                        </thead>
                        <tbody>
                            
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
                              <td>Total</td>
                              <td></td>
                               
                           </tr>
                           
                           
                           
                           
                        </tbody>
                     </table>
                  </div>
               </div> -->
			   
			   
			   
			   
			    
			   <div class=" ">
                  <div class="panel panel-border panel-custom total-area"  >
                     <div class="panel-body">
					   <div class="row">
                        <div class="    col-sm-8">
                           
						      <div class="row">
								<div class="form-group col-sm-4">
									<label   for=" ">No Of Items:</label>
									<input type=" " class="form-control" disabled id=" ">
								</div>
								<div class="form-group col-sm-4">
									<label   for=" ">Total Quantity:</label>
									<input type=" " class="form-control" disabled id=" ">
								</div>
								<div class="form-group col-sm-4">
									<label   for=" ">Total GST:</label>
									<input type=" " class="form-control" disabled id=" ">
								</div>
							   </div>
							   
							   
							   <div class="row">
								<div class="form-group col-sm-4">
									<label   for=" ">Sub Total:</label>
									<input type=" " class="form-control" disabled id=" ">
								</div>
								<div class="form-group col-sm-4">
									<label   for=" ">Rounded Off:</label>
									<input type=" " class="form-control" disabled id=" ">
								</div>
								<div class="form-group col-sm-4">
									<label   for=" ">Discount:</label>
									<input type=" " class="form-control" disabled id=" ">
								</div>
							   </div>
							 
                        </div>
                       
						
						<div class=" gross-area   col-sm-4">
                           <div class="form-group col-sm-12">
									<label   for=" ">Net Amount</label>
									<input type=" " class="form-control" disabled id=" ">
								</div>
								
								<div class="form-group col-sm-6">
								     <label  style="visibility:hidden;"  for=" ">Net Amount</label>
									<button class="btn btn-primary fwidth">Print </button>
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
 
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <h4 class="modal-title">Medicine Name</h4>
         </div>
         <div class="scroll-modal modal-body">
            <!-- <div class="row">
               <div class="col-lg-offset-3 col-lg-6">
                  <div class="panel panel-info" style="border:1px solid #b8c0c7;">
                     <div class="panel-heading" style="color:#fff;">Batch1</div>
                     <div class="panel-body">
                        <table class="table table-bordered">
                           <thead>
                              
                              <tr>
                                 <th>Manufactured Date</th>
                                 <th>:</th>
                                 <th>20-08-2017</th>
                              </tr>
                              <tr>
                                 <th>Expiry Date</th>
                                 <th>:</th>
                                 <th>20-08-2020</th>
                              </tr>
							  <tr>
                                 <th>Availability</th>
                                 <th>:</th>
                                  <th>20 <span>Stripes</span></th>
                              </tr>
                           </thead>
                        </table>
						 
                        <div class="row">
                         
						   
						   <div class=" "  >
  <div class="form-group">
    <label class="control-label col-sm-5" for="">Required Quantity:</label>
    <div class="col-sm-7">
     <div class="input-group">
                <input type="text" value="" class="form-control " name="text"   tabindex="8">
                <div class="input-group-btn bs-dropdown-to-select-group">
                    <button type="button" class="btn   dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
                        <span data-bind="bs-drp-sel-label">Select...</span>
                        <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="">
                        <li data-value="1"><a href="#">Stripes</a></li>
                        <li data-value="2"><a href="#">ml</a></li>
                        <li data-value="3"><a href="#">Three</a></li>
                    </ul>
                </div>
            </div>
    </div>
  </div>
   
  </div>
						   
						 
						    
                        </div>
                     </div>
                  </div>
               </div>
			  </div>  -->
			  <div class="row">
               <div class="  col-lg-12">
                  <div class="panel panel-info" style="border:1px solid #b8c0c7;">
                     <div class="panel-heading" style="color:#fff;">Batch 2</div>
                     <div class="panel-body">
                        <table class="table table-bordered">
							<thead>						   
						      <tr>
								<th>#</th>
								<th>Batch</th>
								<th>Manufactured Date</th>
								<th>Expiry Date</th>
								<th>Price</th>
								<th>Availability</th>
								<th>Required Quantity</th>
							  </tr>
							 </thead>
						   
                             <tbody>
                              <tr>
								<th>1</th>
								<th>I</th>
								<th>20-09-2017</th>
								<th>20-08-2020</th>
								<th>Price</th>
								<th>Availability</th>
								<th width="30%">
								 <div class="input-group">
                <input type="text" value="" class="form-control " name="text"   tabindex="8">
                <div class="input-group-btn bs-dropdown-to-select-group">
                    <button type="button" class="btn   dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
                        <span data-bind="bs-drp-sel-label">Select...</span>
                        <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="">
                        <li data-value="1"><a href="#">Stripes</a></li>
                        <li data-value="2"><a href="#">ml</a></li>
                        <li data-value="3"><a href="#">Three</a></li>
                    </ul>
                </div>
            </div></th>
							  </tr>
							  
							  <tr>
								<th>1</th>
								<th>I</th>
								<th>20-09-2017</th>
								<th>20-08-2020</th>
								<th>Price</th>
								<th>Availability</th>
								<th width="30%">
								 <div class="input-group">
                <input type="text" value="" class="form-control " name="text"   tabindex="8">
                <div class="input-group-btn bs-dropdown-to-select-group">
                    <button type="button" class="btn   dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
                        <span data-bind="bs-drp-sel-label">Select...</span>
                        <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="">
                        <li data-value="1"><a href="#">Stripes</a></li>
                        <li data-value="2"><a href="#">ml</a></li>
                        <li data-value="3"><a href="#">Three</a></li>
                    </ul>
                </div>
            </div></th>
							  </tr>
							  
							  
							  
                           </tbody>
                        </table>
						 
                     </div>
                  </div>
               </div>
			  </div>
         </div>
         <div class="modal-footer" style="border-top:1px solid #ccc;">
		 <button type="button" class="btn btn-primary  " data-dismiss="modal" >Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">window.onload = date_time('date_time');</script>
<script type="text/javascript" src="js/shortcut.js" ></script>
<script type="text/javascript">

$(document).ready(function(){
	
$('[tabindex="5"]').focus();
	
        
});




</script>
<script type="text/javascript">
   $(document).ready(function(){
	   
   	   $(".select2").select2();
   	 $("#medicines").on("change", function () {  
        
      $modal = $('#myModal');
   $modal.modal('show');
  $('[tabindex="8"]').focus();	
  
      /*if($(this).val() === '1'){
          $modal.modal('show');
      }*/
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
      $(document).ready(function () {/*
var inputs=$('body').on('keypress',':input',function(e){
			 if (e.which == 13) {
                 e.preventDefault();
				 //alert(inputs.index(this));
                 var nextInput = inputs.get(inputs.index(this));
				// alert('nextInput');
                 if (nextInput) {
                     nextInput.focus();
                 }
             }
		 }) 
         var inputs = $(':input').keypress(function (e) {
             if (e.which == 13) {
                 e.preventDefault();
				// alert(inputs.attr('nextInput'));
				//alert(document.activeElement.tabIndex);

                 var nextInput = inputs.get(inputs.index(this) + 1);
                 if (nextInput) {
                     nextInput.focus();
                 }
             }
         }); 

              }); */
			  
			  
			  
			  
			  
			  
			  
			  $('input').on("keypress", function(e) {  
               //alert("hi")			  
			  /* ENTER PRESSED*/
				if (e.keyCode == 13) {
				  // FOCUS ELEMENT /                
					inputs = $(this).parents("form").eq(0).find(":input");                
					var idx = inputs.index(this);                
					if (idx == inputs.length - 1) {                    
						inputs[0].select()                
					} else {                    
						inputs[idx + 1].focus();
						//  handles submit buttons
						inputs[idx + 1].select();                
					}                
					return false;            
				}        
			});
			  
});
 </script> 
 

	<script>
	$(document).ready(function(){
		$("#tbUser").on('click', '.delrow', function () {
    $(this).closest('tr').remove();
});
	});
	
	</script>

