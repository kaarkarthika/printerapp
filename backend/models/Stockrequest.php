<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stockrequest".
 *
 * @property integer $requestid
 * @property string $requestcode
 * @property integer $vendorid
 * @property integer $productid
 * @property integer $quantity
 * @property string $brandcode
 * @property string $requestdate
 * @property integer $receivequantity
 * @property string $receivedate
 * @property integer $is_active
 * @property string $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Stockrequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $product_name;
	 public $vendor_name;
	 public $unit;
	   public $companybranch;
    public static function tableName()
    {
        return 'stockrequest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['vendorid', 'productid', 'quantity', 'unitid','brandcode', 'requestdate',], 'required'],
            [['is_active'], 'integer'],
            [['requestdate', 'updated_on', 'batch_number','branch_id','requesttype','updated_by', 'requestincrement',
            'updated_ipaddress','brandcode','requestcode','vendorid', 'productid', 'quantity',  'unitid',], 'safe'],
           // [['requestcode'], 'string', 'max' => 50],
           // [['brandcode'], 'string', 'max' => 30],
            //[['updated_by', 'updated_ipaddress'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'requestid' => 'Requestid',
            'requestcode' => 'Request Code',
            'vendorid' => 'Vendor',
            'productid' => 'Product',
            'quantity' => ' Quantity',
            'brandcode' => 'Brand Code',
            'requestdate' => 'Request Date',
            'receivequantity' => 'Receive Quantity',
            'receivedate' => 'Receive Date',
            'requesttype'=>'Request Type',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'unitid'=>'Unit',
           
        ];
    }
	
	public function afterFind() {
		
		
		if(isset($this->product)>0){
			$this->product_name = $this->product->productname;
		}
		 else{$this->product_name ="Not Available";}
		 
		 if(isset($this->vendor)>0){$this->vendor_name = $this->vendor->vendorname;}
		 else{$this->vendor_name ="Not Available";}
		 
		 
		 if(isset($this->unittype)>0){$this->unit = $this->unittype->unitvalue;}
		 else{$this->unit ="Not Available";}
		 
		 $BranchAdmin=BranchAdmin::find()->where(['ba_autoid'=>$this->updated_by]) ->one();
		  if($BranchAdmin){
		  	$this->updated_by = $BranchAdmin->ba_name;
		  }
		 
		if($this->updated_on!="0000-00-00 00:00:00"){
			$this->updated_on=date('d-m-Y H:i:s',strtotime($this->updated_on));
		}
		if(isset($this->company->branch_name)){
			$this->companybranch=$this->company->branch_name;
		}
		 
		
	 parent::afterFind();	
	}
	
	public function getProduct()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
	 public function getVendor()
    {
         return $this->hasOne(Vendor::className(), ['vendorid' => 'vendorid']);
    }
	public function getUnittype()
    {
        return $this->hasOne(Unit::className(), ['unitid' => 'unitid']);
		 
		 
    }
     public function getCompany()
    {
         return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'branch_id']);
    }
	public function getStockrequestcode()
{
        return $this->hasOne(Stockrequest::className(), ['requestid' => 'requestid']);
}


public function getStockrequestcount()
{
    return Stockrequest::find()->where(['requestcode' => $this->requestcode])->count();
}


}
