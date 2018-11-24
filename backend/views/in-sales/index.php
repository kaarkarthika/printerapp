<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Sales';

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
 echo Html::a(Yii::t('app', 'Add Sales'), ['create'], ['class' => 'btn btn-default  waves-effect waves-light']);
 }
 } ?>
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
<?php Pjax::begin(['id'=>'sale-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;'],],

         //   'opsaleid',
            'name',
           // 'dob',
          //  'gender',
            'mrnumber',
          // 'paid_status',
           // 'emailid:email',
          //   'phonenumber',
             'billnumber',
             'overalltotal',
           //  'physicianname',
            ['attribute'=>'invoicedate','value'=>function($model)
            {
                return date("d-m-Y H:i:s",strtotime($model->invoicedate));
            }],
            // 'updated_by',
            // 'updated_on',
            // 'updated_ipaddress',

                        ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               
                'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
                'contentOptions' => ['width' => '200px;'],
               'template'=>'{view}{opreturns}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                  $session = Yii::$app->session;
                                  if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {  
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
                                   }} }, 
                                   
                                   
                              'opreturns' => function ($url, $model) 
                              {
                                    $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Return Tablet'),
                                            'aria-label' => Yii::t('yii', 'Return Tablet'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                            'target'=>'_blank'
                                        ]);
                                    
                                    $url= Url::to(['in-sales/opreturns', 'id' =>  urlencode(base64_encode($model -> opsaleid))]);
                                    return Html::a('<span class="fa fa-edit" ></span>', $url,$options);   
                               }, 
                             
                                'delete' => function ($url, $model, $key) {
                                    $session = Yii::$app->session;
                                    if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) {    
                                      
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } }},
                                        
                        
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?>

<!--Common Modal Starts For Custom Operation -->
<?php 
    Modal::begin([
                    'header' => '<h3 id="operationalheader_large"> </h3>',
                    'id' => 'operationalmodal_large', 
                    'size' => 'modal-lg',

                ]);
      echo "<div id='modalContenttwo_large'>
            <div id='customtwo_large'><input type='hidden' class='data2'></div>
        </div>";
    Modal::end();

?>
<!--Common Modal End -->

</div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){

            
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader_large').html('<span> <i class="fa fa-fw fa-th-large"></i>View Sales</span>');
             $('#operationalmodal_large').modal('show').find('#modalContenttwo_large').load($(this).attr('value'));
             return false;

         });


    

    });

</script>


