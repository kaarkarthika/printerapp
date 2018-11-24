<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyGst;

/**
 * CompanyGstSearch represents the model behind the search form about `backend\models\CompanyGst`.
 */
class CompanyGstSearch extends CompanyGst
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gstid', 'company_id', 'stateid', 'isactive'], 'integer'],
            [['gst','company_name', 'state','updatedby', 'updatedon', 'updatedipaddress'], 'safe'],
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
        $query = CompanyGst::find()->joinwith(['comp','satz']);

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
            'gstid' => $this->gstid,
            'company_id' => $this->company_id,
            'stateid' => $this->stateid,
            'isactive' => $this->isactive,
            'updatedon' => $this->updatedon,
        ]);

        $query->andFilterWhere(['like', 'gst', $this->gst])
            ->andFilterWhere(['like', 'updatedby', $this->updatedby])
			 ->andFilterWhere(['like', 'company_name', $this->company_name])
			 ->andFilterWhere(['like', 'state_name', $this->state])
            ->andFilterWhere(['like', 'updatedipaddress', $this->updatedipaddress]);

        return $dataProvider;
    }
}
