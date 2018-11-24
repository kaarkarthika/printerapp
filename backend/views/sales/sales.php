<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\CompanyBranch;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;
use backend\models\Stockrequest;
use backend\models\Physicianmaster;
$datatables = $dataProvider->getModels();
$session = Yii::$app->session;
use backend\models\Sales;
use backend\models\Saledetail;
use backend\models\Patient;
$this->title = Yii::t('app', 'Sales');
die;
?>
<style>
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
</style>
<style>
	#load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}
	.dt-buttons{display:none;}
	.wizard .actions{display:none;}
	#datatable-buttons_filter{text-align:left;}
	.chooseaction1:hover{background-color: #ffffff !important;color:#5fbeaa !important}
	.chooseaction1{background-color: #5fbeaa !important;color:#ffffff !important}
	div.dataTables_wrapper div.dataTables_filter input {width:345px !important}
</style>
 <div class="container">
	<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>
<div id="load"  align="center"><img src="<?= Url::to('@web/dmc.gif') ?>" />Loading...</div>
<div class="row">
<div class="col-sm-12">
<ul class="nav nav-tabs tabs tabs-top">
	       	 <li class="active tab">
                                        <a href="#sales" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                            <span class="hidden-xs">Add Sale</span> 
                                        </a> 
                           <li class=" tab"> 
                                        <a href="#patient" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-user-md"></i></span> 
                                            <span class="hidden-xs">New Patient</span> 
                                        </a> 
                                 </li> 
                                </ul> 
  <div class="tab-content"> 
                                	     <div class="tab-pane active" id="sales"> 
  <?php $form = ActiveForm::begin(['id'=>'searchform', 'action' => ['search'],  'method' => 'post']); ?>

	           
	           	<div class="col-md-3"> <div class="row"><h4>Sale Type</h4></div>
 <label><input name="patienttype"  value="1" type="radio"> InPatient</label>
  <label><input name="patienttype"  value="2"  type="radio"> OutPatient</label>
    </div>
   
     <div class="col-md-9">  <div class="row"><h4>Search Patient</h4></div>
		<div class="col-md-3">	
    <?= $form->field($model, 'updated_by')->textinput(['name'=>'patientmobileno','placeholder'=>'Mobile Number','id'=>'pmobileno'])->label(FALSE); ?>
    </div>
   <div class="col-md-3">
    <?= $form->field($model, 'updated_by')->textinput(['name'=>'mrno','placeholder'=>'MR Number','id'=>'pmrnumber'])->label(false); ?>
   </div>
    <div class="col-md-3">
    <?= $form->field($model, 'updated_by')->textinput(['name'=>'patient_name','placeholder'=>'Name','id'=>'pname'])->label(false); ?>
   </div>
	  <div class="col-md-3 form-group">
        <?= Html::Button('Go', ['class' => 'btn btn-default waves-effect waves-light dmc','id'=>'dmcsearch']) ?>
    </div>
    </div>
	 <?php ActiveForm::end(); ?>
	 <div id="search_result">
   </div>
   <div class="row" id="formdetails" style="display: none">
</div>
<div class="clearfix"></div>
                                    </div> 
                                    <div class="tab-pane" id="patient">
                                    	           <div class="row">
                                                   <div class="col-md-12">
	 <?php $form = ActiveForm::begin(['id'=>'wizard-validation-form']);?>
	 
	 
	  <div class="col-md-3">       	  
  <?php   echo $form->field($pmodel, 'patient_type')->radioList(  ['1' => 'Inpatient', "2" => 'OutPatient']); ?>
    </div>    
                                      <div class="col-md-3">
                  	 	
                <?php 
					
					echo $form->field($pmodel, 'medicalrecord_number')->textInput(['maxlength' => true])->label("Medical Record Number");
					 
                  ?>
    </div>
    
    
    
       
      <div class="col-md-3">       	  
  <?php   echo $form->field($pmodel, 'gender')->radioList(  ['M' => 'Male', "F" => 'Female','T'=>'Transgender']); ?>
    </div>   
    
     
    
         <div class="col-md-3">
    
       <?= $form->field($pmodel, 'physicianname')->dropdownlist($physicianlist,['prompt'=>'Select Physician','class'=>'selectpicker',
       'data-live-search'=>'true','data-style'=>"btn-default btn-custom"])->label("Physician Name") ?>
       
      </div> 	     
            <div class="clearfix"></div>
  
    <div class="col-md-3">
    	 <?= $form->field($pmodel, 'firstname')->textInput(['maxlength' => true,'required'=>'true'])->label("First Name *"); ?>
    	
    </div>
    <div class="col-md-3">
    	 <?= $form->field($pmodel, 'lastname')->textInput(['maxlength' => true,'required'=>'true']) ->label("Last Name *");?>
    </div>
     
      
    <div class="col-md-3">
    	
    	<?php if(!$pmodel->isNewRecord)
    	{$dob= $pmodel->dob;
    		$pmodel->dob=date("mm/dd/yyyy",strtotime($dob));}?>
    		 <?= $form->field($pmodel, 'dob')->textInput(['maxlength' => true,'data-provide' => "datepicker", 
             'data-date-format' => "mm/dd/yyyy",'id'=>'dateofbirth', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getage').'", { dob: $(this).val() } )
                                                        .done(function( data ) 
                                                        {
                                                        	
                                                           $("#age").val(data);
														   $("#age").load();
														                                                     
                                                        }
                                                    );'])->label("DOB"); ?>
    		
    		
    </div>
     <div class="col-md-3">
    
     <?= $form->field($pmodel, 'age')->textInput(['maxlength' => true,'readonly'=>'true','placeholder'=>'Age','id'=>'age'])->label("Age"); ?>
       
      </div>
 <div class="clearfix"></div>
    	   	  <div class="col-md-3">
<?= $form->field($pmodel, 'patient_mobilenumber')->textInput(['maxlength' => 10,'required'=>'true', 'onkeypress'=>'return isNumber(event)', ])->label("Patient Phone Number"); ?>
     
 </div>
              
                                     

       <div class="col-md-3">
       <?= $form->field($pmodel, 'insurance_type')->dropdownlist($insurancelist,['id'=>'insurancetype','class'=>'insurancetype form-control',
      'required'=>'true'])->label("Insurance Type *");?>
      </div>
      
         <div class="col-md-3" id="refer" style="display:none;">
      	 <?= $form->field($pmodel, 'reference_number')->textInput(['maxlength' => true])->label("Reference Number"); ?>
      	
      </div>
       <div class="col-md-3">
    	  <?= $form->field($pmodel, 'emailid')->textInput(['maxlength' => true])->label("Email ID "); ?>
    </div>
   
    
   
    
    	  <div class="clearfix"></div>
    	
    	  
      <div class="col-md-3">
      	 <?= $form->field($pmodel, 'guardian_name')->textInput(['maxlength' => true])->label("Guardian Name"); ?>
      	
      </div>
          <div class="col-md-3">
        
    	<?= $form->field($pmodel, 'guardian_mobilenumber')->textInput(['maxlength' => 10, 'onkeypress'=>'return isNumber(event)',])->label("Guardian Mobile Number"); ?>
  </div>

       <div class="col-md-3">
   	 <?= $form->field($pmodel, 'address')->textarea(['rows' => 1,'placeholder' =>'Address']); ?>
   </div> 
       <div class="col-md-3">
   	 <?= $form->field($pmodel, 'notes')->textarea(['rows' => 1,'placeholder' =>'Short Notes']); ?>
   </div> 
  <div class="col-md-3">
 <?= Html::Button($pmodel->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-save "></i>Update',
  ['class' => $pmodel->isNewRecord ? 'btn btn-success savevalue_np' : 'btn btn-primary ']) ?>
 </div>
  <div class="col-md-3">
	 <span id="loadtex" style="display: none; "></span>
	 </div>
 <?php ActiveForm::end(); ?> 
      
                        	</div>
                    	</div>
</div>
</div>
</div>
</div>
</div>

<script>
    $(document).ready(function()
    {
             $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Stock Audit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();
             
         });
         
         
         
         $('body').on("click",'.choose_ep',function()
	{
   
	var dataid=$(this).attr('data-id');
	var price = $('.price').val();
	var branch = $('.branchid').val();
	var ptype = $("#searchform input[name='patienttype']:checked").val();
	//$("#load").fadeIn("slow");
	var inc = $(this).attr('dataincrement');
	$('#productgrid_ep tr').show();

	var form = $("#wizard-validation-form1");
    var formData1 = form.serialize();
    $form_container=$("#wizard-validation-form1");
    $form_container.validate().settings.ignore = ":disabled,:hidden";
   //	$("#load").fadeOut("slow");	
  /*    var chkform=$form_container.valid();
  if(chkform==true){*/
   	$("#buttonsubmit"+ inc).attr('disabled', 'disabled');
    $("#buttonsubmit"+ inc).removeClass("btn-default");
    $("#buttonsubmit"+ inc).addClass("btn-danger");
   	
   	
   	
   	
   	if(ptype==1)
	  {
		  $("#gstperep").hide();
		  $("#gstvalep").hide();
		  $("#totalgstep").hide();
		  $("#totalcgstep").hide();
		  $("#totalsgstep").hide();
		  $("#totalprice_ep_gstlabel").hide();
		  $("#td1").hide();
		  $("#rem1").hide();
		  $("#rem2").hide();
		  $("#totalprice_ep_cgstlabel").hide();
		  $("#totalprice_ep_sgstlabel").hide();
		  $("#totalprice_ep_cgst").hide();
	}
	else{
		  $("#gstperep").show();
		  $("#gstvalep").show();
		  $("#totalgstep").show();
		  $("#totalprice_ep_gstlabel").show();
		  $("#td1").show();
		  $("#rem1").show();
		  $("#rem2").show();
		  $("#totalprice_ep_cgstlabel").show();
		  $("#totalprice_ep_sgstlabel").show();
		  $("#totalcgstep").show();
		  $("#totalsgstep").show();
	}
		$.ajax(
		{
        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/productdetail_ep&id='+dataid+"&branch_id="+branch+"&ptype="+ptype+"&autonumber="+inc,
        type: "post",
         data: formData1,
         
        success: function (data)
         {
         	
      //alert(data);return false;
      $('#ep_theaddata').show();
        var r = $("#formdetails_ep").append(data);
         $('#totalprice_ep_row').show();
         $('#totalprice_ep_cgst').show();
         $('#totalprice_ep_sgst').show();
         $('#totalprice_ep_label').show();
         $('#ovaralltotalprice_ep').show();
         $('#btn_ep').show();
       //  $("#load").fadeOut("slow");

         
         
         
         
        if(data=="Y")
        {
	//	$("#load").fadeOut("slow");	
		}
     //   $("#load").fadeOut("slow");
        $("#gen").attr('disabled',true).selectpicker('refresh');
        $("#vendor_idz").selectpicker('refresh');
        $("#product_idz").selectpicker('refresh');
        $("#formdetails").fadeIn("slow");
        $('input[type=search]').val('');
        $(".dataTables_scroll").hide();
        $(".dataTables_info").hide();
        
        }
     }
     
     
     
     );
   /*}
   
     /*	else{
			swal("Please Fill Required Fields!");
			$("#load").fadeOut("slow");	
		    $("#formdetails").fadeIn("slow");
		       }*/
	})
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
              $('body').on("click",'.savevalue_ep',function(){
     	
 var form = $("#wizard-validation-form1");
 var formData = form.serialize();
 $form_container=$("#wizard-validation-form1");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
   	   	 	var k=0;
var inps = document.getElementsByName('dataincrement[]');
for (var i = 0; i <inps.length; i++)
 {
var inp=inps[i];
var inc=inp.value;
var totalstock1=parseFloat($("#availablestock" + inc).val());
var uq_2=parseFloat($("#totalunits" + inc).val());
          if(uq_2>totalstock1)
          {
          	var k=1;
          }
          
          if(uq_2<=0)
          {
          	var k=2;
          }
}

var overalltotal=parseFloat($("#overalltotalep").val());

if(overalltotal<=0)
{
	k=3;
}
if(k==0)
{
	$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/savesales',
        type: 'post',
        data: formData,
        success: function (data) {
        $("#load").show();
        if(data=="A"){
		$("#load").hide();
		$("#loadtex").text("Some Stock Recently Assigned to Sale. Stock Not available Now.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
		}
		else{
			var data1=data.split("=")[0];
        	var data2=data.split("=")[1];
			if(data1=="Y")
	    {
	    $("#load").hide();
	    $(".savevalue_ep").hide();
		$("#loadtex1").text("Successfully Saved.");
		$("#loadtex1").css('color','green ');
	    $("#loadtex1").show(4);
	    $("#invoice1").show();
	    $("#invoice1").find('a.btn').remove();
	    $("#invoice1").append("<a target='_blank' class='btn btn-default' href='<?php echo Yii::$app->homeUrl ?>?r=sales/invoice&id="+data2+"'>Invoice</a>" );
	    
	  
	    
	    
		}
		}
        }
     });
}
 else if(k==2)
 {
  	   swal({
                title: "Are you sure?",
                text: "Total Units Required",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
   }
   
    else if(k==3){
  	   swal({
                title: "Are you sure?",
               text: "Total Units Required Some Stock",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
                }
        else{
  	         swal({
                title: "Are you sure?",
                text: "Check Your Units is greater than Available Stock",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
   }
   
    }
	});
         
           });
         
</script>
<script>

function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8);
};
 $(document).ready(function()
 {
$('#searchform').on('keyup', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    $("#dmcsearch").click();
  }
});



 $('body').on("click",'.dmc',function(){
 	
 	

 var form = $("#searchform");
 var formData = form.serialize();
 var ptype = $("#searchform input[name='patienttype']:checked").val();
 
 
if (typeof(ptype) == "undefined")
 {
 swal("Sale Type Required");
 }
 else
 {
 	 
 	
 	
 	 $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data)
         {
        	$("#search_result").html(data);
        	
        	TableManageButtons.init();
        	$(".dt-buttons").hide();
        	
        }
     });
     
    
 }
  


	});
	

	
	
	
	
	
	
	
	
		 $('body').on("click",'.savevalue_np',function(){
 var form = $("#wizard-validation-form");
 var formData = form.serialize();
 $form_container=$("#wizard-validation-form");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/create',
        type: 'post',
       data: formData,
        success: function (data) {
        
        	if(data=="Y")
        	{
        $("#load").hide();
		$("#loadtex").text("Successfully Saved.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	    $("input[type=text], textarea").val("");
	    
	    
	    
        	}
        	
        		else if(data=="MR")
        	{
        $("#load").hide();
		$("#loadtex").text("MR Number Exists.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
        	}
        	
        	else if(data=="MN")
        	{
        $("#load").hide();
		$("#loadtex").text("Mobile NUmber Already Exists");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
        	}
        	
        	else if(data=="R")
        	{
        		
        $("#load").hide();
		$("#loadtex").text("MR Number Required For In Patient.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	    
        	}
        	
		
        }
     });
  
  

    }
	});
	$('body').on("click",'.product_add',function(){
 $("#load").fadeIn("slow");
  var form = $("#wizard-validation-form1");
  var formData = form.serialize();
 $.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/productdetails',
        type: 'post',
       data: formData,
        success: function (data) {
        	$("#load").fadeOut("slow");
        	$("#productlist").html(data);
        	$(".dt-buttons").hide();
        }
     });
	});
		$('body').on("click",'.product_add1',function(){
 $("#load").fadeIn("slow");
  var form = $("#wizard-validation-form");
 var formData = form.serialize();
 $.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/productdetails1',
        type: 'post',
       data: formData,
        success: function (data) {
        	$("#load").fadeOut("slow");
        	$("#productlist1").html(data);
        	$(".dt-buttons").hide();
        }
     });
	});
