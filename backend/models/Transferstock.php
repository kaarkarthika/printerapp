<?php

namespace backend\models;

use Yii;
use backend\models\CompanyBranch;


class Transferstock extends \yii\db\ActiveRecord
{
   
     public $vendor_name;
	 public $product_name;
	 public $unitname;
	 public $approvedateval;
    public static function tableName()
    {
        return 'transferstock';
    }

    public function rules()
    {
        return [
           // [[ 'productid', 'vendorid', 'brandcode', 'frombranch', 'tobranch','unit', 'transferstockquantity'], 'required'],
            [[    'frombranch', 'tobranch', 'transferstockquantity', 'updated_by'], 'integer'],
            [['transferstockdate', 'updated_on'], 'safe'],
            [['updated_ipaddress'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'transferstockid' => 'Transferstockid',
            'productid' => 'Product',
            'frombranch' => 'From Branch',
            'tobranch' => 'To Branch',
            'transferstockquantity' => 'Transfer Stock Quantity',
            'transferstockdate' => 'Transfer Stock Date',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'product_name'=>'Product Name',
             'vendor_name'=>'Vendor Name',
             'companyfrombranch'=>'From Branch',
              'companytobranch'=>'To Branch',
              'unitname'=>'Unit',
        ];
    }
	public function afterFind() {
		
		
		if(isset($this->product)>0){
         $this->product_name = $this->product->productname;
		
		 }
		 else{
		 	$this->product_name ="Not Available";
			 
		 }
		  $this->unitname = $this->unit1->unitvalue;
		  
		  $this->approvedateval = $this->stockval->approveddate;
		
	 parent::afterFind();	
	}
	
	 public function getProduct()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
	
     public function getCompanyfrombranch()
    {
         return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'frombranch']);
    }
public function getCompanytobranch()
    {
         return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'tobranch']);
    }
public function getUnit1()
    {
 return $this->hasOne(Unit::className(), ['unitid' => 'unit']);
    }

public function getStockval()
    {
 return $this->hasOne(Transferstockapprove::className(), ['transferstockid' => 'transferstockid']);
    }

	
}
