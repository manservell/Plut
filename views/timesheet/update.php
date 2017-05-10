<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TimeSheet */

$this->title = Yii::t('app', 'Обновить {modelClass}: ', [
    'modelClass' => 'запись табеля за',
]) . $model->date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Табель рабочего времени'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="time-sheet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'items_project_number' => $items_project_number,
        'items_project_name' => $items_project_name,
        'items_orders' => $items_orders,
        'items_full_name' => $items_full_name,
        'items_sector' => $items_sector,
    ]) ?>

</div>