$('body').on("input",'.productqty',function(evt){	
   var self = $(this);
   self.val(self.val().replace(/[^0-9]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
   var valz=$(this).val();
   var attz=$(this).attr('datacls');
   var perprice=$(this).attr('dataprice');
   var totalprice=(perprice)*(valz);
   $("#"+attz).text("Rs."+totalprice);
   $("#"+attz+"1").val(totalprice);
   var totla_each = 0;
   $('.pricez').each(function(){
   	 totla_each += parseFloat(this.value) || 0;
});
$("#total").text("Rs."+totla_each);
$("#totalprice").val(totla_each);
 });
 $('body').on("input",'.productqty_ep',function(evt)
 {		
   var self = $(this);
   self.val(self.val().replace(/[^0-9]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
   var valz1=$(this).val();
   var attr=$(this).attr('datacls_ep');
   var perprice1=$(this).attr('dataprice_ep');
   var totalprice1=(perprice1)*(valz1);
   var temp=attr+"1";
   $("#"+attr).text("Rs."+totalprice1);
   $("#"+temp).val(totalprice1);
   var totla_each1 = 0;
   $('.price_ep').each(function(){
   	 totla_each1 += parseFloat(this.value) || 0;
   
});
$("#total_ep").text("Rs."+totla_each1);
$("#totalprice_ep").val(totla_each1);
 });
 
  $('body').on("input",'.productqty_np',function(evt)
  {	
   var self = $(this);
   self.val(self.val().replace(/[^0-9]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
   var valz1=$(this).val();
   var attr=$(this).attr('datacls_np');
   var perprice1=$(this).attr('dataprice_np');
   var totalprice1=(perprice1)*(valz1);
   var temp=attr+"1";
   $("#"+attr).text("Rs."+totalprice1);
   $("#"+temp).val(totalprice1);
   var totla_each1 = 0;
   $('.price_np').each(function(){
   	 totla_each1 += parseFloat(this.value) || 0;
});

$("#total_np").text("Rs."+totla_each1);
$("#totalprice_np").val(totla_each1);
 });
$('body').on("click",'.chooseaction',function(){
	var dataid=$(this).attr('data-id');
	$("#load").fadeIn("slow");
	$("#formdetails").fadeOut("slow");
	$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/patientdetails&id='+dataid,
        type: "post",
        success: function (data) {
        $("#formdetails").empty();
        $("#formdetails").html(data);
         $("#load").fadeOut("slow");
          $("#gen").attr('disabled',true).selectpicker('refresh');
        $("#vendor_idz").selectpicker('refresh');
        $("#product_idz").selectpicker('refresh');
        $("#formdetails").fadeIn("slow");
        }
     });
	})
	
	$('body').on("click",'.choose_np',function(){
	var y = $('#productgrid_np >tbody >tr').length;
	var dataid=$(this).attr('data-id');
	var price = $('.price').val();
	var branch = $('.branchid').val();
	$("#load").fadeIn("slow");
	$("#formdetails").fadeOut("slow");
	var inc = $(this).attr('dataincrement');
	var selectedVal = "";
    var selected = $("#radioDiv input[type='radio']:checked");
    if (selected.length > 0) 
    {
    selectedVal = selected.val();
    }
if(selectedVal==1 || selectedVal==2)
{
 var form = $("#wizard-validation-form");
 var formData = form.serialize();
 $form_container=$("#wizard-validation-form");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   	  $("#load").fadeOut("slow");	
   var chkform=$form_container.valid();
   if(chkform==true){
		$("#btnsubmit"+ inc).prop('disabled', true);
	    $('#np_theaddata').show();
        $('#totalprice_np_row').show();
        $('#btn_np').show();
        $('#totalprice_np_cgst').show();
        $('#totalprice_np_sgst').show();
        $('#totalprice_np_label').show();
        $("#ovaralltotalprice_np").show();
        
	if(selectedVal==1)
	{
		  $("#gstper").hide();
		  $("#gstval").hide();
		  $("#totalprice_np_cgst").hide();
		  $("#totalprice_np_sgst").hide();
		  $("#totalgstnp").hide();
		  $("#totalprice_np_gstlabel").hide();
		   $("#td1").hide();
		    $("#rem1").hide();
		    $("#rem2").hide();
		  $("#totalprice_np_cgstlabel").hide();
		  $("#totalprice_np_sgstlabel").hide();
		   
	}
	else{
		 $("#gstper").show();
		 $("#gstval").show();
		 $("#totalprice_np_cgst").show();
		 $("#totalprice_np_sgst").show();
		 $('#totalprice_np_label').show();
		 $("#ovaralltotalprice_np").show();
		 $("#totalprice_np_gstlabel").show();
		 $("#totalprice_np_cgstlabel").show();
		 $("#totalprice_np_sgstlabel").show();
		 $("#totalgstnp").show();  
		  $("#rem1").show();
		    $("#rem2").show();
		   $("#td1").show();
	}
   		$.ajax({
   			
       url:'<?php echo Yii::$app->homeUrl ?>?r=sales/productdetail_np&id='+dataid+"&price="+price+"&branch_id="+branch+"&ptype="+selectedVal+"&autonumber="+inc,
        type: "post",
        success: function (data) {
       // $("#formdetails1").empty();
       
        var r = $("#formdetails_np").append(data);
       if(data=="Y"){
		        	 $("#load").fadeOut("slow");	
		        	 noti();
		        	// $("#formdetails1").fadeOut("slow");
		        	}

         $("#load").fadeOut("slow");
          $("#gen").attr('disabled',true).selectpicker('refresh');
        $("#vendor_idz").selectpicker('refresh');
        $("#product_idz").selectpicker('refresh');
        $("#formdetails").fadeIn("slow");
        }
     });
   }
   	
   	else{
			swal("Please Fill Required Fields!");
			$("#load").fadeOut("slow");	
		    $("#formdetails").fadeIn("slow");
		       }
}
else{
	  swal("Please Fill Patient Type ");
	  $("#load").fadeOut("slow");	
	  $("#formdetails").fadeIn("slow");
}
	})
	
	
	<?php 
if(isset($_GET['status'])){?>
 noti();
<?php }?>
});
function noti () {
 swal("Successfully Added!", "", "success")
}
$('body').on("click",'.demo',function(e){
return false;
	
});
</script> 

