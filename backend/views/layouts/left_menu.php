<?php

$session = Yii::$app->session;
$session['user_type'];	

 $menu_data_array = array();
 if($session['user_type']=='S')
 {


$menu_data_array[0] = array('one', 'Dashboard', Yii::$app -> homeUrl, '<i class="fa fa-dashboard"></i>', 'index');

$menu_data_array[1] = array('one', 'User Management', Yii::$app->homeUrl.'?r=user/index', '<i class="fa fa-user"></i>', 'index');
$menu_data_array[2] = array('one', 'Customer Master', Yii::$app->homeUrl.'?r=customer-master/index', '<i class="fa fa-user"></i>', 'index');
$menu_data_array[3] = array('one', 'Tax Master', Yii::$app->homeUrl.'?r=taxmaster/index', '<i class="fa fa-money"></i>', 'index');
$menu_data_array[4] = array('hr');
$menu_data_array[5] = array('one', 'Estimate Slip', Yii::$app->homeUrl.'?r=estimate/index', '<i class="fa fa-calculator"></i>', 'index');
$menu_data_array[6] = array('one', 'Delivery Challan', Yii::$app->homeUrl.'?r=delivery/index', '<i class="fa fa-truck"></i>', 'index');
$menu_data_array[7] = array('one', 'Invoice', Yii::$app->homeUrl.'?r=invoice-table/index', '<i class="fa fa-file-pdf-o"></i>', 'index');


}
else if($session['user_type']=='A')
{
	$menu_data_array[0] = array('one', 'Dashboard', Yii::$app -> homeUrl, '<i class="fa fa-dashboard"></i>', 'index');

	$menu_data_array[1] = array('one', 'Estimate Slip', Yii::$app->homeUrl.'?r=estimate/index', '<i class="fa fa-calculator"></i>', 'index');
	$menu_data_array[2] = array('one', 'Delivery Challan', Yii::$app->homeUrl.'?r=delivery/index', '<i class="fa fa-truck"></i>', 'index');
	$menu_data_array[3] = array('one', 'Invoice', Yii::$app->homeUrl.'?r=invoice-table/index', '<i class="fa fa-file-pdf-o"></i>', 'index');
	
}




$html_menu_out = '';
$controler_url_id = Yii::$app ->controller->id;
$active_url_id = Yii::$app ->controller->action->id;
$html_menu_out_tmp = $controler_url_id . "/" . $active_url_id;
//$html_menu_out .= $html_menu_out_tmp;

foreach ($menu_data_array as $one_ig => $one_menus) {
	if (count($one_menus) > 0) {
		if ($one_menus[0] == 'more') {
			$isselct = '';
			if ($controler_url_id == $one_menus[4]) {$isselct = 'active';
			}//echo $isselct;
			$html_menu_out2 = '<ul class="treeview-menu">';
			foreach ($one_menus['sub'] as $one_submenus) {
				$isactive = '';
				if ($active_url_id == "index") {
					if ($active_url_id == $one_submenus[4] || $controler_url_id == $one_submenus[4]) {
						$isactive = 'class="active"';
						if ($isselct == '') {
							$isselct = 'active';
						}
					}
				} else {
					if ($active_url_id == $one_submenus[4]) {$isactive = 'class="active"';
					}
				}
				$html_menu_out2 .= '<li ' . $isactive . '><a href="' . $one_submenus[1] . '">' . $one_submenus[2] . '' . $one_submenus[0] . '</a></li>';
			}
			$html_menu_out1 = '<li class="treeview ' . $isselct . '"><a href="#">' . $one_menus[3] . ' <span>' . $one_menus[1] . '</span><i class="fa fa-angle-left pull-right"></i></a>';
			$html_menu_out2 .= '</ul></li>';
			$isselct = '';
			$html_menu_out .= $html_menu_out1 . $html_menu_out2;
		} elseif ($one_menus[0] == 'one') {
			$isselct = '';
			if ($active_url_id == "index") {
				if ($controler_url_id == $one_menus[4] || $active_url_id == $one_menus[4]) {$isselct = 'active';
				}
			} else {
				if ($html_menu_out_tmp == $one_menus[4]) {$isselct = 'active';
				}
				//if($controler_url_id==$one_menus[4]){$isselct='active';}
			}
			$html_menu_out .= '<li class="treeview ' . $isselct . '"> 
		              <a href="' . $one_menus[2] . '">' . $one_menus[3] . ' <span>' . $one_menus[1] . '</span></a></li>';
		}
		elseif ($one_menus[0] == 'hr') {
			$html_menu_out .= '<li class="treeview"><div style="width:100%;border-top:2px solid #fff;opacity:0.5;"></div></li>';

		}
	}
}

	

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