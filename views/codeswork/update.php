<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CodesWork */

$this->title = Yii::t('app', 'Обновить {modelClass}: ', [
    'modelClass' => 'код работ',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Коды работ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="codes-work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
