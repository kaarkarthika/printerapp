<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'purchase Order Return Report');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" >
	
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

<?php  echo $this->render('_stockauditsearch_return', ['model' => $searchModel, 'vendorlist'=>$vendorlist,'requestcodelist'=>$requestcodelist,]); ?>
 
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
           
            'request_code',
          //  'stockid',
            'branch_id',
             'batchnumber',
             'receivedquantity',
             'total_no_of_quantity',
            // 'unitid',
            // 'receiveddate',
            // 'purchaseprice',
             'priceperquantity',
            // 'manufacturedate',
             'expiredate',
            // 'purchasedate',
            // 'stock_status',
            // 'returndate',
            'returnquantity',
            // 'updated_by',
            // 'updated_on',
            // 'updated_ipaddress',
            

          
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>
</div>
</div>
</div>
