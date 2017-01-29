<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkTypes */

$this->title = Yii::t('app', 'Create Work Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
