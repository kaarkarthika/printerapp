<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      
    "ubold/css/bootstrap.min.css",
	'ubold/plugins/morris/morris.css',
	'ubold/css/core.css',
	'ubold/css/components.css',
	'ubold/css/icons.css',
	'ubold/css/pages.css',
	'ubold/css/responsive.css',
    ];
    public $js = [   		
   		
      
      "ubold/js/modernizr.min.js",
      "ubold/js/jquery.min.js",
      "ubold/js/bootstrap.min.js",
      "ubold/js/detect.js",
      "ubold/js/fastclick.js",
      "ubold/js/jquery.slimscroll.js",
      "ubold/js/jquery.blockUI.js", 
      "ubold/js/waves.js",
      "ubold/js/wow.min.js",
      "ubold/js/jquery.nicescroll.js",
      "ubold/js/jquery.scrollTo.min.js",
      "ubold/plugins/peity/jquery.peity.min.js",
      "ubold/plugins/waypoints/lib/jquery.waypoints.js",
      "ubold/plugins/counterup/jquery.counterup.min.js",
      "ubold/plugins/morris/morris.min.js",
      "ubold/plugins/raphael/raphael-min.js",
      "ubold/plugins/jquery-knob/jquery.knob.js",
      "ubold/pages/jquery.dashboard.js",
      "ubold/js/jquery.core.js",
      "ubold/js/jquery.app.js", 
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
