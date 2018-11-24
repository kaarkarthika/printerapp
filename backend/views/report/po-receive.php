<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Stockmaster;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StockresponseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchase Order Confirm');

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
										
										
			 
										
										
						<?php  echo $this->render('_stockauditsearch', ['model' => $searchModel, 'vendorlist'=>$vendorlist,'requestcodelist'=>$requestcodelist,]); ?>								
										
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions' =>['class' => 'table table-hover','style'=>"overflow-x: scroll;"],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;']],
           [
            'attribute'=>'request_code', 
          
            'value'=>function ($model, $key, $index, $widget) { 
                 return $model->stockrequestcode->requestcode;
            },
           
           
        ],
        
        
		
        
		
            ['attribute'=>'productname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
             ['attribute'=>'vendorname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
         
          
          
             ['attribute' => 'stockid', 'format'=>'raw', 'value' => function($model){
                                return $model->stockbrandcode->brandcode;
                        }],
                        
                       ['attribute'=>'stockcode', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
            'batchnumber',
      
            ['attribute'=>'receivedquantity', 'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;']],
            ['attribute'=>'unitid','format'=>'raw','value'=>function($model)
    	{
    		return $model->unittype->unitvalue;
    	}],
           
          //   'purchaseprice',
           //  'priceperquantity',
            ['attribute' => 'receiveddate', 'format'=>'raw', 'value' => function($model){
                              
							   $receiveddate=date("d/m/Y",strtotime($model->receiveddate));
							   return $receiveddate;
                        }],
                       'total_no_of_quantity',
           
            ['attribute' => 'expiredate', 'format'=>'raw', 'value' => function($model){
                              
							   $expiredate=date("d/m/Y",strtotime($model->expiredate));
							   return $expiredate;
                        }],
         
            // 'sales_status',
  
            
            
                  ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
               'template'=>'{update}{view}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) { 
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }  }}, 
								  
                              'update' => function ($url, $model) {
                              	$url=Yii::$app->homeurl."?r=stockresponse/update1&id=".$model->stockrequestid;
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::a('<span class="fa fa-edit btn btn-warning btn-xs" style="margin-right:4px;"></span>', $url,$options);                                
            
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


<script>
    $(document).ready(function(){

         
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Stock Receive</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();  });

 	 
            
 });
</script>
