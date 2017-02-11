<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "codes_work".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $type_id
 * @property string $note
 */
class CodesWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'codes_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'type_id'], 'required'],
            [['type_id', 'note'], 'integer'],
            [['code'], 'string', 'max' => 15],
            [['name'], 'string', 'max' => 155],
            [['code'], 'unique'],
        ];
    }
    public function getTypes(){
        return $this->hasOne(WorkTypes::className(), ['id'=>'type_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Код работ'),
            'name' => Yii::t('app', 'Наименование'),
            'type_id' => Yii::t('app', 'Вид работ (из таблицы видов работ)'),
            'note' => Yii::t('app', 'Примечание'),
        ];
    }

    /**
     * @inheritdoc
     * @return CodesWorkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodesWorkQuery(get_called_class());
    }
}
