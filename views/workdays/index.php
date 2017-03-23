<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkdaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Рабочий календарь');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-days-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить 30 дней'), ['index?add_day=true'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            [
                'attribute' => 'hours',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    $res = Html::beginForm(['workdays/index'], 'post', ['data-pjax' => '', 'class' => 'form-inline']);
                    $res .= Html::tag('hours', $model->hours, ['class' => 'hours_view']);
                    $res .= Html::input('text', 'hours', $model->hours, ['class' => 'form-control hours_input']);
                    $res .= Html::input('hidden', 'id', $model->id, ['class' => 'form-control']);
                    $res .= Html::submitButton('Изменить', ['class' => 'btn btn-primary hours_change']);
                    $res .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary hours_save', 'name' => 'hash-button']);
                    $res .= Html::endForm();
                    return $res;
                },
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
