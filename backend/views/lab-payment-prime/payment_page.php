<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\LabTesting;
use backend\models\Testgroup;
use backend\models\LabTestgroup; 
use backend\models\LabUnit;
use backend\models\LabReferenceVal; 
use yii\helpers\ArrayHelper;
use backend\models\LabReport;
use backend\models\MainTestgroup;
use backend\models\LabAddgroup;
use backend\models\LabPaymentPrime;
use backend\models\LabMulChoice;
use backend\models\LabPayment;
use backend\models\BranchAdmin;
/* @var $this yii\web\View */
/* @var $model backend\models\LabPayment */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Test Report';
 Html::encode($this->title) ;

?>

<style>
.table-bordered a span.fa.fa-edit {
    color: #fff;
    background-color: #ffbd4a !important;
    font-weight: 300 !important;
}
.table-bordered a span.fa.fa-print{
    color: #fff;
    background-color: red !important;
    font-weight: 300 !important;
}

div#group_lab_fetch .alertmsg {
    width: 19%; background-color:#a0a0a0;
    height: 25px; top:0 !important;
   }
 select.form-control.result-val {
    font-size: 13px;    
    padding: 0;
}
table.table.table-bordered.algincss thead th {
    background: #4682b4;
    color: #fff;
}
table.table.algincss thead tr th {
    width: 14%;
}
.result-val{
	text-align: right;
	    height: 25px;
    width: 81%;
    float: right;
}
a.btn.btn-danger.print-btn {
    float: right;
    position: relative;
    top: 90px;
    margin-right: 10px;
}
div#group_lab_fetch {
    margin-top: 30px;
}
input.form-control {
    height: 25px;
}	
.comments {
    margin-top: 10px;
}
div#group_lab_fetch,.testing-list{
    padding: 10px 20px 20px 20px;
    border: 1px solid #cecece;
}
div#group_lab_fetch span,.testing-list span {
    position: relative;
    padding: 5px 10px;
    font-weight: bold;
}
.testing-list {
    margin-top: 25px;
}
</style>

<div class="row" id="paymentpage">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body"  >
	<a href="<?php echo Yii::$app->homeUrl .'?r=lab-payment-prime/lab-index-grid' ?>" style="width: 150px;float: right;" class="btn btn-primary b-width btn btn-bk b-width">Back To Grid </a>
    <?php $form = ActiveForm::begin(); ?>
	
<?php 
		
		$set_id=array();
		if(!empty($lab_payment))
		{
			foreach ($lab_payment as $key => $value) 
			{
				if($value['lab_testgroup'] != '' )
				{
					$hide='show';
					$set_id[]=$value['lab_testgroup'];
				}
			}
			$set_id_val=implode(',', $set_id);
		}
?>
	
<div class="inpatientblock  desc" style="position: relative;top: 9px;"> 
	
	
	 <!-- <?=Html::Button('Group Pack', ['class' => 'btn btn-danger waves-effect waves-light '.$hide.'','id'=>'group_pack','data_id'=>$model->lab_id,'set_id'=>$set_id_val]); ?>
	<br/>
	 <?=Html::Button('Lab Test', ['class' => 'btn btn-danger waves-effect waves-light ','id'=>'lab_test','data_id'=>$model->lab_id]); ?> -->
	
	 <div class="testing-list">
		<span> Patient Details </span>
	 <table class="table table-bordered">
    <thead>
      <tr>
        <th>MR Number</th>
        <th>Requistions No</th>
        <th>Patient Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Mobile No</th>
        <th>Consultant Doctor</th>
        <th>Insurance</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $newpatient['mr_no'];?></td>
        <td><?php echo $lab_payment_prime['bill_number'];?></td>
        <td><?php echo $newpatient['patientname'];?></td>
        <td><?php echo $age;?></td>
        <td><?php echo $newpatient['pat_sex'];?></td>
        <td><?php echo $newpatient['pat_mobileno'];?></td>
         <td><?php echo $physicianmaster['physician_name'];?></td>
         <?php  $result = (!empty($insurance['insurance_type'])) ? $insurance['insurance_type'] :'NIL';?>
         <td><?php echo $result;?></td>
      </tr>
    </tbody>
  </table>				
