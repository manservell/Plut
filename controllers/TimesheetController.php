<?php

namespace app\controllers;

use app\models\Employee;
use Yii;
use app\models\TimeSheet;
use app\models\TimesheetSearch;
use app\components\ParentController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Project;
use app\models\Orders;
use app\models\Sector;
use app\models\CodesWork;
use yii\helpers\ArrayHelper;

/**
 * TimesheetController implements the CRUD actions for TimeSheet model.
 */
class TimesheetController extends ParentController
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
        //Запрашиваю ID текущего пользователя
        $person=Yii::$app->user->identity->id;
        //echo "<pre>";
       // var_dump(Yii::$app->request->queryParams);
        //echo "</pre>";
        //exit(0);
        //вывожу в индексе записи только текущего пользователя
        $searchModel->employee_id = $person;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //так было изначально
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        //Создаю новый объект (новая строка в таблице TimeSheet)
        $model = new TimeSheet();
        //Присваиваю переменной значение свойства project_id массива GET
        $project_id = Yii::$app->request->get('project_id');
        //Присваиваю переменной значение свойства order_id массива GET
        $order_id = Yii::$app->request->get('order_id');
        //Если $project_id не пустая, то
       if($project_id){
           //Присваиваю свойству project_number_id объекта TimeSheet значение $project_id (т.е его id)
        $model->project_number_id =$project_id;
           //Присваиваю свойству project_name_id объектаTimeSheet значение $project_id (т.е его id)
        $model->project_name_id =$project_id;
    }
        //Если $order_id не пустая, то
        if($order_id){
            //В таблице Orders нахожу строку (объект), которая соответствует 'id' => $order_id
            $orders = Orders::find()
                ->where(['id' => $order_id])
                ->one();
            //Из этой строки (объекта) получаю id проекта, к которому привязан выбранный заказ
            $project_id= $orders->project_id;
            //echo "<pre>";
            //var_dump($project_id);
            //echo "</pre>";
            //exit(0);
            //Присваиваю новые значения полям
            $model->project_number_id =$project_id;
            $model->project_name_id =$project_id;
            $model->order_number_id =$order_id;
        }

        $model->employee_id = Yii::$app->user->identity->id;
        $model->sector_id= Yii::$app->user->identity->sector_id;

        $items_full_name = Employee::find()
            ->select(['id as value', 'concat(last_name, " ", first_name, " ", middle_name) as label'])
            ->asArray()
            ->all();
        $items_full_name = ArrayHelper::map($items_full_name, 'value', 'label');
        asort($items_full_name);
        reset($items_full_name);

        $items_sector = Sector::find()
            ->select(['id as value', 'concat(sector) as label'])
            ->asArray()
            ->all();
        $items_sector = ArrayHelper::map($items_sector, 'value', 'label');
        asort($items_sector);
        reset($items_sector);

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

        $items_project_name = Project::find()
            ->select(['id as value', 'concat(name, " ", "(",customer,")") as label'])
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

        $render=true;

        if ($model->load(Yii::$app->request->post())) {
            if($model->order_number_id){
                $orders = Orders::find()
                    ->where(['id' => $model->order_number_id])
                    ->one();
                $project_id= $orders->project_id;
                $model->project_number_id =$project_id;
                $model->project_name_id =$project_id;
            }
            $render = false;
            if (!$render && $model->save()) {
                return $this->redirect(['index']);
               // return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                $render = true;
            }
        }

        if($render) {
            return $this->render('create', [
                'model' => $model,
                'items' => $items,
                'items_project_number' => $items_project_number,
                'items_project_name' => $items_project_name,
                'items_orders' => $items_orders,
                'items_full_name' => $items_full_name,
                'items_sector' => $items_sector,

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

        $items_full_name = Employee::find()
            ->select(['id as value', 'concat(last_name, " ", first_name, " ", middle_name) as label'])
            ->asArray()
            ->all();
        $items_full_name = ArrayHelper::map($items_full_name, 'value', 'label');
        asort($items_full_name);
        reset($items_full_name);

        $items_sector = Sector::find()
            ->select(['id as value', 'concat(sector) as label'])
            ->asArray()
            ->all();
        $items_sector = ArrayHelper::map($items_sector, 'value', 'label');
        asort($items_sector);
        reset($items_sector);

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

        $items_project_name = Project::find()
            ->select(['id as value', 'concat(name, " ", "(",customer,")") as label'])
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
            return $this->render('update', [
                'model' => $model,
                'items' => $items,
                'items_project_number' => $items_project_number,
                'items_project_name' => $items_project_name,
                'items_orders' => $items_orders,
                'items_full_name' => $items_full_name,
                'items_sector' => $items_sector,
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
