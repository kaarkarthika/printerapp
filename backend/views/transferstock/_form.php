<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<style>
	#load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}input.error{background:#fbe3e4;border:1px solid #fbc2c4;color:#8a1f11}
	.select2-container .select2-selection {
    height: 60px;
    overflow: scroll;
} 
</style>

<div class="container" >
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>

<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>
<div class="row" >
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">

    <?php $form = ActiveForm::begin(['id'=>'addtransferstockform', 'action' => ['addtransferstock'],
        'method' => 'post']); ?>

  
   <?php 
   $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$frombranchid=$session['branch_id'];
		if($role=="Super")
		{
			echo '<div class="col-md-4">';	
			echo $form->field($model, 'frombranch')->Dropdownlist($companylist,['prompt'=>'Requested Branch','id'=>'frombranchid','class'=>'form-control selectpicker','required'=>'true','data-style'=>"btn-default btn-custom",'data-live-search'=>'true',
			'onchange'=>' $.get( "'.Url::toRoute('gettobranch').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                           $("#tobranchid").html(data);
														     $("#tobranchid").selectpicker("refresh");  
															                                                  
                                                        }
                                                    );'])->label(false);
													echo '</div>';
		}
		else{
			echo $form->field($model, 'frombranch')->hiddenInput(['value'=>$frombranchid])->label(false);
		}
   ?>
  
  <div class="col-md-4">
   	<?php 
   	
   	if($role=="Super")
		{
   	echo $form->field($model, 'tobranch')->Dropdownlist([],['prompt'=>'Approved Branch','class'=>'form-control selectpicker','id'=>'tobranchid','required'=>'true','data-style'=>"btn-default btn-custom",'data-live-search'=>'true'])->label(false);
		}
	else{
			echo $form->field($model, 'tobranch')->Dropdownlist($companylist1,['prompt'=>'To Branch','class'=>'form-control selectpicker','id'=>'tobranchid','required'=>'true','data-style'=>"btn-default btn-custom",'data-live-search'=>'true'])->label(false);
	}
   	
   	?>
   	
   </div>
    
	<div class="col-md-4">
			
   <?= $form->field($model, 'productid')->dropdownlist($productlist,['id'=>'product_idz','title'=>'Select Product','class'=>'selectpicker','required'=>'true','data-style'=>"btn-default btn-custom",
   'data-live-search'=>'true',
   'multiple'=>true, 'data-selected-text-format'=>'count > 2'])->label(false); ?>
    </div>
  <div class="clearfix"></div>
    <div class="col-md-3 form-group pull-right" style="margin-top: 26px;">
        <?= Html::Button('Transfer Stock', ['class' => 'btn btn-primary waves-effect pull-right waves-light addtransferstock',]) ?>
    
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div id="formdetails" >
</div>  
</div>   
</div>  
</div> 
</div> 
<script>
$(document).ready(function(){
 $('body').on("click",'.addtransferstock',function(){
 	$form_container=$("#addtransferstockform");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
  if(chkform==true){
 $("#load").fadeIn("slow");
 var form = $("#addtransferstockform");
 var formData = form.serialize();
 $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        	
        	$("#load").fadeOut("slow");
        	$("#formdetails").html(data);
        	$("#formdetails").fadeIn("slow");
        	
        }
     });
    }
	});
	});
</script>