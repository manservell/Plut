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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'responsible_id', 'budget_hours'], 'integer'],
            [['number', 'name', 'customer', 'planned_end_date', 'actual_end_date', 'fullName'], 'safe'],
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
        $defSort = $dataProvider->getSort();
        $defSort->attributes['fullName'] = [
            'asc' => ['employees.last_name' => SORT_ASC, 'employees.first_name' => SORT_ASC, 'employees.middle_name' => SORT_ASC],
            'desc' => ['employees.last_name' => SORT_DESC, 'employees.first_name' => SORT_DESC, 'employees.middle_name' => SORT_DESC],
            'label' => 'ФИО'
        ];

        $dataProvider->setSort($defSort);
        $this->status = 1; //устанавливается по-умолчанию

        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['employees']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'responsible_id' => $this->responsible_id,
            'budget_hours' => $this->budget_hours,
            'planned_end_date' => $this->planned_end_date,
            'actual_end_date' => $this->actual_end_date,
        ]);


        $query->andFilterWhere(['like', 'last_name', $this->fullName])
            ->orFilterWhere(['like', 'first_name', $this->fullName])
            ->orFilterWhere(['like', 'middle_name', $this->fullName]);

       $query->joinWith(['employees' => function ($q) {
            $q->where('employee.last_name LIKE "%' . $this->fullName . '%"' .
                'employee.first_name LIKE "%' . $this->fullName . '%"' .
                'employee.middle_name LIKE "%' . $this->fullName . '%"');
        }]);


      //  $query->andWhere('last_name LIKE "%' . $this->fullName . '%" ' .
           // 'OR middle_name LIKE "%' . $this->fullName . '%"' .
           // 'OR first_name LIKE "%' . $this->fullName . '%"'
      ///  );

        return $dataProvider;
    }
}
