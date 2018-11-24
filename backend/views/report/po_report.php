<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use backend\models\BranchAdmin;
$this->title = Yii::t('app', 'Report');
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
										  <?php  echo $this->render('_stocksearch', ['model' => $searchModel, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,
										  'compositionlist'=>$compositionlist]); ?>
										
										

         



   
 <?php 

 Pjax::begin(['id'=>'stock-grid']); ?>    
<?php echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'tableOptions' =>['class' => 'table table-striped table-hover'],
  
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],
     	    
    	//'serialnumber',
    	['attribute'=>'companybranch','headerOptions' => ['style' => 'color:#337ab7;']],
  
    ['attribute'=>'brandcode','headerOptions' => ['style' => 'color:#337ab7;']],
     ['attribute'=>'stockcode','headerOptions' => ['style' => 'color:#337ab7;'],'label'=>'Stock Code'],
           [
    'attribute' => 'vendorid','value' => 'vendor_name',
    
    'filter' => Html::activeDropDownList($searchModel, 'vendorid', $vendorlist,['class'=>'form-control ','style'=>'width:100px','prompt' => 'Vendor']),
],

[
    'attribute' => 'compositionid','value' => 'compositionname','label'=>'Composition Name',
    
    'filter' => Html::activeDropDownList($searchModel, 'compositionid', $compositionlist,['class'=>'form-control ','style'=>'width:150px','prompt' => '--Composition--']),
],
[
    'attribute' => 'productid','value' => 'product_name',
    
    'filter' => Html::activeDropDownList($searchModel, 'productid', $productlist,['class'=>'form-control','style'=>'width:150px','prompt' => '--Product--']),
],
['attribute'=>'batchnumber', 'label'=>'Batch Number','contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return $model->stockresponse->batchnumber;
}],
['attribute'=>'quantity','label'=>'Qty', 'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return $model->stockresponse->receivedquantity;
}
],
['attribute'=>'expiredate','label'=>'Expire Date', 'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return date("d/m/Y",strtotime($model->stockresponse->expiredate));
}
],

['attribute'=>'priceperqty', 'label'=>'Price/Qty','contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return $model->stockresponse->priceperquantity;
}
],

['attribute'=>'price', 'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return $model->stockresponse->purchaseprice;
}
],




			
		
            
        ],
    ]); ?>
    <?php Pjax::end(); ?> 
   
</div>
                    </div>
                </div>
                
              </div>
</div>

</div>
