<?php

use yii\grid\GridView;
use yii\helpers\Html;
use common\components\Time;

$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Generate Apples', ['generate'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'color',
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return Time::getDateFormat($model->created_at, 'd-m-Y');
            },
        ],
        [
            'attribute' => 'fall_date',
            'value' => function ($model) {
                if ($model->fall_date) {
                    return Time::getDateFormat($model->fall_date, 'd-m-Y');
                }
                return '(не задано)';
            },
        ],
        [
            'attribute' => 'status',
            'value' => function ($model) {
                return $model->getStatus();
            },
        ],
        'size:percent',
        [
            'attribute' => 'eat_percent',
            'value' => function ($model) {
                if ($model->eat_percent) {
                    return $model->eat_percent. '%';
                }
                return '(не задано)';
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{fall} {eat} {delete}',
            'buttons' => [
                'fall' => function ($url, $model, $key) {
                    return Html::a('Падение', ['fall', 'id' => $model->id], ['class' => 'btn btn-primary']);
                },
                'eat' => function ($url, $model, $key) {
                    return Html::a('Есть', ['eat', 'id' => $model->id, 'percent' => 25], ['class' => 'btn btn-warning', 'data' => [
                        'confirm' => 'Вы уверены, что хотите съесть это яблоко?',
                        'method' => 'post',
                    ]]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить это яблоко?',
                        'method' => 'post',
                    ]]);
                },
            ],
        ],
    ],
]); ?>