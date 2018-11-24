<?php


use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Producttype;
use backend\models\Manufacturermaster;
use backend\models\Taxgrouping;
use backend\models\TaxgroupingLog;

$this->title = 'Product';



use yii\helpers\Url;
$session = Yii::$app->session;
?>
<style>
.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 24px !important;
    padding-left: 0 !important;
}

.select2-container--krajee .select2-selection--single .select2-selection__clear {
    right: 4rem;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: unset !important;
    padding-left: 0px !important;
}

.panel-success > .panel-heading {
    background-color: #5fbeaa;
}

h4.panel-title,.panel-heading .pull-right .summary{
    color: #fff;
}

.btn-toolbar.kv-grid-toolbar.toolbar-container.pull-right>textarea {
    display: none;
}

.panel.panel-success .kv-panel-after {
    width: 135px;
    float: left;
}

i.fa.fa-info-circle {
    color: #000;
}

.bootstrap-dialog.type-warning .modal-header {
    background-color: #5fbeaa;
    padding: 10px 17px !important;
}

table.table.table-striped.table-hover.kv-grid-table.table-bordered.kv-table-wrap td {
    background: #fff;
}
table.table.table-striped.table-hover.kv-grid-table.table-bordered.kv-table-wrap tbody tr td {
    position: relative;
    top: 10px !important;
}
table.table.table-striped .empty {
    font-weight: 700;
    text-align: center;
    color: red;
}
</style>

<div class="container">
 	<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                	
                            
                	 <?php
                	 $session = Yii::$app->session;
                	 if($session[Yii::$app->controller->id]!=""){
                	 if($companycount==0){
                	 if(in_array('a', $session[Yii::$app->controller->id])) {
                	 
                	 echo Html::a(Yii::t('app', 'Add Product'), ['create'], ['class' => 'btn btn-default waves-effect waves-light']);
					
					 } }} ?>
                                </div>
                                
                                
                                
                                <div class="btn-group pull-right m-t-15"> 
                                <?php 
								  $visible=0;
								  $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
								   	
                                  if(in_array('a', $session[Yii::$app->controller->id])) {
                                  		//DIE;
                                  	$visible=1; 	?>	
										<form id="deleteall-form">
                                       <div class="col-md-3">						
                         <?=Html::Button('Delete All', ['class' => 'deleteall btn btn-danger waves-effect waves-light']); ?>
</div>
<?php }
								  
								   } ?>
                                </div>
                                
                                   <div class="btn-group pull-right m-t-15"> 
                                <?php 
								  $visible=0;
								  $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
								   	
                                  if(in_array('et', $session[Yii::$app->controller->id])) {
                                  	$visible=1; 	?>	
										
                                       <div class="col-md-3">				
                                       	 		
                         <?=  Html::a(Yii::t('app', '<i class="fa fa-file-excel-o"></i>'), ['excel'], ['class' => 'btn btn-default waves-effect waves-light']);  ?>
</div>
<?php }
								  
								   } ?>
                                </div>
                                
                                     <div class="btn-group pull-right m-t-15"> 
                                <?php 
								  $visible=0;
								  $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
								   	
                                  if(in_array('print', $session[Yii::$app->controller->id])) {
                                  	$visible=1; 	?>	
										
                                       <div class="col-md-3">				
                                       	 		
                         <?=  Html::a(Yii::t('app', '<i class="fa fa-print"></i>'), ['print'], ['class' => 'btn btn-warning waves-effect waves-light','target' => '_blank']);  ?>
</div>
<?php }
								  
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
								<!--div class="panel panel-border panel-custom">
									<div class="panel-heading">
										
									</div>
									<div class="panel-body"-->
