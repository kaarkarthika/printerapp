<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\PaymentMethod;
use backend\models\PaymentType;
use backend\models\AuthorityMaster;
use backend\models\InRegistration;
use backend\models\InRegistrationSearch;
/* @var $this yii\web\View */
/* @var $model backend\models\IpMoneyreceipts */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.ip-moneyreceipts-form label.control-label {
   /* width: 38%;
    text-align: right;
    float: left;
    margin-right: 15px;
        font-size: 12px; */
}

.ip-moneyreceipts-form input,.ip-moneyreceipts-form select,.ip-moneyreceipts-form textarea {
   /* width: 50%;
    text-align: left;
        font-size: 12px; */
}

</style>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>  

<div class="ip-moneyreceipts-form">

    <?php $form = ActiveForm::begin(); ?>
    <div id="load1" style='display:none;text-align: center;'><img  class="load-image" src="<?= Url::to('@web/loader1.gif') ?>" /></div>
     <div class="row">
     	<div class="col-md-12">
     		<div class="row">
     		
			
			<div class="col-md-3">
     			<!-- <?= $form->field($model, 'transaction_type')->textInput(['maxlength' => true]) ?> -->
     			<?= $form->field($model, 'transaction_type')->dropdownlist(['NS'=>'Non-Settlement','S'=>'Settlement','A'=>'Advance','R'=>'Refund'],['maxlength' => true,'class'=>'form-control'])->label('Type') ?>
			    
				<!-- <?= $form->field($model, 'ip_no')->textInput(['maxlength' => true]) ?> -->
    			<div class="form-group" style="margin-bottom:10px;">
				    <label class="control-label">IP NO</label>  
					<div class="input-group input-group-sm">							   
						<input type="text" id="ip_number" name="ip_number" class="ipnumber form-control cus-fld number" autocomplete="off" onkeyup='EmptyESC(this,event)' required placeholder="IP Number">
						<span class="input-group-btn">
							<button type="button" class="btn inp btn-default btn-flat btn patient_fetch_details"><i class="ssearch glyphicon glyphicon-search"></i></button>
						</span>
					</div>
				</div>
				<?= $form->field($model, 'mr_no')->textInput(['maxlength' => true,'readonly'=>true]) ?>
				<?= $form->field($model, 'bill_number')->textInput(['maxlength' => true,'readonly'=>true]) ?>
                <?= $form->field($model, 'bed_no')->textInput(['maxlength' => true,'readonly'=>true]) ?>
                <?= $form->field($model, 'total_paid')->textInput(['maxlength' => true,'readonly'=>true,'class'=>'form-control text-right'])->label("Total Bill Amount") ?>	    					
			</div>
			
			<div class="col-sm-3">
     		   <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
     		   <div class="form-group field-inregistration-address has-success">
				<label class="control-label" for="inregistration-address">Address</label>
				<textarea id="inregistration-address" class="form-control" name="InRegistration[address]" rows="1" required="" aria-invalid="false"></textarea>
			   </div>
	 
			   <div class="form-group field-inregistration-phone_no">
				<label class="control-label" for="inregistration-phone_no">Phone No</label>
				<input type="text" id="inregistration-phone_no" class="form-control" readonly name="InRegistration[phone_no]">
			   </div>
			  
			   <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true,'readonly'=>true]) ?>
			 
			   <div class="form-group ">
				<label class="control-label" for="inregistration-phone_no">Organisation</label>
				<input type="text" id="inregistration-org" class="form-control" name="InRegistration[phone_no]">
			   </div>  		 	
     	    </div>
			
	    	<div class="col-md-6">
    		  <div class="col-sm-3"> 
			    <?= $form->field($model, 'prev_cashpaid')->textInput(['maxlength' => true,'class'=>'form-control text-right','readonly'=>true ])->label("Previous Paid"); ?>
              </div>  
              <div class="col-sm-3"> 			  
  			    <?= $form->field($model, 'bill_amount')->textInput(['maxlength' => true, 'class'=>'form-control text-right','readonly'=>true])->label("Current Pending"); ?>
    		  </div>
			  <div class="col-sm-3">
			   <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'class'=>'form-control text-right number', 'required'=>true, "onkeyup"=>"CalculatedAmoumt(this.value);"])->label("Current Payment"); ?>
	    	  </div>
			  <div class="col-sm-3">
			   <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true,'class'=>'form-control text-right','readonly'=>true])->label("Balance Amount"); ?>
     	      </div>
			  <div class="col-sm-6">
			      <?php $payment = PaymentMethod::find()->asArray()->all();
  				  $product_map=ArrayHelper::map($payment,'pm_autoid','methodname');
  			      ?>
     	         <div class=" ">
    		        <?= $form->field($model, 'mode_of_payment')->dropdownlist($product_map,['maxlength' => true,'class'=>'form-control','onchange'=>"getval(this);"]) ?> 		
     	         </div>
			  </div>
			  <div class="col-sm-6">
			      <?php $payment = PaymentType::find()->asArray()->all();
  				    $product_map=ArrayHelper::map($payment,'payment_type_id','paymenttype');
  			      ?>
     	          <div class=" ">
    		         <?= $form->field($model, 'card_name')->dropdownlist($product_map,['maxlength' => true,'prompt'=>'Select']) ?> 		
     	          </div> 
			  </div>
			  
			  <div class="col-sm-6">
			      <?= $form->field($model, 'card_cheque_no')->textInput(['maxlength' => 16])->label('Card/ Cheque No') ?>
			  </div>
			  <div class="col-sm-6">
			      <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
			  </div>
			  <div class="col-sm-12">
			  <?= $form->field($model, 'amount_in_words')->textInput(['maxlength' => true]) ?>
			  </div>
			  <div class="col-sm-6">
			    <?= $form->field($model, 'remark')->textarea(['rows' => 1,'required'=>true]) ?> 
			  </div>
			  <div class="col-sm-6">
			     <?php 
                $authority_master=ArrayHelper::map(AuthorityMaster::find()->where(['isactive'=>1])->all(),'autoid','authorityname'); ?>
                <?= $form->field($model, 'authority')->dropdownlist($authority_master,['class'=>'form-control cus-fld','prompt'=>'Select'])->label('Authority')  ?>	
     	
			  </div>
		   
		   </div>
			</div>
			<hr>
			<div class=" ">
			 <div class="col-sm-12 ">
			    <div class=" ">
			     <?= Html::Button('Save', ['class' => 'btn btn-success pull-right', "onclick"=>"SaveMoneyreceipts();"]) ?>
			  </div>
			 </div>
			</div>
     	</div>
  
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
            	<th>IP Number</th>
                <th>MR Number</th>
                <th>Patient name</th>
                <th>Relation Name</th>
                <th>Mobile Number</th>
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
	$(document).ready(function() {
 	if($('#ipmoneyreceipts-mode_of_payment').val()=="1"){
 		$('#ipmoneyreceipts-card_cheque_no').attr('readonly', true);
 		$('#ipmoneyreceipts-bank_name').attr('readonly', true);
 		$('#ipmoneyreceipts-payment_details').attr('readonly', true);
 		$('#ipmoneyreceipts-card_name').attr("disabled","disabled");

 		$('#ipmoneyreceipts-card_cheque_no').attr('required', false);
 		$('#ipmoneyreceipts-bank_name').attr('required', false);
 		$('#ipmoneyreceipts-payment_details').attr('required', false);
 		$('#ipmoneyreceipts-card_name').attr("required", false);
 	}
 	
});
$("body").on('keypress', '.number', function (e) 
{
//if the letter is not digit then display error and don't type anything
if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
{
	return false;
}
}); 
	function isReadOnly() 
	{
		$('#doctor_name').attr("style", "pointer-events: none;");
		$('#gender').attr("style", "pointer-events: none;");
		$('#insurance').attr("style", "pointer-events: none;");
	}
