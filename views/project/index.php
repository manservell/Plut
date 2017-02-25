<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'planned_end_date',
            'actual_end_date',
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
            'template' => '{update}',// иконки удалить, обновить, просмотр....
                ]
        ],
    ]); ?>
</div>
