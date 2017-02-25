<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectCategory */

$this->title = Yii::t('app', 'Создать категорию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории по проектам'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
