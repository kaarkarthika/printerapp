<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaxmasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tax Master';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
  <?php
 
  echo Html::a(' Add Tax',['create'],['class' => 'btn btn-default  waves-effect waves-light   ']);
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

<?php Pjax::begin(['id'=>'taxmaster-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],

        //    'taxid',
        'taxgroup',
             [
    'attribute' => 'taxvalue',
    'contentOptions' => ['class' => 'text-right'],
    'headerOptions' => ['class' => 'text-center']
],
            [
    'attribute' => 'financialyear',
    'contentOptions' => ['class' => 'text-right'],
    'headerOptions' => ['class' => 'text-center']
],
          
            [
    'attribute' => 'additionaltax',
    'contentOptions' => ['class' => 'text-right'],
    'headerOptions' => ['class' => 'text-center']
],
         //   'is_active',
         //   'updated_by',
          //  'updated_on',
            // 'updated_ipaddress',

                  ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                    
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
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
                            
                                'delete' => function ($url, $model, $key) {
                                     
                                     
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
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
<script>
    $(document).ready(function(){

            $('body').on("click",".addtax",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=taxmaster/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Tax</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Tax</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
         
      $('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
      
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Tax</span>');
      
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;
         });
     });
</script>
