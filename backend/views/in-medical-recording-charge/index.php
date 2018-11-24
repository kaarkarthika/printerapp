<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use backend\models\TaxgroupingLog;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InMedicalRecordingChargeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In Medical Recording Charges';
$this->params['breadcrumbs'][] = $this->title;
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
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
   <?php Pjax::begin(['id'=>'recording-grid']); ?> 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'autoid',
            'name',
            'amount',
            //'hsncode',
            
			[
            'attribute'=>'hsncode', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'HSN Code',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) { return $model->hsn->hsncode;},
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(TaxgroupingLog::find()->asArray()->all(), 'taxgroupid', 'hsncode'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Search HSN--'],
        ],
			
          //  'created_date',
            //'updated_date',
            //'user_id',
            //'user_role',
            //'ipaddress',

             ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{view}{update}',
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
								   
                             'update' => function ($url, $model) {
                              	     
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);                                
            
          						}, 
                             
							
							 
							 
                                /*'delete' => function ($url, $model, $key) 
                                {
                                	
                                        return Html::button('<i class="fa fa-trash"></i>', [
                                        'value' => $url, 
                                        'style'=>'margin-right:4px;',
                                        'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 
                                        'data-toggle'=>'tooltip', 
                                        'title' =>'Delete' 
                                        ]);
                                     
								 },*/
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
                    'size' => 'modal-lg',

                ]);
      echo "<div id='modalContenttwo'>
            <div id='customtwo'><input type='hidden' class='data2'></div>
        </div>";
    Modal::end();

?>

<script>
    $(document).ready(function(){

         	$('body').on("click",".addphysician",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=physicianmaster/create';
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Physician</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Physician</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	  $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Medical Recording Charge</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;});
            
 });
</script>