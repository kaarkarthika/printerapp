<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_returndetail".
 *
 * @property int $return_detailid
 * @property int $return_id
 * @property string $sale_detailid
 * @property int $stockid
 * @property int $stockresponseid
 * @property string $returndate
 * @property int $productid
 * @property string $brandcode
 * @property string $stock_code
 * @property int $compositionid
 * @property int $unitid
 * @property string $batchnumber
 * @property string $expiredate
 * @property int $productqty
 * @property double $price
 * @property string $discount_type
 * @property double $gstvalue
 * @property double $cgstvalue
 * @property double $sgstvalue
 * @property double $discountvalue
 * @property double $mrp
 * @property double $priceperqty
 * @property double $gst_percentage
 * @property double $cgst_percentage
 * @property double $sgst_percentage
 * @property double $discount_percentage
 * @property double $gstrate
 * @property double $discountrate
 * @property double $gstvalueperquantity
 * @property double $discountvalueperquantity
 * @property int $is_active
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class InReturndetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
      public $product_name;
      public $composition_name;
      public $unitname;
      public $returninv;
      public $mrnumber;
    public static function tableName()
    {
        return 'in_returndetail';
    }

    /**
     * @inheritdoc
     */
 public function rules()
    {
        return [
            [['return_id', 'returndate', 'productid', 'stock_code',  'productqty', 'price', 'priceperqty'], 'required'],
            [['return_id', 'productid', 'compositionid', 'unitid', 'productqty', 'is_active', 'updated_by'], 'integer'],
            [['returndate', 'updated_on'], 'safe'],
            [['price', 'priceperqty'], 'number'],
            [['stock_code', 'updated_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'return_detailid' => 'Return Detailid',
            'return_id' => 'Return ID',
            'returndate' => 'Returndate',
            'productid' => 'Productid',
            'stock_code' => 'Stock Code',
            'compositionid' => 'Compositionid',
            'unitid' => 'Unitid',
            'productqty' => 'Productqty',
            'price' => 'Price',
            'priceperqty' => 'Priceperqty',
            'is_active' => 'Is Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'returninv'=>'Invoice Number',
            'mrnumber'=>'Medical Record Number',
        ];
    }
        public function afterFind() {
        
        
        if(count($this->product)>0){
         $this->product_name = $this->product->productname;
        
         }
         else{
            $this->product_name ="Not Available";
             
         }
         
         if(count($this->composition)>0){
         $this->composition_name = $this->composition->composition_name;
        
         }
         else{
            $this->composition_name ="Not Available";
             
         }
          if(count($this->unit)>0){
         $this->unitname = $this->unit->unitvalue;
        
         }
         else{
            $this->unitname ="Not Available";
             
         }
          if(count($this->salesreturn)>0){
         $this->returninv = $this->salesreturn->return_invoicenumber;
              $this->mrnumber=$this->salesreturn->mrnumber;
        
         }
         else{
            $this->returninv ="Not Available";
             
         }
          
          
         
         
     parent::afterFind();   
    }
    
     public function getProduct()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
     public function getComposition()
    {
         return $this->hasOne(Composition::className(), ['composition_id' => 'compositionid']);
    }
  public function getUnit()
    {
         return $this->hasOne(Unit::className(), ['unitid' => 'unitid']);
    }

 public function getSalesreturn()
    {
         return $this->hasOne(Salesreturn::className(), ['return_id' => 'return_id']);
    }
    




}
