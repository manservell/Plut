<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DepartmentStructure */

$this->title = 'Создать категорию структуры отдела';
$this->params['breadcrumbs'][] = ['label' => 'Категории по структуре отдела', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-structure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
