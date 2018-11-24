<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Transferstock;
use backend\models\Stockmaster;
use backend\models\Stockresponse;
use backend\models\CompanyBranch;
use backend\models\Transferstockapprove;
use backend\models\Unit;
use backend\models\Transferstockreceive;
$this->title="Receive Transfer Stock After Approved";
?>
<style>
	#load{
		display: none;
position: fixed;
left: 128px;
top: 27px;
width: 100%;
height: 100%;
z-index: 9999;
margin-top: 20%; 
	}
	
	input.error{
		background: rgb(251, 227, 228);
border: 1px solid #fbc2c4;
color: #8a1f11;

	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>


 <?php $form = ActiveForm::begin([
	 'id'=>'addform',
       
        'method' => 'post',
    ]); ?>
<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
	
	
   
  
    <div class="col-md-2">
			<label>Transfer Stock <br>Request Code</label>
   <?= $form->field($model, 'transferstock_requestcode')->textinput(['readonly'=>true,'value'=>$model1->transferstock_requestcode])->label(false); ?>
    </div>
    
    <div class="col-md-2">
			<label>Transfer Stock <br>Request Date</label>
   <?= $form->field($model1, 'transferstockdate')->textinput(['readonly'=>true,'value'=>date('d-m-Y',strtotime($model1->transferstockdate))])->label(false); ?>
    </div>
    <div class="col-md-2">
			<label>Receive <br>Date</label>
   <?= $form->field($model, 'approveddate')->textinput(['value'=>date('d-m-Y'),'class' => 'form-control datepicker3',  'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true])->label(false); ?>
    </div>
  
    <div class="col-md-2">
			<label>From <br>Branch </label><br>
			<?php $frombranchdata = CompanyBranch::find()->where(['branch_id'=>$model1->frombranch])->one();
			 echo $frombranchdata->branch_name;?>
			
   <?= $form->field($model, 'frombranch')->hiddeninput(['readonly'=>true,'value'=>$model1->frombranch,])->label(false); ?>
    </div>
    <div class="col-md-2">
			<label>To <br>Branch </label><br>
			<?php $tobranchdata = CompanyBranch::find()->where(['branch_id'=>$model1->tobranch])->one();
			 echo $tobranchdata->branch_name;?>
   <?= $form->field($model, 'tobranch')->hiddeninput(['readonly'=>true,'value'=>$model1->tobranch,])->label(false); ?>
    </div>
   
</div>

	
	 <div class="panel-body">
	 	 <div  style="white-space: nowrap;
  overflow-x: visible;
  overflow-y: hidden;

  width: 1040px; ">               
	 	
	
	 	<table  id="approvedgrid" class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>#</th>
            <th>Product Name</th> 
             <th> Request<br> Units</th>
               <th>Total <br>Request <br>Units</th>
               <th>Batch Number</th>
             <th>Manufacture <br>Date</th>
             <th>Purchase Date</th>
              <th>Expire Date(d-m-Y)</th>
                <th>Approved <br>Total Qty</th>
              <th>Received <br>Quantity</th>
              <th>Unit</th>
               <th>Total Units</th>
              <th>Price/Qty</th>
             <th>Purchase <br>Price</th>
             <th>Status <br>Received</th>
            
             
             </tr>
             </thead>
             <tbody>
             	<?php
             	$i=1;
		

				$data=	Transferstockapprove::find()->where(['transferstock_requestcode'=>$requestcode])->all();
				foreach ($data as $key => $value) {
				$modelz = Transferstock::find()->where(['transferstockid'=>$value->transferstockid])->one();
				$unitdata=Unit::find()->where(['unitid'=>$modelz->unit])->one();
				$modelxz=Transferstockapprove::find()->where(['transferstockid'=>$value->transferstockid])->one();
				$modelstock = Stockmaster::find()->where(['productid'=>$modelz->productid])->andwhere(['branch_id'=>$model1->tobranch])
				->one();
				$stockid=$modelstock->stockid;

				$approvedmodel=Transferstockapprove::find()->where(['transferstockid'=>$value->transferstockid])->andwhere(['batchnumber' =>$os->batchnumber])->one();
				
echo $form->field($model, 'transferstockapproveid[]')->hiddenInput(['id'=>'transferstockapproveid'.$i,'name'=>'transferstockapproveid'.$i,'value'=>$value->transferstockapproveid])->label(false).'</td>';			
                         $receivedata= Transferstockreceive::find()->where(['transferstockapproveid'=>$value->transferstockapproveid])->one();
						 if($receivedata)
						 {
						 	$receivedqty=$receivedata->receivedquantity;
							$receivedpriceperqty=$receivedata->priceperquantity;
							$price=$receivedata->pricepertransferstock;
							$status="Received";
							$totalqty=$receivedata->total_no_of_quantity;
						 }
						 else{
						 	$receivedqty=$value->approvedquantity;
							$receivedpriceperqty=$value->priceperquantity;
							$price=$value->pricepertransferstock;
							$totalqty=$value->totalapprovedquantity;
							$status="Not Received";
						 }
						 
						 
				echo'
				<tr>
					<td>'.$i.'</td>
					<td>'.$modelz->product_name.$form->field($model, 'transferstockid[]')->hiddenInput(['id'=>'transferstockid'.$i,'name'=>'transferstockid'.$i,
					'value'=>$modelz->transferstockid])->label(false).'</td>
				
					

					<td width="50px">'.$modelz->transferstockquantity."-".$unitdata->unitvalue.'</td>
						<td>'.$modelz->total_no_of_quantity.'</td>';

					echo '<td>'.$form->field($model, 'batchnumber[]')->textInput(['id'=>'batchnumber'.$i,'name'=>'batchnumber'.$i,'value'=>$value->batchnumber,'class'=>'form-control','readonly'=>'true', 'required'=>true])->label(false).'</td>';

					echo ' <td width="130px">'.$form->field($model, 'manufacturedate[]')->textInput(['id'=>'manufacturedate'.$i,
					'name'=>'manufacturedate'.$i,
					'class' => 'form-control datepicker3',
					'placeholder' => 'DD-MM-YYYY',
					'onkeypress'=>'return false',
					'bootstrap-datepicker data-date-autoclose' => "true",
					'data-required' => "true",

					'data-date-format' => "dd-mm-yyyy",
					'readonly'=>'true',
					'value'=>date("d-m-Y",strtotime($value->manufacturedate)),
					'required'=>true])->label(false).'</td>';

					echo ' <td width="130px">'.$form->field($model, 'purchasedate[]')->textInput(['id'=>'purchasedate'.$i,
					'name'=>'purchasedate'.$i,
					'class' => 'form-control datepicker3',
					'placeholder' => 'DD-MM-YYYY',
					'onkeypress'=>'return false',
					'bootstrap-datepicker data-date-autoclose' => "true",
					'data-required' => "true",

					'data-date-format' => "dd-mm-yyyy",
					'readonly'=>'true',
					'value'=>date("d-m-Y",strtotime($value->purchasedate)),
					'required'=>true])->label(false).'</td>';
					
					
					
					
					
					
					

					echo  '<td width="130px">'.$form->field($model, 'expiredate[]')->textInput(['id'=>'expiredate'.$i,
					'name'=>'expiredate'.$i,
					'class' => 'form-control datepicker3',
					'placeholder' => 'DD-MM-YYYY',
					'onkeypress'=>'return false',

					'data-required' => "true",
					'readonly'=>'true',
					'value'=>date("d-m-Y",strtotime($value->expiredate)),
					'required'=>true])->label(false).'</td> ';
					 echo '<td width="50px">'.$totalqty.'</td>';

					echo ' <td width="50px">'.$form->field($model, 'approvedquantity[]')->textInput([
					'id'=>'approvedquantity'.$i,
					'name'=>'approvedquantity'.$i,
					'placeholder'=>' Qty',
					'class' => 'form-control approvedqty',
					'dataincrement'=>$i,
					'value'=>$receivedqty,
					
					'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false).'</td>';
					
					echo '<td>'.$unitdata->unitvalue.$form->field($model, 'unit[]')->hiddenInput(['id'=>'unit'.$i,'name'=>'unit'.$i,
					'value'=>$modelz->unit])->label(false).'</td>';
					
					
					echo ' <td width="50px">'.$form->field($model, 'updated_ipaddress[]')->textInput([
					'id'=>'totalunits'.$i,
					'name'=>'totalunits'.$i,
					'dataincrement'=>$i,
					'placeholder'=>'Total Qty',
					'class'=>'form-control',
					'readonly'=>'true',
					'onkeypress'=>'return isNumber(event)',
					'required'=>true,
					'value'=>$totalqty])->label(false).'</td>';?>
					
			<input type="hidden" name="unitquantity<?php echo $i;?>" id="unitquantity<?php echo $i;?>" value="<?php echo $unitdata->no_of_unit;?>" />
				<input type="hidden"  name="totalstock[]" id="totalstock<?php echo $i;?>" value="<?php echo $totalqty;?>" />	
					

				<?php	echo ' <td width="50px">'.$form->field($model, 'updated_ipaddress[]')->textInput([
					'id'=>'priceperquantity'.$i,
					'name'=>'priceperquantity'.$i,
					'dataincrement'=>$i,
					'placeholder'=>' Qty',
					'class'=>'form-control priceperqty',
					'onkeypress'=>'return isNumber(event)',
					'required'=>true,
					'value'=>$receivedpriceperqty])->label(false).'</td>';

					echo '<td>'.$form->field($model, 'pricepertransferstock[]')->textInput([
					'id'=>'totalprice'.$i,
					'class' => 'form-control ',
					'name'=>'purchaseprice'.$i,
					'placeholder'=>'Price',
					'readonly'=>true,
					'value'=>$price,

					'required'=>true])->label(false).'</td>';
					
					echo '<td>'.$form->field($model, 'status')->dropDownList(['Received' => 'Received', 'Un Received' => 'UnReceived'],['prompt'=>'--Status--','name'=>'status'.$i,'dataincrement'=>$i,'required'=>true])->label(false).'</td>';
					echo'
				</tr>';
				$i++;
				}
             ?>
             	</tbody>
                </table>
                 <div class="form-group pull-right" >
        <?= Html::Button('Update', ['class' => 'btn btn-default waves-effect waves-light update_req',]) ?>
    
    </div>
    </div>
      </div>
        <?php ActiveForm::end(); ?>
		</div>
		</div>
		</div>
</div>
   <script type="text/javascript">
   $('body').on("click",'.update_req',function(){
   	
   	$form_container=$("#addform");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
   var rowCount = $('#approvedgrid tr').length-1;
   	var k=0;
  for(var i=0;i<=rowCount;i++)
  {
  	 	var totalstock=parseInt($("#totalstock" + i).val());
  	 	 var uq_1=$("#totalunits" + i).val();
          if(uq_1 > totalstock)
          {
          	var k=1;
          }
  }
   if(k==0)
   {
   	$form_container.submit();
   }   	
   else{
   alert("Check Received Quantity units is greater than Approved Quantity");
   }
   }
   });
    

	
          $(document).on('change keyup click', '.approvedqty', function ()
      {
  	    
           var inc=$(this).attr('dataincrement');
          var rq=$("#approvedquantity" + inc).val();
          var uq=$("#unitquantity" + inc).val();
          var tu=rq*uq;
          $("#totalunits" + inc).val(tu);
           var rq_1=$("#priceperquantity" + inc).val();
          
          var uq_1=$("#totalunits" + inc).val();
          var tu_1=rq_1*uq_1;
          tu_2= tu_1.toFixed(2);
          $("#totalprice" + inc).val(tu_2);
          var totalstock=parseInt($("#totalstock" + inc).val());
          if(uq_1>totalstock)
          {
          	alert("Check approved Quantity units is greater than Stock");
          }
          
          
          
          
     });
        
        
        $(document).on('change keyup click', '.priceperqty', function ()
      {
  	      var inc=$(this).attr('dataincrement');
          var rq=$("#priceperquantity" + inc).val();
          var uq=$("#totalunits" + inc).val();
          var tu=rq*uq;
          
          $("#totalprice" + inc).val(tu).toFixed(2);
     });
		</script>	