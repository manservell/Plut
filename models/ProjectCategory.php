<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_category".
 *
 * @property string $id
 * @property string $responsible_for
 */
class ProjectCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['responsible_for'], 'required'],
            [['responsible_for'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'responsible_for' => Yii::t('app', 'Категории по проектам'),
        ];
    }
}
