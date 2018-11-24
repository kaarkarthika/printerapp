<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Chat;
use backend\models\BranchAdmin;
$session=Yii::$app->session;
$chat1=Chat::find()->where(['from_user'=>$session['user_id']])->andWhere(['to_user'=>$id])->all();
$chat_list1=array();
		if($chat1){
			foreach($chat1 as $ch1){
				$chat_list1[]=$ch1->autoid;
			}
		}
$chat2=Chat::find()->where(['to_user'=>$session['user_id']])->andWhere(['from_user'=>$id])->all();
$chat_list2=array();
		if($chat2){
			foreach($chat2 as $ch2){
				$chat_list2[]=$ch2->autoid;
			}
		}
		
		$chat_list_all=array();
		if($chat_list1!='' || $chat_list2!=''){
			$chat_list_all=array_merge($chat_list1,$chat_list2);
		}
$name_fetch=BranchAdmin::find()->where(['ba_autoid'=>$id])->one();
$chat_all=Chat::find()->where(['IN','autoid',$chat_list_all])->orderBy(['autoid'=>SORT_ASC])->all();?>
 
<div class="msg_head">
             <?php echo ucwords($name_fetch->ba_name);?>
             
             
               <div class="chat-close">x</div>
            </div>
            <div class="col-lg-12">
               <div class="card-box">
                  
                  <div class="msg_wrap chat-conversation">
                     <ul class=" msg_body conversation-list nicescroll chat123">
            <?php       if($chat_all){
                   	foreach($chat_all as $c1){
                   		
                   		$from_user_fetch=BranchAdmin::find()->where(['ba_autoid'=>$c1->from_user])->one();
						$to_user_fetch=BranchAdmin::find()->where(['ba_autoid'=>$c1->to_user])->one();
						   $from_user_name=$from_user_fetch->ba_name;
						   $to_user_name=$to_user_fetch->ba_name;  
						   $al1="clearfix t123"; 
						   if($c1->from_user==$session['user_id']){
						   	$al1="clearfix odd t123"; 
						   } 
						   ?>
						   
  <li class="<?php echo $al1;?>">
                           <div class="conversation-text">
                              <div class="ctext-wrap">
                                 <i><?php echo ucwords($from_user_name);?></i>
                                 <p>
                                 <?php echo $c1->message;?>
                                 </p>
                                 <p>
                                 <?php echo date("d-M-y h:i A",strtotime($c1->created_at));?>
                                 </p>
                              </div>
                           </div>
                        </li>
                        
               <?php         }
                        }
?>
                   </ul>
                     <div class="row">
                        <div class="col-sm-9 chat-inputbar">
                        	  <p class="lead emoji-picker-container">
                        
                              <input type="text" class="form-control chat-input" name="chat_message" id="chat_message" placeholder="Enter your text" data-emojiable="true">
                           </p>
                        </div>
                        <div class="col-sm-3 chat-send">
                           <button type="submit" class="btn-md btn-info btn-block waves-effect waves-light chatsave"><i class="fa fa-arrow-right"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>