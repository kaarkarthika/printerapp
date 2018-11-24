<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
$datatables = $dataProvider->getModels();
$this->title = Yii::t('app', 'Return');
?>
<style>
	#load{
		display: none;
position: fixed;
left: 128px;
top: 27px;
width: 100%;
height: 100%;
z-index: 9999;
margin-top: 20%; 
	}
		input.error{
		background: rgb(251, 227, 228);
border: 1px solid #fbc2c4;
color: #8a1f11;

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
						<div id="load"  align="center"><img src="<?= Url::to('@web/dmc.gif') ?>" />Loading...</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading"></div>
<div class="panel-body">
<?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
<?php if(count($datatables)>0){ ?>
             <table id="datatable-fixed-col" class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>S.No</th>
             <th>Name</th>
             <th>Gender</th>
             <th>Medical Record Number</th>
             <th>Phone Number</th>
             <th>Invoice Number</th>
             <th>Invoice Date</th>
             <th style="width:100px;">Action</th>
             </tr>
             </thead>
             <tbody>
             	<?php $i=0;
			foreach ($datatables as $key => $value) {$i++; ?>
                         <tr>
                                	<td><?php echo $i;?></td>
                                    <td><?php echo $value->name;?></td>
                                    <td><?php echo $value->gender;?></td>
                                    <td><?php echo $value->mrnumber;?></td>
                                    <td><?php echo $value->phonenumber;?></td>
                                    <td><?php echo $value->billnumber;?></td>
                                    <td><?php echo $value->invoicedate;?></td>
                                    <td><button type='button' class='btn btn-default btn-custom  return' data-id="<?php echo $value->opsaleid;?>">Choose</button></td>
                                    </tr>
                             <?php  } 	?>
             </tbody>
             </table>
             <?php } ?>
               <div class="row" id="formdetails" style="display: none">
</div>
</div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){
    	$(".dt-buttons").hide();
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Patient</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         	$('body').on("click",'.product_add',function(){
 $("#load").fadeIn("slow");
  var form = $("#wizard-validation-form1");
 var formData = form.serialize();
 $.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=salesreturn/productdetails',
        type: 'post',
       data: formData,
        success: function (data) {
        	$("#load").fadeOut("slow");
        	$("#productlist").html(data);
        	$(".dt-buttons").hide();
        }
     });
	});
	
	$('body').on("input",'.productqty',function(evt){	
   var self = $(this);
   self.val(self.val().replace(/[^0-9]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
   var valz=$(this).val();
   var attz=$(this).attr('datacls');
   var perprice=$(this).attr('dataprice');
   var totalprice=(perprice)*(valz);
  $("#"+attz).text("Rs."+totalprice);
   $("#"+attz+"1").val(totalprice);
   var totla_each = 0;
   $('.pricez').each(function(){
   	 totla_each += parseFloat(this.value) || 0;
   
});
$("#total").text("Rs."+totla_each);
$("#totalprice").val(totla_each);

 });
		$(".productqty").keyup(function(){	
			alert();
		});
	
	
     
       

   	$('body').on("click",'.return',function(){
	var dataid=$(this).attr('data-id');
	$("#load").fadeIn("slow");
	$("#formdetails").fadeOut("slow");
	$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=salesreturn/patientdetails&id='+dataid,
        type: "post",
        success: function (data) {
        $("#formdetails").empty();
        $("#formdetails").html(data);
        $("#load").fadeOut("slow");
        $("#gen").attr('disabled',true).selectpicker('refresh');
        $("#vendor_idz").selectpicker('refresh');
        $("#product_idz").selectpicker('refresh');
        $("#formdetails").fadeIn("slow");
        }
     });
	})
    });
    
function noti () {
  $.Notification.autoHideNotify('custom', 'top right', 'Return Product Successfully Added.');
}

</script>