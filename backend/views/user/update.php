<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Update User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<?php
  
    $session = Yii::$app->session;
     if($session['user_type'] == 'S') { 
    echo Html::a('Manage User', ['index'],['class' => 'btn btn-primary waves-effect waves-light pull-right']);
}
   ?>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