</div>
</div>




<div id='group_lab_fetch1'>		
	<?php  
	
	$dob=$newpatient['dob'];
	$check=new DateTime($dob);
	$current_date =new DateTime(date('Y-m-d h:i:s', time()));
 
	$interval = $check->diff($current_date);
	$day_val=$interval->days;
	$month_val=$interval->m;
	$year_val=$interval->y;
	
 $lab_payment_prime_val=LabPaymentPrime::find()->where(['lab_id'=>$lab_payment[0]['lab_prime_id']])->asArray()->one();
 //$lab_payment=LabPayment::find()->where(['lab_prime_id'=>$id])->asArray()->groupBy(['lab_common_id','lab_test_name'])->all();
	
$result_string.='';
		
	
if(!empty($lab_payment))
			{ ?>
		<div id='group_lab_fetch'>
			<!-- <span> Lab Testing </span> -->
			<?php
			 
			 			 
			 $result_string='';
			 $result_string.='<input type="hidden" name="labtest" id="labtest" value='.$lab_payment_prime_val['lab_id'].' >';
			 	$result_string.='<table class="table table-bordered algincss " style="margin-bottom: 2px;" >
				<thead>
				<tr>
					<th style="width:10%;">S.NO</th>
					<th style="width:15%;">Test Code</th>
					<th style="width:25%;">Test Name</th>
					<th style="width:20%;">Print Date & Time</th>
					<th style="width:10%;">Print Count</th>
					<th style="width:10%;"> User</th>
					<th style="width:10%;">Action</th>
			
				</tr></thead><tbody>';
		   		$i=1;
				$ia=1;
				$mgtest=0;
				$testgrp=0;
				
				 
				foreach ($lab_payment as $key => $value)  
				{
					 $split_group=explode('_', $value['lab_test_name']);

					 if($split_group[0]=="MasterGroup"){
						$mastergroupname=MainTestgroup::find()->where(['autoid'=>$value['lab_common_id']])->groupBy(['autoid'])->asArray()->one();
						$printcount=LabReport::find()
							->select(['id','printcount','printdate','user_id','status'])
							->where(['lab_payment_id'=>$value['lab_prime_id']])
							->andWhere(['mastergroupid'=>$value['lab_common_id']])
							->andWhere(['lab_test_group'=>$value['lab_testgroup']])
							->asArray()->one();
							
						$branch_det=BranchAdmin::find()->where(['ba_autoid'=>$printcount['user_id']])->asArray()->one();
						$cdate =$printcount['printdate'];
						$printDate = date("d-m-Y h:i A", strtotime($cdate));
					
					if($printcount['printdate']==""){
							$printDate="-";
						}else{
							$cdate =$printcount['printdate'];
							$printDate = date("d-m-Y h:i A", strtotime($cdate));	
						}
						
					 $testgroupname=Testgroup::find()->select(['shortcode','testgroupname','autoid'])->where(['autoid'=>$value['lab_testgroup']])->andWhere(['isactive'=>1])->asArray()->one();
				 
					 
					if(!empty($testgroupname)){
						$url_code=Url::toRoute(["lab-payment-prime/reportdata", "id" =>$value['lab_prime_id'],"mgrp"=>"Group_".$testgroupname['autoid'],"mgval"=>$value['lab_common_id']]);
						$print_url=Yii::$app->homeUrl .'?r=lab-payment-prime/printdata&id='.$value['lab_prime_id'].'&mg=Group_'.$testgroupname['autoid']."&mgval=".$value['lab_common_id'];
						
						if($printcount['status']=="P"){
							$result_string.='
							<tr style="background: #b6fbc2;">
							<td >'.$i.'</td>
							<td><a href="'.$url_code.'" target="_blank">'. $testgroupname['shortcode'].'</a></td>
							<td ><a href="'.$url_code.'" target="_blank">'.$testgroupname['testgroupname'].'</a></td>
							<td >'.$printDate.'</td>
							<td >'.$printcount['printcount'].'</td>
							<td >'.$branch_det['authUserRole'].' </td>
							<td >
							 	<a href="'.$url_code.'" target="_blank"> <span class="fa fa-edit"></span></a>
							 	<a href="'.$print_url.'" target="_blank"> <span class="fa fa-print"></span></a>
							 </td>
							</tr>';
							
						}else{
							$url_code=Url::toRoute(["lab-payment-prime/reportdata", "id" =>$value['lab_prime_id'],"mgrp"=>"Group_".$testgroupname['autoid']]);
							$result_string.='
							<tr>
							<td >'.$i.'</td>
							<td><a href="'.$url_code.'" target="_blank">'. $testgroupname['shortcode'].'</a></td>
							<td ><a href="'.$url_code.'" target="_blank">'.$testgroupname['testgroupname'].'</a></td>
							<td >'.$printDate.'</td>
							<td >'.$printcount['printcount'].'</td>
							<td >'.$branch_det['authUserRole'].' </td>
							<td >
							 	<a href="'.$url_code.'" target="_blank"> <span class="fa fa-edit"></span></a>
							 </td>
							</tr>';	
						}
						}
					 } 
					  			
   /** TESTGROUP  $mgtest **/
					 	
				if($split_group[0]=="TestGroup"){
					
					
					 $testgroupname=ArrayHelper::map(Testgroup::find()->where(['autoid'=>$value['lab_common_id']])->asArray()->all(), 'autoid', 'testgroupname');
					 if(!empty($testgroupname)){
						$printcount=LabReport::find()
							->select(['id','printcount','printdate','user_id','status'])
							->where(['lab_payment_id'=>$value['lab_prime_id']])
							->andWhere(['lab_test_group'=>$value['lab_common_id']])
							->asArray()->one();
						
							 
						$branch_det=BranchAdmin::find()->where(['ba_autoid'=>$printcount['user_id']])->asArray()->one();
						if($printcount['printdate']==""){
							$printDate="-";
						}else{
							$cdate =$printcount['printdate'];
							$printDate = date("d-m-Y h:i A", strtotime($cdate));	
						}
						
						
				   $url_code=Url::toRoute(["lab-payment-prime/reportdata", "id" =>$value['lab_prime_id'],"mgrp"=>"Group_".$value['lab_common_id']]);
				   $print_url=Yii::$app->homeUrl .'?r=lab-payment-prime/printdata&id='.$value['lab_prime_id'].'&mg=Group_'.$value['lab_common_id']."&mgval=''";
						
					if($printcount['status']=="P"){
						$result_string.='
							<tr style="background: #b6fbc2;">
							<td >'.$i.'</td>
							<td ><a href="'.$url_code.'" target="_blank">'. $testgroupname[$value['lab_common_id']].'</a></td>
							<td ><a href="'.$url_code.'" target="_blank">'.$testgroupname[$value['lab_common_id']].'</a></td>
							<td >'.$printDate.'</td>
							<td >'.$printcount['printcount'].'</td>
							<td >'.$branch_det['authUserRole'].' </td>
							<td >
							 	<a href="'.$url_code.'" target="_blank"> <span class="fa fa-edit"></span></a>
							 	<a href="'.$print_url.'" target="_blank"> <span class="fa fa-print"></span></a>
							 </td>
							</tr>'; 
							}else{
								$result_string.='<tr style="">
							<td >'.$i.'</td>
							<td ><a href="'.$url_code.'" target="_blank">'. $testgroupname[$value['lab_common_id']].'</a></td>
							<td ><a href="'.$url_code.'" target="_blank">'.$testgroupname[$value['lab_common_id']].'</a></td>
							<td >'.$printDate.'</td>
							<td >'.$printcount['printcount'].'</td>
							<td >'.$branch_det['authUserRole'].' </td>
							<td >
							 	<a href="'.$url_code.'" target="_blank"> <span class="fa fa-edit"></span></a>
							 </td>
							</tr>'; 
							}
						   }
		 	       		 }

						if($split_group[0]=="LabTesting"){
 							  		$lab_testing1=LabTesting::find()->where(['autoid'=>$value['lab_common_id']])->asArray()->one();
								if(!empty($lab_testing1))
								{
									$printcount=LabReport::find()->select(['id','printcount','printdate','user_id','status'])->where(['lab_payment_id'=>$value['lab_prime_id']])->andWhere(['testname_id'=>$value['lab_common_id']])->asArray()->one();
									
									$branch_det=BranchAdmin::find()->where(['ba_autoid'=>$printcount['user_id']])->asArray()->one();
									if($printcount['printdate']==""){
										$printDate="-";
									}else{
										$cdate =$printcount['printdate'];
										$printDate = date("d-m-Y h:i A", strtotime($cdate));	
									}
									$url_code=Url::toRoute(["lab-payment-prime/reportdata", "id" =>$value['lab_prime_id'],"mgrp"=>"Testlab_".$value['lab_common_id']]);
									$print_url=Yii::$app->homeUrl .'?r=lab-payment-prime/printdata&id='.$value['lab_prime_id'].'&mg=Testlab_'.$value['lab_common_id']."&mgval=''";
									
									if($printcount['status']=="P"){
												$result_string.='<tr style="background: #b6fbc2;">
												<td >'.$i.'</td>
												<td><a href="'.$url_code.'" target="_blank">'. $lab_testing1['shortcode'].'</a></td>
												<td> <a href="'.$url_code.'" target="_blank">'.$lab_testing1['test_name'].'</a></td>
												<td >'.$printDate.'</td>
												<td >'.$printcount['printcount'].'</td>
												<td >'.$branch_det['authUserRole'].' </td>
												<td >
							 						<a href="'.$url_code.'" target="_blank"> <span class="fa fa-edit"></span></a>
							 						<a href="'.$print_url.'" target="_blank"> <span class="fa fa-print"></span></a>
							 					</td>
												</tr>'; 
											}
										else{
												$result_string.='
												<tr>
												<td >'.$i.'</td>
												<td><a href="'.$url_code.'" target="_blank">'. $lab_testing1['shortcode'].'</a></td>
												<td> <a href="'.$url_code.'" target="_blank">'.$lab_testing1['test_name'].'</a></td>
												<td >'.$printDate.'</td>
												<td >'.$printcount['printcount'].'</td>
												<td >'.$branch_det['authUserRole'].' </td>
												<td >
							 						<a href="'.$url_code.'" target="_blank"> <span class="fa fa-edit"></span></a>
							 					</td>
												</tr>'; 
											}
										}
									}
									$i++;
				 	       		}
							$result_string.='</tbody></table>';
 			  print_r($result_string) ;
			} ?>
			
	</div>	
		 </div>  
			   
	<?php ActiveForm::end(); ?>
