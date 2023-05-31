<?php
/**
 * Created by PhpStorm.
 * User: dilshod
 * Date: 3/26/19
 * Time: 11:40 AM
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class MaterialDesignIconsAsset
 * @package app\base\assets\libs
 */
class MaterialDesignIconsAsset extends AssetBundle
{
    public $sourcePath = '@webroot/libs/mdi';

    public $css = [
        'materialdesignicons.min.css',
    ];

}