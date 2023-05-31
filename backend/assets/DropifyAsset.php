<?php
/**
 * Created by PhpStorm.
 * User: dilshod
 * Date: 3/26/19
 * Time: 11:36 AM
 */
namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Class DropifyAsset
 * @package base\assets\libs
 */
class DropifyAsset extends AssetBundle
{
    public $sourcePath = '@webroot/libs/dropify';

    public $css = [
        'dropify.css',
    ];

    public $js = [
        "dropify.js",
    ];

    public $depends = [
        JqueryAsset::class
    ];

}