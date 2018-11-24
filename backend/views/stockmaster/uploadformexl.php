<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
$this->title = 'Import Stock';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	
 	<div class="row">
							<div class="col-sm-12">
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
    <?php $form = ActiveForm::begin(['action'=>'index.php?r=stockmaster/excelupload', 'options' => ['enctype' => 'multipart/form-data' ]	]); ?>
      <?= $form->field($model, 'brandcode')->fileInput(['class'=>'filestyle col-sm-4','required'=>'true'])->label(False); ?>								
    				
        <div class="form-group pull-left">                           
			<?= Html::submitButton($model->isNewRecord ? ' <i class="fa fa-fw fa-upload"></i> Upload' : '<i class="fa fa-fw fa-upload"></i> Upload', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	   	</div>   
	   <!--	<div class="clearfix"></div>    -->
	   	<div  class="col-md-3">
			<?= Html::a('<i class="fa fa-fw fa-download"></i> Export', ['stockmaster/excelexport'],["class"=>'btn btn-primary']) ?>
		</div>
             
    <?php ActiveForm::end(); ?>
         	                 
                   </div>
                    </div>
                </div>
                
              </div>
</div>  


