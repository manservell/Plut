<?php

namespace app\controllers;

use app\models\Employee;
use Yii;
use app\models\TimeSheet;
use app\models\TimesheetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Project;
use app\models\Orders;
use app\models\CodesWork;
use yii\helpers\ArrayHelper;

/**
 * TimesheetController implements the CRUD actions for TimeSheet model.
 */
class TimesheetController extends Controller
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
     * Lists all TimeSheet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimesheetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TimeSheet model.
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
     * Creates a new TimeSheet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       // header('Content-Type: text/html; charset=utf-8');
       // echo "<pre>";
       // var_dump(Yii::$app->user->identity->sectorName);
       // echo "</pre>";
        //exit(0);
        $model = new TimeSheet();
        //$model->full_name= Yii::$app->user->identity->last_name.' '.Yii::$app->user->identity->first_name.' '.Yii::$app->user->identity->middle_name;
        $model->full_name= Yii::$app->user->identity->fullName;
        $model->sector= Yii::$app->user->identity->sectorName;

        $items_full_name = Employee::find()
            ->select(['id as value', 'concat(last_name, " ", first_name, " ", middle_name) as label'])
            ->asArray()
            ->all();
        $items_full_name = ArrayHelper::map($items_full_name, 'value', 'label');
        asort($items_full_name);
        reset($items_full_name);

        $items = CodesWork::find()
            ->select(['id as value', 'concat(code) as label'])
            ->asArray()
            ->all();
        $items = ArrayHelper::map($items, 'value', 'label');
        asort($items);
        reset($items);

        $items_project_number = Project::find()
            ->select(['id as value', 'concat(number) as label'])
            ->asArray()
            ->all();
        $items_project_number = ArrayHelper::map($items_project_number, 'value', 'label');
        asort($items_project_number);
        reset($items_project_number);
        // header('Content-Type: text/html; charset=utf-8');
        // echo "<pre>";
        // var_dump($items_project_number);
        // echo "</pre>";
        //exit(0);

        $items_project_name = Project::find()
            ->select(['id as value', 'concat(name) as label'])
            ->asArray()
            ->all();
        $items_project_name = ArrayHelper::map($items_project_name, 'value', 'label');
        asort($items_project_name);
        reset($items_project_name);

        $items_orders = Orders::find()
            ->select(['id as value', 'concat(number) as label'])
            ->asArray()
            ->all();
        $items_orders = ArrayHelper::map($items_orders, 'value', 'label');
        asort($items_orders);
        reset($items_orders);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'items' => $items,
                'items_project_number' => $items_project_number,
                'items_project_name' => $items_project_name,
                'items_orders' => $items_orders,
                'items_full_name' => $items_full_name,

            ]);
        }
    }

    /**
     * Updates an existing TimeSheet model.
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
     * Deletes an existing TimeSheet model.
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
     * Finds the TimeSheet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TimeSheet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TimeSheet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
