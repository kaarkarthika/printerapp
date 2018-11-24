<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\AuthorityMaster;
use backend\models\PaymentMethod;
use backend\models\PaymentType;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesMoneyreceipts */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="<?php echo Url::base(); ?>/css/billing.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>  
<link href="<?php echo Url::base(); ?>/alert/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/alert/jquery-confirm.min.js"></script>  
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />

<style>

#history_money thead,tbody.fetch_update_data{
	text-align:center;
}
#history_money thead {
    background: #dcebff;
}
#history_money tr td{
	border:1px solid #000;
}
/*button.save_billing {
    width: 70px !important;
}*/
.page-headr{
  font-size: 13px;
}
label.control-label {
    color: #444;
    font-weight: normal;
}
</style>
<div class="sales-moneyreceipts-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div id="load1" style='display:none;text-align: center;'><img  class="load-image" src="<?= Url::to('@web/loader1.gif') ?>" /></div>
    


<div class=" ">
      <div class=" ">
         <div class="c panel panel-border panel-custom">
          <div class=" ">
                <h5 class="box-title"><strong> </strong></h5> 
            </div>
              <div class=" "> 

<div class="row">

   <div class="col-sm-2">
      <?= $form->field($model, 'bill_number')->textInput(['maxlength' => true,'class'=>"form-control  ipnumber"])->label("Bill Number"); ?>
      <?= $form->field($model, 'mr_no')->textInput(['maxlength' => true,'readonly'=>true]) ?>
      <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>true])->label("Name"); ?>
      <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true,'readonly'=>true])->label("Mobile Number"); ?>
   </div>


   <div class="col-sm-2">
      <?= $form->field($model, 'service_tax')->textInput(['maxlength' => true])->label("Service Tax"); ?>
      <?= $form->field($model, 'pancard_no')->textInput(['maxlength' => true])->label("Pan Card Number"); ?>
      <?= $form->field($model, 'cardholder_name')->textInput(['maxlength' => true])->label("Card Holder Name"); ?>
      <?= $form->field($model, 'payment_details')->textInput(['maxlength' => true])->label("Payment Detail"); ?>
   </div>


   <div class="col-sm-2">
      <?php $payment = PaymentMethod::find()->asArray()->all();
         $product_map=ArrayHelper::map($payment,'pm_autoid','methodname');
         ?>
      <div class=" ">
         <?= $form->field($model, 'mode_of_payment')->dropdownlist($product_map,['maxlength' => true,'class'=>'form-control','onchange'=>"getval(this);"]) ?>     
      </div>
      <?= $form->field($model, 'card_cheque_no')->textInput(['maxlength' => true])->label("Card/Cheque Number"); ?>
      <?= $form->field($model, 'card_name')->textInput(['maxlength' => true])->label("Card Name"); ?>
      <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true])->label("Bank Name"); ?>
   </div>


   <div class="col-sm-4">
      <div class="col-sm-6">
         <?= $form->field($model, 'total_paid')->textInput(['maxlength' => true,'readonly'=>true,'class'=>'form-control text-right'])->label("Total Bill Amount"); ?>
         <?= $form->field($model, 'prev_cashpaid')->textInput(['maxlength' => true,'readonly'=>true,'class'=>'form-control text-right'])->label("Previous Cash Paid"); ?>
         <?= $form->field($model, 'bill_amount')->textInput(['maxlength' => true,'readonly'=>true,'class'=>'form-control text-right'])->label("Current Bill Amount"); ?>
         <?= $form->field($model, 'amount')->textInput(['maxlength' => true,"onkeyup"=>"balnceamtcalc(this.value)","onkeypress"=>"javascript:return isNumber(event)",'class'=>'form-control text-right',
            ])->label("Current Paid Amount"); ?>
      </div>
      <div class="col-sm-6">
         <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true,'readonly'=>true,'class'=>'form-control text-right'])->label("Balance Amount "); ?>
         <?php 
            $authority_master=ArrayHelper::map(AuthorityMaster::find()->where(['isactive'=>1])->all(),'autoid','authorityname'); ?>
         <?= $form->field($model, 'authority')->dropdownlist($authority_master,['class'=>'form-control cus-fld','prompt'=>'Select'])->label('Authority')  ?> 
         <?= $form->field($model, 'remark')->textarea(['rows' => 1])->label("Remarks"); ?>
      </div>
   </div>


     <div class="col-sm-2">
         
          
              <div class="panel-body"  >
           <div class="row">
             <div class="col-sm-12">
             <div class="row">
            
                <div class="form-group b-width"> 
                           <input type="hidden" name="saved_val" id='saved_val'>
        <!-- <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?> -->
        <button type="button" value='save_bill' name='saved_bill' style="z-index: 9999;" onclick='SavedReturnTablet();' class="clear_field btn btn-success  fwidth ss_v save_billing" data-toggle="tooltip" title="Ctrl+s">Save</button>
        
              </div>
             </div> 


             <div class="row">

               
                         </div><br>
             <div class="row">
                           <div class="form-group">
                          <button type="button" class="btn btn-warning b-width remove_all"onclick='remove_all();'>Clear</button> 
                           </div>
               
             </div>
              <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
              <span id="loadtexts" style="display: none; "></span>
              <br>
            <div class="row">
              <div class="form-group ">
                 <a href="<?php  echo Yii::$app->request->BaseUrl;?>/index.php?r=sales-moneyreceipts/index" class="btn  btn-default btn-bk  b-width" title="Back To Grid">Grid </a>
                </div>
                </div>
                         </div>
           </div>
           </div>
          
            
         </div>


