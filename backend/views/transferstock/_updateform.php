<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Product;
use backend\models\Productgrouping;
use backend\models\Stockmaster;
use backend\models\Unit;
use backend\models\CompanyBranch;
use backend\models\Vendor;
use backend\models\Transferstock;
use yii\helpers\ArrayHelper;
?>
<div class="container" >
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title">Update Transfer Stock</h4>
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
	<?php $transferstockid=$model->transferstockid;
	      $frombranch=$model->frombranch;
		  $tobranch=$model->tobranch;
		  $frombranchdata=CompanyBranch::find()->where(['branch_id'=>$frombranch])->one();
		  $frombranchname=$frombranchdata->branch_name;
		  $tobranchdata=CompanyBranch::find()->where(['branch_id'=>$tobranch])->one();
		  $tobranchname=$tobranchdata->branch_name;
		  $transferstockdata=Transferstock::find()->where(['transferstock_requestcode'=>$model->transferstock_requestcode])->all();
	?>
</div>
<div class="panel-body">
		 <table id="datatable-fix-col" class="table table-bordered"><tr>
             <td><b>From Branch : <?php echo $frombranchname;?></b></td>
              <td><b>To Branch : <?php echo $tobranchname;?></b></td>
                <td><b>Transfer Stock Request Date : <?php echo date("d/m/Y",strtotime($model->transferstockdate));?></b></td>
             	</tr></table>
<table  class="table table-striped table-bordered">
<thead>
<tr> <th>#</th>
	 <th>Product</th>
	
	 <th>Transfer Stock</th>
	 <th>Unit</th>
	   <th>Total Units</th>
</tr>
</thead>
<tbody>
	<?php 
	$form=ActiveForm::begin(); 
$i=1;
if($transferstockdata)
{
	foreach ($transferstockdata as $key => $value) 
{
$productdata=Product::find()->where(['productid'=>$value->productid])->one();
$unit=$productdata->unit;
$unitdata=Unit::find()->where(['unitid'=>$unit])->one();
$unitvalue=$unitdata->unitvalue;
$stockrows = Stockmaster::find()->where(['productid'=>$value->productid])->andwhere(['branch_id'=>$frombranch])->andwhere(['is_active'=>1])->one();
$unitlist=ArrayHelper::map(Unit::find()->where(['unitname'=>$productdata->product_typeid])->asArray()->all(), 'unitid', 'unitvalue');
?>
<tr>
<td><?php echo $i;echo $form->field($model, 'frombranch')->hiddenInput(['value'=>$frombranch])->label(false);
echo $form->field($model, 'tobranch')->hiddenInput(['value'=>$tobranch])->label(false);
?></td>
<td><?php echo $productdata->productname;echo $form->field($model, 'productid[]')->hiddenInput(['value'=>$value->productid])->label(false);
echo $form->field($model, 'transferstockid[]')->hiddenInput(['id'=>'transferstockid'.$i,'value'=>$value->transferstockid ])->label(false);
?></td>
<td><?php echo $form->field($model, 'transferstockquantity[]')->textInput(['id'=>'transferstockquantity'.$i,'name'=>'transferstockquantity'.$i,'class'=>'form-control transferstockquantity',
'required'=>true,  'value'=>$value->transferstockquantity,'onkeypress'=>'return isNumber(event)','dataincrement'=>$i, ])->label(false);?></td>
<td><?php   echo $form->field($model, 'unit[]')->dropdownlist($unitlist,['prompt'=>'--Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control','value'=>$value->unit,
           'onchange'=>'$.get( "'.Url::toRoute('getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function( data ) {
                                                        	 $("#unitquantity'.$i.'").val(data);
															 var rq=$("#transferstockquantity'.$i.'").val();
														          var uq= $("#unitquantity'.$i.'").val();
														          var tu=rq*uq;
														          $("#totalunits'.$i.'").val(tu);
															  } );'])->label(false);
														
														
														
	?></td>
	<td><input type="hidden" id="unitquantity<?php echo $i;?>" name="unitquantity<?php echo $i;?>" dataincrement="<?php echo $i;?>" value="<?php echo $unitdata->no_of_unit;?>"/>
<?php echo $form->field($model, 'total_no_of_quantity[]')->textInput(['id'=>'totalunits'.$i,'name'=>'totalunits'.$i,'readonly'=>'true' ,'value'=>$value->total_no_of_quantity])->label(false);?></td>
</tr>
<?php 
$i++;
} 
}
?>
</tbody> 
</table>
<div class="form-group pull-right" >
<?php echo Html::submitButton('<i class="fa fa-edit"></i> Update', ['class' => 'btn btn-primary waves-effect waves-light save_transferstock']);?>
</div>
<?php ActiveForm::end(); ?>
</div>
</div>   
</div>  
</div> 
</div> 
<script>
	   $(document).on('change keyup click', '.transferstockquantity', function ()
   {
  	      var inc=$(this).attr('dataincrement');
          var rq=$("#transferstockquantity" + inc).val();
          var uq=$("#unitquantity" + inc).val();
          var tu=rq*uq;
          $("#totalunits" + inc).val(tu).toFixed(2);
  });
</script>