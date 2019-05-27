<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceTable */

$this->title = 'Create Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Manage Invoice', ['index'], ['class' => 'btn btn-primary pull-right']);
   ?>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>

    <?= $this->render('_form', [
        'model' => $model,
        'invoice_ref' => $invoice_ref,
        'tax_master' => $tax_master,
        'customer_master' => $customer_master,
    ]) ?>

</div>
