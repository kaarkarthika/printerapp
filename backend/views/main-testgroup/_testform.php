<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\LabTesting;
use backend\models\LabTestgroup;
use backend\models\Taxgrouping;

/* @var $this yii\web\View */
/* @var $model backend\models\Testgroup */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Test Grouping';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

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
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
</div>
<div class="panel-body" style="min-height:600px;">
<div class="testgroup-form">
<div class="row" style="margin:0;">
 		<?php $form = ActiveForm::begin(['id'=>'testgroup-form']); ?>
 		<div class="row">
			<div class="col-sm-3">
				<?= $form->field($model, 'testgroupname')->dropdownlist($testgrouplist,['value'=>$model->testgroupname,'prompt'=>'Select Test Group','class'=>'selectpicker testgroupname', 'data-live-search'=>'true','data-style'=>"btn-default btn-custom1",'required' => true])->label("Select Test Group"); ?>
				   <span id="loadtex" style="display: none; "></span>
     		</div>
     		<div class="col-sm-3" style="position: relative;top: 25px;">
     			<?= Html::a('Add New Master Group', ['create'], ['class' => 'btn btn-success addcat']) ?>
     		</div>
  </div> 
     	<div class="row">
     		<div class="col-sm-3"> 
     			
		<div class="testname_val" id="testname_val" >	
			<label class="control-label" for="testgroupsearch-testgroupname">Select Group</label>
			<select id="user_idz" class="selectpicker " name="test_name[]" multiple="" style="color: #fff !important;" size="4" title="Select Testing" data-style="btn-default btn-custom cus-fld" data-live-search="true" aria-required="true" tabindex="-98" aria-invalid="false" required >
			
    		<?php 
    		if(!empty($res_value)){
    				 foreach($res_value as $key => $value ){ ?>
					<option value="<?php echo $key; ?>"><?php echo $value;?></option>	
				<?php } }?>
    	  
    		</select>
    		</div>
				
			<span id="loadtex" style="display: none; ">Test  Name Already Exists</span>
     		</div>
     		<div class="col-sm-3" style="position: relative;top: 25px;">
     				<?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save Test' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success save_test' : 'btn btn-primary updatecategory']) ?>
     			
     		</div>
     	</div>
		<?php ActiveForm::end(); ?>
	</div>
 
    
   <div class="row">
    		<div class="test_values">
    			<?php
    echo $ret_list_html;
    ?>
		</div>
   	</div>
</div>
</div>
</div>
</div>
</div>
<style>
	.field-labtesting-test_name,.test_group,input#adddata{
		display:none;
	}
	input#adddata{		     float: left;    margin-right: 15px;	}
	table#list td {
    	    text-align: center;
	}
	table#list thead td {
    	background: #ff8888;
    	color: #fff;
	}
	table#list {
    	width: 40%;
    	margin: auto;
	}
	span.remove_li {
    cursor: pointer; text-align:center;
    background: #f00;
    padding: 4px 8px;
    border-radius: 6px;
    color: #fff;
}

</style>
<script>

    $('body').on('click','.rem_item', function(){
    	var std=$(this).data('id');
    	if(confirm("Are you sure want to delete ?")){
    	$.ajax({
	        url: '<?php echo Yii::$app->homeUrl . '?r=main-testgroup/remove&id='?>'+std,
	        success: function (data) {
	        if(data){
	        	 location.reload();
	        }else{
	        	Alert(data);
	        }
	      },
	       
	    });
	    }
    });

 $('body').on("click",".addcat",function(){ 
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=testgroup/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Group Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
    
     $( "#maintestgroupsearch-testgroupname" ).change(function() {
     	var text = $("select#maintestgroupsearch-testgroupname").val();
     	 $.ajax({
        url: '<?php echo Yii::$app->homeUrl .'?r=main-testgroup/grouptest&id='?>'+text,
        success: function (data) {
        $("#load").hide(4);
        data1 = JSON.parse(data);
        $("#user_idz").find('option').remove();
       	$("#user_idz").append(data1['drop']);
       	$("#user_idz").selectpicker('refresh');
       	// $('#testname_val').html(data1['drop']);
         $('.test_values').html(data1['tbl']);
                  
         $(".cls-norecors").css('display','none');
      },
       
    });
     	
    }); 

</script>