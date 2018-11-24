<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="form-group col-md-6">
        <?= $form->field($model, 'user_type')->dropDownList([ 'A' => 'A', 'U' => 'U', 'P' => 'P', ], ['prompt' => '']) ?>
        </div>
         
       
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-6">
           <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
         <div class="form-group col-md-6">
          <?= $model->isNewRecord ? $form->field($model, 'password')->passwordInput(array('placeholder' => 'Password')):''  ?> 
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group col-md-6">
           <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>
        </div>
         
    </div>
   

  
     
   <div class="box-footer pull-right">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i> Save' : '<i class="fa fa-fw fa-edit"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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