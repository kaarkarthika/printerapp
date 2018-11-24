<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;
use backend\models\Stockrequest;
use backend\models\Physicianmaster;
use yii\helpers\ArrayHelper;
?>
<style>
	#load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}
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
                                            <span class="hidden-xs">Existing Patient</span> 
                                        </a> 
                                    </li> 
                                   
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
  
    <div class="col-md-3">
             <?php 
     		 echo $form->field($pmodel, 'updated_by')   ->radioList(  ['1' => 'InPatient', "2" => 'OutPatient'],             
     [ 'item' => function($index, $label, $name, $checked, $value) {
     	$class_checked='';
     	if($checked==$value){$class_checked='checked="checked"';}
$return ='<div class="radio radio-custom radio-inline"><input type="radio" name="patienttype" value="' .$value. '" tabindex="3" '.$class_checked.'><label>'.ucwords($label).'</label></div>';
                                    return $return;
                                }
                            ]
                        )
                    ->label("Patient Type");
                    echo ' <div class="help-block"></div>';
   
                   
                    ?>
                           
    </div>
   
 
	<div class="col-md-2">
			<label>Patient Number</label>
    <?= $form->field($model, 'updated_by')->textinput(['name'=>'patientno'])->label(FALSE); ?>
    </div>
   <div class="col-md-2">
   		<label>MR Number</label> 	
    <?= $form->field($model, 'updated_by')->textinput(['name'=>'mrno'])->label(false); ?>
   </div>
    <div class="col-md-2">
   		<label>Patient Name</label> 	
    <?= $form->field($model, 'updated_by')->textinput(['name'=>'patient_name'])->label(false); ?>
   </div>
    
	  <div class="col-md-3 form-group" style="margin-top: 26px;">
        <?= Html::Button('Go', ['class' => 'btn btn-default waves-effect waves-light dmc',]) ?>
    
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
										  <?php $form = ActiveForm::begin(['id'=>'wizard-validation-form']); ?>
                                        <div>
                                           
                                            <section>
                                                
                                                 <div class="col-md-3">
                  	 	
                <?php if($pmodel->isNewRecord)  
				{
					$pmodel->medicalrecord_number=$patientmax+1;
					echo $form->field($pmodel, 'medicalrecord_number')->textInput(['maxlength' => true,'readOnly'=> true])->label("Medical Record Number *");
				}	 
                  ?>
    </div>
    
    
    
                  	<div class="col-md-3">
             <?php 
             if($pmodel->isNewRecord)  {$pmodel->patient_type=1;}
     		 echo $form->field($pmodel, 'patient_type')   ->radioList(  ['1' => 'InPatient', "2" => 'OutPatient'],                   
     [ 'item' => function($index, $label, $name, $checked, $value) {
     	$class_checked='';
     	if($checked==$value){$class_checked='checked="checked"';}
$return ='<div class="radio radio-custom radio-inline"><input type="radio" name="' .$name. '" value="' .$value. '" tabindex="3" '.$class_checked.'><label style="font-size:11px;">'.ucwords($label).'</label></div>';
                                    return $return;
                                }
                            ]
                        )
                    ->label("Patient Type *");
                    echo ' <div class="help-block"></div>';
   
                   
                    ?>
                           
    </div>
                  
                  	       	          	  <div class="col-md-4">
                  	       	          	  
  <?php  if($pmodel->isNewRecord)  {$pmodel->gender="M";}
     		 echo $form->field($pmodel, 'gender')   ->radioList(  ['M' => 'Male', "F" => 'Female','T'=>'Transgender'],
                   
     [ 'item' => function($index, $label, $name, $checked, $value) {
     	$class_checked='';
     	if($checked==$value){$class_checked='checked="checked"';}
$return ='<div class="radio radio-custom radio-inline"><input  type="radio" name="' .$name. '" value="' .$value. '" tabindex="3" '.$class_checked.'><label style="font-size:11px;">'.ucwords($label).'</label></div>';
                                  
                                    return $return;
                                }
                            ]
                        )
                    ->label("Gender *");
                    echo ' <div class="help-block"></div>';
     	  
                    ?>
            
    </div>
     

                 	   
                 	     	<div class="col-md-2">
                  		 <?= $form->field($pmodel, 'patient_number')->textInput(['maxlength' => true,'required'=>'true'])->label("Patient Number *"); ?>
                  	</div>
            <div class="clearfix"></div>
  
    <div class="col-md-3">
    	 <?= $form->field($pmodel, 'firstname')->textInput(['maxlength' => true,'required'=>'true','onkeydown'=>"return alphaOnly(event);"])->label("First Name *"); ?>
    	
    </div>
    <div class="col-md-3">
    	 <?= $form->field($pmodel, 'lastname')->textInput(['maxlength' => true,'required'=>'true','onkeydown'=>"return alphaOnly(event);"]) ->label("Last Name *");?>
    </div>
     
      
    <div class="col-md-3">
    	
    	<?php if(!$pmodel->isNewRecord)
    	{$dob= $pmodel->dob;
    		$pmodel->dob=date("d-m-Y",strtotime($dob));}?>
    		 <?= $form->field($pmodel, 'dob')->textInput(['maxlength' => true,'required'=>'true','data-provide' => "datepicker", 
             'data-date-format' => "dd-mm-yyyy",])->label("DOB *"); ?>
    		
    		
    </div>
     <div class="col-md-3">
       <!--<?= $form->field($pmodel, 'physicianname')->textInput(['maxlength' => true,'required'=>'true','onkeydown'=>"return alphaOnly(event);"])->label("Physician Name *"); ?>-->
       <?= $form->field($pmodel, 'physicianname')->dropdownlist($physicianlist,['prompt'=>'Select Physician','class'=>'selectpicker',
       'data-live-search'=>'true','data-style'=>"btn-default btn-custom",],['title'=>'Select Physician',
       'maxlength' => true,
      
       'required'=>'true'])->label("Physician Name *") ?>
       
      </div>
     
    	 <div class="clearfix"></div>
    	   	  <div class="col-md-3">
    	   	  	  <?= $form->field($pmodel, 'patient_mobilenumber')->textInput(['maxlength' => 10,'required'=>'true', 'onkeypress'=>'return isNumber(event)', ])->label("Patient Phone Number *"); ?>
     	 </div>
         <div class="col-md-3">
    		  <?= $form->field($pmodel, 'emailid')->textInput(['maxlength' => true])->label("Email ID"); ?>
    	</div>
   		<div class="col-md-3">
      		 <?= $form->field($pmodel, 'guardian_name')->textInput(['maxlength' => true])->label("Guardian Name"); ?>
      	</div>
        <div class="col-md-3">
        	<?= $form->field($pmodel, 'guardian_mobilenumber')->textInput(['maxlength' => 10, 'onkeypress'=>'return isNumber(event)',])->label("Guardian Mobile Number"); ?>
         </div>
    	  <div class="clearfix"></div>
       <div class="col-md-3">
		   	 <?= $form->field($pmodel, 'address')->textarea(['rows' => 1,'placeholder' =>'Address']); ?>
   	   </div> 
       <div class="col-md-3">
   	 		<?= $form->field($pmodel, 'notes')->textarea(['rows' => 1,'placeholder' =>'Short Notes']); ?>
   	   </div> 
       <div class="form-group clearfix">
               <label class="col-lg-12 control-label ">(*) Mandatory</label>
        </div>
   </section>
   
    <!-- <h3>Search Product </h3> -->
 <section>
	<?php	$session = Yii::$app -> session;
		$role = $session['authUserRole'];
		$companybranchid = $session['branch_id'];
		$model1 = new Stockrequest();
		if ($role == "Super") {
			?>
	 <div class="col-md-3 ">
 <label>Company</label>	
		<?= $form -> field($model1, 'branch_id') -> dropdownlist($companylist, ['prompt' => '--Select Branch--',
		 'class'=>'form-control selectpicker',
		 'required' => 'true',
		  'data-style' => "btn-default btn-custom", 
		  'data-live-search'=>'true',
		  ]) -> label(false);?>
		</div>
	<?php	} else {

			echo $form -> field($model1, 'branch_id') -> hiddenInput(['value' => $companybranchid]) -> label(false);
		}
