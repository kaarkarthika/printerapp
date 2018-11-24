<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "scheduler_table".
 *
 * @property string $sch_id
 * @property string $physican_master_id
 * @property string $day
 * @property string $start
 * @property string $end
 * @property string $title
 * @property string $backgroundColor
 * @property string $borderColor
 * @property string $textColor
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_ipaddress
 * @property string $user_id
 */
class SchedulerTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scheduler_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'user_id', 'day'], 'safe'],
            [['physican_master_id', 'start', 'end', 'title', 'backgroundColor', 'borderColor', 'textColor', 'updated_ipaddress'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sch_id' => 'Sch ID',
            'physican_master_id' => 'Physican Master ID',
            'day' => 'Day',
            'start' => 'Start',
            'end' => 'End',
            'title' => 'Title',
            'backgroundColor' => 'Background Color',
            'borderColor' => 'Border Color',
            'textColor' => 'Text Color',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_ipaddress' => 'Updated Ipaddress',
            'user_id' => 'User ID',
        ];
    }
}
