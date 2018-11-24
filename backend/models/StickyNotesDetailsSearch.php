<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StickyNotesDetails;

/**
 * StickyNotesDetailsSearch represents the model behind the search form about `backend\models\StickyNotesDetails`.
 */
class StickyNotesDetailsSearch extends StickyNotesDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'branch_id', 'group_id', 'notes_check'], 'integer'],
            [['notes_description', 'status', 'created_at', 'modified_at'], 'safe'],
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
        $query = StickyNotesDetails::find();

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
            'branch_id' => $this->branch_id,
            'group_id' => $this->group_id,
            'notes_check' => $this->notes_check,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'notes_description', $this->notes_description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
