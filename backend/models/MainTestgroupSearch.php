<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MainTestgroup;

/**
 * MainTestgroupSearch represents the model behind the search form of `backend\models\MainTestgroup`.
 */
class MainTestgroupSearch extends MainTestgroup
{
    /**
     * @inheritdoc
     */
     public $hsncode1;
    public function rules()
    {
        return [
            [['autoid', 'created_at', 'updated_at'], 'integer'],
            [['testgroupname', 'price', 'hsncode', 'isactive', 'created_date', 'updated_date','shortcode'], 'safe'],
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
        $query = MainTestgroup::find();

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
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_at' => $this->updated_at,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'testgroupname', $this->testgroupname])
            ->andFilterWhere(['like', 'price', $this->price])
          //  ->andFilterWhere(['like','lab_testing.test_name', $this->test_name])
			->andFilterWhere(['like','taxgrouping.hsncode', $this->hsncode])
            ->andFilterWhere(['like', 'isactive', $this->isactive]);

        return $dataProvider;
    }
 public function search1($params)
    {
        $query = MainTestgroup::find();
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
            //'testnameid' => $this->testnameid,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_at' => $this->updated_at,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'testgroupname', $this->testgroupname])
		//->andFilterWhere(['like','lab_testing.test_name', $this->test_name])
		->andFilterWhere(['like','taxgrouping.hsncode', $this->hsncode])
            ->andFilterWhere(['like', 'isactive', $this->isactive]);

        return $dataProvider;
    }
}
