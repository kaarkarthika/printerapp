<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InCategoryReference;

/**
 * InCategoryReferenceSearch represents the model behind the search form of `backend\models\InCategoryReference`.
 */
class InCategoryReferenceSearch extends InCategoryReference
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'category_id'], 'integer'],
            [['dr_visit_price', 'nurse_price'], 'number'],
            [['dr_visit_hsn_code', 'nurse_hsn_code', 'created_date', 'update_date', 'user_id', 'user_role', 'ipaddress'], 'safe'],
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
        $query = InCategoryReference::find();

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
            'dr_visit_price' => $this->dr_visit_price,
            'nurse_price' => $this->nurse_price,
            'created_date' => $this->created_date,
            'update_date' => $this->update_date,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'dr_visit_hsn_code', $this->dr_visit_hsn_code])
            ->andFilterWhere(['like', 'nurse_hsn_code', $this->nurse_hsn_code])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'user_role', $this->user_role])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
