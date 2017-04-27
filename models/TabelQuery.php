<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tabel]].
 *
 * @see Tabel
 */
class TabelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Tabel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tabel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
