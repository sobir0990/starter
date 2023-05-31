<?php
/**
 * Created by PhpStorm.
 * User: dilshod
 * Date: 11/13/18
 * Time: 3:02 PM
 */

namespace backend\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Vali temasiga moslashgan menu widget
 *
 * Class Menu
 * @package app\widgets
 */
class Menu extends \yii\widgets\Menu
{

    /**
     * @inheritdoc
     */
    public $labelTemplate = '{label}';

    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a class="{class}"  href="{url}">
                <span class="pcoded-micon"><i class="{icon}"></i></span>
                <span class="pcoded-mtext "><span class="text-overflow">{label}</span></span>
                <span class="pcoded-badge ml-2 label label-danger">{badge}</span>               
                </a>';

    /**
     * @inheritdoc
     */
    public $submenuTemplate = "\n<ul class=\"pcoded-submenu\">\n{items}\n</ul>\n";

    /**
     * @inheritdoc
     */
    public $activateParents = true;

    /**
     * Bu o'zgaruvchi agar controller mos kelsa ushbu menu ni active qiladi
     * Yani region/add bo'lsa region/index active bo'ladi, yani qaysi joyda ishlayotganini osonlashtirish mumkin
     * faqat site controllerda ishlamaydi
     *
     * @var bool
     */
    public $activateParentController = true;


    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, 'nav pcoded-inner-navbar');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function renderItems($items,$sub = false)
    {

        $n = count($items);
        $lines = [];

        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');

            $class = ['nav-item'];
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($item['items'])) {
                $class[] = 'pcoded-hasmenu ';
            }
            if ($item['active']) {

                if (!Yii::$app->view->title and isset($item['label'])) {
                    Yii::$app->view->title = $item['label'];
                    if (!empty($item['items'])) {
                        foreach ($item['items'] as $sub_item) {
                            if ($sub_item['active']) {
                                Yii::$app->view->title = $sub_item['label'];
                                break;
                            }
                        }
                    }
                }

                $class[] = 'active pcoded-trigger';
            }

            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item,$sub??false);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                foreach ($item['items'] as $k => $b) {
                    $item['items'][$k]['class'] = ' nav-link  ';
                }

                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items'],true),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);

        }

        return implode("\n", $lines);
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item,$sub = false)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            $class = ArrayHelper::getValue($item, 'class', ' nav-link  ');

            if($sub) {
                $template = str_replace('<span class="pcoded-micon"><i class="{icon}"></i></span>','',$template);
                $template = str_replace('<span class="pcoded-mtext">{label}</span>', '{label}',$template);
            }

            if (!isset($item['icon'])) {
                $template = str_replace('<i class="{icon}"></i>','',$template);
            }
            $badge = 0;
            if (!isset($item['badge']) or $item['badge']<1) {
                $template = str_replace('<span class="pcoded-badge ml-2 label label-danger">{badge}</span>','',$template);
            }else{
                $badge = $item['badge'];
            }

            if (isset($item['badge2']) && $item['badge2']>0) {
                $badge =  $item['badge2'].'/'.$badge;
            }

            return strtr($template, [
                '{class}'=>$class,
                '{icon}'=>ArrayHelper::getValue($item, 'icon',''),
                '{badge}'=>$badge,
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
            ]);
        }
        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
        return strtr($template, [
            '{label}' => $item['label'],
        ]);
    }

    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = Yii::getAlias($item['url'][0]);

            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }

//            $r = explode('/',$this->route);
//            $i = array_filter(explode('/',$route));
//
//            if ($this->activateParentController and count($r)==2 and count($i)==2 and current($i)!='site' and current($r)==current($i)) {
//                return true;
//            }

            if (isset($item['children'])) {
                foreach ($item['children'] as $child) {
                    if ($child['url'][0]==Yii::$app->controller->route) {
                        return true;
                    }
                }
            }

            if (ltrim($route, '/') !== $this->route) {
                return false;
            }

            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }

}