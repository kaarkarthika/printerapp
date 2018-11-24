<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Physicianmaster;
use yii\widgets\ActiveForm;
   use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */

$this->title = $model->patientid;
$this->params['breadcrumbs'][] = ['label' => 'Newpatients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo Url::base(); die;
?>

<div class="newpatient-view">

   
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
   <?php
   		if($model->image)
		{     ?>
			<img src="<?php echo Url::base();?>/<?php echo $model->image;?>" alt="Smiley face" width="400" height="400">
	<?php	} ?>
   
	<br><br>
 <?= $form->field($model, 'patient_file')->fileInput() ?>

  <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success vendor' : 'btn btn-primary updatevendor']) ?>
<?php ActiveForm::end(); ?>
</div>