?>

	<div class="col-md-3">
			<label>Brand Code</label>
			
	<?= $form -> field($model1, 'brandcode') -> dropdownlist($brandlist, ['id' => 'product_idz', 'title' => '--Select Brand--',
	 'data-style' => "btn-default btn-custom", 
	 'required' => 'true',
	 'class'=>'selectpicker',
	  'data-live-search'=>'true',
	  'multiple' => true]) -> label(false);
	?>
	</div>
     <div class="col-md-3 form-group" style="margin-top: 39px;">
			<?= Html::Button('Search', ['class' => 'btn btn-default waves-effect waves-light product_add1']);?>
	  </div>
 
 <div id="productlist1">
 </div>
 
 </section> <section>
	<?php	$session = Yii::$app -> session;
		$role = $session['authUserRole'];
		$companybranchid = $session['branch_id'];
		$model1 = new Stockrequest();
		if ($role == "Super") {
			?>
	 <div class="col-md-3 ">
 <label>Company</label>	
		<?= $form -> field($model1, 'branch_id') -> dropdownlist($companylist, ['prompt' => '--Select Branch--',
		 'class'=>'form-control selectpicker',
		 'required' => 'true',
		  'data-style' => "btn-default btn-custom", 
		  'data-live-search'=>'true',
		  ]) -> label(false);?>
		</div>
	<?php	} else {

			echo $form -> field($model1, 'branch_id') -> hiddenInput(['value' => $companybranchid]) -> label(false);
		}
