<?php

namespace frontend\components;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\db\Query;
use yii\helpers\Json;

class ModalFormsController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!Yii::$app->user->isGuest) {
                return true;
            } else {
                throw new ForbiddenHttpException(Yii::t('yii', 'У Вас нет доступа к этой странице. Возможно Вы не авторизованы или не вошли в систему. Попробуйте авторизоваться.'));
            }
        }
        return false;
    }

    public function actionRecordModalForm($search = null)
    {
        if (!Yii::$app->user->isGuest) {
            $model_name = '\common\models\\' . ucfirst($search) . 'Model';
            $model = new $model_name();
            $rec_id = Yii::$app->request->get('rec_id');
            if (isset($rec_id)) {
                $model = $this->findRecordsModel($model, $rec_id);
            }
            $idField = $model->idField;
            $nameField = $model->nameField;

            if (!Yii::$app->request->post('update') and !Yii::$app->request->post('set')) {
                $this->layout = 'ajax';
                return $this->render($search . '_form', [
                    'model' => $model,
                ]);
            } else {
                if (Yii::$app->request->post('set')) {
                    $model->user_id = Yii::$app->user->id;
                    if ($model->load(Yii::$app->request->post())) {
                        //$model->$idField = GUID();
                        if (property_exists($model::className(), 'CreateDate')){$model->CreateDate = date("Y-m-d H:m:s");}
                        if ($model->save()) {
                            echo json_encode(['record_id' => $model->getPrimaryKey(), 'record_name' => $model->$nameField]);
                        }
                    }
                }
                if (Yii::$app->request->post('update')) {
                    $rec_id = Yii::$app->request->get('rec_id');
                    if (isset($rec_id)) {
                        $model = $this->findRecordsModel($model, $rec_id);
                        if ($model->load(Yii::$app->request->post())) {
                            if ($model->save()) {
                                echo json_encode(['record_id' => $rec_id, 'record_name' => $model->$nameField]);
                            }
                        }
                    }
                }
            }
        } else {
            return $this->render('/err');
        }
    }

    protected function findRecordsModel($empty_model, $id)
    {
        if (!Yii::$app->user->isGuest) {
            if (($model = $empty_model::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('Запрашиваемая страница не существует.');
            }
        } else {
            return $this->render('/err');
        }
    }


    protected function getDataProvider($func)
    {
        $searchModel = new $func();
        return $searchModel->search(\Yii::$app->request->get());
    }

    public function actionModalList($returnId = null, $returnName = null, $search = null, $fld_id = null)
    {
        if (!is_null($search)) {
            $this->layout = 'ajax';
            $func = '\frontend\models\\' . ucfirst($search) . 'SearchModel';
            return $this->render('/modalList', [
                'dataProvider' => $this->getDataProvider($func),
                'searchModel' => new $func(),
                'returnId' => $returnId,
                'returnName' => $returnName,
                'fld_id' => $fld_id,
            ]);
        }
    }

    public function actionAjaxList($search = null, $q = null)
    {
        if (!is_null($q)) {
            $model_name = '\common\models\\' . ucfirst($search) . 'Model';
            $model = new $model_name();
            //sleep(2);
            $query = new Query;
            $table_name = $model->tableName();
            $idField = $model->idField;
            $nameField = $model->nameField;
            $user_id = Yii::$app->user->id;
            $query->select("$idField, $nameField")
                ->from($table_name)
                ->where("(user_id = $user_id) AND ($nameField LIKE \"%" . $q . "%\")")
                ->orderBy("$nameField")
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out = [];
            $counter = 0;
            foreach ($data as $d) {
                $out[$counter]['value'] = $d["$nameField"];
                $out[$counter]['data'] = $d["$idField"];
                $counter++;
            }
            $arr2 = array();
            $arr2['suggestions'] = $out;
            return Json::encode($arr2);
        }
    }
}