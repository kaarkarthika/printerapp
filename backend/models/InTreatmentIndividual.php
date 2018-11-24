<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_treatment_individual".
 *
 * @property int $ind_id
 * @property string $treat_ove_id
 * @property string $return_status Return=YES,Return=NO
 * @property string $return_date
 * @property string $treatment_id
 * @property int $qty
 * @property double $rate
 * @property double $mrp
 * @property double $gstpercent
 * @property double $gstvalue
 * @property double $cgst_percent
 * @property double $cgst_value
 * @property double $sgst_percent
 * @property double $sgst_value
 * @property double $discountvalue
 * @property double $discount_percent
 * @property double $total_price
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 * @property string $created_at
 * @property string $updated_at
 */
class InTreatmentIndividual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_treatment_individual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_status'], 'string'],
            [['return_date', 'created_at', 'updated_at'], 'safe'],
            [['qty'], 'integer'],
            [['rate', 'mrp', 'gstpercent', 'gstvalue', 'cgst_percent', 'cgst_value', 'sgst_percent', 'sgst_value', 'discountvalue', 'discount_percent', 'total_price'], 'number'],
            [['treat_ove_id', 'treatment_id', 'user_id', 'user_role', 'ipaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ind_id' => 'Ind ID',
            'treat_ove_id' => 'Treat Ove ID',
            'return_status' => 'Return Status',
            'return_date' => 'Return Date',
            'treatment_id' => 'Treatment ID',
            'qty' => 'Qty',
            'rate' => 'Rate',
            'mrp' => 'Mrp',
            'gstpercent' => 'Gstpercent',
            'gstvalue' => 'Gstvalue',
            'cgst_percent' => 'Cgst Percent',
            'cgst_value' => 'Cgst Value',
            'sgst_percent' => 'Sgst Percent',
            'sgst_value' => 'Sgst Value',
            'discountvalue' => 'Discountvalue',
            'discount_percent' => 'Discount Percent',
            'total_price' => 'Total Price',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
