<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */

?>

<style>

span.btn.waves-effect.waves-light.btn-default {
    /* height: 38px !important; */
}

span.btn.waves-effect.waves-light.btn-default i.fa {
   /* line-height: 39px; */
}

	.media,
.media-body {
  overflow: visible;
}

.media:after,
.media-body:after{
 content:'';
 clear:both;
 display:block;
}

.select2-container--krajee .select2-selection--single .select2-selection__clear {
    right: 4rem;
}
.unit_val .form-group.field-unit,.unit_val .form-group.field-product-unit{
width: 90%;
    float: left;
}

.unit_val button.btn.btn-xs.btn-success {
    TOP: 26px;
    POSITION: RELATIVE;
    LEFT: 5px;
    PADDING: 5px 10px;
}
a.btn.waves-effect {
    background: #ef8c9d;
    color: #fff;
    float: right;
    position: relative;
    top: -20px;
}
</style><script>
function goBack() {
    window.history.back();
}
</script>
<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body" style="height:600px;">
    <?php $form = ActiveForm::begin(['id'=>'product-form' ,'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>
     <div class="col-md-4">
    
    <?= $form->field($model, 'productname',[
        'template' => '
         <label class="control-label">Product Name</label>
            <div class="input-group ">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-product-hunt"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Product Name',
            'class'=>'form-control tabind first',
          	'tabindex'=>1001,
        ]])
    ?>
  
    </div>
       <div class="col-md-4">
    <?php 
     
     echo $form->field($model, 'product_typeid')->dropDownList($items,['prompt'=>'--Select Product Type--','data-live-search'=>'true','class'=>'form-control selectpicker tabind','tabindex'=>1002 ,'data-style'=>'btn-default btn-custom', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getunit').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	
                                                           $("#unit").html(data);
														     $("#unit").selectpicker("refresh");                                                   
                                                        }
                                                    );']);?>
    </div>
          <div class="col-md-4">
  	
  	
  	<?php 
    	
		 
    	/* echo $form->field($model, 'hsn_code')->dropDownList($tax_hsn_code,['prompt'=>'--Select HSN Code--','class'=>'form-control  tabind','tabindex'=>1003 ,'data-style'=>'btn-default btn-custom', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getgst').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	  $("#product-gst").val(data);                                                
                                                        }
                                                    );']);
		 */
		 
		// echo $form->field($model, 'hsn_code')->dropDownList($tax_hsn_code,['prompt'=>'--Select HSN Code--','class'=>'form-control  tabind','tabindex'=>1003 ,'data-style'=>'btn-default btn-custom']);
		   
		 echo $form->field($model, 'hsn_code')->dropDownList($tax_hsn_code,['prompt'=>'--Select HSN Code--','class'=>'form-control  tabind','tabindex'=>1003 ,'data-style'=>'btn-default btn-custom']);
		  ?> 
  
    
    
    </div>


   
    
 
   <div class="clearfix"></div>
    
    
   
    
    <div class="col-md-4">
    <?= $form->field($model, 'composition_id')->dropDownList($composition,['prompt'=>'--Select Composition--','data-style'=>'btn-default btn-custom','class'=>'form-control  tabind','tabindex'=>1004 ]);?>
   
    
   	<button type="button" class='btn btn-xs btn-success addcomposition'><i class="fa fa-plus"></i></button>
   
    </div>
    
    
    
    <div class="col-md-4 unit_val">
    	 <?php if($model->isNewRecord){
    	
   echo $form->field($model, 'unit')->dropDownList([],['prompt'=>'--Select Unit--','data-live-search'=>'true','data-style'=>'btn-default btn-custom','class'=>'form-control selectpicker tabind ' ,'id'=>'unit','tabindex'=>1005]);
		 }
else {
	 
	 echo $form->field($model, 'unit')->dropDownList($unit,['prompt'=>'--Select Unit--','data-live-search'=>'true','data-style'=>'btn-default btn-custom','class'=>'form-control selectpicker tabind ','tabindex'=>1006]);
} ?>
	
	<button type="button" class='btn btn-xs btn-success addvendor'><i class="fa fa-plus"></i></button>
    </div>
     
     
  
     
     <div class="col-md-4">
   	<?php echo $form->field($model, 'manufacturer_id')->Dropdownlist($manufacturerlist,
['prompt'=>'--Select Manufacturer--','class'=>'form-control tabind','tabindex'=>1007,'data-style'=>'btn-default btn-custom'])->label('Manufacturer') ?>
   <button type="button" class='btn btn-xs btn-success addmanufacturer'><i class="fa fa-plus"></i></button>
   </div>
   <div class="clearfix"></div>
      <div class="col-md-4">
      
  
     <?= $form->field($model, 'minstock',[
        'template' => '
         <label class="control-label">Minimum Stock</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-arrow-down"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Minimum Stock',
            'class'=>'form-control tabind',
            'onkeypress'=>'return isNumber(event)',
          	'tabindex'=>1008,
        ]])
    ?>
    
    
    </div>
      <div class="col-md-4">
  <?= $form->field($model, 'maxstock',[
        'template' => '
         <label class="control-label">Maximum Stock</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-arrow-up"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Maximum Stock',
            'class'=>'form-control tabind',
            'onkeypress'=>'return isNumber(event)',
          	'tabindex'=>1009,
        ]])
    ?>
    </div>
      
    

     
    
    <div class="col-md-4">
   <?= $form->field($model, 'reorderlevelstock',[
        'template' => '
         <label class="control-label">Reorder Level Stock</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-reorder"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Reorder Level Stock',
            'class'=>'form-control tabind',
            'onkeypress'=>'return isNumber(event)',
          'tabindex'=>1010,
        ]])
    ?>
    </div>
    <div class="clearfix"></div>
     <div class="col-md-4 hide">
     <?= $form->field($model, 'pack_size',[
        'template' => '
         <label class="control-label">Pack Size</label>
            <div class="input-group ">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-product-hunt"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Product Name',
            'class'=>'form-control tabind first',
          	//'tabindex'=>1011,
        ]])
    ?>
       </div>
   
  
  <div class="col-md-4">
    <?= $form->field($model, 'sort_description')->textArea(['class'=>'form-control tabind',  'tabindex'=>1011,'maxlength' => true,'placeholder'=>'Description']) ?>
    </div>
        <div class="col-md-2" >
    	<label>Product Code:</label>
    	<?php if($model->isNewRecord){
           	$code= "SC".($product_max+100);
			
			
			echo '<button class="btn btn-primary waves-effect waves-light btn-lg">'.$code.'</button>';
		echo $form->field($model, 'product_code')->hiddenInput(['value' =>"SC".($product_max+100)])->label(false);
		}else{
			$code= $model->product_code	;
			//echo '<h4><span class="label label-default">'.$code.'</span></h4>';
			echo '<button class="btn btn-primary waves-effect waves-light btn-lg">'.$code.'</button>';
		
		echo $form->field($model, 'product_code')->hiddenInput(['value' =>$model->product_code])->label(false);
		}
    	?>
    </div>
        <div class="col-md-1">
    <?php if($model->isNewRecord){$model->is_active = 1;} ?>
   <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:40px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>
	 <div class="clearfix" ></div>
	 
  <div class="form-group col-md-12" style="margin-top:30px;">
  <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success products pull-right tabind' : 'btn btn-primary pull-right updateproduct tabind fetch_data','tabindex'=>1012]) ?>
  <button type='reset' class='btn btn-primary' id='reset'>Reset</button>
 </div>
  
     
     <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
     <div class="clearfix"></div>
