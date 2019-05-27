<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Delivery */

$this->title = 'Update Delivery';
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Manage Delivery', ['index'],['class' => 'btn btn-primary waves-effect waves-light pull-right']);
   ?>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>

    <?= $this->render('_form', [
    'model' => $model,
    'delivery_ref' => $delivery_ref,
    'tax_master' => $tax_master,
    'customer_master' => $customer_master,
    'findDeliveryRef' => $findDeliveryRef,
    'tax_master_index_json' => $tax_master_index_json,
    'tax_master_index' => $tax_master_index,
    'Deliveryaddress_update'=>$Deliveryaddress_update
    ]) ?>

</div>
