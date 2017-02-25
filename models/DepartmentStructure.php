<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department_structure".
 *
 * @property string $id
 * @property string $structure_category
 */
class DepartmentStructure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department_structure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['structure_category'], 'required'],
            [['structure_category'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'structure_category' => Yii::t('app', 'Категории по структуре отдела'),
        ];
    }
}
