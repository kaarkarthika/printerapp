<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TreatmentOverallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Treatment Overalls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treatment-overall-index">
  

	<div class="container">
		
		<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
	
	  <?= Html::a('Add', ['create'], ['class' => 'btn btn-default waves-effect waves-light','style'=>'float:right;']) ?>
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo 'CancelOPD';?></a></li>
</ol>
</div>
</div>
		
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body" style="min-height:1000px;">
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
      
    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            ['attribute' => 'refund_status', 
            	'label' => 'Refund Status',
            ],
            
            'name',
           
             ['attribute' => 'mrnumber', 
            	'label' => 'MR Number',
            ],
            
             ['attribute' => 'billnumber', 
            	'label' => 'Bill Number',
            ],
            [	'attribute' => 'invoicedate', 
             	'label' => 'Invoice Date',
       	  	'value' => function($model)
       	  	{
                if($model->created_at != '')
				{
					return date('d-m-Y H:i:s',strtotime($model->invoicedate));	
				}
				
		   }],
            
             'overalltotal',
          
            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{view}{pdf}{procedurerefunds}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key)
							   {
                                
                                  return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', [
                                 'value' => $url,
                                  'style'=>'margin-right:4px;',
                                  'class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 
                                  'data-toggle'=>'tooltip', 
                                  'title' =>'View' ]);
								  
							 }, 
								   
                           'update' => function ($url, $model, $key) {
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
                                    },
                             
							    'delete' => function ($url, $model, $key) 
                                {
                                	$session = Yii::$app->session;
									
                                        return Html::button('<i class="fa fa-trash"></i>', [
                                        'value' => $url, 
                                        'style'=>'margin-right:4px;',
                                        'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 
                                        'data-toggle'=>'tooltip', 
                                        'title' =>'Delete' 
                                        ]);
                                        
								 },
								 'pdf' => function ($url, $model, $key) 
								   {
                                        $options = array_merge([
                                            'class' => 'btn btn-danger btn-xs pdf gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Report'),
                                            'aria-label' => Yii::t('yii', 'Report'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                            'target'=>'_blank'
                                        ]);
										
										$url= Url::to(['treatment-overall/report', 'id' => ($model -> id)]);
										
                                        return Html::a('<span class="fa fa-print"></span>', $url, $options);
                                    },
                                    
									'procedurerefunds' => function ($url, $model, $key) 
								   {
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs pdf gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Procedures Return'),
                                            'aria-label' => Yii::t('yii', 'Procedures Return'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                            'target'=>'_blank'
                                        ]);
										
										$url= Url::to(['treatment-overall/procedure-refunds', 'id' => urlencode(base64_encode(($model -> id)))]);
										
                                        return Html::a('<i class="fa fa-undo"></i>', $url, $options);
                                    },
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<script>
    $(document).ready(function(){

         	
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i> View Treatment Overalls </span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	
 });
</script>