<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use backend\models\BranchAdmin;
$this->title = Yii::t('app', 'Stock Audit');
$datatables = $dataProvider->getModels();



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
										
										

         



   
 <?php Pjax::begin(['id'=>'stock-grid']); ?>    
<?php echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'tableOptions' =>['class' => 'table table-striped table-hover'],
  
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],
     	    
    	//'serialnumber',
    	['attribute'=>'companybranch','headerOptions' => ['style' => 'color:#337ab7;']],
  
    ['attribute'=>'brandcode','headerOptions' => ['style' => 'color:#337ab7;']],
     ['attribute'=>'stockcode','headerOptions' => ['style' => 'color:#337ab7;']],
           [
    'attribute' => 'vendorid','value' => 'vendor_name',
    
    'filter' => Html::activeDropDownList($searchModel, 'vendorid', $vendorlist,['class'=>'form-control ','prompt' => '--Vendor--']),
],

[
    'attribute' => 'compositionid','value' => 'compositionname','label'=>'Composition',
    
    'filter' => Html::activeDropDownList($searchModel, 'compositionid', $compositionlist,['class'=>'form-control ','prompt' => '--Composition--']),
],
[
    'attribute' => 'productid','value' => 'product_name','label'=>'Stock',
    
    'filter' => Html::activeDropDownList($searchModel, 'productid', $productlist,['class'=>'form-control','prompt' => '--Product--']),
],
['attribute'=>'batchnumber', 'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return $model->stockresponse->batchnumber;
}],
['attribute'=>'total_no_of_quantity', 'contentOptions' =>['style'=>'text-align:right;'],'label'=>'Total Quantity','headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return $model->stockresponse->total_no_of_quantity;
}
],
['attribute'=>'expiredate', 'contentOptions' =>['style'=>'text-align:right;'],'label'=>'Expire Date','headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	$exp=$model->stockresponse->expiredate;
	return date("d/m/Y",strtotime($exp));
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
			  ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
               
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) { 
                               
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }  }}, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								
								if($session[Yii::$app->controller->id]!=""){
									
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);                                
            
            }} }, 
                             
                                    
                                'delete' => function ($url, $model, $key) {
                                       $session = Yii::$app->session;
									   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) { 
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } } },
                          ] ],




			
		
            
        ],
    ]); ?>
    <?php Pjax::end(); ?> 
</div>
                    </div>
                </div>
                
              </div>
</div>

</div>
<script>
    $(document).ready(function(){

         
          $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Stock Request</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
          $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Stock</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();});
         
      });
         
</script>
