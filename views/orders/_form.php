<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Employee;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php
    $sectors = Employee::find()->all();
    $items = ArrayHelper::map($sectors,'id','first_name','last_name');
    $params = [
        'prompt' => 'Выберите сотрудника...'
    ];
    ?>
    <?= $form->field($model, 'responsible_id')->dropDownList($items,$params);?>



    <?=$form->field($model, 'budget_hours')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'planned_end_date')->textInput() ?>
    <? echo DatePicker::widget([
       // 'model' => $model,
    'attribute' => 'from_date',
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
    ]);?>
    <?= $form->field($model, 'actual_end_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
