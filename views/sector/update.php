<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = Yii::t('app', 'Обновить {modelClass}: ', [
    'modelClass' => 'сектор',
]) . $model->sector;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сектора'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->sector, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="sector-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
