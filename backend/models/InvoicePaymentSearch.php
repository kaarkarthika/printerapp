<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InvoicePayment;
class InvoicePaymentSearch extends InvoicePayment
{
    
    public function rules()
    {
        return [
            [['invoicepaymentid', 'branchid', 'saleid'], 'integer'],
            [['paymentmethod', 'invoicenumber', 'cardtype', 'cardholdername', 'referencenumber', 'timestamp', 'updated_timestamp'], 'safe'],
            [['paymentamount'], 'number'],
        ];
    }

  
    public function scenarios()
    {
       
        return Model::scenarios();
    }

  
    public function search($params)
    {
        $query = InvoicePayment::find()->groupBy(['invoicenumber'])->orderBy(['invoicepaymentid'=>SORT_DESC]);
        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
		}
		else{
		$query->andFilterWhere(['branchid' =>$companybranchid]);
		} 

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
          
            return $dataProvider;
        }
		
		$patienttype=$this->cardtype;
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
    if(!empty($this->timestamp))
	{
	$tsd=date('Y-m-d', strtotime($this->timestamp));
    $query->andFilterWhere(['timestamp' =>$tsd]);
	}
	
if(!empty($this->timestamp) && !empty($this->updated_timestamp))
	{
	  $f=$this->timestamp;
	  $t=$this->updated_timestamp;
	  $fromdate=date("Y-m-d",strtotime($f));
	  $todate=date("Y-m-d",strtotime($t));
	  $query->andFilterWhere(['between', 'timestamp',$fromdate, $todate]);
	}
  
		
		 $query->andFilterWhere(['like', 'invoicenumber',$this->invoicenumber]);
        $query->andFilterWhere([
            'invoicepaymentid' => $this->invoicepaymentid,
            'branchid' => $this->branchid,
            'saleid' => $this->saleid,
            'paymentamount' => $this->paymentamount,
           
        ]);

        $query->andFilterWhere(['like', 'paymentmethod', $this->paymentmethod])
            ->andFilterWhere(['like', 'cardholdername', $this->cardholdername])
            ->andFilterWhere(['like', 'referencenumber', $this->referencenumber]);

        return $dataProvider;
    }
}