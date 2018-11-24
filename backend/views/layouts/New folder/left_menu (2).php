<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$session = Yii::$app->session;
use backend\models\AuthProjectModule;
use yii\helpers\ArrayHelper;
use backend\models\ServiceuserLogin;

 $menu_data_array = array();


if ($session['user_logintype']=='BA'  || $session['user_logintype']=='CA') {
	if($session['user_logintype']=='BA'){	
		$in_module=array();
		if($session['authUserRole']!=''){
			$user_modules=ServiceuserLogin::find()->where(['auth_role'=>$session['authUserRole']])->one();
			if($user_modules){
			$data=ArrayHelper::toArray($user_modules);
			$in_module=json_decode($user_modules->assign_service);
			$in_module_action=json_decode($user_modules->assign_action);
			$projct=AuthProjectModule::find()->where(['is_active'=>1])->all();
			 foreach($projct as $key1=>$val1){
			 	//$session[$val1->moduleCode]=[''];
			 	if($in_module_action!=""){
			 foreach($in_module_action as $key=>$val){
			 	if($key==$val1->p_autoid){
			 		//echo $key.'='.$val1->p_autoid.'<br>';
			 	$projct=AuthProjectModule::find()->where(['p_autoid'=>$key])->andwhere(['is_active'=>1])->one();	
			 	$session[$val1->moduleCode]=explode(',', $val);
				}else{
					//$session[$val1->moduleCode]=['s'];
				}
				
			 }
				}else{
					//$session[$val1->moduleCode]=[''];
				}
			 }
			}
		}
		$ProjectModule=array();
		if(count($in_module)>0){
			$ProjectModuledb=AuthProjectModule::find()->where(['IN','p_autoid',$in_module])->andwhere(['is_active'=>1])->orderBy(['sortOrder'=>'SORT_ASC'])->all();		
			$ProjectModule=ArrayHelper::toArray($ProjectModuledb);
		}
	}elseif($session['user_logintype']=='CA'){
		$ProjectModuledb=AuthProjectModule::find()->where(['is_active'=>1])->orderBy(['sortOrder'=>'SORT_ASC'])->all();		
		$ProjectModule=ArrayHelper::toArray($ProjectModuledb);
	}
	
	$root_tree=array();
	foreach($ProjectModule as $one_rt){
		if($one_rt['moduelRoot']!=""){
			$root_tree[$one_rt['moduelRoot']][]=$one_rt;
		}
	}
		$ig=1;
		$menu_data_array_n=array();
		$menu_data_array_n[0] = array('one', 'Dashboard', Yii::$app -> homeUrl, '<i class="fa fa-dashboard"></i>', 'index');
	foreach($ProjectModule as $one_rt){
		if($one_rt['moduelRoot']==""){
		if($one_rt['moduleCode']!='hr'){
			
			$menu_data_array_n[$ig][0]=strtolower($one_rt['moduleMultiple']);
			$menu_data_array_n[$ig][1]=ucwords($one_rt['moduleName']);
			$t_url='';
			$t_url=Yii::$app -> homeUrl.'?r='.$one_rt['moduleCode'];
			if(isset($one_rt)){ 
			if($one_rt['userAction']!=""){
				$t_url.='/'.$one_rt['userAction']."";
			}
			}
			$menu_data_array_n[$ig][2]=$t_url;
			$menu_data_array_n[$ig][3]='<i class="fa fa-fw '.$one_rt['FAIcon'].'"></i>';
			$menu_data_array_n[$ig][4]=strtolower($one_rt['moduleCode']);
			if(isset($root_tree[$one_rt['p_autoid']])){
				$sub_menu=array();
				$ij=0;
				foreach($root_tree[$one_rt['p_autoid']] as $one_rr){	
				$sub_menu[$ij][0]=ucwords($one_rr['moduleName']);
				$t_url='';
				$t_url=Yii::$app -> homeUrl.'?r='.$one_rr['moduleCode'];
				if(isset($one_rr['userAction'])){
				if($one_rr['userAction']!=""){
					$t_url.='/'.$one_rr['userAction'];
				}
				}
				$sub_menu[$ij][1]=$t_url;
				$sub_menu[$ij][2]='<i class="fa fa-fw '.$one_rr['FAIcon'].'"></i>';
				$sub_menu[$ij][3]=strtolower($one_rr['moduleCode']);
				if($one_rr['moduleCode2']!=""){
					$sub_menu[$ij][4]=strtolower($one_rr['moduleCode2']);
				}else{
					$sub_menu[$ij][4]=strtolower($one_rr['userAction']);
				}
				$ij++;				
				}
				$menu_data_array_n[$ig]['sub']=$sub_menu;
			}
			}else{
				$menu_data_array_n[$ig]=array('hr');
			}
		}
		$ig++;
	}
	$menu_data_array=($menu_data_array_n);	

}


