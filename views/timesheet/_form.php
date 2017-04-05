<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TimeSheet */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="time-sheet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'full_name')->widget(Select2::className(),
        [
            'value' => '23',
            'data' => $items_full_name,
            'options' => ['placeholder' => 'Выберите наименование проекта ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>


    <?= $form->field($model, 'sector')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'project_number')->widget(Select2::className(),
        [
            'data' => $items_project_number,
            'options' => ['placeholder' => 'Выберите номер проекта ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php
    echo $form->field($model, 'project_name')->widget(Select2::className(),
        [
            'data' => $items_project_name,
            'options' => ['placeholder' => 'Выберите наименование проекта ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php
    echo $form->field($model, 'order_number')->widget(Select2::className(),
        [
            'data' => $items_orders,
            'options' => ['placeholder' => 'Выберите номер заказа ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php

    echo $form->field($model, 'work_code')->widget(Select2::className(),
        [
            'data' => $items,
            'options' => ['placeholder' => 'Выберите код работ ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        // 'model' => $model,
        //'attribute' => 'from_date',
        //'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]);?>

    <?= $form->field($model, 'hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