<?php Pjax::begin(['id'=>'product-grid']); ?>     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       
        'tableOptions'=>['class'=>'table table-striped  table-hover'],
      
	 /* 	'pager' => [
        
        'maxButtonCount'=>20,    // Set maximum number of page buttons that can be displayed
        ],
	  */
	  
	  
	    'columns' => [
	    
		//	['class' => '\kartik\grid\ActionColumn',
        //'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']],
		
      		['class' => '\kartik\grid\CheckboxColumn','visible'=>$visible],        
        //    ['class' => '\kartik\grid\SerialColumn',  'headerOptions' => ['style' => 'color:#337ab7;']],
             
						   	           [
            'attribute'=>'product_typeid', 
            'width'=>'10px',
                        'value'=>function ($model, $key, $index, $widget) { 
               return $model->producttype->product_type;
            },
           
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Producttype::find()->asArray()->all(), 'product_typeid', 'product_type'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--Product Type--'],
           
        ], 
    	           [
            'attribute'=>'productid', 
            'width'=>'301px',
                        'value'=>function ($model, $key, $index, $widget) { 
                return $model->product->productname;
            },
           
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Product::find()->asArray()->all(), 'productid', 'productname'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--Product--'],
           
        ],   
    
   		 [
            'attribute'=>'composition_id', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'Composition Name',
            'width'=>'10px',
            'format'=>'raw',
		   
		    'value'=>function ($model, $key, $index, $widget) 
		    {
		    	
				 $string = ucfirst($model->composition->composition_name); 
                     if (strlen($string) > 15) 
                     { 
                     	 $tooltip_i='<span class="test" data-toggle="tooltip" data-placement="top" title="'.$string.'"><i class="fa fa-info-circle"></i> </span>';
						 // truncate string
                         $stringCuted = substr($string, 0, 20);
                         // make sure it ends in a word so assassinate doesn't become ass...
                         $string_cutting_data = substr($stringCuted, 0, strrpos($stringCuted, ' ')).'...&nbsp;'.$tooltip_i; 
						 return $string_cutting_data;
                      }
                      else
                      {
                         return $string;
                      }
				
				 //return $model->composition->composition_name;
			
			
			},
           
		   
		    'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Composition::find()->asArray()->all(), 'composition_id', 'composition_name'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Search Composition--'],
        ],
        
		[
            'attribute'=>'manufacturer_id', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'Manufacturer Name',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) { return $model->manufacturer->manufacturer_name;},
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Manufacturermaster::find()->asArray()->all(), 'id', 'manufacturer_name'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Search Manufacturer--'],
        ],
		
        
             
             
			    /*   [
            'attribute'=>'gst', 
            'width'=>'301px',
                        'value'=>function ($model, $key, $index, $widget) { 
                return $model->gst;
            }],*/
             
			 
			      [
            'attribute'=>'hsn_code', 
            'width'=>'301px',
                        'value'=>function ($model, $key, $index, $widget) {
                		if($model->taxgroup->hsncode != '')
						{
							return $model->taxgroup->hsncode;	
						}	 
						else
						{
							return '-';
						}
            },
           
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--HSN Code--'],
           
        ], 
			 
			 
			[
            'attribute'=>'tax',
            'label' => 'GST %', 
            'width'=>'301px',
                        'value'=>function ($model, $key, $index, $widget) { 
                		if($model->taxgrouphsn->tax != '')
						{
							return $model->taxgrouphsn->tax;	
						}	 
						else
						{
							return '-';
						}
            },
            
			'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'tax'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--HSN Code--'],
            
            
            ], 
			 
                   
                   ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {   
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  } }  }, 
                              'update' => function ($url, $model) {
                              	
								$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) 
                                  {
                                  
                                return Html::a('<span class="fa fa-edit"></span>',$url, [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                               			 ]);
									
								  }  }  }, 
                        
                                'delete' => function ($url, $model, $key) {
                                	
                                      $session = Yii::$app->session;
									  if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) {  
                                    //	print_r($url);die;
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
								  } }},
								  
								  
								  
								       /*'delete' => function ($url, $model, $key) {
                                  $session = Yii::$app->session;
								  if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) {      
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } } },*/
								  
								  
                          ] ],
                          
						  
						  
						  
        ],
        
		
			'responsive'=>true,
    'hover'=>true,
     'floatHeader'=>true,
    'floatHeaderOptions'=>['scrollingTop'=>'50'],
		
		
		'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="fa fa-product-hunt"></i> Product</h3>',
        'type'=>'success',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        
		'resizableColumns'=>true,
    'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
     'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
        'beforeGrid'=>'My fancy content before.',
        'afterGrid'=>'My fancy content after.',
    ]
		
    	],
	]); ?>
    
    
    
<?php Pjax::end(); ?>






</div>
</div>
</div>
<script>
    $(document).ready(function(){
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Product</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;
         });

 	/* $('.delete').click(function () {
 	 	//alert("jkj");
 	 	var url=$(this).val();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
            	
            	 $.ajax({
			        url: url,
			        type: 'post',
                     success: function (data) {
				        	if(data=="Y"){
				        	  swal("Deleted!", "Your product has been deleted.", "success");
				        	  $.pjax.reload('#product-grid');
				        	   location.reload();
				        	          }
				                             }
   					  });	
              
            });
           
        });*/
       
       
        	 $('.deleteall').click(function () {
 	 	 var url = '<?php echo Yii::$app->homeUrl;?>?r=product/bulkdelete';
 	 	  var form = $("#deleteall-form");
 var formData = form.serialize();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
            	
            	 $.ajax({
			        url: url,
			        type: 'post',
			        data:formData,
                     success: function (data) {
				        	if(data=="Y"){
				        	  swal("Deleted!", "Selected  Composition has been deleted.", "success");
				        	  $.pjax.reload('#product-grid');
				        	   location.reload();
				        	          }
				                             }
   					  });	
              
            });
           
        });
       
    });
</script>
 <script type="text/javascript">
  $(document).ready(function(){
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");
      $(".list-unstyled").css("display","none");
  });
</script>
<script type="text/javascript">
var $jq = jQuery.noConflict();

$jq(".test").mouseover(function() {    	
       $(this).tooltip('toggle');
    });
</script>