/*elseif ($session['user_logintype']=='BA') {	
$menu_data_array[0] = array('one', 'Dashboard', Yii::$app -> homeUrl, '<i class="fa fa-dashboard"></i>', 'index');	
$menu_data_array[3]=array('more','','#','<i class="material-icons"></i>Cash Report','invoice-excelupload');
$menu_data_array[3]['sub'][0]=array('Upload Excel Cash Report',Yii::$app->homeUrl.'?r=invoice-excelupload/upload','<i class="material-icons"></i>','invoice-excelupload','invoice-excelupload');
$menu_data_array[3]['sub'][1]=array('View Cash Report',Yii::$app->homeUrl.'?r=invoice-excelupload','<i class="material-icons"></i>','invoice-excelupload','invoice-excelupload');	
}*/

	/*echo '<pre>';
print_r($menu_data_array);die;*/

//echo '<pre>';
$html_menu_out = '';
$controler_url_id = Yii::$app -> controller -> id;
$ProjectModulez=AuthProjectModule::find()->where(['moduleCode'=>$controler_url_id])->andwhere(['moduleMultiple'=>'one'])->andwhere(['is_active'=>1])->one();
$projrcy_root="";
if($ProjectModulez!=""){
$projrcy_root=$ProjectModulez->moduelRoot;
}
$root_name="";
if($projrcy_root!=""){
	$ProjectModule_root=AuthProjectModule::find()->where(['p_autoid'=>$projrcy_root])->andwhere(['is_active'=>1])->one();
	$root_name=$ProjectModule_root->moduleCode;
}
$active_url_id = Yii::$app -> controller -> action -> id;
$html_menu_out_tmp = $controler_url_id . "/" . $active_url_id;
$html_menu_out .= "";
//$html_menu_out .=$session['servicecenter_id'];
foreach ($menu_data_array as $one_ig => $one_menus) {
	//print_r($one_menus['4']).'<br>';//echo "<pre>";print_r($one_menus);
	if (count($one_menus) > 0) {
		if ($one_menus[0] == 'more') {
			$isselct = '';
			if ($root_name == $one_menus[4]) {
				$isselct = 'active';
		//	echo $controler_url_id;
		//	print_r($one_menus['4']);die;
			}
			
			if((($active_url_id=="create") || ($active_url_id=="update") || ($active_url_id=="transferstockapprove") || ($active_url_id=="transferstockreceive") ||($active_url_id=="update1")) && $controler_url_id==$one_menus['4'])
			{
			   
				$style= 'style="display:block;"';
			}
			else{
			$style= 'style="display:none;"';
			}
			
			$html_menu_out2 = '<ul class="list-unstyled" ' . $style . '>';
			if(count($one_menus['sub'])>0){
			foreach ($one_menus['sub'] as $one_submenus) {
				$isactive = '';
				if ($active_url_id == "index" || $active_url_id== "create") {
					if ( $controler_url_id == $one_submenus[3]) {
						//echo $active_url_id;
			//print_r($one_submenus);
						$isactive = 'class="active1"';
						if ($isselct == '') {
							//$isselct = 'active';
						}
						
					}
				} else {
					//$isactive = 'class="active"';
					if ($active_url_id == $one_submenus[4]) {$isactive = 'class="active"';
					}
					
				}
				$html_menu_out2 .= '<li ' . $isactive . '><a href="' . $one_submenus[1] . '">' . $one_submenus[2] . '' . $one_submenus[0] . '</a></li>';
			}
			}
			$html_menu_out1 = '<li class="has_sub "><a class="waves-effect ">' . $one_menus[3] . ' <span>' . $one_menus[1] . '</span><span class="menu-arrow"></span></a>';
			$html_menu_out2 .= '</ul></li>';
			$isselct = '';
			$html_menu_out .= $html_menu_out1 . $html_menu_out2;
		} elseif ($one_menus[0] == 'one') {
			$isselct = '';
			
			if ($active_url_id == "index" || $active_url_id== "create") {
				if ($controler_url_id == $one_menus[4] || $active_url_id == $one_menus[4]) {$isselct =  'class="active"';
				}
				
				
			} 
			
			
			else {
				if ($html_menu_out_tmp == $one_menus[4]) {$isselct =  'class="active"';
				}else{
					$isselct="";
				}
				//if($controler_url_id==$one_menus[4]){$isselct='active';}
			}
			
			$html_menu_out .= '<li class="has_sub "> 
		              <a  class="waves-effect '.$isselct.'"  href="' . $one_menus[2] . '">' . $one_menus[3] . ' <span>' . $one_menus[1] . '</span></a></li>';

		} elseif ($one_menus[0] == 'hr') {
			$html_menu_out .= '<li class="has_sub "><div style="width:100%;border-top:1px solid #444;opacity:0.5;"></div></li>';
		}
		
		
	}
}//die;
?> 
 <div class="left side-menu">
 <div class="sidebar-inner slimscrollleft">
 	<div id="sidebar-menu">
 		<ul>
<?php echo $html_menu_out; ?>
</ul>

</div>
</div>
</div>

  
           