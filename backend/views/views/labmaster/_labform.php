<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LabCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-cat">
	<div class="category-pannel row">
		
		   <?php $form = ActiveForm::begin((['method' => 'get'])); ?>
		
	<div class="col-sm-3"> 
		<?= $form->field($model, 'category_name')->dropdownlist($catgorylist,['prompt'=>'Select Category','class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom1"]); ?>
   		</div>
   		<div class="col-sm-3">
				<?= $form->field($subcatmodel, 'lab_subcategory')->dropdownlist($subcatgorylist,['prompt'=>'Select Sub Category','class'=>'selectpicker', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1"]); ?>
   	
		</div>
		<div class="col-sm-3">
				<?= $form->field($unitmodel, 'unit_name')->dropdownlist($unitlist,['prompt'=>'Select unit','class'=>'selectpicker', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1"]); ?>
   	
		</div>
		
		<!-- <div class="col-sm-1">
		     <?php echo Html::button(' +',['class' => 'btn btn-default  addcat waves-effect waves-light',]);?>
		</div> -->   
	 
	</div>
	
	    <?php ActiveForm::end(); ?>
	</div>
	
</div>
 

   


