<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Testgroup;

/**
 * TestgroupSearch represents the model behind the search form of `backend\models\Testgroup`.
 */
class TestgroupSearch extends Testgroup
{
    /**
     * @inheritdoc
     */ 
    public $test_name;
	public $hsncode;
    public function rules()
    {
        return [
            [['autoid', 'testnameid', 'price', 'created_at', 'updated_at'], 'integer'],
            [['testgroupname', 'isactive', 'created_date', 'updated_date','test_name','hsncode'], 'safe'],
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
        $query = Testgroup::find();

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
            'testnameid' => $this->testnameid,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_at' => $this->updated_at,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'testgroupname', $this->testgroupname])
		->andFilterWhere(['like','lab_testing.test_name', $this->test_name])
		->andFilterWhere(['like','taxgrouping.hsncode', $this->hsncode])
            ->andFilterWhere(['like', 'isactive', $this->isactive]);

        return $dataProvider;
    }


	 public function search1($params)
    {
        $query = Testgroup::find();
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
            'testnameid' => $this->testnameid,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_at' => $this->updated_at,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'testgroupname', $this->testgroupname])
		->andFilterWhere(['like','lab_testing.test_name', $this->test_name])
		->andFilterWhere(['like','taxgrouping.hsncode', $this->hsncode])
            ->andFilterWhere(['like', 'isactive', $this->isactive]);

        return $dataProvider;
    }

}
