<?php

namespace app\controllers;

use app\models\ProjectCategory;
use app\models\WorkTypes;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Employee;
use app\models\DepartmentStructure;
use app\models\Sector;
use app\models\CodesWork;
use app\models\Orders;
use app\models\Project;



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
                'only' => ['logout'],
                'rules' => [
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
     * @return string
     */
    public function actionIndex()
    {
       /*
        $emp=Employee::findBySql('
                                  SELECT e.`id`,`first_name`,`middle_name`,`last_name`,`sector`, structure_category as department, `status`
                                  FROM `employee` as e
                                  JOIN
                                    (SELECT * FROM departmentStructure) as d on d.id = `department_id`
                                  JOIN
                                    (SELECT id, sector FROM sector) as s on s.id = `sector_id`
       where 1
                                  order by e.id
                                    ')->all();
*/
        $emp=Employee::find()
            ->select('`employee`.`id`, `employee`.`sector_id`, `employee`.`department_id`, `first_name`,`middle_name`,`last_name`,`sector`.`sector`, `department_structure`.`structure_category`, `status`')
            ->leftJoin('sector', '`employee`.`sector_id` = `sector`.`id`')
            ->leftJoin('department_structure', '`employee`.`department_id` = `department_structure`.`id`')
            ->with('sectors')
            ->with('departments')
            ->all();

        /*
        echo "<pre>";
        var_dump($emp);
        echo "</pre>";
        exit(0);
*/
        return $this->render('employee',
            [
            'yui' => $emp
            ]
        );
    }

    /**
     * Login action.
     *
     * @return string
     */

    public function actionCode()
    {
        $codes=CodesWork::find()->all();
        /*
        echo "<pre>";
        var_dump($kodes);
        echo "</pre>";
        exit(0);
        */
        return $this->render('code',
            [
                'cod' => $codes
            ]
        );
    }

    public function actionOrder()
    {
        $orders=Orders::find()->all();
        return $this->render('order',
            [
                'order' => $orders
            ]
        );
    }

    public function actionProject()
    {
        $projects=Project::find()
        /*    ->select('`number`, `name`, `customer`, `project`.`status`, `project`.`responsible_id`, `budget_hours`, `planned_end_date`, `actual_end_date`')
            ->leftJoin('employee', '`project`.`responsible_id` = `employee`.`id`')
            ->with('employees')
        */
            ->all();
        return $this->render('project',
            [
                'project' => $projects
            ]
        );
    }

    public function actionCategory()
    {
        $categoryes=ProjectCategory::find()->all();
        return $this->render('category',
            [
                'category' => $categoryes
            ]
        );
    }

    public function actionType()
    {
        $tps=WorkTypes::find()->all();
        return $this->render('workTypes',
            [
                'tp' => $tps
            ]
        );
    }

    public function actionSector()
    {
        $sec=Sector::find()->all();
        return $this->render('sector',
            [
                'sec' => $sec
            ]
        );
    }


    public function actionStructure()
    {
        $ds=DepartmentStructure::find()->all();
        return $this->render('departmentStructure',
            [
                'ds' => $ds
            ]
        );
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
