<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TimeSheet */

$this->title = Yii::t('app', 'Create Time Sheet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Time Sheets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-sheet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'items_project_number' => $items_project_number,
        'items_project_name' => $items_project_name,
        'items_orders' => $items_orders,
        'items_full_name' => $items_full_name,
    ]) ?>

</div>
