<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyBranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
$datatables="";

$datatables = $dataProvider->getModels();
$session = Yii::$app->session;
?>

<div class="container">
	

<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                	
                            
                	 <?php
                	 if($session[Yii::$app->controller->id]!=""){
                	 if(in_array('a', $session[Yii::$app->controller->id])) {
                	 
                	 echo Html::a(' Add Branch',['create'],['class' => 'btn btn-default  waves-effect waves-light',]);
					
					 } } ?>
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
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;']],

        
            ['attribute'=>'company_name','label'=>'Company','headerOptions'=>['style'=>'color:#337ab7;']],
              'branch_code',
              'branch_name',
              ['attribute'=>'is_head_office','format'=>'raw','value'=>function($model)
			  {
			  	if($model->is_head_office==1)
				{
					return "Yes";
				}
				else{
					return "No";
				}
			  }
			  ],
          
          

                   ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
              'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
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
                                return Html::a('<span class="fa fa-edit btn btn-warning btn-xs  gridbtncustom" style="margin-right:5px;"></span>', $url,$value);
                               
            }  } }, 
                             
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
                         <div id="dialog" class="modal-block mfp-hide">
                <section class="panel panel-info panel-color">
                    <header class="panel-heading">
                        <h2 class="panel-title">Are you sure?</h2>
                    </header>
                    <div class="panel-body">
                        <div class="modal-wrapper">
                            <div class="modal-text">
                                <p>Are you sure that you want to delete this row?</p>
                            </div>
                        </div>

                        <div class="row m-t-20">
                            <div class="col-md-12 text-right">
                                <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                                <button id="dialogCancel" class="btn btn-default waves-effect">Cancel</button>
                            </div>
                        </div>
                    </div>
                    
                </section>
            </div>

<script>
    $(document).ready(function(){

         	$('body').on("click",".addbranch",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=company-branch/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Branch</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
        
         $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Branch details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });

 
 	$('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
       // $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i>Update Branch</span>');
                 //  $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">DELETE</span> this item ?</h4>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         
         
         
     function isNumber(evt)
    {
        var this_value = evt.val();
        var num = this_value.replace(/\D/g, '');
        //        var num = this_value.replace(/\D[^+ -()]/g, '');
        evt.val(num);
    }
         
      });
      </script>


