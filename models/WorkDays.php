<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_days".
 *
 * @property string $id
 * @property string $data
 * @property integer $hours
 */
class WorkDays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_days';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'hours'], 'required'],
            [['data'], 'safe'],
            [['hours'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data' => Yii::t('app', 'Дата'),
            'hours' => Yii::t('app', 'Кол-во рабочих часов'),
        ];
    }

    /**
     * @inheritdoc
     * @return WorkDaysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkDaysQuery(get_called_class());
    }
}
