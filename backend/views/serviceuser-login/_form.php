<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AuthUserRole;
use yii\helpers\ArrayHelper;
use backend\models\AuthProjectModule;
use backend\models\ModuleAction;
use backend\models\ServiceuserLogin;
use yii\helpers\Url;

?>
<style>
	th {
    background-color: #5fbeaa;
    color: white;
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
									<div class="panel-body">
    <?php $form = ActiveForm::begin(['id'=>'serviceuser-login-form']); ?>
<?php 
     	
     	if($model->isNewRecord){
     	echo '<div class="row"><div class="col-md-3">';	

    echo $form->field($model, 'auth_role')->dropDownList($roles,['prompt'=>'Select User Role','data-live-search'=>'true','class'=>'selectpicker','style'=>'margin-top:30px;'])->label(false) ;
    echo'  </div></div> ';
      
    }else{
			echo $form->field($model, 'auth_role')->hiddeninput()->label(false) ;
			echo '<div class="col-md-12"><label><h4 align="right">User Role : '.ucfirst($model->auth_role).'</h4></label> </div>';
      
		}
 
 $in_module1 = json_decode($model->assign_service);
 
$in_module2= json_decode($model->assign_action);
//echo "<pre>";
//print_r($in_module2);die;
$actz_array=array();
if($in_module2!=""){
foreach($in_module2 as $key=>$vaz){
	$actz_array[$key]=explode(',', $vaz);

}
}

 $services = AuthProjectModule::find()->where(['IN','p_autoid',$in_module1])->all();
$checkedservice =array();
foreach($services as $ser) {
	$checkedservice[]= $ser->p_autoid;
}
$model->assign_service = $checkedservice;
$project_module=AuthProjectModule::find()->all();
       $actions="";
	  $in_module="";
	  $checked_state="";
	  $actionhtml="";	

 ?>
 <div class="col-md-12">
<div class="col-md-6">
   	 <?= $form->field($model, 'id')->hiddenInput(['maxlength' => true,'id'=>'rightsid'])->label(false); ?>
   </div>
      </div>                              
	  <table class="table table-bordered table-hover">
	  	<?php		
	  			if ($model->isNewRecord) {
			$actionhtml.="<tr><th style='width:220px;'> <div class='checkbox checkbox-danger '>
			 <input type='checkbox'class='ckbCheckAll'  name='selectall'/>  <label >
		                                                Module
		                                            </label>  </div></th>";
	  	foreach(ModuleAction::find()->all() as $res)
	  	{
	  		$actionhtml.= "<th style='text-align:center;'>".$res->action_name."</th>";
			
	  	}
	  	 $actionhtml.="</tr>";
				}
				else{$actionhtml.="<tr><th style='width:220px;'>Modules</th>";
	  	foreach(ModuleAction::find()->all() as $res)
	  	{
	  		$actionhtml.= "<th style='text-align:center;'>".$res->action_name."</th>";
			
	  	}
	  	 $actionhtml.="</tr>";
					
				}
	  	echo $actionhtml;
	  	     $i=0;
      	foreach($project_module as $module_value)
      	{
      			
      		$in_module = json_decode($module_value->action);
				
	      	if (!$model->isNewRecord) 
	      	{
	      		if(in_array($module_value->p_autoid, $in_module1))
	      		{
	    			$model->assign_service = $module_value->p_autoid;
					$selected=true;
				}
				else 
				{
					$selected=false;	
				}
			}
			
		    $class="moduleclass".$i;
		    echo " <tr> <td >";
			
			
		    echo $form->field($model, 'assign_service', [
		    'template' => "<div class='checkbox checkbox-danger' style='margin-top:0px;'>{input}<label>$module_value->moduleName</label></div>{error}",
		     ])->checkbox(['name'=>'assignservice[]','id'=>'ser','class'=>$class,'label'=>$module_value->moduleName,'value'=>$module_value->p_autoid,'selected'=>$selected],false);
		    
		   
		    echo '</td>';


 
     
        $data = ModuleAction::find()->all();
		foreach($data as $k)
		{
	         $matchmenuaction=0;
			 if($in_module!="")
           {
		     	$actions="";
		     	$checked_state="";	
			  foreach($in_module as $action_value)
			  {           
      			$actions = ModuleAction::find()->where(['actionid'=>$action_value])->one();	
				if (!$model->isNewRecord) 
				{
					$checked_state="";	
					if($actz_array[$module_value->p_autoid]!="")
					{
						//	$checked_state="checked";	
						
							
						 if(in_array($actions->action_key, $actz_array[$module_value->p_autoid]))
						 
						 {	
			             	$checked_state="checked";
						 }
					}
					if(($actions->action_key)==($k->action_key))
					{
					echo "<td style='text-align:center;'>
					<div class='checkbox checkbox-danger '>
					<input type='checkbox' class='actionclass$i'  name='serviceaction$module_value->p_autoid[]' value='$actions->action_key' $checked_state />
					<label > </label></div>
					</td> ";
					$matchmenuaction=1;	
					}
					
					 
				}
				else{
					if(($actions->action_key)==($k->action_key))
					{
					echo "<td style='text-align:center;'>
					<div class='checkbox checkbox-danger' >
					<input type='checkbox' data-toggle='tooltip' data-placement='bottom'  data-original-title='Tooltip on bottom' class='actionclass$i'  title='$k->action_name' name='serviceaction$module_value->p_autoid[]' 
					value='$actions->action_key'  /> <label > </label></div> </td> ";
		                                            
		                                           
					
					$matchmenuaction=1;	
					}
					
				}
    // echo $form->field($model, 'assign_action')->checkbox(['name'=>'serviceaction'.$module_value->p_autoid.'[]','label'=>$actions->action_name,'value'=>$actions->action_key]);
	    
	     }
		 }
                     if($matchmenuaction==0){echo "<td></td>";}
		}
	 
   echo "</tr>";
       	 ++$i;}
         $count=$i;
       	echo $actionhtml;	
	  ?>
       	</table>
      
    <div class="form-group ">
    	
       <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right add_rights waves-effect' : 'btn btn-primary pull-right add_rights  waves-effect','style'=>'margin-bottom: 2%;']) ?>
  
    </div>
    <div class="clearfix"></div>
 </section>
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
</div>
 <script>
 /*$(".add_rights").on('click',function(){
 	
 	var value=$('input[id="ser"]:checked').val();
 	if(value==undefined){
 		alert("please check atleast one module");
 		return false;
 	}
 	else{
 		$('#serviceuser-login-form').yiiActiveForm('submitForm');
 	}
 	
 	
 });*/
 
<?php	
if ($model->isNewRecord) {
for($j=0;$j<=$count;$j++)
	{ ?>
		
	$(".moduleclass<?php echo $j;?>").change(function(){ var status = this.checked; 
    $(".actionclass<?php echo $j;?>").each(function(){   this.checked = status;  });});
<?php	}?>
	
	$(".ckbCheckAll").change(function(){
		
    var status = this.checked; 
    var counter = <?php echo $count; ?>;
    for (var i = 0;i<counter;i++) {
    $('.moduleclass'+i).each(function(){  
    this.checked = status;  });
    $('.moduleclass'+i).each(function(){
    var status = this.checked; 
    $('.actionclass'+i).each(function(){ 
        this.checked = status; 
    });
});
        }
   
 });
 <?php } 
   else {
for($j=0;$j<=$count;$j++)
	{ ?>
		
	$(".moduleclass<?php echo $j;?>").change(function(){ var status = this.checked; 
    $(".actionclass<?php echo $j;?>").each(function(){   this.checked = status;  });});
<?php	}?>
	

 <?php } ?>
 
 
 
		
	</script>