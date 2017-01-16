<?php

namespace app\controllers;

use app\models\ProjectCategory;
use app\models\Types;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Employee;
use app\models\DepartmentStructure;
use app\models\Sector;
use app\models\KodesWork;
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
                                    (SELECT * FROM department_structure) as d on d.id = `department_id`
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

    public function actionKode()
    {
        $kodes=KodesWork::find()->all();
        /*
        echo "<pre>";
        var_dump($kodes);
        echo "</pre>";
        exit(0);
        */
        return $this->render('kode',
            [
                'kod' => $kodes
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
        $projects=Project::find()->all();
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
        $tps=Types::find()->all();
        return $this->render('types',
            [
                'tp' => $tps
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