</div>
</div>
<script>
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            var  saved_val = $("#saved_val").val();
              if(saved_val==""){
           			Savelabtest();
           			onetimesave=2;
           		}else{
           			alert('Already Saved ..!');
           		}
            break;
        case 'f':
            event.preventDefault();
            alert('ctrl-f');
            break;
        case 'g':
            event.preventDefault();
            alert('ctrl-g');
            break;
        case 'c':
            event.preventDefault();
            alert('ctrl-c');
            break;
        }
    }
});

function Savelabtest()
 {
 	var labid=$("#labtest").val();
 	var remarks=$("#remarks").val();
 	//alert(labid);
 	if(remarks!=""){
 		if (confirm('Are You want Sure to Save ?')) {
			$.ajax({	
			     type: "POST",
 				 url: "<?php echo Yii::$app->homeUrl . "?r=lab-payment-prime/report&id=";?>"+labid,
 				 data: $("#w0").serialize(),
			     success: function (result) 
			     {
			     	//obj=$.parseJSON(result);
			     	
			     		$("#saved_val").val(result[2]);
	            		$('#load1').hide();
			     		$('#saves_sucess').attr('disabled','disabled');
			     		//var url='<?php echo Yii::$app->homeUrl ?>?r=lab-payment-prime/print&id='+obj[1];
		 				//window.open(url,'_blank');
	            		//Alertment('Treatment Register Number is '+obj[0]);
			     }
		 });
  }
  }else{
  	Alertment('Remarks Required..');
  }
 }
 
 
 
