<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BranchadminLayout extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'backend/web/css/site.css',
        'backend/web/bootstrap/css/bootstrap.min.css',
        'backend/web/bootstrap/css/font-awesome.min.css',
        'backend/web/bootstrap/css/ionicons.min.css',
        'backend/web/dist/css/AdminLTE.min.css',
        'backend/web/dist/css/skins/_all-skins.min.css',
        'backend/web/plugins/iCheck/flat/blue.css',
        'backend/web/plugins/morris/morris.css',
        'backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'backend/web/plugins/datepicker/datepicker3.css',
        'backend/web/plugins/daterangepicker/daterangepicker-bs3.css',
        'backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',        
    ];
    public $js = [   		
   		'backend/web/bootstrap/js/bootstrap.min.js',
   		'backend/web/plugins/sparkline/jquery.sparkline.min.js',
   		'backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
   		'backend/web/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
   		'backend/web/plugins/datepicker/moment.min.js',
   		'backend/web/plugins/daterangepicker/daterangepicker.js',
   		'backend/web/plugins/datepicker/bootstrap-datepicker.js',
   		'backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
   		'backend/web/plugins/slimScroll/jquery.slimscroll.min.js',
   		'backend/web/plugins/fastclick/fastclick.min.js',
   		'backend/web/dist/js/app.min.js',
   		'backend/web/dist/js/pages/dashboard.js',
   		'backend/web/dist/js/demo.js',		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
