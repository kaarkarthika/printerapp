<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSolutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tansi Service Centre';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .gridbtncustom{margin-right: 3px;}
  .box-header {
    color: #fff;
    background-color: #ff0000;
}
</style>
<div class="school-management-index">
    <div class="box-body">
    
    
    <div class="box box-primary cgridoverlap">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-table"></i> <?= 'Service Centres' ?></h3>
        </div><!-- /.box-header -->
    <div class="box-body">
      
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            //'center_autoid',
            
            'service_center_name',
            'service_center_code',
            'username',
            //'service_center_status',
            //'service_center_timestamp',
            // 'service_center_createdat',
            
           

            // [
            // 'header'=> 'Actions',
            // 'class' => 'yii\grid\ActionColumn'
            // ],

           /* ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Actions',
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                   
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
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
                                'delete' => function ($url, $model, $key) {
                                       
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'class' => 'btn btn-default btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                    },
                          ] ],*/
           
        ],
    ]); ?>
<?php Pjax::end(); ?>
   </div>
  </div>
 </div>
</div>


<script>
    $(document).ready(function(){

         $('.modalView').click(function(){
             var PageUrl = $(this).attr('value');
       // $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-building-o"></i> Service Centre View</span>');
                 //  $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">DELETE</span> this item ?</h4>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
    });

</script>

