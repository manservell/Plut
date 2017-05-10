<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentStructure */

$this->title = 'Обновить категорию: ' . $model->structure_category;
$this->params['breadcrumbs'][] = ['label' => 'Категории по структуре отдела', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->structure_category, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="department-structure-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
