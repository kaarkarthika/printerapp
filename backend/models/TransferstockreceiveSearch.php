<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Transferstockreceive;

/**
 * TransferstockreceiveSearch represents the model behind the search form about `backend\models\Transferstockreceive`.
 */
class TransferstockreceiveSearch extends Transferstockreceive
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transferstockreceiveid', 'transferstockid', 'receivedquantity',  'updated_by'], 'integer'],
            [['transferstock_requestcode', 'batchnumber', 'receiveddate', 'manufacturedate', 'expiredate', 'purchasedate', 'updated_on', 'updated_ipaddress'], 'safe'],
            [[ 'priceperquantity'], 'number'],
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
        $query = Transferstockreceive::find();

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
            'transferstockreceiveid' => $this->transferstockreceiveid,
            'transferstockid' => $this->transferstockid,
            'receivedquantity' => $this->receivedquantity,
            'receiveddate' => $this->receiveddate,
           
            'priceperquantity' => $this->priceperquantity,
            'manufacturedate' => $this->manufacturedate,
            'expiredate' => $this->expiredate,
            'purchasedate' => $this->purchasedate,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'transferstock_requestcode', $this->transferstock_requestcode])
            ->andFilterWhere(['like', 'batchnumber', $this->batchnumber])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
