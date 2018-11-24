<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InRegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'IP Registrations';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right{
  float:right;	position: relative;
    top: -13px;
}

	.modal .modal-dialog .modal-content .modal-body {
    	padding: 0px;
	}
	button.close {
    	padding: 2px 7px;
    	/*background: #ff0c0c;*/
    	color: #fff;
    	border-radius: 27px;
	}
	
	button.close:hover {    	color: #fff;	}
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> 	</div>
		<div class="col-sm-6">
								<ol class="breadcrumb" style="float:right">
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
<div class="in-registration-index">

    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('IP Registration', ['create'], ['class' => 'btn btn-success addcat btn-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'autoid',
            'patient_type',
            'registered',
            'panel_type',
            'mr_no',
            //'ip_no',
            //'name_initial',
            //'patient_name',
            //'dob',
            //'sex',
            //'marital_status',
            //'relation_suffix',
            //'relative_name',
            //'address:ntext',
            //'city',
            //'district',
            //'state',
            //'pincode',
            //'phone_no',
            //'mobile_no',
            //'country',
            //'religion',
            //'type',
            //'paytype',
            //'bed_no',
            //'room_no',
            //'floor_no',
            //'room_type',
            //'consultant_dr',
            //'dr_unit',
            //'speciality',
            //'co_consultant',
            //'diagnosis',
            //'remarks:ntext',
            //'is_active',
            //'created_date',
            //'updated_date',
            //'user_id',
            //'userrole',
            //'ipaddress',

           // ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{view}{update}{delete}{pdf}',
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
                             
							    'delete' => function ($url, $model, $key) 
                                {
                                	$session = Yii::$app->session;
									
                                        return Html::button('<i class="fa fa-trash"></i>', [
                                        'value' => $url, 
                                        'style'=>'margin-right:4px;',
                                        'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 
                                        'data-toggle'=>'tooltip', 
                                        'title' =>'Delete' 
                                        ]);
                                        
								 },
								  'pdf' => function ($url, $model, $key) 
								   {
                                        $options = array_merge([
                                            'class' => 'btn btn-danger btn-xs pdf gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Report'),
                                            'aria-label' => Yii::t('yii', 'Report'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                            'target'=>'_blank'
                                        ]);
										
										$url= Url::to(['in-registration/pdf', 'id' => ($model -> autoid)]);
										
                                        return Html::a('<span class="fa fa-print"></span>', $url, $options);
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
</div>
</div>
<script>
    $(document).ready(function(){

         	
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i> View Category Group Master </span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	
 });
</script>