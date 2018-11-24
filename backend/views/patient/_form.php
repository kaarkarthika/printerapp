<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

  <div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
              	
              		 <?php $form = ActiveForm::begin(); ?>
            
                  	 <div class="col-md-3">
                  	 	
                <?php if($model->isNewRecord)  
				{
					$model->medicalrecord_number=$patientmax+1;
					echo $form->field($model, 'medicalrecord_number')->textInput(['maxlength' => true,'readOnly'=> true]);
				}	 
              else
			  	{
			  		echo $form->field($model, 'medicalrecord_number')->textInput(['maxlength' => true,'readOnly'=> true]);
			  	}	?>
    </div>
                  	<div class="col-md-3">
             <?php 
     		 echo $form->field($model, 'patient_type')   ->radioList(  ['1' => 'InPatient', "2" => 'OutPatient'],                   
     [ 'item' => function($index, $label, $name, $checked, $value) {
     	$class_checked='';
     	if($checked==$value){$class_checked='checked="checked"';}
$return ='<div class="radio radio-custom radio-inline"><input type="radio" name="' .$name. '" value="' .$value. '" tabindex="3" '.$class_checked.'><label style="font-size:11px;">'.ucwords($label).'</label></div>';
                                    return $return;
                                }
                            ]
                        )
                    ->label("Patient Type");
                    echo ' <div class="help-block"></div>';
   
                   
                    ?>
                           
    </div>
                  
                 	   
     <div class="col-md-3">
      	<?= $form->field($model, 'physicianname',[
      	 
        'template' => '
         <label class="control-label">Physician Name</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-user-md"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Physician Name',
            'class'=>'form-control',
        ]]);
    ?>
      	
     
      </div>
    <div class="clearfix"></div>
    <div class="col-md-3">
    	<?= $form->field($model, 'firstname',[
        'template' => '
          <label class="control-label">First Name</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-user"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'First Name',
            'class'=>'form-control',
        ]])
    ?>
    </div>
    <div class="col-md-3">
    	<?= $form->field($model, 'lastname',[
        'template' => '
          <label class="control-label">Last Name</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-user"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Last Name',
            'class'=>'form-control',
        ]])
    ?>
    </div><div class="col-md-3">
    	
    	<?php if(!$model->isNewRecord)
    	{$dob= $model->dob;
    		$model->dob=date("d-m-Y",strtotime($dob));}?>
    		
    		 <?= $form->field($model, 'dob',[
        'template' => '
        <label class="control-label">DOB</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-calendar"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Date of Birth',
            'class'=>'form-control',
            'data-provide' => "datepicker", 
             'data-date-format' => "dd-mm-yyyy",
               'onkeypress'=>'return false', 
        
        ]])
    ?>
    </div>
     	  <div class="col-md-3">
  <?php
     		 echo $form->field($model, 'gender')   ->radioList(  ['M' => 'Male', "F" => 'Female','T'=>'Transgender'],
                   
     [ 'item' => function($index, $label, $name, $checked, $value) {
     	$class_checked='';
     	if($checked==$value){$class_checked='checked="checked"';}
$return ='<div class="radio radio-custom radio-inline"><input type="radio" name="' .$name. '" value="' .$value. '" tabindex="3" '.$class_checked.'><label style="font-size:11px;">'.ucwords($label).'</label></div>';
                                  
                                    return $return;
                                }
                            ]
                        )
                    ->label("Gender");
                    echo ' <div class="help-block"></div>';
     	  
                    ?>
              
               
           
    	 
             
                   
                
            
    </div>
     
    	  <div class="clearfix"></div>
    	   	  <div class="col-md-3">
      <?= $form->field($model, 'patient_mobilenumber',[
        'template' => '
          <label class="control-label">Patient Mobile Number</label>
            <div class="input-group">
           
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-phone"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Patient Mobile Number',
            'class'=>'form-control',
            'onkeypress'=>'return isNumber(event)', 
            'maxlength'=>10,
        ]])
    ?>
      	
      </div>
   
   
   <div class="col-md-3">
    	 <?= $form->field($model, 'emailid',[
        'template' => '
         <label class="control-label">Email Address</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-envelope"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Email Address',
            'class'=>'form-control',
        ]])
    ?>
    </div>
    
   
     <div class="col-md-3">
      	
      	<?= $form->field($model, 'guardian_name',[
        'template' => '
         <label class="control-label">Guardian Name</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-user"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Guardian Name',
            'class'=>'form-control',
        ]])
    ?>
      </div>
          <div class="col-md-3">
        
    	<?= $form->field($model, 'guardian_mobilenumber',[
        'template' => '
         <label class="control-label">Guardian Mobile Number</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-mobile-phone"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Guardian Mobile Number',
            'class'=>'form-control',
            'onkeypress'=>'return isNumber(event)', 
             'maxlength'=>10,
        ]])
    ?>
  
      	
      </div>
    	  <div class="clearfix"></div>
      
   
       <div class="col-md-3">
   	 <?= $form->field($model, 'address')->textarea(['rows' => 1,'placeholder' =>'Address']); ?>
   </div> 
       <div class="col-md-3">
   	 <?= $form->field($model, 'notes')->textarea(['rows' => 1,'placeholder' =>'Short Notes']); ?>
   </div> 

    <div class="clearfix"></div>

   

    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
     <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

   

     <div class="clearfix"></div>

 </div>
</div>
</div>
</div>

