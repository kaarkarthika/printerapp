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
            		<p style="float: left;margin-right: 10px;">Sample Collection Date</p>
                <div class='input-group date' id=' ' style="width: 200px;">
                    <input type='text' required="required" class=" datepicker form-control date_sample" id="date_sample" name="date_sample" />
                    <!-- <input type='text' required="required" class=" form-control date_sample" id='datetimepicker4' name="date_sample" /> -->
                    
                </div>
                      </div>
            <div class="form-group"> 	<p>Remarks</p>
                <textarea name="remarks" id="remarks" row="5" class="remarks form-control"></textarea>
            </div>
             <div class="form-group"> 
               	<input type="checkbox" name="out_source_test" id="out_source_test"  value=""><span style=""> Out Source Test</span>	
             </div>
        </div>
        
		<input type="button" class="btn btn-success" style="float:right;" name="save" id="save" value="Save" />
	</div>
	<div class="alertmsg">Sample Collect Successfully</div>		
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

}.modal .modal-dialog .modal-content {
    min-height: 415px;
}

</style>
<script>
 


            $(function () {
                $('#datetimepicker4').datetimepicker();
            });
        
    

$("#save").click(function() {

  var outsourcetest;      
  var sampletest =$("#date_sample").val(); 
  //var remarks =$("#remarks").val();
  
  if($('input[type="checkbox"]').prop("checked") == true){
     		outsourcetest="1";      	
  }
  else if($('input[type="checkbox"]').prop("checked") == false){
            outsourcetest="0";
   }
   
  if(sampletest!=""){
  	
	  	$.ajax({
	    	type:'POST',
	    	data: {sample: sampletest,outsourcetest:outsourcetest},
	    	url: '<?php echo Yii::$app->homeUrl . "?r=lab-payment-prime/testsave&id=".$model->lab_id;  ?>', 
	    	success:function(data) {
	    		if(data==1){
	    			$(".alertmsg").css("display", "block");	
	    		}
	    }
	  });
	   setTimeout(function(){
	    window.location.reload(1);
	  }, 1000);
  	
  }else{
  		Alertment('Sample Collection Date Required');
  		document.getElementById("date_sample").focus();
  } 


});
function Alertment(message)
{
$.alert({
		title: 'Alert!',
		content: message,
		type: 'red',
		theme: 'material',
		escapeKey: true,
		backgroundDismiss: true,
		typeAnimated: true,
	});
}
$(function () {
	 $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY HH:mm:ss',
	   daysOfWeekDisabled: [ ]  
     });
   });
	</script>
	 