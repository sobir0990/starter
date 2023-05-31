<?php
/**
 * Created by PhpStorm.
 * User: shranet
 * Date: 12/7/18
 * Time: 11:52 AM
 */

namespace backend\widgets;

use yii\base\Widget;
use Yii;
use yii\web\View;

/**
 * Class JsWidget
 * @package app\widgets
 */
class JsWidget extends Widget
{
    public $position = View::POS_READY;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        ob_start();
        ob_implicit_flush(false);
    }

    /**
     * @return string|void
     */
    public function run()
    {
        parent::run();

        $js = ob_get_clean();

        $js = str_replace(["<script>", "</script>"], "", $js);
        
        Yii::$app->view->registerJs($js, $this->position);
    }
}