<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\LeadModel;

/**
 * Lead form
 */
class LeadForm extends Model
{
    public $user_id;
    public $lead_id;
    public $CreateDate;
    public $OrgName;
    public $Name;
    public $Phone;
    public $Email;
    public $City;
	public $StatusID;
    public $Description;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $myRules = [
            ['OrgName', 'trim'],
            [['user_id', 'OrgName', 'Name', 'Phone', 'Email', 'City'], 'required'],
            [['OrgName', 'Name', 'Phone', 'Email', 'City'], 'string', 'max' => 255],
            [['Description'], 'string'],

            ['Email', 'trim'],
            ['Email', 'required'],
            ['Email', 'email'],
            ['Email', 'string', 'max' => 255],
            //['Email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой электронный адрес уже зарегистрирован.'],

            //['verifyCode', 'captcha', 'captchaAction' => 'models/user/captcha'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
        if (Yii::$app->user->isGuest) {
            $myRules = array_merge($myRules,[['verifyCode', 'captcha']]);
        }
        return $myRules;
        }

    /**
     * Signs lead up.
     *
     * @return lead|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $lead = new LeadModel();
        $lead->OrgName = $this->OrgName;
        $lead->user_id = $this->user_id;
		$lead->CreateDate = $this->CreateDate;
        $lead->Name = $this->Name;
        $lead->Phone = $this->Phone;
        $lead->Email = $this->Email;
        $lead->City = $this->City;
        $lead->StatusID = $this->StatusID;		
        $lead->Description = $this->Description;
        
        return $lead->save() ? $lead : null;
    }

    public function attributeLabels()
    {
        return [
            'CreateDate' => 'Дата создания заявки',
            'OrgName' => 'Наименование организации',
            'Name' => 'Ваше имя',
            'Phone' => 'Контактный телефон',
            'Email' => 'Электронная почта',
            'City' => 'Город',
			'Description' => 'Описание',
            //'StatusID' => 'Статус (ID)',
            'Deleted' => 'Deleted',
        ];
    }
}
