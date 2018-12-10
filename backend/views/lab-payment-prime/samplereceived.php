<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-payment-prime-view" style="    height: 220px;">
	<div class="sample-collect">
		<input type="hidden" id="autoid" name="autoid" value="<?php echo $model->lab_id ?>">
    	<!--<input type="checkbox" id="samplecollect" name="samplecollect" onclick="myFunction()" value="">-->
    
    	 <div class='col-sm-12'> 
            <div class="form-group"> 								  
            		<p style="float: left;margin-right: 10px;">Sample Received Date</p>
            		 <div class='input-group date' id=' ' style="width: 200px;">
                    	<input type='text' required="required" class=" datepicker form-control date_sample" id="date_sample" name="date_sample" />
                    <!-- <input type='text' required="required" class=" form-control date_sample" id='datetimepicker4' name="date_sample" /> -->
                </div>
                <!-- <div class='input-group date' id='datetimepicker1' style="width: 200px;">
                	<input type='text' class="datepicker form-control date_sample" id="date_sample" name="date_sample" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div> -->
            </div>
            <div class="form-group"> 	<p>Remarks</p>
                <textarea name="remarks" id="remarks" row="5" class="remarks form-control"></textarea>
            </div>
             
        </div>
        
		<input type="button" class="btn btn-success" style="float:right;" name="save" id="save" value="Save" />
	</div>
	<div class="alertmsg">Sample Received Successfully</div>		
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
.modal .modal-dialog .modal-content {
    min-height: 415px;
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
//         
 
            $(function () {
                $('#datetimepicker4').datetimepicker();
            });
            
$("#save").click(function(e) {
  
  var sampletest =$("#date_sample").val(); 
  var remarks =$("#remarks").val();
  if(sampletest!=""){
  	if(remarks!=""){
  		$.ajax({
    	type:'POST',
    	data: {sample: sampletest, remark:remarks},
    	url: '<?php echo Yii::$app->homeUrl . "?r=lab-payment-prime/samplereceived&id=".$model->lab_id;  ?>', 
    	success:function(data) {
    		$(".alertmsg").css("display", "block");
   			setTimeout(function(){
    		window.location.reload(1);
	  	}, 1000);
    }
  });
	}else{
  			Alertment('Remarks Required');
  	}
  }else{
  		Alertment('Sample Received Date Required');
  }
  
  

});
$(function () {
	 $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY HH:mm:ss',
	   daysOfWeekDisabled: [ ]  
     });
   });

	</script>