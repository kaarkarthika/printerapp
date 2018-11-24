<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServiceCentre;

/**
 * TansiServiceCentreSearch represents the model behind the search form about `backend\models\TansiServiceCentre`.
 */
class ServiceCentreSearch extends ServiceCentre
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['center_autoid'], 'integer'],
            [['service_center_name', 'service_center_code', 'username','service_center_status', 'service_center_timestamp', 'service_center_createdat'], 'safe'],
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
        $query = ServiceCentre::find();
     // $query->joinWith(['service']);

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
            'center_autoid' => $this->center_autoid,
            'service_center_timestamp' => $this->service_center_timestamp,
            'service_center_createdat' => $this->service_center_createdat,
           
        ]);

        $query->andFilterWhere(['like', 'service_center_name', $this->service_center_name])
            ->andFilterWhere(['like', 'service_center_code', $this->service_center_code])
			 //  ->andFilterWhere(['like', 'service_centre_admin.username', $this->username])
            ->andFilterWhere(['like', 'service_center_status', $this->service_center_status]);

        return $dataProvider;
    }
}
