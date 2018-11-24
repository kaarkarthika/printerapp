<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabSubcategory;

/**
 * LabSubcategorySearch represents the model behind the search form of `backend\models\LabSubcategory`.
 */
class LabSubcategorySearch extends LabSubcategory
{
    /**
     * @inheritdoc
     */
     public $category_name;
    public function rules()
    {
        return [
            [['auto_id'], 'integer'],
            [['lab_subcategory', 'category_id', 'isactive', 'created_at', 'created_date', 'update_at', 'update_date','category_name'], 'safe'],
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
        $query = LabSubcategory::find();

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
            'auto_id' => $this->auto_id,
            'created_date' => $this->created_date,
            'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'lab_subcategory', $this->lab_subcategory])
            ->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'isactive', $this->isactive])
			->andFilterWhere(['like', 'lab_category.category_name', $this->category_name])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'update_at', $this->update_at]);

        return $dataProvider;
    }
}
