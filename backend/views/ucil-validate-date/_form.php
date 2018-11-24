<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\UcilValidateDate */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    select.selectpicker{
        display: block!important;
    }
</style>
<div class="row physicianmaster-form">

    <?php $form = ActiveForm::begin(['id' => 'auth-user-role-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>
 <div class="col-md-6">
    <?= $form->field($model, 'ucil_date_value')->textInput(['required','class' => '  form-control   number' ]) ?>
 </div>

   <div class="clearfix"></div>
<hr>
<div class="form-group col-md-12">
         
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right physician' : 'btn btn-primary pull-right updatephysician']) ?>
        <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>


    <?php ActiveForm::end(); ?>

</div>
 
<script type="text/javascript">
  $("body").on('keypress', '.number', function (e) 
  {
    //if the letter is not digit then display error and don't type anything
    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
    {
      return false;
    }
     });
</script>