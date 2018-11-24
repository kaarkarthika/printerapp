<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


?>
<div class="container">
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


<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
<div class="company-branch-form">

    <?php $form = ActiveForm::begin(['id' => 'branchform', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>
    
    <?= $form->field($model, 'branch_id')->hiddenInput(['maxlength' => true,'id'=>'branchid'])->label(false); ?>
    
    <div class="col-md-4">
   
  
    <?= $form->field($model, 'company_id')->dropDownList($companylist,['prompt'=>'--Select Company--','class'=>'selectpicker tabind','tabindex'=>1001,'data-live-search'=>'true','data-style'=>"btn-default btn-custom",'id'=>'companyname', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getstate').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                           $("#state").html(data);
														   $("#gstnumber").val("");  
														      $("#state").selectpicker("refresh");          
														                                                         
                                                        }
                                                    );'])->label('Company Name') ?>
    </div>
     <div class=" col-md-4">
      <?= $form->field($model, 'branch_name',[
        'template' => '
         <label class="control-label">Branch Name</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-sitemap"></i></span>
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
  
     <?= $form->field($model, 'branch_code',[
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
	 <?php	if($model->isNewRecord){
     echo $form->field($model, 'state')->dropDownList([],['title' =>"--Select State--",'id'=>'state','class'=>'selectpicker tabind','tabindex' => 1004,'data-live-search'=>'true','data-style'=>"btn-default btn-custom", 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getgst').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                           $("#gstnumber").val(data); 
														   $("#gstin").text(data);                                                           
                                                        }
                                                    );'])->label('State');
													
													
	 }
else {
	
	
	 echo $form->field($model, 'state')->dropDownList($statelist,['title' =>"--Select State--",'class'=>'tabind','tabindex' => 1004,'id'=>'state', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getgst').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                           $("#gstnumber").val(data); 
														   $("#gstin").text(data);                                                           
                                                        }
                                                    );'])->label('State');
}
													
													
													
													
													 ?>
     </div>
       <div class=" col-md-4">
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
            'tabindex'=>1005,
        ]])
    ?>
    </div>
     <div class="col-md-4"> 
  
     <?= $form->field($model, 'pincode',[
        'template' => '
         <label class="control-label">Pincode</label>
            <div class="input-group">
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-map-marker"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Branch Name',
            'class'=>'form-control tabind',
             'tabindex'=>1005,
            'maxlength' => 6,'placeholder'=>'Pincode','id'=>'pincode','onkeypress'=>'return isNumber(event)',
        ]])->label(false);
    ?>
     
     </div>
     <div class="clearfix"></div>
     
	 <div class=" col-md-4">
     <?= $form->field($model, 'address1')->textarea(['rows' => 1,'placeholder'=>'Address1','id'=>'address1'])->label('Address1') ?>
     </div>
     <div class=" col-md-4"> 
    <?= $form->field($model, 'address2')->textarea(['rows' => 1,'placeholder'=>'Address2','id'=>'address2',])->label('Address2') ?>
    </div>
     <div class=" col-md-4">
     <?= $form->field($model, 'address3')->textarea(['rows' => 1,'placeholder'=>'Address3','id'=>'address3',])->label('Address3') ?>
     </div>
    <div class="clearfix"></div>
 

 <div class="col-md-2">
 	<?php 
     	if($model->isNewRecord){
     	$model->is_active = 1;
     	}?> 
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom '  style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
 </div>
  <div class="col-md-2">
 	
 <?= $form->field($model, 'is_head_office', [
    'template' => "<div class='checkbox checkbox-custom '  style='margin-top:30px;'>{input}<label>Head Office</label></div>{error}",
])->checkbox([],false) ?>
 </div>
     	 <div class="col-md-3">
     	 

<?php if($model->isNewRecord){
  echo  $form->field($model, 'gst_number')->textInput(['maxlength' => true,'id'=>'gstnumber','readOnly'=>'true'])->label('GSTIN'); 
  }
  else{
  
  	 echo  $form->field($model, 'gst_number')->textInput(['maxlength' => true,'id'=>'gstnumber','value'=>$tax,'readOnly'=>'true'])->label('GSTIN'); 
  }?>


	 	
	 	  </div>
	 	   
   <div class="col-md-3">
     	 

<?php 
  echo  $form->field($model, 'email_id')->textInput(['maxlength' => true,'id'=>'email_id']); 
  
  	
  ?>


	 	
	 	  </div>
    
    
    <div class="clearfix"></div>
 
    

     <div class="form-group col-md-12">
    	 
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-default waves-effect waves-light tabind' : 'btn btn-primary branch waves-effect waves-light tabind','style'=>'margin-left: 0%;','tabindex' => 1013]) ?>
     
    </div>
 <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div></div>

</div>

<?php 
if(!$model->isNewRecord){?>
<script>
    $(document).ready(function(){
    	
    	
    	
    	
    	
    	
    	var companyname=$("#companyname").val();
    	
    	$.ajax({
				url:'<?php echo Yii::$app->homeUrl ?>?r=company-branch/getstate&id='+companyname,
				type: 'post',
                
				success: function (result)
				 {
				  $("#state").html(result);	
				  $("#state").val('<?php echo $model->state;?>');	
				 },});
    	
    });
     	
    </script>
  
<?php } ?>
<script>
	
$('#branchform').on('keydown', '.tabind', function (event) {
   	
    if (event.which == 13) {
    	
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index + 1).toString() + '"]').focus();
    }
    else if(event.which == 8)
    {
    	event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index - 1).toString() + '"]').focus();
    }
});
</script>