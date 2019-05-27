<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CustomerMaster;

/**
 * CustomerMasterSearch represents the model behind the search form of `backend\models\CustomerMaster`.
 */
class CustomerMasterSearch extends CustomerMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_id'], 'integer'],
            [['company_name', 'phone_no', 'address', 'gst', 'state_code', 'created_date', 'updated_at', 'updated_ipaddress', 'user_id','customer_name'], 'safe'],
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
        $query = CustomerMaster::find()->orderBy(['company_name'=>SORT_ASC]);

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
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'phone_no', $this->phone_no])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gst', $this->gst])
            ->andFilterWhere(['like', 'state_code', $this->state_code])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
