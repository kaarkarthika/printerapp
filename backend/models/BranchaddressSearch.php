<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Branchaddress;

/**
 * BranchaddressSearch represents the model behind the search form about `backend\models\Branchaddress`.
 */
class BranchaddressSearch extends Branchaddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'servicecenter_id', 'mobile'], 'integer'],
            [['branchname', 'address1', 'address2', 'city', 'state', 'pin', 'email', 'website','servicenter_name'], 'safe'],
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
        $query = Branchaddress::find();
		
		 $query-> joinWith(['servicecentreadmin']);

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
           // 'autoid' => $this->autoid,
            //'servicecenter_id' => $this->servicecenter_id,
           // 'mobile' => $this->mobile,
        ]);

        $query->andFilterWhere(['like', 'branchname', $this->branchname])
			 ->andFilterWhere(['like', 'servicecentreadmin.username', $this->servicenter_name])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'pin', $this->pin])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website]);

        return $dataProvider;
    }
}
