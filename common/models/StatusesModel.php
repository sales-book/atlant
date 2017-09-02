<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property integer $user_id
 * @property string $StatusID
 * @property string $CreateDate
 * @property string $StatusName
 * @property integer $Deleted
 *
 * @property LeadModel $orders
 */
class StatusesModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //public $StatusName;
    //public $StatusID;

    public static $tableCaption = 'Статусы';
    public static $tableItemName = 'Статус';

    public static $idField = 'StatusID';
    public static $nameField = 'StatusName';

    public static function tableName()
    {
        return '{{%statuses}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['StatusName'], 'required'],
            [['user_id'], 'integer'],
            [['CreateDate'], 'safe'],
            [['StatusName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'StatusID' => 'Статус (ID)',
            'CreateDate' => 'Дата создания',
            'StatusName' => 'Статус',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //public function getLeads()
    //{
    //    return $this->hasMany(LeadModel::className(), ['StatusID' => 'StatusID']);
    //}
}
