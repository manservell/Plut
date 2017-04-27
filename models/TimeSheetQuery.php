<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TimeSheet]].
 *
 * @see TimeSheet
 */
class TimeSheetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TimeSheet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TimeSheet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
