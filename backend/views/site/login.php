<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'SUNITHA PRINTERS - LOGIN';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class="card-box">
				<div class="panel-heading">
					<h3 class="text-center"><strong class="text-custom"><img src="<?= Url::to('@web/ubold/images/sunitha-logo.png') ?>"  /></strong></h3>
				</div>

				<div class="panel-body">
					 <?php $form = ActiveForm::begin(['id' => 'login-form','class'=>'form-horizontal m-t-20','options'=> ['autocomplete'=>'off']]); ?>
						<div class="form-group ">
							<div class="col-xs-12">
							    <?= $form->field($model, 'username',[
        'template' => '
            <div class="input-group">
           
               <span class="input-group-btn">
<div type="button" class="btn waves-effect waves-light btn-danger"><i class="fa fa-user"></i></div>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'User Name',
            'class'=>'form-control  ',
        ]])
    ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
							
							 <?= $form->field($model, 'password',[
        'template' => '
        
            <div class="input-group">
           
               <span class="input-group-btn">
<div type="button" class="btn waves-effect waves-light btn-danger"><i class="fa fa-lock"></i></div>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Password',
            'class'=>'form-control  ',
            'type'=>'password',
        ]])
    ?>
    	</div>
						</div>

						<div class="form-group ">
							<div class="col-xs-12">
							<?php	$model->rememberMe=0;?>
				<?= $form->field($model, 'rememberMe', [
    'template' => "<div class='checkbox checkbox-danger'>{input}<label>Remember Me</label></div>{error}",
])->checkbox([],false) ?>
							</div>
						</div>
						
						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								
									 <?= Html::submitButton('Login', ['class' => 'btn btn-danger btn-block text-uppercase waves-effect waves-light', 'name' => 'login-button']) ?>
								
							</div>
						</div>
						
						  <?php ActiveForm::end(); ?>
				</div>
			</div>
			

		</div>
			<script>
			var resizefunc = [];
		</script>
    