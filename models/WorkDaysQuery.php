<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[WorkDays]].
 *
 * @see WorkDays
 */
class WorkDaysQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return WorkDays[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WorkDays|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
