<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Taxmaster;

/**
 * TaxmasterSearch represents the model behind the search form about `backend\models\Taxmaster`.
 */
class TaxmasterSearch extends Taxmaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxid', 'taxvalue','additionaltax', 'is_active'], 'integer'],
              [['financialyear','taxgroup'], 'string'],
            [['updated_by', 'updated_on', 'updated_ipaddress'], 'safe'],
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
        $query = Taxmaster::find();

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
            'taxid' => $this->taxid,
            'taxvalue' => $this->taxvalue,
            'financialyear' => $this->financialyear,
            'additionaltax' => $this->additionaltax,
            'taxgroup'=>$this->taxgroup,
            
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
