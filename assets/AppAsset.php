<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'ui/jquery-ui.structure.css',
        'ui/jquery-ui.min.css',
        'ui/jquery-ui.theme.min.css',
        // 'css/jquery-mobile/jquery.mobile-1.4.5.min.css',
        'css/main.css',
        
    ];
    public $js = [
        'ui/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'js/jquery.cep.js',
        'js/jquery.maskedinput.js',
        'js/ckeditor/ckeditor.js',
        // 'js/jquery-mobile/jquery.mobile-1.4.5.min.js',
        'js/main.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

