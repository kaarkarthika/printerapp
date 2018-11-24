<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabAddgroup;

/**
 * LabAddgroupSearch represents the model behind the search form of `backend\models\LabAddgroup`.
 */
class LabAddgroupSearch extends LabAddgroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'mastergroupid', 'testgroupid', 'created_at', 'updated_at'], 'integer'],
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
        $query = LabAddgroup::find();

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
            'mastergroupid' => $this->mastergroupid,
            'testgroupid' => $this->testgroupid,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_at' => $this->updated_at,
            'update_date' => $this->update_date,
        ]);

        return $dataProvider;
    }
}
