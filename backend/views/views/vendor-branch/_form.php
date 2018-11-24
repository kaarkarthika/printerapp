<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\ActiveField;

?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">

			</div>
			<div class="panel-body">

				<?php $form = ActiveForm::begin(['id' => 'vendor-branch-form']); ?>
				<div class="col-md-4">
					<?= $form->field($model, 'vendorid')->dropDownList($vendorlist,['prompt'=>'--Select Vendor--',
					'class'=>'selectpicker tabind first',
					'tabindex' => 1001,
					'data-live-search'=>'true',
					'data-style'=>"btn-default btn-custom",
					'id'=>'vendorid',
					'autofocus'=>'autofocus',
					'onchange'=>'$.get( "'.Url::toRoute('getstate').'", { id: $(this).val() } )
					.done(function( data ) {
					$("#state").html(data);
					$("#gstnumber").val("");
					$("#state").selectpicker("refresh");

					}
					);'])->label('Vendor') ?>

				</div>
				<div class="col-md-4">

					<?= $form->field($model, 'branchname',[
'template' => '
<label class="control-label">Branch Name</label>
<div class="input-group">
<span class="input-group-btn">
<span  class="btn waves-effect waves-light btn-default"><i class="fa fa-sitemap"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'Branch Name',
'class'=>'form-control tabind',
'tabindex' => 1002,
]])
					?>
				</div>

				<div class="col-md-4">
					<?= $form->field($model, 'branchcode',['enableAjaxValidation' => true],[
'template' => '
<label class="control-label">Branch Code</label>
<div class="input-group">
<span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-qrcode"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'Branch Code',
'class'=>'form-control tabind',
'tabindex' => 1003,
]])
?>
				</div>

				<div class="clearfix"></div>
				<div class="col-md-4">
					<?= $form->field($model, 'branch_emailid',[
'template' => '
<label class="control-label">Branch Email Address</label>
<div class="input-group">
<span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-envelope"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'Branch Email Address',
'class'=>'form-control tabind',
'tabindex' => 1004,
]])
?>
				</div>

				<div class="col-md-4">

					<?= $form->field($model, 'branch_phonenumber',['enableAjaxValidation' => true])->textInput(['class'=>'form-control tabind','tabindex' => 1005,'placeholder' =>'Phone  Number','maxlength'=>10,'onkeypress'=>'return isNumber(event)',]) ?>
			
				</div>
				<div class="col-md-4">
					<?php
					if ($model -> isNewRecord) {
						echo $form -> field($model, 'state') -> dropDownList([], ['title' => "--Select State--", 'id' => 'state', 'class' => 'selectpicker tabind','tabindex' => 1006, 'data-live-search' => 'true', 'data-style' => "btn-default btn-custom", 'onchange' => '
$.get( "' . Url::toRoute('getgst') . '", { id: $(this).val(),vendorid:$("#vendorid").val() } )
.done(function( data ) {
$("#gstnumber").val(data);
$("#gstin").text(data);
}
);']) -> label('State');

					} else {

						echo $form -> field($model, 'state') -> dropDownList($statelist, ['class'=>'form-control tabind','tabindex' => 1006,'title' => "--Select State--", 'id' => 'state', 'onchange' => '
$.get( "' . Url::toRoute('getgst') . '", { id: $(this).val(),vendorid:$("#vendorid").val() } )
.done(function( data ) {
$("#gstnumber").val(data);
$("#gstin").text(data);
}
);']) -> label('State');
					}
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-4">
					<?= $form->field($model, 'city',[
'template' => '
<label class="control-label">City</label>
<div class="input-group">
<span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-road"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'City',
'class'=>'form-control tabind',
'tabindex' => 1007,
]])
?>
				</div>
				<div class="col-md-4">
					<?= $form->field($model, 'pincode',[
'template' => '
<label class="control-label">Pin Code</label>
<div class="input-group">

<span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-map-marker"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'Pin Code',
'class'=>'form-control tabind',
'tabindex' => 1008,
'onkeypress'=>'return isNumber(event)',
'maxlength'=>6,
]])
					?>
				</div>
				<div class="col-md-4">
					<?= $form->field($model, 'bankname',[
'template' => '
<label class="control-label">Bank Name</label>
<div class="input-group">

<span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-bank"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'Bank Name',
'class'=>'form-control tabind',
'tabindex' => 1009,
]])
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-4">
					<?= $form->field($model, 'ifsccode')->textInput(['class'=>'form-control tabind','tabindex' => 1010,'placeholder' =>'IFSC Code']) ?>
				</div>
				<div class="col-md-4">
					<?= $form->field($model, 'accnumber')->textInput(['class'=>'form-control tabind','tabindex' => 1011,'placeholder' =>'A/C Number','onkeypress'=>'return isNumber(event)',]) ?>
				</div>
				<div class="col-md-4">
					<?= $form -> field($model, 'address1') -> textarea(['class'=>'form-control tabind','tabindex' => 1012,'rows' => 1, 'id' => 'address1', 'placeholder' => 'Address1']); ?>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-4">

					<?= $form -> field($model, 'address2') -> textarea(['class'=>'form-control tabind','tabindex' => 1013,'rows' => 1, 'id' => 'address2', 'placeholder' => 'Address2']); ?>
				</div>

				<div class="col-md-4">

					<?= $form->field($model, 'gstnumber')->textInput(['class'=>'form-control tabind','tabindex' => 1014,'maxlength' => 15,'placeholder'=>'GST Number','readonly'=>'true','id'=>'gstnumber'])->label('GST Identification Number') ?>
				</div>
				<div class="col-md-4">

					<?= $form->field($model, 'creditperiod')->textInput(['class'=>'form-control tabind','tabindex' => 1015,'maxlength' => 3,'placeholder'=>'Credit Period '])->label('Credit Period') ?>
				</div>
				
				
				

				<div class="clearfix"></div>
				<div class="col-md-4">

					<?= $form->field($model, 'contact_person',[
'template' => '
<label class="control-label">Contact Person</label>
<div class="input-group">

<span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-user"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'Contact Person',
'class'=>'form-control tabind',
'tabindex' => 1016,
]])
?>
				</div>
				<div class="col-md-4">

					<?= $form->field($model, 'person_mobilenumber',[
'template' => '
<label class="control-label">Contact Person Phonenumber</label>
<div class="input-group">

<span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-phone"></i></span>
</span> {input}
</div>
{error}',
'inputOptions' => [
'placeholder' => 'Contact Person Phonenumber',
'class'=>'form-control tabind',
'tabindex' => 1017,
'onkeypress'=>'return isNumber(event)',
'maxlength'=>10,
]])
?>
				</div>

				<div class="col-md-1">
					<?php
					if ($model -> isNewRecord) {
						$model -> is_active = 1;
					}
					?>

					<?= $form->field($model, 'is_active', [
'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false)
					?>
				</div>
				<div class="col-md-2">
					<?= $form->field($model, 'is_headoffice', [
'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Head Office</label></div>{error}",
])->checkbox([],false)
					?>
				</div>
				<div class="clearfix"></div>
				
				<div class="col-md-4">
					
					<?php if($model -> isNewRecord)
					{
					echo $form->field($model, 'igstpercent')->textInput(['class'=>'form-control tabind','tabindex' => 1018,'maxlength' => 3,'placeholder'=>'Igst perent','value'=>0])->label('Igst Percent');	
					}
                else
					{
						echo $form->field($model, 'igstpercent')->textInput(['class'=>'form-control tabind','tabindex' => 1018,'maxlength' => 3,'placeholder'=>'Igst perent'])->label('Igst Percent');	
					}
					
					
					
					
					
					 ?>
				</div>
				
				
				
				
				

				<div class="col-md-12">
					<?= Html::submitButton($model -> isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model -> isNewRecord ? 'btn btn-default btn-cutsom tabind' : 'btn btn-default tabind','tabindex' => 1019]) ?>
				</div>
				<div class="clearfix"></div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>

<script>
	//$('#vendorid').focus();
	$('#vendor-branch-form').on('keydown', '.tabind', function (event) {
   	//alert(event.which);
    if (event.which == 13) {
    	//alert("jn");
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index + 1).toString() + '"]').focus();
    }
    else if(event.which == 220)
    {
    	event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index - 1).toString() + '"]').focus();
    }
});
</script>