<?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   use yii\helpers\ArrayHelper;
   use backend\models\Newpatient;
   use yii\helpers\Url;
   $this->title = 'UCIL Patient Update';
   /* @var $this yii\web\View */
   /* @var $model backend\models\Newpatient */
   /* @var $form yii\widgets\ActiveForm */
   
   use kartik\file\FileInput;
    
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
</div>




<div class="container">

  <div class="row">
   <?php $form = ActiveForm::begin(['options' => ['class'=>' ']]) ?>
    <div class="col-sm-5">
   <div class="c panel panel-border panel-custom">
      <div class="panel-heading">
         <!-- <h5 class="box-title"><strong>Room Details</strong></h5>  -->
      </div>
      <div class="panel-body">
         <div class="row">


            <div class="form-group">
            	 
               <label class="control-label">Patient Name</label> 
                
       	<?= $form->field($patient_name, 'patientname')->textInput(['class'=>'form-control tabind first'])->label(false) ?>			 
            </div>




            <div class="form-group">
              <label class="control-label">Mobile Number</label>
 	<?= $form->field($patient_name, 'pat_mobileno')->textInput(['class'=>'form-control tabind first'])->label(false) ?>
            </div>

             <div class="form-group">
              <label class="control-label">Relative Name</label>
   <?= $form->field($patient_name, 'par_relationname')->textInput(['class'=>'form-control tabind first'])->label(false) ?>				
            </div>

         
    
         </div>
      </div>
   </div>
</div>


<div class="col-sm-5">
   <div class="c panel panel-border panel-custom">
      <div class="panel-heading">
         <!-- <h5 class="box-title"><strong>Room Details</strong></h5>  -->
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="form-group">
               <label class="control-label">UCIL ID</label>
       <?= $form->field($sub_visit_name, 'ucil_emp_id')->textInput(['class'=>'form-control tabind first','required'=>true])->label(false) ?>			
            </div>

            <div class="form-group">
              <label class="control-label">Register Number</label>
 	 <?php if($sub_visit_name->patient_date != '1970-01-01'){ ?>		   
                  <?= $form->field($sub_visit_name, 'patient_date')->textInput(['value'=>date('d-m-Y',strtotime($sub_visit_name->patient_date)),'class'=>'form-control tabind first','readonly'=>true])->label(false) ?>	
                  <?php }else{ ?>	
                  <?= $form->field($sub_visit_name, 'patient_date')->textInput(['value'=>date('d-m-Y',strtotime($sub_visit_name->created_at)),'class'=>'form-control tabind first','readonly'=>true])->label(false) ?>
                  <?php } ?>	
            </div>


            <div class="col-sm-5">

              <div class="form-group">
               <label class="control-label">UCIL Update status</label><br>	

              <?php if($sub_visit_name->ucil_letter_status == 'YES'){?>
                  <label class="control-label" for="sub-visit-ucil_letter_status">YES</label>
                  <input type="radio" id="newpatient-ucilval_yes"  checked="checked" name="SubVisit[ucil_letter_status]" value="1">&nbsp;&nbsp;&nbsp;
                  <label class="control-label" for="sub-visit-ucil_letter_status">NO</label>
                  <input type="radio" id="newpatient-ucilval_no" name="SubVisit[ucil_letter_status]" value="0">
                  <?php }else if($sub_visit_name->ucil_letter_status == 'NO'){ ?>
                  <label class="control-label" for="sub-visit-ucil_letter_status">YES</label>
                  <input type="radio" id="newpatient-ucilval_yes"  name="SubVisit[ucil_letter_status]" value="1">&nbsp;&nbsp;&nbsp;
              <label class="control-label" for="sub-visit-ucil_letter_status">NO</label>
                  <input type="radio" id="newpatient-ucilval_no" checked="checked" name="SubVisit[ucil_letter_status]" value="0">
                  <?php } ?>
            </div></div>

<div class="col-sm-7">
             <div class="form-group">
              <label class="control-label">Issue Date</label>
   <?php if($sub_visit_name->ucil_date != '1970-01-01'){ ?>	   
                  <?= $form->field($sub_visit_name, 'ucil_date')->textInput(['value'=>date('d-m-Y',strtotime($sub_visit_name->ucil_date)),'class'=>' datepicker  form-control tabind first'])->label(false) ?>	
                  <?php }else{ ?>	
                  <?=  $form->field($sub_visit_name, 'ucil_date')->textInput(['value'=>'', 'class'=>'datepicker  form-control tabind first'])->label(false)?>
                  <?php } ?>					
            </div>
 </div>
         </div>
      </div>
   </div>
</div>

				 <div class="col-sm-2">
		     <div class="c panel panel-border panel-custom"  >
			    <div class="panel-heading" hidden>
			        <h5 class="box-title">   </h5> 
		        </div>  
	            <div class="panel-body"  >
				   <div class="row">
				     <div class="col-sm-12">
					   <div class="row">
					      <div class="btn form-group b-width"> 
    	                  <!--   <button type="button" class="btn btn-success b-width" id='saves_sucess' onclick="SaveIPForm();">Save</button> -->
    	                   <?= Html::submitButton('SAVE', ['class' => 'btn btn-primary b-width']) ?>
    	                    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     	                    <span id="loadtexts" style="display: none; "></span></div>

     	                     <div class="btn form-group b-width">
     	 <button type="reset" class="btn inp btn-default b-width" onclick="clearForm();">Clear</button> 
						  </div>
						  
    	                   
                        
						 </div><br>
   
		 
                         </div>
					 </div>
				   </div>
				  
		        </div>
		     </div>

<?php ActiveForm::end(); ?>
 </div>



 


            <?php //= Html::submitButton('SAVE', ['class' => 'btn btn-primary']) ?>
            
 </div>

<script>
   $(document).ready(function(){
     $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
   });
   
   
   if ($("#newpatient-ucilval_no").is(":checked")) 
   {
   	$('#subvisit-ucil_date').attr('disabled','disabled');
   }
   
   
   $("input[name='SubVisit[ucil_letter_status]']").click(function () 
   {
          if ($("#newpatient-ucilval_no").is(":checked")) 
          {
          	$('#subvisit-ucil_date').val('');
          	$('#subvisit-ucil_date').attr('disabled','disabled');
          }
          else if($("#newpatient-ucilval_yes").is(":checked"))
          {
          	<?php if($sub_visit_name->ucil_date != '1970-01-01') {?>
          	$('#subvisit-ucil_date').val('<?php echo date('d-m-Y',strtotime($sub_visit_name->ucil_date));?>');
          	$('#subvisit-ucil_date').removeAttr('disabled','disabled');
          	<?php }elseif ($sub_visit_name->ucil_date == '1970-01-01') {?>
          	$('#subvisit-ucil_date').val('');
          	$('#subvisit-ucil_date').removeAttr('disabled','disabled');
          	<?php }?>
          }
      });
   
   });
   
   
</script>