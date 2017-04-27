<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    public $sectorName;
    public $departmentName;
    public $fullName;
    public $role;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'sector_id', 'status'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'fullName', 'sectorName', 'departmentName', 'role', 'username'], 'safe'],
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
        $query = Employee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $defSort = $dataProvider->getSort();// получаем существующие правила сортировки
        $defSort->attributes['sectorName'] = [       // добавляем свои
            'asc' => ['sector.sector' => SORT_ASC],
            'desc' => ['sector.sector' => SORT_DESC],
            'label' => 'Сектор'
        ];
        $defSort->attributes['departmentName'] = [
            'asc' => ['department_structure.structure_category' => SORT_ASC],
            'desc' => ['department_structure.structure_category' => SORT_DESC],
            'label' => 'Категория по структуре отдела'
        ];
        $defSort->attributes['fullName'] = [
            'asc' => ['employee.last_name' => SORT_ASC, 'employee.first_name' => SORT_ASC, 'employee.middle_name' => SORT_ASC],
            'desc' => ['employee.last_name' => SORT_DESC, 'employee.first_name' => SORT_DESC, 'employee.middle_name' => SORT_DESC],
            'label' => 'ФИО'
        ];
        $defSort->attributes['role'] = [       // добавляем свои
            'asc' => ['auth_assignment.item_name' => SORT_ASC],
            'desc' => ['auth_assignment.item_name' => SORT_DESC],
            'label' => 'Роль'
        ];
        $dataProvider->setSort($defSort);
        $this->status = 1; //устанавливается по-умолчанию

      //  $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['sectors'])
                ->joinWith(['departments']);
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'department_id' => $this->department_id,
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['like', 'first_name', $this->fullName])
            ->orFilterWhere(['like', 'middle_name', $this->fullName])
            ->orFilterWhere(['like', 'last_name', $this->fullName]);
        //  where ... and (first_name like %$this->fullName% or middle_name like %$this->fullName% or last_name like %$this->fullName%)
        // Фильтр по сектору
        $query->joinWith(['sectors' => function ($q) {
            $q->where('sector.sector LIKE "%' . $this->sectorName . '%"');
        }]);
        $query->joinWith(['departments' => function ($q) {
            $q->where('department_structure.structure_category LIKE "%' . $this->departmentName . '%"');
        }]);
        $query->joinWith(['roles' => function ($q) {
            $q->andFilterWhere(['auth_assignment.item_name' => $this->role]);
        }]);
        return $dataProvider;
    }
}