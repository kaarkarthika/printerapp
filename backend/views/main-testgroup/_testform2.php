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
<style>
.save_btn button,.save_btn a {
    width: 100px;
    float: left;    margin-right: 10px;
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
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body"  style="min-height:600px;">
<div class="testgroup-form">

<div class="row" style="margin:0;">
 		<?php $form = ActiveForm::begin(['id'=>'testgroup-form']); ?>
 		<div class="row">
			<div class="col-sm-3"> 
				<?= $form->field($model, 'testgroupname')->dropdownlist($testgrouplist,['prompt'=>'Select Test Group','class'=>'selectpicker testgroupname', 'data-live-search'=>'true','data-style'=>"btn-default btn-custom1",'required' => true])->label("Select Master Group"); ?>
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
				<?php } } ?>
    	
    		</select>
    		<span id="loadtex1" style="display: none; "></span>
    		</div>
				
				
     		</div>
     		<div class="col-sm-6 save_btn" style="position: relative;top: 25px;">
     			 <!-- <input type='button' class="btn btn-success" value = ' +' id = 'addtest'> -->   
     			 <input type="hidden" name="saved_val" id='saved_val'>
     			 <!-- <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i> ADD' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success savecategory' : 'btn btn-primary updatecategory']) ?> -->
     			 <button type="button" class="btn  btn-sm btn-success save_billing" id="saves_sucess" onclick="savesdata();">Save</button>
     			  <a href="/2018/dmcpharmacy/backend/web/index.php?r=main-testgroup/makegroupmaster" class="btn btn-primary b-width btn btn-bk b-width">Back To Grid </a>
    				<button type="reset" class="btn btn-warning b-width clearform" onclick="ClearForm();">Clear</button>
     		</div>
     	</div>
     
     	<div class="test_values">
   	<table class="table table-striped table-bordered" id="list_val" style=" margin-top: 20px;margin-bottom: 0; ">
    <thead>
      <tr>
        <th style="text-align: center;">SNO</th>
        <th style="text-align: center;">Group Name</th>
        <th style="text-align: center;">Action</th>
      </tr>
    </thead>
    </table>
    </div>
    <table class="table table-striped table-bordered cls-norecors"  align="center">
    <tbody>
    	<tr><td>No Records</td></thead>
    </tbody>	
    </table>  
			<?php ActiveForm::end(); ?> 
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
    cursor: pointer;
    background: #f00;
    padding: 4px 8px;
    border-radius: 6px;
    color: #fff;
}
button.btn.dropdown-toggle.bs-placeholder.btn-default.btn-custom.cus-fld {
    color: #fff !important;
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
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=main-testgroup/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Main Group Master</span>');
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
    
      
function savesdata(){
	var testname=$("#maintestgroupsearch-testgroupname").val();
	var testing=$("#user_idz").val();
	//alert(testname);
	if(testname!=""){	 $(".loadtex").css("display", "none");
		 if(testing!=""){
				if (confirm('Are You Sure to Lab Test ?')) { 
				$.ajax({ 
					type: "POST",			
		            url: "<?php echo Yii::$app->homeUrl . "?r=main-testgroup/addcreate";?>",
		            data: $("form#testgroup-form").serialize(),
		            success: function (result) 
		            { 
		            	
		            	var obj = $.parseJSON(result); //alert(obj[0]);alert(obj[1]);
		            	if(obj[0] === 'saved')
		            	{
                   			$("#saved_val").val(obj[1]);
		            		$('.save_billing').attr('disabled','disabled');
		            	}else if(obj[0] === 'notsave'){
		            		alert("Amount Value is Zero, So Not Saved ..");
		            		$("#saved_val").val(obj[1]);
		            		
		            	}
		            }
				});
		}
		}else{
			$(".loadtex1").text('Test Name is Required');
			$(".loadtex1").css("display", "block");
			$(".loadtex1").css("color", "red");
			//alert("Test Name is Required..");
		}		
	}else{
		$(".loadtex").text('Test Group Name is Required..');
		$(".loadtex").css("display", "block");
		$(".loadtex").css("color", "red");
		//alert("Test Group Name is Required..");
	}
	$('#labtestingsearch-test_name').focus();
}



     $(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) 
    {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's': 
              event.preventDefault();
            var  saved_val = $("#saved_val").val(); 
              	if(saved_val==""){
              		savesdata();	
            	}else{ 
              		alert("already Saved");
            	}	
            	break;
        case 'f':
            event.preventDefault();
          	  remove_all();
            alert('ctrl-f');
            break;
        case 'g':
            event.preventDefault();
            alert('ctrl-g');
            break;
        case 'c':
            event.preventDefault();
           	RemoveAll();
            break;
        }
    }
});    
function ClearForm () {
 
  window.location.reload(true);
}
 	$(document).ready(function () {
	$("#maintestgroupsearch-testgroupname").change(function(){
       if($("#maintestgroupsearch-testgroupname").val()==""){
       		 $(".loadtex").text('Main Group Name is Required');
			$(".loadtex").css("display", "block");
			$(".loadtex").css("color", "red");
       }else{
       		$(".loadtex").css("display", "none");
		
       }		
	});
});   

    
    
 </script>