</div>
<div class="row">
  <div class="col-sm-12">
  <div class="col-sm-6" style="width: 51%;"></div>
 <div class="col-sm-4" style="width: 32.333333%;">
<?= $form->field($model, 'amount_in_words')->textInput(['maxlength' => true,'readonly'=>true])->label("Amount In Words"); ?>
</div>
</div>
</div>
</div></div></div></div>

<!--    <?= $form->field($model, 'default_amount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'created_at')->textInput() ?>
    <?= $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?> -->

      <!--  <div class="form-group text-right">
        <input type="hidden" name="saved_val" id='saved_val'>
        <!-- <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>  
        <button type="button" value='save_bill' name='saved_bill' style="z-index: 9999;" onclick='SavedReturnTablet();' class="clear_field btn btn-success btn-xs fwidth ss_v save_billing" data-toggle="tooltip" title="Ctrl+s">Save</button>
        
        <button type="button" class="btn  btn-xs btn-warning remove_all"onclick='remove_all();'>Clear</button>
         <a href="<?php  echo Yii::$app->request->BaseUrl;?>/index.php?r=sales-moneyreceipts/index" class="btn text-right btn-xs btn-default btn-bk" title="Back To Grid">Grid </a>
    </div>  -->


<div class="row">
   <h5 class="box-title"><strong>History of sales money receipts</strong></h5> 
  <table class="table table-striped table-hover" width="100%" border="1" id="history_money" align="center">
    <thead>
    	<tr>
    		<td>S.No</td>
    		<td>Date</td>
    		<td>Paid Amount</td>
    		<td>Created By</td>
    		<td>Remarks</td>
    		<td>MOP</td>
    		<td>IP Address</td>
    	</tr>
    </thead>
    <tbody class="fetch_update_data">
    	<tr><td colspan="7">No Records</td></tr>
    <tbody>	
  </table>	
</div>	

<div id="patient_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Details</h4>
      </div>
      <div class="modal-body">
        <div class="" id="patient_history_report">
      
      <table id="reg_table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>MR Number</th>
                <th>Patient name</th>
                <th>DOB</th>
                <th>AGE</th>
               	<th>Relation Name</th>
               	<th>Mobile Number</th>
                <th>City</th>
            </tr>
        </thead>
        
    </table>    
    </div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

    <?php ActiveForm::end(); ?>

</div>
<script>
function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
		 }    
    
