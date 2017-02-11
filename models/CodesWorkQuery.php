<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CodesWork]].
 *
 * @see CodesWork
 */
class CodesWorkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CodesWork[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CodesWork|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
