<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BlockIpEntries;

/**
 * BlockIpEntriesSearch represents the model behind the search form of `backend\models\BlockIpEntries`.
 */
class BlockIpEntriesSearch extends BlockIpEntries
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_id', 'ip_no', 'mr_no', 'age', 'phone_no', 'mobile_no', 'user_id', 'in_reg_id'], 'integer'],
            [['patient_name', 'address', 'sex', 'doctor_name', 'doctor_name_2', 'admit_date', 'discharge_date', 'relative_name', 'city', 'state', 'pincode', 'updated_at', 'created_at', 'ip_address', 'user_name'], 'safe'],
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
        $query = BlockIpEntries::find();

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
            'ip_no' => $this->ip_no,
            'mr_no' => $this->mr_no,
            'age' => $this->age,
            'phone_no' => $this->phone_no,
            'mobile_no' => $this->mobile_no,
            'admit_date' => $this->admit_date,
            'discharge_date' => $this->discharge_date,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'user_id' => $this->user_id,
            'in_reg_id' => $this->in_reg_id,
        ]);

        $query->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'doctor_name', $this->doctor_name])
            ->andFilterWhere(['like', 'doctor_name_2', $this->doctor_name_2])
            ->andFilterWhere(['like', 'relative_name', $this->relative_name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'user_name', $this->user_name]);

        return $dataProvider;
    }
}
