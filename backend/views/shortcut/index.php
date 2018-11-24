<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShortcutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shortcuts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
  <?php
  $session = Yii::$app->session;
  ?>
 <p>
        <?= Html::a('Add Shortcut', ['create'], ['class' => 'btn btn-default  waves-effect waves-light']) ?>
    </p>
   
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         		'name',
				'link',

            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               
              'headerOptions' => ['style' => 'width:180px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                            	
							
							
							
							
							
							
                              'view' => function ($url, $model, $key) {
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs btn-sm view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
							  },
                                'update' => function ($url, $model, $key) {
                              	//print_r($url);die;
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Job Card Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
                                    },
        
                         
                                'delete' => function ($url, $model, $key) {
                                 
                                     
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'class' => 'btn btn-danger btn-sm btn-xs delete gridbtncustom', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                 },
                                 
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){
         	 $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Shortcut Details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             //return false(); 

         });
   $('.delete').click(function () {
 	 	var url=$(this).val();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this module!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
            	
            	
            	 $.ajax({
        url: url,
        type: 'post',
       
        success: function (data) {
        	if(data=="Y"){
        		 $.pjax.reload({container:"#projectmodule-grid"});
        	  swal("Deleted!", "Your module has been deleted.", "success");
        	 }
        	
        	
        }
       
     });	
              
            });
        });
 
         });
</script>