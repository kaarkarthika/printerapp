<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InCategorygroup;

/**
 * InCategorygroupSearch represents the model behind the search form of `backend\models\InCategorygroup`.
 */
class InCategorygroupSearch extends InCategorygroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'category_id', 'room_typeid'], 'integer'],
            [['total'], 'number'],
            [['is_active', 'created_date', 'updated_date', 'user_id', 'user_role', 'ipaddress','roomtypename','categoryname'], 'safe'],
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
        $query = InCategorygroup::find()->joinWith('roomtype')->joinWith('category');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'autoid' => $this->autoid,
            'category_id' => $this->category_id,
            'room_typeid' => $this->room_typeid,
            'total' => $this->total,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'is_active', $this->is_active])
		
		->andFilterWhere(['like', 'in_roomtypes.room_types', $this->roomtypename])
		->andFilterWhere(['like', 'in_category.category_name', $this->categoryname])
		
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'user_role', $this->user_role])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
