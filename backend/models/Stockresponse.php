<?php

namespace backend\models;

use Yii;
use backend\models\Product;
use backend\models\Vendor;
use backend\models\Stockmaster;
use backend\models\Transferstockapprove;
use backend\models\Transferstock;

/**
 * This is the model class for table "stockresponse".
 *
 * @property integer $stockresponseid
 * @property integer $stockrequestid
 * @property integer $stockid
 * @property string $batchnumber
 * @property integer $receivedquantity
 * @property string $receiveddate
 * @property double $purchaseprice
 * @property double $priceperquantity
 * @property string $manufacturedate
 * @property string $expiredate
 * @property string $purchasedate
 * @property string $sales_status
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Stockresponse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
     
     
       public $companybranch;
	   public $productname;
	   public $vendorname;
	   public $stockcode;
	   public $compositionname;
	   public $brandcode;
	   public $compositionid;
	   
	   
	   
	   
    public static function tableName()
    {
        return 'stockresponse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        //[['vendor_inv_no'], 'unique'],
            //[['stockrequestid', 'batchnumber', 'receivedquantity', 'receiveddate', 'purchaseprice', 'priceperquantity', 'manufacturedate', 'expiredate', 'purchasedate'], 'required'],
            //[['stockrequestid', 'stockid', 'receivedquantity', 'unitid','updated_by'], 'integer'],
            [['receiveddate', 'manufacturedate', 'expiredate','branch_id', 'purchasedate', 'updated_on','updated_ipaddress','sales_status','batchnumber','companybranch','vendor_inv_no'], 'safe'],
        [['purchaseprice', 'priceperquantity','discountpercent','discountvalue','gstpercent','gstvalue','cgstpercent','cgstvalue','sgstpercent','sgstvalue'
            ,'igstpercent','igstvalue','mrpperunit','mrp'], 'number'],
            //[['batchnumber'], 'string', 'max' => 100],
           // [['sales_status'], 'string', 'max' => 10],
         //   [['updated_ipaddress'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stockresponseid' => 'Stockresponseid',
            'stockrequestid' => 'Request Code',
            'stockid' => 'Brand',
            'batchnumber' => 'BatchNo',
            'receivedquantity' => 'ReceivedQty',
            'unitid'=>'unit',
            'receiveddate' => 'ReceivedDate',
            'purchaseprice' => 'PurchasePrice',
            'priceperquantity' => 'Price/Qty',
            'manufacturedate' => 'ManufactureDate',
            'expiredate' => 'ExpiryDate',
            'purchasedate' => 'PurchaseDate',
            'sales_status' => 'SalesStatus',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'productname'=>'Product',
            'vendorname'=>'Vendor',
            'stockcode'=>'Stock Code',
            'compositionname'=>'Composition',
        ];
    }
	public function afterFind() {
		

		 $this->companybranch=$this->company->branch_name;
		 $productid=$this->stockbrandcode->productid;
		 $vendorid=$this->stockbrandcode->vendorid;
		 $productgroupid=$this->stockbrandcode->productgroupid;
		 $compositionid=$this->stockbrandcode->compositionid;
		  $productgroupdata=Productgrouping::find()->where(['productgroupid'=>$productgroupid])->one();
		 $this->stockcode=$productgroupdata->stock_code;
		 $this->brandcode=$productgroupdata->brandcode;
		 $productdata=Product::find()->where(['productid'=>$productid])->one();
		 $this->productname=$productdata->productname;
		 $vendordata=Vendor::find()->where(['vendorid'=>$vendorid])->one();
		 $this->vendorname=$vendordata->vendorname;
		 $compositiondata=Composition::find()->where(['composition_id'=>$compositionid])->one();
		 $this->compositionname=$compositiondata->composition_name;
	     parent::afterFind();	
		 
		 
	}
	
 public function getStockrequestcode()
{
        return $this->hasOne(Stockrequest::className(), ['requestid' => 'stockrequestid']);
}
 public function getStockbrandcode()
{
        return $this->hasOne(Stockmaster::className(), ['stockid' => 'stockid']);
}
public function getUnittype()
    {
        return $this->hasOne(Unit::className(), ['unitid' => 'unitid']);
    }
	
	 public function getStockmaster()
    {
         return $this->hasOne(Stockmaster::className(), ['stockid' => 'stockid']);
    }
	
	
	
	
	public function getTotal()
	{
		        $productid=$this->stockmaster->productid;
				$branchid=$this->stockmaster->branch_id;
				
				$total=0;
				$stockdata=Stockmaster::find()->where(['productid'=>$productid])->andwhere(['branch_id'=>$branchid])->all();
				foreach($stockdata as $k)
				{
					$total+=$k->total_no_of_quantity;
				}
				
				return $total;
	}
	
	
	public function getIntransit()
	{
		
		        $stockrequestid=$this->stockrequestid;
				$requestcode=$this->request_code;
				$stockresponseid=$this->stockresponseid;
			
				
					$intransitqty=0;
				
				$data=Transferstockapprove::find()->where(['transferstockid'=>$stockrequestid])
				->andwhere(['stockresponseid'=>$stockresponseid])->one();
				if($data)
				{
						
						$data1=Transferstock::find()->where(['transferstockid'=>$stockrequestid])
						->andwhere(['status'=>'Approved'])->one();
						if($data1)
						{
							
							 $intransitqty=$data->totalapprovedquantity;
						}
					  
				}	
				
				
				
				
				return $intransitqty;
				
		
	}
	
	


 public function getCompany()
    {
         return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'branch_id']);
    }
}
