<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::$classMap['yii\helpers\Html'] = "@common/components/Html.php";

function __($message, $params = array())
{
    return Yii::t('main', $message, $params, Yii::$app->language);
}

function t($text, $params = [], $lang = null)
{
    return Yii::t("yii", $text, $params, $lang);
}