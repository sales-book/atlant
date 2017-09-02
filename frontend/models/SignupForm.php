<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $additional_name;
    public $username;
    public $email;
    public $password;
    public $GUID;
    public $verifyCode;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            //['username', 'required'],
            ['additional_name', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такое имя пользователя уже зарегистрировано.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой электронный адрес уже зарегистрирован.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            //['verifyCode', 'captcha', 'captchaAction' => 'models/user/captcha'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->GUID = $this->GUID;
        $user->additional_name = $this->additional_name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id пользователя',
            'additional_name' => 'Имя',
            'email' => 'Email',
        ];
    }
}
