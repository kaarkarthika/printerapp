<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InRegistration;

/**
 * InRegistrationSearch represents the model behind the search form of `backend\models\InRegistration`.
 */
class InRegistrationSearch extends InRegistration
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['patient_type', 'registered', 'panel_type', 'mr_no', 'ip_no', 'name_initial', 'patient_name', 'dob', 'sex', 'marital_status', 'relation_suffix', 'relative_name', 'address', 'city', 'district', 'state', 'pincode', 'phone_no', 'mobile_no', 'country', 'religion', 'type', 'paytype', 'bed_no', 'room_no', 'floor_no', 'room_type', 'consultant_dr', 'dr_unit', 'speciality', 'co_consultant', 'diagnosis', 'remarks', 'is_active', 'created_date', 'updated_date', 'user_id', 'userrole', 'ipaddress','ucil_to','ucil_from','refered_name'], 'safe'],
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
        $query = InRegistration::find();

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
            'dob' => $this->dob,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'patient_type', $this->patient_type])
            ->andFilterWhere(['like', 'registered', $this->registered])
            ->andFilterWhere(['like', 'panel_type', $this->panel_type])
            ->andFilterWhere(['like', 'mr_no', $this->mr_no])
            ->andFilterWhere(['like', 'ip_no', $this->ip_no])
            ->andFilterWhere(['like', 'name_initial', $this->name_initial])
            ->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'relation_suffix', $this->relation_suffix])
            ->andFilterWhere(['like', 'relative_name', $this->relative_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'phone_no', $this->phone_no])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'paytype', $this->paytype])
            ->andFilterWhere(['like', 'bed_no', $this->bed_no])
            ->andFilterWhere(['like', 'room_no', $this->room_no])
            ->andFilterWhere(['like', 'floor_no', $this->floor_no])
            ->andFilterWhere(['like', 'room_type', $this->room_type])
            ->andFilterWhere(['like', 'consultant_dr', $this->consultant_dr])
            ->andFilterWhere(['like', 'dr_unit', $this->dr_unit])
            ->andFilterWhere(['like', 'speciality', $this->speciality])
            ->andFilterWhere(['like', 'co_consultant', $this->co_consultant])
            ->andFilterWhere(['like', 'diagnosis', $this->diagnosis])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'userrole', $this->userrole])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
