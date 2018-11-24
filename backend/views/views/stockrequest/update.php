<?php

use yii\helpers\Html;



$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Stockrequest',
]) ;
?>
<div class="stockrequest-update">


    <?= $this->render('_updateform', [
        'model' => $model,
                'list'=>$list,
                'unitlist'=>$unitlist,
                'companylist'=>$companylist,
    ]) ?>

</div>
