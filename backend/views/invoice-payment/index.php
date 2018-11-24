<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
$this->title = 'Invoice Payment';
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
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
	
 <div class="clearfix"></div>
<?php Pjax::begin(['id'=>'sale-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;']],
            'name',
            'mrnumber',
             'billnumber',
             ['attribute'=>'invoicedate','value'=>function($model)
			 {
			 	return date("d/m/Y",strtotime($model->invoicedate));
			 }],
			 
               ['attribute'=>'overalltotal','label'=>'Total Amount'],
               
			   
               'paid_status',
               
                        ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                'headerOptions' => ['style' => 'width:250px;color:#337ab7;'],
               'template'=>'{pay}{cancel}{recancel}',
                            'buttons'=>[
                              'pay' => function ($url, $model)
							   {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!="")
								{
                                  if(in_array('pay', $session[Yii::$app->controller->id])) 
                                  {
                                  	
									if($model->paid_status!="Paid")
									{ 
						$return_text = '';	
			$url= Url::to(['invoice-payment/pay', 'id' =>  urlencode(base64_encode($model -> opsaleid))]);
			$return_text .= '<div class="col-md-3">' . Html::a('Pay',$url, ['class' => 'fa  btn btn-danger btn-xs']) . '</div>';
			return $return_text;	 
									} 
            } 
								   }
								 }, 
								 
								  'cancel' => function ($url, $model)
							   {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!="")
								{
							
                                  if(in_array('cancel', $session[Yii::$app->controller->id])) 
                                  {
                                  	
									if($model->paid_status!="Cancelled")
									{ 
						$return_text = '';	
		//	$url= Url::to(['invoice-payment/cancel', 'id' =>  urlencode(base64_encode($model -> opsaleid))]);
		//	$return_text .= '<div class="col-md-6">' . Html::a('Cancel',$url, ['class' => 'fa  btn btn-danger btn-xs']) . '&nbsp;';
			
		 $return_text.='<div class="col-md-4">' .  Html::button('<span>Cancel</span>', ['value' => $url, 'style'=>'margin-left:10px;',
			 'class' => 'btn btn-danger btn-xs modalCancel gridbtncustom', 
			 'data-toggle'=>'tooltip', 'title' =>'Cancel' ]).'</div>';
			
			
			
			return $return_text;	 
									}      
                                 } 
								   }
								 }, 
								 
								 
								 	  'recancel' => function ($url, $model)
							   {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!="")
								{
							
                                  if(in_array('recancel', $session[Yii::$app->controller->id])) 
                                  {
                                  	
									if($model->paid_status!="UnPaid" && $model->paid_status!="Paid")
									{ 
						$return_text = '';	
		//	$url= Url::to(['invoice-payment/cancel', 'id' =>  urlencode(base64_encode($model -> opsaleid))]);
		//	$return_text .= '<div class="col-md-6">' . Html::a('Cancel',$url, ['class' => 'fa  btn btn-danger btn-xs']) . '&nbsp;';
			
		 $return_text.='<div class="col-md-5">' .  Html::button('<span>Re Cancel</span>', ['value' => $url, 'style'=>'margin-left:10px;',
			 'class' => 'btn btn-danger btn-xs modalRecancel gridbtncustom', 
			 'data-toggle'=>'tooltip', 'title' =>'ReCancel' ]).'</div>';
			
			
			
			return $return_text;	 
									}      
                                 } 
								   }
								 }, 
								 
						
								 
         ],
         
		 
		      
                        
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
     $('body').on("click",".modalView",function(){
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Sales</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();
         });
    });
</script>