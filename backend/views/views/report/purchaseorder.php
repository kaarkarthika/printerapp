<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'Purchase Order - Report');
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
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
									<div class="panel-heading">
									</div>
									<div class="panel-body">
 <?php  echo $this->render('_purchaseordersearch', ['model' => $searchModel, 'vendorlist'=>$vendorlist,'requestcodelist'=>$requestcodelist,]); ?>										
										
										
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],
         [ 'attribute'=>'requestcode' ],
             ['attribute'=>'vendorid','label'=>'Vendor',  'value'=>'vendor_name'],
              ['attribute'=>'productid','label'=>'Product',  'value'=>'product_name'],
              
			  
    ['attribute'=>'requestdate','label'=>'Request Date',  'value'=>function($model)
    {
    	return date("d/m/Y",strtotime($model->requestdate));
    }],
    ['attribute'=>'quantity','label'=>'Request Quantity','value'=>function($model)
    {
    	return $model->quantity;
    }],
     ['attribute'=>'total_no_of_quantity','label'=>'Total Unit/tablets','value'=>function($model)
    {
    	return $model->total_no_of_quantity;
    }],
       
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div></div>
</div>