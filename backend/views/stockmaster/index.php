<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use backend\models\BranchAdmin;
$this->title = Yii::t('app', 'Stock');
require('../../vendor/tcpdf/tcpdf.php');
require ('../../vendor/tcpdf/tcpdf_barcodes_1d.php');
require ('../../vendor/tcpdf/tcpdf_barcodes_2d.php');




?>
 <div class="container">
 	<div class="row">
 			<div class="col-sm-12">
 				 <div class="btn-group pull-right m-t-15">
  <?php
  $session = Yii::$app->session;
 if($session[Yii::$app->controller->id]!="")
 {
 if(in_array('a', $session[Yii::$app->controller->id])) 
 {
 echo Html::a(Yii::t('app', 'Add Stock'), ['create'], ['class' => 'btn btn-default waves-effect waves-light']);
 }
 } ?>
</div>
								<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>

         	<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
									<div class="panel-heading">
										
									</div>
									<div class="panel-body">
   
 <?php Pjax::begin(['id'=>'stock-grid']); ?>    
<?php echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'tableOptions' =>['class' => 'table table-striped table-hover'],
  
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;']],
     	    
    	//'serialnumber',
    	[
    'attribute' => 'branch_id','value' => 'companybranch',
    'filter' => Html::activeDropDownList($searchModel, 'branch_id', $branchlist,['class'=>'form-control','prompt' => '--Branch--']),
],
  
    ['attribute'=>'brandcode','headerOptions' => ['style' => 'color:#337ab7;']],
           [
    'attribute' => 'vendorid','value' => 'vendor_name',
    
    'filter' => Html::activeDropDownList($searchModel, 'vendorid', $vendorlist,['class'=>'form-control ','prompt' => '--Vendor--']),
],
[
    'attribute' => 'productid','value' => 'product_name',
    
    'filter' => Html::activeDropDownList($searchModel, 'productid', $productlist,['class'=>'form-control','prompt' => '--Product--']),
],
['attribute'=>'total_no_of_quantity', 'label'=>'Total Quantity','contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:80px;']],
			['attribute'=>'price', 'format' => ['currency', 'Rs.'],'contentOptions' =>['style'=>'text-align:right;'],'headerOptions' =>['style'=>'text-align:right;width:180px;']],
			  ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],
               'template'=>'{view}{delete}',
               
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) { 
                               
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }  }}, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								
								if($session[Yii::$app->controller->id]!=""){
									
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);                                
            
            }} }, 
                             
                                    
                                'delete' => function ($url, $model, $key) {
                                       $session = Yii::$app->session;
									   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) { 
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } } },
                          ] ],
            
        ],
    ]); ?>
    <?php Pjax::end(); ?> 
</div>
                    </div>
                </div>
                
              </div>
</div>

</div>

<script>
	$('#stockmaster-form').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".add_stock_master").attr('disabled','disabled');
    var form = $(this);
    var id=$('#stockmaster-stockid').val();
    if(id=="")
    {
    	var url='?r=stockmaster/create';
    }
    else{
    	var url='?r=stockmaster/update&id='+id;
    }
    var formData = form.serialize();
   // alert(url);
    $.ajax({
        url: url,
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
	    if(data=="Y")
	    {	
		$("#loadtex").text("Successfully Saved.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	     $(".add_stock_master").removeAttr('disabled');
	  $.pjax.reload({container:"#stock-grid"});
	    $("#product_idz").val('');
	    $("#vendorid").val('');
						
		}
		else if(data=="E")
		{
		$("#loadtex").text("Data Already Exists.");
		$("#loadtex").css('color','red ');
	    $("#loadtex").show();
	     $(".add_stock_master").removeAttr('disabled');
		}
		else
		{
		$("#loadtex").text("Data Not Saved.");
		$("#loadtex").css('color','red ');
		$("#loadtex").show();
		 $(".add_stock_master").removeAttr('disabled');
						
		} 
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
	
</script>

<script>
    $(document).ready(function(){
          $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Stock Request</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
          $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Stock</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();});
         
      });
         
</script>