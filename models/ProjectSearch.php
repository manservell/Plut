<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

/**
 * ProjectSearch represents the model behind the search form about `app\models\Project`.
 */
class ProjectSearch extends Project
{
    public $fullName;
    public $planned_end_date_from;
    public $planned_end_date_till;
    public $actual_end_date_from;
    public $actual_end_date_till;
    public $date_creation_from;
    public $date_creation_till;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'responsible_id', 'budget_hours'], 'integer'],
            [['number', 'name', 'date_creation', 'customer', 'date_creation_from', 'date_creation_till', 'planned_end_date', 'actual_end_date', 'planned_end_date_from', 'actual_end_date_from', 'actual_end_date_till', 'planned_end_date_till', 'fullName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Project::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $defSort = $dataProvider->getSort();// получаем существующие правила сортировки
        $defSort->attributes['fullName'] = [ // добавляем свои
            'asc' => ['employee.last_name' => SORT_ASC, 'employee.first_name' => SORT_ASC, 'employee.middle_name' => SORT_ASC],
            'desc' => ['employee.last_name' => SORT_DESC, 'employee.first_name' => SORT_DESC, 'employee.middle_name' => SORT_DESC],
            'label' => 'ФИО'
        ];

        $dataProvider->setSort($defSort);
      //  $this->status = 1; //устанавливается по-умолчанию

        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['employees']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'project.status' => $this->status,
            'number' => $this->number,
            'id' => $this->id,
            'project.status' => $this->status,
            'responsible_id' => $this->responsible_id,
            'budget_hours' => $this->budget_hours,
            'planned_end_date' => $this->planned_end_date,
            'actual_end_date' => $this->actual_end_date,
        ]);
        $query->andFilterWhere(['>=', 'project.date_creation', $this->date_creation_from])
            ->andFilterWhere(['<=', 'project.date_creation', $this->date_creation_till]);

        $query->andFilterWhere(['>=', 'planned_end_date', $this->planned_end_date_from ? $this->planned_end_date_from : null])
            ->andFilterWhere(['<=', 'planned_end_date', $this->planned_end_date_till ? $this->planned_end_date_till : null])
            ->andFilterWhere(['>=', 'actual_end_date', $this->actual_end_date_from ? $this->actual_end_date_from : null])
            ->andFilterWhere(['<=', 'actual_end_date', $this->actual_end_date_till ? $this->actual_end_date_till : null]);

        $query->andFilterWhere(['like', 'last_name', $this->fullName])
            ->orFilterWhere(['like', 'first_name', $this->fullName])
            ->orFilterWhere(['like', 'middle_name', $this->fullName]);
        $query->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['>=', 'planned_end_date', $this->planned_end_date_from])
            ->andFilterWhere(['<=', 'planned_end_date', $this->planned_end_date_till])
            ->andFilterWhere(['>=', 'actual_end_date', $this->actual_end_date_from])
            ->andFilterWhere(['<=', 'actual_end_date', $this->actual_end_date_till]);

        $query->joinWith(['employees' => function ($q) {
            $q->where('employee.last_name LIKE "%' . $this->fullName . '%"' .
                ' OR employee.first_name LIKE "%' . $this->fullName . '%"' .
                ' OR employee.middle_name LIKE "%' . $this->fullName . '%"');
        }]);

        return $dataProvider;
    }
}
