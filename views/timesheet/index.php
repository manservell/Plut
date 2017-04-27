<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TimesheetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Табель рабочего времени');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-sheet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать запись'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullName',
            'sectorName',
            'projectNumber',
            'projectName',
            'orderNumber',
            'codeWork',
            [
                'attribute' => 'date',
                'format' => 'raw',
                'filter'=>
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'date_from',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата от: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]).
                    '<br/>'.
                    '<br/>'.
                    DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'date_till',
                        'value'=>$value,
                        'options' => ['placeholder' => 'Дата до: '],
                        'dateFormat' => 'yyyy-MM-dd',
                    ])
            ],
            'hours',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
