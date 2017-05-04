<?php

namespace app\controllers;

use Yii;
use app\models\CodesWork;
use app\models\CodesworkSearch;
use app\models\WorkTypes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\components\ParentController;

/**
 * CodesworkController implements the CRUD actions for CodesWork model.
 */
class CodesworkController extends ParentController
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
     * Lists all CodesWork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CodesworkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CodesWork model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CodesWork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CodesWork();

        $sectors = WorkTypes::find()->all();
        $items_type = ArrayHelper::map($sectors,'id','type');
        $params_type = [
            'prompt' => 'Выберите тип работ...'
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);//переводит на страницу index
           // return $this->redirect(['view', 'id' => $model->id]);//переводит на страницу view
        } else {
            return $this->render('create', [
                'model' => $model,
                'items_type' => $items_type,
                'params_type' => $params_type,
            ]);
        }
    }

    /**
     * Updates an existing CodesWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sectors = WorkTypes::find()->all();
        $items_type = ArrayHelper::map($sectors,'id','type');
        $params_type = [
            'prompt' => 'Выберите тип работ...'
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);//переводит на страницу index
           // return $this->redirect(['view', 'id' => $model->id]); //переводит на страницу view
        } else {
            return $this->render('update', [
                'model' => $model,
                'items_type' => $items_type,
                'params_type' => $params_type,
            ]);
        }
    }

    /**
     * Deletes an existing CodesWork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CodesWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CodesWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CodesWork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
