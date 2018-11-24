<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AdminThemeVersion;

/**
 * AdminThemeVersionSearch represents the model behind the search form about `backend\models\AdminThemeVersion`.
 */
class AdminThemeVersionSearch extends AdminThemeVersion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['reconcileversionname', 'reconcileversion', 'reconcileversionkey', 'timestamp'], 'safe'],
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
        $query = AdminThemeVersion::find();

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
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'reconcileversionname', $this->reconcileversionname])
            ->andFilterWhere(['like', 'reconcileversion', $this->reconcileversion])
            ->andFilterWhere(['like', 'reconcileversionkey', $this->reconcileversionkey]);

        return $dataProvider;
    }
}
