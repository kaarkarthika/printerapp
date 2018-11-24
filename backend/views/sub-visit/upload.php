<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Newpatient;
use yii\helpers\Url;
$this->title = 'Upload Image';
/* @var $this yii\web\View */
/* @var $model backend\models\Newpatient */
/* @var $form yii\widgets\ActiveForm */

use kartik\file\FileInput;

?>

<link href="<?php echo Url::base(); ?>/sampSlider/sampslider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/sampSlider/sampslider.js"></script>

  <!--style>
  form#w0 .form-group.field-image.has-success {
    width: 100%;
}

.form-group.field-image {
    width: 100%;
}

button.btn.btn-default.fileinput-remove.fileinput-remove-button
{
	    height: 38px !important;
}

.btn.btn-primary.btn-file {
	    height: 38px !important;
}

* {
    box-sizing: border-box;
}

.column {
    float: left;
    width: 20.33%;
    padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
    content: "";
    clear: both;
    display: table;
}

  </style-->
 
  
<div class="container">
<div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
							</div></div>

					     
					
					
	<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body" style="height:1000px;">
					
				 	
					
				 	
 <?php $form = ActiveForm::begin(['options' => ['class'=>'form-inline','enctype' => 'multipart/form-data']]) ?>

	 <div>
	  <div class="col-sm-4">
        <label for="avatar">Profile picture:</label>
        <input type="file" id="avatar" class="filestyle"  multiple required name="upload_picture[]" />
		</div>
        <div class="col-sm-3 fl-mt-25">
          <?= Html::submitButton('Create & Add New', ['class' => 'btn btn-primary']) ?>
    </div>			
    </div>			
    		
    	<br>	
    	<br><br><br><br><br>	
    		



    		
    		
    		
    		
    		
    						
   <div class="col-md-12">
   	
    
	  
	   
		<!--li class="samp-container"><img src="slides/2.jpg"></li>
		<li class="samp-container"><img src="slides/3.jpg"></li>
		<li class="samp-container"><img src="slides/4.jpg"></li>
		<li class="samp-container"><img src="slides/5.jpg"></li>
		<li class="samp-container"><img src="slides/6.jpg"></li-->
	 
	

					
     <?php
  			//$path=array();
           $data=json_decode($upload_picture->upload_picture);
			
			if(!empty($data))
			{
			echo' <div id="demo" class="samp-slider samp-slider-mask">  <ul class="samp-container-horizontal"> ';
				foreach($data as $k)
				{
					 $img=$k;
					 $path= Url::base()."/uploads/subvisit/SUBVISIT_".$upload_picture->sub_id.'/'.$img;
					
					echo'   <li class="samp-container"><img style="width:100%;height:100%;" src="'.$path.'"></li>';
				}
				echo ' </ul></div>';
				
		
				
			} 
			
   /*    echo $form->field($upload_picture, 'upload_picture[]')->widget(FileInput::classname(), [
        'options' => ['id' => 'image','style'=>'width:100%;','multiple' => true,'accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            //change here: below line is added just to hide upload button. Its up to you to add this code or not.
            'overwriteInitial' => true,
            'showPreview' => true,
            'showCaption' => true,
            'showUpload' => true,
            'showZoom' => true,
            'initialPreviewAsData'=>true,
             'initialPreview'=> $path,
             'initialPreviewConfig' => true,
            	
            
        ],
    ]);*/
                ?>						
							     
		
		
   
					    
	</div> 											
					    
					   
						
						
     
	
	


  
   <?php ActiveForm::end(); ?>


</div>
</div>
</div>

</div>
<script>



//(function($) {
$('#demo').sampSlider({
	// auto size images
autosize: true,
// width of the slideshow
width: 100,
// width overrides height with aspect ratio
height: 100,
// overrides autosize. when false it is calculated
aspectratio: true,
// 0 or delay in milliseconds
autoplay: 0,
// true to show drag-navi
dragonbar:true,
// true to show arrows navigation
arrows:true,
// infinite loop
loop: true,
// slide speed
slidespeed: 500,
// 1 and up
startslide: 1,
// if automatically scroll to top of slider
gototop: true,
// called before image switch
beforeslide: null,
// called after image switch
afterslide: null,
// callback

afterinit: function(){
  console.log('Vroom.');
}

});
//})(jQuery);

 </script>
	