<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CodesWork;

/**
 * CodesworkSearch represents the model behind the search form about `app\models\CodesWork`.
 */
class CodesworkSearch extends CodesWork
{
    public $typeName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'note'], 'integer'],
            [['code', 'name','typeName'], 'safe'],
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
        $query = CodesWork::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $defSort = $dataProvider->getSort();// получаем существующие правила сортировки
        $defSort->attributes['typeName'] = [           // добавляем свои
            'asc' => ['work_types.type' => SORT_ASC],
            'desc' => ['work_types.type' => SORT_DESC],
            'label' => 'Вид работ'
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['types']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'note' => $this->note,
        ]);
        $query->joinWith(['types' => function ($q) {
            $q->where('work_types.type LIKE "%' . $this->typeName . '%"');
        }]);
        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