?>

	<div class="col-md-3">
			<label>Brand Code</label>
			
	<?= $form -> field($model1, 'brandcode') -> dropdownlist($brandlist, ['id' => 'product_idz', 'title' => '--Select Brand--',
	 'data-style' => "btn-default btn-custom", 
	 'required' => 'true',
	 'class'=>'selectpicker',
	  'data-live-search'=>'true',
	  'multiple' => true]) -> label(false);
	?>
	</div>
   
    
	  <div class="col-md-3 form-group" style="margin-top: 39px;">
	<?= Html::Button('Search', ['class' => 'btn btn-default waves-effect waves-light product_add1']);?>
		
	</div>
 		 <div id="productlist1">
		 </div>
 </section>
 </div>
  <?php ActiveForm::end(); ?>
         	</div>
     </div>
</div>
</div>
</div>
</div>
</div>
<script src="ubold/plugins/jquery-validation/js/jquery.validate.min.js"></script> 
<script src="ubold/plugins/jquery.steps/js/jquery.steps.min.js"></script> 
<script>

function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8);
};
 $(document).ready(function()
 {
 	
 $('body').on("click",'.dmc',function(){
 $("#load").fadeIn("slow");
 var form = $("#searchform");
 var formData = form.serialize();
 $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        	
        	$("#load").fadeOut("slow");
        	$("#formdetails").fadeOut("slow")
        	
        	$("#search_result").html(data);
        	TableManageButtons.init();
        	$(".dt-buttons").hide();
     
      //	$("#datatable-buttons_paginate").hide();
        //	$("#datatable-buttons_info").hide();
        	
        }
     });

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
 
 
 $('body').on("input",'.productqty1',function(evt){		
	
 	
   var self = $(this);
   self.val(self.val().replace(/[^0-9]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
   var valz1=$(this).val();
   var attr=$(this).attr('datacls1');
   var perprice1=$(this).attr('dataprice1');
   var totalprice1=(perprice1)*(valz1);
   $("#"+attr).text("Rs."+totalprice1);
   $("#"+attr+"1").val(totalprice1);
   var totla_each1 = 0;
   $('.pricez1').each(function(){
   	 totla_each1 += parseFloat(this.value) || 0;
   
});
$("#total1").text("Rs."+totla_each1);
$("#totalprice1").val(totla_each1);

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
         
       !function($) {
       	var FormWizard = function() {};
	    FormWizard.prototype.createValidatorForm = function($form_container) {
        $form_container.validate({
                errorPlacement: function errorPlacement(error, element) {
                	
                element.after(error);
            }
        });
        $form_container.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex) {
            	
                $form_container.validate().settings.ignore = ":disabled,:hidden";
               
                return $form_container.valid();
            },
            onFinishing: function (event, currentIndex) {
                $form_container.validate().settings.ignore = ":disabled";
                return $form_container.valid();
            },
            onFinished: function (event, currentIndex) {
               $("#load").fadeIn("slow");
                 var formData = $("#wizard-validation-form1").serialize();
                $.ajax({
		        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/savesales',
		        type: "post",
		        data: formData,
		        success: function (data) {
		        	//alert(data)
		        	if(data=="Y"){
		        	 $("#load").fadeOut("slow");	
		        	 noti();
		        	 $("#formdetails").fadeOut("slow");
		        	}
		        }
		        });
               
            }
        });

        return $form_container;
    },
   FormWizard.prototype.init = function() {
       
        this.createValidatorForm($("#wizard-validation-form1"));

    },
   
    $.FormWizard = new FormWizard, $.FormWizard.Constructor = FormWizard
}(window.jQuery),

function($) {
    
    $.FormWizard.init()
}(window.jQuery);
         $("#load").fadeOut("slow");
          $("#gen").attr('disabled',true).selectpicker('refresh');
        $("#vendor_idz").selectpicker('refresh');
        $("#product_idz").selectpicker('refresh');
        
        $("#formdetails").fadeIn("slow");
        }
     });
	
	})
	
	
	<?php 
