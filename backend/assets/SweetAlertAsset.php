<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class SweetAlertAsset
 * @package lavrentiev\widgets\toastr
 */
class SweetAlertAsset extends AssetBundle
{
    /** @var string $sourcePath */
    public $sourcePath = '@webroot/libs/sweetalert';

//    public $css = [
//        YII_ENV_DEV ? 'toastr.css' : 'toastr.min.css',
//    ];

    public $js = [
        'sweetalert2.all.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
