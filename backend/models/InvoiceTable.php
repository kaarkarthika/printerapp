<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_table}}".
 *
 * @property string $id
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
class InvoiceTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invoice_table}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bill_date', 'created_date', 'updated_date', 'user_id','customer_name'], 'safe'],
            [['total_ampunt', 'total_gst_percent', 'total_cgst_percent', 'total_sgst_percent'], 'number'],
            [['company_name', 'gstin_no','tax_type','tax_id'], 'required'],
            [['bill_number', 'company_name', 'gstin_no', 'amt_in_words', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_number' => 'Bill Number',
            'bill_date' => 'Bill Date',
            'company_name' => 'Company Name',
            'gstin_no' => 'GSTIN NO',
            'total_ampunt' => 'Total Amount',
            'amt_in_words' => 'Amt In Words',
            'total_gst_percent' => 'Total Gst Percent',
            'total_cgst_percent' => 'Total Cgst Percent',
            'total_sgst_percent' => 'Total Sgst Percent',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
            'tax_type' => 'GST Type',
            'tax_id' => 'GST',
              
        ];
    }
}
