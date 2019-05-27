<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Estimate */

$this->title = 'Estimate Slip';
$this->params['breadcrumbs'][] = ['label' => 'Estimates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
<?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Manage Estimate', ['index'],['class' => 'btn btn-primary waves-effect waves-light pull-right']);
   ?>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>

    <?= $this->render('_form', [
        'model' => $model,
        'customer_master' => $customer_master,
        'tax_master' => $tax_master,
         'estimate_main_tbl_create'=> $estimate_main_tbl_create
    ]) ?>

</div>
