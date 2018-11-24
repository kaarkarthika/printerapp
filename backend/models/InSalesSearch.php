<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InSales;

/**
 * InSalesSearch represents the model behind the search form of `backend\models\InSales`.
 */
class InSalesSearch extends InSales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['opsaleid', 'branch_id', 'insurancetype', 'saleincrement'], 'integer'],
            [['sales_type', 'return_status', 'name', 'dob', 'gender', 'physicianname', 'mrnumber', 'patienttype', 'patient_id', 'ip_no','subvisit_id', 'subvisit_num', 'address', 'phonenumber', 'billnumber', 'invoicedate', 'total', 'tot_no_of_items', 'tot_quantity', 'overalldiscounttype', 'paid_status', 'updated_by', 'updated_on', 'updated_ipaddress', 'created_at','paid_amt','due_amt'], 'safe'],
            [['total_gst_percent', 'total_cgst_percent', 'total_sgst_percent', 'totalgstvalue', 'totalcgstvalue', 'totalsgstvalue', 'totaldiscountvalue', 'totaltaxableamount', 'overalldiscountpercent', 'overalldiscountamount', 'overall_sub_total', 'overalltotal'], 'number'],
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
        $query = InSales::find();

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
            'opsaleid' => $this->opsaleid,
            'branch_id' => $this->branch_id,
            'dob' => $this->dob,
            'insurancetype' => $this->insurancetype,
            'invoicedate' => $this->invoicedate,
            'total_gst_percent' => $this->total_gst_percent,
            'total_cgst_percent' => $this->total_cgst_percent,
            'total_sgst_percent' => $this->total_sgst_percent,
            'totalgstvalue' => $this->totalgstvalue,
            'totalcgstvalue' => $this->totalcgstvalue,
            'totalsgstvalue' => $this->totalsgstvalue,
            'totaldiscountvalue' => $this->totaldiscountvalue,
            'totaltaxableamount' => $this->totaltaxableamount,
            'overalldiscountpercent' => $this->overalldiscountpercent,
            'overalldiscountamount' => $this->overalldiscountamount,
            'overall_sub_total' => $this->overall_sub_total,
            'overalltotal' => $this->overalltotal,
            'saleincrement' => $this->saleincrement,
            'updated_on' => $this->updated_on,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'sales_type', $this->sales_type])
            ->andFilterWhere(['like', 'return_status', $this->return_status])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ip_no', $this->ip_no])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'physicianname', $this->physicianname])
            ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
            ->andFilterWhere(['like', 'patienttype', $this->patienttype])
            ->andFilterWhere(['like', 'patient_id', $this->patient_id])
            ->andFilterWhere(['like', 'subvisit_id', $this->subvisit_id])
            ->andFilterWhere(['like', 'subvisit_num', $this->subvisit_num])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phonenumber', $this->phonenumber])
            ->andFilterWhere(['like', 'billnumber', $this->billnumber])
            ->andFilterWhere(['like', 'total', $this->total])
            ->andFilterWhere(['like', 'tot_no_of_items', $this->tot_no_of_items])
            ->andFilterWhere(['like', 'tot_quantity', $this->tot_quantity])
            ->andFilterWhere(['like', 'overalldiscounttype', $this->overalldiscounttype])
            ->andFilterWhere(['like', 'paid_status', $this->paid_status])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
    public function reportsearch($params)
    {
        $query = InSales::find()->orderBy(['opsaleid'=>SORT_DESC]);

       $session = Yii::$app->session;
        $role=$session['authUserRole'];
    
        if($role=="Super")
        {
        }
        else
        {$query->andFilterWhere(['branch_id'=>$session['branch_id']]);}

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           
        ]);

        $this->load($params);

        if (!$this->validate()) {
            
            return $dataProvider;
        }
        $query->andFilterWhere([
            'opsaleid' => $this->opsaleid,
            'dob' => $this->dob,
            
        ]);
        
        
        
        
    if(!empty($this->invoicedate) && !empty($this->updated_on))
    {
        $f=$this->invoicedate;
        $t=$this->updated_on;
        $fromdate=date("Y-m-d",strtotime($f));
        $todate=date("Y-m-d",strtotime($t));
        $query->andFilterWhere(['between', 'invoicedate',$fromdate, $todate]);
    }
    
    $query->andFilterWhere(['like', 'name', trim($this->name)])->andFilterWhere(['like', 'gender', trim($this->gender)])
    ->andFilterWhere(['like', 'ip_no', $this->ip_no])
    ->andFilterWhere(['like', 'mrnumber', trim($this->mrnumber)])->andFilterWhere(['like', 'address', $this->address])
        ->andFilterWhere(['like', 'phonenumber', $this->phonenumber])->andFilterWhere(['like', 'physicianname', $this->physicianname])
        ->andFilterWhere(['like', 'billnumber', $this->billnumber])->andFilterWhere(['like', 'updated_by', $this->updated_by])
    ->andFilterWhere([ 'paid_status'=>$this->paid_status])->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);
    $query->andFilterWhere([ 'patienttype'=>$this->patienttype]);
    $query->andFilterWhere(['insurancetype'=>$this->insurancetype]);

        return $dataProvider;
    }
}
