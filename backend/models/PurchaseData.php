<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchase_data".
 *
 * @property integer $id
 * @property string $bill_no
 * @property string $vendor
 * @property string $vendor_branch_id
 * @property string $invoice_no
 * @property string $invoice_date
 * @property double $sub_total
 * @property double $discount_amount
 * @property double $gst_amount
 * @property double $cgst_amount
 * @property double $sgst_amount
 * @property double $total_expenses
 * @property double $net_amount
 * @property double $round_off
 * @property double $total_amount
 * @property string $created_at
 * @property string $updated_by
 * @property string $updated_ipaddress
 */
class PurchaseData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_date', 'created_at', 'updated_by'], 'safe'],
            [['sub_total', 'discount_amount', 'gst_amount', 'cgst_amount', 'sgst_amount', 'total_expenses', 'net_amount', 'round_off', 'total_amount'], 'number'],
            [['bill_no', 'vendor', 'vendor_branch_id', 'invoice_no', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_no' => 'Bill No',
            'vendor' => 'Vendor',
            'vendor_branch_id' => 'Vendor Branch ID',
            'invoice_no' => 'Invoice No',
            'invoice_date' => 'Invoice Date',
            'sub_total' => 'Sub Total',
            'discount_amount' => 'Discount Amount',
            'gst_amount' => 'Gst Amount',
            'cgst_amount' => 'Cgst Amount',
            'sgst_amount' => 'Sgst Amount',
            'total_expenses' => 'Total Expenses',
            'net_amount' => 'Net Amount',
            'round_off' => 'Round Off',
            'total_amount' => 'Total Amount',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
