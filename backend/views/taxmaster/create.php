<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Taxmaster */

$this->title = 'Create Taxmaster';
$this->params['breadcrumbs'][] = ['label' => 'Taxmasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Manage Taxmaster', ['index'], ['class' => 'btn btn-primary pull-right']);
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
