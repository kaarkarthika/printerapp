<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
$this->title = Yii::t('app', 'Return');
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
 echo Html::a(Yii::t('app', 'Add  Return'), ['patientindex'], ['class' => 'btn btn-default  waves-effect waves-light']);
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
            ['class' => 'yii\grid\SerialColumn'],

         //   'return_id',
            'return_invoicenumber',
          [ 'attribute'=>'patient_type','format'=>'raw','value'=>function($model)
          {if($model->patient_type==1)
		  {
		  	return "In Patient";
		  }
else{return "Out Patient";}
          	
          }],
            'mrnumber',
            'paid_status',
            'total',
             ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                'headerOptions' => ['style' => 'width:250px;color:#337ab7;'],
               'template'=>'{refund}{cancel}{recancel}',
                            'buttons'=>[
                              'refund' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('refund', $session[Yii::$app->controller->id])) {
                                  	
									if($model->paid_status!="Yes")
									{
										 $return_text = '';	
	
			$url= Url::to(['invoice-payment/refund', 'id' =>  urlencode(base64_encode($model -> return_id))]);
			$return_text .= '<div class="col-md-4">' . Html::a('Refund',$url, ['class' => 'fa  btn btn-danger btn-xs']) . '</div>';
			return $return_text;	 
									}      
                               
            }  } }, 
            
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
		
		
			$url= Url::to(['invoice-payment/cancelreturn', 'id' => $model -> return_id]);
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
		$url= Url::to(['invoice-payment/recancelreturn', 'id' => $model -> return_id]);
			
		 $return_text.='<div class="col-md-5">' .  Html::button('<span>Re Cancel</span>', ['value' => $url, 'style'=>'margin-left:10px;',
			 'class' => 'btn btn-danger btn-xs modalRecancel gridbtncustom', 
			 'data-toggle'=>'tooltip', 'title' =>'ReCancel' ]).'</div>';
			
			
			
			return $return_text;	 
									}      
                                 } 
								   }
								 }, 
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
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Sale Details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();  });
 });
</script>