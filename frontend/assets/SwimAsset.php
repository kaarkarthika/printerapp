<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Solaipandian <solaipandian.istrides@gmail.com>
 * @since 2.0
 */

class SwimAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
   		
        //'frontend/web/solnwizfiles/css/solnwiz_custom.css',
      
    ];
    public $js = [
    //    	'frontend/web/solnwizfiles/js/jquery-1.11.3.min.js',
       
      // 'frontend/web/solnwizfiles/js/dashboard2.js',
        //'frontend/web/solnwizfiles/js/gmaps.js',
        //'frontend/web/solnwizfiles/js/npm.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
