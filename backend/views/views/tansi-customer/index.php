<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TansiCustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tansi Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tansi-customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tansi Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'autoid',
            'name',
            'email:email',
            'password',
            'mobile',
            // 'gender',
            // 'date_of_birth',
            // 'address:ntext',
            // 'city',
            // 'state',
            // 'pincode',
            // 'photo',
            // 'status',
            // 'created_at',
            // 'modified_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
