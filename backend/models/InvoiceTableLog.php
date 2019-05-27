<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_table_log}}".
 *
 * @property int $auto_id
 * @property string $invoice_id
 * @property string $bill_number
 * @property string $bill_date
 * @property string $company_name
 * @property string $gstin_no
 * @property double $total_ampunt
 * @property string $amt_in_words
 * @property double $total_gst_percent
 * @property double $total_cgst_percent
 * @property double $total_sgst_percent
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class InvoiceTableLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invoice_table_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id','bill_date', 'created_date', 'updated_date', 'user_id','invoice_table_log_id'], 'safe'],
            [['gstin_no'], 'required'],
            [['total_ampunt', 'total_gst_percent', 'total_cgst_percent', 'total_sgst_percent'], 'number'],
            [[ 'bill_number', 'company_name', 'gstin_no', 'amt_in_words', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'invoice_id' => 'Invoice ID',
            'bill_number' => 'Bill Number',
            'bill_date' => 'Bill Date',
            'company_name' => 'Company Name',
            'gstin_no' => 'Gstin No',
            'total_ampunt' => 'Total Ampunt',
            'amt_in_words' => 'Amt In Words',
            'total_gst_percent' => 'Total Gst Percent',
            'total_cgst_percent' => 'Total Cgst Percent',
            'total_sgst_percent' => 'Total Sgst Percent',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
