<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
  use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */


 
?>
<style>
  .panel-border.panel-custom .panel-heading {
    background-color: #fff;
  }
  .b-width {
    width: 100%;
  }
  .no-pd.panel-body {
    padding: 0px 20px 0px 20px;
  }
  .form-group {
    margin-bottom: 0px;
}
</style>

<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>

<div class="newpatient-form">
  <div class="container">
    
    <!-- <div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo 'Sub-Visit';?></a></li>
</ol>
</div>
</div>  -->





    <?php $form = ActiveForm::begin(); ?>
	 <div class="row">
	   <!--Patient Details Begins-->
       <div class="col-sm-8">
         <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Patient Details</strong></h5></div>
	       <div class="no-pd panel-body">
	         <div class="row">
		        <div class="col-sm-4 ">
                   <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Sub Visit No') ?>
                   <?= $form->field($model, 'mr_no')->textInput(['class' => 'form-control w-cus'])->label('MR No') ?>
                   <?= $form->field($model, 'pat_inital_name')->dropDownList(['Mr'=>'Mr','Miss'=>'Miss','Baby'=>'Baby','Mrs'=>'Mrs','Master'=>'Master','Baby Of'=>'Baby Of','Empty'=>'Empty','Dr'=>'Dr','Ms.'=>'Ms.'],['class' => 'form-control w-cus','readonly'=>true])->label('Name Initial') ?>
                   <?= $form->field($model, 'patientname')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Name') ?>
                   <?= $form->field($model, 'pat_age')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Age') ?>				   
		        </div>
				<div class="col-sm-4">
				  <?= $form->field($model, 'pat_sex')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Sex') ?>
				  <?= $form->field($model, 'pat_relation')->dropDownList(['W/O'=>'W/O','S/O'=>'S/O','Partner'=>'Partner','D/O'=>'D/O','H/O'=>'H/O'],['class' => 'form-control w-cus','readonly'=>true])->label('Relative') ?>
				  <?= $form->field($model, 'pat_marital_status')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Relative Name') ?>
				  <?= $form->field($model, 'pat_address')->textArea(['class' => 'form-control w-cus','readonly'=>true])->label('Address') ?>
				</div>
				<div class="col-sm-4">
				  <?= $form->field($model, 'pat_pincode')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Pincode') ?>
				  <?= $form->field($model, 'pat_mobileno')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Mobile') ?>
				  <?= $form->field($subvisit, 'patient_type')->dropDownList($patienttype,['class' => 'form-control w-cus','readonly'=>true])->label('Patient Type') ?>
                  <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Insurance') ?>
				</div>
		     </div>
	       </div>
	     </div>
       </div>
	   <!--Patient Details Ends-->
		
	   <!--Consultant Details Begins-->
	   <div class="col-sm-4">
         <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Consultant Details</strong></h5></div>
	       <div class="no-pd panel-body">
	         <div class="row">
			    <div class="col-sm-12">
				   <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Timing') ?>
					<?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Consultant') ?>
					<?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Department') ?>
					<?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Turn No') ?>
					
					<div class="form-group" style="visibility:hidden;">
					  <label>df</label>
					  <input type="text" class="form-control">
					</div>
				</div>
	         </div>
	       </div>
	      </div>
	   </div>
	    <!--Consultant Details Ends-->
     </div>
	 
	 
	 
	  <div class="row">
	   <!--FINANCIAL Details Begins-->
       <div class="col-sm-7">
         <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Financial Details</strong></h5></div>
	       <div class="no-pd panel-body">
	         <div class="row">
			   <div class="col-sm-3">
			       <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Total Amount') ?>
				    <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Less Disc(%)') ?>                   				   
			   </div>
			   <div class="col-sm-3">
			        <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Less Disc(Amt)') ?>
                    <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Net Amount') ?>
			   </div>
			   <div class="col-sm-3">
			        <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Paid Amount') ?>
                    <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Due Amount') ?>                   
			   </div>
			   <div class="col-sm-3">
			       <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Pay Mode') ?>
                    <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Discount By') ?>
			   </div>
		   </div>
		   <div class="row">
				<div class="col-sm-12">
				     <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Remarks') ?>
				</div>
		   </div>
		 </div>
	    </div>
	   </div>
	    <!--FINANCIAL Details Ends-->
		
		<!--OTHER DETAILS Begins-->
		<div class="col-sm-3">
		 <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong>Other Details</strong></h5></div>
	       <div class="no-pd panel-body">
		     <div class="row">
			    <div class="col-sm-6"> 
				   <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Free UP To') ?></div>
			    <div class="col-sm-6">
				   <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Isfreevisit') ?></div>
			 </div>
	         <div class="row">
			   <div class="col-sm-12">  
                  <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Last Consulted Date') ?>
                  <?= $form->field($subvisit, 'sub_visit')->textInput(['class' => 'form-control w-cus','readonly'=>true])->label('Last Consulted Doctor') ?> 
			   </div>
		     </div>
		   </div>
		 </div>
		</div>
		<!--OTHER DETAILS Ends-->
		<div class="col-sm-2">
		 <div class="c panel panel-border panel-custom">
	       <div class="panel-heading"><h5 class="box-title"><strong> </strong></h5></div>
	       <div class="panel-body">
	         <div class="row">
			   <div class="col-sm-12"> 
				<button class="btn btn-success b-width">Save</button>
			   </div>
			   <div class="col-sm-12 mt-5"> 
				<button class="btn btn-warning b-width">Clear</button>
			   </div>
			   <div class="col-sm-12 mt-5"> 
				<button class="inp btn btn-default b-width">Close</button>
			   </div>
			 </div>
		   </div>
		  </div>
	    </div>
	  </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>


<script>

$("#newpatient-mr_no").typeahead({
  
  source: function(query,result) {
	  $.ajax(
	  {
		url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/subvisitfetch";?>',
		method:'POST',
		data:{query:query},
		dataType:'json',
		success:function(data)
		{
			result($.map(data, function(item){
				return item.mr_no;
			}));
		}
	  });
  },
  autoSelect: true,
  displayText: function(result)
  {
     return result;
  },
  afterSelect: function(result) 
  {  
  		$('#load1').show();
		
		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=newpatient/fetchmrnumberauto&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{   
	  			 	$('#load1').hide();
	  			 	
	  			 	$('#newpatient-pat_inital_name').val();
	  			 	$('#newpatient-patientname').val();
	  			 	$('#newpatient-pat_age').val();
	  			 	$('#newpatient-pat_sex').val();
	  			 	
	  			}
		  	  });
	  	
	  	$('#load1').hide();
  }
});
</script>
