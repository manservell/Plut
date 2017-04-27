
<?php
//echo"<pre>";
//header('Content-Type: text/html; charset=utf-8');
//var_dump($items_department);
//var_dump($params_department);
//var_dump($items_sector);
//var_dump($params_sector);
//echo "</pre>";
//exit(0);
?>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = Yii::t('app', 'Создать сотрудника');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сотрудники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'items_department' => $items_department,
        'params_department' => $params_department,
        'items_sector' => $items_sector,
        'params_sector' => $params_sector,
    ]) ?>

</div>
