<?php

namespace frontend\controllers;

use Yii;
use common\models\LeadModel;
use common\models\User;
use frontend\models\LeadSearchModel;
use frontend\components\ModalFormsController;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * WorkoutsController implements the CRUD actions for LeadModel model.
 */
class LkController extends ModalFormsController
{

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LeadModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeadSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $userGUID = User::findOne(['id' => Yii::$app->user->id])->GUID;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userGUID' =>  $userGUID,
        ]);
    }

 
    /**
     * Finds the WorkoutsModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LeadModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findLeadModel($id)
    {
        if (($model = LeadModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенной страницы не существует.');
        }
    }
}