</div>
</div>
</div>
</div>

<script type="text/javascript" src="js/shortcut.js" ></script>

<script>

 shortcut.add("Alt+U",
   function (){
    	 
			$( ".fetch_data" ).trigger( "click" );
    },
   { 'type':'keydown', 'propagate':true, 'target':document}
   );





	$('.first').focus();	
$('#product-form').on('keydown', '.tabind', function (event) {
   	
    if (event.which == 13) {
    	
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index + 1).toString() + '"]').focus();
    }
   /* else if(event.which == 8)
    {
    	event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index - 1).toString() + '"]').focus();
    }*/
});
</script>
<script>
    $(document).ready(function(){
    	
    		
    		 $('body').on("click",".reset",function(){
    		 	$('#product-composition_id').val('');
    		 	$('#product-product_typeid').val('');
    		 	$('#product-hsn_code').val('');
    		 	$('#unit').val('');
    		 	$('#product-manufacturer_id').val('');
    		 	
    		 	
    		 });
		
         	 $('body').on("click",".addvendor",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=unit/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Unit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
             
             
             $('body').on("click",".addcomposition",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=product/createproduct';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Composition</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
             
             $('body').on("click",".addmanufacturer",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=product/createmanufacturer';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Manufacturer</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
  
            
 });
 $("#product-composition_id").select2({ placeholder: "Select Composition"});
 $("#product-manufacturer_id").select2({ placeholder: "Select Manufacturer"});
 $("#product-hsn_code").select2({ placeholder: "Select HSN"});
 
</script>

   <!--div class="col-md-4">
      
  
     <?= $form->field($model, 'gst',[
        'template' => '
         <label class="control-label">GST</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-percent"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'GST',
            'class'=>'form-control tabind',
           'tabindex'=>1004,
           'readOnly'=>true,
        ]])
    ?>
    
    
    </div-->
  