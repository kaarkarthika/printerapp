<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\LabTesting;
use backend\models\Testgroup;
use backend\models\LabTestgroup; 
use backend\models\LabUnit;
use backend\models\LabReferenceVal; 
/* @var $this yii\web\View */
/* @var $model backend\models\LabPayment */
/* @var $form yii\widgets\ActiveForm */
 Html::encode($this->title) ;
?>

<style>
table.table.algincss thead tr th {
    width: 14%;
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
<div class="panel-body" style="min-height:600px;" >
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
	
	 <br/><br/>
	 <table class="table table-bordered">
    <thead>
      <tr>
        <th>MR Number</th>
        <th>Patient Name</th>
        <th>Age</th>
        <th>Pat Sex</th>
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




<div id='group_lab_fetch1'>		
	<?php
if(!empty($lab_payment))
			{
				$result_string='';
				
				foreach ($lab_payment as $key => $value) 
				{
					$lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$value['lab_testgroup']])->asArray()->all();
					if(!empty($lab_testgroup))
					{  ?>
<div id='group_lab_fetch'>
	<span> Grouping </span> 
	<?php
						foreach ($lab_testgroup as $key1 => $value1) 
						{
							$lab_testing=LabTesting::find()->where(['autoid'=>$value1['test_nameid']])->asArray()->one();
							$lab_unit=LabUnit::find()->where(['auto_id'=>$lab_testing['unit_id']])->asArray()->one();
							$lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$lab_testing['autoid']])->asArray()->one();
							$result_string.='<table class="table table-bordered algincss"><thead><tr><th>Test Name</th><th>Result</th><th>Units</th><th>Method</th><th>Normal Values</th><th>Description</th></tr></thead>';
    						$result_string.='<tbody>';
							$result_string.='<tr>';
							$result_string.='<td>'.$lab_testing['test_name'].'<input type="hidden" name="TESTNAME[]" value='.$lab_testing['test_name'].' >
								<input type="hidden" name="LabTesting[]" value='.$value['lab_testing'].'>
							<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
							<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
							<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
							<input type="hidden" name="LabTestgroup[]" value='.$value['lab_testgroup'].'>
						
							
							<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'>
							
							</td>';
							$result_string.='<td><input type="text" class="form-control" name="RESULT[]" required></td>';
							$result_string.='<td>'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
							$result_string.='<td></td>';
							$result_string.='<td>'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';
							$result_string.='<td></td>';
							$result_string.='</tr></tbody></table>';
						}
						
						
					}
					
				} ?> <?
			// $result_string.='<div class="row"><div class="col-sm-6"><textarea rows="4" cols="50" name="TextArea"></textarea></div>';
			 // $result_string.='<div class="col-sm-6"><input class="btn btn-success" type="submit" name="Save_Group" style="float:right;position: relative;top: 60px;" value="Save Grouping"></div></div>';
			  echo $result_string;
					
			} ?>
			</div></div>
			<div class="testing-list1">
				
			<?php
if(!empty($lab_payment))
			{ ?>
				<div class="testing-list">
				<span> Test List </span>
				<?
				$result_string='';
			
				foreach ($lab_payment as $key => $value) 
				{  
					$lab_testing=LabTesting::find()->where(['autoid'=>$value['lab_testing']])->asArray()->all();
				
					if(!empty($lab_testing))
					{ 
						
						foreach ($lab_testing as $key1 => $value1) 
						{
							$lab_testing=LabTesting::find()->where(['autoid'=>$value1['autoid']])->asArray()->one();
							$lab_unit=LabUnit::find()->where(['auto_id'=>$value1['unit_id']])->asArray()->one();
							$lab_reference_val=LabReferenceVal::find()->where(['test_id'=>$value1['autoid']])->asArray()->one();
							$result_string.='<table class="table table-bordered algincss"><thead><tr><th>Test Name</th><th>Result</th><th>Units</th><th>Method</th><th>Normal Values</th><th>Description</th></tr></thead>';
    						$result_string.='<tbody>';
							$result_string.='<tr>';
							$result_string.='<td>'.$value1['test_name'].'<input type="hidden" name="TESTNAME[]" value='.$value1['test_name'].' >
								<input type="hidden" name="LabTesting[]" value='.$value1['lab_testing'].'>
							<input type="hidden" name="TESTNAMEID[]" value='.$value['lab_prime_id'].'>
							<input type="hidden" name="LABPAYMENTPRIME[]" value='.$value['lab_prime_id'].'>
							<input type="hidden" name="LABPAYMENTID[]" value='.$value['autoid'].'>
							<input type="hidden" name="LabTestgroup[]" value='.$value['lab_testgroup'].'>
						
							
							<input type="hidden" name="MRNUMBER[]" value='.$value['mr_number'].'>
							
							</td>';
							$result_string.='<td><input type="text" class="form-control" name="RESULT[]" required></td>';
							$result_string.='<td>'.$lab_unit['unit_name'].'<input type="hidden" name="UNITNAME[]" value='.$lab_unit['unit_name'].'></td>';
							$result_string.='<td></td>';
							$result_string.='<td>'.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'<input type="hidden" name="REFERENCENAME[]" value='.$lab_reference_val['ref_from'].'-'.$lab_reference_val['ref_to'].'></td>';
							$result_string.='<td></td>';
							$result_string.='</tr></tbody></table>';
						}
						
						
					}
					
				}
			//$result_string.='<div class="row"><div class="col-sm-6"><textarea rows="4" cols="50" name="TextArea"></textarea></div>';
			// $result_string.='<div class="col-sm-6"><input class="btn btn-success" type="submit" name="Save_Group" style="float:right;position: relative;top: 60px;" value="Save"></div></div>';
			 echo $result_string;
					
			} ?>
	</div>		   
	<div class="comments">
		<?php
		$result_string1.='<div class="row"><div class="col-sm-6"><textarea rows="4" cols="50" name="TextArea"></textarea></div>';
			 $result_string1.='<div class="col-sm-6"><input class="btn btn-success" type="submit" name="Save_Group" style="float:right;position: relative;top: 60px;" value="Save"><input class="btn btn-primary" type="button" name="print" style="float:right;position: relative;top: 60px;    right: 7px;" value="Print"></div></div>';
			 echo $result_string1;
			?>
	</div>			   
	
    <?php ActiveForm::end(); ?>

</div>
</div>
 <!-- <script>

 $(document).ready(function(){
 	alert($(this).attr('data_id'));
 	//	var id=$(this).attr('data_id');
    //	var setid=$(this).attr('set_id');
    	var id=1;
    	var setid=1;
    
    	if(id != '')
    	{
    		$.ajax({
						
				   type: "POST",
				   url: "<?php echo Yii::$app->homeUrl . "?r=lab-payment-prime/grouppack&id="?>"+id+"&setid="+setid,          
				   success: function (result) 
				   {
				     	$('#group_lab_fetch').html(result);
				   }
				  });
    	}
    	
	
 });
	

</script> -->