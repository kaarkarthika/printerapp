<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaxgroupingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tax Group';
$this->params['breadcrumbs'][] = $this->title;
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
  echo Html::button(' Add Taxgroup',['class' => 'btn btn-default  waves-effect waves-light addtaxgroup  ']);
 }
 } ?>
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


<?php Pjax::begin(['id'=>'taxgrp-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],

          'hsncode',
       
	  ['attribute' =>'groupid','value' => function($model){
                               if(!empty($model->taxmaster->taxgroup))
							   {
							   	return $model->taxmaster->taxgroup;
							   }
							   else{
							   	return "-";
							   }
                        },'filter'=>Html::activeDropDownList($searchModel,'groupid',$taxmaster,['class'=>'form-control','prompt' =>'--Group Name--']),],

  [
    'attribute' => 'groupname',
   
    'headerOptions' => ['class' => 'text-left']
],

             ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        },'filter'=>Html::activeDropDownList($searchModel,'is_active',array("1"=>"Yes","0"=>"No"),['class'=>'form-control','prompt' =>'--Select--']),],
            
  ['attribute' => 'effect_date', 'format'=>'raw', 'value' => function($model){
                               if($model->effect_date!='')
							   {
							   	return date('d-m-Y',strtotime($model->effect_date));
							   }
							   else{
							   	return "-";
							   }
                        },'filter'=>DatePicker::widget([
                    'model' => $model, 
                    'name' => 'TaxgroupingSearch[effect_date]',
                    'value'=>$_GET['TaxgroupingSearch']['effect_date'],
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'autoclose'=>true,
                    ]
                ]) 

            ],
			
      
                   ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {   
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }    }}, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);                                
            
            }  } }, 
                              // 'update' => function ($url, $model, $key) {
                                        // $options = array_merge([
                                            // 'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            // 'data-toggle'=>'tooltip',
                                            // 'title' => Yii::t('yii', 'Update'),
                                            // 'aria-label' => Yii::t('yii', 'Update'),
                                            // 'data-pjax' => '0',
                                        // ]);
                                        // return Html::a('<span class="fa fa-edit"></span>', $url, $options);
                                    // },
                                'delete' => function ($url, $model, $key) {
                                  $session = Yii::$app->session;
								  if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) {      
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } } },
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

         	$('body').on("click",".addtaxgroup",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=taxgrouping/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Tax Group</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
         
         
    
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Taxgroup</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });


 	  $('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
       // $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Taxgroup</span>');
                 //  $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">DELETE</span> this item ?</h4>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });


    });

</script>

<script type="text/javascript">
  
$("#wrapper").addClass("enlarged");
$("#wrapper").addClass("forced");   			
//  $(".list-unstyled > li").removeClass("active1 active");
$(".list-unstyled").css("display","none");
  
</script>


 <script type="text/javascript">
            $(function () {
                $('#datepicker1').datetimepicker({
                	format: 'DD-MM-YYYY'
                });
            });
        </script>