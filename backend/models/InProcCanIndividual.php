<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_proc_can_individual".
 *
 * @property string $can_id
 * @property string $can_treat_id
 * @property string $can_proc_ind_id
 * @property string $treat_id
 * @property double $qty
 * @property double $unit_price
 * @property double $mrp
 * @property double $gst_percent
 * @property double $cgst_percent
 * @property double $sgst_percent
 * @property double $gst_value
 * @property double $cgst_value
 * @property double $sgst_value
 * @property double $dis_value
 * @property double $dis_percent
 * @property double $total_price
 * @property string $user_id
 * @property string $ipaddress
 * @property string $created_at
 * @property string $updated_at
 */
class InProcCanIndividual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_proc_can_individual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty', 'unit_price', 'mrp', 'gst_percent', 'cgst_percent', 'sgst_percent', 'gst_value', 'cgst_value', 'sgst_value', 'dis_value', 'dis_percent', 'total_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['can_treat_id', 'treat_id'], 'string', 'max' => 100],
            [['can_proc_ind_id', 'user_id', 'ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'can_id' => 'Can ID',
            'can_treat_id' => 'Can Treat ID',
            'can_proc_ind_id' => 'Can Proc Ind ID',
            'treat_id' => 'Treat ID',
            'qty' => 'Qty',
            'unit_price' => 'Unit Price',
            'mrp' => 'Mrp',
            'gst_percent' => 'Gst Percent',
            'cgst_percent' => 'Cgst Percent',
            'sgst_percent' => 'Sgst Percent',
            'gst_value' => 'Gst Value',
            'cgst_value' => 'Cgst Value',
            'sgst_value' => 'Sgst Value',
            'dis_value' => 'Dis Value',
            'dis_percent' => 'Dis Percent',
            'total_price' => 'Total Price',
            'user_id' => 'User ID',
            'ipaddress' => 'Ipaddress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
