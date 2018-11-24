<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\CompanyBranch;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;
use backend\models\Stockrequest;
use backend\models\Physicianmaster;
use backend\models\Sales;
use backend\models\Saledetail;
$datatables = $dataProvider->getModels();

$session = Yii::$app->session;
$this->title = Yii::t('app', 'Price List');

?>
<style>
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
	
</style>

</style>
	<div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>

<div class="container">

<div class="row">
<div class="panel panel-border panel-inverse">
<div class="panel-heading"></div>      
       <div class="panel-body">
       <table id="datatable-buttons" class="table table-striped table-hover">
       <thead>
       <tr>
       <th>Stock & Type</th>
       <th>Batch No</th>
        <th>MRP /Unit</th>
     
       <th>Stock Code</th>
       <th>Composition</th>
       <th>Brand Code</th>
       <th>Unit</th>
        <th>Expire Date</th>
          <th>Available Stock</th>
       
      
        </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	if(count($datatables)>0){
                                		
                                		
                                				 $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
						
										
										$saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();
                                		$i=1;
										
										$avt=0;
										$ty=0;
										
                                	foreach ($datatables as $key => $value) {
                                		
										
                                		$branchid[]=$value->branch_id;
										$newbranchdata=array_intersect_key($branchlist, array_flip($branchid));
									    $branchval=array_values($newbranchdata);
										$vendorid[]=$value->stockbrandcode->vendorid;
										$newvendordata=array_intersect_key($vendorlist, array_flip($vendorid));
									    $vendorval=array_values($newvendordata);
										$productid[]=$value->stockbrandcode->productid;
										$newproductdata=array_intersect_key($productlist, array_flip($productid));
									    $productval=array_values($newproductdata);
										$producttypeid[]=$value->stockbrandcode->product->product_typeid;
										$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
									    $producttypeval=array_values($newproducttypedata);
										$compositionid[]=$value->stockbrandcode->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										$unitid[]=$value->stockbrandcode->unitid;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
									    $stockresponseid=$value->stockresponseid;
										$currentqty=0;
										foreach($saledata as $k)
										{
										  $saleid=$k->opsaleid;
											$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$value->stockresponseid])->all();
											foreach($saledetaildata as $l)
											{
											$currentqty+=$l->productqty;	
										    }
										}
										$availableqty=($value->total_no_of_quantity)-$currentqty;
										
										
										
									if($availableqty>0)
									{
									
									
									$avt+=$availableqty;
										
	                                 echo "<tr>
	                            
	                                <td>".$value->stockbrandcode->product->productname.'-'.$producttypeval[0]."</td> <td>".$value->batchnumber."</td><td>".number_format($value->mrpperunit,2)."</td>
	                                 <td>".$value->stockbrandcode->stockcode."</td> <td>".$compositionval[0]."</td>
	                                  <td>".$value->stockbrandcode->brandcode."</td>";
									 echo "<td>".$unitval[0]."</td>";
									 echo "<td>".date("d/m/Y",strtotime($value->expiredate))."</td>";
								   echo "<td>".$availableqty."</td>";
								    $newbranchdata=array(); $branchid=array(); $branchval="";
								    $newvendordata=array();  $vendorid=array();  $vendorval="";
									$newproductdata=array(); $productid=array();$productval="";
									$newproductgroupdata=array(); $productgroupid=array();$productgroupval="";
									$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
									$newcompositiondata=array(); $compositionid=array();$compositionval="";
									$newstockcodedata=array(); $stockcodeid=array();$unitval="";
									$newunitdata=array(); $unitid=array();$stockcodeval="";
                                    
								
									
                                 echo"</tr>";
                                 
								
								 $ty++;
                                 }	
                                 
								 $i++;
								
								 
                               }

                               
}   	?>
                                
                                </tbody>
                               
                            </table>
                                        	</div>
                                         </div>
                        	</div>
                    	</div>

</div>
</div>
</div>
</div>
<script>
   var handleDataTableButtons = function() {
        "use strict";
        0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
        
            buttons: [{
                extend: "copy",
                className: "btn-sm"
            }, {
                extend: "csv",
                className: "btn-sm"
            }, {
                extend: "excel",
                className: "btn-sm"
            }, {
                extend: "pdf",
                className: "btn-sm"
            }, {
                extend: "print",
                className: "btn-sm"
            }],
            
          
            responsive: !0,
            lengthMenu: [[3,10, 25, 50, -1], [3,10, 25, 50, "All"]],
            "paging": true,
            scrollX:false,
            
        })
    },
    TableManageButtons = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableButtons()
            }
        }
    }();
    
</script>	