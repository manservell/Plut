<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a(Yii::t('app', 'Создать сотрудника'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullName',
            'departmentName',
            'sectorName',
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
            ],
        ],
    ]); ?>
</div>
