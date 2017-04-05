<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time_sheet".
 *
 * @property string $id
 * @property string $full_name
 * @property string $sector
 * @property string $project_number
 * @property string $project_name
 * @property string $order_number
 * @property string $work_code
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
            [['full_name', 'sector', 'project_number', 'project_name', 'order_number', 'work_code', 'date', 'hours'], 'required'],
            [['date'], 'safe'],
            [['hours'], 'integer'],
            [['full_name', 'sector', 'note'], 'string', 'max' => 255],
            [['project_number', 'order_number', 'work_code'], 'string', 'max' => 15],
            [['project_name'], 'string', 'max' => 155],
        ];
    }
    public function getProjects(){
        return $this->hasOne(Project::className(), ['id'=>'project_number']);
    }
    public function getProjectNumber() {
        return $this->projects->number;
    }
    public function getProjectName() {
        return $this->projects->name;
    }
    public function getOrder(){
        return $this->hasOne(Orders::className(), ['id'=>'order_number']);
    }
    public function getOrderNumber() {
        return $this->order->number;
    }
    public function getCodes(){
        return $this->hasOne(CodesWork::className(), ['id'=>'work_code']);
    }
    public function getCodeWork() {
        return $this->codes->code;
    }
   // public function getSectors(){
       // return $this->hasOne(Sector::className(), ['id'=>'sector']);
  //  }
    /* Геттер для названия сектора*/
    //public function getSectorName() {
        //return $this->sectors->sector;
   // }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'full_name' => Yii::t('app', 'ФИО'),
            'sector' => Yii::t('app', 'Сектор'),
            'sectorName' => Yii::t('app', 'Сектор'),
            'projectNumber' => Yii::t('app', 'Номер проекта'),
            'projectName' => Yii::t('app', 'Наименование проекта'),
            'orderNumber' => Yii::t('app', 'Номер заказа'),
            'codeWork' => Yii::t('app', 'Код работ'),
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
}
