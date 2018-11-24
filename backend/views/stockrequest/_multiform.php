<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\Stockrequest */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="<?php echo Url::base(); ?>/plugins/multiselect/jquery.sumoselect.js"></script>
<link href="<?php echo Url::base(); ?>/plugins/multiselect/sumoselect.css" rel="stylesheet" />
<style type="text/css">
  .SumoSelect {
    width: 100%;
}

</style>
<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>
        
        <div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
									
									<div class="panel-body">
            	

    <?php $form = ActiveForm::begin(['id'=>'stockrequest-form']); ?>
  
   <div class="col-md-3">	
   	<?= $form->field($model, 'vendorid')->dropdownlist($list,['prompt'=>'select','id'=>'vendor_idz', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getproduct').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                           $("#product_idz").html(data);
														    $(".groups_eg_g").SumoSelect({selectAll:true, search:true });                                                      
                                                        }
                                                    );']) ?>
   	</div>
   	 <div class="col-md-9">	
      <?php 
   echo $form->field($model, 'productid')->widget(Select2::classname(), [
     'data' => [],
     'language' => 'en',
     'options' => ['placeholder' => 'Select Product','multiple' => true,'id'=>'product_idz'],
     'pluginOptions' => [
         'allowClear' => true,
     ],
 ]);?>
    
   </div>

    <div class="form-group col-md-6">
    	  <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success ' : 'btn btn-primary','style'=>'margin-left: 0%;']) ?>
      
    </div>
 <div class="clearfix">
   		
   	</div>
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
</div>

<script>


$( function() {
    $( "#datepicker1").datepicker({ dateFormat: 'yyyy-mm-dd' });
   
  } );
  </script>
  <script type="text/javascript">
    $(".groups_eg_g").SumoSelect({selectAll:true, search:false });
</script>

