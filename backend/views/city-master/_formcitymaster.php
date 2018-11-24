<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\CityMaster */
/* @var $form yii\widgets\ActiveForm */

?>
<style type="text/css">
    select.selectpicker{
        display: block!important;
    }
</style>
<div class="row physicianmaster-form">

    <?php $form = ActiveForm::begin(['id'=>'physician-form']); ?>
    <?php $speciallist = array('Rangareddy'=>'Rangareddy',' EastGodavari'=>'East Godavari','Guntur'=>'Guntur','Krishna'=>'Krishna','Visakhapatnam'=>'Visakhapatnam','Chittoor'=>'Chittoor','Anantapur'=>'Anantapur','Kurnool'=>'Kurnool','Mahbubnagar'=>'Mahbubnagar','Hyderabad'=>'Hyderabad','WestGodavari'=>'West Godavari','Karimnagar'=>'Karimnagar','Warangal'=>'Warangal','Nalgonda'=>'Nalgonda','Prakasam'=>'Prakasam','Medak'=>'Medak','SriPottiSriramuluNellore'=>'Sri Potti Sriramulu Nellore','YSR'=>'YSR','Khammam'=>'Khammam','Adilabad'=>'Adilabad','Srikakulam'=>'Srikakulam','Nizamabad'=>'Nizamabad','Vizianagaram'=>'Vizianagaram'); ?>
 
     <div class="col-md-6">
       <?php
        echo $form->field($model, 'state')->textInput(['data-live-search'=>'true','data-style'=>'btn-default btn-custom','class'=>'form-control selectpicker']);
          ?>
    </div>
    <div class="col-md-6">
       <?php
        echo $form->field($model, 'district')->textInput(['prompt'=>'--Select District--','data-live-search'=>'true','data-style'=>'btn-default btn-custom','class'=>'form-control selectpicker']);
          ?>
    </div>
    <div class='clearfix'></div>
    <div class="col-md-6">
       <?php
        echo $form->field($model, 'city',['enableAjaxValidation' => true])->textInput(['maxlength' => true]);
          ?>
    </div>
     <div class="col-md-6">
        <?php 
        if($model->isNewRecord){$model->is_active = 1;  }?> 
        
     
 <?= $form->field($model, 'is_active', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
    </div>

<div class="clearfix"></div>
<hr>
<div class="form-group col-md-12">
         
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right physician' : 'btn btn-primary pull-right updatephysician']) ?>
        <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger pull-right closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true",'style'=>'margin-right: 2%;']) ?>
    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     <span id="loadtexts" style="display: none; "></span>
    </div>
  <div class="clearfix"></div>


    <?php ActiveForm::end(); ?>

</div>
  <!-- <script>
    $('#physician-form').on('beforeSubmit', function(e) {
    $("#loadphysician").show();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        
        $("#loadphysician").hide(4);
        alert(); 
        if(data=="S")
        {
        alert('Successfully Saved.');
        $("#loadtexts").text("Successfully Saved.");
        $("#loadtexts").css('color','green ');
        $("#loadtexts").show(10);
        $.pjax.reload({container:"#physician-grid"});
         setTimeout(function() {
        $('.addphysician').trigger('click');
        }, 500);
        }
         else if(data=="U")
        {
            alert('Successfully Updated.');
        $("#loadtexts").text("Successfully Updated.");
        $("#loadtexts").css('color','green ');
        $("#loadtexts").show(4);
        $.pjax.reload({container:"#physician-grid"});
        }
        else if(data=="E")
        {
        alert('Data Already Exists.');
        $("#loadtexts").text("Data Already Exists.");
        $("#loadtexts").css('color','red ');
        $("#loadtexts").show();
        }
        else
        { alert('Data Not Saved.');
        $("#loadtexts").text("Data Not Saved.");
        $("#loadtexts").css('color','red ');
        $("#loadtexts").show();
                        
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
<script>
 
 
      $('body').on('change','#citymaster-city', function() {
        var testname=$("#citymaster-city").val();
        
            $.ajax({
            type: "POST",
            url: "<?php echo Yii::$app->homeUrl . "?r=city-master/uniquecheck&testname=";?>"+testname,
            success: function (result) 
            {
              if(result=="1"){
                alert(testname+" Already Exists."); $("#citymaster-city").val('');
                /*$("#loadtext").text(testname+" Already Exists.");
                $("#loadtext").css('color','red');
                $("#loadtext").show(4);
                $(".savecategory").css("pointer-events","none");
                $(".updatecategory").css("pointer-events","none");*/
                
              } else{
               /* $("#loadtext").hide(4);
                $(".savecategory").css("pointer-events","auto");
                $(".updatecategory").css("pointer-events","auto");*/
              }
            }
        });
     });
     
</script> -->