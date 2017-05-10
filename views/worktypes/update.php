<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WorkTypes */

$this->title = Yii::t('app', 'Обновить {modelClass}: ', [
    'modelClass' => 'вид работ',
]) . $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Виды работ'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'обновить');
?>
<div class="work-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
