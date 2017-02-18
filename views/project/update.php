<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = Yii::t('app', 'Обновить {modelClass}: ', [
    'modelClass' => 'проект',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Проекты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="project-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
