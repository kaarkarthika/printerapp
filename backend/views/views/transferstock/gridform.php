<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Product;
use backend\models\Productgrouping;
use backend\models\Stockmaster;
use backend\models\Unit;
use yii\helpers\ArrayHelper;


$form=ActiveForm::begin(['action'=>['savetransferstock'], 'id'=>'transferstock-form1']); ?>
<div class="row" >
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-body">
	 <table  class="table table-bordered"><tr>
             <td><b>From Branch : <?php echo $frombranchname;?></b></td>
              <td><b>To Branch : <?php echo $tobranchname;?></b></td>
                <td><b>Request Date : <?php echo date("d/m/Y");?></b></td>
             	</tr></table>
<table  class="table table-striped table-bordered">
<thead>
<tr> <th>#</th>
	 <th>Product</th>
	 <th>Request Quantity</th>
	 <th>Unit</th>
	  <th>Total Units</th>
</tr>
</thead>
<tbody>
	<?php
$i=1;

foreach ($products as $key => $value) 
{
$productdata=Product::find()->where(['productid'=>$value])->one();
$unit=$productdata->unit;
$unitdata=Unit::find()->where(['unitid'=>$unit])->one();
$unitvalue=$unitdata->unitvalue;
$rows = Productgrouping::find()->where(['productid'=>$value])->andwhere(['is_active'=>1])->one();
$unitlist=ArrayHelper::map(Unit::find()->where(['unitname'=>$productdata->product_typeid])->asArray()->all(), 'unitid', 'unitvalue');
?>
<tr>
<td><?php echo $i;echo $form->field($model, 'frombranch')->hiddenInput(['value'=>$frombranch])->label(false);
echo $form->field($model, 'tobranch')->hiddenInput(['value'=>$tobranch])->label(false);
?></td>
<td><?php echo $productdata->productname;echo $form->field($model, 'productid[]')->hiddenInput(['value'=>$value])->label(false);?></td>

<td><?php echo $form->field($model, 'transferstockquantity[]')->textInput(['id'=>'transferstockquantity'.$i,'dataincrement'=>$i,
'name'=>'transferstockquantity'.$i,'placeholder'=>'Quantity','required'=>true, 
'class'=>'form-control transferstockquantity',
 'onkeypress'=>'return isNumber(event)', ])->label(false);?></td>
 
<td><?php   echo $form->field($model, 'unit[]')->dropdownlist($unitlist,['prompt'=>'--Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control',
           'onchange'=>'$.get( "'.Url::toRoute('getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function( data ) {
                                                        	 $("#unitquantity'.$i.'").val(data);
															 var rq=$("#transferstockquantity'.$i.'").val();
														          var uq= $("#unitquantity'.$i.'").val();
														          var tu=rq*uq;
														          $("#totalunits'.$i.'").val(tu);
															  } );'])->label(false);
														
														
														
	?></td>
	<td><input type="hidden" id="unitquantity<?php echo $i;?>" name="unitquantity<?php echo $i;?>" dataincrement="<?php echo $i;?>"/>
<?php echo $form->field($model, 'total_no_of_quantity[]')->textInput(['id'=>'totalunits'.$i,'name'=>'totalunits'.$i,'readonly'=>'true' ])->label(false);?></td>
</tr>
<?php 
$i++;
} ?>
</tbody> 
</table>
<div class="form-group pull-right" >
<?php echo Html::submitButton('Save', ['class' => 'btn btn-default waves-effect waves-light']);?>
</div>
<?php ActiveForm::end(); ?>
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
