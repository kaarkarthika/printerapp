<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstimateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estimates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
  <?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Add Estimate', ['create'], ['class' => 'btn btn-success']);
   ?>
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
    <?php Pjax::begin(['id'=>'estimete-grid']); ?>   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'auto_id',
            //'customer_id',
            'customer_name',
            'bill_number',
            'particular_field:ntext',
            'amount',
            //'created_at',
            //'updated_at',
            //'user_id',
            //'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               
              'headerOptions' => ['style' => 'width:180px;color:#337ab7;'],
               'template'=>'{update}{deliverychallan}',
                            'buttons'=>[
                                
                                'view' => function ($url, $model, $key) {
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs btn-sm view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
                              },
                                'update' => function ($url, $model, $key) {
                                   
                                        
                                    
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
                                       },

                                       'deliverychallan' => function ($url, $model, $key) {
                                   
                                        
                                    
                                        $options = array_merge([
                                            'class' => 'btn btn-success btn-xs gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Convert to DC'),
                                            'aria-label' => Yii::t('yii', 'Convert to DC'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
                                        return Html::a('<span class="fa fa-exchange-alt"></span>', $url, $options);
                                       },
        
                         
                                     
                                      'delete' => function ($url, $model, $key) {
                                     
                                    
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
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