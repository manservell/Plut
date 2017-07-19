<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Сотрудники');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if(\Yii::$app->user->can('employee_create')) {
                echo Html::a(Yii::t('app', 'Создать сотрудника'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
    <?php Pjax::begin(); ?> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullName',
            [
                'attribute' => 'photo',
                'contentOptions' => ['class' => 'image-center'],
                //'headerOptions' => ['class' => 'text-center'],
                'format' => 'image',
                'value'=>function($data) {
                    return $data->url.'thumb-'.$data->photo;},
            ],
            'departmentName',
            'sectorName',
            'username',

            [
                'label' => 'Роль',
                'attribute' => 'role',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    return Html::tag('role[]', $model->role);
                },
                'filter'=>$roles,
            ],
            [
                'label' => 'Статус',
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    return Html::checkbox('status[]', $model->status, ['value' => $index, 'disabled' => true]);
                },
                'filter'=>array("1"=>"Работает","0"=>"Не работает"),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',// иконки удалить, обновить, просмотр....
                'visible' => \Yii::$app->user->can('employee_create'),
            ]
        ],
    ]);
    echo Yii::getAlias('@web');

   ?>
    <?php Pjax::end(); ?></div>
