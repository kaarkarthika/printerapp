<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<div class="row">
<div class="taxmaster-form ">

    <?php $form = ActiveForm::begin(['id'=>'taxmaster-form','options'=> ['autocomplete'=>'off']]); ?>


<div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">  


    <?= $form->field($model, 'taxid')->hiddenInput(['maxlength' => true,'id'=>'taxid'])->label(false); ?>
  
   <div class="clearfix"></div>
 <div class="col-md-6">
    <?= $form->field($model, 'taxgroup')->textInput(['placeholder' =>'Tax Group','class'=>"form-control  "])->label("Tax Group Name"); ?>
</div>
 <div class="col-md-6">
    <?= $form->field($model, 'taxvalue')->textInput(['placeholder' =>'Tax Value','class'=>"form-control  "])->label('Tax Value') ?>
</div>

     <div class="col-md-6">
   <?php $a= ['2016' => '2016-17', '2017' => '2017-18','2018'=>'2018-19'];
    echo $form->field($model, 'financialyear')->dropDownList($a,['prompt'=>'Select Financial Year'])->label('Financial Year');?>
         
</div>
  
  
   <div class="col-md-4">
    <?= $form->field($model, 'additionaltax')->textInput(['placeholder' =>'Additional Tax','class'=>"form-control "])->label('Additional Tax') ?>
</div>
<div class="col-md-2">
           <?php if($model->isNewRecord){$model->is_active = 1;} ?>
<?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>

  

    <div class="form-group col-md-12">
    <hr>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right tax' : 'btn btn-primary pull-right updatetax']) ?>
        <?//= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-warning pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader1.gif') ?>" /></span>
     <span id="loadtex" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>

</div>




</div>
</div>

    <?php ActiveForm::end(); ?>

</div>
</div>
 
        
       

<script>

     jQuery(document).ready(function() {
    $('#taxmaster-form').on('beforeSubmit', function(e) {
    $("#load").show();
   e.preventDefault();
    var form = $(this);
    var formData = form.serialize();
    
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
      
        if(data=="okay")
        {

             var url='<?php echo Yii::$app->homeUrl ?>?r=taxmaster/reindex';
              window.open(url,'_self');
             
        /*$("#loadtex").text("Successfully Saved.");
        $("#loadtex").css('color','green ');
        $("#loadtex").show(4);
        $.pjax.reload({container:"#taxmaster-grid"});*/
                          
        }
        
        
        
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
  });  
</script>
