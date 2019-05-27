<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_ref_tbl}}".
 *
 * @property string $id
 * @property string $invoice_id
 * @property string $sac_code
 * @property string $description
 * @property double $amount
 * @property double $gst_percent
 * @property double $cgst_percent
 * @property double $sgst_percent
 * @property string $created_date
 * @property string $updated_date
 * @property string $user_id
 * @property string $updated_ipaddress
 */
class InvoiceRefTbl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invoice_ref_tbl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['amount', 'gst_percent', 'cgst_percent', 'sgst_percent'], 'number'],
            [['created_date', 'updated_date', 'user_id','invoice_id'], 'safe'],
            [[ 'sac_code', 'updated_ipaddress'], 'string', 'max' => 255],
           // [['sac_code','description','amount' ,'gst_percent'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
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
