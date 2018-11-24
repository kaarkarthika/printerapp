<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "procedure_cancelation".
 *
 * @property string $can_id
 * @property string $treat_id
 * @property string $name
 * @property string $dob
 * @property string $gender
 * @property string $physician_name
 * @property string $mr_number
 * @property string $pat_id
 * @property string $subvisit_id
 * @property string $subvisit_num
 * @property string $ins_type
 * @property string $treat_bill
 * @property string $can_bill
 * @property string $treat_invoice_date
 * @property string $cancel_invoice_date
 * @property double $cancel_unitprice
 * @property string $can_tot_items
 * @property string $can_qty
 * @property double $can_gst_percent
 * @property double $can_cgst_percent
 * @property double $can_sgst_percent
 * @property double $can_gst_amt
 * @property double $can_cgst_amt
 * @property double $can_sgst_amt
 * @property double $can_dis_percent
 * @property double $can_dis_value
 * @property double $can_due_amt
 * @property double $can_total
 * @property string $reason_cancel
 * @property string $authority
 * @property string $user_id
 * @property string $user_role
 * @property string $created_at
 * @property string $updated_at
 * @property string $ipaddress
 */
class ProcedureCancelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'procedure_cancelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dob', 'treat_invoice_date', 'cancel_invoice_date', 'created_at', 'updated_at','user_id'], 'safe'],
            [['cancel_unitprice', 'can_gst_percent', 'can_cgst_percent', 'can_sgst_percent', 'can_gst_amt', 'can_cgst_amt', 'can_sgst_amt', 'can_dis_percent', 'can_dis_value', 'can_due_amt', 'can_total'], 'number'],
            [['can_tot_items', 'can_qty'], 'integer'],
            [['treat_id', 'gender', 'physician_name', 'mr_number', 'pat_id', 'subvisit_id', 'subvisit_num', 'ins_type', 'treat_bill', 'can_bill'], 'string', 'max' => 100],
            [['name', 'reason_cancel', 'authority', 'user_role', 'ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'can_id' => 'Can ID',
            'treat_id' => 'Treat ID',
            'name' => 'Name',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'physician_name' => 'Physician Name',
            'mr_number' => 'Mr Number',
            'pat_id' => 'Pat ID',
            'subvisit_id' => 'Subvisit ID',
            'subvisit_num' => 'Subvisit Num',
            'ins_type' => 'Ins Type',
            'treat_bill' => 'Treat Bill',
            'can_bill' => 'Can Bill',
            'treat_invoice_date' => 'Treat Invoice Date',
            'cancel_invoice_date' => 'Cancel Invoice Date',
            'cancel_unitprice' => 'Cancel Unitprice',
            'can_tot_items' => 'Can Tot Items',
            'can_qty' => 'Can Qty',
            'can_gst_percent' => 'Can Gst Percent',
            'can_cgst_percent' => 'Can Cgst Percent',
            'can_sgst_percent' => 'Can Sgst Percent',
            'can_gst_amt' => 'Can Gst Amt',
            'can_cgst_amt' => 'Can Cgst Amt',
            'can_sgst_amt' => 'Can Sgst Amt',
            'can_dis_percent' => 'Can Dis Percent',
            'can_dis_value' => 'Can Dis Value',
            'can_due_amt' => 'Can Due Amt',
            'can_total' => 'Can Total',
            'reason_cancel' => 'Reason Cancel',
            'authority' => 'Authority',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
