<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_ref_tbl_log}}".
 *
 * @property string $auto_id
 * @property string $invoice_table_log_id
 * @property string $invoice_ref_id
 * @property string $sac_code
 * @property string $description
 * @property string $amount
 * @property double $gst_percent
 * @property double $cgst_percent
 * @property double $sgst_percent
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class InvoiceRefTblLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invoice_ref_tbl_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gst_percent', 'cgst_percent', 'sgst_percent'], 'number'],
            [[ 'invoice_ref_id','invoice_table_log_id','created_date', 'updated_date', 'user_id', 'description'], 'safe'],
            [[ 'sac_code', 'amount', 'updated_ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auto_id' => 'Auto ID',
            'invoice_table_log_id' => 'Invoice Table Log ID',
            'invoice_ref_id' => 'Invoice Ref ID',
            'sac_code' => 'Sac Code',
            'description' => 'Description',
            'amount' => 'Amount',
            'gst_percent' => 'Gst Percent',
            'cgst_percent' => 'Cgst Percent',
            'sgst_percent' => 'Sgst Percent',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'user_id' => 'User ID',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
