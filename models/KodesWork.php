<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kodes_work".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $type_id
 * @property string $note
 */
class KodesWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kodes_work';
    }
    public function getTypes(){
        return $this->hasOne(Types::className(), ['id'=>'type_id']);
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'type_id' => 'Type ID',
            'note' => 'Note',
        ];
    }
}
