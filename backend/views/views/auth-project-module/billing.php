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
   .total-netamt{text-align: center;
    font-size: 26px;
    color: #36404a;}
   .form-control:focus,input[type="checkbox"]:focus,.select2-container .select2-selection--single:focus {    border: 2px solid #5fbeaa!important;}
   .gross-area{
   background-color: #264056;
   color: #fff;
   border-radius:10px;
   text-align: center;
   }
   .total-area{background-color: #3e678a;
   color: #fff;}
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
   #myModal.modal-lg {
   width: 1200px!important;
   }
   
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
                     <form class="inline-form">
                     <div class="col-sm-12">
                        <div class=" ">
                           <div class="radio radio-info radio-inline">
                              <input type="radio" id="outPatient" class="outPatient" value="outpatient" name="patient" checked=""  >
                              <label for="inlineRadio1" id="outPatient">  Out-Patient <i><strong>[Alt+1]</strong></i> </label>
                           </div>
                           <div class="radio radio-info radio-inline">
                              <input type="radio" id="inPatient" class="inPatient" value="inpatient" name="patient"  >
                              <label for="inlineRadio1" id="inPatient"> In-Patient <i><strong>[Alt+2]<strong></i></label>
                           </div>
                           <span class=" pull-right"> <span><i>[Alt+3]</i></span>
                           <a class=" btn btn-primary text-white" href="<?php echo Yii::$app->homeUrl;?>?r=auth-project-module/draft">Temp</a></span>						 
                        </div>
                     </div>
                     <div class="col-sm-12"  style="margin-top:30px;" >
                        <div class="outpatientblock bg-block desc"   >
                           <div class="row">
                              <div class="form-group col-sm-4"  >
                                 <label for="name">Patient Name:</label>
                                 <input type="text" class="form-control fwidth key patient_name" data-index="2" tabindex="1" id="">
                              </div>
                              <div class="form-group col-sm-4">
                                 <label for="">Mobile Number:</label>
                                 <input type="number" class="form-control fwidth key" data-index="3" tabindex="2" id="">
                              </div>
                              <div class="form-group col-sm-4">
                                 <label for="">Doctor Name:</label>
                                 <div class="input-group fwidth">
                                    <span class="input-group-btn">
                                       <select class="btn " data-index="4" tabindex="3">
                                          <option>Mr</option>
                                          <option>Ms</option>
                                          <option>Mrs</option>
                                       </select>
                                    </span>
                                    <input type="text" class="form-control" data-index="5" tabindex="4">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
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
                           <tr>
                              <td  >1</td>
                              <td  >stock</td>
                              <td >Batch 1</td>
                              <td>Exp date</td>
                              <td>qty</td>
                              <td>unitform</td>
                              <td>price</td>
                              <td>
                                 <ul class="donate-now">
                                    <li>
                                       <input type="radio" id="a25" class="flat" name="desc"  onchange="descChanged()" />
                                       <label for="a25" class="w-50">Flat</label>
                                    </li>
                                    <li>
                                       <input type="radio" id="a50" class="percent" name="desc" onchange="descChanged()"/>
                                       <label for="a50" class="w-50">%</label>
                                    </li>
                                 </ul>
                              </td>
                              <td>
                                 <div class="input-group">
                                    <span class="input-group-addon ft-12 w-50">Val</span>
                                    <input type="text" class="enabledisc disctxt w-50" disabled>
                                 </div>
                                 <div class="input-group mt-5">
                                    <span class="input-group-addon ft-12">Amt</span>
                                    <input type="text" class=" disctxt w-50" disabled>
                                 </div>
                              </td>
                              <td>rate</td>
                              <td>amt</td>
                              <td>rate</td>
                              <td>amt</td>
                              <td>Total</td>
                              <td><span class="delrow"><i class="fa fa-times-circle"></i></span></td>
                           </tr>
                           <tr>
                              <td  >1</td>
                              <td  >stock</td>
                              <td >Batch 1</td>
                              <td>Exp date</td>
                              <td>qty</td>
                              <td>unitform</td>
                              <td>price</td>
                              <td>
                                 <!-- <ul class="donate-now">
                                    <li>
                                       <input type="radio" id="a25" class="flat" name="desc"  onchange="descChanged()" />
                                       <label for="a25" class="w-50">Flat</label>
                                    </li>
                                    <li>
                                       <input type="radio" id="a50" class="percent" name="desc" onchange="descChanged()"/>
                                       <label for="a50" class="w-50">%</label>
                                    </li>
                                 </ul> -->
                              </td>
                              <td>
                                 <!-- <div class="input-group">
                                    <span class="input-group-addon ft-12 w-50">Val</span>
                                    <input type="text" class="enabledisc disctxt w-50" disabled>
                                 </div>
                                 <div class="input-group mt-5">
                                    <span class="input-group-addon ft-12">Amt</span>
                                    <input type="text" class=" disctxt w-50" disabled>
                                 </div> -->
                              </td>
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
                              <td><strong>Price</strong></td>
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
                                 <!-- <div class="form-group col-sm-4">
                                    <label   for=" ">Total VAT:</label>
                                    <input type=" " class="form-control" disabled id=" ">
                                 </div> -->
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
                                       <input type="text" value="" class="form-control modalTextBox" name="text"   tabindex="100">
                                       <div class="input-group-btn bs-dropdown-to-select-group">
                                          <button type="button" class="btn   dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
                                          <span data-bind="bs-drp-sel-label">Select...</span>
                                          <input type="hidden" class="" name="selected_value" data-bind="bs-drp-sel-value" value="">
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
                                 </th>
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
                                       <input type="text" value="" class="form-control " name="text"   tabindex="101">
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
                                 </th>
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
		 <div class="row"  >
           <span class="col-sm-offset-10"> <i>[Alt+7]<i></span> 
             <span style="position: relative;left: 40px;"> <i>[Esc]<i></span>   
         </div>
		 
      </div>
   </div>
</div>
<script type="text/javascript">window.onload = date_time('date_time');</script>
<script type="text/javascript" src="js/shortcut.js" ></script>

<script type="text/javascript">
  $(document).ready(function(){          
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");
  });
</script>

<script type="text/javascript">
   $(document).ready(function(){
   	
   $('.inpatient-details').click(function(){
   	
   	// $(".mrn").prop('disabled',false);
   	$('[tabindex="4"]').focus();
           
   });
   
   
   $(".inpatient-details").keydown(function(){
       $('[tabindex="6"]').focus();
   });
   
   	
   });
   
   
   
   
   
   
   
   
     function descChanged()
      {
          if($('.percent').is(":checked"))   
              $(".enabledisc").prop('disabled',false);
          else if($('.flat').is(":checked")) 
              $(".enabledisc").prop('disabled',true);
   	    $('.enabledisc').focus();
      }  
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
   
   
    $('#medicines').keypress(function(e){
   if(e.keyCode == 13) {
   $modal = $('#myModal');
   $modal.modal('show'); 
   }
   });
   
   $('#myModal').on('shown.bs.modal', function() {
       //  document.activeElement.blur();
         $(this).find(".modal-body :input:visible").first().focus();
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
   
   
   <script>
   $(document).ready(function(){
   jQuery.fn.tabEnter = function() {
this.keypress(function(e){
// get key pressed (charCode from Mozilla/Firefox and Opera / keyCode in IE)
var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;

if(key == 13) {
// get tabindex from which element keypressed

var ntabindex = parseInt($(this).attr("tabindex")) + 1;
alert(ntabindex);
$("[tabindex=" + ntabindex + "]").focus();
return false;
}
});
}
$("[tabindex]").tabEnter();
  }); 
  
 
  
  
  /*$("#myModal").on('keyup', ".modalTextBox", test); 
  
  function test(){
		var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
	  var ntabindex = parseInt($(this).attr("tabindex")) + 1;
	  alert(key);
	  //$("[tabindex=" + ntabindex + "]").focus();
	  //return false;
	  
  }*/
  /* $('#medicines').keypress(function(e){
	   
	   
   }*/
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
   	 $(".outpatientblock").show();
   
   	 
   	 /*$('#outPatient').click(function(){
   		  $(".outpatientblock").show();
   		  $(".inpatientblock").hide();
   		 
   	 });
   	 
   	  $('#inPatient').click(function(){
   		  $(".outpatientblock").hide();
   		  $(".inpatientblock").show();
   		 
   	 }) */
   	 
   	 
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
    
    
    /* function valueChanged()
   {
       if($('#inPatient').is(":checked"))   
           $(".outpatientblock").hide();
           $(".inpatientblock").show();
       else if($('#outPatient').is(":checked"))
           $(".outpatientblock").show();
           $(".outpatientblock").hide();
   }
   
   */
   
   
    
    
</script>
<script type="text/javascript">
   $('[tabindex="1"]').focus();
   
   shortcut.add("Alt+1",
   function() {
         
     $('.fwidth').val('');    
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
   
     $('#outPatient').prop('checked', false);
    $('#inPatient').prop('checked', true); 
   $(".inpatientblock").show();
   $(".outpatientblock").hide();
   $('[tabindex="6"]').focus();
           
   },
   { 'type':'keydown', 'propagate':true, 'target':document}
   ); 
   
   

shortcut.add("shift+f1",
function() {
	 $('[tabindex="5"]').focus();
},

 



{ 'type':'keydown', 'propagate':true, 'target':document}
);
   
   shortcut.add("Alt+3",
   function() {
    $('#outPatient').prop('checked', false);
    $('#inPatient').prop('checked', false);
     window.open("<?php echo Yii::$app->homeUrl;?>?r=auth-project-module/draft");        
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
    
	//alert('hi');
   },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );
   
   shortcut.add("esc",
   function() {
      $("#myModal").modal('hide');
	//alert('hi');
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