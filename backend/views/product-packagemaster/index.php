<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductPackagemasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Packagemasters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	
 	<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                	
                            
                	 <?php
               
                	 
                	
						 //	 echo Html::button('Add ProductGroup',['class' => 'btn btn-default dropdown-toggle  waves-effect waves-light group_product']);
 echo Html::a(Yii::t('app', 'Product Package'), ['create'], ['class' => 'btn btn-default  waves-effect waves-light']);
					 ?>
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'pack_name',
            'is_active',
            //'created_at',
            //'updated_at',
            // 'updated_ipaddress',

             ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
              'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{update}',
                            'buttons'=>[
                             
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
                                    
							'delete' => function ($url, $model, $key) {
								
                                       return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'class' => 'btn btn-danger btn-sm btn-xs delete gridbtncustom', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
									  
									     },
									     
								 
										 
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div></div>
</div>
