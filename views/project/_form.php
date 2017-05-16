<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'responsible_id')->widget(Select2::className(),
        [
            'data' => $items_employee,
            'options' => ['placeholder' => 'Выберите ответственного сотрудника ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'budget_hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'planned_end_date')->widget(DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd',
    ]);?>
    <?= $form->field($model, 'actual_end_date')->widget(DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd',
    ]);?>

    <?
    /*echo $form->field($model, 'status')
        ->radioList([
            '0' => 'Открытый',
            '1' => 'Закрытый',
            '2' => 'Не определён'
        ]);
    */
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
