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
use backend\models\Transferstockreturn;
$this -> title = "Return Transfer Stock After Received";
?>
<style>
	#load {
		display: none;
		position: fixed;
		left: 128px;
		top: 27px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		margin-top: 20%
	}
	input.error {
		background: #fbe3e4;
		border: 1px solid #fbc2c4;
		color: #8a1f11
	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this -> title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app -> request -> BaseUrl; ?>">Home</a></li>
 <li><a href="#"><?php echo $this -> title; ?></a></li>
</ol>
</div>
</div>
 <?php $form = ActiveForm::begin(['id' => 'addform', 'method' => 'post']); ?>
<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
</div>
<div class="panel-body">
	           
	<table class="table table-striped">
		<thead><tr>
			<th>Vendor</th><th>Request Code</th><th>Return Date</th><th>From Branch</th><th>To Branch</th>
		</tr></thead>
		
		<tr>
			<td> <?= $form -> field($model, 'transferstock_requestcode') -> textinput(['readonly' => true, 'value' => $model -> transferstock_requestcode]) -> label(false); ?></td>
			<td> <?php echo date("d/m/Y"); ?></td>
			<td><?php $frombranchdata = CompanyBranch::find() -> where(['branch_id' => $model1 -> frombranch]) -> one();
				echo $frombranchdata -> branch_name;
				echo $form -> field($model, 'frombranch') -> hiddeninput(['readonly' => true, 'value' => $model1 -> frombranch, ]) -> label(false);
 ?></td>
	          <td><?php $tobranchdata = CompanyBranch::find() -> where(['branch_id' => $model1 -> tobranch]) -> one();
				echo $tobranchdata -> branch_name;
				echo $form -> field($model, 'tobranch') -> hiddeninput(['readonly' => true, 'value' => $model1 -> tobranch, ]) -> label(false);
 ?></td></tr>
		
	</table>
	<div  style="white-space: nowrap; overflow-x: visible;overflow-y: hidden;width: 1040px;">   
	 	<table  class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>#</th>
             <th>Product Name</th>
             <th>Received Quantity</th>
             <th>Batch Number</th>
             <th>Manufacture Date</th>
             <th>Purchase Date</th>
             <th>Expire Date (d-m-Y)</th>
             <th>Return Quantity</th>
             <th>Unit</th>
               <th> Total Unit</th>
             <th>Price/Qty</th>
             <th>Purchase Price</th>
             <th>Status Returned</th>
            </tr>
             </thead>
             <tbody>
             	<?php
             	$i=1;
				$data=	Transferstockreceive::find()->where(['transferstock_requestcode'=>$requestcode])->all();
				foreach ($data as $key => $value) {
				$modelz = Transferstock::find()->where(['transferstockid'=>$value->transferstockid])->one();
				$unitdata=Unit::find()->where(['unitid'=>$modelz->unit])->one();
				$modelxz=Transferstockreceive::find()->where(['transferstockid'=>$value->transferstockid])->one();
				$modelstock = Stockmaster::find()->where(['productid'=>$modelz->productid])->andwhere(['branch_id'=>$model1->tobranch])
				->one();
				
	echo $form->field($model, 'transferstockreceiveid[]')->hiddenInput(['id'=>'transferstockreceiveid'.$i,'name'=>'transferstockreceiveid'.$i,'value'=>$value->transferstockreceiveid])->label(false).'</td>';			
                         $receivedata= Transferstockreturn::find()->where(['transferstockreceiveid'=>$value->transferstockreceiveid])->one();
						 if($receivedata)
						 {
						 	$returnqty=$receivedata->returnquantity;
							$receivedpriceperqty=$receivedata->priceperquantity;
							$price=$receivedata->pricepertransferstock;
							$status="Returned";
							$totalunit=$receivedata->total_no_of_quantity;
						 }
						 else{
						 	$returnqty=0;
							$receivedpriceperqty=$value->priceperquantity;
							$price=0;
							$status="Not Returned";
							$totalunit=0;
						 }
						 
						 
				echo'
				<tr>
					<td>'.$i.'</td>
					<td>'.$modelz->product_name.$form->field($model, 'transferstockid[]')->hiddenInput(['id'=>'transferstockid'.$i,'name'=>'transferstockid'.$i,
					'value'=>$modelz->transferstockid])->label(false).'</td>

					<td width="50px">'.$value->receivedquantity."-".$unitdata->unitvalue.'</td>';

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

					echo ' <td width="50px">'.$form->field($model, 'returnquantity[]')->textInput([
					'id'=>'returnquantity'.$i,
					'name'=>'returnquantity'.$i,
					'placeholder'=>' Qty',
					'class' => 'form-control returnqty',
					'dataincrement'=>$i,
					
					'value'=>$returnqty,
					
					'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false).'</td>';
					
					echo '<td>'.$unitdata->unitvalue.$form->field($model, 'unit[]')->hiddenInput(['id'=>'unit'.$i,'name'=>'unit'.$i,
					'value'=>$modelz->unit])->label(false).'</td>';?>
					
					<input type="hidden" name="unitquantity<?php echo $i;?>" id="unitquantity<?php echo $i;?>" value="<?php echo $unitdata->no_of_unit;?>" />
					
				<?php	echo '<td>'.$form->field($model, 'total_no_of_quantity[]')->textInput([
					'id'=>'totalunits'.$i,
					'dataincrement'=>$i,
					'class' => 'form-control ',
					'name'=>'totalunits'.$i,
					'placeholder'=>'Total Units',
					'readonly'=>true,
					'value'=>$totalunit,
					'required'=>true])->label(false).'</td>';
					

					echo ' <td width="50px">'.$form->field($model, 'updated_ipaddress[]')->textInput([
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
					
					echo "<td>".$status."</td>";
					echo'
				</tr>';
					$i++;

					}
             ?>
             	</tbody>
                </table>
                 <div class="form-group pull-right" >
        <?= Html::Button('Update', ['class' => 'btn btn-default waves-effect waves-light update_req', ]) ?>
    
    </div>
    </div>
      </div>
        <?php ActiveForm::end(); ?>
		</div>
		</div>
		</div>
</div>  
  
   <script type="text/javascript">
	$('body').on("click", '.update_req', function() {

		$form_container = $("#addform");
		$form_container.validate().settings.ignore = ":disabled,:hidden";
		var chkform = $form_container.valid();
		if (chkform == true) {
			$form_container.submit();
		}
	});
	
	
	
          $(document).on('change keyup click', '.returnqty', function ()
      {
  	    
           var inc=$(this).attr('dataincrement');
          var rq=$("#returnquantity" + inc).val();
          var uq=$("#unitquantity" + inc).val();
          var tu=rq*uq;
          $("#totalunits" + inc).val(tu);
           var rq_1=$("#priceperquantity" + inc).val();
          
          var uq_1=$("#totalunits" + inc).val();
          var tu_1=rq_1*uq_1;
          tu_2= tu_1.toFixed(2);
        
          $("#totalprice" + inc).val(tu_2);
         
          
          
          
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