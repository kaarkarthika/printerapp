<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Saledetail;

class SaledetailSearch extends Saledetail
{
   
    public function rules()
    {
        return [
            [['opsale_detailid', 'productid', 'compositionid', 'product_name', 'billnumber','mrnumber','composition_name','unitname','unitid', 'productqty', 'is_active', 'updated_by'], 'integer'],
            [['opsaleid', 'saledate', 'stock_code', 'updated_on','gstrate','discountrate','batchnumber','discount_type','gstvalueperquantity','discountvalueperquantity', 'brandcode','updated_ipaddress'], 'safe'],
            [['price', 'priceperqty'], 'number'],
        ];
    }

  
    public function scenarios()
    {
       
        return Model::scenarios();
    }

   
    public function search($params)
    {
    	
		
		
		
        $query = Saledetail::find()->joinwith(['sales'])->orderBy(['opsaleid'=>SORT_DESC]);
		
		
		
		
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }
		
		$paidstatus=$this->updated_ipaddress;
		if($paidstatus==0)
		{
			$pstatus="UnPaid";
		}
		else {
			$pstatus="Paid";
		}
		
		
		
		
        $query->andFilterWhere([
            'opsale_detailid' => $this->opsale_detailid,
           
            'productqty' => $this->productqty,
            'price' => $this->price,
            'priceperqty' => $this->priceperqty,
            'is_active' => $this->is_active,
             'productid' => $this->productid,
             'compositionid'=> $this->compositionid,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);
		    if(!empty($this->saledate))
			{
				 $saledate=date("Y-m-d",strtotime($this->saledate));
			}
		  
		
		//echo $saledate;die;
		
       $query->andFilterWhere([ 'saledate'=>$saledate]);
        $query->andFilterWhere(['like', 'opsaleid', $this->opsaleid])
            ->andFilterWhere(['like', 'stock_code', $this->stock_code])
			 ->andFilterWhere(['unitid'=> $this->unitid])
			  ->andFilterWhere(['like', 'sales.billnumber', $this->opsaleid])
			   ->andFilterWhere(['like','sales.mrnumber',$this->mrnumber])
			
			
            ->andFilterWhere(['sales.paid_status'=>$pstatus]);

        return $dataProvider;
		
		
    }
    public function returnsearch($params,$id)
    {
        $query = Saledetail::find()->joinwith(['sales']);
		
		
		$query->andFilterWhere(['saledetail.opsaleid'=>$id]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }
		
		
        $query->andFilterWhere([
            'opsale_detailid' => $this->opsale_detailid,
            'saledate' => date("Y-m-d",strtotime($this->saledate)),
            'productqty' => $this->productqty,
            'price' => $this->price,
            'priceperqty' => $this->priceperqty,
            'is_active' => $this->is_active,
             'productid' => $this->productid,
             'compositionid'=> $this->compositionid,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query
            ->andFilterWhere(['like', 'stock_code', $this->stock_code])
			 ->andFilterWhere(['like', 'unit.unitvalue', $this->unitid])
			  ->andFilterWhere(['like', 'sales.billnumber', $this->opsaleid])
			   ->andFilterWhere(['like','sales.mrnumber',$this->mrnumber])
		 ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}