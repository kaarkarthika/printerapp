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
     			<?= Html::a('Add New', ['create'], ['class' => 'btn btn-success addcat']) ?>
     		</div>
  </div> 
     	<div class="row">
     		<div class="col-sm-3"> 
     		
		<div class="testname_val" id="testname_val" >	
			<label class="control-label" for="testgroupsearch-testgroupname">Select Test</label>
			<!-- <select id="user_idz" class="selectpicker " name="test_name[]" multiple="" style="color: #fff !important;" size="4" title="Select Testing" data-style="btn-default btn-custom cus-fld" data-live-search="true" aria-required="true" tabindex="-98" aria-invalid="false" required >
				
    		<?php  if(!empty($res_value)){
    			foreach($res_value as $key => $value ){ ?>
					<option value="<?php echo $key; ?>"><?php echo $value;?></option>	
				<?php } 
    		} ?>
    		</select> -->
    		<select id="user_idz" class="selectpicker " name="test_name[]" style="color: #fff !important;" size="4" title="Select Testing" data-style="btn-default btn-custom cus-fld" data-live-search="true" aria-required="true" tabindex="-98" aria-invalid="false" onChange="myNewFunction(this);" >
    		<?php  foreach($res_value as $key => $value ){ ?>
					<option value="<?php echo $key; ?>"><?php echo $value;?></option>	
				<?php } ?>
    	
    		</select>
    		</div>
    		
				
			<span id="loadtex" style="display: none; ">Test  Name Already Exists</span>
     		</div>
     		<div class="col-sm-3">
				<label>Price</label>
				<input type="text" name="price" id="price" class=" form-control" onkeypress="javascript:return isNumber(event)">		
			</div>	
     		<div class="col-sm-3" style="position: relative;top: 25px;">
     			<input type='button' class="btn btn-success" value = ' +' id = 'adddata'>
     				<!-- <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save Test' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success save_test' : 'btn btn-primary updatecategory']) ?> -->
     			
     		</div>
     	</div>
     	  
   <div class="row">
    		<div class="test_values">
    			<?php
    echo $ret_list_html;
    ?>
 
		</div>
     	<div class="col-sm-6 save_btn" style="position: relative;top: 25px;">
     			 <!-- <input type='button' class="btn btn-success" value = ' +' id = 'addtest'> -->
     			    	<input type="hidden" name="saved_val" id='saved_val'>
     			 <!--<button type="button" class="btn  btn-sm btn-success save_billing" id="saves_sucess" onclick="savesdata();">Save</button>-->	
     			 <a href="/2018/dmcpharmacy/backend/web/index.php?r=testgroup/testgroupmaster" class="btn btn-primary b-width btn btn-bk b-width">Back To Grid </a>
    			<button type="reset" class="btn btn-warning b-width clearform" onclick="ClearForm();">Clear</button>
     			 
     		</div> 
		<?php ActiveForm::end(); ?>
	</div>
 
  

   	</div>
	

</div>
</div>
</div>
</div>
</div>
<style>
	.field-labtesting-test_name,.test_group{
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
.save_btn button, .save_btn a {
    width: 100px;
    float: left;
    margin-right: 10px;
}
table#list_val td {
    text-align: center;
}
</style>
<script>

    $('body').on('click','.rem_item', function(){
    	var std=$(this).data('id');
    	if(confirm("Are you sure want to delete ?")){
    	$.ajax({
	        url: '<?php echo Yii::$app->homeUrl . '?r=testgroup/remove&id='?>'+std,
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
$( ".testgroupname" ).change(function() {
	var text = $("select#testgroupsearch-test_name").val();
	var url_string = window.location.href; 
	var url = new URL(url_string);
	var id = url.searchParams.get("id");
	
    $.ajax({
        url: '<?php echo Yii::$app->homeUrl . '?r=testgroup/check&id='?>'+text+'<?php echo "&gid="?>'+id,
        success: function (data) {
        $("#load").hide(4);
        if(data==true){ 
        	$("#loadtex").css('color','red ');
        	$("#loadtex").show(4);
        }else{
        	$("#loadtex").hide(4);
        	$("button.save_test").css('pointer-events','auto ');
        }
      },
       
    });
});




 $('body').on("click",".addcat",function(){ 
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=testgroup/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Group Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
    
     $( "#testgroupsearch-testgroupname" ).change(function() {
     	var text = $("select#testgroupsearch-testgroupname").val();
     	 $.ajax({
        url: '<?php echo Yii::$app->homeUrl .'?r=testgroup/grouptest&id='?>'+text,
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
    
    
    
  $(document).ready(function () {  
	 var $fs='<?php echo $i; ?>';
	 var $inc='<?php echo $inc=1; ?>';
    $('#adddata').click(function(){ 
    	
    	//alert(rowCount); 
    	
    	$(".table.table-striped.table-bordered.cls-norecors").css("display", "none");
    	$(".no-records").css("display", "none");
    	
    	var testname = $("#user_idz").val();
	    var price = $("#price").val();
	    var select_testname=$("#user_idz option:selected").text();
	    var rowCount = $('tbody.fetch_data tr').length;
	    rowCount++;
    	$inc=rowCount;
    	var $testid=testname;
	    if(testname!="" && price!=""){
	    	
	    	$fa_testname='<input type="hidden" id="hid_testname'+$fs+'" name="hid_testname[]" value="'+testname+'" >';
	    	$fa_price='<input type="hidden" id="hid_price'+$fs+'" name="hid_price[]" value="'+price+'">';
	    	$cls='<span class="remove_li " data-toggle="tooltip" title="Remove">X</span>';
	    	    
	    var li = "<tr><td>"+$inc++ + " </td><td>"+ select_testname +$fa_testname+ " </td><td class='gen' style='text-transform: capitalize'>"+price+$fa_price+ "</td><td>" + $cls +"</td></tr>"; 
	    $(".fetch_data").append(li);
	     
	    $fs++;
	   	 $("#idea").focus();
	    	document.getElementById('user_idz').value = "";
	    	document.getElementById('price').value = "";
	    	savesdata();
	    		window.location.reload();
	    }else{
	    		alert("Required..");
	    }
	    window.location.reload();
	});
	
	
	
	
	
});
  $('body').on('click','.remove_li', function(){ 	
    	$(this).closest('tr').remove();
    });

function myNewFunction(sel) {
  var selname =sel.options[sel.selectedIndex].text;
}
   
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
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
              		  		window.location.reload();	
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
  
function savesdata(){
	var testname=$("#testgroupsearch-testgroupname").val();
	var testing=$("#user_idz").val();
	if(testname!=""){ $(".loadtex").css("display", "none");
		 if(testing!="null"){
				if (confirm('Are You Sure to Lab Test ?')) {
				$.ajax({ 
					type: "POST",			
		            url: "<?php echo Yii::$app->homeUrl . "?r=testgroup/addcreate";?>",
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
			$(".loadtex").text('Test Name is Required');
			$(".loadtex").css("display", "block");
			$(".loadtex").css("color", "red");
			//alert("Test Name is Required..");
		}		
	}else{
		$(".loadtex1").text('Test Group Name is Required..');
		$(".loadtex1").css("display", "block");
		$(".loadtex1").css("color", "red");
		//alert("Test Group Name is Required..");
	}
	$('#labtestingsearch-test_name').focus();
	window.location.reload();
	  		
}

</script>