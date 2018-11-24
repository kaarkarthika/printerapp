<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Update {modelClass} ', [
    'modelClass' => 'Purchase Order Return',
]) ;

?>
<div class="container">

  

    <?= $this->render('_returnform', [
        'model' => $model,
        'model1' => $model1,
        'model2' => $model2,
        'model3' => $model3,
        'stock' => $stock,
        'requestcode'=>$requestcode,
        'unitlist'=>$unitlist,
    ]) ?>

</div>
