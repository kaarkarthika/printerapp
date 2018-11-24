<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Emailtemplate;

/**
 * EmailtemplateSearch represents the model behind the search form about `backend\models\Emailtemplate`.
 */
class EmailtemplateSearch extends Emailtemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emailid', 'userfrom', 'userto', 'isread'], 'integer'],
            [['message', 'datesent', 'attachment'], 'safe'],
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
        $query = Emailtemplate::find();

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
            'emailid' => $this->emailid,
            'userfrom' => $this->userfrom,
            'userto' => $this->userto,
            'isread' => $this->isread,
            'datesent' => $this->datesent,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'attachment', $this->attachment]);

        return $dataProvider;
    }
}
