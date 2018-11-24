<?php
   use yii\helpers\Html;
   use yii\grid\GridView;
  
use yii\widgets\ActiveForm;
   use yii\widgets\Pjax;
   $this->title = Yii::t('app', 'Compose Mail');
   
   ?>
<style>
	.p-20 {padding: 17px !important;}
	.card-box{padding:0px;}
	
	
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
            <div class="panel-heading"></div>
            <div class="panel-body">
               <!-- ============================================================== -->
               <!-- Compose -->
               <!-- ============================================================== -->                      
               <div class="">
                  <!-- Start content -->
                  <div class="content">
                     <div class="container">
                        <div class="row">
                           <!-- Left sidebar -->
                           <div class="col-lg-3 col-md-4">
                              <div class="p-20">
                                 <a href="<?php echo Yii::$app->homeUrl;?>?r=emailtemplate/index" class="btn btn-danger btn-rounded btn-custom btn-block waves-effect waves-light">Back to inbox</a>
                                 <div class="list-group mail-list  m-t-20">
                                    <a href="email-inbox.html" class="list-group-item b-0 active"><i class="fa fa-download m-r-10"></i>Inbox <b>(8)</b></a>
                                    <a href="#" class="list-group-item b-0"><i class="fa fa-star-o m-r-10"></i>Starred</a>
                                    <a href="#" class="list-group-item b-0"><i class="fa fa-file-text-o m-r-10"></i>Draft <b>(20)</b></a>
                                    <a href="#" class="list-group-item b-0"><i class="fa fa-paper-plane-o m-r-10"></i>Sent Mail</a>
                                    <a href="#" class="list-group-item b-0"><i class="fa fa-trash-o m-r-10"></i>Trash <b>(354)</b></a>
                                 </div>
                                 <h3 class="panel-title m-t-40">Labels</h3>
                                 <div class="list-group b-0 mail-list">
                                    <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>Web App</a>
                                    <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-warning m-r-10"></span>Project 1</a>
                                    <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-purple m-r-10"></span>Project 2</a>
                                    <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-pink m-r-10"></span>Friends</a>
                                    <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-success m-r-10"></span>Family</a>
                                 </div>
                              </div>
                           </div>
                           <!-- End Left sidebar -->
                           <!-- Right Sidebar -->
                           <?php $form = ActiveForm::begin(['id'=>'send_email_form']); ?>
                           <div class="col-lg-9 col-md-8">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="card-box m-t-20">
                                       <div class="p-20">
                                          <form role="form">
                                             <div class="form-group">
                                                <!-- <input type="email" class="form-control" placeholder="To"> -->
                                                <?= $form->field($model, 'userto')->textInput(['maxlength' => true,'placeholder'=>'To'])->label(false) ?>
                                                <input type="hidden" name="emailkey" id="emailkey"/>
                                             </div>
                                             <div class="form-group">
                                                <div class="row">
                                                   <div class="col-md-6">
                                                      <!-- <input type="email" class="form-control" placeholder="Cc"> -->
                                                      <?= $form->field($model, 'cc')->textInput(['maxlength' => true,'placeholder'=>'Cc'])->label(false) ?>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <!-- <input type="email" class="form-control" placeholder="Bcc"> -->
                                                      <?= $form->field($model, 'bcc')->textInput(['maxlength' => true,'placeholder'=>'Bcc'])->label(false) ?>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <!-- <input type="text" class="form-control" placeholder="Subject"> -->
                                                 <?= $form->field($model, 'subject')->textInput(['maxlength' => true,'placeholder'=>'Subject'])->label(false) ?>
                                             </div>
                                             <div class="form-group">
                                                <div class="summernote">
                                                   <!-- <h6>Hello Summernote</h6>
                                                   <ul>
                                                      <li>
                                                         Select a text to reveal the toolbar.
                                                      </li>
                                                      <li>
                                                         Edit rich document on-the-fly, so elastic!
                                                      </li>
                                                   </ul>
                                                   <p>
                                                      End of air-mode area
                                                   </p> -->
                                                </div>
                                                <!-- <textarea id="elm1" name="message_content"></textarea> -->
                                             </div>
                                             <div class="btn-toolbar form-group m-b-0">
                                                <div class="pull-right">
                                                   <button type="button" class="btn btn-success waves-effect waves-light m-r-5 emailsend" data-id="2"><i class="fa fa-floppy-o"></i></button>
                                                   <button type="button" class="btn btn-success waves-effect waves-light m-r-5 emailsend" data-id="3"><i class="fa fa-trash-o"></i></button>
                                                   <button class="btn btn-purple waves-effect waves-light emailsend" data-id="1"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
                                                  
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- End row -->
                           </div>
                           <?php ActiveForm::end(); ?>
                           <!-- end Col-9 -->
                        </div>
                        <!-- End row -->
                     </div>
                     <!-- container -->
                  </div>
                  <!-- content -->
               </div>
               <!-- ============================================================== -->
               <!-- End compose -->
               <!-- ============================================================== -->
               
               <!-- Add your content here-->
            </div>
         </div>
      </div>
   </div>
</div>
  <script src="../web/plugins/tinymce/tinymce.min.js"></script>
<script>

$(document).ready(function () {
			    if($("#elm1").length > 0){
			        tinymce.init({
			            selector: "textarea#elm1",
			            theme: "modern",
			            height:300,
			            plugins: [
			                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			                "save table contextmenu directionality emoticons template paste textcolor"
			            ],
			            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
			            style_formats: [
			                {title: 'Bold text', inline: 'b'},
			                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			                {title: 'Example 1', inline: 'span', classes: 'example1'},
			                {title: 'Example 2', inline: 'span', classes: 'example2'},
			                {title: 'Table styles'},
			                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			            ]
			        });    
			    }  
			});

            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 250,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false         // set focus to editable area after initializing summernote 
                 
                });
            });
            
    $(document).on('click','.emailsend',function(event){
	z=x=$(this).attr("data-id");
	var text = $('.note-editable panel-body').text()

	$("#emailkey").val(z);
    var form = $('#send_email_form');
	$.ajax({
	    url:'<?php echo Yii::$app->homeUrl . '?r=emailtemplate/compose'; ?>' ,
	    type: 'post',
	    data: form.serialize(),
	    success : function(response){
	    	
	    }
	   })
  
});
        </script>