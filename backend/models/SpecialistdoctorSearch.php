<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Specialistdoctor;

/**
 * SpecialistdoctorSearch represents the model behind the search form of `backend\models\Specialistdoctor`.
 */
class SpecialistdoctorSearch extends Specialistdoctor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_id'], 'integer'],
            [['consult_amount','ucil_amount'],'number'],
            [['specialist', 'updated_by', 'updated_at', 'created_at', 'ip_address'], 'safe'],
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
        $query = Specialistdoctor::find();

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
            's_id' => $this->s_id,
            'ucil_amount' => $this->ucil_amount,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'specialist', $this->specialist])
			->andFilterWhere(['like', 'consult_amount', $this->consult_amount])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        return $dataProvider;
    }
}
