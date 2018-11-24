<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
$this->title = 'Vendor Branch';
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
 echo Html::a(Yii::t('app', 'Add Vendor Branch'), ['create'], ['class' => 'btn btn-default waves-effect waves-light']);
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
<?php  echo $this->render('_search', ['model' => $searchModel,'vendorlist'=>$vendorlist]); 
 Pjax::begin(['id'=>'vendorbranch-grid']); 
 echo GridView::widget([
        'dataProvider' => $dataProvider,  'filterModel' => $searchModel,  'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [ ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],
    		
    		[  'attribute' => 'vendor_name',
			      'headerOptions' =>['style'=>'color:#337ab7;'],
          ],
		    'branchname','branchcode',
             ['attribute' => 'is_headoffice', 'filter'=>array("1"=>"yes","0"=>"No"),'format'=>'raw', 'value' => function($model){
                               if($model->is_headoffice==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
          
             ['attribute'=>'city'],
             'gstnumber',
                  ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
              
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                 $session = Yii::$app->session;
								 if(!empty($session[Yii::$app->controller->id]))
								 {
                                  if(in_array('v', $session[Yii::$app->controller->id])) {   
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  } } }, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if(!empty($session[Yii::$app->controller->id]))
								{
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::a('<span class="fa fa-edit btn btn-warning btn-xs" style="margin-right:5px;"></span>',$url,$options );        
                               
            }} }, 
                     'delete' => function ($url, $model, $key) {
                                	$session = Yii::$app->session;
									if(!empty($session[Yii::$app->controller->id]))
									{
                                  if(in_array('d', $session[Yii::$app->controller->id])) { 
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
     $('body').on("click",".modalView",function(){
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i> View VendorBranch</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();
         });
    });
</script>