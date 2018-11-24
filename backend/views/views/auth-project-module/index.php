<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Json;
use yii\helpers\Url;



$this->title = 'Modules';
 $session = Yii::$app->session;

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
  echo Html::button(' Add Module',['class' => 'btn btn-default  addmodule waves-effect waves-light']);
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
                  <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
         <?php Pjax::begin(['id'=>'projectmodule-grid']); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
          ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;'],],

            'p_autoid',
            'moduleName',
            'moduleCode',
         'moduleMultiple',
           'moduelRoot',
             'userAction',
             'FAIcon',
             'sortOrder',
 ['class' => 'yii\grid\ActionColumn','template' => '{moduleaction}','header'=>'', 
        'buttons' => [
            'moduleaction' => function ($url, $model, $key) {
            	$session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('m', $session[Yii::$app->controller->id])) { 
            
            
		    $return_btu=" ".Html::button('<i class="glyphicon glyphicon-share"></i>Module Action' , ['style'=>'background-color:#3b6ea7; color: white; ','class' => 'btn  btn-flat btn-xs modaction','value'=>$url,'data'=>$model->p_autoid ]);
                return $return_btu; 
				
				}}   },

        ]],
                   ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               
              'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {   
                                
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs btn-sm view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
                                   } }}, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom btn-sm updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);                                
            
            } } }, 
                         
                                'delete' => function ($url, $model, $key) {
                                  $session = Yii::$app->session;
								  if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) {     
                                     
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-top:4px;','class' => 'btn btn-danger btn-sm btn-xs modalDelete gridbtncustom', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                  } }},
                          ] ],
        ],
    ]); ?><?php Pjax::end(); ?> 
          </div>
            
            
            
           <!--   <div class="row">
                            <div class="col-xs-12">
                                <div class="card-box">
                                    <div id="jsGrid"></div>
                                </div>
                            </div>
                 </div>-->

            
            
            
            
            
            
            
            
</div>
</div>
</div>
</div>



<script>
    $(document).ready(function()
    {

         	$('body').on("click",".addmodule",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=auth-project-module/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Module</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         
         
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Module Details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });


 	 $('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Update Module</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });


 $('body').on("click",".modaction",function(){
 	
 	var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Set Module Action</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();
 	
 });

 
 
 
  $('body').on("click",".updateaction",function(){
         	
         	$("#load").show();
         	$(".updateaction").attr('disabled','disabled');
         	
         	var name=$("#modzaction").val();
         	var moduleid=$("#moduleid").val();
         	
         	    var formData = new FormData($('#moduleactionform')[0]);
   	
   	
            	$.ajax({
				url:'<?php echo Yii::$app->homeUrl ?>?r=auth-project-module/moduleaction&id='+moduleid,
				type: 'post',
                async: false,
				cache:false,
				contentType:false,
				processData:false,
				data:formData,
				success: function (result)
				 {
				 	 $("#load").hide(4);
					if(result=="Y"){
						$("#loadtex").text("Successfully Updated.");
						$("#loadtex").css('color','green ');
						 $("#loadtex").show(4);
						
					}else{
						$("#loadtex").text("Data Not Saved.");
						$("#loadtex").css('color','red ');
						 $("#loadtex").show();
						
					} 
				},
				error: function (error) {
				
				}
				});
         		
         		
         	
         	
        
         	
         });
         
         


    });

</script>
<script>
 window.onload = function() {
 	$("#jsGrid").jsGrid("refresh");
var JsDBSource = {
	
    loadData: function (filter) {
    	
        console.log(filter);
        var d = $.Deferred();
      
        $.ajax({
            type: "GET",
         
     url: '<?php echo Yii::$app->homeUrl;?>?r=auth-project-module/jsgridindex',
            success: function(response) {
            	
                var filtered_data = $.grep(response, function (client) {
                	
            
                     return (!filter.p_autoid || client.p_autoid.indexOf(filter.p_autoid) > -1)
                        && (!filter.moduleName || client.moduleName === filter.moduleName)
                        && (!filter.moduleCode || client.moduleCode.indexOf(filter.moduleCode) > -1)
                        && (!filter.moduleMultiple || client.moduleMultiple === filter.moduleMultiple)
                            && (!filter.moduelRoot || client.moduelRoot === filter.moduelRoot)
                             && (!filter.FAIcon || client.FAIcon === filter.FAIcon)
                              && (!filter.userAction || client.userAction === filter.userAction)
                               && (!filter.sortOrder || client.sortOrder === filter.sortOrder)
                              
                        
                });
                d.resolve(filtered_data);
            }
        });
        return d.promise();
    },

    insertItem: function (item) {
        return $.ajax({
            type: "POST",
          url: '<?php echo Yii::$app->homeUrl;?>?r=auth-project-module/gridcreate',
            data: item
        });
    },

    updateItem: function (item) {
    	var autoid=item.p_autoid;
        return $.ajax({
            type: "POST",
            url: '<?php echo Yii::$app->homeUrl;?>?r=auth-project-module/gridupdate&id='+autoid,
            data: item
        });
    },

    deleteItem: function (item) {
    	var autoid=item.p_autoid;
        return $.ajax({
            type: "DELETE",
            url: '<?php echo Yii::$app->homeUrl;?>?r=auth-project-module/griddelete&id='+autoid,
            data: item
        });
    },

};



!function($) {
    "use strict";

    var GridApp = function() {
        this.$body = $("body")
    };
    GridApp.prototype.createGrid = function ($element, options) {
        var defaults = {
            height: "450",
            width: "100%",
            filtering: true,
            editing: true,
            
            inserting: true,
          
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
         //  deleteConfirm: "Do you really want to delete the entry?"
        };

        $element.jsGrid($.extend(defaults, options));
    },
    GridApp.prototype.init = function () {
        var $this = this;

        var options = {
            fields: [
            
                {name: "p_autoid",title:'Auto Id', width: 30},
                 {name: "moduleName",title:'Module', type: "text", width: 100},
                  {name: "moduleCode",title:'Code', type: "text", width: 100},
                   {name: "moduleMultiple",title:'Option', type: "text", width: 100},
                    {name: "moduelRoot",title:'Root', type: "text", width: 100},
                      {name: "userAction",title:'Action', type: "text", width: 100},
                    
                      {name: "FAIcon",title:'Icon', type: "text", width: 130},
                        {name: "sortOrder",title:'Order', type: "text", width: 130},
               
              
                {type: "control"}
            ],
            controller: JsDBSource,
        };
        $this.createGrid($("#jsGrid"), options);

    },
  
    $.GridApp = new GridApp, $.GridApp.Constructor = GridApp

}(window.jQuery),

function($) {
    "use strict";
    $.GridApp.init();
}(window.jQuery);
};
</script>
