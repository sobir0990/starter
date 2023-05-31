<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package app\assets
 */
class AppAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';

    public $sourcePath = '@backend/web/';


    public $css = [
        'theme/assets/plugins/bootstrap/css/bootstrap.min.css',
        'theme/assets/fonts/feather/css/feather.css',
        'theme/assets/plugins/jquery-scrollbar/css/jquery.scrollbar.min.css',
        'theme/assets/fonts/datta/datta-icon.css',
        'theme/assets/fonts/fontawesome/css/fontawesome-all.min.css',
        'theme/assets/plugins/animation/css/animate.min.css',
        'theme/assets/css/style.css',
        'css/common.css',
        'css/custom.css',
    ];

    public $js = [
        "theme/assets/js/vendor-all.min.js",
        "theme/assets/js/pcoded.min.js",
        "theme/assets/plugins/bootstrap/js/bootstrap.min.js",
        "js/common.js",
        "js/pjax.js",
    ];

}
