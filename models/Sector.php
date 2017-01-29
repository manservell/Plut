<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sector".
 *
 * @property string $id
 * @property string $sector
 */
class Sector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sector';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sector'], 'required'],
            [['sector'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sector' => Yii::t('app', 'Сектор'),
        ];
    }
}