function getval(val) {
	vals = $("#ipmoneyreceipts-mode_of_payment").val(); 
	if(vals=="1"){  
		$('#ipmoneyreceipts-card_cheque_no').attr('readonly', true);
 		$('#ipmoneyreceipts-bank_name').attr('readonly', true);
 		$('#ipmoneyreceipts-payment_details').attr('readonly', true);
 		$('#ipmoneyreceipts-card_name').attr("disabled","disabled");

 		$('#ipmoneyreceipts-card_cheque_no').attr('required', false);
 		$('#ipmoneyreceipts-bank_name').attr('required', false);
 		$('#ipmoneyreceipts-payment_details').attr('required', false);
 		$('#ipmoneyreceipts-card_name').attr("required", false);
	}else if(vals=="2"){
		$('#ipmoneyreceipts-card_cheque_no').attr('readonly', false);
 		$('#ipmoneyreceipts-bank_name').attr('readonly', false);
 		$('#ipmoneyreceipts-card_name').attr('disabled', false);

 		$('#ipmoneyreceipts-card_cheque_no').attr('required', true);
 		$('#ipmoneyreceipts-bank_name').attr('required', true);
 		$('#ipmoneyreceipts-payment_details').attr('required', true);
 		$('#ipmoneyreceipts-card_name').attr("required", true);
	}else{
		$('#ipmoneyreceipts-card_cheque_no').attr('readonly', false);
 		$('#ipmoneyreceipts-bank_name').attr('readonly', false);
 		$('#ipmoneyreceipts-card_name').attr("disabled",false);
 		$('#ipmoneyreceipts-card_cheque_no').attr('readonly', true);
 		$('#ipmoneyreceipts-bank_name').attr('readonly', false);
 		$('#ipmoneyreceipts-payment_details').attr('readonly', false);
 		$('#ipmoneyreceipts-card_name').attr("disabled","disabled");

	}  
}

