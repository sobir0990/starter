<?php
/**
 * Created by PhpStorm.
 * User: shranet
 * Date: 11/7/18
 * Time: 1:31 PM
 */

namespace common\components;

use Yii;

/**
 * Class ActiveForm
 * @package app\components
 */
class ActiveForm extends \yii\bootstrap4\ActiveForm
{
    public $fieldClass = ActiveField::class;

    public $enableClientValidation = false;

    public $enableAjaxValidation = true;

    public $fieldConfig = [
        'errorOptions' => ['class' => 'invalid-feedback'],
    ];
}