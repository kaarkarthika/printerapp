<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_saledetail".
 *
 * @property int $opsale_detailid
 * @property string $opsaleid
 * @property string $return_status N=NO RETURN,Y=TABLET RETURN
 * @property int $stockid
 * @property int $stockresponseid
 * @property string $saledate
 * @property string $return_date
 * @property string $productid
 * @property string $brandcode
 * @property string $stock_code
 * @property string $compositionid
 * @property string $unitid
 * @property string $batchnumber
 * @property string $productqty
 * @property string $price
 * @property double $taxableamount
 * @property double $mrpperunit Unit Price of the product don't change column
 * @property string $expiredate
 * @property string $priceperqty product multiply price dont change column name
 * @property string $gstrate
 * @property string $discountrate
 * @property double $gstvalueperquantity
 * @property double $discountvalueperquantity
 * @property double $gstvalue
 * @property double $cgst_percent
 * @property double $sgst_percent
 * @property double $cgstvalue
 * @property double $sgstvalue
 * @property double $total_price_perqty
 * @property double $discountvalue
 * @property string $discount_type
 * @property string $tablet_type
 * @property string $product_name
 * @property string $medicine_type_ins
 * @property string $tablet_tot_unit_ins
 * @property int $is_active
 * @property int $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 * @property string $created_at
 */
class InSaledetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
      public $product_name,$billnumber,$mrnumber,$composition_name,$unitname;
    public static function tableName()
    {
        return 'in_saledetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
 {
        return [
           // [['opsaleid', 'saledate', 'productid', 'stock_code', 'compositionid', 'unitid', 'productqty', 'price', 'priceperqty'], 'required'],
            [['saledate', 'updated_on','discount_type'], 'safe'],
           // [['productid', 'compositionid', 'unitid', 'productqty', 'is_active', 'updated_by'], 'integer'],
            [['price', 'priceperqty'], 'number'],
           // [['opsaleid'], 'string', 'max' => 200],
            [['stock_code', 'updated_ipaddress','discount_type'], 'string', 'max' => 50],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'opsale_detailid' => 'Opsale Detailid',
            'opsaleid' => 'Opsaleid',
            'return_status' => 'Return Status',
            'stockid' => 'Stockid',
            'stockresponseid' => 'Stockresponseid',
            'saledate' => 'Saledate',
            'return_date' => 'Return Date',
            'productid' => 'Productid',
            'brandcode' => 'Brandcode',
            'stock_code' => 'Stock Code',
            'compositionid' => 'Compositionid',
            'unitid' => 'Unitid',
            'batchnumber' => 'Batchnumber',
            'productqty' => 'Productqty',
            'price' => 'Price',
            'taxableamount' => 'Taxableamount',
            'mrpperunit' => 'Mrpperunit',
            'expiredate' => 'Expiredate',
            'priceperqty' => 'Priceperqty',
            'gstrate' => 'Gstrate',
            'discountrate' => 'Discountrate',
            'gstvalueperquantity' => 'Gstvalueperquantity',
            'discountvalueperquantity' => 'Discountvalueperquantity',
            'gstvalue' => 'Gstvalue',
            'cgst_percent' => 'Cgst Percent',
            'sgst_percent' => 'Sgst Percent',
            'cgstvalue' => 'Cgstvalue',
            'sgstvalue' => 'Sgstvalue',
            'total_price_perqty' => 'Total Price Perqty',
            'discountvalue' => 'Discountvalue',
            'discount_type' => 'Discount Type',
            'tablet_type' => 'Tablet Type',
            'product_name' => 'Product Name',
            'medicine_type_ins' => 'Medicine Type Ins',
            'tablet_tot_unit_ins' => 'Tablet Tot Unit Ins',
            'is_active' => 'Is Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'created_at' => 'Created At',
        ];
    }
public function afterFind() {
        
        
        if(isset($this->product)){
         $this->product_name = $this->product->productname;
        
         }
         else{
            $this->product_name ="Not Available";
             
         }
         
         if(isset($this->composition)){
         $this->composition_name = $this->composition->composition_name;
        
         }
         else{
            $this->composition_name ="Not Available";
             
         }
          if(isset($this->unit)){
         $this->unitname = $this->unit->unitvalue;
        
         }
         else{
            $this->unitname ="Not Available";
             
         }
         if(isset($this->sales)){
         $this->billnumber = $this->sales->billnumber;
               $this->mrnumber = $this->sales->mrnumber;
        
         }
         else{
            $this->billnumber ="Not Available";
             
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
 public function getSales()
    {
         return $this->hasOne(Sales::className(), ['opsaleid' => 'opsaleid']);
    }
    
    
}