$(".result-val").change(function(){
	var ttyue=$(this).attr('type');
	if(ttyue=='text'){
		var rfrom=$(this).data('from');
		var rto=$(this).data('to');
		var rval=$(this).val();
		var resultval=$(this).data('id');
		 var set_val="";
		  //alert(rfrom+""+rto+""+rval);
		 if(rval>=rfrom && rval<=rto ){
		 	set_val="1";
		 } 
		 //alert(set_val);
		if(set_val=='1'){
	   		 $("#col_"+resultval).css('background-color','green');
	    }else if(set_val=='2'){
	    	 $("#col_"+resultval).css('background-color','red');
	    }else if(set_val=="3"){
	    	 $("#col_"+resultval).css('background-color','white');
	    }else{
	    	 $("#col_"+resultval).css('background-color','red');
	    }
    	
    }else {
	    var resultval=$(this).data('id');
	    var set_val="";
	    set_val=$(this).find(':selected').attr('data-df');
	    if(set_val=='1'){
	   		 $("#col_"+resultval).css('background-color','green');
	    }else if(set_val=='2'){
	    	 $("#col_"+resultval).css('background-color','red');
	    }else if(set_val=="3"){
	    	 $("#col_"+resultval).css('background-color','white');
	    }else{
	    	 $("#col_"+resultval).css('background-color','red');
	    }
    
    }
    
});



	

 $(document).ready(function(){
 	
 	var sub=$('input.btn.btn-success').val();
 	if(sub=="Update"){

for (var i = 0,j=1; i < 100; i++,j++) {
	
  var ttyue=$(".result-val").attr('type');
	if(ttyue=='text'){
  var resultval=$(".result-val").data('id')+i;
  var rfrom=$("#result-val"+j).data('from');
  var rto=$("#result-val"+j).data('to');
  var rval=$("#result-val"+j).val();
	 var set_val="";
		
	//	  alert(rval+rfrom+rto);  
		 if(rval>=rfrom && rval<=rto ){
		 	set_val="1";
		 } 
		// 	alert(set_val);
		 	
		if(set_val=='1'){
	   		 $("#col_"+resultval).css('background-color','green');
	    }else if(set_val=='2'){
	    	 $("#col_"+resultval).css('background-color','red');
	    }else if(set_val=="3"){
	    	 $("#col_"+resultval).css('background-color','white');
	    }else{
	    	 $("#col_"+resultval).css('background-color','red');
	    }
    	
	}else{    
	    var resultval=$(".result-val").data('id');
	    var set_val="";
	    set_val=$(".result-val").find(':selected').attr('data-df');
	    if(set_val=='1'){
	   		 $("#col_"+resultval).css('background-color','green');
	    }else if(set_val=='2'){
	    	 $("#col_"+resultval).css('background-color','red');
	    }else if(set_val=="3"){
	    	 $("#col_"+resultval).css('background-color','white');
	    }else{
	    	 $("#col_"+resultval).css('background-color','red');
	    }
	}
} 	}
 	
$("#print").click(function(){
 		var id=$(this).attr('data_id');
    	var id=1;
    	
    	if(id != '')
    	{
    		$.ajax({
						
				   type: "POST",
				   url: "<?php echo Yii::$app->homeUrl . "?r=lab-payment-prime/print&id="?>"+id,          
				   success: function (result) 
				   {
				     
				   }
				  });
    	}
    	
	 });
 });
	
</script> 