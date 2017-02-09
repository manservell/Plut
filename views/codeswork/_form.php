<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\WorkTypes;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CodesWork */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="codes-work-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    $sectors = WorkTypes::find()->all();
    $items = ArrayHelper::map($sectors,'id','type');
    $params = [
        'prompt' => 'Выберите тип работ...'
    ];
    ?>
    <?= $form->field($model, 'type_id')->dropDownList($items,$params);?>

    <?= $form->field($model, 'note')->checkbox([
        'label' => 'Требуется уточнение выполненных работ?',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
