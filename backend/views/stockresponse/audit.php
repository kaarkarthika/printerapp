<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Stockmaster;
$this->title = Yii::t('app', 'Audit');
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
									<div class="panel-body" style="overflow-x:scroll;">
			 <?php  echo $this->render('_stocksearch', ['model' => $searchModel, 'vendorlist' => $vendorlist, 'productlist'=>$productlist, 'compositionlist'=>$compositionlist]); ?>							
				
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions' =>['class' => 'table table-hover','style'=>"overflow-x: scroll;width:auto"],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;']],
            ['attribute'=>'companybranch', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
             ],
            ['attribute'=>'productname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
              ],
            
			
			 ['attribute'=>'vendorname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
              ],
              
			  
			  
			  
			  ['attribute' => 'compositionname','value' => 'compositionname','label'=>'Composition','headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
    
    
],
	  ['attribute' => 'brandcode','headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
                        
                       ['attribute'=>'stockcode', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
            'batchnumber',
            ['attribute'=>'total_no_of_quantity', 'label'=>'Overall Stock','contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;'],
            'value'=>function($model)
            {
            return $model->total;
            }],
      
            ['attribute'=>'total_no_of_quantity', 'label'=>'Stock-Batch','contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;']],
            
			['attribute'=>'updated_ipaddress','label'=>'In-Transit','value'=>function($model)
			{
				return $model->intransit;
			}],
			
           
    	[
    'attribute' => 'unitid','format'=>'raw','value'=>function($model)
    	{
    		return $model->unittype->unitvalue;
    	},'label'=>'Unit',
    
    
],
     ['attribute' => 'expiredate', 'format'=>'raw', 'value' => function($model){
                              
							   $expiredate=date("d/m/Y",strtotime($model->expiredate));
							   return $expiredate;
                        }], 
                        ['attribute'=>'mrpperunit', 'label'=>'MRP/Unit','contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;'],
                        'value'=>function($model)
                        {
                        	return number_format($model->mrpperunit,2);
                        }],
         
                  ['class' => 'yii\grid\ActionColumn',
               'header'=> '',
                'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
               'template'=>'{view}{qrcode}',
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
                                return Html::a('<span class="fa fa-edit btn btn-warning btn-xs" style="margin-right:4px;" "></span>', $url,$options);                                
            
            }} }, 
            
			
			            'qrcode' => function ($url, $model) {
			            	 
                              	//$url="stockresponse/qrcode&responseid=".$model->stockresponseid;
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::a('<span class="fa fa-qrcode btn btn-danger btn-xs" style="margin-right:4px;"></span>',['stockresponse/qrcode','responseid'=>$model->stockresponseid], ["target"=>"_blank", "data-pjax"=>"0"]);                                
            
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