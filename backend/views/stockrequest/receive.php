<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'Purchase Order Receive');
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
										<a class="btn btn-success" style="float: right;" href="<?php echo Yii::$app->homeUrl . "?r=stockrequest/index";?>">Move to Request</a>
										<a class="btn btn-success" style="float: right;" href="<?php echo Yii::$app->homeUrl . "?r=stockresponse/index";?>">Move to Response</a>
									</div>
									<div class="panel-body">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-hover'],
         
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],

        //  ['attribute'=>'companybranch', 'label'=>'Branch','headerOptions' => ['style' => 'color:#337ab7;']],
          
            [
            'attribute'=>'requestcode', 
             'group'=>true, 
            'groupedRow'=>true,                    // move grouped column to a single grouped row
            'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
           
        ],
          
             ['attribute'=>'vendorid','label'=>'Vendor',  'value'=>'vendor_name',
             'filter' => Html::activeDropDownList($searchModel, 'vendorid', $vendorlist,['class'=>'form-control ','prompt' => '--Vendor--'])],
             ['attribute'=>'productid','label'=>'Product',  'value'=>'product_name'],
             
			
	[  'label' => 'requestdate',                
            'attribute' => 'requestdate',
          'value'=>function($model){return date("d-m-Y",strtotime($model->requestdate)); },
            'filterType'=> kartik\grid\GridView::FILTER_DATE, 
            'filterWidgetOptions' => [
                    'options' => ['placeholder' => 'Select date'],
                    'pluginOptions' => [
                        'format' => 'd-m-yyyy',
                        'todayHighlight' => true
                    ]
            ],
        ],
	
    
	
	 ['attribute'=>'quantity','label'=>'Requested Quantity','value'=>function($model)
    {
    	return $model->quantity;
    }],
    
	
	
	
     ['attribute'=>'total_no_of_quantity','label'=>'Requested Total Unit','value'=>function($model)
    {
    	return $model->total_no_of_quantity;
    }],
    
	
	
               ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               
                'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
               'template'=>'{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) { 
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }  }}, 
								  
                              'update' => function ($url, $model) {
								 $options = array_merge(['data-toggle'=>'tooltip',                                  'title' => Yii::t('yii', 'Update'),                                  'aria-label' => Yii::t('yii', 'Update'),                                  'data-pjax' => '0']); 
								  
                            $url=Yii::$app->homeurl."?r=stockresponse/update1&id=".$model->requestid;
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::a('<span class="fa fa-edit btn btn-warning btn-xs" style="margin-right:4px;padding:3px;"></span>', $url,$options);                                
            
            }} }, 
                           'delete' => function ($url, $model, $key) {
                                       $session = Yii::$app->session;
									   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) 
                                  { 
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } } },
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div></div>
</div>
<script>
    $(document).ready(function(){
     $('body').on("click",".modalView",function(){
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Stock Request</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();  });
 });
</script>