<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
	 <?php  echo $this->render('_reportsearch', ['model' => $searchModel]); ?>
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
            ['attribute'=>'paid_status','label'=>'Refund Status','value'=>function($model)
			{
				return $model->paid_status;
			}],
            'total',
            ['attribute'=>'updated_on','label'=>'Return Date','value'=>function($model)
			{
				return date("d/m/Y",strtotime($model->updated_on));
			}],
			
                     ['class' => 'yii\grid\ActionColumn',
              
               'template'=>'{print}',
                            'buttons'=>[
               
                                        	 'print' => function ($url, $model, $key) {
                                    $session = Yii::$app->session;
									if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('print', $session[Yii::$app->controller->id])) {    
                                      
                                        return Html::a('<span class="btn btn-purple btn-sm btn-rounded waves-effect waves-light" style="margin-right:4px;">Invoice', ['salesreturn/invoice','id'=>$model->return_id], ["target"=>"_blank", "data-pjax"=>"0", 'data-toggle'=>'tooltip', 'title' =>'Invoice' ]);
                                        } }},
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