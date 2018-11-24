<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchase_log".
 *
 * @property string $purchase_id
 * @property string $stock_res_id
 * @property string $stock_req_id
 * @property string $req_code
 * @property string $stock_id
 * @property string $productgroupid
 * @property string $productid
 * @property string $vendor_id
 * @property string $vendor_branch_id
 * @property string $composition_id
 * @property string $branch_id
 * @property string $batch_number
 * @property string $received_qty
 * @property string $total_qty
 * @property string $unit_id
 * @property string $received_date
 * @property double $purchase_price
 * @property double $priceperquantity
 * @property string $receivedfreequantity
 * @property double $discountpercent
 * @property double $discountvalue
 * @property double $gstpercent
 * @property double $gstvalue
 * @property double $cgstpercent
 * @property double $cgstvalue
 * @property double $sgstpercent
 * @property double $sgstvalue
 * @property int $igstpercent
 * @property double $igstvalue
 * @property double $mrpperunit
 * @property double $mrp
 * @property string $manufacturedate
 * @property string $expiredate
 * @property string $purchasedate
 * @property string $sales_status
 * @property int $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class PurchaseLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_res_id', 'stock_req_id', 'stock_id', 'productgroupid', 'productid', 'vendor_id', 'composition_id', 'branch_id', 'received_qty', 'total_qty', 'unit_id', 'igstpercent'], 'integer'],
            [['received_date', 'manufacturedate', 'expiredate', 'purchasedate', 'updated_on','updated_by','req_code', 'sales_status', 'updated_ipaddress','batch_number', 'vendor_branch_id'], 'safe'],
            [['purchase_price', 'priceperquantity', 'discountpercent', 'discountvalue', 'gstpercent', 'gstvalue', 'cgstpercent', 'cgstvalue', 'sgstpercent', 'sgstvalue', 'igstvalue', 'mrpperunit', 'mrp', 'receivedfreequantity'], 'number'],
          //  [['req_code', 'sales_status', 'updated_ipaddress'], 'string', 'max' => 50],
           // [['batch_number'], 'string', 'max' => 100],
           // [['updated_by'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'purchase_id' => 'Purchase ID',
            'stock_res_id' => 'Stock Res ID',
            'stock_req_id' => 'Stock Req ID',
            'req_code' => 'Req Code',
            'stock_id' => 'Stock ID',
            'productgroupid' => 'Productgroupid',
            'productid' => 'Productid',
            'vendor_id' => 'Vendor ID',
            'vendor_branch_id' => 'Vendor Branch ID',
            'composition_id' => 'Composition ID',
            'branch_id' => 'Branch ID',
            'batch_number' => 'Batch Number',
            'received_qty' => 'Received Qty',
            'total_qty' => 'Total Qty',
            'unit_id' => 'Unit ID',
            'received_date' => 'Received Date',
            'purchase_price' => 'Purchase Price',
            'priceperquantity' => 'Priceperquantity',
            'receivedfreequantity' => 'Receivedfreequantity',
            'discountpercent' => 'Discountpercent',
            'discountvalue' => 'Discountvalue',
            'gstpercent' => 'Gstpercent',
            'gstvalue' => 'Gstvalue',
            'cgstpercent' => 'Cgstpercent',
            'cgstvalue' => 'Cgstvalue',
            'sgstpercent' => 'Sgstpercent',
            'sgstvalue' => 'Sgstvalue',
            'igstpercent' => 'Igstpercent',
            'igstvalue' => 'Igstvalue',
            'mrpperunit' => 'Mrpperunit',
            'mrp' => 'Mrp',
            'manufacturedate' => 'Manufacturedate',
            'expiredate' => 'Expiredate',
            'purchasedate' => 'Purchasedate',
            'sales_status' => 'Sales Status',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
