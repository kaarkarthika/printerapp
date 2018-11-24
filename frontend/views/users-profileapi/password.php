<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UsersProfile */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'change password';
$this->params['breadcrumbs'][] = ['label' => 'Users Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <h1><?= Html::encode($this->title) ?></h1>
<div class="card">
<div class="body">
<div class="users-profile-form">

    <?php $form = ActiveForm::begin([
                            'id' => 'purchase-sms-temp-form',
                            'fieldConfig' => [
                                'template' => '<div class="col-md-6  field-userrole-ur_value"><div class="form-line">{label}{input}</div>{error}</div>']
                ]); ?>


<?=$form->field($model, 'password')->passwordInput(array('placeholder' => 'Password'));  ?> 
    
   
<br clear="all">
    <div class="form-group">
    	<div class="col-md-6 ">
    		<div class="col-md-3">
        <?= Html::submitButton('Save', ['class'=> 'btn btn-primary waves-effect']) ?>
      </div>
        <div class="col-md-3">
        	  
         <?= Html::a('Cancel',['index'], ['class'=> 'btn btn-danger waves-effect']) ?> 
        </div>
       </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div></div>