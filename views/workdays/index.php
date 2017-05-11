<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Рабочий календарь');
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
$(document).ready(function(){
    $('body').on('click', '.hours_change',function(e){
        e.stopPropagation();
        e.preventDefault();
        var form = $(this).closest('form');
        form.find('.hours_change').hide();
        form.find('.hours_input').show();
        form.find('.hours_save').show();
        form.find('.hours_view').hide();
    })
})
</script>
<div class="work-days-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if(\Yii::$app->user->can('employee_create')) {
                echo  Html::a(Yii::t('app', 'Добавить 30 дней'), ['index?add_day=1'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            [
                'attribute' => 'hours',
                'format' => 'raw',
                'value' => function ($model, $index) {

                         $res = Html::beginForm(['workdays/index'], 'post', ['data-pjax' => '', 'class' => 'form-inline']);
                         $res .= Html::tag('hours', $model->hours, ['class' => 'hours_view']);
                    if(\Yii::$app->user->can('employee_create')) {
                        $res .= Html::input('text', 'hours', $model->hours, ['class' => 'form-control hours_input']);
                        $res .= Html::input('hidden', 'id', $model->id, ['class' => 'form-control']);
                        $res .= Html::submitButton('Изменить', ['class' => 'btn btn-primary hours_change']);
                        $res .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary hours_save', 'name' => 'hash-button']);
                    }
                         $res .= Html::endForm();
                         return $res;

                },
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
