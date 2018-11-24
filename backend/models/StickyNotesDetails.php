<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sticky_notes_details".
 *
 * @property string $autoid
 * @property integer $branch_id
 * @property integer $group_id
 * @property string $notes_description
 * @property integer $notes_check
 * @property string $status
 * @property string $created_at
 * @property string $modified_at
 */
class StickyNotesDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sticky_notes_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'group_id', 'notes_check'], 'integer'],
            [['notes_description', 'status'], 'string'],
           // [['notes_check', 'status', 'created_at'], 'required'],
            [['created_at', 'modified_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'autoid' => 'Autoid',
            'branch_id' => 'Branch ID',
            'group_id' => 'Group ID',
            'notes_description' => 'Notes Description',
            'notes_check' => 'Notes Check',
            'status' => 'Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
