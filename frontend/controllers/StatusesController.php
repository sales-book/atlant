<?php

namespace frontend\controllers;

use Yii;
use common\models\StatusesModel;
use frontend\models\StatusesSearchModel;
use frontend\components\ModalFormsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatusesController implements the CRUD actions for CustomersModel model.
 */
class StatusesController extends ModalFormsController
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
     * Lists all StatusesModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StatusesSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the CustomersModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StatusesModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StatusesModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
