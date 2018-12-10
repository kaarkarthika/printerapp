<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo"<pre>"; print_r($lab_payment_prime_val['report_received_date']); die;
?>
<div class="lab-payment-prime-view" style="    height: 220px;">
	<form action="index.php?r=lab-payment-prime/reportsave" method="POST" enctype="multipart/form-data">
	<div class="sample-collect">
		<input type="hidden" id="autoid" name="autoid" value="<?php echo $model->lab_id ?>">
    	<!--<input type="checkbox" id="samplecollect" name="samplecollect" onclick="myFunction()" value="">-->
    
    	 <div class='col-sm-12'> 
            <div class="form-group"> 								  
            		<p style="float: left;margin-right: 10px;">Report Received Date</p>
            	<div class='input-group date' id=' ' style="width: 200px;">
                    <input type='text' required="required" class=" datepicker form-control date_sample" id="date_sample" name="date_sample" />
                    <!-- <input type='text' required="required" class=" form-control date_sample" id='datetimepicker4' name="date_sample" /> -->
                </div>
                <!-- <div class='input-group date' id='datetimepicker1' style="width: 200px;">
                    <input type='text' class="form-control date_sample" id="date_sample" name="date_sample" value="" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div> -->
            </div>
            <div class="form-group"> 	<p>Remarks</p>
                <textarea name="remarks" id="remarks" row="5" class="remarks form-control"><?php echo $lab_payment_prime_val['remarks_report']; ?></textarea>
            </div>
            <div class="form-group">
    		<label for="exampleInputFile">File Upload</label>
    		<input type="file" class="form-control-file" id="file_upload" name="file_upload" >
    		<!-- <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small> -->
  		</div>
             
        </div>
        
		<input type="submit" class="btn btn-success" style="float:right;" name="save" id="save" value="Save" />
	</div>
	</form>
	<div class="alertmsg">Report Received Successfully</div>		
</div>

<style>
.alertmsg{
	color:green;
	font-size:16px; text-align:center;
	display:none; padding: 20px 0;

}
.sample-collect input[type=checkbox]{
	    zoom: 1.5;
}
.sample-collect p {
    font-size: 16px;
    position: relative;

}

</style>
<script>

   // $(function () {
   	  // var dateNow = new Date();
     // $('#datetimepicker1').datetimepicker({
     	// locale: 'es',
     	// format: "D-M-Y H:m",
     	// defaultDate:new Date()
     	// //defaultDate:moment(dateNow).hours(0).minutes(0).seconds(0).milliseconds(0)
     // });
  // });
        
 
            $(function () {
                $('#datetimepicker4').datetimepicker();
            });
            
   $("#savea").click(function(e) {
  
  var sampletest =$("#date_sample").val(); 
  var remarks =$("#remarks").val();
  var file=$("#file_upload").val();
   
 if(sampletest!=""){
 	if(remarks!=""){
		$.ajax({
		    	type:'POST',
		    	data: {sample: sampletest, remark:remarks, file: file},
		    	processData: false,
		    	contentType: false,
		    	  enctype: 'multipart/form-data',
		    	url: '<?php echo Yii::$app->homeUrl . "?r=lab-payment-prime/reportreceived&id=".$model->lab_id;  ?>', 
		    	success:function(data) {
		    }
		  });
 	}else{
 		Alertment('Remark Required');
  		document.getElementById("remarks").focus();
 	}
 }else{
 		Alertment('Sample Collection Date Required');
  		document.getElementById("date_sample").focus();
 }  
   
  
  

});
$(function () {
	 $('.datepicker').datetimepicker({
		 
       format: 'DD-MM-YYYY HH:mm:ss',
	  daysOfWeekDisabled: [ ]  
     });
   });
   
   
   
   

	</script>
	
	