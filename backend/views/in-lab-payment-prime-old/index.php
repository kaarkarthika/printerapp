<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
 	<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-left m-t-15">
                                	
                         <h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
							
													                              <div class="btn-group pull-right m-t-15">
   <?= Html::a('Create Lab Payment', ['create'], ['class' => 'btn btn-success']) ?>
</div>
						</div>
						

						
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'autoid',
              ['attribute' => 'mr_number', 
            	'label' => 'MR Number ',
             	],
           	['attribute' => 'name', 
            	'label' => 'Name',
             	],
			['attribute' => 'ph_number', 
            	'label' => 'Phone Number ',
             	],
			 ['attribute' => 'physican_name', 
            	'label' => 'Physician Name ',
             	],
			'payment_status',
			['attribute' => 'overall_paid_amt', 
            	'label' => 'Paid Amount',
             	],
           // 'lab_testgroup',
            //'lab_testing',
            //'total_amount',
            //'discount_amount',
            //'net_amount',
            //'refund_amount',
            //'towards',
            //'pay_mode',
            //'cancellation:ntext',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'ip_address',

          //  ['class' => 'yii\grid\ActionColumn'],
           ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{view}{lab-return}{pdf}',
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
							 
							 'lab-return' => function ($url, $model, $key)
							   {
                                
                                 $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Return'),
                                            'aria-label' => Yii::t('yii', 'Return'),
                                            'data-pjax' => '0',
                                        ]);
                                        
								$url= Url::to(['in-lab-payment-prime/labreturn', 'id' => urlencode(base64_encode(($model -> lab_id)))]);		
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
								  
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
										
										$url= Url::to(['in-lab-payment-prime/billreport', 'id' => ($model -> lab_id)]);
										
                                        return Html::a('<span class="fa fa-print"></span>', $url, $options);
                                    },
                          ] ],
          ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>
<style>
.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 24px !important;
    padding-left: 0 !important;
}

.select2-container--krajee .select2-selection--single .select2-selection__clear {
    right: 4rem;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: unset !important;
    padding-left: 0px !important;
}

.panel-success > .panel-heading {
    background-color: #5fbeaa;
}

h4.panel-title,.panel-heading .pull-right .summary{
    color: #fff;
}

.btn-toolbar.kv-grid-toolbar.toolbar-container.pull-right>textarea {
    display: none;
}

.panel.panel-success .kv-panel-after {
    width: 135px;
    float: left;
}

i.fa.fa-info-circle {
    color: #000;
}

.bootstrap-dialog.type-warning .modal-header {
    background-color: #5fbeaa;
    padding: 10px 17px !important;
}

table.table.table-striped.table-hover.kv-grid-table.table-bordered.kv-table-wrap td {
    background: #fff;
}
table.table.table-striped.table-hover.kv-grid-table.table-bordered.kv-table-wrap tbody tr td {
    position: relative;
    top: 10px !important;
}
table.table.table-striped .empty {
    font-weight: 700;
    text-align: center;
    color: red;
}
</style>

 <script>
 
$("#wrapper").addClass("enlarged");
$("#wrapper").addClass("forced");
$(".list-unstyled").css("display","none");

$(document).ready(function(){
     $('body').on("click",".modalView",function(){
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i> View Lab Payment </span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });
 });
</script>