//Date Format
function formatDate(date) 
{
     var d = new Date(date),
     month = '' + (d.getMonth() + 1),
     day = '' + d.getDate(),
     year = d.getFullYear();
   
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [day, month, year].join('-');
 }
 function balnceamtcalc (data) {
 
 	var amt=data;
 	$('#salesmoneyreceipts-total_amount').val(0)
   
   var cur_billamt=parseFloat($('#salesmoneyreceipts-bill_amount').val());
   if(isNaN(cur_billamt)){
   	cur_billamt=0;
   }
  if(amt<=cur_billamt){
  	var balnce_amt=cur_billamt-amt;
   if(isNaN(balnce_amt)){
   	balnce_amt=0;
   }
   $('#salesmoneyreceipts-total_amount').val(balnce_amt.toFixed(2));	
  
 
  }else{
  	$('#salesmoneyreceipts-total_amount').val(0);
   	$('#salesmoneyreceipts-amount').val(0);
  	alert('bill amount bigger ');
  	
  }
   
   
  var amt_word=convertNumberToWords(Math.round(parseFloat(data)));
  $('#salesmoneyreceipts-amount_in_words').val(amt_word); 
   
   
 }
  /***********/
 function convertNumberToWords(amount) 
{
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
/*** Bill Number Autocomple ***/

$(".ipnumber").typeahead({
  
  source: function(query,result) {
        $.ajax({
          url:'<?php echo Yii::$app->homeUrl . "?r=sales/ajaxbillnumber";?>',
          method:'POST',
          data:{query:query},
          dataType:'json',
          success:function(data)
          {
            result($.map(data, function(item){
            return item.bill_no;
            }));
            
          }
        })
  },
  autoSelect: true,
  displayText: function(result)
  {
     return result;
  },
  afterSelect: function(result) 
  {  $('#load1').show();
    $.ajax({
          url:'<?php echo Yii::$app->homeUrl . "?r=sales-moneyreceipts/opmoneydetails&id=";?>'+result,
          method:'POST',
          dataType:'json',
          success:function(data)
          {   
          	$('#load1').hide();
          	clearfun();
          	var obj = data;
            $('#salesmoneyreceipts-mr_no').val(obj[0]['mrnumber']);
			$('#salesmoneyreceipts-name').val(obj[0]['name']);
			$('#salesmoneyreceipts-mobile_no').val(obj[0]['phonenumber']); 
			$('#salesmoneyreceipts-bill_number').val(obj[0]['billnumber']);
			$('#salesmoneyreceipts-total_paid').val(Math.round(parseFloat(obj[0]['overalltotal'])));
			
			if(obj[2]!=""){
				$('#salesmoneyreceipts-prev_cashpaid').val(obj[2]);	
				var pre_paid=parseFloat($('#salesmoneyreceipts-prev_cashpaid').val());
			}else{
				var pre_paid=parseFloat($('#salesmoneyreceipts-prev_cashpaid').val());
				if(isNaN(pre_paid)){
  						pre_paid=0;
  				}else{
  						$('#salesmoneyreceipts-prev_cashpaid').val(obj[2]);
  				}
  			}
			
			var totamt=parseFloat($('#salesmoneyreceipts-total_paid').val());
  			var curr_billbal=totamt-pre_paid;
  			if(isNaN(curr_billbal)){
             	$('#salesmoneyreceipts-bill_amount').val(0)
            }else{
            	$('#salesmoneyreceipts-bill_amount').val(curr_billbal);
            }
             $('#salesmoneyreceipts-amount').val(0);
             $('#salesmoneyreceipts-total_amount').val(0);
             var amount=$('#salesmoneyreceipts-amount').val();
             var amt_word=convertNumberToWords(Math.round(parseFloat(amount)));
  			 $('#salesmoneyreceipts-amount_in_words').val(amt_word);
  			 
  			 $('.fetch_update_data ').html(obj['money_re']);
  			 if(totamt==pre_paid){
  			 	$('.save_billing').attr('disabled','disabled');
  			 }
  			 
			$('#salesmoneyreceipts-service_tax').val(obj[3]['service_tax']);
			$('#salesmoneyreceipts-pancard_no').val(obj[3]['pancard_no']);
			$('#salesmoneyreceipts-cardholder_name').val(obj[3]['cardholder_name']);
			$('#salesmoneyreceipts-card_cheque_no').val(obj[3]['card_cheque_no']);
			$('#salesmoneyreceipts-payment_details').val(obj[3]['payment_details']);
			$('#salesmoneyreceipts-card_name').val(obj[3]['card_name']);
			$('#salesmoneyreceipts-bank_name').val(obj[3]['bank_name']);
			
			
             
          }
        })
    }
});
  
  /***********/
 
 function SavedReturnTablet() {
 	var remarks=$('#salesmoneyreceipts-remark').val();
 	var billnumber=$('#salesmoneyreceipts-bill_number').val();
 	if(billnumber != '')
	{
	  if(remarks!= ''){
		if (confirm('Are You Sure to Money Receipts ?')) {
				$.ajax({
		            type: "POST",
		            url: "<?php echo Yii::$app->homeUrl . "?r=sales-moneyreceipts/saveval&id=";?>"+billnumber,
		            data: $("form#w0").serialize(),
		            success: function (result) 
		            { 
		            	var obj = $.parseJSON(result); //alert(obj[0]);alert(obj[1]);
		            	if(obj[0] === 'saved')
		            	{
                   			$("#saved_val").val(obj[1]);
		            		$('.save_billing').attr('disabled','disabled');
		            	}else if(obj[0] === 'notsave'){
		            		alert("Amount Value is Zero, So Not Saved ..");
		            		$("#saved_val").val(obj[1]);
		            		
		            	}
		            }
				});
		}
	}else{
		alert('Remarks required');
		 return false;
		}
	}
	else{
		alert('Bill Number required');
				return false;
	}
	$('#salesmoneyreceipts-bill_number').focus();
 	
 }
 
 $(document).ready(function()
	{
		$('#salesmoneyreceipts-bill_number').focus();
	});	
 function remove_all()
	{  
		$('.fetch_update_data tr').remove();
		clearfun();
		$('.save_billing').removeAttr('disabled','disabled');
		window.location.reload();
	}
function clearfun() { 
  $("#salesmoneyreceipts-mr_no").val('');
  $("#salesmoneyreceipts-name").val('');
  $("#salesmoneyreceipts-mobile_no").val('');
  $("#salesmoneyreceipts-total_paid").val('');
  $("#salesmoneyreceipts-bill_number").val('');
  $("#salesmoneyreceipts-pancard_no").val('');
  $("#salesmoneyreceipts-cardholder_name").val('');
  $("#salesmoneyreceipts-bill_amount").val('');
  $("#salesmoneyreceipts-service_tax").val('');
  $("#salesmoneyreceipts-prev_cashpaid").val('');
  $("#salesmoneyreceipts-amount").val('');
  $("#salesmoneyreceipts-card_cheque_no").val('');
  $("#salesmoneyreceipts-payment_details").val('');
  $("#salesmoneyreceipts-card_name").val('');
  $("#salesmoneyreceipts-amount_in_words").val('');
  $("#salesmoneyreceipts-bank_name").val('');
  $("#salesmoneyreceipts-total_amount").val('');
  $("#salesmoneyreceipts-authority").val('');
  $("#salesmoneyreceipts-remark").val('');
}	
	
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) 
    {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's': 
              event.preventDefault();
            var  saved_val = $("#saved_val").val(); 
              if(saved_val==""){
              SavedReturnTablet();
                 
            }else{ 
              alert("already Saved");
            }
            break;
        case 'f':
            event.preventDefault();
            remove_all();
            alert('ctrl-f');
            break;
        case 'g':
            event.preventDefault();
            alert('ctrl-g');
            break;
        case 'c':
            event.preventDefault();
           	RemoveAll();
            break;
        }
    }
});
	
 </script>
