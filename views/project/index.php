<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Проекты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать проект'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullName',
            'number',
            'name',
            'customer',
            'budget_hours',
            [
                'attribute' => 'planned_end_date',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    return Html::tag('planned_end_date[]', $model->planned_end_date);
                },
/*
                'filter' =>
                    Html::tag(
                        'div',
                        Html::tag('div', Html::activeTextInput($searchModel, 'planned_end_date_from', ['class' => 'form-control']), ['class' => 'col-xs-6']) .
                        Html::tag('div', Html::activeTextInput($searchModel, 'planned_end_date_till', ['class' => 'form-control']), ['class' => 'col-xs-6']),
                        ['class' => 'row']
                    ),
*/
                'filter' =>
                    DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'planned_end_date_from',
                        'value' => $value,
                        'dateFormat' => 'yyyy-MM-dd',
                    ]).
                    DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'planned_end_date_till',
                        'value' => $value,
                        'dateFormat' => 'yyyy-MM-dd',
                    ])

            ],
            [
                'attribute' => 'actual_end_date',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    return Html::tag('actual_end_date[]', $model->actual_end_date);
                },
                'filter' =>
                    DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'actual_end_date_from',
                        'value' => $value,
                        'dateFormat' => 'yyyy-MM-dd',
                    ]).
                    DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'actual_end_date_till',
                        'value' => $value,
                        'dateFormat' => 'yyyy-MM-dd',
                    ])

            ],
            'status',

            ['class' => 'yii\grid\ActionColumn'],
           // 'template' => '{update}',// иконки удалить, обновить, просмотр....
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
