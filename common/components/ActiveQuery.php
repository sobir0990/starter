<?php

namespace common\components;

/**
 * Bu BaseActiveQuery yaratilgan modellar uchun bo'lib qo'shimcha methodlar yaratishda ishlatiladi
 * Va shuningdek ActiveQuery ning methodlarni overrite qilshda ham foydalanamiz
 *
 * Class ActiveQuery
 * @package app\components
 */
class ActiveQuery extends \yii\db\ActiveQuery
{

    /**
     * Jadvaldagi barcha ma'lumotlarni qaytaradi
     *
     * @param null $db
     * @param bool $asArray
     * @return array|\yii\db\ActiveRecord[]
     */
    public function all($db = null, bool $asArray=false)
    {
        if ($asArray) {
            $this->asArray();
        }
        return parent::all($db);
    }

    /**
     * Jadvaldagi barcha ma'lumotlarni massiv ko'rinishda qaytaradi
     *
     * @param null $db
     * @return array|\yii\db\ActiveRecord[]
     */
    public function allArray($db = null)
    {
        $this->asArray();
        return parent::all($db);
    }

    /**
     * Jadvaldagi bitta ma'lumotni qaytaradi
     * ActiveQuery ning one() methodiga limit qo'yilgan sababi barcha ma'lumotlarni qaytarmasligi uchun
     *
     * @param null $db
     * @param bool $asArray
     * @return array|null|\yii\db\ActiveRecord.
     */
    public function one($db = null,bool $asArray=false)
    {
        $this->limit(1);
        if ($asArray) {
            $this->asArray();
        }
        return parent::one($db);
    }

    /**
     *  Jadvaldagi bitta ma'lumotni massiv ko'rinishda qaytaradi
     *  ActiveQuery ning one() methodiga limit qo'yilgan sababi barcha ma'lumotlarni qaytarmasligi uchun
     *
     * @param null $db
     * @return array|null|\yii\db\ActiveRecord
     */
    public function oneArray($db = null)
    {
        $this->limit(1);
        $this->asArray();
        return parent::one($db);
    }

}

