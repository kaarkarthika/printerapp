<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Update {modelClass} ', [
    'modelClass' => 'Transfer Stock',
]) ;

?>
<div class="container">

 

    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
        'model2' => $model2,
        'model3' => $model3,
       
        'requestcode'=>$requestcode,
        
    ]) ?>

</div>
