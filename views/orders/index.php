<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заказы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if(\Yii::$app->user->can('employee_create')) {
                echo Html::a(Yii::t('app', 'Создать заказ'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
    <?php Pjax::begin();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'number',
            'projectNumber',
            'name',
            'fullName',
            'budget_hours',
            [
                'attribute' => 'date_creation',
                'format' => 'raw',
                'filter'=>
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'date_creation_from',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата от: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]).
                    '<br/>'.
                    '<br/>'.
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'date_creation_till',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата до: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ])
            ],
            [
                'attribute' => 'planned_end_date',
                'format' => 'raw',
                'filter'=>
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'planned_end_date_from',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата от: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]).
                    '<br/>'.
                    '<br/>'.
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'planned_end_date_till',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата до: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ])
            ],
            [
                'attribute' => 'actual_end_date',
                'format' => 'raw',
                'filter'=>
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'actual_end_date_from',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата от: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]).
                    '<br/>'.
                    '<br/>'.
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'actual_end_date_till',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата до: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ])
            ],
            [
                'label' => 'Статус',
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    $status=[0=>"Открытый",1=>"Закрытый",2=>"Не определён"];
                    return Html::tag('status[]', $status[$model->status],['0'=>'Открытый','1'=>'Закрытый','2'=>'Не определён'],[]);
                },
                'filter'=>array("0"=>"Открытый","1"=>"Закрытый","2"=>"Не определён"),
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'visible' => \Yii::$app->user->can('employee_create'),],// иконки удалить, обновить, просмотр....
        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
