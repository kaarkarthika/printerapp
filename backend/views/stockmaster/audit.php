<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

use backend\models\Vendor;
use backend\models\Product;
use backend\models\Stockresponse;
use backend\models\CompanyBranch;



$datatables = $dataProvider->getModels();
$session = Yii::$app->session;
$bid=$session['branch_id'];
$companybranchdata=CompanyBranch::find()->where(['branch_id'=>$bid])->one();
$branchname= $companybranchdata->branch_name;


$this->title = "Stock Audit -".$branchname;




?>
<style>
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	
</style>
  <div class="container">
	<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>

         <?php  echo $this->render('_auditsearch', ['model' => $searchModel,'vendorlist'=>$vendorlist,'productlist'=>$productlist,'compositionlist'=>$compositionlist]); ?>
        
      
                
        
						<!--<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
									<div class="panel-heading">
										
									</div>
									<div class="panel-body">
              
   
    
<?php echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'tableOptions' =>['class' => 'table table-striped table-hover'],
     
   
  
    'columns'=>[
     
     	    
    	   ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'color:#337ab7;']],
    	   
    	   ['attribute' => 'companybranch','label' => 'Branch','headerOptions' => ['style' => 'color:#337ab7;']],
    	    ['attribute' => 'stock_code','label' => 'Stock Code','headerOptions' => ['style' => 'color:#337ab7;width:80px;']],
    	
           [
    'attribute' => 'vendorid','value' => 'vendor_name',
    
    'filter' => Html::activeDropDownList($searchModel, 'vendorid', $vendorlist,['class'=>'form-control','prompt' => '--Vendor--']),
],
[
    'attribute' => 'productid','value' => 'product_name',
    
    'filter' => Html::activeDropDownList($searchModel, 'productid', $productlist,['class'=>'form-control','prompt' => '--Product--']),
],
 ['attribute' => 'brandcode','label' => 'Brand Code','headerOptions' => ['style' => 'color:#337ab7;width:50px;']],
     ['attribute' => 'compositionname','label' => 'Composition','headerOptions' => ['style' => 'color:#337ab7;']],
       ['attribute'=>'quantity', 'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;']],
			['attribute'=>'price', 'format' => ['currency', 'Rs.'],'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:120px;']],
          
          
		
		
            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
              'headerOptions' => ['style' => 'color:#337ab7;width:80px;'],
               'template'=>'{view}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) { 
                                  
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }  }}, 
                              
                             
                                    
                            
                          ] ],
            
        ],
    ]); ?>
</div>
</div></div>
</div>-->


			<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
									<div class="panel-heading">
										
									</div>
									<div class="panel-body">
                           
                            
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                	<th>#</th>
                                    <th>Vendor</th>
                                    <th>Stock</th>
                                    <th>Type</th>
                                    <th>Stockcode</th>
                                     <th>Composition</th>
                                    <th>Brandcode</th>
                                    <th>Batch Number</th>
                                       <th>Expire Date</th>
                                    <th>Quantity</th>
                                      <th>Unit</th>
                                    <th>Price/Qty</th>
                                </tr>
                                </thead>


                                <tbody>
                                	
                                	<?php 
                                	if(count($datatables)>0){
                                		$i=1;
                                		
                                		
                                	foreach ($datatables as $key => $value) {
                                		$stockdata=Stockresponse::find()->where(['stockid'=>$value->stockid])->all();
                                		$branchid[]=$value->branch_id;
										$newbranchdata=array_intersect_key($branchlist, array_flip($branchid));
									    $branchval=array_values($newbranchdata);
										
										$vendorid[]=$value->vendorid;
										$newvendordata=array_intersect_key($vendorlist, array_flip($vendorid));
									    $vendorval=array_values($newvendordata);
										
										$productid[]=$value->productid;
										$newproductdata=array_intersect_key($productlist, array_flip($productid));
									    $productval=array_values($newproductdata);
										
										$pdata=Product::find()->where(['is_active'=>1])->andwhere(['productid'=>$value->productid])->one();
										
										$productgroupid[]=$value->productgroupid;
										$newproductgroupdata=array_intersect_key($productgrouplist, array_flip($productgroupid));
									    $productgroupval=array_values($newproductgroupdata);
										
										$stockcodeid[]=$value->productgroupid;
										$newstockcodedata=array_intersect_key($stockcodelist, array_flip($stockcodeid));
									    $stockcodeval=array_values($newstockcodedata);
										
										
										$compositionid[]=$value->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										
										
										
										if($pdata)
										{
											
											$producttypeid[]=$pdata->product_typeid;
										$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
									    $producttypeval=array_values($newproducttypedata);
									

										$unitid[]=$pdata->unit;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
										
										
										}
										if($stockdata)
										{
														foreach($stockdata as $sd)
										{
											$batchno=$sd->batchnumber;
										$expdate=date("d/m/Y",strtotime($sd->expiredate));
										$priceperqty=$sd->priceperquantity;
										
										
										
                                  echo "<tr><td>".$i."</td> <td>".$vendorval[0]."</td> <td>".$productval[0]."</td>
                                   <td>".$producttypeval[0]."</td><td>".$stockcodeval[0]."</td> <td>".$compositionval[0]."</td> <td>".$productgroupval[0]."</td>";
                                    echo "<td>".$batchno."</td>
                                  <td>".$expdate."</td>";
								 echo "<td align='right'>".$value->quantity."</td><td>".$unitval[0]."</td><td align='right'>".$priceperqty."</td>";
                                 echo"</tr>";
								 $i++;
                               } 
										
										
										
										}
										
										else{
											$batchno="";
										$expdate="";
											  echo "<tr><td>".$i."</td><td>".$vendorval[0]."</td> <td>".$productval[0]."</td>
                                   <td>".$producttypeval[0]."</td><td>".$stockcodeval[0]."</td> <td>".$compositionval[0]."</td> <td>".$productgroupval[0]."</td>";
                                    echo "<td>".$batchno."</td>
                                  <td>".$expdate."</td>";
								 echo "<td align='right'>".$value->quantity."</td><td>".$unitval[0]."</td><td align='right'></td>";
                                 echo"</tr>";
								 $i++;
											
										}
							


                                    $newbranchdata=array(); $branchid=array(); $branchval="";
								    $newvendordata=array();  $vendorid=array();  $vendorval="";
									$newproductdata=array(); $productid=array();$productval="";
									$newproductgroupdata=array(); $productgroupid=array();$productgroupval="";
									$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
									$newcompositiondata=array(); $compositionid=array();$compositionval="";
									$newstockcodedata=array(); $stockcodeid=array();$unitval="";
									$newunitdata=array(); $unitid=array();$stockcodeval="";
									
									
									
                               }	} ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
          </div>


<script>

    $(document).ready(function(){
    	
    	 $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
    	 	scrollX:   "1200px",
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
            "paging": false,
            
            "scrollY":        "500px",
        "scrollCollapse": false,
        "paging":         false
            
           
            
        });

         
          $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Stock Audit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });

           });
         
</script>