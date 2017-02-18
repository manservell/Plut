<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $id
 * @property string $number
 * @property string $name
 * @property string $customer
 * @property string $status
 * @property string $responsible_id
 * @property string $budget_hours
 * @property string $planned_end_date
 * @property string $actual_end_date
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'name', 'customer', 'responsible_id', 'budget_hours', 'planned_end_date'], 'required'],
            [['status', 'responsible_id', 'budget_hours'], 'integer'],
            [['planned_end_date', 'actual_end_date'], 'safe'],
            [['number'], 'string', 'max' => 15],
            [['name', 'customer'], 'string', 'max' => 155],
            [['number'], 'unique'],
        ];
    }
    public function getEmployees(){
        return $this->hasOne(Employee::className(), ['id'=>'responsible_id']);
    }

    /* Геттер для ФИО*/
    public function getFullName() {
        return $this->employees->last_name. ' '. $this->employees->first_name. ' ' . $this->employees->middle_name;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Номер пректа'),
            'name' => Yii::t('app', 'Наименование'),
            'customer' => Yii::t('app', 'Заказчик'),
            'status' => Yii::t('app', 'Статус'),
            'responsible_id' => Yii::t('app', 'Ответственный'),
            'budget_hours' => Yii::t('app', 'Бюджет часов'),
            'planned_end_date' => Yii::t('app', 'Запланированная дата выполнения'),
            'actual_end_date' => Yii::t('app', 'Фактическая дата выполнения'),
            'fullName' => Yii::t('app', 'ФИО'),
        ];
    }

    /**
     * @inheritdoc
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
}
