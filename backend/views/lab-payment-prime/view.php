<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\LabTesting; 

/* @var $this yii\web\View */
/* @var $model backend\models\LabPaymentPrime */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lab Payment Primes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo"<pre>"; print_r($model); die;
?>
<style>

</style>
<div class="lab-payment-prime-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->lab_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->lab_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

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
            // 'overall_item',
            // 'overall_gst_per',
            // 'overall_cgst_per',
            // 'overall_sgst_per',
            // 'overall_gst_amt',
            // 'overall_cgst_amt',
            // 'overall_sgst_amt',
            // 'overall_dis_type',
            // 'overall_dis_percent',
            // 'overall_dis_amt',
            // 'overall_sub_total',
            // 'overall_net_amt',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            // 'updated_ipaddress',
        ],
    ]) ?>

 <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr><td>S.No</td>
    			<td>Investications</td>
    			<td>RATE</td>
    			<td>GST(%)</td>
    			<td>GST(AMT)</td>
    			<td>Discount<br>(%)</td>
    			<td>Discount <br>(AMT)</td>
    			<td>Total</td>
    		</tr>
    	</thead>
    	<tbody>
    		<?php  			//print_r($labpayment_list);   
	if(!empty($labpayment_list)){  $i=1;
		foreach($labpayment_list as $val){
			$split_group=explode('_', $val['lab_test_name']);
			
			if($split_group[0]=="LabTesting"){
				$labtest_list=LabTesting::find()->where(['isactive'=>1])->andWhere(['autoid'=>$val['lab_common_id']])->asArray()->one();
			
			}else{
				$labtest_list=LabTesting::find()->where(['isactive'=>1])->andWhere(['autoid'=>$val['lab_testing']])->asArray()->one();
			}
			
		//echo"<pre>"; print_r($val); die;
			 $tot_rate+=$val['price'];
			 $tot_gstpre+=$val['gst_percentage'];
			 $tot_gstval+=$val['gst_amount'];
			 $tot_discount_percent+=$val['discount_percent'];
			 $tot_discount_val+=$val['discount_amount'];
			 $total_price+=$val['net_amount'];
	?>
	<tr><td><?php echo $i++; ?></td>
				<td><?php echo $labtest_list['test_name']; ?></td>
				<td><?php echo $val['price']; ?></td>
				<td><?php echo $val['gst_percentage']; ?></td>
				<td><?php echo $val['gst_amount']; ?></td>
				<td><?php if($val['discount_percent']!=0){echo $val['discount_percent'];}else{echo"-";} ?></td>
				<td><?php if($val['discount_amount']!=0){echo $val['discount_amount'];}else{echo"-";} ?></td>
				<td style="text-align:right"><?php if($val['net_amount']!=0){echo $val['net_amount'];}else{echo"0";} ?></td>
    			<!-- <td style="text-align:right"><?php echo $val['total_amount']; ?></td> -->
    				
	</tr>	
<?php } ?>
	<tr class="total"><td></td>
		<td> Total</td>
		<td><?php echo $tot_rate; ?></td>
		<td><?php echo $tot_gstpre; ?></td><td><?php echo $tot_gstval; ?></td>		<td><?php echo $tot_discount_percent; ?></td><td><?php echo $tot_discount_val; ?></td><td><?php echo $total_price; ?></td>	
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
