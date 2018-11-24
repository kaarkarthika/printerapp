<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServiceCentreAdmin;

/**
 * TansiServiceCentreAdminSearch represents the model behind the search form about `backend\models\TansiServiceCentreAdmin`.
 */
class ServiceCentreAdminSearch extends ServiceCentreAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['servicecenter_id', 'username', 'first_name', 'last_name', 'dob','servicecentername' ,'user_type', 'city', 'auth_key', 'password_hash', 'password_reset_token', 'created_at', 'timestamp', 'rights', 'status_flag', 'user_level', 'mobile_number', 'designation'], 'safe'],
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
        $query = ServiceCentreAdmin::find();
        $query->joinWith(['service']);

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
            'id' => $this->id,
            'dob' => $this->dob,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'servicecenter_id', $this->servicecenter_id])
            ->andFilterWhere(['like', 'username', $this->username])
             ->andFilterWhere(['like', 'service_centre.service_center_name', $this->servicecentername])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'user_type', $this->user_type])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'rights', $this->rights])
            ->andFilterWhere(['like', 'status_flag', $this->status_flag])
            ->andFilterWhere(['like', 'user_level', $this->user_level])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'designation', $this->designation]);

        return $dataProvider;
    }
}
