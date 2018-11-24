<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stickynotes;

/**
 * StickynotesSearch represents the model behind the search form about `backend\models\Stickynotes`.
 */
class StickynotesSearch extends Stickynotes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noteid', 'is_active', 'updated_by'], 'integer'],
            [['notetitle', 'notedesc', 'colorscheme', 'updated_on', 'updated_ipaddress'], 'safe'],
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
        $query = Stickynotes::find();

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
            'noteid' => $this->noteid,
            'is_active' => $this->is_active,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'notetitle', $this->notetitle])
            ->andFilterWhere(['like', 'notedesc', $this->notedesc])
            ->andFilterWhere(['like', 'colorscheme', $this->colorscheme])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
