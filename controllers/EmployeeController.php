<?php

namespace app\controllers;

use app\models\AuthItem;
use Yii;
use app\models\Employee;
use app\models\EmployeeSearch;
use app\models\DepartmentStructure;
use app\models\Sector;
use app\components\ParentController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends ParentController
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {

        if(empty(Yii::$app->request->queryParams))           // вывожу работающих сотрудников по умолчанию, если не заданны другие фильтры
            Yii::$app->request->queryParams=['EmployeeSearch'=>['status'=>1]];

        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /*
                echo '<pre>';
                var_dump($dataProvider );
                echo '</pre>';
                exit(0);
        */
        $roles = AuthItem::find()->where('type = 1')->all();
        $roles = ArrayHelper::map($roles, 'name', 'name');
       // var_dump(Yii::getAlias('@photoemployees'));
       // exit(0);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roles' => $roles,
        ]);

    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        $model->scenario = 'insert';

    $departments = DepartmentStructure::find()->all();
    $items_department = ArrayHelper::map($departments,'id','structure_category');
    $params_department = [
        'prompt' => 'Выберите категорию по структуре отдела...'
    ];

        $sectors = Sector::find()->all();
        $items_sector = ArrayHelper::map($sectors,'id','sector');
        $params_sector = [
            'prompt' => 'Выберите сектор...'
        ];

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['index']);//переводит на страницу index
        } else {
            return $this->render('create', [
                'model' => $model,
                'items_department' => $items_department,
                'params_department' => $params_department,
                'items_sector' => $items_sector,
                'params_sector' => $params_sector,
            ]);
        }
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        $departments = DepartmentStructure::find()->all();
        $items_department = ArrayHelper::map($departments,'id','structure_category');
        $params_department = [
            'prompt' => 'Выберите категорию по структуре отдела...'
        ];

        $sectors = Sector::find()->all();
        $items_sector = ArrayHelper::map($sectors,'id','sector');
        $params_sector = [
            'prompt' => 'Выберите сектор...'
        ];
        if ($model->load(Yii::$app->request->post()) ) {

            if($model->photo_del){
                $model->delete('photo', true);            }
            if($model->save()){
                return $this->redirect(['index']);//переводит на страницу index
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
                'items_department' => $items_department,
                'params_department' => $params_department,
                'items_sector' => $items_sector,
                'params_sector' => $params_sector,
            ]);
        }
    }

    /**
     * Deletes an existing Employee model.
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
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
