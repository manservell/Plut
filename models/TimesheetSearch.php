<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TimeSheet;

/**
 * TimesheetSearch represents the model behind the search form about `app\models\TimeSheet`.
 */
class TimesheetSearch extends TimeSheet
{
    public $projectNumber;
    public $projectName;
    public $orderNumber;
    public $codeWork;
    public $date_from;
    public $date_till;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hours'], 'integer'],
            [['full_name', 'sector', 'project_number', 'project_name', 'order_number', 'work_code', 'date', 'note', 'projectNumber', 'projectName', 'orderNumber', 'codeWork', 'date_from', 'date_till'], 'safe'],
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
        $query = TimeSheet::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $defSort = $dataProvider->getSort();// получаем существующие правила сортировки
        $defSort->attributes['projectNumber'] = [       // добавляем свои
            'asc' => ['project.number' => SORT_ASC],
            'desc' => ['project.number' => SORT_DESC],
            'label' => 'Номер проекта'
        ];

        $defSort->attributes['projectName'] = [       // добавляем свои
            'asc' => ['project.name' => SORT_ASC],
            'desc' => ['project.name' => SORT_DESC],
            'label' => 'Номер проекта'
        ];

        $defSort->attributes['orderNumber'] = [       // добавляем свои
            'asc' => ['orders.number' => SORT_ASC],
            'desc' => ['orders.number' => SORT_DESC],
            'label' => 'Номер проекта'
        ];

        $defSort->attributes['codeWork'] = [       // добавляем свои
            'asc' => ['code' => SORT_ASC],
            'desc' => ['code' => SORT_DESC],
            'label' => 'Номер проекта'
        ];

        $dataProvider->setSort($defSort);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'hours' => $this->hours,
            'full_name' => $this->full_name,
            'sector' => $this->sector,
            'project_number' => $this->project_number,
            'project_name' => $this->project_name,
            'order_number' => $this->order_number,
            'work_code' => $this->work_code,
            'note' => $this->note,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'sector', $this->sector])
            ->andFilterWhere(['like', 'note', $this->note]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['>=', 'date', $this->date_from])
            ->andFilterWhere(['<=', 'date', $this->date_till]);

        $query->joinWith(['projects' => function ($q) {
            $q->where('project.number LIKE "%' . $this->projectNumber . '%"');
        }]);
        $query->joinWith(['projects' => function ($q) {
            $q->where('project.name LIKE "%' . $this->projectName . '%"');
        }]);
        $query->joinWith(['order' => function ($q) {
            $q->where('orders.number LIKE "%' . $this->orderNumber . '%"');
        }]);
        $query->joinWith(['codes' => function ($q) {
            $q->where('code LIKE "%' . $this->codeWork . '%"');
        }]);
        return $dataProvider;
    }
}
