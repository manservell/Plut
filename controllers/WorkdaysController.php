<?php

namespace app\controllers;

use Yii;
use app\models\WorkDays;
use yii\data\ActiveDataProvider;
use app\components\ParentController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkDaysController implements the CRUD actions for WorkDays model.
 */
class WorkdaysController extends ParentController
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
     * Lists all WorkDays models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( isset($_POST['id']) && isset($_POST['hours']) ) {
            $model = $this->findModel((int)Yii::$app->request->post('id'));
            $model->hours = (int)$_POST['hours'];
            $model->save();
        }

        if( isset($_GET['add_day']) ) {
            $last_day = WorkDays::find()->orderBy('id DESC')->one();
            $last_day = new \DateTime($last_day->date);
            $model = new WorkDays();

            if( $last_day->format('N')>5)
                $model->hours = 0;
            else
                $model->hours = 8;

            $model->date = date_add($last_day, date_interval_create_from_date_string('1 days'))->format('Y-m-d');
            $model->save();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => WorkDays::find()->orderBy('id DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkDays model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WorkDays model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WorkDays();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WorkDays model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WorkDays model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    /**
     * Finds the WorkDays model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkDays the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkDays::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
