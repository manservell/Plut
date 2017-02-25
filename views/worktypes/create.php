<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkTypes */

$this->title = Yii::t('app', 'Создание нового вида работ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Виды работ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
