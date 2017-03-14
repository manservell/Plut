<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    public $fullName;
    public $projectNumber;
    public $planned_end_date_from;
    public $planned_end_date_till;
    public $actual_end_date_from;
    public $actual_end_date_till;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'responsible_id', 'budget_hours', 'status'], 'integer'],
            [['number', 'name', 'planned_end_date', 'actual_end_date', 'planned_end_date_from', 'actual_end_date_from', 'actual_end_date_till', 'planned_end_date_till', 'fullName', 'projectNumber'], 'safe'],
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
        $query = Orders::find();

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
        $defSort->attributes['projectNumber'] = [       // добавляем свои
            'asc' => ['project.name' => SORT_ASC],
            'desc' => ['project.name' => SORT_DESC],
            'label' => 'Номер проекта'
        ];
        $dataProvider->setSort($defSort);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['employees'])
                ->joinWith(['projects']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'orders.project_id' => $this->project_id,
            'orders.responsible_id' => $this->responsible_id,
            'orders.budget_hours' => $this->budget_hours,
            'orders.planned_end_date' => $this->planned_end_date,
            'orders.actual_end_date' => $this->actual_end_date,
            'orders.status' => $this->status,
            'orders.number' => $this->number,
        ]);

        $query->andFilterWhere(['like', 'orders.name', $this->name])
            ->andFilterWhere(['>=', 'orders.planned_end_date', $this->planned_end_date_from])
            ->andFilterWhere(['<=', 'orders.planned_end_date', $this->planned_end_date_till])
            ->andFilterWhere(['>=', 'orders.actual_end_date', $this->actual_end_date_from])
            ->andFilterWhere(['<=', 'orders.actual_end_date', $this->actual_end_date_till]);

        $query->joinWith(['employees' => function ($q) {
            $q->where('employee.last_name LIKE "%' . $this->fullName . '%"' .
                ' OR employee.first_name LIKE "%' . $this->fullName . '%"' .
                ' OR employee.middle_name LIKE "%' . $this->fullName . '%"');
        }]);
        $query->joinWith(['projects' => function ($q) {
            $q->where('project.number LIKE "%' . $this->projectNumber . '%"');
        }]);
        return $dataProvider;
    }
}
