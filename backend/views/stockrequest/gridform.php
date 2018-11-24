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
use backend\models\VendorBranch;
use yii\helpers\ArrayHelper;



 $form = ActiveForm::begin([
	 'action'=>['saverequest'],
		 'id'=>'stockrequest-form1',
	        
	    ]); 
	    
	    $vendordata=Vendor::find()->where(['vendorid'=>$vendor])->one();
		$vendorname=$vendordata->vendorname;
		$vendorbranchdata=VendorBranch::find()->where(['vendor_branchid'=>$vendorbranch])->one();
		$vendorbranchname=$vendorbranchdata->branchname;
	    $vendoremail=$vendorbranchdata->branch_emailid;
	   
	    
	    ?>
	    
	    <table id="datatable-fix-col" class="table table-striped table-bordered"><tr>
             <td><b>Request Date : <?php echo date("d-m-Y");?></b></td>
              <td><b>Branch : <?php echo $branchname;?></b></td>
              <td><b>Vendor : <?php echo $vendorname;?></b></td>
             
             	</tr></table>
<table id="datatable-buttons" class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>S.No</th>
             <th>HSN Code</th>
            <th>StockCode<br>/Brand</th>
             <th>Stock/Type</th>
             <th>Composition</th>
           
              <th>Available <br>Stock</th>
             <th style="width:100px;"> Request<br> Qty</th>
             <th>Unit</th>
             
             </tr>
             </thead>
             <tbody>
             	<input type='hidden' name='VendorEmail' value='<?php echo $vendor_branch; ?>'>
  
	<?php    $i=1; 
	         $k=0;
		
		foreach ($products as $key => $value) {
			
			 $productdata=Product::find()->where(['productid'=>$value])->one();
			 $type=$productdata->product_typeid;
			 
			
			 
			 $rows = Stockmaster::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$value])->andwhere(['is_active'=>1])->one();
			 
			  $rows12 = Stockmaster::find()->select(['total_no_of_quantity'=>'SUM(total_no_of_quantity)'])->andwhere(['productid'=>$value])->groupBy(['productid'])->all();
				//print_r($rows12);die;
			 if($rows12)
			 {
			 	$qty=$rows12[0]['total_no_of_quantity'];
			 }
           else
           {
           	$qty=0;
           }
			  $data = Productgrouping::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$value])->andwhere(['is_active'=>1])->one();
			 
			 $brandcode=$data->brandcode;
			 $compositionid=$productdata->composition_id;
			 $compositiondata=Composition::find()->where(['composition_id'=>$compositionid])->one();
			 $compositionname=$compositiondata->composition_name;
			 $unit=$productdata->unit;
			 $productgroupdata=Product::find()->where(['productid'=>$value])->one();
			 $unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			 $stockcode=$data->stock_code;
			 $hsncode=$productgroupdata->hsn_code;
			 
			 
			 
			 $producttypedata=Producttype::find()->where(['product_typeid'=>$type])->one();
			 $producttype=$producttypedata->product_type;
			 $unitname=$unitdata->unitvalue;
		     $unitlist=ArrayHelper::map(Unit::find()->where(['unitname'=>$type])->asArray()->all(), 'unitid', 'unitvalue');
			
			echo"<tr>
             <td>".$i.$form->field($model, 'branch_id')->hiddenInput(['value'=>$branch])->label(false)
             .$form->field($model, 'vendorid[]')->hiddenInput(['value'=>$vendor])->label(false).
             $form->field($model, 'productgroupid[]')->hiddenInput(['value'=>$data->productgroupid])->label(false).
             "</td>";
			  echo "<td>".$hsncode."</td>";
			  echo "<td>".$stockcode.$form->field($model, 'stockcode[]')->hiddenInput(['value'=>$stockcode])->label(false)
			  ."/".$brandcode.$form->field($model, 'brandcode[]')->hiddenInput(['value'=>$brandcode])->label(false)."</td>";
            echo" <td>".$productdata->productname.$form->field($model, 'productid[]')->hiddenInput(['value'=>$value])->label(false)."/".$producttype."</td>";    
            echo" <td>".$compositionname."
            
           
            
            </td>";
                                
                                     echo " <td align='right'>".$qty."</td>
               <td>".$form->field($model, 'quantity[]')->textInput(['id'=>'quantity'.$i,'name'=>'quantity'.$i,'placeholder'=>'Quantity','required'=>true,  'onkeypress'=>'return isNumber(event)', ])->label(false) ."</td>";
             echo ' <td>'
          .$form->field($model, 'unit[]')->dropdownlist($unitlist,['prompt'=>'--Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control',
           
          
          
          
          ])->label(false)."</td> </tr>";
									  $k=1;
									
								

								 $i++;
			
		}
		echo'</tbody>
                </table>';
               
                echo '<div class="form-group pull-right" >';
				
					   echo Html::submitButton('Save', ['class' => 'btn btn-primary waves-effect waves-light']);
				
     
    
   echo' </div><div class="clearfix"></div>';
		
	    ActiveForm::end(); ?>
	    
