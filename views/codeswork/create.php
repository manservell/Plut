<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CodesWork */

$this->title = Yii::t('app', 'Создать код работ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Коды работ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codes-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
