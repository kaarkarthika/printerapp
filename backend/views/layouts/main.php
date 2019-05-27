<?php
   /* @var $this \yii\web\View */
   /* @var $content string */
   
   use backend\assets\DashboardAsset;
   use yii\helpers\Html;
   use yii\bootstrap\Nav;
   use  yii\web\Session;
   use yii\bootstrap\NavBar;
   use yii\widgets\Breadcrumbs;
   use common\widgets\Alert;
   use yii\helpers\Url;
   use yii\bootstrap\Modal;
   use backend\models\BranchAdmin;
   use backend\models\Chat;
   use backend\models\CompanyBranch;
   use backend\models\User;
   
   DashboardAsset::register($this);


    $user_data = User::find()->where(['username' => $session['headlinestv_id']])->one();

   
   //session_start();
 ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
   <head>
      <meta charset="<?= Yii::$app->charset ?>">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
          <script type="text/ecmascript" src="<?php echo Url::base(); ?>/jq_grid/js/jquery.min.js"></script>
          <link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />
		  
		  
		 <!--  <link rel="stylesheet" type="text/css" media="screen" href="<?php // echo Url::base(); ?>/fonts/ubuntu-font.css" /> -->
		  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
          
      <?= Html::csrfMetaTags() ?>
      <title><?= Html::encode($this->title) ?></title>
      <?php $this->head() ?>
  	 
      <style>
         .card-box{padding:0px;}
         .chat_box{
         position:fixed;
         right:20px;
         bottom:0px;
         width:250px;
         }
         /*
         .chat_body{
         background:white;
         height:400px;
         padding:5px 0px;
         }
         */
         .chat_head,.msg_head{
         background:#f39c12;
         color:white;
         padding:15px;
         font-weight:bold;
         cursor:pointer;
         border-radius:5px 5px 0px 0px;
         }
         #load1 {
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          position: fixed;
          display: block;
          opacity: 0.9;
          background-color: #f9f9f794;
          z-index: 99;
          text-align: center;
          }
          .load-image{
            width:10%;
            margin:auto;
            position: absolute;
            left: 45%;
            top: 220px;
            z-index: 9999;
          }
         .select-val select#select-admin {
    		position: relative;
    		top: 15px;
    		padding: 0px 15px;   cursor: pointer;
   			/*  width: 150px;     left: 22%; */
		}
		.forced.enlarged select#select-admin {
    		left: 10%;
		}
		.select-val {
    			position: relative;
			}
         .msg_box{
         position:fixed; 
        /* position:relative;*/
         bottom:-5px;
         width:250px;
         background:white;
         border-radius:5px 5px 0px 0px;
		 float:right;
		 margin-left:10px;
         }
         .msg_head{
         /* background:#3498db;*/
         background:#5fbeaa;
         }
         .msg_body{
         background:white;
         height:200px;
         font-size:12px;
         padding:15px;
         overflow:auto;
         overflow-x: hidden;
         }
		 .chat-box{right:242px;z-index:9;display:none;}
		 
		 @media(max-width:414px){
			 
			 .chat-box{right: 67px!important;z-index: 999;display:none;}
		 }
         .msg_input{
         width:100%;
         border: 1px solid white;
         border-top:1px solid #DDDDDD;
         -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
         -moz-box-sizing: border-box;    /* Firefox, other Gecko */
         box-sizing: border-box;  
         }
         .chat-close{
         float:right;
         cursor:pointer;
         color:#fff;
         }
         .minimize{
         float:right;
         cursor:pointer;
         padding-right:5px;
         }
         .user{
         position:relative;
         padding:10px 30px;
         }
         .user:hover{
         /* background:#f8f8f8; */
         cursor:pointer;
         }
         .user:before{
         content:'';
         position:absolute;
         background:#2ecc71;
         height:10px;
         width:10px;
         left:10px;
         top:15px;
         border-radius:6px;
         }
         .emoji-menu{position:relative;}
         .icon-bell:before,.icon-grid:before{content:"";}	
.input-group-btn .btn{
	/* height:25px!important;
	padding:3px 8px!important; */
}		

#globalsearch{
    width: 180px;
position:relative;
/* left:80px; */
}
.globalsearch{

position:relative;
/* left:240px!important; */

}

