<?php


namespace backend\controllers;


use common\components\Time;
use yii\helpers\Html;
use yii\web\Controller;
use common\models\Apple;
use yii\data\ActiveDataProvider;

class AppleController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Apple::find()->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGenerate()
    {
        $colors = Apple::getColors();
        $count = rand(1, 10);

        for ($i = 0; $i < $count; $i++) {
            $apple = new Apple();
            $apple->color = $colors[array_rand($colors)];
            $apple->created_at = Time::nowFull();
            $apple->status = Apple::STATUS_ON_TREE;
            $apple->size = 1;
            $apple->eat_percent = 0;
            $apple->save();
        }

        return $this->redirect(['index']);
    }

    public function actionFall($id)
    {
        $apple = Apple::findOne($id);
        $apple->fallToGround();

        return $this->redirect(['index']);
    }

    public function actionEat($id, $percent)
    {
        $apple = Apple::findOne($id);
        $apple->eat($percent);

        return $this->redirect(['index']);
    }

    public function actionDelete($id)
    {
        $apple = Apple::findOne($id);
        $apple->deleteApple();

        return $this->redirect(['index']);
    }
}