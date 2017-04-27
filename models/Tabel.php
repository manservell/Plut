<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tabel".
 *
 * @property string $id
 * @property string $project_id
 * @property string $order_id
 * @property string $wt_id
 * @property string $employee_id
 * @property string $t_date
 * @property string $t_hours
 */
class Tabel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tabel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'order_id', 'wt_id', 'employee_id', 't_date'], 'required'],
            [['project_id', 'order_id', 'wt_id', 'employee_id', 't_hours'], 'integer'],
            [['t_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'индекс'),
            'project_id' => Yii::t('app', 'связь с проектами'),
            'order_id' => Yii::t('app', 'связь с заказами'),
            'wt_id' => Yii::t('app', 'связь с типами работ'),
            'employee_id' => Yii::t('app', 'связь с сотрудниками'),
            't_date' => Yii::t('app', 'дата'),
            't_hours' => Yii::t('app', 'отработанные часы'),
        ];
    }

    /**
     * @inheritdoc
     * @return TabelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TabelQuery(get_called_class());
    }
}