if(isset($_GET['status'])){?>
 noti();
<?php }?>
});


function noti () {
	
  $.Notification.autoHideNotify('custom', 'top right', 'Successfully Added.');
}

$('body').on("click",'.demo',function(e){
return false;
	
});

	
</script> 

<script>
 $(document).ready(function()
 {
!function($) {
    "use strict";
    var FormWizard = function() {};
    FormWizard.prototype.createValidatorForm = function($form_container) {
        $form_container.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.after(error);
            }
        });
        $form_container.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex) {
                $form_container.validate().settings.ignore = ":disabled,:hidden";
                return $form_container.valid();
            },
            onFinishing: function (event, currentIndex) {
                $form_container.validate().settings.ignore = ":disabled";
                return $form_container.valid();
            },
            onFinished: function (event, currentIndex) {
        $("#load").fadeIn("slow");
                 var formData = $("#wizard-validation-form").serialize();
                $.ajax({
		        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/addpatient',
		        type: "post",
		        data: formData,
		        success: function (data) {
		        	
		        	if(data=="Y"){
		        		
		        	 $("#load").fadeOut("slow");	
		        	 notify();
		        	 //$("#formdetails").fadeOut("slow");
		        	}
		        }
		        });
            }
        });

        return $form_container;
    },
   
    FormWizard.prototype.init = function() {
        this.createValidatorForm($("#wizard-validation-form"));
    },
    
    $.FormWizard = new FormWizard, $.FormWizard.Constructor = FormWizard
}(window.jQuery),

function($) {
    "use strict";
    $.FormWizard.init()
}(window.jQuery);
   });
   function notify () {
	
  $.Notification.autoHideNotify('custom', 'top right', 'Successfully Added.');
}

</script>
