<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InRegistration */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'In Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.modal-body{
	 height: 500px;
    overflow-y: scroll;
    overflow-x: hidden;
}
</style>
<div class="in-registration-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->autoid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'autoid',
            'patient_type',
            'registered',
            'panel_type',
            'mr_no',
            'ip_no',
            'name_initial',
            'patient_name',
            'dob',
            'sex',
            'marital_status',
            'relation_suffix',
            'relative_name',
            'address:ntext',
            'city',
            'district',
            'state',
            'pincode',
            'phone_no',
            'mobile_no',
            'country',
            'religion',
            'type',
            'paytype',
            'bed_no',
            'room_no',
            'floor_no',
            'room_type',
            'consultant_dr',
            'dr_unit',
            'speciality',
            'co_consultant',
            'diagnosis',
            'remarks:ntext',
            // 'is_active',
            // 'created_date',
            // 'updated_date',
            // 'user_id',
            // 'userrole',
            // 'ipaddress',
        ],
    ]) ?>

</div>
