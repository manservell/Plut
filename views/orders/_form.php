<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Employee;
use app\models\Project;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?php
    $items = Project::find()
        ->select(['id as value', 'concat(number, " ", name) as label'])
        ->asArray()
        ->all();
    $items = ArrayHelper::map($items, 'value', 'label');
    asort($items);
    reset($items);
    echo $form->field($model, 'project_id')->widget(Select2::className(),
        [
            'data' => $items,
            'options' => ['placeholder' => 'Выберите принадлежность к проекту ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    $items = Employee::find()
        ->select(['id as value', 'last_name as label'])
        ->asArray()
        ->all();
    ?>

    <?php
    $items = Employee::find()
        ->select(['id as value', 'concat(last_name, " ", first_name, " ", middle_name) as label'])
        ->asArray()
        ->all();
    $items = ArrayHelper::map($items, 'value', 'label');
    asort($items);
    reset($items);
    echo $form->field($model, 'responsible_id')->widget(Select2::className(),
        [
            'data' => $items,
            'options' => ['placeholder' => 'Выберите ответственного сотрудника ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?=$form->field($model, 'budget_hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'planned_end_date')->widget(DatePicker::className(), [
       // 'model' => $model,
    //'attribute' => 'from_date',
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    ]);?>
    <?= $form->field($model, 'actual_end_date')->widget(DatePicker::className(), [
        // 'model' => $model,
        //'attribute' => 'from_date',
        //'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]);?>
    <?= $form->field($model, 'status')->checkbox([
        'label' => 'Проект активен?',
    ]); ?>
    <?= $form->field($model, 'status')
        ->radioList([
            '1' => 'Не определён',
            '2' => 'Закрытый',
            '3' => 'Открытый'
        ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
