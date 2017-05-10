<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\DepartmentStructure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-structure-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'structure_category')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
