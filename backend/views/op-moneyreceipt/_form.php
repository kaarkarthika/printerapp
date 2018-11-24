<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OpMoneyreceipt */
/* @var $form yii\widgets\ActiveForm */


?>
<style>
.op-moneyreceipt-form label.control-label {
   /* width: 38%;
    text-align: right;
    float: left;
    margin-right: 15px; */
}

.op-moneyreceipt-form input {
   /* width: 50%;
    text-align: left;*/
}

</style>

<div class="container" style="margin-top: 35px;">
    <?php $form = ActiveForm::begin(); ?>
	<div class="row">
	  <div class="col-sm-6"> 
	   <div class="row">  
		<div class="col-sm-4">
	        <?= $form->field($model, 'mr_type')->dropdownlist(['R'=>'Requistions','P'=>'Procedures','O'=>'OPD','S'=>'Sub-Visit'],['disabled' => true,'class'=>'form-control','prompt'=>'--SELECT--'])->label('Type') ?>			
			<?= $form->field($model, 'amount')->textInput(['readonly'=>true])->label('Net Amount') ?>
    		<?= $form->field($model, 'tds')->textInput(['readonly' => true]) ?>
    		<?= $form->field($model, 'service_tax_amount')->textInput(['readonly' => true]) ?>
	    </div>
	    <div class="col-sm-4">
	        <?= $form->field($model, 'request_date')->textInput(['class'=>'form-control','value'=>date('d-m-Y'),'readonly'=>true])->label('Req Date') ?>
    		<?= $form->field($model, 'post_discount')->textInput(['readonly' => true]) ?>
    		<?= $form->field($model, 'dis_allowed_amt')->textInput(['readonly' => true]) ?>
    		<?= $form->field($model, 'recovery_amt')->textInput(['readonly' => true]) ?>
	    </div>
	    <div class="col-sm-4">
	        <?= $form->field($model, 'paid_by')->textInput(['maxlength' => true,'readonly'=>true])->label('Bill Number') ?>  <!--Paid By Means Bill Number-->
    		<?= $form->field($model, 'patient_name')->textInput(['maxlength' => true,'readonly'=>true])->label('Patient Name') ?>
    		<?= $form->field($model, 'total_amt')->textInput(['onkeyup'=>'TotalAmtCal(this,event);','required'=>true]) ?>
			<?= $form->field($model, 'total_amt')->hiddenInput(['id'=>'total_amount','name'=>'Default_Total_Amount'])->label(false) ?>
    		<?= $form->field($model, 'org_disc_amt')->hiddenInput(['id'=>'total_due_amount','name'=>'Default_Due_Amount'])->label(false) ?>
    		<?= $form->field($model, 'org_disc_amt')->textInput(['readonly'=>true])->label('Due Amount') ?>
	    </div>
	   </div>
	  </div>
	  <div class="col-sm-4 br-rt">
	    <div class="col-sm-12">
	        <?= $form->field($model, 'amount_words')->textInput(['maxlength' => true]) ?>
        </div>
		<div class="col-sm-6">
		    <?= $form->field($model, 'payment_by')->dropdownlist($paymenttype,['maxlength' => true]) ?>
		</div>
		<div class="col-sm-6">
		    <?= $form->field($model, 'towards')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-6">
		    <?= $form->field($model, 'auth_by')->dropdownlist($authority,['required' => true,'prompt'=>'--SELECT--']) ?>
		</div>
		<div class="col-sm-6">
		    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-12">
		     <?= $form->field($model, 'remarks')->textArea(['maxlength' => true,'required'=>true]) ?>	
		</div>
		 
	  </div>
	  <div class="col-sm-2">
	      <br><br><br><br><br><br>
	      <div class="form-group">            
             <?= Html::submitButton('Save', ['class' => 'btn btn-success  b-width']) ?>
          </div>
		  <div class="fom-group">		     
			 <a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=op-moneyreceipt/index" class="btn text-center b-width btn-primary btn-bk" Title="Back To Grid">Back to Grid </a>
		  </div>
	  </div>
	</div>
</div>






<div class="op-moneyreceipt-form">	    
	<div class="row">
		<div class="col-md-4">	
		</div>	
		<div class="col-md-4">			
		</div>
		<div class="col-md-4">	
		</div>
	</div>	

    <div class="row">
        <div class="col-md-6">		  
        </div>
        <div class="col-md-6">   	
        </div>	  	
	</div>
    <!-- <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'created_at')->textInput() ?>
    <?= $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>-->
   <!-- <div class="form-group">
        <?php //= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
        <a href="<?php // echo Yii::$app->request->BaseUrl;?>/index.php?r=op-moneyreceipt/index" class="btn text-right  btn-primary btn-bk" Title="Back To Grid"><i class="fa fa-arrow-left"></i>  Back to Grid </a>
    </div> -->
</div>
    
	<?php ActiveForm::end(); ?>




<script>
	
function TotalAmtCal(data,event)
{
	var due_amt=parseFloat($('#total_due_amount').val());
	var total_amount=parseFloat($('#total_amount').val());
	var default_amount=parseFloat($('#opmoneyreceipt-amount').val());
	
	var data_val=data.value;
	if(data_val === '')
	{
		$('#opmoneyreceipt-total_amt').val(total_amount);
		$('#opmoneyreceipt-org_disc_amt').val(due_amt);
	}
	else
	{
		if(default_amount < data_val)
		{
			$('#opmoneyreceipt-total_amt').val(total_amount);
			$('#opmoneyreceipt-org_disc_amt').val(due_amt);
			alert('Net Amount Not Greater Than Paid Amount');
		}
		else
		{
			var calc=parseFloat(default_amount - data_val);
			$('#opmoneyreceipt-org_disc_amt').val(calc);
			var amtinwords=convertNumberToWords(data_val);
			
			$('#opmoneyreceipt-amount_words').val(amtinwords);
		}
	}
	
	
}
	


function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
}
</script>