function EmptyESC(data,event)
 {
 	if(data.value === '' || event.keyCode === 27)
	{
		$('#ipmoneyreceipts-mr_no').val('');
		$('#ip_number').val('');
		$('#ipmoneyreceipts-bed_no').val('');
		$('#ipmoneyreceipts-bill_number').val('');
		$('#ipmoneyreceipts-total_paid').val('');
		$('#ipmoneyreceipts-name').val('');
		$('#inregistration-address').val('');
		$('#ipmoneyreceipts-pancard_no').val('');
		$('#ipmoneyreceipts-prev_cashpaid').val('');
		$('#ipmoneyreceipts-cardholder_name').val('');
		$('#ipmoneyreceipts-bill_amount').val('');
		$('#ipmoneyreceipts-service_tax').val('');
		$('#ipmoneyreceipts-amount').val('');
		$('#inregistration-phone_no').val('');
		$('#ipmoneyreceipts-mobile_no').val('');
		$('#ipmoneyreceipts-total_amount').val('');
	}
 }

 	function CalculatedAmoumt(return_qty) 
	{
		var tablet_id=return_qty;
		if(tablet_id != '')
		{
			 if(tablet_id > parseFloat($('#ipmoneyreceipts-bill_amount').val())){
			 	alert('Amount is greater than Bill amount.!!');
			 	$('#ipmoneyreceipts-amount').val('0');
			 	 return false; 
			 }else{
				$('#ipmoneyreceipts-total_amount').val(parseFloat($('#ipmoneyreceipts-bill_amount').val())-parseFloat($('#ipmoneyreceipts-amount').val())); 
			    var net_amount_in_words=convertNumberToWords(Math.round(parseFloat($('#ipmoneyreceipts-amount').val())));
			    $('#ipmoneyreceipts-amount_in_words').val(net_amount_in_words+' Only');  
			}
	}
}
	
 $(".ipnumber").typeahead({
	
	source: function(query,result) {
	  		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxipnumber";?>',
	  			method:'POST',
	  			data:{query:query},
	  			dataType:'json',
	  			success:function(data)
	  			{
	  				result($.map(data, function(item){
	  				return item.ip_no;
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
	  			url:'<?php echo Yii::$app->homeUrl . "?r=ip-moneyreceipts/ajaxipnumberselectpay&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{   $('#load1').hide();
	  			 
  			 	$('#ipmoneyreceipts-mr_no').val(data[0]['mr_no']);
  			 	$('#ipmoneyreceipts-bed_no').val(data[0]['bed_no']);
				$('#ipmoneyreceipts-bill_number').val(data[0]['mr_no']);
				$('#ipmoneyreceipts-name').val(data[0]['patient_name']);
				$('#inregistration-address').val(data[0]['address']);
				$('#inregistration-phone_no').val(data[0]['phone_no']);
				$('#ipmoneyreceipts-mobile_no').val(data[0]['mobile_no']);
				$('#ipmoneyreceipts-total_paid').val(parseFloat(data[1]['total_amount']));
				$('#ipmoneyreceipts-prev_cashpaid').val(parseFloat(data[1]['prev_amount']));

				
				$('#ipmoneyreceipts-bill_amount').val(parseFloat($('#ipmoneyreceipts-total_paid').val())-parseFloat($('#ipmoneyreceipts-prev_cashpaid').val()));
				 
				 	  			 
	  		}
	  	})
	  }
});

function SaveMoneyreceipts()
 {
   
 	//var valid=$("#w0").valid();  
	 $amount= $("#ipmoneyreceipts-amount").val();
	 $remark= $("#ipmoneyreceipts-remark").val();
	 $authority= $("#ipmoneyreceipts-authority").val();

	 if($amount==""){
	 	alert("Amount field required."); return false;
	 }else if($remark==""){
	 	alert("remark field required."); return false;
	 }else if($authority==""){
	 	alert("authority field required."); return false;
	 }else{

        if (confirm('Are You Sure to Save ?')) {
		$.ajax({	
			     type: "POST",
 				 url: "<?php echo Yii::$app->homeUrl . "?r=ip-moneyreceipts/create";?>",
 				 data: $("#w0").serialize(),
			     success: function (result) 
			     {
			     	if(result === 'S')
			     	{
			     		$('#load1').hide();
			     		alert('Saved Success');
			     		$('#saves_sucess').attr('disabled','disabled');
			     	}	
			     }
		 });
    }
	}
	//}else{
	//	alert("Please fill required fields."); return false;
	//}
 }

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

$(document).ready(function() {
			
	$("body").on('click', '.patient_fetch_details', function ()
	{
		$modal = $('#patient_details');
		$modal.modal('show');
		setTimeout(function(){ 
		var table_as = $("#reg_table").DataTable();
		table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
	});
	jtable_pd();
	
});	
	 function jtable_pd(){
    	
    	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=in-registration/injqgrid';
  var table_reg= $('#reg_table').DataTable( {
        "processing": true,
        "serverSide": true,
         "ajax": {
        	"url": ajax_url,
        	 "type": "POST"
        	},
        	keys: {
           		keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
        	},
        	"columns": [
        	{ "data": "ipno","defaultContent": '<input type="text" value="0" />' },
            { "data": "mrno","defaultContent": '<input type="text" value="0" />' },
            { "data": "pname","defaultContent": "NA" },
            { "data": "rname","defaultContent":"NA" },
            { "data": "mno","defaultContent": '<input type="text" value="0" />'  },
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#reg_table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      //  table_reg.row(cell.index().row).select();
      //  $('#reg_table_filter input').val("");
         $('#reg_table_filter input').focus();
    });
  $('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#reg_table").DataTable();
        if(key === 13){
        	
        	$('#reg_table thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				//alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#reg_table_filter input').focus();
        }
    }); 
    
$('#reg_table').on( 'click', 'tr', function () {
    var data = table_reg.row(this).id(); 
 	PatientDetailsFetch(data);
});

$('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id(); 
   		PatientDetailsFetch(data);
 	}
});    
    
}
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

function PatientDetailsFetch(data)
{
	$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=ip-moneyreceipts/inipfetchmrnumber&id=";?>"+data,
        success: function (result) 
        { 
        	var obj = $.parseJSON(result);
        	
        	$('.ipnumber').val(obj[0]['ip_no']);
        	 $('#ipmoneyreceipts-mr_no').val(obj[0]['mr_no']);
        	$('#ipmoneyreceipts-name').val(obj[0]['patient_name']);
        	$('#ipmoneyreceipts-bill_number').val(obj[0]['bill_number']);
        	$('#inregistration-address').val(obj[0]['address']);
        	$('#inregistration-phone_no').val(obj[0]['phone_no']);
        	$('#ipmoneyreceipts-mobile_no').val(obj[0]['mobile_no']);
        	$('#ipmoneyreceipts-bed_no').val(obj[0]['bed_no']);
        	$('#inregistration-org').val(obj[1]);
        	$('#ipmoneyreceipts-total_paid').val(obj[2]['total_amount']);
        	$('#ipmoneyreceipts-prev_cashpaid').val(obj[2]['prev_amount']);
        	
        //	CalculateAge(obj[0]['dob']); 
        	
        	$modal = $('#patient_details');
        	$modal.modal('hide');
        }
	});
}


</script>	