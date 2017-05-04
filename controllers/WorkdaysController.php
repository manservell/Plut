<?php

namespace app\controllers;

use Yii;
use app\models\WorkDays;
use app\models\WorkdaysSearch;
use app\components\ParentController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkdaysController implements the CRUD actions for WorkDays model.
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
            $model = $this->findModel((int)$_POST['id']);
            $model->hours = (int)$_POST['hours'];
            $model->save();
        }
        if( isset($_GET['add_day']) ) {
            for ($i = 1; $i <= 30; $i++) {

                //Находим последний день в БД
                $last_day = WorkDays::find()->orderBy('id DESC')->one();
                $last_day = new \DateTime($last_day->date);
                $model = new WorkDays();

                //Определяем номер дня недели и выбираем количество рабочих часов по умолчанию
                if ($last_day->format('N') == 5 || $last_day->format('N') == 6)
                    $model->hours = 0;
                else
                    $model->hours = 8;
                $model->date = date_add($last_day, date_interval_create_from_date_string('1 days'))->format('Y-m-d');
                $model->save();
            }
            //убираю с урла лишнее, а то добавлялись дни при обновлении страницы
        $data = filter_input( INPUT_GET, 'add_day');
        if( $data){
            // что-то сделали с данными, записали в БД
            header('Location: http://plut.local/workdays/');
            exit();
        }
            //закончил убирать
        }
        $searchModel = new WorkdaysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkDays model.
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
     * @param string $id
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
     * @param string $id
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
     * @param string $id
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
