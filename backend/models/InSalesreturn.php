<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_salesreturn".
 *
 * @property int $return_id
 * @property int $saleid
 * @property string $return_invoicenumber
 * @property int $patient_type
 * @property string $returndate
 * @property string $name
 * @property string $mrnumber
 * @property string $patient_id
 * @property string $sub_visit_id
 * @property string $subvisit_num
 * @property int $branch_id
 * @property int $returnincrement
 * @property string $return_qty
 * @property string $unit_price
 * @property double $total
 * @property double $totalgstvalue
 * @property double $totalcgstvalue
 * @property double $totalsgstvalue
 * @property double $totaldiscountvalue
 * @property double $totalcgstpercentage
 * @property double $totalsgstpercentage
 * @property double $totalgstpercentage
 * @property double $totaldiscountpercentage
 * @property string $paid_status
 * @property int $is_active
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class InSalesreturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_salesreturn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_invoicenumber', 'patient_type', 'mrnumber','branch_id'], 'required'],
            [['patient_type',  'is_active', 'updated_by','branch_id'], 'integer'],
            [['updated_on'], 'safe'],
            [['return_invoicenumber', 'mrnumber', 'updated_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'return_id' => 'Return ID',
            'saleid' => 'Saleid',
            'return_invoicenumber' => 'Return Invoicenumber',
            'patient_type' => 'Patient Type',
            'returndate' => 'Returndate',
            'name' => 'Name',
            'mrnumber' => 'Mrnumber',
            'patient_id' => 'Patient ID',
            'sub_visit_id' => 'Sub Visit ID',
            'subvisit_num' => 'Subvisit Num',
            'branch_id' => 'Branch ID',
            'returnincrement' => 'Returnincrement',
            'return_qty' => 'Return Qty',
            'unit_price' => 'Unit Price',
            'total' => 'Total',
            'totalgstvalue' => 'Totalgstvalue',
            'totalcgstvalue' => 'Totalcgstvalue',
            'totalsgstvalue' => 'Totalsgstvalue',
            'totaldiscountvalue' => 'Totaldiscountvalue',
            'totalcgstpercentage' => 'Totalcgstpercentage',
            'totalsgstpercentage' => 'Totalsgstpercentage',
            'totalgstpercentage' => 'Totalgstpercentage',
            'totaldiscountpercentage' => 'Totaldiscountpercentage',
            'paid_status' => 'Paid Status',
            'is_active' => 'Is Active',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