.page-headr{
	    position: relative;
    top: 15px;
    left: 40px;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: bolder;
    color: #031d33;
}
#date_time {
    color: #5c5c5c;
    position: relative;
    top: 15px;
    font-weight: normal;
}
      </style>
	  <script type="text/javascript">
    
   function date_time(id)
   {
      date = new Date;
      year = date.getFullYear();
      month = date.getMonth();
      months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
      d = date.getDate();
      day = date.getDay();
      days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
      h = date.getHours();
      if(h<10)
      {
              h = "0"+h;
      }
      m = date.getMinutes();
      if(m<10)
      {
              m = "0"+m;
      }
      s = date.getSeconds();
      if(s<10)
      {
              s = "0"+s;
      }
      result = ''+days[day]+', '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
      document.getElementById(id).innerHTML = result;
      setTimeout('date_time("'+id+'");','1000');
      return true;
   }
   
   
</script>
   </head>
   <body class="fixed-left">
   	    
      <div id="wrapper">
         <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
               <div class="text-center">
                  <!-- <a href="<?= Yii::$app->homeUrl ?>" class="logo" alt="DMC"><i class="icon-c-logo">DMC</i><span>DMC<i class="md md-album"></i>PHARMACY</span></a>-->
                  <!-- Image Logo here -->
                  <a href="index.html" class="logo">
                  <i class="icon-c-logo"> <img src="<?= Url::to('@web/images/sp.png') ?>"  width="42" height="42"/> </i>
                  <span>SUNITHA PRINTERS</span><!--i class="md md-album"></i>PHARMACY<-->
                  </a>
               </div>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
               <div class="container">
                  <div class="row">
                     <div class="pull-left ">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                     </div>
					
					 <div class="fulscrn">
					 
					 
          
						
						
						
						
						
						
						
						
						
						</div>
                     <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="hidden-xs">
                           <a href="#"  class="waves-effect waves-light">
                          
                           </a>
                        </li>
						
                       <!-- <li class="hidden-xs">
                           <a href="#"  class="waves-effect waves-light">
                           <?php $session = Yii::$app->session; ?>
                           Welcome,<?php echo $session['user_name'] ;?>
                           </a>
                        </li> -->
                        <li class="hidden-xs">
                           <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                        </li>
                       <!-- <li class="hidden-xs">
                           <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="fa fa-comment-o"></i></a>
                        </li>  -->

                        <?php

                        $user_prime=urlencode(base64_encode($session['headlinestv_id']));

                        
                        ?>
                        <li class="dropdown top-menu-item-xs">
                           <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="images/dummyimages.png" alt="user-img" class="img-circle"> </a>
                           <ul class="dropdown-menu">
                              <li><a href="<?php echo Yii::$app->homeUrl ?>?r=user/update&id=<?php echo $user_prime; ?>"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                              <!--     <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                 <li><a href="<?= Url::to(['logscreen']);?>"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>-->
                              <li class="divider"></li>
                              <li>
                                 <?php  if (Yii::$app->user->isGuest) {
                                    echo  ['label' => 'Sign out', 'url' => ['/site/login']];
                                    } else {
                                     echo '<a>'
                                         . Html::beginForm(['/site/logout'], 'post')
                                         . Html::submitButton(
                                             '<i class="fa fa-sign-out"></i> Logout',
                                             ['class' => 'btn btn-primary btn-custom waves-effect waves-light']
                                         )
                                         . Html::endForm()
                                         . '</a>';
                                    } ?>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </div>
                 
               </div>
            </div>
         </div>
         
         <?php  echo $this->render('left_menu.php'); ?>
       
         <div class="content-page">
            <div class="content"> 
               <?= Alert::widget() ?>
               <?= $content ?>
            </div>
         </div>
         
         
         
        <div class="msg_box_outer"> 
         <div class="msg_box chat-box">

         </div>
         </div>
         
         <!-- Right Sidebar -->
         <div class="side-bar right-bar nicescroll">
            <h4 class="text-center">Chat    <a href="#" style="float:right;margin-right:20px;" class="right-bar-toggle waves-effect waves-light"><i class="btn btn-sm btn-default fa fa-arrow-right"></i></a></h4>
          
            <input type="hidden" name="touser" id="touser">
            <div class="contact-list nicescroll">
               <ul class="list-group contacts-list">
             <?php $session = Yii::$app->session; 
          // echo $session['user_logintype'];exit;
             if($session['authUserRole']=='S'){
					//$branch_data=BranchAdmin::find()->where(['NOT IN','ba_autoid',$session['user_id']])->groupBy(['ba_branchid'])->all();
				 foreach($branch_data as $b1){
				 //	$branch_name_fetch=CompanyBranch::find()->where(['branch_id'=>$b1->ba_branchid])->one();?>
				 	<div style="padding-left: 6px;"><b><?= $branch_name_fetch->branch_name; ?></b></div>
				 	<?php
					// $branch_data_1=BranchAdmin::find()->where(['NOT IN','ba_autoid',$session['user_id']])->andWhere(['ba_branchid'=>$b1->ba_branchid])->all();
					 foreach($branch_data_1 as $b2){
	              ?> 
	                  <li class="list-group-item">
	                     <div class="chat_body">
	                        <div class="user" data-id="<?= $b2->ba_autoid; ?>"> <?= ucwords($b2->ba_name);?></div>
	                     </div>
	                  </li>
	                <?php
				  }
				 }

           
             }else if(isset($session['branch_id'])){
           //  $branch_data=BranchAdmin::find()->where(['NOT IN','ba_autoid',$session['user_id']])->andWhere(['ba_branchid'=>$session['branch_id']])->all();
              // echo"<pre>";
              // print_r($session['user_id']);			  print_r($branch_data);
			  //  die;
			// foreach($branch_data as $b1){
              ?>  	
                  <li class="list-group-item">
                     <div class="chat_body">
                        <div class="user" data-id="<?= $b1->ba_autoid; ?>"> <?= ucwords($b1->ba_name);?></div>
                     </div>
                  </li>
                <?php
			//  }
			 }
                 ?>  
               </ul>
            </div>
         </div>
         <footer class="footer text-right">
            © 2019 SUNITHA PRINTERS . All rights reserved.
         </footer>
      </div>
	  
	  
	  
	  
	  <script>
	 /*  $(document).ready(function() {
       
    $(".user").click(function() {
        // var domElement = $('<div class="module_holder"><div class="module_item"><h3>content 1</h3></div></div>').insertAfter(".msg_box") ;
        var a = $('<div class="msg_box" style="right:242px;z-index:9;display:none;"><div class="msg_head">User1<div class="chat-close">x</div></div><div class="col-lg-12"><div class="card-box"><div class="msg_wrap chat-conversation"><ul class=" msg_body conversation-list nicescroll"><li class="clearfix"><div class="chat-avatar"><img src="assets/images/avatar-1.jpg" alt="male"><i>10:00</i></div><div class="conversation-text"><div class="ctext-wrap"><i>John Deo</i><p>Hello!</p></div></div></li></ul><div class="row"><div class="col-sm-9 chat-inputbar"> <p class="lead emoji-picker-container"><input type="text" class="form-control chat-input  " placeholder="Enter your text" data-emojiable="true"></p></div><div class="col-sm-3 chat-send"><button type="submit" class="btn btn-md btn-info btn-block waves-effect waves-light"><i class="fa fa-arrow-right"></i></button></div></div></div></div></div></div>').appendTo('.conversation-list').insertAfter(".msg_box");
         
    });
    });
    */

	  </script>
	  
      <?php $this->beginBody() ?>
      <script>
         var resizefunc = [];
      </script>
      <script type="text/javascript">
         jQuery(document).ready(function($) {
             $('.counter').counterUp({
                 delay: 100,
                 time: 1200
             });
         
             $(".knob").knob();
         
         });
      </script>
    
      <?php 
         $this->endBody() ;
    
         Modal::begin(['header' => '<h3 id="customheader"> </h3>','id' => 'modal', 'size' => 'modal-md']);
           echo "<div id='modalContent'>
                 <div id='textContent'></div>
                 <div class='modal-footer'>
                     <input type='hidden' class='data1'>
                     ".Html::a('<i class="fa fa-fw fa-check-square-o"></i> Yes', '#', ['class' => 'btn btn-primary deletatag', 'data-method' => 'post'])."
                     <button class='btn' data-dismiss='modal' aria-hidden='true'><i class='fa fa-fw fa-ban'></i> No</button>
                 </div> 
             </div>";
         Modal::end();
       
         Modal::begin([  'header' => '<h4 id="operationalheader" > </h4>', 'id' => 'operationalmodal', 'size' => 'modal-md' ]);
           echo "<div id='modalContenttwo'   >
                 <div id='customtwo'><input type='hidden' class='data2'></div>
             </div>";
         Modal::end();
         Modal::begin([ 'header' => '<h4 id="customviewheader" > </h4>','id' => 'custommodal', 'size' => 'modal-lg']);
           echo "<div id='customcontent'></div>";
         Modal::end();
         ?>
      <script>
      
      $(document).on('click','.chatsave',function(event){
      
	x=$(this).attr('data-id');
	is_valid="ok";
	noteval=$("#chat_message").val();
	touser=$("#touser").val();
	if(noteval==''){
		is_valid="no";
		alert("Message cannot be blank");
	}
	
if(is_valid=='ok'){	
       //  var form = $('#stickynoteform');
$.ajax({
    
    url : '<?php echo Url::toRoute(['chat/create']); ?>',
    type: 'post',
    data: 'note='+noteval+'&touser='+touser,
     success : function(response){
     $("#chat_message").val('');
     $(".chat123").append(response);	
     var ch=$(".chat123").get(0).scrollHeight;
    	
		$( ".chat123" ).scrollTop(ch);
    }
   })
  }
});

      
         //Delete Modal Call
         $(document).on('click', '.modalDelete', function(e){
             e.preventDefault();
              var url = $(this).val();
                 $('.deletatag').attr("href", url);
                 $('#customheader').html('<span style="color:red"> <i class="fa fa-trash"></i> Delete</span>');
                 $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">DELETE</span> this item ?</h4>');
                 $('#modal').modal('show').find('#modalContent').load();
               
         });
		 
		 
		 $(document).on('click', '.modalCancel', function(e){
             e.preventDefault();
              var url = $(this).val();
                 $('.deletatag').attr("href", url);
                 $('#customheader').html('<span style="color:red"> <i class="fa fa-times"></i> Cancel</span>');
                 $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">Cancel</span> this item ?</h4>');
                 $('#modal').modal('show').find('#modalContent').load();
               
         });
		 
		  $(document).on('click', '.modalRecancel', function(e){
             e.preventDefault();
              var url = $(this).val();
                 $('.deletatag').attr("href", url);
                 $('#customheader').html('<span style="color:red"> <i class="fa fa-times"></i> ReCancel</span>');
                 $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">ReCancel</span> this item ?</h4>');
                 $('#modal').modal('show').find('#modalContent').load();
               
         });
         
         
         //Status Changes Model
         $(document).on('click', '.actionchange', function(e){
             e.preventDefault();
              var url = $(this).val();
                 $('.deletatag').attr("href", url);
                 $('#customheader').html('<span style="color:#195375"> <i class="fa fa-fw fa-info-circle"></i> Confirmation</span>');
                 $('#textContent').html('<p>Are you sure you want to <span style="color:#195375;">Change the Status</span> for this item ?</p>');
                 $('#modal').modal('show').find('#modalContent').load();
         });
         
         
         // Below Pagination class click for reload the page for ajax loading issue
         $(document).on('click', '.pagination', function(e){
             location.reload();
         });
         
         
         /* When Model is in Page the User Profile option will not come for avoid that bug the below code has been resolved it. */
          $(document).on('click', '.dropdown-toggle', function(e){
                  $('.navbar-nav > .user ').toggleClass("open");
                 $(".navbar-nav > .user > .dropdown-toggle").attr("aria-expanded","true");
             });
         
      </script>
	  <!------------ CHAT ------------->
	  <script>
		$(document).ready(function(){
			
				/*	$('.chat_head').click(function(){
				$('.chat_body').slideToggle('slow');
			}); */
			$('.msg_head').click(function(){
				
				$('.msg_wrap').slideToggle('slow');
			});
   	
		 $(document).on('click','.chat-close',function(event){
				$('.msg_box').hide();
			});
   	
			$('.user').click(function(){
  
				$('.msg_wrap').show();
				$('.msg_box').show();
				x=$(this).attr("data-id");
			
				$('#touser').val(x);
   				$.ajax({
				    url:'<?php echo Yii::$app->homeUrl . '?r=chat/chatbox&id='; ?>'+x ,
				    type: 'post',
				    data: 'user='+x,
				    success : function(response){
				    	
				     	$(".msg_box").html(response);
				     	var ch=$(".chat123").get(0).scrollHeight;
    					$( ".chat123" ).scrollTop(ch);
    					$(function() {
			               window.emojiPicker = new EmojiPicker({
				            emojiable_selector: '[data-emojiable=true]',
				            assetsPath: '<?php echo Yii::$app->request->BaseUrl; ?>/ubold/img/',
			                	popupButtonClasses: 'fa fa-smile-o'
			                                });
			                        window.emojiPicker.discover();
		                         });
    				
				    }
				   })
				
			});	
		});
	</script>
	     <script>
	     
	      $(document).ready(function()
	      {
	
			 $("body").on('change', '#select-admin', function ()
			    { 
			    	var admin=$(this).val();
			    	if(admin !== '')
			    	{
			    		 $.ajax({	
					     type: "POST",
		 				 url: "<?php echo Yii::$app->homeUrl . "?r=sales/rights&id=";?>"+admin,
					     success: function (result) 
						     {
						     	// window.location.reload(true); 	
						     }
					  	 });
			    	}
			    });
			});
	    </script>
	
   	 
   </body>
</html>
<?php $this->endPage() ?>



<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown();
		$('.open-left').click(function(){
			
			  $('#globalsearch').toggleClass('globalsearch');

			
			});
			
		//$('.form-control').addClass('input-sm');
		//$('.btn-default').addClass('btn-sm');
    });
    

</script>


<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>


