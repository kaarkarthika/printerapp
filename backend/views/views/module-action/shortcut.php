<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Shortcut;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Shortcuts';
$this->params['breadcrumbs'][] = ['label' => 'shortcut', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
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
<div class="panel-heading">

</div>
<div class="panel-body">
	<?php $form = ActiveForm::begin(); ?>
	 <div class=" col-md-12">
	 	<div class=" col-md-3">
		<?= $form->field($model, 'name')->textInput(['class' => "form-control",'required'=>true])->label('Shortcut Name'); ?>
		</div>
		<div class=" col-md-3">
		<?= $form->field($model, 'link')->textInput(['class' => "form-control",'required'=>true])->label('Link'); ?>
		</div>
		<div class=" col-md-3">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success ','style'=>'position:relative;top:25px']) ?>
		</div>
	 </div>
    	
						
	 <?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
</div>
   

