<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OpMoneyreceiptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OP Money Receipts';
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
    	background: #ff0c0c;
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
		<div class="col-sm-6" >
								<ol class="breadcrumb" style="float:right">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
							</div>
	</div>
	
<div class="row">	
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body"> 
<div class="op-moneyreceipt-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Op Moneyreceipt', ['create'], ['class' => 'btn btn-success btn-right']) ?>
    </p>
<?php $vendorlist = ["P"=>"Procedures","R"=>"Requistions"]; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'autoid',
            //'mr_type',
            [
              'attribute' => 'mr_type',
              'value'=>function($model){
                if($model->mr_type=="R"){
                return "Requistions";   
              }elseif ($model->mr_type=="P") {
                 return "Procedures";  
              }
                
              },

              'filter' => Html::activeDropDownList($searchModel, 'mr_type', $vendorlist,['class'=>'form-control ','prompt' => '--Select--'])
             // 'filter' => Html::DropDownList(['P'=>'Procedures','R'=>'Requistiona'],['class'=>'form-control','prompt' => 'Select Category']),
            ],         
            'mr_number',
           // 'tds',
           // 'service_tax_amount',
            //'request_date',
            //'post_discount',
            //'dis_allowed_amt',
            //'recovery_amt',
             'patient_name',
            'paid_amount',
           
           // 'total_amt',
            [
              'attribute' => 'org_disc_amt',
              'label' =>'Due Amount',

            ],
            //'org_disc_amt',
            //'amount_words',
            //'payment_by',
            //'towards',
           // 'auth_by',
            //'bank_name',
            //'remarks',
           // 'status',
            //'created_at',
            //'updated_at',
            //'user_id',
            //'updated_ipaddress',

          //   ['class' => 'yii\grid\ActionColumn'],
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
								   
                   'update' => function ($url, $model, $key) {
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                        ]);
										
										$url= Url::to(['op-moneyreceipt/update', 'id' => urlencode(base64_encode(($model -> autoid)))]);
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
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View OP MONEY RECEIPTS</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });
 	});
</script>