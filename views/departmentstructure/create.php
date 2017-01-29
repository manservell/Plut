<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DepartmentStructure */

$this->title = 'Create Department Structure';
$this->params['breadcrumbs'][] = ['label' => 'Department Structures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-structure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
