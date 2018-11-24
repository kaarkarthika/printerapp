<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
$this->title = Yii::t('app', 'Transfer Stock Request');

?>

<div class="container" >
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
	
  <?php
  $session = Yii::$app->session;
 if($session[Yii::$app->controller->id]!="")
 {
 if(in_array('a', $session[Yii::$app->controller->id])) 
 {
 echo Html::a(Yii::t('app', 'Tranfer Stock Request'), ['create'], ['class' => 'btn btn-default waves-effect waves-light']);
 }
 } ?>
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>
<div class="row" >
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
	
	
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],
                       [
            'attribute'=>'transferstock_requestcode', 
            'width'=>'310px',
            'group'=>true, 
            'groupedRow'=>true,                    
            'groupOddCssClass'=>'kv-grouped-row',  
            'groupEvenCssClass'=>'kv-grouped-row', 
        ],
    ['attribute'=>'frombranch','label'=>'Requested Branch','format'=>'raw','value'=>function($model) {return $model->companyfrombranch->branch_name; }],
    ['attribute'=>'tobranch','label'=>'Approved Branch','format'=>'raw','value'=>function($model) {return $model->companytobranch->branch_name; }],
    ['attribute'=>'product_name','label'=>'Product', 'headerOptions' => ['style' => 'color:#337ab7;']],
    ['attribute'=>'transferstockquantity','label'=>'Request Quantity', 'headerOptions' => ['style' => 'color:#337ab7;']],
    ['attribute'=>'unitname','headerOptions' => ['style' => 'color:#337ab7;']],
    ['attribute'=>'total_no_of_quantity','label'=>'Request Total Quantity', 'headerOptions' => ['style' => 'color:#337ab7;']],

    
[  'label' => 'transferstockdate',                
            'attribute' => 'transferstockdate',
          'value'=>function($model){return date("d-m-Y",strtotime($model->transferstockdate)); },
            'filterType'=> kartik\grid\GridView::FILTER_DATE, 
            'filterWidgetOptions' => [
                    'options' => ['placeholder' => 'Select date'],
                    'pluginOptions' => [
                        'format' => 'd-m-yyyy',
                        'todayHighlight' => true
                    ]
            ],
        ],
 
    ['attribute'=>'status','contentOptions'=>['style'=>'text-align:right;']],
    ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               'headerOptions' => ['style' => 'color:#337ab7;width:80px;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {   
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }    }}, 
                                'update' => function ($url, $model) {
                              	$url=Yii::$app->homeurl."?r=transferstock/update&id=".$model->transferstockid;
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
									   //	print_r($url);die;
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
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Transfer Stock</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
    });
</script>
