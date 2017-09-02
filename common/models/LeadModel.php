<?php
namespace common\models;

use Yii;

/**
 * LeadModel model
 *
 * @property integer $lead_id
 * @property integer $user_id
 * @property string $CreateDate
 * @property string $OrgName
 * @property string $Name
 * @property string $Phone
 * @property string $Email
 * @property string $City
 * @property string $Description
 * @property integer $StatusID
 * @property integer $Deleted
  */
class LeadModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $StatusName;

    public static function tableName()
    {
        return '{{%leads}}';
    }
   public function rules()
    {
        return [
            [['OrgName', 'Name', 'Phone', 'Email', 'City'], 'required'],
            [['user_id', 'LeadID', 'StatusID'], 'integer'],
            [['OrgName', 'Name', 'Phone', 'Email', 'City'], 'string', 'max' => 255],
            [['Description'], 'string'],
        ];
    }

    public function getStatuses()
    {
        $a = $this->hasOne(StatusesModel::className(), ['StatusID' => 'StatusID']);
        return $a;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'LeadID' => 'Заявка (ID)',
            'CreateDate' => 'Дата/время создания заявки',
            'OrgName' => 'Наименование организации',
            'Name' => 'Ваше имя',
            'Phone' => 'Контактный телефон',
            'Email' => 'Электронная почта',
            'City' => 'Город',
            'Description' => 'Описание',
            'StatusID' => 'Статус (ID)',
            'StatusName' => 'Статус',
            'Deleted' => 'Deleted',
        ];
    }
}
