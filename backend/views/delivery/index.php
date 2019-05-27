<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Delivery';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
  <?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Delivery Challan', ['create'], ['class' => 'btn btn-success']);
   ?>
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
                                <ol class="breadcrumb">
                                     <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
                                     <li><a href="#"><?php echo $this->title;?></a></li>
                                </ol>
                            </div></div>

							<div class="panel panel-border panel-custom">
							<div class="panel-heading"></div>
<div class="panel-body">
<?php Pjax::begin(['id'=>'delivery-grid']); ?>   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'cust_id',
            'company_name',
           // 'cust_name',
            'gstin_no',
           // 'state',
           // 'state_code',
            'address:ntext',
            'bill_no',
            //'bill_date',
            'tot_qty',
            'tot_amt',
            //'transport',
            //'vehicle_num',
            //'remarks:ntext',
            //'c_date',
            //'u_date',
            //'user_id',
            //'ipaddrss',

            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               
              'headerOptions' => ['style' => 'width:180px;color:#337ab7;'],
               'template'=>'{update}{print}{convertiv}{delete}',
                            'buttons'=>[
                                
                                'view' => function ($url, $model, $key) {
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs btn-sm view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
                              },
                                'update' => function ($url, $model, $key) {
                                   
                                      $session = Yii::$app->session;

                                       if($session['user_type']=='S')
                                      {
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);

                                      }       
                                      },


                                  'convertiv' => function ($url, $model, $key) {
                                   
                                      $session = Yii::$app->session;

                                      
                                        $options = array_merge([
                                            'class' => 'btn btn-primary btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Convert INV'),
                                            'aria-label' => Yii::t('yii', 'Convert INV'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
                                        $url = Url::toRoute(['invoice-table/convertinvoice', 'id' => $model->id]);
                                        return Html::a('<span class="fa fa-exchange"></span>', $url, $options);

                                        
                                      },

                                        'print' => function ($url, $model, $key) {
                                   
                                        
                                    
                                        $options = array_merge([
                                            'class' => 'btn btn-success btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Print'),
                                            'aria-label' => Yii::t('yii', 'Print'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                            'target'=>'_blank',
                                        ]);
                                        return Html::a('<span class="fa fa-print"></span>', $url, $options);
                                       },
        
                         
                                     
                                      'delete' => function ($url, $model, $key) {
                                       $session = Yii::$app->session;
                                        if($session['user_type']=='S')
                                      {
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);

                                      }
                                   },
                                 
                          ] ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
 
            </div>
      
