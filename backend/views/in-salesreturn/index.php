<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InSalesreturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Salesreturns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-salesreturn-index">
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

            'return_id',
            'saleid',
            'return_invoicenumber',
            'patient_type',
            'returndate',
            //'name',
            //'mrnumber',
            //'patient_id',
            //'sub_visit_id',
            //'subvisit_num',
            //'branch_id',
            //'returnincrement',
            //'return_qty',
            //'unit_price',
            //'total',
            //'totalgstvalue',
            //'totalcgstvalue',
            //'totalsgstvalue',
            //'totaldiscountvalue',
            //'totalcgstpercentage',
            //'totalsgstpercentage',
            //'totalgstpercentage',
            //'totaldiscountpercentage',
            //'paid_status',
            //'is_active',
            //'updated_by',
            //'created_at',
            //'updated_on',
            //'updated_ipaddress',

               ['class' => 'yii\grid\ActionColumn',
              
               'template'=>'{print}',
                            'buttons'=>[
               				 'print' => function ($url, $model, $key) 
               				 {
                               return Html::a('<span class="btn btn-purple btn-xs btn-flat waves-effect waves-light" style="margin-right:4px;">Invoice', ['in-sales/returntabletbill','id'=>$model->return_id], ["target"=>"_blank", "data-pjax"=>"0", 'data-toggle'=>'tooltip', 'title' =>'Return Bill Invoice' ]);
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
