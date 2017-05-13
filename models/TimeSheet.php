<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time_sheet".
 *
 * @property string $id
 * @property string $employee_id
 * @property string $sector_id
 * @property string $project_number_id
 * @property string $project_name_id
 * @property string $order_number_id
 * @property string $work_code_id
 * @property string $date
 * @property string $hours
 * @property string $note
 */
class TimeSheet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time_sheet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'sector_id', 'project_number_id', 'project_name_id', 'order_number_id', 'work_code_id', 'date', 'hours' ], 'required'],
            [['date'], 'safe'],
            [['hours', 'employee_id', 'sector_id', 'project_number_id', 'project_name_id', 'order_number_id', 'work_code_id'], 'integer'],
            [[ 'note'], 'string', 'max' => 255],
            [[ 'note'], 'noteCheck', 'skipOnEmpty' => false, 'skipOnError' => false],

        ];
    }
    public function getProjects(){
        return $this->hasOne(Project::className(), ['id'=>'project_number_id']);
    }
    public function getProjectNumber() {
        return $this->projects->number;
    }
    public function getProjectName() {
        return $this->projects->name;
    }
    public function getOrder(){
        return $this->hasOne(Orders::className(), ['id'=>'order_number_id']);
    }
    public function getOrderNumber() {
        return $this->order->number;
    }
    public function getCodes(){
        return $this->hasOne(CodesWork::className(), ['id'=>'work_code_id']);
    }
    public function getCodeWork() {
        return $this->codes->code;
    }
    public function getSectors(){
        return $this->hasOne(Sector::className(), ['id'=>'sector_id']);
    }
    public function getSectorName() {
        return $this->sectors->sector;
    }
    public function getEmployees(){
        return $this->hasOne(Employee::className(), ['id'=>'employee_id']);
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
            'fullName' => Yii::t('app', 'ФИО'),
            'employee_id' => Yii::t('app', 'ФИО'),
            'sectorName' => Yii::t('app', 'Сектор'),
            'sector_id' => Yii::t('app', 'Сектор'),
            'projectNumber' => Yii::t('app', 'Номер проекта'),
            'project_number_id' => Yii::t('app', 'Номер проекта'),
            'projectName' => Yii::t('app', 'Наименование проекта'),
            'project_name_id' => Yii::t('app', 'Наименование проекта'),
            'orderNumber' => Yii::t('app', 'Номер заказа'),
            'order_number_id' => Yii::t('app', 'Номер заказа'),
            'codeWork' => Yii::t('app', 'Код работ'),
            'work_code_id' => Yii::t('app', 'Код работ'),
            'date' => Yii::t('app', 'Дата'),
            'hours' => Yii::t('app', 'Часы'),
            'note' => Yii::t('app', 'Примечание'),
        ];
    }

    /**
     * @inheritdoc
     * @return TimeSheetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TimeSheetQuery(get_called_class());
    }
    public function noteCheck($attribute){
       // $this->addError($attribute, 'Заполните примечание!');
        //return false;
        header('Content-Type: text/html; charset=utf-8');
       // echo "<pre>";
        //var_dump($this->work_code_id);
        //echo "</pre>";
       // exit(0);
        $work_code=CodesWork::find()->where(['id'=>$this->work_code_id])->one();
       // echo "<pre>";
       // var_dump($work_code->note);
       // echo "</pre>";
       // exit(0);
        if(empty($this->note)&& $work_code->note=='1'){
            $this->addError($attribute, 'Заполните примечание!');
            return false;
        }
        return true;
    }
}
