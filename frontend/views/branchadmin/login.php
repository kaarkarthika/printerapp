<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
      <div class="login-logo" style="margin-top: -9px;">
        <!-- <a href="http://www.tekwizard.in/" target="_blank"><center> <span class="logo-mini"><img src="uploads/tekwizardimg/teklogo.png" width="360px" height="80px"> </span> </center></a> -->
       <a href="../../index2.html"><b>SWiM</b> </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" style="margin-top:-23px;">
        <p class="login-box-msg" style="color: #fff;">LOGIN</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'ba_code')->textInput(['autofocus' => true]) ?>
                

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->