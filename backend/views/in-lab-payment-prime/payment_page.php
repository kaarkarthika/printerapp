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
/* @var $this yii\web\View */
/* @var $model backend\models\LabPayment */
/* @var $form yii\widgets\ActiveForm */
 Html::encode($this->title) ;
?>

<style>
div#group_lab_fetch .alertmsg {
    width: 19%; background-color:#a0a0a0;
    height: 25px; top:0 !important;
   }
 select.form-control.result-val {
    font-size: 13px;    
    padding: 0;
}
table.table.table-bordered.algincss thead th {
    background: #888888;
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
    top: -15px;
    background: #ff7070;
    padding: 5px 10px;
    color: #fff;
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
        <th>Name</th>
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
	
	
if(!empty($lab_payment))
			{ ?>
		<div id='group_lab_fetch'>
			<span> Lab Testing </span>
			<?php
			 $result_string='';
				$result_string.='<table class="table table-bordered algincss" style="margin-bottom: -2px;">
				<thead><tr><th style="width:20%;">Test Name</th><th style="width:14%;">Result</th><th style="width:10%;">Units</th><th style="width:13%;">Normal Values</th><th style="width:20%;">Method</th><th style="width:40%;">Description</th></tr></thead></table>';
		   		$ia=1;
				 	
		   		foreach ($lab_payment as $key => $value)  
				{
					 	
					 $split_group=explode('_', $value['lab_common_id']);
					 if($split_group[0]=="MasterGroup"){
					 	$mastergroupname=ArrayHelper::map(MainTestgroup::find()->where(['autoid'=>$value['lab_testgroup']])->asArray()->all(), 'autoid', 'testgroupname');
						$lab_mastergroup=LabAddgroup::find()->where(['mastergroupid'=>$value['lab_testgroup']])->asArray()->all();
			    	 if(!empty($lab_mastergroup))
				 	 { $vali=0;
				 		  $result_string.='<table class="table table-bordered algincss" ALIGN="Center" style="margin-bottom: -2px;background: #ffd9d9;"><tr><td style="padding: 3px 10px;    text-align: center;"><b>'.$mastergroupname[$value['lab_testgroup']].'</b></td></tr></table>';
							foreach ($lab_mastergroup as $key2 => $masvalue) 
					 		{  
								$testgroupname=ArrayHelper::map(Testgroup::find()->where(['autoid'=>$masvalue['testgroupid']])->asArray()->all(), 'autoid', 'testgroupname');
								$lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$masvalue['testgroupid']])->asArray()->all();
								if(!empty($lab_testgroup)){
									$result_string.='<table class="table table-bordered algincss" style="margin-bottom: -2px;background: #eaeaea;"><tr><td style="padding: 3px 10px;"><b>'.$testgroupname[$masvalue['testgroupid']].'</b><td></tr></table>';
								}
								$i=1; 
						 
								foreach ($lab_testgroup as $key1 => $value1) 
								{
									$lab_testing=LabTesting::find()->where(['autoid'=>$value1['test_nameid']])->asArray()->one();
									$lab_unit=LabUnit::find()->where(['auto_id'=>$lab_testing['unit_id']])->asArray()->one();
										$lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$lab_testing['autoid']])->asArray()->one();
										
										//if($lab_reference_val['age_cal']=="Day"){
											
											if('Male'==$newpatient['pat_sex'])
											{
												$lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
												->andWhere(['or',['gender'=>"male"],['gender'=>"both"]])
												->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
												->asArray()->one();
											}
											if('Female'==$newpatient['pat_sex']){
											    $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
												->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
												->andWhere(['or',['gender'=>"female"],['gender'=>"both"]])
												->asArray()->one();
											}
										//	echo"<pre>";print_r($day_val);	print_r($lab_reference_val); die;
										
											$ref_from=$lab_reference_val['days_from'];
											$ref_to=$lab_reference_val['days_to'];
										
								$lab_report=LabReport::find()->asArray()->one();
								if(!empty($value['autoid'])){
									 $lab_report_val=LabReport::find()->where(['lab_payment_id'=>$value['autoid']])->asArray()->all();
								} 
									$mul_choice=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->select(["autoid","mulname","normal_value"])->asArray()->all();
									$savetext=ArrayHelper::map($mul_choice, 'autoid', 'mulname');
									$lab_mul_val=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->andWhere(['normal_value'=>'1'])->select(['autoid','mulname'])->asArray()->all();
									$normal_multext=ArrayHelper::map($lab_mul_val, 'mulname', 'mulname');
												
						          if($lab_testing['result_type']=="numeric"){
								  	 if(!empty($lab_reference_val)){
								  	 	  
									$result_string.='<table class="table table-bordered algincss group" style="margin-bottom: -2px;">';
		    						$result_string.='<tbody>';
									$result_string.='<tr>';
												//echo"<pre>"; print_r($value1['testgroupid']); die; 	
										
									if(!empty($value['autoid'])){
									$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
											<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
											<input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
											<input type="hidden" name="mastergroupid[]" value='.$masvalue['mastergroupid'].'>
											<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
											<input type="hidden" name="LabTestgroup[]" value='.$value1['testgroupid'].'>
											<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'> 
											</td>';
										}else{
											  
											$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
													<input type="hidden" name="TESTNAME[]" value="" >
												<input type="hidden" name="LabTesting[]" value="">
											<input type="hidden" name="TESTNAMEID[]" value="">
											<input type="hidden" name="LABPAYMENTPRIME[]" value="">
											<input type="hidden" name="LABPAYMENTID[]" value="">
											<input type="hidden" name="LabTestgroup[]" value="">
											<input type="hidden" name="MRNUMBER[]" value=""> 
											<input type="hidden" name="mastergroupid[]" value="">
											</td>';
										}
										
								//	echo"<pre>"; print_r($lab_report_val[$vali++]);
									
										if($lab_testing['result_type']=="numeric"){  
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><input type="text" data-id="'.$ia.'" data-from="'.$lab_reference_val['ref_from'].'" data-to="'.$lab_reference_val['ref_to'].'" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$vali++]['result'].' ></td>';	
										}elseif($lab_testing['result_type']=="multichoice"){
											$result_string.='<td style="width:12%;"><span id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><select class="form-control result-val" data-id="'.$ia.'" id="result-val_'.$ia.'" name="RESULT[]" required>';
								  			$result_string.='<option value="">- Select -</option>';
												foreach($mul_choice as $val_a1){
													$dftype='';
													if($val_a1['normal_value']){
														$dftype='1';
													}else{
														$dftype='';
													}
														
											  		if($lab_report_val[$vali++]['result']==$val_a1['mulname']){
											  			$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'" selected>'.$val_a1['mulname'].'</option>';
											  			}	
											  		$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'">'.$val_a1['mulname'].'</option>';	
													}  
												$result_string.='</select></td>';
										}elseif($lab_testing['result_type']=="posneg"){
											$result_string.='<td style="width:12%;"><span id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><input type="text" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';
										}
										

										$result_string.='<td style="width:8.6%;">'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
										if('numeric'==$lab_testing['result_type']){
											$result_string.='<td style="width:10.5%;">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';
										}else if('multichoice'==$lab_testing['result_type']){
											foreach ($normal_multext as $key => $value) {
												$mul.=",".$value;
											}
											$string = trim($mul,",");
											$result_string.='<td style="width:10.5%;">'.$string.'</td>';
											$mul="";
										}else{
											$result_string.='<td style="width:10.5%;">-<input type="hidden" name="REFERENCENAME[]" ></td>';
										}
											$result_string.='<td style="width:18%;">'.$lab_testing['method'].'</td>';
											$result_string.='<td style="width:20%;">'.$lab_testing['description'].'</td>';
											$result_string.='</tr></tbody></table>';
											$i++;
											$ia++;
								  	 }
								  }else{
								  	  
									$result_string.='<table class="table table-bordered algincss group" style="margin-bottom: -2px;">';
		    						$result_string.='<tbody>';
									$result_string.='<tr>';
									if(!empty($value['autoid'])){
									$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
											<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
											<input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
											<input type="hidden" name="mastergroupid[]" value='.$masvalue['mastergroupid'].'>
											<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
											<input type="hidden" name="LabTestgroup[]" value='.$value1['testgroupid'].'>
											<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'> 
											</td>';
										}else{
											  
											$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
													<input type="hidden" name="TESTNAME[]" value="" >
												<input type="hidden" name="LabTesting[]" value="">
											<input type="hidden" name="TESTNAMEID[]" value="">
											<input type="hidden" name="LABPAYMENTPRIME[]" value="">
											<input type="hidden" name="LABPAYMENTID[]" value="">
											<input type="hidden" name="LabTestgroup[]" value="">
											<input type="hidden" name="MRNUMBER[]" value=""> 
											<input type="hidden" name="mastergroupid[]" value="">
											</td>';
										}
										
									
										if($lab_testing['result_type']=="numeric"){  
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><input type="text" data-id="'.$ia.'" data-from="'.$lab_reference_val['ref_from'].'" data-to="'.$lab_reference_val['ref_to'].'" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';	
										}elseif($lab_testing['result_type']=="multichoice"){
											$result_string.='<td style="width:12%;"><span id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><select class="form-control result-val" data-id="'.$ia.'" id="result-val_'.$ia.'" name="RESULT[]" required>';
								  			$result_string.='<option value="">- Select -</option>';
												foreach($mul_choice as $val_a1){
													$dftype='';
													if($val_a1['normal_value']){
														$dftype='1';
													}else{
														$dftype='';
													}
														
											  		if($lab_report_val[$key1]['result']==$val_a1['mulname']){
											  			$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'" selected>'.$val_a1['mulname'].'</option>';
											  			}	
											  		$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'">'.$val_a1['mulname'].'</option>';	
													}  
												$result_string.='</select></td>';
										}elseif($lab_testing['result_type']=="posneg"){
											$result_string.='<td style="width:12%;"><span id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><input type="text" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';
										}
										

										$result_string.='<td style="width:8.6%;">'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
										if('numeric'==$lab_testing['result_type']){
											$result_string.='<td style="width:10.5%;">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';
										}else if('multichoice'==$lab_testing['result_type']){
											foreach ($normal_multext as $key => $value) {
												$mul.=",".$value;
											}
											$string = trim($mul,",");
											$result_string.='<td style="width:10.5%;">'.$string.'</td>';
											$mul="";
										}else{
											$result_string.='<td style="width:10.5%;">-<input type="hidden" name="REFERENCENAME[]" ></td>';
										  }
											$result_string.='<td style="width:18%;">'.$lab_testing['method'].'</td>';
											$result_string.='<td style="width:20%;">'.$lab_testing['description'].'</td>';
											$result_string.='</tr></tbody></table>';
											$i++;
											$ia++;
								  		  }
								   		}  
					  				  } 
					  			   }
  								 }  
					 		  
					 		$result_string.='<div style="   margin-top: 20px;">';
					 		if($split_group[0]=="TestGroup"){ 
					 		 $testgroupname=ArrayHelper::map(Testgroup::find()->where(['autoid'=>$value['lab_testgroup']])->asArray()->all(), 'autoid', 'testgroupname');
							 $lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$value['lab_testgroup']])->asArray()->all();
						   	if(!empty($lab_testgroup)){
								$result_string.='<table class="table table-bordered algincss" style="margin-bottom: -2px;background: #eaeaea; "><tr><td style="padding: 3px 10px;"><b>'.$testgroupname[$value['lab_testgroup']].'</b><td></tr></table>';
								$i=0; 
								foreach ($lab_testgroup as $key1 => $value1) 
								{ 
									$lab_testing=LabTesting::find()->where(['autoid'=>$value1['test_nameid']])->asArray()->one();
									$lab_unit=LabUnit::find()->where(['auto_id'=>$lab_testing['unit_id']])->asArray()->one();
									$lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$lab_testing['autoid']])->asArray()->one();
									
											if('Male'==$newpatient['pat_sex'])
											{
												$lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
												->andWhere(['or',['gender'=>"male"],['gender'=>"both"]])
												->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
												->asArray()->one();
											}
											if('Female'==$newpatient['pat_sex']){
											    $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
												->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
												->andWhere(['or',['gender'=>"female"],['gender'=>"both"]])
												->asArray()->one();
											}
									
											$ref_from=$lab_reference_val['days_from'];
											$ref_to=$lab_reference_val['days_from'];
																			
									$lab_report=LabReport::find()->asArray()->one();
									$lab_report_val=LabReport::find()->where(['lab_payment_id'=>$value['autoid']])->asArray()->all();
									
									
									$mul_choice=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->select(["autoid","mulname","normal_value"])->asArray()->all();
									$savetext=ArrayHelper::map($mul_choice, 'autoid', 'mulname');
									$lab_mul_val=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->andWhere(['normal_value'=>'1'])->select(['autoid','mulname'])->asArray()->all();
									$normal_multext=ArrayHelper::map($lab_mul_val, 'mulname', 'mulname');
								
									if($lab_testing['result_type']=="numeric"){
								  	 if(!empty($lab_reference_val)){
								  	 		$result_string.='<table class="table table-bordered algincss group" style="margin-bottom: -2px;">';
		    						$result_string.='<tbody>'; 
									$result_string.='<tr>';
										$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
											<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
											<input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
											<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
											<input type="hidden" name="LabTestgroup[]" value='.$value['lab_testgroup'].'>
											<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'> 
											</td>';
										if($lab_testing['result_type']=="numeric"){  
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><input type="text" data-id="'.$ia.'" data-from="'.$lab_reference_val['ref_from'].'" data-to="'.$lab_reference_val['ref_to'].'" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$i]['result'].' ></td>';	
										}elseif($lab_testing['result_type']=="multichoice"){
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><select class="form-control result-val" data-id="'.$ia.'" id="result-val'.$ia.'" name="RESULT[]" required>';
								  			$result_string.='<option value="">- Select -</option>';
												foreach($mul_choice as $val_a1){
												$dftype='';
													if($val_a1['normal_value']){
														$dftype='1';
													}else{
														$dftype='';
													}
														
											  		if($lab_report_val[$key1]['result']==$val_a1['mulname']){
											  			$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'" selected>'.$val_a1['mulname'].'</option>';
											  			}	
											  		$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'">'.$val_a1['mulname'].'</option>';	
													}  
												$result_string.='</select></td>';
										}elseif($lab_testing['result_type']=="posneg"){
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><input type="text" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';
										}
										
										$result_string.='<td style="width:8.6%;">'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
											if('numeric'==$lab_testing['result_type']){
											$result_string.='<td style="width:10.5%;">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';	
										}else if('multichoice'==$lab_testing['result_type']){
											foreach ($normal_multext as $key => $value) {
												$mul.=",".$value;
											}
											$string = trim($mul,",");
											$result_string.='<td style="width:10.5%;">'.$string.'</td>';
										$mul="";
										}else{
											$result_string.='<td style="width:10.5%;">-<input type="hidden" name="REFERENCENAME[]" ></td>';
										}
											$result_string.='<td style="width:18%;">'.$lab_testing['method'].'</td>';
											$result_string.='<td style="width:20%;">'.$lab_testing['description'].'</td>';
											$result_string.='</tr></tbody></table>';
											$i++;$ia++;	
								  	 	
								  	 	}
									}else{
											$result_string.='<table class="table table-bordered algincss group" style="margin-bottom: -2px;">';
		    						$result_string.='<tbody>'; 
									$result_string.='<tr>';
										$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
											<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
											<input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
											<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
											<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
											<input type="hidden" name="LabTestgroup[]" value='.$value['lab_testgroup'].'>
											<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'> 
											</td>';
										if($lab_testing['result_type']=="numeric"){  
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><input type="text" data-id="'.$ia.'" data-from="'.$lab_reference_val['ref_from'].'" data-to="'.$lab_reference_val['ref_to'].'" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$i]['result'].' ></td>';	
										}elseif($lab_testing['result_type']=="multichoice"){
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><select class="form-control result-val" data-id="'.$ia.'" id="result-val'.$ia.'" name="RESULT[]" required>';
								  			$result_string.='<option value="">- Select -</option>';
												foreach($mul_choice as $val_a1){
												$dftype='';
													if($val_a1['normal_value']){
														$dftype='1';
													}else{
														$dftype='';
													}
														
											  		if($lab_report_val[$key1]['result']==$val_a1['mulname']){
											  			$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'" selected>'.$val_a1['mulname'].'</option>';
											  			}	
											  		$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'">'.$val_a1['mulname'].'</option>';	
													}  
												$result_string.='</select></td>';
										}elseif($lab_testing['result_type']=="posneg"){
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' " id="col_'.$ia.'"></span><input type="text" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';
										}
										
										$result_string.='<td style="width:8.6%;">'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
											if('numeric'==$lab_testing['result_type']){
											$result_string.='<td style="width:10.5%;">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';	
										}else if('multichoice'==$lab_testing['result_type']){
											foreach ($normal_multext as $key => $value) {
												$mul.=",".$value;
											}
											$string = trim($mul,",");
											$result_string.='<td style="width:10.5%;">'.$string.'</td>';
										$mul="";
										}else{
											$result_string.='<td style="width:10.5%;">-<input type="hidden" name="REFERENCENAME[]" ></td>';
										}
											$result_string.='<td style="width:18%;">'.$lab_testing['method'].'</td>';
											$result_string.='<td style="width:20%;">'.$lab_testing['description'].'</td>';
											$result_string.='</tr></tbody></table>';
											$i++;$ia++;
										}
									 }  				 	       		
				 	       		   }
				 	       		 }
				 	       		 $result_string.="</div>";
				 	       		} //die;
				 	   	//$result_string.='<table class="table table-bordered algincss" style="margin-bottom: -2px;background: #eaeaea;"><tr><td style="padding: 3px 10px;"><b>Test </b><td></tr></table>';
						  foreach ($lab_payment as $key => $value)  
							{   
				    		$split_group=explode('_', $value['lab_common_id']); 
								if($split_group[0]=="LabTesting"){
 
							  		$lab_testing=LabTesting::find()->where(['autoid'=>$value['lab_testing']])->asArray()->all();
									
									if(!empty($lab_testing))
							  		{
							  			//$result_string.='<table class="table table-bordered algincss" style="margin-bottom: -2px;background: #eaeaea;"><tr><td style="padding: 3px 10px;"><b>Test </b><td></tr></table>';
							  	
							  			foreach ($lab_testing as $key1 => $value1) {
							  				$lab_testing=LabTesting::find()->where(['autoid'=>$value1['autoid']])->asArray()->one();
											$lab_unit=LabUnit::find()->where(['auto_id'=>$value1['unit_id']])->asArray()->one();
											$lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$value1['autoid']])->asArray()->one();
										
											if('Male'==$newpatient['pat_sex'])
											{
												$lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
												->andWhere(['or',['gender'=>"male"],['gender'=>"both"]])
												->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
												->asArray()->one();
											}
											if('Female'==$newpatient['pat_sex']){
											    $lab_reference_val=LabReferenceVal::find()->where(['IN','test_id',$lab_testing['autoid']])
												->andWhere(['and',['<=','days_from',$day_val],['>=','days_to',$day_val]])
												->andWhere(['or',['gender'=>"female"],['gender'=>"both"]])
												->asArray()->one();
											}
										
											$ref_from=$lab_reference_val['days_from'];
											$ref_to=$lab_reference_val['days_to'];
																			
											
											
											$lab_report_val=LabReport::find()->where(['lab_payment_id'=>$value['autoid']])->asArray()->all();
											$mul_choice=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->select(["autoid","mulname","normal_value"])->asArray()->all();
											$savetext=ArrayHelper::map($mul_choice, 'autoid', 'mulname');
											$lab_mul_val=LabMulChoice::find()->where(['test_id'=>$lab_testing['autoid']])->andWhere(['normal_value'=>'1'])->select(['autoid','mulname'])->asArray()->all();
											$normal_multext=ArrayHelper::map($lab_mul_val, 'mulname', 'mulname');
										if($lab_testing['result_type']=="numeric"){
										  	 if(!empty($lab_reference_val)){
										  	 		$result_string.='<table class="table table-bordered algincss" style="margin-bottom: -2px;" >';
				    						$result_string.='<tbody>';
											$result_string.='<tr>';
											$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
												<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
												<input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
												<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
												<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
												<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
												<input type="hidden" name="LabTestgroup[]" value='.$value['lab_testgroup'].'>
												<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'> 
											</td>';
											if($lab_testing['result_type']=="numeric"){  
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' "id="col_'.$ia.'"></span><input type="text" data-id="'.$ia.'" data-from="'.$lab_reference_val['ref_from'].'" data-to="'.$lab_reference_val['ref_to'].'" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';	
											}elseif($lab_testing['result_type']=="multichoice"){
												$result_string.='<td style="width:12%;"><span id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><select class="form-control result-val" data-id="'.$ia.'" id="result-val'.$ia.'" name="RESULT[]" required>';
												  	$result_string.='<option value="">- Select -</option>';
													foreach($mul_choice as $val_a1){
													$dftype='';
													if($val_a1['normal_value']){
														$dftype='1';
													}else{
														$dftype='';
													}
														
													  if($lab_report_val[$key1]['result']==$val_a1['mulname']){
													  	$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'" selected>'.$val_a1['mulname'].'</option>';
													  }	
													  $result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'">'.$val_a1['mulname'].'</option>';	
													}  
												$result_string.='</select></td>';
											}elseif($lab_testing['result_type']=="posneg"){
												$result_string.='<td style="width:12%;"><span "id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><input type="text" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';
											}
											
											$result_string.='<td style="width:8.6%;">'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
											
												if('numeric'==$lab_testing['result_type']){
													$result_string.='<td style="width:10.5%;">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';	
												}else if('multichoice'==$lab_testing['result_type']){
														foreach ($normal_multext as $key => $value) {
															$mul.=",".$value;
														}
														$string = trim($mul,",");
														$result_string.='<td style="width:10.5%;">'.$string.'</td>';
														$mul="";
												}else{
													$result_string.='<td style="width:10.5%;">-<input type="hidden" name="REFERENCENAME[]" ></td>';
											}
											$result_string.='<td style="width:18%;">'.$value1['method'].'</td>';
											$result_string.='<td style="width:20%;">'.$value1['description'].'</td>';
											$result_string.='</tr></tbody></table>';
											$i++;$ia++;
											 }
											}else{
													$result_string.='<table class="table table-bordered algincss" style="margin-bottom: -2px;" >';
				    						$result_string.='<tbody>';
											$result_string.='<tr>';
											$result_string.='<td style="width:18%;position:relative">'.$lab_testing['test_name'].'
												<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
												<input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
												<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
												<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
												<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
												<input type="hidden" name="LabTestgroup[]" value='.$value['lab_testgroup'].'>
												<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'> 
											</td>';
											if($lab_testing['result_type']=="numeric"){  
											$result_string.='<td style="width:12%;"><span class="btn alertmsg alertmsgcolor'.$ia.' "id="col_'.$ia.'"></span><input type="text" data-id="'.$ia.'" data-from="'.$lab_reference_val['ref_from'].'" data-to="'.$lab_reference_val['ref_to'].'" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';	
											}elseif($lab_testing['result_type']=="multichoice"){
												$result_string.='<td style="width:12%;"><span id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><select class="form-control result-val" data-id="'.$ia.'" id="result-val'.$ia.'" name="RESULT[]" required>';
												  	$result_string.='<option value="">- Select -</option>';
													foreach($mul_choice as $val_a1){
													$dftype='';
													if($val_a1['normal_value']){
														$dftype='1';
													}else{
														$dftype='';
													}
														
													  if($lab_report_val[$key1]['result']==$val_a1['mulname']){
													  	$result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'" selected>'.$val_a1['mulname'].'</option>';
													  }	
													  $result_string.='<option data-df="'.$dftype.'" value="'.$val_a1['mulname'].'">'.$val_a1['mulname'].'</option>';	
													}  
												$result_string.='</select></td>';
											}elseif($lab_testing['result_type']=="posneg"){
												$result_string.='<td style="width:12%;"><span "id="col_'.$ia.'" class="btn alertmsg alertmsgcolor'.$ia.' "></span><input type="text" class="form-control result-val" id="result-val'.$ia.'" name="RESULT[]" required value='.$lab_report_val[$key1]['result'].' ></td>';
											}
											
											$result_string.='<td style="width:8.6%;">'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
											
												if('numeric'==$lab_testing['result_type']){
													$result_string.='<td style="width:10.5%;">'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';	
												}else if('multichoice'==$lab_testing['result_type']){
														foreach ($normal_multext as $key => $value) {
															$mul.=",".$value;
														}
														$string = trim($mul,",");
														$result_string.='<td style="width:10.5%;">'.$string.'</td>';
														$mul="";
												}else{
													$result_string.='<td style="width:10.5%;">-<input type="hidden" name="REFERENCENAME[]" ></td>';
											}
											$result_string.='<td style="width:18%;">'.$value1['method'].'</td>';
											$result_string.='<td style="width:20%;">'.$value1['description'].'</td>';
											$result_string.='</tr></tbody></table>';
											$i++;$ia++;
											}
										}
									  }	
									}
							  	 } 
							  	
										 
			  echo $result_string;
		
		//echo"<pre>";print_r(); die;			
			} ?>
			
			
	</div>	
		 </div>  
		 
	<div class="comments">
		<div class="row"><div class="col-sm-6">
		<?php
			$result_string11.='<h4> Remarks </h4>';
			$result_string11.='<textarea rows="4" cols="50" name="TextArea">'.$lab_report_val[0]['textarea'].'</textarea>'; echo $result_string11; 	?>
			</div>
		<div class="col-sm-6">
		<?php
		if($lab_payment_prime_val['status']=='report'){  
			 $result_string1.=' <input class="btn btn-success" type="submit" name="Save_Group" style="float:right;position: relative;top: 90px;" value="Update"> ';
		}
		else{
			 $result_string1.=' <input class="btn btn-success" type="submit" name="Save_Group" style="float:right;position: relative;top: 90px;" value="Save"> ';
		}
			 echo $result_string1;
			 if($lab_payment_prime_val['status']=='report'){  ?>
			 	<a href="<?php echo Yii::$app->homeUrl .'?r=lab-payment-prime/print&id='. $model->lab_id ?>" class="btn btn-danger print-btn" target="_blank" Title="Print"> <span class="fa fa-print"></span> Print </a>
		<?php	 } ?>
			
	</div>	</div></div>		   
	
    <?php ActiveForm::end(); ?>

</div>
</div>
<script>

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