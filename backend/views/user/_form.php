<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
    
use yii\helpers\Url;
$session = Yii::$app->session;

?>

<div class="card">
<div class="body">

<div class="branch-management-form row">

                 <?php $form = ActiveForm::begin(['id' => 'branch-management-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false,]); ?>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<br/><br/>
<?php if($session['user_type'] == 'S') { ?>
   <div class="col-md-3">

  <?= $form->field($model, 'user_type')->dropDownList(['S'=>'Super Admin','A'=>'Admin'],['prompt'=>'Select User Type'])->label("User Type"); ?>   
  
  </div>
    <?php } ?>
   
   
    
       <div class="col-md-3">
    <?= $form->field($model, 'name',[
        'template' => '
          <label class="control-label">Name</label>
            <div class="input-group">
           
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-user"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Name',
            'class'=>'form-control  ',
        ]])
    ?>
   </div>

     <div class="col-md-3">
  <?= $form->field($model, 'username')->textInput()->label("User Name"); ?>   
  </div>

    <?php if($model->isNewRecord)
    { ?>
 <div class="col-md-3">
    <?= $form->field($model, 'password_hash',[
        'template' => '
          <label class="control-label">Password</label>
            <div class="input-group">
           
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-lock"></i></span>
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
    <?php } 
     else
    { ?>
 <div class="col-md-3">
    <?= $form->field($model, 'password_hash',[
        'template' => '
          <label class="control-label">Password</label>
            <div class="input-group">
           
               <span class="input-group-btn">
<span type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-lock"></i></span>
 </span> {input}
            </div>
            {error}',
        'inputOptions' => [
            'placeholder' => 'Password',
            'class'=>'form-control  ',
            'type'=>'password',
            'value'=>'',
        ]])
    ?>
    </div>
    <?php } ?>
    
    
        
    <div class="form-group ">

    <div class="col-md-12 ">
        <hr>
         
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i> Save' : '<i class="fa fa-fw fa-edit"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right add_branchadmin waves-effect' : 'btn btn-primary pull-right add_branchadmin  waves-effect']) ?>
             
            
             
   
         
        
        </div>
        
        
        
        <div class="clearfix"></div>
       <br/><br/><br/><br/>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>

</div>
</div>
</div>

<script>
    $('#branch-management-form').on('beforeSubmit', function(e) {
    $("#load").show();
    $(".add_branchadmin").attr('disabled','disabled');
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
            $("#loadtex").text("Successfully Saved.");
            $("#loadtex").css('color','green ');
          $("#loadtex").show(4);
          $.pjax.reload({container:"#branchadmin-grid"});
            }
            else if(data=="E")
            {
              $("#loadtex").text("Data Already Exists.");
              $("#loadtex").css('color','red ');
            $("#loadtex").show();
            }
            else
            {
            $("#loadtex").text("Data Not Saved.");
            $("#loadtex").css('color','red ');
            $("#loadtex").show();
                            
            }},
        error: function (data) {
            alert('Something Went Wrong');
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
    
</script>