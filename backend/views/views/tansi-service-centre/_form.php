<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\TansiServiceCentreAdmin;
use backend\models\AuthUserRole;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\BranchManagement */
/* @var $form yii\widgets\ActiveForm */


?>
<style type="text/css">
    
    .box-header {
    color: #fff;
    background-color: #ff0000;
}
</style>
<section class="content">
<!-- Info boxes -->
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header with-border">
                     <h3 class="box-title"><?= $model->isNewRecord ? '<i class="fa fa-fw fa-calendar-plus-o"></i>' : '<i class="fa fa-fw fa-edit"></i>' ?>  <?= Html::encode($this->title) ?></h3>
              </div><!-- /.box-header -->
<div class="school-mgmt-form">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">
        <div class="form-group col-md-6">
        <?= $form->field($model, 'service_center_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="form-group col-md-6">
        <?= $form->field($model, 'service_center_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-6">
        <?php
        if($model->isNewRecord)
        {
        ?>
           <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
           <?php } 
           else
           {
           ?>
           <?= $form->field($model1, 'username')->textInput(['maxlength' => true]) ?>
           <?php } ?>

        </div>
        <div class="form-group col-md-6">
        <?php
        if($model->isNewRecord)
        { ?>
        	<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        	<?php 
		}else{
			$model1->password_hash='';
        ?>
        <?= $form->field($model1, 'password_hash')->passwordInput(['maxlength' => true]) ?>

        <?php } ?>
         
           
        </div>
    </div>
   

  
     
   <div class="box-footer pull-right">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i> Add' : '<i class="fa fa-fw fa-edit"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
    </div>

</div>
</div>
</div>
</div>
</section>



<script type="text/javascript">
    $(".datepicker").datepicker();
    </script>