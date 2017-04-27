<?php

namespace app\components;

use Yii;
use yii\web\Controller;

/**
 * ParentController
 */
class ParentController extends Controller
{


    public function beforeAction($action) {
        if (!\Yii::$app->user->isGuest) {
            if (!\Yii::$app->user->can(\Yii::$app->controller->id . '_' . $action->id)) {
                echo '<pre>';
                var_dump(\Yii::$app->controller->id . '_' . $action->id, \Yii::$app->user->getIdentity()->getId());
                echo '</pre>';
                exit(0);
            }
        }
        return parent::beforeAction($action);
    }
}
