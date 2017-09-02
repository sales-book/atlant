<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\LeadForm;
use frontend\models\ContactForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionKep()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
            $this->redirect(['/main']);
        }
        $loginWithEmail = Yii::$app->params['loginWithEmail'];
        $model = $loginWithEmail ? new LoginForm(['scenario' => 'loginWithEmail']) : new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            $this->redirect(['/main']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Спасибо что обратились к нам. Мы обязательно ответим Вам, как только сможем.');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка отправки письма.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        $model->GUID = GUID();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $this->redirect(['/login']);
                    //return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    private function leadHendler($id, $siteLayout = true)
    {
        $model = new LeadForm();
        $model->user_id = 1; //По умолчанию user_id всегда установлен на 1
        if (isset($id)) {
            //Если id пользователя в запросе явно указан, то даже авторизованный пользователь может создать заявку для другого пользователя по его id
            $model->user_id = User::findOne(['GUID' => $id])->id;
        }else{
            if (Yii::$app->user->isGuest) {
                //Если id явно не указан и это гость, нужно проверить Cookie, возможно id был ранее сохранен там
                $cookies = Yii::$app->request->cookies;
                $user_guid = $cookies->getValue('user_guid', '');
                If($user_guid != ''){$model->user_id = User::findOne(['GUID' => $user_guid])->id;}
            }else{
                $model->user_id = Yii::$app->user->id;
            }
        }
        // если id был явно задан, то после всех проверок всегда сохраняем его в Cookie, для того чтобы если пользователь уйдет со
        // страницы формы, не отправив ее, он мог отправить форму в другой раз, уже без id в URL
        if (isset($id)) {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'user_guid',
                'value' => $id,
            ]));
        }
        $model->CreateDate = date("Y-m-d H:i:s");;
        $model->StatusID = 1; //При создании новой заявки ее статус всегда равен 1
        if (!$siteLayout){$this->layout = 'ajax';}
        if ($model->load(Yii::$app->request->post())) {
            if ($model->signup()) {
                if (!$siteLayout) {
                    return $this->render('lead_sended');
                }else{
                    if (Yii::$app->user->isGuest) {
                        return $this->render('lead_sended');
                    }else{
                        return $this->redirect(['/main']);
                    }
                }
            }
        }
        return $this->render('lead', [
            'model' => $model,
        ]);
    }

    public function actionLeadForm($id = null)
    {
        return $this->leadHendler($id);
    }

    public function actionLead($id = null)
    {
        return $this->leadHendler($id, false);
    }

    //public function actionLeadSended()
   // {
      //  return $this->render('lead_sended');
    //}
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций по смене пароля');
                //$loginWithEmail = Yii::$app->params['loginWithEmail'];
                //$model = $loginWithEmail ? new LoginForm(['scenario' => 'loginWithEmail']) : new LoginForm();
                //return $this->render('login', [
                //    'model' => $model,
                //]);
                return $this->redirect(['/login']);
                //Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций по смене пароля');
                //return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Такой адрес электронной почты не найден');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль был успешно сохранен');

            return $this->redirect(['/login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
