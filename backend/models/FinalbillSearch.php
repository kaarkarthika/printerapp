<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Finalbill;

/**
 * FinalbillSearch represents the model behind the search form of `backend\models\Finalbill`.
 */
class FinalbillSearch extends Finalbill
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['ipno', 'mrno', 'name', 'age', 'gender', 'doa', 'dod', 'total_amt', 'discount', 'net_amount', 'paid_amount', 'balance_amount', 'reason', 'refundable', 'auth_by', 'remark', 'status', 'created_date', 'updated_date', 'user_id', 'user_role', 'ipaddress'], 'safe'],
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
        $query = Finalbill::find();

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
            'doa' => $this->doa,
            'dod' => $this->dod,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'ipno', $this->ipno])
            ->andFilterWhere(['like', 'mrno', $this->mrno])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'total_amt', $this->total_amt])
            ->andFilterWhere(['like', 'discount', $this->discount])
            ->andFilterWhere(['like', 'net_amount', $this->net_amount])
            ->andFilterWhere(['like', 'paid_amount', $this->paid_amount])
            ->andFilterWhere(['like', 'balance_amount', $this->balance_amount])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'refundable', $this->refundable])
            ->andFilterWhere(['like', 'auth_by', $this->auth_by])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'user_role', $this->user_role])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
