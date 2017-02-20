<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CodesworkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Коды работ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codes-work-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать код работ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            'name',
            'typeName',
            [
                'label' => 'Примечание',
                'attribute' => 'note',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    return Html::checkbox('note[]', $model->note, ['value' => $index, 'disabled' => true]);
                },
                'filter'=>array("1"=>"Требуется уточнение выполненных работ","0"=>"Не требует уточнения"),
            ],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
            ],
        ],
    ]); ?>
</div>
