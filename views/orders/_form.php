<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Employee;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>




    <?php
    $items = Employee::find()
        ->select(['id as value', 'last_name as label'])
        ->asArray()
        ->all();
    echo "<pre>";
    var_dump($items);
    echo "</pre>";
    //exit(0);
    ?>

    <?= $form->field($model, 'responsible_id')->widget(
        AutoComplete::className(), [
        'clientOptions' => [
            'source' => $items,
            'minLength'=>'3',

        ],
        'options'=>[
            'class'=>'form-control'
        ]
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
