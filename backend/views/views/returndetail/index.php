<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\Product;
use backend\models\Composition;
$this->title = Yii::t('app', 'Return Details');
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
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-striped table-hover'],
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],

         //   'return_detailid',
                  [  'attribute'=>'returninv',  'group'=>true,            'groupedRow'=>true,                
            'groupOddCssClass'=>'kv-grouped-row', 
            'groupEvenCssClass'=>'kv-grouped-row',  ],
                   [
            'attribute'=>'mrnumber', 'label'=>'MR Number',
            'width'=>'90px',
            'headerOptions' => ['style' => 'color:#337ab7;'],
           
           
        ],
                [
            'attribute'=>'returndate', 'label'=>'Return Date',
            'width'=>'90px',
            'headerOptions' => ['style' => 'color:#337ab7;'],
            
           
           
            
			'value'=>function($model){
				return date("d-m-Y h:i:s",strtotime($model->returndate));
			}
        ],
        
          
              [
            'attribute'=>'productid', 'label'=>'Product Name',
            'width'=>'310px',
                        'value'=>function ($model, $key, $index, $widget) { 
                return $model->product->productname;
            },
           
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Product::find()->asArray()->all(), 'productid', 'productname'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any Product'],
           
        ],  
            'stock_code',
             [
            'attribute'=>'compositionid', 
            'label'=>'Composition',
            'width'=>'310px',
                        'value'=>function ($model, $key, $index, $widget) { 
                return $model->composition->composition_name;
            },
           
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Composition::find()->asArray()->all(), 'composition_id', 'composition_name'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any Composition'],
           
        ],
            
             ['attribute'=>'unitname','label'=>'Unit','headerOptions' => ['style' => 'color:#337ab7;']],
            [ 'attribute'=>'productqty','width'=>'80px', 'label'=>'Return Quantity','hAlign'=>'right', 'pageSummary'=>true ],
            [ 'attribute'=>'priceperqty','width'=>'80px', 'label'=>'Price/Qty','hAlign'=>'right',  'format'=>['decimal', 2],'pageSummary'=>true ],
            [ 'attribute'=>'price','width'=>'80px', 'hAlign'=>'right',  'format'=>['decimal', 2],'pageSummary'=>true ],  
                    ['attribute'=>'updated_ipaddress','format'=>'raw','label'=>'Refund Status','value'=>function($model)
             {
             	return $model->salesreturn->paid_status;
			 }],
			
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
								  }  } }, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {
                                  	
									$status=$model->salesreturn->paid_status;
									  if($status=="No")
									  {
									  	 return Html::a('<span class="btn btn-warning btn-xs fa fa-edit" style="margin-right:4px;"></span>', $url,$options);  
									  }      
                                                             
            
            } } }, 
                            
                                'delete' => function ($url, $model, $key) {
                                       $session = Yii::$app->session;
									   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) { 
                                      
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                   }}},
                          ] ],
            
           
           
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){

         
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Sale Details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false(); 
              });
 });
</script>

