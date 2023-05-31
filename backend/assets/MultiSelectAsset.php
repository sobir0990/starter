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
 * Class MultiSelectAsset
 * @package app\assets
 */
class MultiSelectAsset extends AssetBundle
{
    public $sourcePath = '@webroot/libs/multiselect';

    public $css = [
        'multiple-select.min.css',
    ];

    public $js = [
        "multiple-select.min.js",
        "init.js",
    ];

    public $depends = [
        JqueryAsset::class
    ];

}