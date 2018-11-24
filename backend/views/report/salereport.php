<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Report';
error_reporting(0);

?>
<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div></div>
							
							 <?php  echo $this->render('_search', ['model' => $searchModel,'patienttypelist'=>$patienttypelist,"insurancetypelist"=>$insurancetypelist]); ?>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
<?php Pjax::begin(['id'=>'sale-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;'],],

         //   'opsaleid',
          'billnumber',
            'name',
           // 'dob',
          //  'gender',
            'mrnumber',
          // 'paid_status',
           // 'emailid:email',
          //   'phonenumber',
			[  'label' => 'Invoice Date',                
            'attribute' => 'invoicedate',
          'value'=>function($model){return date("d-m-Y h:i:s",strtotime($model->invoicedate)); },
        
        ],
			 
            
             ['attribute'=>'total','value'=>function($model)
			 {
			 	return number_format($model->total,2);
			 }],
           //  'physicianname',
            // 'invoicedate',
            // 'updated_by',
            // 'updated_on',
            // 'updated_ipaddress',

                        ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               
                'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
                'contentOptions' => ['width' => '200px;'],
               'template'=>'{print}',
                            'buttons'=>[
                    'print' => function ($url, $model, $key) {
                                    $session = Yii::$app->session;
									if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('print', $session[Yii::$app->controller->id])) {    
                      return Html::a('<span class="btn btn-purple btn-xs btn-flat waves-effect waves-light" style="margin-right:4px;">Invoice',
                       ['sales/invoice','id'=>$model->opsaleid], ["target"=>"_blank","data-pjax"=>"0",'data-toggle'=>'tooltip','title' =>'Bill Invoice']);
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
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Sales</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();
         });
    });
</script>