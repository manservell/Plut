<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $number
 * @property string $name
 * @property string $responsible_id
 * @property string $budget_hours
 * @property string $planned_end_date
 * @property string $actual_end_date
 * @property string $status
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }
    public function getEmployees(){
        return $this->hasOne(Employee::className(), ['id'=>'responsible_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'name', 'responsible_id', 'budget_hours', 'planned_end_date'], 'required'],
            [['responsible_id', 'budget_hours', 'status'], 'integer'],
            [['planned_end_date', 'actual_end_date'], 'safe'],
            [['number'], 'string', 'max' => 15],
            [['name'], 'string', 'max' => 155],
            [['number'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'name' => 'Name',
            'responsible_id' => 'Responsible ID',
            'budget_hours' => 'Budget Hours',
            'planned_end_date' => 'Planned End Date',
            'actual_end_date' => 'Actual End Date',
            'status' => 'Status',
        ];
    }
}
