<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Unit;
use backend\models\Stockrequest;
use backend\models\Vendor;
use backend\models\CompanyBranch;
use backend\models\Product;
use backend\models\Stockmaster;
use backend\models\Productgrouping;
use backend\models\Producttype;
use backend\models\Composition;
?>


<div class="container" >
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

<div class="row" >
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">

<?php $unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');

         $requestid=$model->requestid;
		 $requestdataone=Stockrequest::find()->where(['requestid'=>$requestid])->one();
		 $requestcode=$requestdataone->requestcode;
		 $vendor=$requestdataone->vendorid;
		 $branch=$requestdataone->branch_id;
		  $requestdata=Stockrequest::find()->where(['requestcode'=>$requestcode])->all();
		  
		   $vendordata=Vendor::find()->where(['vendorid'=>$vendor])->one();
		   $vendorname=$vendordata->vendorname;
		   
		   
		  
		$company_data = CompanyBranch::find()->where(['branch_id' => $branch])->one();
		$branchname=$company_data->branch_name;
		
		$form = ActiveForm::begin(); 
		 
		 if($requestdata)
		 {
		 	?>
		 	    <table id="datatable-fix-col" class="table table-striped table-bordered"><tr>
             <td><b>Request Date : <?php echo date("d-m-Y");?></b></td>
              <td><b>Branch : <?php echo $branchname;?></b></td>
              <td><b>Vendor : <?php echo $vendorname;?></b></td>
             	</tr></table>
<table class="table table-striped table-bordered">
            <thead>
             <tr>
             <th>S.No</th>
             <th>HSN Code</th>
              <th>StockCode</th>
             <th>Brand Code</th>
             <th>StockName</th>
              <th>StockComposition</th>
                <th>StockType</th>
              <th>Available Stock</th>
             <th>Request Quantity</th>
             <th>Unit</th>
             
             </tr>
             </thead>
		 	
<?php    $i=1;
		
		foreach ($requestdata as $key => $data) {
			
			 $value=$data->productid;
			 $unit=$data->unitid;
			 $requestid=$data->requestid;
			 $productdata=Product::find()->where(['productid'=>$value])->one();
			 $type=$productdata->product_typeid;
			 $compositionid=$productdata->composition_id;
			 $compositiondata=Composition::find()->where(['composition_id'=>$compositionid])->one();
			 $compositionname=$compositiondata->composition_name;
			 $rows = Stockmaster::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$value])->andwhere(['branch_id'=>$branch])->andwhere(['is_active'=>1])->one();
			 $unitlist=ArrayHelper::map(Unit::find()->where(['unitname'=>$type])->asArray()->all(), 'unitid', 'unitvalue');
			 if($rows)
			 {
			 	$qty=$rows->total_no_of_quantity;
			 }
			 else{
			 	$qty=0;
			 }
			  $groupdata = Productgrouping::find()->where(['vendorid' => $vendor])->andwhere(['productid'=>$value])->andwhere(['is_active'=>1])->andwhere(['brandcode'=>
			  $data->brandcode])->one();
			 
			 $brandcode=$data->brandcode;
			 $unit=$productdata->unit;
			 $unitdata=Unit::find()->where(['unitid'=>$unit])->one();
			 $stockcode=$groupdata->stock_code;
			 $unitname=$unitdata->unitvalue;
			 $productgroupdata=Product::find()->where(['productid'=>$value])->one();
			
			 $hsncode=$productgroupdata->hsn_code;
			
			 $producttypedata=Producttype::find()->where(['product_typeid'=>$type])->one();
			 $producttype=$producttypedata->product_type;
			echo"<tr>
             <td>".$i.$form->field($model, 'branch_id')->hiddenInput(['value'=>$branch])->label(false).
             $form->field($model, 'requestid[]')->hiddenInput(['value'=>$requestid])->label(false)
             .$form->field($model, 'vendorid[]')->hiddenInput(['value'=>$vendor])->label(false)."</td>";
			 echo "<td>".$hsncode."</td>
			   <td>".$stockcode.$form->field($model, 'stockcode[]')->hiddenInput(['value'=>$stockcode])->label(false)."</td>";
			    echo " <td>".$brandcode.$form->field($model, 'brandcode[]')->hiddenInput(['value'=>$brandcode])->label(false)."</td>";
                                    echo "<td>".$productdata->productname.$form->field($model, 'productid[]')->hiddenInput(['value'=>$value])->label(false)."</td>";
                                  
                                     echo" <td>".$compositionname."</td>";
                                  
                echo" <td>".$producttype."</td>";   
                                     
                                    echo "  <td align='right'>".$qty."</td>
                                  
                                    <td>".$form->field($model, 'quantity[]')->textInput(['id'=>'quantity'.$i,'name'=>'quantity'.$i,
                                    'placeholder'=>'Quantity',
                                    'value'=>$data->quantity,
                                    'required'=>true,  'onkeypress'=>'return isNumber(event)', ])->label(false) ."</td>";
                                    echo ' <td>'
          .$form->field($model, 'unit[]')->dropdownlist($unitlist,['prompt'=>'--Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control','value'=>$data->unitid,
           
          
          
          
          ])->label(false)."</td>
                                    
                                    </tr>";
								 $i++;
			
		}
		}?>
		
		<?php echo'</tbody>
                </table><div class="form-group pull-right" >';
        echo Html::submitButton('<i class="fa fa-fw fa-save"></i> Save', ['class' => 'btn btn-success waves-effect waves-light save_form',]);
    
   echo' </div>';
		
	    ActiveForm::end(); ?>
	    

</div>  
</div>
</div>
</div>
</div>  

  </div> 


