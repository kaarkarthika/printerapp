<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = 'Create Lab Payment Prime';
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; 
?>
<style>
.btn-bk{
background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
}
</style>
<div class="container">
 <!--   <div class="row">
<div class="col-sm-6">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
			<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div> 
							<div class="col-sm-6 text-right ">
	<a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=lab-payment-prime/index" class="btn text-right btn-default btn-bk" Title="Back To Grid">Back to Grid </a> 
</div>
						</div> -->
   

    <?= $this->render('_form', [
                'model' => $main,
	            'labtesting' => $labtesting,
	            'testgroup'=>$testgroup,
	            'mastergroup'=>$mastergroup,
	            'main' =>  $model,
	            'authority_master' => $authority_master,
    ]) ?>
	
</div>
