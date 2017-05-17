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
    public $fullName;
    public $projectNumber;
    public $projectName;
    public $orderNumber;
    public $sectorName;
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
            [['employee_id', 'sector_id', 'project_number_id', 'project_name_id', 'order_number_id', 'work_code_id', 'date', 'note', 'projectNumber', 'projectName', 'orderNumber', 'codeWork', 'date_from', 'date_till', 'sectorName', 'fullName'], 'safe'],
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

        $defSort->attributes['fullName'] = [ // добавляем свои
            'asc' => ['employee.last_name' => SORT_ASC, 'employee.first_name' => SORT_ASC, 'employee.middle_name' => SORT_ASC],
            'desc' => ['employee.last_name' => SORT_DESC, 'employee.first_name' => SORT_DESC, 'employee.middle_name' => SORT_DESC],
            'label' => 'ФИО'
        ];

        $defSort->attributes['projectNumber'] = [       // добавляем свои
            'asc' => ['project.number' => SORT_ASC],
            'desc' => ['project.number' => SORT_DESC],
            'label' => 'Номер проекта'
        ];

        $defSort->attributes['sectorName'] = [       // добавляем свои
            'asc' => ['sector.sector' => SORT_ASC],
            'desc' => ['sector.sector' => SORT_DESC],
            'label' => 'Сектор'
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
            'employee_id' => $this->employee_id,
            'time_sheet.sector_id' => $this->sector_id,
            'project_number_id' => $this->project_number_id,
            'project_name_id' => $this->project_name_id,
            'order_number_id' => $this->order_number_id,
            'work_code_id' => $this->work_code_id,
            'note' => $this->note,
        ]);

        $query->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'time_sheet.sector_id', $this->sector_id])
            ->andFilterWhere(['like', 'note', $this->note]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['>=', 'date', $this->date_from])
            ->andFilterWhere(['<=', 'date', $this->date_till]);

        $query->joinWith(['projects' => function ($q) {
            $q->where('project.number LIKE "%' . $this->projectNumber . '%"');
        }]);
        $query->joinWith(['sectors' => function ($q) {
            $q->where('sector.sector LIKE "%' . $this->sectorName . '%"');
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

        $query->joinWith(['employees' => function ($q) {
            $q->where('employee.last_name LIKE "%' . $this->fullName . '%"' .
                ' OR employee.first_name LIKE "%' . $this->fullName . '%"' .
                ' OR employee.middle_name LIKE "%' . $this->fullName . '%"');
        }]);
        return $dataProvider;
    }
}
