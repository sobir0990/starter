<?php

namespace common\models;

use common\components\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string|null $color цвет
 * @property int|null $eat_percent сколько съели
 * @property int $status статус
 * @property int $size
 * @property string|null $fall_date дата падения
 * @property string|null $created_at дата появления
 * @property string|null $updated_at
 */
class Apple extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }


    const STATUS_ON_TREE = 0; //СТАТУС НА ДЕРЕВЕ
    const STATUS_ON_GROUND = 1; //СТАТУС НА ЗЕМЛЕ
    const STATUS_ROTTEN = 2; //СТАТУС ГНИЛЬНЫЙ

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['eat_percent', 'status'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_ON_TREE],
            [['fall_date', 'created_at', 'updated_at', 'size'], 'safe'],
            [['color'], 'string', 'min' => 3, 'max' => 255],
            [['eat_percent'], 'integer', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'eat_percent' => 'Сколько съели',
            'status' => 'Статус',
            'fall_date' => 'Дата падения',
            'created_at' => 'Дата появления',
            'updated_at' => 'Updated At',
        ];
    }


    public function getStatus()
    {
        $statusLabels = [
            self::STATUS_ON_TREE => 'на дереве',
            self::STATUS_ON_GROUND => 'на земле',
            self::STATUS_ROTTEN => 'гнильный',
        ];

        return isset($statusLabels[$this->status]) ? $statusLabels[$this->status] : 'Unknown';
    }

    public static function getColors()
    {
        return ['красный', 'зеленый', 'желтый'];
    }

    public function fallToGround()
    {
        if ($this->status === self::STATUS_ON_TREE) {
            $this->status = self::STATUS_ON_GROUND;
            $this->fall_date = Time::nowFull();
            if ($this->save()) {
                return Yii::$app->session->setFlash('success', 'Успешно');
            }
        } elseif ($this->status === self::STATUS_ROTTEN) {
            return Yii::$app->session->setFlash('success', 'Яблоко уже гнилое');
        } else {
            return Yii::$app->session->setFlash('success', 'Яблоко уже упало');
        }
    }

    public function eat($percent)
    {
        if ($this->status === self::STATUS_ON_TREE) {
            return Yii::$app->session->setFlash('error', 'Нельзя есть яблоко, пока оно на дереве');
        }

        if ($this->status === self::STATUS_ROTTEN) {
            return Yii::$app->session->setFlash('error', 'Нельзя есть гнилое яблоко');
        }

        if ($this->size === 0) {
            return Yii::$app->session->setFlash('error', 'tugadi');
        }

        if ($this->status === self::STATUS_ON_GROUND and time() >= strtotime($this->fall_date) + 5 * 3600) {
            $this->status = self::STATUS_ROTTEN;
            $this->save();
            return Yii::$app->session->setFlash('error', 'Яблоко испортилось');
        }

        $this->size -= $percent / 100;
        $this->eat_percent += $percent;


        if ($this->size <= 0) {
            $this->status = self::STATUS_ROTTEN;
        }

        if ($this->save()) {
            return Yii::$app->session->setFlash('success', 'Успешно');
        }
        return Yii::$app->session->setFlash('error', 'что то пошло не так');
    }

    public function deleteApple()
    {
        if ($this->status === self::STATUS_ROTTEN || $this->eat_percent >= 100) {
            $this->delete();
        } else {
            return Yii::$app->session->setFlash('error', 'Невозможно удалить яблоко, если оно не гнильный или не съедено');
        }
    }
}
