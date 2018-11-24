<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UsersProfile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Profiles', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="body">
<div class="users-profile-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary waves-effect']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger waves-effect',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
         //   'first_name',
         //   'last_name',
         //   'dob',
        //    'user_type',
         //   'city',
            //'auth_key',
           // 'password_hash',
         //   'password_reset_token',
         //   'status',
            'created_at',
            'updated_at',
          //  'rights:ntext',
         //   'status_flag',
          //  'user_level',
            'mobile_number',
          //  'designation',
        ],
    ]) ?>

</div></div></div>
