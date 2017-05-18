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
            [['number', 'name', 'customer',], 'required'],
            [['status', 'responsible_id', 'budget_hours'], 'integer'],
            [['planned_end_date', 'actual_end_date'], 'safe'],
            [['number'], 'string', 'max' => 15],
            [['name', 'customer'], 'string', 'max' => 155],
            [['number'], 'unique'],
            [[ 'status'], 'statusCheck', 'skipOnEmpty' => false, 'skipOnError' => false],
            [[ 'actual_end_date'], 'checkDate', 'skipOnEmpty' => false, 'skipOnError' => false],
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
            'date_creation' => Yii::t('app', 'Дата создания заказа'),
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

    public function statusCheck(){
        if(!empty($this->responsible_id)&&!empty($this->budget_hours)&&!empty($this->planned_end_date)){
            $this->status="0";
            if(!empty($this->responsible_id)&&!empty($this->budget_hours)&&!empty($this->planned_end_date)&&!empty($this->actual_end_date)){
                $this->status="1";
                return true;
            }
        }
        else{
            $this->status="2";
        }

        return true;
    }
    public function checkDate($attribute){
        //получаю id текущего проекта
        $project=$this->id;   //работает
        $projectEndDate=$this->actual_end_date;   //работает
        //echo "<pre>";
        //var_dump($projectEndDate);
        //echo "</pre>";
        //exit(0);
        $orders=Orders::find()
            ->where(['project_id' => $project])
            ->all();//получаю объект заказов, соответствующих текущему проекту
        //с помошью цикла перебираю actual_end_date в объекте $orders, если эти даты существуют и они меньше чем дата закрытия текущего проекта, то проект принимает статут ЗАКРЫТ
        foreach($orders as $order){
            if($order->actual_end_date>$projectEndDate){
                $this->addError($attribute, 'Проект не может быть закрыт! Дата закрытия проекта раньше, чем дата закрытия последнего заказа.');
                return false;
            }
            if(empty($order->actual_end_date)){
                $this->addError($attribute, 'Проект не может быть закрыт! У текущего проекта есть не закрытые заказы.');
                return false;
            }
            continue;
        }
    }
}
