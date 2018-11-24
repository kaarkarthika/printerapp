<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
require ('../../vendor/tcpdf/tcpdf_barcodes_1d.php');

/* @var $this yii\web\View */
/* @var $model backend\models\Stockmaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stockmaster-form">

    <?php $form = ActiveForm::begin(['id'=>'stockmaster-form1']); ?>
   <!-- <div class="col-md-6">
    	 <?= $form->field($model, 'vendorid')->dropdownlist($vendorlist,['prompt'=>'Select','id'=>'vendorid', 'disabled'=>'disabled','onchange'=>'
                                                    $.get( "'.Url::toRoute('getproduct').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                           $("#product_idz1").html(data);                       
                                                        }
                                                    );']) ;
                                                     echo   $form->field($model, 'stockid')->hiddenInput()->label(false);
                                                    ?>
                                                   
    </div>
    <div class=" col-md-6">
    <?= $form->field($model, 'productid')->Dropdownlist($productlist,['prompt'=>'Select','size'=>'1','class'=>' form-control','id'=>'product_idz1','disabled'=>'disabled']) ?>
 </div>-->

 <div class="clearfix"></div>
<div class=" col-md-4">
    <?= $form->field($model, 'quantity')->textInput(['onkeypress'=>'return isNumber(event)']) ?>
   </div>
   <div class=" col-md-4">
    <?= $form->field($model, 'price')->textInput(['onkeypress'=>'return isNumber(event)']) ?>
   </div>
   
  
<div class=" col-md-4">
 
<?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>

</div>
<div class="clearfix"></div>

<div class="clearfix" style="margin-top:40px;"></div>
    <div class="form-group col-md-12">
     <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?>
     <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i> Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success productgrouping' : 'btn btn-primary productgrouping','style'=>'margin-left: 0%;']) ?>
     <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtex" style="display: none; "></span>
    </div>
<div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
<script>
	$('#stockmaster-form1').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".add_stock_master").attr('disabled','disabled');
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
	    if(data=="Y")
	    {	
		$("#loadtex").text("Successfully Updated.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	     $(".add_stock_master").removeAttr('disabled');
	    $.pjax.reload({container:"#w0-pjax	"});
		}
		else if(data=="E")
		{
		$("#loadtex").text("Data Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	     $(".add_stock_master").removeAttr('disabled');
		}
		else
		{
		$("#loadtex").text("Data Not Saved.");
		$("#loadtex").css('color','red ');
		$("#loadtex").show();
		$(".add_stock_master").removeAttr('disabled');
		} 
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>