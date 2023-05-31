<?php
/**
 * Created by PhpStorm.
 * User: shranet
 * Date: 11/7/18
 * Time: 1:39 PM
 */

namespace yii\helpers;

use Yii;
use yii\db\ActiveRecord;
use yii\validators\FileValidator;
use yii\validators\ImageValidator;

/**
 * Class Html
 * @package yii\helpers
 */
class Html extends BaseHtml
{
    const ALERT_TYPE_SUCCESS = "success";
    const ALERT_TYPE_ERROR = "error";
    const ALERT_TYPE_WARNING = "warning";
    const ALERT_TYPE_INFO = "info";

    /**
     *
     */
    public static function alertTransactionException() {
        self::alertError(t("Ma'lumotlarni ustida amal bajarishda xatolik yuz berdi. Iltimos qayta urinib ko'ring."));
    }

    /**
     * @param $message
     * @param bool $closeButton
     */
    public static function alertSuccess($message, $closeButton = true) {
        static::alert($message, static::ALERT_TYPE_SUCCESS, $closeButton);
    }

    /**
     * @param $message
     * @param bool $closeButton
     */
    public static function alertError($message, $closeButton = true) {
        static::alert($message, static::ALERT_TYPE_ERROR, $closeButton);
    }

    /**
     * @param $message
     * @param bool $closeButton
     */
    public static function alertWarning($message, $closeButton = true) {
        static::alert($message, static::ALERT_TYPE_WARNING, $closeButton);
    }

    /**
     * @param $message
     * @param bool $closeButton
     */
    public static function alertInfo($message, $closeButton = true) {
        static::alert($message, static::ALERT_TYPE_INFO, $closeButton);
    }

    /**
     * @param $message
     * @param $type
     * @param bool $closeButton
     */
    private static function alert($message, $type, $closeButton = true) {
        $data = Yii::$app->session->getFlash($type);
        $hash = md5($message);

        $msg = $closeButton === false ? [Html::encode($message), $closeButton] : Html::encode($message);
        if (is_array($data)) {
            $data[$hash] = $msg;
        } else {
            $data = [$hash => $msg];
        }

        Yii::$app->session->setFlash($type, $data);
    }

    /**
     * @param string $name
     * @param null $value
     * @param array $options
     * @return string
     */
    public static function textInput($name, $value = null, $options = [])
    {
        return static::input('text', $name, $value, $options+['class'=>'form-control']);
    }

    /**
     * @param $model
     * @param $attribute
     * @return array
     */
    public static function activeFileLimits($model, $attribute)
    {
        $limit = 0;
        $extensions = [];
        $size = false;

        /** @var $model ActiveRecord */
        foreach($model->getActiveValidators($attribute) as $validator) {
            if (!($validator instanceof FileValidator)) {
                continue;
            }

            if ($validator instanceof ImageValidator) {
                /** @var $validator ImageValidator */
                $size = [
                    $validator->minWidth,
                    $validator->minHeight
                ];
            }

            /** @var $validator FileValidator */
            $limit = $validator->getSizeLimit();
            $extensions = $validator->extensions;
            break;
        }

        return [$limit, $extensions, $size];
    }

}