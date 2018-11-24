<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
//use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Specialistdoctor;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UcilValidateDateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ucil Validate Dates';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
  .table-bordered {
    border: 0px solid #ebeff2;
}
</style>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
  <?php
  
  $session = Yii::$app->session;
/* if($session[Yii::$app->controller->id]!="")
 {
    
 if(in_array('a', $session[Yii::$app->controller->id])) 
 {*/
    
 //echo Html::button(' Add City',['class' => 'btn btn-default waves-effect waves-light addcity']);
/* }
 }*/ ?>
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
    <?php Pjax::begin(['id'=>'city-grid']); ?>   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'autoid',
            'ucil_date_value',
           // 'created_date',

             ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{update}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key)
                               {
                               /*  $session = Yii::$app->session;
                                 if(!empty($session[Yii::$app->controller->id]) &&(in_array('v', $session[Yii::$app->controller->id])))
                                 {*/
                                  return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', [
                                 'value' => $url,
                                  'style'=>'margin-right:4px;',
                                  'class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 
                                  'data-toggle'=>'tooltip', 
                                  'title' =>'View' ]);
                                //  }
                             }, 
                                   
                                      'update' => function ($url, $model) {
                                $session = Yii::$app->session;
                               /* if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {    */  
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);    
                                // } } 
                             }, 
                             
                                'delete' => function ($url, $model, $key) 
                                {
                                 //   $session = Yii::$app->session;
                                 //    if(!empty($session[Yii::$app->controller->id]) && (in_array('d', $session[Yii::$app->controller->id])))
                                    
                                     //  {
                                        return Html::button('<i class="fa fa-trash"></i>', [
                                        'value' => $url, 
                                        'style'=>'margin-right:4px;',
                                        'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 
                                        'data-toggle'=>'tooltip', 
                                        'title' =>'Delete' 
                                        ]);
                                      //  } 
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
<?php 
    Modal::begin([
                    'header' => '<h4 id="operationalheader"> </h4>',
                    'id' => 'operationalmodal', 
                    'size' => 'modal-md',

                ]);
      echo "<div id='modalContenttwo'>
            <div id='customtwo'><input type='hidden' class='data2'></div>
        </div>";
    Modal::end();

?>
 
 
<script>
    $(document).ready(function(){

            $('body').on("click",".addcity",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=city-master/create';
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i> City</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View City</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

      $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> City</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;});
            
 });
</script>