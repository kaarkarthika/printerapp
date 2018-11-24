<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = 'Create Lab Payment Prime';
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
   

    <?= $this->render('_form', [
        'model' => $main,
	            'labtesting' => $labtesting,
	            'testgroup'=>$testgroup,
	            'main' =>  $model,
    ]) ?>
	
</div>
