<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Specialistdoctor;
/* @var $this yii\web\View */
/* @var $model backend\models\Physicianmaster */
/* @var $form yii\widgets\ActiveForm */




?>


<link href="<?php echo Url::base(); ?>/timetable/jquery.schedule.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Url::base(); ?>/timetable/jquery.schedule.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Url::base(); ?>/timetable/jquery.schedule-demo.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Url::base(); ?>/timetable/jquery.schedule-demo.min.css" rel="stylesheet" type="text/css" />

   <script type="text/javascript" src="<?php echo Url::base(); ?>/timetable/jquery.schedule.js"></script>  
   <script type="text/javascript" src="<?php echo Url::base(); ?>/timetable/jquery.schedule.min.js"></script>
   <script type="text/javascript" src="<?php echo Url::base(); ?>/timetable/js/jquery-ui.js"></script>


	
<div class="physicianmaster-form">
	
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">

</div>
<h4 class="page-title"> Timetable</h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo 'Timetable';?></a></li>
								</ol>
							</div></div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
		
</div>
<div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
	<?php 
	
		$Specialistdoctor=Specialistdoctor::find()->where(['is_active'=>'1'])->andWhere(['s_id'=>$model->specialist])->one();
	?>
	<table class='table table-bordered'>
		<thead>
		<tr>
			<th>Physician Name</th>
			<th>Qualification</th>
			<th>Specialist</th>
			<th>Action</th>
			
		</tr>
		</thead>
		<tbody>
			<td><?php echo $model->physician_name; ?></td>
			<td><?php echo $model->qualification; ?></td>
			<td><?php echo $Specialistdoctor->specialist; ?></td>
			<td><?php echo Html::button('Schedule & Save',['class' => 'btn btn-default waves-effect waves-light','id'=>'export']);?></td>
		</tbody>
	</table>
	<br/>
	<br/>
	
	<div id="schedule-demo"></div>
	



    <?php ActiveForm::end(); ?>
</div>
									</div>
								</div>
							</div>
							

</div>
<script>
<?php  if($model->timetable != ''){
	 ?>
	 
	$("#schedule-demo").jqs({
 
  
  mode: "edit", // read
  hour: 24, // 12
  periodDuration: 60, // 15/30/60
  data: <?php echo json_decode($model->timetable);?>,
  periodOptions: true,
  periodColors: [],
  periodTitle: "",
  periodBackgroundColor: "rgba(82, 155, 255, 0.5)",
  periodBorderColor: "#2a3cff",
  periodTextColor: "#000",
  periodRemoveButton: "Remove",
  periodDuplicateButton: 'Duplicate',
  periodTitlePlaceholder: "Title",
  days: [
  	  
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
  ],
  onInit: function () {},
  onAddPeriod: function () {},
  onRemovePeriod: function () {},
  onClickPeriod: function () {},
  onDuplicatePeriod: function () {},
});
<?php }else if($model->timetable == '') { ?>
	
	
	$("#schedule-demo").jqs({

  mode: "edit", // read
  hour: 24, // 12
  periodDuration: 60, // 15/30/60
  data: [],
  periodOptions: true,
  periodColors: [],
  periodTitle: "",
  periodBackgroundColor: "rgba(82, 155, 255, 0.5)",
  periodBorderColor: "#2a3cff",
  periodTextColor: "#000",
  periodRemoveButton: "Remove",
  periodDuplicateButton: 'Duplicate',
  periodTitlePlaceholder: "Title",
  days: [
  	  
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
  ],
  onInit: function () {},
  onAddPeriod: function () {},
  onRemovePeriod: function () {},
  onClickPeriod: function () {},
  onDuplicatePeriod: function () {},
});
<?php } ?>	


 // export

 ;(function($){
  	
  	$("#export").click(function () 
  	{
  		var model_prime_id='<?php echo $model->id; ?>'
  		
  		var data = $("#schedule-demo").jqs('export');
  		//var myJSON = JSON.stringify(data);
  		var r = confirm("Are U Sure Want to Save Your Timetable");
  		var txt;
		if (r == true && data != '') 
		{
			
			
			$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . '?r=physicianmaster/timetableschedule';?>&id="+model_prime_id,
	            data: {jsondata:data},
	            //dataType: "json",
	            success: function (result) 
	            {
	            	if(result == 'Y')
	            	{
	            		alert('Your Time Table Successfully Saved');
	            	}
	            	else if(result == 'N')
	            	{
	            		alert('Something Went Wrong');
	            	}
	            }
	        });   
		} 
		else 
		{
		    txt = "You pressed Cancel!";
		}
	});
	
})(jQuery);



</script>
