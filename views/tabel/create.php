<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tabel */

$this->title = Yii::t('app', 'Create Tabel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tabels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tabel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
