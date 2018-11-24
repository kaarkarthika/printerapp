<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = 'Assign Rights';
 $session = Yii::$app->session;
 
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
 echo Html::a(' Add Rights',['create'],['class' => 'btn btn-default  waves-effect waves-light']);
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
<?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [ ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;'],],
           
            //'id',
            'auth_role',
            //'assign_service',
            'status',
              ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
           'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                              	$session = Yii::$app->session;
								//echo "<pre>";
								//print_r($session['authUserRole']);die;
								//print_r($session[Yii::$app->controller->id]);die;
								
								if(($session[Yii::$app->controller->id]!="") && (in_array('v', $session[Yii::$app->controller->id]))){
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url,'style'=>'margin-right:4px;margin-bottom:4px;','class' => 'btn btn-primary btn-sm btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }
									}, 
                            
                              'update' => function ($url, $model, $key) {
                              	$session = Yii::$app->session;
							//	if(($session[Yii::$app->controller->id]!="") && (in_array('e', $session[Yii::$app->controller->id]))){
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-sm btn-xs  update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-bottom:4px;margin-right:4px;',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
								//  }
							  }  ,
                                'delete' => function ($url, $model, $key) {
                                	$session = Yii::$app->session;
									if(($session[Yii::$app->controller->id]!="") && (in_array('d', $session[Yii::$app->controller->id]))){
                                      return Html::button('<i class="fa fa-trash"></i>', ['value' => $url,'style'=>'margin-bottom:4px;', 'class' => 'btn btn-danger btn-sm btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);  
                   								  }  }  
                          ] ]]]);
      
  Pjax::end(); ?>
  </div></div></div></div></div>
<script>
    $(document).ready(function(){
  $('body').on("click",".modalView",function(){
           
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Rights</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();
         });
});
</script>