<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\LabTesting; 
use backend\models\Testgroup;
use backend\models\LabPayment;
use backend\models\MainTestgroup;
use backend\models\LabAddgroup;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo"<pre>"; print_r($model); die;
?>
<style>

</style>
<div class="lab-payment-prime-view">

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'lab_id',
            //'payment_status',
            'mr_number',
            'name',
            'ph_number',
             ['attribute' => 'dr_name', 
            	'label' => ' Physician Name',
           
            ],
            //'insurance',
            [	'attribute' => 'insurance', 
             	'label' => 'Insurance',
       	  	'value' => function($model)
       	  	{
                if($model->insurance != '')
				{
					return $model->insurance;	
				}else{
					return "-";
				}
				
		   }],
           // 'dob',
            ['attribute' => 'dob', 
             	'label' => 'Date of Birth',
       	  	'value' => function($model)
       	  	{
                if($model->created_at != '')
				{
					return date('d-m-Y',strtotime($model->dob));	
				}
				
		   }],
          
        ],
    ]) ?>

 <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr>
    			<td>S.No</td>
    			<td>Investications</td>
    			<td>RATE</td>
    			<td>GST(%)</td>
    			<td>GST(AMT)</td>
    			<!--  <td>Discount<br>(%)</td>
    			<td>Discount <br>(AMT)</td> -->
    			<td>Total</td>
    		</tr>
    	</thead>
    	<tbody>
    		<?php    
	if(!empty($labpayment_list)){  $i=1;
		foreach($labpayment_list as $val){
			
			$split_group=explode('_', $val['lab_test_name']);
			
			if("LabTesting"==$split_group[0]){
				$labtest_list=LabTesting::find()->where(['isactive'=>1])->andWhere(['autoid'=>$val['lab_common_id']])->asArray()->one();
				
			?>
			<tr><td><?php echo $i++; ?></td>
				<td><?php echo $labtest_list['test_name']; ?></td>
				<td style="text-align:right"><?php echo $labtest_list['price']; ?></td>
				<td><?php echo $val['gst_percentage']; ?></td>
				<td><?php echo $val['gst_amount']; ?></td>
				<!-- <td><?php if($val['discount_percent']!=0){echo $val['discount_percent'];}else{echo"-";} ?></td>
				<td><?php if($val['discount_amount']!=0){echo $val['discount_amount'];}else{echo"-";} ?></td> -->
				<td style="text-align:right"><?php if($labtest_list['price']!=0){echo $labtest_list['price'];}else{echo"0";} ?></td>
			<?php	
						  	$tot_rate+=$labtest_list['price'];
				$total_price+=$labtest_list['price'];
			
			}	
			if($split_group[0]=="TestGroup"){
				
			  $labtest_list=Testgroup::find()->where(['autoid'=>$val['lab_testgroup']])->asArray()->one();
			  
			  ?>
			  	<tr><td><?php echo $i++; ?></td>
				<td><?php echo $labtest_list['testgroupname']; ?></td>
				<td style="text-align:right"><?php echo $labtest_list['price']; ?></td>
				<td><?php echo $val['gst_percentage']; ?></td>
				<td><?php echo $val['gst_amount']; ?></td>
				<!-- <td><?php if($val['discount_percent']!=0){echo $val['discount_percent'];}else{echo"-";} ?></td>
				<td><?php if($val['discount_amount']!=0){echo $val['discount_amount'];}else{echo"-";} ?></td> -->
				<td style="text-align:right"><?php if($labtest_list['price']!=0){echo $labtest_list['price'];}else{echo"0";} ?></td>
			  <?php
			    	$tot_rate+=$labtest_list['price'];
				$total_price+=$labtest_list['price'];
			  
			}
			if($split_group[0]=="MasterGroup"){
			
			 //$lab_list=LabPayment::find()->where(['lab_prime_id'=>$id])->andWhere(['lab_test_name'=>"MasterGroup"])->groupBy(['lab_common_id'])->asArray()->one();
			 $mastergroupname=ArrayHelper::map(MainTestgroup::find()->where(['autoid'=>$val['lab_common_id']])->asArray()->all(), 'autoid', 'testgroupname');
			 $testgroup_list=LabAddgroup::find()->where(['mastergroupid'=>$val['lab_common_id']])->andWhere(['testgroupid'=>$val['lab_testgroup']])->asArray()->all();
			 foreach ($testgroup_list as $key => $value) {
			 	 $testgroup_name=Testgroup::find()->select(['testgroupname'])->where(['autoid'=>$value['testgroupid']])->asArray()->one();
						
					?>
			  	<tr><td><?php echo $i++; ?></td>
				<td><?php echo $testgroup_name['testgroupname']; ?></td>
				<td style="text-align:right"><?php echo $value['price']; ?></td>
				<td><?php echo $val['gst_percentage']; ?></td>
				<td><?php echo $val['gst_amount']; ?></td>
				<!--  <td><?php if($val['discount_percent']!=0){echo $val['discount_percent'];}else{echo"-";} ?></td>
				<td><?php if($val['discount_amount']!=0){echo $val['discount_amount'];}else{echo"-";} ?></td> -->
				<td style="text-align:right"><?php if($value['price']!=0){echo $value['price'];}else{echo"0";} ?></td>
			  <?php
			  	$tot_rate+=$value['price'];
				$total_price+=$value['price'];
			  		
			  } 
			}
			
				 //$tot_rate+=$val['price'];
			 $tot_gstpre+=$val['gst_percentage'];
			 $tot_gstval+=$val['gst_amount'];
			 //$tot_discount_percent+=$val['discount_percent'];
			 //$tot_discount_val+=$val['discount_amount'];
			// $total_price+=$val['net_amount'];
			 //echo"<pre>";print_r($val['net_amount']);
	?>
					
	</tr>	
<?php } ?>
	<tr class="total"><td></td>
		<td> Total</td>
		<td style="text-align:right"><?php echo round($tot_rate); ?></td>
		<td><?php echo round($tot_gstpre); ?></td><td><?php echo round($tot_gstval); ?></td>
		<!-- <td><?php echo $tot_discount_percent; ?></td><td><?php echo $tot_discount_val; ?></td> -->
		<td style="text-align:right"><?php echo round($total_price); ?></td>	
	</tr>		
<? }else{ ?>
	<tr><td>No Records</td></tr>
<?php } ?>
   </tbody>
	</table>
</div>
<style>
table.table.table-striped.table-bordered.detail-view thead td {
    background: #ff7272;
    color: #fff;
}
tr.total td {
    color: green;
    background: #ececec;
    font-weight: bold;
}
</style>
