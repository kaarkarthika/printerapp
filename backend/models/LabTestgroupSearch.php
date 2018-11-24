<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabTestgroup;

/**
 * LabTestgroupSearch represents the model behind the search form of `backend\models\LabTestgroup`.
 */
class LabTestgroupSearch extends LabTestgroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'testgroupid', 'test_nameid', 'created_at', 'updated_at'], 'integer'],
            [['created_date', 'update_date'], 'safe'],
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
        $query = LabTestgroup::find();

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
            'testgroupid' => $this->testgroupid,
            'test_nameid' => $this->test_nameid,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_at' => $this->updated_at,
            'update_date' => $this->update_date,
        ]);

        return $dataProvider;
    }
}
