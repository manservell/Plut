<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\TimeSheet */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="time-sheet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->widget(Select2::className(),
        [
            'data' => $items_full_name,
            'disabled'=> true,
           // 'options' => ['placeholder' => 'Выберите наименование проекта ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'sector_id')->widget(Select2::className(),
        [
            'data' => $items_sector,
            'disabled'=> true,
            //'options' => ['placeholder' => 'Выберите сектор ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?php Pjax::begin(); ?>
    <?= $form->field($model, 'project_number_id')->widget(Select2::className(),
        [
            'data' => $items_project_number,
            'options' => ['placeholder' => 'Выберите номер проекта ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?= Html::a("Обновить", ['timesheet/create'], ['class' => 'hidden', 'id'=>'project_number_id_link']) ?>

    <?= $form->field($model, 'project_name_id')->widget(Select2::className(),
        [
            'data' => $items_project_name,
            'disabled'=> true,
            'options' => ['placeholder' => 'Выберите наименование проекта ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'order_number_id')->widget(Select2::className(),
        [
            'data' => $items_orders,
            'options' => ['placeholder' => 'Выберите номер заказа ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?php Pjax::end(); ?>
    <?= $form->field($model, 'work_code_id')->widget(Select2::className(),
        [
            'data' => $items,
            'options' => ['placeholder' => 'Выберите код работ ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd',
    ]);?>

    <?= $form->field($model, 'hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

