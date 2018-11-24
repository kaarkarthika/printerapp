<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "in_category_reference".
 *
 * @property string $autoid
 * @property double $dr_visit_price
 * @property string $dr_visit_hsn_code
 * @property double $nurse_price
 * @property string $nurse_hsn_code
 * @property string $created_date
 * @property string $update_date
 * @property string $user_id
 * @property string $user_role
 * @property string $ipaddress
 * @property string $category_id
 */
class InCategoryReference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_category_reference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dr_visit_price', 'nurse_price'], 'number'],
            [['created_date', 'update_date','user_id', 'user_role'], 'safe'],
            [['category_id'], 'integer'],
            [['dr_visit_hsn_code', 'nurse_hsn_code',  'ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'dr_visit_price' => 'Dr Visit Price',
            'dr_visit_hsn_code' => 'Dr Visit Hsn Code',
            'nurse_price' => 'Nurse Price',
            'nurse_hsn_code' => 'Nurse Hsn Code',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'ipaddress' => 'Ipaddress',
            'category_id' => 'Category ID',
        ];
    }
}
