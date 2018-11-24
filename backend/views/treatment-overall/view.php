

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Treatment;

/* @var $this yii\web\View */
/* @var $model backend\models\TreatmentOverall */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Treatment Overalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//echo"<pre>"; print_r($model->dob); 
$date=date_create($model->dob);

?>
<style>
	table.table.table-striped.table-bordered.detail-view thead td {
    	background: #4682b4;
    	color: #fff;
	}
	div#operationalmodal .modal-dialog.modal-md {
    width: 715px;
}
tr.total td {
    color: green;
    background: #ececec;    font-weight: bold;
}
</style>
<div class="treatment-overall-view">

 <!--  <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'refund_status',
            'name',
          //  'dob',
            
            ['attribute' => 'dob', 
             	'label' => 'Date of Birth',
       	  	'value' => function($model)
       	  	{
                if($model->created_at != '')
				{
					return date('d-m-Y',strtotime($model->dob));	
				}
				
		   }],
			
            //'physicianname',
            //'mrnumber',
            ['attribute' => 'dr_name', 
            	'label' => ' Physician Name',
            ],
            ['attribute' => 'mrnumber', 
            	'label' => 'MR Number',
            ],
           // 'patient_id',
           // 'subvisit_id',
            ['attribute' => 'subvisit_num', 
            	'label' => 'Subvisit Number',
            ],
            ['attribute' => 'insurance_type', 
            	'label' => 'Insurance Type',
            ],
            'address',
            ['attribute' => 'phonenumber', 
            	'label' => 'Phone Number',
            ],
            ['attribute' => 'billnumber', 
            	'label' => 'Bill Number',
            ],
            [	'attribute' => 'invoicedate', 
             	'label' => 'Invoice Date',
       	  	'value' => function($model)
       	  	{
                if($model->created_at != '')
				{
					return date('d-m-Y H:i:s',strtotime($model->invoicedate));	
				}
				
		   }],
         /*   'total',
            'tot_no_of_items',
            'tot_quantity',
            'total_gst_percent',
            'total_cgst_percent',
            'total_sgst_percent',
            'totalgstvalue',
            'totalcgstvalue',
            'totalsgstvalue',*/
           // 'totaldiscountvalue',
           // 'totaltaxableamount',
           // 'overalldiscounttype',
           // 'overalldiscountpercent',
           // 'overalldiscountamount',
         /*   'overall_sub_total',
            'overalltotal',
            // 'user_id',
            // 'user_role',
            // 'created_at',
            // 'updated_at',
            // 'ipaddress', */
        ],
    ]) ?>
    <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr><td>S.No</td>
    			<td>PROCEDURE NAME</td>
    			<td>RATE</td>
    			<td>QTY</td>
    			<td>GST(%)</td>
    			<td>GST(AMT)</td>
    			<td>Discount<br>(%)</td>
    			<td>Discount <br>(AMT)</td>
    			<td>Total</td>
    		</tr>
    	</thead>
    	<tbody>
<?php //echo"<pre>";//print_r($treatment_list); die;
if(!empty($treatment_list)){  $i=1;
	foreach($treatment_list as $val){
		$treatment_list=Treatment::find()->where(['is_active'=>1])->andWhere(['id'=>$val['treatment_id']])->asArray()->one();
		$tot_rate+=$val['rate'];
		$tot_qty+=$val['qty'];
		$tot_gstpre+=$val['gstpercent'];
		$tot_gstval+=$val['gstvalue'];
		$tot_discount_percent+=$val['discount_percent'];
		$tot_discount_val+=$val['discountvalue'];
		$total_price+=$val['total_price'];
	?>
	<tr><td><?php echo $i++; ?></td>
				<td><?php echo $treatment_list['treatment_name']; ?></td>
				<td><?php echo $val['rate']; ?></td>
				<td><?php echo $val['qty']; ?></td>
				<td><?php echo $val['gstpercent']; ?></td>
				<td><?php echo $val['gstvalue']; ?></td>
				<td><?php if($val['discount_percent']!=0){echo $val['discount_percent'];}else{echo"-";} ?></td>
				<td><?php if($val['discountvalue']!=0){echo $val['discountvalue'];}else{echo"-";} ?></td>
    			<td style="text-align:right"><?php echo $val['total_price']; ?></td>
    				
	</tr>	
<?php } ?>
	<tr class="total"><td></td>
		<td> Total</td>
		<td><?php echo $tot_rate; ?></td><td><?php echo $tot_qty; ?></td><td><?php echo $tot_gstpre; ?></td><td><?php echo $tot_gstval; ?></td>		<td><?php echo $tot_discount_percent; ?></td><td><?php echo $tot_discount_val; ?></td><td><?php echo $total_price; ?></td>	
	</tr>		
<? }else{ ?>
	<tr><td>No Records</td></tr>
<?php } ?>
   </tbody>
	</table>
</div>
