<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Stockresponse;
use backend\models\Stockrequest;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StockresponseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchase Order Backorder');

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

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions' =>['class' => 'table table-hover','style'=>"overflow-x: scroll;"],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;']],

           // 'stockresponseid',
           
           [
            'attribute'=>'stockrequestid', 
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) { 
                 return $model->stockrequestcode->requestcode;
            },
           
           
        ],
        
		
        
		
            ['attribute'=>'productname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
             ['attribute'=>'vendorname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
             
			  ['attribute' => 'updated_ipaddress','label'=>'Request Quantity/Unit', 'format'=>'raw', 'value' => function($model){
			  	$rcode=$model->stockrequestcode->requestcode;
			  		
			  	$brandcode=$model->stockbrandcode->brandcode;
				$data=Stockrequest::find()->where(['requestcode'=>$rcode])->andwhere(['brandcode'=>$brandcode])->all();
				$z=0;
			foreach($data as $k)
			{
				$z+=$k->total_no_of_quantity;
			}
			return $z;
				
			  }],
         
          
          
             ['attribute' => 'stockid', 'format'=>'raw', 'value' => function($model){ return $model->stockbrandcode->brandcode;}],
                        
                       ['attribute'=>'stockcode', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
           
      
            ['attribute'=>'receivedquantity','label'=>'Received quantity/Unit','format'=>'raw','value'=>function($model)
    	{
    		
			$rcode=$model->stockrequestcode->requestcode;
			$data=Stockresponse::find()->where(['request_code'=>$rcode,'stockid'=>$model->stockid])->all();
			$z=0;
			foreach($data as $k)
			{
				$z+=$k->total_no_of_quantity;
			}
			return $z;
    		
    	}],
            
			
            ['attribute'=>'unitid','format'=>'raw','value'=>function($model)
    	{
    		return $model->unittype->unitvalue;
    	}],
           
                  ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
               'template'=>'{update}',
                            'buttons'=>[
                             
								  
                              'update' => function ($url, $model) {
                              	$url=Yii::$app->homeurl."?r=stockrequest/backorder&requestcode=".$model->stockrequestcode->requestcode;
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {
								$rcode=$model->stockrequestcode->requestcode;
							  	$brandcode=$model->stockbrandcode->brandcode;
								$data=Stockrequest::find()->where(['requestcode'=>$rcode])->andwhere(['brandcode'=>$brandcode])->all();
								
								$bkorderdata=Stockrequest::find()->where(['backorder_requestcode'=>$rcode])->andwhere(['brandcode'=>$brandcode])->all();
								$bkorderqty=$bkorderdata->total_no_of_quantity;
								$z=0;
			foreach($data as $k)
			{
				$z+=$k->total_no_of_quantity;
			}
			
			$data1=Stockresponse::find()->where(['request_code'=>$rcode,'stockid'=>$model->stockid])->all();
			$z1=0;
			foreach($data1 as $k)
			{
				$z1+=$k->total_no_of_quantity;
			}
			
			
			 if($z1>=$z){
				 return "Request Completed";
			}
         else if($bkorderdata)
			{
				
				return "Backorder Request Completed"; 
				
			}
			else{
				 return Html::a('<span class="fa  btn btn-danger btn-xs" style="margin-right:4px;"> Back Order</span>', $url,$options);   
			}
			
							                            
            
            }} }, 
                             
                            
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
