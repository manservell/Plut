<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\models\Employee;


/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer')->textInput(['maxlength' => true]) ?>
    <?php
    $sectors = Employee::find()->all();
    $items = [];
    foreach($sectors as $sector){
        $items[$sector['id']]=$sector['last_name'].' '.$sector['first_name'].' '.$sector['middle_name'];
    }
    sort($items);
    $params = [
        'prompt' => 'Выберите сотрудника...'
    ];

    ?>
    <?= $form->field($model, 'responsible_id')->dropDownList($items,$params);?>

    <?= $form->field($model, 'budget_hours')->textInput(['maxlength' => true]) ?>


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

    <?= $form->field($model, 'status')
        ->radioList([
            '1' => 'Не определён',
            '2' => 'Закрытый',
            '3' => 'Открытый'
        ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
