<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = Yii::t('app', 'Обновить {modelClass}: ', [
    'modelClass' => 'сотрудника',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сотрудники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items_department' => $items_department,
        'params_department' => $params_department,
        'items_sector' => $items_sector,
        'params_sector' => $params_sector,
    ]) ?>

</div>
