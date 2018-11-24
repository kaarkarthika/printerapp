<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CancelLogTableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cancel Log Tables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
 	<?= Html::a('Cancel OPD', ['cancelopd'], ['class'=>'btn btn-default']) ?>
</div>
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
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'cancel_id',
           // 'cancel_ran_id',
            //'cancel_trans_type',
            //'cancel_type',
            'subvisitno',
            'mrnumber',
            //'opd_type',
            //'towards',
            //'refund_type',
            //'payment_mode',
           // 'hospital_fees',
            'doctor_fees',
            'cancel_amt',
            'amt_words',
            'paid',
            //'reason_cancelled:ntext',
            'created_at',
            //'updated_at',
            //'ip_address',
            //'user_id',

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
									</div>
								</div>
							</div>
							</div>
 <script type="text/javascript">
  $(document).ready(function(){
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");   			
    //  $(".list-unstyled > li").removeClass("active1 active");
        $(".list-unstyled").css("display","none");
  });
</script>