<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property string $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $department_id
 * @property string $sector_id
 * @property string $status
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'middle_name', 'last_name', 'department_id', 'sector_id'], 'required'],
            [['department_id', 'sector_id', 'status'], 'integer'],
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 55],
        ];
    }
    public function getSectors(){
        return $this->hasOne(Sector::className(), ['id'=>'sector_id']);
    }

    /* Геттер для названия сектора*/
    public function getSectorName() {
        return $this->sectors->sector;
    }

    public function getDepartments(){
        return $this->hasOne(DepartmentStructure::className(), ['id'=>'department_id']);
    }

    /* Геттер для названия департамента*/
    public function getDepartmentName() {
        return $this->departments->structure_category;
    }

    /* Геттер для ФИО*/
    public function getFullName() {
        return $this->last_name. ' '. $this->first_name. ' ' . $this->middle_name;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'Имя'),
            'middle_name' => Yii::t('app', 'Отчество'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'department_id' => Yii::t('app', 'Категория по структуре отдела'),
            'departmentName' => Yii::t('app', 'Категория по структуре отдела'),
            'status' => Yii::t('app', 'Статус'),
            'sector_id' => Yii::t('app', 'Сектор'),
            'sectorName' => Yii::t('app', 'Сектор'),
            'fullName' => Yii::t('app', 'ФИО'),
        ];
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }
}
