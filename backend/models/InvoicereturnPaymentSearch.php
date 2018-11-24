<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InvoicereturnPayment;


class InvoicereturnPaymentSearch extends InvoicereturnPayment
{
  
    public function rules()
    {
        return [
            [['invoicepaymentreturnid', 'branchid', 'returnid', 'patient_mobilenumber'], 'integer'],
            [['patientname', 'mrnumber', 'return_reason', 'referencenumber', 'paymentmethod', 'invoicenumber', 'timestamp', 'updated_timestamp'], 'safe'],
            [['paymentamount'], 'number'],
        ];
    }

  
    public function scenarios()
    {
       
        return Model::scenarios();
    }

   
    public function search($params)
    {
        $query = InvoicereturnPayment::find();
        $dataProvider = new ActiveDataProvider([ 'query' => $query ]);
        $this->load($params);
        if (!$this->validate()) {
           return $dataProvider;
        }
        $query->andFilterWhere([
            'invoicepaymentreturnid' => $this->invoicepaymentreturnid,
            'branchid' => $this->branchid,
            'returnid' => $this->returnid,
            'patient_mobilenumber' => $this->patient_mobilenumber,
            'paymentamount' => $this->paymentamount,
            'timestamp' => $this->timestamp,
            'updated_timestamp' => $this->updated_timestamp,
        ]);
		
		$patienttype=$this->referencenumber;
		if($patienttype==1)
		{
			$ptype="IP";
		}
		else{
			$ptype="OP";
		}
		
		
if(!empty($patienttype))
{
  $query->andFilterWhere(['like', 'invoicenumber',$ptype]);
}
 if(!empty($this->timestamp) && !empty($this->updated_timestamp))
	{
	  $f=$this->timestamp;
	  $t=$this->updated_timestamp;
	  $fromdate=date("Y-m-d",strtotime($f));
	  $todate=date("Y-m-d",strtotime($t));
	  $query->andFilterWhere(['between', 'timestamp',$fromdate, $todate]);
	}
		
		

        $query->andFilterWhere(['like', 'patientname', $this->patientname])
            ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
            ->andFilterWhere(['like', 'return_reason', $this->return_reason])
         
            ->andFilterWhere(['like', 'paymentmethod', $this->paymentmethod])
            ->andFilterWhere(['like', 'invoicenumber', $this->invoicenumber]);
        return $dataProvider;
    }
}
