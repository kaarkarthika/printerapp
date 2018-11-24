<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\InvoicePayment;
use kartik\date\DatePicker;
$this->title = Yii::t('app', 'Invoice Payment History');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
  <?php
  $session = Yii::$app->session;
 if($session[Yii::$app->controller->id]!="")
 {
 if(in_array('a', $session[Yii::$app->controller->id])) 
 {
 echo Html::a(Yii::t('app', 'Add Sales'), ['create'], ['class' => 'btn btn-default dropdown-toggle waves-effect waves-light']);
 }
 } ?>
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
							</div></div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
</div>
<div class="panel-body">
<?php
 echo $this->render('_search', ['model' => $searchModel,'paymentmodelist'=>$paymentmodelist]); 
 ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'branchid', 
            'label'=>'Branch','value'=>function($model)
            {
            	return $model->branch->branch_name;
            }],
             ['attribute'=>'paymentmethod','label'=>'Payment Method','value'=>function($model)
             {
             	return $model->paymentmethod;
             }],
             
			 [     'label'=>'Paid Date',             
            'attribute' => 'timestamp',
          'value'=>function($model){return date("d-m-Y",strtotime($model->timestamp)); },
            'filterType'=> kartik\grid\GridView::FILTER_DATE, 
            'filterWidgetOptions' => [
                    'options' => ['placeholder' => 'Select date'],
                    'pluginOptions' => [
                        'format' => 'd-m-yyyy',
                        'todayHighlight' => true
                    ]
            ],
        ],
             
			 
			 
			 
            ['attribute'=>'invoicenumber','label'=>'Invoice Number'],
             ['attribute'=>'paymentamount','label'=>'Payment Amount','value'=>function($model){
             	$total=0;
				$invoiceno=$model->invoicenumber;
				$idata=InvoicePayment::find()->where(['invoicenumber'=>$invoiceno])->all();
				foreach($idata as $k)
				{
					$total+=$k->paymentamount;
				}
				return $total;
             }],
            // 'cardtype',
            // 'cardholdername',
            // 'referencenumber',
            
           
			 
			 
			 
			 
            // 'updated_timestamp',
        ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                  'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{viewhistory}{print}',
                            'buttons'=>['viewhistory' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
                                   return Html::button('<span>View</span></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs view view  viewhistory', 'data-toggle'=>'tooltip', 'title' =>'View Products' ]);
								  }, 
								  	 'print' => function ($url, $model, $key) {
                                    $session = Yii::$app->session;
									if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('print', $session[Yii::$app->controller->id])) {    
                                      
                                        return Html::a('<span class="btn btn-purple btn-sm btn-rounded waves-effect waves-light" style="margin-right:4px;">Report', ['invoice-payment/report','id'=>$model->invoicepaymentid], ["target"=>"_blank", "data-pjax"=>"0", 'data-toggle'=>'tooltip', 'title' =>'Report' ]);
                                        } }},
                          ] ,
                          ],
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
          $('body').on("click",".viewhistory",function(){
             var PageUrl = $(this).attr('value');
             $('#customviewheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Payment History</span>');
             $('#custommodal').modal('show').find('#customcontent').load(PageUrl);
             return false();
         });
});
</script>