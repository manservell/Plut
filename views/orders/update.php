<?php
//echo"<pre>";
//header('Content-Type: text/html; charset=utf-8');
//var_dump($items_project);//массив проектов
//var_dump($items_employee);//массив сотрудников
//echo "</pre>";
//exit(0);
?>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = Yii::t('app', 'Обновить {modelClass}: ', [
    'modelClass' => 'заказ',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items_project' => $items_project,
        'items_employee' => $items_employee,
    ]) ?>

</div>
