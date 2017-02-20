<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a(Yii::t('app', 'Создать заказ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
            'planned_end_date',
            'actual_end_date',
            [
                'label' => 'Статус',
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    return Html::listBox('status[]', $model->status,['0'=>'Открытый','1'=>'Закрытый','2'=>'Не определён'],['disabled' => true,'size'=>3]);
                },
                'filter'=>array("0"=>"Открытый","1"=>"Закрытый","2"=>"Не определён"),
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}'],// иконки удалить, обновить, просмотр....
        ],
    ]); ?>
</div>
