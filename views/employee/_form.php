<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sector;
use app\models\DepartmentStructure;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <?php
    $departments = DepartmentStructure::find()->all();
    $items = ArrayHelper::map($departments,'id','structure_category');
    $params = [
        'prompt' => 'Выберите категорию по структуре отдела...'
    ];
    ?>
    <?= $form->field($model, 'department_id')->dropDownList($items,$params);?>



    <?php
    $sectors = Sector::find()->all();
    $items = ArrayHelper::map($sectors,'id','sector');
    $params = [
        'prompt' => 'Выберите сектор...'
    ];
    ?>
    <?= $form->field($model, 'sector_id')->dropDownList($items,$params);?>


    <?= $form->field($model, 'status')->checkbox([
        'label' => 'Сотрудник работает?',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
