<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Stockmaster;
use backend\models\Unit;
use backend\models\Productgrouping;
use backend\models\Producttype;
use backend\models\Composition;
use backend\models\Stockrequest;
use backend\models\Stockresponse;
use backend\models\VendorBranch;
 $form = ActiveForm::begin([
	 'action'=>['savebackorderrequest'],
		 'id'=>'stockrequest-form1',
	        
	    ]); 
	    
	    $vendordata=Vendor::find()->where(['vendorid'=>$vendor])->one();
		$vendorname=$vendordata->vendorname;
		
	    
	    
	    ?>
	    <div class="container">
	    <div class="row" >
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
	    
	    <table  class="table table-striped table-bordered"><tr>
             <td><b>Request Date : <?php echo date("d-m-Y");?></b></td>
              <td><b>Branch : <?php echo $branchname;?></b></td>
              <td><b>Vendor : <?php echo $vendorname;?></b></td>
             	</tr></table>
<table  class="table table-hover table-striped table-bordered">
             <thead>
             <tr>
             <th>S.No</th>
             <th>HSN Code</th>
              <th>StockCode</th>
             <th>Brand Code</th>
             <th>Stock</th>
              <th>Composition</th>
             <th>StockType</th>
              <th>Available Stock</th>
             <th>Request Quantity</th>
             <th>Unit</th>
             </tr>
             </thead>
             <tbody>
	<?php    $i=1; 
	         $k=0;
			
		foreach ($products as $key => $value) {
			
			 $productdata=Product::find()->where(['productid'=>$value])->one();
			 $datapg = Productgrouping::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$value])->andwhere(['is_active'=>1])->one();
			 $type=$productdata->product_typeid;
			 $rows = Stockmaster::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$value])->andwhere(['branch_id'=>$branch])->andwhere(['is_active'=>1])->one();
			 $brandcode=$datapg->brandcode;
			 $compositionid=$rows->compositionid;
			 $compositiondata=Composition::find()->where(['composition_id'=>$compositionid])->one();
			 $compositionname=$compositiondata->composition_name;
			 $unit=$productdata->unit;
			 $productgroupdata=Product::find()->where(['productid'=>$value])->one();
			 $unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			 $stockcode=$datapg->stock_code;
			 $hsncode=$productgroupdata->hsn_code;
			 $producttypedata=Producttype::find()->where(['product_typeid'=>$type])->one();
			 $producttype=$producttypedata->product_type;
			 $unitname=$unitdata->unitvalue;
			
			 if($rows)
			 {
			 	
				$rcode=$requestcode;
				$data=Stockrequest::find()->where(['requestcode'=>$rcode])->andwhere(['brandcode'=>$brandcode])->all();
								$z=0;
			foreach($data as $k)
			{
				$z+=$k->quantity;
			}
			
			$data1=Stockresponse::find()->where(['request_code'=>$rcode,'stockid'=>$rows->stockid])->all();
			$z1=0;
			foreach($data1 as $k)
			{
				$z1+=$k->receivedquantity+$k->receivedfreequantity;
			}
				
				$qty=$z-$z1;
			echo"<tr>
             <td>".$i.$form->field($model, 'branch_id')->hiddenInput(['value'=>$branch])->label(false)
             .$form->field($model, 'vendorid[]')->hiddenInput(['value'=>$vendor])->label(false)
              .$form->field($model, 'productgroupid[]')->hiddenInput(['value'=>$datapg->productgroupid])->label(false).
             $form->field($model, 'requestcode[]')->hiddenInput(['value'=>$rcode])->label(false)."</td>";
			  echo "<td>".$hsncode."</td>";
			  echo "<td>".$stockcode.$form->field($model, 'stockcode[]')->hiddenInput(['value'=>$stockcode])->label(false)."</td>";
			   echo "<td>".$brandcode.$form->field($model, 'brandcode[]')->hiddenInput(['value'=>$brandcode])->label(false)."</td>";
            echo" <td>".$productdata->productname.$form->field($model, 'productid[]')->hiddenInput(['value'=>$value])->label(false)."</td>";
            echo" <td>".$compositionname."</td>";
                echo" <td>".$producttype."</td>";                      
                                     echo " <td align='right'>".$rows->quantity."</td>
               <td>".$form->field($model, 'quantity[]')->textInput(['id'=>'quantity'.$i,'name'=>'quantity'.$i,'placeholder'=>'Quantity','required'=>true,  'value'=>$qty,'onkeypress'=>'return isNumber(event)', ])->label(false) ."</td>
                                       <td>".$unitname.$form->field($model, 'unit[]')->hiddenInput(['value'=>$unit])->label(false)."</td>
                                    
                                    </tr>";
									  $k=1;
									
									}

								 $i++;
			
		}?>
		
		<?php 
		     if($k==0)
			 {
			 	echo "<tr><td colspan='7'><center>Stock Not available for this Branch</center></td></tr>";
			 }
		
		
		
		echo'</tbody>
                </table>';
                
                echo '<div class="form-group pull-right" >';
			
					   echo Html::submitButton('Save', ['class' => 'btn btn-default waves-effect waves-light save_form']);
				
   echo' </div><div class="clearfix"></div>';
		
	    ActiveForm::end(); ?>
	    </div>  
</div>
</div>
</div>
</div>  

	    
